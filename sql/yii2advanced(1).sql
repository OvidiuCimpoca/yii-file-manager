-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 11, 2017 at 07:12 PM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.23-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yii2advanced`
--

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1503680512),
('m130524_201442_init', 1503680523);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `abbreviation` varchar(10) NOT NULL,
  `createdby` int(255) NOT NULL,
  `createdat` date DEFAULT NULL,
  `finishedat` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `name`, `description`, `abbreviation`, `createdby`, `createdat`, `finishedat`) VALUES
(1, 'Project One', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan', 'PRJ', 1, '2017-08-26', NULL),
(2, 'StuffToDo', 'am sapien, in tristique eros. Ut imperdiet, leo sit amet tristique bibendum, ligula nulla porttitor leo, id finibus ligula dui vitae quam. Morbi auctor tellus congue elementum tempor. Ut iaculis magna in metus egestas consectetur. Nullam egestas tempor sapien ut scelerisque. Suspendiss', 'STD', 1, '2017-08-25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `projectid` int(255) NOT NULL,
  `tasknr` int(255) NOT NULL,
  `description` text,
  `createdby` int(255) NOT NULL,
  `developerid` int(255) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `priority` varchar(20) DEFAULT NULL,
  `estimated` time DEFAULT NULL,
  `elapsed` time DEFAULT NULL,
  `createdat` date DEFAULT NULL,
  `updatedat` date DEFAULT NULL,
  `closedat` date DEFAULT NULL,
  `due` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `name`, `projectid`, `tasknr`, `description`, `createdby`, `developerid`, `status`, `priority`, `estimated`, `elapsed`, `createdat`, `updatedat`, `closedat`, `due`) VALUES
(1, 'Task 1', 1, 1, 'This is a description.', 1, 1, 2, NULL, NULL, NULL, '2017-08-25', NULL, NULL, '2017-09-25'),
(2, 'task2', 1, 2, 'ASkdjaksjd kajsskdjaskldjklas.', 1, 1, 1, 'Low', '01:00:00', '00:00:00', '2017-08-25', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_status`
--

CREATE TABLE `task_status` (
  `id` int(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_status`
--

INSERT INTO `task_status` (`id`, `name`, `description`) VALUES
(1, 'Open', NULL),
(2, 'Ready', NULL),
(3, 'Closed', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '9AKhN3LGb4Ef1IBfxSzIzFaQ9KLOqTct', '$2y$13$HPUEViJ1rUQmJ8NLq1jmHeeidg7rcR0lieRj9l16ne8qPTozESQ9G', NULL, 'ovidiu.cimpoca90@gmail.com', 10, 1503680592, 1503680592);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_status`
--
ALTER TABLE `task_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `task_status`
--
ALTER TABLE `task_status`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
