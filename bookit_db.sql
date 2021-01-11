-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2020 at 06:34 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

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
(1, 'Piattosss', 15.00, 'Foods', 96),
(2, 'Dove Conditioner', 10.00, 'Hygiene', 89),
(3, 'Sunsilk Shampoo', 8.00, 'Hygiene', 69),
(4, 'Sunsilk Conditioner', 8.00, 'Hygiene', -1),
(5, 'Nature Spring 350ml', 10.00, 'Drinks', 87),
(6, 'Nature Spring 500ml', 15.00, 'Drinks', 96),
(7, 'Pepsi 8oz', 10.00, 'Drinks', 92),
(8, 'Mirinda 8oz', 10.00, 'Drinks', 94),
(9, 'Mountain Dew 8oz', 10.00, 'Drinks', 100),
(10, 'Pepsi 12oz', 15.00, 'Drinks', 100),
(11, 'Mirinda 12oz', 15.00, 'Drinks', 100),
(12, 'Mountain Dew 12oz', 15.00, 'Drinks', 100),
(13, 'Pepsi 1L', 30.00, 'Drinks', -10000000),
(14, 'San Miguel Light 330ml', 50.00, 'Drinks', 100),
(15, 'San Miguel Pale Pilsen 320ml', 35.00, 'Drinks', 100),
(16, 'Piattos', 15.00, 'Foods', 80),
(17, 'Nova', 15.00, 'Foods', 76),
(18, 'Taquitos', 15.00, 'Foods', 89),
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
(33, 'Pillows', 70.00, 'Extras', 8),
(34, 'Lights', 70.00, 'Extras', 4),
(35, 'burger', 24.00, 'Foods', 5),
(36, 'dove clay', 15.00, 'Hygiene', 150),
(37, 'hotdog', 10.00, 'Foods', -1);

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
(21, '2019-12-30', 22),
(22, '2019-12-31', 23),
(23, '2020-12-30', 24),
(24, '2020-12-31', 25),
(25, '2020-12-30', 26),
(26, '2020-12-16', 27),
(27, '2020-12-22', 28),
(28, '2020-12-27', 29),
(29, '2020-12-26', 30),
(30, '2020-12-30', 31),
(31, '2020-12-30', 32),
(32, '2020-12-31', 33);

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
(80, 2, 21, '2020-12-30', 2),
(81, 2, 21, '2020-12-30', 3),
(82, 1, 21, '2020-12-30', 6),
(83, 2, 21, '2020-12-30', 16),
(84, 2, 21, '2020-12-30', 17),
(86, 1, 22, '2020-12-30', 3),
(87, 2, 22, '2020-12-30', 4),
(88, 1, 22, '2020-12-30', 7),
(89, 3, 22, '2020-12-30', 1),
(90, 1, 22, '2020-12-30', 18),
(94, 4, 25, '2020-12-30', 3),
(95, 4, 25, '2020-12-30', 5),
(96, 3, 25, '2020-12-30', 7),
(97, 3, 25, '2020-12-30', 16),
(99, 3, 26, '2020-12-30', 2),
(100, 2, 26, '2020-12-30', 7),
(101, 4, 26, '2020-12-30', 16),
(102, 2, 26, '2020-12-30', 17),
(104, 1, 27, '2020-12-30', 5),
(105, 3, 27, '2020-12-30', 8),
(106, 3, 27, '2020-12-30', 1),
(107, 3, 27, '2020-12-30', 17),
(108, 1, 27, '2020-12-30', 18),
(110, 3, 28, '2020-12-30', 3),
(111, 2, 28, '2020-12-30', 16),
(112, 2, 28, '2020-12-30', 17),
(113, 3, 28, '2020-12-30', 18),
(115, 3, 29, '2020-12-30', 1),
(116, 4, 29, '2020-12-30', 16),
(117, 3, 29, '2020-12-30', 17),
(118, 3, 29, '2020-12-30', 18),
(119, 2, 29, '2020-12-30', 5),
(121, 2, 30, '2020-12-30', 3),
(122, 1, 30, '2020-12-30', 5),
(123, 1, 30, '2020-12-30', 1),
(124, 1, 30, '2020-12-30', 16),
(126, 2, 31, '2020-12-30', 2),
(127, 2, 31, '2020-12-30', 3),
(128, 2, 31, '2020-12-30', 8),
(129, 2, 31, '2020-12-30', 17),
(130, 1, 31, '2020-12-30', 33),
(131, 2, 31, '2020-12-30', 1),
(133, 2, NULL, '2020-12-30', 2),
(134, 3, NULL, '2020-12-30', 16),
(135, 2, NULL, '2020-12-30', 17);

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
(20, NULL, 26),
(22, NULL, 28),
(24, NULL, 30),
(25, NULL, 31),
(27, NULL, 33);

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
(30, 'Dummy1', 'Tester1', '', 'dumb street 1', 'dumb1@email.com', '321654987'),
(31, 'Dummy2', 'Tester2', '', 'dumb street 2', 'dumb2@email.com', '123654987'),
(32, 'YEAAAAAAH', 'BOIIIIIIIII', 'H', 'space and galaxy', 'shootingStars@email.com', '123456789'),
(33, 'Tester', 'Dummy', '', NULL, 'dumb@email.com', '741852963'),
(34, 'Disguised', 'Toast', '', 'Among Us', 'comfycartel@email.com', '789456123'),
(35, 'Philip', 'Ojomo', '', 'Azarov\'s Lair', 'wraith@email.com', '753453123'),
(36, 'Billy', 'Thompson', '', 'thompson\'s farm', 'hilibilly@email.com', '963852741'),
(37, 'Sally', 'Smithson', '', 'Hospital', 'nurse@email.com', '654987320'),
(38, 'Herman', 'Carter', '', 'Lery\'s Memorial Institute', 'theDoctor@gmail.com', '753951654'),
(39, 'Evan', 'McMillan', '', 'McMillan Estate', 'trapper@email.com', '987654'),
(40, 'Dummy', 'Tester', '', 'dumb street', 'dumb@email.com', '7834123'),
(41, 'Dummy3', 'Tester3', 'F', NULL, 'dumb3@email.com', '7856413');

