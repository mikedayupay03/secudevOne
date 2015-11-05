-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2015 at 04:08 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `badges`
--

INSERT INTO `badges` (`user_id`, `posts`, `donations`, `purchases`) VALUES
(1, 0, 0, 0),
(2, -3, 0, 0),
(3, -3, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `order_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`order_id`, `customer_id`, `item_id`, `quantity`) VALUES
(7, 7, 1, 3),
(7, 7, 2, 1),
(8, 8, 1, 2),
(8, 8, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
`customer_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `name`, `email`) VALUES
(7, 'Mike Dayupay', 'mike.dayupay@gmail.com'),
(8, 'test buyer', 'markg.romantigue-buyer@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
`item_id` int(11) NOT NULL,
  `item_name` varchar(50) NOT NULL,
  `item_description` varchar(300) NOT NULL,
  `item_image` varchar(500) NOT NULL,
  `item_price` float NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_description`, `item_image`, `item_price`) VALUES
(1, 'iPhone 6s', 'The latest smartphone from apple.', 'WIN_20150325_142249.JPG', 31990),
(2, 'iPhone 6s+', 'The latest bigger smartphone from apple.', 'iphone-6-plus.jpg', 43990);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=26 ;

--
-- Dumping data for table `message_board`
--

INSERT INTO `message_board` (`message_id`, `user_id`, `message`, `date_posted`, `edited_date`) VALUES
(22, 1, 'x', '2015-10-26 11:44:42', NULL),
(23, 1, 'y', '2015-10-26 11:44:48', NULL),
(24, 1, 'z', '2015-10-26 11:45:05', NULL),
(25, 1, 'x', '2015-11-04 12:06:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
`order_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `date_created` varchar(25) NOT NULL,
  `date_completed` varchar(25) DEFAULT NULL,
  `customer_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `total_price`, `date_created`, `date_completed`, `customer_id`) VALUES
(7, 139960, '2015-11-05 11:02:11', NULL, 7),
(8, 283930, '2015-11-05 11:06:22', NULL, 8);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `userdb`
--

INSERT INTO `userdb` (`user_id`, `first_name`, `last_name`, `male`, `salutation`, `bday`, `username`, `password`, `about`, `admin`, `date_joined`) VALUES
(1, 'Nina', 'Nesbitt', 0, 'Ms.', '1994-07-11', 'nina', '92efeff958c88194ad0b983eed21ce90', 'n', 1, '2015-10-26'),
(2, 'Mark Genesis', 'Romantigue', 1, 'Mr.', '1995-10-13', 'mark', '92efeff958c88194ad0b983eed21ce90', 'makmsmdmaksmdmkaskd', 0, '2015-10-28'),
(3, 'nina', 'nesbitt', 0, 'Ms.', '1994-07-11', 'nina', '686b6096cf5a28f1742cb67dae56a9d5', 'nina', 0, '2015-11-04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `badges`
--
ALTER TABLE `badges`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
 ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `message_board`
--
ALTER TABLE `message_board`
 ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
 ADD PRIMARY KEY (`order_id`);

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
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `message_board`
--
ALTER TABLE `message_board`
MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `salutations`
--
ALTER TABLE `salutations`
MODIFY `salutation_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `userdb`
--
ALTER TABLE `userdb`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
