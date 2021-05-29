-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 29, 2021 at 11:02 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `ud_id` int NOT NULL,
  `ud_usr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ud_pwd` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ud_role` int DEFAULT NULL,
  `ud_pic` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ud_log` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ud_created` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `cd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `payment_data`
--
ALTER TABLE `payment_data`
  MODIFY `pd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT for table `repair_service_data`
--
ALTER TABLE `repair_service_data`
  MODIFY `rsd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT for table `runner_data`
--
ALTER TABLE `runner_data`
  MODIFY `rd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `staff_data`
--
ALTER TABLE `staff_data`
  MODIFY `sd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `track_data`
--
ALTER TABLE `track_data`
  MODIFY `td_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `ud_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000;

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
