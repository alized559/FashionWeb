-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2022 at 10:33 PM
-- Server version: 10.3.32-MariaDB-0ubuntu0.20.04.1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

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
(5, 'Mhmd Serhan', 'test 123', 'Lebanon', 961, '78836784'),
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
(3, 'Adidas', 'https://www.adidas.com/', 0, 1, 1),
(4, 'Gucci', 'https://www.gucci.com/', 0, 1, 1),
(5, 'Grand Outlet', 'https://www.facebook.com/thegrandoutlet/', 1, 1, 0),
(6, 'Big Sale', 'https://bigsale-lb.com/', 1, 1, 0),
(10, 'Pellini', 'https://www.pellini-collection.com/', 1, 1, 1);

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
(10, -1),
(11, -1),
(12, -1);

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
(57, 10, 2, 7, 2, 'Extra: none'),
(58, 10, 8, 20, 3, 'Size: 42'),
(59, 11, 2, 8, 1, 'Extra: none'),
(60, 11, 5, 15, 1, 'Extra: none'),
(61, 12, 1, 38, 1, 'Size: 39'),
(62, 12, 2, 6, 2, 'Extra: none');

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
(5, 2),
(5, 1);

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
(10, 5, 9, 'Mohammad Serhan', 'Beirut, Dahie, 24 BLD', 'Lebanon', 961, '70890764', '598$', '<a href=<qm>viewProduct.php?id=1<qm>>Nike Air Force 1</a> (test item, Test2: option 2) x 1 299$ <ilb><a href=<qm>viewProduct.php?id=1<qm>>Nike Air Force 1</a> (Travis Scott Edition, Extra: none) x 1 299$ <ilb>', 'Pending', -1, '2022-05-09 18:53:12'),
(11, 5, 10, 'Mohammad Serhan', 'Beirut, Dahie, 24 BLD', 'Lebanon', 961, '70890764', '600$', '<a href=<qm>viewProduct.php?id=2<qm>>Women’s High-Rise Woven Pants</a> (White, Extra: none) x 2 120$ <ilb><a href=<qm>viewProduct.php?id=8<qm>>LeBron 19 Low</a> (Black Red White, Size: 42) x 3 480$ <ilb>', 'Pending', -1, '2022-05-20 16:54:33'),
(12, 5, 11, 'Mhmd Serhan', 'Nwayre Zaydan', 'Lebanon', 961, '78836784', '144.99$', '<a href=<qm>viewProduct.php?id=2<qm>>Women’s High-Rise Woven Pants</a> (Black, Extra: none) x 1 60$ <ilb><a href=<qm>viewProduct.php?id=5<qm>>Nike Zoom Freak 3</a> (White, Extra: none) x 1 84.99$ <ilb>', 'Pending', -1, '2022-05-21 02:41:18'),
(13, 5, 12, 'Mhmd Serhan', 'test 123', 'Lebanon', 961, '78836784', '419$', '<a href=<qm>viewProduct.php?id=1<qm>>Nike Air Force 1</a> (Cactus Jack, Size: 39) x 1 299$ <ilb><a href=<qm>viewProduct.php?id=2<qm>>Women’s High-Rise Woven Pants</a> (Pink Orange, Extra: none) x 2 120$ <ilb>', 'Pending', -1, '2022-05-21 02:49:09');

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
(1, 'Air Force 1', 'Nike shoes are the foundation of the sneaker collecting hobby as we know it today. The legacy of the most famous brand in sneakers began in the 1970s when the legendary Oregon track coach Bill Bowerman began cobbling together his own custom-made track spikes and racing flats, eventually pairing with former runner Phil Knight to found the Nike brand in 1972. Nike gained popularity outside of performance athletics during the early 1980s with models such as the Nike Air Force 1, Nike Dunk, and Air Jordan 1, which all became hit lifestyle sneakers on the streets. Nike’s popularity continued to snowball in the 1990s with even more now-iconic models including the Nike Air Max 90, Nike Air Max 95, and Air Jordan 11. Today, Nike is regarded by many as the most stylish and innovative athletic footwear brand in the industry, constantly pushing boundaries in fashion and performance. ', 299, 3, 0, 1, 'Package Dimensions<>13.78 x 9.13 x 4.65 inches; 2.5 Pounds\r\nModel Number<>DC2911-101', 'm', 'shoes', 'slides', 'Nike'),
(2, 'High-Rise Woven Pants', 'Lets face it. We cant stay pantless forever. As we prime ourselves for more coffee runs and endless commutes, we need a good pair of pants to go the extra mile with us. These roomy pants can keep up, stay up, and hold their shape (even during video calls). Now the only question is, what shoes will you wear?', 79.99, 2, 19.99, 1, 'Made<>61% cotton/39% polyester\r\nModel<>DD5983-010', 'f', 'clothing', 'pants', 'Nike'),
(5, 'Zoom Freak 3', 'Nike shoes are the foundation of the sneaker collecting hobby as we know it today. The legacy of the most famous brand in sneakers began in the 1970s when the legendary Oregon track coach Bill Bowerman began cobbling together his own custom-made track spikes and racing flats, eventually pairing with former runner Phil Knight to found the Nike brand in 1972. Nike gained popularity outside of performance athletics during the early 1980s with models such as the Nike Air Force 1, Nike Dunk, and Air Jordan 1, which all became hit lifestyle sneakers on the streets. Nike’s popularity continued to snowball in the 1990s with even more now-iconic models including the Nike Air Max 90, Nike Air Max 95, and Air Jordan 11. Today, Nike is regarded by many as the most stylish and innovative athletic footwear brand in the industry, constantly pushing boundaries in fashion and performance.', 120, 3, 35.01, 1, 'Package Dimensions<>13.78 x 9.13 x 4.65 inches; 2.5 Pounds\r\nModel<>DA0694-001', 'u', 'shoes', 'basketball', 'Nike'),
(8, 'LeBron 19 Low', 'LeBron plays less in the paint and more at the point, so it makes sense that he wants to feel a little quicker. His 19th signature gives you the feeling of containment but with a lower, lighter design thats ideal for fast, strong players like LeBron who stretch the court.', 160, 14, 0, 0, 'Model<>CZ0203-004', 'u', 'shoes', 'basketball', 'Nike'),
(9, 'LeBron 19', 'LeBron thrives when stakes are high and the pressure’s on. The LeBron 19 harnesses that energy with a locked-in fit and an updated cushioning system. The snug inner sleeve is pulled together by a sculpted overlay that the laces feed through to help prevent the foot from moving inside the shoe. Cushioned pods around the collar and tongue add comfort while reducing weight, giving players the secure feel and confidence to go all out when the game is on the line.', 200, 10, 0, 0, 'Model<>DQ8344-600', 'u', 'shoes', 'basketball', 'Nike'),
(10, 'LeBron Witness 6', 'For this iteration of the LeBron Witness, we swapped out Zoom Air for visible Max Air cushioning—LeBrons favorite—to help dissipate impact forces and provide a responsive sensation. The lightweight, reinforced mesh upper keeps you contained all around, from the webbing that harnesses your forefoot to the external molded pieces that lock in your heel.', 100, 9, 0, 0, 'Model<>CZ0204-501', 'm', 'shoes', 'basketball', 'Nike'),
(11, 'Kyrie Low 5', 'Kyrie twists defenders into knots using his footwork and ball handling, creating the space he needs to make the play. Designed for his quick, crafty game, the Kyrie Low 5 enables players who utilize their speed and multidirectional ability to stay in control while taking advantage of the separation they create.', 110, 12, 0, 0, 'Model<>DJ6012-800', 'm', 'shoes', 'basketball', 'Nike'),
(12, 'Nike Metcon 7 AMP', 'The Nike Metcon 7 AMP is the gold standard for weight training—even tougher and more stable than previous versions. Weve also added React foam that ups the comfort to keep you ready for high-intensity cardio. Plus, a tab locks down your laces so you can forget about them coming untied when youre focused on your next PR.', 140, 14, 0, 0, 'Made<>CW3935-005', 'm', 'shoes', 'training', 'Nike'),
(13, 'Nike Vapor Edge Elite 360 Flyknit', 'Engineered for speed, the Nike Vapor Edge Elite 360 Flyknit offers a new degree of agility. Its internal full-foot plate creates flexible support, while wide stud placements let you cut like never before. Its stretchy Flyknit construction combines with a NikeSkin overlay to create a sock-like fit with a fast feel.', 200, 10, 0, 0, 'Model<>DO2494-260', 'm', 'shoes', 'football', 'Nike'),
(14, 'Nike Zoom Metcon Turbo 2', 'The Nike Zoom Metcon Turbo 2 puts a shot of adrenalizing speed into your everyday workout. It combines stability and responsiveness in a lightweight package to help you move quickly during circuit training, high intensity intervals on the treadmill, a squeezed-in cardio workout on the way home whatever you choose. From the Zoom Air cushioning underfoot to the rope wrap at the instep, every detail is pared down to minimize weight while maximizing function and durability. Lighter, stronger materials are built for speed and strength.', 150, 10, 0, 0, 'Model<>DA3130-101', 'm', 'shoes', 'training', 'Nike'),
(15, 'Nike Vapor Edge Elite 360', 'Engineered for speed, the Nike Vapor Edge Elite 360 offers a new degree of agility. Its internal full-foot plate creates flexible support, while wide stud placements help you cut fast. 360 degrees of Flyknit construction around your foot combines with a NikeSkin overlay to create a lightweight, fast feel with a socklike fit. Set the stage for a bold and expressive future in a design made to help you live out your football dreams.', 200, 7, 10, 0, 'Model<>CW3143-005', 'm', 'shoes', 'football', 'Nike'),
(16, 'Nike Revolution 5', 'When the road beckons, answer the call in a lightweight pair that’ll keep you moving mile after mile. Soft foam cushions your stride, and a reinforced heel delivers a smooth, stable ride. Crafted with knit material for breathable support, while a minimalist design fits in just about anywhere your day takes you.', 48, 10, 10, 0, 'Model<>DO8965-002', 'm', 'shoes', 'walking', 'Nike'),
(17, 'Nike Pegasus Trail 3', 'Find your wings with an off-road run. The Nike Pegasus Trail 3 has the same comfort you love, with a design that nods to the classic Pegasus look. Nike React foam delivers responsive cushioning while tough traction helps you stay moving through rocky terrain. More support around the midfoot helps you feel secure on your journey.', 130, 8, 0, 0, 'Model<>CW3143-005', 'm', 'shoes', 'walking', 'Nike'),
(18, 'Nike Air Max Cirro', 'Whether youre hitting the gym or headed to the store, weve created a perfect go-between that delivers quick style and incredible comfort. Large, visible Air in the heel pairs with a comfy foam footbed for a striking statement in comfort.', 50, 5, 0, 0, 'Model<>DD9311-003', 'm', 'shoes', 'slides', 'Nike'),
(19, 'Jordan LS', 'Courtside or beachside, these slides pair step-in comfort with functional design. The adjustable heel strap adds support when you need it and the classic foam footbed is molded for your comfort.', 85, 10, 9.99, 0, 'Model<>DC3725-002', 'm', 'shoes', 'slides', 'Nike'),
(20, 'Nike Sportswear Club', 'Dreamy watercolor florals elevate these everyday joggers. Hype these with a matching hoodie and your favorite sneakers, and watch heads turn.', 70, 14, 0, 0, 'Model<>CZ9907-001\r\nMade<>80% cotton/20% polyester', 'm', 'clothing', 'pants', 'Nike'),
(21, 'Jordan Dri-FIT Air', 'Do it all in the Jordan Dri-FIT Air Fleece Pants. Designed to wear on or off the court, they combine the utility and look of streetwear with performance materials and a tailored fit you can play in. This product is made with at least 50% recycled polyester fibers.', 90, 9, 0, 0, 'Model<>CZ1000-001\r\nMade<>78% polyester/22% cotton. Overlays: 100% polyester', 'm', 'clothing', 'pants', 'Nike'),
(22, 'Free Metcon 4', 'Our latest Metcon combines flexibility with stability to help you get the most out of your training program. Updated \"chain-link\" mesh cools and flexes as you speed through agility drills, while support at the midfoot and heel braces you for your heaviest sets in the weight room.', 120, 2, 0, 0, 'Model<>DJ4310-074', 'f', 'shoes', 'training', 'Nike'),
(23, 'Graphics Camo Hoodie', 'Its just something thats never going away. Obviously were talking about camo. Its not season, occasion or style dependent. What it is, is GOOD. Which is extra clear with this adidas hoodie. Undeniable, you could say, with the bold refresh on the classic print. Also good is the comfort that the soft fleece build provides, along with the ribbed details, so you can settle in fully wherever the day takes you.', 65, 10, 30, 0, 'Model<>AH9907-001\r\nMade<>70% cotton, 30% recycled polyester fleece', 'm', 'clothing', 'hoodies', 'Adidas'),
(24, 'Cloudfoam Pure 2.0 Shoes', 'Whatever your day has in store, move through it in comfort and confidence with these shoes. Inspired by adidas running footwear, they combine a lightweight and breathable fit with premium cushioning under foot, so every step is as effortless as the one before it. Pair them with tights and a tank top as you head for the yoga studio, or match them up with your favorite track pants and hoodie for a casual outing with friends.\r\n\r\nMade with a series of recycled materials, the upper features at least 50% recycled content. This product represents just one of our solutions to help end plastic waste.', 75, 2, 12, 0, 'Model<>GY4485\r\nOrigin<>Imported', 'f', 'shoes', 'walking', 'Adidas'),
(25, 'Mercurial Superfly 8 Elite FG', 'The Nike Mercurial Superfly 8 Elite FG features a new look with specialized components to let you play your fastest from start to finish. A stretchy collar provides extra support, and the innovative plate provides instant responsiveness for quicker cuts at high speeds.', 275, 3, 0, 0, 'Model<>DJ2839-007', 'f', 'shoes', 'football', 'Nike'),
(26, 'Predator Edge.3', 'Swerve. Power. Control. When you have the edge, the pitch is full of possibilities. See the beautiful game from a brand-new angle in adidas Predator. These soccer cleats help you dominate the ball with a Control Zone upper containing strategically placed areas of grip-enhancing print. Underneath, a striking faceted outsole keeps you in charge on firm ground. Up top, a stretchy two-piece collar delivers a supportive fit.', 90, 2, 0, 0, 'Model<>GW2274\r\nOrigin<>Imported', 'f', 'shoes', 'football', 'Adidas'),
(27, 'Adicolor Essentials Trefoil Hoodie', 'Witness the evolution of cozy. This adidas hoodie updates a casual wardrobe staple with plush heavy fleece. Pull it on, flip up the hood and tuck your hands in the kangaroo pocket. Boom. Seriously cozy. Bonus points for minimalist style.', 55, 9, 0, 0, 'Mode<>HE9420\r\nMade<>70% cotton, 30% recycled polyester fleece', 'm', 'clothing', 'hoodies', 'Adidas'),
(28, 'ZoomX Vaporfly', 'Continue the next evolution of speed with a racing shoe made to you help chase new goals and records. It helps improve comfort and breathability with a redesigned upper. From a 10K to a marathon, this model, like the previous version, has the responsive cushioning and secure support to push you towards your personal best.', 250, 3, 37, 0, 'Model<>CU4123-501', 'f', 'shoes', 'walking', 'Nike'),
(29, 'Rich MNisi X9000L4', 'Run wild. These adidas shoes are made in collaboration with South African designer Rich Mnisi. The vibrant patterns take influence from the hustle and bustle of South African city life, played out in an explosion of colors and abstract prints. Built for short- to mid-distance running, they have a soft adidas PRIMEKNIT upper and energy-returning BOOST in the midsole.', 150, 2, 0, 0, 'Model<>GW3400', 'f', 'shoes', 'training', 'Adidas'),
(30, 'NikeCourt Naomi Osaka Collection', 'Command the worlds attention in the NikeCourt Naomi Osaka Collection Jacket. With a loose, roomy feel, youll feel supported no matter what kind of day youre having. And when the weathers warmer, the jacket folds into a bag in which you can pack your extra tennis balls or some snacks. This product is made with at least 75% recycled polyester fibers.', 120, 5, 0, 0, 'Mode<>DM2164-821\r\nMade<>100% polyester', 'm', 'clothing', 'jackets', 'Nike'),
(31, 'Tiro 21 Ttrack Jacket', 'Too good to limit to the pitch. The adidas Tiro jacket debuted as soccer training wear, but its now a streetwear staple. From moisture-absorbing AEROREADY to the zip pockets on the side, the details are just as useful beyond the boundary lines.', 50, 10, 0, 0, 'Model<>GM7319\r\nMade<>100% recycled polyester doubleknit', 'm', 'clothing', 'jackets', 'Adidas'),
(32, 'Icon Classic', 'Lifted. Classic hoops detailing. Strappy but easy to wear. Check all the boxes in the Nike Icon Classic. Its big, bold midsole wows with comfort. The outsole pattern delivers iconic Air Force 1 vibes, while the multiple hook-and-loop straps add a fearless look. Get ready to shine with this new voice in sandal style.', 60, 2, 0, 0, 'Model<>DH0224-600', 'f', 'shoes', 'slides', 'Nike'),
(33, 'Nike Everyday Plus', 'Rock the red, white and blue with the Nike Everyday Plus Socks. A dip-dye design combines national colors with a retro treatment for a little extra pizazz. Extra cushioning under the heel and forefoot and a snug, supportive arch band make these super comfortable for everyday wear.', 18, 5, 0, 0, 'Model<>DQ4046-902\r\nMade<>67% cotton/30% polyester/2% spandex/1% nylon', 'u', 'clothing', 'socks', 'Nike'),
(34, 'Adilette Lite Slides', 'Keep things light. This applies to your life and to your footwear. These adidas Adilette slides make everything easy. All you have to do is slip them on. They work just as well when youre out running around as they do when youre in the house. You can thank the lightweight cushioning for that.', 30, 1, 9, 0, 'Model<>GZ6196', 'f', 'shoes', 'slides', 'Adidas'),
(35, 'Icon Quarter Socks 3 Pairs', 'Whats the vibe? Simple Trefoil logo, or just a quick flash of adidas? Whichever direction, the comfort levels dont change with these socks. Both options are sporty, supportive and super soft. Basically, you cant go wrong.', 18, 15, 5, 0, 'Model<>FZ6717\r\nMade<>95% polyester, 4% natural latex rubber, 1% elastane', 'm', 'clothing', 'socks', 'Adidas'),
(36, 'Dance Cargo Pants', 'Roomy and ready for everyday wear, these cargo pants bring a fresh look and feel to a closet staple. A zippered cargo pocket secures your essentials for wherever your day takes you.', 80, 3, 0, 0, 'Model<>DO2571-010', 'f', 'clothing', 'pants', 'Nike'),
(37, 'The Nike Polo', 'This isn’t your average polo—it’s The Nike Polo. Every detail, from its innovative, sweat-wicking fabric to the hints of orange that nod to Nike’s original shoebox, has been thoughtfully crafted to meet the needs of the everyday you. The result is a street-ready style that looks at home on the course, the court and everywhere else. The stripes nod to the look of classic rugby tops. This product is made with 100% sustainable materials, using a blend of both recycled polyester and organic cotton fibers. The blend is at least 10% recycled fibers or at least 10% organic cotton fibers.', 75, 14, 0, 0, 'Model<>DH0900-451\r\nMade<>59% cotton/41% polyester', 'm', 'clothing', 'polos', 'Nike'),
(38, 'Fleece Oversized Hoodie', 'Swoosh is always in season. Let flowers power you up in this hoodie with an embroidered daisy logo. Its cozy soft fleece and oversized fit make it the perfect layer to keep you comfy all day long.', 70, 2, 0, 0, 'Model<>DO7256-010', 'f', 'clothing', 'hoodies', 'Nike'),
(39, 'Nike Dri-FIT ADV Tiger Woods', 'The Nike Dri-FIT ADV Tiger Woods Polo blends our most innovative materials with insights from Tiger Woods to create a piece thats built to perform at the highest levels of play. The result is a polo thats designed to help you move freely and stay dry during your most grueling rounds. The incredibly breathable fabric is elevated with an abstract print thats inspired by tiger stripes. This product is made with at least 50% recycled polyester fibers.', 85, 13, 0, 0, 'Model<>DA3072-100\r\nMade<>100% polyester', 'm', 'clothing', 'polos', 'Nike'),
(40, 'Future Icons 3-Stripes Hooded Track Top', 'A LAID BACK, FULL-ZIP HOODIE WITH SPORTY ATTITUDE.\r\nWhen it comes to off-duty-athlete style, the Future Icons 3-Stripes Hooded Track Top sets the pace. With its ability to be dressed up or down, the hoodie easily holds the title as a heavyweight wardrobe staple.\r\n\r\nWhatever gets your heart racing, weve made it easy to take the love for your sport off-pitch — or court, or mat — and into your daily hustle. The iconic branding shows off your inner athlete, with a remixed 3-Stripes design that wraps across your back and down the sleeves.\r\n\r\nThe luxe doubleknit fabric adds an extra touch of comfort throughout your day. And youll feel even better knowing that our cotton products support more sustainable cotton farming. Put it on and wear your stripes with pride.', 65, 2, 0, 0, 'Model<>HE1661', 'f', 'clothing', 'hoodies', 'Adidas'),
(41, 'Nike Standard Issue', 'Switch up your game in these reversible basketball shorts. With a colorful print on one side and solid colors on the other, their mesh design lets you stay comfortable and focus on playing lockdown D or getting to the basket.', 55, 12, 0, 0, 'Model<>DH7386-010\r\nMade<>100% polyester', 'm', 'clothing', 'shorts', 'Nike'),
(42, 'Icon Clash', 'Feel right at home wherever you are. Designed with layering in mind, this quilted jackets loose fit and zip-off sleeves allow you to move and layer comfortably. Inspired by homeware textiles and patterns, the allover print matches the cozy feel this comfortable layer provides.', 130, 3, 60, 0, 'Model<>DM6292-010', 'f', 'clothing', 'jackets', 'Nike'),
(43, 'Aeroready 2 Move Woven Sport', 'A comfortable pair of workout shorts that covers you on the moisture-absorbing front with AEROREADY to help keep you dry. Get to that next set on the circuit or stick around for another game of pickup with the crew. Youve got plenty of room to move and side pockets to stow away keys or your cell phone.', 30, 13, 10, 0, 'Mode<>H30301\r\nMade<>100% recycled polyester plain weave', 'm', 'clothing', 'shorts', 'Adidas'),
(44, 'Warm-Up Slim 3 Stripes Track', 'Dash out the door feeling ready for it all. This track jacket has a slim cut with raglan sleeves for a distraction-free feel while warming up or recovering later on. Side pockets keep a bus pass and music player within reach.\r\n\r\nThis product is made with Primegreen, a series of high-performance recycled materials.', 50, 3, 0, 0, 'Model<>H48443', 'f', 'clothing', 'jackets', 'Adidas'),
(45, 'Trefoil SuperLite No-Show Socks', 'Protect your feet from blisters and your favorite shoes from funk. Each pair in this six-pack of super-no-show adidas socks is perfect for trainers, loafers and ballerina flats. Get the sockless look you love, plus the stay-in-place comfort your feet deserve.', 20, 3, 2, 0, 'Model<>EV8990', 'f', 'clothing', 'socks', 'Adidas'),
(46, 'Black Ceremony 4 Pieces Suit', 'Throw it back with the Pellini Suit. This classic combo has a versatile jacket and pants that can be worn together or separately. Soft and comfy, it also has big logo stripes down the sides for signature Pellini style.', 300, 3, 0, 0, 'Mode<>CU8374-622\r\nMade<>100% wool', 'm', 'clothing', 'suits', 'Pellini'),
(47, 'Dri-FIT Eclipse', 'Glide through your stride in the buttery-soft feel of the Nike Dri-FIT Eclipse Shorts. With breathable fabric, your runs will feel cool and fresh. Plenty of pockets let you stash a key quickly for on-the-go storage. This product is made with at least 75% recycled polyester fibers.', 65, 3, 0, 0, 'Model<>DM7725-010', 'f', 'clothing', 'shorts', 'Nike'),
(48, 'White Ceremony 3 Pieces Suit', 'The Pellini Suit is a classic everyday combo with a matching full-zip hoodie and pants. Soft knit fabric with woven overlays means it’s all-around comfy. Wear it together, or pair your separates with other Swoosh favorites', 350, 2, 0, 0, 'Model<>DD8567-084\r\nMade<>100% wool', 'm', 'clothing', 'suits', 'Pellini'),
(49, 'AdiColor Classics 3-Stripes', 'Everything feels just a little more chill in shorts. Whether youre kicking back or crushing that to-do list, these adidas shorts add a laid-back vibe to your day. Iconic 3-Stripes and a retro look add extra style, even if your cat is the only one who sees it.\r\n\r\nThis product is made with recycled content as part of our ambition to end plastic waste.', 35, 2, 7, 0, 'Model<>GN2885', 'f', 'clothing', 'shorts', 'Adidas'),
(50, 'KD', 'KD is as effortless with his style as he is with his shot. This button-down top from Nike Basketball top gives the casual and versatile silhouette a new look inspired by Kevin Durants signature look.', 70, 13, 0, 0, 'Model<>DO4023-097\r\nMade<>100% polyester', 'm', 'clothing', 'tshirts', 'Nike'),
(51, 'Nike Sportswear T-Shirt', 'Look to the Nike Sportswear Polo to help you find solace and sunshine when life is handing out nothing but showers and shade. Its loose fit and soft cotton blend ensure a carefree, vacay vibe thats welcome any time of the year.', 75, 12, 0, 0, 'Model<>DM5032-010\r\nMade<>80% cotton/20% polyester', 'm', 'clothing', 'tshirts', 'Nike'),
(52, 'Red and navy blue wool blend Suit Set', 'This suit combines beautifully 2 different fabrics for jacket and trousers. Intense red and navy blue combined exquisitely to give you an easy but sophisticated look that can be work in any occasion. Cut and tailored from Wool Blends fabric specifically with women in mind, this elegant slim fitting intense red and navy blue suit accentuates your womans figure. The fully lined, flat-front pants with straight side pockets and front zipper creates a classic suit for all occasions.', 326.99, 12, 0, 0, 'Compounds<>80% wool and 20% Terylene', 'f', 'clothing', 'suits', 'Sumissura'),
(53, 'Nike AeroBill Tailwind', 'Top off your warm-weather look with the Nike AeroBill Tailwind Cap. Laser perforations strategically optimize breathability on the front and side panels, while moisture-wicking comfort helps you stay dry on the trail. This product is made with at least 50% recycled polyester fibers.', 28, 11, 0, 0, 'Model<>BV2204-432\r\nMade<>100% recycled polyester. Lining: 79% polyester', 'u', 'accessories', 'hats', 'Nike'),
(54, 'Navy Blue Skirt Suit with peak lapels', 'Ideal for business, this suit made in navy blue , features a tailored slim fit, with peak lapels, 1 button, flap pockets and 2_buttons sleeve buttons. Crafted by our artisans from wool blends cloth, this slim-fit 1 button/s navy blue blazer features a peak lapel. The fully lined high waisted skirt with no side pockets and front zipper creates a classic skirt suit for all occasions.\r\n', 289.99, 10, 0, 0, 'Compounds<>80% Wool & 20% Terylene', 'f', 'clothing', 'suits', 'Sumissura'),
(55, 'Nike Warm', 'Take on the cold in the Nike Warm Headband. It blends fuzzy fleece with soft faux fur to help keep your head and ears cozy.', 19.97, 12, 0, 0, 'Model<>N1002619-978\r\nMade<>100% polyester', 'f', 'accessories', 'hats', 'Nike'),
(56, 'Yoga Dri-FIT', 'Made with soft, stretchy sweat-wicking fabric, this top is a breathable layer designed to keep you comfortable while you flow through your movements. Dropped shoulder seams, exaggerated side vents and a longer back hem let you bend, stretch and move freely between your poses. This product is made with at least 75% sustainable materials, using a blend of both recycled polyester and organic cotton fibers. The blend is at least 10% recycled fibers or at least 10% organic cotton fibers.', 35, 2, 0, 0, 'Model<>DM7025-010', 'f', 'clothing', 'tshirts', 'Nike'),
(57, 'AdiColor Classics Trefoil Tee', 'The brand with the 3-Stripes strives to be better. To be the best. Created to be truly original, the Adicolor collection keeps heritage at its heart. The iconic Trefoil logo celebrates that energy front and center on this adidas classic t-shirt. Soft single jersey feels soft against your skin.\r\n\r\nOur cotton products support sustainable cotton farming. This is part of our ambition to end plastic waste.', 29.99, 4, 0, 0, 'Model<>GN2896', 'f', 'clothing', 'tshirts', 'Adidas'),
(58, 'Wrap Necklace', 'Tiffany HardWear is elegantly subversive and captures the spirit of the women of New York City. This necklace is both refined and rebellious.', 20000, 10, 0, 0, 'Mode<>60700915\r\nMade<>18k gold', 'f', 'accessories', 'necklaces', 'Tiffany');

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

