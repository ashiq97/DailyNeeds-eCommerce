-- phpMyAdmin SQL Dump
-- version 4.4.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2018 at 08:47 AM
-- Server version: 5.6.25
-- PHP Version: 5.6.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `needy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE IF NOT EXISTS `admin_user` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `join_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL,
  `permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `full_name`, `email`, `password`, `join_date`, `last_login`, `permission`) VALUES
(1, 'Ashiq khan', 'ashiq097@gmail.com', '$2y$10$4swNn68QawCkFWg7WrWq7uNFscjXzqoSarPc2l05nnjDc21ZniYaG', '2017-11-08 21:49:02', '2018-08-15 14:25:54', 'admin,editor'),
(2, 'rashad Akhtar', 'rashad123@gmail.com', '$2y$10$oJ/KvYhmYMGEdkHdoaBMeeL8jZ7Dt2tLEN3mamRqd6ZKOwe81xIsC', '2017-11-20 14:27:18', '2017-12-18 03:40:14', 'admin,editor'),
(6, 'Ridwan Zahan', 'Ridwan12@gmail.com', '123456', '2017-11-20 22:14:47', '0000-00-00 00:00:00', 'editor'),
(7, 'ridwan khan', 'rid123@gmail.com', '$2y$10$N6jC4ehEpcF7W4l6kp8L.OKIuWmxw2W1HZjByGzd2zlyt.dqc9Ycq', '2017-11-22 10:50:18', '0000-00-00 00:00:00', 'editor'),
(8, 'Nazmul Ahsan', 'Nazmul123@gmail.com', '$2y$10$Ux1aA3nb4iz01H6aIPJfdeRBs5tuN9xC1I4UB3jXuh0HcGtinQEoy', '2017-12-03 22:33:44', '2017-12-19 09:27:52', 'editor');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `brand_name`) VALUES
(17, 'Unilever'),
(18, 'Agora'),
(19, 'BDFood'),
(20, 'Nestle'),
(21, 'Johnsons'),
(22, 'Not Applicable'),
(23, 'Olimpic');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL,
  `items` text COLLATE utf8_unicode_ci NOT NULL,
  `expire_date` datetime NOT NULL,
  `paid` tinyint(4) NOT NULL DEFAULT '0',
  `shipped` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `items`, `expire_date`, `paid`, `shipped`) VALUES
(1, '[{"id":"3","size":"medium","quantity":"2"},{"id":"6","size":"50","quantity":"3"},{"id":"1","size":"32","quantity":"2"}]', '2017-12-02 10:28:39', 0, 0),
(2, '[{"id":"6","size":"50","quantity":"2"},{"id":"2","size":"small","quantity":"2"}]', '2017-12-02 10:50:48', 0, 0),
(3, '[{"id":"4","size":"small","quantity":"1"},{"id":"3","size":"medium","quantity":"2"},{"id":"6","size":"40","quantity":"2"},{"id":"1","size":"28","quantity":"2"}]', '2017-12-04 04:30:47', 0, 0),
(4, '[{"id":"3","size":"medium","quantity":"2"},{"id":"6","size":"40","quantity":"2"}]', '2017-12-04 12:08:02', 0, 0),
(5, '[{"id":"6","size":"50","quantity":"2"}]', '2017-12-05 05:58:18', 0, 0),
(6, '[{"id":"6","size":"50","quantity":1}]', '2017-12-05 08:15:35', 0, 0),
(7, '[{"id":"6","size":"40","quantity":"1"},{"id":"1","size":"32","quantity":"2"}]', '2017-12-05 11:39:18', 0, 0),
(8, '[{"id":"6","size":"50","quantity":"2"},{"id":"2","size":"small","quantity":"3"}]', '2017-12-05 15:37:56', 0, 0),
(9, '[{"id":"8","size":"kg","quantity":3},{"id":"2","size":"large","quantity":"2"},{"id":"6","size":"50","quantity":"3"},{"id":"2","size":"small","quantity":"2"}]', '2017-12-06 04:49:39', 0, 0),
(10, '[{"id":"9","size":"kgs","quantity":2}]', '2017-12-06 06:12:12', 0, 0),
(11, '[{"id":"9","size":"kgs","quantity":5},{"id":"16","size":"Pieces","quantity":2},{"id":"12","size":"kgs","quantity":4}]', '2017-12-09 06:54:25', 0, 0),
(12, '[{"id":"11","size":"Pieces","quantity":"3"}]', '2017-12-13 05:19:47', 0, 0),
(13, '[{"id":"26","size":"Pieces","quantity":"3"},{"id":"17","size":"Pieces","quantity":"2"}]', '2017-12-13 06:02:10', 0, 0),
(14, '[{"id":"25","size":"Pieces","quantity":"3"}]', '2017-12-13 06:53:37', 0, 0),
(15, '[{"id":"11","size":"Pieces","quantity":1}]', '2017-12-20 17:20:26', 0, 0),
(17, '[{"id":"11","size":"Pieces","quantity":3}]', '2017-12-27 03:24:51', 0, 0),
(18, '[{"id":"13","size":"Pieces","quantity":"2"}]', '2017-12-28 16:48:46', 0, 0),
(19, '[{"id":"12","size":"kgs","quantity":"2"}]', '2017-12-31 13:43:38', 0, 0),
(20, '[{"id":"16","size":"Pieces","quantity":1}]', '2017-12-03 18:39:07', 1, 0),
(21, '[{"id":"17","size":"Pieces","quantity":"1"},{"id":"26","size":"Pieces","quantity":"2"}]', '2018-01-02 10:42:29', 1, 0),
(22, '[{"id":"28","size":"Packets","quantity":1}]', '2018-01-02 10:53:38', 0, 0),
(28, '[{"id":"13","size":"Pieces","quantity":1}]', '2018-01-03 07:31:39', 0, 0),
(31, '[{"id":"26","size":"Pieces","quantity":3}]', '2018-01-03 07:42:53', 0, 0),
(32, '[{"id":"11","size":"Pieces","quantity":6}]', '2018-01-03 08:51:43', 0, 0),
(33, '[{"id":"26","size":"Pieces","quantity":"2"}]', '2018-01-03 15:59:49', 1, 0),
(40, '[{"id":"13","size":"Pieces","quantity":"2"},{"id":"12","size":"kgs","quantity":"2"}]', '2017-12-06 10:23:52', 0, 0),
(47, '[{"id":"11","size":"Pieces","quantity":4}]', '2018-01-05 02:35:16', 0, 0),
(51, '[{"id":"11","size":"Pieces","quantity":"2"}]', '2018-01-05 04:31:36', 1, 0),
(53, '[{"id":"11","size":"Pieces","quantity":"2"}]', '2018-01-05 17:02:16', 1, 0),
(54, '[{"id":"13","size":"Pieces","quantity":"1"}]', '2018-01-05 19:34:59', 1, 0),
(55, '[{"id":"11","size":"Pieces","quantity":"1"}]', '2018-01-05 20:15:11', 1, 0),
(56, '[{"id":"11","size":"Pieces","quantity":"1"}]', '2018-01-05 20:21:00', 1, 0),
(57, '[{"id":"13","size":"Pieces","quantity":"1"}]', '2018-01-05 20:34:34', 0, 0),
(58, '[{"id":"11","size":"Pieces","quantity":"1"}]', '2018-01-05 20:35:41', 1, 0),
(59, '[{"id":"11","size":"Pieces","quantity":"1"}]', '2018-01-05 20:40:10', 1, 0),
(60, '[{"id":"12","size":"kgs","quantity":"1"}]', '2018-01-06 03:26:07', 1, 0),
(61, '[{"id":"11","size":"Pieces","quantity":"1"}]', '2018-01-06 03:28:09', 1, 0),
(62, '[{"id":"11","size":"Pieces","quantity":"1"}]', '2018-01-06 03:29:08', 1, 0),
(63, '[{"id":"11","size":"Pieces","quantity":"1"}]', '2018-01-06 03:31:26', 1, 0),
(64, '[{"id":"11","size":"Pieces","quantity":"1"}]', '2018-01-06 03:38:58', 1, 0),
(65, '[{"id":"11","size":"Pieces","quantity":"2"}]', '2018-01-06 03:46:27', 1, 0),
(67, '[{"id":"11","size":"Pieces","quantity":"1"}]', '2018-01-06 03:50:47', 1, 0),
(68, '[{"id":"11","size":"Pieces","quantity":"1"}]', '2018-01-06 04:22:12', 1, 1),
(69, '[{"id":"13","size":"Pieces","quantity":"1"}]', '2018-01-06 04:45:57', 1, 1),
(70, '[{"id":"11","size":"Pieces","quantity":"2"},{"id":"12","size":"kgs","quantity":"1"}]', '2018-01-06 05:05:11', 1, 1),
(71, '[{"id":"12","size":"kgs","quantity":"1"}]', '2018-01-06 05:27:34', 0, 0),
(72, '[{"id":"12","size":"kgs","quantity":1},{"id":"11","size":"Pieces","quantity":"2"}]', '2018-01-06 13:33:31', 1, 1),
(73, '[{"id":"9","size":"kgs","quantity":"1"}]', '2018-01-06 13:41:24', 1, 1),
(74, '[{"id":"11","size":"Pieces","quantity":"2"}]', '2018-01-06 13:44:25', 1, 1),
(75, '[{"id":"13","size":"Pieces","quantity":"1"}]', '2018-01-06 13:49:15', 1, 1),
(76, '[{"id":"24","size":"Piece","quantity":"1"},{"id":"26","size":"Pieces","quantity":"1"},{"id":"27","size":"Packets","quantity":"2"},{"id":"12","size":"kgs","quantity":2},{"id":"9","size":"kgs","quantity":"1"}]', '2018-01-06 15:44:02', 1, 1),
(77, '[{"id":"24","size":"Piece","quantity":"1"}]', '2018-01-06 15:55:54', 0, 0),
(78, '[{"id":"12","size":"kgs","quantity":"1"}]', '2018-01-06 16:00:53', 1, 1),
(79, '[{"id":"13","size":"Pieces","quantity":"1"}]', '2018-01-06 17:16:45', 1, 1),
(80, '[{"id":"27","size":"Packets","quantity":"1"}]', '2018-01-06 17:22:23', 1, 1),
(81, '[{"id":"30","size":"Pieces","quantity":"1"}]', '2018-01-06 17:30:15', 1, 1),
(82, '[{"id":"38","size":"kgs","quantity":2}]', '2018-01-06 18:10:42', 1, 1),
(83, '[{"id":"9","size":"kgs","quantity":"1"}]', '2018-01-06 18:27:13', 1, 1),
(85, '[{"id":"44","size":"Combos","quantity":"1"}]', '2018-01-07 13:29:23', 0, 0),
(86, '[{"id":"45","size":"Sets","quantity":"2"}]', '2018-01-10 13:24:08', 0, 0),
(88, '[{"id":"9","size":"kgs","quantity":2}]', '2018-01-10 19:09:25', 0, 0),
(89, '[{"id":"40","size":"kgs","quantity":"1"}]', '2018-01-12 06:54:43', 0, 0),
(92, '[{"id":"12","size":"kgs","quantity":"1"}]', '2018-01-14 16:12:13', 1, 1),
(93, '[{"id":"26","size":"Pieces","quantity":"1"}]', '2018-01-14 16:17:14', 1, 1),
(94, '[{"id":"40","size":"kgs","quantity":"1"},{"id":"11","size":"Pieces","quantity":"1"}]', '2018-01-14 16:27:45', 1, 1),
(95, '[{"id":"46","size":"Combos","quantity":3}]', '2018-01-14 16:37:23', 1, 1),
(96, '[{"id":"47","size":"Sets","quantity":"2"}]', '2018-01-14 16:41:14', 1, 1),
(97, '[{"id":"27","size":"Packets","quantity":"1"},{"id":"26","size":"Pieces","quantity":1},{"id":"25","size":"Pieces","quantity":2}]', '2018-01-14 16:45:48', 1, 1),
(98, '[{"id":"12","size":"kgs","quantity":"1"},{"id":"11","size":"Pieces","quantity":"1"}]', '2018-01-14 17:00:23', 1, 1),
(99, '[{"id":"12","size":"kgs","quantity":"1"},{"id":"11","size":"Pieces","quantity":"1"}]', '2018-01-14 17:06:54', 1, 1),
(100, '[{"id":"17","size":"Pieces","quantity":"1"},{"id":"16","size":"Pieces","quantity":"1"}]', '2018-01-14 17:09:01', 1, 1),
(101, '[{"id":"31","size":"kgs","quantity":"2"},{"id":"42","size":"pieces","quantity":"1"},{"id":"13","size":"Pieces","quantity":"1"}]', '2018-01-14 17:24:48', 1, 1),
(102, '[{"id":"10","size":"Pieces","quantity":"1"},{"id":"14","size":"kgs","quantity":"1"}]', '2018-01-14 17:31:57', 1, 1),
(103, '[{"id":"35","size":"kgs","quantity":"1"},{"id":"33","size":"kgs","quantity":"1"},{"id":"10","size":"Pieces","quantity":"1"}]', '2018-01-14 18:14:19', 1, 1),
(104, '[{"id":"45","size":"Sets","quantity":"2"},{"id":"33","size":"kgs","quantity":"1"},{"id":"9","size":"kgs","quantity":"1"}]', '2018-01-14 18:29:04', 1, 0),
(105, '[{"id":"19","size":"Pieces","quantity":"2"},{"id":"29","size":"Pieces","quantity":2},{"id":"38","size":"kgs","quantity":"1"}]', '2018-01-14 18:49:20', 1, 0),
(106, '[{"id":"44","size":"Combos","quantity":1},{"id":"46","size":"Combos","quantity":"1"}]', '2018-01-14 18:52:15', 1, 1),
(107, '[{"id":"13","size":"Pieces","quantity":"2"},{"id":"10","size":"Pieces","quantity":"1"}]', '2018-01-14 19:08:06', 1, 0),
(108, '[{"id":"38","size":"kgs","quantity":"1"},{"id":"37","size":"kgs","quantity":2},{"id":"36","size":"kgs","quantity":"1"}]', '2018-01-15 06:02:07', 1, 0),
(109, '[{"id":"14","size":"kgs","quantity":"1"},{"id":"47","size":"Sets","quantity":"1"},{"id":"15","size":"kgs","quantity":"2"}]', '2018-01-15 11:34:33', 1, 0),
(110, '[{"id":"49","size":"PIeces","quantity":"1"},{"id":"38","size":"kgs","quantity":"2"}]', '2018-01-16 20:59:00', 1, 0),
(111, '[{"id":"12","size":"kgs","quantity":2},{"id":"34","size":"kgs","quantity":2},{"id":"19","size":"Pieces","quantity":"1"},{"id":"51","size":"kgs","quantity":"1"},{"id":"57","size":"Packets","quantity":2},{"id":"56","size":"Packets","quantity":"1"},{"id":"53","size":"Packets","quantity":"1"}]', '2018-01-17 04:56:57', 1, 0),
(112, '[{"id":"56","size":"Packets","quantity":"1"},{"id":"14","size":"Packets","quantity":"2"},{"id":"19","size":"Pieces","quantity":"1"}]', '2018-01-17 05:56:26', 1, 0),
(115, '[{"id":"10","size":"Pieces","quantity":1}]', '2018-01-18 09:52:31', 1, 0),
(116, '[{"id":"14","size":"Packets","quantity":"1"}]', '2018-01-18 15:44:58', 1, 0),
(123, '[{"id":"28","size":"Packets","quantity":"2"}]', '2018-01-19 11:48:27', 0, 0),
(124, '[{"id":"10","size":"Pieces","quantity":2}]', '2018-09-14 14:20:14', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `parent`) VALUES
(41, 'Food', 0),
(42, 'Fruits &amp; Vegetables', 41),
(43, 'Snacks', 41),
(45, 'Meat &amp; Fish', 41),
(46, 'Home &amp; Cleaning', 0),
(47, 'Pest Control &amp; Food Storage', 46),
(48, 'Laundry &amp; Napkins', 46),
(50, 'Office Products', 0),
(51, 'Batteries', 50),
(52, 'Printing', 50),
(53, 'Baby Care', 0),
(54, 'Fooding', 53),
(55, 'Bath &amp; Skincare', 53),
(56, 'Special offers', 0),
(57, 'Combos', 56),
(58, 'Grocery', 0),
(59, 'Free Offers', 56),
(60, 'chaldal', 58);

-- --------------------------------------------------------

--
-- Table structure for table `customer2`
--

CREATE TABLE IF NOT EXISTS `customer2` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(175) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer2`
--

