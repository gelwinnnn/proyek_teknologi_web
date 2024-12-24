-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 04:41 PM
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
-- Database: `project_forum`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `join_date` date NOT NULL,
  `profile_picture_link` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`id`, `username`, `pass`, `full_name`, `join_date`, `profile_picture_link`) VALUES
(19, 'nic', 'nic12345', 'Nicholas Sindoro', '2023-12-16', '../assets/profile-picture/Screenshot 2023-12-11 213743.png'),
(20, 'tim', 'tim123', 'Timothy Vieri Chandra', '2023-12-16', '../assets/profile-picture/bg.png'),
(21, 'ger', 'ger', 'Gerry Elnathan Tantosoo', '2023-12-17', '../assets/profile-picture/Screenshot 2023-12-12 224624.png'),
(22, 'gel', 'gel123', 'Gelwin Alfito', '2023-12-17', '../assets/profile-picture/Screenshot (372).png'),
(23, 'bun', 'bun123', 'Christopher Boenadhi?', '2023-12-17', '');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `pass`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `id` int(11) NOT NULL,
  `id_account` int(11) NOT NULL,
  `id_thread` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`id`, `id_account`, `id_thread`) VALUES
(3, 19, 3),
(5, 23, 7),
(8, 23, 1),
(10, 23, 4),
(11, 21, 12),
(12, 21, 7),
(13, 19, 12),
(17, 20, 12),
(18, 20, 3),
(19, 20, 1),
(21, 23, 13),
(22, 23, 12),
(23, 19, 15),
(26, 23, 15),
(28, 21, 40);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `id_account` int(11) NOT NULL,
  `id_thread` int(11) NOT NULL,
  `content` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `id_account`, `id_thread`, `content`) VALUES
(1, 23, 15, 'yeah'),
(2, 19, 15, 'thx'),
(3, 20, 15, 'ok'),
(4, 23, 14, 'hello'),
(5, 22, 14, 'yo!'),
(6, 21, 14, 'welcome'),
(7, 22, 15, 'thanks'),
(8, 22, 13, 'wonderful'),
(9, 22, 13, 'test'),
(10, 22, 14, 'wow'),
(12, 22, 12, 'nice'),
(14, 22, 1, 'first'),
(21, 19, 1, 'yea'),
(22, 19, 1, 'mm'),
(25, 23, 13, 'world'),
(27, 23, 13, 'GM'),
(30, 23, 7, 'eat'),
(31, 20, 3, 'first comment here'),
(32, 21, 13, 'wooo'),
(43, 23, 4, 'hello'),
(46, 21, 40, 'gn');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `id_account` int(11) NOT NULL,
  `id_thread` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `id_account`, `id_thread`) VALUES
(5, 22, 7),
(8, 21, 4),
(9, 21, 3),
(10, 23, 1),
(13, 20, 7),
(15, 19, 7),
(17, 19, 1),
(20, 23, 3),
(22, 20, 12),
(25, 21, 13),
(26, 21, 1),
(27, 23, 13),
(28, 23, 7),
(31, 19, 14),
(36, 23, 14),
(37, 21, 15);

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE `thread` (
  `id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `content` varchar(5000) NOT NULL,
  `post_time` datetime NOT NULL,
  `id_account` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`id`, `title`, `content`, `post_time`, `id_account`) VALUES
(1, 'Title1', 'content11', '2023-12-17 14:00:20', 20),
(3, 'title3', 'content 3', '2023-12-17 14:00:54', 19),
(4, 'Title 4', 'content 4', '2023-12-17 14:01:01', 19),
(7, 'title7', 'laper', '2023-12-17 14:11:44', 19),
(12, 'title9', 'GM', '2023-12-17 17:10:10', 21),
(13, 'Title 10', 'Hello World', '2023-12-17 18:12:42', 20),
(14, 'Drafter', 'Hello All Creatures', '2023-12-17 20:44:55', 23),
(15, 'Announcement', 'This is an announcement', '2023-12-17 22:02:37', 19),
(40, 'good night', 'gn everyone', '2023-12-18 22:33:36', 23);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_account` (`id_account`),
  ADD KEY `id_thread` (`id_thread`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_account` (`id_account`),
  ADD KEY `id_thread` (`id_thread`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_account` (`id_account`),
  ADD KEY `likes_ibfk_2` (`id_thread`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`id`),
  ADD KEY `thread_ibfk_1` (`id_account`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD CONSTRAINT `bookmark_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `bookmark_ibfk_2` FOREIGN KEY (`id_thread`) REFERENCES `thread` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`id_thread`) REFERENCES `thread` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `likes_ibfk_2` FOREIGN KEY (`id_thread`) REFERENCES `thread` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `thread`
--
ALTER TABLE `thread`
  ADD CONSTRAINT `thread_ibfk_1` FOREIGN KEY (`id_account`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
