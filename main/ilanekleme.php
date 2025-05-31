<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';


// Form gönderildiyse
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $arac_markasi = $_POST["marka"] ?? '';
    $arac_modeli = $_POST["model"] ?? '';
    $paket = $_POST["paket"] ?? '';
    $kilometre = $_POST["kilometre"] ?? '';
    $arac_rengi = $_POST["arac_rengi"] ?? '';
    $yakit_turu = $_POST["yakit_turu"] ?? '';
    $vites_turu = $_POST["vites_turu"] ?? '';
    $ilan_aciklamasi = $_POST["ilan_aciklamasi"] ?? '';
    $kayit_tarihi = date("Y-m-d");
    $fiyat = $_POST["fiyat"] ?? '';

    // Resim yükleme işlemi
    $resim_yolu = "";
    if (isset($_FILES["resim"]) && $_FILES["resim"]["error"] === 0) {
        $hedef_klasor = "uploads/";
        $dosya_adi = basename($_FILES["resim"]["name"]);
        $dosya_uzantisi = strtolower(pathinfo($dosya_adi, PATHINFO_EXTENSION));
        $izinli_uzantilar = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($dosya_uzantisi, $izinli_uzantilar)) {
            if (!is_dir($hedef_klasor)) {
                mkdir($hedef_klasor, 0777, true);
            }

            $yeni_dosya_adi = uniqid("resim_", true) . "." . $dosya_uzantisi;
            $hedef_yol = $hedef_klasor . $yeni_dosya_adi;

            if (move_uploaded_file($_FILES["resim"]["tmp_name"], $hedef_yol)) {
                $resim_yolu = $hedef_yol;
            } else {
                echo "<div class='alert alert-danger text-center'>Resim yüklenemedi.</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>Geçersiz resim formatı. (Sadece jpg, jpeg, png, gif, webp)</div>";
        }
    }

    // Veritabanına kayıt
    $sql = "INSERT INTO araclar 
        (fiyat,arac_markasi, arac_modeli, paket, kilometre, arac_rengi, yakit_turu, vites_turu, resim_yolu, ilan_aciklamasi, kayit_tarihi)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $fiyat, $arac_markasi, $arac_modeli, $paket, $kilometre, $arac_rengi, 
        $yakit_turu, $vites_turu, $resim_yolu, $ilan_aciklamasi, $kayit_tarihi 
    ]);

    echo "<div class='alert alert-success text-center'>✅ İlan başarıyla eklendi!</div>";
}
?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Araç İlanı Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/ads.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Araç İlanı Ekle</h2>
    <form method="post" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
        <div class="row mb-3">
            <div class="col">
                <label>Marka</label>
                <select name="marka" id="marka" class="form-select">
                    <option value="">Yükleniyor...</option>
                </select>
            </div>
            <div class="col">
                <label>Model</label>
                <select name="model" id="model" class="form-select">
                    <option value="">Önce bir marka seçin</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label>Paket</label>
            <input type="text" name="paket" class="form-control">
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Kilometre</label>
                <input type="number" name="kilometre" class="form-control" required>
            </div>
            <div class="col">
                <label>Renk</label>
                <select name="arac_rengi" class="form-select">
                    <option value="">Renk Seçin</option>
                    <option value="Beyaz">Beyaz</option>
                    <option value="Siyah">Siyah</option>
                    <option value="Gri">Gri</option>
                    <option value="Kırmızı">Kırmızı</option>
                    <option value="Mavi">Mavi</option>
                    <option value="Lacivert">Lacivert</option>
                    <option value="Yeşil">Yeşil</option>
                    <option value="Sarı">Sarı</option>
                    <option value="Turuncu">Turuncu</option>
                    <option value="Bej">Bej</option>
                    <option value="Kahverengi">Kahverengi</option>
                    <option value="Mor">Mor</option>
                    <option value="Altın">Altın</option>
                    <option value="Gümüş">Gümüş</option>
                </select>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Yakıt Türü</label>
                <select name="yakit_turu" class="form-select">
                    <option value="Benzin">Benzin</option>
                    <option value="Dizel">Dizel</option>
                    <option value="Elektrik">Elektrik</option>
                    <option value="Benzin & LPG">Benzin & LPG</option>
                </select>
            </div>
            <div class="col">
                <label>Vites Türü</label>
                <select name="vites_turu" class="form-select">
                    <option value="Manuel">Manuel</option>
                    <option value="Otomatik">Otomatik</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label>Resim Yükle</label>
            <input type="file" name="resim" class="form-control" accept="image/*">
        </div>
        <div class="mb-3">
            <label>İlan Açıklaması</label>
            <textarea name="ilan_aciklamasi" class="form-control" rows="4"></textarea>
        </div>
        <div class="mb-3">
            <label>Fiyat</label>
            <input type="number" name="fiyat" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">İlanı Ekle</button>
        <a href="ilanlar.php?aktif=1" class="btn btn-secondary ms-2">İlanlar</a>
    </form>
</div>

 <script>
    const markaSelect = document.getElementById('marka');
    const modelSelect = document.getElementById('model');

    // Markaları yükle
    fetch('get_brands.php?type=brand')
      .then(res => res.json())
      .then(data => {
        markaSelect.innerHTML = '<option value="">Marka Seçin</option>';
        data.forEach(brand => {
          const option = document.createElement('option');
          option.value = brand.id;
          option.textContent = brand.name;
          markaSelect.appendChild(option);
        });
      });

    // Marka seçilince modelleri yükle
    markaSelect.addEventListener('change', function () {
      const brandId = this.value;
      modelSelect.innerHTML = '';

      if (!brandId) {
        modelSelect.disabled = true;
        modelSelect.innerHTML = '<option value="">Önce bir marka seçin</option>';
        return;
      }

      fetch(`get_brands.php?type=model&brand_id=${brandId}`)
        .then(res => res.json())
        .then(data => {
          modelSelect.disabled = false;
          if (data.length === 0) {
            modelSelect.innerHTML = '<option value="">Model bulunamadı</option>';
          } else {
            modelSelect.innerHTML = '<option value="">Model Seçin</option>';
            data.forEach(model => {
              const option = document.createElement('option');
              option.value = model.id;
              option.textContent = model.name;
              modelSelect.appendChild(option);
            });
          }
        })
        .catch(() => {
          modelSelect.innerHTML = '<option value="">Hata oluştu</option>';
          modelSelect.disabled = true;
        });
    });
  </script>

</body>
</html>