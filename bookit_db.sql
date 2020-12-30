-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2020 at 05:43 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookit_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `amenity_id` int(11) NOT NULL,
  `amenity_name` varchar(100) DEFAULT NULL,
  `amenity_price` float(10,2) DEFAULT NULL,
  `amenity_type` enum('Hygiene','Foods','Drinks','Extras') DEFAULT NULL,
  `stock` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`amenity_id`, `amenity_name`, `amenity_price`, `amenity_type`, `stock`) VALUES
(1, 'Piattosss', 15.00, 'Foods', 109),
(2, 'Dove Conditioner', 10.00, 'Hygiene', 98),
(3, 'Sunsilk Shampoo', 8.00, 'Hygiene', 93),
(4, 'Sunsilk Conditioner', 8.00, 'Hygiene', 100),
(5, 'Nature Spring 350ml', 10.00, 'Drinks', 99),
(6, 'Nature Spring 500ml', 15.00, 'Drinks', 100),
(7, 'Pepsi 8oz', 10.00, 'Drinks', 100),
(8, 'Mirinda 8oz', 10.00, 'Drinks', 100),
(9, 'Mountain Dew 8oz', 10.00, 'Drinks', 100),
(10, 'Pepsi 12oz', 15.00, 'Drinks', 100),
(11, 'Mirinda 12oz', 15.00, 'Drinks', 100),
(12, 'Mountain Dew 12oz', 15.00, 'Drinks', 100),
(13, 'Pepsi 1L', 30.00, 'Drinks', -10000000),
(14, 'San Miguel Light 330ml', 50.00, 'Drinks', 100),
(15, 'San Miguel Pale Pilsen 320ml', 35.00, 'Drinks', 100),
(16, 'Piattos', 15.00, 'Foods', 100),
(17, 'Nova', 15.00, 'Foods', 98),
(18, 'Taquitos', 15.00, 'Foods', 100),
(19, 'Vcut', 15.00, 'Foods', 100),
(20, 'Clover', 15.00, 'Foods', 100),
(21, 'Dingdong', 12.00, 'Foods', 100),
(22, 'Kirie', 10.00, 'Foods', 100),
(23, 'Oishi', 10.00, 'Foods', 100),
(24, 'Cheese and Chips', 10.00, 'Foods', 100),
(25, 'Chippy', 10.00, 'Foods', 100),
(26, 'Patata', 10.00, 'Foods', 100),
(27, 'Baby Powder', 20.00, 'Foods', 100),
(28, 'Candy', 1.00, 'Foods', 100),
(29, 'Longsilog', 70.00, 'Foods', 9999999),
(30, 'Hotsilog', 70.00, 'Foods', 9999999),
(31, 'Cornsilog', 70.00, 'Foods', 9999999),
(32, 'Tunasilog', 70.00, 'Foods', 9999999),
(33, 'Pillows', 70.00, 'Extras', 9),
(34, 'Lights', 70.00, 'Extras', 4),
(35, 'burger', 24.00, 'Foods', 5),
(36, 'dove clay', 5.00, 'Hygiene', -10000000);

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` int(11) NOT NULL,
  `bill_date` date DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_id`, `bill_date`, `guest_id`) VALUES
(1, '2020-10-11', 1),
(2, '2020-10-11', 2),
(3, '2020-11-11', 3),
(4, '2020-11-13', 4),
(5, '2020-11-14', 5),
(6, '2020-12-15', 6),
(7, '2020-12-24', 7),
(8, '2020-12-26', 8),
(9, '2020-12-26', 9),
(10, '2020-12-27', 10),
(11, '2020-12-28', 11),
(12, '2020-12-28', 12),
(13, '2020-12-28', 13),
(14, '2020-12-28', 14),
(15, '2020-12-29', 15);

-- --------------------------------------------------------

--
-- Table structure for table `bill_items`
--

