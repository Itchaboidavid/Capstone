-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2023 at 12:39 PM
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
(1, 12, 2023, 1, 20);

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
(3, 2022, 2023, '2022 - 2023', 0),
(4, 2023, 2024, '2023 - 2024', 1);

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
(45, 'Responsibility', 'Academic', 'Accountancy, Business and Management', 11, 28, 'Arcie Natuel', 3, '2022 - 2023', 0),
(46, 'Generosity', 'Academic', 'Humanities and Social Science', 12, 30, 'Daryl Balbastro', 3, '2022 - 2023', 0),
(47, 'Perseverance', 'Academic', 'Science, Technology, Engineering and Mathematics', 11, 28, 'Arcie Natuel', 4, '2023 - 2024', 1),
(48, 'Hardwork', 'Technical-Vocational-Livelihood', 'Home Economics', 12, 30, 'Daryl Balbastro', 4, '2023 - 2024', 1),
(49, 'Perseverance', 'Academic', 'Science, Technology, Engineering and Mathematics', 11, 31, 'Ahl Rosales', 3, '2022 - 2023', 0);

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
  `default_end` date NOT NULL,
  `is_archived` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `name`, `start_year`, `end_year`, `output`, `start_date`, `end_date`, `default_start`, `default_end`, `is_archived`) VALUES
(22, '1st', '2022', '2023', '1st (2022 - 2023)', '01/01/22', '01/01/23', '2022-01-01', '2023-01-01', 0),
(23, '2nd', '2022', '2023', '2nd (2022 - 2023)', '01/01/22', '01/01/23', '2022-01-01', '2023-01-01', 1);

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
  `attendance_month` int(11) NOT NULL,
  `attendance_year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sf2`
--

