-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2012 at 04:41 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phonebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE IF NOT EXISTS `people` (
  `P_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Last` varchar(50) NOT NULL,
  `First` varchar(50) NOT NULL,
  PRIMARY KEY (`P_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`P_ID`, `Last`, `First`) VALUES
(3, 'Pich', 'Dara'),
(6, 'Pich', 'X'),
(8, 'Peng', 'Miao'),
(9, 'Peng', 'Xueyuan'),
(10, 'Pich', 'Dara');

-- --------------------------------------------------------

--
-- Table structure for table `phoneowner`
--

CREATE TABLE IF NOT EXISTS `phoneowner` (
  `P_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Phone_Number` bigint(20) NOT NULL,
  PRIMARY KEY (`P_ID`,`Phone_Number`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `phoneowner`
--

INSERT INTO `phoneowner` (`P_ID`, `Phone_Number`) VALUES
(3, 4388787677),
(6, 4388788106),
(8, 102030405),
(9, 7788990),
(9, 12345678),
(9, 4388788106),
(10, 7788990);

-- --------------------------------------------------------

--
-- Table structure for table `phone_info`
--

CREATE TABLE IF NOT EXISTS `phone_info` (
  `Phone_Number` bigint(20) NOT NULL,
  `Phone_Type` varchar(15) NOT NULL,
  PRIMARY KEY (`Phone_Number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phone_info`
--

INSERT INTO `phone_info` (`Phone_Number`, `Phone_Type`) VALUES
(7788990, 'home'),
(12345678, 'home'),
(102030405, 'office'),
(4388787677, 'mobile'),
(4388788106, 'home');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
