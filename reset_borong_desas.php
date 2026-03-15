<?php
// reset_borong_desas.php
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use Illuminate\Support\Str;

// Hapus semua data dummy Borong
Desa::where('kecamatan', 'Borong')->delete();

$desasBorong = [
    'Nanga Labang',
    'Gurung Liwut',
    'Benteng Riwu',
    'Ngampang Mas',
    'Rana Masak',
    'Benteng Raja',
    'Golo Lalong',
    'Golo Kantar',
    'Poco Rii',
    'Balus Permai',
    'Waling',
    'Golo Leda',
    'Compang Tenda',
    'Bangka Kantar',
    'Compang Ndejing'
];

foreach ($desasBorong as $index => $nama) {
    Desa::create([
        'nama_desa' => $nama,
        'kode_desa' => '53.19.01.20' . str_pad($index + 1, 2, '0', STR_PAD_LEFT),
        'kepala_desa' => 'Nama Kades ' . $nama, // Dummy untuk mencegah error null
        'kecamatan' => 'Borong',
        'is_desa_wisata' => false,
        'jumlah_penduduk' => 1000,
        'luas_wilayah' => 10.5,
    ]);
}

echo "Berhasil menghapus data lama dan menambahkan " . count($desasBorong) . " desa resmi di Kecamatan Borong.\n";
