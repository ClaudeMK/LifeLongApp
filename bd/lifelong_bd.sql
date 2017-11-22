-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 31, 2017 at 07:03 PM
-- Server version: 10.1.24-MariaDB-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lifelong_bd_TESTING`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(11) NOT NULL,
  `formation_complete_id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `formation_complete_id`, `name`, `path`, `created`, `modified`) VALUES
(1, 7, 'test.PNG', 'Files/', '2017-10-28 17:52:09', '2017-10-28 17:52:09'),
(2, 10, 'CahierDesCharges(1).pdf', 'Files/', '2017-10-28 18:10:09', '2017-10-28 18:10:09'),
(4, 121, 'CahierDesCharges(1).pdf', 'Files/', '2017-10-31 00:00:00', '2017-10-31 00:00:00'),
(5, 120, 'iTunes.jpg', 'Files/', '2017-10-31 00:00:00', '2017-10-31 17:33:53');

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id` int(11) NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`id`, `address`) VALUES
(1, '752 Douglas ST, Victoria BC V8W3M6'),
(2, '1234 boulevard René-Levesque Est, Montréal H2C4T6'),
(3, '141 Louis-Pasteur, Ottawa (Ontario) K1N6N5');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(1, 'Health and Security'),
(2, 'Environnement'),
(3, 'Human ressources'),
(4, 'Quality');

-- --------------------------------------------------------

--
-- Table structure for table `civilities`
--

CREATE TABLE `civilities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `civilities`
--

INSERT INTO `civilities` (`id`, `title`) VALUES
(1, 'Mr.'),
(2, 'Mrs'),
(3, 'Mx');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `number` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `civilitie_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `language_id` int(11) NOT NULL,
  `cell_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `position_title_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `additional_Infos` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_sent_formation_plan` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `number`, `civilitie_id`, `last_name`, `first_name`, `language_id`, `cell_number`, `email`, `position_title_id`, `building_id`, `parent_id`, `additional_Infos`, `last_sent_formation_plan`, `active`) VALUES
