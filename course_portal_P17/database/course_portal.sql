-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 19, 2021 at 05:56 AM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `course_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `ee_admin`
--

CREATE TABLE `ee_admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `otp` varchar(20) NOT NULL,
  `sms_st` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ee_admin`
--

INSERT INTO `ee_admin` (`username`, `password`, `mobile`, `otp`, `sms_st`) VALUES
('admin', 'admin', 9976570006, '2176', 0),
('staff', '1234', 9790530960, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ee_certificate`
--

CREATE TABLE `ee_certificate` (
  `id` int(11) NOT NULL,
  `uname` varchar(11) NOT NULL,
  `course` varchar(11) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `filename` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ee_certificate`
--

INSERT INTO `ee_certificate` (`id`, `uname`, `course`, `duration`, `filename`) VALUES
(1, 'taju', 'java', '6 months', 'M1Abstracts (1).docx'),
(1, 'taju', 'java', '6 months', 'M1Abstracts (1).docx'),
(2, 'admin', 'java', '6months', 'M2Docu-8.docx');

-- --------------------------------------------------------

--
-- Table structure for table `ee_course`
--

CREATE TABLE `ee_course` (
  `id` int(11) NOT NULL,
  `course` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ee_course`
--

INSERT INTO `ee_course` (`id`, `course`) VALUES
(1, 'Java'),
(2, 'Python');

-- --------------------------------------------------------

--
-- Table structure for table `ee_feedback`
--

CREATE TABLE `ee_feedback` (
  `id` int(11) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `feedback` varchar(100) NOT NULL,
  `rdate` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ee_feedback`
--

INSERT INTO `ee_feedback` (`id`, `uname`, `feedback`, `rdate`) VALUES
(1, 'raj', 'thank you', '14-02-2021');

-- --------------------------------------------------------

--
-- Table structure for table `ee_register`
--

CREATE TABLE `ee_register` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact` bigint(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `course` int(11) NOT NULL,
  `fees` int(11) NOT NULL,
  `paid_st` int(11) NOT NULL,
  `learn1` double NOT NULL,
  `learn2` double NOT NULL,
  `learn3` double NOT NULL,
  `learn4` double NOT NULL,
  `learn5` double NOT NULL,
  `utype` varchar(20) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ee_register`
--

INSERT INTO `ee_register` (`id`, `name`, `gender`, `dob`, `address`, `contact`, `email`, `course`, `fees`, `paid_st`, `learn1`, `learn2`, `learn3`, `learn4`, `learn5`, `utype`, `uname`, `pass`) VALUES
(1, 'Raj', 'Male', '21-10-1994', '11,trichy', 9976570006, 'raja@myinfo.in', 2, 6000, 1, 26.67, 40, 6.67, 0, 0, 'Book', 'taju', '1234'),
(2, 'godwin', 'Male', '09-03-2000', 'trichy', 9884324898, 't@gmail.com', 1, 3500, 1, 0, 0, 0, 0, 0, '', 'leo', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `ee_tutorial`
--

CREATE TABLE `ee_tutorial` (
  `id` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `subid` int(11) NOT NULL,
  `ttype` varchar(30) NOT NULL,
  `title` varchar(50) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `details` varchar(200) NOT NULL,
  `rdate` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ee_tutorial`
--

INSERT INTO `ee_tutorial` (`id`, `cid`, `subid`, `ttype`, `title`, `filename`, `details`, `rdate`) VALUES
(1, 1, 0, 'Link', 'w3schools for PHP', '', 'http://w3schools.com', ''),
(2, 1, 0, 'Book', 'Java OOPs', 'F2Important-paper.pdf', 'Java OOPs', '08-03-2020'),
(3, 1, 0, 'Video', 'myinfo', 'F3car.jpg', 'dfgdfgdfg', '14-02-2021'),
(5, 2, 0, 'Book', 'Loop', 'F5Integrated Health Care App or Portal.docx', 'program', '14-02-2021'),
(6, 2, 0, 'Video', 'String', 'F6conver.mp4', 'program', '14-02-2021'),
(7, 1, 0, 'Video', 'Array', 'F7conver.mp4', 'array', '23-02-2021');
