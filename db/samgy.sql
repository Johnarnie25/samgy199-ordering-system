-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 25, 2025 at 03:15 PM
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
-- Database: `samgy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) NOT NULL DEFAULT 'admin'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(3, 'admin', '3a4ebf16a4795ad258e5408bae7be341', 'admin'),
(5, 'admin1', '3a4ebf16a4795ad258e5408bae7be341', 'admin'),
(6, 'manager', '385b04acf62bbc4c951b4c99cbc82875', 'manager'),
(7, 'staff', 'da33460d9bc25350dcc70f30961defe0', 'staff'),
(8, 'waiter', 'fca44fae31d93b3d81d9cd653359d169', 'waiter');

-- --------------------------------------------------------

--
-- Table structure for table `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `contact_number` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_made` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `basket`
--

INSERT INTO `basket` (`id`, `customer_name`, `contact_number`, `address`, `email`, `total`, `status`, `date_made`) VALUES
(25, 'Customer', '1234567890', 'Cabanatuan', 'customer1@gmail.com', '897.00', 'confirmed', '2025-03-24 21:38:54'),
(26, 'Customer', '1234567890', 'Cabanatuan', 'customer1@gmail.com', '897.00', 'confirmed', '2025-03-24 21:39:29'),
(27, 'Customer', '1234567890', 'Customer1gmailcom', 'customer1@gmail.com', '499.00', 'pending', '2025-03-24 21:40:09'),
(28, 'customer', '1234', 'cab', 'customer1@gmail.com', '1,496.00', 'pending', '2025-03-25 17:52:14'),
(29, 'Customer', '1234567890', 'Customer1gmailcom', 'customer1@gmail.com', '848.00', 'pending', '2025-03-25 22:01:57'),
(30, 'Customer', '1234567890', 'Customer1gmailcom', 'johnarniemariano2@gmail.com', '848.00', 'confirmed', '2025-03-25 22:10:47');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `customer_name`, `subject`, `email`, `message`) VALUES
(1, 'Adam Abdulrahman', 'Late Delivery', 'abdulflezy13@yahoo.com', 'Please ensure that your delivery guys deliver the meals at the required time because they are often late.'),
(2, 'Zainab Adamu', 'Late Delivery', 'Zee@yahoo.com', 'I need an email of the GM if possible');

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `food_name` varchar(255) NOT NULL,
  `food_category` varchar(255) NOT NULL,
  `food_price` varchar(255) NOT NULL,
  `food_description` text NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`id`, `food_name`, `food_category`, `food_price`, `food_description`, `stock`) VALUES
(12, 'Chicken', 'breakfast', '199', 'Tender and juicy chicken, marinated in a flavorful blend of spices, then grilled to perfection over an open flame. This dish boasts a smoky aroma, crispy charred edges, and a succulent bite, making it a perfect choice for samgyup-style grilling. Best paired with dipping sauces, fresh lettuce, and a side of rice.', 80),
(13, 'Pork', 'breakfast', '299', 'Savory and tender pork ribs, marinated in a rich blend of spices and smoky barbecue sauce, then slow-grilled to achieve a mouthwatering caramelized glaze. Each bite offers a perfect balance of juiciness and charred goodness, making it an irresistible addition to your samgyup feast. Best enjoyed with fresh lettuce wraps, dipping sauces, and a side of rice.', 119),
(14, 'Beef', 'breakfast', '499', 'Premium cuts of beef, thinly sliced for quick grilling, delivering a rich, juicy, and smoky flavor with every bite. Marinated or served plain, this beef is tender and packed with umami, making it perfect for wrapping in fresh lettuce with garlic, ssamjang, and kimchi. Best paired with dipping sauces and a side of rice for an authentic samgyup experience.', 10),
(15, 'Lettuce', 'lunch', '0', 'Crisp and refreshing lettuce leaves, perfect for wrapping grilled meats and side dishes in a traditional samgyup style. Their mild flavor and crunchy texture complement the smoky, savory taste of the meat, while adding a light and healthy touch to every bite. Best paired with garlic, ssamjang, and kimchi for the ultimate Korean BBQ experience.', 19),
(16, 'Kimchi', 'lunch', '50', 'A classic Korean side dish made from fermented napa cabbage and radish, seasoned with a bold mix of chili pepper, garlic, ginger, and fish sauce. Kimchi adds a spicy, tangy, and umami-rich kick to every bite, perfectly balancing the smoky flavors of grilled meat. It&#039;s not just a flavorful addition to your samgyup feast&mdash;it also aids digestion and enhances the overall dining experience!', 100),
(17, 'Sisig', 'lunch', '150', 'A sizzling Filipino delicacy made from crispy, finely chopped pork (typically pig&rsquo;s face and ears) mixed with onions, chili, and seasoned with calamansi and soy sauce. Served on a hot plate, this dish boasts a perfect balance of crunchy, savory, and tangy flavors. Often topped with a creamy egg or mayo, sisig is best enjoyed with rice or as a flavorful side to your samgyup feast', 20),
(18, 'Potato', 'lunch', '25', 'Golden and crispy potatoes, either fried to perfection or lightly seasoned and roasted for a rich, buttery flavor. Whether served as classic French fries, crispy potato wedges, or creamy mashed potatoes, this side dish adds a satisfying crunch and a hearty bite to your samgyup experience. Best paired with dipping sauces or enjoyed alongside grilled meats for a balanced meal', 58),
(19, 'French Fries', 'lunch', '50', 'Crispy, golden fries made from premium potatoes, deep-fried to perfection for a crunchy exterior and a soft, fluffy inside. Lightly salted and served hot, they make the perfect side dish for your samgyup feast. Enjoy them plain, dipped in cheese or spicy mayo, or paired with your favorite grilled meats for an extra satisfying bite!', 7),
(20, 'Mountain Dew', 'dinner', '50', 'A bold and refreshing citrus-flavored soft drink with a crisp, fizzy kick. Its sweet and tangy taste perfectly complements the smoky, savory flavors of grilled meats, making it an ideal beverage for your samgyup feast. Best served ice-cold for maximum refreshment!', 1),
(21, 'Coca Cola', 'dinner', '50', 'The classic, refreshing cola with a perfect balance of sweetness and carbonation. Its crisp and fizzy taste enhances the rich, smoky flavors of grilled meats, making it a must-have beverage for any samgyup feast. Best served ice-cold for a truly satisfying dining experience!', 444),
(22, 'Sprite', 'dinner', '50', 'A refreshing lemon-lime soft drink with a crisp, bubbly fizz that perfectly complements the rich and smoky flavors of grilled meats. Its light and zesty taste cleanses the palate, making each bite of your samgyup feast even more enjoyable. Best served ice-cold for maximum refreshment!', 43),
(23, 'Mojito', 'dinner', '150', 'A refreshing cocktail made with a zesty blend of fresh mint leaves, lime juice, sugar, and soda water, topped with ice for a cool and invigorating drink. Its crisp citrus and minty flavors perfectly balance the smoky, savory taste of grilled meats, making it a great pairing for your samgyup feast. Can be enjoyed as a classic non-alcoholic mocktail or with a splash of rum for an extra kick!', 6),
(24, 'Chicken Soup', 'special', '50', 'A warm and comforting broth made with tender chicken, simmered with aromatic herbs, garlic, and onions for a rich, savory flavor. Light yet satisfying, this soup is perfect for cleansing the palate between bites of grilled meat, adding a soothing and hearty touch to your samgyup feast. Best enjoyed hot, with a side of rice or fresh vegetables!', 5),
(25, 'White Rice', 'special', '20', 'Soft, fluffy, and perfectly steamed white rice, serving as the ideal base for your samgyup feast. Its mild flavor balances the rich, smoky taste of grilled meats and savory side dishes, making each bite more satisfying. A must-have staple to complete your Korean BBQ experience!', 10),
(26, 'Java Rice', 'special', '30', 'A flavorful, golden-yellow rice dish infused with garlic, turmeric, and savory seasonings, giving it a rich aroma and a slightly smoky taste. This vibrant and fragrant rice pairs perfectly with grilled meats, enhancing the overall samgyup experience with its bold flavors. Best enjoyed with a side of dipping sauces and fresh vegetables!', 460);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int(11) NOT NULL,
  `order_id` varchar(100) NOT NULL,
  `food` varchar(100) NOT NULL,
  `qty` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `order_id`, `food`, `qty`) VALUES
(13, '23', 'Chicken', '19'),
(14, '23', ' Beef', '2'),
(15, '23', ' Lettuce', '2'),
(16, '23', ' Pork', '4'),
(17, '24', 'French Fries', '1'),
(18, '24', ' Potato', '1'),
(19, '24', ' Chicken', '1'),
(20, '24', ' Pork', '9'),
(21, '25', 'Pork', '3'),
(22, '26', 'Pork', '3'),
(23, '27', 'Beef', '1'),
(24, '28', 'Beef', '2'),
(25, '28', ' Chicken', '1'),
(26, '28', ' Pork', '1'),
(27, '29', 'Beef', '1'),
(28, '29', ' Pork', '1'),
(29, '29', ' Kimchi', '1'),
(30, '0', 'Beef', '1'),
(31, '0', ' Pork', '1'),
(32, '0', ' Kimchi', '1');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `reserve_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `no_of_guest` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `date_res` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `suggestions` varchar(100) NOT NULL,
  `table_no` int(11) NOT NULL,
  `status` enum('pending','confirmed') DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`reserve_id`, `user_id`, `no_of_guest`, `email`, `phone`, `date_res`, `time`, `suggestions`, `table_no`, `status`) VALUES
