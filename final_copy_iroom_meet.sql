-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2025 at 08:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iroom_meet`
--

-- --------------------------------------------------------

--
-- Table structure for table `adviser`
--

CREATE TABLE `adviser` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `school_id` text NOT NULL,
  `section` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` text NOT NULL DEFAULT 'adviser'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adviser`
--

INSERT INTO `adviser` (`id`, `name`, `school_id`, `section`, `email`, `contact_no`, `password`, `type`) VALUES
(13, 'bea_adviser', '21-75832', 'A', 'bea@gmail.com', '09060714266', 'bea_adviser', 'adviser');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student`, `status`, `date`) VALUES
(21, 15, 'Present', '2025-05-29 18:39:22'),
(22, 16, 'Present', '2025-05-29 18:52:29');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_what` varchar(255) NOT NULL,
  `event_when` varchar(255) NOT NULL,
  `event_where` varchar(255) NOT NULL,
  `event_who` varchar(255) NOT NULL,
  `event_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_what`, `event_when`, `event_where`, `event_who`, `event_date`) VALUES
(16, 'Alumni Homecoming', 'Alumni Homecoming Reunion – A special day to reconnect with old classmates, celebrate memories, and honor the legacy of our school community.', 'Date: Saturday, November 23, 2025 🕘 Time: 10:00 AM – 8:00 PM 🎉 Includes: Welcome Reception, Campus Tour, Lunch, Award Ceremony & Evening Party', 'Address: 123 Alumni Lane, Cityville, ST 45678', ' Invited: All Former Students, Teachers, Staff, and Families', '2025-05-29');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `grade` varchar(255) NOT NULL,
  `quarter` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `student`, `subject`, `grade`, `quarter`, `date`) VALUES
(17, 15, 'Earth and Life Science', '100', '1st Quarter', '2025-05-29 18:39:01'),
(18, 15, 'Empowerment Technology', '100', '2nd Quarter', '2025-05-29 18:39:13'),
(21, 16, 'Earth and Life Science', '99', '1st Quarter', '2025-05-29 18:52:10'),
(22, 16, 'Empowerment Technology', '100', '1st Quarter', '2025-05-29 18:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `id` int(11) NOT NULL,
  `parent_name` varchar(255) NOT NULL,
  `student` int(11) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'parent'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`id`, `parent_name`, `student`, `student_id`, `school_id`, `email`, `password`, `type`) VALUES
(8, 'kjgnaquines_parent', 15, '21-75832', '21-75832', 'kjgnaquines@gmail.com', 'kjgnaquines_parent', 'parent');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `middlename` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `lrn` varchar(255) NOT NULL,
  `adviser` int(11) NOT NULL,
  `section` varchar(100) NOT NULL,
  `type` varchar(255) NOT NULL DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `firstname`, `middlename`, `lastname`, `lrn`, `adviser`, `section`, `type`) VALUES
(15, 'Shaina', 'O', 'Respicio', '130103300010015', 13, 'A', 'student'),
(16, 'Kayle', 'Kuzma', 'Heart', '120103213124412', 13, 'A', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `weekly_performance`
--

CREATE TABLE `weekly_performance` (
  `id` int(11) NOT NULL,
  `student` int(11) NOT NULL,
  `m01` varchar(11) NOT NULL,
  `m02` varchar(11) NOT NULL,
  `m03` varchar(11) NOT NULL,
  `m04` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `weekly_performance`
--

INSERT INTO `weekly_performance` (`id`, `student`, `m01`, `m02`, `m03`, `m04`) VALUES
(13, 15, '10', '8', '10', '10'),
(14, 16, '9', '10', '10', '10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adviser`
--
ALTER TABLE `adviser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_attendance_student` (`student`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_grades_student` (`student`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_parent_student` (`student`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_student` (`adviser`);

--
-- Indexes for table `weekly_performance`
--
ALTER TABLE `weekly_performance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_weekly_performance` (`student`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adviser`
--
ALTER TABLE `adviser`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `weekly_performance`
--
ALTER TABLE `weekly_performance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_attendance_student` FOREIGN KEY (`student`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `fk_grades_student` FOREIGN KEY (`student`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `fk_parent_student` FOREIGN KEY (`student`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_student` FOREIGN KEY (`adviser`) REFERENCES `adviser` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `weekly_performance`
--
ALTER TABLE `weekly_performance`
  ADD CONSTRAINT `fk_weekly_performance` FOREIGN KEY (`student`) REFERENCES `student` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
