-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2017 at 01:33 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

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
-- Table structure for table `news_letters`
--

CREATE TABLE `news_letters` (
  `id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `pdf_attachment` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_on` date NOT NULL,
  `created_by` int(10) NOT NULL,
  `edited_on` date NOT NULL,
  `edited_by` int(10) NOT NULL,
  `is_deleted` int(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_letters`
--

INSERT INTO `news_letters` (`id`, `title`, `cover_image`, `pdf_attachment`, `description`, `created_on`, `created_by`, `edited_on`, `edited_by`, `is_deleted`) VALUES
(3, 'news letters', 'img/newsletter/3/miracle-sai-baba.jpg', '', '<span style=\"color: rgb(255, 255, 255); font-family: Avenir, Arial, Helvetica, sans-serif; font-size: 18px; background-color: rgb(52, 63, 73);\">Instead of spending all your time trying to design a newsletter, plug your content into one of our&nbsp;</span><b style=\"color: rgb(255, 255, 255); font-family: Avenir, Arial, Helvetica, sans-serif; font-size: 18px; background-color: rgb(52, 63, 73);\">free newsletter templates</b><span style=\"color: rgb(255, 255, 255); font-family: Avenir, Arial, Helvetica, sans-serif; font-size: 18px; background-color: rgb(52, 63, 73);\">. You\'ll get the smart look you want in a fraction of the time. If you’re looking for inspiration, these sample newsletters and newsletter examples can be the start of your next great idea. We\'ve got a great selection of templates for teachers, for schools, and for preschools. With Lucidpress newsletter templates, creating a printable newsletter is a snap. Download or email your newsletter to share it with parents, students, and more. It\'s never been easier to keep your classroom on the same page.</span>', '2017-07-21', 654, '0000-00-00', 0, 0),
(4, 'news 2', 'img/newsletter/4/Yekaterinburg_skyline2.jpg', '', 'hi helo how are yoyu', '2017-07-21', 654, '0000-00-00', 0, 1),
(5, 'news 2', 'img/newsletter/5/Yekaterinburg_skyline2.jpg', '', 'hi helo how are yoyu', '2017-07-21', 654, '0000-00-00', 0, 1),
(6, 'namanana', 'img/newsletter/6/picasabackground.bmp', '', 'zxcxzzz', '2017-07-21', 654, '0000-00-00', 0, 1),
(7, 'jakaka', 'img/newsletter/7/Koala.jpg', '', 'sCXzXzXzxzxzX', '2017-07-21', 654, '0000-00-00', 0, 0),
(8, 'ravi', 'img/newsletter/8/Desktop.jpg', 'pdf/newsletter/8/', 'xzzxzX', '2017-07-21', 654, '0000-00-00', 0, 1),
(9, 'zxzxzx', 'img/newsletter/9/picasabackground.bmp', 'pdf/newsletter/9/Invoice-STL_IN078_BE-3397_17-18.pdf', 'zxzXX', '2017-07-21', 654, '0000-00-00', 0, 1),
(10, 'dsxasas', 'img/newsletter/10/picasabackground.bmp', '', 'asassasasass', '2017-07-21', 654, '0000-00-00', 0, 1),
(11, 'as', 'img/newsletter/11/picasabackground.bmp', 'pdf/newsletter/11/Invoice-STL_IN078_BE-3397_17-18.pdf', 'sdsdsdsdzxzxz', '2017-07-21', 654, '2017-07-21', 654, 1),
(12, 'sxsxsxs', 'img/newsletter/12/picasabackground.bmp', '', 'zxazaza', '2017-07-21', 654, '0000-00-00', 0, 0),
(13, 'dcdccdcdcd', 'img/newsletter/13/Yekaterinburg_skyline2.jpg', '', 'xxxxdcdcdc', '2017-07-21', 654, '0000-00-00', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `news_letters`
--
ALTER TABLE `news_letters`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `news_letters`
--
ALTER TABLE `news_letters`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
