<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use Illuminate\Support\Facades\DB;

$tablesWithDesaId = ['laporans', 'pesans', 'potensis', 'arsips', 'desa_galleries'];

echo "=== PERBAIKAN FINAL ===" . PHP_EOL . PHP_EOL;

// =============================================
// 1. Hapus Wanguar Weli dari Lamba Leda Timur (tidak ada di data resmi)
// =============================================
echo "[1] Hapus Wanguar Weli dari Lamba Leda Timur..." . PHP_EOL;
$wanguar = Desa::where('kecamatan', 'Lamba Leda Timur')->where('nama_desa', 'Wanguar Weli')->first();
if ($wanguar) {
    // Cek apakah ada relasi
    $hasRelasi = false;
    foreach ($tablesWithDesaId as $table) {
        if (\Illuminate\Support\Facades\Schema::hasColumn($table, 'desa_id')) {
            $count = DB::table($table)->where('desa_id', $wanguar->id)->count();
            if ($count > 0) {
                echo "  ⚠️  Ada $count relasi di $table! Skip hapus." . PHP_EOL;
                $hasRelasi = true;
            }
        }
    }
    if (!$hasRelasi) {
        $wanguar->delete();
        echo "  ✅ Wanguar Weli (ID={$wanguar->id}) berhasil dihapus." . PHP_EOL;
    }
} else {
    echo "  Wanguar Weli tidak ditemukan, skip." . PHP_EOL;
}

// =============================================
// 2. Tambah 8 desa Kota Komba yang benar
// =============================================
echo PHP_EOL . "[2] Tambah desa-desa Kota Komba..." . PHP_EOL;
$kotaKombaDesa = [
    'Lembur', 'Ruan', 'Mbengan', 'Rana Kolong',
    'Gunung', 'Komba', 'Bamo', 'Pong Ruan'
];

foreach ($kotaKombaDesa as $nama) {
    $exists = Desa::where('kecamatan', 'Kota Komba')
        ->where('nama_desa', $nama)
        ->exists();
    if (!$exists) {
        $new = Desa::create([
            'nama_desa' => $nama,
            'kecamatan' => 'Kota Komba',
            'jenis'     => 'desa'
        ]);
        echo "  ✅ Tambah: $nama (ID={$new->id})" . PHP_EOL;
    } else {
        echo "  - $nama sudah ada, skip." . PHP_EOL;
    }
}

// =============================================
// VERIFIKASI AKHIR
// =============================================
$masterData = [
    'Borong'             => ['kel' => 3,  'desa' => 15],
    'Congkar'            => ['kel' => 0,  'desa' => 8],
    'Elar'               => ['kel' => 1,  'desa' => 14],
    'Elar Selatan'       => ['kel' => 1,  'desa' => 13],
    'Kota Komba'         => ['kel' => 3,  'desa' => 8],
    'Kota Komba Utara'   => ['kel' => 0,  'desa' => 11],
    'Lamba Leda'         => ['kel' => 3,  'desa' => 13],
    'Lamba Leda Selatan' => ['kel' => 0,  'desa' => 21],
    'Lamba Leda Timur'   => ['kel' => 0,  'desa' => 18],
    'Lamba Leda Utara'   => ['kel' => 0,  'desa' => 11],
    'Rana Mese'          => ['kel' => 0,  'desa' => 21],
    'Sambi Rampas'       => ['kel' => 6,  'desa' => 6],
];

echo PHP_EOL . "=== VERIFIKASI AKHIR ===" . PHP_EOL;
$totalDesa = 0;
$totalKel  = 0;
$allOk = true;

foreach ($masterData as $kec => $expected) {
    $dbKel  = Desa::where('kecamatan', $kec)->where('jenis', 'kelurahan')->count();
    $dbDesa = Desa::where('kecamatan', $kec)->where('jenis', 'desa')->count();
    $totalDesa += $dbDesa;
    $totalKel  += $dbKel;
    $ok   = ($dbKel === $expected['kel'] && $dbDesa === $expected['desa']);
    if (!$ok) $allOk = false;
    $icon = $ok ? 'OK  ' : 'BEDA';
    echo "[$icon] " . str_pad($kec, 22) . "DB: $dbDesa D + $dbKel K | Target: {$expected['desa']} D + {$expected['kel']} K" . PHP_EOL;
}

echo PHP_EOL;
echo "TOTAL DESA     : $totalDesa (target: 159)" . PHP_EOL;
echo "TOTAL KELURAHAN: $totalKel (target: 17)" . PHP_EOL;
echo PHP_EOL;
echo ($allOk ? "✅ SEMUA DATA SUDAH SESUAI DATA RESMI!" : "❌ Masih ada perbedaan, cek log di atas.") . PHP_EOL;
