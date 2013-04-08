-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 14, 2012 at 03:50 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ugst`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `file_name` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `wosksheet_id` bigint(20) unsigned NOT NULL,
  `worksheet_order` tinyint(4) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `attachments`
--


-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `worksheetId` int(11) DEFAULT NULL,
  `letterCode` varchar(5) DEFAULT NULL,
  `assignedDate` datetime DEFAULT NULL,
  `reviewerId` varchar(45) DEFAULT NULL,
  `review` text,
  `reviewOrder` tinyint(2) DEFAULT NULL,
  `invalidReview` tinyint(1) DEFAULT '0',
  `statusCode` tinyint(2) DEFAULT '1',
  `locked` tinyint(1) DEFAULT '0',
  `reviewDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `worksheetId`, `letterCode`, `assignedDate`, `reviewerId`, `review`, `reviewOrder`, `invalidReview`, `statusCode`, `locked`, `reviewDate`) VALUES
(9, 3, '2F', NULL, '22', '', 1, 0, 1, 0, NULL),
(12, 3, '3A', NULL, '26', 'sdfdfs', 2, 0, 4, 0, NULL),
(13, 4, '8A*', NULL, '22', '', 1, 0, 4, 0, NULL),
(14, 4, NULL, NULL, '26', NULL, 2, 0, 1, 0, NULL),
(15, 3, NULL, NULL, '26', NULL, 3, 0, 1, 0, NULL),
(16, 2, NULL, NULL, '22', NULL, 1, 0, 1, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roleName` (`role_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=5461 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'admin'),
(3, 'creator'),
(2, 'reviewer');

-- --------------------------------------------------------

--
-- Table structure for table `select_options`
--

CREATE TABLE IF NOT EXISTS `select_options` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `subtype` varchar(255) NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(2048) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=442 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `select_options`
--

