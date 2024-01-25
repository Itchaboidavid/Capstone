-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2024 at 06:31 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone_db`
--
CREATE DATABASE IF NOT EXISTS `capstone_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `capstone_db`;

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `id` int(11) NOT NULL,
  `school_name` varchar(255) NOT NULL,
  `school_id` int(255) NOT NULL,
  `school_district` varchar(255) NOT NULL,
  `school_division` varchar(255) NOT NULL,
  `school_region` varchar(255) NOT NULL,
  `school_head` varchar(255) NOT NULL,
  `schoolhead_designation` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`id`, `school_name`, `school_id`, `school_district`, `school_division`, `school_region`, `school_head`, `schoolhead_designation`) VALUES
(1, 'Tagaytay City National High School -ISHS', 301216, 'Tagaytay City', 'Cavite', 'REGION IV-A', 'LORENA V. MIRANDA', 'PRINCIPAL IV');

-- --------------------------------------------------------

--
-- Table structure for table `schoolstart`
--

CREATE TABLE `schoolstart` (
  `id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schoolstart`
--

INSERT INTO `schoolstart` (`id`, `month`, `year`, `start_date`, `end_date`) VALUES
(1, 1, 2024, 1, 30);

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `id` int(11) NOT NULL,
  `start_year` int(11) NOT NULL,
  `end_year` int(11) NOT NULL,
  `sy` varchar(11) NOT NULL,
  `is_archived` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`id`, `start_year`, `end_year`, `sy`, `is_archived`) VALUES
(1, 2023, 2024, '2023 - 2024', 1),
(2, 2024, 2025, '2024 - 2025', 0);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `track` varchar(255) NOT NULL,
  `strand` varchar(255) NOT NULL,
  `grade` int(255) NOT NULL,
  `adviser_id` int(11) NOT NULL,
  `adviser` varchar(255) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `is_archived` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`, `track`, `strand`, `grade`, `adviser_id`, `adviser`, `school_year_id`, `school_year`, `is_archived`) VALUES
(1, 'Preservance', 'Academic', 'Science, Technology, Engineering and Mathematics', 12, 30, 'Daryl Balbastro', 1, '2023 - 2024', 1),
(2, 'Humility', 'Academic', 'Humanities and Social Science', 11, 28, 'Arcie Natuel', 1, '2023 - 2024', 1),
(3, 'Responsibility', 'Academic', 'Humanities and Social Science', 11, 30, 'Daryl Balbastro', 2, '2024 - 2025', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sf2`
--

CREATE TABLE `sf2` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `student_section` varchar(255) DEFAULT NULL,
  `school_year_id` int(11) NOT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `attendance_status` varchar(11) DEFAULT NULL,
  `attendance_month` int(11) NOT NULL,
  `attendance_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sf2`
--

INSERT INTO `sf2` (`id`, `student_id`, `student_name`, `student_section`, `school_year_id`, `sex`, `day`, `attendance_status`, `attendance_month`, `attendance_year`) VALUES
(1, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '1', 'on', 1, 2024),
(2, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '2', 'on', 1, 2024),
(3, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '3', 'on', 1, 2024),
(4, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '4', 'on', 1, 2024),
(5, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '5', 'on', 1, 2024),
(6, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '8', 'on', 1, 2024),
(7, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '9', 'on', 1, 2024),
(8, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '10', 'on', 1, 2024),
(9, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '11', 'on', 1, 2024),
(10, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '12', 'on', 1, 2024),
(11, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '15', 'on', 1, 2024),
(12, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '16', 'on', 1, 2024),
(13, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '17', 'on', 1, 2024),
(14, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '18', 'on', 1, 2024),
(15, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '19', 'on', 1, 2024),
(16, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '22', 'on', 1, 2024),
(17, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '23', 'on', 1, 2024),
(18, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '24', 'on', 1, 2024),
(19, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '25', 'on', 1, 2024),
(20, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '26', 'on', 1, 2024),
(21, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '29', 'on', 1, 2024),
(22, 7, 'Duen, Janella  Merodo', 'Responsibility', 2, 'F', '30', 'on', 1, 2024),
(23, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '1', 'on', 1, 2024),
(24, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '2', 'on', 1, 2024),
(25, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '3', 'on', 1, 2024),
(26, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '4', 'on', 1, 2024),
(27, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '5', 'on', 1, 2024),
(28, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '8', 'on', 1, 2024),
(29, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '9', 'on', 1, 2024),
(30, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '10', 'on', 1, 2024),
(31, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '11', 'on', 1, 2024),
(32, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '12', 'on', 1, 2024),
(33, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '15', 'on', 1, 2024),
(34, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '16', 'on', 1, 2024),
(35, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '17', 'on', 1, 2024),
(36, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '18', 'on', 1, 2024),
(37, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '19', 'on', 1, 2024),
(38, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '22', 'on', 1, 2024),
(40, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '24', 'on', 1, 2024),
(41, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '25', 'on', 1, 2024),
(42, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '26', 'on', 1, 2024),
(43, 11, 'Inigaw, Charmaine  Humaya', 'Responsibility', 2, 'F', '29', 'on', 1, 2024),
(45, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '1', 'on', 1, 2024),
(46, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '2', 'on', 1, 2024),
(47, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '3', 'on', 1, 2024),
(48, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '4', 'on', 1, 2024),
(49, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '5', 'on', 1, 2024),
(50, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '8', 'on', 1, 2024),
(51, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '9', 'on', 1, 2024),
(52, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '10', 'on', 1, 2024),
(53, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '11', 'on', 1, 2024),
(54, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '12', 'on', 1, 2024),
(55, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '15', 'on', 1, 2024),
(56, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '16', 'on', 1, 2024),
(57, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '17', 'on', 1, 2024),
(58, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '18', 'on', 1, 2024),
(59, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '19', 'on', 1, 2024),
(60, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '22', 'on', 1, 2024),
(61, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '23', 'on', 1, 2024),
(62, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '24', 'on', 1, 2024),
(63, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '25', 'on', 1, 2024),
(64, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '26', 'on', 1, 2024),
(65, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '29', 'on', 1, 2024),
(66, 12, 'Tamayo, Janel  Ruby', 'Responsibility', 2, 'F', '30', 'on', 1, 2024),
(67, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '1', 'on', 1, 2024),
(68, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '2', 'on', 1, 2024),
(69, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '3', 'on', 1, 2024),
(70, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '4', 'on', 1, 2024),
(71, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '5', 'on', 1, 2024),
(72, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '8', 'on', 1, 2024),
(73, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '9', 'on', 1, 2024),
(74, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '10', 'on', 1, 2024),
(75, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '11', 'on', 1, 2024),
(76, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '12', 'on', 1, 2024),
(77, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '15', 'on', 1, 2024),
(78, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '16', 'on', 1, 2024),
(79, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '17', 'on', 1, 2024),
(80, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '18', 'on', 1, 2024),
(81, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '19', 'on', 1, 2024),
(82, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '22', 'on', 1, 2024),
(83, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '23', 'on', 1, 2024),
(84, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '24', 'on', 1, 2024),
(85, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '25', 'on', 1, 2024),
(86, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '26', 'on', 1, 2024),
(87, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '29', 'on', 1, 2024),
(88, 9, 'Inas, Charles  Sanaye ', 'Responsibility', 2, 'M', '30', 'on', 1, 2024),
(89, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '1', 'on', 1, 2024),
(90, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '2', 'on', 1, 2024),
(91, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '3', 'on', 1, 2024),
(92, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '4', 'on', 1, 2024),
(93, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '5', 'on', 1, 2024),
(94, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '8', 'on', 1, 2024),
(95, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '9', 'on', 1, 2024),
(96, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '10', 'on', 1, 2024),
(97, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '11', 'on', 1, 2024),
(98, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '12', 'on', 1, 2024),
(99, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '15', 'on', 1, 2024),
(100, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '16', 'on', 1, 2024),
(102, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '18', 'on', 1, 2024),
(103, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '19', 'on', 1, 2024),
(104, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '22', 'on', 1, 2024),
(105, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '23', 'on', 1, 2024),
(106, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '24', 'on', 1, 2024),
(108, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '26', 'on', 1, 2024),
(109, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '29', 'on', 1, 2024),
(110, 10, 'Meyara, Daryl  Forson', 'Responsibility', 2, 'M', '30', 'on', 1, 2024),
(111, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '1', 'on', 1, 2024),
(112, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '2', 'on', 1, 2024),
(113, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '3', 'on', 1, 2024),
(114, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '4', 'on', 1, 2024),
(115, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '5', 'on', 1, 2024),
(116, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '8', 'on', 1, 2024),
(117, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '9', 'on', 1, 2024),
(118, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '10', 'on', 1, 2024),
(119, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '11', 'on', 1, 2024),
(120, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '12', 'on', 1, 2024),
(121, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '15', 'on', 1, 2024),
(122, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '16', 'on', 1, 2024),
(123, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '17', 'on', 1, 2024),
(124, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '18', 'on', 1, 2024),
(125, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '19', 'on', 1, 2024),
(126, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '22', 'on', 1, 2024),
(127, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '23', 'on', 1, 2024),
(128, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '24', 'on', 1, 2024),
(129, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '25', 'on', 1, 2024),
(130, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '26', 'on', 1, 2024),
(131, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '29', 'on', 1, 2024),
(132, 8, 'Mirinda, David  Wentino', 'Responsibility', 2, 'M', '30', 'on', 1, 2024);

