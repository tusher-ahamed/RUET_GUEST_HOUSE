-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 25, 2017 at 03:05 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `testdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE IF NOT EXISTS `request` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `no_of_guest` int(100) DEFAULT NULL,
  `location` varchar(100) NOT NULL,
  `datefrom` date DEFAULT NULL,
  `dateto` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `name`, `email`, `designation`, `no_of_guest`, `location`, `datefrom`, `dateto`) VALUES
(5, 'Tusher Ahamed', 'ronak@gmail.com', 'administration', 7, 'ruet', '2017-08-25', '2017-08-30'),
(6, 'utpol', 'utpol@gmail.com', 'lecturer', 5, 'dhaka', '2017-08-29', '2017-08-31'),
(10, 'Tusher Ahamed', 'ronak@gmail.com', 'lecturer', 5, 'ruet', '2017-08-24', '2017-08-28'),
(11, 'partho pritom', 'partho@gmail.com', 'lecturer', 2, 'ruet', '2017-08-14', '2017-08-22');

-- --------------------------------------------------------

--
-- Table structure for table `room_allocation`
--

CREATE TABLE IF NOT EXISTS `room_allocation` (
  `name` varchar(100) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `no_of_room` int(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `roomtype` varchar(100) NOT NULL,
  `datefrom` date DEFAULT NULL,
  `dateto` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_allocation`
--

INSERT INTO `room_allocation` (`name`, `designation`, `no_of_room`, `location`, `roomtype`, `datefrom`, `dateto`) VALUES
('Tusher', 'Administration', 1, 'DHAKA', 'AC', '2017-08-23', '2017-08-29'),
('Tusher', 'Administration', 1, 'DHAKA', 'AC', '2017-08-23', '2017-08-29'),
('Tusher Ahamed', 'Assistant professor', 3, 'DHAKA', 'AC', '2017-08-28', '2017-08-31'),
('partho pritom', 'Lecturer', 1, 'RUET', 'NON-AC', '2017-08-14', '2017-08-22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(40) NOT NULL,
  `role` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(4, 'Admin', 'adminruet@gmail.com', '12c64ee05d7419248962b1378342e098', 'admin'),
(5, 'Tusher Ahamed', 'tusher@gmail.com', '12c64ee05d7419248962b1378342e098', 'user'),
(6, 'partho pritom', 'partho@gmail.com', '12c64ee05d7419248962b1378342e098', 'user');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
