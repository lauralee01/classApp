-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 22, 2017 at 08:30 PM
-- Server version: 5.5.58-0ubuntu0.14.04.1
-- PHP Version: 7.0.25-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wetext`
--

-- --------------------------------------------------------

--
-- Table structure for table `text`
--

CREATE TABLE IF NOT EXISTS `text` (
  `id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `time_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `text_msg`
--

CREATE TABLE IF NOT EXISTS `text_msg` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` text NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `time_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `text_msg`
--

INSERT INTO `text_msg` (`id`, `msg`, `sender_id`, `reciever_id`, `time_date`) VALUES
(1, 'hey', 2, 5, '2017-11-21 02:10:39'),
(2, 'hello', 2, 5, '2017-11-21 02:12:14'),
(3, 'how are you?', 2, 5, '2017-11-21 02:12:54'),
(4, 'Hi', 2, 3, '2017-11-21 02:29:03'),
(5, 'B, whassup', 2, 4, '2017-11-21 02:29:21'),
(6, 'mr Jay', 2, 2, '2017-11-21 02:29:36'),
(7, 'mr kk, wassup', 4, 5, '2017-11-21 02:33:42'),
(8, 'thank you', 5, 4, '2017-11-21 02:39:48'),
(9, 'alright man', 4, 5, '2017-11-21 02:42:38'),
(10, 'I hear you sir', 5, 4, '2017-11-21 08:48:54'),
(11, 'Aright man', 4, 5, '2017-11-21 08:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `user_password` varchar(60) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `user_password`) VALUES
(1, 'l', 'laura'),
(2, 'j', 'josh'),
(3, 'A', 'anybody'),
(4, 'B', 'everybody'),
(5, 'kk', 'kk'),
(8, '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
