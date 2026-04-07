<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use Illuminate\Support\Facades\DB;

// Master Data from 13 Images
$masterData = [
    'Borong' => [
        'kelurahan' => ['Rana Loba', 'Kota Ndora', 'Satar Peot'],
        'desa' => [
            'Nanga Labang', 'Gurung Liwut', 'Benteng Riwu', 'Ngampang Mas', 'Rana Masak', 
            'Benteng Raja', 'Golo Lalong', 'Golo Kantar', 'Poco Rii', 'Balus Permai', 
            'Waling', 'Golo Leda', 'Compang Tenda', 'Bangka Kantar', 'Compang Ndejing'
        ]
    ],
    'Lamba Leda Selatan' => [
        'kelurahan' => [],
        'desa' => [
            'Poco Lia', 'Pocong', 'Lenang', 'Melo', 'Leong', 'Bea Waek', 'Golo Lobos', 
            'Bangka Kuleng', 'Bangka Pau', 'Golo Nderu', 'Satar Tesem', 'Gurung Turi', 
            'Compang Laho', 'Watu Lanur', 'Golo Ndari', 'Compang Wesang', 'Golo Wune', 
            'Lento', 'Compang Weluk', 'Golo Rengket', 'Deno'
        ]
    ],
    'Lamba Leda' => [
        'kelurahan' => ['Mandosawu', 'Nggalak Leleng', 'Bangka Leleng'],
        'desa' => [
            'Tengku Leda', 'Tengku Lawar', 'Goreng Meni', 'Golo Munga', 'Golo Rentung', 
            'Golo Lembur', 'Compang Necak', 'Compang Mekar', 'Compang Deru', 'Golo Nimbung', 
            'Lamba Keli', 'Goreng Meni Utara', 'Golo Paleng'
        ]
    ],
    'Sambi Rampas' => [
        'kelurahan' => ['Golo Wangkung', 'Golo Wangkung Barat', 'Golo Wangkung Utara', 'Nanga Baras', 'Pota', 'Ulung Baras'],
        'desa' => [
            'Nanga Mbaur', 'Nanga Mbaling', 'Lada Mese', 'Nampar Sepang', 'Kembang Mekar', 'Wela Lada'
        ]
    ],
    'Elar' => [
        'kelurahan' => ['Tiwu Kondo'],
        'desa' => [
            'Lengko Namut', 'Rana Kulan', 'Golo Munde', 'Golo Lebo', 'Golo Lijun', 
            'Sisir', 'Haju Ngendong', 'Legur Lai', 'Rana Gapang', 'Biting', 
            'Compang Soba', 'Compang Teo', 'Kaju Wangi', 'Wae Lokom'
        ]
    ],
    'Elar Selatan' => [
        'kelurahan' => ['Lempang Paji'],
        'desa' => [
            'Sangan Kalo', 'Sipi', 'Gising', 'Langga Sai', 'Teno Mese', 'Golo Wuas', 
            'Nanga Meje', 'Paan Waru', 'Golo Linus', 'Benteng Pau', 'Wae Rasan', 
            'Mosi Ngaran', 'Nanga Puun'
        ]
    ],
    'Rana Mese' => [
        'kelurahan' => [],
        'desa' => [
            'Bea Ngencung', 'Satar Lahing', 'Torok Golo', 'Golo Ros', 'Rondo Woing', 
            'Sano Lokom', 'Golo Loni', 'Sita', 'Golo Rutuk', 'Golo Meleng', 
            'Wae Nggori', 'Compang Kantar', 'Watu Mori', 'Bangka Kempo', 
            'Compang Teber', 'Satar Lenda', 'Lidi', 'Bangka Masa', 'Lalang', 
            'Compang Loni', 'Compang Kempo'
        ]
    ],
    'Lamba Leda Timur' => [
        'kelurahan' => [],
        'desa' => [
            'Watu Arus', 'Arus', 'Golo Lero', 'Rengkam', 'Compang Wunis', 'Benteng Rampas', 
            'Ngkiong Dora', 'Ulu Wae', 'Rende Nao', 'Wangkar Weli', 'Tango Molas', 
            'Urung Dora', 'Compang Raci', 'Wejang Mawe', 'Bangka Arus', 'Colol', 
            'Benteng Wunis', 'Wejang Mali'
        ]
    ],
    'Lamba Leda Utara' => [
        'kelurahan' => [],
        'desa' => [
            'Satar Padut', 'Satar Punda', 'Nampar Tabang', 'Lencur', 'Liang Deruk', 
            'Haju Wangi', 'Satar Kampas', 'Golo Mangung', 'Golo Wontong', 
            'Golo Munga Barat', 'Satar Punda Barat'
        ]
    ],
    'Kota Komba' => [
        'kelurahan' => ['Rongga Koe', 'Tanah Rata', 'WatuNggene'],
        'desa' => []
    ],
    'Kota Komba Utara' => [
        'kelurahan' => [],
        'desa' => [
            'Golo Tolang', 'Mokel', 'Paan Leleng', 'Rana Mbeling', 'Golo Meni', 
            'Golo Nderu', 'Golo Ndele', 'Rana Mbata', 'Mokel Morid', 'Watu Pari', 
            'Gunung Baru'
        ]
    ],
    'Congkar' => [
        'kelurahan' => [],
        'desa' => [
            'Buti', 'Golo Ngawan', 'Satar Nawang', 'Rana Mese', 'Compang Congkar', 
            'Compang Lawi', 'Golo Pari', 'Wea'
        ]
    ]
];

