<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';

$type = $_GET['type'] ?? null; // 'brand' veya 'model'
$brandId = $_GET['brand_id'] ?? null;

header('Content-Type: application/json');

try {
    if ($type === 'brand') {
        // Marka listesi
        $stmt = $pdo->query("SELECT id, name FROM car_brands");
        $brands = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($brands);

    } elseif ($type === 'model' && $brandId !== null) {
        // Belirli markaya ait modeller
        $stmt = $pdo->prepare("SELECT id, name FROM car_models WHERE brand_id = ?");
        $stmt->execute([$brandId]);
        $models = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($models);

    } else {
        // Geçersiz istek
        http_response_code(400);
        echo json_encode(['error' => 'Geçersiz parametre']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Veri çekilirken hata oluştu: ' . $e->getMessage()]);
}
?>
