-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 27 May 2025, 22:13:00
-- Sunucu sürümü: 10.4.27-MariaDB
-- PHP Sürümü: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `arsgarage`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `araclar`
--

CREATE TABLE `araclar` (
  `id` int(11) NOT NULL,
  `fiyat` decimal(10,0) NOT NULL,
  `arac_markasi` varchar(50) NOT NULL,
  `arac_modeli` varchar(50) NOT NULL,
  `paket` varchar(50) NOT NULL,
  `kilometre` int(11) NOT NULL,
  `arac_rengi` varchar(50) NOT NULL,
  `yakit_turu` varchar(50) NOT NULL,
  `vites_turu` varchar(50) NOT NULL,
  `resim_yolu` varchar(255) NOT NULL,
  `ilan_aciklamasi` varchar(255) NOT NULL,
  `kayit_tarihi` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `aktif` tinyint(1) NOT NULL DEFAULT 1,
  `ilanbaslik` varchar(100) DEFAULT NULL,
  `aracmodelyili` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `araclar`
--

INSERT INTO `araclar` (`id`, `fiyat`, `arac_markasi`, `arac_modeli`, `paket`, `kilometre`, `arac_rengi`, `yakit_turu`, `vites_turu`, `resim_yolu`, `ilan_aciklamasi`, `kayit_tarihi`, `aktif`, `ilanbaslik`, `aracmodelyili`) VALUES
(18, '650000', '3', '9', 'Titanium', 120000, 'Mavi', 'Benzin & LPG', 'Manuel', 'uploads/resim_68355db946a5e8.69415536.jpg', 'Araç Temiz ve diri bir araçtır', '2025-05-27 16:48:02', 0, 'Tertemiz Araç', ''),
(25, '550000', '3', '9', 'Trend', 278000, 'Lacivert', 'Benzin & LPG', 'Manuel', 'uploads/resim_68356e108cd694.74112979.jpg', 'Ford Focus Aile Aracı tavsiye edilir', '2025-05-26 21:00:00', 1, 'Ford Focus Aile Aracı', '2009'),
(26, '450000', '2', '5', '1.6i VTEC Premium', 175000, 'Kırmızı', 'Benzin & LPG', 'Manuel', 'uploads/resim_6835e56d914627.69027973.png', 'Aracımız ağır hasar kayıtlı hatasızdır.', '2025-05-26 21:00:00', 1, 'Honda Civic fd6', '2008'),
(27, '850000', '3', '9', 'Trend', 68, 'Altın', 'Dizel', 'Manuel', 'uploads/resim_6835ee333a3e38.43258717.jpg', 'dfdsfs', '2025-05-26 21:00:00', 1, 'denemeeee', '2005');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `car_brands`
--

CREATE TABLE `car_brands` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `car_brands`
--

INSERT INTO `car_brands` (`id`, `name`) VALUES
(1, 'Toyota'),
(2, 'Honda'),
(3, 'Ford'),
(4, 'Chevrolet'),
(5, 'BMW'),
(6, 'Mercedes-Benz'),
(7, 'Audi'),
(8, 'Volkswagen'),
(9, 'Hyundai'),
(10, 'Kia'),
(11, 'Nissan'),
(12, 'Peugeot'),
(13, 'Renault'),
(14, 'Fiat'),
(15, 'Mazda'),
(16, 'Subaru'),
(17, 'Volvo'),
(18, 'Tesla'),
(19, 'Porsche'),
(20, 'Jaguar'),
(21, 'Lexus'),
(22, 'Land Rover'),
(23, 'Mitsubishi'),
(24, 'Suzuki'),
(25, 'Skoda');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `car_models`
--

CREATE TABLE `car_models` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `car_models`
--

INSERT INTO `car_models` (`id`, `brand_id`, `name`) VALUES
(1, 1, 'Corolla'),
(2, 1, 'Camry'),
(3, 1, 'Yaris'),
(4, 1, 'RAV4'),
(5, 2, 'Civic'),
(6, 2, 'Accord'),
(7, 2, 'CR-V'),
(8, 2, 'Jazz'),
(9, 3, 'Focus'),
(10, 3, 'Fiesta'),
(11, 3, 'Mustang'),
(12, 3, 'Escape'),
(13, 4, 'Cruze'),
(14, 4, 'Malibu'),
(15, 4, 'Tahoe'),
(16, 4, 'Spark'),
(17, 5, '3 Series'),
(18, 5, '5 Series'),
(19, 5, 'X3'),
(20, 5, 'X5'),
(21, 6, 'C-Class'),
(22, 6, 'E-Class'),
(23, 6, 'GLA'),
(24, 6, 'GLE'),
(25, 7, 'A3'),
(26, 7, 'A4'),
(27, 7, 'Q5'),
(28, 7, 'Q7'),
(29, 8, 'Golf'),
(30, 8, 'Passat'),
(31, 8, 'Tiguan'),
(32, 8, 'Polo'),
(33, 9, 'Elantra'),
(34, 9, 'Sonata'),
(35, 9, 'Tucson'),
(36, 9, 'i20'),
(37, 10, 'Rio'),
(38, 10, 'Sportage'),
(39, 10, 'Sorento'),
(40, 10, 'Cerato'),
(41, 11, 'Altima'),
(42, 11, 'Sentra'),
(43, 11, 'Rogue'),
(44, 11, 'Qashqai'),
(45, 12, '208'),
(46, 12, '308'),
(47, 12, '3008'),
(48, 12, '5008'),
(49, 13, 'Clio'),
(50, 13, 'Megane'),
(51, 13, 'Captur'),
(52, 13, 'Kadjar'),
(53, 14, 'Punto'),
(54, 14, 'Tipo'),
(55, 14, '500'),
(56, 14, 'Egea'),
(57, 15, 'Mazda3'),
(58, 15, 'Mazda6'),
(59, 15, 'CX-3'),
(60, 15, 'CX-5'),
(61, 16, 'Impreza'),
(62, 16, 'Forester'),
(63, 16, 'Outback'),
(64, 16, 'XV'),
(65, 17, 'S60'),
(66, 17, 'XC40'),
(67, 17, 'XC60'),
(68, 17, 'XC90'),
(69, 18, 'Model S'),
(70, 18, 'Model 3'),
(71, 18, 'Model X'),
(72, 18, 'Model Y'),
(73, 19, '911'),
(74, 19, 'Cayenne'),
(75, 19, 'Macan'),
(76, 19, 'Panamera'),
(77, 20, 'XE'),
(78, 20, 'XF'),
(79, 20, 'F-Pace'),
(80, 20, 'I-Pace'),
(81, 21, 'IS'),
(82, 21, 'ES'),
(83, 21, 'NX'),
(84, 21, 'RX'),
(85, 22, 'Discovery'),
(86, 22, 'Range Rover'),
(87, 22, 'Defender'),
(88, 22, 'Evoque'),
(89, 23, 'Lancer'),
(90, 23, 'Outlander'),
(91, 23, 'ASX'),
(92, 23, 'Pajero'),
(93, 24, 'Swift'),
(94, 24, 'Vitara'),
(95, 24, 'Baleno'),
(96, 24, 'Ignis'),
(97, 25, 'Fabia'),
(98, 25, 'Octavia'),
(99, 25, 'Superb'),
(100, 25, 'Kodiaq');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `userName` varchar(50) NOT NULL,
  `password` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`userName`, `password`) VALUES
('ArslanhanGarage', 123);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `araclar`
--
ALTER TABLE `araclar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `car_brands`
--
ALTER TABLE `car_brands`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `car_models`
--
ALTER TABLE `car_models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `araclar`
--
ALTER TABLE `araclar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Tablo için AUTO_INCREMENT değeri `car_models`
--
ALTER TABLE `car_models`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `car_models`
--
ALTER TABLE `car_models`
  ADD CONSTRAINT `car_models_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `car_brands` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
