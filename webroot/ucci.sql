-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 04, 2017 at 06:44 AM
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
-- Table structure for table `grievance_categories`
--

CREATE TABLE `grievance_categories` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grievance_categories`
--

INSERT INTO `grievance_categories` (`id`, `name`) VALUES
(1, 'General'),
(2, 'Personal');

-- --------------------------------------------------------

--
-- Table structure for table `grievance_issues`
--

CREATE TABLE `grievance_issues` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grievance_issues`
--

INSERT INTO `grievance_issues` (`id`, `name`) VALUES
(1, 'Repairing & Maintenace'),
(2, 'New construction/Work'),
(3, 'Clearance of Pending Matter'),
(4, 'Issues Regarding');

-- --------------------------------------------------------

--
-- Table structure for table `grievance_issue_relateds`
--

CREATE TABLE `grievance_issue_relateds` (
  `id` int(11) NOT NULL,
  `grievance_issue_id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grievance_issue_relateds`
--

INSERT INTO `grievance_issue_relateds` (`id`, `grievance_issue_id`, `name`) VALUES
(1, 1, 'Roads'),
(2, 1, 'Draingage'),
(3, 1, 'Street Light'),
(4, 1, 'Cleanliness'),
(5, 1, 'Others'),
(6, 2, 'New construction'),
(7, 2, 'Work'),
(8, 3, 'Application'),
(9, 3, 'File'),
(10, 3, 'Licence'),
(11, 3, 'Permission'),
(12, 4, 'Mining lease'),
(13, 4, 'Renewals'),
(14, 4, 'Leas Concession'),
(15, 4, 'Royalty'),
(16, 4, 'Dead Rent'),
(17, 4, 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `industrial_departments`
--

CREATE TABLE `industrial_departments` (
  `id` int(12) NOT NULL,
  `department_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `industrial_departments`
--

INSERT INTO `industrial_departments` (`id`, `department_name`) VALUES
(1, 'COLLECTORATE'),
(2, 'DIC'),
(3, 'RIICO'),
(4, 'PWD'),
(5, 'PHED'),
(6, 'AVVNL'),
(7, 'RSPCB'),
(8, 'DMG'),
(9, 'ESIC'),
(10, 'EPFO'),
(11, 'UIT'),
(12, 'NAGAR NIGAM'),
(13, 'NHAI'),
(14, 'RFC'),
(15, 'BSNL'),
(16, 'POLICE'),
(17, 'TRAFFIC POLICE'),
(18, 'LEAD BANK'),
(19, 'PASSPORT DEPTT'),
(20, 'COMMERCIAL TAXATION'),
(21, 'EXCISE'),
(22, 'CUSTOMS'),
(23, 'GOODS & SERVICE TAX'),
(24, 'INCOME TAX'),
(25, 'ANY OTHER DEPTT');

-- --------------------------------------------------------

--
-- Table structure for table `industrial_grievances`
--

CREATE TABLE `industrial_grievances` (
  `id` int(20) NOT NULL,
  `grievance_category_id` int(11) NOT NULL,
  `industrial_department_id` int(11) NOT NULL,
  `grievance_issue_id` int(11) NOT NULL,
  `lodge_same_grievance` varchar(20) NOT NULL,
  `grievance_period` varchar(12) NOT NULL,
  `grievance_age` int(10) NOT NULL,
  `document` varchar(200) NOT NULL,
  `grievance_issue_related_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `location` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `mail_status` int(4) NOT NULL DEFAULT '1',
  `complete_status` varchar(20) NOT NULL DEFAULT 'inprogress',
  `comment` text NOT NULL,
  `close_date` date NOT NULL,
  `reopen_reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `industrial_grievances`
--

INSERT INTO `industrial_grievances` (`id`, `grievance_category_id`, `industrial_department_id`, `grievance_issue_id`, `lodge_same_grievance`, `grievance_period`, `grievance_age`, `document`, `grievance_issue_related_id`, `description`, `location`, `created_on`, `created_by`, `mail_status`, `complete_status`, `comment`, `close_date`, `reopen_reason`) VALUES
(1, 2, 12, 1, 'No', 'Month', 2, 'img/grievance/1/thumb.jpg', 1, 'construction of  RTO road not completed', 'Udaipur ucci chamber', '2017-08-03 06:35:29', 18, 1, 'inprogress', '', '0000-00-00', ''),
(2, 2, 3, 3, 'Yes', 'Year', 1, '', 10, 'The RTO road which is opening at university road ,at university road a bottle neck is created . Due to which traffic The RTO road which is opening at university road ,at university road a bottle neck is created . Due to which traffic', 'Ucci chamber udaipur', '2017-08-03 06:37:27', 15, 1, 'reopen', 'construction of RTO road not completed', '2017-08-03', 'श्री कृष्ण विला गाड॔न के पास सरकारी जमीन पर कब्जा कर दुकाने व ट्युवेल आदी कर अतिक्रमण कर लिया है । जिस वजह से लोगो को परेशानियाँ हो रही है। \r\nअतः निवेदन है कि अतिक्रमण हटाओ अभियान के तहत मामला दर्ज किया जाए ।'),
(3, 1, 12, 4, 'No', 'Month', 2, '', 15, 'श्री कृष्ण विला गाड॔न के पास सरकारी जमीन पर कब्जा कर दुकाने व ट्युवेल आदी कर अतिक्रमण कर लिया है । जिस वजह से लोगो को परेशानियाँ हो रही है। ', 'Udaipur', '2017-08-02 06:40:56', 18, 1, 'reopen', 'The local residents will be able to complain about the pertinent issues ', '2017-08-03', 'श्री कृष्ण विला गाड॔न के पास सरकारी जमीन पर कब्जा कर दुकाने व ट्युवेल आदी कर अतिक्रमण कर लिया है । जिस वजह से लोगो को परेशानियाँ हो रही है। \r\nअतः निवेदन है कि अतिक्रमण हटाओ अभियान के तहत मामला दर्ज किया जाए ।'),
(4, 2, 12, 1, 'No', 'Month', 2, 'img/grievance/1/thumb.jpg', 1, 'construction of  RTO road not completed', 'Udaipur ucci chamber', '2017-08-04 06:35:29', 18, 1, 'inprogress', '', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `industrial_grievance_follows`
--

CREATE TABLE `industrial_grievance_follows` (
  `id` int(20) NOT NULL,
  `department_content` text CHARACTER SET ucs2 NOT NULL,
  `industrial_grievance_id` int(12) NOT NULL,
  `ucci_content` text CHARACTER SET ucs2 NOT NULL,
  `follow_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `industrial_grievance_follows`
--

INSERT INTO `industrial_grievance_follows` (`id`, `department_content`, `industrial_grievance_id`, `ucci_content`, `follow_date`) VALUES
(1, 'श्री कृष्ण विला गाड॔न के पास सरकारी जमीन पर कब्जा कर दुकाने व ट्युवेल आदी कर अतिक्रमण कर लिया है । जिस वजह से लोगो को परेशानियाँ हो रही है।', 2, 'श्री कृष्ण विला गाड॔न के पास सरकारी जमीन पर कब्जा कर दुकाने व ट्युवेल आदी कर अतिक्रमण कर लिया है । जिस वजह से लोगो को परेशानियाँ हो रही है।', '2017-08-03 06:43:27'),
(2, '', 3, 'श्री कृष्ण विला गाड॔न के पास सरकारी जमीन पर कब्जा कर दुकाने व ट्युवेल आदी कर अतिक्रमण कर लिया है । जिस वजह से लोगो को परेशानियाँ हो रही है।', '2017-08-03 07:05:01'),
(3, 'श्री कृष्ण विला गाड॔न के पास सरकारी जमीन पर कब्जा कर दुकाने व ट्युवेल आदी कर अतिक्रमण कर लिया है । जिस वजह से लोगो को परेशानियाँ हो रही है।', 1, 'श्री कृष्ण विला गाड॔न के पास सरकारी जमीन पर कब्जा कर दुकाने व ट्युवेल आदी कर अतिक्रमण कर लिया है । जिस वजह से लोगो को परेशानियाँ हो रही है।', '2017-08-03 07:05:52'),
(4, 'test', 3, 'test', '2017-08-03 07:08:51'),
(5, 'श्री कृष्ण विला गाड॔न के पास सरकारी जमीन पर कब्जा कर दुकाने व ट्युवेल आदी कर अतिक्रमण कर लिया है । जिस वजह से लोगो को परेशानियाँ हो रही है।', 2, 'श्री कृष्ण विला गाड॔न के पास सरकारी जमीन पर कब्जा कर दुकाने व ट्युवेल आदी कर अतिक्रमण कर लिया है । जिस वजह से लोगो को परेशानियाँ हो रही है।', '2017-08-03 12:05:40'),
(6, 'श्री कृष्ण विला गाड॔न के पास सरकारी जमीन पर कब्जा कर दुकाने व ट्युवेल आदी कर अतिक्रमण कर लिया है । जिस वजह से लोगो को परेशानियाँ हो रही है।', 2, 'श्री कृष्ण विला गाड॔न के पास सरकारी जमीन पर कब्जा कर दुकाने व ट्युवेल आदी कर अतिक्रमण कर लिया है । जिस वजह से लोगो को परेशानियाँ हो रही है।', '2017-08-03 12:05:47'),
(7, 'श्री कृष्ण विला गाड॔न के पास सरकारी जमीन पर कब्जा कर दुकाने व ट्युवेल आदी कर अतिक्रमण कर लिया है । जिस वजह से लोगो को परेशानियाँ हो रही है।', 2, 'श्री कृष्ण विला गाड॔न के पास सरकारी जमीन पर कब्जा कर दुकाने व ट्युवेल आदी कर अतिक्रमण कर लिया है । जिस वजह से लोगो को परेशानियाँ हो रही है।', '2017-08-03 12:05:54');

-- --------------------------------------------------------

--
-- Table structure for table `industrial_grievance_statuses`
--

CREATE TABLE `industrial_grievance_statuses` (
  `id` int(12) NOT NULL,
  `industrial_grievance_id` int(12) NOT NULL,
  `status` varchar(25) NOT NULL,
  `user_id` int(12) NOT NULL,
  `action_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` text NOT NULL,
  `reopen_reason` text CHARACTER SET ucs2 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `industrial_grievance_statuses`
--

INSERT INTO `industrial_grievance_statuses` (`id`, `industrial_grievance_id`, `status`, `user_id`, `action_date`, `comment`, `reopen_reason`) VALUES
(1, 2, 'hold', 654, '2017-08-03 06:45:57', 'construction of RTO road not completed', ''),
(2, 2, 'reopen', 654, '2017-08-03 06:46:55', '', 'so my humble request is to acquire the plot and increase the width of the road'),
(3, 3, 'hold', 654, '2017-08-03 06:51:29', 'The local residents will be able to complain about the pertinent issues ', ''),
(4, 3, 'reopen', 654, '2017-08-03 06:51:48', '', 'श्री कृष्ण विला गाड॔न के पास सरकारी जमीन पर कब्जा कर दुकाने व ट्युवेल आदी कर अतिक्रमण कर लिया है । जिस वजह से लोगो को परेशानियाँ हो रही है। \r\nअतः निवेदन है कि अतिक्रमण हटाओ अभियान के तहत मामला दर्ज किया जाए ।');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grievance_categories`
--
ALTER TABLE `grievance_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grievance_issues`
--
ALTER TABLE `grievance_issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grievance_issue_relateds`
--
ALTER TABLE `grievance_issue_relateds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `industrial_departments`
--
ALTER TABLE `industrial_departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `industrial_grievances`
--
ALTER TABLE `industrial_grievances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `industrial_grievance_follows`
--
ALTER TABLE `industrial_grievance_follows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `industrial_grievance_statuses`
--
ALTER TABLE `industrial_grievance_statuses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grievance_categories`
--
ALTER TABLE `grievance_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `grievance_issues`
--
ALTER TABLE `grievance_issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `grievance_issue_relateds`
--
ALTER TABLE `grievance_issue_relateds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `industrial_departments`
--
ALTER TABLE `industrial_departments`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `industrial_grievances`
--
ALTER TABLE `industrial_grievances`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `industrial_grievance_follows`
--
ALTER TABLE `industrial_grievance_follows`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `industrial_grievance_statuses`
--
ALTER TABLE `industrial_grievance_statuses`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
