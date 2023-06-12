-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 27 Nis 2023, 11:52:52
-- Sunucu sürümü: 5.7.36
-- PHP Sürümü: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `hajans_case`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `status`, `created_at`, `updated_at`) VALUES
(15, 'Telefon', 'telefon', 'Telefon Modelleri', 1, '2023-04-27 10:49:36', '2023-04-27 10:49:36');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `color` varchar(25) NOT NULL,
  `size` varchar(15) NOT NULL,
  `weight` varchar(15) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `category_id`, `price`, `image_url`, `color`, `size`, `weight`, `stock_id`, `status`, `created_at`, `updated_at`) VALUES
(15, 'test95', 'test', 2, '100', 'sadas', 'mavi', 'L', '2', 5, 1, '2023-04-27 02:42:55', '2023-04-27 02:42:55'),
(12, 'test53', 'test', 6, '100', 'sadas', 'mavi', 'L', '80', 5, 1, '2023-04-27 00:10:55', '2023-04-27 00:29:49'),
(11, 'test53', 'test', 6, '100', 'sadas', 'mavi', 'L', '80', 5, 1, '2023-04-26 23:51:50', '2023-04-26 23:57:40'),
(14, 'test55', 'test', 2, '100', 'sadas', 'mavi', 'L', '2', 5, 1, '2023-04-27 00:12:14', '2023-04-27 00:12:14'),
(16, 'test125', 'test', 2, '100', 'sadas', 'mavi', 'L', '2', 5, 1, '2023-04-27 03:12:38', '2023-04-27 03:12:38'),
(17, 'test325', 'test', 2, '100', 'sadas', 'mavi', 'L', '2', 5, 1, '2023-04-27 14:49:15', '2023-04-27 14:49:15');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `stocks`
--

DROP TABLE IF EXISTS `stocks`;
CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `stock_count` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `stock_count`) VALUES
(1, 14, 10),
(2, 15, 11),
(3, 12, 10),
(4, 11, 25);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
