-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2017 at 11:27 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ucci_old`
--

-- --------------------------------------------------------

--
-- Table structure for table `survey_answers`
--

CREATE TABLE `survey_answers` (
  `id` int(11) NOT NULL,
  `survey_question_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `survey_question_row_id` int(11) NOT NULL,
  `answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `survey_answer_rows`
--

CREATE TABLE `survey_answer_rows` (
  `id` int(11) NOT NULL,
  `survey_question_row_id` int(11) NOT NULL,
  `survey_answer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions`
--

CREATE TABLE `survey_questions` (
  `id` int(11) NOT NULL,
  `question` varchar(250) NOT NULL,
  `question_type` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_questions`
--

INSERT INTO `survey_questions` (`id`, `question`, `question_type`, `date`) VALUES
(1, 'What is the overall impact of GST and de-monetization on your business?', 'radio', '2017-09-04 08:31:04'),
(2, 'How useful do you find UCCI services for your business ?', 'radio', '2017-09-04 08:32:09'),
(3, 'How often do you need the services provided by UCCI?', 'radio', '2017-09-04 08:33:05'),
(4, 'How satisfied are you with UCCI''s services?', 'radio', '2017-09-04 08:34:28'),
(5, 'Which areas would you like UCCI to focus more on? (Choose Priority)', 'radio', '2017-09-04 08:35:53'),
(6, 'Which type of training would you like UCCI to conduct in near future? (Choose Priority)', 'radio', '2017-09-04 08:37:29'),
(7, 'Which industries you see booming in Udaipur in near future? (Choose 3)', 'checkbox', '2017-09-04 08:46:46'),
(8, 'Which UCCI facility you find the most appealing?', 'radio', '2017-09-04 08:48:17'),
(9, 'Would you like to give some suggestion on our newsletter? Please tell us how we can improve the content and information of our newsletters.', 'text', '2017-09-04 08:49:14'),
(10, 'Did you attend any recent event at UCCI? Please share your feedback', 'text', '2017-09-04 08:49:35');

-- --------------------------------------------------------

--
-- Table structure for table `survey_question_rows`
--

CREATE TABLE `survey_question_rows` (
  `id` int(11) NOT NULL,
  `survey_question_id` int(11) NOT NULL,
  `objective` varchar(200) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_question_rows`
--

INSERT INTO `survey_question_rows` (`id`, `survey_question_id`, `objective`, `date`) VALUES
(1, 1, 'Positive', '2017-09-04 08:31:04'),
(2, 1, 'Moderately Positive', '2017-09-04 08:31:04'),
(3, 1, 'Can''t say', '2017-09-04 08:31:04'),
(4, 1, 'Slightly Negative', '2017-09-04 08:31:04'),
(5, 1, 'Extremely Negative', '2017-09-04 08:31:04'),
(6, 2, 'Extremely useful', '2017-09-04 08:32:09'),
(7, 2, 'Useful', '2017-09-04 08:32:09'),
(8, 2, 'Not so useful', '2017-09-04 08:32:09'),
(9, 2, 'We don''t use the services', '2017-09-04 08:32:09'),
(10, 3, 'Very Frequently', '2017-09-04 08:33:05'),
(11, 3, 'Often but not very frequently', '2017-09-04 08:33:05'),
(12, 3, 'Rarely', '2017-09-04 08:33:05'),
(13, 3, 'Never', '2017-09-04 08:33:05'),
(14, 4, 'Yes absolutely', '2017-09-04 08:34:28'),
(15, 4, 'Somewhat', '2017-09-04 08:34:28'),
(16, 4, 'Maybe', '2017-09-04 08:34:28'),
(17, 4, 'Not so much', '2017-09-04 08:34:28'),
(18, 4, 'Not At All', '2017-09-04 08:34:28'),
(19, 5, 'Industry Grievances', '2017-09-04 08:35:53'),
(20, 5, 'Environment and Waste Management', '2017-09-04 08:35:53'),
(21, 5, 'Local Utility & Services', '2017-09-04 08:35:53'),
(22, 5, 'Skill Development and Training', '2017-09-04 08:35:53'),
(23, 5, 'Policy Making and Advocacy', '2017-09-04 08:35:53'),
(24, 5, 'MSME Projects', '2017-09-04 08:35:53'),
(25, 5, 'CSR', '2017-09-04 08:35:53'),
(26, 6, 'IT & Technology', '2017-09-04 08:37:29'),
(27, 6, 'Finance and Taxation', '2017-09-04 08:37:29'),
(28, 6, 'Legal and IP', '2017-09-04 08:37:29'),
(29, 6, 'Industrial Design', '2017-09-04 08:37:29'),
(30, 6, 'Manufacturing & Processing', '2017-09-04 08:37:29'),
(31, 6, 'Communication and Soft Skills', '2017-09-04 08:37:29'),
(32, 6, 'Other______________', '2017-09-04 08:37:29'),
(33, 7, 'IT Services', '2017-09-04 08:46:46'),
(34, 7, 'Industrial Manufacturing', '2017-09-04 08:46:46'),
(35, 7, 'Education', '2017-09-04 08:46:46'),
(36, 7, 'Tourism and Hospitality', '2017-09-04 08:46:46'),
(37, 7, 'Medical and Pharmaceutical', '2017-09-04 08:46:46'),
(38, 7, 'Food Processing', '2017-09-04 08:46:46'),
(39, 7, 'Media/Advertising/Film/TV', '2017-09-04 08:46:46'),
(40, 7, 'Retail ', '2017-09-04 08:46:46'),
(41, 7, 'Other_____________', '2017-09-04 08:46:46'),
(42, 8, ' Aravali Hall', '2017-09-04 08:48:17'),
(43, 8, 'Pyrotech-Tempsens Hall', '2017-09-04 08:48:17'),
(44, 8, 'PP Singhal Auditorium', '2017-09-04 08:48:17'),
(45, 8, 'Environment Park', '2017-09-04 08:48:17'),
(46, 8, 'Cafetaria', '2017-09-04 08:48:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `survey_answers`
--
ALTER TABLE `survey_answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_answer_rows`
--
ALTER TABLE `survey_answer_rows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_questions`
--
ALTER TABLE `survey_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `survey_question_rows`
--
ALTER TABLE `survey_question_rows`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `survey_answers`
--
ALTER TABLE `survey_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `survey_answer_rows`
--
ALTER TABLE `survey_answer_rows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `survey_questions`
--
ALTER TABLE `survey_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `survey_question_rows`
--
ALTER TABLE `survey_question_rows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
