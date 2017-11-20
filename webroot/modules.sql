-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 20, 2017 at 08:48 AM
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
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
`id` int(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `main_menu` varchar(30) NOT NULL,
  `main_menu_icon` varchar(20) NOT NULL,
  `sub_menu` varchar(20) NOT NULL,
  `sub_menu_icon` varchar(20) NOT NULL,
  `controller` varchar(40) NOT NULL,
  `page_name_url` varchar(50) NOT NULL,
  `icon_class_name` varchar(20) NOT NULL,
  `query_string` varchar(30) NOT NULL,
  `target` varchar(20) NOT NULL,
  `tooltips` text NOT NULL,
  `preferance` int(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `main_menu`, `main_menu_icon`, `sub_menu`, `sub_menu_icon`, `controller`, `page_name_url`, `icon_class_name`, `query_string`, `target`, `tooltips`, `preferance`) VALUES
(1, 'Dashboard', '', '', '', '', 'Users', 'index', 'fa fa-dashboard', '', '', '', 0),
(2, 'Member Registration', 'Registration', 'fa fa-book', '', '', 'Users', 'member_registration', 'fa fa-circle-o', '', '', '', 0),
(3, 'Generate Proforma Invoice', 'Proforma', 'fa fa-file-o', '', '', 'Users', 'member_performa_invoice', 'fa fa-file-text', '', '', '', 0),
(4, 'Invoice & Receipt', 'Receipt', 'fa fa-file-o', '', '', 'MemberReceipts', 'member_receipt', 'fa fa-circle-o', '', '', '', 0),
(5, 'General Receipt', 'Receipt', 'fa fa-file-o', '', '', 'MemberReceipts', 'general_receipt', 'fa fa-circle-o', '', '', '', 0),
(6, 'Generate COO', 'COO', 'fa fa-certificate', '', '', 'CertificateOrigins', 'certificate_origin', 'fa fa-circle-o', '', '', '', 0),
(7, 'Certificate of Origin Approve', 'Certificate', 'fa fa-certificate', '', '', 'CertificateOrigins', 'certificate_origin_approve', 'fa fa-circle-o', '', '', '', 0),
(8, 'Coo View', 'COO', 'fa fa-certificate', '', '', 'CertificateOrigins', 'certificate_origin_view_list', 'fa fa-circle-o', '', '', '', 0),
(10, 'Membership Fee', 'Master', 'fa fa-cogs', '', '', 'MasterMembershipFees', 'master_membership_fee', 'fa fa-circle-o', '', '', '', 0),
(11, 'Turn Over', 'Master', 'fa fa-cogs', '', '', 'MasterTurnOvers', 'master_turn_over', 'fa fa-circle-o', '', '', '', 0),
(12, 'Purpose', 'Master', 'fa fa-cogs', '', '', 'MasterPurposes', 'master_purpose', 'fa fa-circle-o', '', '', '', 0),
(13, 'Bank', 'Master', 'fa fa-cogs', '', '', 'MasterBanks', 'master_bank', 'fa fa-circle-o', '', '', '', 0),
(14, 'Invoice & Receipt Report', 'Receipt', 'fa fa-file', '', '', 'MemberReceipts', 'invoice_receipt_report', 'fa fa-circle-o', '', '', '', 0),
(15, 'Proforma Report', 'Proforma', 'fa fa-file', '', '', 'Users', 'performa_invoice_report', 'fa fa-circle-o', '', '', '', 0),
(16, 'User Rights', 'Settings', 'fa fa-wrench', '', '', 'UserRights', 'user_right', 'fa fa-circle-o', '', '', '', 0),
(17, 'Grade', 'Master', 'fa fa-cogs', '', '', 'MasterGrades', 'master_grade', 'fa fa-circle-o', '', '', '', 0),
(18, 'Category', 'Master', 'fa fa-cogs', '', '', 'MasterCategories', 'master_category', 'fa fa-circle-o', '', '', '', 0),
(19, 'Classification', 'Master', 'fa fa-cogs', '', '', 'MasterClassifications', 'master_classification', 'fa fa-circle-o', '', '', '', 0),
(20, 'Create Login', 'Settings', 'fa fa-wrench', '', '', 'Users', 'create_login', 'fa fa-circle-o', '', '', '', 0),
(21, 'Change Password', '', 'fa fa-wrench', '', '', 'Users', 'change_password', 'fa fa-circle-o', '', '', '', 0),
(22, 'Member View', 'Registration', 'fa fa-book', '', '', 'Users', 'member_view', 'fa fa-circle-o', '', '', '', 0),
(23, 'Role', 'Master', 'fa fa-cogs', '', '', 'Roles', 'master_role', 'fa fa-circle-o', '', '', '', 0),
(24, 'Invoice Due Report', 'Reports', 'fa fa-file-o', '', '', 'Users', 'invoice_due_report', 'fa fa-circle-o', '', '', '', 0),
(25, 'Reminder Report', 'Proforma', 'fa fa-file', '', '', 'Users', 'performa_invoice_reminder', 'fa fa-circle-o', '', '', '', 0),
(26, 'Invoice Received Report', 'Reports', 'fa fa-file-o', '', '', 'Users', 'invoice_received_report', 'fa fa-circle-o', '', '', '', 0),
(27, 'Notice Add', 'Notice', 'fa fa-file-text', '', '', 'Notices', 'add', 'fa fa-circle-o', '', '', '', 0),
(28, 'Notice View', 'Notice', 'fa fa-file-text', '', '', 'Notices', 'index', 'fa fa-circle-o', '', '', '', 0),
(29, 'Grievance Add', 'Grievance', 'fa fa-envelope', '', '', 'IndustrialGrievances', 'add', 'fa fa-circle-o', '', '', '', 0),
(30, 'Grievance View', 'Grievance', 'fa fa-envelope', '', '', 'IndustrialGrievances', 'index', 'fa fa-circle-o', '', '', '', 0),
(31, 'Business Vissa Add', 'BusinessVisa', 'fa fa-cc-visa', '', '', 'BusinessVisas', 'add', 'fa fa-circle-o', '', '', '', 0),
(32, 'Business Vissa View ', 'BusinessVisa', 'fa fa-cc-visa', '', '', 'BusinessVisas', 'index', 'fa fa-circle-o', '', '', '', 0),
(33, 'ID Card', '', '', '', '', 'Users', 'id_card_report', 'fa fa-user', '', '', '', 0),
(34, 'Event Add', 'Event', 'fa fa-file-text', '', '', 'Events', 'add', 'fa fa-circle-o', '', '', '', 0),
(35, 'Event View', 'Event', 'fa fa-file-text', '', '', 'Events', 'index', 'fa fa-circle-o', '', '', '', 0),
(36, 'Blog Add', 'Blog', 'fa fa-file-text', '', '', 'Blogs', 'add', 'fa fa-circle-o', '', '', '', 0),
(37, 'Blog View', 'Blog', 'fa fa-file-text', '', '', 'Blogs', 'index', 'fa fa-circle-o', '', '', '', 0),
(38, 'News Letter Add', 'News Letter', 'fa fa-file-text', '', '', 'News-letters', 'add', 'fa fa-circle-o', '', '', '', 0),
(39, 'News Letter view', 'News Letter', 'fa fa-file-text', '', '', 'News-letters', 'index', 'fa fa-circle-o', '', '', '', 0),
(40, 'Gallery view', 'Gallery ', 'fa fa-file-text', '', '', 'galleries', 'index', 'fa fa-circle-o', '', '', '', 0),
(41, 'Executive add', 'Executive Members', 'fa fa-file-text', '', '', 'executive-members', 'add', 'fa fa-circle-o', '', '', '', 0),
(42, 'Executive view', 'Executive Members', 'fa fa-file-text', '', '', 'executive-members', 'index', 'fa fa-circle-o', '', '', '', 0),
(43, 'Project Edit', 'Projects', 'fa fa-file-text', '', '', 'Projects', 'edit/1', 'fa fa-circle-o', '', '', '', 0),
(44, ' Adv Add', 'Advertisement', 'fa fa-file-text', '', '', 'Advertisements', 'add', 'fa fa-circle-o', '', '', '', 0),
(45, 'Af .Add', 'Affilations', 'fa fa-file-text', '', '', 'AffilationRegistrations', 'add', 'fa fa-circle-o', '', '', '', 0),
(46, 'Sub Committee Add', 'Sub Committees', 'fa fa-file-text', '', '', 'sub-committees', 'add', 'fa fa-circle-o', '', '', '', 0),
(47, 'Sub Committee View', 'Sub Committees', 'fa fa-file-text', '', '', 'sub-committees', 'index', 'fa fa-circle-o', '', '', '', 0),
(48, 'In. Add', 'initiatives', 'fa fa-file-text', '', '', 'initiatives', 'add', 'fa fa-circle-o', '', '', '', 0),
(49, 'In View', 'initiatives', 'fa fa-file-text', '', '', 'initiatives', 'index', 'fa fa-circle-o', '', '', '', 0),
(50, 'Gallery Add', 'Gallery ', 'fa fa-file-text', '', '', 'galleries', 'add', 'fa fa-circle-o', '', '', '', 0),
(51, 'Facility View', 'Facility-bookings', 'fa fa-file-text', '', '', 'facility-bookings', 'index', 'fa fa-circle-o', '', '', '', 0),
(52, 'Update', 'Profile update', 'fa fa-file-text', '', '', 'users', 'profile-update', 'fa fa-circle-o', '', '', '', 0),
(53, 'Approval', 'Registration', 'fa fa-file-text', '', '', 'users', 'profile_approval', 'fa fa-circle-o', '', '', '', 0),
(54, 'view', 'Profile update', 'fa fa-file-text', '', '', 'users', 'profile-member-view', 'fa fa-circle-o', '', '', '', 0),
(55, 'Directory', '', 'fa fa-file-text', '', '', 'users', 'member-list', 'fa fa-circle-o', '', '', '', 0),
(56, 'Suppliers Add', 'Suppliers', 'fa fa-file-text', '', '', 'Suppliers', 'add', 'fa fa-circle-o', '', '', '', 0),
(57, 'Suppliers View', 'Suppliers', 'fa fa-file-text', '', '', 'Suppliers', 'index', 'fa fa-circle-o', '', '', '', 0),
(58, 'Purchase Order Add', 'Purchase Order', 'fa fa-file-text', '', '', 'purchase-orders', 'add', 'fa fa-circle-o', '', '', '', 0),
(59, 'Purchase Order View', 'Purchase Order', 'fa fa-file-text', '', '', 'purchase-orders', 'index', 'fa fa-circle-o', '', '', '', 0),
(60, 'Non member exporter add', 'Registration', 'fa fa-file-text', '', '', 'Companies', 'non-member-registration', 'fa fa-circle-o', '', '', '', 0),
(61, 'Documents', '', '', '', '', 'Companies', 'documents', 'fa fa-upload', '', '', '', 5),
(62, 'Draft COO', 'COO', 'fa fa-certificate', '', '', 'CertificateOrigins', 'certificateOriginDraftView', 'fa fa-circle-o', '', '', '', 0),
(63, 'Ucci Staff Login', 'Settings', 'fa fa-wrench', '', '', 'Companies', 'UcciStaffLogin', 'fa fa-circle-o', '', '', '', 0),
(64, 'Published COO', 'COO', 'fa fa-certificate', '', '', 'CertificateOrigins', 'certificate-origin-view-published', 'fa fa-circle-o', '', '', '', 0),
(65, 'Coo Coupon Generate', 'COO', 'fa fa-file-o', '', '', 'CooCoupons', 'add', 'fa fa-circle-o', '', '', '', 0),
(66, 'Invoice Attestation Add', 'Invoice Attestation', 'fa fa-file-o', '', '', 'InvoiceAttestations', 'add', 'fa fa-circle-o', '', '', '', 0),
(67, 'Invoice Attestation View', 'Invoice Attestation', 'fa fa-file-o', '', '', 'InvoiceAttestations', 'Invoice-attestation-view-list', 'fa fa-circle-o', '', '', '', 0),
(68, 'Approve Invoice Attestation', 'Invoice Attestation', 'fa fa-certificate', '', '', 'InvoiceAttestations', 'InvoiceAttestationApprove', 'fa fa-circle-o', '', '', '', 0),
(69, 'Invoice Attestation Draft View', 'Invoice Attestation', 'fa fa-certificate', '', '', 'InvoiceAttestations', 'invoiceAttestationDraftView', 'fa fa-circle-o', '', '', '', 0),
(70, 'Invoice Attestation View list', 'Invoice Attestation', 'fa fa-certificate', '', '', 'InvoiceAttestations', 'invoiceAttestationViewPublished', 'fa fa-circle-o', '', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
MODIFY `id` int(30) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=71;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
