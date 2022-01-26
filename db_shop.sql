-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 17, 2019 at 09:22 AM
-- Server version: 5.6.12-log
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_shop`
--
CREATE DATABASE IF NOT EXISTS `db_shop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_shop`;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `adminId` int(11) NOT NULL AUTO_INCREMENT,
  `adminName` varchar(255) NOT NULL,
  `adminUser` varchar(255) NOT NULL,
  `adminEmail` varchar(255) NOT NULL,
  `adminPass` varchar(32) NOT NULL,
  `level` tinyint(4) NOT NULL,
  PRIMARY KEY (`adminId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`adminId`, `adminName`, `adminUser`, `adminEmail`, `adminPass`, `level`) VALUES
(1, 'Sayed Sahin', 'sayed', 'sayed@gmail.com', '4f90718bc1a7ee98cdedfdabd68ab333', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE IF NOT EXISTS `tbl_brand` (
  `brandId` int(11) NOT NULL AUTO_INCREMENT,
  `brandName` varchar(255) NOT NULL,
  PRIMARY KEY (`brandId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brandId`, `brandName`) VALUES
(1, 'CANON'),
(2, 'ACER'),
(3, 'SAMSUNG'),
(4, 'IPHONE');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `cartId` int(11) NOT NULL AUTO_INCREMENT,
  `sesId` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`cartId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cartId`, `sesId`, `productId`, `productName`, `price`, `quantity`, `image`) VALUES
(6, '8fq0l5jde9fbpuki0ursb6odl2', 4, 'LOREM IPSUM IS SIMPLY DUMMY TEXT', 400.66, 1, 'uploads/40ced2e439.jpg'),
(9, '9chk2egm1vdf7tc7osne9uol94', 5, 'LOREM IPSUM IS SIMPLY DUMMY TEXT', 700.54, 1, 'uploads/6c855d0f6e.jpg'),
(10, 'lb1l5dba2hublc0qpl112s73f6', 2, 'LOREM IPSUM IS SIMPLY DUMMY TEXT', 800.54, 1, 'uploads/6230d014f8.png'),
(11, 'lb1l5dba2hublc0qpl112s73f6', 4, 'LOREM IPSUM IS SIMPLY DUMMY TEXT', 400.66, 1, 'uploads/40ced2e439.jpg'),
(15, 'gb2q0ttqjnshtejfa9gilrjp54', 4, 'LOREM IPSUM IS SIMPLY DUMMY TEXT', 400.66, 2, 'uploads/40ced2e439.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `catId` int(11) NOT NULL AUTO_INCREMENT,
  `catName` varchar(255) NOT NULL,
  PRIMARY KEY (`catId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`catId`, `catName`) VALUES
(1, 'Mobile Phones'),
(2, 'Desktop'),
(3, 'Laptop'),
(4, 'Accessories'),
(5, 'Software'),
(6, 'Sports &amp; Fitness'),
(7, 'Footwear'),
(8, 'Jewellery'),
(9, 'Clothing'),
(10, 'Home Decor &amp; Kitchen'),
(11, 'Beauty &amp; Healthcare'),
(12, 'Toys, Kids &amp; Babies');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zip` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`id`, `name`, `address`, `city`, `country`, `zip`, `phone`, `email`, `pass`) VALUES
(2, 'Sayed Ahmed', 'Muhammad Ulla Building, Dr. Para, Feni Sadar', 'Feni', 'bangladesh', '3900', '01727758658', 'sayedahmed@gmail.com', '4f90718bc1a7ee98cdedfdabd68ab333'),
(3, 'Mehedi Hasan', 'Muhammad Ulla Building, Dr. Para, Feni Sadar', 'feni', 'bangladesh', '3', '01727758658', 'mehedi@gmail.com', '1e2c292dc43e97a130b6940492ba1c98'),
(5, 'Jakir Hossain', 'Fatehpur, Shorshodi', 'Feni Sadar', 'bangladesh', '3900', '0182xxxxxxxxx', 'jakri@gmail.com', 'd73595a6ad072f26c0ade0fa5ee01be1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `orderId` int(11) NOT NULL AUTO_INCREMENT,
  `cId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`orderId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`orderId`, `cId`, `productId`, `productName`, `quantity`, `price`, `image`, `time`, `status`) VALUES
(31, 2, 7, 'LOREM IPSUM IS SIMPLY DUMMY TEXT', 5, 88.37, 'uploads/fe84308893.jpg', '2019-08-01 19:14:33', 1),
(33, 2, 3, 'LOREM IPSUM IS SIMPLY DUMMY TEXT', 1, 403.66, 'uploads/41dc31e4d3.png', '2019-08-01 19:14:33', 2),
(34, 2, 7, 'LOREM IPSUM IS SIMPLY DUMMY TEXT', 1, 88.37, 'uploads/fe84308893.jpg', '2019-08-01 19:16:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `productId` int(11) NOT NULL AUTO_INCREMENT,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `brandId` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `brandId`, `body`, `price`, `image`, `type`) VALUES
(2, 'Apple iPhone 6S Plus 32 GB', 1, 4, '<p>Apple iPhone 6S Plus Smartphone 32 GB</p>\r\n<ul>\r\n<li><span>OS: iOS 11</span></li>\r\n<li><span>Mobile Chip: A9 chip with 64-bit&nbsp;architecture Embedded M9 motion&nbsp;coprocessor</span></li>\r\n<li><span>Display: 5.5-inch (diagonal) widescreen LCD Multi-Touch display with IPS technology; Retina HD&nbsp;display with 3D&nbsp;Touch</span></li>\r\n<li><span>Resolution: 1920-by-1080-pixel resolution at&nbsp;401&nbsp;</span>ppi<span>; 1300:1 contrast ratio&nbsp;(typical)</span></li>\r\n<li><span>Rear Camera: 12-megapixel camera with Optical Image Stabilization; Panorama (up to 63 megapixels); &fnof;/2.2&nbsp;aperture; Five-element lens; 5x digital zoom; True Tone Flash</span></li>\r\n<li><span>Front Camera: 5-megapixel photos; Retina&nbsp;Flash; &fnof;/2.2&nbsp;aperture; Face detection</span></li>\r\n<li><span>Video: 4K video recording at 30 fps; 1080p HD video recording at 30 fps or 60 fps; Optical Image Stabilization; True Tone Flash; Slo-mo; Time-lapse</span></li>\r\n<li><span>Touch ID: Fingerprint sensor built into the Home&nbsp;button</span></li>\r\n<li><span>Battery: Built-in rechargeable lithium-ion battery</span></li>\r\n<li><span>Sensors: Touch ID fingerprint sensor; Barometer; Three-axis gyro; Accelerometer;&nbsp;</span>Proximity<span>&nbsp;sensor;&nbsp;</span>Ambient<span>&nbsp;light sensor</span></li>\r\n</ul>\r\n<p><span>Meticulously crafted with a blend of innovative design and technology, the new iPhone 6S Plus is all that you need to flaunt your taste in smart accessories. It is bigger, better, and has a host of useful features that will change the way that you have ever used a smartphone.</span></p>', 110.99, 'uploads/2bc5da90aa.jpg', 1),
(3, 'Samsung Refrigerator RT29HARZASP/D2 275 L', 4, 3, '<p><span>Samsung Double-door Refrigerator RT29HARZASP/D2 275 L</span></p>\r\n<p><span>Capacity(Gross) 275 L<br />Cooling Feature<br />&bull; Multi flow Yes<br />&bull; Refrigerant R-600a<br />&bull; Display &amp; Control Mechanical<br />&bull; Handle Recess<br />Energy Saving 3 Stars<br />&bull; Refrigerator Feature<br />Deodorizer ~ Yes<br />Number of Shelf (Total) ~ 2EA<br />Number of Shelf (Silde Out) ~ 1EA<br />Humidity Control (Drawer Only) ~ Yes (Moist Fresh Zone)<br />Shelf Material ~ Toughened Glass<br />Number of Vegetable&amp;Fruit Drawer ~ 1 (Veg Box)<br />Door Pocket Type ~ Transparent<br />Number of Door Pocket ~ 4EA<br />Egg Container(Egg Tray) ~ Yes<br />Fresh room ~ Yes<br />Interior LED Light ~ Yes<br />Humidity Control (Vegetable&amp;Fruit Drawer) ~ Yes (Moist Fresh Zone- Veg box only)</span></p>\r\n<p><span>Freezer Feature<br />Icemaker ~ Twist Ice-Maker<br />Shelf Material ~ Cool Pack<br />Number of Shelf (Total) ~ 1EA</span></p>', 403.66, 'uploads/18baede9dd.png', 1),
(4, 'Samsung S19F350HNW 18.5 Inch Business LED Monitor', 2, 3, '<p><strong>Ultra-slim Design</strong></p>\r\n<p>Featuring an ultra-slim and sleek profile the Samsung SF350 monitor measures less than 0.4inch thick. Make a stylish statement while staying productive with the 22" screen. The simple circular stand will add a modern look to your space.&nbsp;An ultra-slim design and sleek profile that measures less than 0.4-inch thick and an elegant circular stand. Product Dimensions With Stand-17.4 x 14 x 6.9 inches. Product Dimensions Without Stand- 17.4 x 10.4 x 2.7 inches.<br /><br /></p>\r\n<p><strong>Eye Saver Mode</strong></p>\r\n<p>Eye Saver Mode optimizes your viewing comfort by reducing blue light emissions and flickers at the touch of a button. Read documents, play games, watch movies and edit photos for long periods of time, and experience a comfortable and pleasing view, without worrying about eye strain or fatigue.<br /><br /></p>\r\n<p><strong>Wide Viewing Angle</strong></p>\r\n<p>Wide Viewing Panel provides 178&deg;wide viewing angle horizontally and vertically, so that you can experience the optimal screen from any position.<br /><br /></p>\r\n<p><strong>Eye Saver Mode</strong></p>\r\n<p>Eye Saver Mode optimizes your viewing comfort by reducing blue light emissions and flickers at the touch of a button. Read documents, play games, watch movies and edit photos for long periods of time, and experience a comfortable and pleasing view, without worrying about eye strain or fatigue.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Eco-friendly Monitor</strong></p>\r\n<p>The Eco-Saving Plus feature reduces screen brightness to save power, plus the screen brightness automatically transitions fluidly&mdash;reducing energy use even more. The monitor itself is also constructed without PVC*</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Model - Samsung S19F350HNW, Display Size (Inch) - 18.5", Shape - Widescreen, Display Type - LED Display, Display Resolution - 1366 x 768, Brightness (cd/m2) - 250cd/m2, Contrast Ratio (TCR/DCR) - 1000:1, Response Time (ms) - 14ms, Refresh Rate (Hz) - 60Hz, VGA Port - 1, Viewing Angle - 178 degree (H &amp; V), Others - Viewing Angle:178 degree - 178 degree, Wall Mount: Yes (75 x 75), Part No - S19F350HNW, Warranty - 3 year(Samsung S19F350HNW)</p>', 400.66, 'uploads/c5751abdc3.png', 1),
(5, 'Acer Aspire 3 A315-21 AMD Dual Core A4-9120E', 3, 2, '<p><strong>Additional Information</strong></p>\r\n<table id="product-attribute-specs-table" class="data-table"><colgroup><col width="25%" /><col /></colgroup>\r\n<tbody>\r\n<tr class="first odd"><th class="label">Brand</th>\r\n<td class="data last">Acer</td>\r\n</tr>\r\n<tr class="even"><th class="label">Model</th>\r\n<td class="data last">Acer Aspire 3 A315-21</td>\r\n</tr>\r\n<tr class="odd"><th class="label">Processor</th>\r\n<td class="data last">AMD Dual Core A4-9120E</td>\r\n</tr>\r\n<tr class="even"><th class="label">Clock Speed</th>\r\n<td class="data last">1.5GHz</td>\r\n</tr>\r\n<tr class="odd"><th class="label">Display Type</th>\r\n<td class="data last">HD LED</td>\r\n</tr>\r\n<tr class="even"><th class="label">Display Size</th>\r\n<td class="data last">15.6"</td>\r\n</tr>\r\n<tr class="odd"><th class="label">Display Resolution</th>\r\n<td class="data last">1360x768 (WxH) HD</td>\r\n</tr>\r\n<tr class="even"><th class="label">Touch</th>\r\n<td class="data last">No</td>\r\n</tr>\r\n<tr class="odd"><th class="label">RAM type</th>\r\n<td class="data last">DDR4</td>\r\n</tr>\r\n<tr class="even"><th class="label">RAM</th>\r\n<td class="data last">4GB</td>\r\n</tr>\r\n<tr class="odd"><th class="label">Storage</th>\r\n<td class="data last">1TB HDD</td>\r\n</tr>\r\n<tr class="even"><th class="label">Graphics chipset</th>\r\n<td class="data last">Integrated Graphics</td>\r\n</tr>\r\n<tr class="odd"><th class="label">Graphics memory</th>\r\n<td class="data last">Shared</td>\r\n</tr>\r\n<tr class="even"><th class="label">Networking</th>\r\n<td class="data last">LAN, WiFi, Bluetooth, Card Reader, WebCam</td>\r\n</tr>\r\n<tr class="odd"><th class="label">Display port</th>\r\n<td class="data last">HDMI</td>\r\n</tr>\r\n<tr class="even"><th class="label">Audio port</th>\r\n<td class="data last">Combo</td>\r\n</tr>\r\n<tr class="odd"><th class="label">USB Port</th>\r\n<td class="data last">1 x USB3.0, 2 x USB2.0</td>\r\n</tr>\r\n<tr class="even"><th class="label">Battery</th>\r\n<td class="data last">2 Cell Li-Ion</td>\r\n</tr>\r\n<tr class="odd"><th class="label">Backup time</th>\r\n<td class="data last">Up to 5.5 Hrs.</td>\r\n</tr>\r\n<tr class="even"><th class="label">Weight</th>\r\n<td class="data last">2.1Kg</td>\r\n</tr>\r\n<tr class="odd"><th class="label">Color</th>\r\n<td class="data last">Black</td>\r\n</tr>\r\n<tr class="even"><th class="label">Operating System</th>\r\n<td class="data last">Free-Dos</td>\r\n</tr>\r\n<tr class="odd"><th class="label">Part No</th>\r\n<td class="data last">NX.GNVSI.037</td>\r\n</tr>\r\n<tr class="even"><th class="label">Country of Origin</th>\r\n<td class="data last">Taiwan</td>\r\n</tr>\r\n<tr class="odd"><th class="label">Made in/ Assemble</th>\r\n<td class="data last">China</td>\r\n</tr>\r\n<tr class="last even"><th class="label">Warranty</th>\r\n<td class="data last">2 year (Battery, Adapter 1 year)</td>\r\n</tr>\r\n</tbody>\r\n</table>', 700.54, 'uploads/5a69935756.png', 1),
(6, 'Canon EOS 1300D 18MP Digital SLR Camera (Black)', 4, 1, '<ul class="a-unordered-list a-vertical a-spacing-none">\r\n<li><span class="a-list-item">Sensor: APS-C CMOS Sensor with 18 MP (sufficient resolution for large prints and image cropping)</span></li>\r\n<li><span class="a-list-item">ISO: 100-6400 sensitivity range (critical for obtaining grain-free pictures, especially in low light)</span></li>\r\n<li><span class="a-list-item">Image Processor: DIGIC 4+ with 9 autofocus points (important for speed and accuracy of autofocus and burst photography)</span></li>\r\n<li><span class="a-list-item">Video Resolution: Full HD video with fully manual control and selectable frame rates (great for precision and high-quality video work)</span></li>\r\n<li><span class="a-list-item">Connectivity: WiFi, NFC and Bluetooth built-in (useful for remotely controlling your camera and transferring pictures wirelessly as you shoot)</span></li>\r\n<li><span class="a-list-item">Lens Mount: EF-S mount compatible with all EF and EF-S lenses (crop-sensor mount versatile and compact, especially when used with EF-S lenses)</span></li>\r\n</ul>', 660.54, 'uploads/5b93d46a64.jpg', 2),
(7, 'Samsung Galaxy A20', 1, 3, '<ul>\r\n<li><span>OS: Android 9.0 (Pie); One UI</span></li>\r\n<li><span>Chipset: Exynos 7884 Octa-core</span></li>\r\n<li><span>Display: 6.4 inches Super AMOLED capacitive touchscreen (720 x 1560 pixels)</span></li>\r\n<li><span>RAM: 3GB</span></li>\r\n<li><span>ROM: 32GB</span></li>\r\n<li><span>Rear Camera: 13.0 MP + 5.0 MP</span></li>\r\n<li><span>Front Camera: 8.0 MP</span></li>\r\n<li><span>Battery: Non-removable Li-Po 4000 mAh battery</span></li>\r\n<li><span>Sensors: Fingerprint (rear-mounted), accelerometer, proximity, compass</span></li>\r\n</ul>', 88.37, 'uploads/55323b16c0.jpg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wlist`
--

CREATE TABLE IF NOT EXISTS `tbl_wlist` (
  `wId` int(11) NOT NULL AUTO_INCREMENT,
  `customerId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  PRIMARY KEY (`wId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `tbl_wlist`
--

INSERT INTO `tbl_wlist` (`wId`, `customerId`, `productId`) VALUES
(1, 2, 5),
(2, 2, 2),
(3, 2, 6),
(6, 3, 5),
(7, 2, 3);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
