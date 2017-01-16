-- phpMyAdmin SQL Dump for Onskesedlen
-- Created by Psylicium in january 2017

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Table structure for table `gifts`
--

CREATE TABLE IF NOT EXISTS `gifts` (
  `gift_id` int(10) NOT NULL AUTO_INCREMENT,
  `gift_desc` varchar(300) COLLATE utf8_danish_ci NOT NULL,
  `gift_link` varchar(300) COLLATE utf8_danish_ci NOT NULL,
  `gift_owner` int(10) NOT NULL,
  `gift_reserved` int(10) NOT NULL,
  `reserved_by` int(10) DEFAULT NULL,
  UNIQUE KEY `gift_id` (`gift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) COLLATE utf8_danish_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_danish_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_danish_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_danish_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;