-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2016 at 05:40 AM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpfinal`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(9) NOT NULL,
  `street_address` varchar(60) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state_province` varchar(50) NOT NULL,
  `postal_code` varchar(9) NOT NULL,
  `country` varchar(50) NOT NULL,
  `user_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `street_address`, `city`, `state_province`, `postal_code`, `country`, `user_id`) VALUES
(6, 'ujk', 'jh', 'uy', 'g', 'Haiti', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(9) NOT NULL,
  `user_id` int(9) DEFAULT NULL,
  `anon_id` varchar(50) DEFAULT NULL,
  `product_id` int(9) NOT NULL,
  `quantity` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(2) NOT NULL,
  `category_name` varchar(30) NOT NULL,
  `category_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_url`) VALUES
(1, 'body armours', 'bodyarmours.php'),
(2, 'boots', 'boots.php'),
(3, 'jackets', 'jackets.php'),
(5, 'pants', 'pants.php'),
(6, 'helmets', 'helmets.php'),
(7, 'bags', 'bags.php'),
(8, 'Army Knives', 'armyknives.php');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `contry_id` int(9) NOT NULL,
  `country` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`contry_id`, `country`) VALUES
(1, 'Albania'),
(2, 'Algeria'),
(3, 'Andorra'),
(4, 'Angola'),
(5, 'Anguilla'),
(6, 'Antarctica'),
(7, 'Antigua'),
(8, 'Antilles'),
(9, 'Argentina'),
(10, 'Armenia'),
(11, 'Aruba'),
(12, 'Australia'),
(13, 'Austria'),
(14, 'Azerbaijan'),
(15, 'Bahamas'),
(16, 'Bangladesh'),
(17, 'Barbados'),
(18, 'Belarus'),
(19, 'Belgium'),
(20, 'Belize'),
(21, 'Benin'),
(22, 'Bermuda'),
(23, 'Bhutan'),
(24, 'Bolivia'),
(25, 'Bosnia'),
(26, 'Botswana'),
(27, 'Brazil'),
(28, 'Brunei'),
(29, 'Bulgaria'),
(30, 'Burkina Faso'),
(31, 'Burundi'),
(32, 'Cambodia'),
(33, 'Cameroon'),
(34, 'Canada'),
(35, 'Cape Verde'),
(36, 'Cayman Islands'),
(37, 'Central Africa'),
(38, 'Chad'),
(39, 'Chile'),
(40, 'China'),
(41, 'Colombia'),
(42, 'Comoros'),
(43, 'Congo'),
(44, 'Cook Islands'),
(45, 'Costa Rica'),
(46, 'Cote D''Ivoire'),
(47, 'Croatia'),
(48, 'Cuba'),
(49, 'Cyprus'),
(50, 'Czech Republic'),
(51, 'Denmark'),
(52, 'Djibouti'),
(53, 'Dominica'),
(54, 'Dominican Rep.'),
(55, 'Ecuador'),
(56, 'Egypt'),
(57, 'El Salvador'),
(58, 'Eritrea'),
(59, 'Estonia'),
(60, 'Ethiopia'),
(63, 'Falkland Islands'),
(61, 'Fiji'),
(62, 'Finland'),
(64, 'France'),
(65, 'Gabon'),
(66, 'Gambia'),
(67, 'Georgia'),
(68, 'Germany'),
(69, 'Ghana'),
(70, 'Gibraltar'),
(71, 'Greece'),
(72, 'Greenland'),
(73, 'Grenada'),
(74, 'Guam'),
(75, 'Guatemala'),
(76, 'Guiana'),
(77, 'Guinea'),
(78, 'Guyana'),
(79, 'Haiti'),
(80, 'Hondoras'),
(81, 'Hong Kong'),
(82, 'Hungary'),
(83, 'Iceland'),
(84, 'India'),
(85, 'Indonesia'),
(86, 'Iran'),
(87, 'Iraq'),
(88, 'Ireland'),
(89, 'Israel'),
(90, 'Italy'),
(91, 'Jamaica'),
(92, 'Japan'),
(93, 'Jordan'),
(94, 'Kazakhstan'),
(95, 'Kenya'),
(96, 'Kiribati'),
(97, 'Korea'),
(98, 'Kyrgyzstan'),
(99, 'Lao'),
(100, 'Latvia'),
(101, 'Lesotho'),
(102, 'Liberia'),
(103, 'Liechtenstein'),
(104, 'Lithuania'),
(105, 'Luxembourg'),
(106, 'Macau'),
(107, 'Macedonia'),
(108, 'Madagascar'),
(109, 'Malawi'),
(110, 'Malaysia'),
(111, 'Maldives'),
(112, 'Mali'),
(113, 'Malta'),
(114, 'Marshal Islands'),
(115, 'Martinique'),
(116, 'Mauritania'),
(117, 'Mauritius'),
(118, 'Mayotte'),
(119, 'Mexico'),
(120, 'Micronesia'),
(121, 'Moldova'),
(122, 'Monaco'),
(123, 'Mongolia'),
(124, 'Montserrat'),
(125, 'Morocco'),
(126, 'Mozambique'),
(127, 'Myanmar'),
(128, 'Namibia'),
(129, 'Nauru'),
(130, 'Nepal'),
(131, 'Netherlands'),
(132, 'New Caledonia'),
(133, 'New Guinea'),
(134, 'New Zealand'),
(135, 'Nicaragua'),
(136, 'Nigeria'),
(137, 'Niue'),
(138, 'Norfolk Island'),
(139, 'Norway'),
(140, 'Palau'),
(141, 'Panama'),
(142, 'Paraguay'),
(143, 'Peru'),
(145, 'Philippines'),
(146, 'Poland'),
(147, 'Polynesia'),
(148, 'Portugal'),
(144, 'Puerto'),
(149, 'Romania'),
(150, 'Russia'),
(151, 'Rwanda'),
(152, 'Saint Lucia'),
(153, 'Samoa'),
(154, 'San Marino'),
(155, 'Senegal'),
(156, 'Seychelles'),
(157, 'Sierra Leone'),
(158, 'Singapore'),
(159, 'Slovakia'),
(160, 'Slovenia'),
(161, 'Somalia'),
(162, 'South Africa'),
(163, 'Spain'),
(164, 'Sri Lanka'),
(165, 'St. Helena'),
(166, 'Sudan'),
(167, 'Suriname'),
(168, 'Swaziland'),
(169, 'Sweden'),
(170, 'Switzerland'),
(171, 'Taiwan'),
(172, 'Tajikistan'),
(173, 'Tanzania'),
(174, 'Thailand'),
(175, 'Togo'),
(176, 'Tokelau'),
(177, 'Tonga'),
(178, 'Trinidad'),
(179, 'Tunisia'),
(180, 'Turkey'),
(181, 'Uganda'),
(182, 'Ukraine'),
(183, 'United Kingdom'),
(184, 'United States'),
(185, 'Uruguay'),
(186, 'Uzbekistan'),
(187, 'Vanuatu'),
(188, 'Venezuela'),
(189, 'Vietnam'),
(190, 'Virgin Islands'),
(191, 'Yugoslavia'),
(192, 'Zaire'),
(193, 'Zambia'),
(194, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `measurement`
--

CREATE TABLE `measurement` (
  `measurement_id` int(9) NOT NULL,
  `contact_id` int(9) DEFAULT NULL,
  `user_height` varchar(6) NOT NULL,
  `user_shoeSize` varchar(10) NOT NULL,
  `user_handSize` varchar(6) NOT NULL,
  `user_headSize` varchar(6) NOT NULL,
  `user_neckSize` varchar(6) NOT NULL,
  `user_chestSize` varchar(6) NOT NULL,
  `user_waistSize` varchar(6) NOT NULL,
  `user_hipSize` varchar(6) NOT NULL,
  `date_measured` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `measurement`
--

INSERT INTO `measurement` (`measurement_id`, `contact_id`, `user_height`, `user_shoeSize`, `user_handSize`, `user_headSize`, `user_neckSize`, `user_chestSize`, `user_waistSize`, `user_hipSize`, `date_measured`) VALUES
(36, 1, 'rehreh', 'hrehre', 'ehreh', '32134', '214', 'sdvggh', 'rehre', 'hrehre', '2016-05-06');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `message_id` int(9) NOT NULL,
  `recepient_id` int(9) NOT NULL,
  `sender_id` int(9) NOT NULL,
  `date_sent` date NOT NULL,
  `message_text` varchar(5000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`message_id`, `recepient_id`, `sender_id`, `date_sent`, `message_text`) VALUES
(1, 36, 35, '2016-04-28', 'Honey'),
(2, 37, 35, '2016-04-28', 'piggie'),
(3, 37, 35, '2016-04-28', 'pig pig'),
(4, 35, 35, '2016-04-28', 'hey\r\n'),
(5, 36, 36, '2016-04-28', 'bear'),
(6, 38, 38, '2016-04-28', 'hey'),
(7, 35, 38, '2016-04-28', 'REquest DENIEDDDDDD!!!'),
(17, 2, 1, '2016-05-06', 'iuyfiugfhwq\r\np[]fr[pruioygejyt'),
(19, 2, 1, '2016-05-06', 'fgwgrehreherh'),
(20, 1, 2, '2016-05-06', 'admin reply'),
(21, 2, 1, '2016-05-06', 'fgwgrehreherh');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(9) NOT NULL,
  `order_date` date NOT NULL,
  `payment_id` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `address_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `payment_id`, `user_id`, `address_id`) VALUES
