<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Desa;
use Illuminate\Support\Facades\DB;

try {
    DB::beginTransaction();

    $correctId = 17;
    $errorId = 178;

    $errorDesa = Desa::find($errorId);
    $correctDesa = Desa::find($correctId);

    if (!$errorDesa || !$correctDesa) {
        throw new Exception("Records not found. Error ID: $errorId, Correct ID: $correctId");
    }

    echo "Moving user {$errorDesa->user_id} from ID $errorId to ID $correctId...\n";

    // Transfer user
    $correctDesa->user_id = $errorDesa->user_id;
    $correctDesa->save();

    // Delete duplicate
    echo "Deleting duplicate record ID $errorId...\n";
    $errorDesa->delete();

    DB::commit();
    echo "Successfully consolidated Desa Ngampang Mas.\n";
} catch (Exception $e) {
    DB::rollBack();
    echo "ERROR: " . $e->getMessage() . "\n";
}
