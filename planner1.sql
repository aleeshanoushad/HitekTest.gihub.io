-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 10, 2022 at 12:05 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `planner1`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE `equipments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`id`, `name`) VALUES
(1, 'M0871-JAD-SI01-1F-ELEC-BPP-001, BOOSTER PUMP PANEL-01, 1F-MEP Room-1st Floor'),
(2, 'M0871-JAD-SI01-1F-ELEC-CTL-001, CIRCULATION PUMP PANEL-02, 1F-MEP Room-1st Floo'),
(3, 'M0871-JAD-SI01-1F-ELEC-DIB-001, SPO-L01-DB-LP1-01, 1F-ELECTRICAL Room-1st Floor'),
(4, 'M0871-JAD-SI01-1F-ELEC-DIB-002, SPO-L01-DB-PP1-01, 1F-ELECTRICAL Room-1st Floor'),
(5, 'M0871-JAD-SI01-1F-ELEC-DIB-007, SPO-L01-DB-MP, 1F-MULTI PURPOSE Room-1st Floor'),
(6, 'M0871-JAD-SI01-1F-ELEC-DIB-008, SPO-L01-DB-MEP, 1F-MEP Room-1st Floor'),
(7, 'M0871-JAD-SI01-1F-ELEC-MCC-001, SPO-L01-MCC-01, 1F-MEP Room-1st Floor'),
(8, 'M0871-JAD-SI01-1F-ELEC-MCC-002, SPO-L01-MCC-02, 1F-MEP Room-1st Floor'),
(9, 'M0871-JAD-SI01-1F-ELEC-MCC-003, SPO-L01-EMCC-01, 1F-MEP Room-1st Floor'),
(10, 'M0871-JAD-SI01-1F-ELEC-SMDB-002, SPO-L01-SMDB-03, 1F-ELECTRICAL Room-1st Floor'),
(11, 'M0871-JAD-SI01-1F-HVAC-AHU-002, AHU- SPO-FF-02, 1F-MEP Room-1st Floor'),
(12, 'M0871-JAD-SI01-1F-HVAC-AHU-003, AHU- SPO-FF-03, 1F-MEP Room-1st Floor'),
(13, 'M0871-JAD-SI01-1F-HVAC-CWPS-001, CIRCULATION PUMP-1, 1F-MEP Room-1st Floor');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_shift_mapping`
--

CREATE TABLE `equipment_shift_mapping` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shift_id` smallint(5) UNSIGNED NOT NULL DEFAULT '0',
  `equipment_id` bigint(20) NOT NULL,
  `value` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `equipment_shift_mapping`
--

INSERT INTO `equipment_shift_mapping` (`id`, `shift_id`, `equipment_id`, `value`) VALUES
(1, 26, 1, 'Y'),
(2, 26, 2, 'Y'),
(3, 12, 3, '3M'),
(4, 25, 3, '6M'),
(5, 12, 4, '3M'),
(6, 25, 4, '6M'),
(7, 12, 5, '3M'),
(8, 25, 5, '6M'),
(9, 12, 6, '3M'),
(10, 25, 6, '6M'),
(11, 14, 7, '3M'),
(12, 26, 7, 'Y'),
(13, 14, 8, '3M'),
(14, 26, 8, 'Y'),
(15, 14, 9, '3M'),
(16, 26, 9, 'Y'),
(17, 10, 10, '3M'),
(18, 23, 10, '3M'),
(19, 36, 10, '3M'),
(20, 4, 11, 'M'),
(21, 8, 11, 'M'),
(22, 13, 11, '3M'),
(23, 17, 11, 'M'),
(24, 21, 11, 'M'),
(25, 25, 11, 'Y'),
(26, 30, 11, 'M'),
(27, 34, 11, 'M'),
(28, 4, 12, 'M'),
(29, 8, 12, 'M'),
(30, 13, 12, '3M'),
(31, 17, 12, 'M'),
(32, 21, 12, 'M'),
(33, 25, 12, 'Y'),
(34, 30, 12, 'M'),
(35, 34, 12, 'M'),
(36, 13, 13, '3M'),
(37, 25, 13, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shift_period` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `shift_period`) VALUES
(1, '2021-09-25'),
(2, '2021-09-25'),
(3, '2021-09-25'),
(4, '2021-09-25'),
(5, '2021-10-23'),
(6, '2021-10-23'),
(7, '2021-10-23'),
(8, '2021-10-23'),
(9, '2021-11-20'),
(10, '2021-11-20'),
(11, '2021-11-20'),
(12, '2021-11-20'),
(13, '2021-12-18'),
(14, '2021-12-18'),
(15, '2021-12-18'),
(16, '2021-12-18'),
(17, '2022-01-15'),
(18, '2022-01-15'),
(19, '2022-01-15'),
(20, '2022-01-15'),
(21, '2022-02-12'),
(22, '2022-02-12'),
(23, '2022-02-12'),
(24, '2022-02-12'),
(25, '2022-03-12'),
(26, '2022-03-12'),
(27, '2022-03-12'),
(28, '2022-03-12'),
(29, '2022-04-09'),
(30, '2022-04-09'),
(31, '2022-04-09'),
(32, '2022-04-09'),
(33, '2022-05-07'),
(34, '2022-05-07'),
(35, '2022-05-07'),
(36, '2022-05-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `equipment_shift_mapping`
--
ALTER TABLE `equipment_shift_mapping`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `equipment_shift_mapping_idx_equipment_id` (`equipment_id`),
  ADD KEY `equipment_shift_mapping_idx_shift_id` (`shift_id`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `equipment_shift_mapping`
--
ALTER TABLE `equipment_shift_mapping`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
