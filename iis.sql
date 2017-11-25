-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2017 at 05:56 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iis`
--

-- --------------------------------------------------------

--
-- Table structure for table `ability`
--

CREATE TABLE `ability` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `ability`
--

INSERT INTO `ability` (`id`, `name`) VALUES
(1, 'Watchman'),
(2, 'Warrior'),
(3, 'Scout'),
(4, 'Javelineer'),
(5, 'Support');

-- --------------------------------------------------------

--
-- Table structure for table `expedition`
--

CREATE TABLE `expedition` (
  `id` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `user` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `status` text COLLATE utf8_czech_ci NOT NULL,
  `success` int(11) NOT NULL,
  `report` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `finishTime` text COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `expedition`
--

INSERT INTO `expedition` (`id`, `user`, `date`, `status`, `success`, `report`, `finishTime`) VALUES
('5a19866ee0df7', 1, '2017-11-25 16:04:14', 'Finished', 1, '5a19866635884', '2017-11-25 16:14:14'),
('5a198b418b2fc', 1, '2017-11-25 16:24:49', 'Finished', 1, '5a198666102d3', '2017-11-25 16:54:49'),
('5a199c55df840', 1, '2017-11-25 17:37:41', 'In progress', 0, '5a199b9c717ce', '2017-11-25 17:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `expedition_member`
--

CREATE TABLE `expedition_member` (
  `hunterId` int(11) NOT NULL,
  `expeditionId` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `since` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `until` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `expedition_member`
--

INSERT INTO `expedition_member` (`hunterId`, `expeditionId`, `since`, `until`) VALUES
(2, '5a19866ee0df7', '2017-11-25 16:04:14', '2017-11-25 16:14:14'),
(4, '5a19866ee0df7', '2017-11-25 16:04:14', '2017-11-25 16:14:14'),
(2, '5a198b418b2fc', '2017-11-25 16:24:49', '2017-11-25 16:54:49'),
(4, '5a198b418b2fc', '2017-11-25 16:24:49', '2017-11-25 16:54:49'),
(4, '5a199c55df840', '2017-11-25 17:37:41', '2017-11-25 17:57:41'),
(5, '5a199c55df840', '2017-11-25 17:37:41', '2017-11-25 17:57:41'),
(6, '5a199c55df840', '2017-11-25 17:37:41', '2017-11-25 17:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `expedition_pit`
--

CREATE TABLE `expedition_pit` (
  `pitId` int(11) NOT NULL,
  `expeditionId` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `since` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `until` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `expedition_pit`
--

INSERT INTO `expedition_pit` (`pitId`, `expeditionId`, `since`, `until`) VALUES
(1, '5a19866ee0df7', '2017-11-25 16:04:14', '2017-11-25 16:14:14'),
(1, '5a198b418b2fc', '2017-11-25 16:24:49', '2017-11-25 16:54:49'),
(1, '5a199c55df840', '2017-11-25 17:37:41', '2017-11-25 17:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `hunter`
--

CREATE TABLE `hunter` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `health` int(11) NOT NULL,
  `ability` int(11) NOT NULL,
  `available` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `hunter`
--

INSERT INTO `hunter` (`id`, `user`, `name`, `health`, `ability`, `available`) VALUES
(1, 1, 'Trudo', 100, 1, 0),
(2, 1, 'XD', -18, 2, 0),
(3, 1, 'ass', -176, 2, 0),
(4, 1, 'tonk', 46, 5, 0),
(5, 1, 'asdf', 100, 1, 0),
(6, 1, 'asdfff', 100, 1, 0),
(7, 4, 'a', 100, 1, 1),
(8, 4, 'aa', 100, 1, 1),
(9, 4, 'aaa', 100, 1, 1),
(10, 4, 'aaaa', 100, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `mammoth`
--

CREATE TABLE `mammoth` (
  `id` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `sign` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `properties` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `mammoth`
--

INSERT INTO `mammoth` (`id`, `sign`, `properties`, `gender`) VALUES
('5a19866611a43', 'injured', 'passive', 'female'),
('5a198666129e4', 'tiny', 'passive', 'male'),
('5a1986662a0e9', 'white fur', 'neutral', 'male'),
('5a1986663837d', 'baby mammoth', 'passive', 'male'),
('5a199b9c70446', 'broken fang', 'passive', 'female'),
('5a199b9c70ffe', 'broken fang', 'passive', 'male'),
('5a199b9c7a088', 'white fur', 'slow', 'female'),
('5a199b9c80619', 'huge', 'slow', 'male');

-- --------------------------------------------------------

--
-- Table structure for table `murder`
--

CREATE TABLE `murder` (
  `hunterId` int(11) NOT NULL,
  `mammothId` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `type` int(11) NOT NULL,
  `pitId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `murder`
