-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 13, 2023 at 08:14 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `health_mit`
--

-- --------------------------------------------------------

--
-- Table structure for table `hms_data`
--

DROP TABLE IF EXISTS `hms_data`;
CREATE TABLE IF NOT EXISTS `hms_data` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `userid` varchar(255) NOT NULL,
  `heartbeat` varchar(255) NOT NULL,
  `temperature` varchar(255) NOT NULL,
  `spo` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_data`
--

INSERT INTO `hms_data` (`id`, `userid`, `heartbeat`, `temperature`, `spo`, `time`, `date`) VALUES
(10, 'PT01', '80', '102', '119', '12:44 PM', '23/05/2021'),
(11, 'PT01', '76', '101', '122', '01:13 PM', '23/05/2021'),
(12, 'PT01', '79', '101', '121', '02:07 PM', '23/05/2021'),
(13, 'PT01', '84', '102', '125', '03:17 PM', '23/05/2021');

-- --------------------------------------------------------

--
-- Table structure for table `hms_doctors`
--

DROP TABLE IF EXISTS `hms_doctors`;
CREATE TABLE IF NOT EXISTS `hms_doctors` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `loginid` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hms_doctors`
--

INSERT INTO `hms_doctors` (`id`, `loginid`, `name`, `password`) VALUES
(4, 'ashish', 'Ashish Vegan', '8cb2237d0679ca88db6464eac60da96345513964');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
