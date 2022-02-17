-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 25, 2021 at 10:23 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cartzilla`
--

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

DROP TABLE IF EXISTS `billing`;
CREATE TABLE IF NOT EXISTS `billing` (
  `customer_id` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `town` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `street` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`customer_id`, `firstname`, `lastname`, `email`, `zipcode`, `state`, `town`, `company_name`, `phone`, `street`) VALUES
('1', 'victor', 'nwaede', 'ituaosemeilu234@gmail.com', '300283', 'Akwa Ibom', 'Asaba', '', '+2348114800769', '6 ugbowo road');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `password` varchar(80) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `email`, `password`, `firstname`, `lastname`) VALUES
(3, 'meljulius79@gmail.com', '$2y$10$ODAwNGUxNDQyNTdkNWQ2NOsag6/JZ.NxU6j8VpT.6kKr52/qLyxvG', NULL, NULL),
(2, 'ituaosemeilu234@gmail.com', '$2y$10$OGE4ZDM0ODQxYzI1M2RhMO7ByIHfTEi9lhU6RspQRVuYckyDLEJU2', NULL, NULL),
(4, 'sivatech234@gmail.com', '$2y$10$YzViNDRlYTNkNDU3ZjZmNOqdqsunV7PU40/7N0ZUK29vvXfUq7uye', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
CREATE TABLE IF NOT EXISTS `newsletter` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`id`, `email`) VALUES
(1, 'ituaosemeilu234@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `reference_id` varchar(15) NOT NULL,
  `payment_status` varchar(14) NOT NULL DEFAULT 'pending...',
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1054 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `customer_id`, `total`, `order_date`, `reference_id`, `payment_status`) VALUES
(1030, 2, 141, '2021-10-21', '2sqPop2Qd3NOPd', 'pending...'),
(1031, 2, 141, '2021-10-21', 'YS0SV8DQR6uG1L', 'pending...'),
(1032, 2, 141, '2021-10-21', 'uhAVGrlD0Aeuca', 'pending...'),
(1033, 2, 141, '2021-10-21', 'hGSJeWWApEnG4j', 'pending...'),
(1034, 2, 141, '2021-10-21', 'dpAVWeMJcP6Mta', 'pending...'),
(1035, 2, 141, '2021-10-21', '4KEfZSct2vk5XC', 'pending...'),
(1036, 2, 353, '2021-10-21', 'qFtkeZw5cLPVbr', 'pending...'),
(1037, 2, 353, '2021-10-21', 'blZC4VC4S0oDAp', 'paid'),
(1038, 2, 353, '2021-10-21', 'rkPnMqFjIwZxeP', 'pending...'),
(1039, 1, 508, '2021-10-22', 'Hn83tk6KonXtHD', 'pending...'),
(1040, 1, 508, '2021-10-22', 'IUviaOwvkj0v2R', 'paid'),
(1041, 1, 508, '2021-10-22', 'DW1dGaXgukQUji', 'pending...'),
(1042, 1, 508, '2021-10-22', '1AE8vpyYlP6WTv', 'pending...'),
(1043, 1, 397, '2021-10-22', 'QtzxZfvol29GLG', 'pending...'),
(1044, 1, 260, '2021-10-22', 'DzWhcv0T2KMOAi', 'pending...'),
(1045, 1, 260, '2021-10-22', 'LB03VFBN6gJsfh', 'pending...'),
(1046, 1, 260, '2021-10-22', 'T1xBFAw9RHbkkm', 'paid'),
(1047, 1, 166, '2021-10-22', 'dd8V1IfknhlbuH', 'paid'),
(1048, 1, 83, '2021-10-22', 'pDYVOfQGVBgYdE', 'paid'),
(1049, 1, 350, '2021-10-22', 'oJYK3fTHL5NBSz', 'paid'),
(1050, 1, 380, '2021-10-22', 'QEvQ9yeNpdKM4T', 'pending...'),
(1051, 1, 380, '2021-10-22', 'pgIqt3d53ApcSj', 'paid'),
(1052, 1, 559, '2021-10-22', 'TidPTIbuFqIY87', 'paid'),
(1053, 2, 402, '2021-10-25', 'VcrsJaPwJ2p5hr', 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

DROP TABLE IF EXISTS `order_address`;
CREATE TABLE IF NOT EXISTS `order_address` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `billing_firstname` varchar(255) NOT NULL,
  `billing_lastname` varchar(255) NOT NULL,
  `billing_email` varchar(255) NOT NULL,
  `billing_phone` varchar(30) NOT NULL,
  `billing_street` text NOT NULL,
  `billing_town` varchar(255) NOT NULL,
  `billing_state` varchar(50) DEFAULT NULL,
  `billing_country` varchar(50) DEFAULT NULL,
  `shipping_firstname` varchar(255) NOT NULL,
  `shipping_lastname` varchar(255) NOT NULL,
  `shipping_country` varchar(50) DEFAULT NULL,
  `shipping_street` text NOT NULL,
  `shipping_town` varchar(50) NOT NULL,
  `shipping_zipcode` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`id`, `order_id`, `billing_firstname`, `billing_lastname`, `billing_email`, `billing_phone`, `billing_street`, `billing_town`, `billing_state`, `billing_country`, `shipping_firstname`, `shipping_lastname`, `shipping_country`, `shipping_street`, `shipping_town`, `shipping_zipcode`) VALUES
(1, 0, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(2, 0, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(3, 0, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(4, 1033, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(5, 1034, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(6, 1035, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(7, 1036, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(8, 1037, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(9, 1038, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(10, 1039, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(11, 1040, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(12, 1041, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(13, 1042, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(14, 1043, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(15, 1044, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(16, 1044, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(17, 1045, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(18, 1046, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(19, 1046, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(20, 1047, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(21, 1048, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(22, 1049, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(23, 1049, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(24, 1050, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(25, 1050, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(26, 1051, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(27, 1051, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(28, 1052, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(29, 1053, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', ''),
(30, 1053, 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '08114800769', '6 ugbowo road', 'Benin city', 'Edo', 'Nigeria', 'Itua', 'Osemeilu', 'Nigeria', '6 ugbowo road', 'Benin city', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_contents`
--

