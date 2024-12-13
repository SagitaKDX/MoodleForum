-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 09:01 PM
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
-- Database: `moodle_overflow`
--

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `vote_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `is_deleted`, `post_id`, `content`, `author_id`, `createdAt`, `vote_count`) VALUES
(2, 1, 13, 'Comment 2 changed', 2, '2023-10-27 13:27:03', 0),
(4, 1, 13, 'Comment 1noo', 2, '2023-10-27 14:49:35', 0),
(5, 0, 17, 'I have nothing to complain. Well done!', 12, '2023-10-27 15:31:26', 0),
(7, 1, 13, 'Comment 5', 2, '2023-10-28 05:02:10', 0),
(9, 0, 13, 'I wonder how, i wonder why, yesterday you were telling me about the blue blue sky hehehe', 13, '2023-10-31 01:45:59', 1),
(11, 0, 20, 'Good job', 8, '2023-11-01 05:22:40', 0),
(14, 0, 17, 'That\'s correct\r\nHurray', 8, '2023-11-02 15:23:27', 0),
(15, 0, 17, 'Hihihshshshshs', 3, '2023-11-03 02:09:43', 0),
(17, 1, 21, 'I have no idea', 3, '2023-11-07 04:59:29', 0),
(18, 1, 21, 'Hi man', 2, '2023-11-14 05:10:07', 0),
(19, 0, 22, '+1', 2, '2023-11-15 02:50:58', 0),
(20, 0, 21, 'Yeah changed', 3, '2023-11-22 03:39:26', 0),
(21, 0, 21, 'Hi Quân', 8, '2023-11-22 07:24:24', 0),
(22, 1, 17, 'Anyone? Help!', 2, '2023-11-26 16:06:58', 0),
(23, 1, 13, 'sfsd', 17, '2024-12-06 16:12:38', 0),
(24, 1, 14, 'Niga', 18, '2024-12-07 03:33:53', 0),
(25, 0, 13, 'Nigga', 18, '2024-12-07 03:34:07', 2),
(26, 0, 14, 'Yo nigga', 21, '2024-12-07 17:03:08', 0),
(27, 1, 13, 'Noooo', 22, '2024-12-07 17:27:25', 0),
(28, 1, 34, 'sds', 22, '2024-12-08 15:30:47', 0),
(29, 1, 34, 'Yo nigga', 22, '2024-12-08 16:48:08', 1),
(30, 1, 34, 'Yo nigga', 22, '2024-12-08 16:54:02', -1),
(31, 1, 34, '1', 22, '2024-12-08 16:56:12', 0),
(32, 1, 34, 'Accumsan dictum quis bibendum auctor non. Ultricies dignissim malesuada montes lacinia nullam; quisque tristique vestibulum. Ante netus elementum molestie eros nulla aptent bibendum posuere? Torquent hendrerit risus potenti nibh phasellus cursus nulla torquent odio. Nulla lectus mus habitasse porttitor praesent porta turpis class. Tellus ac eros, magna quisque orci rutrum fringilla porta mauris. Penatibus placerat risus maecenas venenatis sapien primis. Potenti cubilia aliquam platea pulvinar dui in arcu? Nibh adipiscing bibendum maecenas facilisi per non sodales.\r\n\r\nViverra consectetur justo cubilia rhoncus pharetra ac ante platea. Integer dolor nibh finibus non; molestie metus bibendum vestibulum. Dolor mus consectetur nam iaculis taciti mollis pulvinar aliquet. Mi habitant urna magna ex ex cursus. Non aliquam curae eleifend himenaeos nisi nullam tortor. Curae elit sapien elit vestibulum id ipsum risus. Volutpat dapibus ultricies aliquam quam neque; tristique mus habitasse. Ex pharetra nam proin, dignissim sit ut auctor.\r\n\r\nFringilla feugiat luctus rutrum eget sagittis erat potenti vestibulum. ', 22, '2024-12-08 17:01:22', -2),
(33, 1, 34, 'sdsds', 22, '2024-12-09 04:05:37', 1),
(34, 0, 13, '1', 22, '2024-12-09 06:57:13', 1),
(35, 0, 34, 'as\r\n', 25, '2024-12-11 01:49:17', 0),
(36, 0, 34, 'sada', 22, '2024-12-11 03:36:06', 1),
(37, 0, 40, 'ngu', 22, '2024-12-12 22:57:41', 1),
(38, 0, 40, 'Hello', 22, '2024-12-13 02:56:15', 1),
(39, 1, 44, 'comment', 22, '2024-12-13 03:21:40', 1),
(40, 0, 45, '222\r\n', 22, '2024-12-13 03:39:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment_votes`
--

