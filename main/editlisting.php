<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}


require_once 'db.php';

// 1. İlan ID'sini al
$id = $_GET['id'] ?? null;
if (!$id) {
    echo "Geçersiz ilan ID'si.";
    exit();
}

// 2. Mevcut ilanı veritabanından al
$stmt = $pdo->prepare("SELECT * FROM araclar WHERE id = ?");
$stmt->execute([$id]);
$ilan = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ilan) {
    echo "İlan bulunamadı.";
    exit();
}

// 3. Form gönderildiyse ilanı güncelle
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sql = "UPDATE araclar SET
        fiyat = ?, arac_markasi = ?, arac_modeli = ?, paket = ?, kilometre = ?, 
        arac_rengi = ?, yakit_turu = ?, vites_turu = ?, ilan_aciklamasi = ?, 
        ilanbaslik = ?, aracmodelyili = ?
        WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $_POST['fiyat'], $_POST['marka'], $_POST['model'], $_POST['paket'], $_POST['kilometre'],
        $_POST['arac_rengi'], $_POST['yakit_turu'], $_POST['vites_turu'], $_POST['ilan_aciklamasi'],
        $_POST['ilanbaslik'], $_POST['aracmodelyili'], $id
    ]);
    echo "<div class='alert alert-success text-center'>✅ İlan başarıyla güncellendi!</div>";
}
    
?>

<!DOCTYPE html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>Araç İlanı Güncelle</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Favicon-->
<link  rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Morris Chart Css-->
<link rel="stylesheet" href="assets/plugins/morrisjs/morris.css" />
<!-- Colorpicker Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
<!-- Multi Select Css -->
<link rel="stylesheet" href="assets/plugins/multi-select/css/multi-select.css">
<!-- Bootstrap Spinner Css -->
<link rel="stylesheet" href="assets/plugins/jquery-spinner/css/bootstrap-spinner.css">
<!-- Bootstrap Tagsinput Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css">
<!-- Bootstrap Select Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap-select/css/bootstrap-select.css" />
<!-- noUISlider Css -->
<link rel="stylesheet" href="assets/plugins/nouislider/nouislider.min.css" />
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/color_skins.css">
</head>
<body class="theme-black">

<!-- Left Sidebar -->
<aside id="minileftbar" class="minileftbar">
    <ul class="menu_list">
        <li><a href="javascript:void(0);" class="menu-sm"><i class="zmdi zmdi-swap"></i></a></li>        
        <li class="power">
            <a href="javascript:void(0);" class="js-right-sidebar"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a>            
            <a href="sign-in.html" class="mega-menu"><i class="zmdi zmdi-power"></i></a>
        </li>
    </ul>    
</aside>

<aside class="right_menu">
    <div id="rightsidebar" class="right-sidebar">
        <ul class="nav nav-tabs">
            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#setting">Setting</a></li>                
        </ul>
        <div class="tab-content slim_scroll">
            <div class="tab-pane slideRight active" id="setting">
                <div class="card">
                    <div class="header">
                        <h2><strong>Colors</strong> Skins</h2>
                    </div>
                    <div class="body">
                        <ul class="choose-skin list-unstyled m-b-0">
                            <li data-theme="black" class="active">
                                <div class="black"></div>
                            </li>
                            <li data-theme="purple">
                                <div class="purple"></div>
                            </li>                   
                            <li data-theme="blue">
                                <div class="blue"></div>
                            </li>
                            <li data-theme="cyan">
                                <div class="cyan"></div>                    
                            </li>
                            <li data-theme="green">
                                <div class="green"></div>
                            </li>
                            <li data-theme="orange">
                                <div class="orange"></div>
                            </li>
                            <li data-theme="blush">
                                <div class="blush"></div>                    
                            </li>
                        </ul>
                    </div>
                </div>                  
            </div>
        </div>
    </div>
    <div id="leftsidebar" class="sidebar">
        <div class="menu">
            <ul class="list">
                <li>
                    <div class="user-info m-b-20">
                        <div class="image">
                            <a href=""><img src="assets/images/profile_av.jpg" alt="User"></a>
                        </div>
                        <div class="detail">
                            <h6>ArslanhanGarage</h6>
                            <p class="m-b-0">mehmetarrslanhan@gmail.com</p>          
                            <a href="javascript:void(0);" title="" class=" waves-effect waves-block"><i class="zmdi zmdi-linkedin-box"></i></a>
                            <a href="javascript:void(0);" title="" class=" waves-effect waves-block"><i class="zmdi zmdi-instagram"></i></a>                 
                        </div>
                    </div>
                </li>
                <li class="header">Sayfalar</li>
                <li> <a href="index.php"><i class="zmdi zmdi-home"></i><span>Görünüm</span></a></li>   
                <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-swap-alt"></i><span>Araçlar</span></a>
                    <ul class="ml-menu">
                        <li><a href="ilanlar.php?aktif=1">Aktif İlandaki Araçlar</a></li>                    
                        <li><a href="ilanlar.php?aktif=0">Pasife Alınan Araçlar</a></li>    
                        <li><a href="addlisting.php">İlana Araç Koy</a></li>                                    
                    </ul>
                        <li class=""> 
                            <a href="..\index.html"><i class="zmdi zmdi-home"></i><span>Siteye Git</span></a>
                        </li>                
                </li>                 
                    </ul>
        </div>
    </div>
