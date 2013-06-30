-- phpMyAdmin SQL Dump
-- version 3.5.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 30, 2013 at 04:24 AM
-- Server version: 5.1.69-cll
-- PHP Version: 5.3.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `varunver_AQ`
--

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`QuestionId`, `OptionId`, `CreatedAt`) VALUES
(4, 2, '2013-06-24 19:46:17'),
(4, 4, '2013-06-24 19:46:17'),
(5, 1, '2013-06-24 19:56:53'),
(6, 3, '2013-06-29 19:49:33'),
(7, 2, '2013-06-29 19:54:38'),
(8, 1, '2013-06-29 19:58:30'),
(9, 3, '2013-06-29 20:05:59');

--
-- Dumping data for table `meta_data`
--

INSERT INTO `meta_data` (`QuestionId`, `MetaKey`, `MetaValue`, `CreatedAt`) VALUES
(4, 'tag', 'ABAP', '2013-06-24 19:46:36'),
(5, 'tag', 'ABAP', '2013-06-24 05:00:00'),
(6, 'tag', 'ABAP', '2013-06-29 19:50:34'),
(7, 'tag', 'DB', '2013-06-29 19:55:31'),
(8, 'tag', 'DDIC', '2013-06-29 19:58:55'),
(9, 'tag', 'ABAP', '2013-06-29 20:06:32');

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`QuestionId`, `OptionId`, `OptionValue`, `CreatedAt`) VALUES
(4, 1, 'End-of-selection', '2013-06-24 19:45:15'),
(4, 2, 'End-of-initialization', '2013-06-24 19:45:15'),
(4, 3, 'Get', '2013-06-24 19:45:40'),
(4, 4, 'Set', '2013-06-24 19:45:40'),
(5, 1, 'SAP-Memory', '2013-06-24 19:56:26'),
(5, 2, 'ABAP/4 Memory', '2013-06-24 19:56:26'),
(5, 3, 'Shared Memory', '2013-06-24 19:56:43'),
(6, 1, 'MESSAGE Y123', '2013-06-29 19:48:17'),
(6, 2, 'MESSAGE E123(9999).', '2013-06-29 19:48:17'),
(6, 3, 'MESSAGE ID ''AT'' TYPE ''S'' NUMBER 100', '2013-06-29 19:48:55'),
(6, 4, 'MESSAGE E123 by Fielda Fieldb', '2013-06-29 19:48:55'),
(7, 1, 'Redundant data is not returned to the resultant set', '2013-06-29 19:52:59'),
(7, 2, 'Redundant data from the outer table is included', '2013-06-29 19:52:59'),
(7, 4, 'Run time error', '2013-06-29 19:54:05'),
(7, 4, 'Redundant data from the inner table is included', '2013-06-29 19:54:05'),
(8, 1, 'Data Element', '2013-06-29 19:56:51'),
(8, 2, 'Domain', '2013-06-29 19:56:51'),
(8, 3, 'Values', '2013-06-29 19:57:35'),
(8, 4, 'Nothing', '2013-06-29 19:57:35'),
(9, 1, 'Row count of the current line', '2013-06-29 20:04:41'),
(9, 2, 'Height of the current line', '2013-06-29 20:04:41'),
(9, 3, 'Width of the current line', '2013-06-29 20:05:45'),
(9, 4, 'No of characters in the current line', '2013-06-29 20:05:45');

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`ID`, `Question`, `Level`, `ChoiceType`, `CreatedAt`) VALUES
(4, 'Which of the following is <br><u>NOT</u></b> an event in the ABAP programming language', 1, 2, '2013-06-24 19:44:14'),
(5, 'What type of memory is typically used as to save defaullt values for screen fields', 1, 1, '2013-06-24 19:56:00'),
(6, 'Select the valid customer defined message', 1, 1, '2013-06-29 19:47:30'),
(7, 'What happens when a 1 to many relationship is encountered with an inner join', 2, 1, '2013-06-29 19:51:55'),
(8, 'What must be assigned to Search Helps', 1, 1, '2013-06-29 19:56:12'),
(9, 'What is contained in variable SY-LINSZ', 2, 1, '2013-06-29 20:01:42');

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`QuizId`, `Description`, `Count`, `Level`, `QuestionIds`, `CreatedAt`) VALUES
(3, 'ABAP Basics - 1', 5, 1, '4,5,6,8', '2013-06-30 09:19:48'),
(4, 'Database Fundamentals', 5, 2, '7,9', '2013-06-30 09:21:07');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
