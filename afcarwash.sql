-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 26, 2024 at 03:42 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `afcarwash`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(128) NOT NULL,
  `role` varchar(128) NOT NULL,
  `username` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `role`, `username`, `password`) VALUES
(1, 'manager', 'manager', '123Manager$$'),
(3, 'employee', 'employee', '123Employee$$');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(128) NOT NULL,
  `customer_id` int(128) NOT NULL,
  `phone` int(128) NOT NULL,
  `vehicle` varchar(128) NOT NULL,
  `serviceType` varchar(128) NOT NULL,
  `carType` varchar(128) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `special` varchar(128) NOT NULL,
  `bookingStatus` varchar(128) NOT NULL DEFAULT 'Pending',
  `cost` varchar(128) NOT NULL,
  `invoiceNumber` varchar(128) NOT NULL,
  `paymentStatus` varchar(128) NOT NULL,
  `receiptNumber` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `customer_id`, `phone`, `vehicle`, `serviceType`, `carType`, `date`, `time`, `special`, `bookingStatus`, `cost`, `invoiceNumber`, `paymentStatus`, `receiptNumber`) VALUES
(14, 2, 172310267, 'SAA 9763 A', 'carWash', 'smallCar', '2024-01-19', '09:30:00', 'Testing', 'Cancelled', '', '', '', ''),
(15, 2, 324334324, 'SAA 9763 A', 'carRepair', 'SUV', '2024-01-27', '14:30:00', 'Hey', 'Approved', '199', '1999232', '9763', ''),
(19, 2, 54554, 'SAA 9763 V', 'carWash', 'smallCar', '2024-01-26', '15:00:00', 'Awim bawe', 'Cancelled', '', '', '', ''),
(23, 7, 172310267, 'SAA 9763 A', 'carRepair', 'SUV', '2024-01-31', '08:30:00', 'MANAGER TESTING', 'Approved', '', '', '', ''),
(25, 7, 172310267, 'SAA 9763 A', 'carRepair', 'SUV', '2024-01-31', '08:00:00', 'MAS', 'Approved', '', '', '', ''),
(27, 6, 0, 'gdg', 'carWash', 'SUV', '2024-01-27', '16:30:00', 'gfdg', 'Approved', '', '', '', ''),
(31, 6, 123456789, '432', 'carRepair', 'SUV', '2024-01-27', '14:30:00', 'fgd', 'Approved', '', '', '', ''),
(32, 6, 123456789, 'regg', 'carWash', 'smallCar', '2024-01-27', '14:30:00', 'greg', 'Approved', '', '', '', ''),
(34, 6, 172310267, 'SAA 9763 A', 'carWash', 'SUV', '2024-02-01', '08:00:00', 'Lol', 'Approved', '', '', '', ''),
(36, 6, 172310267, 'SAA 9763 A', 'carWash', 'SUV', '2024-02-01', '08:00:00', 'HELLO WORLD', 'Approved', '', '', '', ''),
(37, 6, 172310267, 'SAA 9763 A', 'carRepair', 'SUV', '2024-02-01', '11:30:00', 'HELLO WORLD ', 'Approved', '', '', '', ''),
(38, 6, 172310267, 'SAA 9763 V', 'carWash', 'SUV', '2024-02-01', '09:00:00', 'Hello World', 'Cancelled', '', '', '', ''),
(42, 7, 123, 'QAA1777', 'carRepair', 'SUV', '2024-01-20', '08:00:00', 'Manager', 'Cancelled', '', '', '', ''),
(43, 6, 172310267, 'QAA 1979 A', 'carWash', 'van', '0000-00-00', '12:00:00', '', 'Cancelled', '', '', '', ''),
(44, 7, 1723220982, 'fdsfd', 'carWash', 'smallCar', '2024-01-27', '08:00:00', 'Noni', 'Approved', '', '', '', ''),
(45, 6, 172310267, 'SAA 9763 A', 'carWash', 'SUV', '2024-01-26', '16:00:00', '10.39pm', 'Approved', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `username` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `username`, `email`, `password`) VALUES
(2, 'admin', 'taco0267@gmail.com', '1'),
(4, 'Ali', 'fidelyong12@gmail.com', '1'),
(6, 'Fid', 'fidelyong22@gmail.com', '1'),
(7, 'Manager', 'Manager', '-'),
(8, 'fifi', 'abu@gmail.com', '1'),
(9, 'Yogi', 'togi@gmail.com', '1'),
(10, 'small', 'taco@gmail.com', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(128) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
