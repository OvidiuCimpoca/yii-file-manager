-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 14, 2017 at 06:15 PM
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
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `name`) VALUES
(10, 'Admin'),
(20, 'Project Manager'),
(30, 'Developer'),
(40, 'Observer'),
(50, 'Business member');

-- --------------------------------------------------------

--
-- Table structure for table `priority`
--

CREATE TABLE `priority` (
  `id` int(255) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `priority`
--

INSERT INTO `priority` (`id`, `name`) VALUES
(1, 'Low'),
(2, 'Medium'),
(3, 'High');

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
(1, 'Project One edit', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec accumsan', 'PRJ', 1, '2017-08-26', NULL),
(2, 'StuffToDo', 'am sapien, in tristique eros. Ut imperdiet, leo sit amet tristique bibendum, ligula nulla porttitor leo, id finibus ligula dui vitae quam. Morbi auctor tellus congue elementum tempor. Ut iaculis magna in metus egestas consectetur. Nullam egestas tempor sapien ut scelerisque. Suspendiss', 'STD', 1, '2017-08-25', NULL),
(3, 'Project Test', 'TEst project Lorem ipsum', 'PJT', 1, '2017-09-17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(255) NOT NULL,
  `name` varchar(30) NOT NULL,
  `projectid` int(255) NOT NULL,
  `description` text,
  `createdby` int(255) NOT NULL,
  `developerid` int(255) DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `priority` int(20) NOT NULL DEFAULT '1',
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

INSERT INTO `task` (`id`, `name`, `projectid`, `description`, `createdby`, `developerid`, `status`, `priority`, `estimated`, `elapsed`, `createdat`, `updatedat`, `closedat`, `due`) VALUES
(1, 'Task 1', 1, 'This is a description.', 1, 1, 1, 2, NULL, NULL, '2017-08-25', NULL, NULL, '2017-09-25'),
(2, 'task2', 1, 'ASkdjaksjd kajsskdjaskldjklas.', 1, 7, 1, 1, '01:00:00', '00:00:00', '2017-08-25', NULL, NULL, '2017-09-14'),
(3, 'Test', 1, 'asdkajsk asds2', 1, 7, 1, 1, '00:20:00', NULL, '2014-01-17', NULL, NULL, NULL),
(4, 'Test', 1, 'asdkajsk asds', 1, 1, 1, 2, NULL, NULL, '2014-01-17', NULL, NULL, NULL),
(5, 'Test 2', 2, 'asdkajsk asds Lorem', 1, 1, 1, 3, '00:00:40', NULL, '2014-01-17', NULL, NULL, '2014-01-31'),
(6, 'New Task 2', 3, 'This is a description.', 1, 6, 1, 2, '00:00:30', '00:27:00', '2017-09-13', NULL, NULL, '2017-09-21'),
(7, 'Creating tasks', 3, 'THis is tha des', 1, 1, 2, 2, '00:00:15', NULL, '2017-09-13', NULL, NULL, '2017-09-23'),
(8, 'Task createing', 3, 'This is a creating test', 1, 1, 1, 3, '01:30:00', NULL, '2017-09-13', NULL, NULL, '2017-09-30'),
(9, 'test task', 3, 'This is des', 1, 7, 1, 1, '00:30:00', NULL, '2017-09-14', NULL, NULL, NULL);

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
(3, 'Closed', NULL),
(4, 'Working', NULL);

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
  `permission` int(10) NOT NULL DEFAULT '40',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `permission`, `created_at`, `updated_at`) VALUES
(1, 'admin', '9AKhN3LGb4Ef1IBfxSzIzFaQ9KLOqTct', '$2y$13$HPUEViJ1rUQmJ8NLq1jmHeeidg7rcR0lieRj9l16ne8qPTozESQ9G', NULL, 'ovidiu.cimpoca90@gmail.com', 10, 10, 1503680592, 1503680592),
(6, 'pm', 'zlAQzPjCJrvx1slCVpXji-EJUzzd-XKN', '$2y$13$3JddNJD8c.66MEYju01lQui.Cwcl4T/HGVXIGJsGjD57GrsutzyRG', NULL, 'pm@mail.com', 10, 20, 1505302478, 1505302478),
(7, 'dev', '7ivq9IOKTSK4k3nWBMY0Pz92ctlivmiY', '$2y$13$3DBCCDV8kX74ddzxl.ehE.7VwsN94uXJPs4lvOk2kPBsYui1tnpfm', NULL, 'dev@dev.com', 10, 30, 1505302511, 1505302511),
(8, 'obs', 'OYFzZhY1_l7nOU9ta0m8u7TDkBIchC4I', '$2y$13$abGYeHposyR8hIuQsZ3H..0aUGARBQLq/X42bm9oqTEzUFm60MJcG', NULL, 'obs@obs.com', 10, 40, 1505302535, 1505302535),
(9, 'bim', 'F5vjBH2XxMlypUMuBygUdpXsl68d7sN9', '$2y$13$IPcdfHwXzblcOcXMa1GzTeCSkukB36JDMOXLWdU9kfvTy/DeH31Xy', NULL, 'bim@mail.com', 10, 50, 1505302560, 1505398092);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `priority`
--
ALTER TABLE `priority`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `priority`
--
ALTER TABLE `priority`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `task_status`
--
ALTER TABLE `task_status`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