-- --------------------------------------------------------

--
-- Table structure for table `sf2remarks`
--

CREATE TABLE `sf2remarks` (
  `id` int(11) NOT NULL,
  `student_id` int(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sf5b`
--

CREATE TABLE `sf5b` (
  `id` int(11) NOT NULL,
  `lrn` int(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `completed` varchar(255) NOT NULL,
  `nc` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sf5b`
--

INSERT INTO `sf5b` (`id`, `lrn`, `student_name`, `school_year_id`, `completed`, `nc`, `section`, `sex`) VALUES
(1, 20010405, 'Amando, Steven  Igncaio', 1, 'Yes', 'NC I', 'Preservance', 'M'),
(2, 20010403, 'Cabrera, Anne  Mayabag ', 1, 'Yes', 'NC I', 'Preservance', 'F'),
(3, 20010401, 'Cauyong, Dhayne  ', 1, 'Yes', 'NC I', 'Preservance', 'M'),
(4, 20010406, 'Forsolon, Samantha  Irege', 1, 'Yes', 'NC I', 'Preservance', 'F'),
(5, 20010402, 'Irenea, Jhanniel  Balosco', 1, 'Yes', 'NC I', 'Preservance', 'F'),
(6, 20010404, 'Jose, Jarule  Belano', 1, 'Yes', 'NC I', 'Preservance', 'M'),
(7, 20010421, 'Duen, Janella  Merodo', 2, 'Yes', '', 'Responsibility', 'F'),
(8, 20010423, 'Inas, Charles  Sanaye ', 2, 'Yes', 'NC II', 'Responsibility', 'M'),
(9, 20010425, 'Inigaw, Charmaine  Humaya', 2, 'Yes', 'NC II', 'Responsibility', 'F'),
(10, 20010424, 'Meyara, Daryl  Forson', 2, 'Yes', 'NC II', 'Responsibility', 'M'),
(11, 20010422, 'Mirinda, David  Wentino', 2, 'Yes', 'NC II', 'Responsibility', 'M'),
(12, 20010426, 'Tamayo, Janel  Ruby', 2, 'Yes', 'NC II', 'Responsibility', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `sf9`
--

CREATE TABLE `sf9` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `subject_type` varchar(255) NOT NULL,
  `subject_title` varchar(255) NOT NULL,
  `sem_grade1` float NOT NULL,
  `sem_grade2` float NOT NULL,
  `final_grade` float NOT NULL,
  `semester` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sf9`
--

INSERT INTO `sf9` (`id`, `student_name`, `school_year_id`, `subject_type`, `subject_title`, `sem_grade1`, `sem_grade2`, `final_grade`, `semester`, `sex`, `section`) VALUES
(1, 'Amando, Steven  Igncaio', 1, 'Core', 'Physical Education and Health', 98, 99, 98.5, '1st', 'M', 'Preservance'),
(2, 'Amando, Steven  Igncaio', 1, 'Core', 'Introduction to the Philosophy of the Human Person/Pambungad sa Pilosopiya ng Tao', 97, 98, 97.5, '1st', 'M', 'Preservance'),
(3, 'Amando, Steven  Igncaio', 1, 'Applied', 'Practical Research 2', 95, 95, 95, '1st', 'M', 'Preservance'),
(4, 'Amando, Steven  Igncaio', 1, 'Core', 'Personality Development', 91, 94, 92.5, '1st', 'M', 'Preservance'),
(5, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(6, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(7, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(8, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(9, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(10, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(11, 'Amando, Steven  Igncaio', 1, 'Core', 'Media and Information Technology', 97, 96, 96.5, '2nd', 'M', 'Preservance'),
(12, 'Amando, Steven  Igncaio', 1, 'Core', 'Contemporary Philippine Arts from the Regions', 97, 98, 97.5, '2nd', 'M', 'Preservance'),
(13, 'Amando, Steven  Igncaio', 1, 'Applied', 'Entrepreneurship', 95, 96, 95.5, '2nd', 'M', 'Preservance'),
(14, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(15, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(16, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(17, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(18, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(19, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(20, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(21, 'Cabrera, Anne  Mayabag ', 1, 'Core', 'Physical Education and Health', 98, 97, 97.5, '1st', 'F', 'Preservance'),
(22, 'Cabrera, Anne  Mayabag ', 1, 'Core', 'Introduction to the Philosophy of the Human Person/Pambungad sa Pilosopiya ng Tao', 96, 96, 96, '1st', 'F', 'Preservance'),
(23, 'Cabrera, Anne  Mayabag ', 1, 'Applied', 'Practical Research 2', 96, 95, 95.5, '1st', 'F', 'Preservance'),
(24, 'Cabrera, Anne  Mayabag ', 1, 'Applied', 'Inquiries, Investigation, and Immersion', 96, 97, 96.5, '1st', 'F', 'Preservance'),
(25, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(26, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(27, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(28, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(29, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(30, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(31, 'Cabrera, Anne  Mayabag ', 1, 'Core', 'Media and Information Technology', 97, 95, 96, '2nd', 'F', 'Preservance'),
(32, 'Cabrera, Anne  Mayabag ', 1, 'Core', 'Contemporary Philippine Arts from the Regions', 95, 97, 96, '2nd', 'F', 'Preservance'),
(33, 'Cabrera, Anne  Mayabag ', 1, 'Applied', 'Entrepreneurship', 97, 96, 96.5, '2nd', 'F', 'Preservance'),
(34, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(35, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(36, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(37, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(38, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(39, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(40, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(41, 'Cauyong, Dhayne  ', 1, 'Core', 'Physical Education and Health', 97, 96, 96.5, '1st', 'M', 'Preservance'),
(42, 'Cauyong, Dhayne  ', 1, 'Core', 'Introduction to the Philosophy of the Human Person/Pambungad sa Pilosopiya ng Tao', 97, 98, 97.5, '1st', 'M', 'Preservance'),
(43, 'Cauyong, Dhayne  ', 1, 'Applied', 'Practical Research 2', 96, 95, 95.5, '1st', 'M', 'Preservance'),
(44, 'Cauyong, Dhayne  ', 1, 'Applied', 'Inquiries, Investigation, and Immersion', 96, 95, 95.5, '1st', 'M', 'Preservance'),
(45, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(46, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(47, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(48, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(49, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(50, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(51, 'Cauyong, Dhayne  ', 1, 'Core', 'Media and Information Technology', 96, 96, 96, '2nd', 'M', 'Preservance'),
(52, 'Cauyong, Dhayne  ', 1, 'Core', 'Contemporary Philippine Arts from the Regions', 95, 95, 95, '2nd', 'M', 'Preservance'),
(53, 'Cauyong, Dhayne  ', 1, 'Applied', 'Entrepreneurship', 97, 95, 96, '2nd', 'M', 'Preservance'),
(54, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(55, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(56, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(57, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(58, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(59, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(60, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(61, 'Forsolon, Samantha  Irege', 1, 'Core', 'Physical Education and Health', 97, 95, 96, '1st', 'F', 'Preservance'),
(62, 'Forsolon, Samantha  Irege', 1, 'Core', 'Physical Education and Health', 96, 96, 96, '1st', 'F', 'Preservance'),
(63, 'Forsolon, Samantha  Irege', 1, 'Applied', 'Practical Research 2', 95, 94, 94.5, '1st', 'F', 'Preservance'),
(64, 'Forsolon, Samantha  Irege', 1, 'Applied', 'Inquiries, Investigation, and Immersion', 98, 95, 96.5, '1st', 'F', 'Preservance'),
(65, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(66, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(67, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(68, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(69, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(70, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(71, 'Forsolon, Samantha  Irege', 1, 'Core', 'Media and Information Technology', 98, 96, 97, '2nd', 'F', 'Preservance'),
(72, 'Forsolon, Samantha  Irege', 1, 'Core', 'Contemporary Philippine Arts from the Regions', 96, 95, 95.5, '2nd', 'F', 'Preservance'),
(73, 'Forsolon, Samantha  Irege', 1, 'Applied', 'Entrepreneurship', 97, 95, 96, '2nd', 'F', 'Preservance'),
(74, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(75, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(76, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(77, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(78, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(79, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(80, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(81, 'Irenea, Jhanniel  Balosco', 1, 'Core', 'Physical Education and Health', 97, 96, 96.5, '1st', 'F', 'Preservance'),
(82, 'Irenea, Jhanniel  Balosco', 1, 'Core', 'Introduction to the Philosophy of the Human Person/Pambungad sa Pilosopiya ng Tao', 96, 97, 96.5, '1st', 'F', 'Preservance'),
(83, 'Irenea, Jhanniel  Balosco', 1, 'Applied', 'Practical Research 2', 95, 96, 95.5, '1st', 'F', 'Preservance'),
(84, 'Irenea, Jhanniel  Balosco', 1, 'Applied', 'Inquiries, Investigation, and Immersion', 97, 96, 96.5, '1st', 'F', 'Preservance'),
(85, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(86, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(87, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(88, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(89, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(90, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '1st', 'F', 'Preservance'),
(91, 'Irenea, Jhanniel  Balosco', 1, 'Core', 'Media and Information Technology', 97, 95, 96, '2nd', 'F', 'Preservance'),
(92, 'Irenea, Jhanniel  Balosco', 1, 'Core', 'Contemporary Philippine Arts from the Regions', 96, 97, 96.5, '2nd', 'F', 'Preservance'),
(93, 'Irenea, Jhanniel  Balosco', 1, 'Applied', 'Entrepreneurship', 97, 98, 97.5, '2nd', 'F', 'Preservance'),
(94, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(95, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(96, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(97, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(98, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(99, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(100, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '2nd', 'F', 'Preservance'),
(101, 'Jose, Jarule  Belano', 1, 'Core', 'Physical Education and Health', 97, 96, 96.5, '1st', 'M', 'Preservance'),
(102, 'Jose, Jarule  Belano', 1, 'Core', 'Introduction to the Philosophy of the Human Person/Pambungad sa Pilosopiya ng Tao', 97, 96, 96.5, '1st', 'M', 'Preservance'),
(103, 'Jose, Jarule  Belano', 1, 'Applied', 'Practical Research 2', 95, 96, 95.5, '1st', 'M', 'Preservance'),
(104, 'Jose, Jarule  Belano', 1, 'Applied', 'Inquiries, Investigation, and Immersion', 98, 97, 97.5, '1st', 'M', 'Preservance'),
(105, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(106, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(107, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(108, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(109, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(110, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '1st', 'M', 'Preservance'),
(111, 'Jose, Jarule  Belano', 1, 'Core', 'Media and Information Technology', 97, 96, 96.5, '2nd', 'M', 'Preservance'),
(112, 'Jose, Jarule  Belano', 1, 'Core', 'Contemporary Philippine Arts from the Regions', 97, 96, 96.5, '2nd', 'M', 'Preservance'),
(113, 'Jose, Jarule  Belano', 1, 'Applied', 'Entrepreneurship', 96, 97, 96.5, '2nd', 'M', 'Preservance'),
(114, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(115, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(116, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(117, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(118, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(119, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(120, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '2nd', 'M', 'Preservance'),
(121, 'Duen, Janella  Merodo', 2, 'Core', 'Oral Communication in Context', 97, 97, 97, '1st', 'F', 'Responsibility'),
(122, 'Duen, Janella  Merodo', 2, 'Core', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 97, 97, 97, '1st', 'F', 'Responsibility'),
(123, 'Duen, Janella  Merodo', 2, 'Applied', 'Empowerment Technologies', 98, 96, 97, '1st', 'F', 'Responsibility'),
(124, 'Duen, Janella  Merodo', 2, 'Applied', 'English for Academic and Special Purposes', 95, 97, 96, '1st', 'F', 'Responsibility'),
(125, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(126, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(127, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(128, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(129, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(130, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(131, 'Duen, Janella  Merodo', 2, 'Core', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 97, 95, 96, '2nd', 'F', 'Responsibility'),
(132, 'Duen, Janella  Merodo', 2, 'Core', 'Understanding Culture, Society, and Politics', 96, 95, 95.5, '2nd', 'F', 'Responsibility'),
(133, 'Duen, Janella  Merodo', 2, 'Applied', 'Practical Research 1', 98, 97, 97.5, '2nd', 'F', 'Responsibility'),
(134, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(135, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(136, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(137, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(138, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(139, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(140, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(141, 'Inas, Charles  Sanaye ', 2, 'Core', 'Oral Communication in Context', 97, 96, 96.5, '1st', 'M', 'Responsibility'),
(142, 'Inas, Charles  Sanaye ', 2, 'Core', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 96, 97, 96.5, '1st', 'M', 'Responsibility'),
(143, 'Inas, Charles  Sanaye ', 2, 'Applied', 'Empowerment Technologies', 95, 96, 95.5, '1st', 'M', 'Responsibility'),
(144, 'Inas, Charles  Sanaye ', 2, 'Applied', 'English for Academic and Special Purposes', 98, 97, 97.5, '1st', 'M', 'Responsibility'),
(145, 'Inas, Charles  Sanaye ', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(146, 'Inas, Charles  Sanaye ', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(147, 'Inas, Charles  Sanaye ', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(148, 'Inas, Charles  Sanaye ', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(149, 'Inas, Charles  Sanaye ', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(150, 'Inas, Charles  Sanaye ', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(151, 'Inas, Charles  Sanaye ', 2, 'Core', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 96, 95, 95.5, '2nd', 'M', 'Responsibility'),
(152, 'Inas, Charles  Sanaye ', 2, 'Core', 'Understanding Culture, Society, and Politics', 96, 95, 95.5, '2nd', 'M', 'Responsibility'),
(153, 'Inas, Charles  Sanaye ', 2, 'Applied', 'Practical Research 1', 98, 96, 97, '2nd', 'M', 'Responsibility'),
(154, 'Inas, Charles  Sanaye ', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(155, 'Inas, Charles  Sanaye ', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(156, 'Inas, Charles  Sanaye ', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(157, 'Inas, Charles  Sanaye ', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(158, 'Inas, Charles  Sanaye ', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(159, 'Inas, Charles  Sanaye ', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(160, 'Inas, Charles  Sanaye ', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(161, 'Inigaw, Charmaine  Humaya', 2, 'Core', 'Oral Communication in Context', 97, 95, 96, '1st', 'F', 'Responsibility'),
(162, 'Inigaw, Charmaine  Humaya', 2, 'Core', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 96, 97, 96.5, '1st', 'F', 'Responsibility'),
(163, 'Inigaw, Charmaine  Humaya', 2, 'Applied', 'English for Academic and Special Purposes', 97, 96, 96.5, '1st', 'F', 'Responsibility'),
(164, 'Inigaw, Charmaine  Humaya', 2, 'Applied', 'Empowerment Technologies', 96, 95, 95.5, '1st', 'F', 'Responsibility'),
(165, 'Inigaw, Charmaine  Humaya', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(166, 'Inigaw, Charmaine  Humaya', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(167, 'Inigaw, Charmaine  Humaya', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(168, 'Inigaw, Charmaine  Humaya', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(169, 'Inigaw, Charmaine  Humaya', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(170, 'Inigaw, Charmaine  Humaya', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(171, 'Inigaw, Charmaine  Humaya', 2, 'Core', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 97, 96, 96.5, '2nd', 'F', 'Responsibility'),
(172, 'Inigaw, Charmaine  Humaya', 2, 'Core', 'Understanding Culture, Society, and Politics', 98, 96, 97, '2nd', 'F', 'Responsibility'),
(173, 'Inigaw, Charmaine  Humaya', 2, 'Applied', 'Practical Research 1', 95, 94, 94.5, '2nd', 'F', 'Responsibility'),
(174, 'Inigaw, Charmaine  Humaya', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(175, 'Inigaw, Charmaine  Humaya', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(176, 'Inigaw, Charmaine  Humaya', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(177, 'Inigaw, Charmaine  Humaya', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(178, 'Inigaw, Charmaine  Humaya', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(179, 'Inigaw, Charmaine  Humaya', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(180, 'Inigaw, Charmaine  Humaya', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(181, 'Meyara, Daryl  Forson', 2, 'Core', 'Oral Communication in Context', 97, 85, 91, '1st', 'M', 'Responsibility'),
(182, 'Meyara, Daryl  Forson', 2, 'Core', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 97, 96, 96.5, '1st', 'M', 'Responsibility'),
(183, 'Meyara, Daryl  Forson', 2, 'Applied', 'Empowerment Technologies', 97, 95, 96, '1st', 'M', 'Responsibility'),
(184, 'Meyara, Daryl  Forson', 2, 'Applied', 'English for Academic and Special Purposes', 97, 87, 92, '1st', 'M', 'Responsibility'),
(185, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(186, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(187, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(188, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(189, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(190, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(191, 'Meyara, Daryl  Forson', 2, 'Core', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 97, 96, 96.5, '2nd', 'M', 'Responsibility'),
(192, 'Meyara, Daryl  Forson', 2, 'Core', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 95, 94, 94.5, '2nd', 'M', 'Responsibility'),
(193, 'Meyara, Daryl  Forson', 2, 'Applied', 'Practical Research 1', 98, 97, 97.5, '2nd', 'M', 'Responsibility'),
(194, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(195, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(196, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(197, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(198, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(199, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(200, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(201, 'Mirinda, David  Wentino', 2, 'Core', 'Oral Communication in Context', 97, 95, 96, '1st', 'M', 'Responsibility'),
(202, 'Mirinda, David  Wentino', 2, 'Core', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 97, 95, 96, '1st', 'M', 'Responsibility'),
(203, 'Mirinda, David  Wentino', 2, 'Applied', 'Empowerment Technologies', 98, 97, 97.5, '1st', 'M', 'Responsibility'),
(204, 'Mirinda, David  Wentino', 2, 'Applied', 'English for Academic and Special Purposes', 98, 96, 97, '1st', 'M', 'Responsibility'),
(205, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(206, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(207, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(208, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(209, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(210, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(211, 'Mirinda, David  Wentino', 2, 'Core', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 98, 97, 97.5, '2nd', 'M', 'Responsibility'),
(212, 'Mirinda, David  Wentino', 2, 'Core', 'Understanding Culture, Society, and Politics', 97, 96, 96.5, '2nd', 'M', 'Responsibility'),
(213, 'Mirinda, David  Wentino', 2, 'Applied', 'Practical Research 1', 96, 95, 95.5, '2nd', 'M', 'Responsibility'),
(214, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(215, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(216, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(217, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(218, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(219, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(220, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(221, 'Tamayo, Janel  Ruby', 2, 'Core', 'Oral Communication in Context', 97, 96, 96.5, '1st', 'F', 'Responsibility'),
(222, 'Tamayo, Janel  Ruby', 2, 'Core', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 97, 96, 96.5, '1st', 'F', 'Responsibility'),
(223, 'Tamayo, Janel  Ruby', 2, 'Applied', 'Empowerment Technologies', 98, 97, 97.5, '1st', 'F', 'Responsibility'),
(224, 'Tamayo, Janel  Ruby', 2, 'Applied', 'English for Academic and Special Purposes', 97, 98, 97.5, '1st', 'F', 'Responsibility'),
(225, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(226, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(227, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(228, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(229, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(230, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(231, 'Tamayo, Janel  Ruby', 2, 'Core', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 97, 95, 96, '2nd', 'F', 'Responsibility'),
(232, 'Tamayo, Janel  Ruby', 2, 'Core', 'Understanding Culture, Society, and Politics', 98, 97, 97.5, '2nd', 'F', 'Responsibility'),
(233, 'Tamayo, Janel  Ruby', 2, 'Applied', 'Practical Research 1', 73, 72, 72.5, '2nd', 'F', 'Responsibility'),
(234, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(235, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(236, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(237, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(238, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(239, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(240, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '2nd', 'F', 'Responsibility');

-- --------------------------------------------------------

--
-- Table structure for table `sf9_modality`
--

CREATE TABLE `sf9_modality` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `blended_q1` tinyint(1) DEFAULT 0,
  `blended_q2` tinyint(1) DEFAULT 0,
  `blended_q3` tinyint(1) DEFAULT 0,
  `blended_q4` tinyint(1) DEFAULT 0,
  `mdl_q1` tinyint(1) DEFAULT 0,
  `mdl_q2` tinyint(1) DEFAULT 0,
  `mdl_q3` tinyint(1) DEFAULT 0,
  `mdl_q4` tinyint(1) DEFAULT 0,
  `ip_q1` tinyint(1) DEFAULT 0,
  `ip_q2` tinyint(1) DEFAULT 0,
  `ip_q3` tinyint(1) DEFAULT 0,
  `ip_q4` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sf9_modality`
--

INSERT INTO `sf9_modality` (`id`, `student_name`, `blended_q1`, `blended_q2`, `blended_q3`, `blended_q4`, `mdl_q1`, `mdl_q2`, `mdl_q3`, `mdl_q4`, `ip_q1`, `ip_q2`, `ip_q3`, `ip_q4`) VALUES
(1, 'Amando, Steven  Igncaio', 1, 0, 1, 1, 0, 1, 0, 1, 1, 1, 1, 0),
(2, 'Cabrera, Anne  Mayabag ', 1, 1, 0, 0, 1, 0, 1, 1, 0, 1, 0, 0),
(3, 'Cauyong, Dhayne  ', 1, 1, 1, 0, 1, 0, 1, 1, 0, 0, 0, 0),
(4, 'Forsolon, Samantha  Irege', 1, 0, 0, 1, 1, 1, 0, 1, 0, 0, 1, 0),
(5, 'Irenea, Jhanniel  Balosco', 1, 0, 0, 1, 1, 1, 1, 1, 0, 1, 0, 0),
(6, 'Jose, Jarule  Belano', 1, 0, 0, 1, 1, 1, 0, 0, 0, 1, 1, 0),
(7, 'Duen, Janella  Merodo', 1, 0, 0, 0, 1, 1, 1, 1, 0, 1, 0, 0),
(8, 'Inas, Charles  Sanaye ', 1, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0),
(9, 'Inigaw, Charmaine  Humaya', 1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1),
(10, 'Meyara, Daryl  Forson', 1, 0, 0, 0, 0, 1, 0, 1, 0, 0, 1, 0),
(11, 'Mirinda, David  Wentino', 1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 1),
(12, 'Tamayo, Janel  Ruby', 1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sf9_ov`
--

CREATE TABLE `sf9_ov` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `mdq1` varchar(255) NOT NULL,
  `mdq2` varchar(255) NOT NULL,
  `mdq3` varchar(255) NOT NULL,
  `mdq4` varchar(255) NOT NULL,
  `mdq5` varchar(255) NOT NULL,
  `mdq6` varchar(255) NOT NULL,
  `mdq7` varchar(255) NOT NULL,
  `mdq8` varchar(255) NOT NULL,
  `mkq1` varchar(255) NOT NULL,
  `mkq2` varchar(255) NOT NULL,
  `mkq3` varchar(255) NOT NULL,
  `mkq4` varchar(255) NOT NULL,
  `mkq5` varchar(255) NOT NULL,
  `mkq6` varchar(255) NOT NULL,
  `mkq7` varchar(255) NOT NULL,
  `mkq8` varchar(255) NOT NULL,
  `mkkq1` varchar(255) NOT NULL,
  `mkkq2` varchar(255) NOT NULL,
  `mkkq3` varchar(255) NOT NULL,
  `mkkq4` varchar(255) NOT NULL,
  `mbq1` varchar(255) NOT NULL,
  `mbq2` varchar(255) NOT NULL,
  `mbq3` varchar(255) NOT NULL,
  `mbq4` varchar(255) NOT NULL,
  `mbq5` varchar(255) NOT NULL,
  `mbq6` varchar(255) NOT NULL,
  `mbq7` varchar(255) NOT NULL,
  `mbq8` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sf9_ov`
--

INSERT INTO `sf9_ov` (`id`, `student_name`, `mdq1`, `mdq2`, `mdq3`, `mdq4`, `mdq5`, `mdq6`, `mdq7`, `mdq8`, `mkq1`, `mkq2`, `mkq3`, `mkq4`, `mkq5`, `mkq6`, `mkq7`, `mkq8`, `mkkq1`, `mkkq2`, `mkkq3`, `mkkq4`, `mbq1`, `mbq2`, `mbq3`, `mbq4`, `mbq5`, `mbq6`, `mbq7`, `mbq8`) VALUES
(1, 'Amando, Steven  Igncaio', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(2, 'Cabrera, Anne  Mayabag ', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(3, 'Cauyong, Dhayne  ', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(4, 'Forsolon, Samantha  Irege', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(5, 'Irenea, Jhanniel  Balosco', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(6, 'Jose, Jarule  Belano', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(7, 'Duen, Janella  Merodo', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(8, 'Inas, Charles  Sanaye ', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(9, 'Inigaw, Charmaine  Humaya', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(10, 'Meyara, Daryl  Forson', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(11, 'Mirinda, David  Wentino', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO'),
(12, 'Tamayo, Janel  Ruby', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO');

-- --------------------------------------------------------

--
-- Table structure for table `sf10remedial`
--

CREATE TABLE `sf10remedial` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `subject_type` varchar(255) NOT NULL,
  `subject_title` varchar(255) NOT NULL,
  `old_grade` int(255) NOT NULL,
  `new_grade` int(255) NOT NULL,
  `final_grade` int(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sf10remedial`
--

INSERT INTO `sf10remedial` (`id`, `student_name`, `school_year_id`, `subject_type`, `subject_title`, `old_grade`, `new_grade`, `final_grade`, `semester`, `action`, `sex`, `section`) VALUES
(1, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '', '', 'M', 'Preservance'),
(2, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '', '', 'M', 'Preservance'),
(3, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '', '', 'M', 'Preservance'),
(4, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '', '', 'M', 'Preservance'),
(5, 'Amando, Steven  Igncaio', 1, '', '', 0, 0, 0, '', '', 'M', 'Preservance'),
(6, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '', '', 'F', 'Preservance'),
(7, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '', '', 'F', 'Preservance'),
(8, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '', '', 'F', 'Preservance'),
(9, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '', '', 'F', 'Preservance'),
(10, 'Cabrera, Anne  Mayabag ', 1, '', '', 0, 0, 0, '', '', 'F', 'Preservance'),
(11, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '', '', 'M', 'Preservance'),
(12, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '', '', 'M', 'Preservance'),
(13, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '', '', 'M', 'Preservance'),
(14, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '', '', 'M', 'Preservance'),
(15, 'Cauyong, Dhayne  ', 1, '', '', 0, 0, 0, '', '', 'M', 'Preservance'),
(16, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '', '', 'F', 'Preservance'),
(17, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '', '', 'F', 'Preservance'),
(18, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '', '', 'F', 'Preservance'),
(19, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '', '', 'F', 'Preservance'),
(20, 'Forsolon, Samantha  Irege', 1, '', '', 0, 0, 0, '', '', 'F', 'Preservance'),
(21, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '', '', 'F', 'Preservance'),
(22, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '', '', 'F', 'Preservance'),
(23, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '', '', 'F', 'Preservance'),
(24, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '', '', 'F', 'Preservance'),
(25, 'Irenea, Jhanniel  Balosco', 1, '', '', 0, 0, 0, '', '', 'F', 'Preservance'),
(26, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '', '', 'M', 'Preservance'),
(27, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '', '', 'M', 'Preservance'),
(28, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '', '', 'M', 'Preservance'),
(29, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '', '', 'M', 'Preservance'),
(30, 'Jose, Jarule  Belano', 1, '', '', 0, 0, 0, '', '', 'M', 'Preservance'),
(31, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(32, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(33, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(34, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(35, 'Duen, Janella  Merodo', 2, '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(36, 'Inas, Charles  Sanaye ', 2, 'Specialized', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(37, 'Inas, Charles  Sanaye ', 2, '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(38, 'Inas, Charles  Sanaye ', 2, '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(39, 'Inas, Charles  Sanaye ', 2, '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(40, 'Inas, Charles  Sanaye ', 2, '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(41, 'Inigaw, Charmaine  Humaya', 2, 'Specialized', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(42, 'Inigaw, Charmaine  Humaya', 2, '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(43, 'Inigaw, Charmaine  Humaya', 2, '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(44, 'Inigaw, Charmaine  Humaya', 2, '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(45, 'Inigaw, Charmaine  Humaya', 2, '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(46, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(47, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(48, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(49, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(50, 'Meyara, Daryl  Forson', 2, '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(51, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(52, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(53, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(54, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(55, 'Mirinda, David  Wentino', 2, '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(56, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(57, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(58, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(59, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(60, 'Tamayo, Janel  Ruby', 2, '', '', 0, 0, 0, '', '', 'F', 'Responsibility');

-- --------------------------------------------------------

--
-- Table structure for table `sf10remedialdate`
--

CREATE TABLE `sf10remedialdate` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `start_date1` date NOT NULL,
  `end_date1` date NOT NULL,
  `start_date2` date NOT NULL,
  `end_date2` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sf10remedialdate`
--

INSERT INTO `sf10remedialdate` (`id`, `student_name`, `start_date1`, `end_date1`, `start_date2`, `end_date2`) VALUES
(1, 'Amando, Steven  Igncaio', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(2, 'Cabrera, Anne  Mayabag ', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(3, 'Cauyong, Dhayne  ', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(4, 'Forsolon, Samantha  Irege', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(5, 'Irenea, Jhanniel  Balosco', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(6, 'Jose, Jarule  Belano', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(7, 'Duen, Janella  Merodo', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(8, 'Inas, Charles  Sanaye ', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(9, 'Inigaw, Charmaine  Humaya', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(10, 'Meyara, Daryl  Forson', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(11, 'Mirinda, David  Wentino', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(12, 'Tamayo, Janel  Ruby', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `strand`
--

CREATE TABLE `strand` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `track` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `strand`
--

INSERT INTO `strand` (`id`, `name`, `track`) VALUES
(1, 'Accountancy, Business and Management', 'Academic'),
(2, 'Science, Technology, Engineering and Mathematics', 'Academic'),
(3, 'Humanities and Social Science', 'Academic'),
(5, 'Home Economics', 'Technical-Vocational-Livelihood'),
(6, 'All', 'All'),
(7, 'General Academic Strand', 'Academic'),
(8, 'Information and Communications Technology', 'Technical-Vocational-Livelihood');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `lrn` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `mname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `suffix` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `birth_date` varchar(255) NOT NULL,
  `birth_date2` date NOT NULL,
  `age` int(255) NOT NULL,
  `ra` varchar(255) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL,
  `municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `father` varchar(255) NOT NULL,
  `mother` varchar(255) NOT NULL,
  `guardian` varchar(255) NOT NULL,
  `relationship` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `school_year` varchar(255) NOT NULL,
  `track` varchar(255) NOT NULL,
  `strand` varchar(255) NOT NULL,
  `grade` int(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'complete',
  `lm` varchar(255) NOT NULL,
  `indicator` varchar(255) NOT NULL,
  `ri` varchar(255) NOT NULL,
  `rid` varchar(255) NOT NULL,
  `weight` float NOT NULL,
  `height` float NOT NULL,
  `height2` float NOT NULL,
  `bmi` float NOT NULL,
  `bmi_category` varchar(255) NOT NULL,
  `hfa_category` varchar(255) NOT NULL,
  `sf8_remarks` varchar(255) NOT NULL,
  `is_archived` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `lrn`, `name`, `fname`, `mname`, `lname`, `suffix`, `sex`, `birth_date`, `birth_date2`, `age`, `ra`, `house_no`, `barangay`, `municipality`, `province`, `father`, `mother`, `guardian`, `relationship`, `contact`, `section`, `school_year_id`, `school_year`, `track`, `strand`, `grade`, `status`, `lm`, `indicator`, `ri`, `rid`, `weight`, `height`, `height2`, `bmi`, `bmi_category`, `hfa_category`, `sf8_remarks`, `is_archived`) VALUES
(1, 20010401, 'Cauyong, Dhayne  ', 'Dhayne', '', 'Cauyong', '', 'M', '03-23-2002', '2002-03-23', 20, 'Catholic', 'Blk 26 Lot 12', 'Tartaria', 'Silang', 'Cavite', 'Alex Cauyong', 'Irene Mulibag', 'Alex Cauyong', 'Parent', '09773362626', 'Preservance', 1, '2023 - 2024', 'Academic', 'Science, Technology, Engineering and Mathematics', 12, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', '', '', 1),
(2, 20010402, 'Irenea, Jhanniel  Balosco', 'Jhanniel', 'Balosco', 'Irenea', '', 'F', '04-29-2000', '2000-04-29', 22, 'Catholic', 'Blk 13 Lot 08', 'Tartaria', 'Silang', 'Cavite', 'Juno Irenea', 'Ester Balosco', 'Ester Balosco', 'Parent', '00997216873', 'Preservance', 1, '2023 - 2024', 'Academic', 'Science, Technology, Engineering and Mathematics', 12, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', '', '', 1),
(3, 20010403, 'Cabrera, Anne  Mayabag ', 'Anne ', 'Mayabag', 'Cabrera', '', 'F', ' 08-09-2001', '2001-08-09', 21, 'Catholic', 'Blk 15 Lot 08', 'Tartaria', 'Silang', 'Cavite', 'Armmando Cabrera', 'Quesa Mayabag', 'Armmando Cabrera', 'Parent', '09972384728', 'Preservance', 1, '2023 - 2024', 'Academic', 'Science, Technology, Engineering and Mathematics', 12, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', '', '', 1),
(4, 20010404, 'Jose, Jarule  Belano', 'Jarule', 'Belano', 'Jose', '', 'M', '02-08-2001', '2001-02-08', 21, 'Catholic', 'Blk 26 Lot 15', 'Puting Kahoy', 'Sta. Rosa', 'Laguna', 'Mayordo Jose', 'Seyna Belano', 'Seyna Belano', 'Parent', '09971523815', 'Preservance', 1, '2023 - 2024', 'Academic', 'Science, Technology, Engineering and Mathematics', 12, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', '', '', 1),
(5, 20010405, 'Amando, Steven  Igncaio', 'Steven', 'Igncaio', 'Amando', '', 'M', '12-07-2002', '2002-12-07', 21, 'Catholic', 'Blk 26 Lot 12 Buklod Bahayan', 'Tartaria', 'Silang', 'Cavite', 'Lazaro Amando', 'Arlene Ignacio', 'Arlene Ignacio', 'Parent', '09126386123', 'Preservance', 1, '2023 - 2024', 'Academic', 'Science, Technology, Engineering and Mathematics', 12, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', '', '', 1),
(6, 20010406, 'Forsolon, Samantha  Irege', 'Samantha', 'Irege', 'Forsolon', '', 'F', '08-27-2002', '2002-08-27', 20, 'Catholic', 'Blk 13 Lot 12', 'Tartaria', 'Silang', 'Cavite', 'Ernesto Forsolon', 'Miya Irege', 'Ernesto Forsolon', 'Parent', '09971583271', 'Preservance', 1, '2023 - 2024', 'Academic', 'Science, Technology, Engineering and Mathematics', 12, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', '', '', 1),
(7, 20010421, 'Duen, Janella  Merodo', 'Janella', 'Merodo', 'Duen', '', 'F', '07-08-2003', '2003-07-08', 19, 'Catholic', 'Blk 15 Lot 08', 'Lumil', 'Silang', 'Cavite', 'Jerome Duen', 'Nermy Merodo', 'Nermy Merodo', 'Parent', '09916278361', 'Responsibility', 2, '2024 - 2025', 'Academic', 'Humanities and Social Science', 11, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', '', '', 0),
(8, 20010422, 'Mirinda, David  Wentino', 'David', 'Wentino', 'Mirinda', '', 'M', '02-08-2003', '2003-02-08', 19, 'Catholic', 'Blk 24 Lot 12 ', 'Tartaria', 'Silang', 'Cavite', 'Kok Mirinda', 'Maria Wentino', 'Kok Mirinda', 'Parent', '09961278387', 'Responsibility', 2, '2024 - 2025', 'Academic', 'Humanities and Social Science', 11, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', '', '', 0),
(9, 20010423, 'Inas, Charles  Sanaye ', 'Charles', 'Sanaye ', 'Inas', '', 'M', '02-09-2003', '2003-02-09', 19, 'Catholic', 'Blk 39 Lot 10', 'Lumil', 'Silang', 'Cavite', 'Eduardo Inas', 'Chapelin Sanaye', 'Chapelin Sanaye', 'Parent', '09961283532', 'Responsibility', 2, '2024 - 2025', 'Academic', 'Humanities and Social Science', 11, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', '', '', 0),
(10, 20010424, 'Meyara, Daryl  Forson', 'Daryl', 'Forson', 'Meyara', '', 'M', '09-29-2003', '2003-09-29', 19, 'Catholic', 'Blk 22 Lot 12', 'Tartaria', 'Silang', 'Cavite', 'Amanuel Meyara', 'Abigail Forson', 'Abigail Forson', 'Parent', '09971825361', 'Responsibility', 2, '2024 - 2025', 'Academic', 'Humanities and Social Science', 11, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', '', '', 0),
(11, 20010425, 'Inigaw, Charmaine  Humaya', 'Charmaine', 'Humaya', 'Inigaw', '', 'F', '12-09-2003', '2003-12-09', 20, 'Catholic', 'Blk 34 Lot 16', 'Lumil', 'Sta. Rosa', 'Laguna', 'Edi Inigaw', 'Maya Humaya', 'Edi Inigaw', 'Parent', '09917253851', 'Responsibility', 2, '2024 - 2025', 'Academic', 'Humanities and Social Science', 11, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', '', '', 0),
(12, 20010426, 'Tamayo, Janel  Ruby', 'Janel', 'Ruby', 'Tamayo', '', 'F', '08-07-2002', '2002-08-07', 20, 'Catholic', 'Blk 36 Lot 15', 'Tartaria', 'Silang', 'Cavite', 'Ketsup Tamayo', 'Emer Ruby', 'Ketsup Tamayo', 'Parent', '09189217938', 'Responsibility', 2, '2024 - 2025', 'Academic', 'Humanities and Social Science', 11, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `subject_type` varchar(255) NOT NULL,
  `track` varchar(255) NOT NULL,
  `strand` varchar(255) NOT NULL,
  `grade` int(255) NOT NULL,
  `semester` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `subject_type`, `track`, `strand`, `grade`, `semester`) VALUES
(11, 'Oral Communication in Context', 'Core', 'All', 'All', 11, '1st'),
(12, 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 'Core', 'All', 'All', 11, '1st'),
(13, '21st Century from the Philippines and the World', 'Core', 'All', 'All', 11, '1st'),
(14, 'General Mathematics', 'Core', 'All', 'All', 11, '1st'),
(15, 'Empowerment Technologies', 'Applied', 'All', 'All', 11, '1st'),
(16, 'Practical Research 1', 'Applied', 'All', 'All', 11, '2nd'),
(17, 'Practical Research 2', 'Applied', 'All', 'All', 12, '1st'),
(18, 'Philippine Politics and Governance', 'Specialized', 'Academic', 'Accountancy, Business and Management', 11, '1st'),
(19, 'Discipline and Ideas in the Social Sciences', 'Specialized', 'Academic', 'Humanities and Social Science', 12, '1st'),
(24, 'Earth And Life Science ', 'Core', 'All', 'All', 11, '1st'),
(25, 'Physical Education and Health', 'Core', 'All', 'All', 12, '1st'),
(26, 'Reading and Writing Skills', 'Core', 'All', 'All', 11, '1st'),
(27, 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 'Core', 'All', 'All', 11, '2nd'),
(28, 'Understanding Culture, Society, and Politics', 'Core', 'All', 'All', 11, '2nd'),
(29, 'Statistics and Probability', 'Core', 'All', 'All', 11, '2nd'),
(30, 'Physical Science', 'Core', 'All', 'All', 11, '2nd'),
(32, 'Introduction to the Philosophy of the Human Person/Pambungad sa Pilosopiya ng Tao', 'Core', 'All', 'All', 12, '1st'),
(33, 'Personality Development', 'Core', 'All', 'All', 12, '1st'),
(35, 'Media and Information Technology', 'Core', 'All', 'All', 12, '2nd'),
(36, 'Contemporary Philippine Arts from the Regions', 'Core', 'All', 'All', 12, '2nd'),
(37, 'Filipino sa Piling Larang', 'Applied', 'All', 'All', 11, '2nd'),
(38, 'English for Academic and Special Purposes', 'Applied', 'All', 'All', 11, '1st'),
(39, 'Entrepreneurship', 'Applied', 'All', 'All', 12, '2nd'),
(40, 'Inquiries, Investigation, and Immersion', 'Applied', 'All', 'All', 12, '1st'),
(42, 'Culminating Activity or Work Immersion ', 'Specialized', 'Academic', 'Humanities and Social Science', 12, '2nd'),
(43, 'Trends, Networks and Critical Thinking in the 21st Century Culture ', 'Specialized', 'Academic', 'Humanities and Social Science', 12, '2nd'),
(44, 'Creative Non-fiction: The Literary Essay', 'Specialized', 'Academic', 'Humanities and Social Science', 12, '2nd'),
(45, 'Community Engagement, Solidarity and Citizenship', 'Specialized', 'Academic', 'Humanities and Social Science', 12, '1st'),
(46, 'Creative Writing/ Malikhaing Pagsulat ', 'Specialized', 'Academic', 'Humanities and Social Science', 12, '1st'),
(47, 'Discipline and Ideas in the Applied Social Sciences', 'Specialized', 'Academic', 'Humanities and Social Science', 12, '1st'),
(48, 'Introduction to World Religions and Belief System', 'Specialized', 'Academic', 'Humanities and Social Science', 12, '1st');

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE `track` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`id`, `name`) VALUES
(1, 'Technical-Vocational-Livelihood'),
(2, 'Academic'),
(3, 'All');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `password2` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `password2`, `name`, `user_type`, `section`, `status`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', '123', 'system admin', 'system admin', '', 'Active'),
(27, 'david', '73b5498b79df94cf62d5c280874896cb', 'centeno', 'David Centeno', 'Registrar', '', 'Active'),
(28, 'arcie', 'a126780c3a673de4fbc14896a79b0e66', 'natuel', 'Arcie Natuel', 'Adviser', '', 'Active'),
(29, 'jerome', '662eaa47199461d01a623884080934ab', 'jose', 'Jerome Jose', 'Clinic teacher', '', 'Active'),
(30, 'daryl', 'f39e6f5e6a5a38472e0a1558a285f1d1', 'balbastro', 'Daryl Balbastro', 'Adviser', 'Responsibility', 'Active'),
(31, 'ahl', '96c4cbfbd9b13425d1d7154e4276484e', 'rosales', 'Ahl Rosales', 'Adviser', '', 'Active'),
(38, 'samuel', '79ab945544e5bc017a2317b6146ed3aa', 'johnson', 'Samuel Johnson', 'Adviser', '', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schoolstart`
--
ALTER TABLE `schoolstart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sf2`
--
ALTER TABLE `sf2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sf2remarks`
--
ALTER TABLE `sf2remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sf5b`
--
ALTER TABLE `sf5b`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sf9`
--
ALTER TABLE `sf9`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sf9_modality`
--
ALTER TABLE `sf9_modality`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sf9_ov`
--
ALTER TABLE `sf9_ov`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sf10remedial`
--
ALTER TABLE `sf10remedial`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sf10remedialdate`
--
ALTER TABLE `sf10remedialdate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `strand`
--
ALTER TABLE `strand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lrn` (`lrn`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `schoolstart`
--
ALTER TABLE `schoolstart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sf2`
--
ALTER TABLE `sf2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `sf2remarks`
--
ALTER TABLE `sf2remarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sf5b`
--
ALTER TABLE `sf5b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sf9`
--
ALTER TABLE `sf9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=241;

--
-- AUTO_INCREMENT for table `sf9_modality`
--
ALTER TABLE `sf9_modality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sf9_ov`
--
ALTER TABLE `sf9_ov`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sf10remedial`
--
ALTER TABLE `sf10remedial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `sf10remedialdate`
--
ALTER TABLE `sf10remedialdate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `strand`
--
ALTER TABLE `strand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `track`
--
ALTER TABLE `track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"capstone_db\",\"table\":\"user\"},{\"db\":\"capstone_db\",\"table\":\"sf10remedial\"},{\"db\":\"capstone_db\",\"table\":\"sf2\"},{\"db\":\"capstone_db\",\"table\":\"section\"},{\"db\":\"capstone_db\",\"table\":\"school_year\"},{\"db\":\"capstone_db\",\"table\":\"semester\"},{\"db\":\"capstone_db\",\"table\":\"schoolstart\"},{\"db\":\"capstone_db\",\"table\":\"student\"},{\"db\":\"capstone_db\",\"table\":\"sf9\"},{\"db\":\"capstone_db\",\"table\":\"sf5b\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2024-01-22 09:30:20', '{\"Console\\/Mode\":\"collapse\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
--
-- Database: `user_db`
--
CREATE DATABASE IF NOT EXISTS `user_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `user_db`;

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(NULL, 'david', 'david@gmail.com', '87da0f6e043bdecbfd3139cc9e07334e', 'admin'),
(NULL, 'jerome', 'jerome@gmail.com', '202cb962ac59075b964b07152d234b70', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
