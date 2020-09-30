-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2020 at 12:06 AM
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
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `brief` varchar(255) NOT NULL,
  `body_text` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `is_published` varchar(255) NOT NULL DEFAULT 'No',
  `published_date` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `image`, `brief`, `body_text`, `tags`, `is_published`, `published_date`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'Test', '', 'Test Brief', '<h3>This is the body text</h3>', 'test,announcement', 'Yes', '2020-09-15 08:04:17', '2020-09-15 08:04:17', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` varchar(255) NOT NULL DEFAULT 'No',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `zip_code` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `token` text DEFAULT NULL,
  `is_active` varchar(20) NOT NULL DEFAULT 'Yes',
  `ip` varchar(255) DEFAULT NULL,
  `login_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `username`, `email`, `phone`, `country`, `city`, `address`, `zip_code`, `image`, `password`, `token`, `is_active`, `ip`, `login_at`, `created_at`, `updated_at`) VALUES
(1, 'Bipul Karmokar', 'bipulkarmokar', 'bipul.bogra.bd@gmail.com', '01710647026', 'Bangladesh', 'Bogra', 'Shibganj', NULL, NULL, '', NULL, 'Yes', '', NULL, '2020-09-02 07:40:33', '2020-09-21 19:47:58'),
(2, 'Fahimul Islam', 'fahim', 'fahimulislam93@gmail.com', '01812733305', 'BD', 'Dhaka', '15/2/A', '1215', 'uploads/customers/16251620_1217232858397023_933375537393403556_o.jpg', '$2y$10$el8oH1jyV/Bzj31cH9Bjj.rdrKRgz7ZTwFfbSTaMngC45gLB9pIuy', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2MDExMjg0MTksIm5iZiI6MTYwMTEyODQxOSwiZXhwIjoxNjAxMjE0ODE5LCJhdWQiOiJteWN1c3RvbWVycyIsImRhdGEiOnsiaWQiOjIsIm5hbWUiOiJGYWhpbXVsIElzbGFtIiwiZW1haWwiOiJmYWhpbXVsaXNsYW05M0BnbWFpbC5jb20ifX0.llxBnBRsBumRaoCt07Ji8cnzyp3D96Kl7I99fEF35n7t-cJqtDlpQeoaj4QUFHkUT_Dk5VPlqwwY72te_YwQ_Q', 'Yes', '::1', '2020-09-26 09:53:39', '2020-09-21 09:44:50', '2020-09-26 13:53:39'),
(8, 'M.I. sujon', 'sujon', 'sujon@gmail.com', '01812345678', '19', 'Dhaka', '15/2/A', '1215', NULL, '$2y$10$LoCgkISF6HPqDunpOZsnnefV6b47NIDhVW9Poo.FjdsE0ipIf0AHO', NULL, 'Yes', NULL, NULL, '2020-09-26 11:17:25', NULL),
(12, 'Sakib sakib', 'sakib', 'sakib@gmail.com', '01812345678', '19', 'Dhaka', '15/2/A', '1215', NULL, '$2y$10$loP8V5NMrsF2Og8iqL033eESkVfIcjhwj8M.mFnmIduDrSNWBi3Ky', NULL, 'Yes', NULL, NULL, '2020-09-26 12:36:05', NULL),
(13, 'Mamun', 'mamun', 'mamun@gmail.com', '01812733305', 'BD', 'Dhaka', '15/2/A', '1215', NULL, '$2y$10$bTNstJWAXv4sJ6Pjw3YfPuWmqFoToUNFn3TwvnS0hCavhT3BmOUC.', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpc3MiOiJsb2NhbGhvc3QiLCJpYXQiOjE2MDEyMDg1ODUsIm5iZiI6MTYwMTIwODU4NSwiZXhwIjoxNjAxMjk0OTg1LCJhdWQiOiJteWN1c3RvbWVycyIsImRhdGEiOnsiaWQiOjEzLCJuYW1lIjoiTWFtdW4iLCJlbWFpbCI6Im1hbXVuQGdtYWlsLmNvbSJ9fQ.xkfgB4ApjSFHEOpW7b2w6Ra2_HQqBku2VNl7pLUZG9ac-NivKmtsozNvTcLPi_7p3spN2OcxchmcFLN14T_zBw', 'Yes', '::1', '2020-09-27 08:09:46', '2020-09-27 12:08:48', '2020-09-27 12:09:46');

-- --------------------------------------------------------

--
-- Table structure for table `customers_accounts`
--

CREATE TABLE `customers_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer` int(11) NOT NULL,
  `total_business` float(15,2) DEFAULT 0.00,
  `total_topup` float(15,2) DEFAULT 0.00,
  `current_balance` float(15,2) DEFAULT 0.00,
  `status` int(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `customers_accounts`
--

INSERT INTO `customers_accounts` (`id`, `customer`, `total_business`, `total_topup`, `current_balance`, `status`, `created_at`, `updated_at`) VALUES
(1, 13, 55.00, 100.00, 45.00, 1, '2020-09-27 12:08:48', '2020-09-29 21:10:27');

-- --------------------------------------------------------

--
-- Table structure for table `customer_packages`
--

CREATE TABLE `customer_packages` (
  `id` int(10) UNSIGNED NOT NULL,
  `customer` int(11) DEFAULT NULL,
  `package` int(11) DEFAULT NULL,
  `expire_on` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_packages`
--

INSERT INTO `customer_packages` (`id`, `customer`, `package`, `expire_on`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '2020-11-26 02:36:05', 1, '2020-09-26 12:36:05', '2020-09-26 16:22:42'),
(2, 12, 1, '2020-11-26 02:36:05', 1, '2020-09-26 12:36:05', '2020-09-26 13:12:47'),
(3, 2, 2, '2020-11-26 02:36:05', 0, '2020-09-26 12:36:05', '2020-09-26 16:22:42'),
(4, 13, 1, '2020-11-27 02:08:48', 1, '2020-09-27 12:08:48', NULL);

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
(4, '::1', 'Anonymous', NULL, 14, 208749.00, 'byte', '2020-09-10 23:29:36', NULL),
(5, '::1', 'Anonymous', NULL, 14, 208749.00, 'byte', '2020-09-10 23:42:16', NULL),
(6, '::1', 'Anonymous', NULL, 13, 99999999.99, 'byte', '2020-09-10 23:46:35', NULL),
(7, '::1', 'Anonymous', NULL, 13, 99999999.99, 'byte', '2020-09-10 23:47:07', NULL),
(8, '::1', 'Anonymous', NULL, 14, 208749.00, 'byte', '2020-09-18 17:30:32', NULL),
(9, '::1', 'Anonymous', NULL, 14, 208749.00, 'byte', '2020-09-18 18:19:00', NULL),
(10, '::1', 'Registered', 13, 14, 208749.00, 'byte', '2020-09-30 20:57:03', NULL);

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
(1, 'test update', '', 'fbgfbg', 'fbfbf', 'fnfgbf', 'fgbf', 'fgnnfgb', 'xcvxcv', 'gnngnf', 'xdvdxvdv', 'upload', '', 'Resume-of-MD-Arman-Hossain.pdf', 0.00, 'Byte', 'Yes', 55.00, 'USD', 'No', 'Yes', NULL, NULL, NULL, '2020-09-07 13:59:54', '2020-09-30 19:25:16', NULL, NULL),
(2, 'edited again', '', 'bcbcfgcfb', 'ccbbxb', 'zcxvccb', 'fgbf', 'fgnnfgb', 'xcvxcv', 'gnngnf', 'xdvdxvdv', 'upload', '', '', 0.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', NULL, NULL, NULL, '2020-09-07 14:13:47', '2020-09-08 22:51:23', NULL, NULL),
(3, 'xdsxbxvx', '', 'bcbcfgcfb', 'ccbbxb', 'zcxvccb', 'fgbf', 'fgnnfgb', 'xcvxcv', 'gnngnf', 'xdvdxvdv', 'upload', '', '', 0.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', NULL, NULL, NULL, '2020-09-07 14:14:44', NULL, NULL, NULL),
(4, 'hgnfgb', '', 'bcbcfgcfb', 'ccbbxb', 'fnfgbf', 'fgbf', 'xvxv', 'xcvxcv', 'fbfgb', 'gfnfnfn', 'direct', 'sdvsdvs', '', 56.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', NULL, NULL, NULL, '2020-09-07 14:22:23', NULL, NULL, NULL),
(5, 'hgnfgb', '', 'fbgfbg', 'fbfbf', 'zcxvccb', 'vxvxv', 'xvxv', 'xcvxcv', 'gnngnf', 'xdvdxvdv', 'upload', '', '', 0.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', NULL, NULL, NULL, '2020-09-07 14:29:57', NULL, NULL, NULL),
(6, 'hgnfgb', '', 'fbgfbg', 'fbfbf', 'zcxvccb', 'vxvxv', 'xvxv', 'xcvxcv', 'gnngnf', 'xdvdxvdv', 'upload', '', '', 0.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', NULL, NULL, NULL, '2020-09-07 14:34:56', '2020-09-18 00:28:21', NULL, NULL),
(7, 'hgnfgb', '', 'bcbcfgcfb', 'ccbbxb', 'fnfgbf', 'fgbf', 'fgnnfgb', 'fbfgb', 'gnngnf', 'xdvdxvdv', 'upload', '', '', 0.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', NULL, NULL, NULL, '2020-09-07 14:37:04', '2020-09-18 00:28:28', NULL, NULL),
(8, 'hfnssdfs', '', 'bcbcfgcfb', 'ccbbxb', 'fnfgbf', 'fgbf', 'fgnnfgb', 'xcvxcv', 'gnngnf', 'gfnfnfn', 'direct', 'sdcsxx', '', 2.01, 'Byte', 'No', 0.00, '', 'No', 'Yes', NULL, NULL, NULL, '2020-09-07 14:38:37', '2020-09-18 00:28:38', NULL, NULL),
(9, 'hgnfgb', '', 'bcbcfgcfb', 'ccbbxb', 'zcxvccb', 'fgbf', 'fgnnfgb', 'xcvxcv', 'gnngnf', 'xdvdxvdv', 'direct', 'sdcsxx', '', 0.01, 'Byte', 'No', 0.00, '', 'No', 'Yes', NULL, NULL, NULL, '2020-09-07 14:47:04', '2020-09-18 00:28:45', NULL, NULL),
(10, 'hfnssdfs', '', 'fbgfbg', 'fbfbf', 'zcxvccb', 'vxvxv', 'fgnnfgb', 'fbfgb', 'gnngnf', 'xdvdxvdv', 'direct', 'sdcsxx', '', 4.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', NULL, NULL, NULL, '2020-09-07 14:48:36', '2020-09-18 00:28:52', NULL, NULL),
(11, 'hgnfgb', '', 'bcbcfgcfb', 'fbfbf', 'zcxvccb', 'vxvxv', 'fgnnfgb', 'xcvxcv', 'gnngnf', 'xdvdxvdv', 'direct', 'sdcsxx', '', 4.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', NULL, NULL, 1, '2020-09-07 14:52:01', '2020-09-18 00:28:58', NULL, NULL),
(12, 'hgnfgb', '', 'fbgfbg', 'fbfbf', 'zcxvccb', 'vxvxv', 'xvxv', 'fbfgb', 'gnngnf', 'xdvdxvdv', 'direct', 'https://doc-0c-84-docs.googleusercontent.com/docs/securesc/v9r8kvh1q711b2nh7a2imgl0avh369ab/eto16s835besbmlsp6hj1v4asjch49ia/1599781800000/09893641086843687000/04327092949152832579/1X54mWAfh-r-zMHDR2NV_eCIEjhdq0D7u?e=download&authuser=0&nonce=35gpbei4tfhq6&user=04327092949152832579&hash=f9vu8l04eoac8otjh6ipa3fioaaj0j4v', '', 56.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', NULL, NULL, 2, '2020-09-07 15:07:09', '2020-09-18 00:29:06', NULL, NULL),
(13, 'xdsxbxvx', '', 'fbgfbg', 'ccbbxb', 'fnfgbf', 'fgbf', 'xvxv', 'fbfgb', 'gnngnf', 'gfnfnfn', 'upload', '', 'Inception.2010.1080p.BrRip.x264.YIFY.mp4', 0.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', NULL, NULL, NULL, '2020-09-08 15:39:32', '2020-09-18 00:29:13', NULL, NULL),
(14, 'hgnfgb', '', 'bcbcfgcfb', 'fbfbf', 'fnfgbf', 'vxvxv', 'xvxv', 'xcvxcv', 'xc x ', 'xdvdxvdv', 'upload', '', 'Resume-of-MD-Arman-Hossain.pdf', 0.00, 'Byte', 'No', 0.00, '', 'No', 'Yes', NULL, NULL, NULL, '2020-09-08 15:43:27', '2020-09-18 00:29:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `file_requests`
--

CREATE TABLE `file_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `is_read` varchar(255) NOT NULL DEFAULT 'No',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, '::1', 1, '2020-09-10 14:45:44', '2020-09-30 16:44:40'),
(2, '::1', 2, '2020-09-10 15:02:30', '2020-09-18 14:18:48'),
(4, '::1', 14, '2020-09-10 16:33:27', '2020-09-30 16:57:03'),
(5, '::1', 13, '2020-09-10 23:46:22', '2020-09-18 13:30:03'),
(6, '::1', 12, '2020-09-10 23:51:29', '2020-09-10 19:51:55'),
(7, '::1', 7, '2020-09-14 11:23:54', NULL),
(8, '::1', 8, '2020-09-18 17:26:20', '2020-09-28 12:07:27'),
(9, '::1', 6, '2020-09-22 10:52:41', '2020-09-22 06:57:36');

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
-- Table structure for table `interface_setup`
--

CREATE TABLE `interface_setup` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `language` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `skin` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `default_password` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `show_new_days` int(5) DEFAULT 3,
  `footer_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `copyright` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `header_contact` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `footer_contact` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `switch_language` int(1) UNSIGNED DEFAULT 0,
  `enable_review` int(1) UNSIGNED DEFAULT 0,
  `facebook_url` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin_url` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(400) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_slider` int(1) DEFAULT 0,
  `download_search` int(1) DEFAULT 0,
  `download_folder` int(1) DEFAULT 0,
  `feature_and_arrival` int(1) DEFAULT 0,
  `best_sells` int(1) DEFAULT 1,
  `top_feature_product` int(1) DEFAULT 1,
  `top_and_recent_file_list` int(1) DEFAULT 1,
  `our_partner` int(1) DEFAULT 1,
  `active` int(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `interface_setup`
--

INSERT INTO `interface_setup` (`id`, `language`, `skin`, `default_password`, `show_new_days`, `footer_text`, `copyright`, `header_contact`, `footer_contact`, `switch_language`, `enable_review`, `facebook_url`, `youtube_url`, `twitter_url`, `linkedin_url`, `instagram_url`, `image_slider`, `download_search`, `download_folder`, `feature_and_arrival`, `best_sells`, `top_feature_product`, `top_and_recent_file_list`, `our_partner`, `active`, `created_at`, `updated_at`, `updated_by`) VALUES
(1, 'en', 'green', 'www.gsmtechmaster.com', 3, '<strong>Powered By <a href=\"https://gsmserverspro.com/\" target=\"_blank\">Download Server (GSM Servers Pro)</a></strong>', '<strong>Copyright © 2017 - 2020 <a href=\"https://gsmtechmaster.com/\" target=\"_blank\">GSM Tech Master </a> All Rights Reserved.</strong>', 'Contact Us  / Whatsapp <i class=\"fa fa-phone fw-r10\"></i> <strong>+8801875134862 (Only SMS)</strong>', 'Phone +8801875134862<br>WhatsApp +8801751986091 <br>Like Our Page For Latest Firmware And Solutions', 0, 1, 'https://web.facebook.com/GSM-Tech-Master-559794727858656/', 'https://www.youtube.com/channel/UCa9n8C9KcNcB_oHFAvfIvLg', 'https://twitter.com/gsmshanto', NULL, NULL, 1, 1, 1, 1, 1, 1, 1, 1, 1, NULL, '2020-03-04 04:40:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `order_no` bigint(20) NOT NULL,
  `item_type` varchar(20) NOT NULL COMMENT 'File / Package',
  `file_id` int(11) DEFAULT NULL,
  `file_title` varchar(255) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `package_title` varchar(255) DEFAULT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` float(10,2) NOT NULL,
  `sub_total` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `order_no` bigint(20) NOT NULL,
  `order_by` int(11) NOT NULL,
  `sub_total` float(10,2) NOT NULL DEFAULT 0.00,
  `discount` float(10,2) NOT NULL DEFAULT 0.00,
  `tax` float(10,2) NOT NULL DEFAULT 0.00,
  `bill_amount` float(10,2) NOT NULL DEFAULT 0.00,
  `bill_unit` varchar(20) NOT NULL,
  `notes` text NOT NULL,
  `is_paid` tinyint(4) NOT NULL DEFAULT 0 COMMENT 'paid = 1, unpaid = 0',
  `status` varchar(20) NOT NULL DEFAULT 'Pending' COMMENT 'Pending / Completed',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `order_by`, `sub_total`, `discount`, `tax`, `bill_amount`, `bill_unit`, `notes`, `is_paid`, `status`, `completed_at`, `created_at`, `updated_at`) VALUES
(6, 1001, 13, 55.00, 0.00, 0.00, 55.00, 'USD', '', 1, 'Completed', NULL, '2020-09-29 18:39:28', '2020-09-29 21:10:27'),
(7, 1002, 13, 55.00, 0.00, 0.00, 55.00, 'USD', '', 0, 'Pending', NULL, '2020-09-30 20:44:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_files`
--

CREATE TABLE `orders_files` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `order_no` bigint(20) NOT NULL,
  `file_id` int(11) DEFAULT NULL,
  `file_title` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sub_total` float(10,2) NOT NULL,
  `discount` float(10,2) NOT NULL,
  `total` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders_files`
--

INSERT INTO `orders_files` (`id`, `order_id`, `order_no`, `file_id`, `file_title`, `price`, `quantity`, `sub_total`, `discount`, `total`) VALUES
(7, 6, 1001, 1, 'test update', 55.00, 1, 55.00, 0.00, 55.00),
(8, 7, 1002, 1, 'test update', 55.00, 1, 55.00, 0.00, 55.00);

-- --------------------------------------------------------

--
-- Table structure for table `orders_messages`
--

CREATE TABLE `orders_messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `message_from` int(1) DEFAULT NULL COMMENT '1=customer;2=comany',
  `message` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `orders_messages`
--

INSERT INTO `orders_messages` (`id`, `order_id`, `message_from`, `message`, `created_at`, `updated_at`) VALUES
(1, 6, 1, 'Hello', '2020-09-30 21:45:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders_packages`
--

CREATE TABLE `orders_packages` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `order_no` bigint(20) NOT NULL,
  `package_id` int(11) DEFAULT NULL,
  `package_title` varchar(255) DEFAULT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sub_total` float(10,2) NOT NULL,
  `discount` float(10,2) NOT NULL,
  `total` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` int(11) NOT NULL,
  `title` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_paid` tinyint(1) NOT NULL DEFAULT 0,
  `price` float(10,2) NOT NULL DEFAULT 0.00,
  `price_unit` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `validity` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Non Expirable' COMMENT 'Expirable / Non Expirable',
  `validity_period` int(8) NOT NULL,
  `validity_period_unit` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `devices` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Unlimited' COMMENT 'Limited / Unlimited',
  `device_amount` int(5) DEFAULT 0 COMMENT 'Allow device amount',
  `is_public` int(1) DEFAULT 0,
  `is_active` int(1) DEFAULT 0,
  `bandwith_size` int(1) DEFAULT 1,
  `bandwith_size_unit` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bandwith_size_in_bytes` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Featured / Non Featured',
  `bandwith_limit_file` int(11) DEFAULT 0,
  `daily_file_limit` int(5) DEFAULT 0,
  `daily_download_size` int(11) DEFAULT 0,
  `daily_download_size_unit` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Daily for package main condition',
  `daily_download_size_in_bytes` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `free_file_limit` int(11) DEFAULT 0,
  `free_file_size` int(11) DEFAULT 0,
  `free_file_size_unit` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Free is daily condition',
  `free_file_size_in_bytes` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `description`, `is_paid`, `price`, `price_unit`, `validity`, `validity_period`, `validity_period_unit`, `devices`, `device_amount`, `is_public`, `is_active`, `bandwith_size`, `bandwith_size_unit`, `bandwith_size_in_bytes`, `file_type`, `bandwith_limit_file`, `daily_file_limit`, `daily_download_size`, `daily_download_size_unit`, `daily_download_size_in_bytes`, `free_file_limit`, `free_file_size`, `free_file_size_unit`, `free_file_size_in_bytes`, `created_at`, `updated_at`) VALUES
(1, 'Free', 'Free Package for all registerd user', 0, 0.00, '', 'Expirable', 2, 'Month', 'Limited', 1000, 1, 1, 100, 'GB', '107374182400', 'Non-Featured', 1000, 15, 4, 'GB', '4294967296', 20, 10, 'GB', '10737418240', '2020-02-22 06:20:58', '2020-09-25 20:26:13'),
(2, 'GTM Test', 'This Package For Test', 1, 5.00, 'USD', 'Expirable', 5, 'Day', 'Limited', 5, 1, 1, 5, 'GB', '5368709120', 'Featured', 5, 5, 5, 'GB', '5368709120', 5, 5, 'GB', '5368709120', '2020-02-23 23:14:59', '2020-09-25 20:25:53');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` int(11) NOT NULL,
  `image` varchar(200) COLLATE utf16_unicode_ci DEFAULT NULL,
  `name` varchar(50) COLLATE utf16_unicode_ci DEFAULT NULL,
  `is_active` int(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci ROW_FORMAT=COMPACT;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `image`, `name`, `is_active`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'uploads/partner/sony.png', 'Sonny', 0, NULL, '2020-02-25 01:13:50', NULL, 1),
(2, 'uploads/partner/toshiba.png', 'Samsung', 1, NULL, '2020-02-25 01:13:53', NULL, NULL),
(3, 'uploads/partner/1582384694.png', 'Samsung', 1, NULL, '2020-02-22 09:18:14', NULL, 1),
(4, 'uploads/partner/huawei.png', 'Mi', 1, NULL, '2020-02-25 01:14:25', NULL, NULL),
(5, 'uploads/partner/acer.png', 'Acer', 1, NULL, '2020-02-25 01:13:59', NULL, 1),
(6, 'uploads/partner/dell.png', 'DELL', 1, NULL, '2020-02-25 01:13:56', NULL, 1),
(7, 'uploads/partner/1582614787.png', 'Del', 1, NULL, '2020-02-25 01:13:07', NULL, 1),
(8, 'uploads/partner/1582614845.png', 'Itel', 1, NULL, '2020-02-25 01:14:19', NULL, 1),
(11, 'uploads/partner/1578543198.jpg', 'sfdsf', 1, '2020-01-08 22:13:18', '2020-01-08 22:37:54', 1, NULL),
(12, 'uploads/partner/1578544712.jpg', 'sfdsf', 1, '2020-01-08 22:38:32', '2020-01-08 22:39:19', 1, NULL),
(13, '', NULL, 0, '2020-01-09 06:58:58', '2020-02-25 01:12:59', 1, NULL),
(14, 'uploads/partner/1582614876.png', 'huawei', 1, '2020-02-25 01:14:36', '2020-02-25 01:15:14', 1, 1),
(15, 'uploads/partner/1582614896.png', 'huawei', 0, '2020-02-25 01:14:56', '2020-02-25 01:15:03', 1, NULL),
(16, 'uploads/partner/1582615052.png', 'vivo', 1, '2020-02-25 01:17:32', '2020-02-25 01:17:32', 1, NULL),
(17, 'uploads/partner/1582615120.png', 'xiaomi', 1, '2020-02-25 01:18:40', '2020-02-25 01:18:40', 1, NULL),
(18, 'uploads/partner/1582615384.png', 'oppo', 1, '2020-02-25 01:23:04', '2020-02-25 01:23:04', 1, NULL),
(19, 'uploads/partner/1582615474.png', 'google', 1, '2020-02-25 01:24:34', '2020-02-25 01:24:34', 1, NULL),
(20, 'uploads/partner/1582615583.png', 'htc', 1, '2020-02-25 01:26:23', '2020-02-25 01:26:23', 1, NULL),
(21, 'uploads/partner/1582615733.png', 'tecno', 1, '2020-02-25 01:28:53', '2020-02-25 01:29:07', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `system_download_setup`
--

CREATE TABLE `system_download_setup` (
  `id` int(10) NOT NULL,
  `default_registration_package` int(11) DEFAULT NULL,
  `link_expire_period` int(6) DEFAULT NULL,
  `link_expire_period_unit` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `allow_visitior_download` int(1) DEFAULT 1,
  `visitor_allow_feature` int(1) DEFAULT 0,
  `visitor_download_size` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `visitor_download_size_unit` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `visitor_download_size_in_bytes` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `visitor_file_limit` int(5) DEFAULT NULL,
  `allow_user_switch_package` int(1) DEFAULT 0,
  `allow_onsite_file_upload` int(1) DEFAULT 0,
  `max_upload_size` int(10) DEFAULT 0,
  `max_upload_size_uniy` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `allow_additional_package_of_active_package` int(1) DEFAULT 0,
  `allow_one_free_package` int(1) DEFAULT 1,
  `file_owner_percentage` int(4) DEFAULT 0,
  `is_active` int(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `system_download_setup`
--

INSERT INTO `system_download_setup` (`id`, `default_registration_package`, `link_expire_period`, `link_expire_period_unit`, `allow_visitior_download`, `visitor_allow_feature`, `visitor_download_size`, `visitor_download_size_unit`, `visitor_download_size_in_bytes`, `visitor_file_limit`, `allow_user_switch_package`, `allow_onsite_file_upload`, `max_upload_size`, `max_upload_size_uniy`, `allow_additional_package_of_active_package`, `allow_one_free_package`, `file_owner_percentage`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Day', 1, 0, '6', 'GB', '6442450944', 6, 1, 1, 10, 'GB', 0, 1, 5, 1, NULL, '2020-09-25 19:00:05');

-- --------------------------------------------------------

--
-- Table structure for table `system_setup`
--

CREATE TABLE `system_setup` (
  `id` int(11) NOT NULL,
  `site_title` tinytext COLLATE utf16_unicode_ci DEFAULT NULL,
  `site_url` tinytext COLLATE utf16_unicode_ci DEFAULT NULL,
  `site_logo` tinytext COLLATE utf16_unicode_ci DEFAULT NULL,
  `lazy_image` tinytext COLLATE utf16_unicode_ci DEFAULT NULL,
  `default_folder_icon` tinytext COLLATE utf16_unicode_ci DEFAULT NULL,
  `default_file_thumbnail` tinytext COLLATE utf16_unicode_ci DEFAULT NULL,
  `og_image` tinytext COLLATE utf16_unicode_ci DEFAULT NULL,
  `fav_icon` tinytext COLLATE utf16_unicode_ci DEFAULT NULL,
  `meta_tag` text COLLATE utf16_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf16_unicode_ci DEFAULT NULL,
  `support_email` tinytext COLLATE utf16_unicode_ci DEFAULT NULL,
  `contact_email` tinytext COLLATE utf16_unicode_ci DEFAULT NULL,
  `technical_email` tinytext COLLATE utf16_unicode_ci DEFAULT NULL,
  `billing_email` tinytext COLLATE utf16_unicode_ci DEFAULT NULL,
  `currency_code` varchar(10) COLLATE utf16_unicode_ci DEFAULT NULL,
  `currency_format` varchar(10) COLLATE utf16_unicode_ci DEFAULT NULL,
  `currency_decimal` varchar(10) COLLATE utf16_unicode_ci DEFAULT NULL,
  `maximum_pending_order` varchar(10) COLLATE utf16_unicode_ci DEFAULT NULL,
  `allow_registration` tinyint(1) DEFAULT 0,
  `mail_verification` tinyint(1) DEFAULT 0,
  `captcha_active` tinyint(1) DEFAULT 0,
  `lazy_active` tinyint(1) DEFAULT 0,
  `balance_order` tinyint(1) DEFAULT NULL,
  `balance_transfer` tinyint(1) DEFAULT 0,
  `show_partner` tinyint(1) DEFAULT 1,
  `show_recent_file` tinyint(1) DEFAULT 1,
  `show_top_file` tinyint(1) DEFAULT 1,
  `show_announcement` tinyint(1) DEFAULT 1,
  `login_download` tinyint(1) DEFAULT 1,
  `free_download_size` varchar(20) COLLATE utf16_unicode_ci DEFAULT '5',
  `size_unit` varchar(6) COLLATE utf16_unicode_ci DEFAULT 'GB',
  `size_in_bytes` varchar(40) COLLATE utf16_unicode_ci DEFAULT '5368709120',
  `file_limit` int(4) DEFAULT 15,
  `theme_color` varchar(12) COLLATE utf16_unicode_ci DEFAULT 'green',
  `theme_text` varchar(12) COLLATE utf16_unicode_ci DEFAULT 'blue',
  `top_bar_color` varchar(12) COLLATE utf16_unicode_ci DEFAULT 'yellow',
  `menu_bar_color` varchar(12) COLLATE utf16_unicode_ci DEFAULT 'red',
  `header_color` varchar(12) COLLATE utf16_unicode_ci DEFAULT 'pink',
  `news_part` varchar(12) COLLATE utf16_unicode_ci DEFAULT 'orange',
  `folder_color` varchar(12) COLLATE utf16_unicode_ci DEFAULT 'green',
  `footer_color` varchar(12) COLLATE utf16_unicode_ci DEFAULT 'gray',
  `footer_bar_color` varchar(12) COLLATE utf16_unicode_ci DEFAULT 'black',
  `show_map` int(1) DEFAULT 0,
  `map_url` varchar(400) COLLATE utf16_unicode_ci DEFAULT 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.873610134837!2d90.4224795145893!3d23.751886084588595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b871cec3a7e5%3A0xf766a4fabc165e9b!2sTaltola%20Market%20Rd%2C%20Dhaka!5e0!3m2!1sen!2sbd!4v1574410761745!5m2!1sen!2sbd',
  `is_email_verified` int(1) DEFAULT 1,
  `is_active` int(1) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_unicode_ci;

--
-- Dumping data for table `system_setup`
--

INSERT INTO `system_setup` (`id`, `site_title`, `site_url`, `site_logo`, `lazy_image`, `default_folder_icon`, `default_file_thumbnail`, `og_image`, `fav_icon`, `meta_tag`, `meta_description`, `support_email`, `contact_email`, `technical_email`, `billing_email`, `currency_code`, `currency_format`, `currency_decimal`, `maximum_pending_order`, `allow_registration`, `mail_verification`, `captcha_active`, `lazy_active`, `balance_order`, `balance_transfer`, `show_partner`, `show_recent_file`, `show_top_file`, `show_announcement`, `login_download`, `free_download_size`, `size_unit`, `size_in_bytes`, `file_limit`, `theme_color`, `theme_text`, `top_bar_color`, `menu_bar_color`, `header_color`, `news_part`, `folder_color`, `footer_color`, `footer_bar_color`, `show_map`, `map_url`, `is_email_verified`, `is_active`, `created_at`, `updated_at`, `created_by`, `updated_by`) VALUES
(1, 'GSM Tech Master', 'https://gsmtechmaster.com', 'uploads/system/l1574162894.png', 'uploads/system/la1574063228.png', 'uploads/system/fo1582381470.png', 'uploads/system/fi1582383446.png', 'uploads/system/o1574063228.jpg', 'uploads/system/fav1582381311.png', 'GSM Tech Master Soft,Samsung Firmware,Huawei Firmware,HTC Firmware,Samsung Combination,Clone Firmware Flash File,Symphony Customer Care Firmware,Walton Customer Care Firmware,Logo Fix Firmware, Dead Recovey Flash File,LCD Fix Firmware Flash File,Root File TWRP,Mi Cloud Clean Rom,Xiaomi Downgrade Firmware,MIUI 10 Firmware,Bootloader Unlock File,', 'Welcome To GSM Tech Master Official Download Server, Hare You Can Find Firmware Flash File,SAMSUNG Firmware,SAMSUNG Combination,Customer Care Firmware,All Root File,MTK Clone Firmware, Xiaomi Firmware,Huawei Firmware,Also All GTM Tested Firmware And Solution, FRP Remove File And Solution', 'gsmtechmaster@gmail.com', 'gsmtechmaster@gmail.com', 'gsmtechmaster@gmail.com', 'gsmtechmaster@gmail.com', 'USD', '$', '2', NULL, 0, 1, 1, 1, 1, 0, 1, 1, 0, 0, 1, NULL, NULL, '6442450944', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.8815556794243!2d90.42242181429697!3d23.751602794648736!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b9a0bd62e54b%3A0xa5f9fbd9fc4614aa!2sGSM%20Tech%20Master!5e0!3m2!1sbn!2sbd!4v1582547063128!5m2!1sbn!2sbd', 0, 1, NULL, '2020-09-22 09:36:30', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer` int(11) DEFAULT NULL,
  `admin_pay` int(1) DEFAULT 0,
  `invoice` bigint(20) DEFAULT NULL,
  `gateway` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gateway_identity` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` float(10,2) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `customer`, `admin_pay`, `invoice`, `gateway`, `gateway_identity`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 13, 0, 1001, 'balance', 'balance', 55.00, 1, '2020-09-29 21:10:27', '2020-09-30 16:55:04');

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
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers_accounts`
--
ALTER TABLE `customers_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer` (`customer`);

--
-- Indexes for table `customer_packages`
--
ALTER TABLE `customer_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_package_ibfk_1` (`package`),
  ADD KEY `customer` (`customer`);

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
-- Indexes for table `file_requests`
--
ALTER TABLE `file_requests`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `interface_setup`
--
ALTER TABLE `interface_setup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_by` (`order_by`);

--
-- Indexes for table `orders_files`
--
ALTER TABLE `orders_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `orders_messages`
--
ALTER TABLE `orders_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `orders_packages`
--
ALTER TABLE `orders_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `system_download_setup`
--
ALTER TABLE `system_download_setup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_setup`
--
ALTER TABLE `system_setup`
  ADD PRIMARY KEY (`id`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer` (`customer`);

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
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customers_accounts`
--
ALTER TABLE `customers_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_packages`
--
ALTER TABLE `customer_packages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `download_history`
--
ALTER TABLE `download_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `file_requests`
--
ALTER TABLE `file_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_tags`
--
ALTER TABLE `file_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `file_visitors`
--
ALTER TABLE `file_visitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `interface_setup`
--
ALTER TABLE `interface_setup`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders_files`
--
ALTER TABLE `orders_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders_messages`
--
ALTER TABLE `orders_messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `orders_packages`
--
ALTER TABLE `orders_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `system_download_setup`
--
ALTER TABLE `system_download_setup`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_setup`
--
ALTER TABLE `system_setup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Constraints for table `announcements`
--
ALTER TABLE `announcements`
  ADD CONSTRAINT `announcements_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `announcements_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `customers_accounts`
--
ALTER TABLE `customers_accounts`
  ADD CONSTRAINT `customers_accounts_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer_packages`
--
ALTER TABLE `customer_packages`
  ADD CONSTRAINT `customer_packages_ibfk_1` FOREIGN KEY (`package`) REFERENCES `packages` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `customer_packages_ibfk_2` FOREIGN KEY (`customer`) REFERENCES `customers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

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
-- Constraints for table `interface_setup`
--
ALTER TABLE `interface_setup`
  ADD CONSTRAINT `interface_setup_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`order_by`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders_files`
--
ALTER TABLE `orders_files`
  ADD CONSTRAINT `orders_files_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders_messages`
--
ALTER TABLE `orders_messages`
  ADD CONSTRAINT `orders_messages_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `orders_packages`
--
ALTER TABLE `orders_packages`
  ADD CONSTRAINT `orders_packages_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `partners`
--
ALTER TABLE `partners`
  ADD CONSTRAINT `partners_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `partners_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `system_setup`
--
ALTER TABLE `system_setup`
  ADD CONSTRAINT `system_setup_ibfk_1` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`customer`) REFERENCES `customers` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_role`) REFERENCES `user_roles` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
