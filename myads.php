<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ARSLANGAN GARAGE - İkinci El Araba İlanı</title>

    <link rel="stylesheet" href="css\ads.css"> 
    <style>

        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            background-image: url("images/bg.png"); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: Arial, sans-serif;
        }

        .container {
            flex: 1;
            background-color: rgba(255, 255, 255, 0.85); /* içerik kutusunu okunur hale getir */
            padding: 20px;
        }

        footer {
            background-color: #2b2b2b;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
    </style>
</head>
<body>
        <header>
            <nav>
                <div class="logo">ArslanhanGarage</div>
                <ul>
                    <li><a href="about.html">Hakkımızda</a></li>
                    <li><a href="contact.html">İletişim</a></li>
                    <li><a href="index.html">Anasayfa</a></li>  
                </ul>
            </nav>
        </header>

<div id="ilanListesi" class="container"></div>


    <footer>
        © ARSLANHANGARAGE. Tüm hakları saklıdır.
    </footer>

  <script>
document.addEventListener('DOMContentLoaded', function () {

    const urlParams = new URLSearchParams(window.location.search);
    const aktif = urlParams.get('brand_id');

    const fetchUrl = aktif ? `get_ads.php?brand_id=${aktif}` : 'get_ads.php';

    fetch(fetchUrl)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('ilanListesi');
            container.innerHTML = ''; 
            if (!data.length) {
                container.innerHTML = '<p>Hiç ilan bulunamadı.</p>';
                return;
            }

            data.forEach(ad => {
                const ilanHTML = `
                    <section class="listing-detail">
                        <div class="car-images">
                        <img id="mainImage" src="main/${ad.resim_yolu}" alt="${ad.arac_markasi} ${ad.arac_modeli}" class="car-main-image">
                        </div>
                        <div class="car-info">
                        <h1>${ad.ilanbaslik}</h1>
                        <div class="price">Fiyat: <span>₺${Number(ad.fiyat || 0).toLocaleString('tr-TR')}</span></div>
                            <ul class="car-details">
                                <li><strong>Araç Markası:</strong> ${ad.arac_markasi}</li>
                                <li><strong>Araç Modeli:</strong> ${ad.arac_modeli}</li>
                                <li><strong>Araç Model Yılı:</strong> ${ad.aracmodelyili}</li>
                                <li><strong>Kilometre:</strong> ${ad.kilometre.toLocaleString('tr-TR')} km</li>
                                <li><strong>Renk:</strong> ${ad.arac_rengi}</li>
                                <li><strong>Araç Paketi:</strong> ${ad.paket}</li>
                                <li><strong>Yakıt Türü:</strong> ${ad.yakit_turu}</li>
                                <li><strong>Vites:</strong> ${ad.vites_turu}</li>
                                <li><strong>Açıklama:</strong> ${ad.ilan_aciklamasi}</li>
                                <li><strong>İlana Eklenme Tarihi:</strong> ${new Date(ad.kayit_tarihi).toLocaleDateString('tr-TR')}</li>
                            </ul>
                            <a href="contact.html" class="btn btn-primary">İletişime Geç</a>
                        </div>
                    </section>
                `;
                container.insertAdjacentHTML('beforeend', ilanHTML);
            });
        })
        .catch(error => {
            console.error("İlanlar alınamadı:", error);
        });
});
</script>


</body>
</html>
