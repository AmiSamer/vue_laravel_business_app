-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 02:17 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `business_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(5, '2014_10_12_000000_create_users_table', 1),
(6, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(7, '2019_08_19_000000_create_failed_jobs_table', 1),
(8, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2023_11_02_055836_create_roles_table', 2),
(10, '2014_10_12_100000_create_password_resets_table', 3),
(11, '2023_11_13_102049_create_sales_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Master Admin', '2023-11-02 08:34:51', '2023-11-02 08:34:51'),
(2, 'Admin', '2023-11-02 08:34:51', '2023-11-02 08:34:51'),
(3, 'Member', '2023-11-02 08:35:57', '2023-11-02 08:35:57');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `selling_date` date DEFAULT NULL,
  `product_name` text NOT NULL,
  `product_price` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_selling_price` double(8,2) NOT NULL,
  `receipt_image` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `user_id`, `role_id`, `selling_date`, `product_name`, `product_price`, `quantity`, `total_selling_price`, `receipt_image`, `created_at`, `updated_at`) VALUES
(4, 3, 3, NULL, 'Bag', 2400.00, 2, 4800.00, NULL, '2023-11-23 00:26:37', '2023-11-23 00:26:37'),
(5, 3, 3, NULL, 'Earrings', 1200.00, 2, 2400.00, NULL, '2023-11-23 00:26:54', '2023-11-23 00:26:54'),
(18, 2, 3, '2023-12-05', 'Iron gate', 1200.00, 2, 2400.00, NULL, '2023-12-05 01:07:21', '2023-12-05 01:07:21'),
(19, 2, 3, '2023-12-05', 'Iron Window', 550.00, 4, 2200.00, NULL, '2023-12-05 01:07:45', '2023-12-05 01:07:45'),
(20, 2, 3, '2023-12-05', 'Iron Rod', 2500.00, 4, 10000.00, 'sale_receipt/202312051701760115.jpg', '2023-12-05 01:08:16', '2023-12-05 01:08:35'),
(21, 2, 3, '2023-12-04', 'test product', 1452.00, 5, 7260.00, NULL, '2023-12-05 01:09:12', '2023-12-05 01:09:12'),
(22, 3, 3, '2023-12-05', 'sharee', 1250.00, 2, 2500.00, NULL, '2023-12-05 01:47:32', '2023-12-05 01:47:32'),
(23, 2, 3, '2023-11-14', 'Iron gates', 1200.00, 9, 10800.00, NULL, '2023-12-05 08:19:11', '2023-12-05 12:58:52'),
(24, 2, 3, '2023-11-09', 'iron gates', 2500.00, 1, 2500.00, NULL, '2023-12-05 08:19:30', '2023-12-05 08:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) DEFAULT 3 COMMENT '1 = Master admin, 2 = Admin, 3 = Member',
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0 COMMENT '0 = deactivate\r\n1 = activate',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Abul Kauser Samer', 'acquaintsam@gmail.com', NULL, '$2y$10$v1omsO1YmJuULvm2sH3bsuUzA0qYVnFpzDSqxN6lmAhrJIwwd6dzi', 1, NULL, '2023-11-08 00:20:12', '2023-11-08 00:20:12'),
(2, 3, 'Rakib Hasan Rahat', 'rahat@gmail.com', NULL, '$2y$10$eo3iweIRMpXGnGi/apXK6.P8w606I7lDaWqnoxTETUCgikPztpKsq', 1, NULL, '2023-11-08 00:23:20', '2023-12-05 12:58:09'),
(3, 3, 'Kamrun Nahar', 'eva@gmail.com', NULL, '$2y$10$niuW4.x.y.BTxNoe.LIgDuQ.WdsUsL3Z2.pfyvX6XxBNG1rwyD.0.', 0, NULL, '2023-11-23 00:26:07', '2023-12-05 12:35:18'),
(4, 0, 'test user', 'testu@gmail.com', NULL, '$2y$10$H4R9mpF10S.w8lLxO0zgDuLt27XuhJu5cALrhj5AsQzsuRJPqbY4C', 0, NULL, '2023-12-04 08:33:52', '2023-12-04 08:33:52'),
(5, 0, 'rr', 'ev@gmail.com', NULL, '$2y$10$ZsZK08MLqjyGrCmFA/Z/zuhayvpCBD/hXbJFQt1nvtoSnUiiyj3Tu', 0, NULL, '2023-12-05 00:16:51', '2023-12-05 00:16:51'),
(6, 0, 'ss', 'ess@gmail.com', NULL, '$2y$10$27cfgDRuC9GYKRlBb2HTFuWy.yX27tpnuaYgGT42wmY94eOgiCTvy', 0, NULL, '2023-12-05 00:23:53', '2023-12-05 00:23:53'),
(7, 3, 'ssssssssss', 'aa@gmail.com', NULL, '$2y$10$RHfdPEHkyGNwA9DUf0MqqOQ9PGo/pADP7YmuT0KpTAi6xfjVyIEqu', 0, NULL, '2023-12-05 11:35:43', '2023-12-05 11:35:43'),
(8, 3, 'kkkkkkkkkk', 'kk@gmail.com', NULL, '$2y$10$ZiR6pBRHXFzHGcKd8gBxLOKUF/.7QT8NDnBBA15tJ.LdSYzS9weqi', 0, NULL, '2023-12-05 11:39:45', '2023-12-05 11:39:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
