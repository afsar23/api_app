-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 22, 2020 at 07:03 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rest_api_auth_level_2`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(256) NOT NULL,
  `lastname` varchar(256) NOT NULL,
  `access_level` varchar(54) NOT NULL,
  `email` varchar(256) NOT NULL,
  `password` text NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `access_level`, `email`, `password`, `created`, `modified`) VALUES
(9, 'Mikee', 'Dalisay', 'Admin', 'mike@test.com', '$2y$10$DBlhVvsHE6sLXTXQWCeHVe8SO664tGDs3nPtypC77NLmCAEPK3gwa', '2018-09-17 08:16:41', '2019-01-19 02:12:07'),
(12, 'James', 'Harden', 'Customer', 'jame@test.com', '$2y$10$kYP6OZLSsjseQ6IGw.FRCuTkq..Zfc/zXAUwGV4SXhtg8aE6GFiQ.', '2018-09-18 09:52:14', '2019-01-18 14:14:05'),
(14, 'Darwin', 'Dalisay', 'Customer', 'darwin@test.com', '$2y$10$6EIXIZcKxG1Dq.TdeiYyjOeHxiy3K11QC8hWRdWWuQUFXkfUa0i0e', '2019-01-18 01:27:25', '2019-01-18 14:13:53'),
(15, 'LeBron', 'James', 'Customer', 'lebron@test.com', '$2y$10$rdXbT2ySUhdsdpr.oQsgtu7JPL1TAWxAWqtP9vnN1XpM5ZEtwYmAC', '2019-01-18 20:49:49', '2019-01-18 14:13:33'),
(16, 'Pau', 'Gasol', 'Customer', 'pau@test.com', '$2y$10$3KO9jDG8pFyoMSOrtnfGlehTWaCKlW.FXbX6akmgwKxmbz197BCTi', '2019-01-18 20:51:43', '2019-01-18 14:13:19'),
(17, 'Tony', 'Parker', 'Customer', 'tony@test.com', '$2y$10$GcNr.jbRyt5LUyzR2KvdFuM7cXna8WYXHSNJMAU2KgL3lmatezIRW', '2019-01-18 21:36:03', '2019-01-18 14:12:01'),
(18, 'Manu', 'Ginobilli', 'Customer', 'manu@test.com', '$2y$10$6iREh8bpfvlviWNFEJpg/eVT16o/pdI3y92RWyKH6h6ppo89s.CyG', '2019-01-18 21:36:14', '2019-01-18 14:11:39'),
(19, 'Tim', 'Duncan', 'Customer', 'tim@test.com', '$2y$10$QTWoWFqPfu6pxKrpVwxLfOLmMAEzKXzXdQKrmQxhn1CXOUJLJvRY.', '2019-01-18 21:36:47', '2019-01-18 13:36:47'),
(20, 'DeMar', 'DeRozan', 'Customer', 'demar@test.com', '$2y$10$b7Ae5JcqIIUvQLKdQgg0lehYU4v4rFlS7gw6R6YrqahLlGJ86BWiy', '2019-01-18 21:37:01', '2019-01-18 13:37:01'),
(21, 'Derrick', 'White', 'Customer', 'derrick@test.com', '$2y$10$xJHFCV2XsQjiHJuz2Zhcc.EP7pBolv3palVMEHBfaUsiZ0m4uxrf2', '2019-01-18 21:48:59', '2019-01-18 14:11:21'),
(22, 'Rudy', 'Gay', 'Customer', 'rudy@test.com', '$2y$10$SqpjVim/NCGKnNu35djvSesiBqpl6VnJ8FYK9Bn0z1IMxIGWW0p2W', '2019-01-18 21:49:03', '2019-01-18 14:10:59'),
(23, 'Patty', 'Mills', 'Customer', 'patty@test.com', '$2y$10$1yiPpYLz896eSg8eg/9GDeKjkbD44TOkXLseevhdn3AegtMkN3Rwy', '2019-01-18 21:49:03', '2019-01-18 14:11:17'),
(24, 'Drew', 'Eubanks', 'Customer', 'drew@test.com', '$2y$10$RZRxXBbyt44f/yvxo0LUd.ahfM1Mw4TymfbjRtiOeuw4J2WrCieYa', '2019-01-18 21:49:32', '2019-01-18 14:10:16'),
(25, 'Bryn', 'Forbes', 'Customer', 'bryn@test.com', '$2y$10$a7SOct5zCrLUc270spspt.IMrcT6Z.rD1iG5kBVruqRxAXjt24omK', '2019-01-18 21:50:46', '2019-01-18 13:50:46');

--
-- Indexes for dumped tables
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
