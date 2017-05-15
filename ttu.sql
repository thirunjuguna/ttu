-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 09, 2017 at 01:02 PM
-- Server version: 5.7.18-0ubuntu0.16.04.1
-- PHP Version: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ttu`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(10) UNSIGNED NOT NULL,
  `mini_dp_id` int(11) NOT NULL,
  `course` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `mini_dp_id`, `course`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bsc. Mathematics& Computer Science', NULL, NULL),
(2, 2, 'Bsc.Commerce', NULL, NULL),
(3, 1, 'Bsc.Information Technology', '2017-03-28 17:47:55', '2017-03-28 17:47:55'),
(4, 1, 'Msc.Computer Systems', '2017-04-10 04:58:28', '2017-04-10 04:58:28'),
(5, 3, 'Bsc.Mining And Mineral Processing Engineering', '2017-04-30 07:31:53', '2017-04-30 07:31:53');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `created_at`, `updated_at`) VALUES
(1, 'ACADEMICS', NULL, NULL),
(2, 'HALLS', NULL, NULL),
(3, 'LIBRARY', '2017-04-16 22:46:12', '2017-04-16 22:46:12'),
(4, 'GAMES & SPORTS', '2017-04-16 22:46:28', '2017-04-16 22:46:28'),
(5, 'DEANS OFFICE', '2017-04-16 22:46:44', '2017-04-16 22:46:44'),
(6, 'REGISTRAR', '2017-04-16 22:47:06', '2017-04-16 22:47:06');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) UNSIGNED NOT NULL,
  `dp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minidp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `from_` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `dp`, `minidp`, `from_`, `to_`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '6', '1', 'tes', 'read', '2017-03-30 05:43:22', '2017-04-15 09:16:34'),
(2, '1', '1', '6', '6', 'tes', 'unread', '2017-03-30 05:43:22', '2017-03-30 05:43:22'),
(3, '1', '1', '6', '1', 'tes', 'unread', '2017-03-30 05:43:22', '2017-03-30 05:43:22'),
(4, '1', '1', '6', '6', 'tes', 'unread', '2017-03-30 05:43:22', '2017-03-30 05:43:22'),
(5, '1', '1', '11', '6', 'Testing', 'unread', '2017-04-15 09:16:34', '2017-04-15 09:16:34'),
(6, '1', '1', '11', '7', 'Thiru Thiru', 'unread', '2017-04-15 10:38:35', '2017-04-15 10:38:35'),
(7, '1', '2', '6', '2', 'tets', 'unread', '2017-04-16 16:21:32', '2017-04-16 16:21:32'),
(8, '1', '1', '6', '1', 'test', 'unread', '2017-04-18 21:52:09', '2017-04-18 21:52:09'),
(9, '1', '1', '6', '1', 'kimani wamanta', 'unread', '2017-04-18 21:52:20', '2017-04-18 21:52:20'),
(10, '4', '1', '6', '1', 'Hey Wachezaji', 'unread', '2017-04-18 22:14:39', '2017-04-18 22:14:39'),
(11, '1', '1', '11', '15', 'Dan Test sms', 'unread', '2017-04-18 22:23:34', '2017-04-18 22:23:34');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_03_23_085442_create_departments_table', 2),
(4, '2017_03_23_085503_create_minidepartments_table', 2),
(5, '2017_03_23_093946_create_courses_table', 2),
(6, '2017_03_24_214046_create_userdp_table', 3),
(7, '2017_03_26_120215_create_years_table', 4),
(8, '2017_03_28_214105_create_messages_table', 5),
(9, '2017_04_01_104026_create_notices_table', 6),
(10, '2017_04_04_003628_create_records_table', 7),
(11, '2017_04_04_004536_create_remarks_table', 7),
(12, '2017_04_13_061628_create_transactions-table', 8);

-- --------------------------------------------------------

--
-- Table structure for table `minidepartments`
--

