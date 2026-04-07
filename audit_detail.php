<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;

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
        'desa' => ['Watu Arus', 'Arus', 'Golo Lero', 'Rengkam', 'Compang Wunis', 'Benteng Rampas', 'Ngkiong Dora', 'Ulu Wae', 'Rende Nao', 'Wanguar Weli', 'Wangkar Weli', 'Tango Molas', 'Urung Dora', 'Compang Raci', 'Wejang Mawe', 'Bangka Arus', 'Colol', 'Benteng Wunis', 'Wejang Mali']
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

echo "=== AUDIT: DATA DI DB YANG TIDAK ADA DI MASTER ===\n\n";

$totalExtra = 0;
foreach ($masterData as $kecamatan => $data) {
    $masterList = array_merge($data['kelurahan'], $data['desa']);
    $dbRecords = Desa::where('kecamatan', $kecamatan)->get();
    
    $extras = $dbRecords->filter(fn($d) => !in_array($d->nama_desa, $masterList));
    
    if ($extras->isNotEmpty()) {
        echo "[$kecamatan]\n";
        foreach ($extras as $e) {
            echo "  ⚠️  ID={$e->id} | nama='{$e->nama_desa}' | jenis={$e->jenis}\n";
            $totalExtra++;
        }
        echo "\n";
    }
}

echo "=== AUDIT: DUPLIKAT NAMA DESA DALAM KECAMATAN YANG SAMA ===\n\n";

foreach ($masterData as $kecamatan => $data) {
    $dbRecords = Desa::where('kecamatan', $kecamatan)->get();
    $names = $dbRecords->pluck('nama_desa');
    $dupes = $names->duplicates();
    if ($dupes->isNotEmpty()) {
        echo "[$kecamatan] Duplikat: " . $dupes->implode(', ') . "\n";
    }
}

echo "\nTotal data tidak dikenal: $totalExtra\n";
echo "\n=== RINGKASAN PER KECAMATAN ===\n";
foreach ($masterData as $kecamatan => $data) {
    $masterKel = count($data['kelurahan']);
    $masterDesa = count($data['desa']);
    $dbKel = Desa::where('kecamatan', $kecamatan)->where('jenis', 'kelurahan')->count();
    $dbDesa = Desa::where('kecamatan', $kecamatan)->where('jenis', 'desa')->count();
    $status = ($masterKel === $dbKel && $masterDesa === $dbDesa) ? '✅' : '❌';
    echo "$status " . str_pad($kecamatan, 22) . "DB: $dbDesa D + $dbKel K | Master: $masterDesa D + $masterKel K\n";
}
