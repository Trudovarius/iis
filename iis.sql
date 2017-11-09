-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2017 at 07:59 PM
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
-- Table structure for table `hunter`
--

CREATE TABLE `hunter` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `health` int(11) NOT NULL,
  `ability` int(11) NOT NULL,
  `available` int(11) NOT NULL,
  `outpost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

--
-- Dumping data for table `hunter`
--

INSERT INTO `hunter` (`id`, `user`, `name`, `health`, `ability`, `available`, `outpost`) VALUES
(1, 1, 'Poso', 100, 2, 1, 0),
(2, 2, 'DominguezZZZ', 100, 5, 1, 0),
(3, 2, 'HackD', 100, 4, 1, 0),
(4, 3, 'Pravý Poso', 100, 4, 1, 0),
(5, 1, 'XD', 100, 1, 1, 0),
(6, 4, 'mľask', 100, 3, 1, 0),
(7, 4, 'boha', 100, 1, 1, 0),
(8, 4, 'tvoja mama', 100, 2, 1, 0),
(9, 5, 'abc', 100, 2, 1, 0),
(10, 5, 'def', 100, 1, 0, 16);

-- --------------------------------------------------------

--
-- Table structure for table `mammoth`
--

CREATE TABLE `mammoth` (
  `id` int(11) NOT NULL,
  `sign` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `properties` varchar(255) COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

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
(4, 'Outpost0', 2, 3, 0),
(5, 'Outpost1', 2, 3, 0),
(6, 'Outpost2', 2, 3, 0),
(7, 'Outpost0', 1, 3, 0),
(8, 'Outpost1', 1, 3, 0),
(9, 'Outpost2', 1, 3, 0),
(10, 'Outpost0', 3, 3, 0),
(11, 'Outpost1', 3, 3, 0),
(12, 'Outpost2', 3, 3, 0),
(13, 'Outpost0', 4, 3, 0),
(14, 'Outpost1', 4, 3, 0),
(15, 'Outpost2', 4, 3, 0),
(16, 'Outpost0', 5, 3, 1),
(17, 'Outpost1', 5, 3, 0),
(18, 'Outpost2', 5, 3, 0);

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
(2, 'Makrella', '8cb2237d0679ca88db6464eac60da96345513964', 1),
(3, 'Poso', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(4, 'XD', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 1),
(5, 'Kral', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ability`
--
ALTER TABLE `ability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hunter`
--
ALTER TABLE `hunter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outpost`
--
ALTER TABLE `outpost`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
