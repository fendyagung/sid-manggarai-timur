<?php

use App\Models\Desa;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Initial Counts:\n";
echo "Desa: " . Desa::where('jenis', 'desa')->count() . "\n";
echo "Kelurahan: " . Desa::where('jenis', 'kelurahan')->count() . "\n\n";

// 1. Fix Incorrect Kelurahan (Should be Desa)
$incorrectIDs = [161, 162, 163, 164, 166, 167, 168, 169, 170, 171, 172, 173, 174, 175, 176, 177, 178];
$count = Desa::whereIn('id', $incorrectIDs)->update(['jenis' => 'desa']);
echo "Updated $count records from Kelurahan to Desa.\n";

// 2. Fix Incorrect Desa (Should be Kelurahan)
// Note: mandosawu (22) and nggalak leleng (23) are Poco Ranaka, which is correct as Kelurahan.
$targetKelurahanIDs = [5, 21, 22, 23, 69, 70, 71, 72, 73, 74, 89, 104, 105, 106];
$count2 = Desa::whereIn('id', $targetKelurahanIDs)->update(['jenis' => 'kelurahan']);
echo "Updated $count2 records from Desa to Kelurahan.\n";

// 3. Add Missing Kelurahan for Borong
$borongKelurahans = [
    ['nama_desa' => 'Kelurahan Mandosawu', 'kecamatan' => 'Borong'],
    ['nama_desa' => 'Kelurahan Nggalak Leleng', 'kecamatan' => 'Borong']
];

foreach ($borongKelurahans as $data) {
    if (!Desa::where('nama_desa', $data['nama_desa'])->where('kecamatan', $data['kecamatan'])->exists()) {
        Desa::create([
            'nama_desa' => $data['nama_desa'],
            'kecamatan' => $data['kecamatan'],
            'jenis' => 'kelurahan',
            // Default values
            'user_id' => 1, // Using admin ID as placeholder
            'slug' => \Illuminate\Support\Str::slug($data['nama_desa'] . '-' . $data['kecamatan']),
            'is_desa_wisata' => 0
        ]);
        echo "Created missing: {$data['nama_desa']} ({$data['kecamatan']})\n";
    } else {
        echo "Skipped existing: {$data['nama_desa']} ({$data['kecamatan']})\n";
    }
}

echo "\nFinal Counts:\n";
echo "Desa: " . Desa::where('jenis', 'desa')->count() . "\n";
echo "Kelurahan: " . Desa::where('jenis', 'kelurahan')->count() . "\n";
