-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 20, 2015 at 05:35 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `owleats`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
`id` int(6) NOT NULL,
  `firstname` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `firstname`, `lastname`, `email`, `phone`, `username`, `password`) VALUES
(1, 'Nick', 'Robinson', 'tue63367@temple.edu', '2147483647', 'tue63367', 'password'),
(3, 'Courtney', 'Wise', 'tue66667@temple.edu', '123456789', 'courtneyd', 'password'),
(4, 'Bart', 'Simpson', 'tue62347@temple.edu', '2145551245', 'bart', 'password'),
(5, 'Nick', 'Robinson', 'jdsaklfjdlk', '5555555', 'tue63367', 'test'),
(6, 'testing', 'testing', 'testing', 'testing', 'testing', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
`id` int(6) NOT NULL,
  `vendor_id` int(6) DEFAULT NULL,
  `menu_id` int(6) DEFAULT NULL,
  `order_id` int(6) DEFAULT NULL,
  `customer_id` int(6) DEFAULT NULL,
  `quantity` varchar(100) NOT NULL,
  `notes` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `vendor_id`, `menu_id`, `order_id`, `customer_id`, `quantity`, `notes`) VALUES
(29, 3, 3, 32, 1, '', ''),
(30, 3, 3, 32, 1, '', ''),
(31, 4, 7, 35, 1, '', ''),
(32, 4, 6, 35, 1, '', ''),
(33, 2, 5, 37, 1, '', ''),
(34, 2, 4, 37, 1, '', ''),
(35, 2, 4, 39, 1, '1', ''),
(36, 2, 5, 39, 1, '7', ''),
(37, 3, 11, 40, 1, '3', ''),
(38, 3, 8, 40, 1, '3', ''),
(39, 2, 4, 41, 1, '1', '3'),
(40, 2, 5, 41, 1, '3', ''),
(41, 3, 3, 42, 1, '2', 'extra milk'),
(42, 3, 11, 42, 1, '1', 'with onions'),
(43, 3, 8, 42, 1, '1', ''),
(46, 4, 7, 44, 1, '3', 'dfd'),
(47, 3, 11, 45, 1, '1', 'nkl'),
(48, 3, 8, 45, 1, '1', '111'),
(49, 4, 7, 46, 1, '1', 'esdc'),
(50, 3, 10, 47, 1, '1', 'sss'),
(51, 3, 13, 47, 1, '1', 'ssss'),
(52, 3, 3, 47, 1, '1', 'ssss'),
(53, 4, 6, 48, 5, '1', 'dsaf'),
(54, 4, 7, 48, 5, '1', 'dsafd'),
(55, 2, 4, 49, 5, '1', ''),
(56, 3, 12, 50, 5, '2', 'dfsaf'),
(57, 3, 14, 50, 5, '1', 'sadfd'),
(58, 3, 8, 51, 5, '1', ''),
(59, 3, 13, 51, 5, '1', ''),
(60, 3, 15, 51, 5, '1', ''),
(61, 3, 3, 52, 5, '1', 'please work'),
(62, 3, 2, 52, 5, '1', ''),
(63, 3, 3, 53, 5, '1', ''),
(65, 3, 12, 53, 5, '1', ''),
(66, 4, 6, 54, 4, '2', ''),
(67, 4, 7, 54, 4, '7', ''),
(68, 3, 16, 55, NULL, '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE IF NOT EXISTS `menus` (
`id` int(6) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `foodtype` varchar(200) DEFAULT NULL,
  `vendor_id` int(6) DEFAULT NULL,
  `price` varchar(20) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `foodtype`, `vendor_id`, `price`) VALUES
(2, 'Pizza', 'Lunch', 3, '2.25'),
(3, 'Chocolate Milk', 'Beverages', 3, '1.75'),
(4, 'Breakfast Wrap', 'Breakfast', 2, '5.00'),
(5, 'Coffee', 'Beverages', 2, '1.50'),
(6, 'Buffalo Chicken Panini', 'Lunch', 4, '5.75'),
(7, 'Fettucini Alfredo', 'Lunch', 4, '7.50'),
(8, 'Water', 'Beverages', 3, '1.00'),
(9, 'Iced Tea', 'Beverages', 3, '1.50'),
(10, 'Water', 'Lunch', 3, '1.00'),
(11, 'Cheeseburger', 'Lunch', 3, '4.00'),
(12, 'Hoagie', 'Lunch', 3, '5.50'),
(13, 'Chicken Wrap', 'Lunch', 3, '4.00'),
(14, 'Salad', 'Lunch', 3, '6.00'),
(15, 'French Fries', 'Sides', 3, '1.50'),
(16, 'Fruit Juice', 'Beverages', 3, '2.00');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`id` int(6) NOT NULL,
  `vendor_id` int(6) DEFAULT NULL,
  `customer_id` int(6) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `vendor_id`, `customer_id`, `status`, `timestamp`) VALUES
(33, 3, 1, 'New Order', '2015-04-11 15:26:54'),
(34, 3, 1, 'New Order', '2015-04-11 15:27:00'),
(35, 4, 1, 'New Order', '2015-04-11 15:27:52'),
(36, 4, 1, 'New Order', '2015-04-11 15:48:55'),
(37, 2, 1, 'Ready for Pickup', '2015-04-12 19:22:47'),
(38, 2, 1, 'Canceled', '2015-04-12 20:50:36'),
(39, 2, 1, 'Ready for Pickup', '2015-04-13 23:09:33'),
(40, 3, 1, 'In Progress', '2015-04-13 23:50:50'),
(41, 2, 1, 'Ready for Pickup', '2015-04-13 23:52:02'),
(42, 3, 1, 'In Progress', '2015-04-14 01:47:56'),
(43, 3, 1, 'New Order', '2015-04-14 02:08:50'),
(44, 4, 1, 'In Progress', '2015-04-14 18:09:40'),
(45, 3, 1, 'Canceled', '2015-04-16 18:35:49'),
(46, 4, 1, 'New Order', '2015-04-17 03:31:59'),
(47, 3, 1, 'Canceled', '2015-04-17 03:42:00'),
(48, 4, 5, 'New Order', '2015-04-17 04:39:47'),
(49, 2, 5, 'New Order', '2015-04-17 04:47:27'),
(50, 3, 5, 'New Order', '2015-04-17 18:57:00'),
(51, 3, 5, 'New Order', '2015-04-17 20:04:32'),
(52, 3, 5, 'New Order', '2015-04-17 20:56:52'),
(53, 3, 5, 'New Order', '2015-04-17 22:29:36'),
(54, 4, 4, 'Ready for Pickup', '2015-04-19 13:24:02'),
(55, 3, NULL, 'New Order', '2015-04-19 19:50:57');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE IF NOT EXISTS `vendors` (
`id` int(6) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `location` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `name`, `location`, `email`, `phone`, `username`, `password`) VALUES
(2, 'Richies Deli and pizza', '1835 N. 12th St', 'richiesdeli@temple.edu', '2157652656', 'itsrichies', 'itsrichies'),
(3, 'Eddies Truck', '13th and Montgomery', NULL, '2157638028', 'eddies', 'eddies'),
(4, 'Sexy Green Truck', 'N11th and Montgomery Ave', NULL, '2672697173', 'sexygreen', 'sexygreen'),
(5, 'test', '1805 N 18th st', '', '5546613216', 'nick', 'nick');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
MODIFY `id` int(6) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