CREATE TABLE `bill_items` (
  `billitem_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `bill_id` int(11) DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `amenity_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bill_items`
--

INSERT INTO `bill_items` (`billitem_id`, `quantity`, `bill_id`, `bill_date`, `amenity_id`) VALUES
(1, 1, 1, NULL, 5),
(2, 1, 1, NULL, 8),
(3, 1, 1, NULL, 11),
(4, 2, 1, NULL, 29),
(5, 1, 2, NULL, 1),
(6, 1, 2, NULL, 3),
(7, 3, 2, NULL, 17),
(8, 2, 2, NULL, 25),
(9, 1, 3, NULL, 5),
(10, 1, 3, NULL, 8),
(11, 1, 3, NULL, 11),
(12, 2, 3, NULL, 29),
(13, 1, 4, NULL, 5),
(14, 1, 4, NULL, 8),
(15, 1, 4, NULL, 11),
(16, 2, 4, NULL, 29),
(17, 1, 5, NULL, 5),
(18, 1, 5, NULL, 8),
(19, 1, 5, NULL, 11),
(20, 2, 5, NULL, 29),
(21, 2, 7, NULL, 15),
(22, 2, 7, NULL, 16),
(23, 2, 7, NULL, 19),
(24, 2, 7, NULL, 22),
(25, 2, 7, NULL, 10),
(26, 2, 7, NULL, 4),
(27, 2, 7, NULL, 9),
(28, 6, 8, NULL, 15),
(29, 3, 8, NULL, 16),
(30, 5, 8, NULL, 19),
(31, 1, 8, NULL, 22),
(32, 3, 8, NULL, 10),
(33, 1, 6, NULL, 5),
(34, 1, 6, NULL, 8),
(35, 1, 6, NULL, 11),
(36, 2, 6, NULL, 29),
(37, 1, 1, '2020-12-24', 34),
(38, 1, 9, '2020-12-26', NULL),
(39, 1, 2, '2020-12-27', 1),
(40, 2, 2, '2020-12-27', 2),
(41, 1, 10, '2020-12-27', NULL),
(42, 4, 10, '2020-12-27', 3),
(43, 1, 10, '2020-12-27', 17),
(44, 2, 3, '2020-12-28', 2),
(45, 1, 11, '2020-12-28', NULL),
(46, 1, 12, '2020-12-28', NULL),
(47, 2, 3, '2020-12-28', 3),
(48, 1, 13, '2020-12-28', NULL),
(49, 1, 13, '2020-12-28', 17),
(50, 1, 14, '2020-12-28', NULL),
(51, 1, 3, '2020-12-28', 33),
(52, 1, 15, '2020-12-29', NULL),
(53, 2, 15, '2020-12-28', 2),
(54, 1, 15, '2020-12-28', 3),
(55, 1, 15, '2020-12-28', 5);

-- --------------------------------------------------------

--
-- Table structure for table `checked_in_guests`
--

CREATE TABLE `checked_in_guests` (
  `checked_in_id` int(11) NOT NULL,
  `paid_amount` float(10,2) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checked_in_guests`
--

INSERT INTO `checked_in_guests` (`checked_in_id`, `paid_amount`, `guest_id`) VALUES
(1, NULL, 9),
(2, NULL, 9),
(3, NULL, 10),
(4, NULL, 10),
(5, NULL, 11),
(6, NULL, 11),
(7, NULL, 12),
(8, NULL, 12),
(9, NULL, 13),
(10, NULL, 13),
(11, NULL, 15),
(12, NULL, 15);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `MI` varchar(5) DEFAULT NULL,
  `Address` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `fname`, `lname`, `MI`, `Address`, `email`, `phone`) VALUES
