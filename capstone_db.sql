-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2023 at 01:50 PM
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
(1, 12, 2023, 11, 25);

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
(3, 2022, 2023, '2022 - 2023', 1),
(4, 2023, 2024, '2023 - 2024', 0);

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
(45, 'Responsibility', 'Academic', 'Accountancy, Business and Management', 11, 28, 'Arcie Natuel', 3, '2022 - 2023', 1),
(46, 'Generosity', 'Technical-Vocational-Livelihood', 'Home Economics', 12, 30, 'Daryl Balbastro', 3, '2022 - 2023', 1),
(47, 'Perseverance', 'Academic', 'Science, Technology, Engineering and Mathematics', 11, 28, 'Arcie Natuel', 4, '2023 - 2024', 0),
(48, 'Hardwork', 'Technical-Vocational-Livelihood', 'Home Economics', 12, 30, 'Daryl Balbastro', 4, '2023 - 2024', 0);

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
(6, 20011246, 'Javier, Bryan M. ', 'Yes', 'NC II', 'Responsibility', 'M');

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
(444, 'Javier, Bryan M. ', 'Core', 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 88, 88, 88, '1st', 'M', 'Responsibility'),
(445, 'Javier, Bryan M. ', 'Applied', 'Empowerment Technologies', 89, 81, 85, '1st', 'M', 'Responsibility'),
(446, 'Javier, Bryan M. ', 'Applied', 'Practical Research 1', 75, 75, 75, '1st', 'M', 'Responsibility'),
(447, 'Javier, Bryan M. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(448, 'Javier, Bryan M. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(449, 'Javier, Bryan M. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(450, 'Javier, Bryan M. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(451, 'Javier, Bryan M. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(452, 'Javier, Bryan M. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(453, 'Javier, Bryan M. ', '', '', 0, 0, 0, '1st', 'M', 'Responsibility'),
(454, 'Javier, Bryan M. ', 'Core', 'Oral Communication in Context', 99, 99, 99, '2nd', 'M', 'Responsibility'),
(455, 'Javier, Bryan M. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(456, 'Javier, Bryan M. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(457, 'Javier, Bryan M. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(458, 'Javier, Bryan M. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(459, 'Javier, Bryan M. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(460, 'Javier, Bryan M. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(461, 'Javier, Bryan M. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(462, 'Javier, Bryan M. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility'),
(463, 'Javier, Bryan M. ', '', '', 0, 0, 0, '2nd', 'M', 'Responsibility');

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
(29, 'Javier, Bryan M. ', 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1);

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
(26, 'Javier, Bryan M. ', 'AO', 'AO', 'AO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'AO', 'AO', 'AO', 'AO', 'AO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO', 'SO');

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
  `is_archived` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `lrn`, `name`, `fname`, `mname`, `lname`, `suffix`, `sex`, `birth_date`, `birth_date2`, `age`, `ra`, `house_no`, `barangay`, `municipality`, `province`, `father`, `mother`, `guardian`, `relationship`, `contact`, `section`, `school_year_id`, `school_year`, `track`, `strand`, `grade`, `status`, `lm`, `indicator`, `ri`, `rid`, `weight`, `height`, `height2`, `bmi`, `bmi_category`, `hfa_category`, `is_archived`) VALUES
(54, 20011246, 'Javier, Bryan M. ', 'Bryan', 'M.', 'Javier', '', 'M', ' 10-10-2005', '2005-10-10', 17, 'Catholic', 'Blk 26 Lot 12', 'Tartaria', 'Silang', 'Cavite', 'Brody T. Javier', 'Lesly K. Manalo', 'Brody T. Javier', 'Parent', '00992857334', 'Responsibility', 3, '2022 - 2023', 'Academic', 'Accountancy, Business and Management', 11, 'complete', 'Face to face', '', '', '', 0, 0, 0, 0, '', '', 1);

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
(11, 'Oral Communication in Context', 'Core', 'All', 'All', 11, '2nd'),
(12, 'Komunikasyon at Pananaliksik sa Wika at Kulturang Filipino', 'Core', 'All', 'All', 11, '1st'),
(13, '21st Century from the Philippines and the World', 'Core', 'All', 'All', 11, '1st'),
(14, 'General Mathematics', 'Core', 'All', 'All', 11, '1st'),
(15, 'Empowerment Technologies', 'Applied', 'All', 'All', 11, '1st'),
(16, 'Practical Research 1', 'Applied', 'All', 'All', 11, '1st'),
(17, 'Practical Research 2', 'Applied', 'All', 'All', 12, '1st'),
(18, 'Philippine Politics and Governance', 'Specialized', 'Academic', 'Humanities and Social Science', 12, '1st'),
(19, 'Discipline and Ideas in the Social Sciences', 'Specialized', 'Academic', 'Humanities and Social Science', 11, '1st');

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
(28, 'arcie', 'a126780c3a673de4fbc14896a79b0e66', 'natuel', 'Arcie Natuel', 'Adviser', 'Perseverance', 'Active'),
(29, 'jerome', '662eaa47199461d01a623884080934ab', 'jose', 'Jerome Jose', 'Clinic teacher', '', 'Active'),
(30, 'daryl', 'f39e6f5e6a5a38472e0a1558a285f1d1', 'balbastro', 'Daryl Balbastro', 'Adviser', 'Hardwork', 'Active');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `sf2`
--
ALTER TABLE `sf2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=574;

--
-- AUTO_INCREMENT for table `sf2remarks`
--
ALTER TABLE `sf2remarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sf5b`
--
ALTER TABLE `sf5b`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sf9`
--
ALTER TABLE `sf9`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=464;

--
-- AUTO_INCREMENT for table `sf9_modality`
--
ALTER TABLE `sf9_modality`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `sf9_ov`
--
ALTER TABLE `sf9_ov`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `sf10remedial`
--
ALTER TABLE `sf10remedial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `sf10remedialdate`
--
ALTER TABLE `sf10remedialdate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `strand`
--
ALTER TABLE `strand`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
