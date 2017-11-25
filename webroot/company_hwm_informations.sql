-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2017 at 12:09 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23

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
-- Table structure for table `company_hwm_informations`
--

CREATE TABLE `company_hwm_informations` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `waste_description` varchar(100) NOT NULL,
  `waste_type_number` varchar(50) NOT NULL,
  `process_generating_waste` varchar(100) NOT NULL,
  `generation_rate` varchar(100) NOT NULL,
  `disposal_arrangement` varchar(100) NOT NULL,
  `chemical_composition` varchar(30) NOT NULL,
  `company_service_type` varchar(30) NOT NULL,
  `chemical_composition_sheet` text NOT NULL,
  `off_site_company_name` varchar(100) NOT NULL,
  `off_site_address` text NOT NULL,
  `on_site_disposal_method` varchar(100) NOT NULL,
  `disposal_waste_use` varchar(50) NOT NULL,
  `waste_stream` varchar(50) NOT NULL,
  `solid_type` varchar(50) NOT NULL,
  `liquid_type` varchar(50) NOT NULL,
  `sludge_type` varchar(50) NOT NULL,
  `constituents_present` text NOT NULL,
  `principal_components` text NOT NULL,
  `acidic_basic` text NOT NULL,
  `waste_combustible` text NOT NULL,
  `potential_reuse` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_hwm_informations`
--
ALTER TABLE `company_hwm_informations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company_hwm_informations`
--
ALTER TABLE `company_hwm_informations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