--

INSERT INTO `murder` (`hunterId`, `mammothId`, `date`, `type`, `pitId`) VALUES
(4, 5, '2017-11-25 16:24:30', 1, 1),
(4, 5, '2017-11-25 17:34:36', 1, 1),
(4, 5, '2017-11-25 17:34:36', 1, 1),
(2, 5, '2017-11-25 17:34:36', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `outpost`
--

CREATE TABLE `outpost` (
  `id` int(11) NOT NULL,
  `outpost` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `user` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `hunterCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `outpost`
--

INSERT INTO `outpost` (`id`, `outpost`, `user`, `capacity`, `hunterCount`) VALUES
(1, 'Outpost0', 1, 3, 0),
(2, 'Outpost1', 1, 3, 0),
(3, 'Outpost2', 1, 3, 1),
(4, 'Outpost0', 4, 3, 0),
(5, 'Outpost1', 4, 3, 0),
(6, 'Outpost2', 4, 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `outpost_member`
--

CREATE TABLE `outpost_member` (
  `hunterId` int(11) NOT NULL,
  `outpostId` int(11) NOT NULL,
  `since` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `until` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `outpost_member`
--

INSERT INTO `outpost_member` (`hunterId`, `outpostId`, `since`, `until`) VALUES
(1, 1, '2017-11-24 15:54:14', '2017-11-24 17:03:58'),
(1, 1, '2017-11-24 15:54:25', '2017-11-24 17:03:58'),
(4, 6, '2017-11-24 15:58:17', '2017-11-24 17:03:21'),
(6, 1, '2017-11-25 00:28:23', '2017-11-25 17:37:34'),
(5, 2, '2017-11-25 00:28:28', '2017-11-25 17:37:31'),
(1, 3, '2017-11-25 00:28:31', ''),
(4, 2, '2017-11-25 00:28:47', '2017-11-25 00:29:26'),
(3, 2, '2017-11-25 00:28:47', '2017-11-25 00:29:11'),
(4, 2, '2017-11-25 00:29:21', '2017-11-25 00:29:26'),
(2, 1, '2017-11-25 00:42:29', '2017-11-25 00:42:31'),
(4, 3, '2017-11-25 14:51:04', '2017-11-25 14:51:05');

-- --------------------------------------------------------

--
-- Table structure for table `pit`
--

CREATE TABLE `pit` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `deadMammoths` int(11) NOT NULL,
  `available` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `pit`
--

INSERT INTO `pit` (`id`, `user`, `deadMammoths`, `available`) VALUES
(1, 1, 7, 0),
(2, 1, 0, 1),
(3, 1, 0, 1),
(4, 4, 0, 1),
(5, 4, 0, 1),
(6, 4, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `mammothId` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `reportId` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `record`
--

INSERT INTO `record` (`mammothId`, `reportId`) VALUES
('5a19866611a43', '5a198666102d3'),
('5a198666129e4', '5a198666102d3'),
('5a1986662a0e9', '5a198666102d3'),
('5a1986663837d', '5a19866635884'),
('5a199b9c70446', '5a199b9c6b23c'),
('5a199b9c70ffe', '5a199b9c6b23c'),
('5a199b9c7a088', '5a199b9c717ce'),
('5a199b9c80619', '5a199b9c717ce');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `user` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `outpost` int(11) NOT NULL,
  `mammothCount` int(11) NOT NULL,
  `completion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `user`, `date`, `outpost`, `mammothCount`, `completion`) VALUES
('5a198666102d3', 1, '2017-11-25 16:04:06', 1, 3, 1),
('5a19866635884', 1, '2017-11-25 16:04:06', 1, 1, 1),
('5a199b9c6b23c', 1, '2017-11-25 17:34:36', 1, 2, 0),
('5a199b9c717ce', 1, '2017-11-25 17:34:36', 1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='table of users';

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `level`) VALUES
(1, 'Trudo', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(4, 'Makrella', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ability`
--
ALTER TABLE `ability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expedition`
--
ALTER TABLE `expedition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hunter`
--
ALTER TABLE `hunter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mammoth`
--
ALTER TABLE `mammoth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outpost`
--
ALTER TABLE `outpost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pit`
--
ALTER TABLE `pit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ability`
--
ALTER TABLE `ability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `hunter`
--
ALTER TABLE `hunter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `outpost`
--
ALTER TABLE `outpost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `pit`
--
ALTER TABLE `pit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
