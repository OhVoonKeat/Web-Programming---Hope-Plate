-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2024 at 10:32 AM
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
-- Database: `hopeplatedatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `Admin_ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Phone_num` varchar(15) NOT NULL,
  `Gender` enum('Male','Female','Other') NOT NULL,
  `DOB` date NOT NULL,
  `Pass` varchar(225) NOT NULL,
  `Register_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`Admin_ID`, `Name`, `Email`, `Phone_num`, `Gender`, `DOB`, `Pass`, `Register_date`) VALUES
(1, 'Oh Voon Keat', 'vkoh3128@gmail.com', '017-3210383', 'Male', '2004-08-22', '26f582b38851b3041c6d7d49af12cd4d6010d331', '2024-12-08 20:16:35'),
(2, 'Lee Seng Wai', 'sengwai@gmail.com', '012-3456789', 'Male', '2004-01-01', '00eac676b81ee5ec6ad9581b334877e56390e6a8', '2024-12-08 20:16:35'),
(3, 'Charis Kwan', 'lecturer_ck@gmail.com', '017-1234567', 'Female', '1990-01-01', '51b1a6fd3ec2df0c890dcad10ddb72e4f6270450', '2024-12-08 20:16:35');

-- --------------------------------------------------------

--
-- Table structure for table `contact_form`
--

