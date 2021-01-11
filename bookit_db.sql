-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2021 at 06:45 AM
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
  `stock` int(11) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`amenity_id`, `amenity_name`, `amenity_price`, `amenity_type`, `stock`, `image`) VALUES
(1, 'Piattosss', 15.00, 'Foods', 96, 'Piattos.JFIF'),
(2, 'Dove Conditioner', 10.00, 'Hygiene', 79, 'dove-conditioner.jpg'),
(3, 'Sunsilk Shampoo', 8.00, 'Hygiene', 46, 'sunsilk-shampoo.png'),
(4, 'Sunsilk Conditioner', 8.00, 'Hygiene', -1, 'creamsilk.jpg'),
(5, 'Nature Spring 350ml', 10.00, 'Drinks', 94, 'naturespring-350.png'),
(6, 'Nature Spring 500ml', 15.00, 'Drinks', 72, 'naturespring-500.png'),
(7, 'Pepsi 8oz', 10.00, 'Drinks', 87, 'pepsi-8oz.jpg'),
(8, 'Mirinda 8oz', 10.00, 'Drinks', 98, 'mirinda-8.jpg'),
(9, 'Mountain Dew 8oz', 10.00, 'Drinks', 100, NULL),
(10, 'Pepsi 12oz', 15.00, 'Drinks', 100, NULL),
(11, 'Mirinda 12oz', 15.00, 'Drinks', 100, NULL),
(12, 'Mountain Dew 12oz', 15.00, 'Drinks', 100, NULL),
(13, 'Pepsi 1L', 30.00, 'Drinks', -10000000, NULL),
(14, 'San Miguel Light 330ml', 50.00, 'Drinks', 100, NULL),
(15, 'San Miguel Pale Pilsen 320ml', 35.00, 'Drinks', 100, NULL),
(16, 'Piattos', 15.00, 'Foods', 73, NULL),
(17, 'Nova', 15.00, 'Foods', 74, 'nova.png'),
(18, 'Taquitos', 15.00, 'Foods', 89, 'taquitos.jpg'),
(19, 'Vcut', 15.00, 'Foods', 100, 'vcut.jpg'),
(20, 'Clover', 15.00, 'Foods', 100, NULL),
(21, 'Dingdong', 12.00, 'Foods', 100, NULL),
(22, 'Kirie', 10.00, 'Foods', 100, NULL),
(23, 'Oishi', 10.00, 'Foods', 100, NULL),
(24, 'Cheese and Chips', 10.00, 'Foods', 100, NULL),
(25, 'Chippy', 10.00, 'Foods', 100, NULL),
(26, 'Patata', 10.00, 'Foods', 100, NULL),
(27, 'Baby Powder', 20.00, 'Foods', 100, NULL),
(28, 'Candy', 1.00, 'Foods', 100, NULL),
(29, 'Longsilog', 70.00, 'Foods', 9999999, NULL),
(30, 'Hotsilog', 70.00, 'Foods', 9999999, NULL),
(31, 'Cornsilog', 70.00, 'Foods', 9999999, NULL),
(32, 'Tunasilog', 70.00, 'Foods', 9999999, NULL),
(33, 'Pillows', 70.00, 'Extras', 8, 'Pillow.jpg'),
(34, 'Lights', 70.00, 'Extras', 4, 'lights.JFIF'),
(35, 'burger', 24.00, 'Foods', 5, NULL),
(36, 'dove clay', 15.00, 'Hygiene', 137, 'dove-shampoo.jpg'),
(37, 'hotdog', 10.00, 'Foods', -1, NULL),
(100, 'booking', 0.00, '', 0, NULL);

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
(1, '2021-01-11', 1),
(2, '2021-01-11', 2),
(3, '2021-01-11', 3),
(4, '2021-01-11', 4),
(5, '2021-01-11', 5),
(6, '2021-01-11', 6),
(7, '2021-01-11', 7),
(8, '2021-01-11', 8),
(9, '2021-01-11', 9),
(10, '2021-01-12', 10),
(11, '2021-01-11', 11);

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
(1, 1, 1, '2021-01-11', 100),
(2, 1, 1, '2021-01-11', 6),
(3, 1, 2, '2021-01-11', 100),
(4, 1, 2, '2021-01-11', 6),
(5, 1, 3, '2021-01-11', 100),
(6, 1, 2, '2021-01-11', 6),
(7, 1, 4, '2021-01-11', 100),
(8, 3, 2, '2021-01-11', 2),
(9, 3, 2, '2021-01-11', 3),
(10, 2, 2, '2021-01-11', 8),
(11, 1, 5, '2021-01-11', 100),
(12, 2, 5, '2021-01-11', 6),
(13, 2, 5, '2021-01-11', 7),
(14, 1, 6, '2021-01-11', 100),
(15, 1, 7, '2021-01-11', 100),
(16, 2, 7, '2021-01-11', 7),
(17, 1, 8, '2021-01-11', 100),
(18, 1, 9, '2021-01-11', 100),
(19, 1, 10, '2021-01-12', 100),
(20, 1, 11, '2021-01-11', 100);

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
(6, NULL, 6),
(7, NULL, 7),
(8, NULL, 8),
(9, NULL, 9);

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
(1, 'Herman', 'Carter', '', 'Lery\'s Memorial Institute', 'theDoctor@gmail.com', '753753'),
(2, 'Evan', 'McMillan', '', 'McMillan Estate', 'trapper@email.com', '78537453'),
(3, 'Sally', 'Smithson', '', 'Hospital', 'nurse@email.com', '737534'),
(4, 'Dummy', 'Tester', '', 'dumb street', 'dumb@email.com', '75786'),
(5, 'Disguised', 'Toast', '', 'Among Us', 'comfycartel@email.com', '47537537'),
(6, 'Dummy', 'Tester', '', 'dumb street', '', '786786'),
(7, 'YEAAAAAAH', 'BOIIIIIIIII', '', 'space and galaxy', 'shootingStars@email.com', '8793783'),
(8, 'Michael', 'Myers', '', 'haddonfield', 'shape@email.com', '786335'),
(9, 'Billy', 'Thompson', '', 'thompson\'s farm', 'hilibilly@email.com', '7537553'),
(10, 'Dummy3', 'Tester3', '', NULL, 'dumb3@email.com', '6345696'),
(11, 'Dummy2', 'Tester2', '', NULL, 'dumb2@email.com', '7861263');

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
(1, '2021-01-11', '2021-01-11', 1, 'COMPLETE', 'driver license', '7837', '', 1, 104, 1),
(2, '2021-01-11', '2021-01-11', 1, 'COMPLETE', 'SSS UMID', '78563783', '', 2, 103, 2),
(3, '2021-01-11', '2021-01-11', 1, 'COMPLETE', 'passport', '7527865', '', 3, 104, 3),
(4, '2021-01-11', '2021-01-11', 1, 'COMPLETE', 'SSS UMID', '567863', '', 4, 104, 4),
(5, '2021-01-01', '2021-01-11', 1, 'COMPLETE', 'PhilHealth', '753753', '', 5, 104, 5),
(6, '2021-01-11', '2021-01-15', 3, 'INCOMPLETE', 'driver license', '786786', '', 6, 306, 6),
(7, '2021-01-11', '2021-01-14', 2, 'INCOMPLETE', 'TIN', '7867', '', 7, 202, 7),
(8, '2021-01-11', '2021-01-12', 1, 'INCOMPLETE', 'POSTAL', '786786', '', 8, 104, 8),
(9, '2021-01-11', '2021-01-12', 2, 'INCOMPLETE', 'SSS UMID', '7835', '', 9, 201, 9),
(10, '2021-01-12', '2021-01-16', 2, 'RESERVED', NULL, NULL, NULL, 10, 106, 10),
(11, '2021-01-11', '2021-01-14', 1, 'RESERVED', NULL, NULL, NULL, 11, 103, 11);

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
(1, 4000.00, NULL, NULL, 1),
(2, 4000.00, NULL, NULL, 2),
(3, 4000.00, NULL, NULL, 3),
(4, 6000.00, NULL, NULL, 4),
(5, 2000.00, NULL, NULL, 5),
(6, 36000.00, NULL, NULL, 6),
(7, 6000.00, NULL, NULL, 7),
(8, 2000.00, NULL, NULL, 8),
(9, 2000.00, NULL, NULL, 9),
(10, 8000.00, NULL, NULL, 10),
(11, 6000.00, NULL, NULL, 11);

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

