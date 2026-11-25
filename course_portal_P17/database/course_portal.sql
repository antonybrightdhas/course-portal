-- phpMyAdmin SQL Dump
-- Database: `course_portal`

CREATE DATABASE IF NOT EXISTS `course_portal` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `course_portal`;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Table structure for table `ee_admin`
--

CREATE TABLE IF NOT EXISTS `ee_admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL DEFAULT 0,
  `otp` varchar(20) NOT NULL DEFAULT '',
  `sms_st` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ee_admin`
--

INSERT IGNORE INTO `ee_admin` (`username`, `password`, `mobile`, `otp`, `sms_st`) VALUES
('admin', 'admin', 9976570006, '2176', 0),
('staff', '1234', 9790530960, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ee_certificate`
--

CREATE TABLE IF NOT EXISTS `ee_certificate` (
  `id` int(11) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `duration` varchar(30) NOT NULL DEFAULT '',
  `filename` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ee_certificate`
--

INSERT IGNORE INTO `ee_certificate` (`id`, `uname`, `course`, `duration`, `filename`) VALUES
(1, 'taju', 'java', '6 months', 'M1Abstracts (1).docx'),
(2, 'admin', 'java', '6months', 'M2Docu-8.docx');

-- --------------------------------------------------------

--
-- Table structure for table `ee_course`
--

CREATE TABLE IF NOT EXISTS `ee_course` (
  `id` int(11) NOT NULL,
  `course` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_course` (`course`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ee_course`
--

INSERT IGNORE INTO `ee_course` (`id`, `course`) VALUES
(1, 'Java'),
(2, 'Python');

-- --------------------------------------------------------

--
-- Table structure for table `ee_feedback`
--

CREATE TABLE IF NOT EXISTS `ee_feedback` (
  `id` int(11) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `feedback` varchar(255) NOT NULL,
  `rdate` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ee_feedback`
--

INSERT IGNORE INTO `ee_feedback` (`id`, `uname`, `feedback`, `rdate`) VALUES
(1, 'raj', 'thank you', '14-02-2021');

-- --------------------------------------------------------

--
-- Table structure for table `ee_register`
--

CREATE TABLE IF NOT EXISTS `ee_register` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(15) NOT NULL DEFAULT '',
  `address` varchar(100) NOT NULL DEFAULT '',
  `contact` bigint(20) NOT NULL DEFAULT 0,
  `email` varchar(60) NOT NULL DEFAULT '',
  `course` int(11) NOT NULL DEFAULT 0,
  `fees` int(11) NOT NULL DEFAULT 0,
  `paid_st` int(11) NOT NULL DEFAULT 0,
  `learn1` double NOT NULL DEFAULT 0,
  `learn2` double NOT NULL DEFAULT 0,
  `learn3` double NOT NULL DEFAULT 0,
  `learn4` double NOT NULL DEFAULT 0,
  `learn5` double NOT NULL DEFAULT 0,
  `utype` varchar(20) NOT NULL DEFAULT '',
  `uname` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uniq_uname` (`uname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ee_register`
--

INSERT IGNORE INTO `ee_register` (`id`, `name`, `gender`, `dob`, `address`, `contact`, `email`, `course`, `fees`, `paid_st`, `learn1`, `learn2`, `learn3`, `learn4`, `learn5`, `utype`, `uname`, `pass`) VALUES
(1, 'Raj', 'Male', '21-10-1994', '11,trichy', 9976570006, 'raja@myinfo.in', 2, 6000, 1, 26.67, 40, 6.67, 0, 0, 'Book', 'taju', '1234'),
(2, 'godwin', 'Male', '09-03-2000', 'trichy', 9884324898, 't@gmail.com', 1, 3500, 1, 0, 0, 0, 0, 0, '', 'leo', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `ee_tutorial`
--

CREATE TABLE IF NOT EXISTS `ee_tutorial` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `subid` int(11) NOT NULL DEFAULT 0,
  `ttype` varchar(30) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL,
  `filename` varchar(200) NOT NULL DEFAULT '',
  `details` varchar(255) NOT NULL DEFAULT '',
  `rdate` varchar(15) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ee_tutorial`
--

INSERT IGNORE INTO `ee_tutorial` (`id`, `cid`, `subid`, `ttype`, `title`, `filename`, `details`, `rdate`) VALUES
(1, 1, 0, 'Link', 'w3schools for PHP', '', 'http://w3schools.com', ''),
(2, 1, 0, 'Book', 'Java OOPs', 'F2Important-paper.pdf', 'Java OOPs', '08-03-2020'),
(3, 1, 0, 'Video', 'myinfo', 'F3car.jpg', 'dfgdfgdfg', '14-02-2021'),
(5, 2, 0, 'Book', 'Loop', 'F5Integrated Health Care App or Portal.docx', 'program', '14-02-2021'),
(6, 2, 0, 'Video', 'String', 'F6conver.mp4', 'program', '14-02-2021'),
(7, 1, 0, 'Video', 'Array', 'F7conver.mp4', 'array', '23-02-2021');
