<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use Illuminate\Support\Facades\DB;

$masterData = [
    'Borong' => [
        'kelurahan' => ['Rana Loba', 'Kota Ndora', 'Satar Peot'],
        'desa' => ['Nanga Labang', 'Gurung Liwut', 'Benteng Riwu', 'Ngampang Mas', 'Rana Masak', 'Benteng Raja', 'Golo Lalong', 'Golo Kantar', 'Poco Rii', 'Balus Permai', 'Waling', 'Golo Leda', 'Compang Tenda', 'Bangka Kantar', 'Compang Ndejing']
    ],
    'Lamba Leda Selatan' => [
        'kelurahan' => [],
        'desa' => ['Poco Lia', 'Pocong', 'Lenang', 'Melo', 'Leong', 'Bea Waek', 'Golo Lobos', 'Bangka Kuleng', 'Bangka Pau', 'Golo Nderu', 'Satar Tesem', 'Gurung Turi', 'Compang Laho', 'Watu Lanur', 'Golo Ndari', 'Compang Wesang', 'Golo Wune', 'Lento', 'Compang Weluk', 'Golo Rengket', 'Deno']
    ],
    'Lamba Leda' => [
        'kelurahan' => ['Mandosawu', 'Nggalak Leleng', 'Bangka Leleng'],
        'desa' => ['Tengku Leda', 'Tengku Lawar', 'Goreng Meni', 'Golo Munga', 'Golo Rentung', 'Golo Lembur', 'Compang Necak', 'Compang Mekar', 'Compang Deru', 'Golo Nimbung', 'Lamba Keli', 'Goreng Meni Utara', 'Golo Paleng']
    ],
    'Sambi Rampas' => [
        'kelurahan' => ['Golo Wangkung', 'Golo Wangkung Barat', 'Golo Wangkung Utara', 'Nanga Baras', 'Pota', 'Ulung Baras'],
        'desa' => ['Nanga Mbaur', 'Nanga Mbaling', 'Lada Mese', 'Nampar Sepang', 'Kembang Mekar', 'Wela Lada']
    ],
    'Elar' => [
        'kelurahan' => ['Tiwu Kondo'],
        'desa' => ['Lengko Namut', 'Rana Kulan', 'Golo Munde', 'Golo Lebo', 'Golo Lijun', 'Sisir', 'Haju Ngendong', 'Legur Lai', 'Rana Gapang', 'Biting', 'Compang Soba', 'Compang Teo', 'Kaju Wangi', 'Wae Lokom']
    ],
    'Elar Selatan' => [
        'kelurahan' => ['Lempang Paji'],
        'desa' => ['Sangan Kalo', 'Sipi', 'Gising', 'Langga Sai', 'Teno Mese', 'Golo Wuas', 'Nanga Meje', 'Paan Waru', 'Golo Linus', 'Benteng Pau', 'Wae Rasan', 'Mosi Ngaran', 'Nanga Puun']
    ],
    'Rana Mese' => [
        'kelurahan' => [],
        'desa' => ['Bea Ngencung', 'Satar Lahing', 'Torok Golo', 'Golo Ros', 'Rondo Woing', 'Sano Lokom', 'Golo Loni', 'Sita', 'Golo Rutuk', 'Golo Meleng', 'Wae Nggori', 'Compang Kantar', 'Watu Mori', 'Bangka Kempo', 'Compang Teber', 'Satar Lenda', 'Lidi', 'Bangka Masa', 'Lalang', 'Compang Loni', 'Compang Kempo']
    ],
    'Lamba Leda Timur' => [
        'kelurahan' => [],
        'desa' => ['Watu Arus', 'Arus', 'Golo Lero', 'Rengkam', 'Compang Wunis', 'Benteng Rampas', 'Ngkiong Dora', 'Ulu Wae', 'Rende Nao', 'Wangkar Weli', 'Tango Molas', 'Urung Dora', 'Compang Raci', 'Wejang Mawe', 'Bangka Arus', 'Colol', 'Benteng Wunis', 'Wejang Mali']
    ],
    'Lamba Leda Utara' => [
        'kelurahan' => [],
        'desa' => ['Satar Padut', 'Satar Punda', 'Nampar Tabang', 'Lencur', 'Liang Deruk', 'Haju Wangi', 'Satar Kampas', 'Golo Mangung', 'Golo Wontong', 'Golo Munga Barat', 'Satar Punda Barat']
    ],
    'Kota Komba' => [
        'kelurahan' => ['Rongga Koe', 'Tanah Rata', 'WatuNggene'],
        'desa' => []
    ],
    'Kota Komba Utara' => [
        'kelurahan' => [],
        'desa' => ['Golo Tolang', 'Mokel', 'Paan Leleng', 'Rana Mbeling', 'Golo Meni', 'Golo Nderu', 'Golo Ndele', 'Rana Mbata', 'Mokel Morid', 'Watu Pari', 'Gunung Baru']
    ],
    'Congkar' => [
        'kelurahan' => [],
        'desa' => ['Buti', 'Golo Ngawan', 'Satar Nawang', 'Rana Mese', 'Compang Congkar', 'Compang Lawi', 'Golo Pari', 'Wea']
    ]
];

