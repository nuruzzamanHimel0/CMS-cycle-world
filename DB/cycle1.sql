-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2018 at 11:47 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cycle1`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(15, 'himel', '$2y$10$N2I1ODg4ZmFjMzljNWJkMuakd6z5XubLwTqtOHhmBP0'),
(16, 'memia apu', '$2y$10$OGI1OTJhNGQ4YTJkZjVkO.1DYdGPqtkSYcGiGAR.0/c');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subject_id` int(3) NOT NULL,
  `manu_name` varchar(30) NOT NULL,
  `position` int(5) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  `content` text,
  PRIMARY KEY (`id`),
  KEY `subject_id` (`subject_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `subject_id`, `manu_name`, `position`, `visible`, `content`) VALUES
(3, 1, 'Our Goal new', 3, 1, ' Our Goal new Our Goal new Our Goal new               \r\n                '),
(4, 2, 'Cycle1', 4, 1, '                \r\n                '),
(5, 2, 'Spares', 2, 1, 'This is page text'),
(7, 3, 'Service 2', 2, 1, 'This is page text'),
(8, 3, 'Service 3', 3, 1, 'This is page text'),
(9, 4, 'ACC', 1, 1, 'This is page text'),
(10, 4, 'Picness', 2, 1, 'This is page text'),
(18, 1, 'Himel vai', 1, 0, '  Himel vaiHimel vaiHimel vai              \r\n                '),
(19, 12, 'hau mau khau', 1, 1, ' hau mau khauhau mau khauhau mau khauhau mau khauhau mau khauhau mau khauhau mau khauhau mau khauhau mau khauhau mau khau               \r\n                ');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE IF NOT EXISTS `subjects` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `manu_name` varchar(30) NOT NULL,
  `position` int(3) NOT NULL,
  `visible` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `manu_name`, `position`, `visible`) VALUES
(1, 'Program', 1, 1),
(2, 'Services', 3, 1),
(3, 'ROHAN', 4, 1),
(4, '', 8, 0),
(12, 'hahaha', 1, 0),
(13, 'lol', 6, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
