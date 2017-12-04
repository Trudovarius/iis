-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2017 at 06:55 PM
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

--
-- Dumping data for table `expedition`
--

INSERT INTO `expedition` (`id`, `user`, `date`, `status`, `success`, `report`, `finishTime`, `food`, `experience`) VALUES
('5a1dd2eb2f28a', 5, '2017-11-28 22:19:39', 'Finished', 1, '5a1dd2e174586', '2017-11-28 22:29:39', 100, 152),
('5a1dd2efe1ada', 5, '2017-11-28 22:19:43', 'Finished', 1, '5a1dd2e17e5b0', '2017-11-28 22:29:43', 100, 120),
('5a1dd56b2ca45', 5, '2017-11-28 22:30:19', 'Finished', 1, '5a1dd55edf1f2', '2017-11-28 22:50:19', 100, 141),
('5a1dd56fb7c1e', 5, '2017-11-28 22:30:23', 'Finished', 1, '5a1dd55ed8a09', '2017-11-28 22:50:23', 200, 139),
('5a1ded1d066a9', 5, '2017-11-29 00:11:25', 'Finished', 1, '5a1ded119a5d2', '2017-11-29 00:41:25', 200, 152),
('5a1ded2447404', 5, '2017-11-29 00:11:32', 'Finished', 1, '5a1ded117e498', '2017-11-29 00:31:32', 100, 158),
('5a1ea70763fd7', 5, '2017-11-29 13:24:39', 'Finished', 1, '5a1ea6f65195a', '2017-11-29 14:14:39', 100, 124),
('5a1ea70d6424a', 5, '2017-11-29 13:24:45', 'Finished', 1, '5a1ea6f640fb6', '2017-11-29 13:44:45', 200, 219);

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

--
-- Dumping data for table `expedition_member`
--

INSERT INTO `expedition_member` (`hunterId`, `expeditionId`, `dmg`, `since`, `until`) VALUES
(1, '5a1dd2eb2f28a', 102, '2017-11-28 22:19:39', '2017-11-28 22:29:39'),
(4, '5a1dd2efe1ada', 70, '2017-11-28 22:19:43', '2017-11-28 22:29:43'),
(3, '5a1dd56b2ca45', 91, '2017-11-28 22:30:19', '2017-11-28 22:50:19'),
(2, '5a1dd56fb7c1e', 39, '2017-11-28 22:30:23', '2017-11-28 22:50:23'),
(2, '5a1ded1d066a9', 52, '2017-11-29 00:11:25', '2017-11-29 00:41:25'),
(4, '5a1ded2447404', 108, '2017-11-29 00:11:32', '2017-11-29 00:31:32'),
(3, '5a1ea70763fd7', 74, '2017-11-29 13:24:39', '2017-11-29 14:14:39'),
(2, '5a1ea70d6424a', 67, '2017-11-29 13:24:45', '2017-11-29 13:44:45'),
(4, '5a1ea70d6424a', 52, '2017-11-29 13:24:45', '2017-11-29 13:44:45');

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
(1, '5a1dd2eb2f28a', '2017-11-28 22:19:39', '2017-11-28 22:29:39'),
(3, '5a1dd2efe1ada', '2017-11-28 22:19:43', '2017-11-28 22:29:43'),
(1, '5a1dd56b2ca45', '2017-11-28 22:30:19', '2017-11-28 22:50:19'),
(2, '5a1dd56fb7c1e', '2017-11-28 22:30:23', '2017-11-28 22:50:23'),
(1, '5a1ded1d066a9', '2017-11-29 00:11:25', '2017-11-29 00:41:25'),
(3, '5a1ded2447404', '2017-11-29 00:11:32', '2017-11-29 00:31:32'),
(1, '5a1ea70763fd7', '2017-11-29 13:24:39', '2017-11-29 14:14:39'),
(2, '5a1ea70d6424a', '2017-11-29 13:24:45', '2017-11-29 13:44:45');

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

--
-- Dumping data for table `hunter`
--