(1, 'Ana', 'Manalastas', 'Z', 'Philippines', 'dummyemail@gmail.com', '12345678999'),
(2, 'Ana', 'Manalastas', 'Z', 'Philippines', 'dummyemail@gmail.com', '12345678999'),
(3, 'Joey', 'De Leon', 'Z', 'Philippines', 'dummyemail@gmail.com', '12345678999'),
(4, 'Cardo', 'Dalisay', 'Z', 'Philippines', '', ''),
(5, 'Ador', 'Dalisay', 'Z', 'Philippines', '', ''),
(6, 'John', 'Doe', 'Z', 'America', 'dummyemail@gmail.com', '12345678999'),
(7, 'Naruto', 'Uzumaki', 'Z', 'Japan', '', ''),
(8, 'Yami', 'Sukihiro', 'Z', 'Japan', '', '654654'),
(9, 'Ana', 'Manalastas', 'Z', 'Philippines', 'dummyemail@gmail.com', '12345678999'),
(10, 'Ana', 'Manalastas', 'Z', 'Philippines', 'dummyemail@gmail.com', '12345678999'),
(11, 'Joey', 'De Leon', 'Z', 'Philippines', 'dummyemail@gmail.com', '12345678999'),
(12, 'Cardo', 'Dalisay', 'Z', 'Philippines', '', ''),
(13, 'Ador', 'Dalisay', 'Z', 'Philippines', '', ''),
(14, 'John', 'Doe', 'Z', 'America', 'dummyemail@gmail.com', '12345678999'),
(15, 'Naruto', 'Uzumaki', 'Z', 'Japan', '', ''),
(16, 'Yami', 'Sukihiro', 'Z', 'Japan', '', ''),
(17, '', '', '', '', '', ''),
(18, 'fasdfa', 'lhujhj', 'l', 'fadfad', 'afds@mail.com', '2145656'),
(19, '', '', '', '', '', ''),
(20, '', '', '', '', '', ''),
(21, 'Carla', 'Gwapa', 'G', 'cebu', 'carla@email.com', '789645'),
(22, 'stephen', 'lumban', 'p', NULL, 'gwapo@email.com', '561654456'),
(23, 'asfd', 'asfaf', 'afads', 'fadsfad', 'fadf@mail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guest_id` int(11) NOT NULL,
  `date_in` date DEFAULT NULL,
  `date_out` date DEFAULT NULL,
  `guests_count` int(11) DEFAULT NULL,
  `guest_status` enum('COMPLETE','INCOMPLETE','CANCELLED', 'RESERVED') DEFAULT 'INCOMPLETE',
  `ID_type` enum('passport','driver license','PhilHealth','SSS UMID','POSTAL','TIN','SENIOR CITIZEN','OFW','OTHERS') DEFAULT NULL,
  `ID_number` varchar(100) DEFAULT NULL,
  `files` varchar(100) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guests`
--

INSERT INTO `guests` (`guest_id`, `date_in`, `date_out`, `guests_count`, `guest_status`, `ID_type`, `ID_number`, `files`, `payment_id`, `room_id`, `customer_id`) VALUES
(1, '2020-10-11', '0000-00-00', 1, 'COMPLETE', NULL, NULL, NULL, 1, 101, 1),
(2, '2020-10-11', '2020-12-27', 1, 'COMPLETE', NULL, NULL, NULL, 2, 101, 2),
(3, '2020-11-11', '0000-00-00', 3, 'INCOMPLETE', NULL, NULL, NULL, 3, 205, 3),
(4, '2020-11-13', '2020-11-14', 2, 'COMPLETE', NULL, NULL, NULL, 4, 202, 4),
(5, '2020-11-14', '0000-00-00', 6, 'COMPLETE', NULL, NULL, NULL, 5, 301, 5),
(6, '2020-12-15', '2020-12-27', 4, 'INCOMPLETE', NULL, NULL, NULL, 6, 204, 6),
(7, '2020-12-24', '0000-00-00', 5, 'COMPLETE', NULL, NULL, NULL, 7, 303, 7),
(8, '2020-12-26', '2020-12-28', 1, 'INCOMPLETE', NULL, NULL, NULL, 8, 206, 8),
(9, '1000-01-01', '1000-01-01', 2, 'CANCELLED', '', '', '', 9, 101, 17),
(10, '2020-12-27', '2020-12-28', 1, 'COMPLETE', 'passport', '45864645', '', 10, 105, 18),
(11, '1000-01-01', '1000-01-01', 3, 'CANCELLED', '', '', '', 11, 306, 19),
(12, '1000-01-01', '1000-01-01', 2, 'CANCELLED', '', '', '', 12, 205, 20),
(13, '2020-12-28', '0000-00-00', 3, 'COMPLETE', 'SENIOR CITIZEN', '7898745', '', 13, 203, 21),
(14, '1000-01-01', '1000-01-01', NULL, 'CANCELLED', NULL, NULL, NULL, 14, 201, 22),
(15, '2020-12-29', '0000-00-00', 2, 'COMPLETE', '', '45564', '', 15, 101, 23);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `payment_amount` float(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_type` enum('Cash','Credit Card') DEFAULT NULL,
  `bill_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `payment_amount`, `payment_date`, `payment_type`, `bill_id`) VALUES
(1, 5070.00, '2020-10-12', 'Cash', 1),
(2, 5000.00, '2020-10-12', 'Cash', 2),
(3, 217500.00, '2020-11-12', 'Credit Card', 3),
(4, 2175.00, '2020-11-14', 'Cash', 4),
(5, 9175.00, '2020-11-15', 'Credit Card', 5),
(6, 117500.00, '2020-12-16', 'Cash', 6),
(7, 10000.00, '2020-12-26', 'Cash', 7),
(8, 5000.00, '2020-12-28', 'Credit Card', 8),
(9, 0.00, NULL, NULL, 9),
(10, 3000.00, NULL, NULL, 10),
(11, 0.00, NULL, NULL, 11),
(12, 100000000.00, NULL, NULL, 12),
(13, 4515.00, NULL, NULL, 13),
(14, 0.00, NULL, NULL, NULL),
(15, 2040.00, NULL, NULL, 15);

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `record_id` int(11) NOT NULL,
  `record_type` enum('COMING','STAYING','CHECKED OUT') DEFAULT NULL,
  `record_desc` varchar(100) DEFAULT NULL,
  `record_time` time DEFAULT NULL,
  `record_date` date DEFAULT NULL,
  `record_paid` float(10,2) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`record_id`, `record_type`, `record_desc`, `record_time`, `record_date`, `record_paid`, `guest_id`) VALUES
(1, 'COMING', 'coming', '14:00:00', '2020-10-11', 150.00, 1),
(2, 'STAYING', 'staying', '15:00:00', '2020-10-11', 150.00, 102),
(3, 'CHECKED OUT', '', '09:00:00', '2020-10-12', 150.00, 1),
(4, 'COMING', 'coming', '14:00:00', '2020-10-11', 150.00, 2),
(5, 'STAYING', 'staying', '16:00:00', '2020-10-11', 150.00, 2),
(6, 'CHECKED OUT', '', '10:00:00', '2020-10-12', 150.00, 2),
(7, 'COMING', 'coming', '14:00:00', '2020-11-11', 150.00, 3),
(8, 'STAYING', 'staying', '15:00:00', '2020-11-11', 150.00, 3),
(9, 'CHECKED OUT', '', '08:00:00', '2020-11-12', 150.00, 3),
(10, 'COMING', 'coming', '14:00:00', '2020-11-13', 150.00, 4),
(11, 'STAYING', 'staying', '16:00:00', '2020-11-13', 150.00, 4),
(12, 'CHECKED OUT', '', '16:00:00', '2020-11-14', 150.00, 4),
(13, 'COMING', 'coming', '14:00:00', '2020-11-14', 150.00, 5),
(14, 'STAYING', 'staying', '16:00:00', '2020-11-14', 150.00, 5),
(15, 'CHECKED OUT', '', '16:00:00', '2020-11-15', 150.00, 5),
(16, 'COMING', 'coming', '14:00:00', '2020-12-15', 150.00, 6),
(17, 'STAYING', 'staying', '13:00:00', '2020-12-15', 150.00, 6),
(18, 'CHECKED OUT', '', '10:00:00', '2020-12-16', 150.00, 6),
(19, 'COMING', 'coming', '14:00:00', '2020-12-24', 150.00, 7),
(20, 'COMING', 'coming', '14:00:00', '2020-12-26', 150.00, 8),
(21, 'CHECKED OUT', NULL, '13:55:36', '2020-12-26', 2245.00, 1),
(22, 'STAYING', NULL, '07:01:34', '2020-12-26', NULL, 9),
(23, 'CHECKED OUT', NULL, '13:28:52', '2020-12-27', 2105.00, 2),
(24, 'CHECKED OUT', NULL, '13:30:05', '2020-12-27', 9216.00, 7),
(25, 'STAYING', NULL, '06:40:51', '2020-12-27', NULL, 10),
(26, 'CHECKED OUT', NULL, '13:42:14', '2020-12-27', 2047.00, 10),
(27, 'STAYING', NULL, '09:07:46', '2020-12-28', NULL, 11),
(28, 'STAYING', NULL, '09:08:46', '2020-12-28', NULL, 12),
(29, 'CHECKED OUT', NULL, '16:10:19', '2020-12-28', 2175.00, 4),
(30, 'CHECKED OUT', NULL, '23:44:25', '2020-12-28', 9175.00, 5),
(31, 'STAYING', NULL, '04:47:03', '2020-12-28', NULL, 13),
(32, 'CHECKED OUT', NULL, '23:48:24', '2020-12-28', 4515.00, 13),
(33, 'COMING', NULL, '23:49:00', '2020-12-28', NULL, 14),
(34, 'STAYING', NULL, '05:22:19', '2020-12-29', NULL, 15),
(35, 'CHECKED OUT', NULL, '00:23:17', '2020-12-29', 2038.00, 15);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_status` enum('Available','Used by guest','Maintenance','Reserved') DEFAULT NULL,
  `roomtype_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_status`, `roomtype_id`) VALUES