INSERT INTO `records` (`record_id`, `record_type`, `record_desc`, `record_time`, `record_date`, `record_paid`, `record_payables`, `record_change`, `guest_id`) VALUES
(1, 'CHECKED OUT', NULL, '12:52:09', '2021-01-11', 5000.00, 4015.00, 985.00, 1),
(2, 'CHECKED OUT', NULL, '12:54:37', '2021-01-11', 4015.00, 4015.00, 0.00, 2),
(3, 'CHECKED OUT', NULL, '12:59:02', '2021-01-11', 4000.00, 4000.00, 0.00, 3),
(4, 'CHECKED OUT', NULL, '13:08:01', '2021-01-11', 7000.00, 6000.00, 1000.00, 4),
(5, 'CHECKED OUT', NULL, '13:24:25', '2021-01-11', 3000.00, 2050.00, 950.00, 5),
(6, 'STAYING', NULL, '06:25:18', '2021-01-11', NULL, NULL, NULL, 6),
(7, 'STAYING', NULL, '06:26:20', '2021-01-11', NULL, NULL, NULL, 7),
(8, 'STAYING', NULL, '06:30:06', '2021-01-11', NULL, NULL, NULL, 8),
(9, 'STAYING', NULL, '06:31:57', '2021-01-11', NULL, NULL, NULL, 9),
(10, 'COMING', NULL, '01:36:00', '2021-01-12', NULL, NULL, NULL, 10),
(11, 'COMING', NULL, '13:37:00', '2021-01-11', NULL, NULL, NULL, 11);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_status` enum('Available','Used by guest','Maintenance','Reserved','Hidden') DEFAULT NULL,
  `roomtype_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_status`, `roomtype_id`) VALUES
(101, 'Available', 1),
(102, 'Available', 1),
(103, 'Reserved', 1),
(104, 'Used by guest', 1),
(105, 'Available', 2),
(106, 'Reserved', 2),
(201, 'Used by guest', 2),
(202, 'Used by guest', 2),
(203, 'Available', 3),
(204, 'Available', 3),
(205, 'Available', 3),
(206, 'Maintenance', 3),
(301, 'Available', 4),
(302, 'Maintenance', 4),
(303, 'Available', 4),
(304, 'Available', 4),
(305, 'Available', 4),
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
(1, 2000.00, 'Single bed, Aircon', 2),
(2, 2000.00, 'Single bed, Fan only', 2),
(3, 4500.00, 'Two beds, Aircon', 4),
(4, 9000.00, 'Three beds, Aircon', 5);

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
(6, 6, 306),
(7, 7, 202),
(8, 8, 104),
(9, 9, 201),
(10, 10, 106),
(11, 11, 103);

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
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bill_items`
--
ALTER TABLE `bill_items`
  MODIFY `billitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `checked_in_guests`
--
ALTER TABLE `checked_in_guests`
  MODIFY `checked_in_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `guests`
--
ALTER TABLE `guests`
  MODIFY `guest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=402;

--
-- AUTO_INCREMENT for table `room_type`
--
ALTER TABLE `room_type`
  MODIFY `roomtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sched_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
