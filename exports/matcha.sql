-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 23, 2018 at 07:32 AM
-- Server version: 5.6.32
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matcha`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `picname` varchar(255) NOT NULL,
  `liker` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE `pictures` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `current` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pictures`
--

INSERT INTO `pictures` (`id`, `name`, `user`, `current`) VALUES
(1, 'sc-C5rqf.jpg', 'mushagim', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `profilePic` varchar(255) DEFAULT '../uploads/male.jpg',
  `user_name` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `bio` varchar(500) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `preference` varchar(255) NOT NULL DEFAULT 'both',
  `email` varchar(255) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '0',
  `con_code` varchar(255) NOT NULL,
  `noti` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profilePic`, `user_name`, `first_name`, `surname`, `address`, `bio`, `age`, `gender`, `preference`, `email`, `passwd`, `active`, `con_code`, `noti`) VALUES
(1, '10247230_970060659722272_6138054940196570509_n.jpg', 'JoeZeeMo', 'Joseph', 'Ngoma', NULL, 'Just a guy', 25, 'male', 'female', 'joseph.ngoma0707@gmail.com', '$2y$10$owUAuE6mAWzyJedY5xOMa.useGNnYjtiYo2J6MTAEJ5rUDJ6h/oaW', 1, '2700eb2e82686fe825eb4ade183fa4f015e5b9bf47aab1d5aba0a75dc3492fe690e9001382e81b98f03ab0b85b11584ef8e08d21cf252821ac11d15e6ae5910e', 1),
(2, '../uploads/male.jpg', 'Test', 'Test', 'Ing', NULL, '123', 35, 'female', 'female', 'joseph.ngoma@moov.life', '$2y$10$t.3Fw5QPeFPsOCRm8UzZSe0tjbqWRdMUfuadE/Y1SOm8d7XuxB9Mu', 1, '5e43dbd01ff26ba81f169079d84aca463200d073a5f7b9d761e316ea6d598d7ea11731618d53c9dade33cb4caea9805e7dfa85cb1faacf52860f131dae54a2cf', 1),
(3, '10247230_970060659722272_6138054940196570509_n.jpg', 'letssee', 'lets', 'see', NULL, 'Testing', 25, 'male', 'male', 'letssee@mailinator.com', '$2y$10$w/uK2Fp/r2bPizc9YK7KlOwBJ1xEtGMCP1Mw5/uv1FC/mZyn0OqD2', 1, '0d8dc95c5a2ecbb36f4318bb8f80730fe22e1ab69dd8091ccd71dd60aa4bd50f41c8429fdd860033cca8652fba39334e0de4b034b6c8d2e97868e8ad036f9f90', 1),
(5, '../uploads/female.jpg', 'RiRi', 'Ri', 'Ri', NULL, 'Just nje', 25, 'female', 'male', 'riri@mailinator.com', '$2y$10$VKXZKNTAkeq1pHLoIhwsg.cx2Xl/Sy3AaYH0Yv08LzUSVeweeSRbK', 1, '1b4ca46a037ceef0525ff9d0c86496b70045ab093ed80855636471048ce61a4486b2c6c5a926a05130fe9fe1f8d5adc47685ee9dbddf04d41a5c995a1695e1b4', 1),
(6, '../uploads/male.jpg', 'mmayibo', NULL, NULL, NULL, NULL, NULL, NULL, 'both', 'mmayibo@student.wethinkode.co.za', '$2y$10$c/tHjOPT8cSYi3jbT7OjNOKC1ZqPHZjfc/3TNG0V.XNHp2QIzvlhG', 0, 'f59d567669b46ceb5a839725f4caad64ff7783e1707e6bff24f90ce1e819536f814e62b5b76608c710f56661cccf5271d75f39fe7dc78413b76e6d99eeaa344f', 1),
(7, 'sc-C5rqf.jpg', 'mushagim', 'Mushagi', 'Mayibo', NULL, 'Hit me up ladies for hot passionate sex under the stars.', 23, 'male', 'female', 'mshaggi@gmail.com', '$2y$10$I2H9hCpdtDlSaRz21fSer.tlDrhEt9QM51su7k9ZNlAJ1jw7hCVpq', 1, '20b3bae419ff677a9fcd20f3f1cbf89a51c7b905480e2e77b708074168e3b20606fc224c541998323a75030598314dfe036cc660a867cdc7448db7bfdc453c15', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pictures`
--
ALTER TABLE `pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pictures`
--
ALTER TABLE `pictures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
