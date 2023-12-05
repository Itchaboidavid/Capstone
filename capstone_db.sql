-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 04, 2023 at 02:27 PM
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
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `track` varchar(255) NOT NULL,
  `strand` varchar(255) NOT NULL,
  `grade` int(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `semester_name` varchar(255) NOT NULL,
  `start_year` varchar(255) NOT NULL,
  `end_year` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`id`, `name`, `track`, `strand`, `grade`, `semester`, `semester_name`, `start_year`, `end_year`, `start_date`, `end_date`) VALUES
(29, 'Responsibility', 'Academic', 'Accountancy, Business and Management', 11, '2nd (2020 - 2021)', '2nd', '2020', '2021', '', ''),
(30, 'Generosity', 'Academic', 'Humanities and Social Science', 12, '1st (2020 - 2021)', '1st', '2020', '2021', '', ''),
(31, 'Hardwork', 'Technical-Vocational-Livelihood', 'Home Economics', 11, '1st (2020 - 2021)', '1st', '2020', '2021', '', ''),
(32, 'Creativity', 'Technical-Vocational-Livelihood', 'Information and Communications Technology', 11, '1st (2020 - 2021)', '1st', '2020', '2021', '', ''),
(35, 'Perseverance', 'Academic', 'Accountancy, Business and Management', 12, '3rd (2000 - 2001)', '3rd', '2000', '2001', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `start_year` varchar(255) NOT NULL,
  `end_year` varchar(255) NOT NULL,
  `output` varchar(255) NOT NULL,
  `start_date` varchar(255) NOT NULL,
  `end_date` varchar(255) NOT NULL,
  `default_start` date NOT NULL,
  `default_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `name`, `start_year`, `end_year`, `output`, `start_date`, `end_date`, `default_start`, `default_end`) VALUES
(13, '1st', '2020', '2021', '1st (2020 - 2021)', '', '', '0000-00-00', '0000-00-00'),
(14, '2nd', '2020', '2021', '2nd (2020 - 2021)', '', '', '0000-00-00', '0000-00-00'),
(15, '1st', '2021', '2022', '1st (2021 - 2022)', '', '', '0000-00-00', '0000-00-00'),
(16, '2nd', '2021', '2022', '2nd (2021 - 2022)', '', '', '0000-00-00', '0000-00-00'),
(20, '3rd', '2000', '2001', '3rd (2000 - 2001)', '05/05/00', '06/06/01', '2000-05-05', '2001-06-06');

-- --------------------------------------------------------

--
-- Table structure for table `sf2`
--

CREATE TABLE `sf2` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `student_section` varchar(255) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `attendance_status` varchar(11) DEFAULT NULL,
  `attendance_month` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sf2`
--

INSERT INTO `sf2` (`id`, `student_id`, `student_name`, `student_section`, `sex`, `day`, `attendance_status`, `attendance_month`) VALUES
(436, 44, 'Centeno, David N. ', 'Responsibility', 'M', '4', 'on', 12),
(437, 44, 'Centeno, David N. ', 'Responsibility', 'M', '5', 'on', 12),
(438, 44, 'Centeno, David N. ', 'Responsibility', 'M', '6', 'on', 12),
(439, 44, 'Centeno, David N. ', 'Responsibility', 'M', '7', 'on', 12),
(440, 44, 'Centeno, David N. ', 'Responsibility', 'M', '8', 'on', 12),
(441, 44, 'Centeno, David N. ', 'Responsibility', 'M', '11', 'on', 12),
(442, 44, 'Centeno, David N. ', 'Responsibility', 'M', '12', 'on', 12),
(443, 44, 'Centeno, David N. ', 'Responsibility', 'M', '13', 'on', 12),
(444, 44, 'Centeno, David N. ', 'Responsibility', 'M', '14', 'on', 12),
(446, 44, 'Centeno, David N. ', 'Responsibility', 'M', '20', 'on', 12),
(447, 44, 'Centeno, David N. ', 'Responsibility', 'M', '21', 'on', 12),
(448, 44, 'Centeno, David N. ', 'Responsibility', 'M', '22', 'on', 12),
(449, 44, 'Centeno, David N. ', 'Responsibility', 'M', '27', 'on', 12),
(450, 44, 'Centeno, David N. ', 'Responsibility', 'M', '28', 'on', 12),
(451, 44, 'Centeno, David N. ', 'Responsibility', 'M', '29', 'on', 12),
(452, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '1', 'on', 12),
(453, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '4', 'on', 12),
(454, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '5', 'on', 12),
(455, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '6', 'on', 12),
(456, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '7', 'on', 12),
(457, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '8', 'on', 12),
(458, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '11', 'on', 12),
(459, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '12', 'on', 12),
(460, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '13', 'on', 12),
(461, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '14', 'on', 12),
(462, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '15', 'on', 12),
(463, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '18', 'on', 12),
(464, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '19', 'on', 12),
(465, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '20', 'on', 12),
(466, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '21', 'on', 12),
(467, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '22', 'on', 12),
(468, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '25', 'on', 12),
(469, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '26', 'on', 12),
(470, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '27', 'on', 12),
(471, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '28', 'on', 12),
(472, 46, 'Jose, Jerome  J.', 'Responsibility', 'M', '29', 'on', 12),
(473, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '1', 'on', 12),
(474, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '4', 'on', 12),
(475, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '5', 'on', 12),
(476, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '6', 'on', 12),
(477, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '7', 'on', 12),
(478, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '8', 'on', 12),
(479, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '11', 'on', 12),
(480, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '12', 'on', 12),
(481, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '13', 'on', 12),
(482, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '14', 'on', 12),
(483, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '15', 'on', 12),
(484, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '18', 'on', 12),
(485, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '19', 'on', 12),
(486, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '20', 'on', 12),
(487, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '21', 'on', 12),
(488, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '22', 'on', 12),
(489, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '25', 'on', 12),
(490, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '26', 'on', 12),
(491, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', 'M', '27', 'on', 12),
(492, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '1', 'on', 12),
(493, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '4', 'on', 12),
(494, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '5', 'on', 12),
(495, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '6', 'on', 12),
(496, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '7', 'on', 12),
(497, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '8', 'on', 12),
(498, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '11', 'on', 12),
(499, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '12', 'on', 12),
(500, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '13', 'on', 12),
(501, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '14', 'on', 12),
(502, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '15', 'on', 12),
(503, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '18', 'on', 12),
(504, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '19', 'on', 12),
(505, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '20', 'on', 12),
(506, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '21', 'on', 12),
(507, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '22', 'on', 12),
(508, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '25', 'on', 12),
(509, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '26', 'on', 12),
(510, 48, 'Cabrera, Yasy  M.', 'Responsibility', 'F', '27', 'on', 12),
(511, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '1', 'on', 12),
(512, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '4', 'on', 12),
(513, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '5', 'on', 12),
(514, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '6', 'on', 12),
(515, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '7', 'on', 12),
(516, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '8', 'on', 12),
(517, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '11', 'on', 12),
(518, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '12', 'on', 12),
(519, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '13', 'on', 12),
(520, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '14', 'on', 12),
(521, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '15', 'on', 12),
(522, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '18', 'on', 12),
(523, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '19', 'on', 12),
(524, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '20', 'on', 12),
(525, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '21', 'on', 12),
(526, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '22', 'on', 12),
(527, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '25', 'on', 12),
(528, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '26', 'on', 12),
(529, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '27', 'on', 12),
(530, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '28', 'on', 12),
(531, 49, 'Rivera, Juliane  S.', 'Responsibility', 'F', '29', 'on', 12),
(532, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '1', 'on', 12),
(533, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '4', 'on', 12),
(534, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '5', 'on', 12),
(535, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '6', 'on', 12),
(536, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '7', 'on', 12),
(537, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '8', 'on', 12),
(538, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '11', 'on', 12),
(539, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '12', 'on', 12),
(540, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '13', 'on', 12),
(541, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '14', 'on', 12),
(542, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '15', 'on', 12),
(543, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '18', 'on', 12),
(544, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '19', 'on', 12),
(545, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '20', 'on', 12),
(546, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '21', 'on', 12),
(547, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '22', 'on', 12),
(548, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '25', 'on', 12),
(549, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '26', 'on', 12),
(550, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '27', 'on', 12),
(551, 50, 'Aquino, Angela Jr. K.', 'Responsibility', 'F', '28', 'on', 12),
(552, 44, 'Centeno, David N. ', 'Responsibility', 'M', '1', 'on', 12);

-- --------------------------------------------------------

--
-- Table structure for table `sf2remarks`
--

CREATE TABLE `sf2remarks` (
  `id` int(11) NOT NULL,
  `student_id` int(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sf2remarks`
--

INSERT INTO `sf2remarks` (`id`, `student_id`, `student_name`, `section`, `remarks`) VALUES
(2, 44, 'Centeno, David N. ', 'Responsibility', 'a.1 Had to take care of siblings'),
(3, 46, 'Jose, Jerome  J.', 'Responsibility', ''),
(4, 47, 'Mojica, Ancis Josh  N.', 'Responsibility', '');

-- --------------------------------------------------------

--
-- Table structure for table `sf5b`
--

CREATE TABLE `sf5b` (
  `id` int(11) NOT NULL,
  `lrn` int(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `completed` varchar(255) NOT NULL,
  `nc` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sf5b`
--

INSERT INTO `sf5b` (`id`, `lrn`, `student_name`, `completed`, `nc`, `section`, `sex`) VALUES
(2, 20010116, 'Centeno, David N. ', 'Yes', 'NC II', 'Responsibility', 'M'),
(3, 20010223, 'Jose, Jerome  J.', 'Yes', '', 'Responsibility', 'M'),
(5, 20010919, 'Aquino, Angela Jr. K.', 'Yes', '', 'Responsibility', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `sf8`
--

CREATE TABLE `sf8` (
  `id` int(11) NOT NULL,
  `lrn` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birth_date` varchar(255) NOT NULL,
  `age` int(255) NOT NULL,
  `weight` int(255) NOT NULL,
  `height` int(255) NOT NULL,
  `height2` int(255) NOT NULL,
  `bmi` int(255) NOT NULL,
  `bmi_category` varchar(255) NOT NULL,
  `hfa` int(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sf8`
--

INSERT INTO `sf8` (`id`, `lrn`, `name`, `birth_date`, `age`, `weight`, `height`, `height2`, `bmi`, `bmi_category`, `hfa`, `section`, `sex`) VALUES
(7, 20010116, 'Centeno, David N. ', ' 10-17-2000', 22, 53, 2, 3, 21, 'Normal', 0, 'Responsibility', 'M');

-- --------------------------------------------------------

--
-- Table structure for table `sf9`
--

CREATE TABLE `sf9` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `subject_type` varchar(255) NOT NULL,
  `subject_title` varchar(255) NOT NULL,
  `sem_grade1` int(255) NOT NULL,
  `sem_grade2` int(255) NOT NULL,
  `final_grade` int(255) NOT NULL,
  `semester` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sf9`
--

INSERT INTO `sf9` (`id`, `student_name`, `subject_type`, `subject_title`, `sem_grade1`, `sem_grade2`, `final_grade`, `semester`, `sex`, `section`) VALUES
(364, 'Centeno, David N. ', 'Core', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 88, 99, 94, '1st', 'M', 'Responsibility'),
(365, 'Centeno, David N. ', 'Applied', 'Empowerment Technologies', 79, 98, 89, '1st', 'M', 'Responsibility'),
(366, 'Centeno, David N. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(367, 'Centeno, David N. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(368, 'Centeno, David N. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(369, 'Centeno, David N. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(370, 'Centeno, David N. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(371, 'Centeno, David N. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(372, 'Centeno, David N. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(373, 'Centeno, David N. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(374, 'Centeno, David N. ', 'Core', 'Oral Communication in Context', 77, 77, 77, '2nd', 'M', 'Responsibility'),
(375, 'Centeno, David N. ', 'Applied', 'dadawdawdaw', 88, 88, 88, '2nd', 'M', 'Responsibility'),
(376, 'Centeno, David N. ', 'Specialized', 'trshstrhr', 66, 66, 66, '2nd', 'M', 'Responsibility'),
(377, 'Centeno, David N. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(378, 'Centeno, David N. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(379, 'Centeno, David N. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(380, 'Centeno, David N. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(381, 'Centeno, David N. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(382, 'Centeno, David N. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(383, 'Centeno, David N. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(404, 'Jose, Jerome  J.', 'Core', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 88, 88, 88, '1st', 'M', 'Responsibility'),
(405, 'Jose, Jerome  J.', 'Applied', 'Empowerment Technologies', 99, 99, 99, '1st', 'M', 'Responsibility'),
(406, 'Jose, Jerome  J.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(407, 'Jose, Jerome  J.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(408, 'Jose, Jerome  J.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(409, 'Jose, Jerome  J.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(410, 'Jose, Jerome  J.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(411, 'Jose, Jerome  J.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(412, 'Jose, Jerome  J.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(413, 'Jose, Jerome  J.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(414, 'Jose, Jerome  J.', 'Core', 'Oral Communication in Context', 67, 88, 78, '2nd', 'M', 'Responsibility'),
(415, 'Jose, Jerome  J.', 'Applied', 'dadawdawdaw', 99, 78, 89, '2nd', 'M', 'Responsibility'),
(416, 'Jose, Jerome  J.', 'Specialized', 'trshstrhr', 99, 67, 83, '2nd', 'M', 'Responsibility'),
(417, 'Jose, Jerome  J.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(418, 'Jose, Jerome  J.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(419, 'Jose, Jerome  J.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(420, 'Jose, Jerome  J.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(421, 'Jose, Jerome  J.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(422, 'Jose, Jerome  J.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(423, 'Jose, Jerome  J.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(424, 'Aquino, Angela Jr. K.', 'Core', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 88, 99, 94, '1st', 'F', 'Responsibility'),
(425, 'Aquino, Angela Jr. K.', 'Applied', 'Empowerment Technologies', 98, 99, 99, '1st', 'F', 'Responsibility'),
(426, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(427, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(428, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(429, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(430, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(431, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(432, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(433, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(434, 'Aquino, Angela Jr. K.', 'Core', 'Oral Communication in Context', 99, 99, 99, '2nd', 'F', 'Responsibility'),
(435, 'Aquino, Angela Jr. K.', 'Applied', 'dadawdawdaw', 99, 99, 99, '2nd', 'F', 'Responsibility'),
(436, 'Aquino, Angela Jr. K.', 'Specialized', 'trshstrhr', 99, 99, 99, '2nd', 'F', 'Responsibility'),
(437, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(438, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(439, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(440, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(441, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(442, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(443, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility');

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
(25, 'Centeno, David N. ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1),
(27, 'Jose, Jerome  J.', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1),
(28, 'Aquino, Angela Jr. K.', 1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 1, 1);

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
(22, 'Centeno, David N. ', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(24, 'Jose, Jerome  J.', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(25, 'Aquino, Angela Jr. K.', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'AO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO');

-- --------------------------------------------------------

--
-- Table structure for table `sf10remedial`
--

CREATE TABLE `sf10remedial` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
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

INSERT INTO `sf10remedial` (`id`, `student_name`, `subject_type`, `subject_title`, `old_grade`, `new_grade`, `final_grade`, `semester`, `action`, `sex`, `section`) VALUES
(58, 'Centeno, David N. ', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(59, 'Centeno, David N. ', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(60, 'Centeno, David N. ', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(61, 'Centeno, David N. ', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(62, 'Centeno, David N. ', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(68, 'Jose, Jerome  J.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(69, 'Jose, Jerome  J.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(70, 'Jose, Jerome  J.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(71, 'Jose, Jerome  J.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(72, 'Jose, Jerome  J.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(73, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(74, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(75, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(76, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(77, 'Aquino, Angela Jr. K.', '', '', 0, 0, 0, '', '', 'F', 'Responsibility');

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
(7, 'Centeno, David N. ', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(8, 'Jose, Jerome  J.', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(9, 'Aquino, Angela Jr. K.', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00');

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
  `semester` varchar(255) NOT NULL,
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
  `hfa_category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `lrn`, `name`, `fname`, `mname`, `lname`, `suffix`, `sex`, `birth_date`, `birth_date2`, `age`, `ra`, `house_no`, `barangay`, `municipality`, `province`, `father`, `mother`, `guardian`, `relationship`, `contact`, `section`, `semester`, `school_year`, `track`, `strand`, `grade`, `status`, `lm`, `indicator`, `ri`, `rid`, `weight`, `height`, `height2`, `bmi`, `bmi_category`, `hfa_category`) VALUES
(44, 20010116, 'Centeno, David N. ', 'David', 'N.', 'Centeno', '', 'M', ' 10-17-2000', '2000-10-17', 11, 'Catholic', 'Blk 26 Lot 12 Buklod Bahayan', 'Tartaria', 'Silang', 'Cavite', 'Remigio T. Centeno', 'Elene A. Nuque', 'Elene A. Nuque', 'Mother', '09218166060', 'Responsibility', '2nd', '2020 - 2021', 'Academic', 'Accountancy, Business and Management', 11, 'complete', 'Face to face', '', '', '', 44, 1.55, 2.4025, 18.31, 'Wasted', 'Normal'),
(45, 20010178, 'Mojica, Ancis  J.', 'Ancis', 'J.', 'Mojica', '', 'M', '09-22-2005', '2005-09-22', 17, 'Catholic', 'Blk 13 Lot 08', 'Tartaria', 'Silang', 'Cavite', 'Jerome Jose', 'Arcie Natuel', 'Jerome Jose', 'Father', '09239238283', 'Generosity', '1st', '2020 - 2021', 'Academic', 'Humanities and Social Science', 12, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', ''),
(46, 20010223, 'Jose, Jerome  J.', 'Jerome', 'J.', 'Jose', '', 'M', '08-02-2004', '2004-08-02', 18, 'Catholic', 'Blk 10 Lot 11', 'Ibaba', 'Ulat', 'Cavite', 'Jimuel M. Jose', 'Jannah A. Toledo', 'Jannah A. Toledo', 'Mother', '09952852893', 'Responsibility', '2nd', '2020 - 2021', 'Academic', 'Accountancy, Business and Management', 11, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', ''),
(47, 20010111, 'Mojica, Ancis Josh  N.', 'Ancis Josh', 'N.', 'Mojica', '', 'M', '08-10-2005', '2005-08-10', 17, 'Catholic', 'Zone 6 Blk 23 Lot 31', 'Puting Kahoy', 'Silang', 'Cavite', 'Andrew L. Mojica', 'Anne S. Nanaog', 'Andrew L. Mojica', 'Father', '00989284935', 'Responsibility', '2nd', '2020 - 2021', 'Academic', 'Accountancy, Business and Management', 11, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', ''),
(48, 20010839, 'Cabrera, Yasy  M.', 'Yasy', 'M.', 'Cabrera', '', 'F', '06-18-2005', '2005-06-18', 17, 'Catholic', 'Kalye dos Blk 10 Lot 17', 'Carmen', 'Silang', 'Cavite', 'Roberto Cabrera', 'Ever Manalo', 'Ever Manalo', 'Mother', '00978472846', 'Responsibility', '2nd', '2020 - 2021', 'Academic', 'Accountancy, Business and Management', 11, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', ''),
(49, 20010849, 'Rivera, Juliane  S.', 'Juliane', 'S.', 'Rivera', '', 'F', '05-05-2005', '2005-05-05', 17, 'Catholic', 'Blk 30 Lot 15', 'Imperial', 'Silang', 'Cavite', 'Roddy Rivera', 'Roxy Supremo', 'Roddy Rivera', 'Father', '00992929291', 'Responsibility', '2nd', '2020 - 2021', 'Academic', 'Accountancy, Business and Management', 11, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', ''),
(50, 20010919, 'Aquino, Angela Jr. K.', 'Angela', 'K.', 'Aquino', 'Jr.', 'F', '12-25-2005', '2005-12-25', 17, 'Iglesia ni Cristo', 'Blk 22 Lot 15', 'Tartaria', 'Silang', 'Cavite', 'Alucard Aquino', 'Benedetta Killah', 'Benedetta Killah', 'Mother', '00998296382', 'Responsibility', '2nd', '2020 - 2021', 'Academic', 'Accountancy, Business and Management', 11, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', '');

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
  `semester` varchar(255) NOT NULL,
  `semester_name` varchar(255) NOT NULL,
  `start_year` varchar(255) NOT NULL,
  `end_year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `name`, `subject_type`, `track`, `strand`, `grade`, `semester`, `semester_name`, `start_year`, `end_year`) VALUES
(11, 'Oral Communication in Context', 'Core', 'All', 'All', 11, '2nd (2020 - 2021)', '2nd', '2020', '2021'),
(12, 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 'Core', 'All', 'All', 11, '1st (2020 - 2021)', '1st', '2020', '2021'),
(13, '21st Century from the Philippines and the World', 'Core', 'All', 'All', 11, '1st (2020 - 2021)', '1st', '2020', '2021'),
(14, 'General Mathematics', 'Core', 'All', 'All', 11, '1st (2020 - 2021)', '1st', '2020', '2021'),
(15, 'Empowerment Technologies', 'Applied', 'All', 'All', 11, '1st (2020 - 2021)', '1st', '2020', '2021'),
(16, 'Practical Research 1', 'Applied', 'All', 'All', 11, '1st (2020 - 2021)', '1st', '2020', '2021'),
(17, 'Practical Research 2', 'Applied', 'All', 'All', 12, '1st (2020 - 2021)', '1st', '2020', '2021'),
(18, 'Philippine Politics and Governance', 'Specialized', 'Academic', 'Humanities and Social Science', 12, '1st (2020 - 2021)', '1st', '2020', '2021'),
(19, 'Discipline and Ideas in the Social Sciences', 'Specialized', 'Academic', 'Humanities and Social Science', 11, '1st (2020 - 2021)', '2nd', '2020', '2021'),
(21, 'dadawdawdaw', 'Applied', 'All', 'All', 11, '2nd (2020 - 2021)', '2nd', '2020', '2021'),
(22, 'trshstrhr', 'Specialized', 'All', 'All', 11, '2nd (2021 - 2022)', '2nd', '2021', '2022'),
(23, 'trjsagge', 'Core', 'All', 'All', 11, '2nd (2020 - 2021)', '2nd', '2020', '2021');

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
(1, 'admin', '202cb962ac59075b964b07152d234b70', '123', 'system admin', 'system admin', '', 'active'),
(19, 'david', '73b5498b79df94cf62d5c280874896cb', 'centeno', 'David Centeno', 'registrar', '', 'active'),
(20, 'arcie', '230b150398b4b174b4789699754b631e', 'a126780c3a673de4fbc14896a79b0e66', 'Arcie Natuel', 'adviser', '', 'active'),
(22, 'daryl', 'f39e6f5e6a5a38472e0a1558a285f1d1', 'f39e6f5e6a5a38472e0a1558a285f1d1', 'Daryl Balbastro', 'adviser', 'Responsibility', 'active'),
(23, 'lebron', 'b4cc344d25a2efe540adbf2678e2304c', 'james', 'LeBron James', 'clinic staff', 'Responsibility', 'active'),
(24, 'aldren', '8c4937efca3ca92c742a440eb49861a1', 'sumile', 'Aldren Sumile', 'registrar', '', 'active'),
(25, 'hanz', '990c564889512b715dfee9c517179652', 'dinglasan', 'Hanz Dinglasan', 'adviser', '', 'active'),
(26, 'ancis', '355a8d0d595eb00bd69f9c250015f71d', 'mojica', 'Ancis Mojica', 'adviser', 'Generosity', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
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
-- Indexes for table `sf8`
--
ALTER TABLE `sf8`
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
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `sf2`
--
ALTER TABLE `sf2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=553;

--
-- AUTO_INCREMENT for table `sf2remarks`
--
ALTER TABLE `sf2remarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sf5b`
--
ALTER TABLE `sf5b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sf8`
--
ALTER TABLE `sf8`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sf9`
--
ALTER TABLE `sf9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=444;

--
-- AUTO_INCREMENT for table `sf9_modality`
--
ALTER TABLE `sf9_modality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `sf9_ov`
--
ALTER TABLE `sf9_ov`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sf10remedial`
--
ALTER TABLE `sf10remedial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `sf10remedialdate`
--
ALTER TABLE `sf10remedialdate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `strand`
--
ALTER TABLE `strand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `track`
--
ALTER TABLE `track`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