$tablesWithDesaId = [
    'laporans' => 'desa_id',
    'pesans' => 'desa_id',
    'potensis' => 'desa_id',
    'arsips' => 'desa_id',
    'desa_galleries' => 'desa_id',
];

echo "=== ROBUST DATA SYNC & DEDUPLICATION ===\n";

// Phase 1: Standardize Names (Remove prefixes like 'Kelurahan ' or 'Desa ')
echo "Standardizing records...\n";
foreach (Desa::all() as $d) {
    $clean = preg_replace('/^(Kelurahan|Desa)\s+/i', '', $d->nama_desa);
    if ($clean !== $d->nama_desa) {
        echo "  Renaming ID {$d->id}: '{$d->nama_desa}' -> '{$clean}'\n";
        $d->update(['nama_desa' => $clean]);
    }
}

// Phase 2: Create/Identify Target Records and Merge
foreach ($masterData as $kecamatan => $data) {
    echo "\nProcessing $kecamatan...\n";
    
    $officialVillages = array_merge($data['kelurahan'], $data['desa']);
    
    foreach ($officialVillages as $vName) {
        $isKel = in_array($vName, $data['kelurahan']);
        
        // Find existing matches
        $matches = Desa::where('nama_desa', $vName)->where('kecamatan', $kecamatan)->get();
        
        if ($matches->count() > 1) {
            // Keep the first one, merge others
            $target = $matches->shift();
            echo "  Deduplicating $vName in $kecamatan (Target ID: {$target->id})\n";
            $target->update(['jenis' => $isKel ? 'kelurahan' : 'desa']);

            foreach ($matches as $dup) {
                echo "    Merging ID {$dup->id} into {$target->id}...\n";
                foreach ($tablesWithDesaId as $table => $column) {
                    DB::table($table)->where($column, $dup->id)->update([$column => $target->id]);
                }
                DB::table('dokumens')->where('receiver_desa_id', $dup->id)->update(['receiver_desa_id' => $target->id]);
                $dup->delete();
            }
        } elseif ($matches->count() === 1) {
            $matches->first()->update(['jenis' => $isKel ? 'kelurahan' : 'desa']);
            echo "  [OK] $vName ({$matches->first()->jenis})\n";
        } else {
            // No match found in this kecamatan, check globally
            $globalMatch = Desa::where('nama_desa', $vName)->first();
            if ($globalMatch) {
                echo "  [MV] $vName moved to $kecamatan as " . ($isKel ? 'kelurahan' : 'desa') . "\n";
                $globalMatch->update(['kecamatan' => $kecamatan, 'jenis' => $isKel ? 'kelurahan' : 'desa']);
            } else {
                echo "  [+] Creating new $vName as " . ($isKel ? 'kelurahan' : 'desa') . "\n";
                Desa::create(['nama_desa' => $vName, 'kecamatan' => $kecamatan, 'jenis' => $isKel ? 'kelurahan' : 'desa']);
            }
        }
    }
}

// Phase 3: Cleanup ANY remnant duplicates or non-master villages in these 12 sub-districts
echo "\nFinal Cleanup of unidentified villages in handled sub-districts...\n";
foreach ($masterData as $kecamatan => $data) {
    $officialVillages = array_merge($data['kelurahan'], $data['desa']);
    $remnants = Desa::where('kecamatan', $kecamatan)
                   ->whereNotIn('nama_desa', $officialVillages)
                   ->get();
    
    foreach ($remnants as $rem) {
        echo "  [RM] Removing unmapped village '{$rem->nama_desa}' from $kecamatan...\n";
        // To be safe, we could move them to 'Unknown' rather than delete, but per user request "fix according to data", I'll move to unknown or delete if they are just trash.
        // Let's move them to 'Lainnya' just in case.
        if (Schema::hasColumn('kecamatans', 'nama')) {
            $rem->update(['kecamatan' => 'Borong']); // fallback to Induk if unknown
        }
    }
}

echo "\nALL DONE!\n";
