-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 11, 2025 at 03:32 PM
-- Server version: 10.6.21-MariaDB-cll-lve
-- PHP Version: 8.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ytshyzsw_student_dashboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `place` varchar(100) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `ifsc_code` varchar(20) NOT NULL,
  `starting_account_number` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `thumbnail_image` varchar(255) NOT NULL,
  `joining_date` date NOT NULL DEFAULT curdate(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `company_name`, `company_address`, `place`, `email_id`, `mobile_number`, `ifsc_code`, `starting_account_number`, `userid`, `ip_address`, `thumbnail_image`, `joining_date`, `created_at`) VALUES
(4, 'baroda', 'kochi', 'kerala', 'baroda@gmail.com', '9898976567', 'BAR4129', 260516, 61, '103.70.199.93', '1741611485_login.png', '2025-03-08', '2025-03-10 12:58:05'),
(10, 'coperative', 'kochi', 'kerala', 'coperate@bank.com', '9898976567', 'COP3316', 687946, 53, '103.70.199.93', '1741593341_login.png', '2025-03-08', '2025-03-10 07:55:41'),
(13, 'coperative', 'kochi', 'kerala', 'coperative@gmail.com', '9898976567', 'COP5529', 382140, 58, '103.70.199.93', '1741603099_login.png', '2025-03-08', '2025-03-10 10:38:19'),
(15, 'southinidan', 'kochi', 'kerala', 'southinidan@gmail.com', '9898976567', 'SOU8591', 478763, 59, '103.70.199.93', '1741610796_login.png', '2025-03-08', '2025-03-10 12:46:36'),
(16, 'southinidan', 'kochi', 'kerala', 'southinidan@gmail.com', '9898976567', 'SOU8880', 146090, 60, '103.70.199.93', '1741611409_login.png', '2025-03-08', '2025-03-10 12:56:49'),
(17, 'sbii', 'kochi', 'kerala', 'sbii@gmail.com', '9898976567', 'SBI3166', 712835, 62, '103.166.245.72', '1741665085_login.png', '2025-03-08', '2025-03-11 03:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `companyid` int(11) NOT NULL,
  `employee_id` varchar(50) NOT NULL,
  `employee_name` varchar(100) NOT NULL,
  `employee_address` varchar(255) NOT NULL,
  `place` varchar(100) NOT NULL,
  `mail_id` varchar(100) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `thumbnail_image` varchar(255) DEFAULT NULL,
  `joined_date` date NOT NULL,
  `designation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `companyid`, `employee_id`, `employee_name`, `employee_address`, `place`, `mail_id`, `pincode`, `mobile_number`, `thumbnail_image`, `joined_date`, `designation`) VALUES
(1, 4, 'EMP188311', 'Arun', 'kannur', 'Kerala', 'arungmail.com', '675678', '9898867666', '67cee3304d228_login.png', '2028-04-02', 'gdfgd'),
(2, 4, 'EMP90', 'nora', 'kannur', 'Kerala', 'anoragmail.com', '675678', '9898867666', '67cfb14fdfb68_login.png', '2028-04-02', 'gdfgd');

-- --------------------------------------------------------

--
-- Table structure for table `ifsc_table`
--

CREATE TABLE `ifsc_table` (
  `id` int(11) NOT NULL,
  `caption` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mds`
--

CREATE TABLE `mds` (
  `id` int(11) NOT NULL,
  `mds_id` int(11) NOT NULL,
  `companyid` int(11) NOT NULL,
  `mds_name` varchar(100) NOT NULL,
  `total_salary` decimal(10,2) NOT NULL,
  `starting_date` date NOT NULL,
  `number_of_installments` int(11) NOT NULL,
  `end_date` date NOT NULL,
  `caption` varchar(255) NOT NULL,
  `no_of_members` int(11) NOT NULL,
  `status` varchar(50) NOT NULL,
  `statusid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mds`
--

INSERT INTO `mds` (`id`, `mds_id`, `companyid`, `mds_name`, `total_salary`, `starting_date`, `number_of_installments`, `end_date`, `caption`, `no_of_members`, `status`, `statusid`) VALUES
(63, 200, 10, 'mdsssss', 7010.00, '2023-10-01', 2, '2021-05-08', 'hii', 3, 'upcoming', 1),
(65, 201, 4, 'mdsssss', 7010.00, '2023-10-01', 2, '2021-05-08', 'hii', 3, 'upcoming', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mdsmembers`
--

CREATE TABLE `mdsmembers` (
  `id` int(11) NOT NULL,
  `companyid` int(11) NOT NULL,
  `mds_id` int(11) NOT NULL,
  `memberid` int(11) NOT NULL,
  `joined_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mdsmembers`
--

INSERT INTO `mdsmembers` (`id`, `companyid`, `mds_id`, `memberid`, `joined_date`) VALUES
(13, 10, 200, 66, '2015-08-10'),
(14, 4, 201, 66, '2015-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `companyid` int(11) NOT NULL,
  `account_id` bigint(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `mobile_number` varchar(15) NOT NULL,
  `email_id` varchar(100) NOT NULL,
  `joined_date` date NOT NULL,
  `thumbnail_image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `place` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `companyid`, `account_id`, `name`, `address`, `pincode`, `mobile_number`, `email_id`, `joined_date`, `thumbnail_image`, `created_at`, `place`) VALUES
(66, 10, 687946, 'lisaa', 'aa', '678787', '9898898983', 'ddd@gmail.com', '2022-08-03', '1741601358_pic.jpg', '2025-03-10 10:09:18', 'kerala'),
(67, 10, 687947, 'colbert', 'Irinjalakuda', '678787', '6787778782', 'colbert@gmail.com', '2022-02-02', '1741605587_913245d9-85a7-4714-aeec-e4a57411845e.jpeg', '2025-03-10 10:10:58', 'tamilnadu'),
(68, 13, 382140, 'chris', 'aa', '678787', '9898898983', 'chris@gmail.com', '2022-08-03', '1741603124_pic.jpg', '2025-03-10 10:38:44', 'kerala'),
(69, 10, 687948, 'chris', 'aa', '678787', '9898898983', 'chris1@gmail.com', '2022-08-03', '1741603324_pic.jpg', '2025-03-10 10:42:04', 'kerala'),
(70, 13, 382141, 'reu', 'aa', '678787', '9898898983', 'renu@gmail.com', '2022-08-03', '1741603841_pay3.png', '2025-03-10 10:50:41', 'kerala'),
(71, 4, 260516, 'laila', 'aa', '678787', '9898898983', 'laila@gmail.com', '2022-08-03', '1741611598_pay3.png', '2025-03-10 12:59:58', 'kerala');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `companyid` int(11) NOT NULL,
  `notification_description` text NOT NULL,
  `date` date NOT NULL,
  `userid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `installment_id` int(11) NOT NULL,
  `memberid` int(11) NOT NULL,
  `companyid` int(11) NOT NULL,
  `mds_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `created_at` date NOT NULL,
  `paid_date` date NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `status_master`
--

CREATE TABLE `status_master` (
  `id` int(11) NOT NULL,
  `caption` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_master`
--

INSERT INTO `status_master` (`id`, `caption`) VALUES
(1, 'hi'),
(2, 'hello');

-- --------------------------------------------------------

--
-- Table structure for table `usertype_master`
--

CREATE TABLE `usertype_master` (
  `id` int(11) NOT NULL,
  `usertype` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `usertype_master`
--

INSERT INTO `usertype_master` (`id`, `usertype`) VALUES
(1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `userid` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `usertypeid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`userid`, `username`, `password`, `usertypeid`) VALUES
(53, 'rajiv', '$2y$10$nv4cjf1I5h6WJda4oVcnpOUHVZ7t8nsRKrNkaanW0TY/UOiR/Imty', 1),
(58, 'melisa', '$2y$10$d8js8ZZVr2pFX9uUaYaYKeo9mRRCKC9aVSQIJRHSyY2d56da7GrS6', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userid` (`userid`),
  ADD UNIQUE KEY `starting_account_number` (`starting_account_number`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`),
  ADD KEY `companyid` (`companyid`);

--
-- Indexes for table `ifsc_table`
--
ALTER TABLE `ifsc_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mds`
--
ALTER TABLE `mds`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mds_id` (`mds_id`),
  ADD KEY `companyid` (`companyid`),
  ADD KEY `fk_mds_status` (`statusid`);

--
-- Indexes for table `mdsmembers`
--
ALTER TABLE `mdsmembers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companyid` (`companyid`),
  ADD KEY `mds_id` (`mds_id`),
  ADD KEY `memberid` (`memberid`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `account_id` (`account_id`),
  ADD KEY `companyid` (`companyid`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `companyid` (`companyid`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `memberid` (`memberid`),
  ADD KEY `companyid` (`companyid`),
  ADD KEY `mds_id` (`mds_id`);

--
-- Indexes for table `status_master`
--
ALTER TABLE `status_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usertype_master`
--
ALTER TABLE `usertype_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usertype` (`usertype`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`userid`),
  ADD KEY `fk_user_usertype` (`usertypeid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `ifsc_table`
--
ALTER TABLE `ifsc_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mds`
--
ALTER TABLE `mds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `mdsmembers`
--
ALTER TABLE `mdsmembers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `status_master`
--
ALTER TABLE `status_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`companyid`) REFERENCES `company` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mds`
--
ALTER TABLE `mds`
  ADD CONSTRAINT `fk_mds_status` FOREIGN KEY (`statusid`) REFERENCES `status_master` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mds_ibfk_1` FOREIGN KEY (`companyid`) REFERENCES `company` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `mdsmembers`
--
ALTER TABLE `mdsmembers`
  ADD CONSTRAINT `fk_mdsmembers_memberid` FOREIGN KEY (`memberid`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mdsmembers_ibfk_1` FOREIGN KEY (`companyid`) REFERENCES `company` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mdsmembers_ibfk_2` FOREIGN KEY (`mds_id`) REFERENCES `mds` (`mds_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mdsmembers_ibfk_3` FOREIGN KEY (`memberid`) REFERENCES `members` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`companyid`) REFERENCES `company` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`companyid`) REFERENCES `company` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`memberid`) REFERENCES `members` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`companyid`) REFERENCES `company` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payment_ibfk_3` FOREIGN KEY (`mds_id`) REFERENCES `mds` (`mds_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_master`
--
ALTER TABLE `user_master`
  ADD CONSTRAINT `fk_user_company` FOREIGN KEY (`userid`) REFERENCES `company` (`userid`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_user_usertype` FOREIGN KEY (`usertypeid`) REFERENCES `usertype_master` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
