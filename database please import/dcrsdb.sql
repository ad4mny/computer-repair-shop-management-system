-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 27, 2021 at 06:01 PM
-- Server version: 8.0.23
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dcrsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_data`
--

CREATE TABLE `customer_data` (
  `cd_id` int NOT NULL,
  `cd_ud_id` int DEFAULT NULL,
  `cd_full_name` varchar(80) DEFAULT NULL,
  `cd_phone` varchar(15) DEFAULT NULL,
  `cd_street_1` varchar(50) DEFAULT NULL,
  `cd_street_2` varchar(50) DEFAULT NULL,
  `cd_postcode` int DEFAULT NULL,
  `cd_city` varchar(20) DEFAULT NULL,
  `cd_state` varchar(20) DEFAULT NULL,
  `cd_log` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `customer_data`
--

INSERT INTO `customer_data` (`cd_id`, `cd_ud_id`, `cd_full_name`, `cd_phone`, `cd_street_1`, `cd_street_2`, `cd_postcode`, `cd_city`, `cd_state`, `cd_log`) VALUES
(2, 1, 'adam aiman bin zulkornain', '0108884285', 'no 26 jalan perjiranan 11/18', 'bandar dato onn', 81100, 'johor bahru', 'johor', '04:05:49 2021-05-27'),
(3, 7, 'siti noormaimunah binti syed hadi', '0197274670', 'no 5 lorong jalan tegak', 'kampung baru', 41020, 'wilayah persekutuan', 'kuala lumpur', '11:05:54 2021-05-26'),
(4, 10, 'mazliana', '0108884287', 'b4 unit 304 ', 'pangkalan tldm', 32100, 'lumut', 'perak', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_data`
--

