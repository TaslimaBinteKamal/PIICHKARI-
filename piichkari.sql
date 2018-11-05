-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2018 at 01:55 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `piichkari`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` varchar(50) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `remark` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `commentuserimage`
--

CREATE TABLE `commentuserimage` (
  `comment_id` varchar(50) NOT NULL,
  `image_id` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `givelike`
--

CREATE TABLE `givelike` (
  `user_id` varchar(10) NOT NULL,
  `image_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `image_id` varchar(30) NOT NULL,
  `image_name` varchar(25) NOT NULL,
  `image_path` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `report_id` varchar(10) NOT NULL,
  `reported_person` varchar(25) NOT NULL,
  `personwho_reported` varchar(25) NOT NULL,
  `reason` varchar(200) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `email_address` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`report_id`, `reported_person`, `personwho_reported`, `reason`, `user_id`, `email_address`) VALUES
('rid0000001', 'shaan', 'nawhan', 'kotha bole na', 'uid755707', 'shaan@gmail.com'),
('rid0000002', 'shaan', 'shamma', 'Onek alshe', 'uid755707', 'shaan@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(1) NOT NULL,
  `role_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(10) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email_address` varchar(200) NOT NULL,
  `password` varchar(32) NOT NULL,
  `role_id` int(1) NOT NULL,
  `activeStatus` int(1) NOT NULL,
  `banStatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `email_address`, `password`, `role_id`, `activeStatus`, `banStatus`) VALUES
('uid203644', 'nawhan', 'nawhan@gmail.com', 'fbb7d6ca2c662aac16a99a49af5a1c2f', 2, 1, 2),
('uid50507', 'koly', 'koly@gmail.com', 'c6ded5d1ab3b40f27a876c5bbfe265fd', 1, 1, 2),
('uid755707', 'shaan', 'shaan@gmail.com', 'cb3734ed63c36ed641b74d0f18ea4f95', 2, 1, 1),
('uid94025', 'shamma', 'shamma@gmail.com', '1ff76e2b8ab6a3efc7f1c3b4c07ab06d', 2, 1, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `FK_UserComment` (`user_id`);

--
-- Indexes for table `commentuserimage`
--
ALTER TABLE `commentuserimage`
  ADD KEY `FK1_CommentImage` (`comment_id`),
  ADD KEY `FK2_CommentImage` (`image_id`);

--
-- Indexes for table `givelike`
--
ALTER TABLE `givelike`
  ADD KEY `FK1_UserImage` (`user_id`),
  ADD KEY `FK2_UserImage` (`image_id`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `FK1_UserReport` (`user_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `FK_RoleUser` (`role_id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_UserComment` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `commentuserimage`
--
ALTER TABLE `commentuserimage`
  ADD CONSTRAINT `FK1_CommentImage` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`comment_id`),
  ADD CONSTRAINT `FK2_CommentImage` FOREIGN KEY (`image_id`) REFERENCES `image` (`image_id`);

--
-- Constraints for table `givelike`
--
ALTER TABLE `givelike`
  ADD CONSTRAINT `FK1_UserImage` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `FK2_UserImage` FOREIGN KEY (`image_id`) REFERENCES `image` (`image_id`);

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `FK1_UserReport` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_RoleUser` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
