-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2021 at 12:17 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demo`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_name` text NOT NULL,
  `wedges` int(11) NOT NULL DEFAULT 0,
  `visible` bit(1) NOT NULL DEFAULT b'1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_name`, `wedges`, `visible`) VALUES
('-1-1.png', 6, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(256) NOT NULL,
  `password` varchar(256) NOT NULL,
  `wedges` int(11) NOT NULL,
  `weekly` bit(1) NOT NULL,
  `posts` int(11) NOT NULL,
  `post_files` text NOT NULL,
  `lastEarn` double NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `wedges`, `weekly`, `posts`, `post_files`, `lastEarn`) VALUES
(1, 'root', '$2y$10$gE7WjK1RYHAGb9Sp1JxF3Om53sUiVKEjM86yLy4Z4y.7I.cih0G1m', 36, b'1', 1, '-1-1.png', 1617283251),
(2, 'thingy', '', 4, b'0', 0, '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`wedges`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `minusOne` ON SCHEDULE EVERY 1 DAY STARTS '2021-03-27 19:05:48' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE posts
SET wedges = wedges - (CASE WHEN wedges != 0 THEN 1 ELSE 0 END),
	visible = (CASE WHEN wedges = 0 THEN 0 ELSE 1 END)$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
