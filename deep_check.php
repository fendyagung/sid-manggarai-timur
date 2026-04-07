<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;

// Data resmi lengkap
$masterDesa = [
    'Borong' => ['Nanga Labang','Gurung Liwut','Benteng Riwu','Ngampang Mas','Rana Masak','Benteng Raja','Golo Lalong','Golo Kantar','Poco Rii','Balus Permai','Waling','Golo Leda','Compang Tenda','Bangka Kantar','Compang Ndejing'],
    'Lamba Leda Selatan' => ['Poco Lia','Pocong','Lenang','Melo','Leong','Bea Waek','Golo Lobos','Bangka Kuleng','Bangka Pau','Golo Nderu','Satar Tesem','Gurung Turi','Compang Laho','Watu Lanur','Golo Ndari','Compang Wesang','Golo Wune','Lento','Compang Weluk','Golo Rengket','Deno'],
    'Lamba Leda' => ['Tengku Leda','Tengku Lawar','Goreng Meni','Golo Munga','Golo Rentung','Golo Lembur','Compang Necak','Compang Mekar','Compang Deru','Golo Nimbung','Lamba Keli','Goreng Meni Utara','Golo Paleng'],
    'Sambi Rampas' => ['Nanga Mbaur','Nanga Mbaling','Lada Mese','Nampar Sepang','Kembang Mekar','Wela Lada'],
    'Elar' => ['Lengko Namut','Rana Kulan','Golo Munde','Golo Lebo','Golo Lijun','Sisir','Haju Ngendong','Legur Lai','Rana Gapang','Biting','Compang Soba','Compang Teo','Kaju Wangi','Wae Lokom'],
    'Kota Komba' => ['Lembur','Ruan','Mbengan','Rana Kolong','Gunung','Komba','Bamo','Pong Ruan'],
    'Rana Mese' => ['Bea Ngencung','Satar Lahing','Torok Golo','Golo Ros','Rondo Woing','Sano Lokom','Golo Loni','Sita','Golo Rutuk','Golo Meleng','Wae Nggori','Compang Kantar','Watu Mori','Bangka Kempo','Compang Teber','Satar Lenda','Lidi','Bangka Masa','Lalang','Compang Loni','Compang Kempo'],
    'Lamba Leda Timur' => ['Watu Arus','Arus','Golo Lero','Rengkam','Compang Wunis','Benteng Rampas','Ngkiong Dora','Ulu Wae','Rende Nao','Wangkar Weli','Tango Molas','Urung Dora','Compang Raci','Wejang Mawe','Bangka Arus','Colol','Benteng Wunis','Wejang Mali'],
    'Elar Selatan' => ['Sangan Kalo','Sipi','Gising','Langga Sai','Teno Mese','Golo Wuas','Nanga Meje','Paan Waru','Golo Linus','Benteng Pau','Wae Rasan','Mosi Ngaran','Nanga Puun'],
    'Kota Komba Utara' => ['Golo Tolang','Mokel','Paan Leleng','Rana Mbeling','Golo Meni','Golo Nderu','Golo Ndele','Rana Mbata','Mokel Morid','Watu Pari','Gunung Baru'],
    'Lamba Leda Utara' => ['Satar Padut','Satar Punda','Nampar Tabang','Lencur','Liang Deruk','Haju Wangi','Satar Kampas','Golo Mangung','Golo Wontong','Golo Munga Barat','Satar Punda Barat'],
    'Congkar' => ['Buti','Golo Ngawan','Satar Nawang','Rana Mese','Compang Congkar','Compang Lawi','Golo Pari','Wea'],
];

echo "=== PERBANDINGAN DETAIL DESA ===" . PHP_EOL . PHP_EOL;

$totalOk = 0;
$totalMissing = 0;
$totalExtra = 0;

foreach ($masterDesa as $kec => $daftarResmi) {
    $dbDesa = Desa::where('kecamatan', $kec)->where('jenis', 'desa')->pluck('nama_desa')->toArray();

    $missing = array_diff($daftarResmi, $dbDesa); // Ada di resmi, tidak ada di DB
    $extra   = array_diff($dbDesa, $daftarResmi);  // Ada di DB, tidak ada di resmi

    $status = (empty($missing) && empty($extra)) ? 'OK' : 'BEDA';
    echo "[$status] $kec" . PHP_EOL;

    if (!empty($missing)) {
        foreach ($missing as $m) {
            echo "  ❌ KURANG : $m" . PHP_EOL;
            $totalMissing++;
        }
    }
    if (!empty($extra)) {
        foreach ($extra as $e) {
            echo "  ⚠️  LEBIH  : $e" . PHP_EOL;
            $totalExtra++;
        }
    }
    if ($status === 'OK') $totalOk++;
}

$totalDesa = Desa::where('jenis','desa')->count();
$totalKel  = Desa::where('jenis','kelurahan')->count();

echo PHP_EOL . "=== RINGKASAN ===" . PHP_EOL;
echo "Kecamatan OK     : $totalOk / " . count($masterDesa) . PHP_EOL;
echo "Desa kurang      : $totalMissing" . PHP_EOL;
echo "Desa lebih       : $totalExtra" . PHP_EOL;
echo "Total DB         : $totalDesa Desa + $totalKel Kelurahan" . PHP_EOL;
echo PHP_EOL;
if ($totalMissing === 0 && $totalExtra === 0) {
    echo "✅ SEMUA DATA DESA SUDAH SESUAI DATA RESMI!" . PHP_EOL;
} else {
    echo "❌ Masih ada perbedaan!" . PHP_EOL;
}
