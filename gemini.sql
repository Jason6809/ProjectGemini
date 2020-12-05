-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2017 at 04:21 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_27367122_gemini`
--
CREATE DATABASE IF NOT EXISTS `epiz_27367122_gemini` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `epiz_27367122_gemini`;

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `access_id` int(11) NOT NULL,
  `access_type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `access`
--

INSERT INTO `access` (`access_id`, `access_type`) VALUES
(1, 'ADMIN'),
(2, 'STYLIST'),
(3, 'USER');

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `plate_no` varchar(255) NOT NULL,
  `street_1` text NOT NULL,
  `street_2` text NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `phone_no` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `plate_no`, `street_1`, `street_2`, `postcode`, `city`, `state`, `phone_no`) VALUES
(1, 'NO 953', 'Jalan XYZ', 'Taman XYZ', '81000', 'Kulai', 'Johor', '012-1235544'),
(2, 'NO 13', 'Jalan XYZ', 'Taman XYZ', '81000', 'Kulai', 'Johor', '012-1235544'),
(3, 'NO 953', 'Jalan Teratai 36/13', 'Bandar Indahpura', '81000', 'Kulaijaya', 'Johor', '017-7118334');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stylist_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `book_status` tinyint(1) NOT NULL,
  `book_date` datetime NOT NULL,
  `request_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`book_id`, `user_id`, `stylist_id`, `service_id`, `branch_id`, `book_status`, `book_date`, `request_date`) VALUES
(35, 17, 42, 7, 12, 1, '2017-11-30 15:00:00', '2017-11-30 11:38:27');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `branch_id` int(11) NOT NULL,
  `branch_name` text NOT NULL,
  `branch_address` text NOT NULL,
  `branch_phoneNo` varchar(255) NOT NULL,
  `branch_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch_name`, `branch_address`, `branch_phoneNo`, `branch_img`) VALUES
(10, 'Gemini Salon Mid Valley', 'A-G-2, Ground Floor, Northpoint, \r\nMid Valley City, No.1 Medan Syed Putra Utara \r\n59200 Kuala Lumpur', '+603 2287 0661', 'top-10-hair-salons-in-penang.jpg'),
(11, 'Gemini Salon Bangsar', 'No. 50, Ground Floor, Jalan Telawi, \r\nBangsar Baru, 59100 Kuala Lumpur', '+603 2283 1776', 'blog_post_2017_03_31.jpg'),
(12, 'Gemini Salon Publika', 'A1-G2-2, Solaris Dutamas, \r\nNo. 1, Jalan Dutamas 1, \r\n50480 Kuala Lumpur', '+603 6201 2776', 's_IMG_0558.jpg'),
(13, 'Gemini Salon Starhill Gallery', 'S4, Pamper Floor, Starhill Gallery, \r\nJalan Bukit Bintang, \r\n55100 Kuala Lumpur.', '+603 2141 6676', 'parallax.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `item_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`item_id`, `user_id`, `product_id`) VALUES
(28, 17, 1),
(29, 17, 4);

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `gallery_id` int(11) NOT NULL,
  `img_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`gallery_id`, `img_name`) VALUES
(12, 'FB_IMG_1498121845723.jpg'),
(15, 'FB_IMG_1499945510907.jpg'),
(18, 'FB_IMG_1497165378268.jpg'),
(21, 'Number76 Natural Styles (10)-min.jpg'),
(22, 'Number76 Natural Styles (8)-min.jpg'),
(23, 'Number76 Natural Styles 15-minjpg.jpg'),
(24, 'Number76 Natural Styles (4)-min.jpg'),
(26, 'Number76 Color Styles 24-minjpg.jpg'),
(27, 'Number76 Color Styles (6)-min.jpg'),
(28, 'Number76 Color Styles 21-minjpg.jpg'),
(29, 'Number76 Color Styles 13-minjpg.jpg'),
(30, 'Number76 Color Styles (2)-min.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `news_title` text NOT NULL,
  `news_date` date NOT NULL,
  `news_content` text NOT NULL,
  `img_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_date`, `news_content`, `img_name`) VALUES
(15, 'BLACK FRIDAY SALE 2017', '2017-11-23', 'It’s finally BLACK Friday! This marks the beginning of the holiday shopping season from all over the world. To celebrate Number76 Online Store’s first Black Friday sale, we are happy to share that you’ll be enjoying 20% OFF ALL BLACK items on the 24 November 2017.\r\n\r\nWith 24 HOURS on the clock, enjoy amazing reductions on some of the most sought after items that you can find like CATCH THE WAVE merchandise, scalp shampoo brushes, elegant accessories & headwear and more.\r\n\r\nUse the code, BLKFRI20 at the end of your check out page to discount your purchase! Shop more and earn more!\r\n\r\nTo top it all, with every minimum purchase of RM150, earn yourself a free travel sized hair care product worth RM30. ', 'black-fridaymyjpg.jpg'),
(19, 'title2', '2017-10-20', 'content2', 'news_photo1.jpg'),
(23, 'title3', '2017-11-01', 'content3', '01b35bd7a8e783b2e7d2a4b80d3a63c7--hair-salon-singapore-stole.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_brand` int(11) DEFAULT NULL,
  `product_type` int(11) DEFAULT NULL,
  `product_desc` text NOT NULL,
  `product_price` decimal(6,2) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_brand`, `product_type`, `product_desc`, `product_price`, `product_quantity`, `product_img`) VALUES
(1, 'THE HAIR CARE AIRY FLOW Shampoo', 1, 1, 'Cleanses with a rich lather, leaving hair silky-smooth, and making hair soft and easy to manage.', '39.90', 4, '00109625.jpg'),
(2, 'THE HAIR CARE AIRY FLOW Treatment', 1, 2, 'The soft, melting texture gives hair an airy-soft finish.', '39.90', 10, '0074594.jpeg'),
(3, 'THE HAIR CARE ADENOVITAL Shampoo', 1, 1, 'Gently cleanses the scalp without stripping away the precious moisture, thereby improving the scalp condition to promote the penetration of Scalp Essence V.', '49.90', 6, 'sim.jpg'),
(4, 'ELVIVE Total Repair 5 Repairing Shampoo', 2, 1, 'Shampoo for damaged hair. With Protein + Ceramide. Fights the 5 signs of damage*.', '35.90', 7, 'prod_ec_2268576202.jpg'),
(5, 'THE HAIR CARE ADENOVITAL Scalp Treatment', 1, 2, 'Replenishes the scalp with moisture to optimize the scalp condition for Scalp Essence V to follow.', '35.90', 7, 'THC_AD_TREATMENT_tm_fin_300x300.jpg'),
(6, 'ELVIVE Total Repair 5 Damage Erasing Balm', 2, 2, 'Rinse-out hair mask. For damaged hair. In just 1 use healthier, revived hair*.', '35.90', 9, 'Hca9_5_pack-shot.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_brand`
--

