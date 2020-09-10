-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2020 at 01:37 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gsm`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `customer_full_name` varchar(255) NOT NULL,
  `customer_username` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `customer_country` varchar(255) NOT NULL,
  `customer_city` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer_full_name`, `customer_username`, `customer_email`, `customer_phone`, `customer_country`, `customer_city`, `customer_address`, `customer_status`, `created_at`, `updated_at`) VALUES
(1, 'Bipul Karmokar', 'bipulkarmokar', 'bipul.bogra.bd@gmail.com', '01710647026', 'Bangladesh', 'Bogra', 'Shibganj', 'Active', '2020-09-02 07:40:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `download_history`
--

CREATE TABLE `download_history` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'Anonymous' COMMENT 'Anonymous / Registered',
  `customer` int(11) DEFAULT NULL,
  `file` int(11) NOT NULL,
  `size` double(10,2) NOT NULL,
  `size_unit` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `download_history`
--

INSERT INTO `download_history` (`id`, `ip`, `user_type`, `customer`, `file`, `size`, `size_unit`, `created_at`, `updated_at`) VALUES
(1, '::1', 'Anonymous', NULL, 14, 208749.00, 'byte', '2020-09-10 21:54:56', NULL),
(2, '::1', 'Anonymous', NULL, 14, 208749.00, 'byte', '2020-09-10 23:29:07', NULL),
(3, '::1', 'Anonymous', NULL, 14, 208749.00, 'byte', '2020-09-10 23:29:26', NULL),
(4, '::1', 'Anonymous', NULL, 14, 208749.00, 'byte', '2020-09-10 23:29:36', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `device_brand` varchar(255) NOT NULL,
  `device_model` varchar(255) NOT NULL,
  `android_version` varchar(255) NOT NULL,
  `firmware_version` varchar(255) DEFAULT NULL,
  `chip_detail` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `support_tool` varchar(255) NOT NULL,
  `file_method` varchar(255) NOT NULL,
  `direct_url` varchar(512) NOT NULL,
  `file` varchar(255) NOT NULL,
  `file_size` double(10,2) NOT NULL,
  `file_size_unit` varchar(255) DEFAULT NULL,
  `is_paid` varchar(255) NOT NULL,
  `price` double(10,2) DEFAULT NULL,
  `price_unit` varchar(255) DEFAULT NULL,
  `is_featured` varchar(255) NOT NULL,
  `is_active` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `folder` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `title`, `description`, `device_brand`, `device_model`, `android_version`, `firmware_version`, `chip_detail`, `country`, `language`, `support_tool`, `file_method`, `direct_url`, `file`, `file_size`, `file_size_unit`, `is_paid`, `price`, `price_unit`, `is_featured`, `is_active`, `thumbnail`, `image`, `folder`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'test update', '', 'fbgfbg', 'fbfbf', 'fnfgbf', 'fgbf', 'fgnnfgb', 'xcvxcv', 'gnngnf', 'xdvdxvdv', 'upload', '', '', 0.00, 'Byte', 'Yes', 55.00, 'USD', 'No', 'Yes', NULL, NULL, NULL, '2020-09-07 13:59:54', '2020-09-09 19:48:04', NULL, NULL),
(2, 'edited again', '', 'bcbcfgcfb', 'ccbbxb', 'zcxvccb', 'fgbf', 'fgnnfgb', 'xcvxcv', 'gnngnf', 'xdvdxvdv', 'upload', '', '', 0.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', NULL, NULL, NULL, '2020-09-07 14:13:47', '2020-09-08 22:51:23', NULL, NULL),
(3, 'xdsxbxvx', '', 'bcbcfgcfb', 'ccbbxb', 'zcxvccb', 'fgbf', 'fgnnfgb', 'xcvxcv', 'gnngnf', 'xdvdxvdv', 'upload', '', '', 0.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', NULL, NULL, NULL, '2020-09-07 14:14:44', NULL, NULL, NULL),
(4, 'hgnfgb', '', 'bcbcfgcfb', 'ccbbxb', 'fnfgbf', 'fgbf', 'xvxv', 'xcvxcv', 'fbfgb', 'gfnfnfn', 'direct', 'sdvsdvs', '', 56.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', NULL, NULL, NULL, '2020-09-07 14:22:23', NULL, NULL, NULL),
(5, 'hgnfgb', '', 'fbgfbg', 'fbfbf', 'zcxvccb', 'vxvxv', 'xvxv', 'xcvxcv', 'gnngnf', 'xdvdxvdv', 'upload', '', '', 0.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', NULL, NULL, NULL, '2020-09-07 14:29:57', NULL, NULL, NULL),
(6, 'hgnfgb', '', 'fbgfbg', 'fbfbf', 'zcxvccb', 'vxvxv', 'xvxv', 'xcvxcv', 'gnngnf', 'xdvdxvdv', 'upload', '', '', 0.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', '', '', NULL, '2020-09-07 14:34:56', NULL, NULL, NULL),
(7, 'hgnfgb', '', 'bcbcfgcfb', 'ccbbxb', 'fnfgbf', 'fgbf', 'fgnnfgb', 'fbfgb', 'gnngnf', 'xdvdxvdv', 'upload', '', '', 0.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', '', '', NULL, '2020-09-07 14:37:04', NULL, NULL, NULL),
(8, 'hfnssdfs', '', 'bcbcfgcfb', 'ccbbxb', 'fnfgbf', 'fgbf', 'fgnnfgb', 'xcvxcv', 'gnngnf', 'gfnfnfn', 'direct', 'sdcsxx', '', 2.01, 'Byte', 'No', 0.00, '', 'No', 'Yes', '', '', NULL, '2020-09-07 14:38:37', NULL, NULL, NULL),
(9, 'hgnfgb', '', 'bcbcfgcfb', 'ccbbxb', 'zcxvccb', 'fgbf', 'fgnnfgb', 'xcvxcv', 'gnngnf', 'xdvdxvdv', 'direct', 'sdcsxx', '', 0.01, 'Byte', 'No', 0.00, '', 'No', 'Yes', '', '', NULL, '2020-09-07 14:47:04', NULL, NULL, NULL),
(10, 'hfnssdfs', '', 'fbgfbg', 'fbfbf', 'zcxvccb', 'vxvxv', 'fgnnfgb', 'fbfgb', 'gnngnf', 'xdvdxvdv', 'direct', 'sdcsxx', '', 4.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', '', '', NULL, '2020-09-07 14:48:36', NULL, NULL, NULL),
(11, 'hgnfgb', '', 'bcbcfgcfb', 'fbfbf', 'zcxvccb', 'vxvxv', 'fgnnfgb', 'xcvxcv', 'gnngnf', 'xdvdxvdv', 'direct', 'sdcsxx', '', 4.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', '', '', 1, '2020-09-07 14:52:01', NULL, NULL, NULL),
(12, 'hgnfgb', '', 'fbgfbg', 'fbfbf', 'zcxvccb', 'vxvxv', 'xvxv', 'fbfgb', 'gnngnf', 'xdvdxvdv', 'direct', 'sdcsxxkklkllkhk', '', 56.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', '', '', 2, '2020-09-07 15:07:09', '2020-09-08 23:38:06', NULL, NULL),
(13, 'xdsxbxvx', '', 'fbgfbg', 'ccbbxb', 'fnfgbf', 'fgbf', 'xvxv', 'fbfgb', 'gnngnf', 'gfnfnfn', 'upload', '', '', 0.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', '', '', NULL, '2020-09-08 15:39:32', NULL, NULL, NULL),
(14, 'hgnfgb', '', 'bcbcfgcfb', 'fbfbf', 'fnfgbf', 'vxvxv', 'xvxv', 'xcvxcv', 'xc x ', 'xdvdxvdv', 'upload', '', 'Resume-of-MD-Arman-Hossain.pdf', 0.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', '', '', NULL, '2020-09-08 15:43:27', '2020-09-10 20:17:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `file_tags`
--

CREATE TABLE `file_tags` (
  `id` int(11) NOT NULL,
  `tag` varchar(255) NOT NULL,
  `file` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `file_visitors`
--

CREATE TABLE `file_visitors` (
  `id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `file` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `file_visitors`
--

INSERT INTO `file_visitors` (`id`, `ip`, `file`, `created_at`, `updated_at`) VALUES
(1, '::1', 1, '2020-09-10 14:45:44', '2020-09-10 19:35:22'),
(2, '::1', 2, '2020-09-10 15:02:30', '2020-09-10 11:57:02'),
(4, '::1', 14, '2020-09-10 16:33:27', '2020-09-10 19:29:36');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `is_active` varchar(255) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `title`, `description`, `thumbnail`, `is_active`, `parent`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Box Setup/Program', 'Folder description', 'folder-icon-default.png', 'Yes', NULL, '2020-09-07 07:38:44', '2020-09-08 21:49:25', NULL, NULL),
(2, 'Driver', '', 'folder-icon-default.png', 'Yes', NULL, '2020-09-07 07:42:28', '2020-09-07 12:59:50', NULL, NULL),
(3, 'Tools', '', 'folder-icon-default.png', 'Yes', NULL, '2020-09-07 07:42:46', '2020-09-07 12:59:58', NULL, NULL),
(4, 'Firmware', '', 'folder-icon-default.png', 'Yes', NULL, '2020-09-07 07:42:57', '2020-09-07 13:00:03', NULL, NULL),
(5, 'EMMC Dump', '', 'folder-icon-default.png', 'Yes', NULL, '2020-09-07 07:56:17', '2020-09-07 13:00:08', NULL, NULL),
(6, 'test0', 'Folder description', 'folder-icon-default.png', 'Yes', 2, '2020-09-07 15:08:39', '2020-09-08 18:45:48', NULL, NULL),
(7, 'test2', 'Folder description', 'folder-icon-default.png', 'Yes', 2, '2020-09-07 15:09:35', '2020-09-08 19:01:16', NULL, NULL),
(8, 'test3', 'Folder description', 'folder-icon-default.png', 'Yes', 2, '2020-09-07 15:10:07', '2020-09-08 19:10:36', NULL, NULL),
(9, 'test4', '', 'folder-icon-default.png', 'Yes', 2, '2020-09-07 15:15:02', NULL, NULL, NULL),
(10, 'test5', '', 'folder-icon-default.png', 'Yes', 2, '2020-09-07 15:17:00', NULL, NULL, NULL),
(11, 'test6', '', 'folder-icon-default.png', 'Yes', 2, '2020-09-07 15:17:39', NULL, NULL, NULL),
(12, 'test7', '', 'folder-icon-default.png', 'Yes', 2, '2020-09-07 15:18:02', NULL, NULL, NULL),
(13, 'test7', '', 'folder-icon-default.png', 'Yes', 2, '2020-09-07 15:18:03', NULL, NULL, NULL),
(14, 'test7', '', 'folder-icon-default.png', 'Yes', 2, '2020-09-07 15:18:03', NULL, NULL, NULL),
(15, 'test8', '', 'folder-icon-default.png', 'Yes', 2, '2020-09-07 15:20:57', NULL, NULL, NULL),
(16, 'test8', '', 'folder-icon-default.png', 'Yes', 2, '2020-09-07 15:21:31', NULL, NULL, NULL),
(17, 'test9', '', 'folder-icon-default.png', 'Yes', 2, '2020-09-07 15:22:16', NULL, NULL, NULL),
(18, 'test10', '', 'folder-icon-default.png', 'Yes', 2, '2020-09-07 15:33:40', NULL, NULL, NULL),
(19, 'test11', '', 'folder-icon-default.png', 'Yes', 2, '2020-09-07 15:34:01', NULL, NULL, NULL),
(20, 'test12', '', 'folder-icon-default.png', 'Yes', 2, '2020-09-07 15:37:09', NULL, NULL, NULL),
(21, 'test13', '', 'folder-icon-default.png', 'Yes', 2, '2020-09-07 15:37:54', NULL, NULL, NULL),
(22, 'test14', '', 'folder-icon-default.png', 'Yes', 2, '2020-09-07 15:38:53', NULL, NULL, NULL),
(23, 'test15', '', 'folder-icon-default.png', 'Yes', 2, '2020-09-08 18:15:50', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_full_name` varchar(255) NOT NULL,
  `user_username` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_phone` varchar(255) NOT NULL,
  `user_status` varchar(255) NOT NULL DEFAULT 'Active',
  `user_role` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_full_name`, `user_username`, `user_email`, `user_phone`, `user_status`, `user_role`, `created_at`, `updated_at`) VALUES
(1, 'GSM Tech Master', 'gtm', 'gsmtechmaster@gmail.com', '01751986091', 'Active', 1, '2020-09-01 14:10:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `role_status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role_name`, `role_status`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'Active', '2020-09-01 14:05:08', NULL),
(2, 'Admin', 'Active', '2020-09-01 14:05:08', NULL),
(3, 'File Controller', 'Active', '2020-09-01 14:05:40', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `download_history`
--
ALTER TABLE `download_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file` (`file`),
  ADD KEY `download_history_ibfk_1` (`customer`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folder` (`folder`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `file_tags`
--
ALTER TABLE `file_tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file` (`file`);

--
-- Indexes for table `file_visitors`
--
ALTER TABLE `file_visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `file` (`file`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `folders_ibfk_1` (`created_by`),
  ADD KEY `folders_ibfk_2` (`updated_by`),
  ADD KEY `folders_ibfk_3` (`parent`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_role` (`user_role`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `download_history`
--
ALTER TABLE `download_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `file_tags`
--
ALTER TABLE `file_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_visitors`
--
ALTER TABLE `file_visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `download_history`
--
ALTER TABLE `download_history`
  ADD CONSTRAINT `download_history_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `download_history_ibfk_2` FOREIGN KEY (`file`) REFERENCES `files` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`folder`) REFERENCES `folders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `files_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `files_ibfk_3` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `file_tags`
--
ALTER TABLE `file_tags`
  ADD CONSTRAINT `file_tags_ibfk_1` FOREIGN KEY (`file`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `file_visitors`
--
ALTER TABLE `file_visitors`
  ADD CONSTRAINT `file_visitors_ibfk_1` FOREIGN KEY (`file`) REFERENCES `files` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `folders`
--
ALTER TABLE `folders`
  ADD CONSTRAINT `folders_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `folders_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `folders_ibfk_3` FOREIGN KEY (`parent`) REFERENCES `folders` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_role`) REFERENCES `user_roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
