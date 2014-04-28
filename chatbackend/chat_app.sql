-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 28, 2014 at 02:13 PM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `chat_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE IF NOT EXISTS `friends` (
  `friend_pk` int(11) NOT NULL AUTO_INCREMENT,
  `my_number` varchar(20) NOT NULL,
  `friend_number` varchar(20) NOT NULL,
  PRIMARY KEY (`friend_pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`friend_pk`, `my_number`, `friend_number`) VALUES
(1, '123456789', '2121'),
(2, '123456789', '1258'),
(3, '123456789', '458'),
(4, '123456789', '2121'),
(5, '123456789', '1258'),
(6, '123456789', '458'),
(7, '123456789', '2121'),
(8, '123456789', '1258'),
(9, '123456789', '458'),
(10, '123456789', '2121'),
(11, '123456789', '1258'),
(12, '123456789', '458');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `msg_pk` int(10) NOT NULL AUTO_INCREMENT,
  `to` varchar(100) NOT NULL,
  `from` varchar(100) NOT NULL,
  `msg` text NOT NULL,
  `to_device_id` varchar(50) NOT NULL,
  `is_delivered` int(10) NOT NULL,
  PRIMARY KEY (`msg_pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_pk`, `to`, `from`, `msg`, `to_device_id`, `is_delivered`) VALUES
(2, '123456789', '4587', 'testing', '123456789', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_pk` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `contact_number` int(15) NOT NULL,
  PRIMARY KEY (`user_pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_pk`, `username`, `contact_number`) VALUES
(3, 'test', 123456789);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `user_detail_pk` int(10) NOT NULL AUTO_INCREMENT,
  `user_fk` int(10) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `device_id` varchar(100) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`user_detail_pk`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_detail_pk`, `user_fk`, `first_name`, `last_name`, `device_id`, `status`) VALUES
(2, 3, '', '', '123456789', 0);
