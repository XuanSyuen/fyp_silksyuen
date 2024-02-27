-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Feb 27, 2024 at 04:35 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SilkSyuen`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`, `admin_email`) VALUES
(1, 'admin', '123', 'admin@gmail.com'),
(2, 'admin1', '123', 'xadmin@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `name`, `email`, `mobile`, `subject`, `message`, `created_at`) VALUES
(1, 'abc', 'test@gmail.com', '01293999999', 'text subject', 'dsad', '2024-02-25 19:07:59');

-- --------------------------------------------------------

--
-- Table structure for table `new_order`
--

CREATE TABLE `new_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivery_address` text NOT NULL,
  `order_created` datetime NOT NULL,
  `order_status` varchar(255) NOT NULL,
  `remark` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `new_order`
--

INSERT INTO `new_order` (`order_id`, `user_id`, `delivery_address`, `order_created`, `order_status`, `remark`) VALUES
(5, 1, 'No8, Jalan Abc, 253265 ,city1, Cheras, Malaysia', '2023-06-04 14:21:44', 'completed', 'Hi'),
(6, 1, 'No8, Jalan Abc, 253265 ,city1, Cheras, Malaysia', '2023-06-04 16:14:49', 'pending', 'Note'),
(7, 4, 'No8, Jalan Abc, 253265 ,city12, Kl, Malaysia', '2023-06-04 16:23:41', 'pending', 'note'),
(8, 5, 'No22, Jalan Abc, 2222, 1232  , city12, Kl33, Malaysia', '2023-06-04 16:25:53', 'pending', 'Noteee'),
(10, 1, 'dsa, dsa, 32321  , sda, 231, Malaysia', '2023-10-27 21:13:03', 'pending', 'dsa'),
(11, 7, 'abc, abc, 32321  , sda, Cheras, Malaysia', '2023-11-11 21:34:26', 'pending', 'No'),
(13, 8, 'dsa, dsa, 32321  , Cheras, Cheras, Malaysia', '2024-02-14 20:07:49', 'pending', 'ac');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `order_id` int(11) NOT NULL,
  `rated` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`id`, `product_id`, `qty`, `price`, `order_id`, `rated`) VALUES
(6, 17, 4, '316', 5, 0),
(7, 16, 3, '299.7', 5, 0),
(8, 15, 3, '447', 5, 0),
(9, 11, 1, '299', 6, 0),
(10, 12, 1, '99.9', 6, 0),
(11, 13, 1, '54.9', 6, 0),
(12, 16, 1, '99.9', 6, 0),
(13, 15, 1, '149', 6, 0),
(14, 15, 1, '149', 7, 0),
(15, 14, 3, '447', 7, 0),
(16, 12, 1, '99.9', 8, 0),
(17, 13, 1, '54.9', 8, 0),
(18, 16, 4, '399.6', 8, 0),
(22, 16, 5, '499.5', 10, 0),
(23, 16, 6, '599.4', 11, 1),
(24, 15, 1, '149', 11, 1),
(27, 16, 7, '699.3', 13, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `product_short_desc` text NOT NULL,
  `product_price` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `product_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_desc`, `product_short_desc`, `product_price`, `product_image`, `product_status`) VALUES