(16, '2016-05-06', 3, 1, 6),
(17, '2016-05-06', 3, 1, 6);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `order_detail_id` int(9) NOT NULL,
  `product_id` int(9) NOT NULL,
  `item_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `order_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`order_detail_id`, `product_id`, `item_price`, `quantity`, `order_id`) VALUES
(12, 2, 11.12, 1, 16),
(13, 6, 4789.98, 1, 16),
(14, 2, 11.12, 1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `payment_method_id` int(9) NOT NULL,
  `card_type` varchar(30) NOT NULL,
  `card_number` varchar(50) NOT NULL,
  `card_holder` varchar(50) NOT NULL,
  `security_pin` varchar(3) NOT NULL,
  `expiration_date` date NOT NULL,
  `user_id` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`payment_method_id`, `card_type`, `card_number`, `card_holder`, `security_pin`, `expiration_date`, `user_id`) VALUES
(3, 'Visa', '4012888888881881', 'dwf', '332', '2020-06-14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(9) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_description` varchar(500) DEFAULT NULL,
  `product_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_image` blob NOT NULL,
  `category_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_description`, `product_price`, `quantity`, `product_image`, `category_id`) VALUES
(2, 'SSS', 'safsdfsdgsdfdsfs', 11.12, 1, '', 2),
(6, 'gg', 'uses the latest materials and offers the same protection as the Osprey system but it issignificantly lighter, moves with the body more easily and produces a slimmer profile.', 4789.98, 23, '', 1),
(7, 'GAH Military Operations Vest', 'offer a wide choice of body armour designs for army, air force and naval requirements.', 5291.59, 101, '', 1),
(8, 'Combat Boots ', 'Brand new Mle 1965 combat boots made of shined black leather with direct molded soles.', 178.68, 589, '', 2),
(9, 'TG Outrider', 'Just like the real-time reconnaissance military drone that inspired the creation of these\r\nboots, the Outrider was designed to help you stay a step ahead of the enemy. At just\r\nunder 19 oz., it''s light enough to keep you quick on your feet. ', 79.99, 354, '', 2),
(10, 'Rocky Lightweight', 'Lightweight, comfortable and compliant, the Lightweight RLW is ready for battle. The\r\nnewest evolution of military boots combines Rocky''s most advanced lightweight features\r\nwith the durability and performance needed in competitive operations. ', 179.99, 278, '', 2),
(12, 'MICH Helmet Cover', 'The Modular Integrated Communications Helmet (MICH) is the primary combat helmet\r\nused by soldiers of the United States Army developed by the United States Army Soldier\r\nSystems Center to be the next generation of protective combat helmets.\r\n', 20.99, 315, '', 5),
(13, 'CG634 Helmet with dust goggles', 'Fitted with a cloth cover when not in actual use. The CG634 chinstrap release buckle can\r\nbe worn on the left or right, depending on user preference.', 298.99, 489, '', 5),
(14, 'Condor 3-Day Assault Pack', 'The high functionality and easy accessibility of the Condor 3-Day Assault Pack make it an\r\nideal combat companion. Made from durable nylon, the exterior boasts massive amounts\r\nof modular webbing for attachments. Have to carry heavy loads for long distances? It''s no\r\nproblem for this pack.', 139.99, 243, '', 6),
(15, 'Tru-Spec Elite 3 Day Backpack', 'Large enough to carry personal gear, extra ammo and all manners of tactical gear with\r\ndozens of compartments to store all the gear you’ll need for a three day excursion. The\r\nside compression straps compress the bag down when not fully loaded and can hold\r\nlonger items, like M4s, aiming stakes, or tripods securely.', 99.98, 198, '', 6),
(16, 'Poly / Cotton Ripstop TDU Pants', 'After receiving feedback from tactical operators who know what it takes to perform in the\r\nfield, 5.11 released its tactically advanced Ripstop TDU pants. Made from a lightweight\r\npoly/cotton ripstop fabric, these pants can withstand extreme conditions and deliver\r\ncomfort that lasts all day.', 79.99, 1089, '', 4),
(18, 'Parklands Canadian Army Style 4 Pocket Shirt', 'BRAND NEW, COMBAT STYLE, HIGH QUALITY AND DURABLE, GREAT FOR OUTDOOR, AIR\r\nSOFT, PAINTBALL, HUNTING. POLY/COTTON TWILL.', 131.99, 235, '', 3),
(19, 'The Smock', 'Finally, the smock is beginning to gain some traction here in the US. We’ve written about\r\nthem in the past, mentioning smocks from Drop Zone, the now defunct EOTAC, SOD\r\nGear, Level Peaks, SORD as well as the upcoming Vertx smock.', 88.98, 155, '', 3),
(20, 'Army Rescue Assisted Opening Pocket Knife', 'Even if you''re not in the Army, you should still be prepared to defend yourself and those\r\naround you. With the Army Rescue Assisted Open Folder Knife, you can. Whether you''re\r\nin a car accident where a seat belt needs to be cut or a fire where the only way out of a\r\nburning building is through the window, this small folding knife has the tools to keep your\r\nsafe', 56.99, 155, '', 7),
(21, 'Ka-bar Knives POW/MIA US Army Knife', 'Making a quality KA-BAR product requires the talent of experienced craftspeople\r\nperforming dozens of processes with precision and skill. Each knife undergoes specific\r\nmanufacturing processes to ensure corrosion resistance, strength, edge holding ability,\r\nand an out-of-the-box razor sharp cutting edge.\r\n', 88.99, 143, '', 7),
(22, 'Whadup waduo ', 'whadup whadup whadup', 111, 222, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(1) NOT NULL,
  `role_name` varchar(15) NOT NULL,
  `role_description` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_description`) VALUES
(1, 'user', 'Any online shopper'),
(2, 'admin', 'Inventory and database managers');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  `user_first_name` varchar(30) NOT NULL,
  `user_last_name` varchar(30) NOT NULL,
  `user_dob` date NOT NULL,
  `user_gender` varchar(1) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_role_id` int(1) NOT NULL,
  `banned_until` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `user_first_name`, `user_last_name`, `user_dob`, `user_gender`, `user_email`, `user_role_id`, `banned_until`) VALUES
(1, 'SushchenkoDi1', 'sushi', 'Diana', 'Sushchenko', '1996-04-01', 'F', 'di_ana_su@hotmail.com', 1, '0000-00-00'),
(2, 'Admin', 'Admin123', 'Admin', 'Admin', '2016-05-04', 'M', 'Admin@admin.com', 2, '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`),
  ADD UNIQUE KEY `category_name` (`category_name`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`contry_id`),
  ADD UNIQUE KEY `country` (`country`);

--
-- Indexes for table `measurement`
--
ALTER TABLE `measurement`
  ADD PRIMARY KEY (`measurement_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `recepient_id` (`recepient_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `message_id` (`message_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `payment_id` (`payment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `address_id` (`address_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`payment_method_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `contry_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195;
--
-- AUTO_INCREMENT for table `measurement`
--
ALTER TABLE `measurement`
  MODIFY `measurement_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `order_detail_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `payment_method_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
