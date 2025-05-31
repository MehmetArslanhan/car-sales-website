
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
    $ilanbaslik = $_POST["ilanbaslik"] ?? '';
    $aracmodelyili = $_POST["aracmodelyili"] ?? '';

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
        (fiyat,arac_markasi, arac_modeli, paket, kilometre, arac_rengi, yakit_turu, vites_turu, resim_yolu, ilan_aciklamasi, kayit_tarihi, ilanbaslik, aracmodelyili)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $fiyat, $arac_markasi, $arac_modeli, $paket, $kilometre, $arac_rengi, 
        $yakit_turu, $vites_turu, $resim_yolu, $ilan_aciklamasi, $kayit_tarihi , $ilanbaslik , $aracmodelyili,
    ]);

    echo "<div class='alert alert-success text-center'>✅ İlan başarıyla eklendi!</div>";
}

?>
<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>Araç İlanı Ekle</title>
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
                            <a href="profile.html"><img src="assets/images/profile_av.jpg" alt="User"></a>
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
                        <li class="breadcrumb-item active">İlana Araç Ekle</li>
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


        <form method="post" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col">
                <label>Marka</label>
                <select name="marka" id="marka" class="form-control">
                    <option value="">Yükleniyor...</option>
                </select>
            </div>
            <div class="col">
                <label>Model</label>
                <select name="model" id="model" class="form-control">
                    <option value="">Önce bir marka seçin</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label>Paket</label>
            <input type="text" name="paket" class="form-control">
        </div>
        <div class="mb-3">
            <label>Fiyat</label>
            <input type="number" name="fiyat" class="form-control">
        </div>
        <div class="mb-3">
            <label>İlan Başlığı</label>
            <input type="text" name="ilanbaslik" class="form-control">
        </div>
        <div class="mb-3">
            <label>Araç Model Yılı</label>
            <input type="number" name="aracmodelyili" class="form-control">
        </div>
        <div class="row mb-3">
            <div class="col">
                <label>Kilometre</label>
                <input type="number" name="kilometre" class="form-control" required>
            </div>
            <div class="col">
                <label>Renk</label>
                <select name="arac_rengi" class="form-control">
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
                <select name="yakit_turu" class="form-control">
                    <option value="Benzin">Benzin</option>
                    <option value="Dizel">Dizel</option>
                    <option value="Elektrik">Elektrik</option>
                    <option value="Benzin & LPG">Benzin & LPG</option>
                </select>
            </div>
            <div class="col">
                <label>Vites Türü</label>
                <select name="vites_turu" class="form-control">
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
        <button type="submit" class="btn btn-primary">İlanı Ekle</button>
        <a href="ilanlar.php?aktif=1" class="btn btn-secondary ms-2">İlanlar</a>
    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Jquery Core Js --> 
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