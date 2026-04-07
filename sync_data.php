<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;

$masterData = [
    'Borong' => [
        'is_kelurahan' => ['Rana Loba', 'Kota Ndora', 'Satar Peot'],
        'is_desa' => [
            'Nanga Labang', 'Gurung Liwut', 'Benteng Riwu', 'Ngampang Mas', 'Rana Masak', 
            'Benteng Raja', 'Golo Lalong', 'Golo Kantar', 'Poco Rii', 'Balus Permai', 
            'Waling', 'Golo Leda', 'Compang Tenda', 'Bangka Kantar', 'Compang Ndejing'
        ]
    ],
    'Lamba Leda Selatan' => [
        'is_kelurahan' => [],
        'is_desa' => [
            'Poco Lia', 'Pocong', 'Lenang', 'Melo', 'Leong', 'Bea Waek', 'Golo Lobos', 
            'Bangka Kuleng', 'Bangka Pau', 'Golo Nderu', 'Satar Tesem', 'Gurung Turi', 
            'Compang Laho', 'Watu Lanur', 'Golo Ndari', 'Compang Wesang', 'Golo Wune', 
            'Lento', 'Compang Weluk', 'Golo Rengket', 'Deno'
        ]
    ],
    'Lamba Leda' => [
        'is_kelurahan' => ['Mandosawu', 'Nggalak Leleng', 'Bangka Leleng'],
        'is_desa' => [
            'Tengku Leda', 'Tengku Lawar', 'Goreng Meni', 'Golo Munga', 'Golo Rentung', 
            'Golo Lembur', 'Compang Necak', 'Compang Mekar', 'Compang Deru', 'Golo Nimbung', 
            'Lamba Keli', 'Goreng Meni Utara', 'Golo Paleng'
        ]
    ],
    'Sambi Rampas' => [
        'is_kelurahan' => ['Golo Wangkung', 'Golo Wangkung Barat', 'Golo Wangkung Utara', 'Nanga Baras', 'Pota', 'Ulung Baras'],
        'is_desa' => [
            'Nanga Mbaur', 'Nanga Mbaling', 'Lada Mese', 'Nampar Sepang', 'Kembang Mekar', 'Wela Lada'
        ]
    ],
    'Elar' => [
        'is_kelurahan' => ['Tiwu Kondo'],
        'is_desa' => [
            'Lengko Namut', 'Rana Kulan', 'Golo Munde', 'Golo Lebo', 'Golo Lijun', 
            'Sisir', 'Haju Ngendong', 'Legur Lai', 'Rana Gapang', 'Biting', 
            'Compang Soba', 'Compang Teo', 'Kaju Wangi', 'Wae Lokom'
        ]
    ],
    'Elar Selatan' => [
        'is_kelurahan' => ['Lempang Paji'],
        'is_desa' => [
            'Sangan Kalo', 'Sipi', 'Gising', 'Langga Sai', 'Teno Mese', 'Golo Wuas', 
            'Nanga Meje', 'Paan Waru', 'Golo Linus', 'Benteng Pau', 'Wae Rasan', 
            'Mosi Ngaran', 'Nanga Puun'
        ]
    ],
    'Rana Mese' => [
        'is_kelurahan' => [],
        'is_desa' => [
            'Bea Ngencung', 'Satar Lahing', 'Torok Golo', 'Golo Ros', 'Rondo Woing', 
            'Sano Lokom', 'Golo Loni', 'Sita', 'Golo Rutuk', 'Golo Meleng', 
            'Wae Nggori', 'Compang Kantar', 'Watu Mori', 'Bangka Kempo', 
            'Compang Teber', 'Satar Lenda', 'Lidi', 'Bangka Masa', 'Lalang', 
            'Compang Loni', 'Compang Kempo'
        ]
    ],
    'Lamba Leda Timur' => [
        'is_kelurahan' => [],
        'is_desa' => [
            'Watu Arus', 'Arus', 'Golo Lero', 'Rengkam', 'Compang Wunis', 'Benteng Rampas', 
            'Ngkiong Dora', 'Ulu Wae', 'Rende Nao', 'Wangkar Weli', 'Tango Molas', 
            'Urung Dora', 'Compang Raci', 'Wejang Mawe', 'Bangka Arus', 'Colol', 
            'Benteng Wunis', 'Wejang Mali'
        ]
    ],
    'Lamba Leda Utara' => [
        'is_kelurahan' => [],
        'is_desa' => [
            'Satar Padut', 'Satar Punda', 'Nampar Tabang', 'Lencur', 'Liang Deruk', 
            'Haju Wangi', 'Satar Kampas', 'Golo Mangung', 'Golo Wontong', 
            'Golo Munga Barat', 'Satar Punda Barat'
        ]
    ],
    'Kota Komba' => [
        'is_kelurahan' => ['Rongga Koe', 'Tanah Rata', 'WatuNggene'],
        'is_desa' => []
    ],
    'Kota Komba Utara' => [
        'is_kelurahan' => [],
        'is_desa' => [
            'Golo Tolang', 'Mokel', 'Paan Leleng', 'Rana Mbeling', 'Golo Meni', 
            'Golo Nderu', 'Golo Ndele', 'Rana Mbata', 'Mokel Morid', 'Watu Pari', 
            'Gunung Baru'
        ]
    ],
    'Congkar' => [
        'is_kelurahan' => [],
        'is_desa' => [
            'Buti', 'Golo Ngawan', 'Satar Nawang', 'Rana Mese', 'Compang Congkar', 
            'Compang Lawi', 'Golo Pari', 'Wea'
        ]
    ]
];

