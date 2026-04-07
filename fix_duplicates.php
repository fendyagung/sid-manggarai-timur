<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use Illuminate\Support\Facades\DB;

$tablesWithDesaId = ['laporans', 'pesans', 'potensis', 'arsips', 'desa_galleries'];

function mergeAndDelete($keepId, $deleteId, $tablesWithDesaId) {
    foreach ($tablesWithDesaId as $table) {
        if (\Illuminate\Support\Facades\Schema::hasColumn($table, 'desa_id')) {
            DB::table($table)->where('desa_id', $deleteId)->update(['desa_id' => $keepId]);
        }
    }
    if (\Illuminate\Support\Facades\Schema::hasColumn('dokumens', 'receiver_desa_id')) {
        DB::table('dokumens')->where('receiver_desa_id', $deleteId)->update(['receiver_desa_id' => $keepId]);
    }
    Desa::find($deleteId)?->delete();
    echo "  Hapus ID=$deleteId -> pindah relasi ke ID=$keepId" . PHP_EOL;
}

echo "=== MULAI PERBAIKAN DATA ===" . PHP_EOL . PHP_EOL;

// =============================================
// 1. BORONG: hapus duplikat kelurahan (keep 160,161,162 - hapus 177,178,179)
// =============================================
echo "[1] Borong - hapus duplikat kelurahan..." . PHP_EOL;
mergeAndDelete(160, 177, $tablesWithDesaId); // Rana Loba
mergeAndDelete(161, 178, $tablesWithDesaId); // Kota Ndora
mergeAndDelete(162, 179, $tablesWithDesaId); // Satar Peot

// =============================================
// 2. ELAR: hapus duplikat Tiwu Kondo (keep 163 - hapus 190)
// =============================================
echo PHP_EOL . "[2] Elar - hapus duplikat Tiwu Kondo..." . PHP_EOL;
mergeAndDelete(163, 190, $tablesWithDesaId);

// =============================================
// 3. ELAR SELATAN: hapus duplikat Lempang Paji (keep 164 - hapus 191)
// =============================================
echo PHP_EOL . "[3] Elar Selatan - hapus duplikat Lempang Paji..." . PHP_EOL;
mergeAndDelete(164, 191, $tablesWithDesaId);

// =============================================
// 4. KOTA KOMBA: hapus duplikat kelurahan (keep 165,166,167 - hapus 192,193,194)
//               hapus desa tidak dikenal (89,102,103,104,107)
// =============================================
echo PHP_EOL . "[4] Kota Komba - duplikat kelurahan + desa tidak dikenal..." . PHP_EOL;
mergeAndDelete(165, 192, $tablesWithDesaId); // Rongga Koe
mergeAndDelete(166, 193, $tablesWithDesaId); // Tanah Rata
mergeAndDelete(167, 194, $tablesWithDesaId); // WatuNggene

// Hapus desa yang tidak ada di master: Bamo, Pari, Pong Ruan, Rana Kolong, Ruan
$unknownKotaKomba = [89, 102, 103, 104, 107];
foreach ($unknownKotaKomba as $id) {
    $d = Desa::find($id);
    if ($d) {
        echo "  Hapus desa tidak dikenal: ID=$id | {$d->nama_desa}" . PHP_EOL;
        // Cek apakah ada relasi dulu
        foreach ($tablesWithDesaId as $table) {
            if (\Illuminate\Support\Facades\Schema::hasColumn($table, 'desa_id')) {
                $count = DB::table($table)->where('desa_id', $id)->count();
                if ($count > 0) {
                    echo "    ⚠️  Ada $count relasi di tabel $table! Skip hapus." . PHP_EOL;
                    continue 2;
                }
            }
        }
        $d->delete();
    }
}

// =============================================
// 5. KOTA KOMBA UTARA: hapus duplikat Golo Nderu (keep 92, hapus 25 - karena 25 ada di Lamba Leda Selatan sebagai Golo Nderu)
//                      hapus desa tidak dikenal: Gunung(94), Komba(96), Lembur(97), Mbengan(98)
// =============================================
echo PHP_EOL . "[5] Kota Komba Utara - duplikat Golo Nderu + desa tidak dikenal..." . PHP_EOL;
// ID=25 (Golo Nderu di Kota Komba Utara) adalah duplikat dari ID=92
// Tapi ID=180 di Lamba Leda Selatan juga Golo Nderu - itu memang ada di master Lamba Leda Selatan
// Untuk Kota Komba Utara: keep=92, delete=25
mergeAndDelete(92, 25, $tablesWithDesaId); // Golo Nderu di Kota Komba Utara

// Hapus desa tidak dikenal: Gunung, Komba, Lembur, Mbengan
$unknownKKU = [94, 96, 97, 98];
foreach ($unknownKKU as $id) {
    $d = Desa::find($id);
    if ($d) {
        foreach ($tablesWithDesaId as $table) {
            if (\Illuminate\Support\Facades\Schema::hasColumn($table, 'desa_id')) {
                $count = DB::table($table)->where('desa_id', $id)->count();
                if ($count > 0) {
                    echo "    ⚠️  Ada $count relasi di $table untuk ID=$id ({$d->nama_desa})! Skip." . PHP_EOL;
                    continue 2;
                }
            }
        }
        echo "  Hapus desa tidak dikenal: ID=$id | {$d->nama_desa}" . PHP_EOL;
        $d->delete();
    }
}