DROP TABLE IF EXISTS `order_contents`;
CREATE TABLE IF NOT EXISTS `order_contents` (
  `oc_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `ship_date` date NOT NULL,
  PRIMARY KEY (`oc_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_contents`
--

INSERT INTO `order_contents` (`oc_id`, `order_id`, `product_id`, `quantity`, `price`, `ship_date`) VALUES
(1, 1043, 2, 7, 35, '2021-10-22'),
(2, 1044, 2, 1, 35, '2021-10-22'),
(3, 1044, 4, 3, 75, '2021-10-22'),
(4, 1045, 2, 1, 35, '2021-10-22'),
(5, 1046, 2, 1, 35, '2021-10-22'),
(6, 1046, 4, 3, 75, '2021-10-22'),
(7, 1047, 1, 10, 17, '2021-10-22'),
(8, 1048, 1, 5, 17, '2021-10-22'),
(9, 1049, 1, 3, 17, '2021-10-22'),
(10, 1049, 4, 4, 75, '2021-10-22'),
(11, 1050, 3, 5, 26, '2021-10-22'),
(12, 1050, 11, 4, 63, '2021-10-22'),
(13, 1051, 3, 5, 26, '2021-10-22'),
(14, 1051, 11, 4, 63, '2021-10-22'),
(15, 1052, 6, 6, 93, '2021-10-22'),
(16, 1053, 3, 4, 26, '2021-10-25'),
(17, 1053, 4, 4, 75, '2021-10-25');

-- --------------------------------------------------------

--
-- Table structure for table `passwordreset`
--

DROP TABLE IF EXISTS `passwordreset`;
CREATE TABLE IF NOT EXISTS `passwordreset` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `token` varchar(67) NOT NULL,
  `exp_time` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passwordreset`
--

INSERT INTO `passwordreset` (`id`, `email`, `token`, `exp_time`) VALUES
(24, 'ituaosemeilu234@gmail.com', '768e78024aa8fdb9b8fe87be86f64745ituaosemeilu234@gmail.comca097e5b6b', '2021-10-24 23:08:43'),
(21, 'meljulius79@gmail.com', '768e78024aa8fdb9b8fe87be86f64745meljulius79@gmail.com82f755757c', '2021-10-24 13:06:56');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `product_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `price` text NOT NULL,
  `total_stock` int(11) NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `short_description` text NOT NULL,
  `product_image2` varchar(100) DEFAULT NULL,
  `product_image3` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `price`, `total_stock`, `product_image`, `category_id`, `short_description`, `product_image2`, `product_image3`) VALUES
(1, 'Esprit Ruffle Shirt', '16.64', 18, 'product-01.jpg', 5, 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat. till i get u back im gon try', NULL, NULL),
(2, 'Herschel supply', '35.31', 12, 'product-02.jpg', 5, 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat. till i get u back im gon try', NULL, NULL),
(3, 'Only Check Trouser', '25.50', 18, 'product-03.jpg', 4, 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat. till i get u back im gon try', NULL, NULL),
(4, 'Classic Trench Coat', '75.00', 12, 'product-04.jpg', 5, 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat. till i get u back im gon try', NULL, NULL),
(5, 'Front Pocket Jumper', '34.75', 18, 'product-05.jpg', 5, 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat. till i get u back im gon try', NULL, NULL),
(6, 'Vintage Inspired Classic', '93.20', 15, 'product-06.jpg', 1, 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat. till i get u back im gon try', NULL, NULL),
(7, 'Shirt in Stretch Cotton', '52.66', 20, 'product-07.jpg', 5, 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat. till i get u back im gon try', NULL, NULL),
(8, 'Pieces Metallic Printed', '18.96', 30, 'product-08.jpg', 5, 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat. till i get u back im gon try', NULL, NULL),
(9, 'Converse All Star Hi Plimsolls', '75.00', 10, 'product-09.jpg', 2, 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat. till i get u back im gon try', NULL, NULL),
(10, 'Femme T-Shirt In Stripe', '25.85', 12, 'product-10.jpg', 5, 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat. till i get u back im gon try', NULL, NULL),
(11, 'Herschel Supply', '63.16', 10, 'product-11.jpg', 4, 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat. till i get u back im gon try', NULL, NULL),
(12, 'T-Shirt with sleeve', '18.49', 16, 'product-12.jpg', 5, 'Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat ornare feugiat. till i get u back im gon try', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_reviews`
--

DROP TABLE IF EXISTS `product_reviews`;
CREATE TABLE IF NOT EXISTS `product_reviews` (
  `review_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `message` text NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`review_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shipping`
--

DROP TABLE IF EXISTS `shipping`;
CREATE TABLE IF NOT EXISTS `shipping` (
  `customer_id` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `town` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `street` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping`
--

INSERT INTO `shipping` (`customer_id`, `firstname`, `lastname`, `email`, `zipcode`, `state`, `town`, `company_name`, `street`) VALUES
('1', 'Itua', 'Osemeilu', 'ituaosemeilu234@gmail.com', '300256', 'Edo', 'Benin city', 'Speedtech', '6 ugbowo road');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

DROP TABLE IF EXISTS `slider`;
CREATE TABLE IF NOT EXISTS `slider` (
  `slider_id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `slider_image` varchar(100) NOT NULL,
  `text-1` varchar(60) NOT NULL,
  `text-2` varchar(60) NOT NULL,
  `text-3` varchar(20) NOT NULL,
  `anime-1` varchar(20) NOT NULL,
  `anime-2` varchar(20) NOT NULL,
  `anime-3` varchar(20) NOT NULL,
  PRIMARY KEY (`slider_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`slider_id`, `slider_image`, `text-1`, `text-2`, `text-3`, `anime-1`, `anime-2`, `anime-3`) VALUES
(1, 'slide-01.jpg', 'Women collection 2018', 'NEW SEASON', 'Shop Now', 'fadeInDown', 'fadeInUp', 'zoomIn'),
(2, 'slide-02.jpg', 'Men New-Season', 'Jackets & Coats', 'Shop Now', 'rollIn', 'lightSpeedIn', 'slideInUp'),
(3, 'slide-03.jpg', 'Men Collection 2018', 'New Arrivals', 'Shop Now', 'rotateInDownLeft', 'rotateInUpRight', 'rotateIn');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `price`, `quantity`) VALUES
(1, 20, 3),
(2, 80, 6),
(3, 35, 5),
(6, 35, 5),
(7, 17, 1),
(8, 35, 4),
(9, 35, 5),
(10, 17, 1),
(11, 35, 4),
(12, 35, 5),
(13, 17, 1),
(14, 35, 4),
(15, 35, 5),
(16, 17, 1),
(17, 35, 4),
(18, 35, 5),
(19, 17, 1),
(20, 35, 4),
(21, 35, 5),
(22, 17, 1),
(23, 35, 4),
(24, 35, 5),
(25, 17, 1),
(26, 35, 4);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
