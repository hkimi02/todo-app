-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2022 at 10:48 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dsi22_todo_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` int(10) NOT NULL,
  `title` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `due_date` date NOT NULL,
  `complete` tinyint(1) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `title`, `description`, `due_date`, `complete`, `id_user`) VALUES
(10, 'sql', 'tlayel', '2002-05-18', 0, 8),
(13, 'bech tbet ', 'lil', '2022-11-05', 0, 9),
(14, 'taamel sig', 'asap', '2003-05-18', 0, 9),
(16, 'todo app ', 'add user delete or edit ', '2022-11-09', 0, 13),
(18, 'hkimi', 'be9i ahsen aabed fel denya ', '2002-05-18', 0, 18),
(22, 'devlopi bi', 'nwali 9a7boun akther men hmaida hmida(l3asba)', '4684-05-31', 0, 23);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(250) NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `avatar`) VALUES
(8, 'seifallahmaameraaaa', '123@ali.com', '123', './storage/c0df4953d2b7da0746278b226aa083c9.png'),
(9, 'farouk', 'farouk@souei.com', '123', './storage/cd058d5c13fba17f8fe9264881a9aec6.png'),
(10, 'seif', 'seif@9a7ba.com', '321', './storage/bc2b7b3356c019abbcca68db520dae3c.png'),
(11, 'hkimi amin', 'hkimiamin@ieee.org', 'Siamointer08*', './storage/331cd7f2febbe276310aa41c964fb75a.png'),
(12, 'aa', 'aa@gmail.com', '789', './storage/9d793871a15a0a5fa949611858dfd755.png'),
(13, 'hkimiaaaaaaaaaaaaaa', 'hkimiamin02@gmail.com', '123456', './storage/53d4201095a0d03d345f16e70951d9d2.png'),
(15, 'aawatef', 'aawatef@maa.com', '23043296', './storage/a55e0fb4547c8fc6482901d0fc86167e.jpg'),
(16, 'aa', '123@aliaa.com', '789', './storage/b1bc3a1371721cc4d577c3dbd2446f94.png'),
(17, 'azouz binsa', 'azzouz.binsa@gmail.com', '1313', './storage/61639ffdc3fd65497cac4f862879f4e5.jpg'),
(18, 'lyna moujehed ', 'lyna@friends.com', '963', './storage/91073818470896cb4b4c8a4c9767bcd6.jpg'),
(19, 'youssef', 'youssef@chlendi.com', '789', './storage/8cbc5b27b2040e03726be4c8a460aa0f.jpg'),
(21, 'aaa', 'aaa@li.com', '852', './storage/943634e46bf090558be19eb8936abcdf.png'),
(22, 'mohamed amin', 'nerimene@gmail.com', '741', './storage/b1fe914ae89805421d223dd4329f8437.png'),
(23, 'hamza ', 'hamza@hamzagmail.com', '789', './storage/c559c6e116054a469fbd86a3b24da15d.jpg'),
(24, 'hkimi amin', 'ki@li.com', '68053af2923e00204c3ca7c6a3150cf7', './storage/da22ae316e1a4e8a9eb60cb1412454b9.jpg'),
(25, 'seifallahmaamer', 'hkimiamin02@gmail.com', '$2y$10$5vkScEM308Flnb4NCYC/6O8hnzaQeWlVykhaLoRao4Kc/MC8v.gMK', './storage/avatars/09cd0f108dabbf233a22e6d6d411877efbf90a3c.png'),
(26, 'seifallahmaamer', 'rouda@chlendi.com', '$2y$10$KMIaDMf13jjyMHhAFOG5u.WGHzMKTocG/mzz9R1dpfLRxjsnpgGNu', './storage/avatars/d1d47037a57c674efc719d68b56a63d4232d54a5.png'),
(27, 'mariem', 'mariemhkimi@gmail.com', '68053af2923e00204c3ca7c6a3150cf7', './storage/611a65a93cda25a941840c19e443bee3.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `todos`
--
ALTER TABLE `todos`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