CREATE TABLE `product_brand` (
  `product_brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_brand`
--

INSERT INTO `product_brand` (`product_brand_id`, `brand_name`) VALUES
(1, 'Shiseido'),
(2, 'L\'Oréal');

-- --------------------------------------------------------

--
-- Table structure for table `product_detail`
--

CREATE TABLE `product_detail` (
  `product_detail_id` int(11) NOT NULL,
  `purchase_date` date NOT NULL,
  `cost` decimal(6,2) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_detail`
--

INSERT INTO `product_detail` (`product_detail_id`, `purchase_date`, `cost`, `product_id`) VALUES
(1, '2017-11-01', '19.90', 1),
(2, '2017-11-03', '18.50', 2),
(3, '2017-11-01', '29.50', 3),
(4, '2017-11-01', '19.90', 4),
(5, '2017-11-02', '15.90', 5),
(6, '2017-09-01', '20.00', 6);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `product_type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`product_type_id`, `type_name`) VALUES
(1, 'Shampoo'),
(2, 'Treatment');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `service_price` decimal(6,2) NOT NULL,
  `service_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`service_id`, `service_name`, `service_price`, `service_type`) VALUES
(1, '13-19 years old', '15.00', 1),
(3, 'Touch Up', '148.00', 2),
(4, 'Cold Perm', '265.00', 3),
(6, 'Short', '212.00', 2),
(7, 'Medium', '254.00', 2),
(8, 'Digital Perm', '424.00', 3),
(9, '6-12 years old', '10.00', 1),
(10, '0-5 years old', '0.00', 1),
(12, 'Wash & Blow Dry', '42.00', 5),
(13, 'Ultrasonic Iron Short', '245.00', 4),
(14, 'Ultrasonic Iron Med.', '265.00', 4),
(15, 'Ultrasonic Iron Long', '285.00', 4),
(16, 'Wash & Styling', '62.00', 5),
(19, 'Rebonding Short', '370.00', 3),
(20, 'Rebonding Medium', '424.00', 3),
(21, 'Rebonding Long', '530.00', 5),
(22, 'Above 19', '20.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `service_type`
--

CREATE TABLE `service_type` (
  `service_type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_type`
--

INSERT INTO `service_type` (`service_type_id`, `type_name`) VALUES
(1, 'Cut'),
(2, 'Color'),
(3, 'Perm'),
(4, 'Treatment'),
(5, 'Styling');

-- --------------------------------------------------------

--
-- Table structure for table `stylist`
--

CREATE TABLE `stylist` (
  `stylist_id` int(11) NOT NULL,
  `stylist_ic` varchar(255) NOT NULL,
  `stylist_name` varchar(255) NOT NULL,
  `stylist_school` text NOT NULL,
  `stylist_exp` int(11) NOT NULL,
  `stylist_intro` text NOT NULL,
  `stylist_branch` int(11) DEFAULT NULL,
  `stylist_fees` decimal(6,2) NOT NULL,
  `stylist_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stylist`
--

INSERT INTO `stylist` (`stylist_id`, `stylist_ic`, `stylist_name`, `stylist_school`, `stylist_exp`, `stylist_intro`, `stylist_branch`, `stylist_fees`, `stylist_img`) VALUES
(35, '890102016002', 'Fung', 'Elle Hair Academy', 5, 'A growing name in the hair styling world, his charm and good-natured temperament draw guests to seek advice for tresses in distress. He enjoys strategizing and executing full-on hair makeovers, and takes satisfaction in the smiles of happy guests.', 10, '10.00', 'Fung.jpg'),
(36, '890120016030', 'Calvin Lai', 'Kimarie Hair Academy Malaysia', 7, 'Beneath the cool persona lays a conscientious individual. From glamorous highlights to show-stopping colours to classic styles for both men and women, his versatility in tailoring styles to complement individual features has earned him many happy customers.', 11, '50.00', 'Calvin.jpg'),
(37, '900311015566', 'Suky Lim', 'Kimarie Hair Academy Malaysia', 3, 'Relatively new to the team, she has spent some years gaining experiences and building solid relationships with regulars who highly approve of her works. With swift hands and deft fingers, she is ever-determined to do her best to make a mark in the highly-driven hair industry.', 12, '10.00', 'Suky.jpg'),
(38, '851122016699', 'Ivan Tong', 'Kimarie Hair Academy Malaysia', 4, 'Having been in the team for a couple of years, he has grown to be a familiar face for long-time regulars. Friendly with attention to details, and ever-willing to share insider’s tips on hair styling, its crystal clear why he has since became a favourite for many customers.', 13, '15.00', 'Ivan.jpg'),
(39, '800405012335', 'Steve Koh', 'Kimarie Hair Academy Malaysia', 7, 'The years spent under the guidance of esteemed Japanese hair maestros have earned him impressive skills to gain the customers’ trust. Also fluent in few languages including Japanese, he works regularly with customers from all walks of life.', 10, '50.00', 'Steve.jpg'),
(40, '850611023355', 'Desmond Chong', 'Elle Hair Academy', 5, 'After years of training and working experiences in Number76, he has gained a wide range of knowledge and skills in the hairdressing industry. Pursuing his passion and commitment to his lifelong goal, he hopes to embark his journey of creating new styles and trends while serving his customer’s with the best of customer care.', 11, '15.00', 'Desmond.jpg'),
(42, '950229016655', 'Xuan', 'Elle Hair Academy', 5, 'Relatively fresh to the team, she has a list of happy regulars who have trusted her styling instincts since many years. With a warm and sincere heart, alongside trained techniques, she hopes to satisfy every customer’s personal preferences and needs as best she can.', 12, '20.00', 'Xuan.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stylist_detail`
--

CREATE TABLE `stylist_detail` (
  `stylist_detail_id` int(11) NOT NULL,
  `salary` int(11) NOT NULL,
  `book_accepted` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `stylist_pass` text NOT NULL,
  `stylist_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stylist_detail`
--

INSERT INTO `stylist_detail` (`stylist_detail_id`, `salary`, `book_accepted`, `start_date`, `phone_no`, `stylist_pass`, `stylist_id`) VALUES
(9, 1500, 6, '2017-01-01', '012-1235544', 'S00001111', 35),
(10, 3000, 0, '2015-01-02', '014-4567898', 'S00001112', 36),
(11, 1200, 0, '2016-11-02', '013-7896552', 'S00001113', 37),
(12, 1200, 1, '2017-07-05', '014-7788663', 'S00001114', 38),
(13, 2500, 0, '2014-01-01', '012-3698786', 'S00001115', 39),
(14, 1200, 0, '2017-09-08', '016-9854672', 'S00001116', 40),
(16, 1500, 1, '2015-01-01', '012-3451111', 'S00001117', 42);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `transaction_id` int(11) NOT NULL,
  `transaction_time` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `address_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`transaction_id`, `transaction_time`, `user_id`, `product_id`, `address_id`) VALUES
(39, '2017-11-27 23:51:46', 10, 1, NULL),
(40, '2017-11-27 23:51:46', 10, 2, NULL),
(41, '2017-11-27 23:54:22', 10, 1, NULL),
(42, '2017-11-27 23:54:22', 10, 2, NULL),
(43, '2017-11-29 00:07:48', 10, 1, NULL),
(44, '2017-11-29 00:07:48', 10, 2, NULL),
(45, '2017-11-29 00:14:22', NULL, 2, NULL),
(46, '2017-11-29 00:14:22', NULL, 5, NULL),
(47, '2017-11-29 00:14:22', NULL, 3, NULL),
(48, '2017-11-29 00:14:22', NULL, 1, NULL),
(49, '2017-11-29 00:14:22', NULL, 4, NULL),
(50, '2017-11-29 02:02:21', 10, 1, NULL),
(51, '2017-11-29 02:02:21', 10, 4, NULL),
(52, '2017-11-29 19:11:21', 10, 1, 1),
(53, '2017-11-30 08:40:06', 26, 4, 2),
(54, '2017-11-30 09:23:13', 10, 1, 1),
(55, '2017-11-30 09:25:17', 10, 2, 1),
(56, '2017-11-30 09:25:48', 10, 1, 1),
(57, '2017-11-30 09:26:20', 10, 4, 1),
(58, '2017-11-30 09:26:20', 10, 2, 1),
(59, '2017-11-30 09:29:35', 10, 5, 1),
(60, '2017-11-30 09:29:35', 10, 5, 1),
(61, '2017-11-30 09:31:14', 10, 5, 1),
(62, '2017-11-30 09:31:14', 10, 5, 1),
(63, '2017-11-30 09:33:23', 10, 4, 1),
(64, '2017-11-30 09:33:23', 10, 4, 1),
(65, '2017-11-30 09:33:38', 10, 3, 1),
(66, '2017-11-30 09:33:38', 10, 3, 1),
(67, '2017-11-30 09:38:22', 10, 3, 1),
(68, '2017-11-30 09:38:22', 10, 3, 1),
(69, '2017-11-30 09:40:12', 10, 1, 1),
(70, '2017-11-30 09:40:12', 10, 1, 1),
(71, '2017-11-30 09:42:02', 10, 4, 1),
(72, '2017-11-30 09:42:02', 10, 4, 1),
(73, '2017-11-30 09:44:23', 10, 1, 1),
(74, '2017-11-30 09:44:23', 10, 1, 1),
(75, '2017-11-30 10:20:08', 10, 1, 1),
(76, '2017-11-30 23:18:26', 10, 3, 1),
(77, '2017-11-30 23:18:26', 10, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `stylist_id` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `access_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `stylist_id`, `email`, `firstname`, `lastname`, `password`, `access_level`) VALUES
(7, NULL, 'admin@admin.com', 'Admin', 'Admin', 'dd4b21e9ef71e1291183a46b913ae6f2', 1),
(10, NULL, 'pavitradrew@gmail.com', 'Pavitra', 'Naaidu', '6ebe76c9fb411be97b3b0d48b791a7c9', 3),
(15, 35, 'fung@stylist.com', 'Fung', 'Fung', 'deb558b68c5ebbb7cf03639e833e1bbe', 2),
(17, NULL, 'jason6809@hotmail.com', 'Jason', 'Tam', 'd54d1702ad0f8326224b817c796763c9', 3),
(18, 36, 'calvinlai@stylist.com', 'Calvin Lai', 'Calvin Lai', '4a16bd360d2a27b0faefcbcbf586c932', 2),
(19, 37, 'sukylim@stylist.com', 'Suky Lim', 'Suky Lim', '4820b6bdb96dafdb7fa91b591b5d98a0', 2),
(20, 38, 'ivantong@stylist.com', 'Ivan Tong', 'Ivan Tong', '934f200b7fa0b17288798d2f8678831a', 2),
(21, 39, 'stevekoh@stylist.com', 'Steve Koh', 'Steve Koh', 'c6f0f46c8f0d737ace042df4ddac57cc', 2),
(22, 40, 'desmondchong@stylist.com', 'Desmond Chong', 'Desmond Chong', '5fd954035a4361e4c911a3e4a75db9b4', 2),
(25, 42, 'xuan@stylist.com', 'Xuan', 'Xuan', 'fab36b39f3899577b1536fafb30aa511', 2),
(26, NULL, 'jack6899@mail.com', 'Jack', 'Tan', 'd54d1702ad0f8326224b817c796763c9', 3);

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `user_id` int(11) NOT NULL,
  `address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_address`
--

INSERT INTO `user_address` (`user_id`, `address_id`) VALUES
(10, 1),
(26, 2),
(17, 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`access_id`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `UserBooking` (`user_id`),
  ADD KEY `BookStylist` (`stylist_id`),
  ADD KEY `BookBranch` (`branch_id`),
  ADD KEY `BookService` (`service_id`);

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `UserProduct` (`user_id`),
  ADD KEY `ProductUser` (`product_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`gallery_id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `ProductType` (`product_type`),
  ADD KEY `ProductBrand` (`product_brand`);

--
-- Indexes for table `product_brand`
--
ALTER TABLE `product_brand`
  ADD PRIMARY KEY (`product_brand_id`);

--
-- Indexes for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD PRIMARY KEY (`product_detail_id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`product_type_id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `ServiceType` (`service_type`);

--
-- Indexes for table `service_type`
--
ALTER TABLE `service_type`
  ADD PRIMARY KEY (`service_type_id`);

--
-- Indexes for table `stylist`
--
ALTER TABLE `stylist`
  ADD PRIMARY KEY (`stylist_id`),
  ADD UNIQUE KEY `stylist_ic` (`stylist_ic`),
  ADD KEY `StylistBranch` (`stylist_branch`);

--
-- Indexes for table `stylist_detail`
--
ALTER TABLE `stylist_detail`
  ADD PRIMARY KEY (`stylist_detail_id`),
  ADD UNIQUE KEY `stylist_id` (`stylist_id`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `ProductTransaction` (`product_id`),
  ADD KEY `TransactionAddress` (`address_id`),
  ADD KEY `UserTransaction` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `AccessLevel` (`access_level`),
  ADD KEY `UserStylist` (`stylist_id`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD KEY `user_id` (`user_id`) USING BTREE,
  ADD KEY `address_id` (`address_id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `branch_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `gallery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_brand`
--
ALTER TABLE `product_brand`
  MODIFY `product_brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_detail`
--
ALTER TABLE `product_detail`
  MODIFY `product_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `product_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `service_type`
--
ALTER TABLE `service_type`
  MODIFY `service_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `stylist`
--
ALTER TABLE `stylist`
  MODIFY `stylist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `stylist_detail`
--
ALTER TABLE `stylist_detail`
  MODIFY `stylist_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `BookBranch` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `BookService` FOREIGN KEY (`service_id`) REFERENCES `service` (`service_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `BookStylist` FOREIGN KEY (`stylist_id`) REFERENCES `stylist` (`stylist_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserBooking` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `ProductUser` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserProduct` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `ProductBrand` FOREIGN KEY (`product_brand`) REFERENCES `product_brand` (`product_brand_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `ProductType` FOREIGN KEY (`product_type`) REFERENCES `product_type` (`product_type_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `product_detail`
--
ALTER TABLE `product_detail`
  ADD CONSTRAINT `ProductDetail` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `service`
--
ALTER TABLE `service`
  ADD CONSTRAINT `ServiceType` FOREIGN KEY (`service_type`) REFERENCES `service_type` (`service_type_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `stylist`
--
ALTER TABLE `stylist`
  ADD CONSTRAINT `StylistBranch` FOREIGN KEY (`stylist_branch`) REFERENCES `branch` (`branch_id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `stylist_detail`
--
ALTER TABLE `stylist_detail`
  ADD CONSTRAINT `StylistDetail` FOREIGN KEY (`stylist_id`) REFERENCES `stylist` (`stylist_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `ProductTransaction` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `TransactionAddress` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `UserTransaction` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `AccessLevel` FOREIGN KEY (`access_level`) REFERENCES `access` (`access_id`),
  ADD CONSTRAINT `UserStylist` FOREIGN KEY (`stylist_id`) REFERENCES `stylist` (`stylist_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_address`
--
ALTER TABLE `user_address`
  ADD CONSTRAINT `AddressUser` FOREIGN KEY (`address_id`) REFERENCES `address` (`address_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `UserAddress` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
