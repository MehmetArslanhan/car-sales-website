<?php
require_once 'db.php';


$brandId = $_GET['brand_id'] ?? null;
$aktif = $_GET['aktif'] ?? null;

header('Content-Type: application/json');

try {
    if ($brandId != null) {
        // Belirli markaya ait modeller
        $stmt = $pdo->prepare("SELECT 
                                    id,
                                    fiyat,
                                    (SELECT name FROM car_brands WHERE id = arac_markasi LIMIT 1) AS arac_markasi,
                                    (SELECT name FROM car_models WHERE id = arac_modeli LIMIT 1) AS arac_modeli,
                                    paket,
                                    kilometre,
                                    arac_rengi,
                                    yakit_turu,
                                    vites_turu,
                                    resim_yolu,
                                    ilan_aciklamasi,
                                    kayit_tarihi,
                                    ilanbaslik,
                                    aracmodelyili,
                                    aktif  
                                    FROM araclar WHERE arac_markasi = ? AND aktif = 1");
        $stmt->execute([$brandId]);
        $models = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($models);

    }
    else if ($brandId == null && $aktif != null) {
        // Belirli markaya ait modeller
        $stmt = $pdo->prepare("SELECT 
                                    id,
                                    fiyat,
                                    (SELECT name FROM car_brands WHERE id = arac_markasi LIMIT 1) AS arac_markasi,
                                    (SELECT name FROM car_models WHERE id = arac_modeli LIMIT 1) AS arac_modeli,
                                    paket,
                                    kilometre,
                                    arac_rengi,
                                    yakit_turu,
                                    vites_turu,
                                    resim_yolu,
                                    ilan_aciklamasi,
                                    kayit_tarihi,
                                    ilanbaslik,
                                    aracmodelyili,
                                    aktif 
                                    FROM araclar WHERE aktif = ?");
        $stmt->execute([$aktif]);
        $models = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($models);

    }else {
        // Tüm ilanlar
        $stmt = $pdo->prepare("SELECT 
                                    id,
                                    fiyat,
                                    (SELECT name FROM car_brands WHERE id = arac_markasi LIMIT 1) AS arac_markasi,
                                    (SELECT name FROM car_models WHERE id = arac_modeli LIMIT 1) AS arac_modeli,
                                    paket,
                                    kilometre,
                                    arac_rengi,
                                    yakit_turu,
                                    vites_turu,
                                    resim_yolu,
                                    ilan_aciklamasi,
                                    kayit_tarihi,
                                    ilanbaslik,
                                    aracmodelyili,
                                    aktif  
                                    FROM araclar WHERE aktif = 1");
        $stmt->execute();
        $models = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($models);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Veri çekilirken hata oluştu: ' . $e->getMessage()]);
}
?>