INSERT INTO `select_options` (`id`, `type`, `subtype`, `code`, `name`, `description`) VALUES
(1, 'block', 'financial', '00', 'Unavailable', 'Unavailable or not collected'),
(2, 'block', 'financial', '01', 'Eligible', 'Financial eligibility'),
(3, 'block', 'financial', '02', 'Contract & Loan', 'Contract and loan problem'),
(4, 'block', 'financial', '03', 'SAR > Select', 'SAR balance > or = to select balance'),
(5, 'block', 'financial', '04', 'Severed Services', 'Severed university services'),
(6, 'block', 'financial', '05', 'Delin. SCCU', 'Delinquent account at SCCU'),
(7, 'block', 'financial', '06', 'SEV+DEL SCCU', 'Severed and delinquent account at SCCU'),
(8, 'block', 'financial', '07', 'Adjudged', 'Adjudged account'),
(9, 'block', 'financial', '08', 'Loan Interview', 'NDSL or house loan interview'),
(10, 'block', 'financial', '09', 'BAL+LN INT', 'SAR bal not < sel bal & NDSL/HS loan int'),
(11, 'block', 'financial', '10', 'SEV+EXIT INT', 'Severed services and exit interview'),
(12, 'block', 'financial', '11', 'DEL+EXIT INT', 'Delinquent account and exit interview'),
(13, 'block', 'financial', '12', 'DEL SEV+EXIT INT', 'Delinquent severed and exit interview'),
(14, 'block', 'financial', '13', 'ADJ+EXIT INT', 'Adjudged and exit interview'),
(15, 'block', 'financial', '99', 'UNDEF INELIGIBLE', 'Undefined Ineligible'),
(16, 'block', 'judicial', '00', 'Unavailable', 'Unavailable or not collected'),
(17, 'block', 'judicial', '01', 'Eligible', 'Eligible'),
(18, 'block', 'judicial', '02', 'NO-REG OK-REC', 'Cannot register, records may be released'),
(19, 'block', 'judicial', '03', 'OK-REG NO-REC', 'May register, do not release records'),
(20, 'block', 'judicial', '04', 'NO-REG NO-REC', 'Cannot register, do not release records'),
(21, 'block', 'judicial', '05', 'NOTIFY JUD', 'Notify judiciary of students'),
(22, 'decision', 'prior_reenrollment', '1A', 'Denial/50', NULL),
(23, 'decision', 'prior_reenrollment', '2A', 'Denial/50', NULL),
(24, 'decision', 'prior_reenrollment', '2F', 'Denial/50', NULL),
(25, 'decision', 'prior_reenrollment', '3A', 'Denial/50', NULL),
(26, 'decision', 'prior_reenrollment', '3F', 'Denial/50', NULL),
(27, 'decision', 'prior_reenrollment', '4X', 'Denial/50', NULL),
(28, 'decision', 'prior_reenrollment', '50', 'Denial/5I', NULL),
(29, 'decision', 'prior_reenrollment', '60', 'Pending/08', NULL),
(30, 'decision', 'prior_reenrollment', '80', 'Readmit/70', NULL),
(31, 'decision', 'prior_reenrollment', '86', 'Readmit/70', NULL),
(32, 'decision', 'prior_reenrollment', '6M', 'Pending/08', NULL),
(33, 'decision', 'prior_reenrollment', '6X', 'Pending/08', NULL),
(34, 'decision', 'prior_reenrollment', '8A*', 'Approval/70', NULL),
(35, 'decision', 'prior_reenrollment', '8A', 'Cancel/34', NULL),
(36, 'decision', 'prior_reenrollment', 'RC', 'Approval/71', NULL),
(37, 'decision', 'prior_reenrollment', '8N', 'Approval/71', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `status_codes`
--

CREATE TABLE IF NOT EXISTS `status_codes` (
  `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  `status_description` varchar(255) DEFAULT NULL,
  `type` varchar(45) NOT NULL,
  `order` tinyint(3) DEFAULT NULL COMMENT 'for order of status actions',
  PRIMARY KEY (`id`),
  UNIQUE KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `status_codes`
--

INSERT INTO `status_codes` (`id`, `status`, `status_description`, `type`, `order`) VALUES
(1, 'Worksheet Incomplete', NULL, 'worksheet', 1),
(2, 'Worksheet Complete', NULL, 'worksheet', 2),
(3, 'Pending First Review', NULL, 'worksheet', 3),
(4, 'First Review Complete', NULL, 'worksheet', 4),
(5, 'Pending Second Review', NULL, 'worksheet', 5),
(6, 'Pending Third Review', NULL, 'worksheet', 6),
(7, 'Pending Decision', NULL, 'worksheet', 7),
(8, 'Decision Made', NULL, 'worksheet', 8),
(9, 'Assigned', NULL, 'review', 2),
(10, 'Started', NULL, 'review', 3),
(11, 'Completed', NULL, 'review', 4),
(12, 'Reviewer Selected', NULL, 'review', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `uid` varchar(100) NOT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emailId` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `lastModifiedTime` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `fullName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `emailId` (`emailId`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AVG_ROW_LENGTH=5461 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `emailId`, `password`, `username`, `role`, `is_active`, `lastModifiedTime`, `fullName`) VALUES
(20, 'rajankz@gmail.com', 'cef941c7f3bb2b3d9c3361ecdef800e0730f0acc', 'rajankz', 'admin', 1, '2012-09-05 12:34:47', 'Rajan Zachariah'),
(22, 'simple@abc.org', 'cef941c7f3bb2b3d9c3361ecdef800e0730f0acc', 'reviewer', 'reviewer', 1, '2012-09-07 14:52:51', 'Reviewer One'),
(23, 'hello@world.com', 'cef941c7f3bb2b3d9c3361ecdef800e0730f0acc', 'creator', 'creator', 1, '2012-09-04 11:07:54', 'Creator One'),
(25, 'rajankz@umd.edu', 'cef941c7f3bb2b3d9c3361ecdef800e0730f0acc', 'admin', 'admin', 1, '2012-09-04 11:07:54', 'Admin One'),
(26, 'simple1@abc.org', 'cef941c7f3bb2b3d9c3361ecdef800e0730f0acc', 'reviewer1', 'reviewer', 1, '2012-09-07 14:52:51', 'Reviewer Two');

-- --------------------------------------------------------

--
-- Table structure for table `worksheets`
--

CREATE TABLE IF NOT EXISTS `worksheets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) DEFAULT NULL,
  `financialBlock` varchar(5) DEFAULT NULL,
  `judicialBlock` varchar(5) DEFAULT NULL,
  `missingTranscripts` tinyint(1) DEFAULT NULL,
  `missingEssay` tinyint(1) DEFAULT NULL,
  `numReEnrollApps` int(11) DEFAULT NULL,
  `numApprovals` int(11) DEFAULT NULL,
  `numDenials` int(11) DEFAULT NULL,
  `numPendingDecision` int(11) DEFAULT NULL,
  `numCancelledApps` int(11) DEFAULT NULL,
  `creditsRepeated` int(11) DEFAULT NULL,
  `needPermToReturnToMajor` tinyint(1) DEFAULT NULL,
  `needPermToRegisterThirdTime` tinyint(1) DEFAULT NULL,
  `needPermToRepeatMoreThan18` tinyint(1) DEFAULT NULL,
  `attemptedUMDCredits` int(11) DEFAULT NULL,
  `cgpa` float DEFAULT NULL,
  `needCreditsAt275` int(11) DEFAULT NULL,
  `needCreditsAt25` int(11) DEFAULT NULL,
  `needCreditsAt225` int(11) DEFAULT NULL,
  `currentMajor` varchar(100) DEFAULT NULL,
  `requestedMajor` varchar(100) DEFAULT NULL,
  `nonDegreeSeeking` tinyint(1) DEFAULT NULL,
  `shadyGrove` tinyint(1) DEFAULT NULL,
  `repeatingCoursesOffSem` tinyint(1) DEFAULT NULL,
  `dismissedLastSem` tinyint(1) DEFAULT NULL,
  `withdrewLastSem` tinyint(1) DEFAULT NULL,
  `registeredForOffSem` tinyint(1) DEFAULT NULL,
  `additionalComments` text,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `statusId` tinyint(4) DEFAULT '0',
  `createdBy` varchar(255) NOT NULL,
  `lastUpdateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `assignedToId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `worksheets`
--

INSERT INTO `worksheets` (`id`, `uid`, `financialBlock`, `judicialBlock`, `missingTranscripts`, `missingEssay`, `numReEnrollApps`, `numApprovals`, `numDenials`, `numPendingDecision`, `numCancelledApps`, `creditsRepeated`, `needPermToReturnToMajor`, `needPermToRegisterThirdTime`, `needPermToRepeatMoreThan18`, `attemptedUMDCredits`, `cgpa`, `needCreditsAt275`, `needCreditsAt25`, `needCreditsAt225`, `currentMajor`, `requestedMajor`, `nonDegreeSeeking`, `shadyGrove`, `repeatingCoursesOffSem`, `dismissedLastSem`, `withdrewLastSem`, `registeredForOffSem`, `additionalComments`, `firstName`, `lastName`, `statusId`, `createdBy`, `lastUpdateTime`, `assignedToId`) VALUES
(2, '123123', '05', '01', 1, 1, 100, 80, 10, 5, 5, 5, 1, 1, 1, 100, 2, 6, 3, 3, 'HCI', 'CMNS', 1, 1, 1, 1, 1, 1, 'This is a sample Comment!\r\nHello World!\r\n----------------------------------\r\nThis is some more comments!!!!\r\n\r\nThis is a sample Comment!\r\nHello World!\r\n----------------------------------\r\nThis is some more comments!!!!\r\n\r\nThis is a sample Comment!\r\nHello World!\r\n----------------------------------\r\nThis is some more comments!!!!', 'Thomas', 'Mathew', 1, '', '2012-08-23 13:34:35', NULL),
(3, '12345', '01', '03', 0, 0, 9, 8, 0, 1, NULL, 1, 0, 0, 0, 36, 3.99, NULL, NULL, NULL, 'HCI', '', 1, 1, 0, 1, 1, 1, 'This is the section for additional notes.', 'rajan', 'zachariah', 1, '', '2012-08-23 13:34:35', NULL),
(4, '12345', '02', '02', 1, 1, 1, 1, 1, 1, 1, 2, 0, 1, 1, 35, 1, NULL, NULL, NULL, 'hci', 'cmns', 0, 0, 0, 0, 0, 0, 'sdfsdf', 'dfhkljhl', 'klhkhl', 1, '', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `worksheets_old`
--

CREATE TABLE IF NOT EXISTS `worksheets_old` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uid` varchar(100) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `status_id` tinyint(4) NOT NULL,
  `lastModifiedBy` varchar(255) NOT NULL,
  `lastModifieddate` datetime NOT NULL,
  `dataId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `worksheets_old`
--

