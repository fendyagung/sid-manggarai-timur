<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

$masterDesas = [
    'Borong' => ['Nanga Labang', 'Gurung Liwut', 'Benteng Riwu', 'Ngampang Mas', 'Rana Masak', 'Benteng Raja', 'Golo Lalong', 'Golo Kantar', 'Poco Rii', 'Balus Permai', 'Waling', 'Golo Leda', 'Compang Tenda', 'Bangka Kantar', 'Compang Ndejing'],
    'Lamba Leda Selatan' => ['Poco Lia', 'Pocong', 'Lenang', 'Melo', 'Leong', 'Bea Waek', 'Golo Lobos', 'Bangka Kuleng', 'Bangka Pau', 'Golo Nderu', 'Satar Tesem', 'Gurung Turi', 'Compang Laho', 'Watu Lanur', 'Golo Ndari', 'Compang Wesang', 'Golo Wune', 'Lento', 'Compang Weluk', 'Golo Rengket', 'Deno'],
    'Lamba Leda' => ['Tengku Leda', 'Tengku Lawar', 'Goreng Meni', 'Golo Munga', 'Golo Rentung', 'Golo Lembur', 'Compang Necak', 'Compang Mekar', 'Compang Deru', 'Golo Nimbung', 'Lamba Keli', 'Goreng Meni Utara', 'Golo Paleng'],
    'Sambi Rampas' => ['Nanga Mbaur', 'Nanga Mbaling', 'Lada Mese', 'Nampar Sepang', 'Kembang Mekar', 'Wela Lada'],
    'Elar' => ['Lengko Namut', 'Rana Kulan', 'Golo Munde', 'Golo Lebo', 'Golo Lijun', 'Sisir', 'Haju Ngendong', 'Legur Lai', 'Rana Gapang', 'Biting', 'Compang Soba', 'Compang Teo', 'Kaju Wangi', 'Wae Lokom'],
    'Kota Komba' => ['Lembur', 'Ruan', 'Mbengan', 'Rana Kolong', 'Gunung', 'Komba', 'Bamo', 'Pong Ruan'],
    'Rana Mese' => ['Bea Ngencung', 'Satar Lahing', 'Torok Golo', 'Golo Ros', 'Rondo Woing', 'Sano Lokom', 'Golo Loni', 'Sita', 'Golo Rutuk', 'Golo Meleng', 'Wae Nggori', 'Compang Kantar', 'Watu Mori', 'Bangka Kempo', 'Compang Teber', 'Satar Lenda', 'Lidi', 'Bangka Masa', 'Lalang', 'Compang Loni', 'Compang Kempo'],
    'Lamba Leda Timur' => ['Watu Arus', 'Arus', 'Golo Lero', 'Rengkam', 'Compang Wunis', 'Benteng Rampas', 'Ngkiong Dora', 'Ulu Wae', 'Rende Nao', 'Wangkar Weli', 'Tango Molas', 'Urung Dora', 'Compang Raci', 'Wejang Mawe', 'Bangka Arus', 'Colol', 'Benteng Wunis', 'Wejang Mali'],
    'Elar Selatan' => ['Sangan Kalo', 'Sipi', 'Gising', 'Langga Sai', 'Teno Mese', 'Golo Wuas', 'Nanga Meje', 'Paan Waru', 'Golo Linus', 'Benteng Pau', 'Wae Rasan', 'Mosi Ngaran', 'Nanga Puun'],
    'Kota Komba Utara' => ['Golo Tolang', 'Mokel', 'Paan Leleng', 'Rana Mbeling', 'Golo Meni', 'Golo Nderu', 'Golo Ndele', 'Rana Mbata', 'Mokel Morid', 'Watu Pari', 'Gunung Baru'],
    'Lamba Leda Utara' => ['Satar Padut', 'Satar Punda', 'Nampar Tabang', 'Lencur', 'Liang Deruk', 'Haju Wangi', 'Satar Kampas', 'Golo Mangung', 'Golo Wontong', 'Golo Munga Barat', 'Satar Punda Barat'],
    'Congkar' => ['Buti', 'Golo Ngawan', 'Satar Nawang', 'Rana Mese', 'Compang Congkar', 'Compang Lawi', 'Golo Pari', 'Wea'],
];

