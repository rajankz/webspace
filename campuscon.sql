SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `commentId` varchar(35) NOT NULL,
  `postId` varchar(35) NOT NULL,
  `username` varchar(35) NOT NULL,
  `isAnonymous` varchar(1) NOT NULL,
  `emailId` varchar(100) NOT NULL,
  `comment` blob NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `quarantined` varchar(1) NOT NULL,
  `deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`commentId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `postId` int(35) NOT NULL AUTO_INCREMENT,
  `username` varchar(35) NOT NULL,
  `emailId` varchar(35) NOT NULL,
  `postGroupId` varchar(35) NOT NULL,
  `isAnonymous` varchar(1) NOT NULL,
  `post` blob NOT NULL,
  `timeStamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `likeCount` int(5) NOT NULL,
  `dislikeCount` int(5) NOT NULL,
  `reportSpamCount` int(10) NOT NULL DEFAULT '0',
  `quarantined` varchar(1) NOT NULL,
  `deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`postId`),
  UNIQUE KEY `postId_2` (`postId`),
  UNIQUE KEY `postId_3` (`postId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

INSERT INTO `posts` (`postId`, `username`, `emailId`, `postGroupId`, `isAnonymous`, `post`, `timeStamp`, `likeCount`, `dislikeCount`, `reportSpamCount`, `quarantined`, `deleted`) VALUES
(1, 'rajankz', 'anonymous@gmail.com', '2', 'n', 0x48656c6c6f20554d44, '2012-02-24 13:05:32', 0, 0, 0, '', 'n'),
(2, 'rajankz', 'anonymous@gmail.com', '3', 'n', 0x68656c6c6f20434d552e2e0d0a77617a7a75707070703f3f3f0d0a2d72616a, '2012-03-09 14:24:54', 0, 0, 0, '', 'n');

DROP TABLE IF EXISTS `registration`;
CREATE TABLE IF NOT EXISTS `registration` (
  `emailId` varchar(35) NOT NULL,
  `confirmCode` varchar(35) NOT NULL,
  `univEmailExt` varchar(10) NOT NULL,
  `status` varchar(1) NOT NULL,
  `deleted` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `registration` (`emailId`, `confirmCode`, `univEmailExt`, `status`, `deleted`) VALUES
('rajankz@umd.edu', 'a669de6597c51e436c326106ab408d27', 'umd.edu', 'a', ''),
('rajankz@umd.edu', '72bfee583e166e7346bb97796b664098', 'umd.edu', 'a', ''),
('rajankz@umd.edu', '20fcf18cb2bc2e2685cbb1fb6493fdb0', 'umd.edu', 'a', '');

DROP TABLE IF EXISTS `universities`;
CREATE TABLE IF NOT EXISTS `universities` (
  `univId` int(16) NOT NULL AUTO_INCREMENT,
  `univName` varchar(100) NOT NULL,
  `univEmailExt` varchar(10) NOT NULL,
  `deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`univId`),
  UNIQUE KEY `univEmailExt` (`univEmailExt`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

INSERT INTO `universities` (`univId`, `univName`, `univEmailExt`, `deleted`) VALUES
(2, 'University of Maryland', 'umd.edu', 'n'),
(3, 'Carnegie Mellon University', 'cmu.edu', 'n'),
(1, 'Select University', 'null', 'n');

DROP TABLE IF EXISTS `univUser`;
CREATE TABLE IF NOT EXISTS `univUser` (
  `username` varchar(35) NOT NULL,
  `univEmailExt` varchar(10) NOT NULL,
  `userEmail` varchar(35) NOT NULL,
  `deleted` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `univUser` (`username`, `univEmailExt`, `userEmail`, `deleted`) VALUES
('rajankz', 'umd.edu', 'rajankz@umd.edu', '');

DROP TABLE IF EXISTS `userGroups`;
CREATE TABLE IF NOT EXISTS `userGroups` (
  `username` varchar(35) NOT NULL,
  `univId` varchar(16) NOT NULL,
  `deleted` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `userGroups` (`username`, `univId`, `deleted`) VALUES
('rajankz', '2', ''),
('rajankz', '3', '');

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(35) NOT NULL,
  `fname` varchar(35) NOT NULL,
  `lName` varchar(35) NOT NULL,
  `password_md5` varchar(100) NOT NULL,
  `deleted` varchar(1) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `users` (`username`, `fname`, `lName`, `password_md5`, `deleted`) VALUES
('rajankz', 'rajan', 'zachariah', 'f6565efd42846497a538b4d08a84bca8', '');
