-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2022 at 02:09 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `register`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(9) NOT NULL,
  `user_type` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `activity` varchar(150) NOT NULL,
  `date_time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(9) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `trn_date` datetime NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `middlename` text NOT NULL,
  `mobilenumber` text NOT NULL,
  `address` varchar(50) NOT NULL,
  `mfa_qrcode_enabled` tinyint(2) NOT NULL,
  `mfa_pincode_enabled` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `email`, `password`, `trn_date`, `firstname`, `lastname`, `middlename`, `mobilenumber`, `address`, `mfa_qrcode_enabled`, `mfa_pincode_enabled`) VALUES
(1, 'admin', 'iskawtcare@gmail.com', 'admin', '2022-09-16 10:44:52', 'Iskawt', 'Admin', 'Care', '09231234567', 'Luzon, Visayas, Mindanao', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `allowed_apps`
--

CREATE TABLE `allowed_apps` (
  `id` int(9) NOT NULL,
  `email` varchar(150) NOT NULL,
  `ggmail` tinyint(9) NOT NULL,
  `gdrive` tinyint(9) NOT NULL,
  `gform` tinyint(9) NOT NULL,
  `ghangout` tinyint(9) NOT NULL,
  `gdocument` tinyint(9) NOT NULL,
  `gspreadsheet` tinyint(9) NOT NULL,
  `gpresentation` tinyint(9) NOT NULL,
  `gclassroom` tinyint(9) NOT NULL,
  `gmeet` tinyint(9) NOT NULL,
  `gcalendar` tinyint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(9) NOT NULL,
  `email` varchar(155) NOT NULL,
  `username` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `mobilenumber` varchar(50) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `verifiedEmail` int(5) NOT NULL,
  `token` varchar(200) NOT NULL,
  `check_new_account` int(11) NOT NULL,
  `date_created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `qrcode` varchar(255) NOT NULL,
  `qr_enabled` int(2) NOT NULL,
  `pincode_enabled` int(2) NOT NULL,
  `verification_code` int(4) NOT NULL,
  `flagged` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allowed_apps`
--
ALTER TABLE `allowed_apps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `allowed_apps`
--
ALTER TABLE `allowed_apps`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
