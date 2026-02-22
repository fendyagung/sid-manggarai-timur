<?php
// Script to drop all tables and start fresh
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=simpro_desa', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected to database simpro_desa\n\n";

    // Disable foreign key checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");
    echo "Disabled foreign key checks\n";

    // Get all tables
    $result = $pdo->query("SHOW TABLES");
    $tables = $result->fetchAll(PDO::FETCH_COLUMN);

    echo "Found " . count($tables) . " tables\n";
    echo "Dropping all tables...\n\n";

    foreach ($tables as $table) {
        echo "  - Dropping table: $table\n";
        $pdo->exec("DROP TABLE IF EXISTS `$table`");
    }

    // Re-enable foreign key checks
    $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
    echo "\nRe-enabled foreign key checks\n";

    echo "\n✅ All tables dropped successfully!\n";
    echo "Now run: php artisan migrate --seed\n";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