(68, '7715248', '1', 'Rivol', 'Thierry', 1, '438.123.1234', 'Rivol.Thierry@hotmail.com', 13, 3, 57, '', NULL, 1),
(67, '2256183', '1', 'Papalis', 'Robert', 1, '123.123.1234', 'Papalis.Robert@hotmail.com', 2, 2, 65, '', NULL, 1),
(66, '4426152', '2', 'Mijnssen', 'Rita', 2, '438.123.1234', 'Mijnssen.Rita@hotmail.com', 1, 3, 65, '', NULL, 1),
(65, '9156485', '1', 'Menut', 'Max', 2, '438.123.1234', 'Menut.Max@hotmail.com', 7, 1, 1, '', '2017-10-31 17:18:16', 1),
(64, '4478512', '1', 'Menut', 'Eric', 1, '438.123.1234', 'Menut.Eric@hotmail.com', 9, 2, 65, '', NULL, 1),
(63, '6612455', '1', 'Martin', 'William', 1, '438.123.1234', 'Martin.William@hotmail.com', 8, 1, 65, '', NULL, 1),
(62, '9954562', '2', 'Manen', 'Nicole', 2, '514.123.1234', 'Manen.Nicole@hotmail.com', 7, 2, 65, '', NULL, 1),
(61, '3215478', '2', 'Leenhardt', 'Christine', 2, '555.111.2222', 'Leen.Christine@hotmail.com', 6, 3, 57, '', NULL, 1),
(60, '1234560', '1', 'Kirouac', 'Claude', 1, '514.123.1234', 'cl_kirouac@hotmail.com', 17, 1, 1, '', '2017-10-31 17:11:40', 1),
(69, '999999', '1', 'Test', 'Test', 2, '', 'a.lamontagne01@hotmail.com', 2, 1, 58, '', '2017-10-31 17:39:38', 1),
(59, '6259458', '2', 'Johnson', 'Lola', 2, '514.123.1234', 'Johnson.Lola@hotmail.com', 5, 2, 57, '', NULL, 1),
(57, '2342234', '2', 'Chopin', 'Françoise', 1, '438.123.1234', 'Chopin.Francoise@hotmail.com', 4, 2, 1, '', NULL, 1),
(56, '2567489', '2', 'Cabantous', 'Claire', 2, '514.123.1234', 'youcef.guerni@gmail.com', 2, 2, 57, '', '2017-10-31 15:45:34', 1),
(55, '7489380', '1', 'Barriol', 'Luc', 1, '514.123.1234', 'Barrio.Luc@hotmail.com', 1, 1, 57, '', '2017-10-31 11:40:34', 1),
(1, '0', '1', 'None', ' ', 1, NULL, '1', 1, 1, 0, NULL, NULL, 1),
(58, '987654', '1', 'Guerni', 'Youcef', 2, '514.123.1234', 'youcef.guerni@gmail.ca', 6, 2, 65, '', '2017-10-31 11:40:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `formations`
--

CREATE TABLE `formations` (
  `id` int(11) NOT NULL,
  `number` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `frequencie_id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL,
  `modalitie_id` int(11) NOT NULL,
  `duration` decimal(5,2) NOT NULL,
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `formations`
--

INSERT INTO `formations` (`id`, `number`, `title`, `categorie_id`, `frequencie_id`, `notification_id`, `modalitie_id`, `duration`, `note`) VALUES
(1, '1', 'Introduction to Occupational Health and Safety', 1, 2, 1, 1, '0.01', ''),
(2, '2', 'SIMDUT Formation', 1, 3, 1, 1, '0.01', 'Lkdfhgldkfhg'),
(3, '3', 'Office security', 1, 3, 3, 1, '0.10', ''),
(4, '4', 'Sliding, tripping, falling', 1, 4, 3, 1, '0.10', ''),
(5, '5', 'Ladders - safety procedure', 1, 3, 3, 1, '0.10', ''),
(6, '6', 'Individual protection equipment', 1, 3, 2, 1, '0.10', ''),
(7, '7', 'Electrical hazards', 1, 3, 2, 1, '0.10', ''),
(8, '8', 'Fall Protection Systems and Fall Arrest Systems', 1, 3, 3, 1, '0.00', ''),
(9, '9', 'Locking and labeling 1', 1, 3, 2, 1, '0.00', ''),
(10, '10', 'Locking and labeling 2', 1, 3, 2, 1, '0.10', ''),
(11, '11', 'Introduction to Safety for Managers', 1, 1, 1, 1, '0.10', ''),
(12, '12', 'Handling of materials and prevention of back injuries', 1, 3, 3, 1, '0.10', ''),
(13, '13', 'Due Diligence', 1, 3, 3, 1, '0.00', ''),
(21, '21', 'Violence in the Workplace-Awareness', 1, 2, 6, 1, '0.00', ''),
(15, '15', 'Entrepreneurs and Security', 1, 4, 3, 1, '0.00', ''),
(16, '16', 'Ergonomics in the office', 1, 4, 3, 1, '0.00', ''),
(17, '17', 'Annual Safety Review', 1, 2, 6, 1, '0.00', ''),
(18, '18', 'Enclosed spaces: the rudiments, part 1: risk awareness', 1, 4, 3, 1, '0.00', ''),
(19, '19', 'Enclosed spaces: the rudiments, part 2: risk management', 1, 4, 4, 1, '0.00', ''),
(20, '20', 'Enclosed spaces: the basics, part 3: working safely', 1, 4, 5, 1, '0.00', ''),
(14, '14', 'Introduction to Safety for Young Workers', 1, 1, 3, 1, '0.00', ''),
(22, '22', 'Mold Awareness', 2, 3, 4, 1, '0.00', ''),
(23, '23', 'Awareness of asbestos', 2, 3, 3, 1, '0.00', ''),
(24, '24', 'Initiation Online - Part 1', 3, 1, 2, 1, '0.00', ''),
(25, '25', 'Online Initiation - Part 2', 3, 1, 2, 1, '0.00', ''),
(26, '26', 'Initiation Online - Part 3', 3, 1, 2, 1, '0.00', ''),
(28, '28', 'Awareness of ProFac\'s Quality System - Only PWGSC USC', 4, 1, 3, 1, '0.00', ''),
(29, '29', 'General safety course on construction sites (30h ASP)', 1, 1, 4, 2, '0.00', ''),
(30, '30', 'First Aid / First Aid / CPR (2 days)', 1, 4, 4, 2, '0.00', ''),
(31, '31', 'WHMIS training', 1, 1, 6, 2, '0.00', ''),
(32, '32', 'Confined Space Work', 1, 4, 6, 2, '0.00', ''),
(33, '33', 'Use of portable fire extinguishers', 1, 4, 6, 2, '0.00', ''),
(34, '34', 'Halocabures C.S.C', 2, 5, 6, 2, '0.00', NULL),
(35, '35', 'Transportation of hazardous materials', 2, 4, 6, 2, '0.00', ''),
(36, '36', 'Manipulation of asbestos', 2, 4, 6, 2, '0.00', ''),
(37, '37', 'Awareness of Mold', 2, 5, 6, 2, '0.00', ''),
(38, '38', 'Lifting platforms (scissors)', 1, 5, 5, 2, '0.00', ''),
(39, '39', 'Nacelle with articulated or fixed arm', 1, 5, 5, 2, '0.00', ''),
(40, '40', 'Driving a forklift truck', 1, 4, 5, 2, '0.00', ''),
(41, '41', 'Electric pallet trucks', 1, 4, 5, 2, '0.00', ''),
(42, '42', 'Winches, hoists and overhead cranes', 1, 4, 5, 2, '0.00', ''),
(43, '43', 'Respiratory Protection', 1, 2, 5, 2, '0.00', ''),
(44, '44', 'Due Diligence', 1, 3, 6, 2, '0.00', ''),
(45, '45', 'Action Plan', 1, 1, 7, 2, '0.00', ''),
(46, '46', 'Fall prevention and fall arrest devices (including use and inspection of the harness)', 1, 2, 5, 3, '0.00', ''),
(47, '47', 'Accident Investigation and Analysis', 1, 7, 5, 3, '0.00', ''),
(48, '48', 'Introduction to electric arcs', 1, 3, 4, 3, '0.00', ''),
(49, '49', 'Locking Procedure and Portfolio Labeling Québec (Theoretical)', 1, 4, 4, 3, '0.00', ''),
(50, '50', 'Locking Procedure and Portfolio Labeling Québec (Practice)', 1, 2, 4, 3, '0.00', ''),
(51, '51', 'Halocarbon Management', 2, 1, 6, 3, '0.00', ''),
(52, '52', 'Management of storage systems for petroleum and related products', 2, 1, 6, 3, '0.00', ''),
(53, '53', 'Personal risk assessment', 1, 1, 4, 4, '0.00', '');

-- --------------------------------------------------------

--
-- Table structure for table `formations_positionTitles`
--

CREATE TABLE `formations_positionTitles` (
  `id` int(11) NOT NULL,
  `formation_id` int(11) NOT NULL,
  `position_title_id` int(11) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `formations_positionTitles`
--

INSERT INTO `formations_positionTitles` (`id`, `formation_id`, `position_title_id`, `status`) VALUES
(25, 7, 2, 'Obligatory'),
(24, 6, 2, 'Obligatory'),
(23, 4, 2, 'Obligatory'),
(22, 3, 2, 'Obligatory'),
(21, 1, 2, 'Obligatory'),
(26, 9, 2, 'Obligatory'),
(27, 21, 2, 'Obligatory'),
(28, 17, 2, 'Obligatory'),
(29, 1, 1, 'Obligatory'),
(30, 1, 3, 'Obligatory'),
(31, 1, 4, 'Obligatory'),
(32, 1, 5, 'Obligatory'),
(33, 1, 6, 'Obligatory'),
(34, 1, 7, 'Obligatory'),
(35, 1, 8, 'Obligatory'),
(36, 1, 9, 'Obligatory'),
(37, 1, 13, 'Obligatory'),
(38, 2, 1, 'Obligatory'),
(39, 2, 2, 'Obligatory'),
(40, 2, 3, 'Obligatory'),
(41, 2, 4, 'Obligatory'),
(42, 2, 5, 'Obligatory'),
(43, 2, 6, 'Obligatory'),
(44, 2, 7, 'Obligatory'),
(45, 2, 8, 'Obligatory'),
(46, 2, 9, 'Recommended'),
(47, 2, 13, 'Obligatory'),
(48, 3, 1, 'Obligatory'),
(49, 3, 3, 'Obligatory'),
(50, 3, 4, 'Obligatory'),
(51, 3, 5, 'Obligatory'),
(52, 3, 6, 'Obligatory'),
(53, 3, 7, 'Obligatory'),
(54, 3, 8, 'Obligatory'),
(55, 3, 9, 'Obligatory'),
(56, 3, 13, 'Obligatory'),
(57, 4, 1, 'Obligatory'),
(58, 4, 3, 'Obligatory'),
(59, 4, 4, 'Obligatory'),
(60, 4, 5, 'Obligatory'),
(61, 4, 6, 'Obligatory'),
(62, 4, 7, 'Obligatory'),
(63, 4, 8, 'Obligatory'),
(64, 4, 9, 'Obligatory'),
(65, 4, 13, 'Obligatory'),
(66, 1, 16, 'Obligatory'),
(67, 2, 16, 'Recommended'),
(68, 3, 16, 'Obligatory'),
(69, 4, 16, 'Obligatory'),
(70, 5, 9, 'Recommended'),
(71, 5, 1, 'Obligatory'),
(72, 5, 2, 'Obligatory'),
(73, 5, 3, 'Obligatory'),
(74, 5, 5, 'Obligatory'),
(75, 5, 6, 'Obligatory'),
(76, 5, 7, 'Obligatory'),
(77, 5, 8, 'Obligatory'),
(78, 5, 9, 'Obligatory'),
(79, 5, 13, 'Obligatory'),
(80, 6, 1, 'Obligatory'),
(82, 6, 3, 'Obligatory'),
(83, 6, 5, 'Obligatory'),
(84, 6, 6, 'Obligatory'),
(85, 6, 7, 'Obligatory'),
(86, 6, 8, 'Obligatory'),
(87, 6, 13, 'Obligatory'),
(88, 7, 1, 'Obligatory'),
(148, 22, 17, 'Obligatory'),
(90, 7, 3, 'Obligatory'),
(91, 7, 5, 'Obligatory'),
(92, 7, 6, 'Obligatory'),
(93, 7, 7, 'Obligatory'),
(94, 7, 8, 'Obligatory'),
(95, 7, 13, 'Obligatory'),
(96, 8, 1, 'Obligatory'),
(97, 8, 2, 'Obligatory'),
(98, 8, 3, 'Obligatory'),
(99, 8, 5, 'Obligatory'),
(100, 8, 6, 'Recommended'),
(101, 8, 7, 'Obligatory'),
(102, 8, 8, 'Obligatory'),
(103, 8, 13, 'Obligatory'),
(104, 9, 1, 'Obligatory'),
(147, 2, 17, 'Obligatory'),
(106, 9, 3, 'Obligatory'),
(107, 9, 5, 'Obligatory'),
(108, 9, 6, 'Obligatory'),
(109, 9, 7, 'Obligatory'),
(110, 9, 8, 'Obligatory'),
(111, 9, 13, 'Obligatory'),
(112, 10, 1, 'Obligatory'),
(113, 10, 2, 'Obligatory'),
(114, 10, 3, 'Obligatory'),
(115, 10, 5, 'Obligatory'),
(116, 10, 6, 'Obligatory'),
(117, 10, 7, 'Obligatory'),
(118, 10, 8, 'Obligatory'),
(119, 10, 13, 'Obligatory'),
(120, 11, 5, 'Obligatory'),
(121, 11, 2, 'Obligatory'),
(122, 11, 13, 'Obligatory'),
(123, 12, 1, 'Obligatory'),
(124, 12, 2, 'Obligatory'),
(125, 12, 3, 'Obligatory'),
(126, 12, 5, 'Obligatory'),
(127, 12, 6, 'Obligatory'),
(128, 12, 7, 'Obligatory'),
(129, 12, 8, 'Obligatory'),
(130, 12, 13, 'Obligatory'),
(131, 13, 9, 'Recommended'),
(132, 13, 1, 'Recommended'),
(133, 13, 2, 'Obligatory'),
(134, 13, 5, 'Obligatory'),
(135, 13, 13, 'Obligatory'),
(136, 13, 3, 'Obligatory'),
(137, 13, 7, 'Obligatory'),
(138, 13, 8, 'Obligatory'),
(139, 14, 3, 'Recommended'),
(140, 14, 1, 'Recommended'),
(141, 14, 7, 'Recommended'),
(142, 14, 8, 'Recommended'),
(143, 14, 6, 'Obligatory'),
(144, 14, 5, 'Obligatory'),
(145, 14, 2, 'Obligatory'),
(146, 14, 13, 'Obligatory');

-- --------------------------------------------------------

--
-- Table structure for table `formation_completes`
--

CREATE TABLE `formation_completes` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `formation_id` int(11) NOT NULL,
  `lastTime_completed` date DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `formation_completes`
--

INSERT INTO `formation_completes` (`id`, `employee_id`, `formation_id`, `lastTime_completed`, `comment`, `status`) VALUES
(54, 54, 5, NULL, NULL, 'Recommended'),
(53, 54, 2, NULL, NULL, 'Obligatory'),
(52, 54, 17, NULL, NULL, 'Obligatory'),
(51, 54, 21, NULL, NULL, 'Obligatory'),
(50, 54, 9, NULL, NULL, 'Obligatory'),
(49, 54, 1, NULL, NULL, 'Obligatory'),
(48, 54, 3, NULL, NULL, 'Obligatory'),
(47, 54, 4, NULL, NULL, 'Obligatory'),
(46, 54, 6, NULL, NULL, 'Obligatory'),
(66, 55, 6, NULL, NULL, 'Obligatory'),
(65, 55, 5, NULL, NULL, 'Recommended'),
(64, 55, 4, NULL, NULL, 'Obligatory'),
(63, 55, 3, NULL, NULL, 'Obligatory'),
(62, 55, 2, NULL, NULL, 'Obligatory'),
(61, 55, 1, NULL, NULL, 'Obligatory'),
(60, 54, 14, NULL, NULL, 'Recommended'),
(59, 54, 13, NULL, NULL, 'Recommended'),
(58, 54, 12, NULL, NULL, 'Obligatory'),
(57, 54, 11, NULL, NULL, 'Obligatory'),
(56, 54, 10, NULL, NULL, 'Obligatory'),
(55, 54, 8, NULL, NULL, 'Obligatory'),
(45, 54, 7, NULL, NULL, 'Obligatory'),
(67, 55, 7, NULL, NULL, 'Obligatory'),
(68, 55, 8, NULL, NULL, 'Obligatory'),
(69, 55, 9, NULL, NULL, 'Obligatory'),
(70, 55, 10, NULL, NULL, 'Obligatory'),
(71, 55, 12, NULL, NULL, 'Obligatory'),
(72, 55, 13, NULL, NULL, 'Recommended'),
(73, 55, 14, NULL, NULL, 'Recommended'),
(74, 56, 7, '2014-12-31', '', 'Obligatory'),
(75, 56, 6, '2016-10-31', 'Valable', 'Obligatory'),
(76, 56, 4, NULL, NULL, 'Obligatory'),
(77, 56, 3, NULL, NULL, 'Obligatory'),
(78, 56, 1, NULL, NULL, 'Obligatory'),
(79, 56, 9, NULL, NULL, 'Obligatory'),
(80, 56, 21, NULL, NULL, 'Obligatory'),
(81, 56, 17, NULL, NULL, 'Obligatory'),
(82, 56, 2, NULL, NULL, 'Obligatory'),
(83, 56, 5, NULL, NULL, 'Recommended'),
(84, 56, 8, NULL, NULL, 'Obligatory'),
(85, 56, 10, NULL, NULL, 'Obligatory'),
(86, 56, 11, NULL, NULL, 'Obligatory'),
(87, 56, 12, NULL, NULL, 'Obligatory'),
(88, 56, 13, NULL, NULL, 'Recommended'),
(89, 56, 14, NULL, NULL, 'Recommended'),
(90, 57, 1, NULL, NULL, 'Obligatory'),
(91, 57, 2, NULL, NULL, 'Obligatory'),
(92, 57, 3, NULL, NULL, 'Obligatory'),
(93, 57, 4, NULL, NULL, 'Obligatory'),
(94, 58, 1, NULL, NULL, 'Obligatory'),
(95, 58, 2, NULL, NULL, 'Obligatory'),
(96, 58, 3, NULL, NULL, 'Obligatory'),
(97, 58, 4, NULL, NULL, 'Obligatory'),
(98, 58, 5, NULL, NULL, 'Recommended'),
(99, 58, 6, NULL, NULL, 'Obligatory'),
(100, 58, 7, NULL, NULL, 'Obligatory'),
(101, 58, 8, NULL, NULL, 'Obligatory'),
(102, 58, 9, NULL, NULL, 'Obligatory'),
(103, 58, 10, NULL, NULL, 'Obligatory'),
(104, 58, 12, NULL, NULL, 'Obligatory'),
(105, 58, 14, NULL, NULL, 'Recommended'),
(106, 59, 1, NULL, NULL, 'Obligatory'),
(107, 59, 2, NULL, NULL, 'Obligatory'),
(108, 59, 3, NULL, NULL, 'Obligatory'),
(109, 59, 4, NULL, NULL, 'Obligatory'),
(110, 59, 5, NULL, NULL, 'Recommended'),
(111, 59, 6, NULL, NULL, 'Obligatory'),
(112, 59, 7, NULL, NULL, 'Obligatory'),
(113, 59, 8, NULL, NULL, 'Obligatory'),
(114, 59, 9, NULL, NULL, 'Obligatory'),
(115, 59, 10, NULL, NULL, 'Obligatory'),
(116, 59, 11, NULL, NULL, 'Obligatory'),
(117, 59, 12, NULL, NULL, 'Obligatory'),
(118, 59, 13, NULL, NULL, 'Recommended'),
(119, 59, 14, NULL, NULL, 'Recommended'),
(120, 60, 22, '2012-05-12', 'Bonjour les amis!', 'Obligatory'),
(121, 60, 2, '2017-10-10', 'un beau petit commentaire', 'Obligatory'),
(122, 61, 1, NULL, NULL, 'Obligatory'),
(123, 61, 2, NULL, NULL, 'Obligatory'),
(124, 61, 3, NULL, NULL, 'Obligatory'),
(125, 61, 4, NULL, NULL, 'Obligatory'),
(126, 61, 5, NULL, NULL, 'Recommended'),
(127, 61, 6, NULL, NULL, 'Obligatory'),
(128, 61, 7, NULL, NULL, 'Obligatory'),
(129, 61, 8, NULL, NULL, 'Obligatory'),
(130, 61, 9, NULL, NULL, 'Obligatory'),
(131, 61, 10, NULL, NULL, 'Obligatory'),
(132, 61, 12, NULL, NULL, 'Obligatory'),
(133, 61, 14, NULL, NULL, 'Recommended'),
(134, 62, 1, NULL, NULL, 'Obligatory'),
(135, 62, 2, NULL, NULL, 'Obligatory'),
(136, 62, 3, NULL, NULL, 'Obligatory'),
(137, 62, 4, NULL, NULL, 'Obligatory'),
(138, 62, 5, NULL, NULL, 'Recommended'),
(139, 62, 6, NULL, NULL, 'Obligatory'),
(140, 62, 7, NULL, NULL, 'Obligatory'),
(141, 62, 8, NULL, NULL, 'Obligatory'),
(142, 62, 9, NULL, NULL, 'Obligatory'),
(143, 62, 10, NULL, NULL, 'Obligatory'),
(144, 62, 12, NULL, NULL, 'Obligatory'),
(145, 62, 13, NULL, NULL, 'Recommended'),
(146, 62, 14, NULL, NULL, 'Recommended'),
(147, 63, 1, NULL, NULL, 'Obligatory'),
(148, 63, 2, NULL, NULL, 'Obligatory'),
(149, 63, 3, NULL, NULL, 'Obligatory'),
(150, 63, 4, NULL, NULL, 'Obligatory'),
(151, 63, 5, NULL, NULL, 'Recommended'),
(152, 63, 6, NULL, NULL, 'Obligatory'),
(153, 63, 7, NULL, NULL, 'Obligatory'),
(154, 63, 8, NULL, NULL, 'Obligatory'),
(155, 63, 9, NULL, NULL, 'Obligatory'),
(156, 63, 10, NULL, NULL, 'Obligatory'),
(157, 63, 12, NULL, NULL, 'Obligatory'),
(158, 63, 13, NULL, NULL, 'Recommended'),
(159, 63, 14, NULL, NULL, 'Recommended'),
(160, 64, 1, NULL, NULL, 'Obligatory'),
(161, 64, 2, NULL, NULL, 'Obligatory'),
(162, 64, 3, NULL, NULL, 'Obligatory'),
(163, 64, 4, NULL, NULL, 'Obligatory'),
(164, 64, 5, NULL, NULL, 'Recommended'),
(165, 64, 5, NULL, NULL, 'Recommended'),
(166, 64, 13, NULL, NULL, 'Recommended'),
(167, 65, 1, NULL, NULL, 'Obligatory'),
(168, 65, 2, NULL, NULL, 'Obligatory'),
(169, 65, 3, NULL, NULL, 'Obligatory'),
(170, 65, 4, NULL, NULL, 'Obligatory'),
(171, 65, 5, NULL, NULL, 'Recommended'),
(172, 65, 6, NULL, NULL, 'Obligatory'),
(173, 65, 7, NULL, NULL, 'Obligatory'),
(174, 65, 8, NULL, NULL, 'Obligatory'),
(175, 65, 9, NULL, NULL, 'Obligatory'),
(176, 65, 10, NULL, NULL, 'Obligatory'),
(177, 65, 12, NULL, NULL, 'Obligatory'),
(178, 65, 13, NULL, NULL, 'Recommended'),
(179, 65, 14, NULL, NULL, 'Recommended'),
(180, 66, 1, NULL, NULL, 'Obligatory'),
(181, 66, 2, NULL, NULL, 'Obligatory'),
(182, 66, 3, NULL, NULL, 'Obligatory'),
(183, 66, 4, NULL, NULL, 'Obligatory'),
(184, 66, 5, NULL, NULL, 'Recommended'),
(185, 66, 6, NULL, NULL, 'Obligatory'),
(186, 66, 7, NULL, NULL, 'Obligatory'),
(187, 66, 8, NULL, NULL, 'Obligatory'),
(188, 66, 9, NULL, NULL, 'Obligatory'),
(189, 66, 10, NULL, NULL, 'Obligatory'),
(190, 66, 12, NULL, NULL, 'Obligatory'),
(191, 66, 13, NULL, NULL, 'Recommended'),
(192, 66, 14, NULL, NULL, 'Recommended'),
(193, 67, 7, NULL, NULL, 'Obligatory'),
(194, 67, 6, NULL, NULL, 'Obligatory'),
(195, 67, 4, NULL, NULL, 'Obligatory'),
(196, 67, 3, NULL, NULL, 'Obligatory'),
(197, 67, 1, NULL, NULL, 'Obligatory'),
(198, 67, 9, NULL, NULL, 'Obligatory'),
(199, 67, 21, NULL, NULL, 'Obligatory'),
(200, 67, 17, NULL, NULL, 'Obligatory'),
(201, 67, 2, NULL, NULL, 'Obligatory'),
(202, 67, 5, NULL, NULL, 'Recommended'),
(203, 67, 8, NULL, NULL, 'Obligatory'),
(204, 67, 10, NULL, NULL, 'Obligatory'),
(205, 67, 11, NULL, NULL, 'Obligatory'),
(206, 67, 12, NULL, NULL, 'Obligatory'),
(207, 67, 13, NULL, NULL, 'Recommended'),
(208, 67, 14, NULL, NULL, 'Recommended'),
(209, 68, 1, '2017-10-01', '', 'Obligatory'),
(210, 68, 2, NULL, NULL, 'Obligatory'),
(211, 68, 3, NULL, NULL, 'Obligatory'),
(212, 68, 4, NULL, NULL, 'Obligatory'),
(213, 68, 5, NULL, NULL, 'Recommended'),
(214, 68, 6, NULL, NULL, 'Obligatory'),
(215, 68, 7, NULL, NULL, 'Obligatory'),
(216, 68, 8, NULL, NULL, 'Obligatory'),
(217, 68, 9, NULL, NULL, 'Obligatory'),
(218, 68, 10, NULL, NULL, 'Obligatory'),
(219, 68, 11, NULL, NULL, 'Obligatory'),
(220, 68, 12, NULL, NULL, 'Obligatory'),
(221, 68, 13, NULL, NULL, 'Recommended'),
(222, 68, 14, NULL, NULL, 'Recommended'),
(223, 69, 7, '2015-10-31', '', 'Obligatory'),
(224, 69, 6, '2014-10-31', '', 'Obligatory'),
(225, 69, 4, '2017-03-31', '', 'Obligatory'),
(226, 69, 3, NULL, NULL, 'Obligatory'),
(227, 69, 1, NULL, NULL, 'Obligatory'),
(228, 69, 9, NULL, NULL, 'Obligatory'),
(229, 69, 21, NULL, NULL, 'Obligatory'),
(230, 69, 17, NULL, NULL, 'Obligatory'),
(231, 69, 2, NULL, NULL, 'Obligatory'),
(232, 69, 5, NULL, NULL, 'Recommended'),
(233, 69, 8, NULL, NULL, 'Obligatory'),
(234, 69, 10, NULL, NULL, 'Obligatory'),
(235, 69, 11, NULL, NULL, 'Obligatory'),
(236, 69, 12, NULL, NULL, 'Obligatory'),
(237, 69, 13, NULL, NULL, 'Recommended'),
(238, 69, 14, NULL, NULL, 'Recommended');

-- --------------------------------------------------------

--
-- Table structure for table `frequencies`
--

CREATE TABLE `frequencies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `frequencies`
--

INSERT INTO `frequencies` (`id`, `title`) VALUES
(1, 'At hiring'),
(2, '1 year'),
(9, '1 week'),
(3, '2 years'),
(4, '3 years'),
(5, '5 years'),
(8, 'Only once'),
(6, 'N/A'),
(7, 'If needed'),
(10, '1 month'),
(11, '3 months'),
(12, '6 months'),
(13, '18 months'),
(14, '4 years');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `title`) VALUES
(1, 'French'),
(2, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `modalities`
--

CREATE TABLE `modalities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modalities`
--

INSERT INTO `modalities` (`id`, `title`) VALUES
(1, 'Online'),
(2, 'External'),
(3, 'Internal'),
(4, 'Web Dev');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`) VALUES
(1, '1 Day'),
(2, '1 week'),
(3, '1 month'),
(4, '3 months'),
(5, '6 months'),
(6, '1 year'),
(7, 'N/A'),
(8, '18 months'),
(9, '2 years'),
(10, '3 years'),
(11, '4 years'),
(12, '5 years');

-- --------------------------------------------------------

--
-- Table structure for table `position_titles`
--

CREATE TABLE `position_titles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `position_titles`
--

INSERT INTO `position_titles` (`id`, `title`) VALUES
(1, 'Building Technician'),
(2, 'Project Manager'),
(3, 'Project Coordinator'),
(4, 'Project Control Coordinator'),
(5, 'Technical Support Manager'),
(6, 'Student / Intern (Tech)'),
(7, 'Building Service Coordinator'),
(8, 'Safety Coordinator'),
(9, 'Administrative assistant'),
(16, 'Project administrator'),
(13, 'Project Team Leader'),
(17, 'Master of puppets');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`) VALUES
(1, 'admin', '$2y$10$0oMcjwKz2xWhs9FLNR/XrOoXslCpbBbzNNa1BR6pZCuBZ3XnmcQoi', 'Administrator', '2017-09-13 00:00:00', '2017-09-21 21:03:57'),
(2, 'coordo', '$2y$10$k.3ZmjlYmM5rPgzT7bHo8.GlFXsh6UmmuihDqUp3av66PSQrbUrIe', 'Coordinator', '2017-09-13 00:00:00', '2017-09-27 16:47:03'),
(6, 'XpertDocUser', '$2y$10$TRtBVa8PBXmCMjxg36S/K.tsR18b6Tzwia9Cuf4GRH1cyNzTMZ9wG', 'Coordinator', '2017-10-07 00:16:29', '2017-10-07 00:16:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formation_complete_id` (`formation_complete_id`);

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `civilities`
--
ALTER TABLE `civilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `civility_key` (`civilitie_id`),
  ADD KEY `employee_key` (`parent_id`),
  ADD KEY `position_title_key` (`position_title_id`),
  ADD KEY `language_key` (`language_id`),
  ADD KEY `building_key` (`building_id`);

--
-- Indexes for table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_key` (`categorie_id`),
  ADD KEY `frequency_key` (`frequencie_id`),
  ADD KEY `modality_key` (`modalitie_id`);

--
-- Indexes for table `formations_positionTitles`
--
ALTER TABLE `formations_positionTitles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formation_completes`
--
ALTER TABLE `formation_completes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`),
  ADD KEY `formation_id` (`formation_id`);

--
-- Indexes for table `frequencies`
--
ALTER TABLE `frequencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modalities`
--
ALTER TABLE `modalities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `position_titles`
--
ALTER TABLE `position_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1235;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `civilities`
--
ALTER TABLE `civilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
--
-- AUTO_INCREMENT for table `formations`
--
ALTER TABLE `formations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT for table `formations_positionTitles`
--
ALTER TABLE `formations_positionTitles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;
--
-- AUTO_INCREMENT for table `formation_completes`
--
ALTER TABLE `formation_completes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=239;
--
-- AUTO_INCREMENT for table `frequencies`
--
ALTER TABLE `frequencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `modalities`
--
ALTER TABLE `modalities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `position_titles`
--
ALTER TABLE `position_titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