CREATE TABLE `comment_votes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_upvote` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment_votes`
--

INSERT INTO `comment_votes` (`id`, `user_id`, `comment_id`, `is_deleted`, `is_upvote`) VALUES
(1, 22, 25, 0, 1),
(2, 22, 9, 0, 1),
(3, 22, 29, 0, 1),
(4, 22, 30, 0, 0),
(5, 22, 31, 0, 0),
(6, 22, 32, 0, 0),
(7, 23, 32, 0, 0),
(8, 23, 31, 0, 1),
(9, 23, 25, 0, 1),
(10, 22, 33, 0, 1),
(11, 22, 34, 0, 1),
(12, 25, 35, 0, 1),
(13, 22, 36, 0, 1),
(14, 22, 35, 0, 0),
(15, 22, 37, 0, 1),
(16, 22, 38, 0, 1),
(17, 22, 39, 0, 1),
(18, 22, 40, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `email_from` varchar(250) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `email_from`, `subject`, `content`, `createdAt`) VALUES
(1, 'namjustin@gmail.com', 'Subject 1', 'content 1', '2023-11-14 03:17:17'),
(2, 'bach@gmail.com', 'Subject 2', 'Content 2', '2023-11-14 03:17:17'),
(3, 'namjustin@gmail.com', 'Subject 3', 'message 3', '2023-11-14 03:43:39'),
(4, 'namjustin@gmail.com', 'Subject 4', 'message 4', '2023-11-14 03:48:55'),
(5, 'namjustin@gmail.com', 'Subject 4', 'message 4', '2023-11-14 03:51:07'),
(6, 'namjustin@gmail.com', 'Subject 4', 'message 4', '2023-11-14 03:51:41'),
(7, 'namjustin@gmail.com', 'Subject 4', 'message 4', '2023-11-14 03:53:18'),
(8, 'bach@gmail.com', 'Subject 5', 'content 5', '2023-11-14 04:52:28'),
(9, 'bach@gmail.com', 'Add module \"Computer Science\"', 'Excuse sir, can you add this module to the system?', '2023-11-26 15:21:26'),
(10, 'bach@gmail.com', '<script>alert(\'Malicious Script\');</script>', '<img src=\"malicious_image.jpg\" onerror=\"alert(\'Malicious Script\');\">', '2023-11-26 18:17:18'),
(11, 'minhltgcs230050@fpt.edu.vn', 'FF', 'Noooo', '2024-12-08 03:20:03'),
(12, 'minhltgcs230050@fpt.edu.vn', 'Please ', '1', '2024-12-08 17:12:12'),
(13, 'hmminhle@gmail.com', 'Please ', '1', '2024-12-09 04:01:06'),
(14, 'minhltgcs230050@fpt.edu.vn', 'Please ', '1', '2024-12-09 05:41:43'),
(15, 'hinhle@gmail.com', 'Please ', '1', '2024-12-11 01:50:34'),
(16, 'minhltgcs230050@fpt.edu.vn', 'Hello', 'Send messages to admin', '2024-12-12 22:36:37'),
(17, 'minhltgcs230050@fpt.edu.vn', 'Hello', 'Test message\r\n', '2024-12-13 02:55:21'),
(18, 'minhltgcs230050@fpt.edu.vn', 'oaooa', '123', '2024-12-13 03:01:00'),
(19, 'minhltgcs230050@fpt.edu.vn', 'Please ', 'contactadmin', '2024-12-13 03:22:58');

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `name` varchar(100) NOT NULL,
  `teacher` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `is_deleted`, `name`, `teacher`) VALUES
(1, 1, 'Networking', 'Danh'),
(3, 0, 'Project Management', 'Tra Luong'),
(4, 1, 'Web Programming 1', 'Thành'),
(7, 1, 'Final Year Project', 'Quốc Anh'),
(9, 1, 'UI/UX Design', 'Henry'),
(10, 1, 'Test', 'Henry'),
(11, 0, 'Web1', 'Tra Luong'),
(12, 0, 'adsadasd', 'asda');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `image` text DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `vote_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `is_deleted`, `title`, `content`, `image`, `module_id`, `author_id`, `createdAt`, `vote_count`) VALUES
(13, 0, 'Post 1', 'content 1', '../uploads/34 Phan Công Danh.png', 3, 3, '2023-10-25 17:00:00', 2),
(14, 0, 'Post 2', 'content 2', '../uploads/Screenshot 2023-10-25 100133.png', 4, 2, '2023-10-25 17:00:00', 0),
(17, 0, 'Someone helps me with the coursework?', 'Please help me!', '../uploads/networking-challenges.png', 1, 2, '2023-10-25 17:00:00', 0),
(20, 0, 'I\'ve finished', 'I have nothing to say!', '../uploads/carbon (6).png', 7, 2, '2023-11-01 04:26:16', 0),
(21, 0, 'My LAN network is crashed', 'Cany someone help me?', '../uploads/UntitledUserPersona (6).png', 1, 3, '2023-11-07 03:12:51', 0),
(22, 1, 'hello', 'mon nay nhu shit', NULL, 3, 2, '2023-11-15 02:50:38', 0),
(23, 0, 'Test post', 'content test', '../uploads/9a557771-a5fd-4a91-885a-1888035129d6.jpg', 7, 2, '2023-11-22 06:59:26', 0),
(24, 1, 'My Gantt Chart Updated', 'This is my Gantt Chart for the coursework. Can someone give me some feedback?', '../uploads/gantt-chart.png', 3, 2, '2023-11-26 13:43:48', 0),
(25, 0, 'aa', 'aa', '../uploads/gantt-chart.png', 10, 2, '2023-11-26 16:46:14', 0),
(26, 1, 'How do I run Apache?', 'Someone please help me. Updated: I can run it now. Thank you so much', '../uploads/cai-dat-xampp-03.png', 4, 14, '2023-11-26 17:20:13', 0),
(27, 0, 'Work Breakdown Structure ', 'I need someone\'s help with the work breakdown structure for the coursework', '../uploads/work-breakdown-structure-example.png', 1, 2, '2023-11-26 17:38:45', 0),
(28, 1, 'Best anime', 'Yo suck', '../uploads/marnie050.jpg', 3, 17, '2024-12-07 02:43:40', 0),
(30, 1, 'Not gud', 'This anime is not good for people who have love problem.', '../uploads/marnie050.jpg', 3, 21, '2024-12-07 16:27:59', 0),
(31, 1, 'coook', 'let him cook please', '../uploads/download.jpg', 3, 22, '2024-12-08 10:03:58', 0),
(32, 1, 'Let himm coook', '1', '../uploads/download.jpg', 3, 22, '2024-12-08 10:09:04', 1),
(33, 1, 'cook', 'cook', '../uploads/download.jpg', 3, 22, '2024-12-08 10:13:30', 0),
(34, 0, '1', '1', '../uploads/9a557771-a5fd-4a91-885a-1888035129d6.jpg', 3, 23, '2024-12-08 10:37:35', -1),
(35, 1, '5', '1', '../uploads/unnamed.jpg', 3, 22, '2024-12-09 07:34:40', 0),
(36, 1, '1', '1', '../uploads/unnamed.jpg', 3, 22, '2024-12-09 07:34:48', 0),
(37, 1, '1', '1', '../uploads/unnamed.jpg', 3, 22, '2024-12-09 07:34:59', 0),
(38, 0, '1', 'ssdasdasd', '../uploads/1.jpg', 3, 25, '2024-12-11 01:50:05', 1),
(39, 1, '1', '1', '../uploads/Screenshot 2024-12-11 100146.png', 3, 22, '2024-12-11 03:33:27', 0),
(40, 0, '1', '123', '../uploads/favicon.png', 3, 22, '2024-12-12 22:05:54', 1),
(41, 1, 'changed', '12333', '../uploads/5hbID520.jpg', 3, 22, '2024-12-12 22:06:12', 0),
(42, 1, 'TraLu', 'Tra', '../uploads/favicon.png', 11, 22, '2024-12-13 02:55:02', 0),
(43, 0, '123', 'minhhiuiuyuiy', '../uploads/favicon.png', 11, 26, '2024-12-13 03:04:33', -1),
(44, 1, 'title', '2424', '../uploads/favicon.png', 3, 22, '2024-12-13 03:20:23', -1),
(45, 0, '1', '1', '../uploads/favicon.png', 3, 27, '2024-12-13 03:34:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `avatar` text NOT NULL DEFAULT 'https://img.freepik.com/premium-vector/man-character_665280-46970.jpg',
  `activation_code` varchar(255) DEFAULT NULL,
  `activate_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `is_deleted`, `is_admin`, `firstname`, `lastname`, `email`, `password`, `avatar`, `activation_code`, `activate_status`) VALUES
(1, 1, 0, 'Danh', 'Phan', 'danhphan141204@gmail.com', '$2y$10$ih.ZteeKLCd9wo9L6q/wd.Hjo/L70XYahuHGuPYyEA8f7PtBAi8jm', '../uploads/A20_0038.png', NULL, 0),
(2, 1, 0, 'Bách', 'Hoàng', 'bach@gmail.com', '$2y$10$IPrClgx1AGRn6YCXeZa69u04WiMDtYP5eAPzioMX/dqIxCmthxR3K', '../uploads/italian.png', NULL, 0),
(3, 0, 0, 'Nam', 'Nguyễn', 'namjustin@gmail.com', '$2y$10$FMIflU99qu8BNTKWFo/S/uIph1CygZIrHgD1T8I7GfOy6/15Hcpx.', 'https://img.freepik.com/premium-vector/man-character_665280-46970.jpg', NULL, 0),
(8, 1, 0, 'Hânn', 'Nguyễn', 'Hannguyen@gmail.com', '$2y$10$hRaIcnYM6FxK0YAgM.lf4OBcf5jPGj3A5NmJNGlrLUK7YwCgwvwsK', 'https://img.freepik.com/premium-vector/man-character_665280-46970.jpg', NULL, 1),
(12, 1, 0, 'Kiệt', 'Khương', 'kiet@gmail.com', '$2y$10$njopL3FbPSgTk3NWslE.N.fmvxycYDq87dM0BRezX1cRSsQZmqpUS', 'https://img.freepik.com/premium-vector/man-character_665280-46970.jpg', NULL, 0),
(13, 1, 0, 'Peter', 'Allen', 'peter.updated@gmail.com', '$2y$10$ZiQ431a788hxl5E3U4puA.zjWP8uLTS7Br8bCt2X2rk19BBaSox6m', 'https://img.freepik.com/premium-vector/man-character_665280-46970.jpg', NULL, 0),
(14, 1, 0, 'Tony', 'Stark', 'tony@gmail.com', '$2y$10$E3SCv0OKrnHfcqt7V4Rb3eNTNkkfI6SRkMB78xkNNwi4bRQ5zZ.cq', 'https://img.freepik.com/premium-vector/man-character_665280-46970.jpg', NULL, 0),
(17, 1, 0, 'Jonh', 'Wick', 'leminh1412@gmail.com', '$2y$10$up89fMx0disz3M6Nw4sOEuU8YCVFrwIdgJPLcQsD5F0C6oSs4.i.2', 'https://img.freepik.com/premium-vector/man-character_665280-46970.jpg', NULL, 0),
(18, 1, 0, 'Jonh', 'Wick', 'minh@fpt.edu.vn', '$2y$10$fmCC2e1yciHgnWxR6GgGceA7cxaAyqM6XvtsL4JCgw4HYkT3yBbQ.', '../uploads/Screenshot 2024-11-23 220055.png', NULL, 0),
(20, 0, 0, 'Jonh', 'Wick', 'minhtgcs230050@fpt.edu.vn', '$2y$10$RxQqtGNbI0RZLqHyBtsJoObMNK3FAfKm6laJ0RSroTRlbbrovPyqm', 'https://img.freepik.com/premium-vector/man-character_665280-46970.jpg', NULL, 0),
(21, 0, 1, 'Jonh', 'Wick', 'leminhl1412@gmail.com', '$2y$10$Rq8l8f4uY3xlRfLNHN6rwu9slHqiSxoDst3mB/eJeMPC6XHS.S48C', 'https://img.freepik.com/premium-vector/man-character_665280-46970.jpg', '31c5dd6996a26aeb3ddcf455665affef', 0),
(22, 0, 0, 'Jonh', 'Wick', 'minhltgcs230050@fpt.edu.vn', '$2y$10$ENfqplILlNKzGBqpb4rSYOEw0ywIDl5Z0RvAX9hgPVRCefohvTsUu', '../uploads/laputa040.jpg', '5a3235a285ea34555c95b5268eaed43a', 0),
(23, 1, 0, 'Jonh', 'Wick', 'hmminhle@gmail.com', '$2y$10$AaRbfHmIyYSPeK4UBDamP.Oqt.rXKbkfBjAtH1APlkYejPLkWtYnO', 'https://img.freepik.com/premium-vector/man-character_665280-46970.jpg', '7d2c4fa4c090079169294223130aea3d', 1),
(24, 0, 0, 'Jonh', 'Wick', 'hmmmminhle@gmail.com', '$2y$10$NpKneoWVDbQOZvj1G/46p.5Go6ri9NgCOistTRWVWG00lsLfSi/p.', 'https://img.freepik.com/premium-vector/man-character_665280-46970.jpg', 'ca727837ec690479528e8d228a999e84', 0),
(25, 0, 0, 'Jonh', 'Wick', 'hinhle@gmail.com', '$2y$10$EJnWldkjURgmF4zQPohWjuar4GtSlot5feQbjxtfqCaBdxGn1Ueby', 'https://img.freepik.com/premium-vector/man-character_665280-46970.jpg', '080e2a5d937a31c6148553ff7dae3f48', 1),
(26, 0, 0, 'Nguyen', 'Minh', 'mn65366@gmail.com', '$2y$10$hEHJu1KA8IbwBKJngg4SHOntV1SG7KRivrqezrS7RQNG6BXoHV65a', 'https://img.freepik.com/premium-vector/man-character_665280-46970.jpg', 'e9cea6d871e467ab46993b4a8ae294e1', 1),
(27, 0, 0, 'Jonh', 'Wick', 'hmmminhle@gmail.com', '$2y$10$dSHz/6rs3A17lPByn2RBfuxcIEGiZXttegzy0AEhvPYwoz5EHkjtq', 'https://img.freepik.com/premium-vector/man-character_665280-46970.jpg', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `is_upvote` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `user_id`, `post_id`, `is_deleted`, `is_upvote`) VALUES
(24, 22, 34, 0, 1),
(25, 22, 32, 0, 1),
(26, 22, 31, 0, 0),
(27, 23, 34, 0, 0),
(28, 23, 31, 0, 1),
(29, 23, 13, 0, 1),
(30, 22, 13, 0, 1),
(31, 25, 34, 0, 0),
(32, 22, 38, 0, 1),
(33, 22, 40, 0, 1),
(34, 22, 44, 0, 0),
(35, 22, 45, 0, 1),
(36, 27, 45, 0, 0),
(37, 27, 43, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `comment_votes`
--
ALTER TABLE `comment_votes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_upvote` (`user_id`,`comment_id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email_from` (`email_from`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`),
  ADD KEY `author_id` (`author_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `comment_votes`
--
ALTER TABLE `comment_votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `module`
--
ALTER TABLE `module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `comment_votes`
--
ALTER TABLE `comment_votes`
  ADD CONSTRAINT `comment_votes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_votes_ibfk_2` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`email_from`) REFERENCES `user` (`email`) ON UPDATE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
