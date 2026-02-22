<?php
// Script to create default DPMD profile
try {
    $pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=simpro_desa', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connected to database simpro_desa\n\n";

    // Check if dpmd_profiles table exists
    $result = $pdo->query("SHOW TABLES LIKE 'dpmd_profiles'");
    if ($result->rowCount() == 0) {
        echo "❌ Table dpmd_profiles does not exist!\n";
        echo "Please run: php artisan migrate\n";
        exit(1);
    }

    // Check if profile already exists
    $result = $pdo->query("SELECT COUNT(*) as count FROM dpmd_profiles");
    $row = $result->fetch(PDO::FETCH_ASSOC);

    if ($row['count'] > 0) {
        echo "✅ DPMD Profile already exists!\n";
        echo "Profile count: " . $row['count'] . "\n";
    } else {
        // Insert default profile
        $sql = "INSERT INTO dpmd_profiles (
            nama_kadis, 
            visi, 
            misi,
            sambutan_judul,
            sambutan_teks,
            created_at,
            updated_at
        ) VALUES (
            'Kepala Dinas PMD Manggarai Timur',
            'Terwujudnya Desa yang Mandiri dan Sejahtera',
            'Meningkatkan kualitas SDM desa\nMemperkuat tata kelola pemerintahan desa\nMendorong ekonomi desa yang berkelanjutan',
            'Membangun Desa, Sejahterakan Rakyat',
            'Selamat datang di Portal SIMPRO DESA Kabupaten Manggarai Timur. Kami berkomitmen untuk terus mendorong transparansi dan inovasi di setiap desa di Kabupaten Manggarai Timur.',
            NOW(),
            NOW()
        )";

        $pdo->exec($sql);
        echo "✅ Created default DPMD profile!\n";
    }

    echo "\n✅ Database is ready!\n";
    echo "You can now access: http://localhost:8000/profil\n";

} catch (PDOException $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
