<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
<title>ArslanhanGarage - Admin Panel</title>
<link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/plugins/morrisjs/morris.css" />
<link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css"/>
<!-- Custom Css -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/color_skins.css">
</head>
<body class="theme-black">
<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="assets/images/logo.svg" width="48" height="48" alt="Alpino"></div>
        <p>Please wait...</p>        
    </div>
</div>
<!-- Overlay For Sidebars -->



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
                <div class="card">
                    <div class="header">
                        <h2><strong>Left</strong> Menu</h2>
                    </div>
                    <div class="body theme-light-dark">
                        <button class="t-dark btn btn-primary btn-round btn-block">Dark</button>
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
                <li class="active open"><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-swap-alt"></i><span>Araçlar</span></a>
                    <ul class="ml-menu">
                        <li><a href="ilanlar.php?aktif=1">Aktif İlandaki Araçlar</a></li>                    
                        <li><a href="ilanlar.php?aktif=0">Pasife Alınan Araçlar</a></li>    
                        <li><a href="addlisting.php">İlana Araç Koy</a></li>                                    
                    </ul>
                    <li class=""> <a href="../index.html"><i class="zmdi zmdi-home"></i><span>Siteye Git</span></a></li> 
                </li>            
            </ul>
        </div>
    </div>
</aside>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <div class="row clearfix">
                <div class="col-lg-5 col-md-5 col-sm-12">
                    <h2>Yönetici Paneli</h2>
                    <ul class="breadcrumb padding-0">
                        <li class="breadcrumb-item"><a href="index.html"><i class="zmdi zmdi-home"></i></a></li>
                        <li class="breadcrumb-item active">İlana Araç Ekleme</li>
                    </ul>
                </div>            
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Marka</th>
                        <th>Model</th>
                        <th>Fiyat</th>
                        <th>İlana Ekleme Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody id="ilanListesi"></tbody>
            </table>
        </div>
        
    </div>
</section>



    <!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->
<script src="assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob-->
<script src="assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
<script src="assets/bundles/morrisscripts.bundle.js"></script> <!-- Morris Plugin Js --> 
<script src="assets/bundles/sparkline.bundle.js"></script> <!-- sparkline Plugin Js --> 
<script src="assets/bundles/doughnut.bundle.js"></script>

<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="assets/js/pages/index.js"></script>

 <script>
document.addEventListener('DOMContentLoaded', function () {

    // URL'den brand_id parametresini al
    const urlParams = new URLSearchParams(window.location.search);
    const aktif = urlParams.get('aktif');

    // Eğer brand_id varsa, onu URL'ye ekle
    const fetchUrl = aktif ? `../get_ads.php?aktif=${aktif}` : '../get_ads.php';

    fetch(fetchUrl)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('ilanListesi');
            container.innerHTML = ''; // Önceki içeriği temizle

            if (!data.length) {
                container.innerHTML = '<p>Hiç ilan bulunamadı.</p>';
                return;
            }

            data.forEach(ad => {
                const ilanHTML = `
                    <tr>
                        <td>${ad.id}</td>
                        <td>${ad.arac_markasi}</td>
                        <td>${ad.arac_modeli}</td>
                        <td>${ad.fiyat}</td>
                        <td>${new Date(ad.kayit_tarihi).toLocaleDateString('tr-TR')}</td>
                        <td>
                            <a href="editlisting.php?id=${ad.id}" class="btn btn-sm btn-primary">Düzenle</a>
                            <button class="btn btn-sm btn-primary toggle-aktif" data-id="${ad.id}" data-aktif="${ad.aktif}">
                                ${ad.aktif == 1 ? 'Pasife Al' : 'Aktif Et'}
                            </button>
                            <button class="btn btn-sm btn-danger delete-ad" data-id="${ad.id}">Sil</button>                          
                        </td>
                    </tr>
                `;
                container.insertAdjacentHTML('beforeend', ilanHTML);
            });
        })
        .catch(error => {
            console.error("İlanlar alınamadı:", error);
        });
});

document.addEventListener('click', function (e) {
    // Aktiflik değiştirme
    if (e.target && e.target.classList.contains('toggle-aktif')) {
        const button = e.target;
        const id = button.getAttribute('data-id');
        const aktif = parseInt(button.getAttribute('data-aktif'));
        const yeniDurum = aktif === 1 ? 0 : 1;

        fetch('transactions.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `id=${id}&aktif=${yeniDurum}`
        })
        .then(res => res.json())
        .then(data => {
            alert(data.message);
            location.reload();
        })
        .catch(err => console.error('Hata:', err));
    }

    // Silme işlemi
    if (e.target && e.target.classList.contains('delete-ad')) {
        const id = e.target.getAttribute('data-id');
        if (confirm('Bu ilanı silmek istediğinize emin misiniz?')) {
            fetch('transactions.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `id=${id}&sil=1`
            })
            .then(res => res.json())
            .then(data => {
                alert(data.message);
                location.reload();
            })
            .catch(err => console.error('Silme hatası:', err));
        }
    }
});



</script>

</body>
</html>