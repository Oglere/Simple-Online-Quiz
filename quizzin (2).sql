-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2025 at 02:45 AM
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
-- Database: `quizzin`
--

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quiz_id` int(11) NOT NULL,
  `teacher` int(11) DEFAULT NULL,
  `title` varchar(32) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `duration` int(2) DEFAULT NULL,
  `status` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`quiz_id`, `teacher`, `title`, `description`, `duration`, `status`) VALUES
(8, 32, 'Math 101', 'Its just basic math...', 1, 'Ongoing');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_answers`
--

CREATE TABLE `quiz_answers` (
  `id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `question` varchar(225) DEFAULT NULL,
  `option_a` varchar(255) NOT NULL,
  `option_b` varchar(255) NOT NULL,
  `option_c` varchar(255) NOT NULL,
  `option_d` varchar(255) NOT NULL,
  `answer` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `quiz_answers`
--

INSERT INTO `quiz_answers` (`id`, `quiz_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `answer`) VALUES
(3, 8, '1 is added by 1 = ?', '1', '2', '3', '4', 'option_b'),
(4, 8, '2 becomes half = ?', '1', '2', '3', '4', 'option_a'),
(5, 8, '3 multiplied by 5 = ?', '5', '10', '15', '20', 'option_c'),
(6, 8, '10 - 6 = ?', '2', '4', '6', '8', 'option_b'),
(7, 8, '420/(360/6)+3 = ?', '1', '10', '100', '1000', 'option_c');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_results`
--

CREATE TABLE `quiz_results` (
  `result_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `total_items` int(11) NOT NULL,
  `percentage` decimal(5,2) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `quiz_results`
--

INSERT INTO `quiz_results` (`result_id`, `student_id`, `quiz_id`, `score`, `total_items`, `percentage`, `remarks`, `created_at`, `updated_at`) VALUES
(5, 28, 8, 3, 5, 60.00, 'Failed', '2025-05-02 01:09:20', '2025-05-02 01:09:20'),
(6, 29, 8, 5, 5, 100.00, 'Passed', '2025-05-02 09:21:52', '2025-05-02 09:21:52');

-- --------------------------------------------------------

--
-- Table structure for table `quiz_sessions`
--