INSERT INTO `customer2` (`id`, `name`, `email`, `mobile`, `password`, `address`, `image`) VALUES
(1, 'ahsan', 'ahsan123@gmail.com', '01914436796', 'ahsan123', 'good', NULL),
(2, 'ashiq', 'ashiq097@gmail.com', '01914436796', 'ashiq097', 'sadd', NULL),
(3, 'Nazmul', 'Nazmul123@outlook.com', '01521218701', 'Nazmul123', 'khilgaon,Dhaka-1202', NULL),
(4, 'Ashiqur Rahman', 'ashiq070@gmail.com', '019144367', 'ashiq080', 'Mohakhali, Dhaka - 12', 'ashiq3.PNG'),
(5, 'Rashad Ahmad', 'rashad123@gmail.com', '01521218701', 'rashad123', 'Mirpur-Dahaka-1202', NULL),
(6, 'Rashad', 'rash@gmail.com', '+8801744398865', '012012012', 'Mirpurrrsdfdsfdsfsd', 'rashad.PNG'),
(7, 'Ashique', 'ashique@gmail.com', '01948385781', '023023023', 'Faridpur', NULL),
(8, 'Nazmul Ahasan', 'nrejve@hotmail.com', '01788254100', 'riZvi123', 'Modhubag, Mogbazar, Dhaka', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grouping`
--

CREATE TABLE IF NOT EXISTS `grouping` (
  `id` int(11) NOT NULL,
  `group_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `grouping`
--

INSERT INTO `grouping` (`id`, `group_name`) VALUES
(1, 'Fresh Vegetables'),
(2, 'Fresh Fruits'),
(3, 'Special offers'),
(4, 'Fresh Fish'),
(5, 'Meat'),
(6, 'Frozen mf'),
(7, 'Noodles'),
(8, 'Soft Drinks'),
(9, 'Biscuits'),
(10, 'pest control'),
(11, 'food storage'),
(12, 'laundry'),
(13, 'napkins'),
(16, 'batteries'),
(20, 'paper'),
(21, 'toner and ink'),
(22, 'babymilk'),
(23, 'breadjelly'),
(24, 'babybath'),
(25, 'babyskin'),
(26, 'chaldal');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `list_price` decimal(10,2) NOT NULL,
  `brand` int(11) NOT NULL,
  `categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `sizes` text COLLATE utf8_unicode_ci NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `u_Amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `grouping` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `featured`, `sizes`, `deleted`, `u_Amount`, `grouping`) VALUES