CREATE TABLE `minidepartments` (
  `id` int(10) UNSIGNED NOT NULL,
  `dp_id` int(11) NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `minidepartments`
--

INSERT INTO `minidepartments` (`id`, `dp_id`, `department`, `created_at`, `updated_at`) VALUES
(1, 1, 'M&I', NULL, NULL),
(2, 1, 'BSE', NULL, '2017-04-03 21:22:58'),
(3, 1, 'MMPE', '2017-04-16 22:47:40', '2017-04-16 22:47:40');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(10) UNSIGNED NOT NULL,
  `dp` int(11) NOT NULL,
  `notice` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `dp`, `notice`, `created_at`, `updated_at`) VALUES
(2, 1, 'Hey People', '2017-04-15 09:36:43', '2017-04-15 09:36:43'),
(3, 1, 'Hey Clearance is a web-based data driven clearance systems that helps ease in clearing higher learning institutionsHey Clearance is a web-based data driven clearance systems that helps ease in clearing higher learning institutionsHey Clearance is a web-based data driven clearance systems that helps ease in clearing higher learning institutionsHey Clearance is a web-based data driven clearance systems that helps ease in clearing higher learning institutionsHey Clearance is a web-based data driven clearance systems that helps ease in clearing higher learning institutionsHey Clearance is a web-based data driven clearance systems that helps ease in clearing higher learning institutions', '2017-04-15 09:41:25', '2017-04-15 09:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`id`, `user_id`, `year`, `status`, `created_at`, `updated_at`) VALUES
(45, '4', '1', '1', '2017-04-18 21:35:56', '2017-04-18 21:35:56'),
(46, '4', '4', '1', '2017-04-18 21:35:56', '2017-04-18 21:35:56'),
(47, '6', '1', '1', '2017-04-18 21:35:56', '2017-04-18 21:35:56'),
(48, '6', '4', '1', '2017-04-18 21:35:56', '2017-04-18 21:35:56'),
(49, '7', '1', '1', '2017-04-18 21:35:56', '2017-04-18 21:35:56'),
(50, '7', '4', '1', '2017-04-18 21:35:56', '2017-04-18 21:35:56'),
(51, '9', '1', '1', '2017-04-18 21:35:56', '2017-04-18 21:35:56'),
(52, '9', '4', '1', '2017-04-18 21:35:56', '2017-04-18 21:35:56'),
(53, '13', '1', '1', '2017-04-18 21:35:56', '2017-04-18 21:35:56'),
(54, '13', '4', '1', '2017-04-18 21:35:57', '2017-04-18 21:35:57'),
(55, '15', '1', '1', '2017-04-18 21:35:57', '2017-04-18 21:35:57'),
(56, '15', '4', '1', '2017-04-18 21:35:57', '2017-04-18 21:35:57'),
(57, '16', '1', '1', '2017-04-30 07:26:18', '2017-04-30 07:26:18'),
(58, '16', '4', '1', '2017-04-30 07:26:18', '2017-04-30 07:26:18');

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE `remarks` (
  `id` int(10) UNSIGNED NOT NULL,
  `record` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL DEFAULT '0',
  `dp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `minidp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paid` int(25) NOT NULL DEFAULT '0',
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(10) UNSIGNED NOT NULL,
  `sender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to_` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `sender`, `to_`, `amount`, `status`, `code`, `created_at`, `updated_at`) VALUES
(1, '254714876995', 'tuo1-sc211-0134/2013', 100, 1, '9470', NULL, '2017-04-18 22:08:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` int(25) NOT NULL DEFAULT '0',
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `reg` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `course` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `yos` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `level` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1',
  `verify_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `verify_status` int(10) NOT NULL DEFAULT '0',
  `complete` int(2) NOT NULL DEFAULT '0',
  `minidp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `balance`, `mobile`, `reg`, `password`, `department`, `course`, `yos`, `level`, `status`, `verify_code`, `verify_status`, `complete`, `minidp`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Thiru', 'Thiru', 'gichurepaul123@gmail.com', 0, '', '', '$2y$10$K6jtlmK9cGoV2dvZHZKzTuExbQMXZSDpGJ.yMNFkLPRPF/RNGKNIe', '', '', '', '', 1, '', 0, 0, '', NULL, '2017-03-23 05:19:31', '2017-03-23 05:19:31'),
(3, 'tets', 'jsfed', 'gichurepfdfaul123@gmail.com', 0, '', '', '$2y$10$s.xEOx8qVlrm6oAggER/teS0cIdwWC8RT/y.QjST/uP3.fkbYDO/S', '', '', '', '', 1, '', 0, 0, '', NULL, '2017-03-23 11:57:44', '2017-03-23 11:57:44'),
(4, 'hun', 'hun', 'hun@hun.com', 0, '254', 'tuo1-sc211-0134/2013', '$2y$10$qSK7bk/GmWfFb4UnewRTmOCwTziLbqZS87bsV7paMFrOxZQPaxpt2', '1', '1', '1', 'STUDENT', 1, '', 0, 1, '1', 'E3AwSuX1h7G91GPS4U2gc2NPnWRGfjxwyygTrQxlFBc8TgqqSijxIxBHwf9R', '2017-03-24 15:24:21', '2017-03-24 16:33:20'),
(6, 'Student', 'Student', 'student@student.com', 7584, '254714876995', 'tuo1-sc211-0134/2013', '$2y$10$ZB5SEMlvBqQZxrA1vbYaZeqo7/9tKU/THSUGIj5CkNlZGw6LtCsgq', '1', '3', '1', 'STUDENT', 1, '9180883', 0, 1, '1', 'tm1lHoSVlT7xjIiT8FZPrmngHcw5xgnWLauXsYTmTF41g1x8Mfz0QO6Q0o6j', '2017-03-28 18:07:39', '2017-04-18 22:08:43'),
(7, 'ann', 'ann', 'ann@as.s', 0, '254714876995', 'tuo1-sc211-0134/2013', '$2y$10$yo6GJm2HhBTapPbES2KeU.JfOwb8SKCtsvxsqhVf2SHcXS0gApYJW', '1', '1', '1', 'STUDENT', 1, '', 0, 1, '1', 'IFo0zqFk9chKEANTlRqrrJWjfFn12nyVmwv6bGReQvdsthUcMUGoWJf1pWkB', '2017-04-01 08:09:14', '2017-04-01 08:11:03'),
(8, 'as', 'sd', 'admin@admin.com', 0, '254714876995', 'tuo1-sc211-0134/2013', '$2y$10$huo86waM9pZ/0o1/F0rGsOqUPcWsgTGrBGtmL6KpliW1T4L1TXB/m', '1', '1', '1', 'ADMIN', 1, '1914318', 0, 1, '1', 'XCksEbnGbIJJvGRGfXm6BXujHqjQ7RPEF3M1CLdnTfX3FukQ5osgGxXXw4FU', '2017-04-01 08:28:20', '2017-04-16 16:13:28'),
(9, 'tets', 'test', 'student@student.comd', 0, '254737194759', 'tuo1-sc211-0134/2013', '$2y$10$i8Hp9Yx3fXDujCOx.sdwtOtxDmE/eXHbF7QqBFHViE7Fgpfz5SAQO', '1', '1', '1', 'STUDENT', 1, '', 0, 1, '', 'DS4BYI6RYVOqQ2F4YMzEw38FEjPC833Um2jy79LldQQ1ZzC6WDV5lMOhRvxd', '2017-04-01 08:41:34', '2017-04-01 08:43:29'),
(10, 'Jane', 'Jamed', 'jane@jane.com', 0, '254714876995', '', '$2y$10$o4KD5i9K/uf2GnZ.cDQmNeKp8pD8e7MWBodj2lxeHwVeBExnvgW5i', '1', '', '', 'DEPARTMENT', 1, '', 0, 1, '1', 'azxK0cs6EgbXGg4wgI8DGdoCbveZyBAdxJ8TvGipEktmOaQfj6AbLSPQwvLN', '2017-04-10 04:54:55', '2017-04-10 04:57:42'),
(11, 'd@d.com', 'd@d.com', 'd@d.com', 0, '254714876995', '', '$2y$10$MOVauWW1m0y2nRXEwHy1ueLXOORRKXHIOxg9SbrSJnq7Iv8ct0twG', '1', '', '', 'DEPARTMENT', 1, '', 1, 1, '3', 'l6IfH07BMIansDLxUsOSRGdgjcRDoLjoqCsE6UYXz4CQ6WJbIPXjC1ApO4W7', '2017-04-13 03:30:12', '2017-04-30 07:31:17'),
(12, 'Student', 'Daggy', 'admin@admin.coml', 0, '254714876995', '', '$2y$10$lmysvYjDRawLog2M08xgeemFqFsO7env6VqOIVw7/WVGIJJgApXHi', '2', '', '', 'DEPARTMENT', 1, '', 0, 1, '', 'wtVn1DCD6FrX4jINC5AvxKVFwG6V22dp6IztRE3rAQAvNplRccOzG7bRATkQ', '2017-04-16 16:16:11', '2017-04-17 14:40:30'),
(13, 'Ruth', 'Wageci', 'wageci@ruth.com', 0, '254714876995', 'tuo1-sc211-0134/2012', '$2y$10$YQoXw40FhRPmXKO59oS5ZOcSUmNHExBhhTb66T7mGNH5AOuCVkJrC', '2', '2', '1', 'STUDENT', 1, '', 0, 1, '1', 'kAPRLkRCOk4SSAEMKpKO8udliJoQ9nyYXjsrvRkGKbLiVaq9ZXz1GBnQauWo', '2017-04-17 18:30:51', '2017-04-17 18:41:04'),
(14, 'Daniel', 'Mbuthia', 'danielwandurua@gmail.com', 0, '', '', '$2y$10$AgiBDSb21VH4hieD0SN.MuFyaVmCiUguRbggW7tueMsfYOej7PGXm', '', '', '', '', 1, '', 0, 0, '', '8rWj7hPZaJy1Ww7jhlsB2cH1Pmiv3LXh1I1UKWyIp1Rc1kguhOU67CN5oYCy', '2017-04-17 18:41:52', '2017-04-17 18:41:52'),
(15, 'Joy', 'Mwangi', 'joy@joy.com', 0, '254714876995', 'tuo1-sc211-0104/2013', '$2y$10$ePMh/k.Hpv9LhfZyr7ZETefjhYc4n/gB0jKWPzSObhhi.lrOYQ/Q2', '1', '4', '2', 'STUDENT', 1, '', 0, 1, '1', 'GVMDMB0XqAuiyAhzoKmjWH6txoVHqRTnuekx8Zv5pN4IrmrPKgugQuTDBfUz', '2017-04-17 18:52:44', '2017-04-17 18:54:30'),
(16, 'A', 'B', 'student1@gmail.com', 0, '254714876995', 'tuo1-sc211-0134/2013', '$2y$10$GlELmXUU8RYHI8WmTRbsmukXfAzJtI/HLE83EktNDSMbmgyaglnsa', '1', '3', '1', 'STUDENT', 1, '', 0, 1, '1', 'olDPs2AG8L7YnwdEGvPWSVEMPzqa7AtAewEwwUV8o00bwDK0ONuIGinafkT3', '2017-04-30 07:25:46', '2017-04-30 07:26:18'),
(17, 'gdgs', 'ds', 'd@d.comdd', 0, '', '', '$2y$10$sgkhs5Bv.h4UZejXad3cG.4x.fPQzGD9YMBUD5XkcaPXA3GMf6fGu', '', '', '', '', 1, '', 0, 0, '', NULL, '2017-04-30 07:32:15', '2017-04-30 07:32:15');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` int(10) UNSIGNED NOT NULL,
  `year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` int(25) NOT NULL DEFAULT '1',
  `status` int(5) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `year`, `semester`, `status`, `created_at`, `updated_at`) VALUES
(1, '2016/2017', 1, 0, NULL, '2017-04-16 16:13:15'),
(4, '2016/2017', 2, 1, '2017-04-16 22:52:38', '2017-04-16 22:52:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minidepartments`
--
ALTER TABLE `minidepartments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `records`
--
ALTER TABLE `records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remarks`
--
ALTER TABLE `remarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `minidepartments`
--
ALTER TABLE `minidepartments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `records`
--
ALTER TABLE `records`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `remarks`
--
ALTER TABLE `remarks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
