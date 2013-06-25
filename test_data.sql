-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 11, 2013 at 09:29 AM
-- Server version: 5.1.53-community-log
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hanu_quiz`
--

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`QuestionId`, `OptionId`, `CreatedAt`) VALUES
(1, 1, '2013-05-28 11:53:58'),
(2, 2, '2013-05-28 11:53:58'),
(3, 1, '2013-05-28 11:54:10');

--
-- Dumping data for table `meta_data`
--

INSERT INTO `meta_data` (`QuestionId`, `MetaKey`, `MetaValue`, `CreatedAt`) VALUES
(1, 'tag', 'DDIC', '2013-05-28 11:54:46'),
(2, 'tag', 'ABAP', '2013-05-28 11:54:46'),
(3, 'tag', 'ABAP', '2013-05-28 11:54:59');

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`QuestionId`, `OptionId`, `OptionValue`, `CreatedAt`) VALUES
(1, 1, 'SE11', '2013-05-28 11:51:46'),
(1, 2, 'SE55', '2013-05-28 11:51:46'),
(2, 1, 'SE11', '2013-05-28 11:52:16'),
(2, 2, 'SE38', '2013-05-28 11:52:16'),
(3, 1, 'SE37', '2013-05-28 11:52:52'),
(3, 2, 'SE38', '2013-05-28 11:52:52'),
(1, 3, 'ASE', '2013-05-28 11:53:22'),
(2, 3, '3SW', '2013-05-28 11:53:22');

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`ID`, `Question`, `Level`, `ChoiceType`, `CreatedAt`) VALUES
(1, 'What is the transaction to create DB Tables', 1, 1, '2013-05-28 11:49:23'),
(2, 'What is the transaction to create reports', 1, 1, '2013-05-28 11:49:54'),
(3, 'What is the transaction to create Function modules', 1, 1, '2013-05-28 11:50:14');

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`QuizId`, `Count`, `Level`, `QuestionIds`, `CreatedAt`) VALUES
(1, 2, 1, '1,2', '2013-06-11 09:28:02'),
(2, 2, 1, '2,3', '2013-06-11 09:28:02');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
