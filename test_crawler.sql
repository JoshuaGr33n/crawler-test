-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 03, 2023 at 10:51 PM
-- Server version: 8.0.33
-- PHP Version: 8.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_crawler`
--

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
CREATE TABLE IF NOT EXISTS `content` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `url` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `title`, `url`, `created_at`) VALUES
(1, 'Big Bang Theory', 'https://www.facebook.com/', '2023-10-26 20:35:02'),
(2, 'Another Topic', 'https://www.facebook.com/', '2023-10-26 20:36:13'),
(3, 'Post Test', 'https://www.facebook.com/', '2023-10-26 21:19:25'),
(4, 'New Post', 'https://www.facebook.com/', '2023-10-26 21:20:12'),
(5, 'Test Run', 'https://www.facebook.com/', '2023-10-26 21:51:05'),
(6, 'come', 'https://www.facebook.com/', '2023-10-26 21:59:43'),
(7, 'comerade', 'https://www.facebook.com/', '2023-10-26 22:00:17'),
(8, 'comerade gggg', 'https://www.facebook.com/', '2023-10-26 22:00:35'),
(9, 'Fiinnaa', 'https://wallet-dev.detiktemasek.com/', '2023-10-26 22:01:47');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
CREATE TABLE IF NOT EXISTS `results` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `url` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=558 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `title`, `url`, `created_at`) VALUES
(549, 'Big Bang Theory\r\n', 'https://www.facebook.com/', '2023-10-28 16:43:49'),
(550, 'Another Topic\r\n', 'https://www.facebook.com/', '2023-10-28 16:43:49'),
(551, 'Post Test\r\n', 'https://www.facebook.com/', '2023-10-28 16:43:49'),
(552, 'New Post\r\n', 'https://www.facebook.com/', '2023-10-28 16:43:49'),
(553, 'Test Run\r\n', 'https://www.facebook.com/', '2023-10-28 16:43:49'),
(554, 'come\r\n', 'https://www.facebook.com/', '2023-10-28 16:43:49'),
(555, 'comerade\r\n', 'https://www.facebook.com/', '2023-10-28 16:43:49'),
(556, 'comerade gggg\r\n', 'https://www.facebook.com/', '2023-10-28 16:43:49'),
(557, 'Fiinnaa\r\n', 'https://wallet-dev.detiktemasek.com/', '2023-10-28 16:43:49');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$9y.BUeMxpV3aiCG4Pm4fme8unNZn9NEnsrZe0kCFJB3B1zIOUnAsG', '2023-10-26 08:14:50'),
(2, '1111', '$2y$10$KD3z2szpvS1W7hyyHDNbUOmEBLlOzIJEEB/NCrKNHxw5FuK3m2OwO', '2023-10-26 08:17:01'),
(3, 'John', '$2y$10$ubDm/WEg1OK0vV8woenMLefbZss0RxPMP7aoomI2vBAkG3OrgJWTe', '2023-10-26 09:02:45'),
(4, 'Jackson', '$2y$10$FLgYoi5RH0zwEEhCzEayR.WdVSIKrYRYuKb.CMKhfXbJM5X9B5qCG', '2023-10-26 09:09:05');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