CREATE TABLE `contact_form` (
  `Contact_ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Phone_num` varchar(15) NOT NULL,
  `Message` varchar(500) NOT NULL,
  `Form_submission_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_form`
--

INSERT INTO `contact_form` (`Contact_ID`, `Name`, `Email`, `Phone_num`, `Message`, `Form_submission_date`) VALUES
(1, 'Ali', 'ali_123@gmail.com', '012-5533221', 'I need help!!!!', '2024-11-24 00:43:03'),
(2, 'John', 'john@gmail.com', '017-3210383', 'I faced some bug and I need help...', '2024-12-12 20:18:08'),
(3, 'Sarah', 'sarah@gmail.com', '017-6588790', 'I wish the login have more features!', '2024-12-12 20:19:09'),
(4, 'James', 'james@gmail.com', '019-8584330', 'I am writing on behalf of Feeding America and we are keen to partner with you to support your initiatives. We specialise in distributing meals to communities in need, and we believe our resources could help amplify your impact.\r\nLooking forward to discussing this further.', '2024-12-13 14:53:10'),
(5, 'Shelly', 'shelly@gmail.com', '012-7908567', 'I am truly inspired by your mission to eliminate hunger. I wanted to share some ideas that might help reach more people in need, such as partnerships and awareness campaigns. Please let me know if I can help implement this.', '2024-12-13 14:55:57'),
(6, 'David Wilson', 'david@gmail.com', '013-5566789', 'I am interested in joining your efforts to achieve zero hunger. Could you please provide more information about the volunteering opportunities available? I would love to contribute to your mission but i faced some issues when signing up for it.', '2024-12-13 14:58:20'),
(7, 'Olivia Davis', 'olivia2024@gmail.com', '012-1112233', 'I represent Food Forward, and we share a similar commitment to helping underserved communities. I would love to discuss potential partnership opportunities where we can combine our efforts to address food insecurity.\r\n\r\nLet me know a convenient time for us to connect. I look forward to exploring how we can work together to make a difference!', '2024-12-13 15:00:16'),
(8, 'Tan Hui Zhe', 'egg_tan@gmail.com', '019-3310987', 'As a blogger, I admire your dedication to tackling hunger. I would love to collaborate on spreading awareness about your initiatives through blogs, and social media.\r\n\r\nLet me know how we can work together to amplify your impact!', '2024-12-13 15:01:50');

-- --------------------------------------------------------

--
-- Table structure for table `donation_form`
--

CREATE TABLE `donation_form` (
  `DONATION_ID` int(11) NOT NULL,
  `Reference_ID` varchar(20) DEFAULT NULL,
  `Name` varchar(50) NOT NULL,
  `Gender` enum('Male','Female','Other') NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Type_of_donation` varchar(5) NOT NULL,
  `Food_donation_type` varchar(30) DEFAULT NULL,
  `Food_collection_date` varchar(15) DEFAULT NULL,
  `Food_donation_location` varchar(500) DEFAULT NULL,
  `Payment_method` varchar(13) DEFAULT NULL,
  `Amount` varchar(20) DEFAULT NULL,
  `Card_number` varchar(16) DEFAULT NULL,
  `CVV` varchar(4) DEFAULT NULL,
  `Card_expiry_date` varchar(10) DEFAULT NULL,
  `Bank` varchar(30) DEFAULT NULL,
  `PayPal_email` varchar(40) DEFAULT NULL,
  `Form_submission_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation_form`
--

INSERT INTO `donation_form` (`DONATION_ID`, `Reference_ID`, `Name`, `Gender`, `Email`, `Phone`, `Type_of_donation`, `Food_donation_type`, `Food_collection_date`, `Food_donation_location`, `Payment_method`, `Amount`, `Card_number`, `CVV`, `Card_expiry_date`, `Bank`, `PayPal_email`, `Form_submission_date`) VALUES
(1, 'HP675bee575d6c2', 'Sarah Tan', 'Female', 'sarah@gmail.com', '012-0098564', 'Food', 'Canned Food', '2024-12-15', 'No. 12, Jalan Tun Razak, Kuala Lumpur, Malaysia', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', '2024-12-13 16:20:39'),
(2, 'HP675befacd9b7c', 'Tan Hui Zhe', 'Male', 'zhe.ht0623@gmail.com', '012-2267319', 'Food', 'Canned Food', '2024-12-27', 'N0.35, Jalan Telur, Mount Kinabalu, Malaysia', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', '2024-12-13 16:26:20'),
(3, 'HP675bf279c1289', 'James', 'Male', 'james324@gmail.com', '016-8975418', 'Money', 'NA', 'NA', 'NA', 'Bank Transfer', '300.00', 'NA', 'NA', 'NA', 'Maybank', 'NA', '2024-12-13 16:38:17'),
(4, 'HP675bf3863edb8', 'Nurul Hana', 'Female', 'nurul@gmail.com', '016-0980997', 'Money', 'NA', 'NA', 'NA', 'PayPal', '150.00', 'NA', 'NA', 'NA', 'NA', 'nurul@gmail.com', '2024-12-13 16:42:46'),
(5, 'HP675bf779e5b24', 'Alen Teoh', 'Male', 'alen_teoh@gmail.com', '019-3322445', 'Money', 'NA', 'NA', 'NA', 'Credit Card', '1000.00', '9876543210987654', '456', '11/28', 'NA', 'NA', '2024-12-13 16:59:37'),
(6, 'HP675bf815c5903', 'Aaron Tan', 'Male', 'aaron_04@gmail.com', '017-1155009', 'Food', 'Others', '2025-01-25', 'No. 10, Jalan Hang Tuah, Melaka City, Melaka, Malaysia', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', '2024-12-13 17:02:13'),
(7, 'HP675bf862de1bc', 'Lee Wei Ling', 'Female', 'wl_Lee@gmail.com', '019-5569384', 'Money', 'NA', 'NA', 'NA', 'PayPal', '100.00', 'NA', 'NA', 'NA', 'NA', 'wl_Lee@gmail.com', '2024-12-13 17:03:30'),
(8, 'HP675bf8d502d9b', 'Amy Chan', 'Female', 'amy5505@gmail.com', '012-1980328', 'Food', 'Dry Goods', '2024-12-31', '17, Jalan Seremban, Seremban, Negeri Sembilan, Malaysia', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', '2024-12-13 17:05:25'),
(9, 'HP675bf8fabbfe2', 'Oh Voon Keat', 'Male', 'vkoh3128@gmail.com', '017-3210383', 'Money', 'NA', 'NA', 'NA', 'Bank Transfer', '300.00', 'NA', 'NA', 'NA', 'CIMB Bank', 'NA', '2024-12-13 17:06:02'),
(10, 'HP675bf9b0bd10b', 'Shelly', 'Female', 'shelly@gmail.com', '012-7908567', 'Food', 'Packaged Food', '2024-12-16', 'No. 45, Jalan Padungan, Kuching, Sarawak, Malaysia', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', '2024-12-13 17:09:04'),
(11, 'HP675bfa2d59520', 'Mohammad Rahman', 'Male', 'm_rahman@gmail.com', '016-9765321', 'Money', 'NA', 'NA', 'NA', 'Bank Transfer', '50.00', 'NA', 'NA', 'NA', 'Bank Islam', 'NA', '2024-12-13 17:11:09'),
(12, 'HP675bfad0724cb', 'Oh Kok Lin', 'Male', 'kloh@gmail.com', '012-6554367', 'Food', 'Packaged Food', '2024-12-22', 'No. 4, Jalan Bumi, Pangsapuri Sri Pelangi, Shah Alam, Selangor, Malaysia.', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', '2024-12-13 17:13:52'),
(13, 'HP675bfb7f528cc', 'Cynthia Ng', 'Female', 'cynthia@gmail.com', '013-2255990', 'Money', 'NA', 'NA', 'NA', 'Credit Card', '400.00', '1054597891234567', '123', '10/29', 'NA', 'NA', '2024-12-13 17:16:47'),
(14, 'HP675bfc20227d8', 'Lee Seng Wai', 'Male', 'lees7340@gmail.com', '017-8893963', 'Money', 'NA', 'NA', 'NA', 'Bank Transfer', '600.00', 'NA', 'NA', 'NA', 'RHB Bank', 'NA', '2024-12-13 17:19:28'),
(15, 'HP675bfcc26041d', 'Chris Evans', 'Male', 'chrisE@gmail.com', '012-3344556', 'Food', 'Others', '2025-01-02', 'No. 10, Jalan Sultan Yusof, Ipoh, Perak, Malaysia', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', 'NA', '2024-12-13 17:22:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_table`
--

CREATE TABLE `user_table` (
  `User_ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Phone_num` varchar(15) NOT NULL,
  `Gender` enum('Male','Female','Other') NOT NULL,
  `DOB` date NOT NULL,
  `Pass` varchar(225) NOT NULL,
  `Register_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_table`
--

INSERT INTO `user_table` (`User_ID`, `Name`, `Email`, `Phone_num`, `Gender`, `DOB`, `Pass`, `Register_date`) VALUES
(1, 'Ethan', 'ethan@gmail.com', '016-1122334', 'Male', '2000-05-11', '7c222fb2927d828af22f592134e8932480637c0d', '2024-11-28 20:14:16'),
(2, 'Jessie', 'jessie@gmail.com', '017-0909098', 'Female', '2000-12-12', '19dd466e43cdbd3833abc0609eba6d8786f9b342', '2024-12-03 13:53:56'),
(3, 'James', 'james324@gmail.com', '016-8975418', 'Male', '1978-02-28', '00525608d3a193127576e33d9d0f4760db4174fc', '2024-12-03 20:53:24'),
(7, 'Alex Johnson', 'alexjohnson@gmail.com', '012-9876543', 'Male', '1990-03-15', '8efb89ad2ba300a93f304d49b7c339478afe8f54', '2024-12-08 16:36:24'),
(8, 'David Wilson', 'david@gmail.com', '013-5566789', 'Male', '1992-12-05', '8cf2e44a935fe4c453f118c032adb5b0a3ce66fe', '2024-12-08 16:37:58'),
(9, 'Olivia Davis', 'olivia2024@gmail.com', '012-1112233', 'Female', '2001-11-21', '8c8ad5fc3425af26a49537a7c1045f985f6b4992', '2024-12-08 16:39:57'),
(10, 'Mia Anderson', 'mia@gmail.com', '013-6666554', 'Female', '1991-07-25', '6477d868a3cd1aa69db8e257ffbfaea12b20b17c', '2024-12-08 16:41:01'),
(11, 'Chris Evans', 'chrisE@gmail.com', '012-3344556', 'Male', '1997-08-30', '7ea0346fcd2874259a8ebe0ba28c9b221348cb54', '2024-12-08 16:42:19'),
(12, 'Sophia Miller', 'miller@gmail.com', '016-7777993', 'Female', '1998-02-18', '6b5ec67196379d8883fea7cc3476461f4b7ff2f3', '2024-12-08 16:44:11'),
(13, 'Michael Brown', 'michael@gmail.com', '016-4432190', 'Male', '1995-10-11', 'abe31fae1302ee0d7491b5b3526456a2c5ae88d9', '2024-12-08 16:45:46'),
(16, 'Emma Taylor', 'emma@gmail.com', '017-6679036', 'Female', '1993-04-12', 'd05c7aad901e14ef05a391ab69bcac280176d331', '2024-12-09 21:32:01'),
(17, 'Shelly', 'shelly@gmail.com', '012-7908567', 'Female', '1999-05-01', 'f1dd94668603966630eee6b247dfc4b88df9cb8c', '2024-12-09 21:36:24'),
(18, 'Ern Ching', 'ern_ching@gmail.com', '017-1234567', 'Other', '2006-06-27', '9c4d2809450c8e83333c9fc0a188f03d54f7a94e', '2024-12-09 21:59:26'),
(19, 'Sarah Tan', 'sarah@gmail.com', '012-0098564', 'Female', '1992-12-06', 'f7018b79110c7226971dc2ca3f803a45bd4c6e9f', '2024-12-12 20:58:34'),
(20, 'Amir Ali', 'amirali@gmail.com', '019-7734562', 'Male', '1985-09-23', '85e85da5add13776b628cd994df67879076afb99', '2024-12-12 21:00:06'),
(21, 'Jessica Lee', 'jessica_lee@gmail.com', '017-5987554', 'Female', '1990-11-30', 'd07d854ffe1b670791c4750e2178c75065224ab2', '2024-12-12 21:02:12'),
(22, 'Mohamad Rahman', 'm_rahman@gmail.com', '016-9765321', 'Male', '1982-04-19', '5d35ef21a9aa7cc978c2adb4d11e7adbec09a499', '2024-12-12 21:03:38'),
(23, 'Amy Chan', 'amy5505@gmail.com', '012-1980328', 'Female', '1995-11-09', 'afbd96097bf5f737c673e4ad521add592fd53737', '2024-12-12 21:05:12'),
(24, 'Siew Lin', 'chu_siewl@gmail.com', '012-6566230', 'Female', '1984-06-27', '5c0dc4c9b02a8e6a2c2fa0f7186eed6db7f411ca', '2024-12-12 21:07:00'),
(25, 'Oh Kok Lin', 'kloh@gmail.com', '012-6554367', 'Male', '1979-01-06', 'ec44bf2b45c0292253a297eefa77e697a62f0744', '2024-12-12 21:08:37'),
(26, 'Tan Hui Zhe', 'egg_tan@gmail.com', '019-3310987', 'Male', '2004-06-23', '7570f752774de0d949f33eb7c54788c5b7eaa7f5', '2024-12-12 21:09:55'),
(29, 'Brock', 'brock@gmail.com', '012-2980698', 'Male', '2003-12-01', '318dc20bcae264010281196a88f1626a7942de51', '2024-12-13 17:23:41'),
(30, 'Yap Kim Eng', 'kim_04@gmail.com', '016-9763457', 'Male', '2004-09-10', '7c781d2ce928eb524048626733a052db31fb9aa0', '2024-12-13 17:25:50');

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_form`
--

CREATE TABLE `volunteer_form` (
  `Volunteer_ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Gender` enum('Male','Female','Other') NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Phone` varchar(15) NOT NULL,
  `Home_address` varchar(500) NOT NULL,
  `Available_date` datetime NOT NULL,
  `Role_preference` varchar(50) NOT NULL,
  `Form_submission_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `volunteer_form`
--

INSERT INTO `volunteer_form` (`Volunteer_ID`, `Name`, `Gender`, `Email`, `Phone`, `Home_address`, `Available_date`, `Role_preference`, `Form_submission_date`) VALUES
(1, 'Lyra Ashwind', 'Female', 'lyra@gmail.com', '017-7965430', 'No. 23, Jalan Melur 3, Taman Indah, 47000 Petaling Jaya, Selangor, Malaysia.', '2024-12-24 00:00:00', 'sorting_and_packaging_food', '2024-12-05 23:04:14'),
(2, 'Elric Thornefield', 'Male', 'elric@gmail.com', '016-4399383', 'Lot 87, Kampung Sungai Batu, 32010 Seri Manjung, Perak, Malaysia.', '2025-01-14 00:00:00', 'transportation', '2024-12-06 14:05:04'),
(3, 'James', 'Male', 'james009@gmail.com', '016-5599876', 'Jalan Sri Perdana 7, Taman Sri Perdana, 53000 Kuala Lumpur, Malaysia.', '2024-12-17 00:00:00', 'sorting_and_packaging_food', '2024-12-12 20:21:46'),
(4, 'Lee Xiao Ming', 'Male', 'xm_04@gmail.com', '019-44444444', 'No. 15, Jalan Meranti Indah, Kampung Sungai Baru, 43000 Kajang, Selangor, Malaysia.', '2025-02-10 00:00:00', 'others', '2024-12-12 20:23:27'),
(5, 'John Smith', 'Male', 'john@gmail.com', '012-9054329', '123 Jalan Maple, Kuala Lumpur, Malaysia', '2024-12-20 00:00:00', 'collecting_and_distributing_food', '2024-12-13 14:42:23'),
(6, 'Maria Garcia', 'Female', 'maria04@gmail.com', '017-5696998', '456 Lorong Oak, Penang, Malaysia', '2024-12-22 00:00:00', 'none', '2024-12-13 14:43:48'),
(7, 'Aisha Khan', 'Female', 'aisha5565@gmail.com', '019-8865993', '321 Jalan Birch, Kota Kinabalu, Malaysia', '2025-01-03 00:00:00', 'collecting_and_distributing_food', '2024-12-13 14:44:55'),
(8, 'Chen Shen', 'Male', 'oren_god@gmail.com', '016-1543343', '654 Lorong Elm, Selangor, Malaysia', '2025-02-02 00:00:00', 'transportation', '2024-12-13 14:46:06'),
(9, 'Ethan', 'Male', 'ethan@gmail.com', '016-1122334', '14 Jalan Maple, Kuala Lumpur, Malaysia', '2024-12-31 00:00:00', 'collecting_and_distributing_food', '2024-12-13 14:47:49'),
(10, 'Ern Ching', 'Female', 'ern_ching@gmail.com', '017-1234567', '789 Taman Pine, Johor Bahru, Malaysia', '2025-01-16 00:00:00', 'others', '2024-12-13 14:49:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`Admin_ID`);

--
-- Indexes for table `contact_form`
--
ALTER TABLE `contact_form`
  ADD PRIMARY KEY (`Contact_ID`);

--
-- Indexes for table `donation_form`
--
ALTER TABLE `donation_form`
  ADD PRIMARY KEY (`DONATION_ID`);

--
-- Indexes for table `user_table`
--
ALTER TABLE `user_table`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `volunteer_form`
--
ALTER TABLE `volunteer_form`
  ADD PRIMARY KEY (`Volunteer_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `Admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_form`
--
ALTER TABLE `contact_form`
  MODIFY `Contact_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `donation_form`
--
ALTER TABLE `donation_form`
  MODIFY `DONATION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_table`
--
ALTER TABLE `user_table`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `volunteer_form`
--
ALTER TABLE `volunteer_form`
  MODIFY `Volunteer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
