<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Dropping existing database...\n";
    $pdo->exec("DROP DATABASE IF EXISTS simpro_desa");
    echo "✓ Database dropped\n";

    echo "Creating fresh database...\n";
    $pdo->exec("CREATE DATABASE simpro_desa CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "✓ Database created\n";

    echo "\n✅ Database recreated successfully!\n";
    echo "Now run: php artisan migrate\n";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
