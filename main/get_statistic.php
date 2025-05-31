<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';

header('Content-Type: application/json');

try {
        $stmt = $pdo->prepare("SELECT
                            COUNT(*) AS total_vehicles,
                            SUM(aktif = 1) AS active_vehicles,
                            SUM(aktif = 0) AS inactive_vehicles
                        FROM araclar;
                        ");
        $stmt->execute();
        $models = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($models);

} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Veri çekilirken hata oluştu: ' . $e->getMessage()]);
}
?>
