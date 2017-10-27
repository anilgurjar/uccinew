-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2017 at 01:17 PM
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
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `name`) VALUES
(1, 'President'),
(2, 'Vice President'),
(3, 'Immediate Past President'),
(4, 'Past President');

-- --------------------------------------------------------

--
-- Table structure for table `executive_categories`
--

CREATE TABLE `executive_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `member_limit` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `executive_categories`
--

INSERT INTO `executive_categories` (`id`, `name`, `member_limit`) VALUES
(1, 'Main', 7),
(2, 'Past President Category - C', 2),
(3, 'Member Bodies & Association - B', 3),
(4, 'Large & Medium Enterprises (A-1)', 6),
(5, 'Small & Micro Enterprises (A-2)', 9),
(6, 'Traders (A-3)', 3),
(7, 'Proffesional & Education Institutions (A-4)', 2);

-- --------------------------------------------------------

--
-- Table structure for table `executive_members`
--

CREATE TABLE `executive_members` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `master_financial_year_id` int(11) NOT NULL,
  `executive_category_id` int(11) NOT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `status` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `executive_members`
--

INSERT INTO `executive_members` (`id`, `user_id`, `master_financial_year_id`, `executive_category_id`, `designation_id`, `status`, `created_by`, `created_on`) VALUES
(7, 2, 1, 1, 1, '', 0, '2017-07-27 10:52:45'),
(8, 2, 1, 1, 2, '', 0, '2017-07-27 10:52:45'),
(9, 3, 1, 1, 3, '', 0, '2017-07-27 10:52:45'),
(10, 4, 1, 1, NULL, '', 0, '2017-07-27 10:52:45'),
(11, 5, 1, 1, NULL, '', 0, '2017-07-27 10:52:45'),
(12, 5, 1, 1, NULL, '', 0, '2017-07-27 10:52:45'),
(13, 5, 1, 1, NULL, '', 0, '2017-07-27 10:52:45'),
(14, 5, 1, 2, NULL, '', 0, '2017-07-27 10:52:45'),
(15, 7, 1, 2, NULL, '', 0, '2017-07-27 10:52:45'),
(16, 15, 1, 3, NULL, '', 0, '2017-07-27 10:52:45'),
(17, 17, 1, 3, NULL, '', 0, '2017-07-27 10:52:45'),
(18, 24, 1, 3, NULL, '', 0, '2017-07-27 10:52:45'),
(19, 15, 1, 4, NULL, '', 0, '2017-07-27 10:52:45'),
(20, 30, 1, 4, NULL, '', 0, '2017-07-27 10:52:45'),
(21, 27, 1, 4, NULL, '', 0, '2017-07-27 10:52:45'),
(22, 26, 1, 4, NULL, '', 0, '2017-07-27 10:52:45'),
(23, 144, 1, 4, NULL, '', 0, '2017-07-27 10:52:45'),
(24, 17, 1, 4, NULL, '', 0, '2017-07-27 10:52:45'),
(25, 13, 1, 5, NULL, '', 0, '2017-07-27 10:52:45'),
(26, 5, 1, 5, NULL, '', 0, '2017-07-27 10:52:45'),
(27, 29, 1, 5, NULL, '', 0, '2017-07-27 10:52:45'),
(28, 25, 1, 5, NULL, '', 0, '2017-07-27 10:52:45'),
(29, 32, 1, 5, NULL, '', 0, '2017-07-27 10:52:45'),
(30, 56, 1, 5, NULL, '', 0, '2017-07-27 10:52:45'),
(31, 21, 1, 5, NULL, '', 0, '2017-07-27 10:52:45'),
(32, 54, 1, 5, NULL, '', 0, '2017-07-27 10:52:45'),
(33, 318, 1, 5, NULL, '', 0, '2017-07-27 10:52:45'),
(34, 405, 1, 6, NULL, '', 0, '2017-07-27 10:52:45'),
(35, 654, 1, 6, NULL, '', 0, '2017-07-27 10:52:45'),
(36, 638, 1, 6, NULL, '', 0, '2017-07-27 10:52:45'),
(37, 7, 1, 7, NULL, '', 0, '2017-07-27 10:52:45'),
(38, 22, 1, 7, NULL, '', 0, '2017-07-27 10:52:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `executive_categories`
--
ALTER TABLE `executive_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `executive_members`
--
ALTER TABLE `executive_members`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `executive_categories`
--
ALTER TABLE `executive_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `executive_members`
--
ALTER TABLE `executive_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
