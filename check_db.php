<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    echo "MySQL Connection: OK\n";

    $stmt = $pdo->query("SHOW DATABASES LIKE 'simpro_desa'");
    $result = $stmt->fetch();

    if ($result) {
        echo "Database 'simpro_desa' exists\n";

        // Check tables
        $pdo->exec("USE simpro_desa");
        $tables = $pdo->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);
        echo "Tables found: " . count($tables) . "\n";
        if (count($tables) > 0) {
            echo "Tables: " . implode(", ", $tables) . "\n";
        }
    } else {
        echo "Database 'simpro_desa' NOT FOUND\n";
        echo "Creating database...\n";
        $pdo->exec("CREATE DATABASE simpro_desa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "Database created successfully!\n";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
