-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 13, 2019 at 01:04 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apartment`
--

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `amenities_id` int(11) NOT NULL,
  `amenities_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`amenities_id`, `amenities_name`) VALUES
(1, 'Air-conditioning'),
(2, 'Wood flooring'),
(3, 'Charging outlets with USB ports'),
(4, 'TV');

-- --------------------------------------------------------

--
-- Table structure for table `apartment`
--

CREATE TABLE `apartment` (
  `id` int(11) NOT NULL,
  `apartment_name` varchar(200) NOT NULL,
  `blocks` int(11) NOT NULL,
  `flat_count` int(11) NOT NULL,
  `address` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apartment`
--

INSERT INTO `apartment` (`id`, `apartment_name`, `blocks`, `flat_count`, `address`) VALUES
(1, 'Apartment', 10, 100, 'Apartment Address');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `flat_id` int(11) NOT NULL,
  `booking_start_date` date NOT NULL,
  `booking_end_date` date NOT NULL,
  `advance_payment` varchar(6) NOT NULL,
  `booking_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `member_id`, `flat_id`, `booking_start_date`, `booking_end_date`, `advance_payment`, `booking_status`) VALUES
(1, 1, 101, '2019-02-02', '2019-09-09', '100000', 1),
(5, 2, 102, '2019-05-13', '2019-06-06', '100000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `flat_details`
--

CREATE TABLE `flat_details` (
  `id` int(11) NOT NULL,
  `flat_no` varchar(10) NOT NULL,
  `block_no` varchar(10) NOT NULL,
  `bedroom_count` int(11) NOT NULL,
  `bathroom_count` int(11) NOT NULL,
  `room_count` int(11) NOT NULL,
  `amenities` varchar(500) NOT NULL,
  `rent` varchar(10) NOT NULL,
  `advance` varchar(10) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `flat_details`
--

INSERT INTO `flat_details` (`id`, `flat_no`, `block_no`, `bedroom_count`, `bathroom_count`, `room_count`, `amenities`, `rent`, `advance`, `status`) VALUES
(1, '105', '5', 3, 3, 8, 'Power', '5000', '150000', 0),
(6, '102', '5', 5, 2, 7, 'TV,AC', '50000', '100000', 1),
(7, '103', '5', 5, 2, 7, 'TV', '2500', '100000', 0),
(8, '104', '5', 5, 2, 7, 'TV', '2500', '100000', 1),
(9, '101', '5', 5, 2, 7, 'TV', '2500', '100000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` varchar(250) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`id`, `name`, `mobile`, `email`, `password`, `address`, `status`) VALUES
(1, 'veena', '9995164972', 'veena@gmail.com', '$2y$10$razBth0PPjqNQ.4aDTlnA.MLh1TNhDOve515WHHpvG5xJyOh.AzhW', 'address', 1),
(2, 'ammu', '9985164972', 'ammu@gmail.com', '$2y$10$I7gaiJ3ci4K3XNsyvOM4DOKlAf2T298zKsFpRltjUsM/3Xuv4.WGa', 'address', 1);

-- --------------------------------------------------------

--
-- Table structure for table `rent`
--

CREATE TABLE `rent` (
  `bill_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `flat_no` varchar(8) NOT NULL,
  `due_amount` varchar(6) NOT NULL,
  `paid_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rent`
--

INSERT INTO `rent` (`bill_id`, `member_id`, `flat_no`, `due_amount`, `paid_date`) VALUES
(1, 1, '101', '5000', '2019-05-08'),
(5, 2, '102', '50000', '2019-05-13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`amenities_id`);

--
-- Indexes for table `apartment`
--
ALTER TABLE `apartment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `flat_details`
--
ALTER TABLE `flat_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rent`
--
ALTER TABLE `rent`
  ADD PRIMARY KEY (`bill_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `amenities_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `apartment`
--
ALTER TABLE `apartment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `flat_details`
--
ALTER TABLE `flat_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rent`
--
ALTER TABLE `rent`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