$kelurahans = [
    'Borong' => ['Rana Loba', 'Kota Ndora', 'Satar Peot'],
    'Elar' => ['Tiwu Kondo'],
    'Elar Selatan' => ['Lempang Paji'],
    'Kota Komba' => ['Rongga Koe', 'Tanah Rata', 'WatuNggene'],
    'Lamba Leda' => ['Mandosawu', 'Nggalak Leleng', 'Bangka Leleng'],
    'Sambi Rampas' => ['Golo Wangkung', 'Golo Wangkung Barat', 'Golo Wangkung Utara', 'Nanga Baras', 'Pota', 'Ulung Baras'],
];

$relationalTables = [
    'desa_galleries' => 'desa_id',
    'dokumens' => 'receiver_desa_id',
    'laporans' => 'desa_id',
    'potensis' => 'desa_id',
];

echo "=== NUCLEAR DATA SYNC (176 GOAL) ===\n";

// Phase 1: Combine into a single Master List
$finalMaster = [];
foreach ($masterDesas as $k => $list) {
    foreach ($list as $name) {
        $finalMaster[] = ['nama' => $name, 'kecamatan' => $k, 'jenis' => 'desa'];
    }
}
foreach ($kelurahans as $k => $list) {
    foreach ($list as $name) {
        $finalMaster[] = ['nama' => $name, 'kecamatan' => $k, 'jenis' => 'kelurahan'];
    }
}

echo "Master list compiled: " . count($finalMaster) . " entries.\n";

// Phase 2: Processing and Merging
foreach ($finalMaster as $m) {
    $name = $m['nama'];
    $kec = $m['kecamatan'];
    $jenis = $m['jenis'];
    
    // 1. Find or Create the canonical record for this specific (name, kecamatan) pair
    $target = Desa::where('nama_desa', $name)->where('kecamatan', $kec)->first();
    
    if (!$target) {
        // Check if there is a record with this name that is NOT yet assigned to its correct kecamatan
        // (i.e. it belongs to this name but has a wrong kecamatan name)
        // We only do this if the name is truly unique in the Master List
        $masterCount = count(array_filter($finalMaster, fn($x) => $x['nama'] === $name));
        
        if ($masterCount === 1) {
            $misplaced = Desa::where('nama_desa', $name)->first();
            if ($misplaced) {
                $target = $misplaced;
                $target->update(['kecamatan' => $kec]);
                echo "  [U] MOVED: $name to $kec\n";
            }
        }
    }

    if (!$target) {
        $target = Desa::create(['nama_desa' => $name, 'kecamatan' => $kec, 'jenis' => $jenis]);
        echo "  [+] CREATED: $name ($kec)\n";
    }

    $target->update(['jenis' => $jenis, 'nama_desa' => $name]);

    // 2. Identify and Merge ALL other records that match this name in this kecamatan
    $localDupes = Desa::where('nama_desa', $name)->where('kecamatan', $kec)->where('id', '!=', $target->id)->get();
    foreach ($localDupes as $other) {
        echo "  [M] MERGING DUPE: ID {$other->id} -> ID {$target->id} for '$name' in $kec\n";
        foreach ($relationalTables as $table => $column) {
            DB::table($table)->where($column, $other->id)->update([$column => $target->id]);
        }
        $other->delete();
    }
}

// Phase 3: Remnant Cleanup
$officialNames = array_column($finalMaster, 'nama');
$officialPairs = array_map(fn($m) => $m['nama'] . '||' . $m['kecamatan'], $finalMaster);

$allDesas = Desa::all();
foreach ($allDesas as $d) {
    $pair = $d->nama_desa . '||' . $d->kecamatan;
    if (!in_array($pair, $officialPairs)) {
        echo "  [D] DELETING UNKNOWN: ID {$d->id} | {$d->nama_desa} ({$d->kecamatan})\n";
        $d->delete();
    }
}

echo "\n--- FINAL VERIFICATION ---\n";
echo "Total Records: " . Desa::count() . " / Expected 176\n";
echo "Desa Count: " . Desa::where('jenis', 'desa')->count() . " / Expected 159\n";
echo "Kelurahan Count: " . Desa::where('jenis', 'kelurahan')->count() . " / Expected 17\n";
