-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2022 at 03:24 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `fashion`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `price` double NOT NULL,
  `delivery_time` int(11) NOT NULL DEFAULT 1,
  `discount` double NOT NULL DEFAULT 0,
  `likes` int(11) NOT NULL DEFAULT 0,
  `details` longtext NOT NULL,
  `department` char(1) NOT NULL DEFAULT 'U',
  `category` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `brand` varchar(100) NOT NULL DEFAULT 'Local Brand'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`prod_id`, `name`, `description`, `price`, `delivery_time`, `discount`, `likes`, `details`, `department`, `category`, `type`, `brand`) VALUES
(1, 'Nike Air Force 1', 'Nike shoes are the foundation of the sneaker collecting hobby as we know it today. The legacy of the most famous brand in sneakers began in the 1970s when the legendary Oregon track coach Bill Bowerman began cobbling together his own custom-made track spikes and racing flats, eventually pairing with former runner Phil Knight to found the Nike brand in 1972. Nike gained popularity outside of performance athletics during the early 1980s with models such as the Nike Air Force 1, Nike Dunk, and Air Jordan 1, which all became hit lifestyle sneakers on the streets. Nike’s popularity continued to snowball in the 1990s with even more now-iconic models including the Nike Air Max 90, Nike Air Max 95, and Air Jordan 11. Today, Nike is regarded by many as the most stylish and innovative athletic footwear brand in the industry, constantly pushing boundaries in fashion and performance. ', 299, 3, 0, 0, 'Package Dimensions<>13.78 x 9.13 x 4.65 inches; 2.5 Pounds\r\nModel Number<>DC2911-101', 'm', 'shoes', 'slides', 'Nike'),
(2, 'Women’s High-Rise Woven Pants', 'Lets face it. We cant stay pantless forever. As we prime ourselves for more coffee runs and endless commutes, we need a good pair of pants to go the extra mile with us. These roomy pants can keep up, stay up, and hold their shape (even during video calls). Now the only question is, what shoes will you wear?', 79.99, 2, 19.99, 0, 'Made<>61% cotton/39% polyester\r\nModel<>DD5983-010', 'f', 'clothing', 'pants', 'Nike'),
(5, 'Nike Zoom Freak 3', 'Nike shoes are the foundation of the sneaker collecting hobby as we know it today. The legacy of the most famous brand in sneakers began in the 1970s when the legendary Oregon track coach Bill Bowerman began cobbling together his own custom-made track spikes and racing flats, eventually pairing with former runner Phil Knight to found the Nike brand in 1972. Nike gained popularity outside of performance athletics during the early 1980s with models such as the Nike Air Force 1, Nike Dunk, and Air Jordan 1, which all became hit lifestyle sneakers on the streets. Nike’s popularity continued to snowball in the 1990s with even more now-iconic models including the Nike Air Max 90, Nike Air Max 95, and Air Jordan 11. Today, Nike is regarded by many as the most stylish and innovative athletic footwear brand in the industry, constantly pushing boundaries in fashion and performance.', 120, 3, 35.01, 0, 'Package Dimensions<>13.78 x 9.13 x 4.65 inches; 2.5 Pounds\r\nModel<>DA0694-001', 'm', 'shoes', 'basketball', 'Nike');

-- --------------------------------------------------------

--
-- Table structure for table `product_items`
--

CREATE TABLE `product_items` (
  `item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_items`
--

INSERT INTO `product_items` (`item_id`, `product_id`, `name`, `quantity`) VALUES
(3, 1, 'Cactus Jack', 5),
(4, 1, 'Travis Scott Edition', 1),
(6, 2, 'Pink Orange', 5),
(7, 2, 'White', 2),
(8, 2, 'Black', 10),
(9, 5, 'Aqua', 2),
(10, 5, 'Beige', 5),
(11, 5, 'Black, Yellow Stripe', 4),
(12, 5, 'Black, Red Srtipe', 2),
(13, 5, 'Black And White', 1),
(14, 5, 'Pink', 6),
(15, 5, 'White', 3);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `rev_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `text` longtext NOT NULL DEFAULT 'Rated This Product',
  `rate` double(10,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`rev_id`, `user_id`, `product_id`, `text`, `rate`) VALUES
(18, 5, 2, 'I got this for my wife, she really loved it, its comfy and great quality, 100% recommend', 5.0),
(19, 5, 2, 'Update, i got another one fore my daughter', 5.0),
(21, 5, 2, 'Update, i got another one fore my daughter w', 4.5);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL DEFAULT 'user',
  `photo` varbinary(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `fullname`, `email`, `password`, `type`, `photo`) VALUES
(3, 'ali', 'Ali Zein Al Dine', 'alized559@gmail.com', '202cb962ac59075b964b07152d234b70', 'user', ''),
(5, 'msserhan', 'Mohammad Serhan', 'msserhan2002@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'admin', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `product_items`
--
ALTER TABLE `product_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`rev_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_items`
--
ALTER TABLE `product_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `rev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;
