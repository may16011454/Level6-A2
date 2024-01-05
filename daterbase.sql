-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 05, 2024 at 03:45 PM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shopa2`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE `equipments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`id`, `name`, `description`, `image`) VALUES
(1, 'tomta', 'tomato ', 'https://www.uvm.edu/content/shared/files/styles/1200/public/uvm-extension-cultivating-healthy-communities/tomatoes2-e.jpg?t=rpri8o'),
(2, 'tomat2', 'omg gif! watch get slice!!!', 'https://images.squarespace-cdn.com/content/v1/587aa287e58c62d26c165dc9/1487386528701-O1PXSY2V21TVIHOMGJH2/image-asset.gif'),
(4, 'orange', 'colouri', 'https://www.allrecipes.com/thmb/y_uvjwXWAuD6T0RxaS19jFvZyFU=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/GettyImages-1205638014-2000-d0fbf9170f2d43eeb046f56eec65319c.jpg'),
(11, 'watermelon', 'melonish', 'https://blog-images-1.pharmeasy.in/2020/08/28152823/shutterstock_583745164-1.jpg'),
(12, 'ironman', 'metal', 'https://i.imgur.com/uhndF3E.jpeg'),
(15, 'Lego', 'brick', 'https://m.media-amazon.com/images/I/41Y-LXWb03L._AC_UF894,1000_QL80_.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `createdOn`, `modifiedOn`) VALUES
(1, 'admin', '2024-01-03 10:38:52', '2024-01-03 10:38:52'),
(2, 'user', '2024-01-05 13:49:28', '2024-01-05 13:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `password` text,
  `email` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `firstname`, `lastname`, `password`, `email`, `role_id`, `createdOn`, `modifiedOn`) VALUES
(2, 'eg1egeran', 'ergergerg', '$2y$10$dnrsO8mMy6RSaDvSO1UxoOLe.0PJopTZzp0FomWbVGcp77Kn0.Um.', '12regregreg@eagerg.com', 2, '2023-11-08 11:50:20', '2024-01-05 15:45:01'),
(3, 'Fred', 'Smith', '$2y$10$OtCIgHEYWtmm2umQShCLBu6KyJ48NefqkRzJ8t2OMCsPof3WnhVhO', 'Fred@Smith.com', 1, '2023-11-15 11:17:49', '2023-11-15 11:17:49'),
(7, 'katie', 'smith', '$2y$10$AKpd5R3rl5PU4aGl0DQK3OE4p3uT19XRWhxCJ/wI5VnQOY8wUXSF2', 'katiesmith2@gmail.com', 1, '2023-11-15 11:37:49', '2023-11-15 14:25:23'),
(9, 'jim', 'smith', '$2y$10$7j56SeGeR5YRMSAjo5LVYu/og703KV1uodU1YDMX73Tg85YNQFTva', 'jimsmith@gmail.com', 1, '2023-11-15 14:31:29', '2023-11-15 14:31:47'),
(10, 'amy', 'smith', '$2y$10$XJpmJ9LHeUUe0dE7YQVf6uQI9.lQcYjV1ks0IEnDb4w0njBZ/cQ/a', 'amysmith@test.com', 1, '2023-11-28 15:03:11', '2023-11-28 15:03:11'),
(12, 'tester', 'testington', '$2y$10$hXvyQOp8Sa.i4TJ4Q1R1D.wzCtpkIdLwW3PJdgHaaYvRDQAYBu6A6', 'test@t.t', 1, '2023-11-29 09:53:05', '2023-11-29 09:53:05'),
(14, 'jack', 'milo', '$2y$10$PEph9OFtBZiZYNQCJeWv1.W9fuYMOTWg1aKGYdzlIxpuQRnrVAOUC', 'jack@milo.com', 1, '2023-11-29 11:40:10', '2023-11-29 11:40:10'),
(17, 'admin', 'admin', '$2y$10$q7VSH4XWPP3X4.trpd0Bm.gcrFW28rlN8Kgad3LfsMvlkqol3iATm', 'admin@admin.com', 2, '2024-01-03 10:42:04', '2024-01-05 15:24:14'),
(19, 'testerererer', 'testington', '$2y$10$rtZUW8.qHnAx7l.WxayjaeCSUzMYDpuEZUI6g48ojJFH0HvOGoxMG', 'testingthetests@test.tes', 1, '2024-01-03 10:59:06', '2024-01-03 10:59:06'),
(22, 'nattest', 'test', '$2y$10$rb0HIlhlYpD7fEl1CorkruMx1Midau9ATp/WXIFhynTJyNrMUWUES', 'natest@gmail.com', 1, '2024-01-03 12:10:16', '2024-01-03 12:10:16'),
(23, 'logan', 'testing', '$2y$10$SL93ILWeFsWcKdiFVagOSuNhLt/F7gickNYMbcom1JiXxZ9SKLWQG', 'logan@mail.net', 1, '2024-01-05 13:47:45', '2024-01-05 13:47:45'),
(24, 'testerererer', 'testhehe', '$2y$10$zIgBCLdSvSt/sUqJ7NUv9eGVlVknb23z5jcUtAyz1doiZXMXKwtb.', 'realme@mail.com', 1, '2024-01-05 15:09:44', '2024-01-05 15:11:20');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
(17, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
