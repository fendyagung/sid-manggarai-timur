<?php
// Script to fix migrations table and run migrations
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=simpro_desa', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected to database simpro_desa\n\n";

    // Drop and recreate migrations table
    echo "Dropping migrations table if exists...\n";
    $pdo->exec("DROP TABLE IF EXISTS migrations");

    echo "Creating migrations table...\n";
    $sql = "CREATE TABLE `migrations` (
        `id` int unsigned NOT NULL AUTO_INCREMENT,
        `migration` varchar(255) NOT NULL,
        `batch` int NOT NULL,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    $pdo->exec($sql);
    echo "✅ Created migrations table\n\n";

    echo "✅ Database is ready for migrations!\n";
    echo "Now run: php artisan migrate\n";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