</aside>

<section class="content">   
    <div class="container-fluid">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>Yönetici Paneli</h2>
                    <ul class="breadcrumb padding-0">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i></a></li>
                        <li class="breadcrumb-item active">İlan Güncelle</li>
                    </ul>
                </div>
            </div>
        </div>
      
        <!-- Advanced Select -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="header">
                        <h2><strong>İlan Bilgilerini Gir</strong></h2>
                    </div>
                    <div class="body">

<div class="container mt-5">
    <h2><strong>İlan Güncelleyin</strong></h2>
    <form method="POST">
        <div class="form-group">
            <label><strong>İlan Başlığı</strong></label>
            <input type="text" name="ilanbaslik" class="form-control" value="<?= htmlspecialchars($ilan['ilanbaslik']) ?>" required>
        </div>
        <div class="form-group">
            <label><strong>Marka</strong></label>
            <select name="marka" id="marka" class="form-control" required></select>
        </div>
        <div class="form-group">
            <label><strong>Model</strong></label>
            <select name="model" id="model" class="form-control" required></select>
        </div>
        <div class="form-group">
            <label><strong>Paket</strong></label>
            <input type="text" name="paket" class="form-control" value="<?= htmlspecialchars($ilan['paket']) ?>">
        </div>
        <div class="form-group">
            <label><strong>Model Yılı</strong></label>
            <input type="text" name="aracmodelyili" class="form-control" value="<?= htmlspecialchars($ilan['aracmodelyili']) ?>">
        </div>
        <div class="form-group">
            <label><strong>Kilometre</strong></label>
            <input type="text" name="kilometre" class="form-control" value="<?= htmlspecialchars($ilan['kilometre']) ?>">
        </div>
        <div class="form-group">
            <label><strong>Renk</strong></label>
            <input type="text" name="arac_rengi" class="form-control" value="<?= htmlspecialchars($ilan['arac_rengi']) ?>">
        </div>
        <div class="form-group">
            <label><strong>Yakıt Türü</strong></label>
            <select name="yakit_turu" class="form-control">
                <option value="Benzin" <?= $ilan['yakit_turu'] === 'Benzin' ? 'selected' : '' ?>>Benzin</option>
                <option value="Dizel" <?= $ilan['yakit_turu'] === 'Dizel' ? 'selected' : '' ?>>Dizel</option>
                <option value="Elektrik" <?= $ilan['yakit_turu'] === 'Elektrik' ? 'selected' : '' ?>>Elektrik</option>
                <option value="Hybrid" <?= $ilan['yakit_turu'] === 'Hybrid' ? 'selected' : '' ?>>Hybrid</option>
            </select>
        </div>
        <div class="form-group">
            <label><strong>Vites Türü</strong></label>
            <select name="vites_turu" class="form-control">
                <option value="Manuel" <?= $ilan['vites_turu'] === 'Manuel' ? 'selected' : '' ?>>Manuel</option>
                <option value="Otomatik" <?= $ilan['vites_turu'] === 'Otomatik' ? 'selected' : '' ?>>Otomatik</option>
            </select>
        </div>
        <div class="form-group">
            <label><strong>Fiyat</strong></label>
            <input type="text" name="fiyat" class="form-control" value="<?= htmlspecialchars($ilan['fiyat']) ?>">
        </div>
        <div class="form-group">
            <label><strong>Açıklama</strong></label>
            <textarea name="ilan_aciklamasi" class="form-control"><?= htmlspecialchars($ilan['ilan_aciklamasi']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Güncelle</button>
    </form>
</div>

<script>
    const markaSelect = document.getElementById('marka');
    const modelSelect = document.getElementById('model');
    const seciliMarkaId = "<?= $ilan['arac_markasi'] ?>";
    const seciliModelId = "<?= $ilan['arac_modeli'] ?>";

    // Markaları yükle
    fetch('get_brands.php?type=brand')
        .then(res => res.json())
        .then(data => {
            markaSelect.innerHTML = '<option value="">Marka Seçin</option>';
            data.forEach(brand => {
                const option = document.createElement('option');
                option.value = brand.id;
                option.textContent = brand.name;
                if (brand.id == seciliMarkaId) {
                    option.selected = true;
                }
                markaSelect.appendChild(option);
            });

            // Seçili markanın modellerini getir
            if (seciliMarkaId) {
                fetch(`get_brands.php?type=model&brand_id=${seciliMarkaId}`)
                    .then(res => res.json())
                    .then(models => {
                        modelSelect.disabled = false;
                        modelSelect.innerHTML = '<option value="">Model Seçin</option>';
                        models.forEach(model => {
                            const option = document.createElement('option');
                            option.value = model.id;
                            option.textContent = model.name;
                            if (model.id == seciliModelId) {
                                option.selected = true;
                            }
                            modelSelect.appendChild(option);
                        });
                    });
            }
        });

    // Marka değişince modelleri tekrar yükle
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
                modelSelect.innerHTML = '<option value="">Model Seçin</option>';
                data.forEach(model => {
                    const option = document.createElement('option');
                    option.value = model.id;
                    option.textContent = model.name;
                    modelSelect.appendChild(option);
                });
            })
            .catch(() => {
                modelSelect.innerHTML = '<option value="">Hata oluştu</option>';
                modelSelect.disabled = true;
            });
    });

    
</script>
</body>
</html>