INSERT INTO `hunter` (`id`, `user`, `name`, `health`, `ability`, `available`) VALUES
(1, 5, 'admin', -2, 1, 0),
(2, 5, 'admin', 59, 2, 1),
(3, 5, 'admin', 52, 3, 1),
(4, 5, 'admin', 274, 5, 1);

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
('5a1dd2e17d9f8', 'injured', 'slow', 'male'),
('5a1dd2e184f2a', 'tiny', 'agile', 'female'),
('5a1dd55edda81', 'injured', 'fast', 'female'),
('5a1dd55ede63a', 'white fur', 'agresive', 'female'),
('5a1dd55ee6b0c', 'injured', 'slow', 'male'),
('5a1dd55f02a9f', 'injured', 'passive', 'male'),
('5a1ded1186d51', 'baby', 'slow', 'male'),
('5a1ded118e281', 'tiny', 'passive', 'male'),
('5a1ded119f3f2', 'huge', 'agile', 'male'),
('5a1ded11a7cab', 'white fur', 'slow', 'male'),
('5a1ded11a866f', 'tiny', 'angry', 'female'),
('5a1ea6f643aae', 'baby', 'agile', 'male'),
('5a1ea6f64abf8', 'huge', 'angry', 'male'),
('5a1ea6f656f4b', 'tiny', 'angry', 'male'),
('5a1ea6f657eeb', 'white fur', 'agile', 'male'),
('5a1ea6f65d8c5', 'baby', 'neutral', 'female'),
('5a1ea6f664a0e', 'tiny', 'agile', 'male'),
('5a1ea6f6655c6', 'tiny', 'passive', 'female'),
('5a1ed45944126', '3-legged', 'agile', 'male'),
('5a1ed4595bffc', 'tiny', 'angry', 'female'),
('5a1ed45961205', 'white fur', 'neutral', 'male'),
('5a1ed459621a5', '3-legged', 'agile', 'female');

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

--
-- Dumping data for table `murder`
--

INSERT INTO `murder` (`hunterId`, `mammothId`, `date`, `type`, `pitId`) VALUES
(1, '5a1dd2e17d9f8', '2017-11-28 22:29:39', 1, 1),
(1, '5a1dd2e17d9f8', '2017-11-28 22:29:39', 0, 1),
(4, '5a1dd2e184f2a', '2017-11-28 22:29:43', 1, 3),
(3, '5a1dd55ee6b0c', '2017-11-28 22:50:19', 1, 1),
(2, '5a1dd55edda81', '2017-11-28 22:50:23', 1, 2),
(2, '5a1dd55ede63a', '2017-11-28 22:50:23', 1, 2),
(2, '5a1ded119f3f2', '2017-11-29 00:41:25', 1, 1),
(2, '5a1ded11a7cab', '2017-11-29 00:41:25', 1, 1),
(4, '5a1ded118e281', '2017-11-29 00:31:32', 1, 3),
(3, '5a1ea6f664a0e', '2017-11-29 14:14:39', 1, 1),
(2, '5a1ea6f643aae', '2017-11-29 13:44:45', 1, 2),
(2, '5a1ea6f64abf8', '2017-11-29 13:44:45', 1, 2);

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

--
-- Dumping data for table `outpost`
--

INSERT INTO `outpost` (`id`, `outpost`, `user`, `capacity`, `hunterCount`) VALUES
(1, '1.2HTP', 5, 3, 0),
(2, 'Fabia 40kW', 5, 3, 0),
(3, 'Divín', 5, 3, 0),
(16, 'Outpost0', 10, 3, 0),
(17, 'Outpost1', 10, 3, 0),
(18, 'Outpost2', 10, 3, 0);

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
(1, 1, '2017-11-28 22:19:26', '2017-11-28 22:19:32'),
(2, 1, '2017-11-28 22:19:26', '2017-11-28 22:30:11'),
(3, 1, '2017-11-28 22:19:27', '2017-11-28 22:30:12'),
(2, 1, '2017-11-28 22:30:04', '2017-11-28 22:30:11'),
(3, 1, '2017-11-28 22:30:05', '2017-11-28 22:30:12'),
(4, 1, '2017-11-28 22:30:05', '2017-11-28 22:30:12'),
(4, 2, '2017-11-29 00:11:10', '2017-11-29 13:24:29'),
(2, 2, '2017-11-29 00:11:11', '2017-11-29 13:24:28'),
(3, 2, '2017-11-29 00:11:12', '2017-11-29 13:24:28'),
(2, 2, '2017-11-29 13:24:20', '2017-11-29 13:24:28'),
(3, 2, '2017-11-29 13:24:20', '2017-11-29 13:24:28'),
(4, 2, '2017-11-29 13:24:21', '2017-11-29 13:24:29');

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
(1, 5, 4, 1),
(2, 5, 2, 1),
(3, 5, 2, 1),
(16, 10, 0, 1),
(17, 10, 0, 1),
(18, 10, 0, 1);

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
('5a1dd2e17d9f8', '5a1dd2e174586'),
('5a1dd2e184f2a', '5a1dd2e17e5b0'),
('5a1dd55edda81', '5a1dd55ed8a09'),
('5a1dd55ede63a', '5a1dd55ed8a09'),
('5a1dd55ee6b0c', '5a1dd55edf1f2'),
('5a1dd55f02a9f', '5a1dd55edf1f2'),
('5a1ded1186d51', '5a1ded117e498'),
('5a1ded118e281', '5a1ded117e498'),
('5a1ded119f3f2', '5a1ded119a5d2'),
('5a1ded11a7cab', '5a1ded119a5d2'),
('5a1ded11a866f', '5a1ded119a5d2'),
('5a1ea6f643aae', '5a1ea6f640fb6'),
('5a1ea6f64abf8', '5a1ea6f640fb6'),
('5a1ea6f656f4b', '5a1ea6f65195a'),
('5a1ea6f657eeb', '5a1ea6f65195a'),
('5a1ea6f65d8c5', '5a1ea6f65195a'),
('5a1ea6f664a0e', '5a1ea6f65195a'),
('5a1ea6f6655c6', '5a1ea6f65195a');

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
('5a1dd2e174586', 5, '2017-11-28 22:18:04', 1, 1, 1),
('5a1dd2e17e5b0', 5, '2017-11-28 22:17:00', 1, 1, 1),
('5a1dd55ed8a09', 5, '2017-11-28 22:28:49', 1, 2, 1),
('5a1dd55edf1f2', 5, '2017-11-28 22:29:18', 1, 2, 1),
('5a1ded117e498', 5, '2017-11-29 00:08:54', 2, 2, 1),
('5a1ded119a5d2', 5, '2017-11-29 00:11:00', 2, 3, 1),
('5a1ea6f640fb6', 5, '2017-11-29 13:21:58', 2, 2, 1),
('5a1ea6f65195a', 5, '2017-11-29 13:23:50', 2, 5, 1);

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
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `level`, `food`, `experience`, `role`) VALUES
(5, 'Trudo', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 5, 5620, 205, 'admin'),
(10, 'Admin', '6c7ca345f63f835cb353ff15bd6c5e052ec08e7a', 1, 100, 0, 'user');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `report` (`report`);

