<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;

$desas = Desa::orderBy('kecamatan')->orderBy('nama_desa')->get();
$handle = fopen('tmp/desa_list.csv', 'w');
fputcsv($handle, ['ID', 'Nama Desa', 'Kecamatan', 'Jenis', 'Kode Desa']);

foreach ($desas as $d) {
    fputcsv($handle, [$d->id, $d->nama_desa, $d->kecamatan, $d->jenis, $d->kode_desa]);
}
fclose($handle);
echo "Dumped " . $desas->count() . " records to tmp/desa_list.csv\n";
