-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2021 at 04:34 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `evoting_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE IF NOT EXISTS `reset_password` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `code` varchar(300) NOT NULL,
  `email` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tblcandidate`
--

CREATE TABLE IF NOT EXISTS `tblcandidate` (
  `candidate_id` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `category` varchar(50) NOT NULL,
  `objective` varchar(1000) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`candidate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcandidate`
--

INSERT INTO `tblcandidate` (`candidate_id`, `fullname`, `email`, `gender`, `category`, `objective`, `image`) VALUES
('CID-608af7f3d1224', 'Afolabi Ayomikun Rebecca', 'Ayomikun@gmail.com', 'Female', 'President', 'Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata', '02c38a54d797495da994593e52487379.jpg'),
('CID-608af8202d248', 'Omole Deborah Oluwaseun', 'Omo@gmail.com', 'Female', 'Minister for Education', 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident', '4e247af595f442b2abf2cd1e1c3b73c8.jpg'),
('CID-608af8513d178', 'Akinremi Moyinoluwa', 'Moyin@gmail.com', 'Female', 'Governor', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur', 'd667ac47f12f44d986f4ede3d2b3a7d2.jpg'),
('CID-608af88f49eb0', 'Albert Faith Segun', 'Albert1@gmail.com', 'Male', 'President', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'bd444851e73f464e95f7e86ebf42e06a.jpg'),
('CID-608af8c45f40f', 'Agbede Anuoluwapo', 'Anu.a@gmail.com', 'Male', 'House of Representative', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'd7a1689549de45119c2ac1227205143b.jpg'),
('CID-608af918a250a', 'Testing Testing', 'Testing@gmail.com', 'Male', 'Governor', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'ae06a24c0e81472f95726985228e58cb.jpg'),
('CID-608b0245a51a8', 'Amazing Grace', 'test1@yahoo.com', 'Male', 'Senate President', 'Testing Objective', 'Snapchat-369764743.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblregister`
--

CREATE TABLE IF NOT EXISTS `tblregister` (
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblregister`
--

INSERT INTO `tblregister` (`fullname`, `email`, `password`, `usertype`) VALUES
('Afolabi Temidayo Timothy', 'afolabi8120@gmail.com', '$2y$10$hXkCXBfJRIqq1Wlz1/WMeuleHAQVM/hyavywyZIkwbEwK2GPMKL1.', 'Admin'),
('Albert Faith Segun', 'Albert@gmail.com', '$2y$10$1bDXtCKTnyfueyzqSTsj9u00ElqktKIEK/D0JWcuN2/QWmYl327oW', 'User'),
('Ayokanmi Balogun Mutiu', 'Balozy@gmail.com', '$2y$10$.xfeD3XOfC5.srBMeMF4qesei2vPgS7Pvhc3BYrLqTqbLo62EfW0e', 'User'),
('Oladiti Michael Pelumi', 'm.oladiti1@gmail.com', '$2y$10$nGlT7MNws.I.gUxhSU7/FOjQx/nniqJUW2Tx1j1XpNR2qDbR5n3Fy', 'Admin'),
('Afolabi Temitope Emmanuel', 'tpex@gmail.com', '$2y$10$CDwkeyGYTDb.GYwbev3zs.fZefC19tSxaZV9/mojrEPmfzEjupC7e', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `tblvote`
--

CREATE TABLE IF NOT EXISTS `tblvote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` varchar(255) NOT NULL,
  `candidate_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `voters_name` varchar(255) NOT NULL,
  `voters_email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tblvote`
--

INSERT INTO `tblvote` (`id`, `candidate_id`, `candidate_name`, `category`, `voters_name`, `voters_email`) VALUES
(1, 'CID-608b0245a51a8', 'Amazing Grace', 'Senate President', 'Afolabi Temitope Emmanuel', 'tpex@gmail.com'),
(2, 'CID-608af7f3d1224', 'Afolabi Ayomikun Rebecca', 'President', 'Afolabi Temitope Emmanuel', 'tpex@gmail.com'),
(3, 'CID-608af8202d248', 'Omole Deborah Oluwaseun', 'Minister for Education', 'Afolabi Temitope Emmanuel', 'tpex@gmail.com'),
(4, 'CID-608af8513d178', 'Akinremi Moyinoluwa', 'Governor', 'Afolabi Temitope Emmanuel', 'tpex@gmail.com'),
(5, 'CID-608af8c45f40f', 'Agbede Anuoluwapo', 'House of Representative', 'Afolabi Temitope Emmanuel', 'tpex@gmail.com'),
(6, 'CID-608af7f3d1224', 'Afolabi Ayomikun Rebecca', 'President', 'Ayokanmi Balogun Mutiu', 'Balozy@gmail.com'),
(7, 'CID-608af8202d248', 'Omole Deborah Oluwaseun', 'Minister for Education', 'Ayokanmi Balogun Mutiu', 'Balozy@gmail.com'),
(8, 'CID-608af8513d178', 'Akinremi Moyinoluwa', 'Governor', 'Ayokanmi Balogun Mutiu', 'Balozy@gmail.com'),
(9, 'CID-608af8c45f40f', 'Agbede Anuoluwapo', 'House of Representative', 'Ayokanmi Balogun Mutiu', 'Balozy@gmail.com'),
(10, 'CID-608b0245a51a8', 'Amazing Grace', 'Senate President', 'Ayokanmi Balogun Mutiu', 'Balozy@gmail.com'),
(11, 'CID-608af7f3d1224', 'Afolabi Ayomikun Rebecca', 'President', 'Albert Faith Segun', 'Albert@gmail.com'),
(12, 'CID-608af8202d248', 'Omole Deborah Oluwaseun', 'Minister for Education', 'Albert Faith Segun', 'Albert@gmail.com'),
(13, 'CID-608af8513d178', 'Akinremi Moyinoluwa', 'Governor', 'Albert Faith Segun', 'Albert@gmail.com'),
(14, 'CID-608b0245a51a8', 'Amazing Grace', 'Senate President', 'Albert Faith Segun', 'Albert@gmail.com'),
(15, 'CID-608af8c45f40f', 'Agbede Anuoluwapo', 'House of Representative', 'Albert Faith Segun', 'Albert@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
