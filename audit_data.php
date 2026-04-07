<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;

$correctData = [
    'Borong' => [
        'Nanga Labang', 'Gurung Liwut', 'Benteng Riwu', 'Ngampang Mas', 'Rana Masak', 'Benteng Raja', 'Golo Lalong',
        'Golo Kantar', 'Poco Rii', 'Balus Permai', 'Waling', 'Golo Leda', 'Compang Tenda', 'Bangka Kantar', 'Compang Ndejing'
    ],
    'Lamba Leda Selatan' => [
        'Poco Lia', 'Pocong', 'Lenang', 'Melo', 'Leong', 'Bea Waek', 'Golo Lobos', 'Bangka Kuleng', 'Bangka Pau',
        'Golo Nderu', 'Satar Tesem', 'Gurung Turi', 'Compang Laho', 'Watu Lanur', 'Golo Ndari', 'Compang Wesang',
        'Golo Wune', 'Lento', 'Compang Weluk', 'Golo Rengket', 'Deno'
    ],
    'Lamba Leda' => [
        'Tengku Leda', 'Tengku Lawar', 'Goreng Meni', 'Golo Munga', 'Golo Rentung', 'Golo Lembur', 'Compang Necak',
        'Compang Mekar', 'Compang Deru', 'Golo Nimbung', 'Lamba Keli', 'Goreng Meni Utara', 'Golo Paleng'
    ],
    'Sambi Rampas' => [
        'Nanga Mbaur', 'Nanga Mbaling', 'Lada Mese', 'Nampar Sepang', 'Kembang Mekar', 'Wela Lada'
    ],
    'Elar' => [
        'Lengko Namut', 'Rana Kulan', 'Golo Munde', 'Golo Lebo', 'Golo Lijun', 'Sisir', 'Haju Ngendong', 
        'Legur Lai', 'Rana Gapang', 'Biting', 'Compang Soba', 'Compang Teo', 'Kaju Wangi', 'Wae Lokom'
    ],
    'Rana Mese' => [
        'Bea Ngencung', 'Satar Lahing', 'Torok Golo', 'Golo Ros', 'Rondo Woing', 'Sano Lokom', 'Golo Loni', 
        'Sita', 'Golo Rutuk', 'Golo Meleng', 'Wae Nggori', 'Compang Kantar', 'Watu Mori', 'Bangka Kempo', 
        'Compang Teber', 'Satar Lenda', 'Lidi', 'Bangka Masa', 'Lalang', 'Compang Loni', 'Compang Kempo'
    ],
    'Lamba Leda Timur' => [
        'Watu Arus', 'Arus', 'Golo Lero', 'Rengkam', 'Compang Wunis', 'Benteng Rampas', 'Ngkiong Dora', 
        'Ulu Wae', 'Rende Nao', 'Wangkar Weli', 'Tango Molas', 'Urung Dora', 'Compang Raci', 
        'Wejang Mawe', 'Bangka Arus', 'Colol', 'Benteng Wunis', 'Wejang Mali'
    ]
];

echo "=== AUDIT DATA DESA ===\n";

foreach ($correctData as $kecamatan => $villages) {
    echo "\nKecamatan: $kecamatan\n";
    $dbVillages = Desa::where('kecamatan', $kecamatan)->pluck('nama_desa')->toArray();
    
    // Missing in DB
    $missing = array_diff($villages, $dbVillages);
    if (!empty($missing)) {
        echo "  [-] Missing in DB: " . implode(', ', $missing) . "\n";
    }
    
    // Extra in DB (misplaced?)
    $extra = array_diff($dbVillages, $villages);
    if (!empty($extra)) {
        echo "  [+] Extra in DB: " . implode(', ', $extra) . "\n";
    }

    // Check if missing villages exist elsewhere
    foreach ($missing as $m) {
        $found = Desa::where('nama_desa', 'LIKE', '%' . $m . '%')->get();
        if ($found->count() > 0) {
            foreach ($found as $f) {
                echo "      [!] Note: '$m' found in DB under kecamatan '{$f->kecamatan}'\n";
            }
        }
    }
}
