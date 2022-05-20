-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2022 at 09:26 PM
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
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `user_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL DEFAULT '',
  `address` mediumtext NOT NULL DEFAULT '',
  `country` varchar(100) NOT NULL DEFAULT 'Lebanon',
  `code` int(11) NOT NULL DEFAULT 961,
  `phone` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`user_id`, `fullname`, `address`, `country`, `code`, `phone`) VALUES
(5, 'Mohammad Serhan', 'Beirut, Dahie, 24 BLD', 'Lebanon', 961, '70890764'),
(6, 'Mhmd Serhan', 'NWayre, 2 street, bwej ldiwan', 'Lebanon', 961, '036784678');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `link` text NOT NULL,
  `local` int(11) NOT NULL,
  `display_navbar` int(11) NOT NULL,
  `display_footer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `name`, `link`, `local`, `display_navbar`, `display_footer`) VALUES
(2, 'Nike', 'https://www.nike.com/', 0, 1, 1),
(3, 'Addidas', 'https://www.adidas.com/', 0, 1, 1),
(4, 'Gucci', 'https://www.gucci.com/', 0, 1, 1),
(5, 'Grand Outlet', 'https://www.facebook.com/thegrandoutlet/', 1, 1, 0),
(6, 'Big Sale', 'https://bigsale-lb.com/', 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`) VALUES
(1, -1),
(2, -1),
(3, -1),
(4, -1),
(5, -1),
(6, -1),
(7, -1),
(8, -1),
(9, -1),
(10, 5);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `item_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `prod_id` int(11) NOT NULL,
  `prod_item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `data` mediumtext NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`item_id`, `cart_id`, `prod_id`, `prod_item_id`, `quantity`, `data`) VALUES
(29, 1, 2, 6, 1, 'Size: 33.5'),
(32, 1, 5, 12, 1, 'Size: 33.5'),
(33, 1, 1, 3, 2, 'Size: 33.5'),
(36, 2, 2, 8, 1, 'Size: 33.5'),
(37, 2, 1, 4, 1, 'Size: 33.5'),
(38, 3, 5, 9, 1, 'Size: 33.5'),
(39, 3, 2, 8, 1, 'Size: 35'),
(40, 4, 2, 8, 1, 'Size: 33.5'),
(41, 4, 2, 7, 1, 'Size: 34'),
(42, 4, 2, 7, 1, 'Size: 33.5'),
(43, 4, 5, 9, 1, 'Size: 33.5'),
(44, 4, 5, 13, 1, 'Size: 33.5'),
(45, 5, 1, 3, 1, 'Size: 33.5'),
(46, 6, 2, 6, 1, 'Size: 33.5'),
(47, 6, 2, 7, 1, 'Size: 33.5'),
(48, 6, 2, 8, 1, 'Size: 33.5'),
(49, 6, 2, 8, 1, 'Size: 34'),
(50, 7, 5, 9, 2, 'Size: 33.5'),
(51, 7, 2, 8, 10, 'Size: 33.5'),
(52, 8, 1, 4, 1, 'Size: 33.5'),
(54, 9, 1, 4, 1, 'Extra: none'),
(55, 10, 1, 4, 1, 'Size: 43.5'),
(57, 10, 2, 7, 1, 'Extra: none');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`user_id`, `product_id`) VALUES
(5, 5),
(5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `address` mediumtext NOT NULL,
  `country` varchar(255) NOT NULL,
  `countryCode` int(11) NOT NULL,
  `number` text NOT NULL,
  `payment` varchar(255) NOT NULL,
  `cart_items` longtext NOT NULL,
  `state` varchar(255) NOT NULL DEFAULT 'Pending',
  `driver` int(11) NOT NULL DEFAULT -1,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `cart_id`, `fullname`, `address`, `country`, `countryCode`, `number`, `payment`, `cart_items`, `state`, `driver`, `date`) VALUES
(5, 5, 4, 'Mohammad Serhan', 'Beirut, Dahie, 24 BLD 2, right door', 'Lebanon', 961, '70890764', 'LBP 9,099,480', '<a href=<qm>viewProduct.php?id=2<qm>>Women’s High-Rise Woven Pants</a> (Black, Size: 33.5) x 1 LBP 1,560,000 <ilb><a href=<qm>viewProduct.php?id=2<qm>>Women’s High-Rise Woven Pants</a> (White, Size: 34) x 1 LBP 1,560,000 <ilb><a href=<qm>viewProduct.php?id=2<qm>>Women’s High-Rise Woven Pants</a> (White, Size: 33.5) x 1 LBP 1,560,000 <ilb><a href=<qm>viewProduct.php?id=5<qm>>Nike Zoom Freak 3</a> (Aqua, Size: 33.5) x 1 LBP 2,209,740 <ilb><a href=<qm>viewProduct.php?id=5<qm>>Nike Zoom Freak 3</a> (Black And White, Size: 33.5) x 1 LBP 2,209,740 <ilb>', 'Returned', 5, '2022-05-07 11:59:51'),
(6, 6, 5, 'Mhmd Serhan', 'NWayre, 2 street, bwej ldiwan', 'Lebanon', 961, '036784678', 'LBP 7,774,000', '<a href=<qm>viewProduct.php?id=1<qm>>Nike Air Force 1</a> (Cactus Jack, Size: 33.5) x 1 LBP 7,774,000 <ilb>', 'Delivered', 6, '2022-05-07 13:11:42'),
(7, 6, 6, 'Mhmd Serhan', 'NWayre, 2 street, bwej ldiwan', 'Lebanon', 961, '036784678', '240$', '<a href=<qm>viewProduct.php?id=2<qm>>Women’s High-Rise Woven Pants</a> (Pink Orange, Size: 33.5) x 1 60$ <ilb><a href=<qm>viewProduct.php?id=2<qm>>Women’s High-Rise Woven Pants</a> (White, Size: 33.5) x 1 60$ <ilb><a href=<qm>viewProduct.php?id=2<qm>>Women’s High-Rise Woven Pants</a> (Black, Size: 33.5) x 1 60$ <ilb><a href=<qm>viewProduct.php?id=2<qm>>Women’s High-Rise Woven Pants</a> (Black, Size: 34) x 1 60$ <ilb>', 'Pending', -1, '2022-05-07 13:53:16'),
(8, 5, 7, 'Mohammad Serhan', 'Beirut, Dahie, 24 BLD', 'Lebanon', 961, '70890764', 'LBP 20,019,480', '<a href=<qm>viewProduct.php?id=2<qm>>Women’s High-Rise Woven Pants</a> (Black, Size: 33.5) x 10 LBP 15,600,000 <ilb><a href=<qm>viewProduct.php?id=5<qm>>Nike Zoom Freak 3</a> (Aqua, Size: 33.5) x 2 LBP 4,419,480 <ilb>', 'Delivered', 5, '2022-05-07 21:18:35'),
(9, 5, 8, 'Mohammad Serhan', 'Beirut, Dahie, 24 BLD', 'Lebanon', 961, '70890764', '299$', '<a href=<qm>viewProduct.php?id=1<qm>>Nike Air Force 1</a> (Travis Scott Edition, Size: 33.5) x 1 299$ <ilb>', 'Pending', -1, '2022-05-09 18:27:27'),
(10, 5, 9, 'Mohammad Serhan', 'Beirut, Dahie, 24 BLD', 'Lebanon', 961, '70890764', '598$', '<a href=<qm>viewProduct.php?id=1<qm>>Nike Air Force 1</a> (test item, Test2: option 2) x 1 299$ <ilb><a href=<qm>viewProduct.php?id=1<qm>>Nike Air Force 1</a> (Travis Scott Edition, Extra: none) x 1 299$ <ilb>', 'Pending', -1, '2022-05-09 18:53:12');

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
(2, 'Women’s High-Rise Woven Pants', 'Lets face it. We cant stay pantless forever. As we prime ourselves for more coffee runs and endless commutes, we need a good pair of pants to go the extra mile with us. These roomy pants can keep up, stay up, and hold their shape (even during video calls). Now the only question is, what shoes will you wear?', 79.99, 2, 19.99, 1, 'Made<>61% cotton/39% polyester\r\nModel<>DD5983-010', 'f', 'clothing', 'pants', 'Nike'),
(5, 'Nike Zoom Freak 3', 'Nike shoes are the foundation of the sneaker collecting hobby as we know it today. The legacy of the most famous brand in sneakers began in the 1970s when the legendary Oregon track coach Bill Bowerman began cobbling together his own custom-made track spikes and racing flats, eventually pairing with former runner Phil Knight to found the Nike brand in 1972. Nike gained popularity outside of performance athletics during the early 1980s with models such as the Nike Air Force 1, Nike Dunk, and Air Jordan 1, which all became hit lifestyle sneakers on the streets. Nike’s popularity continued to snowball in the 1990s with even more now-iconic models including the Nike Air Max 90, Nike Air Max 95, and Air Jordan 11. Today, Nike is regarded by many as the most stylish and innovative athletic footwear brand in the industry, constantly pushing boundaries in fashion and performance.', 120, 3, 35.01, 1, 'Package Dimensions<>13.78 x 9.13 x 4.65 inches; 2.5 Pounds\r\nModel<>DA0694-001', 'm', 'shoes', 'basketball', 'Nike'),
(8,'LeBron 19 Low','LeBron plays less in the paint and more at the point, so it makes sense that he wants to feel a little quicker. His 19th signature gives you the feeling of containment but with a lower, lighter design thats ideal for fast, strong players like LeBron who stretch the court.',160,14,0,0,'Made<>','m','shoes','basketball','Nike'),
(9,'LeBron 19','LeBron thrives when stakes are high and the pressure’s on. The LeBron 19 harnesses that energy with a locked-in fit and an updated cushioning system. The snug inner sleeve is pulled together by a sculpted overlay that the laces feed through to help prevent the foot from moving inside the shoe. Cushioned pods around the collar and tongue add comfort while reducing weight, giving players the secure feel and confidence to go all out when the game is on the line.',200,10,0,0,'Made<>','m','shoes','basketball','Nike'),
(10,'LeBron Witness 6','For this iteration of the LeBron Witness, we swapped out Zoom Air for visible Max Air cushioning—LeBrons favorite—to help dissipate impact forces and provide a responsive sensation. The lightweight, reinforced mesh upper keeps you contained all around, from the webbing that harnesses your forefoot to the external molded pieces that lock in your heel.',100,9,0,0,'Made<>','m','shoes','basketball','Nike'),
(11,'Kyrie Low 5','Kyrie twists defenders into knots using his footwork and ball handling, creating the space he needs to make the play. Designed for his quick, crafty game, the Kyrie Low 5 enables players who utilize their speed and multidirectional ability to stay in control while taking advantage of the separation they create.',110,12,0,0,'Made<>','m','shoes','basketball','Nike'),
(12,'Nike Metcon 7 AMP','The Nike Metcon 7 AMP is the gold standard for weight training—even tougher and more stable than previous versions. Weve also added React foam that ups the comfort to keep you ready for high-intensity cardio. Plus, a tab locks down your laces so you can forget about them coming untied when youre focused on your next PR.',140,14,0,0,'Made<>','m','shoes','training','Nike'),
(13,'Nike Vapor Edge Elite 360 Flyknit','Engineered for speed, the Nike Vapor Edge Elite 360 Flyknit offers a new degree of agility. Its internal full-foot plate creates flexible support, while wide stud placements let you cut like never before. Its stretchy Flyknit construction combines with a NikeSkin overlay to create a sock-like fit with a fast feel.',200,10,0,0,'Made<>','m','shoes','football','Nike');
-- --------------------------------------------------------

--
-- Table structure for table `product_items`
--

CREATE TABLE `product_items` (
  `item_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `extra_name` varchar(100) NOT NULL DEFAULT '',
  `extra_options` text NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_items`
--

INSERT INTO `product_items` VALUES
(6,2,'Pink Orange',5,'',''),
(7,2,'White',2,'',''),
(8,2,'Black',10,'',''),
(9,5,'Aqua',0,'',''),
(10,5,'Beige',3,'',''),
(11,5,'Black, Yellow Stripe',4,'',''),
(12,5,'Black, Red Srtipe',2,'',''),
(13,5,'Black And White',0,'',''),
(14,5,'Pink',5,'',''),
(15,5,'White',2,'',''),
(20,8,'Black Red White',6,'Size','42\r\n42.5\r\n43\r\n44'),
(21,9,'Siren Red',20,'Size','42\r\n43\r\n44\r\n44.5\r\n45'),
(22,9,'Blue Lime',5,'Size','39\r\n40\r\n42\r\n44'),
(23,9,'White Black Gold',3,'Size','43\r\n44\r\n44.5\r\n45'),
(24,9,'Black Violet White',4,'Size','44\r\n45'),
(25,9,'Black Red',15,'Size','42\r\n43\r\n44'),
(26,9,'Orange Red Blue',2,'Size','42\r\n43\r\n44\r\n44.5'),
(27,10,'Black Sequoia',20,'Size','39\r\n40\r\n41\r\n42'),
(28,10,'Platinum White',7,'Size','40\r\n42\r\n45'),
(29,10,'White Violet',5,'Size','42\r\n43\r\n44\r\n45'),
(30,10,'Black Obsidian',3,'Size','44\r\n44.5\r\n45\r\n46'),
(31,10,'Black Royal',5,'Size','39\r\n40\r\n41\r\n44'),
(32,11,'Black White',8,'Size','40\r\n41\r\n42\r\n44'),
(33,11,'White Ash',4,'Size','40\r\n44\r\n45\r\n46'),
(34,12,'Marine Blue',7,'Size','40\r\n41\r\n43'),
(35,12,'Spruce White',4,'Size','42\r\n43\r\n44'),
(36,13,'Black White',6,'Size','38\r\n39\r\n40\r\n41'),
(37,13,'Black Grey',10,'Size','40\r\n41\r\n42\r\n43\r\n44\r\n45\r\n46');

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
(30, 5, 5, 'i like this product', 5.0);

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
(5, 'msserhan', 'Mohammad Serhan', 'msserhan2002@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'admin', ''),
(6, 'msserhan2', 'Mhmd Serhan', 'toxicscripts1@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'driver', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

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
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_items`
--
ALTER TABLE `product_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `rev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;
