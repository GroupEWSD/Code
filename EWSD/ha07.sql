-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2020 at 07:07 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ha07`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `student` varchar(60) NOT NULL,
  `date` varchar(60) NOT NULL,
  `time` varchar(60) NOT NULL,
  `type` varchar(60) NOT NULL,
  `tutor` varchar(60) NOT NULL,
  `reason` varchar(60) NOT NULL,
  `status` varchar(60) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `student`, `date`, `time`, `type`, `tutor`, `reason`, `status`) VALUES
(1, 'John', '2020-02-04', '2', 'virtual', 'tutorA', '', 'Pending'),
(2, 'John', '2020-02-04', '2', 'virtual', 'tutorA', '', 'Pending'),
(3, 'John', '2020-02-06', '4.00pm-5.00pm', 'realtime', 'Ryan', '', 'Accept'),
(4, 'John', '2020-02-04', '4.00pm-5.00pm', 'realtime', 'Ryan', 'Consultation on project', 'Accept'),
(5, 'John', '', '2:00pm-3.00pm', 'virtual', 'Annida', '', 'Pending'),
(6, 'John', '2020-02-04', '4.00pm-5.00pm', 'realtime', 'Annida', '131231', 'Pending'),
(7, 'John', '2020-02-04', '2:00pm-3.00pm', 'realtime', 'Ryan', '13131', 'Decline'),
(8, 'John', '2020-02-04', '4.00pm-5.00pm', 'realtime', 'Ryan', '123123', 'Accept'),
(9, 'John', '2020-02-04', '2:00pm-3.00pm', 'virtual', 'Annida', '123123', 'Pending'),
(10, 'Ryan', '2020-03-12', '2:00pm-3.00pm', 'virtual', 'Ryan', '12313', 'Accept'),
(11, 'Ryan', '2020-03-04', '2:00pm-3.00pm', 'virtual', 'Ryan', '12331', 'Accept'),
(12, 'Ryan', '2020-03-03', '2:00pm-3.00pm', 'virtual', 'Ryan', 'sdsf', 'Accept'),
(13, 'Ryan', '2020-03-03', '2:00pm-3.00pm', 'virtual', 'Ryan', 'sdsf', 'Accept'),
(14, 'Ryan', '2020-03-05', '2:00pm-3.00pm', 'realtime', 'Ryan', '1231', 'Accept'),
(15, 'Mack', '2020-03-02', '2:00pm-3.00pm', 'virtual', 'Ryan', '123', 'Accept'),
(16, 'Mack', '2020-03-11', '2:00pm-3.00pm', 'virtual', 'Ryan', '12', 'Accept'),
(17, 'Mack', '2020-03-10', '4.00pm-5.00pm', 'virtual', 'Ryan', '12312', 'Accept'),
(18, 'Ryan', '2020-03-05', '2:00pm-3.00pm', 'virtual', 'Ryan', '', 'Accept'),
(19, 'Ryan', '2020-03-04', '2:00pm-3.00pm', 'virtual', 'Ryan', '31', 'Accept'),
(20, 'Ryan', '2020-03-02', '2:00pm-3.00pm', 'virtual', 'Ryan', 'wqe', 'Accept'),
(21, 'Ryan', '2020-03-18', '2:00pm-3.00pm', 'virtual', 'Ryan', 'wwww', 'Accept'),
(22, 'Ryan', '2020-03-04', '2:00pm-3.00pm', 'virtual', 'Ryan', '2131', 'Decline'),
(23, 'Ryan', '', '2:00pm-3.00pm', 'virtual', 'Ryan', '12312', 'Pending'),
(24, 'Ryan', '2020-03-17', '2:00pm-3.00pm', 'virtual', 'Ryan', '1231', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `ID` int(10) NOT NULL,
  `Fname` varchar(255) NOT NULL,
  `name` mediumblob NOT NULL,
  `size` int(60) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `mid` int(11) NOT NULL,
  `tutor_name` varchar(20) NOT NULL,
  `student` varchar(20) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`mid`, `tutor_name`, `student`, `content`) VALUES
(1, 'John', '', 'aaaaa'),
(2, 'John', 'Jason', 'aaaa'),
(3, 'John', 'Jason', 'testing'),
(4, 'John', 'Jason', 'testing');

-- --------------------------------------------------------

--
-- Table structure for table `t_assign`
--

CREATE TABLE `t_assign` (
  `AID` int(10) NOT NULL,
  `Tname` varchar(60) NOT NULL,
  `Sname` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_assign`
