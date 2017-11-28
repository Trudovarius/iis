-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2017 at 10:07 PM
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
  `finishTime` text COLLATE utf8_czech_ci NOT NULL,
  `food` int(11) NOT NULL,
  `experience` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Table structure for table `expedition_member`
--

CREATE TABLE `expedition_member` (
  `hunterId` int(11) NOT NULL,
  `expeditionId` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `dmg` int(11) NOT NULL,
  `since` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `until` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `hunter`
--

CREATE TABLE `hunter` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `name` varchar(15) COLLATE utf8_czech_ci NOT NULL,
  `health` int(11) NOT NULL,
  `ability` int(11) NOT NULL,
  `available` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `murder`
--

CREATE TABLE `murder` (
  `hunterId` int(11) NOT NULL,
  `mammothId` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `type` int(11) NOT NULL,
  `pitId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- --------------------------------------------------------

--
-- Table structure for table `outpost`
--

CREATE TABLE `outpost` (
  `id` int(11) NOT NULL,
  `outpost` varchar(15) COLLATE utf8_czech_ci NOT NULL,
  `user` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `hunterCount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `record`
--

CREATE TABLE `record` (
  `mammothId` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `reportId` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `level` int(11) NOT NULL,
  `food` int(11) NOT NULL,
  `experience` int(11) NOT NULL,
  `role` varchar(10) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci COMMENT='table of users';

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `outpost`
--
ALTER TABLE `outpost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pit`
--
ALTER TABLE `pit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
