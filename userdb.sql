-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 15, 2015 at 09:48 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `secudev1`
--

-- --------------------------------------------------------

--
-- Table structure for table `userdb`
--

CREATE TABLE IF NOT EXISTS `userdb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `male` tinyint(1) NOT NULL,
  `salutation` varchar(11) NOT NULL,
  `bday` date NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `about` longtext NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `userdb`
--

INSERT INTO `userdb` (`id`, `first_name`, `last_name`, `male`, `salutation`, `bday`, `username`, `password`, `about`, `admin`) VALUES
(1, 'Mike', 'Dayupay', 1, 'Mr.', '1991-04-16', 'mike', '231231', '', 0),
(2, 'Zach', 'Raduban', 1, 'Mr.', '1888-04-12', 'zachysoba', '1231231', 'ajkdajsda', 0),
(3, 'Renz', 'Dimayuga', 1, 'Mr.', '1992-02-02', 'renzo', 'renz', 'renzo', 1),
(4, 'daps', 'da', 1, 'Mr.', '1992-03-03', 'daps', 'daps', 'kjaksjdkasjd', 0),
(5, 'mark', 'romantigue', 1, 'Sir', '1995-09-23', 'markg', 'mark', 'mark is g.', 0),
(6, 'Nikki', 'Ebora', 0, 'Ms.', '1990-02-27', 'nikkiballs', 'emi', 'nikki', 0),
(11, 'Janaes', 'Parman', 0, 'Miss', '1995-09-03', 'janaes', '123', 'janae', 0),
(14, 'zachy', 'Soba', 1, 'Mr.', '1993-03-03', 'zachy', '123', '123', 0),
(15, 'John', 'Doe', 1, 'Mr.', '1919-01-01', 'johndoe', '1234', 'dsds', 0),
(16, 'Juan', 'Luna', 1, 'Sir', '1908-09-27', 'juantamad', 'juan1234', 'Isang dakilang pintor', 0),
(17, 'Antonio', 'Luna', 1, 'Sir', '1907-05-24', 'antonipis', 'anton1234', 'Isang dakilang heneral', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
