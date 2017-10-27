-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2017 at 08:33 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ucci`
--

-- --------------------------------------------------------

--
-- Table structure for table `member_requests`
--

CREATE TABLE `member_requests` (
  `id` int(12) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `company_name` varchar(200) NOT NULL,
  `company_address` text NOT NULL,
  `designation` varchar(200) NOT NULL,
  `master_member_type_id` int(12) NOT NULL,
  `remarks` text NOT NULL,
  `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(12) NOT NULL,
  `website` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `member_requests`
--

INSERT INTO `member_requests` (`id`, `name`, `mobile`, `email`, `company_name`, `company_address`, `designation`, `master_member_type_id`, `remarks`, `request_date`, `user_id`, `website`) VALUES
(1, 'Rohit', '9887779123', 'rohit@phppoets.in', 'PHPPOETS', 'UDAipur', 'Senior developer', 1, 'this company is very good performance', '2017-07-18 08:20:13', 18, ''),
(2, 'raja', '9887779123\r\n', 'rohit1@phppoets.in', 'NMC', 'udaipur', 'developer', 1, 'good', '2017-07-18 10:46:38', 18, 'www.google.com'),
(3, 'ashish', '8578956421', 'ashish@phppoets.in', 'PHPPOETS IT SOLUTION PVT.LTE', 'Rajasthan udaipur', 'developer', 1, 'very good', '2017-07-18 11:53:32', 18, 'www.google.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member_requests`
--
ALTER TABLE `member_requests`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member_requests`
--
ALTER TABLE `member_requests`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
