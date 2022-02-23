-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2019 at 11:36 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `plots`
--

-- --------------------------------------------------------

--
-- Table structure for table `plots`
--

CREATE TABLE `plots` (
  `plotId` int(11) NOT NULL,
  `plotNo` varchar(50) NOT NULL,
  `plotSize` varchar(50) NOT NULL,
  `block` varchar(15) NOT NULL,
  `projId` int(11) NOT NULL,
  `plotStatus` varchar(50) NOT NULL,
  `use_id` int(11) NOT NULL,
  `plotDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `plots`
--

INSERT INTO `plots` (`plotId`, `plotNo`, `plotSize`, `block`, `projId`, `plotStatus`, `use_id`, `plotDate`) VALUES
(7, 's12', '500', '', 4, 'OPEN', 8, '2019-03-31 08:28:59'),
(8, 's13', '1500', '', 4, 'NOT OPEN', 8, '2019-03-31 08:33:43'),
(9, 's14', '150', '', 4, 'OPEN', 8, '2019-03-31 08:33:56'),
(10, 's12', '500', '', 3, 'open', 8, '2019-03-24 06:36:12'),
(11, 's13', '1500', '', 3, 'not open', 8, '2019-03-24 06:36:12'),
(22, 'l01', '4533', 'A', 3, 'NOT OPEN', 8, '2019-03-31 09:34:49'),
(23, 'l02', '7787', 'B', 3, 'not open', 8, '2019-03-29 11:16:28'),
(24, 'l03', '2345', 'B', 3, 'open', 8, '2019-03-29 11:16:28'),
(25, 'l04', '444', 'C', 3, 'NOT OPEN', 8, '2019-03-31 08:34:38'),
(26, 'l05', '654', 'C', 3, 'NOT OPEN', 8, '2019-03-31 08:34:44'),
(27, '4534', '34', 'K', 3, 'OPEN', 8, '2019-03-31 09:34:44'),
(29, 'RT', 'ERE', 'D', 3, 'open', 8, '2019-03-30 05:20:12'),
(31, 'l01', '4533', 'A', 6, 'open', 8, '2019-03-30 05:39:24'),
(32, 'l02', '7787', 'B', 6, 'not open', 8, '2019-03-30 05:39:24'),
(33, 'l03', '2345', 'B', 6, 'open', 8, '2019-03-30 05:39:24'),
(34, 'l04', '444', 'C', 6, 'open', 8, '2019-03-30 05:39:24'),
(35, 'l05', '654', 'C', 6, 'not open', 8, '2019-03-30 05:39:24'),
(36, 'l54', '24', 'G', 6, 'not open', 8, '2019-03-30 05:39:24'),
(37, 'l65', '343', 'M', 6, 'open', 8, '2019-03-30 05:39:24'),
(38, 'PLOT', 'SIZE', 'BLOCK', 6, 'STATUS', 8, '2019-03-30 05:40:35');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `projId` int(11) NOT NULL,
  `projTitle` varchar(50) NOT NULL,
  `use_id` int(11) NOT NULL,
  `projDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`projId`, `projTitle`, `use_id`, `projDate`) VALUES
(2, 'kigamboni', 8, '2019-03-22 12:09:04'),
(3, 'Bagamoyo', 8, '2019-03-22 12:09:04'),
(4, 'Kigali', 8, '2019-03-22 12:09:04'),
(5, 'Kimara', 8, '2019-03-22 12:09:04'),
(6, 'Fuoni', 8, '2019-03-30 05:37:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `use_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `u_email` varchar(50) NOT NULL,
  `u_password` varchar(50) NOT NULL,
  `u_status` int(1) NOT NULL DEFAULT '1',
  `user_role` varchar(20) NOT NULL,
  `picture` varchar(100) NOT NULL DEFAULT 'no picture',
  `timedate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`use_id`, `user_name`, `u_email`, `u_password`, `u_status`, `user_role`, `picture`, `timedate`) VALUES
(8, 'yahya', 'whiteali90@gmail.com', '12345', 1, 'Admin', '81051-dsc_0126.jpg', '2019-03-22 09:04:23'),
(9, 'ahmed', 'ahmed@yahoo.com', '12345', 1, 'User', '49165-yahya.jpg', '2019-03-22 09:10:25'),
(10, 'mollet', 'mollet7@live.com', '12345', 1, 'Admin', '19598-avatar.png', '2019-03-22 09:18:26'),
(11, 'alawi', 'ala@yahoo.com', '12345', 1, 'User', '57975-avatar3.png', '2019-03-22 09:33:13'),
(12, 'hjgjh', 'whitehali90@gmail.com', '12345', 1, 'Admin', '15834-dsc_0126.jpg', '2019-03-30 08:41:34'),
(13, 'hgkjgkj', 'whiteajjjli90@gmail.com', '123456', 1, 'User', '60929-dsc_0127.jpg', '2019-03-30 08:42:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plots`
--
ALTER TABLE `plots`
  ADD PRIMARY KEY (`plotId`),
  ADD KEY `plotFK1` (`use_id`),
  ADD KEY `plotFK2` (`projId`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`projId`),
  ADD KEY `projFK` (`use_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`use_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plots`
--
ALTER TABLE `plots`
  MODIFY `plotId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `projId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `use_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `plots`
--
ALTER TABLE `plots`
  ADD CONSTRAINT `plotFK1` FOREIGN KEY (`use_id`) REFERENCES `users` (`use_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `plotFK2` FOREIGN KEY (`projId`) REFERENCES `project` (`projId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `projFK` FOREIGN KEY (`use_id`) REFERENCES `users` (`use_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
