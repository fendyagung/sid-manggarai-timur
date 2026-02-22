<?php
echo "Attempting to force drop database...\n\n";

try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Step 1: Connected to MySQL\n";

    // Try to drop database with CASCADE
    echo "Step 2: Attempting to drop simpro_desa...\n";
    try {
        $pdo->exec("DROP DATABASE IF EXISTS simpro_desa");
        echo "✓ Database simpro_desa dropped successfully!\n";
    } catch (PDOException $e) {
        echo "⚠ Warning: " . $e->getMessage() . "\n";
        echo "Trying alternative method...\n";

        // Alternative: try to use the database first then drop
        try {
            $pdo->exec("USE simpro_desa");
            $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

            echo "Found " . count($tables) . " tables, dropping them first...\n";
            $pdo->exec("SET FOREIGN_KEY_CHECKS = 0");

            foreach ($tables as $table) {
                echo "  Dropping table: $table\n";
                $pdo->exec("DROP TABLE IF EXISTS `$table`");
            }

            $pdo->exec("SET FOREIGN_KEY_CHECKS = 1");
            echo "All tables dropped\n";

            // Now try to drop database again
            $pdo->exec("DROP DATABASE simpro_desa");
            echo "✓ Database dropped after clearing tables!\n";

        } catch (PDOException $e2) {
            echo "❌ Still failed: " . $e2->getMessage() . "\n";
            echo "\nPlease restart MySQL service in XAMPP and try again.\n";
            exit(1);
        }
    }

    echo "\nStep 3: Creating fresh database...\n";
    $pdo->exec("CREATE DATABASE simpro_desa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✓ Database simpro_desa created successfully!\n";

    echo "\n✅ SUCCESS! Database is ready.\n";
    echo "Next step: Run 'php artisan migrate'\n";

} catch (PDOException $e) {
    echo "❌ Fatal Error: " . $e->getMessage() . "\n";
    exit(1);
}
