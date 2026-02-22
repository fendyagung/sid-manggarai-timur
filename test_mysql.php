<?php
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=simpro_desa', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);

    echo "Connected to database\n\n";

    // Check SQL modes
    $stmt = $pdo->query("SELECT @@sql_mode");
    $sqlMode = $stmt->fetchColumn();
    echo "Current SQL Mode:\n$sqlMode\n\n";

    // Check innodb settings
    $stmt = $pdo->query("SHOW VARIABLES LIKE 'innodb_file_per_table'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "innodb_file_per_table: " . $result['Value'] . "\n";

    $stmt = $pdo->query("SHOW VARIABLES LIKE 'innodb_strict_mode'");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "innodb_strict_mode: " . $result['Value'] . "\n\n";

    // Try to create a simple table
    echo "Testing table creation...\n";
    $pdo->exec("DROP TABLE IF EXISTS test_table");
    $pdo->exec("CREATE TABLE test_table (id INT PRIMARY KEY AUTO_INCREMENT, name VARCHAR(255))");
    echo "✓ Test table created successfully!\n";

    $pdo->exec("DROP TABLE test_table");
    echo "✓ Test table dropped successfully!\n\n";

    echo "✅ MySQL is working properly!\n";
    echo "The issue might be with Laravel's migration files.\n";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "Code: " . $e->getCode() . "\n";
}
