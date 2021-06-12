-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 12, 2021 at 05:42 PM
-- Server version: 8.0.25
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
  `cd_full_name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cd_phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cd_street_1` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cd_street_2` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cd_postcode` int DEFAULT NULL,
  `cd_city` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cd_state` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cd_log` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_data`
--

INSERT INTO `customer_data` (`cd_id`, `cd_ud_id`, `cd_full_name`, `cd_phone`, `cd_street_1`, `cd_street_2`, `cd_postcode`, `cd_city`, `cd_state`, `cd_log`) VALUES
(109, 1013, 'adam aiman bin zulkornain', '01088832827', '26 jalan perjiranan 11/18', 'bandar dato onn', 81100, 'johor bahru', 'johor', '2021-06-10 20:20:29 '),
(110, 1014, 'iskandar bin johari', '0187897871', '98 blok a-1-7', 'jalan angkasa prima', 41400, 'bandar kajang', 'selangor', NULL),
(111, 1016, 'ali bin abu', '01129879987', '13', '13', 123123, '13', '13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_data`
--

CREATE TABLE `payment_data` (
  `pd_id` int NOT NULL,
  `pd_cd_id` int DEFAULT NULL,
  `pd_rsd_id` int DEFAULT NULL,
  `pd_payment_gross` double DEFAULT NULL,
  `pd_status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pd_log` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_data`
--

INSERT INTO `payment_data` (`pd_id`, `pd_cd_id`, `pd_rsd_id`, `pd_payment_gross`, `pd_status`, `pd_log`) VALUES
(1005, 109, 1019, 115.4, 'Completed', '2021-06-10 21:25:09'),
(1006, 109, 1021, 104.8, 'Completed', '2021-06-10 22:52:22'),
(1007, 109, 1017, 104.8, 'Completed', '2021-06-10 22:57:11'),
(1008, 109, 1022, 30.6, 'Completed', '2021-06-12 04:23:09');

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
  `rsd_comment` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rsd_repair_cost` double DEFAULT NULL,
  `rsd_device_brand` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rsd_device_model` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rsd_device_color` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rsd_damage_severity` int DEFAULT NULL,
  `rsd_damage_info` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rsd_pickup_log` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rsd_log` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `repair_service_data`
--

INSERT INTO `repair_service_data` (`rsd_id`, `rsd_cd_id`, `rsd_sd_id`, `rsd_status`, `rsd_progress`, `rsd_comment`, `rsd_repair_cost`, `rsd_device_brand`, `rsd_device_model`, `rsd_device_color`, `rsd_damage_severity`, `rsd_damage_info`, `rsd_pickup_log`, `rsd_log`) VALUES
(1015, 109, 101, 1, 2, 'Repair is complete', 80, 'apple', 'macbook air', 'rose gold', 1, 'keyboard problem', '2021-06-10 20:00:00', '2021-06-10 18:42:33'),
(1017, 109, 101, 1, 2, 'Repair is complete', 80, 'asus', 'rog scar', 'white', 1, 'battery problem', '2021-06-11 14:00:00', '2021-06-10 22:57:11'),
(1018, 109, 101, 0, 0, 'No technician available', 0, 'lenovo', 'legion y730', 'black', 2, 'water spilled', '2021-06-10 20:00:00', '2021-06-10 18:51:38'),
(1019, 109, 100, 1, 2, 'Repair is complete', 90, 'microsoft', 'surface pro', 'navy blue', 1, 'speaker problem', '2021-06-14 14:00:00', '2021-06-10 21:25:09'),
(1020, 110, NULL, NULL, 0, 'Device awaiting inspection', NULL, 'sony', 'vaio', 'red', 0, 'battery problem', '2021-06-12 14:00:00', '2021-06-12 05:53:33'),
(1021, 109, 101, 1, 2, 'Repair is complete', 80, 'apple', 'homepod', 'gray', 0, 'speaker issues', '2021-06-10 20:00:00', '2021-06-10 22:52:22'),
(1022, 109, 100, 1, 1, 'Repairing', 10, 'apple', 'macbook pro 16', 'space gray', 0, 'screen scratch', '2021-06-13 14:00:00', '2021-06-12 04:23:09');

-- --------------------------------------------------------

--
-- Table structure for table `runner_data`
--

CREATE TABLE `runner_data` (
  `rd_id` int NOT NULL,
  `rd_ud_id` int DEFAULT NULL,
  `rd_full_name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rd_phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rd_plat_num` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rd_status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `runner_data`
--

INSERT INTO `runner_data` (`rd_id`, `rd_ud_id`, `rd_full_name`, `rd_phone`, `rd_plat_num`, `rd_status`) VALUES
(101, 1012, 'ahmad maslan bin wahab', '0137665182', 'JTQ 7070', 1),
(104, 1019, 'kamisan bin ahmad', '0176261546', 'JTS 1021', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff_data`
--

CREATE TABLE `staff_data` (
  `sd_id` int NOT NULL,
  `sd_ud_id` int DEFAULT NULL,
  `sd_full_name` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sd_phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sd_status` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `staff_data`
--

INSERT INTO `staff_data` (`sd_id`, `sd_ud_id`, `sd_full_name`, `sd_phone`, `sd_status`) VALUES
(100, 1001, 'ivy seroja binti ahmad', '0137665182', 1),
(101, 1011, 'sarah sofea binti hafizi', '0137665121', 1),
(102, 1018, 'arya safarina binti kugiran', '0108789871', 1),
(120, 1066, 'siti kaisarah binti parni ahmad', '0108192819', 1),
(121, 1067, 'adam aiman ', '010884287', 1);

-- --------------------------------------------------------

--
-- Table structure for table `track_data`
--

CREATE TABLE `track_data` (
  `td_id` int NOT NULL,
  `td_rsd_id` int DEFAULT NULL,
  `td_rd_id` int DEFAULT NULL,
  `td_status` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `td_log` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `track_data`
--

INSERT INTO `track_data` (`td_id`, `td_rsd_id`, `td_rd_id`, `td_status`, `td_log`) VALUES
(1016, 1015, 101, 'Picking Up', '2021-06-10 18:04:22'),
(1018, 1015, NULL, 'Paid', '2021-06-10 18:42:33'),
(1019, 1015, NULL, 'Repairing', '2021-06-10 18:42:33'),
(1020, 1015, NULL, 'Completed', '2021-06-10 18:46:48 '),
(1021, 1015, 101, 'Delivering', '2021-06-10 18:47:18'),
(1022, 1015, 101, 'Delivered', '2021-06-10 18:48:52'),
(1023, 1018, 101, 'Picking Up', '2021-06-10 18:51:30'),
(1024, 1019, 101, 'Picking Up', '2021-06-10 18:52:24'),
(1025, 1018, NULL, 'Completed', '2021-06-10 19:10:37'),
(1026, 1018, 101, 'Delivering', '2021-06-10 19:10:54'),
(1027, 1018, 101, 'Delivered', '2021-06-10 20:00:55'),
(1028, 1019, NULL, 'Paid', '2021-06-10 21:25:09'),
(1029, 1017, 101, 'Picking Up', '2021-06-10 21:26:32'),
(1030, 1017, NULL, 'Completed', '2021-06-10 21:26:50'),
(1031, 1021, NULL, 'Picking Up', '2021-06-10 22:36:52'),
(1033, 1021, NULL, 'Paid', '2021-06-10 22:52:22'),
(1034, 1021, NULL, 'Completed', '2021-06-10 22:52:47 '),
(1035, 1017, NULL, 'Paid', '2021-06-10 22:57:11'),
(1036, 1019, NULL, 'Completed', '2021-06-10 22:57:39'),
(1037, 1021, 101, 'Delivering', '2021-06-10 22:58:01'),
(1038, 1021, 101, 'Delivered', '2021-06-10 22:58:05'),
(1039, 1022, 101, 'Picking Up', '2021-06-12 03:50:59'),
(1040, 1022, NULL, 'Paid', '2021-06-12 04:23:09'),
(1041, 1017, NULL, 'Completed', '2021-06-12 04:39:56'),
(1042, 1017, 101, 'Delivering', '2021-06-12 04:40:36'),
(1043, 1020, 101, 'Picking Up', '2021-06-12 05:13:12'),
(1044, 1017, 101, 'Delivered', '2021-06-12 05:13:28'),
(1045, 1019, 101, 'Delivering', '2021-06-12 05:53:54'),
(1046, 1019, 101, 'Delivered', '2021-06-12 05:54:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_data`
--

CREATE TABLE `user_data` (
  `ud_id` int NOT NULL,
  `ud_usr` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ud_pwd` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ud_role` int DEFAULT NULL,
  `ud_email` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ud_pic` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ud_log` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ud_created` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_data`
--

INSERT INTO `user_data` (`ud_id`, `ud_usr`, `ud_pwd`, `ud_role`, `ud_email`, `ud_pic`, `ud_log`, `ud_created`) VALUES
(1001, 'seroja', '8d6e7982477080010e3bef76d9e52194', 2, NULL, NULL, '2021-06-12 03:52:53 ', '03:06:06 2021-06-07'),
(1011, 'sarah', 'ec26202651ed221cf8f993668c459d46', 2, NULL, NULL, '2021-06-12 17:01:21 ', '00:06:57 2021-06-10'),
(1012, 'maslan', '8989619c1e5f45d38f3465816b21365e', 1, NULL, NULL, '2021-06-12 05:53:22 ', '00:06:52 2021-06-10'),
(1013, 'adaman', 'd9be342ef2b9b14bc9bbedb57f0298d9', 0, NULL, '0106.jpg', '2021-06-12 06:04:24 ', '00:06:54 2021-06-10'),
(1014, 'iskandar', 'e363b1274e59f11fdf31c927a0bcf340', 0, NULL, NULL, '2021-06-10 22:10:51 ', '2021-06-10 14:02:49 '),
(1015, 'khaizuran', '21380888b3a2fc8e512e7b508206b60b', 1, NULL, NULL, '2021-06-10 22:36:48 ', '2021-06-10 22:36:48 '),
(1016, 'aliabu', '985dda5decf8fe6c3a15027efffe2375', 0, NULL, NULL, '2021-06-11 23:40:28 ', '2021-06-11 23:40:28 '),
(1017, 'kaizan', '7c2d3de5becd19231d045ca1d81f340e', 1, NULL, NULL, '2021-06-12 07:17:35 ', '2021-06-12 06:20:14 '),
(1018, 'safarina', 'd2222e5b258f09175f4c30fa56b5cebc', 2, 'scaphynx@gmail.com', NULL, '2021-06-12 06:22:27 ', '2021-06-12 06:22:27 '),
(1019, 'kamisan', '63f25830ffd9e8ba44852c30a38a0703', 1, NULL, NULL, '2021-06-12 07:17:46 ', '2021-06-12 06:24:08 '),
(1020, 'hamzah', '91d6743d296ac4f95373d4af9939007a', 1, NULL, NULL, '2021-06-12 06:25:44 ', '2021-06-12 06:25:44 '),
(1066, 'kaisarah', 'bf0c3ac47a9f381108273f7c7acc5b57', 2, 'scaphynx@gmail.com', NULL, '2021-06-12 16:12:03 ', '2021-06-12 16:11:43 '),
(1067, 'adamm', '3dcbeaadeb4d82ccf6d25b15e5fbf1fa', 2, 'adamzulkornain00@gmail.com', NULL, '2021-06-12 17:01:10 ', '2021-06-12 17:00:32 ');

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
  MODIFY `cd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `payment_data`
--
ALTER TABLE `payment_data`
  MODIFY `pd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;

--
-- AUTO_INCREMENT for table `repair_service_data`
--
ALTER TABLE `repair_service_data`
  MODIFY `rsd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1023;

--
-- AUTO_INCREMENT for table `runner_data`
--
ALTER TABLE `runner_data`
  MODIFY `rd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `staff_data`
--
ALTER TABLE `staff_data`
  MODIFY `sd_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `track_data`
--
ALTER TABLE `track_data`
  MODIFY `td_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1047;

--
-- AUTO_INCREMENT for table `user_data`
--
ALTER TABLE `user_data`
  MODIFY `ud_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1068;

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