CREATE TABLE `payment_data` (
  `pd_id` int NOT NULL,
  `pd_cd_id` int DEFAULT NULL,
  `pd_rsd_id` int DEFAULT NULL,
  `pd_payment_gross` double DEFAULT NULL,
  `pd_status` varchar(50) DEFAULT NULL,
  `pd_log` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment_data`
--

INSERT INTO `payment_data` (`pd_id`, `pd_cd_id`, `pd_rsd_id`, `pd_payment_gross`, `pd_status`, `pd_log`) VALUES
(23, 2, 13, 686, 'Completed', '04:05:08 2021-05-21'),
(24, 2, 14, 1640, 'Completed', '03:05:08 2021-05-26'),
(25, 2, 19, 50, 'Completed', '10:05:46 2021-05-27'),
(27, 2, 22, 410.4, 'Completed', '02:05:42 2021-05-27'),
(29, 3, 16, 285, 'Completed', '05:05:46 2021-05-27'),
(30, 3, 21, 2733.6, 'Completed', '05:05:28 2021-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `repair_service_data`
--

CREATE TABLE `repair_service_data` (
  `rsd_id` int NOT NULL,
  `rsd_cd_id` int DEFAULT NULL,
  `rsd_sd_id` int DEFAULT NULL,
  `rsd_status` int DEFAULT NULL,
  `rsd_progress` int DEFAULT NULL,
  `rsd_comment` varchar(500) DEFAULT NULL,
  `rsd_repair_cost` double DEFAULT NULL,
  `rsd_device_brand` varchar(20) DEFAULT NULL,
  `rsd_device_model` varchar(20) DEFAULT NULL,
  `rsd_device_color` varchar(20) DEFAULT NULL,
  `rsd_damage_severity` int DEFAULT NULL,
  `rsd_damage_info` varchar(100) DEFAULT NULL,
  `rsd_log` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `repair_service_data`
--

INSERT INTO `repair_service_data` (`rsd_id`, `rsd_cd_id`, `rsd_sd_id`, `rsd_status`, `rsd_progress`, `rsd_comment`, `rsd_repair_cost`, `rsd_device_brand`, `rsd_device_model`, `rsd_device_color`, `rsd_damage_severity`, `rsd_damage_info`, `rsd_log`) VALUES
(11, 2, 1, 1, 2, 'Repair has been completed', 600, 'apple', 'macbook air 2021', 'silver', 0, 'battery replacement', '04:05:08 2021-05-25'),
(12, 2, 2, 0, 0, 'No technician available', 0, 'acer', 'aspire 5', 'brown', 0, 'keyboard problem', NULL),
(13, 2, 1, 1, 1, 'Repairing', 600, 'lenovo', 'legion y520', 'black', 2, 'Battery Replacement', '04:05:08 2021-05-25'),
(14, 2, 1, 1, 2, 'Repair is complete', 1500, 'xiaomi', 'mattebook', 'white', 2, 'Motherboard problem', '03:05:08 2021-05-26'),
(16, 3, 2, 1, 1, 'Repairing', 250, 'acer', 'nitro 5', 'black', 0, 'battery replacement', '05:05:46 2021-05-27'),
(18, 3, NULL, NULL, 0, NULL, NULL, 'acer', 'aspire 5', 'black', 2, 'motherboard problem', NULL),
(19, 2, 3, 0, 1, 'Repairing', NULL, 'apple', 'imac pro', 'pink', 2, 'screen replacement', '10:05:46 2021-05-27'),
(21, 3, 3, 1, 2, 'Repair is complete', 2560, 'apple', 'macbook pro 2011', 'space grey', 1, 'screen replacement', '05:05:28 2021-05-27'),
(22, 2, 3, 1, 1, 'Repairing', 340, '1M4U', 'Notebook malaysia', 'black', 2, 'motherboard problem', '02:05:42 2021-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `runner_data`
--

CREATE TABLE `runner_data` (
  `rd_id` int NOT NULL,
  `rd_ud_id` int DEFAULT NULL,
  `rd_full_name` varchar(80) DEFAULT NULL,
  `rd_phone` varchar(15) DEFAULT NULL,
  `rd_plat_num` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `runner_data`
--

INSERT INTO `runner_data` (`rd_id`, `rd_ud_id`, `rd_full_name`, `rd_phone`, `rd_plat_num`) VALUES
(1, 9, 'ahmad mamat bin malek', '0108884287', 'NDA 900'),
(2, 33, 'ismail bin mail', '0109898761', 'jsf 7009');

-- --------------------------------------------------------

--
-- Table structure for table `staff_data`
--

CREATE TABLE `staff_data` (
  `sd_id` int NOT NULL,
  `sd_ud_id` int DEFAULT NULL,
  `sd_full_name` varchar(80) DEFAULT NULL,
  `sd_phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `staff_data`
--

INSERT INTO `staff_data` (`sd_id`, `sd_ud_id`, `sd_full_name`, `sd_phone`) VALUES
(1, 8, 'abu bin bakar ali', '0137867819'),
(2, 31, 'sarah najwa binti adam', '010882912'),
(3, 32, 'ivy seroja binti adam ', '01928811231');

-- --------------------------------------------------------

--
-- Table structure for table `track_data`
--

CREATE TABLE `track_data` (
  `td_id` int NOT NULL,
  `td_rsd_id` int DEFAULT NULL,
  `td_rd_id` int DEFAULT NULL,
  `td_status` varchar(20) DEFAULT NULL,
  `td_log` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `track_data`
--

INSERT INTO `track_data` (`td_id`, `td_rsd_id`, `td_rd_id`, `td_status`, `td_log`) VALUES
(7, 11, NULL, 'Paid', '04:05:08 2021-05-26'),
(8, 11, 1, 'Completed', '10:14:59 2021-05-28'),
(9, 11, 1, 'Delivering', '17:33:29 2021-05-28'),
(10, 11, 1, 'Delivered', '17:33:29 2021-05-29'),
(18, 13, NULL, 'Paid', '04:05:08 2021-05-26'),
(19, 13, 1, 'Completed', '10:14:59 2021-05-28'),
(20, 13, 1, 'Delivering', '17:33:29 2021-05-28'),
(21, 14, NULL, 'Paid', '03:05:08 2021-05-26'),
(22, 13, 1, 'Delivered', '17:33:29 2021-05-29'),
(23, 19, NULL, 'Paid', '10:05:46 2021-05-27'),
(25, 22, NULL, 'Paid', '02:05:42 2021-05-27'),
(27, 16, NULL, 'Paid', '05:05:46 2021-05-27'),
(28, 16, NULL, 'Repairing', '05:05:46 2021-05-27'),
(29, 21, NULL, 'Paid', '05:05:28 2021-05-27'),
(30, 21, NULL, 'Repairing', '05:05:28 2021-05-27'),
(31, 21, NULL, 'Completed', '01:05:51 2021-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `ud_id` int NOT NULL,
  `ud_usr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ud_pwd` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ud_role` int DEFAULT NULL,
  `ud_log` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ud_created` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`ud_id`, `ud_usr`, `ud_pwd`, `ud_role`, `ud_log`, `ud_created`) VALUES
(1, 'adamny', '132c9256f087c8c267a30a22a7fa5356', 0, '01:05:20 2021-05-28', '09:05:42 2021-05-19'),
(7, 'siti', 'db04eb4b07e0aaf8d1d477ae342bdff9', 0, '01:05:00 2021-05-28', '06:05:02 2021-05-21'),
(8, 'abu', '132c9256f087c8c267a30a22a7fa5356', 2, '04:05:46 2021-05-27', '06:05:02 2021-05-20'),
(9, 'mamat', '132c9256f087c8c267a30a22a7fa5356', 1, '06:05:02 2021-05-20', '06:05:02 2021-05-20'),
(10, 'mazliana', 'b93cc4d98183a6d942de3e0a6ab91e4c', 0, '11:05:21 2021-05-26', '11:05:21 2021-05-26'),
(31, 'sarah', 'cd3a77622ef59e64711dfd05f1a263a6', 2, '05:05:42 2021-05-27', '11:05:21 2021-05-26'),
(32, 'seroja', '8d6e7982477080010e3bef76d9e52194', 2, '01:05:47 2021-05-28', '11:05:23 2021-05-26'),
(33, 'ismail', 'b3c55a02882e9050dcd4a6739d4a288c', 1, '05:05:38 2021-05-26', '05:05:25 2021-05-26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_data`
--
ALTER TABLE `customer_data`
  ADD PRIMARY KEY (`cd_id`),
  ADD KEY `cd_ud_id` (`cd_ud_id`);

--
-- Indexes for table `payment_data`
--
ALTER TABLE `payment_data`
  ADD PRIMARY KEY (`pd_id`),
  ADD KEY `payment_data_ibfk_1` (`pd_cd_id`),
  ADD KEY `pd_rsd_id` (`pd_rsd_id`);

--
-- Indexes for table `repair_service_data`
--
ALTER TABLE `repair_service_data`
  ADD PRIMARY KEY (`rsd_id`),
  ADD KEY `rsd_cd_id` (`rsd_cd_id`),
  ADD KEY `rsd_sd_id` (`rsd_sd_id`);

--
-- Indexes for table `runner_data`
--
ALTER TABLE `runner_data`
  ADD PRIMARY KEY (`rd_id`),
  ADD KEY `rd_ud_id` (`rd_ud_id`);

--
-- Indexes for table `staff_data`
--
ALTER TABLE `staff_data`
  ADD PRIMARY KEY (`sd_id`),
  ADD KEY `sd_ud_id` (`sd_ud_id`);

--
-- Indexes for table `track_data`
--
ALTER TABLE `track_data`
  ADD PRIMARY KEY (`td_id`),
  ADD KEY `td_rd_id` (`td_rd_id`),
  ADD KEY `td_rsd_id` (`td_rsd_id`);

--
-- Indexes for table `user_data`
--
ALTER TABLE `user_data`
  ADD PRIMARY KEY (`ud_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_data`
--
ALTER TABLE `customer_data`
  MODIFY `cd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `payment_data`
--
ALTER TABLE `payment_data`
  MODIFY `pd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `repair_service_data`
--
ALTER TABLE `repair_service_data`
  MODIFY `rsd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `runner_data`
--
ALTER TABLE `runner_data`
  MODIFY `rd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `staff_data`
--
ALTER TABLE `staff_data`
  MODIFY `sd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `track_data`
--
ALTER TABLE `track_data`
  MODIFY `td_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `ud_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_data`
--
ALTER TABLE `customer_data`
  ADD CONSTRAINT `customer_data_ibfk_1` FOREIGN KEY (`cd_ud_id`) REFERENCES `user_data` (`ud_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_data`
--
ALTER TABLE `payment_data`
  ADD CONSTRAINT `payment_data_ibfk_1` FOREIGN KEY (`pd_cd_id`) REFERENCES `customer_data` (`cd_id`),
  ADD CONSTRAINT `payment_data_ibfk_2` FOREIGN KEY (`pd_rsd_id`) REFERENCES `repair_service_data` (`rsd_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `repair_service_data`
--
ALTER TABLE `repair_service_data`
  ADD CONSTRAINT `repair_service_data_ibfk_1` FOREIGN KEY (`rsd_cd_id`) REFERENCES `customer_data` (`cd_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `repair_service_data_ibfk_2` FOREIGN KEY (`rsd_sd_id`) REFERENCES `staff_data` (`sd_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `runner_data`
--
ALTER TABLE `runner_data`
  ADD CONSTRAINT `runner_data_ibfk_1` FOREIGN KEY (`rd_ud_id`) REFERENCES `user_data` (`ud_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff_data`
--
ALTER TABLE `staff_data`
  ADD CONSTRAINT `staff_data_ibfk_1` FOREIGN KEY (`sd_ud_id`) REFERENCES `user_data` (`ud_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `track_data`
--
ALTER TABLE `track_data`
  ADD CONSTRAINT `track_data_ibfk_2` FOREIGN KEY (`td_rd_id`) REFERENCES `runner_data` (`rd_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `track_data_ibfk_3` FOREIGN KEY (`td_rsd_id`) REFERENCES `repair_service_data` (`rsd_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
