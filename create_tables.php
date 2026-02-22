<?php
// Direct SQL migration runner
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=simpro_desa', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected to database\n";

    // Create migrations table first
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS migrations (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255) NOT NULL,
            batch INT NOT NULL
        )
    ");
    echo "✓ Created migrations table\n";

    // Create users table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            phone VARCHAR(255) NULL,
            role ENUM('admin_dpmd', 'admin_desa') DEFAULT 'admin_desa',
            email_verified_at TIMESTAMP NULL,
            password VARCHAR(255) NOT NULL,
            remember_token VARCHAR(100) NULL,
            created_at TIMESTAMP NULL,
            updated_at TIMESTAMP NULL
        )
    ");
    echo "✓ Created users table\n";

    // Create password_reset_tokens table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS password_reset_tokens (
            email VARCHAR(255) PRIMARY KEY,
            token VARCHAR(255) NOT NULL,
            created_at TIMESTAMP NULL
        )
    ");
    echo "✓ Created password_reset_tokens table\n";

    // Create sessions table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS sessions (
            id VARCHAR(255) PRIMARY KEY,
            user_id BIGINT UNSIGNED NULL,
            ip_address VARCHAR(45) NULL,
            user_agent TEXT NULL,
            payload LONGTEXT NOT NULL,
            last_activity INT NOT NULL,
            INDEX sessions_user_id_index (user_id),
            INDEX sessions_last_activity_index (last_activity)
        )
    ");
    echo "✓ Created sessions table\n";

    // Create cache table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS cache (
            `key` VARCHAR(255) PRIMARY KEY,
            value MEDIUMTEXT NOT NULL,
            expiration INT NOT NULL
        )
    ");
    echo "✓ Created cache table\n";

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS cache_locks (
            `key` VARCHAR(255) PRIMARY KEY,
            owner VARCHAR(255) NOT NULL,
            expiration INT NOT NULL
        )
    ");
    echo "✓ Created cache_locks table\n";

    echo "\n✅ All basic tables created successfully!\n";
    echo "Now run: php artisan migrate\n";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}