CREATE TABLE `quiz_sessions` (
  `id` int(11) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED NOT NULL,
  `quiz_id` int(11) UNSIGNED NOT NULL,
  `time_end` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quiz_sessions`
--

INSERT INTO `quiz_sessions` (`id`, `student_id`, `quiz_id`, `time_end`) VALUES
(11, 28, 8, '2025-05-02 09:08:59'),
(12, 29, 8, '2025-05-02 17:22:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `status` varchar(8) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `otp` varchar(6) DEFAULT NULL,
  `expire` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `last_name`, `first_name`, `password_hash`, `email`, `role`, `last_login`, `status`, `created_at`, `updated_at`, `otp`, `expire`) VALUES
(17, 'Gelicame', 'Analyn', '$2y$10$yJXx2qlXIu5B/9p7La.RKuxudvl3flQIO.z8c560iBCnv3mXRy..S', 'izecold66@yahoo.com', 'Teacher', '2025-04-27 14:12:24', 'Active', NULL, '2025-04-27 06:12:24', '686187', '2025-04-19 23:14:40'),
(18, 'Malubay', 'Race', '$2y$10$kWbRPZpch9rOEH5tmnM7puIo5lqzyIs2x3bCwJK.IWVLlDG08WcfW', 'student5@gmail.com', 'Student', NULL, 'Deleted', NULL, NULL, NULL, NULL),
(19, 'Survilla', 'Justin Jay', '$2y$10$h53Bd5zVeI5PCR4HSXANV.J3sTWEMHCAp0PxqdSpPmpJ7byDQZqJW', 'student6@gmail.com', 'Student', '2025-04-18 15:26:20', 'Active', NULL, '2025-04-18 07:26:20', NULL, NULL),
(20, 'Virtudazo', 'Kc Mae', '$2y$10$d067u9OL5pM6HgvuD3V7GO1gZgnhzWLwgEePQ4th51iJSWP4XOieK', 'student7@gmail.com', 'Student', NULL, 'Active', NULL, NULL, NULL, NULL),
(21, 'Tajanlangit', 'Ken Ashley', '$2y$10$j1BeDSV0aHGqtM5EgFbJbuuzNWQXWAjkUq7DFjh2Y/WSNmvQfUU1m', 'student8@gmail.com', 'Student', NULL, 'Active', NULL, NULL, NULL, NULL),
(22, 'Ruela', 'Debrah', '$2y$10$SSvdry50L.9BiDyBZNwz1.qQNr3JzqiJkNNBhBpcWpIZF19htKlja', 'student9@gmail.com', 'Student', '2024-11-25 11:05:02', 'Active', NULL, NULL, NULL, NULL),
(23, 'Jumamoy', 'Aaron James', '$2y$10$TynGZIzNfyS1jbF1JFchtuA82CkXE1Kfp.9DAlBF2Hk5SfgpDE3a.', 'teacherMath@gmail.com', 'Teacher', '2024-11-25 13:22:05', 'Active', NULL, NULL, NULL, NULL),
(24, 'Imperial', 'Roy', '$2y$10$S13.3Yuqi8yTucD3XV/EmeZpMfovDb2QtyRdZJmTepT3gXZZpEGei', 'admin@email.com', 'Admin', NULL, 'Active', NULL, NULL, NULL, NULL),
(25, 'Prudenciado', 'Ryan', '$2y$10$wsQiNOy0KGCORGQOvVG6l.sUvoEuOGu6PZ2faAs.27mgQ1bDtFQke', 'POS@email.com', 'Teacher', '2025-04-17 18:43:37', 'Active', NULL, '2025-04-17 10:43:37', NULL, NULL),
(27, 'B', 'HockRock', '$2y$10$3jWGvuIv0z.u1gc2rKy2cOlM0rifitoF4JViVCh3B4fUdz1Ciwvcy', 'adminHockR@email.com', 'Admin', '2025-04-29 15:22:34', 'Active', NULL, '2025-04-29 07:22:34', NULL, NULL),
(28, 'Faller', 'Gayle David', '$2y$10$.MsslYu8VLJBN6xJl/z0Z.tMlqKfJ3AtCixU02KPQEC7l7ajvAe16', 'gambaza66@gmail.com', 'Student', '2025-05-02 17:20:02', 'Active', NULL, '2025-05-02 09:20:02', '823023', '2025-04-20 13:38:44'),
(29, 'Alferez', 'Neil', '$2y$10$lWbpzMg9ydHGZ0mFHu7ZYO.tboIkRqBSwjlmQKrPY9W/e62JHCakW', 'user1@gmail.com', 'Student', '2025-04-12 15:55:11', 'Active', NULL, '2025-04-12 07:55:11', NULL, NULL),
(30, 'Amistoso', 'Jun-rey', '$2y$10$pbLImmq7MFZC3ydZHUihoejTSENrT.zl6jsaZ4vJfOMv2S863oD/2', 'user2@email.com', 'Student', '2025-04-17 17:42:02', 'Active', NULL, '2025-04-17 09:42:02', NULL, NULL),
(31, 'Bautista', 'Trixie', '$2y$10$2Mmd0ie2N1aXNziPqGHFQeRXklBWMcyKAPLppHclJcVDW.TDaGeJa', 'user3@gmail.com', 'Student', '2025-03-31 02:47:46', 'Active', NULL, '2025-03-30 18:47:46', NULL, NULL),
(32, 'Francisco', 'Donald', '$2y$10$P8qY6xKfewvCIO3xuSg5TeSnia8grcEOkg8EE5VTCnA07EUB0LFH.', 'teacher1@gmail.com', 'Teacher', '2025-05-02 17:20:58', 'Active', NULL, '2025-05-02 09:20:58', NULL, NULL),
(33, 'Rodruigez', 'Chrislia', '$2y$10$eILLAFOE8lRlnxeOLeqmfOoNe9fxZAALFnXQuLNMgO.oXGVP/TVmm', 'teacher2@email.com', 'Teacher', NULL, 'Active', NULL, NULL, NULL, NULL),
(34, 'Lehitimas', 'Noel', '$2y$10$KjWL5cFI6IAfBGZKpIvreeWTbHw8X0hUaqOspCJPx2e6GOqu86.NC', 'teacher3@gmail.com', 'Teacher', '2025-05-01 13:12:24', 'Active', NULL, '2025-05-01 05:12:24', NULL, NULL),
(35, 'Nistrator', 'Ammy', '$2y$10$IsrqFAGlmPpMMCc1hycV0e.QnB4uX9vMLZCZ.2wdRw1.T3OxnnbI6', 'admin1@gmail.com', 'Admin', NULL, 'Active', NULL, NULL, NULL, NULL),
(36, 'Quevedo', 'Johnna', '$2y$10$1v2Vyhu34AC5h5LxlBR.ROdgBjNYmax833Lx4PHYtlhmIgEmdhJe.', 'user4@gmail.com', 'Student', NULL, 'Active', NULL, NULL, NULL, NULL),
(37, 'Vacante', 'Jay Lorenz', '$2y$10$OhG5ABenMF8.9SojW/BtjuqjsNFA9aFTMNyXIXhl.Bg.apnF2FJem', 'user5@gmail.com', 'Student', NULL, 'Active', NULL, NULL, NULL, NULL),
(38, 'Indong', 'Sherlyn', '$2y$10$bwtKtArZ.BHbH1EjYEH9CeBE2uQeDG3s6S/OiVwaNlfBe3c0kmjei', 'user6@gmail.com', 'Student', NULL, 'Active', NULL, NULL, NULL, NULL),
(39, 'Igot', 'Don Dave', '$2y$10$TtZw4Yr354KRY56.0eX4LeptEStJw4BpDIbSYjx9aqe4kVq.c/KZq', 'user7@gmail.com', 'Student', NULL, 'Active', NULL, NULL, NULL, NULL),
(40, 'Layasan', 'Roel Jr.', '$2y$10$sYfhDv1hr5JqR7k0CMQWLO7M66J2Z.tnjm1cTPYXsyi7xP5lyk9lG', 'user8@gmail.com', 'Student', NULL, 'Active', NULL, NULL, NULL, NULL),
(41, 'Epe', 'Marc Niño', '$2y$10$LdXeNam0YQ4a4GMmnkyCQOAnEYfC9lfWbtXs9CO3d0zo6RhTwHueq', 'user9@gmail.com', 'Student', '2025-04-20 12:03:18', 'Active', NULL, '2025-04-20 04:03:18', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quiz_id`);

--
-- Indexes for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `quiz_id` (`quiz_id`);

--
-- Indexes for table `quiz_results`
--
ALTER TABLE `quiz_results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `quiz_sessions`
--
ALTER TABLE `quiz_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quiz_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `quiz_results`
--
ALTER TABLE `quiz_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quiz_sessions`
--
ALTER TABLE `quiz_sessions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `quiz_answers`
--
ALTER TABLE `quiz_answers`
  ADD CONSTRAINT `quiz_answers_ibfk_1` FOREIGN KEY (`quiz_id`) REFERENCES `quiz` (`quiz_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
