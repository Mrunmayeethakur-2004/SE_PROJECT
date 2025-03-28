-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2025 at 06:40 AM
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
-- Database: `event_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `event_time` time NOT NULL,
  `location` varchar(255) NOT NULL,
  `category` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `event_banner` varchar(255) NOT NULL,
  `event_brochure` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_name`, `event_date`, `event_time`, `location`, `category`, `description`, `event_banner`, `event_brochure`, `created_at`) VALUES
(1, 'Farewell party', '2025-03-26', '11:00:00', 'College Campus', 'Seminar', 'Final Year Farewell party ', 'uploads/img.png', 'uploads/Brochure.png', '2025-03-26 17:18:48'),
(2, 'Freshers party', '2025-12-29', '10:00:00', 'College Campus', 'Seminar', 'First year welcome party', 'uploads/img.png', 'uploads/Brochure.png', '2025-03-26 17:20:55'),
(3, 'Comedy Show', '2025-03-27', '17:00:00', 'COEP Main Audi', 'Concert', 'It is a comedy show ', 'uploads/banner.png', 'uploads/Brochure.png', '2025-03-26 17:28:51'),
(4, 'Regata', '2025-03-19', '17:00:00', 'Boat club', 'Concert', 'Regata event', 'uploads/banner.png', 'uploads/Brochure.png', '2025-03-27 06:59:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role` enum('user','admin') NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `email`, `password`) VALUES
(1, 'admin', 'mrunmayee123@gmail.com', '$2y$10$dEhFGFzGvF.hFmsmPCvp6.2Wi4kOKJB5yYtq0Wix2X1hepkCt5M0e'),
(2, 'user', 'manu456@gmail.com', '$2y$10$iUkhpHI6gXkVIG5/b.v1suW66avkueBKDeQyNSjPm46uFvd9If4BK'),
(3, 'user', 'Komal234@gmail.com', '$2y$10$eHCt20oAQOh9Hd3QSXIhf.on2sy5OfXAkpZ8GLeTfvce8MyJRWyHK'),
(5, 'admin', 'Komal339@gmail.com', '$2y$10$cOMTb5mzK7r2bOYojtQ0l.z1gXooxC.EYwQocfJNYRM9c77IVekYW'),
(7, 'admin', 'Komal016@gmail.com', '$2y$10$kTYXytW8oS9busaL6FBgrODMttRxlrRV9At/2qUTUXpjKzBPBZasS'),
(8, 'user', 'shravani@gmail.com', '$2y$10$I44zMcXIFcxSuE7NrftdV.z39hSsoUJXkRxIKog9/L8voTWBIYLje'),
(11, 'admin', 'disha2004@gmail.com', '$2y$10$ryvTArekN7hqT8hlwxCBCeMblFJwmccoo7D/Ef/vNGbm9QpT9UaFi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
