-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 01, 2024 at 04:37 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `praytime`
--

-- --------------------------------------------------------

--
-- Table structure for table `box`
--

CREATE TABLE `box` (
  `boxId` int(11) NOT NULL,
  `boxName` varchar(255) DEFAULT NULL,
  `boxPrayerZone` varchar(255) DEFAULT NULL,
  `boxCreated` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `box`
--

INSERT INTO `box` (`boxId`, `boxName`, `boxPrayerZone`, `boxCreated`) VALUES
(1, 'Orchard Tower', 'WLY01', '2024-04-29 18:31:00'),
(2, 'United Square', 'SWK02', '2024-04-29 18:31:00'),
(3, 'Thompson Plaza', 'JHR01', '2024-04-29 18:31:54'),
(4, 'Peranakan Place', 'KDH01', '2024-04-29 20:31:04'),
(5, 'Marina Boulevard', 'MLK01', '2024-04-29 18:32:25');

-- --------------------------------------------------------

--
-- Table structure for table `boxSong`
--

CREATE TABLE `boxSong` (
  `boxSongId` int(11) NOT NULL,
  `boxId` int(11) NOT NULL,
  `songId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `boxSong`
--

INSERT INTO `boxSong` (`boxSongId`, `boxId`, `songId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 1),
(4, 2, 3),
(5, 3, 2),
(6, 3, 3),
(7, 4, 1),
(8, 4, 2),
(9, 4, 3),
(10, 5, 1),
(11, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `prayer`
--

CREATE TABLE `prayer` (
  `prayerId` int(11) NOT NULL,
  `PrayerZone` varchar(255) DEFAULT NULL,
  `prayerDate` date DEFAULT NULL,
  `prayerTime` time DEFAULT NULL,
  `prayerType` enum('imsak','fajr','syuruk','dhuhr','asr','maghrib','isha') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prayer`
--

INSERT INTO `prayer` (`prayerId`, `PrayerZone`, `prayerDate`, `prayerTime`, `prayerType`) VALUES
(1, 'WLY01', '2024-04-30', '05:44:00', 'imsak'),
(2, 'WLY01', '2024-04-30', '05:54:00', 'fajr'),
(3, 'WLY01', '2024-04-30', '07:03:00', 'syuruk'),
(4, 'WLY01', '2024-04-30', '13:13:00', 'dhuhr'),
(5, 'WLY01', '2024-04-30', '16:31:00', 'asr'),
(6, 'WLY01', '2024-04-30', '19:20:00', 'maghrib'),
(7, 'WLY01', '2024-04-30', '20:31:00', 'isha'),
(8, 'WLY01', '2024-05-01', '05:43:00', 'imsak'),
(9, 'WLY01', '2024-05-01', '05:53:00', 'fajr'),
(10, 'WLY01', '2024-05-01', '07:03:00', 'syuruk'),
(11, 'WLY01', '2024-05-01', '13:13:00', 'dhuhr'),
(12, 'WLY01', '2024-05-01', '16:31:00', 'asr'),
(13, 'WLY01', '2024-05-01', '19:20:00', 'maghrib'),
(14, 'WLY01', '2024-05-01', '20:31:00', 'isha'),
(15, 'WLY01', '2024-05-02', '05:43:00', 'imsak'),
(16, 'WLY01', '2024-05-02', '05:53:00', 'fajr'),
(17, 'WLY01', '2024-05-02', '07:02:00', 'syuruk'),
(18, 'WLY01', '2024-05-02', '13:13:00', 'dhuhr'),
(19, 'WLY01', '2024-05-02', '16:31:00', 'asr'),
(20, 'WLY01', '2024-05-02', '19:20:00', 'maghrib'),
(21, 'WLY01', '2024-05-02', '20:31:00', 'isha'),
(22, 'WLY01', '2024-05-03', '05:43:00', 'imsak'),
(23, 'WLY01', '2024-05-03', '05:53:00', 'fajr'),
(24, 'WLY01', '2024-05-03', '07:02:00', 'syuruk'),
(25, 'WLY01', '2024-05-03', '13:13:00', 'dhuhr'),
(26, 'WLY01', '2024-05-03', '16:32:00', 'asr'),
(27, 'WLY01', '2024-05-03', '19:20:00', 'maghrib'),
(28, 'WLY01', '2024-05-03', '20:31:00', 'isha'),
(29, 'WLY01', '2024-05-04', '05:42:00', 'imsak'),
(30, 'WLY01', '2024-05-04', '05:52:00', 'fajr'),
(31, 'WLY01', '2024-05-04', '07:02:00', 'syuruk'),
(32, 'WLY01', '2024-05-04', '13:13:00', 'dhuhr'),
(33, 'WLY01', '2024-05-04', '16:32:00', 'asr'),
(34, 'WLY01', '2024-05-04', '19:20:00', 'maghrib'),
(35, 'WLY01', '2024-05-04', '20:32:00', 'isha'),
(36, 'WLY01', '2024-05-05', '05:42:00', 'imsak'),
(37, 'WLY01', '2024-05-05', '05:52:00', 'fajr'),
(38, 'WLY01', '2024-05-05', '07:02:00', 'syuruk'),
(39, 'WLY01', '2024-05-05', '13:13:00', 'dhuhr'),
(40, 'WLY01', '2024-05-05', '16:32:00', 'asr'),
(41, 'WLY01', '2024-05-05', '19:20:00', 'maghrib'),
(42, 'WLY01', '2024-05-05', '20:32:00', 'isha'),
(43, 'WLY01', '2024-05-06', '05:42:00', 'imsak'),
(44, 'WLY01', '2024-05-06', '05:52:00', 'fajr'),
(45, 'WLY01', '2024-05-06', '07:02:00', 'syuruk'),
(46, 'WLY01', '2024-05-06', '13:13:00', 'dhuhr'),
(47, 'WLY01', '2024-05-06', '16:32:00', 'asr'),
(48, 'WLY01', '2024-05-06', '19:20:00', 'maghrib'),
(49, 'WLY01', '2024-05-06', '20:32:00', 'isha'),
(50, 'SWK02', '2024-04-30', '04:54:00', 'imsak'),
(51, 'SWK02', '2024-04-30', '05:04:00', 'fajr'),
(52, 'SWK02', '2024-04-30', '06:14:00', 'syuruk'),
(53, 'SWK02', '2024-04-30', '12:24:00', 'dhuhr'),
(54, 'SWK02', '2024-04-30', '15:41:00', 'asr'),
(55, 'SWK02', '2024-04-30', '18:30:00', 'maghrib'),
(56, 'SWK02', '2024-04-30', '19:42:00', 'isha'),
(57, 'SWK02', '2024-05-01', '04:53:00', 'imsak'),
(58, 'SWK02', '2024-05-01', '05:03:00', 'fajr'),
(59, 'SWK02', '2024-05-01', '06:14:00', 'syuruk'),
(60, 'SWK02', '2024-05-01', '12:24:00', 'dhuhr'),
(61, 'SWK02', '2024-05-01', '15:42:00', 'asr'),
(62, 'SWK02', '2024-05-01', '18:30:00', 'maghrib'),
(63, 'SWK02', '2024-05-01', '21:37:20', 'isha'),
(64, 'SWK02', '2024-05-02', '04:53:00', 'imsak'),
(65, 'SWK02', '2024-05-02', '05:03:00', 'fajr'),
(66, 'SWK02', '2024-05-02', '06:14:00', 'syuruk'),
(67, 'SWK02', '2024-05-02', '12:24:00', 'dhuhr'),
(68, 'SWK02', '2024-05-02', '15:42:00', 'asr'),
(69, 'SWK02', '2024-05-02', '18:30:00', 'maghrib'),
(70, 'SWK02', '2024-05-02', '19:42:00', 'isha'),
(71, 'SWK02', '2024-05-03', '04:53:00', 'imsak'),
(72, 'SWK02', '2024-05-03', '05:03:00', 'fajr'),
(73, 'SWK02', '2024-05-03', '06:14:00', 'syuruk'),
(74, 'SWK02', '2024-05-03', '12:24:00', 'dhuhr'),
(75, 'SWK02', '2024-05-03', '15:42:00', 'asr'),
(76, 'SWK02', '2024-05-03', '18:30:00', 'maghrib'),
(77, 'SWK02', '2024-05-03', '19:42:00', 'isha'),
(78, 'SWK02', '2024-05-04', '04:52:00', 'imsak'),
(79, 'SWK02', '2024-05-04', '05:02:00', 'fajr'),
(80, 'SWK02', '2024-05-04', '06:13:00', 'syuruk'),
(81, 'SWK02', '2024-05-04', '12:23:00', 'dhuhr'),
(82, 'SWK02', '2024-05-04', '15:42:00', 'asr'),
(83, 'SWK02', '2024-05-04', '18:30:00', 'maghrib'),
(84, 'SWK02', '2024-05-04', '19:42:00', 'isha'),
(85, 'SWK02', '2024-05-05', '04:52:00', 'imsak'),
(86, 'SWK02', '2024-05-05', '05:02:00', 'fajr'),
(87, 'SWK02', '2024-05-05', '06:13:00', 'syuruk'),
(88, 'SWK02', '2024-05-05', '12:23:00', 'dhuhr'),
(89, 'SWK02', '2024-05-05', '15:43:00', 'asr'),
(90, 'SWK02', '2024-05-05', '18:30:00', 'maghrib'),
(91, 'SWK02', '2024-05-05', '19:43:00', 'isha'),
(92, 'SWK02', '2024-05-06', '04:52:00', 'imsak'),
(93, 'SWK02', '2024-05-06', '05:02:00', 'fajr'),
(94, 'SWK02', '2024-05-06', '06:13:00', 'syuruk'),
(95, 'SWK02', '2024-05-06', '12:23:00', 'dhuhr'),
(96, 'SWK02', '2024-05-06', '15:43:00', 'asr'),
(97, 'SWK02', '2024-05-06', '18:30:00', 'maghrib'),
(98, 'SWK02', '2024-05-06', '19:43:00', 'isha'),
(99, 'JHR01', '2024-04-30', '05:33:00', 'imsak'),
(100, 'JHR01', '2024-04-30', '05:43:00', 'fajr'),
(101, 'JHR01', '2024-04-30', '06:53:00', 'syuruk'),
(102, 'JHR01', '2024-04-30', '13:02:00', 'dhuhr'),
(103, 'JHR01', '2024-04-30', '16:20:00', 'asr'),
(104, 'JHR01', '2024-04-30', '19:07:00', 'maghrib'),
(105, 'JHR01', '2024-04-30', '20:18:00', 'isha'),
(106, 'JHR01', '2024-05-01', '05:33:00', 'imsak'),
(107, 'JHR01', '2024-05-01', '05:43:00', 'fajr'),
(108, 'JHR01', '2024-05-01', '06:53:00', 'syuruk'),
(109, 'JHR01', '2024-05-01', '13:01:00', 'dhuhr'),
(110, 'JHR01', '2024-05-01', '16:20:00', 'asr'),
(111, 'JHR01', '2024-05-01', '19:07:00', 'maghrib'),
(112, 'JHR01', '2024-05-01', '20:18:00', 'isha'),
(113, 'JHR01', '2024-05-02', '05:32:00', 'imsak'),
(114, 'JHR01', '2024-05-02', '05:42:00', 'fajr'),
(115, 'JHR01', '2024-05-02', '06:53:00', 'syuruk'),
(116, 'JHR01', '2024-05-02', '13:01:00', 'dhuhr'),
(117, 'JHR01', '2024-05-02', '16:20:00', 'asr'),
(118, 'JHR01', '2024-05-02', '19:06:00', 'maghrib'),
(119, 'JHR01', '2024-05-02', '20:18:00', 'isha'),
(120, 'JHR01', '2024-05-03', '05:32:00', 'imsak'),
(121, 'JHR01', '2024-05-03', '05:42:00', 'fajr'),
(122, 'JHR01', '2024-05-03', '06:53:00', 'syuruk'),
(123, 'JHR01', '2024-05-03', '13:01:00', 'dhuhr'),
(124, 'JHR01', '2024-05-03', '16:20:00', 'asr'),
(125, 'JHR01', '2024-05-03', '19:06:00', 'maghrib'),
(126, 'JHR01', '2024-05-03', '20:18:00', 'isha'),
(127, 'JHR01', '2024-05-04', '05:32:00', 'imsak'),
(128, 'JHR01', '2024-05-04', '05:42:00', 'fajr'),
(129, 'JHR01', '2024-05-04', '06:53:00', 'syuruk'),
(130, 'JHR01', '2024-05-04', '13:01:00', 'dhuhr'),
(131, 'JHR01', '2024-05-04', '16:20:00', 'asr'),
(132, 'JHR01', '2024-05-04', '19:06:00', 'maghrib'),
(133, 'JHR01', '2024-05-04', '20:18:00', 'isha'),
(134, 'JHR01', '2024-05-05', '05:32:00', 'imsak'),
(135, 'JHR01', '2024-05-05', '05:42:00', 'fajr'),
(136, 'JHR01', '2024-05-05', '06:52:00', 'syuruk'),
(137, 'JHR01', '2024-05-05', '13:01:00', 'dhuhr'),
(138, 'JHR01', '2024-05-05', '16:21:00', 'asr'),
(139, 'JHR01', '2024-05-05', '19:06:00', 'maghrib'),
(140, 'JHR01', '2024-05-05', '20:18:00', 'isha'),
(141, 'JHR01', '2024-05-06', '05:31:00', 'imsak'),
(142, 'JHR01', '2024-05-06', '05:41:00', 'fajr'),
(143, 'JHR01', '2024-05-06', '06:52:00', 'syuruk'),
(144, 'JHR01', '2024-05-06', '13:01:00', 'dhuhr'),
(145, 'JHR01', '2024-05-06', '16:21:00', 'asr'),
(146, 'JHR01', '2024-05-06', '19:06:00', 'maghrib'),
(147, 'JHR01', '2024-05-06', '20:18:00', 'isha'),
(148, 'KDH01', '2024-04-30', '05:45:00', 'imsak'),
(149, 'KDH01', '2024-04-30', '05:55:00', 'fajr'),
(150, 'KDH01', '2024-04-30', '07:04:00', 'syuruk'),
(151, 'KDH01', '2024-04-30', '13:18:00', 'dhuhr'),
(152, 'KDH01', '2024-04-30', '16:34:00', 'asr'),
(153, 'KDH01', '2024-04-30', '19:27:00', 'maghrib'),
(154, 'KDH01', '2024-04-30', '20:39:00', 'isha'),
(155, 'KDH01', '2024-05-01', '05:44:00', 'imsak'),
(156, 'KDH01', '2024-05-01', '05:54:00', 'fajr'),
(157, 'KDH01', '2024-05-01', '07:04:00', 'syuruk'),
(158, 'KDH01', '2024-05-01', '13:18:00', 'dhuhr'),
(159, 'KDH01', '2024-05-01', '16:34:00', 'asr'),
(160, 'KDH01', '2024-05-01', '19:27:00', 'maghrib'),
(161, 'KDH01', '2024-05-01', '20:39:00', 'isha'),
(162, 'KDH01', '2024-05-02', '05:44:00', 'imsak'),
(163, 'KDH01', '2024-05-02', '05:54:00', 'fajr'),
(164, 'KDH01', '2024-05-02', '07:03:00', 'syuruk'),
(165, 'KDH01', '2024-05-02', '13:18:00', 'dhuhr'),
(166, 'KDH01', '2024-05-02', '16:34:00', 'asr'),
(167, 'KDH01', '2024-05-02', '19:27:00', 'maghrib'),
(168, 'KDH01', '2024-05-02', '20:39:00', 'isha'),
(169, 'KDH01', '2024-05-03', '05:44:00', 'imsak'),
(170, 'KDH01', '2024-05-03', '05:54:00', 'fajr'),
(171, 'KDH01', '2024-05-03', '07:03:00', 'syuruk'),
(172, 'KDH01', '2024-05-03', '13:18:00', 'dhuhr'),
(173, 'KDH01', '2024-05-03', '16:35:00', 'asr'),
(174, 'KDH01', '2024-05-03', '19:27:00', 'maghrib'),
(175, 'KDH01', '2024-05-03', '20:40:00', 'isha'),
(176, 'KDH01', '2024-05-04', '05:43:00', 'imsak'),
(177, 'KDH01', '2024-05-04', '05:53:00', 'fajr'),
(178, 'KDH01', '2024-05-04', '07:03:00', 'syuruk'),
(179, 'KDH01', '2024-05-04', '13:18:00', 'dhuhr'),
(180, 'KDH01', '2024-05-04', '16:35:00', 'asr'),
(181, 'KDH01', '2024-05-04', '19:27:00', 'maghrib'),
(182, 'KDH01', '2024-05-04', '20:40:00', 'isha'),
(183, 'KDH01', '2024-05-05', '05:43:00', 'imsak'),
(184, 'KDH01', '2024-05-05', '05:53:00', 'fajr'),
(185, 'KDH01', '2024-05-05', '07:03:00', 'syuruk'),
(186, 'KDH01', '2024-05-05', '13:18:00', 'dhuhr'),
(187, 'KDH01', '2024-05-05', '16:35:00', 'asr'),
(188, 'KDH01', '2024-05-05', '19:27:00', 'maghrib'),
(189, 'KDH01', '2024-05-05', '20:40:00', 'isha'),
(190, 'KDH01', '2024-05-06', '05:43:00', 'imsak'),
(191, 'KDH01', '2024-05-06', '05:53:00', 'fajr'),
(192, 'KDH01', '2024-05-06', '07:02:00', 'syuruk'),
(193, 'KDH01', '2024-05-06', '13:17:00', 'dhuhr'),
(194, 'KDH01', '2024-05-06', '16:36:00', 'asr'),
(195, 'KDH01', '2024-05-06', '19:27:00', 'maghrib'),
(196, 'KDH01', '2024-05-06', '20:40:00', 'isha'),
(197, 'MLK01', '2024-04-30', '05:42:00', 'imsak'),
(198, 'MLK01', '2024-04-30', '05:52:00', 'fajr'),
(199, 'MLK01', '2024-04-30', '07:03:00', 'syuruk'),
(200, 'MLK01', '2024-04-30', '13:11:00', 'dhuhr'),
(201, 'MLK01', '2024-04-30', '16:29:00', 'asr'),
(202, 'MLK01', '2024-04-30', '19:16:00', 'maghrib'),
(203, 'MLK01', '2024-04-30', '20:27:00', 'isha'),
(204, 'MLK01', '2024-05-01', '05:42:00', 'imsak'),
(205, 'MLK01', '2024-05-01', '05:52:00', 'fajr'),
(206, 'MLK01', '2024-05-01', '07:03:00', 'syuruk'),
(207, 'MLK01', '2024-05-01', '13:11:00', 'dhuhr'),
(208, 'MLK01', '2024-05-01', '16:29:00', 'asr'),
(209, 'MLK01', '2024-05-01', '19:16:00', 'maghrib'),
(210, 'MLK01', '2024-05-01', '20:27:00', 'isha'),
(211, 'MLK01', '2024-05-02', '05:42:00', 'imsak'),
(212, 'MLK01', '2024-05-02', '05:52:00', 'fajr'),
(213, 'MLK01', '2024-05-02', '07:02:00', 'syuruk'),
(214, 'MLK01', '2024-05-02', '13:11:00', 'dhuhr'),
(215, 'MLK01', '2024-05-02', '16:30:00', 'asr'),
(216, 'MLK01', '2024-05-02', '19:16:00', 'maghrib'),
(217, 'MLK01', '2024-05-02', '20:27:00', 'isha'),
(218, 'MLK01', '2024-05-03', '05:42:00', 'imsak'),
(219, 'MLK01', '2024-05-03', '05:52:00', 'fajr'),
(220, 'MLK01', '2024-05-03', '07:02:00', 'syuruk'),
(221, 'MLK01', '2024-05-03', '13:10:00', 'dhuhr'),
(222, 'MLK01', '2024-05-03', '16:30:00', 'asr'),
(223, 'MLK01', '2024-05-03', '19:16:00', 'maghrib'),
(224, 'MLK01', '2024-05-03', '20:27:00', 'isha'),
(225, 'MLK01', '2024-05-04', '05:41:00', 'imsak'),
(226, 'MLK01', '2024-05-04', '05:51:00', 'fajr'),
(227, 'MLK01', '2024-05-04', '07:02:00', 'syuruk'),
(228, 'MLK01', '2024-05-04', '13:10:00', 'dhuhr'),
(229, 'MLK01', '2024-05-04', '16:30:00', 'asr'),
(230, 'MLK01', '2024-05-04', '19:16:00', 'maghrib'),
(231, 'MLK01', '2024-05-04', '20:27:00', 'isha'),
(232, 'MLK01', '2024-05-05', '05:41:00', 'imsak'),
(233, 'MLK01', '2024-05-05', '05:51:00', 'fajr'),
(234, 'MLK01', '2024-05-05', '07:02:00', 'syuruk'),
(235, 'MLK01', '2024-05-05', '13:10:00', 'dhuhr'),
(236, 'MLK01', '2024-05-05', '16:30:00', 'asr'),
(237, 'MLK01', '2024-05-05', '19:16:00', 'maghrib'),
(238, 'MLK01', '2024-05-05', '20:27:00', 'isha'),
(239, 'MLK01', '2024-05-06', '05:41:00', 'imsak'),
(240, 'MLK01', '2024-05-06', '05:51:00', 'fajr'),
(241, 'MLK01', '2024-05-06', '07:02:00', 'syuruk'),
(242, 'MLK01', '2024-05-06', '13:10:00', 'dhuhr'),
(243, 'MLK01', '2024-05-06', '16:30:00', 'asr'),
(244, 'MLK01', '2024-05-06', '19:16:00', 'maghrib'),
(245, 'MLK01', '2024-05-06', '20:28:00', 'isha');

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `songId` int(11) NOT NULL,
  `songName` varchar(255) DEFAULT NULL,
  `songUrl` text DEFAULT NULL,
  `songCreated` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`songId`, `songName`, `songUrl`, `songCreated`) VALUES
(1, 'Ahmed El Kourdi', '8c052a5edec1.mp3', '2024-04-30 14:14:08'),
(2, 'Adham Al Sharqawe', 'cbcd8d249dcc.mp3', '2024-04-30 14:14:08'),
(3, 'Hamza Al Majale', '495dea4f4ea5.mp3', '2024-04-30 14:16:23');

-- --------------------------------------------------------

--
-- Table structure for table `subsBox`
--

CREATE TABLE `subsBox` (
  `subsBoxId` int(11) NOT NULL,
  `boxId` int(11) NOT NULL,
  `subsId` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subsBox`
--

INSERT INTO `subsBox` (`subsBoxId`, `boxId`, `subsId`) VALUES
(5, 3, 6),
(3, 2, 6),
(6, 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `subscriber`
--

CREATE TABLE `subscriber` (
  `subsId` int(11) NOT NULL,
  `subsEmail` varchar(255) DEFAULT NULL,
  `subsName` varchar(255) DEFAULT NULL,
  `subsPassword` text DEFAULT NULL,
  `subsJoinDate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subscriber`
--

INSERT INTO `subscriber` (`subsId`, `subsEmail`, `subsName`, `subsPassword`, `subsJoinDate`) VALUES
(6, 'admin@admin.id', 'admin', '$2y$10$DttbaYTMxjAPuDIJouAxcOpNQHvWjsZx79WjgfhNQgM/fWbMOjSYK', '2024-04-29 15:29:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `box`
--
ALTER TABLE `box`
  ADD PRIMARY KEY (`boxId`);

--
-- Indexes for table `boxSong`
--
ALTER TABLE `boxSong`
  ADD PRIMARY KEY (`boxSongId`);

--
-- Indexes for table `prayer`
--
ALTER TABLE `prayer`
  ADD PRIMARY KEY (`prayerId`),
  ADD UNIQUE KEY `unique_prayer_combination` (`PrayerZone`,`prayerDate`,`prayerType`) USING HASH;

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`songId`);

--
-- Indexes for table `subsBox`
--
ALTER TABLE `subsBox`
  ADD PRIMARY KEY (`subsBoxId`);

--
-- Indexes for table `subscriber`
--
ALTER TABLE `subscriber`
  ADD PRIMARY KEY (`subsId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `box`
--
ALTER TABLE `box`
  MODIFY `boxId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `boxSong`
--
ALTER TABLE `boxSong`
  MODIFY `boxSongId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `prayer`
--
ALTER TABLE `prayer`
  MODIFY `prayerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=246;

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `songId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subsBox`
--
ALTER TABLE `subsBox`
  MODIFY `subsBoxId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subscriber`
--
ALTER TABLE `subscriber`
  MODIFY `subsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
