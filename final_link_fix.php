<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use App\Models\Laporan;

$links = [
    'Semua Laporan' => [
        'Laporan Keuangan Semester 1 2024' => 'Desa Colol',
        'Laporan Kebersihan Desa' => 'Desa Golo Loni',
        'Potensi Wisata di Pantai Ligota' => 'Desa Compang Ndejing',
    ]
];

// Based on dashboard screenshot: 
// Colol -> Lamba Leda Timur (now Poco Ranaka Timur)
// Golo Loni -> Rana Mese
// Compang Ndejing -> Borong

$manualMap = [
    'Laporan Keuangan Semester 1 2024' => ['name' => 'Desa Colol', 'kec' => 'Poco Ranaka Timur'],
    'Laporan Kebersihan Desa' => ['name' => 'Desa Golo Loni', 'kec' => 'Rana Mese'],
    'Potensi Wisata di Pantai Ligota' => ['name' => 'Desa Compang Ndejing', 'kec' => 'Borong'],
    'Laporan Pembangunan Jalan' => ['name' => 'Desa Arus', 'kec' => 'Poco Ranaka Timur'], // Guess
    'Dokumentasi Waktu Kegiatan' => ['name' => 'Desa Golo Kantar', 'kec' => 'Borong'], // Guess
];

foreach (Laporan::all() as $l) {
    foreach ($manualMap as $titlePart => $target) {
        if (strpos($l->judul, $titlePart) !== false) {
            $desa = Desa::where('nama_desa', $target['name'])->where('kecamatan', $target['kec'])->first();
            if ($desa) {
                $l->desa_id = $desa->id;
                $l->save();
                echo "Linked '{$l->judul}' to {$desa->nama_desa}\n";
            }
        }
    }
}

echo "Final Village Count: " . Desa::count() . "\n";
echo "Final Linked Reports: " . Laporan::whereNotNull('desa_id')->count() . "/5\n";