(101, 'Available', 1),
(102, 'Maintenance', 1),
(103, 'Maintenance', 1),
(104, 'Maintenance', 1),
(105, 'Available', 2),
(106, 'Maintenance', 2),
(201, 'Available', 2),
(202, 'Available', 2),
(203, 'Available', 3),
(204, 'Available', 3),
(205, 'Used by guest', 3),
(206, 'Maintenance', 3),
(301, 'Available', 4),
(302, 'Maintenance', 4),
(303, 'Available', 4),
(304, 'Available', 4),
(305, 'Maintenance', 4),
(306, 'Used by guest', 4);

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE `room_type` (
  `roomtype_id` int(11) NOT NULL,
  `room_cost` float(10,2) DEFAULT NULL,
  `room_desc` varchar(100) DEFAULT NULL,
  `room_cap` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `room_type`
--

INSERT INTO `room_type` (`roomtype_id`, `room_cost`, `room_desc`, `room_cap`) VALUES
(1, 2000.00, 'Single bed, Aircon, 1-2 people', 2),
(2, 2000.00, 'Single bed, Fan only, 1-2 people', 2),
(3, 4500.00, 'Two beds, Aircon, 2-4 people', 4),
(4, 9000.00, 'Three beds, Aircon, 3-5 people', 5);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `sched_id` int(11) NOT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`sched_id`, `guest_id`, `room_id`) VALUES
(1, 1, 101),
(2, 2, 102),
(3, 3, 103),
(6, 6, 202),
(7, 7, 303),
(8, 8, 206),
(10, 10, 105);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `task_name` varchar(100) DEFAULT NULL,
  `task_desc` varchar(100) DEFAULT NULL,
  `task_status` enum('COMPLETE','INCOMPLETE') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_name`, `task_desc`, `task_status`) VALUES
(1, 'clean room', 'a customer spilled juice on the bed.', 'INCOMPLETE'),
(2, 'Order equipmemts', 'check the storage, and order them.', 'INCOMPLETE'),
(3, 'bugs', 'hide bugs', 'COMPLETE'),
(4, 'bugs', 'hide bugs', 'COMPLETE'),
(5, 'Clean room 205', 'clean room because dirty', 'COMPLETE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `fname` varchar(100) DEFAULT NULL,
  `lname` varchar(100) DEFAULT NULL,
  `MI` varchar(5) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `user_type` enum('Receptionist','Admin') DEFAULT NULL,
  `salary` float(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `fname`, `lname`, `MI`, `email`, `password`, `user_type`, `salary`) VALUES
(1, 'Ash', 'Ketchum', 'P', 'admin@email.com', 'admin', 'Admin', 400.00),
(2, 'Luffy', 'Monkey', 'D', 'rec@email.com', 'receptionist', 'Receptionist', 300.00),
(3, 'Rico', 'Muaña', 'P', 'rico@mail.com', 'rico', 'Receptionist', 200.99);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`amenity_id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `bill_guests_pk` (`guest_id`);