$tablesWithDesaId = ['laporans', 'pesans', 'potensis', 'arsips', 'desa_galleries'];

echo "=== NUCLEAR DATA FIX ===\n";

// Phase 1: Pure Binary Cleaning
echo "Cleaning all records of binary garbage...\n";
foreach (Desa::all() as $d) {
    // Keep only Alphanumeric and spaces
    $cleanName = trim(preg_replace('/[^A-Za-z0-9\s]/', '', str_replace('Kelurahan ', '', $d->nama_desa)));
    // Fix common OCR errors or truncated names if found
    $d->update(['nama_desa' => $cleanName]);
}

// Phase 2: Reconstruction and Merge
foreach ($masterData as $kecamatan => $data) {
    echo "Syncing $kecamatan...\n";
    $list = array_merge($data['kelurahan'], $data['desa']);
    
    foreach ($list as $vName) {
        $isKel = in_array($vName, $data['kelurahan']);
        
        // Find existing matches globally by precise name
        $matches = Desa::where('nama_desa', $vName)->get();
        
        if ($matches->isEmpty()) {
            Desa::create(['nama_desa' => $vName, 'kecamatan' => $kecamatan, 'jenis' => $isKel ? 'kelurahan' : 'desa']);
            continue;
        }

        // Standard merge into ONE record per kecamatan
        $target = $matches->filter(fn($m) => str_contains($m->kecamatan, $kecamatan))->first();
        if (!$target) {
            $target = $matches->first();
            $target->update(['kecamatan' => $kecamatan]);
        }
        $target->update(['jenis' => $isKel ? 'kelurahan' : 'desa', 'nama_desa' => $vName]);

        foreach ($matches as $other) {
            if ($other->id === $target->id) continue;
            
            echo "  Merging {$other->nama_desa} ($other->id -> $target->id)\n";
            foreach ($tablesWithDesaId as $table) {
                DB::table($table)->where('desa_id', $other->id)->update(['desa_id' => $target->id]);
            }
            DB::table('dokumens')->where('receiver_desa_id', $other->id)->update(['receiver_desa_id' => $target->id]);
            $other->delete();
        }
    }
}

// Final Step: DELETE any village in these kecamatan that's not on the list
foreach ($masterData as $kecamatan => $data) {
    $list = array_merge($data['kelurahan'], $data['desa']);
    Desa::where('kecamatan', $kecamatan)->whereNotIn('nama_desa', $list)->delete();
}

echo "VERIFICATION:\n";
foreach ($masterData as $kecamatan => $data) {
    $count = Desa::where('kecamatan', $kecamatan)->count();
    $expected = count(array_merge($data['kelurahan'], $data['desa']));
    echo "  $kecamatan: $count / Expected $expected\n";
}