INSERT INTO `sf2` (`id`, `student_id`, `student_name`, `student_section`, `sex`, `day`, `attendance_status`, `attendance_month`, `attendance_year`) VALUES
(598, 57, 'Anue, Adeline K. ', 'Responsibility', 'F', '1', 'on', 12, 2023),
(599, 56, 'Cuinto, Abby Mae  C.', 'Responsibility', 'F', '1', 'on', 12, 2023),
(600, 55, 'Mangu, Airlie E. ', 'Responsibility', 'F', '1', 'on', 12, 2023),
(601, 58, 'Meralda, Esme  K.', 'Responsibility', 'F', '1', 'on', 12, 2023),
(602, 63, 'Wonca, Milly R. ', 'Responsibility', 'F', '1', 'on', 12, 2023),
(603, 61, 'Benjamin, Shakira   C.', 'Responsibility', 'M', '1', 'on', 12, 2023),
(604, 62, 'De Benz, Shawn  T.', 'Responsibility', 'M', '1', 'on', 12, 2023),
(605, 54, 'Javier, Bryan M. ', 'Responsibility', 'M', '1', 'on', 12, 2023),
(606, 60, 'Jordan, Lia   R.', 'Responsibility', 'M', '1', 'on', 12, 2023),
(607, 59, 'Monkey, Luffy  D.', 'Responsibility', 'M', '1', 'on', 12, 2023),
(608, 57, 'Anue, Adeline K. ', 'Responsibility', 'F', '4', 'on', 12, 2023),
(609, 57, 'Anue, Adeline K. ', 'Responsibility', 'F', '5', 'on', 12, 2023),
(610, 57, 'Anue, Adeline K. ', 'Responsibility', 'F', '6', 'on', 12, 2023),
(611, 57, 'Anue, Adeline K. ', 'Responsibility', 'F', '8', 'on', 12, 2023),
(612, 57, 'Anue, Adeline K. ', 'Responsibility', 'F', '11', 'on', 12, 2023),
(613, 57, 'Anue, Adeline K. ', 'Responsibility', 'F', '12', 'on', 12, 2023),
(614, 57, 'Anue, Adeline K. ', 'Responsibility', 'F', '13', 'on', 12, 2023),
(615, 57, 'Anue, Adeline K. ', 'Responsibility', 'F', '14', 'on', 12, 2023),
(616, 57, 'Anue, Adeline K. ', 'Responsibility', 'F', '18', 'on', 12, 2023),
(617, 57, 'Anue, Adeline K. ', 'Responsibility', 'F', '19', 'on', 12, 2023),
(618, 57, 'Anue, Adeline K. ', 'Responsibility', 'F', '20', 'on', 12, 2023),
(619, 56, 'Cuinto, Abby Mae  C.', 'Responsibility', 'F', '4', 'on', 12, 2023),
(620, 56, 'Cuinto, Abby Mae  C.', 'Responsibility', 'F', '5', 'on', 12, 2023),
(621, 56, 'Cuinto, Abby Mae  C.', 'Responsibility', 'F', '6', 'on', 12, 2023),
(622, 56, 'Cuinto, Abby Mae  C.', 'Responsibility', 'F', '7', 'on', 12, 2023),
(623, 56, 'Cuinto, Abby Mae  C.', 'Responsibility', 'F', '8', 'on', 12, 2023),
(624, 56, 'Cuinto, Abby Mae  C.', 'Responsibility', 'F', '11', 'on', 12, 2023),
(625, 56, 'Cuinto, Abby Mae  C.', 'Responsibility', 'F', '12', 'on', 12, 2023),
(626, 56, 'Cuinto, Abby Mae  C.', 'Responsibility', 'F', '13', 'on', 12, 2023),
(627, 56, 'Cuinto, Abby Mae  C.', 'Responsibility', 'F', '14', 'on', 12, 2023),
(628, 56, 'Cuinto, Abby Mae  C.', 'Responsibility', 'F', '15', 'on', 12, 2023),
(629, 56, 'Cuinto, Abby Mae  C.', 'Responsibility', 'F', '18', 'on', 12, 2023),
(630, 56, 'Cuinto, Abby Mae  C.', 'Responsibility', 'F', '19', 'on', 12, 2023),
(631, 56, 'Cuinto, Abby Mae  C.', 'Responsibility', 'F', '20', 'on', 12, 2023),
(632, 55, 'Mangu, Airlie E. ', 'Responsibility', 'F', '4', 'on', 12, 2023),
(633, 55, 'Mangu, Airlie E. ', 'Responsibility', 'F', '5', 'on', 12, 2023),
(634, 55, 'Mangu, Airlie E. ', 'Responsibility', 'F', '6', 'on', 12, 2023),
(635, 55, 'Mangu, Airlie E. ', 'Responsibility', 'F', '7', 'on', 12, 2023),
(636, 55, 'Mangu, Airlie E. ', 'Responsibility', 'F', '8', 'on', 12, 2023),
(637, 55, 'Mangu, Airlie E. ', 'Responsibility', 'F', '12', 'on', 12, 2023),
(638, 55, 'Mangu, Airlie E. ', 'Responsibility', 'F', '13', 'on', 12, 2023),
(639, 55, 'Mangu, Airlie E. ', 'Responsibility', 'F', '14', 'on', 12, 2023),
(640, 55, 'Mangu, Airlie E. ', 'Responsibility', 'F', '15', 'on', 12, 2023),
(641, 55, 'Mangu, Airlie E. ', 'Responsibility', 'F', '18', 'on', 12, 2023),
(642, 55, 'Mangu, Airlie E. ', 'Responsibility', 'F', '19', 'on', 12, 2023),
(643, 55, 'Mangu, Airlie E. ', 'Responsibility', 'F', '20', 'on', 12, 2023),
(644, 58, 'Meralda, Esme  K.', 'Responsibility', 'F', '4', 'on', 12, 2023),
(645, 58, 'Meralda, Esme  K.', 'Responsibility', 'F', '5', 'on', 12, 2023),
(646, 58, 'Meralda, Esme  K.', 'Responsibility', 'F', '6', 'on', 12, 2023),
(647, 58, 'Meralda, Esme  K.', 'Responsibility', 'F', '7', 'on', 12, 2023),
(648, 58, 'Meralda, Esme  K.', 'Responsibility', 'F', '8', 'on', 12, 2023),
(649, 58, 'Meralda, Esme  K.', 'Responsibility', 'F', '11', 'on', 12, 2023),
(650, 58, 'Meralda, Esme  K.', 'Responsibility', 'F', '12', 'on', 12, 2023),
(651, 58, 'Meralda, Esme  K.', 'Responsibility', 'F', '13', 'on', 12, 2023),
(652, 58, 'Meralda, Esme  K.', 'Responsibility', 'F', '14', 'on', 12, 2023),
(653, 58, 'Meralda, Esme  K.', 'Responsibility', 'F', '15', 'on', 12, 2023),
(654, 58, 'Meralda, Esme  K.', 'Responsibility', 'F', '18', 'on', 12, 2023),
(655, 58, 'Meralda, Esme  K.', 'Responsibility', 'F', '19', 'on', 12, 2023),
(656, 58, 'Meralda, Esme  K.', 'Responsibility', 'F', '20', 'on', 12, 2023),
(657, 63, 'Wonca, Milly R. ', 'Responsibility', 'F', '4', 'on', 12, 2023),
(658, 63, 'Wonca, Milly R. ', 'Responsibility', 'F', '5', 'on', 12, 2023),
(659, 63, 'Wonca, Milly R. ', 'Responsibility', 'F', '6', 'on', 12, 2023),
(660, 63, 'Wonca, Milly R. ', 'Responsibility', 'F', '8', 'on', 12, 2023),
(661, 63, 'Wonca, Milly R. ', 'Responsibility', 'F', '11', 'on', 12, 2023),
(662, 63, 'Wonca, Milly R. ', 'Responsibility', 'F', '12', 'on', 12, 2023),
(663, 63, 'Wonca, Milly R. ', 'Responsibility', 'F', '14', 'on', 12, 2023),
(664, 63, 'Wonca, Milly R. ', 'Responsibility', 'F', '15', 'on', 12, 2023),
(665, 63, 'Wonca, Milly R. ', 'Responsibility', 'F', '18', 'on', 12, 2023),
(666, 63, 'Wonca, Milly R. ', 'Responsibility', 'F', '20', 'on', 12, 2023),
(667, 61, 'Benjamin, Shakira   C.', 'Responsibility', 'M', '5', 'on', 12, 2023),
(668, 61, 'Benjamin, Shakira   C.', 'Responsibility', 'M', '7', 'on', 12, 2023),
(669, 61, 'Benjamin, Shakira   C.', 'Responsibility', 'M', '8', 'on', 12, 2023),
(670, 61, 'Benjamin, Shakira   C.', 'Responsibility', 'M', '12', 'on', 12, 2023),
(671, 61, 'Benjamin, Shakira   C.', 'Responsibility', 'M', '13', 'on', 12, 2023),
(672, 61, 'Benjamin, Shakira   C.', 'Responsibility', 'M', '14', 'on', 12, 2023),
(673, 61, 'Benjamin, Shakira   C.', 'Responsibility', 'M', '15', 'on', 12, 2023),
(674, 61, 'Benjamin, Shakira   C.', 'Responsibility', 'M', '18', 'on', 12, 2023),
(675, 61, 'Benjamin, Shakira   C.', 'Responsibility', 'M', '19', 'on', 12, 2023),
(676, 62, 'De Benz, Shawn T. ', 'Responsibility', 'M', '4', 'on', 12, 2023),
(677, 62, 'De Benz, Shawn T. ', 'Responsibility', 'M', '5', 'on', 12, 2023),
(678, 62, 'De Benz, Shawn T. ', 'Responsibility', 'M', '6', 'on', 12, 2023),
(679, 62, 'De Benz, Shawn T. ', 'Responsibility', 'M', '8', 'on', 12, 2023),
(680, 62, 'De Benz, Shawn T. ', 'Responsibility', 'M', '11', 'on', 12, 2023),
(681, 62, 'De Benz, Shawn T. ', 'Responsibility', 'M', '12', 'on', 12, 2023),
(682, 62, 'De Benz, Shawn T. ', 'Responsibility', 'M', '13', 'on', 12, 2023),
(683, 62, 'De Benz, Shawn T. ', 'Responsibility', 'M', '15', 'on', 12, 2023),
(684, 62, 'De Benz, Shawn T. ', 'Responsibility', 'M', '18', 'on', 12, 2023),
(685, 62, 'De Benz, Shawn T. ', 'Responsibility', 'M', '19', 'on', 12, 2023),
(686, 62, 'De Benz, Shawn T. ', 'Responsibility', 'M', '20', 'on', 12, 2023),
(687, 54, 'Javier, Bryan M. ', 'Responsibility', 'M', '4', 'on', 12, 2023),
(688, 54, 'Javier, Bryan M. ', 'Responsibility', 'M', '5', 'on', 12, 2023),
(689, 54, 'Javier, Bryan M. ', 'Responsibility', 'M', '6', 'on', 12, 2023),
(690, 54, 'Javier, Bryan M. ', 'Responsibility', 'M', '7', 'on', 12, 2023),
(691, 54, 'Javier, Bryan M. ', 'Responsibility', 'M', '8', 'on', 12, 2023),
(692, 54, 'Javier, Bryan M. ', 'Responsibility', 'M', '11', 'on', 12, 2023),
(693, 54, 'Javier, Bryan M. ', 'Responsibility', 'M', '12', 'on', 12, 2023),
(694, 54, 'Javier, Bryan M. ', 'Responsibility', 'M', '13', 'on', 12, 2023),
(695, 54, 'Javier, Bryan M. ', 'Responsibility', 'M', '14', 'on', 12, 2023),
(696, 54, 'Javier, Bryan M. ', 'Responsibility', 'M', '15', 'on', 12, 2023),
(697, 54, 'Javier, Bryan M. ', 'Responsibility', 'M', '18', 'on', 12, 2023),
(698, 54, 'Javier, Bryan M. ', 'Responsibility', 'M', '19', 'on', 12, 2023),
(699, 54, 'Javier, Bryan M. ', 'Responsibility', 'M', '20', 'on', 12, 2023),
(700, 60, 'Jordan, Lia   R.', 'Responsibility', 'M', '4', 'on', 12, 2023),
(701, 60, 'Jordan, Lia   R.', 'Responsibility', 'M', '5', 'on', 12, 2023),
(702, 60, 'Jordan, Lia   R.', 'Responsibility', 'M', '6', 'on', 12, 2023),
(703, 60, 'Jordan, Lia   R.', 'Responsibility', 'M', '7', 'on', 12, 2023),
(704, 60, 'Jordan, Lia   R.', 'Responsibility', 'M', '8', 'on', 12, 2023),
(705, 60, 'Jordan, Lia   R.', 'Responsibility', 'M', '11', 'on', 12, 2023),
(706, 60, 'Jordan, Lia   R.', 'Responsibility', 'M', '13', 'on', 12, 2023),
(707, 60, 'Jordan, Lia   R.', 'Responsibility', 'M', '14', 'on', 12, 2023),
(708, 60, 'Jordan, Lia   R.', 'Responsibility', 'M', '15', 'on', 12, 2023),
(709, 60, 'Jordan, Lia   R.', 'Responsibility', 'M', '19', 'on', 12, 2023),
(710, 60, 'Jordan, Lia   R.', 'Responsibility', 'M', '20', 'on', 12, 2023),
(711, 59, 'Monkey, Luffy  D.', 'Responsibility', 'M', '4', 'on', 12, 2023),
(712, 59, 'Monkey, Luffy  D.', 'Responsibility', 'M', '5', 'on', 12, 2023),
(713, 59, 'Monkey, Luffy  D.', 'Responsibility', 'M', '6', 'on', 12, 2023),
(714, 59, 'Monkey, Luffy  D.', 'Responsibility', 'M', '13', 'on', 12, 2023),
(715, 59, 'Monkey, Luffy  D.', 'Responsibility', 'M', '14', 'on', 12, 2023),
(716, 59, 'Monkey, Luffy  D.', 'Responsibility', 'M', '15', 'on', 12, 2023),
(717, 59, 'Monkey, Luffy  D.', 'Responsibility', 'M', '18', 'on', 12, 2023),
(718, 59, 'Monkey, Luffy  D.', 'Responsibility', 'M', '19', 'on', 12, 2023),
(719, 59, 'Monkey, Luffy  D.', 'Responsibility', 'M', '20', 'on', 12, 2023);

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
  `completed` varchar(255) NOT NULL,
  `nc` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sf5b`
--

INSERT INTO `sf5b` (`id`, `lrn`, `student_name`, `completed`, `nc`, `section`, `sex`) VALUES
(16, 20010302, 'Anue, Adeline K. ', 'Yes', 'NC II', 'Responsibility', 'F'),
(17, 20010311, 'Benjamin, Shakira   C.', 'Yes', 'NC I', 'Responsibility', 'M'),
(18, 20010301, 'Cuinto, Abby Mae  C.', 'Yes', 'NC I', 'Responsibility', 'F'),
(19, 20010312, 'De Benz, Shawn T. ', 'Yes', 'NC III', 'Responsibility', 'M'),
(20, 20011246, 'Javier, Bryan M. ', 'Yes', 'NC I', 'Responsibility', 'M'),
(21, 200103006, 'Jordan, Lia   R.', 'Yes', 'NC I', 'Responsibility', 'M'),
(22, 20010300, 'Mangu, Airlie E. ', 'Yes', 'NC I', 'Responsibility', 'F'),
(23, 20010304, 'Meralda, Esme  K.', 'Yes', 'NC I', 'Responsibility', 'F'),
(24, 200103005, 'Monkey, Luffy  D.', 'Yes', 'NC II', 'Responsibility', 'M'),
(25, 20010314, 'Wonca, Milly R. ', 'Yes', 'NC I', 'Responsibility', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `sf9`
--

CREATE TABLE `sf9` (
  `id` int(11) NOT NULL,
  `student_name` varchar(255) NOT NULL,
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

INSERT INTO `sf9` (`id`, `student_name`, `subject_type`, `subject_title`, `sem_grade1`, `sem_grade2`, `final_grade`, `semester`, `sex`, `section`) VALUES
(557, 'Anue, Adeline K. ', 'Core', 'Oral Communication in Context', 99, 99, 99, '1st', 'F', 'Responsibility'),
(558, 'Anue, Adeline K. ', 'Core', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 88, 88, 88, '1st', 'F', 'Responsibility'),
(559, 'Anue, Adeline K. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(560, 'Anue, Adeline K. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(561, 'Anue, Adeline K. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(562, 'Anue, Adeline K. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(563, 'Anue, Adeline K. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(564, 'Anue, Adeline K. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(565, 'Anue, Adeline K. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(566, 'Anue, Adeline K. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(567, 'Anue, Adeline K. ', 'Core', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 99, 99, 99, '2nd', 'F', 'Responsibility'),
(568, 'Anue, Adeline K. ', 'Applied', 'Filipino sa Piling Larang', 88, 88, 88, '2nd', 'F', 'Responsibility'),
(569, 'Anue, Adeline K. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(570, 'Anue, Adeline K. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(571, 'Anue, Adeline K. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(572, 'Anue, Adeline K. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(573, 'Anue, Adeline K. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(574, 'Anue, Adeline K. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(575, 'Anue, Adeline K. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(576, 'Anue, Adeline K. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(577, 'Benjamin, Shakira   C.', 'Core', 'Oral Communication in Context', 97, 98, 97.5, '1st', 'M', 'Responsibility'),
(578, 'Benjamin, Shakira   C.', 'Core', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 89, 99, 94, '1st', 'M', 'Responsibility'),
(579, 'Benjamin, Shakira   C.', 'Core', '21st Century from the Philippines and the World', 98, 97, 97.5, '1st', 'M', 'Responsibility'),
(580, 'Benjamin, Shakira   C.', 'Core', 'General Mathematics', 95, 97, 96, '1st', 'M', 'Responsibility'),
(581, 'Benjamin, Shakira   C.', 'Core', 'Earth And Life Science ', 97, 97, 97, '1st', 'M', 'Responsibility'),
(582, 'Benjamin, Shakira   C.', 'Core', 'Reading and Writing Skills', 96, 95, 95.5, '1st', 'M', 'Responsibility'),
(583, 'Benjamin, Shakira   C.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(584, 'Benjamin, Shakira   C.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(585, 'Benjamin, Shakira   C.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(586, 'Benjamin, Shakira   C.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(587, 'Benjamin, Shakira   C.', 'Core', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 98, 98, 98, '2nd', 'M', 'Responsibility'),
(588, 'Benjamin, Shakira   C.', 'Core', 'Understanding Culture, Society, and Politics', 97, 97, 97, '2nd', 'M', 'Responsibility'),
(589, 'Benjamin, Shakira   C.', 'Core', 'Statistics and Probability', 96, 97, 96.5, '2nd', 'M', 'Responsibility'),
(590, 'Benjamin, Shakira   C.', 'Core', 'Physical Science', 98, 98, 98, '2nd', 'M', 'Responsibility'),
(591, 'Benjamin, Shakira   C.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(592, 'Benjamin, Shakira   C.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(593, 'Benjamin, Shakira   C.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(594, 'Benjamin, Shakira   C.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(595, 'Benjamin, Shakira   C.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(596, 'Benjamin, Shakira   C.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(597, 'Cuinto, Abby Mae  C.', 'Applied', 'Empowerment Technologies', 98, 98, 98, '1st', 'F', 'Responsibility'),
(598, 'Cuinto, Abby Mae  C.', 'Core', 'Oral Communication in Context', 96, 96, 96, '1st', 'F', 'Responsibility'),
(599, 'Cuinto, Abby Mae  C.', 'Specialized', 'Philippine Politics and Governance', 97, 96, 96.5, '1st', 'F', 'Responsibility'),
(600, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(601, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(602, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(603, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(604, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(605, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(606, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(607, 'Cuinto, Abby Mae  C.', 'Core', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 98, 97, 97.5, '2nd', 'F', 'Responsibility'),
(608, 'Cuinto, Abby Mae  C.', 'Core', 'Understanding Culture, Society, and Politics', 96, 97, 96.5, '2nd', 'F', 'Responsibility'),
(609, 'Cuinto, Abby Mae  C.', 'Applied', 'Filipino sa Piling Larang', 97, 98, 97.5, '2nd', 'F', 'Responsibility'),
(610, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(611, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(612, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(613, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(614, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(615, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(616, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(617, 'De Benz, Shawn T. ', 'Core', 'Oral Communication in Context', 97, 95, 96, '1st', 'M', 'Responsibility'),
(618, 'De Benz, Shawn T. ', 'Core', '21st Century from the Philippines and the World', 97, 97, 97, '1st', 'M', 'Responsibility'),
(619, 'De Benz, Shawn T. ', 'Applied', 'Empowerment Technologies', 95, 95, 95, '1st', 'M', 'Responsibility'),
(620, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(621, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(622, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(623, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(624, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(625, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(626, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(627, 'De Benz, Shawn T. ', 'Core', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 97, 97, 97, '2nd', 'M', 'Responsibility'),
(628, 'De Benz, Shawn T. ', 'Core', 'Understanding Culture, Society, and Politics', 96, 96, 96, '2nd', 'M', 'Responsibility'),
(629, 'De Benz, Shawn T. ', 'Applied', 'Practical Research 1', 98, 96, 97, '2nd', 'M', 'Responsibility'),
(630, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(631, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(632, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(633, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(634, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(635, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(636, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(637, 'Javier, Bryan M. ', 'Core', 'Oral Communication in Context', 96, 95, 95.5, '1st', 'M', 'Responsibility'),
(638, 'Javier, Bryan M. ', 'Applied', 'Empowerment Technologies', 94, 94, 94, '1st', 'M', 'Responsibility'),
(639, 'Javier, Bryan M. ', 'Core', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 96, 95, 95.5, '1st', 'M', 'Responsibility'),
(640, 'Javier, Bryan M. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(641, 'Javier, Bryan M. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(642, 'Javier, Bryan M. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(643, 'Javier, Bryan M. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(644, 'Javier, Bryan M. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(645, 'Javier, Bryan M. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(646, 'Javier, Bryan M. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(647, 'Javier, Bryan M. ', 'Core', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 98, 98, 98, '2nd', 'M', 'Responsibility'),
(648, 'Javier, Bryan M. ', 'Applied', 'Practical Research 1', 99, 99, 99, '2nd', 'M', 'Responsibility'),
(649, 'Javier, Bryan M. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(650, 'Javier, Bryan M. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(651, 'Javier, Bryan M. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(652, 'Javier, Bryan M. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(653, 'Javier, Bryan M. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(654, 'Javier, Bryan M. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(655, 'Javier, Bryan M. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(656, 'Javier, Bryan M. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(657, 'Jordan, Lia   R.', 'Core', 'Oral Communication in Context', 97, 97, 97, '1st', 'M', 'Responsibility'),
(658, 'Jordan, Lia   R.', 'Core', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 96, 96, 96, '1st', 'M', 'Responsibility'),
(659, 'Jordan, Lia   R.', 'Applied', 'Empowerment Technologies', 96, 96, 96, '1st', 'M', 'Responsibility'),
(660, 'Jordan, Lia   R.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(661, 'Jordan, Lia   R.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(662, 'Jordan, Lia   R.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(663, 'Jordan, Lia   R.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(664, 'Jordan, Lia   R.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(665, 'Jordan, Lia   R.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(666, 'Jordan, Lia   R.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(667, 'Jordan, Lia   R.', 'Core', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 97, 97, 97, '2nd', 'M', 'Responsibility'),
(668, 'Jordan, Lia   R.', 'Applied', 'Practical Research 1', 99, 99, 99, '2nd', 'M', 'Responsibility'),
(669, 'Jordan, Lia   R.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(670, 'Jordan, Lia   R.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(671, 'Jordan, Lia   R.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(672, 'Jordan, Lia   R.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(673, 'Jordan, Lia   R.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(674, 'Jordan, Lia   R.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(675, 'Jordan, Lia   R.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(676, 'Jordan, Lia   R.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(677, 'Mangu, Airlie E. ', 'Core', 'Oral Communication in Context', 98, 98, 98, '1st', 'F', 'Responsibility'),
(678, 'Mangu, Airlie E. ', 'Core', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 97, 97, 97, '1st', 'F', 'Responsibility'),
(679, 'Mangu, Airlie E. ', 'Applied', 'Empowerment Technologies', 97, 89, 93, '1st', 'F', 'Responsibility'),
(680, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(681, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(682, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(683, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(684, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(685, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(686, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(687, 'Mangu, Airlie E. ', 'Core', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 96, 97, 96.5, '2nd', 'F', 'Responsibility'),
(688, 'Mangu, Airlie E. ', 'Applied', 'Practical Research 1', 99, 99, 99, '2nd', 'F', 'Responsibility'),
(689, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(690, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(691, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(692, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(693, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(694, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(695, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(696, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(697, 'Meralda, Esme  K.', 'Core', 'Oral Communication in Context', 97, 97, 97, '1st', 'F', 'Responsibility'),
(698, 'Meralda, Esme  K.', 'Core', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 96, 97, 96.5, '1st', 'F', 'Responsibility'),
(699, 'Meralda, Esme  K.', 'Applied', 'Empowerment Technologies', 98, 98, 98, '1st', 'F', 'Responsibility'),
(700, 'Meralda, Esme  K.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(701, 'Meralda, Esme  K.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(702, 'Meralda, Esme  K.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(703, 'Meralda, Esme  K.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(704, 'Meralda, Esme  K.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(705, 'Meralda, Esme  K.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(706, 'Meralda, Esme  K.', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(707, 'Meralda, Esme  K.', 'Core', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 97, 97, 97, '2nd', 'F', 'Responsibility'),
(708, 'Meralda, Esme  K.', 'Applied', 'Practical Research 1', 96, 96, 96, '2nd', 'F', 'Responsibility'),
(709, 'Meralda, Esme  K.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(710, 'Meralda, Esme  K.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(711, 'Meralda, Esme  K.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(712, 'Meralda, Esme  K.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(713, 'Meralda, Esme  K.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(714, 'Meralda, Esme  K.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(715, 'Meralda, Esme  K.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(716, 'Meralda, Esme  K.', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(717, 'Monkey, Luffy  D.', 'Core', 'Oral Communication in Context', 97, 97, 97, '1st', 'M', 'Responsibility'),
(718, 'Monkey, Luffy  D.', 'Core', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 99, 98, 98.5, '1st', 'M', 'Responsibility'),
(719, 'Monkey, Luffy  D.', 'Applied', 'Empowerment Technologies', 97, 97, 97, '1st', 'M', 'Responsibility'),
(720, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(721, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(722, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(723, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(724, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(725, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(726, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(727, 'Monkey, Luffy  D.', 'Core', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 97, 97, 97, '2nd', 'M', 'Responsibility'),
(728, 'Monkey, Luffy  D.', 'Applied', 'Practical Research 1', 99, 99, 99, '2nd', 'M', 'Responsibility'),
(729, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(730, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(731, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(732, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(733, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(734, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(735, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(736, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(737, 'Wonca, Milly R. ', 'Core', 'Oral Communication in Context', 97, 96, 96.5, '1st', 'F', 'Responsibility'),
(738, 'Wonca, Milly R. ', 'Core', '21st Century from the Philippines and the World', 96, 96, 96, '1st', 'F', 'Responsibility'),
(739, 'Wonca, Milly R. ', 'Applied', 'Empowerment Technologies', 96, 97, 96.5, '1st', 'F', 'Responsibility'),
(740, 'Wonca, Milly R. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(741, 'Wonca, Milly R. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(742, 'Wonca, Milly R. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(743, 'Wonca, Milly R. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(744, 'Wonca, Milly R. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(745, 'Wonca, Milly R. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(746, 'Wonca, Milly R. ', '', '', 0, 0, 0, '1st', 'F', 'Responsibility'),
(747, 'Wonca, Milly R. ', 'Core', 'Pagbasa at Pagsusuri ng Iba\'t Ibang Teksto Tungo sa Pananaliksik', 96, 96, 96, '2nd', 'F', 'Responsibility'),
(748, 'Wonca, Milly R. ', 'Applied', 'Practical Research 1', 97, 97, 97, '2nd', 'F', 'Responsibility'),
(749, 'Wonca, Milly R. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(750, 'Wonca, Milly R. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(751, 'Wonca, Milly R. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(752, 'Wonca, Milly R. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(753, 'Wonca, Milly R. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(754, 'Wonca, Milly R. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(755, 'Wonca, Milly R. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility'),
(756, 'Wonca, Milly R. ', '', '', 0, 0, 0, '2nd', 'F', 'Responsibility');

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
(31, 'Anue, Adeline K. ', 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1),
(32, 'Benjamin, Shakira   C.', 1, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 1),
(33, 'Cuinto, Abby Mae  C.', 1, 1, 0, 1, 0, 1, 0, 0, 0, 0, 1, 0),
(34, 'De Benz, Shawn T. ', 1, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0),
(35, 'Javier, Bryan M. ', 1, 0, 1, 0, 0, 1, 1, 1, 0, 0, 0, 0),
(36, 'Jordan, Lia   R.', 0, 0, 1, 0, 1, 1, 0, 1, 0, 0, 0, 0),
(37, 'Mangu, Airlie E. ', 1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 1),
(38, 'Meralda, Esme  K.', 1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 1),
(39, 'Monkey, Luffy  D.', 1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 1),
(40, 'Wonca, Milly R. ', 1, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 1);

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
(28, 'Anue, Adeline K. ', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(29, 'Benjamin, Shakira   C.', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(30, 'Cuinto, Abby Mae  C.', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(31, 'De Benz, Shawn T. ', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(32, 'Javier, Bryan M. ', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(33, 'Jordan, Lia   R.', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(34, 'Mangu, Airlie E. ', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(35, 'Meralda, Esme  K.', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(36, 'Monkey, Luffy  D.', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO'),
(37, 'Wonca, Milly R. ', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO');

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
(88, 'Anue, Adeline K. ', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(89, 'Anue, Adeline K. ', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(90, 'Anue, Adeline K. ', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(91, 'Anue, Adeline K. ', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(92, 'Anue, Adeline K. ', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(93, 'Benjamin, Shakira   C.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(94, 'Benjamin, Shakira   C.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(95, 'Benjamin, Shakira   C.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(96, 'Benjamin, Shakira   C.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(97, 'Benjamin, Shakira   C.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(98, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(99, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(100, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(101, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(102, 'Cuinto, Abby Mae  C.', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(103, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(104, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(105, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(106, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(107, 'De Benz, Shawn T. ', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(108, 'Javier, Bryan M. ', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(109, 'Javier, Bryan M. ', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(110, 'Javier, Bryan M. ', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(111, 'Javier, Bryan M. ', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(112, 'Javier, Bryan M. ', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(113, 'Jordan, Lia   R.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(114, 'Jordan, Lia   R.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(115, 'Jordan, Lia   R.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(116, 'Jordan, Lia   R.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(117, 'Jordan, Lia   R.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(118, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(119, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(120, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(121, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(122, 'Mangu, Airlie E. ', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(123, 'Meralda, Esme  K.', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(124, 'Meralda, Esme  K.', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(125, 'Meralda, Esme  K.', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(126, 'Meralda, Esme  K.', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(127, 'Meralda, Esme  K.', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(128, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(129, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(130, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(131, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(132, 'Monkey, Luffy  D.', '', '', 0, 0, 0, '', '', 'M', 'Responsibility'),
(133, 'Wonca, Milly R. ', 'Applied', 'Empowerment Technologies', 74, 74, 74, '1st', 'FAILED', 'F', 'Responsibility'),
(134, 'Wonca, Milly R. ', 'Applied', 'Filipino sa Piling Larang', 73, 82, 78, '2nd', 'PASSED', 'F', 'Responsibility'),
(135, 'Wonca, Milly R. ', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(136, 'Wonca, Milly R. ', '', '', 0, 0, 0, '', '', 'F', 'Responsibility'),
(137, 'Wonca, Milly R. ', '', '', 0, 0, 0, '', '', 'F', 'Responsibility');

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
(12, 'Anue, Adeline K. ', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(13, 'Benjamin, Shakira   C.', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(14, 'Cuinto, Abby Mae  C.', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(15, 'De Benz, Shawn T. ', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(16, 'Javier, Bryan M. ', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(17, 'Jordan, Lia   R.', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(18, 'Mangu, Airlie E. ', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(19, 'Meralda, Esme  K.', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(20, 'Monkey, Luffy  D.', '0000-00-00', '0000-00-00', '0000-00-00', '0000-00-00'),
(21, 'Wonca, Milly R. ', '2022-02-07', '2022-08-12', '2023-01-09', '2023-04-07');

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
(54, 20011246, 'Javier, Bryan M. ', 'Bryan', 'M.', 'Javier', '', 'M', ' 10-10-2005', '2005-10-10', 17, 'Catholic', 'Blk 26 Lot 12', 'Tartaria', 'Silang', 'Cavite', 'Brody T. Javier', 'Lesly K. Manalo', 'Brody T. Javier', 'Parent', '00992857334', 'Responsibility', 3, '2022 - 2023', 'Academic', 'Accountancy, Business and Management', 11, 'complete', 'Face to face', '', '', '', 53, 1.5, 2.25, 23.56, 'Normal', 'Severely stunted', '', 0),
(55, 20010300, 'Mangu, Airlie E. ', 'Airlie', 'E.', 'Mangu', '', 'F', ' 07-13-2004', '2004-07-13', 18, 'Catholic', 'Blk 18 Lot 67', 'Tartaria', 'Silang', 'Cavite', 'Chino Mangu', 'Ariele Eduardo', 'Chino Mangu', 'Father', '09338272711', 'Responsibility', 3, '2022 - 2023', 'Academic', 'Accountancy, Business and Management', 11, 'complete', 'Face to face', '', '', '', 56, 2.3, 5.29, 10.59, 'Severely wasted', 'Tall', '', 0),
(56, 20010301, 'Cuinto, Abby Mae  C.', 'Abby Mae', 'C.', 'Cuinto', '', 'F', '07-15-2004', '2004-07-15', 18, 'Catholic', 'Blk 17 Lot 1', 'Tartaria', 'Silang', 'Cavite', 'Billie Cuinto', 'Maria Carding', 'Billie Cuinto', 'Father', '09461527357', 'Responsibility', 3, '2022 - 2023', 'Academic', 'Accountancy, Business and Management', 11, 'complete', 'Face to face', '', '', '', 58, 2.3, 5.29, 10.96, 'Severely wasted', 'Tall', '', 0),
(57, 20010302, 'Anue, Adeline K. ', 'Adeline', 'K.', 'Anue', '', 'F', ' 11-17-2004', '2004-11-17', 19, 'Catholic', 'Blk 56 Lot 12', 'Pogi', 'Lipa', 'Batangas', 'Sugma Anue', 'Irene Kuriano', 'Irene Kuriano', 'Mother', '09971263715', 'Responsibility', 3, '2022 - 2023', 'Academic', 'Accountancy, Business and Management', 11, 'complete', 'Face to face', '', '', '', 58, 1.39, 1.9321, 30.02, 'Obese', 'Severely stunted', '', 0),
(58, 20010304, 'Meralda, Esme  K.', 'Esme', 'K.', 'Meralda', '', 'F', '12-15-2003', '2003-12-15', 19, 'Catholic', 'Blk 5 Lot 3', 'Humiga', 'Alfonso', 'Cavite', 'Mikolaj Meralda', 'Ayah Kaynes', 'Mikolaj Meralda', 'Father', '09927126471', 'Responsibility', 3, '2022 - 2023', 'Academic', 'Accountancy, Business and Management', 11, 'complete', 'Face to face', '', '', '', 60, 1, 1, 60, 'Obese', 'Severely stunted', '', 0),
(59, 200103005, 'Monkey, Luffy  D.', 'Luffy', 'D.', 'Monkey', '', 'M', '01-23-2005', '2005-01-23', 17, 'Catholic', 'Blk 56 Lot 19', 'Ulat', 'Alfonso', 'Cavite', 'Dragon Monkey', 'Ivankov Dio', 'Ivankov Dio', 'Mother', '09972836545', 'Responsibility', 3, '2022 - 2023', 'Academic', 'Accountancy, Business and Management', 11, 'complete', 'Face to face', '', '', '', 54, 2.5, 6.25, 8.64, 'Severely wasted', 'Tall', '', 0),
(60, 200103006, 'Jordan, Lia   R.', 'Lia ', 'R.', 'Jordan', '', 'M', '02-11-2005', '2005-02-11', 17, 'Catholic', 'Blk 6 Lot 99', 'Tartaria', 'Silang', 'Cavite', 'Lebron Jordan', 'Sia Rum', 'Lebron Jordan', 'Father', '09973825464', 'Responsibility', 3, '2022 - 2023', 'Academic', 'Accountancy, Business and Management', 11, 'complete', 'Face to face', '', '', '', 57, 1.5, 2.25, 25.33, 'Overweight', 'Severely stunted', '', 0),
(61, 20010311, 'Benjamin, Shakira   C.', 'Shakira ', 'C.', 'Benjamin', '', 'M', '12-21-2004', '2004-12-21', 18, 'Catholic', 'Blk 26 Lot 5', 'Lumil', 'Alfonso', 'Cavite', 'Myke Benjamin', 'Amie Carino', 'Amie Carino', 'Mother', '09173241463', 'Responsibility', 3, '2022 - 2023', 'Academic', 'Accountancy, Business and Management', 11, 'complete', 'Face to face', '', '', '', 55, 1.4, 1.96, 28.06, 'Overweight', 'Severely stunted', '', 0),
(62, 20010312, 'De Benz, Shawn T. ', 'Shawn', 'T.', 'De Benz', '', 'M', ' 12-07-2004', '2004-12-07', 19, '', 'Blk 13Lot 9', 'Tartaria', 'Silang', 'Cavite', 'Merci De Benz', 'Margie Tolits', 'Merci De Benz', 'Father', '09996127353', 'Responsibility', 3, '2022 - 2023', 'Academic', 'Accountancy, Business and Management', 11, 'complete', 'Face to face', '', '', '', 48, 1.3, 1.69, 28.4, 'Overweight', 'Severely stunted', '', 0),
(63, 20010314, 'Wonca, Milly R. ', 'Milly', 'R.', 'Wonca', '', 'F', ' 05-14-2004', '2004-05-14', 18, 'Catholic', 'Blk 36 Lot 12', 'Tartaria', 'Silang', 'Cavite', 'Marvin Wonca', 'Rea Rindin', 'Rea Rindin', 'Mother', '09997426178', 'Responsibility', 3, '2022 - 2023', 'Academic', 'Accountancy, Business and Management', 11, 'complete', 'Face to face', '', '', '', 58, 1, 1, 58, 'Obese', 'Severely stunted', '', 0),
(64, 20010315, 'Maddox, Jonty   R', 'Jonty ', 'R', 'Maddox', '', 'M', '07-14-2004', '2004-07-14', 18, 'Catholic', 'Blk 14 Lot 2', 'Tartaria', 'Silang', 'Cavite', 'Hanz Maddox', 'Rea Ril', 'Hanz Maddox', 'Father', '09926936492', 'Perseverance', 4, '2023 - 2024', 'Academic', 'Science, Technology, Engineering and Mathematics', 11, 'complete', 'Face to face', '', '', '', 56, 1.67, 2.7889, 20.08, 'Normal', 'Stunted', '', 0),
(65, 20010316, 'Walton, Malik  Q. ', 'Malik ', 'Q.', 'Walton', '', 'F', ' 04-17-2004', '2004-04-17', 18, 'Catholic', 'Blk 17 Lot 12', 'Tartaria', 'Silang', 'Cavite', 'Millie Walton', 'Reyna Quiiin', 'Reyna Quiiin', 'Mother', '09927348276', 'Perseverance', 4, '2023 - 2024', 'Academic', 'Science, Technology, Engineering and Mathematics', 11, 'complete', 'Face to face', '', '', '', 53, 1.67, 2.7889, 19, 'Normal', 'Normal', '', 0),
(66, 20010317, 'Gallagher, Iqra   W.', 'Iqra ', 'W.', 'Gallagher', '', 'M', '12-08-2004', '2004-12-08', 19, 'Catholic', 'Blk 16 Lot 13', 'Lalaan', 'Silang', 'Cavite', 'Luis Gallagher', 'Meri Wimm', 'Luis Gallagher', 'Father', '09916253714', 'Perseverance', 4, '2023 - 2024', 'Academic', 'Science, Technology, Engineering and Mathematics', 11, 'complete', 'Face to face', '', '', '', 60, 2.3, 5.29, 11.34, 'Severely wasted', 'Tall', '', 0),
(67, 20010318, 'Potts, Harry  T. ', 'Harry ', 'T.', 'Potts', '', 'M', ' 07-18-2004', '2004-07-18', 18, '', 'Blk 26 Lot 2', 'Lumil', 'Silang', 'Cavite', 'Harry Potts', 'Sandra Tinner', 'Harry Potts', 'Father', '9718326716', 'Perseverance', 4, '2023 - 2024', 'Academic', 'Science, Technology, Engineering and Mathematics', 11, 'complete', 'Face to face', '', '', '', 60, 1, 1, 60, 'Obese', 'Severely stunted', '', 0),
(68, 20010319, 'Hampton, Dante   R.', 'Dante ', 'R.', 'Hampton', '', 'M', '07-18-2005', '2005-07-18', 17, 'Catholic', 'Blk 36 Lot 12', 'Lalaan', 'Silang', 'Cavite', 'Humpy Hampton', 'Cindy Riggs', 'Humpy Hampton', 'Father', '09912643162', 'Perseverance', 4, '2023 - 2024', 'Academic', 'Science, Technology, Engineering and Mathematics', 11, 'complete', 'Face to face', '', '', '', 56, 1.39, 1.9321, 28.98, 'Overweight', 'Severely stunted', '', 0),
(69, 20010320, 'Simmons, Elouise   M.', 'Elouise ', 'M.', 'Simmons', '', 'F', '08-07-2004', '2004-08-07', 18, 'Catholic', 'Blk 36 Lot 1', 'Puting Kahoy', 'Sta. Rosa', 'Laguna', 'Johnny Simmons', 'Denise Mardun', 'Johnny Simmons', 'Father', '09961278361', 'Perseverance', 4, '2023 - 2024', 'Academic', 'Science, Technology, Engineering and Mathematics', 11, 'complete', 'Face to face', '', '', '', 58, 1.39, 1.9321, 30.02, 'Obese', 'Severely stunted', '', 0),
(70, 20010321, 'Newton, Pearl   M.', 'Pearl ', 'M.', 'Newton', '', 'M', '06-07-2004', '2004-06-07', 18, 'Catholic', 'Blk 30 Lot 10', 'Tartaria', 'Silang', 'Cavite', 'Isaac Newton', 'Cindy Meyn', 'Isaac Newton', 'Father', '09916235172', 'Perseverance', 4, '2023 - 2024', 'Academic', 'Science, Technology, Engineering and Mathematics', 11, 'complete', 'Face to face', '', '', '', 60, 1.39, 1.9321, 31.05, 'Obese', 'Severely stunted', '', 0),
(71, 20010323, 'Jennings, Beatrice   C.', 'Beatrice ', 'C.', 'Jennings', '', 'F', '12-07-2004', '2004-12-07', 19, 'Catholic', 'Blk 16 Lot 12', 'Tartaria', 'Silang', 'Cavite', 'Niw Jennings', 'Xanovier Carion', 'Xanovier Carion', 'Mother', '09914723461', 'Perseverance', 4, '2023 - 2024', 'Academic', 'Science, Technology, Engineering and Mathematics', 11, 'complete', 'Face to face', '', '', '', 60, 1, 1, 60, 'Obese', 'Severely stunted', '', 0),
(72, 20010324, 'Carpenter, Abbey   W.', 'Abbey ', 'W.', 'Carpenter', '', 'F', '12-04-2004', '2004-12-04', 19, 'Catholic', 'Blk 45 Lot 11', 'Puting Kahoy', 'Sta. Rosa', 'Laguna', 'Timmy Carpenter', 'Zeinin Weyn', 'Timmy Carpenter', 'Father', '09776712573', 'Perseverance', 4, '2023 - 2024', 'Academic', 'Science, Technology, Engineering and Mathematics', 11, 'complete', 'Face to face', '', '', '', 56, 1.67, 2.7889, 20.08, 'Normal', 'Normal', '', 0),
(73, 20010326, 'Thomson, Jude   G.', 'Jude ', 'G.', 'Thomson', '', 'F', '12-02-2004', '2004-12-02', 19, 'Catholic', 'Blk 36 Lot 24', 'Lumil', 'Silang', 'Cavite', 'Thim Thomsom', 'Abigeyl Genori', 'Abigeyl Genori', 'Mother', '09472835435', 'Perseverance', 4, '2023 - 2024', 'Academic', 'Science, Technology, Engineering and Mathematics', 11, 'complete', 'Face to face', '', '', '', 60, 1.39, 1.9321, 31.05, 'Obese', 'Severely stunted', '', 0),
(74, 20010400, 'Gilbert, Kenny   H.', 'Kenny ', 'H.', 'Gilbert', '', 'M', '03-26-2004', '2004-03-26', 18, 'Catholic', 'Blk 16 Lot 10', 'Tartaria', 'Silang', 'Cavite', 'Henry Gilbert', 'Sandra Hamon', 'Henry Gilbert', 'Father', '09951273561', 'Generosity', 3, '2022 - 2023', 'Academic', 'Humanities and Social Science', 12, 'complete', 'Face to face', '', '', '', 56.7, 1.6, 2.56, 22.15, 'Normal', 'Severely stunted', '', 0),
(75, 20010401, 'Grimes, Barry   N.', 'Barry ', 'N.', 'Grimes', '', 'M', '02-07-2004', '2004-02-07', 17, 'Catholic', 'Blk 45 Lot 10', 'Tartaria', 'Silang', 'Cavite', 'Timoty Grimes', 'Andrea Nilag', 'Timoty Grimes', 'Father', '09732487587', 'Generosity', 3, '2022 - 2023', 'Academic', 'Humanities and Social Science', 12, 'complete', 'Face to face', '', '', '', 56.7, 1.6, 2.56, 22.15, 'Normal', 'Stunted', '', 0),
(76, 200104002, 'Buchanan, Bilal   K.', 'Bilal ', 'K.', 'Buchanan', '', 'M', '02-17-2004', '2004-02-17', 18, 'Catholic', 'Blk 01 Lot 23', 'Puting Kahoy', 'Sta. Rosa', 'Laguna', 'Kim Buchanan', 'Charmaine Kilton', 'Charmaine Kilton', 'Mother', '09962517352', 'Generosity', 3, '2022 - 2023', 'Academic', 'Humanities and Social Science', 12, 'complete', 'Face to face', '', '', '', 56.7, 1.8, 3.24, 17.5, 'Wasted', 'Normal', '', 0),
(77, 20010405, 'Gomez, Samuel   I.', 'Samuel ', 'I.', 'Gomez', '', 'M', '02-07-2004', '2004-02-07', 18, 'Catholic', 'Blk 14 Lot 5', 'Lumil', 'Silang', 'Cavite', 'Carlo Gomez', 'Mika Inken', 'Carlo Gomez', 'Father', '09372473645', 'Generosity', 3, '2022 - 2023', 'Academic', 'Humanities and Social Science', 12, 'complete', 'Face to face', '', '', '', 53, 1.39, 1.9321, 27.43, 'Overweight', 'Severely stunted', '', 0),
(78, 200104007, 'Davenport, Albert   Y.', 'Albert ', 'Y.', 'Davenport', '', 'M', '05-16-2004', '2004-05-16', 18, 'Catholic', 'Blk 01 Lot 14', 'Lumil', 'Silang', 'Cavite', 'Aero Davenport', 'Mari Ygsael', 'Mari Ygsael', 'Mother', '09967123571', 'Generosity', 3, '2022 - 2023', 'Academic', 'Humanities and Social Science', 12, 'complete', 'Face to face', '', '', '', 60, 1.67, 2.7889, 21.51, 'Normal', 'Stunted', '', 0),
(79, 20010409, 'Duke, Traci  V. ', 'Traci ', 'V.', 'Duke', '', 'F', ' 03-27-2004', '2004-03-27', 18, 'Catholic', 'Blk 26 Lot 9', 'Tartaria', 'Silang', 'Cavite', 'Grand Duke', 'Fericia Vigor', 'Grand Duke', 'Father', '9961253715', 'Generosity', 3, '2022 - 2023', 'Academic', 'Humanities and Social Science', 12, 'complete', 'Face to face', '', '', '', 53, 1.67, 2.7889, 19, 'Normal', 'Normal', '', 0),
(80, 200104012, 'Wyatt, Kathryn   F.', 'Kathryn ', 'F.', 'Wyatt', '', 'F', '02-06-2004', '2004-02-06', 18, 'Catholic', 'Blk 13 Lot 7', 'Tartaria', 'Silang', 'Cavite', 'Gin Wyatt', 'Remelia Forson', 'Gin Wyatt', 'Father', '09961253715', 'Generosity', 3, '2022 - 2023', 'Academic', 'Humanities and Social Science', 12, 'complete', 'Face to face', '', '', '', 53, 2.3, 5.29, 10.02, 'Severely wasted', 'Tall', '', 0),
(81, 20010416, 'Patrick, Amy  J. ', 'Amy ', 'J.', 'Patrick', '', 'F', ' 08-09-2004', '2004-08-09', 18, 'Catholic', 'Purok 5', 'Lumil', 'Silang', 'Cavite', 'Stinfer Patrick', 'Gina Judson', 'Stinfer Patrick', 'Father', '09578123781', 'Generosity', 3, '2022 - 2023', 'Academic', 'Humanities and Social Science', 12, 'complete', 'Face to face', '', '', '', 54, 1.5, 2.25, 24, 'Normal', 'Severely stunted', '', 0),
(82, 20010420, 'Mcconnell, Diane   F.', 'Diane ', 'F.', 'Mcconnell', '', 'F', '07-06-2004', '2004-07-06', 18, 'Catholic', 'Blk 15 Lot 12', 'Tartaria', 'Silang', 'Cavite', 'Edward Mcconnell', 'Jhanel Fredriach', 'Jhanel Fredriach', 'Mother', '09861325716', 'Generosity', 3, '2022 - 2023', 'Academic', 'Humanities and Social Science', 12, 'complete', 'Face to face', '', '', '', 58, 1.39, 1.9321, 30.02, 'Obese', 'Severely stunted', '', 0),
(83, 20010423, 'Reyes, Regan   V.', 'Regan ', 'V.', 'Reyes', '', 'M', '08-07-2005', '2005-08-07', 17, 'Catholic', 'Blk 46 Lot 12', 'Lumil', 'Silang', 'Cavite', 'Mikey Reyes', 'Janice Vinlon', 'Mikey Reyes', 'Father', '09651234656', 'Generosity', 3, '2022 - 2023', 'Academic', 'Humanities and Social Science', 12, 'complete', 'Face to face', '', '', '', 58, 1, 1, 58, 'Obese', 'Severely stunted', '', 0);

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
(28, 'arcie', 'a126780c3a673de4fbc14896a79b0e66', 'natuel', 'Arcie Natuel', 'Adviser', 'Responsibility', 'Active'),
(29, 'jerome', '662eaa47199461d01a623884080934ab', 'jose', 'Jerome Jose', 'Clinic teacher', '', 'Active'),
(30, 'daryl', 'f39e6f5e6a5a38472e0a1558a285f1d1', 'balbastro', 'Daryl Balbastro', 'Adviser', 'Generosity', 'Active'),
(31, 'ahl', '96c4cbfbd9b13425d1d7154e4276484e', 'rosales', 'Ahl Rosales', 'Adviser', 'Perseverance', 'Active');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sf2`
--
ALTER TABLE `sf2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=720;

--
-- AUTO_INCREMENT for table `sf2remarks`
--
ALTER TABLE `sf2remarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sf5b`
--
ALTER TABLE `sf5b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `sf9`
--
ALTER TABLE `sf9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=757;

--
-- AUTO_INCREMENT for table `sf9_modality`
--
ALTER TABLE `sf9_modality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `sf9_ov`
--
ALTER TABLE `sf9_ov`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sf10remedial`
--
ALTER TABLE `sf10remedial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- AUTO_INCREMENT for table `sf10remedialdate`
--
ALTER TABLE `sf10remedialdate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `strand`
--
ALTER TABLE `strand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
