<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';

// ID'yi al
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

// Hatalı ID kontrolü
if ($id <= 0) {
    echo json_encode([
        'success' => false,
        'message' => 'Geçersiz ID'
    ]);
    exit;
}

// Aktiflik güncelleme isteği mi, silme isteği mi kontrol et
if (isset($_POST['aktif'])) {
    $aktif = intval($_POST['aktif']);
    $stmt = $pdo->prepare("UPDATE araclar SET aktif = :aktif WHERE id = :id");
    $stmt->bindParam(':aktif', $aktif, PDO::PARAM_INT);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $success = $stmt->execute();

    echo json_encode([
        'success' => $success,
        'message' => $success ? 'Durum güncellendi.' : 'Güncelleme başarısız.'
    ]);
} elseif (isset($_POST['sil']) && $_POST['sil'] === "1") {
    $stmt = $pdo->prepare("DELETE FROM araclar WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $success = $stmt->execute();

    echo json_encode([
        'success' => $success,
        'message' => $success ? 'İlan başarıyla silindi.' : 'Silme işlemi başarısız.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Geçersiz istek.'
    ]);
}
?>
