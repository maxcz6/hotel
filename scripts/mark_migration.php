<?php
$host = '127.0.0.1';
$port = 3306;
$db = 'hotel';
$user = 'root';
$pass = '';
try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $stmt = $pdo->prepare('INSERT INTO migrations (migration,batch) VALUES (?,?)');
    $stmt->execute(['2025_10_15_000003_create_reservations_table', 3]);
    echo "Inserted migration record\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
