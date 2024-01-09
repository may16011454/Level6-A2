-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 09, 2024 at 09:47 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

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
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Fruits'),
(2, 'Vegetables'),
(4, 'Brooms'),
(6, 'Heavy Machines');

-- --------------------------------------------------------

--
-- Table structure for table `equipments`
--

CREATE TABLE `equipments` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `supplier_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `equipments`
--

INSERT INTO `equipments` (`id`, `name`, `description`, `image`, `supplier_id`, `category_id`) VALUES
(1, 'tomtas', 'tomato ', 'https://www.uvm.edu/content/shared/files/styles/1200/public/uvm-extension-cultivating-healthy-communities/tomatoes2-e.jpg?t=rpri8o', 5, 1),
(2, 'tomat2', 'omg gif! watch get slice!!!', 'https://images.squarespace-cdn.com/content/v1/587aa287e58c62d26c165dc9/1487386528701-O1PXSY2V21TVIHOMGJH2/image-asset.gif', 10, 2),
(4, 'orange', 'colouri', 'https://www.allrecipes.com/thmb/y_uvjwXWAuD6T0RxaS19jFvZyFU=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/GettyImages-1205638014-2000-d0fbf9170f2d43eeb046f56eec65319c.jpg', 1, 1),
(11, 'watermelon', 'melonish', 'https://blog-images-1.pharmeasy.in/2020/08/28152823/shutterstock_583745164-1.jpg', 5, 1),
(12, 'ironman', 'metal', 'https://i.imgur.com/uhndF3E.jpeg', 11, 6),
(30, 'Aldi Broomstick Handle', 'for all of your broomstick needs', 'https://www.rbequestrian.co.uk/images/Red%20Gorilla%20Broom%20Handle%20yellow%20from%20RB%20EQuestrian.jpg', 5, 4);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `createdOn`, `modifiedOn`) VALUES
(1, 'admin', '2024-01-03 10:38:52', '2024-01-03 10:38:52'),
(2, 'user', '2024-01-05 13:49:28', '2024-01-06 23:58:44');

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `contact_email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `name`, `contact_email`) VALUES
(1, 'ASDA', 'asda@grocers.net'),
(3, 'Tesco', 'Tesco@Tesco.uk.com'),
(5, 'Aldi', 'Aldi@supermakets.book'),
(8, 'HomeBargains', 'HB@grocer.gov.uk'),
(10, 'SuperStore', 'SS@SS.com'),
(11, 'Oli', 'Oli@Business.ac.uk');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `password` text,
  `email` varchar(255) DEFAULT NULL,
  `role_id` int DEFAULT NULL,
  `createdOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modifiedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `firstname`, `lastname`, `password`, `email`, `role_id`, `createdOn`, `modifiedOn`) VALUES
(14, 'jack', 'milo', '$2y$10$PEph9OFtBZiZYNQCJeWv1.W9fuYMOTWg1aKGYdzlIxpuQRnrVAOUC', 'jack@milo.com', 2, '2023-11-29 11:40:10', '2024-01-09 20:55:54'),
(17, 'admin', 'admin', '$2y$10$q7VSH4XWPP3X4.trpd0Bm.gcrFW28rlN8Kgad3LfsMvlkqol3iATm', 'admin@admin.com', 2, '2024-01-03 10:42:04', '2024-01-05 15:24:14'),
(22, 'nattest', 'test', '$2y$10$rb0HIlhlYpD7fEl1CorkruMx1Midau9ATp/WXIFhynTJyNrMUWUES', 'natest@gmail.com', 2, '2024-01-03 12:10:16', '2024-01-07 00:29:33'),
(23, 'logan', 'testing', '$2y$10$SL93ILWeFsWcKdiFVagOSuNhLt/F7gickNYMbcom1JiXxZ9SKLWQG', 'logan@mail.net', 2, '2024-01-05 13:47:45', '2024-01-07 00:35:18'),
(25, 'testthefirst', 'raaaa', '$2y$10$4OzGIFBFI5CZ0BT7sHulm.Uux5BOmR2V9X/eBvs.rkrwINV2g5SSS', 'rah@test.net', 2, '2024-01-07 00:05:11', '2024-01-07 00:29:41'),
(40, 'Fake', 'Person', '$2y$10$GCbxwwcpORzF2zNbW/8J1eoTHmDlv6PVq0GqOctCulXkeiaLibi.O', 'real@lol.com', 2, '2024-01-07 01:23:45', '2024-01-07 01:23:45'),
(41, 'Aldi', 'Store', '$2y$10$.D5MWxA/PxbeQusqD4UY3e69usAB/sQdptd7XyKgSwZlBfjS6Z2R6', 'Aldi@store.gov.uk', 1, '2024-01-08 14:35:45', '2024-01-08 14:35:48'),
(42, 'a', 'b', '$2y$10$XFOEoBn/LJydqrauauFxDuzGyyYOBThheS4FO5bSeDNGnJBlvC9DS', 'cs@abc.cn', 2, '2024-01-09 13:23:43', '2024-01-09 13:23:43'),
(43, 'oli', 'olington', '$2y$10$owNFPJKdNtUQslaqc1IUyuRm/i5cPyVD1oEcgIDdWTw1JBnv.kOw2', 'oli@Business.ac.uk', 1, '2024-01-09 19:54:14', '2024-01-09 19:54:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int NOT NULL,
  `role_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
(17, 1),
(41, 1),
(43, 1),
(14, 2),
(22, 2),
(23, 2),
(25, 2),
(40, 2),
(42, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipments`
--
ALTER TABLE `equipments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_equipments_suppliers` (`supplier_id`),
  ADD KEY `fk_category` (`category_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `equipments`
--
ALTER TABLE `equipments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `equipments`
--
ALTER TABLE `equipments`
  ADD CONSTRAINT `fk_category` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_equipments_suppliers` FOREIGN KEY (`supplier_id`) REFERENCES `suppliers` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `user_roles_ibfk_33` FOREIGN KEY (`user_id`) REFERENCES `users` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