(10, 'WATER REPELLENT NYLON 6 POCKET JACKET', '<p><span style=\"color: rgb(51, 51, 51); font-family: \"Hiragino Kaku Gothic ProN\", Meiryo, sans-serif; font-size: 12px;\">●Water repellency will gradually get lost by washing or cleaning.</span><br></p>', '<p><span style=\"color: rgb(102, 102, 102); font-family: \"Hiragino Kaku Gothic ProN\", Meiryo, sans-serif; font-size: 13px;\">COMFORTABLE FITTING</span><br style=\"color: rgb(102, 102, 102); font-family: \"Hiragino Kaku Gothic ProN\", Meiryo, sans-serif; font-size: 13px;\"><span style=\"color: rgb(102, 102, 102); font-family: \"Hiragino Kaku Gothic ProN\", Meiryo, sans-serif; font-size: 13px;\">MATERIAL. HIDDEN POCKET</span><br style=\"color: rgb(102, 102, 102); font-family: \"Hiragino Kaku Gothic ProN\", Meiryo, sans-serif; font-size: 13px;\"><span style=\"color: rgb(102, 102, 102); font-family: \"Hiragino Kaku Gothic ProN\", Meiryo, sans-serif; font-size: 13px;\">TO ORGANIZE ITEMS.</span><br></p>', '289', '20230603072725_jacket-man.jpeg', 1),
(11, 'STRETCH SEERSUKER JACKET', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 12px;\">●Colour transfer of dark-coloured products may occur during use due to friction and when handling while wet. Wash separately.</span><br></p>', '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">MADE WITH UNEVEN SURFACE</span><br style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\"><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">MATERIAL. SOFT ON SKIN AND</span><br style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\"><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">SMOOTH TEXTURE JACKET.</span><br></p>', '299', '20230603072712_jacketman1.jpeg', 1),
(12, 'WASHED OXFORD BUTTON DOWN SHIRT', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 12px;\">●Colour transfer of dark-coloured products may occur during use due to friction and when handling while wet. Wash separately.</span><br></p>', '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">FINISHED WITH A WASH TO</span><br style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\"><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">GIVE ORIGINAL COTTON FEEL.</span><br style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\"><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">USING ORGANIC COTTON.</span><br></p>', '99.90', '20230603072812_buttonshirt.jpeg', 1),
(13, 'Heavy weight jersey Pocket T-shirt', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 12px;\">●Colour transfer of dark-coloured products may occur during use due to friction and when handling while wet. Wash separately.</span></p><p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 12px;\">BODY:COTTON100%</span><br style=\"color: rgb(51, 51, 51); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 12px;\"><span style=\"color: rgb(51, 51, 51); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 12px;\">RIBBED KNIT:COTTON100%</span><span style=\"color: rgb(51, 51, 51); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 12px;\"><br></span><br></p>', '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">Knitted with bulky yarn.</span><br style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\"><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">Garment-washed.</span><br style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\"><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">Made with organic cotton.</span><br></p>', '54.90', '20230603072901_jersey.jpeg', 1),
(14, '4 WAY STRETCH DENIM SKINNY (76CM LENGTH)', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 12px;\">●Colour transfer may occur during use due to friction and when handling while wet. </span></p><p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 12px;\">●This product may transfer colour to white or light coloured underwear or clothing, or to white or light coloured chairs, sofas, car seats, shoes, bags, belts, etc. Wash separately. </span></p><p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 12px;\">●Due to the characteristics of the materials, deformations or twisting may occur. </span></p><p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 12px;\">●Discolouration may occur in light coloured products due to being stored in light or polluted air. </span></p><p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 12px;\">●Due to the manufacturing process, the finished size and colour may vary slightly.</span><br></p>', '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">MADE WITH 4 WAY STRETCH</span><br style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\"><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">FABRIC FOR COMFORT.</span><br style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\"><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">USING ORGANIC COTTON.</span><br></p>', '149', '20230603072947_jean.jpeg', 1),
(15, 'QUICK DRY 4 WAY STRETCH ANKLE LENGTH TROUSERS', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 12px;\">POLYESTER100%</span><br></p>', '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">MADE WITH STRETCHY YARN</span><br style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\"><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">FOR SOFT AND SMOOTH</span><br style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\"><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">TEXTURE.</span><br></p>', '149', '20230603073025_pant.jpeg', 1),
(16, 'EXTRA LONG STAPLE COTTON BROAD ROUND COLLAR SHIRT (F)', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 12px;\">COTTON100%</span><br></p>', '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">EXTRA LONG STAPLE COTTON</span><br style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\"><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">MAKES SMOOTH TEXTURE.</span><br style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\"><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">MADE WITH ORGANIC COTTON.</span><br></p>', '99.90', '20230603073212_shirtf.jpeg', 1),
(17, 'SUN PROTECT UPF 50 ZIP UP HOODY', '<p><span style=\"color: rgb(51, 51, 51); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 12px;\">●Colour transfer of dark-coloured products may occur during use due to friction and when handling while wet. Wash separately.</span><br style=\"color: rgb(51, 51, 51); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 12px;\"><span style=\"color: rgb(51, 51, 51); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 12px;\">●An earphone cord can be passed from a hole inside the pocket to a loop on the front neck.</span><br></p>', '<p><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">KNITTED WITH SOFT AND</span><br style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\"><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">STRETCHY POLYESTER</span><br style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\"><span style=\"color: rgb(102, 102, 102); font-family: &quot;Hiragino Kaku Gothic ProN&quot;, Meiryo, sans-serif; font-size: 13px;\">THREAD. EASY TO DRY.</span><br></p>', '79', '20230603073249_subblock.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` text,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `review`
--

INSERT INTO `review` (`review_id`, `order_id`, `product_id`, `user_id`, `rating`, `comment`, `created_at`) VALUES
(2, 11, 16, 7, 5, 'abc', '2024-02-27 17:30:45'),
(3, 11, 15, 7, 4, 'Fit size', '2024-02-27 17:48:29'),
(4, 11, 16, 7, 5, 'abc1', '2024-02-27 17:30:45');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_contact` varchar(255) NOT NULL,
  `user_delivery` text,
  `user_created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_name`, `user_password`, `user_contact`, `user_delivery`, `user_created`) VALUES
(1, 'test@gmail.com', 'tester', '123', '01725366333', NULL, '2023-03-04 09:58:18'),
(2, 'new@gmail.com', 'new', '123', '01273823782', NULL, '2023-03-04 13:36:30'),
(3, 'hs@gmail.com', 'hxrkkd', '123', '01272837278', NULL, '2023-06-03 22:53:14'),
(4, 'newacc@gmail.com', 'newAcc2', '1234', '011111', NULL, '2023-06-04 16:21:44'),
(5, 'test1@gmail.com', 'test12', '1234', '0182222', NULL, '2023-06-04 16:24:46'),
(6, 'abc@gmail.com', 'abc', '123', '12322321', NULL, '2023-06-29 16:16:37'),
(7, 'new2@gmail.com', 'new', 'qweqwe11', '01828328382', NULL, '2023-11-11 21:33:48'),
(8, 'hxrkkd@gmail.com', 'new', 'w2COkZpQ', '01293999999', NULL, '2024-02-14 20:07:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `new_order`
--
ALTER TABLE `new_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`product_id`),
  ADD KEY `oid` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `new_order`
--
ALTER TABLE `new_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `oid` FOREIGN KEY (`order_id`) REFERENCES `new_order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pid` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
