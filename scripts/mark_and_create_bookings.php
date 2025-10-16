<?php
$host = '127.0.0.1';
$port = 3306;
$db = 'hotel';
$user = 'root';
$pass = '';
try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$db", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    // Insert migration record
    $stmt = $pdo->prepare('INSERT INTO migrations (migration,batch) VALUES (?,?)');
    $stmt->execute(['2025_10_15_000201_create_bookings_and_guests_tables', 4]);
    echo "Inserted migration record for bookings+guests\n";

    // Create bookings table if not exists
    $sql = "CREATE TABLE IF NOT EXISTS bookings (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        guest_id BIGINT UNSIGNED NOT NULL,
        room_id BIGINT UNSIGNED NOT NULL,
        check_in_date DATE NOT NULL,
        check_out_date DATE NOT NULL,
        total_price DECIMAL(10,2) NOT NULL DEFAULT 0,
        status ENUM('pending','confirmed','check_in','check_out','cancelled') NOT NULL DEFAULT 'pending',
        created_at TIMESTAMP NULL,
        updated_at TIMESTAMP NULL,
        FOREIGN KEY (guest_id) REFERENCES guests(id) ON DELETE CASCADE,
        FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

    $pdo->exec($sql);
    echo "Created bookings table (if not existed)\n";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
    exit(1);
}
