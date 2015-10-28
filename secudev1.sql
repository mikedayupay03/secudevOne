-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2015 at 08:58 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

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
-- Table structure for table `badges`
--

CREATE TABLE IF NOT EXISTS `badges` (
`user_id` int(11) NOT NULL,
  `posts` int(11) NOT NULL,
  `donations` int(11) NOT NULL,
  `purchases` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`user_id`, `posts`, `donations`, `purchases`) VALUES
(1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `message_board`
--

CREATE TABLE IF NOT EXISTS `message_board` (
`message_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text COLLATE utf8_bin NOT NULL,
  `date_posted` datetime NOT NULL,
  `edited_date` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `salutations`
--

CREATE TABLE IF NOT EXISTS `salutations` (
`salutation_id` int(11) NOT NULL,
  `salutation` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

--
-- Dumping data for table `salutations`
--

INSERT INTO `salutations` (`salutation_id`, `salutation`) VALUES
(1, 'Mr.'),
(2, 'Sir'),
(3, 'Senior'),
(4, 'Count'),
(5, 'Miss'),
(6, 'Ms.'),
(7, 'Mrs.'),
(8, 'Madame'),
(9, 'Majesty'),
(10, 'Seniora');

-- --------------------------------------------------------

--
-- Table structure for table `userdb`
--

CREATE TABLE IF NOT EXISTS `userdb` (
`user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `male` tinyint(1) NOT NULL,
  `salutation` varchar(11) NOT NULL,
  `bday` date NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `about` longtext NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `date_joined` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `userdb`
--

INSERT INTO `userdb` (`user_id`, `first_name`, `last_name`, `male`, `salutation`, `bday`, `username`, `password`, `about`, `admin`, `date_joined`) VALUES
(1, 'Nina', 'Nesbitt', 0, 'Ms.', '1994-07-11', 'nina', '686b6096cf5a28f1742cb67dae56a9d5', 'n', 1, '2015-10-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `message_board`
--
ALTER TABLE `message_board`
 ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `salutations`
--
ALTER TABLE `salutations`
 ADD PRIMARY KEY (`salutation_id`);

--
-- Indexes for table `userdb`
--
ALTER TABLE `userdb`
 ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `badges`
--
ALTER TABLE `badges`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `message_board`
--
ALTER TABLE `message_board`
MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `salutations`
--
ALTER TABLE `salutations`
MODIFY `salutation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `userdb`
--
ALTER TABLE `userdb`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
