-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2024 at 02:49 PM
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
-- Database: `dbproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `description` varchar(500) NOT NULL,
  `slug` varchar(300) NOT NULL,
  `category` varchar(300) NOT NULL,
  `size` varchar(300) NOT NULL,
  `color` varchar(300) NOT NULL,
  `weight` varchar(300) NOT NULL,
  `oldprice` int(20) NOT NULL,
  `newprice` int(20) NOT NULL,
  `image` varchar(500) NOT NULL,
  `uid` int(10) NOT NULL,
  `pid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcart`
--

INSERT INTO `tblcart` (`id`, `name`, `description`, `slug`, `category`, `size`, `color`, `weight`, `oldprice`, `newprice`, `image`, `uid`, `pid`) VALUES
(89, 'Asus Zenbook', '                                    Best looking laptop                        ', 'Asus Zenbook-Best looking laptops', 'Ultrabooks', '14', '#dedede', '1900', 159999, 144999, 'asus-zenbook.jpeg', 9, 44),
(91, 'Acer', '                                    Best                        ', 'Acer-Bests', 'General', '15.6', '#ffffff', '1900', 88999, 81999, 'acer.jpeg', 23, 41),
(92, 'ASUS Vivobook S15 OLED', '                                                Best laptop under 65000                                ', 'Asus-Laptop', 'Creator laptops', '15.6', '#6b6b6b', '1300', 79999, 73999, 'test.jpg', 23, 37),
(93, 'Lanovo-Think Pad', '                                    All Rounder laptop                        ', 'Lanovo-All Rounder laptops', 'General', '14', '#ededed', '1800', 79999, 74999, 'lenovo-thinkpad.jpeg', 18, 40),
(95, 'ASUS TUF Gaming F17', 'Asus Best Gaming Laptop', 'Asus-Gaming', 'Gaming', '15.6', '#000000', '2.60', 57990, 53990, 'asus-tuf.jpg', 18, 49),
(96, 'Lenovo IdeaPad Pro 5', 'Lenove Ideapad', 'Lenovo-Best Performer', 'Creator laptops', '14', '#e3e3e3', '1.4', 110999, 109990, 'lenovo-ideapad-5.jpg', 18, 54);

-- --------------------------------------------------------

--
-- Table structure for table `tblcomputercategory`
--

CREATE TABLE `tblcomputercategory` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcomputercategory`
--

