-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2017 at 08:39 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ucciudai_ucci`
--

-- --------------------------------------------------------

--
-- Table structure for table `invoice_attestations`
--

CREATE TABLE IF NOT EXISTS `invoice_attestations` (
`id` bigint(25) NOT NULL,
  `company_id` bigint(25) NOT NULL,
  `origin_no` bigint(30) NOT NULL,
  `exporter` varchar(200) NOT NULL,
  `consignee` varchar(2000) NOT NULL,
  `invoice_no` varchar(200) NOT NULL,
  `invoice_date` date NOT NULL,
  `manufacturer` varchar(2000) NOT NULL,
  `despatched_by` varchar(100) NOT NULL,
  `port_of_loading` text NOT NULL,
  `final_destination` text NOT NULL,
  `port_of_discharge` text NOT NULL,
  `date_current` date NOT NULL,
  `approve` int(4) NOT NULL COMMENT '1 for approved, 2 for not approved',
  `transaction_id` varchar(300) NOT NULL,
  `payment_status` varchar(100) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `approve_on` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `payment_amount` varchar(200) NOT NULL,
  `payment_tax_amount` varchar(200) NOT NULL,
  `show_amount` varchar(10) NOT NULL,
  `invoice_attachment` varchar(25) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `currency_unit` varchar(25) NOT NULL,
  `other_info` text NOT NULL,
  `status` varchar(20) NOT NULL,
  `coo_email` varchar(15) NOT NULL,
  `verify_by` int(10) NOT NULL,
  `verify_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `verify_remarks` text NOT NULL,
  `authorised_remarks` text NOT NULL,
  `authorised_by` int(10) NOT NULL,
  `authorised_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `payment_type` varchar(20) NOT NULL,
  `file_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice_attestations`
--

INSERT INTO `invoice_attestations` (`id`, `company_id`, `origin_no`, `exporter`, `consignee`, `invoice_no`, `invoice_date`, `manufacturer`, `despatched_by`, `port_of_loading`, `final_destination`, `port_of_discharge`, `date_current`, `approve`, `transaction_id`, `payment_status`, `approved_by`, `approve_on`, `payment_amount`, `payment_tax_amount`, `show_amount`, `invoice_attachment`, `currency`, `currency_unit`, `other_info`, `status`, `coo_email`, `verify_by`, `verify_on`, `verify_remarks`, `authorised_remarks`, `authorised_by`, `authorised_on`, `payment_type`, `file_name`) VALUES
(1, 584, 1, 'test', 'ggkjlnk', '13', '2017-11-18', 'gfhj', '1', 'hgjlkh', 'hjkl', 'ghujk', '2017-11-18', 0, '79fd9ba963229af9b75e', 'success', 586, '2017-11-20 05:33:41', '200', '36', 'Yes', 'true', '', '', 'ghjkftghujkl;', 'approved', 'yes', 581, '0000-00-00 00:00:00', '', '', 586, '2017-11-20 05:33:41', '', ''),
(2, 584, 0, 'test', 'fghjkl', '123', '2017-11-22', 'ghjk', '2', 'hjgh', 'gfhjk', 'inmk', '2017-11-20', 0, '1ca1a4396f482ff16d09', 'success', 0, '2017-11-20 07:14:39', '200', '36', 'Yes', 'true', '', '', 'fdghyjk', 'published', 'no', 0, '0000-00-00 00:00:00', '', '', 0, '0000-00-00 00:00:00', '', 'program-to-draw-a-line-using-bresenham-algorithm.pdf');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `invoice_attestations`
--
ALTER TABLE `invoice_attestations`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `invoice_attestations`
--
ALTER TABLE `invoice_attestations`
MODIFY `id` bigint(25) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