--

INSERT INTO `t_assign` (`AID`, `Tname`, `Sname`) VALUES
(1, 'AronT', 'Aron'),
(4, 'KorrT', 'Alex'),
(5, 'AronT', 'Korr'),
(6, 'John', 'Jason');

-- --------------------------------------------------------

--
-- Table structure for table `user_acc`
--

CREATE TABLE `user_acc` (
  `UID` int(10) NOT NULL,
  `Uname` varchar(255) NOT NULL,
  `Pword` varchar(255) NOT NULL,
  `status` int(10) NOT NULL,
  `Uemail` varchar(60) NOT NULL,
  `Unum` varchar(60) NOT NULL,
  `Ucontact` varchar(60) NOT NULL,
  `Activation` varchar(255) NOT NULL,
  `role` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_acc`
--

INSERT INTO `user_acc` (`UID`, `Uname`, `Pword`, `status`, `Uemail`, `Unum`, `Ucontact`, `Activation`, `role`) VALUES
(1, 'Aron', '$2y$10$P4.xOG.01UG2qm.2xstLu.WXLMeYf.ytRX3l2ycxSTNTZTXKdrB7K', 0, 'johnleekk@hotmail.com', 'stu123', '0192222353', '34a1e6ca04e4e8da4cbb575069d61f1d', 's'),
(2, 'Alex', '$2y$10$74OJjjnGjb3FZJ7KYb7Bteesbd.vSc53ll/IRzxt5wYkna09QjGjG', 0, 'johnleekk@hotmail.com', 'stu543', '0192222353', '8282ae4d318aece5903acd68ffbb8b68', 's'),
(3, 'Korr', '$2y$10$/G18vFy8koM9f.JLvcTa1.XEafrOAHgs6g7XIpB9PDBrGPtKUpMYq', 1, 'johnleekk@hotmail.com', 'stu556', '0192222353', '365fec25a8d672f9e386d35adcc4507d', 's'),
(4, 'KorrT', '$2y$10$/G18vFy8koM9f.JLvcTa1.XEafrOAHgs6g7XIpB9PDBrGPtKUpMYq', 1, 'johnleekk@hotmail.com', 'stu556', '0192222353', '365fec25a8d672f9e386d35adcc4507d', 't'),
(5, 'AronT', '$2y$10$P4.xOG.01UG2qm.2xstLu.WXLMeYf.ytRX3l2ycxSTNTZTXKdrB7K', 0, 'johnleekk@hotmail.com', 'stu123', '0192222353', '34a1e6ca04e4e8da4cbb575069d61f1d', 't'),
(6, 'Jason', '$2y$10$YfaKrZyPi95BK0lHGnsD7.8nJDreP5/wL7cVzWnAQm1wiGvVHRnoG', 1, 'johnleekk@hotmail.com', 'stu556', '0192222353', '365fec25a8d672f9e386d35adcc4507d', 's'),
(7, 'John', '$2y$10$gx.XCjk0n.M1oHkuq1jnVO3zr40Z8m6YX//vgRfc.BhCb15wedg3u', 1, 'johnleekk@hotmail.com', 'stu556', '0192222353', '365fec25a8d672f9e386d35adcc4507d', 't');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `t_assign`
--
ALTER TABLE `t_assign`
  ADD PRIMARY KEY (`AID`);

--
-- Indexes for table `user_acc`
--
ALTER TABLE `user_acc`
  ADD PRIMARY KEY (`UID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `mid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_assign`
--
ALTER TABLE `t_assign`
  MODIFY `AID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_acc`
--
ALTER TABLE `user_acc`
  MODIFY `UID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