(10, 6, '5', 'customer1@gmail.com', '123456789', '2025-03-24', '19:29', 'Sample', 0, 'pending'),
(11, 6, '6', 'customer1@gmail.com', '123', '2025-03-24', '19:29', 'Sample1', 2, 'confirmed'),
(12, 7, '10', 'customer2@gmail.com', '123456789', '2025-03-24', '19:31', 'Sample', 3, 'confirmed'),
(13, 7, '111', 'customer2@gmail.com', '123', '2025-03-24', '19:31', 'Sample2', 0, 'pending'),
(15, 6, '1', 'customer1@gmail.com', '1', '2025-03-25', '17:51', 'sample', 0, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(300) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `email`, `address`, `phone_number`, `created_at`) VALUES
(1, 'Test User', 'test_pass', 'test@example.com', 'Test Address', '1234567890', '2025-03-25 12:11:39'),
(6, 'Customer1', '$2y$10$yriqO08pGGqnG8I6SDr76uFogKx6J3LnFTLmo2X/MjdNmkAyxTPQe', 'customer1@gmail.com', 'Cabanatuan City', '1234567890', '2025-03-24 04:28:19'),
(7, 'Customer2', '$2y$10$U7ocrR9L6G3CglP636mJEu6EmePmpkOusun/ZQkWNPcmU.xKwVsQe', 'customer2@gmail.com', 'Cabanatuan City', '1234567890', '2025-03-24 04:28:44'),
(9, 'Customer 3', 'password3', 'customer3@gmail.com', '123 Street A', '1234567890', '2025-03-24 13:50:19'),
(10, 'Customer 4', 'password4', 'customer4@gmail.com', '124 Street B', '1234567891', '2025-03-24 13:50:19'),
(11, 'Customer 5', 'password5', 'customer5@gmail.com', '125 Street C', '1234567892', '2025-03-24 13:50:19'),
(12, 'Customer 6', 'password6', 'customer6@gmail.com', '126 Street D', '1234567893', '2025-03-24 13:50:19'),
(13, 'Customer 7', 'password7', 'customer7@gmail.com', '127 Street E', '1234567894', '2025-03-24 13:50:19'),
(14, 'Customer 8', 'password8', 'customer8@gmail.com', '128 Street F', '1234567895', '2025-03-24 13:50:19'),
(15, 'Customer 9', 'password9', 'customer9@gmail.com', '129 Street G', '1234567896', '2025-03-24 13:50:19'),
(16, 'Customer 10', 'password10', 'customer10@gmail.com', '130 Street H', '1234567897', '2025-03-24 13:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `user_cart`
--

CREATE TABLE `user_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ordered` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_cart`
--

INSERT INTO `user_cart` (`id`, `user_id`, `food_id`, `quantity`, `added_at`, `ordered`) VALUES
(35, 6, 14, 2, '2025-03-25 12:15:50', 1),
(37, 6, 13, 1, '2025-03-25 12:16:50', 1),
(39, 7, 13, 18, '2025-03-25 12:52:57', 0),
(40, 7, 14, 14, '2025-03-25 12:53:05', 0),
(41, 7, 12, 15, '2025-03-25 13:04:19', 0),
(42, 7, 18, 1, '2025-03-25 13:09:47', 0),
(43, 6, 16, 1, '2025-03-25 14:01:31', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`reserve_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_food` (`user_id`,`food_id`),
  ADD KEY `user_cart_ibfk_2` (`food_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `reserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_cart`
--
ALTER TABLE `user_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_cart`
--
ALTER TABLE `user_cart`
  ADD CONSTRAINT `user_cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_cart_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `food` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