--
-- Indexes for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD PRIMARY KEY (`billitem_id`),
  ADD KEY `billitems_bill_pk` (`bill_id`),
  ADD KEY `billitems_amenities_pk` (`amenity_id`);

--
-- Indexes for table `checked_in_guests`
--
ALTER TABLE `checked_in_guests`
  ADD PRIMARY KEY (`checked_in_id`),
  ADD KEY `checkedinguests_guests_pk` (`guest_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `guests`
--
ALTER TABLE `guests`
  ADD PRIMARY KEY (`guest_id`),
  ADD KEY `guests_payments_pk` (`payment_id`),
  ADD KEY `guests_rooms_pk` (`room_id`),
  ADD KEY `rooms_customer_pk` (`customer_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `pay_bill_fk` (`bill_id`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`record_id`),
  ADD KEY `records_guests_pk` (`guest_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `rooms_roomtype_pk` (`roomtype_id`);

--
-- Indexes for table `room_type`
--
ALTER TABLE `room_type`
  ADD PRIMARY KEY (`roomtype_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`sched_id`),
  ADD KEY `schedule_guests_pk` (`guest_id`),
  ADD KEY `schedule_rooms_pk` (`room_id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `bill_items`
--
ALTER TABLE `bill_items`
  MODIFY `billitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `checked_in_guests`
--
ALTER TABLE `checked_in_guests`
  MODIFY `checked_in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `roomtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sched_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_guests_pk` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`guest_id`);

--
-- Constraints for table `bill_items`
--
ALTER TABLE `bill_items`
  ADD CONSTRAINT `billitems_amenities_pk` FOREIGN KEY (`amenity_id`) REFERENCES `amenities` (`amenity_id`),
  ADD CONSTRAINT `billitems_bill_pk` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`);

--
-- Constraints for table `checked_in_guests`
--
ALTER TABLE `checked_in_guests`
  ADD CONSTRAINT `checkedinguests_guests_pk` FOREIGN KEY (`guest_id`) REFERENCES `guests` (`guest_id`);

--
-- Constraints for table `guests`
--
ALTER TABLE `guests`
  ADD CONSTRAINT `guests_payments_pk` FOREIGN KEY (`payment_id`) REFERENCES `payments` (`payment_id`),
  ADD CONSTRAINT `guests_rooms_pk` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`),
  ADD CONSTRAINT `rooms_customer_pk` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `pay_bill_fk` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`bill_id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_roomtype_pk` FOREIGN KEY (`roomtype_id`) REFERENCES `room_type` (`roomtype_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