// =============================================
// 6. LAMBA LEDA SELATAN: hapus 3 kelurahan yang salah kecamatan (168,169,170)
//    Kelurahan Mandosawu, Nggalak Leleng, Bangka Leleng milik Lamba Leda
//    (sudah ada di Lamba Leda, jadi ini duplikat salah tempat)
// =============================================
echo PHP_EOL . "[6] Lamba Leda Selatan - hapus kelurahan salah kecamatan..." . PHP_EOL;
// Cek apakah ada di Lamba Leda
$lambaLedaKel = Desa::where('kecamatan', 'Lamba Leda')->where('jenis', 'kelurahan')
    ->whereIn('nama_desa', ['Mandosawu', 'Nggalak Leleng', 'Bangka Leleng'])->get();
echo "  Data di Lamba Leda yang benar: " . $lambaLedaKel->pluck('id')->implode(', ') . PHP_EOL;

foreach ([168, 169, 170] as $id) {
    $d = Desa::find($id);
    if ($d) {
        // Cari pasangannya yang benar di Lamba Leda
        $correct = Desa::where('kecamatan', 'Lamba Leda')
            ->where('nama_desa', $d->nama_desa)
            ->first();
        if ($correct) {
            mergeAndDelete($correct->id, $id, $tablesWithDesaId);
        } else {
            // Tidak ada pasangannya, pindahkan ke Lamba Leda
            echo "  Pindah ID=$id ({$d->nama_desa}) dari Lamba Leda Selatan ke Lamba Leda" . PHP_EOL;
            $d->update(['kecamatan' => 'Lamba Leda']);
        }
    }
}

// =============================================
// 7. SAMBI RAMPAS: hapus duplikat kelurahan (keep 171-176, hapus 184-189)
// =============================================
echo PHP_EOL . "[7] Sambi Rampas - hapus duplikat kelurahan..." . PHP_EOL;
$sambiBag = [
    171 => 184, // Golo Wangkung
    172 => 185, // Golo Wangkung Barat
    173 => 186, // Golo Wangkung Utara
    174 => 187, // Nanga Baras
    175 => 188, // Pota
    176 => 189, // Ulung Baras
];
foreach ($sambiBag as $keep => $delete) {
    mergeAndDelete($keep, $delete, $tablesWithDesaId);
}

// =============================================
// 8. LAMBA LEDA TIMUR: tambah Wanguar Weli yang hilang
// =============================================
echo PHP_EOL . "[8] Lamba Leda Timur - tambah Wanguar Weli..." . PHP_EOL;
$exists = Desa::where('kecamatan', 'Lamba Leda Timur')->where('nama_desa', 'Wanguar Weli')->exists();
if (!$exists) {
    Desa::create(['nama_desa' => 'Wanguar Weli', 'kecamatan' => 'Lamba Leda Timur', 'jenis' => 'desa']);
    echo "  Berhasil tambah Wanguar Weli" . PHP_EOL;
} else {
    echo "  Wanguar Weli sudah ada, skip." . PHP_EOL;
}

// =============================================
// VERIFIKASI AKHIR
// =============================================
$masterData = [
    'Borong'             => ['kel' => 3, 'desa' => 15],
    'Congkar'            => ['kel' => 0, 'desa' => 8],
    'Elar'               => ['kel' => 1, 'desa' => 14],
    'Elar Selatan'       => ['kel' => 1, 'desa' => 13],
    'Kota Komba'         => ['kel' => 3, 'desa' => 0],
    'Kota Komba Utara'   => ['kel' => 0, 'desa' => 11],
    'Lamba Leda'         => ['kel' => 3, 'desa' => 13],
    'Lamba Leda Selatan' => ['kel' => 0, 'desa' => 21],
    'Lamba Leda Timur'   => ['kel' => 0, 'desa' => 19],
    'Lamba Leda Utara'   => ['kel' => 0, 'desa' => 11],
    'Rana Mese'          => ['kel' => 0, 'desa' => 21],
    'Sambi Rampas'       => ['kel' => 6, 'desa' => 6],
];

echo PHP_EOL . "=== VERIFIKASI AKHIR ===" . PHP_EOL;
$allOk = true;
foreach ($masterData as $kec => $expected) {
    $dbKel  = Desa::where('kecamatan', $kec)->where('jenis', 'kelurahan')->count();
    $dbDesa = Desa::where('kecamatan', $kec)->where('jenis', 'desa')->count();
    $ok = ($dbKel === $expected['kel'] && $dbDesa === $expected['desa']);
    if (!$ok) $allOk = false;
    $icon = $ok ? 'OK' : 'MISMATCH';
    echo "[$icon] " . str_pad($kec, 22) . "DB: $dbDesa D + $dbKel K | Expected: {$expected['desa']} D + {$expected['kel']} K" . PHP_EOL;
}

echo PHP_EOL . ($allOk ? "SEMUA DATA SUDAH SESUAI MASTER!" : "Masih ada perbedaan, cek log di atas.") . PHP_EOL;