--
-- Indexes for table `expedition_member`
--
ALTER TABLE `expedition_member`
  ADD KEY `hunterId` (`hunterId`),
  ADD KEY `expeditionId` (`expeditionId`);

--
-- Indexes for table `expedition_pit`
--
ALTER TABLE `expedition_pit`
  ADD KEY `pitId` (`pitId`),
  ADD KEY `expeditionId` (`expeditionId`);

--
-- Indexes for table `hunter`
--
ALTER TABLE `hunter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ability` (`ability`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `mammoth`
--
ALTER TABLE `mammoth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `murder`
--
ALTER TABLE `murder`
  ADD KEY `mammothId` (`mammothId`),
  ADD KEY `hunterId` (`hunterId`),
  ADD KEY `pitId` (`pitId`);

--
-- Indexes for table `outpost`
--
ALTER TABLE `outpost`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `outpost_member`
--
ALTER TABLE `outpost_member`
  ADD KEY `outpostId` (`outpostId`),
  ADD KEY `hunterId` (`hunterId`);

--
-- Indexes for table `pit`
--
ALTER TABLE `pit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

--
-- Indexes for table `record`
--
ALTER TABLE `record`
  ADD KEY `mammothId` (`mammothId`),
  ADD KEY `reportId` (`reportId`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `outpost`
--
ALTER TABLE `outpost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `pit`
--
ALTER TABLE `pit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `expedition`
--
ALTER TABLE `expedition`
  ADD CONSTRAINT `expedition_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expedition_ibfk_2` FOREIGN KEY (`report`) REFERENCES `report` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expedition_ibfk_3` FOREIGN KEY (`id`) REFERENCES `expedition_member` (`expeditionId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `expedition_ibfk_4` FOREIGN KEY (`id`) REFERENCES `expedition_pit` (`expeditionId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expedition_member`
--
ALTER TABLE `expedition_member`
  ADD CONSTRAINT `expedition_member_ibfk_1` FOREIGN KEY (`hunterId`) REFERENCES `hunter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expedition_pit`
--
ALTER TABLE `expedition_pit`
  ADD CONSTRAINT `expedition_pit_ibfk_1` FOREIGN KEY (`pitId`) REFERENCES `pit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hunter`
--
ALTER TABLE `hunter`
  ADD CONSTRAINT `hunter_ibfk_1` FOREIGN KEY (`ability`) REFERENCES `ability` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `hunter_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `murder`
--
ALTER TABLE `murder`
  ADD CONSTRAINT `murder_ibfk_1` FOREIGN KEY (`hunterId`) REFERENCES `hunter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `murder_ibfk_2` FOREIGN KEY (`mammothId`) REFERENCES `mammoth` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `murder_ibfk_3` FOREIGN KEY (`pitId`) REFERENCES `pit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outpost`
--
ALTER TABLE `outpost`
  ADD CONSTRAINT `outpost_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `outpost_member`
--
ALTER TABLE `outpost_member`
  ADD CONSTRAINT `outpost_member_ibfk_1` FOREIGN KEY (`hunterId`) REFERENCES `hunter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `outpost_member_ibfk_2` FOREIGN KEY (`outpostId`) REFERENCES `outpost` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pit`
--
ALTER TABLE `pit`
  ADD CONSTRAINT `pit_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `record`
--
ALTER TABLE `record`
  ADD CONSTRAINT `record_ibfk_1` FOREIGN KEY (`mammothId`) REFERENCES `mammoth` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `record_ibfk_2` FOREIGN KEY (`reportId`) REFERENCES `report` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