echo "=== SYNCING DATA DESA & KELURAHAN ===\n";

foreach ($masterData as $kecamatan => $data) {
    echo "\nKecamatan: $kecamatan\n";
    
    // Kelurahan
    foreach ($data['is_kelurahan'] as $v) {
        $found = Desa::where('nama_desa', $v)->where('kecamatan', $kecamatan)->first();
        if ($found) {
            $found->update(['jenis' => 'kelurahan']);
            echo "  [V] $v -> Kelurahan (OK)\n";
        } else {
            // Check globally
            $found = Desa::where('nama_desa', $v)->first();
            if ($found) {
                $found->update(['kecamatan' => $kecamatan, 'jenis' => 'kelurahan']);
                echo "  [M] $v -> Moved to $kecamatan as Kelurahan\n";
            } else {
                Desa::create(['nama_desa' => $v, 'kecamatan' => $kecamatan, 'jenis' => 'kelurahan']);
                echo "  [+] $v -> New Kelurahan\n";
            }
        }
    }

    // Desa
    foreach ($data['is_desa'] as $v) {
        // Special case: Golo Nderu
        if ($v === 'Golo Nderu') {
            $found = Desa::where('nama_desa', $v)->where('kecamatan', $kecamatan)->first();
            if (!$found) {
                Desa::create(['nama_desa' => $v, 'kecamatan' => $kecamatan, 'jenis' => 'desa']);
                echo "  [+] Golo Nderu for $kecamatan created.\n";
            } else {
                $found->update(['jenis' => 'desa']);
                echo "  [V] Golo Nderu for $kecamatan (OK)\n";
            }
            continue;
        }

        $found = Desa::where('nama_desa', $v)->where('kecamatan', $kecamatan)->first();
        if ($found) {
            $found->update(['jenis' => 'desa']);
            echo "  [V] $v -> Desa (OK)\n";
        } else {
            $found = Desa::where('nama_desa', $v)->first();
            if ($found && $found->kecamatan != $kecamatan) {
                 // ONLY MOVE IF NOT IN KELURAHAN LIST (which we already processed)
                 $found->update(['kecamatan' => $kecamatan, 'jenis' => 'desa']);
                 echo "  [M] $v -> Moved to $kecamatan\n";
            } else if (!$found) {
                 Desa::create(['nama_desa' => $v, 'kecamatan' => $kecamatan, 'jenis' => 'desa']);
                 echo "  [+] $v -> New Desa\n";
            }
        }
    }
}
echo "\nDONE!\n";
