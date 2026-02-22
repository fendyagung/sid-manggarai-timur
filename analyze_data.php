<?php

use App\Models\Desa;

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// List of Kelurahan names from the images
$targetKelurahan = [
    'Lempang Paji',
    'Mandosawu',
    'Nggalak Leleng',
    'Satar Peot',
    'Bangka Leleng',
    'Golo Wangkung', // Need to be careful with exact matching
    'Golo Wangkung Barat',
    'Golo Wangkung Utara',
    'Nanga Baras',
    'Pota',
    'Ulung Baras',
    'Tiwu Kondo',
    'Rongga Koe',
    'Tanah Rata',
    'Watu Nggene'
];

$output = "--- Analyzing Target Kelurahan ---\n";
foreach ($targetKelurahan as $name) {
    // Search with like to handle "Desa ..." prefix or slight variations
    $results = Desa::where('nama_desa', 'LIKE', '%' . $name . '%')->get();

    if ($results->isEmpty()) {
        $output .= "[MISSING] $name\n";
    } else {
        foreach ($results as $res) {
            $output .= "[FOUND] {$res->nama_desa} | Jenis: {$res->jenis} | Kec: {$res->kecamatan} | ID: {$res->id}\n";
        }
    }
}

$output .= "\n--- Analyzing Incorrect Kelurahan Candidates ---\n";
// These are the ones we found earlier that look like Desa but are marked as Kelurahan
$incorrectCandidates = [
    'Wangkung Weli',
    'Watu Arus',
    'Wejang Mali',
    'Wejang Mawe',
    'Benteng Pau',
    'Gising',
    'Golo Linus',
    'Golo Wuas',
    'Langga Sai',
    'Mosi Ngaran',
    'Nanga Meje',
    'Nanga Puun',
    'Paan Waru',
    'Sangan Kalo',
    'Sipi',
    'Teno Mese',
    'Wae Rasan'
];

foreach ($incorrectCandidates as $name) {
    $results = Desa::where('nama_desa', 'LIKE', '%' . $name . '%')
        ->where('jenis', 'kelurahan')
        ->get();
    foreach ($results as $res) {
        $output .= "[INCORRECT_KELURAHAN] {$res->nama_desa} | ID: {$res->id}\n";
    }
}

file_put_contents('analyze_data_output.txt', $output);
echo "Analysis saved to analyze_data_output.txt";
