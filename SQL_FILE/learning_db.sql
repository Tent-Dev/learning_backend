-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 02, 2020 at 06:23 PM
-- Server version: 5.6.37
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learning_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lesson`
--

CREATE TABLE IF NOT EXISTS `tbl_lesson` (
  `lesson_id` int(11) NOT NULL,
  `lesson_name` varchar(255) NOT NULL,
  `lesson_desc` text NOT NULL,
  `lesson_intro_mp4` text NOT NULL,
  `lesson_content_mp4` text NOT NULL,
  `lesson_urlname` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_lesson`
--

INSERT INTO `tbl_lesson` (`lesson_id`, `lesson_name`, `lesson_desc`, `lesson_intro_mp4`, `lesson_content_mp4`, `lesson_urlname`) VALUES
(2, 'Lesson2 Pre Test', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '../upload/video/intro/5e36d0beaa1d5-unit2.mp4', '', 'unit-2'),
(32, 'Lesson1 Introduction', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '../upload/video/intro/5e36d3533c838-intro1_2.mp4', '', 'unit-1'),
(33, 'Lesson3 How to', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '../upload/video/intro/5e36d3a724de3-unit3.mp4', '', 'unit-3'),
(43, 'Lesson4 String', 'aaaa', '../upload/video/intro/5e36d3be800bc-unit4_1.mp4', '', 'unit-4'),
(44, 'Lesson5 Ha', 'aaaaa', '../upload/video/intro/5e36d40034d30-unit5.mp4', '', 'unit-5'),
(45, 'Lesson6 Test', 'Textttt', '', '', 'unit-6'),
(46, 'Lesson7', '', '../upload/video/intro/5e36d7175748c-unit7_1.mp4', '', ''),
(47, 'Lesson8', '', '', '', 'unit-8');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_member`
--

CREATE TABLE IF NOT EXISTS `tbl_member` (
  `member_id` int(11) NOT NULL,
  `member_firstname` varchar(255) NOT NULL,
  `member_lastname` varchar(255) NOT NULL,
  `member_username` varchar(40) NOT NULL,
  `member_password` longtext NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_member`
--

INSERT INTO `tbl_member` (`member_id`, `member_firstname`, `member_lastname`, `member_username`, `member_password`) VALUES
(2, 'ABC', 'DEF', 'admin', '$2y$12$hLQnObUmUwAeHIQca.0XkeLYspbq3f0aWgqYOd3.2aYNd5N950LbW');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_video`
--

CREATE TABLE IF NOT EXISTS `tbl_video` (
  `video_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `video_url` text NOT NULL,
  `video_category` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_lesson`
--
ALTER TABLE `tbl_lesson`
  ADD PRIMARY KEY (`lesson_id`);

--
-- Indexes for table `tbl_member`
--
ALTER TABLE `tbl_member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `tbl_video`
--
ALTER TABLE `tbl_video`
  ADD PRIMARY KEY (`video_id`),
  ADD KEY `FK_video` (`lesson_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_lesson`
--
ALTER TABLE `tbl_lesson`
  MODIFY `lesson_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `tbl_member`
--
ALTER TABLE `tbl_member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `tbl_video`
--
ALTER TABLE `tbl_video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_video`
--
ALTER TABLE `tbl_video`
  ADD CONSTRAINT `FK_video` FOREIGN KEY (`lesson_id`) REFERENCES `tbl_lesson` (`lesson_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