INSERT INTO `product_items` (`item_id`, `product_id`, `name`, `quantity`, `extra_name`, `extra_options`) VALUES
(6, 2, 'Pink Orange', 3, 'Size', 'S\r\nM\r\nL\r\nXXL'),
(7, 2, 'White', 12, 'Size', 'M\r\nXL'),
(8, 2, 'Black', 9, 'Size', 'S\r\nL\r\nXL'),
(9, 5, 'Aqua', 10, 'Size', '38\r\n39\r\n40.5\r\n41\r\n42\r\n44\r\n45'),
(10, 5, 'Beige', 3, 'Size', '38\r\n39\r\n40.5\r\n41\r\n42\r\n44\r\n45'),
(11, 5, 'Black, Yellow Stripe', 4, 'Size', '38\r\n39\r\n40.5\r\n41\r\n42\r\n44\r\n45'),
(12, 5, 'Black, Red Srtipe', 2, 'Size', '38\r\n39\r\n40.5\r\n41\r\n42\r\n44\r\n45'),
(13, 5, 'Black And White', 20, 'Size', '41\r\n42\r\n43\r\n44\r\n45'),
(14, 5, 'Pink', 5, 'Size', '38\r\n39\r\n40.5\r\n41\r\n42\r\n44\r\n45'),
(15, 5, 'White', 11, 'Size', '38\r\n39\r\n40.5\r\n41\r\n42\r\n44\r\n45'),
(20, 8, 'Black Red White', 3, 'Size', '42\r\n42.5\r\n43\r\n44'),
(21, 9, 'Siren Red', 20, 'Size', '42\r\n43\r\n44\r\n44.5\r\n45'),
(22, 9, 'Blue Lime', 5, 'Size', '39\r\n40\r\n42\r\n44'),
(23, 9, 'White Black Gold', 3, 'Size', '43\r\n44\r\n44.5\r\n45'),
(24, 9, 'Black Violet White', 4, 'Size', '44\r\n45'),
(25, 9, 'Black Red', 15, 'Size', '42\r\n43\r\n44'),
(26, 9, 'Orange Red Blue', 2, 'Size', '42\r\n43\r\n44\r\n44.5'),
(27, 10, 'Black Sequoia', 20, 'Size', '39\r\n40\r\n41\r\n42'),
(28, 10, 'Platinum White', 7, 'Size', '40\r\n42\r\n45'),
(29, 10, 'White Violet', 5, 'Size', '42\r\n43\r\n44\r\n45'),
(30, 10, 'Black Obsidian', 3, 'Size', '44\r\n44.5\r\n45\r\n46'),
(31, 10, 'Black Royal', 5, 'Size', '39\r\n40\r\n41\r\n44'),
(32, 11, 'Black White', 8, 'Size', '40\r\n41\r\n42\r\n44'),
(33, 11, 'White Ash', 4, 'Size', '40\r\n44\r\n45\r\n46'),
(34, 12, 'Marine Blue', 7, 'Size', '40\r\n41\r\n43'),
(35, 12, 'Spruce White', 4, 'Size', '42\r\n43\r\n44'),
(36, 13, 'Black White', 6, 'Size', '38\r\n39\r\n40\r\n41'),
(37, 13, 'Black Grey', 10, 'Size', '40\r\n41\r\n42\r\n43\r\n44\r\n45\r\n46'),
(38, 1, 'Cactus Jack', 20, 'Size', '39\r\n40\r\n41\r\n42\r\n42.5\r\n43\r\n45'),
(39, 14, 'White Pink', 5, 'Size', '40\r\n41\r\n42\r\n43'),
(40, 14, 'Black Grey', 10, 'Size', '43\r\n44\r\n45'),
(41, 15, 'White Black Orange', 3, 'Size', '40\r\n41\r\n43\r\n44'),
(42, 16, 'Black White', 20, 'Size', '38\r\n39\r\n40\r\n41'),
(43, 16, 'Black', 14, 'Size', '40\r\n41\r\n42'),
(44, 17, 'Ghost Black', 5, 'Size', '40\r\n41\r\n42\r\n43'),
(45, 17, 'Beetroot Black', 5, 'Size', '41\r\n42\r\n43'),
(46, 17, 'Blue Foam', 6, 'Size', '40\r\n41\r\n43\r\n44'),
(47, 18, 'Grey Volt', 7, 'Size', '40\r\n42'),
(48, 18, 'Black White', 4, 'Size', '44\r\n45\r\n46'),
(49, 19, 'Black White', 8, 'Size', '40\r\n41\r\n42'),
(50, 20, 'Pro Green', 8, 'Size', 'S\r\nM\r\nL\r\nXL\r\n2XL\r\n3XL'),
(51, 20, 'Light Bone', 4, 'Size', 'S\r\nM\r\nL\r\nXL'),
(52, 21, 'Black', 8, 'Size', 'S\r\nM\r\nL\r\nXL'),
(53, 21, 'Rose Black', 9, 'Size', 'XS\r\nS\r\nM\r\nL\r\nXL'),
(54, 22, 'Black', 10, 'Size', '37\r\n38\r\n39\r\n40\r\n41'),
(55, 22, 'White', 9, 'Size', '37\r\n38\r\n39\r\n40\r\n41'),
(56, 23, 'White', 8, 'Size', 'S\r\nM\r\nL'),
(57, 24, 'Black', 5, 'Size', '38\r\n40\r\n41\r\n41.5\r\n42'),
(58, 24, 'White', 9, 'Size', '39\r\n40\r\n41\r\n41.5\r\n42\r\n43'),
(59, 24, 'Gray', 3, 'Size', '39\r\n40\r\n41\r\n41.5\r\n42\r\n43'),
(60, 25, 'Black', 20, 'Size', '38\r\n40\r\n40.5\r\n41'),
(61, 25, 'Black And Blue', 2, 'Size', '38\r\n40\r\n40.5\r\n41'),
(62, 25, 'Cyan', 7, 'Size', '38\r\n40\r\n40.5\r\n41'),
(63, 23, 'Violet Blue', 6, 'Size', 'S\r\nM\r\nL'),
(64, 26, 'Purple', 7, 'Size', '37\r\n38\r\n38.5\r\n39.5\r\n40'),
(65, 26, 'Black', 2, 'Size', '37\r\n38\r\n38.5\r\n40'),
(66, 26, 'White', 5, 'Size', '37\r\n38\r\n38.5\r\n39.5\r\n40'),
(67, 27, 'Hi-Res Green', 10, 'Size', 'S\r\nM\r\nL\r\nXL'),
(68, 27, 'Semi Turbo', 8, 'Size', 'XS\r\nS\r\nM\r\nL'),
(69, 28, 'Black', 5, 'Size', '38\r\n39\r\n40\r\n41\r\n42'),
(70, 28, 'Purple', 4, 'Size', '38\r\n39\r\n40\r\n41\r\n42'),
(71, 28, 'Cyan And Yellow', 8, 'Size', '38\r\n39\r\n40\r\n41\r\n42'),
(72, 29, 'Rich MNisi', 4, 'Size', '37\r\n38\r\n39\r\n40.5'),
(73, 30, 'Tint Black', 9, 'Size', 'X\r\nL\r\n2XL'),
(74, 31, 'Black', 9, 'Size', 'S\r\nM\r\nL'),
(75, 32, 'Rose', 4, 'Size', '38\r\n38.5\r\n39\r\n40'),
(76, 32, 'Silver', 8, 'Size', '38\r\n38.5\r\n39\r\n40'),
(77, 33, 'Blue Red', 20, 'Size', 'S\r\nM\r\nL'),
(78, 34, 'Black', 5, 'Size', '38\r\n39\r\n40\r\n41'),
(79, 34, 'Orange', 9, 'Size', '38\r\n39\r\n40\r\n41'),
(80, 34, 'White', 5, 'Size', '38\r\n39\r\n40\r\n41'),
(81, 35, 'White Black Beige', 19, 'Size', 'S\r\nM\r\nL'),
(82, 36, 'Grey', 4, 'Size', 'XS\r\nS\r\nM\r\nL\r\nXL\r\nXXL'),
(83, 36, 'Black', 2, 'Size', 'M\r\nL\r\nXL\r\nXXL'),
(84, 36, 'Hot Pink', 6, 'Size', 'XS\r\nS\r\nM\r\nL\r\nXL\r\nXXL'),
(85, 37, 'Obsidian', 8, 'Size', 'S\r\nM\r\nL'),
(86, 37, 'Grey Black', 9, 'Size', 'XS\r\nS\r\nM\r\nL\r\nXL'),
(87, 37, 'Dust White', 10, 'Size', 'S\r\nM\r\nL'),
(88, 38, 'White', 6, 'Size', 'S\r\nM\r\nL\r\nXL'),
(89, 38, 'Black', 7, 'Size', 'XS\r\nS\r\nM\r\nXL'),
(90, 39, 'White Black', 18, 'Size', 'S\r\nM\r\nL'),
(91, 39, 'Pomegranate', 14, 'Size', 'S\r\nM\r\nL\r\nXL'),
(92, 39, 'Iron', 12, 'Size', 'XL\r\nXXL'),
(93, 40, 'Black', 4, 'Size', 'S\r\nM\r\nL\r\nXL'),
(94, 40, 'Blue', 2, 'Size', 'S\r\nM\r\nL\r\nXL'),
(95, 40, 'Grey', 6, 'Size', 'XS\r\nS\r\nM\r\nL\r\nXL'),
(96, 40, 'Green', 4, 'Size', 'S\r\nM\r\nL\r\nXL'),
(97, 41, 'Black Atomic', 16, 'Size', 'S\r\nM\r\nL\r\nXL'),
(98, 41, 'Sulfur', 5, 'Size', 'S\r\nM\r\nL'),
(99, 41, 'Heather Black', 8, 'Size', 'XL\r\n2XL\r\n4XL'),
(100, 42, 'Black', 4, 'Size', 'XS\r\nM\r\nL\r\nXL'),
(101, 42, 'Rose', 6, 'Size', 'S\r\nM\r\nL\r\nXL'),
(102, 43, 'Green', 12, 'Size', 'X\r\nL\r\nXXL'),
(103, 44, 'Black', 7, 'Size', 'S\r\nM\r\nL\r\nXL'),
(104, 44, 'Rose', 4, 'Size', 'S\r\nM\r\nL\r\nXL'),
(105, 45, 'White', 5, 'Size', 'M'),
(106, 45, 'Black', 6, 'Size', 'M\r\nL'),
(107, 45, 'Grey', 6, 'Size', 'M'),
(108, 46, 'Black', 5, 'Size', '48\r\n50\r\n52'),
(109, 47, 'Black/White', 4, 'Size', 'XS\r\nS\r\nM\r\nL\r\nXL'),
(110, 47, 'Blue/White', 6, 'Size', 'XS\r\nS\r\nM\r\nL\r\nXL'),
(111, 47, 'Rose', 6, 'Size', 'XS\r\nS\r\nM\r\nL\r\nXL'),
(112, 48, 'White', 3, 'Size', '50\r\n51\r\n54'),
(113, 49, 'Black', 12, 'Size', 'S\r\nM\r\nL\r\nXL'),
(114, 50, 'Summit White', 14, 'Size', 'XS\r\nS\r\nM'),
(115, 51, 'Black', 15, 'Size', 'M\r\nL\r\nXL'),
(116, 51, 'Light Bordeaux', 12, 'Size', 'S\r\nM\r\nL'),
(117, 51, 'Pecan', 18, 'Size', 'XS\r\nS\r\nM\r\nL\r\nXL\r\n2XL'),
(119, 52, 'Red/Blue', 1000, 'Measurement', 'Sent By Mail'),
(120, 53, 'Blue', 15, '', ''),
(121, 53, 'Red', 14, '', ''),
(122, 53, 'Black', 12, '', ''),
(123, 54, 'Navy Blue', 1000, 'Measurement', 'Sent By Email'),
(124, 55, 'White', 12, '', ''),
(125, 55, 'Black', 6, '', ''),
(126, 56, 'Black', 12, 'Size', 'S\r\nM\r\nL\r\nXL'),
(127, 56, 'Marina Blue', 9, 'Size', 'S\r\nM\r\nL\r\nXL'),
(128, 57, 'Black', 12, 'Size', 'S\r\nL\r\nXL'),
(129, 57, 'White', 4, 'Size', 'S\r\nM\r\nL\r\nXL'),
(130, 57, 'Blue', 2, 'Size', 'S\r\nM\r\nL\r\nXL'),
(131, 58, 'Gold', 3, '', '');

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
(36, 5, 5, 'Posted a review.', 4.5);

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
  `type` varchar(100) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `fullname`, `email`, `password`, `type`) VALUES
(5, 'msserhan', 'Mohammad Serhan', 'msserhan2002@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'admin'),
(6, 'msserhan2', 'Mhmd Serhan', 'toxicscripts1@gmail.com', 'cc03e747a6afbbcbf8be7668acfebee5', 'driver'),
(8, 'alized559', 'Ali Zein Al Dine', 'alized559@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin');

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
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `product_items`
--
ALTER TABLE `product_items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `rev_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