(9, 'Cow Meat ', '400.00', '0.00', 0, '45', '/Dailyneeds/images/products/cow.jpg', 'very good', 1, 'kgs:3:1', 0, '1 kg', 5),
(10, 'Chicken', '180.00', '200.00', 22, '45', '/Dailyneeds/images/products/chicken.jpg', 'Very Good', 1, 'Pieces:0:2', 0, '1 piece', 5),
(11, 'Bedana', '50.00', '70.00', 17, '42', '/Dailyneeds/images/products/bedana.jpg', 'Very Good', 1, 'Pieces:4:2', 0, '1 piece', 2),
(12, 'Black Grapes', '200.00', '230.00', 17, '42', '/Dailyneeds/images/products/grapes.jpg', 'Very Good', 1, 'kgs:4:2', 0, '1 kg', 2),
(13, 'Shosha', '30.00', '32.00', 17, '42', '/Dailyneeds/images/products/shosha.png', 'Very Good', 0, 'kgs:4:2', 0, '1 kg', 1),
(14, 'Lexus Biscuit', '100.00', '120.00', 19, '43', '/Dailyneeds/images/products/lexus_biscuit.jpg', 'Very Good', 1, 'Packets:1:2', 0, '1 packet', 9),
(15, 'Carrot', '30.00', '34.00', 17, '42', '/Dailyneeds/images/products/carrot.jpg', 'very good', 0, 'kgs:3:2', 0, '1 kg', 1),
(16, 'Lunch Box', '60.00', '70.00', 17, '47', '/Dailyneeds/images/products/lunchbox3layer.jpeg', 'very Good', 1, 'Pieces:3:2', 0, '1 piece', 11),
(17, 'Water Jar', '50.00', '60.00', 17, '47', '/Dailyneeds/images/products/waterjar.jpg', 'Very Good', 1, 'Pieces:4:2', 0, '1 piece', 11),
(19, 'Surf Excel', '30.00', '40.00', 17, '48', '/Dailyneeds/images/products/surfexcel.jpg', 'Very Good', 1, 'Pieces:2:2', 0, '1 piece', 12),
(20, 'Keya Soap', '25.00', '30.00', 17, '48', '/Dailyneeds/images/products/keyasoap.jpg', 'Very Good', 1, 'Pieces:2:2', 0, '1 piece', 12),
(22, 'Naptholine', '10.00', '12.00', 18, '47', '/Dailyneeds/images/products/pest2.jpeg', 'Very Good', 0, 'Packets:4:2', 0, '1 packet', 10),
(23, 'Mosquito Bat', '200.00', '220.00', 18, '47', '/Dailyneeds/images/products/pest3.jpeg', 'Very Good', 0, 'Pieces:3:2', 0, '1 piece', 10),
(24, 'Samsung Laser Toner', '500.00', '600.00', 17, '52', '/Dailyneeds/images/products/pri2.jpg', 'Very Good', 0, 'Piece:2:2', 0, '1 piece', 21),
(25, 'Double A4 Paper', '40.00', '50.00', 17, '52', '/Dailyneeds/images/products/pri1.jpg', 'Very Good', 0, 'Packets:2:1', 0, '1 packet', 20),
(26, 'Energizer Battery', '10.00', '12.00', 18, '51', '/Dailyneeds/images/products/bat2.jpg', 'Very Good', 1, 'Pieces:1:1', 0, '1 piece', 16),
(27, 'Cerelac', '200.00', '250.00', 20, '54', '/Dailyneeds/images/products/cerelac.jpg', 'Very Good', 1, 'Packets:3:1', 0, '1 packet', 22),
(28, 'Pediasure', '300.00', '320.00', 20, '54', '/Dailyneeds/images/products/pedia.jpg', 'Very Good', 1, 'Packets:4:2', 0, '1 packet', 22),
(29, 'Johnsons Baby Soap', '30.00', '35.00', 21, '55', '/Dailyneeds/images/products/bb1.jpg', 'Very Good', 0, 'Pieces:2:2', 0, '1 piece', 24),
(30, 'Johnsons Baby Lotion', '40.00', '45.00', 21, '55', '/Dailyneeds/images/products/bb2.jpg', 'Very Good', 0, 'Pieces:2:2', 0, '1 piece', 25),
(31, 'Mutton Meat', '600.00', '700.00', 17, '45', '/Dailyneeds/images/products/mutton.jpg', 'Very Good', 0, 'kgs:3:2', 0, '1 kg', 5),
(33, 'Sajeeb Soya Nugget', '200.00', '220.00', 19, '45', '/Dailyneeds/images/products/nugget.png', 'Very good', 0, 'Packets:2:2', 0, '1 packet', 6),
(34, 'Prawn Fish', '400.00', '450.00', 17, '45', '/Dailyneeds/images/products/prawn.jpg', 'Very Good', 1, 'kgs:4:2', 0, '1 kg', 4),
(35, 'Fish Fingers', '200.00', '230.00', 17, '45', '/Dailyneeds/images/products/fish_fingers.jpg', 'Very Good', 0, 'Packets:3:2', 0, '1 packet', 6),
(36, 'Katla Fish', '150.00', '180.00', 17, '45', '/Dailyneeds/images/products/katla.jpg', 'Very Good', 0, 'kgs:5:2', 0, '1 kg', 4),
(37, 'Kaski Fish', '100.00', '120.00', 17, '45', '/Dailyneeds/images/products/kaski.jpg', 'Very Good', 0, 'kgs:4:2', 0, '1 kg', 4),
(38, 'Mama Noodles', '20.00', '22.00', 19, '43', '/Dailyneeds/images/products/mama_noodles.jpg', 'Very Good', 0, 'Packets:2:2', 0, '1 Packet', 7),
(39, 'Pineapple', '40.00', '45.00', 18, '42', '/Dailyneeds/images/products/pineapple.jpg', 'Very Good', 0, 'pieces:6:2', 0, '1 piece', 2),
(40, 'Butter', '60.00', '65.00', 17, '54', '/Dailyneeds/images/products/butter.jpg', 'Very Good', 0, 'kgs:4:1', 0, '1 kg', 23),
(41, 'Jelly', '50.00', '55.00', 20, '54', '/Dailyneeds/images/products/jelly.jpg', 'Very Good', 0, 'Bottles:5:2', 0, '1 Bottle', 23),
(42, 'Spoon', '30.00', '35.00', 18, '52', '/Dailyneeds/images/products/spoon.jpg', 'Very Good', 0, 'pieces:4:2', 1, '1 piece', 0),
(43, 'Red Apple', '50.00', '60.00', 20, '42', '/Dailyneeds/images/products/apples.jpg', 'Very Good', 0, 'kg:5:2', 0, '1 kg', 2),
(44, 'Vegetables Combo', '500.00', '520.00', 20, '57', '/Dailyneeds/images/products/vegcombo.jpg', '2 kg Onions , 2 kg Potatos , 1 kg Tomato', 0, 'Combos:3:2', 0, '2 kg Potatos , 2 kg Onions , 1 kg Tomato', 3),
(45, 'Finis Harpick ', '50.00', '55.00', 20, '59', '/Dailyneeds/images/products/harpicfree.jpg', 'Buy 1 Finis Harpic and Get 1 Free', 0, 'Sets:3:2', 0, 'Buy 1 Get 1 Free', 3),
(46, 'Sauce Combo', '150.00', '170.00', 20, '57', '/Dailyneeds/images/products/saucecombo.png', 'Get 3 Bottle True Hot Tomato Sauces in Reasonable Price', 0, 'Combos:5:2', 0, '3 Bottle Sauces', 3),
(47, 'Clevedon Tea', '50.00', '55.00', 20, '59', '/Dailyneeds/images/products/clevedontea.jpg', 'Buy 1 Clevedon Tea and Get a Mug Free', 0, 'Sets:2:2', 0, '1 Packet Clevedon Tea (Mug Free)', 3),
(48, 'Nocilla', '40.00', '45.00', 20, '54', '/Dailyneeds/images/products/nocilla.jpg', 'Good', 0, 'Pieces:6:2', 0, '1 piece', 23),
(49, 'Fulkopi', '20.00', '30.00', 19, '42', '/Dailyneeds/images/products/fulkopi.jpg', 'Very Good', 0, 'PIeces:2:1', 0, '1 piece', 1),
(50, 'Tomato ', '40.00', '45.00', 19, '42', '/Dailyneeds/images/products/tomato.jpg', 'Very Good', 0, 'kgs:3:1', 0, '1 kg', 1),
(51, 'Mango ', '200.00', '220.00', 18, '42', '/Dailyneeds/images/products/mango.jpg', 'Very Good', 0, 'kgs:4:2', 0, '1 kg', 2),
(52, 'Coca Cola', '60.00', '65.00', 17, '43', '/Dailyneeds/images/products/cokee.jpg', 'Very Good', 1, 'Litres:5:2', 0, '1 litre', 8),
(53, 'Berries Biscuit', '50.00', '55.00', 18, '43', '/Dailyneeds/images/products/berries_biscuit.jpg', 'Very Good', 0, 'Packets:2:1', 0, '1 packet', 9),
(54, 'Cocola Noodles', '20.00', '25.00', 17, '43', '/Dailyneeds/images/products/cocola.jpg', 'Very Good', 0, 'Packets:4:2', 0, '1 packet', 7),
(55, 'Fanta', '50.00', '55.00', 17, '43', '/Dailyneeds/images/products/fanta2.jpg', 'Very Good', 0, 'Litres:3:1', 0, '1 litre', 8),
(56, 'Energy Biscuit', '20.00', '22.00', 20, '43', '/Dailyneeds/images/products/energy_biscuit.jpg', 'Very Good', 0, 'Packets:2:2', 0, '1 packet', 9),
(57, 'Maggi Noodles', '20.00', '26.00', 17, '43', '/Dailyneeds/images/products/magi_noodles.jpg', 'Very Good', 0, 'Packets:2:2', 0, '1 packet', 7),
(58, 'Mountain Dew', '50.00', '55.00', 17, '43', '/Dailyneeds/images/products/mountain_dew.jpg', 'Very Good', 0, 'Litres:4:2', 0, '1 litre', 8),
(59, 'Kidney Beans', '200.00', '220.00', 18, '45', '/Dailyneeds/images/products/kidney_beans.jpg', 'Very Good', 0, 'Packets:4:2', 0, '1 packet', 6),
(60, 'Tiffin Box', '100.00', '120.00', 20, '47', '/Dailyneeds/images/products/lunchbox.jpg', 'Very Good', 0, 'Pieces:4:2', 1, '1 piece', 11),
(61, 'Potato', '30.00', '0.00', 0, '60', '/Dailyneeds/images/products/potato.jpg', 'very nutritious ', 0, 'kgs:20:2', 0, '1 kg', 26),
(62, 'Onion', '110.00', '0.00', 0, '60', '/Dailyneeds/images/products/onion.jpg', 'very good', 0, 'kgs:15:2', 0, '1 kg', 26),
(63, 'Morich', '60.00', '65.00', 0, '60', '/Dailyneeds/images/products/kachamorich.jpeg', 'very spicy', 0, 'kgs:8:1', 0, '1 kg', 26);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE IF NOT EXISTS `review` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `featured` tinyint(4) NOT NULL DEFAULT '0',
  `Date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`id`, `name`, `email`, `description`, `featured`, `Date`, `image`) VALUES
(1, 'Rashad', 'rash@gmail.com', 'Dailyneeds is a very good place to shop.\r\n', 1, '2017-12-20 10:54:28', 'rashad.PNG'),
(2, 'Ashique', 'ashique@gmail.com', 'I had a really good experience shopping at dailyneeds', 0, '2017-12-18 10:53:02', NULL),
(3, 'Ashiqur Rahman', 'ashiq070@gmail.com', 'Satisfied by their professionalism ! Got my tea bags in time. Didn&#039;t have to pay any delivery charge. I can&#039;t believe that. Keep it up!!\r\n', 1, '2017-12-20 15:17:31', 'ashiq3.PNG'),
(4, 'Nazmul Ahasan', 'nrejve@hotmail.com', 'Very excellent shopping experience', 1, '2017-12-19 14:30:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL,
  `charge_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cart_id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(175) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(175) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip_code` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(175) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `txn_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `txn_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `charge_id`, `cart_id`, `full_name`, `email`, `street`, `street2`, `city`, `state`, `zip_code`, `country`, `sub_total`, `tax`, `grand_total`, `description`, `txn_type`, `txn_date`) VALUES
(1, 'ch_1BUf29AEONwVQHTuXiwBXAdo', 20, 'Ashiqur Rahman', 'ashiq070@gmail.com', 'Gulshan', 'Mohakhali', 'Gulshan', 'Bir uttom', '1212', 'Dhaka', '60.00', '0.06', '60.06', '1 item from Daily needs.', 'charge', '2017-12-02 23:44:16'),
(2, 'ch_1BUu29AEONwVQHTuisndJjD4', 21, 'Rashad Akhter', 'ashiq070@gmail.com', 'Benaroshi', 'polli 5', 'north', 'original 10', '1203', 'Dhaka', '70.00', '6.09', '76.09', '3 items from Daily needs.', 'charge', '2017-12-03 15:45:14'),
(3, 'ch_1BVLT3AEONwVQHTumw327bsV', 33, 'ashiq', 'ashiq070@gmail.com', 'aj2', 'ab3', 'Dhaka', 'unisd', '1212', 'Bangladesh', '20.00', '0.02', '20.02', '2 items from Daily needs.', 'charge', '2017-12-04 21:02:50'),
(4, 'ch_1BVtgPAEONwVQHTuwmGiTd27', 51, 'Ashiq Ahmad', 'ashiq070@gmail.com', 'Dhaka11', 'Dhaka12', 'Dhaka', 'Dhaka', '1212', 'Bangladesh', '100.00', '0.10', '100.10', '2 items from Daily needs.', 'charge', '2017-12-06 09:34:43'),
(5, 'ch_1BWFIpAEONwVQHTuTUWKEHUW', 64, 'sadad', 'ashiq097@gmail.com', 'sadasd', 'sdsad', 'sadsad', 'sadsad', 'sadsad', 'sasdsa', '50.00', '0.05', '50.05', '1 item from Daily needs.', 'charge', '2017-12-07 08:39:59'),
(6, 'ch_1BWFPyAEONwVQHTurV4mgKxl', 65, 'hello', 'ashiq097@gmail.com', 'sadsad', 'sdsad', 'sdad', 'sadsad', 'asdsadf', 'sdsad', '100.00', '0.10', '100.10', '2 items from Daily needs.', 'charge', '2017-12-07 08:47:23'),
(7, 'ch_1BWFTsAEONwVQHTurmhCgBI9', 67, 'dfas', 'ashiq096@gmail.com', 'sdfds', 'dfsdf', 'dsfsd', 'dfdsf', 'dfdsf', 'dsfds', '50.00', '0.05', '50.05', '1 item from Daily needs.', 'charge', '2017-12-07 08:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

CREATE TABLE IF NOT EXISTS `user_transactions` (
  `id` int(11) NOT NULL,
  `charge_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cart_id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `sub_total` decimal(10,2) NOT NULL,
  `tax` decimal(10,2) NOT NULL,
  `grand_total` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `txn_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `txn_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_transactions`
--

INSERT INTO `user_transactions` (`id`, `charge_id`, `cart_id`, `full_name`, `email`, `mobile`, `address`, `sub_total`, `tax`, `grand_total`, `description`, `txn_type`, `txn_date`) VALUES
(1, 'sad', 1, 'sdad', 'sadsa', 'sdas', 'sadsa', '12.00', '123.00', '12.00', 'sadsd', 'curere', '2017-12-07 08:53:05'),
(2, 'ch_1BWGBfAEONwVQHTuZyfBOK0x', 68, 'Ashiqur RAhman', 'ashiq097@gmail.com', '01914436796', 'Mohakhali', '50.00', '0.05', '50.05', '1 item from Daily needs.', 'charge', '2017-12-07 09:36:40'),
(3, 'ch_1BWGMlAEONwVQHTuQEsOjvgp', 69, 'Nazmul', 'Nazmul123@outlook.com', '01521218701', 'khilgaon,Dhaka-1202', '70.00', '0.07', '70.07', '1 item from Daily needs.', 'charge', '2017-12-07 09:48:07'),
(4, 'ch_1BWGirAEONwVQHTughpDvI19', 70, 'Nazmul', 'Nazmul123@outlook.com', '01521218701', 'khilgaon,Dhaka-1202', '300.00', '12.00', '312.00', '3 items from Daily needs.', 'charge', '2017-12-07 10:10:58'),
(5, 'ch_1BWOdlAEONwVQHTuLLMZV4lf', 72, 'Ashiq ibn Faruk', 'ashiq097@gmail.com', '01914436796', 'Mohakhali Dhaka 1212', '300.00', '12.00', '312.00', '3 items from Daily needs.', 'charge', '2017-12-07 18:37:58'),
(6, 'ch_1BWOi3AEONwVQHTufJK2hMKG', 73, 'ashiq', 'ashiq097@gmail.com', '01914436796', 'Dhaka', '400.00', '16.00', '416.00', '1 item from Daily needs.', 'charge', '2017-12-07 18:42:24'),
(7, 'ch_1BWOl7AEONwVQHTukpYUBZyb', 74, 'Ashiq ibn Faruk', 'ashiq097@gmail.com', '01914436796', 'Dhaka', '100.00', '4.00', '104.00', '2 items from Daily needs.', 'charge', '2017-12-07 18:45:33'),
(8, 'ch_1BWOpEAEONwVQHTuRXcPZSVh', 75, 'ashiq', 'ashiq097@gmail.com', '01914436796', 'sadd', '70.00', '2.80', '72.80', '1 item from Daily needs.', 'charge', '2017-12-07 18:49:49'),
(9, 'ch_1BWQjgAEONwVQHTubtQKH1QM', 76, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '1710.00', '68.40', '1778.40', '7 items from Daily needs.', 'charge', '2017-12-07 20:52:25'),
(10, 'ch_1BWQuOAEONwVQHTu1QZKdeBA', 78, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '200.00', '8.00', '208.00', '1 item from Daily needs.', 'charge', '2017-12-07 21:03:30'),
(11, 'ch_1BWS47AEONwVQHTuuJdxxjDC', 79, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '70.00', '2.80', '72.80', '1 item from Daily needs.', 'charge', '2017-12-07 22:17:37'),
(12, 'ch_1BWS9TAEONwVQHTuNcQtP9Bc', 80, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '200.00', '8.00', '208.00', '1 item from Daily needs.', 'charge', '2017-12-07 22:23:09'),
(13, 'ch_1BWSGsAEONwVQHTuW38g9IbZ', 81, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '40.00', '1.60', '41.60', '1 item from Daily needs.', 'charge', '2017-12-07 22:30:47'),
(14, 'ch_1BWSuBAEONwVQHTugw3uWVnF', 82, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '60.00', '2.40', '62.40', '2 items from Daily needs.', 'charge', '2017-12-07 23:11:24'),
(15, 'ch_1BWTBCAEONwVQHTubA0dkeBx', 83, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '400.00', '16.00', '416.00', '1 item from Daily needs.', 'charge', '2017-12-07 23:28:59'),
(16, 'ch_1BZKsZAEONwVQHTu65i93g06', 92, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '200.00', '8.00', '208.00', '1 item from Daily needs.', 'charge', '2017-12-15 21:13:36'),
(17, 'ch_1BZKwhAEONwVQHTuiaoHakA8', 93, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '10.00', '0.40', '10.40', '1 item from Daily needs.', 'charge', '2017-12-15 21:17:53'),
(18, 'ch_1BZL6xAEONwVQHTuWMrxCqUc', 94, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '110.00', '4.40', '114.40', '2 items from Daily needs.', 'charge', '2017-12-15 21:28:30'),
(19, 'ch_1BZLGWAEONwVQHTuNOL6LWiJ', 95, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '450.00', '18.00', '468.00', '3 items from Daily needs.', 'charge', '2017-12-15 21:38:21'),
(20, 'ch_1BZLKFAEONwVQHTuDufHdaC6', 96, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '100.00', '4.00', '104.00', '2 items from Daily needs.', 'charge', '2017-12-15 21:42:13'),
(21, 'ch_1BZLOZAEONwVQHTuiOXgiGe9', 97, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '290.00', '11.60', '301.60', '4 items from Daily needs.', 'charge', '2017-12-15 21:46:40'),
(22, 'ch_1BZLcNAEONwVQHTu5qZGUHwE', 98, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '250.00', '10.00', '260.00', '2 items from Daily needs.', 'charge', '2017-12-15 22:00:56'),
(23, 'ch_1BZLiyAEONwVQHTuVQpOml36', 99, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '250.00', '10.00', '260.00', '2 items from Daily needs.', 'charge', '2017-12-15 22:07:45'),
(24, 'ch_1BZLkgAEONwVQHTufLti8Tdp', 100, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '110.00', '4.40', '114.40', '2 items from Daily needs.', 'charge', '2017-12-15 22:09:31'),
(25, 'ch_1BZM0FAEONwVQHTuLvS7KgtH', 101, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '1300.00', '52.00', '1352.00', '4 items from Daily needs.', 'charge', '2017-12-15 22:25:36'),
(26, 'ch_1BZM70AEONwVQHTui9leZjEi', 102, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '210.00', '8.40', '218.40', '2 items from Daily needs.', 'charge', '2017-12-15 22:32:35'),
(27, 'ch_1BZMmHAEONwVQHTuqV3S5f6b', 103, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '580.00', '23.20', '603.20', '3 items from Daily needs.', 'charge', '2017-12-15 23:15:14'),
(28, 'ch_1BZN0AAEONwVQHTuUwn68IaV', 104, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '700.00', '28.00', '728.00', '4 items from Daily needs.', 'charge', '2017-12-15 23:29:35'),
(29, 'ch_1BZNJzAEONwVQHTuWNdui1d6', 105, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '150.00', '6.00', '156.00', '5 items from Daily needs.', 'charge', '2017-12-15 23:50:04'),
(30, 'ch_1BZNMuAEONwVQHTulQMkeO7i', 106, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '650.00', '26.00', '676.00', '2 items from Daily needs.', 'charge', '2017-12-15 23:53:05'),
(31, 'ch_1BZNc4AEONwVQHTusv20dCyL', 107, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '320.00', '12.80', '332.80', '3 items from Daily needs.', 'charge', '2017-12-16 00:08:49'),
(32, 'ch_1BZXs3AEONwVQHTuWWGA6mz8', 108, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '380.00', '15.20', '395.20', '4 items from Daily needs.', 'charge', '2017-12-16 11:05:58'),
(33, 'ch_1BZd17AEONwVQHTuN5sKPhtN', 109, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '680.00', '27.20', '707.20', '4 items from Daily needs.', 'charge', '2017-12-16 16:35:40'),
(34, 'ch_1Ba8K5AEONwVQHTuiYd71JtJ', 110, 'Ashique', 'ashique@gmail.com', '01948385781', 'Faridpur', '80.00', '3.20', '83.20', '3 items from Daily needs.', 'charge', '2017-12-18 02:01:22'),
(35, 'ch_1BaFm4AEONwVQHTuuJOC9PmX', 111, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '1540.00', '61.60', '1601.60', '10 items from Daily needs.', 'charge', '2017-12-18 09:58:43'),
(36, 'ch_1BaGhZAEONwVQHTuQCmECOxV', 112, 'Ashiqur Rahman', 'ashiq070@gmail.com', '01914436796', 'Mohakhali, Dhaka - 1212', '250.00', '10.00', '260.00', '4 items from Daily needs.', 'charge', '2017-12-18 10:58:03'),
(37, 'ch_1BamJBAEONwVQHTubthpNZO4', 115, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '180.00', '7.20', '187.20', '1 item from Daily needs.', 'charge', '2017-12-19 20:43:07'),
(38, 'ch_1BamLSAEONwVQHTuciNukbNs', 116, 'Rashad', 'rash@gmail.com', '+8801744398865', 'Mirpur', '100.00', '4.00', '104.00', '1 item from Daily needs.', 'charge', '2017-12-19 20:45:28'),
(39, 'ch_1CzODOAEONwVQHTuQfAOvhow', 124, 'ashiq', 'ashiq097@gmail.com', '01914436796', 'Mohakhali', '360.00', '14.40', '374.40', '2 items from Daily needs.', 'charge', '2018-08-15 18:35:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer2`
--
ALTER TABLE `customer2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grouping`
--
ALTER TABLE `grouping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `customer2`
--
ALTER TABLE `customer2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `grouping`
--
ALTER TABLE `grouping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
