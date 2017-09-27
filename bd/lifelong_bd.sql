-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 13, 2017 at 03:38 PM
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
-- Database: `lifelong_bd`
--

-- --------------------------------------------------------
CREATE TABLE `start_notifications` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


ALTER TABLE `start_notifications`
  ADD PRIMARY KEY (`id`);
 
ALTER TABLE `start_notifications`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `start_notifications`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;


--
-- Table structure for table `buildings`
--

CREATE TABLE `buildings` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`) VALUES
(53, 'Santé et sécurité'),
(54, 'Environnement'),
(55, 'Ressources humaines'),
(56, 'Qualité');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `number` varchar(10) NOT NULL,
  `civility` varchar(20) NOT NULL,
  `last_Name` varchar(255) NOT NULL,
  `first_Name` varchar(255) NOT NULL,
  `language_id` int(11) NOT NULL,
  `cell_Number` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `position_title_id` int(11) NOT NULL,
  `building_id` int(11) NOT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `additional_Infos` varchar(255) DEFAULT NULL,
  `last_sent_formation_plan` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `formations`
--

CREATE TABLE `formations` (
  `id` int(11) NOT NULL,
  `number` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL,
  `frequency_id` int(11) NOT NULL,
  `start_notification_id` int(11) NOT NULL,
  `modality_id` int(11) NOT NULL,
  `duration` decimal(5,2) NOT NULL,
  `note` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `frequencies`
--

CREATE TABLE `frequencies` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `modalities`
--

CREATE TABLE `modalities` (
  `id` int(11) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modalities`
--

INSERT INTO `modalities` (`id`, `title`) VALUES
(11, 'En ligne'),
(12, 'Externe'),
(13, 'Interne'),
(14, 'Dev Web');

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
(1, 'Technicien en bâtiment'),
(2, 'Administrateur de projet'),
(3, 'Coodonnateur de projet'),
(4, 'Coordonnatrice contrôle des projets'),
(5, 'Gestionnaire support technique'),
(6, 'Etudiant / Stagiaire (Tech)'),
(7, 'Coordonateur service à l\'immeuble'),
(8, 'Coordonnateur santé sécurité'),
(9, 'Adjointe administrative'),
(10, 'Coordonateur service à l\'immeuble'),
(11, 'Technicien en bâtiment'),
(12, 'Gestionnaire de projet'),
(13, 'Gestionnaire d\'équipe de projet');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created`, `modified`) VALUES
(1, 'admin', 'Pa$$word', 'admin', '2017-09-13 00:00:00', NULL),
(2, 'coordonateur', 'Pa$$word', 'coord', '2017-09-13 00:00:00', NULL);

--
-- Indexes for dumped tables
--

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
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emplyee_key` (`emplyee_id`),
  ADD KEY `position_title_key` (`position_title_id`),
  ADD KEY `language_key` (`language_id`),
  ADD KEY `building_key` (`building_id`);

--
-- Indexes for table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_key` (`category_id`),
  ADD KEY `frequency_key` (`frequency_id`),
  ADD KEY `start_notification_key` (`start_notification_id`),
  ADD KEY `modality_key` (`modality_id`);

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
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `formations`
--
ALTER TABLE `formations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `frequencies`
--
ALTER TABLE `frequencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `modalities`
--
ALTER TABLE `modalities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `position_titles`
--
ALTER TABLE `position_titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
