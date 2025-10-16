<?php
$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=hotel','root','', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
$stmt = $pdo->prepare('SELECT COUNT(*) as c FROM migrations WHERE migration = ?');
$stmt->execute(['2025_10_15_000201_create_bookings_and_guests_tables']);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row['c'] == 0) {
    $stmt = $pdo->prepare('INSERT INTO migrations (migration,batch) VALUES (?,?)');
    $stmt->execute(['2025_10_15_000201_create_bookings_and_guests_tables', 5]);
    echo "Inserted bookings+guests migration record\n";
} else {
    echo "Record already present (count={$row['c']})\n";
}