-- --------------------------------------------------------

--
-- Table structure for table `guests`
--

CREATE TABLE `guests` (
  `guest_id` int(11) NOT NULL,
  `date_in` date DEFAULT NULL,
  `date_out` date DEFAULT NULL,
  `guests_count` int(11) DEFAULT NULL,
  `guest_status` enum('COMPLETE','INCOMPLETE','CANCELLED','RESERVED') DEFAULT 'INCOMPLETE',
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
(22, '2019-12-30', '2020-12-30', 2, 'COMPLETE', 'PhilHealth', '456789', '', 21, 101, 30),
(23, '2019-12-31', '2020-12-30', 4, 'COMPLETE', 'passport', '123', '', 22, 302, 31),
(24, '2020-12-30', '2021-01-09', 1, 'INCOMPLETE', 'SSS UMID', '15698', '', 23, 101, 32),
(25, '1000-01-01', '1000-01-01', 2, 'CANCELLED', NULL, NULL, NULL, 24, 103, 33),
(26, '2020-12-30', '2021-01-01', 1, 'INCOMPLETE', 'PhilHealth', '15698', '', 25, 105, 34),
(27, '2020-12-16', '2020-12-30', 3, 'COMPLETE', 'SSS UMID', '456789', '', 26, 203, 35),
(28, '2020-12-22', '2020-12-30', 2, 'INCOMPLETE', 'POSTAL', '753', '', 27, 204, 36),
(29, '2020-12-27', '2020-12-30', 1, 'COMPLETE', 'PhilHealth', '7586', '', 28, 104, 37),
(30, '2020-12-26', '2021-01-02', 3, 'INCOMPLETE', 'OFW', '753423', '', 29, 305, 38),
(31, '2020-12-30', '2020-12-30', 3, 'INCOMPLETE', 'driver license', '645483327', '', 30, 205, 39),
(32, '2020-12-30', '2020-12-30', 1, 'COMPLETE', 'OTHERS', '456789', '', 31, 102, 40),
(33, '2020-12-31', '2021-01-02', NULL, 'RESERVED', NULL, NULL, NULL, 32, 106, 41);

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
(21, 8000.00, NULL, NULL, 21),
(22, 36000.00, NULL, NULL, 22),
(23, 20000.00, NULL, NULL, 23),
(24, 0.00, NULL, NULL, 24),
(25, 4000.00, NULL, NULL, 25),
(26, 63000.00, NULL, NULL, 26),
(27, 49500.00, NULL, NULL, 27),
(28, 6000.00, NULL, NULL, 28),
(29, 63000.00, NULL, NULL, 29),
(30, 27000.00, NULL, NULL, 30),
(31, 18000.00, NULL, NULL, 31),
(32, 4000.00, NULL, NULL, 32);

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
  `record_payables` float(10,2) DEFAULT NULL,
  `record_change` float(10,2) DEFAULT NULL, 
  `guest_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`record_id`, `record_type`, `record_desc`, `record_time`, `record_date`, `record_paid`, `guest_id`) VALUES
(49, 'CHECKED OUT', NULL, '10:14:24', '2020-12-30', 2111.00, 22),
(50, 'CHECKED OUT', NULL, '10:14:32', '2020-12-30', 9094.00, 23),
(51, 'COMING', NULL, '11:20:00', '2020-12-30', NULL, 24),
(52, 'COMING', NULL, '22:34:00', '2020-12-31', NULL, 25),
(53, 'STAYING', NULL, '03:32:57', '2020-12-30', NULL, 26),
(54, 'STAYING', NULL, '03:36:33', '2020-12-16', NULL, 27),
(55, 'STAYING', NULL, '03:39:52', '2020-12-22', NULL, 28),
(56, 'STAYING', NULL, '03:42:43', '2020-12-27', NULL, 29),
(57, 'CHECKED OUT', NULL, '10:43:16', '2020-12-30', 6129.00, 29),
(58, 'STAYING', NULL, '03:48:14', '2020-12-26', NULL, 30),
(59, 'COMING', NULL, '10:52:00', '2020-12-30', NULL, 31),
(60, 'STAYING', NULL, NULL, '2020-12-30', NULL, 31),
(61, 'STAYING', NULL, '04:21:43', '2020-12-30', NULL, 32),
(62, 'CHECKED OUT', NULL, '11:26:42', '2020-12-30', 18186.00, 32),
(63, 'COMING', NULL, '00:30:00', '2020-12-31', NULL, 33),
(64, 'STAYING', NULL, NULL, '2020-12-30', NULL, 33),
(65, 'CHECKED OUT', NULL, '11:36:34', '2020-12-30', 63140.00, 27);

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
(101, 'Used by guest', 1),
(102, 'Available', 1),
(103, 'Reserved', 1),
(104, 'Available', 1),
(105, 'Used by guest', 2),
(106, 'Reserved', 2),
(201, 'Available', 2),
(202, 'Available', 2),
(203, 'Available', 3),
(204, 'Used by guest', 3),
(205, 'Used by guest', 3),
(206, 'Maintenance', 3),
(301, 'Available', 4),
(302, 'Maintenance', 4),
(303, 'Available', 4),
(304, 'Available', 4),
(305, 'Used by guest', 4),
(306, 'Available', 4);

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
(23, 24, 101),
(25, 26, 105),
(27, 28, 204),
(29, 30, 305),
(30, 31, 205),
(32, 33, 106);

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
(5, 'Clean room 205', 'clean room because dirty', 'COMPLETE'),
(6, 'run demo', 'test running now', 'COMPLETE');

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
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `bill_items`
--
ALTER TABLE `bill_items`
  MODIFY `billitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `checked_in_guests`
--
ALTER TABLE `checked_in_guests`
  MODIFY `checked_in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

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
  MODIFY `sched_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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


ALTER TABLE amenities
ADD image varchar(100);

UPDATE amenities SET image='dove-shampoo.jpg' WHERE (amenity_id=36);
UPDATE amenities SET image='dove-conditioner.jpg' WHERE (amenity_id=2);
UPDATE amenities SET image='sunsilk-shampoo.png' WHERE (amenity_id=3);
UPDATE amenities SET image='creamsilk.jpg' WHERE (amenity_id=4);
UPDATE amenities SET image='Piattos.JFIF' WHERE (amenity_id=1);
UPDATE amenities SET image='nova.png' WHERE (amenity_id=17);
UPDATE amenities SET image='taquitos.jpg' WHERE (amenity_id=18);
UPDATE amenities SET image='vcut.jpg' WHERE (amenity_id=19);
UPDATE amenities SET image='naturespring-350.png' WHERE (amenity_id=5);
UPDATE amenities SET image='naturespring-500.png' WHERE (amenity_id=6);
UPDATE amenities SET image='pepsi-8oz.jpg' WHERE (amenity_id=7);
UPDATE amenities SET image='mirinda-8.jpg' WHERE (amenity_id=8);
UPDATE amenities SET image='Pillow.jpg' WHERE (amenity_id=33);
UPDATE amenities SET image='lights.JFIF' WHERE (amenity_id=34);

ALTER TABLE records ADD record_payables FLOAT(10,2) NULL DEFAULT NULL AFTER record_paid;
ALTER TABLE records ADD record_change FLOAT(10,2) NULL DEFAULT NULL AFTER record_payables;

INSERT INTO amenities`(amenity_id`, amenity_name, amenity_price, amenity_type, stock) VALUES (100,'booking',0,'',0);

UPDATE room_type SET room_desc = 'Single bed, Aircon' WHERE roomtype_id = 1;
UPDATE room_type SET room_desc = 'Single bed, Fan only' WHERE roomtype_id = 2;
UPDATE room_type SET room_desc = 'Two beds, Aircon' WHERE roomtype_id = 3;
UPDATE room_type SET room_desc = 'Three beds, Aircon' WHERE roomtype_id = 4;