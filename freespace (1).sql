-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 05, 2026 at 09:58 AM
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
-- Database: `freespace`
--

-- --------------------------------------------------------

--
-- Table structure for table `regdata`
--

CREATE TABLE `regdata` (
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `regdata`
--

INSERT INTO `regdata` (`name`, `email`, `password`) VALUES
('Ritesh Singh', 'ritesh1@mightcode.com', '123456'),
('Akash', 'akash@mightcode.com', '123456'),
('Deepali', 'deepali@mightcode.com', '123456'),
('Ritesh Singh', 'ritesh@mightcode.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `updfiles`
--

CREATE TABLE `updfiles` (
  `email` varchar(30) DEFAULT NULL,
  `filepath` varchar(200) DEFAULT NULL,
  `size` varchar(20) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `filetype` varchar(255) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `updfiles`
--

INSERT INTO `updfiles` (`email`, `filepath`, `size`, `date`, `filetype`, `id`) VALUES
('deepali@mightcode.com', 'uploaded data/Aadhar1 (1).png', '103783', '2025-10-15', 'image', 2),
('deepali@mightcode.com', 'uploaded data/Aadhar1 (1).png', '103783', '2025-10-15', 'image', 3),
('ritesh@mightcode.com', 'uploaded data/Ritesh_Singh_Resume.pdf', '122885', '2026-01-05', 'pdf', 45),
('ritesh@mightcode.com', 'uploaded data/Screenshot at 15-20-39.png', '235999', '2025-10-25', 'image', 43),
('ritesh@mightcode.com', 'uploaded data/1762966698575.jpg', '1802041', '2025-12-16', 'image', 44),
('deepali@mightcode.com', 'uploaded data/HP_logo_2025.svg.png', '53365', '2025-10-15', 'image', 22),
('deepali@mightcode.com', 'uploaded data/RPO_BU001_RPO_25-26_00027.pdf', '51065', '2025-10-15', 'image', 23),
('deepali@mightcode.com', 'uploaded data/Screencastfrom08-10-2512_03_04PMIST.webm', '1599118', '2025-10-15', 'video', 24),
('deepali@mightcode.com', 'uploaded data/Screencastfrom08-10-2512_03_04PMIST.webm', '1599118', '2025-10-15', 'video', 25),
('deepali@mightcode.com', 'uploaded data/Screencastfrom08-10-2512_03_04PMIST.webm', '1599118', '2025-10-15', 'video', 26),
('deepali@mightcode.com', 'uploaded data/Screencastfrom08-10-2512_03_04PMIST.webm', '1599118', '2025-10-15', 'video', 27),
('deepali@mightcode.com', 'uploaded data/Screencastfrom08-10-2512_03_04PMIST.webm', '1599118', '2025-10-15', 'video', 28);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `regdata`
--
ALTER TABLE `regdata`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `updfiles`
--
ALTER TABLE `updfiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `updfiles`
--
ALTER TABLE `updfiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