INSERT INTO `tblcomputercategory` (`id`, `name`, `description`) VALUES
(1, 'Gaming', ''),
(3, 'Convertible', ''),
(4, 'General', ''),
(5, 'Creator laptops', ''),
(6, 'Ultrabooks', ''),
(7, 'AMD laptops', ''),
(8, 'Chromebook', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblfeedback`
--

CREATE TABLE `tblfeedback` (
  `id` int(10) NOT NULL,
  `email` varchar(500) NOT NULL,
  `feedback` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblfeedback`
--

INSERT INTO `tblfeedback` (`id`, `email`, `feedback`) VALUES
(3, 'dhruv@gmail.com', 'ABCD'),
(4, 'aryan1234@gmail.com', 'ABCD'),
(5, 'dhruv@gmail.com', 'dasdsd'),
(6, 'dhruv@gmail.com', 'aaaaaaaaaaa');

-- --------------------------------------------------------

--
-- Table structure for table `tblmaster`
--

CREATE TABLE `tblmaster` (
  `id` int(10) NOT NULL,
  `name` varchar(400) NOT NULL,
  `description` varchar(400) NOT NULL,
  `slug` varchar(400) NOT NULL,
  `category` varchar(400) NOT NULL,
  `size` varchar(200) NOT NULL,
  `color` varchar(200) NOT NULL,
  `weight` varchar(200) NOT NULL,
  `oldprice` int(20) NOT NULL,
  `newprice` int(20) NOT NULL,
  `images` varchar(300) NOT NULL,
  `status` varchar(100) NOT NULL,
  `processor` varchar(100) NOT NULL,
  `clock_speed` varchar(100) NOT NULL,
  `gpu` varchar(100) NOT NULL,
  `ram` varchar(100) NOT NULL,
  `ram_slot` int(5) NOT NULL,
  `ssd_hdd` varchar(100) NOT NULL,
  `os` varchar(100) NOT NULL,
  `display_size` varchar(100) NOT NULL,
  `display_type` varchar(100) NOT NULL,
  `display_touch` varchar(100) NOT NULL,
  `power_adapter` varchar(100) NOT NULL,
  `battery_capacity` varchar(100) NOT NULL,
  `battery_hour` varchar(100) NOT NULL,
  `dimension` varchar(100) NOT NULL,
  `colors` varchar(100) NOT NULL,
  `io_ports` varchar(100) NOT NULL,
  `fingerprint_sensor` varchar(100) NOT NULL,
  `camera` varchar(100) NOT NULL,
  `keyboard` varchar(100) NOT NULL,
  `touchpad` varchar(100) NOT NULL,
  `wifi` varchar(100) NOT NULL,
  `bluetooth` varchar(100) NOT NULL,
  `speaker` varchar(100) NOT NULL,
  `mic` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblmaster`
--

INSERT INTO `tblmaster` (`id`, `name`, `description`, `slug`, `category`, `size`, `color`, `weight`, `oldprice`, `newprice`, `images`, `status`, `processor`, `clock_speed`, `gpu`, `ram`, `ram_slot`, `ssd_hdd`, `os`, `display_size`, `display_type`, `display_touch`, `power_adapter`, `battery_capacity`, `battery_hour`, `dimension`, `colors`, `io_ports`, `fingerprint_sensor`, `camera`, `keyboard`, `touchpad`, `wifi`, `bluetooth`, `speaker`, `mic`) VALUES
(37, 'ASUS Vivobook S15 OLED', '                                                Best laptop under 65000                                ', 'Asus-Laptop', 'Creator laptops', '15.6', '#6b6b6b', '1300', 79999, 73999, 'test.jpg', 'Active', '12th Gen Intel EVO Core i5-12500H', '2.5 GHz Base Speed', '16 GB', '16 GB', 2, 'SSD', 'Windows 11 Home', '15.6', 'OLED', 'None', '90W', '‎90 Watts', '10 Hours', '‎23.3 x 36 x 1.9 cm; 1.8 kg', 'Black', 'All', 'None', '720p Webcam', 'Backlit Keyboard', 'Fully Functional', 'Wi-Fi 6E', 'v5.3', 'Built in', '3'),
(39, 'HP-Pvillion', '                                                                        Best Performer                                                ', 'HP-Best Performer', 'Gaming', '17.3', '#000000', '2000', 100000, 90000, 'hp-pavilion.jpeg', 'Active', '12th Gen Intel Core i7-12500H', '3.2 GHz Base Speed', 'NVIDIA® GeForce RTX™ 4090', '32GB', 2, 'SSD', 'Windows 11 Home', '17.3', 'OLED', 'None', '120W', '90 Watts', '3 Hours', '23.3 x 36 x 1.9 cm;  2.0 kg', 'Black', 'All', 'None', '1080p Webcam', 'Backlit RGB Keyboard', 'Fully Functional', 'Wi-Fi 6E', 'v5.4', 'Built in', '4'),
(40, 'Lanovo-Think Pad', '                                    All Rounder laptop                        ', 'Lanovo-All Rounder laptops', 'General', '14', '#ededed', '1800', 79999, 74999, 'lenovo-thinkpad.jpeg', 'Active', '12th Gen Intel EVO Core i5-12500H', '2.5 GHz Base Speed', 'Intel irix', '16 GB', 2, 'SSD', 'Windows 11 Home', '14', 'OLED', 'None', '90W', '90 Watts', '09 Hours', '‎23.3 x 36 x 1.9 cm; 1.6 kg', 'Black', 'All', 'Yes', '720p Webcam', 'Backlit Keyboard', 'Fully Functional', 'Wi-Fi 6E', 'v5.3', 'Built in', '3'),
(41, 'Acer', '                                    Best                        ', 'Acer-Bests', 'General', '15.6', '#ffffff', '1900', 88999, 81999, 'acer.jpeg', 'Active', '13th Gen Intel EVO Core i5-13250H', '2.7 GHz Base Speed', 'Intel irix', '16GB', 2, 'SSD', 'Windows 11 Home', '15.6', 'OLDE', 'None', '120W', '120 Watts', '8 Hours', '‎23.3 x 36 x 1.9 cm; 1.5 kg', 'Silver', 'All', 'None', '720p Webcam', 'Backlit Keyboard', 'Fully Functional', 'Wi-Fi 6E', 'v5.3', 'Built in', '5'),
(44, 'Asus Zenbook', '                                    Best looking laptop                        ', 'Asus Zenbook-Best looking laptops', 'Ultrabooks', '14', '#dedede', '1900', 159999, 144999, 'asus-zenbook.jpeg', 'Active', 'Intel Evo Platform, Core i7-1165G7', '‎4.7 GHz', '‎Intel Iris Xe Graphics', '8GB RAM', 0, '512GB PCIe SSD', 'Windows 10 Home', '14', 'FHD NanoEdge Touch Display', 'Innovative ScreenPad Plus', '90W', '‎70 Watt Hours', '‎10.5 Hours', '32.41 x 22.2 x 1.73 cm; 1.57 kg', 'Blue', 'All', 'None', '1080p Webcam', 'Backlit Keyboard', 'Fully Functional', 'Wi-Fi 6E', 'v5.1', 'Built in', '3'),
(47, 'HP Laptop 15s', 'Slim and Best for student', 'HP-slim and best', 'General', '14', '#bababa', '1.69', 45999, 41250, 'hp15s.jpeg', 'Active', 'AMD Ryzen 5 5500U', '2.2 GHz Base Speed', 'AMD Radeon Graphics', '16GB DDR4', 1, '512GB SSD', '‎Windows 11 Home', '14', 'Full HD', 'None', '45 Volts', '‎41 Watt Hours', '3 Hours', '35.8 x 24.2 x 1.8 cm; 1.69 kg', 'Silver', 'All', 'None', '720p HD Camera', 'Backlit KB', 'Fully Functional', 'Wi-Fi 5.5', 'v5.1', 'Built in', '2'),
(48, 'HP Victus', 'Best Gaming Laptop', 'HP Gaming', 'Gaming', '15.6', '#7866ff', '2.37', 65999, 61999, 'hp-victos.jpg', 'Active', 'AMD Ryzen 5 5600H', '3.2 GHz Base Speed', '4Gb RTX 3050 Gpu', '16Gb Ddr4', 2, '512Gb Ssd', 'Windows 11 Home', '15.6-Inch', 'Fhd,IPS,144Hz', 'None', '52.5 Watt Hours', '52.5 Watt Hours', '3 Hours', '35.8 x 24 x 2.3 cm; 2.37 kg', 'Blue', 'All', 'None', '720p Webcam', 'Backlit Kb', 'Fully Functional ', 'Wi-Fi 6E', 'v5.3', 'Dual Speakers', '5'),
(49, 'ASUS TUF Gaming F17', 'Asus Best Gaming Laptop', 'Asus-Gaming', 'Gaming', '15.6', '#000000', '2.60', 57990, 53990, 'asus-tuf.jpg', 'Active', 'Intel Core i5-11400H 11th Gen', '4.5 GHz', '4GB NVIDIA GeForce RTX 2050', '16GB DDR4', 2, '1TB SSD', 'Windows 11 Home', '17.3-inch (43.94 cm)', 'FHD 165Hz', 'None', '90W', '90 Watts', '3.5 Hours', '49.29 x 32.7 x 10.3 cm; 2.6 kg', 'Black', 'All', 'None', '720p Webcam', 'RGB Backlit KB', 'Fully Functional', 'Wi-Fi 6E', 'v5.3', 'Built in', '3'),
(52, 'Acer Nitro V Gaming Laptop', 'Acer gaming laptop', 'Acer-gaming', 'Gaming', '15.6', '#000000', '2.1', 81999, 77480, 'acer-nitro.jpg', 'Active', '13th Gen Intel Core i5-13420H', '‎3.4 GHz', 'RTX 4050 Graphics 6GB VRAM', '16GB DDR5', 2, '512GB SSD', 'Windows 11 Home', '15.6', '144Hz Display', 'None', '‎240 Volts', '57 Watts', '‎5 Hours', '50.4 x 7.2 x 50.4 cm; 2.1 kg', 'Black', 'All', 'None', '720p Webcam', 'RGB Backlit KB', 'Fully Functional', 'Wi-Fi 6', 'v5.3', 'Built in', '4'),
(53, 'Dell New Inspiron 14 Plus', 'Dell AI Laptop', 'Dell-Ai 14', 'Chromebook', '14', '#b8cfff', '1.24', 99999, 97989, 'dell-i-14.jpg', 'Active', 'AI Enabled Intel Evo Powered Core Ultra 7 155H Processor', '4.8 GHz', 'Integrated', '16GB LPDDR5X', 2, '1TB SSD', 'Windows 11 Home', '14', 'OLED', 'Yes', '90W', '64 Watt Hours', '8+ Hours', '6.7 x 34.4 x 39.9 cm; 2.6 kg', 'Ice Blue', 'All', 'Yes', '1080p Webcam', 'Backlit KB', 'Fully Functional', 'Wi-Fi 6E', 'v5.3', 'Built in', '4'),
(54, 'Lenovo IdeaPad Pro 5', 'Lenove Ideapad', 'Lenovo-Best Performer', 'Creator laptops', '14', '#e3e3e3', '1.4', 110999, 109990, 'lenovo-ideapad-5.jpg', 'Active', 'Intel Evo Core Ultra 9 185H', '‎5.1 GHz', '‎Integrated Intel Arc Graphics', '32GB', 2, '1TB SSD', 'Windows 11 Home', '14', '2.8K-OLED 400Nits 120Hz', 'Yes', '120W', '‎84 Watt Hours', '5 Hours', '6.9 x 28.7 x 47.4 cm; 1.46 kg', 'Silver', 'All', 'Yes', 'FHD+IR Camera', 'Backlit Keyboard', 'Fully Functional', 'Wi-Fi 6', 'v5.3', '‎Stereo speakers, 2W x2, optimized with Dolby Audio', '3'),
(55, 'Samsung Galaxy Book3 Pro 360', 'Samsung Galaxy book3 Pro', 'Samsung-360', 'Convertible', '15.6', '#000000', '1.6', 110999, 109990, 'samsung-book3.jpg', 'Active', 'Intel 13th Gen i7 EvoTM', '‎5 GHz', '‎Intel Iris Xe Graphics', '16 GB', 2, '512 GB SSD', 'Windows 11 Home, Microsoft Office 2021', '15.6', '3K Display, 120Hz', 'Touchscreen ', '‎65 Watts', '‎84 Watt Hours', '7 Hours', '25.2 x 35.5 x 1.3 cm; 1.66 kg', 'Black', 'All', '‎Fingerprint Reader', '‎1080p', 'Backlit Keyboard', 'Fully Functional', 'Wi-Fi 6', 'v5.3', 'Stereo speakers', '4'),
(56, 'ASUS TUF Gaming A15 (2024)', 'Asus Tuf', 'ASUS-Gaming', 'AMD laptops', '15.6', '#000000', '2.20', 149999, 142990, 'asus-tuf-amd.jpg', 'Active', 'AMD Ryzen 9 8945H', '‎4 GHz', 'NVIDIA GeForce RTX 4070', '16GB DDR5', 2, '1TB SSD', 'Windows 11/Office 2021', '15.6', 'FHD 144Hz', 'None', '120W', '90 Watt Hours', '3 Hours', '10.4 x 31.2 x 42.9 cm; 2.2 kg', 'Mecha Gray', 'All', 'None', '720p Webcam', 'RGB Backlit KB', 'Fully Functional', 'Wi-Fi 6E', 'v5.4', 'Built in', '3'),
(57, 'HP OMEN Gaming Laptop', 'HP omen', 'HP-OMEN Gaming', 'Gaming', '15.6', '#000000', '2.35', 134999, 128490, 'hp-omen.jpg', 'Active', '13th Gen Intel Core i7-13700HX', '5 GHz', 'NVIDIA', '16GB DDR5', 2, '1TB SSD', 'Windows 11 Home', '15.6', 'FHD, IPS, 165Hz, 300 nits', 'None', '120W', '83 Watt Hours', '4 Hours', '6.9 x 44.9 x 59.3 cm; 2.32 kg', 'Black', 'All', 'None', '720p Webcam', 'RGB Backlit KB', 'Fully Functional', 'Wi-Fi 6', 'v5.4', 'Built in', '4');

-- --------------------------------------------------------

--
-- Table structure for table `tblpolicy`
--

CREATE TABLE `tblpolicy` (
  `id` int(10) NOT NULL,
  `name` varchar(300) NOT NULL,
  `description` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpolicy`
--

INSERT INTO `tblpolicy` (`id`, `name`, `description`) VALUES
(5, '1. Privacy Policy', '<p><strong>Purpose:</strong> Outlines how the website collects, uses, and protects customer data.</p><p><strong>Key Elements:</strong></p><ul><li>Types of data collected (e.g., personal information, payment details).</li><li>How the data is used (e.g., for processing orders, marketing).</li><li>Data protection measures in place.</li><li>Third-party sharing practices.</li><li>Customer rights regarding their data (e.g., access, deletion).</li></ul>'),
(6, '2. Return and Refund Policy', '<p><strong>Purpose:</strong> Describes the process for returning products and obtaining refunds.</p><p><strong>Key Elements:</strong></p><ul><li>Conditions under which returns are accepted (e.g., within 30 days, unused items).</li><li>Steps to initiate a return.</li><li>Refund methods and timeframes.</li><li>Non-refundable items (e.g., sale items, digital products).</li></ul>'),
(7, '3. Shipping Policy', '<p><strong>Purpose:</strong> Provides details on how and when products will be shipped to customers.</p><p><strong>Key Elements:</strong></p><ul><li>Shipping options and costs.</li><li>Estimated delivery times.</li><li>International shipping availability and customs information.</li><li>Handling times and order processing.</li><li>Procedures for lost or damaged shipments.</li></ul>');

-- --------------------------------------------------------

--
-- Table structure for table `tblrole`
--

CREATE TABLE `tblrole` (
  `id` int(20) NOT NULL,
  `name` varchar(300) NOT NULL,
  `description` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblrole`
--

INSERT INTO `tblrole` (`id`, `name`, `description`) VALUES
(16, 'Admin', ''),
(17, 'User', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `id` int(20) NOT NULL,
  `fname` varchar(400) NOT NULL,
  `lname` varchar(400) NOT NULL,
  `email` varchar(400) NOT NULL,
  `number` varchar(400) NOT NULL,
  `password` varchar(400) NOT NULL,
  `gender` varchar(400) NOT NULL,
  `dob` varchar(400) NOT NULL,
  `hobby` varchar(400) NOT NULL,
  `image` varchar(400) NOT NULL,
  `role` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`id`, `fname`, `lname`, `email`, `number`, `password`, `gender`, `dob`, `hobby`, `image`, `role`) VALUES
(2, 'Prince', 'Akbari', 'princeakbari1234@gmail.com', '1234567890', '$2y$10$/Awq9V/DP859Hvy7We704eiM4uf9.clOcTGnvi.uAfBmy.8JXLjDC', 'Male', '15-08-2024', 'Dancing, Reading', 'avatar.png', 'User'),
(9, 'Aryan', 'Raval', 'aryan1234@gmail.com', '4567898765', '$2y$10$tee.p0WshPtnsov5sEGlFu8UX2gxmJWviiEN2ot7N8F1VromB5bVO', 'Male', '23-08-2024', 'Singing, Dancing, Reading, Swimming', 'avatar6.png', 'User'),
(17, 'b', 'b', 'b@gmail.com', '1231231231', '$2y$10$BiTqeXfCgM/G0DHkydGUQObdclyKrH99EFgZuFmeGMIJG6UPhTEha', 'Female', '20-08-2024', 'Singing, Dancing, Swimming, Travelling', '', 'User'),
(18, 'Dhruv', 'Gajera', 'dhruv@gmail.com', '9023755654', '$2y$10$UxRb8T6bc6YqtKrm75kOh.fxOrT7QNdcsAFB8dSWESRTIeI9wzr3q', 'Male', '22-06-2005', 'Singing, Writing, Travelling', 'me.jpg', 'Admin'),
(19, 'Vivek', 'Bharadva', 'vivek@gmail.com', '3456789098', '$2y$10$wii381Gths0sG5pllq94Y.UdPjnt1UjSXnjHwIbpWaNuW6rivvNbK', 'Male', '05-08-2024', 'Dancing, Reading, Swimming', '', 'User'),
(20, 'Hardik', 'Bodar', 'hardik@gmail.com', '4567894564', '$2y$10$Bh.hkJtLpEJz3Hk42rNexe.q8a9s0c/y3XoGYNpYNt9d6AJNTVxXy', 'Male', '09-04-2024', 'Dancing, Reading, Travelling', '', 'User'),
(21, 'Prince', 'Lakhankiya', 'prince1234@gmail.com', '1230986754', '$2y$10$2n4QLvx/9q9JaTgWg.EZCuN2l571TL0wnec2MaFuMk5zhuQ9v53EK', 'Male', '30-05-2021', 'Singing, Dancing, Writing', '', 'User'),
(22, 'a', 'a', 'a@gmail.com', '2346587665', '$2y$10$bBRPcLR.N9Y15Dy2I73VW.X42mbAhP/6l87nM9.MNkeGpTpgC8A/W', 'Female', '01-01-1970', 'Dancing, Reading, Swimming', '', 'User'),
(23, 'Jash', 'Paghadar', 'jash@gmail.com', '9045678798', '$2y$10$DihCzKdxmmcaj9FROIDcb.RoF1TLlNigtckPCORf17d4.bOvojsuS', 'Male', '13-01-2004', 'Singing, Writing, Reading', 'avatar7.jpeg', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcomputercategory`
--
ALTER TABLE `tblcomputercategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmaster`
--
ALTER TABLE `tblmaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpolicy`
--
ALTER TABLE `tblpolicy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblrole`
--
ALTER TABLE `tblrole`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblcart`
--
ALTER TABLE `tblcart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `tblcomputercategory`
--
ALTER TABLE `tblcomputercategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblfeedback`
--
ALTER TABLE `tblfeedback`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblmaster`
--
ALTER TABLE `tblmaster`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tblpolicy`
--
ALTER TABLE `tblpolicy`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblrole`
--
ALTER TABLE `tblrole`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
