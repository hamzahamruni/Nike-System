-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 04, 2022 at 11:23 AM
-- Server version: 5.7.36
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nike`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_operations`
--

DROP TABLE IF EXISTS `account_operations`;
CREATE TABLE IF NOT EXISTS `account_operations` (
  `id_account` int(11) NOT NULL,
  `id_operation` int(11) NOT NULL AUTO_INCREMENT,
  `date_operations` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `amount` double NOT NULL,
  PRIMARY KEY (`id_operation`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_operations`
--

INSERT INTO `account_operations` (`id_account`, `id_operation`, `date_operations`, `amount`) VALUES
(10, 2, '2022-02-26 03:33:30', 100),
(10, 3, '2022-02-26 03:39:23', 150),
(3, 4, '2022-03-04 20:08:56', 5088),
(3, 5, '2022-03-04 20:23:36', 0),
(3, 6, '2022-03-04 20:28:40', 50),
(3, 7, '2022-03-04 20:33:16', 100),
(3, 8, '2022-03-04 20:43:11', 30),
(3, 9, '2022-03-04 20:44:28', 100),
(3, 10, '2022-03-04 20:48:05', 10),
(3, 11, '2022-03-04 20:49:47', 10);

-- --------------------------------------------------------

--
-- Table structure for table `buffer_purchases`
--

DROP TABLE IF EXISTS `buffer_purchases`;
CREATE TABLE IF NOT EXISTS `buffer_purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_class_buffer` int(11) NOT NULL,
  `qty_buffer` int(11) NOT NULL,
  `price_buffer` bigint(20) NOT NULL,
  `id_client` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `Id_class` int(11) NOT NULL AUTO_INCREMENT,
  `barcode` bigint(20) NOT NULL,
  `Code` varchar(11) NOT NULL,
  `Color` int(11) NOT NULL,
  `type` char(10) NOT NULL,
  `Name` varchar(60) NOT NULL,
  `Img` varchar(30) NOT NULL,
  `Price` bigint(11) NOT NULL,
  `id_user_c` int(11) NOT NULL,
  `del` int(11) NOT NULL,
  PRIMARY KEY (`Id_class`,`barcode`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`Id_class`, `barcode`, `Code`, `Color`, `type`, `Name`, `Img`, `Price`, `id_user_c`, `del`) VALUES
(25, 1111111111111, '123456', 123, 'S', 'NIKE AIR MAX', '921694-013.jpg', 0, 1, 0),
(27, 2222222222222, '123456', 333, 'S', 'AIR FOURC', '923619-010.jpg', 100, 1, 0),
(29, 3333333333333, '654321', 234, 'A', 'BALL1', '003480-100.jpg', 150, 1, 0),
(31, 4444444444444, '987654', 234, 'C', 'TSHIRT', '006014-100.jpg', 900, 0, 0),
(32, 5555555555555, '234567', 876, 'S', 'AIR MAX1', '', 90, 0, 0),
(33, 3349666007891, '555555', 55, 'S', 'BOSS HUGO', '', 155, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

DROP TABLE IF EXISTS `portfolio`;
CREATE TABLE IF NOT EXISTS `portfolio` (
  `id_portfolio` int(11) NOT NULL,
  `qty_por` int(11) NOT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id_portfolio`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `id_pur` int(11) NOT NULL AUTO_INCREMENT,
  `id_class` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `qty_store` int(11) NOT NULL,
  `price_buy` int(11) NOT NULL,
  `date_pur` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_client` int(11) NOT NULL,
  `del` int(11) NOT NULL,
  PRIMARY KEY (`id_pur`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id_pur`, `id_class`, `qty`, `qty_store`, `price_buy`, `date_pur`, `id_client`, `del`) VALUES
(38, 31, 11, -2, 111, '2022-02-25 21:59:40', 0, 0),
(39, 25, 2, 0, 200, '2022-02-25 21:58:24', 0, 0),
(40, 27, 22, 19, 50, '2022-02-28 13:46:16', 0, 0),
(41, 29, 44, 5, 100, '2022-03-04 20:32:21', 0, 0),
(42, 32, 3, 0, 30, '2022-02-25 21:22:48', 0, 0),
(43, 31, 10, 0, 80, '2022-02-25 21:59:40', 0, 0),
(44, 33, 5, 0, 95, '2022-02-28 15:10:49', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `relation_class_sale`
--

DROP TABLE IF EXISTS `relation_class_sale`;
CREATE TABLE IF NOT EXISTS `relation_class_sale` (
  `id_relation` int(11) NOT NULL AUTO_INCREMENT,
  `id_sale` int(11) NOT NULL,
  `id_class` int(11) NOT NULL,
  `qty_sale` int(11) NOT NULL,
  `class_price` double NOT NULL,
  PRIMARY KEY (`id_relation`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relation_class_sale`
--

INSERT INTO `relation_class_sale` (`id_relation`, `id_sale`, `id_class`, `qty_sale`, `class_price`) VALUES
(1, 1, 1, 0, 200),
(2, 1, 2, 0, 200),
(3, 3, 31, 0, 900),
(4, 3, 32, 0, 90),
(5, 5, 31, 0, 900),
(6, 5, 32, 0, 90),
(7, 6, 31, 0, 900),
(8, 6, 32, 0, 90),
(9, 7, 31, 0, 900),
(10, 8, 31, 0, 900),
(11, 9, 31, 0, 900),
(12, 9, 31, 0, 900),
(13, 10, 25, 0, 0),
(14, 12, 31, 0, 900),
(15, 12, 31, 0, 900),
(16, 13, 29, 0, 0),
(17, 15, 27, 2, 100),
(18, 16, 29, 1, 0),
(19, 17, 29, 2, 150),
(20, 18, 27, 1, 100),
(21, 19, 33, 5, 155),
(22, 20, 29, 5, 150),
(23, 21, 29, 1, 150),
(24, 22, 29, 3, 150),
(25, 23, 29, 1, 150),
(26, 24, 29, 3, 150),
(27, 25, 29, 2, 150),
(28, 26, 29, 2, 150),
(29, 28, 29, 1, 150),
(30, 29, 29, 2, 150),
(31, 30, 29, 1, 150),
(32, 32, 29, 1, 150),
(33, 33, 29, 1, 150),
(34, 35, 29, 1, 150),
(35, 36, 29, 1, 150),
(36, 38, 29, 1, 150),
(37, 39, 29, 1, 150),
(38, 40, 29, 2, 150);

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

DROP TABLE IF EXISTS `sale`;
CREATE TABLE IF NOT EXISTS `sale` (
  `Id_sale` int(11) NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_price` double NOT NULL,
  `paid` double NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_account` int(11) DEFAULT NULL,
  `del` int(11) NOT NULL,
  PRIMARY KEY (`Id_sale`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`Id_sale`, `date`, `total_price`, `paid`, `id_user`, `id_account`, `del`) VALUES
(1, '2022-01-01 18:38:12', 400, 400, 1, 0, 0),
(2, '2022-01-01 18:38:48', 400, 400, 1, 0, 0),
(3, '2022-02-25 20:44:02', 990, 990, 1, 0, 0),
(4, '2022-02-25 21:19:50', 1170, 1170, 1, 0, 0),
(5, '2022-02-25 21:22:08', 1170, 1170, 1, 0, 0),
(6, '2022-02-25 21:22:47', 1170, 1170, 1, 0, 0),
(7, '2022-02-25 21:34:51', 900, 900, 1, 0, 0),
(8, '2022-02-25 21:35:27', 900, 900, 1, 0, 0),
(9, '2022-02-25 21:54:54', 1800, 1800, 1, 0, 0),
(10, '2022-02-25 21:58:24', 0, 0, 1, 0, 0),
(11, '2022-02-25 21:58:29', 0, 0, 1, 0, 0),
(12, '2022-02-25 21:59:39', 2700, 2700, 1, 0, 0),
(13, '2022-02-25 22:04:16', 0, 0, 1, 0, 0),
(14, '2022-02-25 23:06:55', 200, 200, 1, 0, 0),
(15, '2022-02-26 03:39:23', 200, 200, 1, 10, 0),
(17, '2022-02-28 13:44:07', 300, 300, 1, NULL, 0),
(18, '2022-02-28 13:44:37', 100, 100, 1, NULL, 0),
(19, '2022-02-28 15:10:49', 775, 775, 1, NULL, 0),
(20, '2022-03-04 19:07:17', 750, 750, 1, 0, 0),
(21, '2022-03-04 19:09:58', 150, 150, 1, 0, 0),
(22, '2022-03-04 19:12:50', 450, 450, 1, 0, 0),
(23, '2022-03-04 19:17:45', 150, 150, 1, 0, 0),
(24, '2022-03-04 19:22:00', 450, 450, 1, 0, 0),
(25, '2022-03-04 19:23:21', 300, 300, 1, 0, 0),
(26, '2022-03-04 19:27:54', 300, 300, 1, 0, 0),
(27, '2022-03-04 19:28:25', 0, 0, 1, 0, 0),
(28, '2022-03-04 19:28:48', 150, 150, 1, 0, 0),
(29, '2022-03-04 19:31:11', 300, 300, 1, 0, 0),
(30, '2022-03-04 19:33:59', 150, 150, 1, 0, 0),
(31, '2022-03-04 19:35:26', 0, 0, 1, 1, 0),
(32, '2022-03-04 19:35:38', 150, 150, 1, 0, 0),
(33, '2022-03-04 19:42:37', 150, 150, 1, 0, 0),
(34, '2022-03-04 19:43:29', 0, 0, 1, 0, 0),
(35, '2022-03-04 19:43:36', 150, 150, 1, 0, 0),
(36, '2022-03-04 19:44:14', 150, 50, 1, 1, 0),
(37, '2022-03-04 19:44:37', 0, 50, 1, 1, 0),
(38, '2022-03-04 19:45:03', 150, 50, 1, 1, 0),
(39, '2022-03-04 20:49:47', 150, 110, 1, 3, 0),
(40, '2022-03-04 20:47:00', 300, 300, 1, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(30) NOT NULL,
  `User_Name` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Priv` varchar(11) NOT NULL,
  `del` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Name`, `User_Name`, `Password`, `Priv`, `del`) VALUES
(1, 'Admin', 'admin', '12345', 'A', 0),

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

DROP TABLE IF EXISTS `user_accounts`;
CREATE TABLE IF NOT EXISTS `user_accounts` (
  `id_account` int(11) NOT NULL AUTO_INCREMENT,
  `account_name` varchar(60) NOT NULL,
  `phone_number` int(11) NOT NULL,
  `salary` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `account_char` char(20) CHARACTER SET utf8 NOT NULL,
  `del` int(11) NOT NULL,
  PRIMARY KEY (`id_account`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`id_account`, `account_name`, `phone_number`, `salary`, `account_char`, `del`) VALUES
(1, 'hamza', 921111111, NULL, 'SU', 0),

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
