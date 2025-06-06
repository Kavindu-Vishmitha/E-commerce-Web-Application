-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.32 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.4.0.6659
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for xflax
CREATE DATABASE IF NOT EXISTS `xflax` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `xflax`;

-- Dumping structure for table xflax.brand
CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.brand: ~21 rows (approximately)
INSERT INTO `brand` (`brand_id`, `brand_name`) VALUES
	(21, 'Vivo'),
	(23, 'Honor'),
	(24, 'Huawei'),
	(25, 'Samsung '),
	(26, 'Apple'),
	(27, 'Dell'),
	(28, 'ASUS '),
	(29, 'MSI'),
	(30, 'ACER'),
	(31, 'Canon'),
	(32, 'Sony'),
	(33, 'Nikon '),
	(35, 'Techtonic'),
	(37, 'CUKTECH'),
	(38, 'Xiaomi'),
	(39, 'DZ-TECH'),
	(40, 'Ehang'),
	(41, 'DJI'),
	(42, 'CHUBORY'),
	(43, 'YH'),
	(44, 'Autel Robotics');

-- Dumping structure for table xflax.brand_has_category
CREATE TABLE IF NOT EXISTS `brand_has_category` (
  `brand_brand_id` int NOT NULL,
  `category_cat_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_brand_has_category_category1_idx` (`category_cat_id`),
  KEY `fk_brand_has_category_brand1_idx` (`brand_brand_id`),
  CONSTRAINT `fk_brand_has_category_brand1` FOREIGN KEY (`brand_brand_id`) REFERENCES `brand` (`brand_id`),
  CONSTRAINT `fk_brand_has_category_category1` FOREIGN KEY (`category_cat_id`) REFERENCES `category` (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.brand_has_category: ~0 rows (approximately)

-- Dumping structure for table xflax.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `qty` int DEFAULT NULL,
  `Product_id` int NOT NULL,
  `users_email` varchar(100) NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `fk_cart_Product1_idx` (`Product_id`),
  KEY `fk_cart_users1_idx` (`users_email`),
  CONSTRAINT `fk_cart_Product1` FOREIGN KEY (`Product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_users1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=305 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.cart: ~2 rows (approximately)
INSERT INTO `cart` (`cart_id`, `qty`, `Product_id`, `users_email`) VALUES
	(226, 1, 153, 'avishka@gmail.com'),
	(227, 2, 153, 'sanjana@gmail.com');

-- Dumping structure for table xflax.category
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.category: ~5 rows (approximately)
INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
	(1, 'Mobile Phones  '),
	(2, 'Laptops'),
	(3, 'Cameras'),
	(4, 'Mobile Phone Accessories'),
	(5, 'Drones');

-- Dumping structure for table xflax.city
CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int NOT NULL AUTO_INCREMENT,
  `city_name` varchar(45) DEFAULT NULL,
  `district_district_id` int DEFAULT NULL,
  PRIMARY KEY (`city_id`),
  KEY `fk_city_district1_idx` (`district_district_id`),
  CONSTRAINT `fk_city_district1` FOREIGN KEY (`district_district_id`) REFERENCES `district` (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.city: ~75 rows (approximately)
INSERT INTO `city` (`city_id`, `city_name`, `district_district_id`) VALUES
	(1, 'Colombo', 1),
	(2, 'Dehiwala', 1),
	(3, 'Maharagama', 1),
	(4, 'Gampaha', 2),
	(5, 'Negombo', 2),
	(6, 'Ja-Ela', 2),
	(7, 'Kalutara', 3),
	(8, 'Horana', 3),
	(9, 'Panadura', 3),
	(10, 'Kandy', 4),
	(11, 'Peradeniya', 4),
	(12, 'Gampola', 4),
	(13, 'Matale', 6),
	(14, 'Dambulla', 6),
	(15, 'Rattota', 6),
	(16, 'Nuwara Eliya', 5),
	(17, 'Hatton', 5),
	(18, 'Talawakele', 5),
	(19, 'Galle', 7),
	(20, 'Unawatuna', 7),
	(21, 'Ambalangoda', 7),
	(22, 'Matara', 8),
	(23, 'Kakunagolla', 8),
	(24, 'Dikwella', 8),
	(25, 'Hambantota', 9),
	(26, 'Tangalle', 9),
	(27, 'Beliatta', 9),
	(28, 'Jaffna', 10),
	(29, 'Nallur', 10),
	(30, 'Chavakachcheri', 10),
	(31, 'Kilinochchi', 11),
	(32, 'Pachchilaipalli', 11),
	(33, 'Karachchi', 11),
	(34, 'Mannar', 23),
	(35, 'Madhu', 23),
	(36, 'Thalaimannar', 23),
	(37, 'Vavuniya', 12),
	(38, 'Vellankulam', 12),
	(39, 'Cheddikulam', 12),
	(40, 'Mullaitivu', 24),
	(41, 'Puthukkudiyiruppu', 24),
	(42, 'Oddusuddan', 24),
	(43, 'Batticaloa', 25),
	(44, 'Kalkudah/Kaluwanchikudy', 25),
	(45, 'Valaichenai', 25),
	(46, 'Ampara', 14),
	(47, 'Kalmunai', 14),
	(48, 'Sainthamaruthu', 14),
	(49, 'Trincomalee', 13),
	(50, 'Kinniya', 13),
	(51, 'Nilaveli', 13),
	(52, 'Anuradhapura', 18),
	(53, 'Thalawa', 18),
	(54, 'Eppawala', 18),
	(55, 'Polonnaruwa', 19),
	(56, 'Minneriya', 19),
	(57, 'Hingurakgoda', 19),
	(58, 'Kurunegala', 16),
	(59, 'Narammala', 16),
	(60, 'Kuliyapitiya', 16),
	(61, 'Puttalam', 17),
	(62, 'Chilaw', 17),
	(63, 'Anamaduwa', 17),
	(64, 'Badulla', 20),
	(65, 'Bandarawela', 20),
	(66, 'Passara', 20),
	(67, 'Monaragala', 21),
	(68, 'Bibila', 21),
	(69, 'Wellawaya', 21),
	(70, 'Ratnapura', 15),
	(71, 'Eheliyagoda', 15),
	(72, 'Balangoda', 15),
	(73, 'Kegalle', 22),
	(74, 'Mawanella', 22),
	(75, 'Yatiyanthota', 22);

-- Dumping structure for table xflax.color
CREATE TABLE IF NOT EXISTS `color` (
  `clr_id` int NOT NULL AUTO_INCREMENT,
  `clr_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`clr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.color: ~13 rows (approximately)
INSERT INTO `color` (`clr_id`, `clr_name`) VALUES
	(1, 'Black'),
	(2, 'Blue'),
	(3, 'Red'),
	(4, 'Silver'),
	(5, 'White'),
	(6, 'Gold'),
	(9, 'Green'),
	(10, 'Mint Green'),
	(11, 'Natural Titanium'),
	(12, 'Quiet Blue'),
	(13, 'Steel Grey'),
	(14, 'Yellow'),
	(15, 'Gray');

-- Dumping structure for table xflax.condition
CREATE TABLE IF NOT EXISTS `condition` (
  `condition_id` int NOT NULL AUTO_INCREMENT,
  `condition_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`condition_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.condition: ~2 rows (approximately)
INSERT INTO `condition` (`condition_id`, `condition_name`) VALUES
	(1, 'Brand New'),
	(2, 'Used');

-- Dumping structure for table xflax.district
CREATE TABLE IF NOT EXISTS `district` (
  `district_id` int NOT NULL AUTO_INCREMENT,
  `district_name` varchar(45) DEFAULT NULL,
  `province_province_id` int DEFAULT NULL,
  PRIMARY KEY (`district_id`),
  KEY `fk_district_province1_idx` (`province_province_id`),
  CONSTRAINT `fk_district_province1` FOREIGN KEY (`province_province_id`) REFERENCES `province` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.district: ~25 rows (approximately)
INSERT INTO `district` (`district_id`, `district_name`, `province_province_id`) VALUES
	(1, 'Colombo', 1),
	(2, 'Gampaha', 1),
	(3, 'Kaluthara', 1),
	(4, 'Kandy', 2),
	(5, 'Nuwara Eliya', 2),
	(6, 'Matale', 2),
	(7, 'Galle', 3),
	(8, 'Matara', 3),
	(9, 'Hambantota', 3),
	(10, 'Jaffna', 4),
	(11, 'Kilinochchi', 4),
	(12, 'Vavuniya', 4),
	(13, 'Trincomalee', 5),
	(14, 'Ampara', 5),
	(15, 'Ratnapura', 9),
	(16, 'Kurunegala', 6),
	(17, 'Puttalam', 6),
	(18, 'Anuradhapura', 7),
	(19, 'Polonnaruwa', 7),
	(20, 'Badulla', 8),
	(21, 'Monaragala', 8),
	(22, 'Kegalle', 9),
	(23, 'Mannar', 4),
	(24, 'Mullaitive', 4),
	(25, 'Batticaloa', 5);

-- Dumping structure for table xflax.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `id` int NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.gender: ~2 rows (approximately)
INSERT INTO `gender` (`id`, `gender_name`) VALUES
	(1, 'Male'),
	(2, 'Female');

-- Dumping structure for table xflax.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `users_email` varchar(100) NOT NULL,
  `Product_id` int NOT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `fk_invoice_users1_idx` (`users_email`),
  KEY `fk_invoice_Product1_idx` (`Product_id`),
  CONSTRAINT `fk_invoice_Product1` FOREIGN KEY (`Product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_invoice_users1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.invoice: ~3 rows (approximately)
INSERT INTO `invoice` (`invoice_id`, `order_id`, `date`, `total`, `qty`, `status`, `users_email`, `Product_id`) VALUES
	(1, '683f92290245f', '2025-06-04 05:54:44', 6700, 1, 0, 'kavinduvishmith@gmail.com', 150),
	(2, '683f92290245f', '2025-06-04 05:54:44', 6700, 2, 0, 'kavinduvishmith@gmail.com', 153),
	(4, '683f95b964e95', '2025-06-04 06:10:09', 2300, 3, 0, 'kaveesha1@gmail.com', 153),
	(5, '68424e33327ea', '2025-06-06 07:41:37', 38350, 19, 0, 'kavinduvishmith@gmail.com', 150),
	(6, '68425221e69de', '2025-06-06 07:58:18', 2650, 1, 0, 'kavinduvishmith@gmail.com', 149),
	(7, '684290b44308f', '2025-06-06 12:25:27', 1700, 2, 0, 'kavinduvishmith@gmail.com', 153),
	(8, '68429116a55b4', '2025-06-06 12:26:42', 14700, 2, 0, 'kavinduvishmith@gmail.com', 150),
	(9, '68429116a55b4', '2025-06-06 12:26:42', 14700, 2, 0, 'kavinduvishmith@gmail.com', 152);

-- Dumping structure for table xflax.model
CREATE TABLE IF NOT EXISTS `model` (
  `model_id` int NOT NULL AUTO_INCREMENT,
  `model_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.model: ~26 rows (approximately)
INSERT INTO `model` (`model_id`, `model_name`) VALUES
	(29, 'Vivo V30 '),
	(32, 'HONOR X9B '),
	(33, 'Nova 11i '),
	(34, 'Galaxy A54 5G '),
	(35, 'iPhone 15 Pro '),
	(36, 'Inspiron 3530'),
	(37, 'Vivobook 15 X1504'),
	(38, 'MateBook D 14 '),
	(39, 'MSI THIN 15 B13VE '),
	(40, 'Aspire 5 '),
	(41, 'EOS 2000D DSLR'),
	(42, 'ZV-E10 Mirrorless'),
	(43, 'a6600 Mirrorless'),
	(44, 'D7500 DSLR'),
	(45, 'Alpha a7'),
	(47, '360° Universal'),
	(48, '2 Port PD Plug 40W'),
	(49, '25000mAh Power Bank'),
	(50, 'TWS Bluetooth 5.3'),
	(51, 'For Motorola Moto G'),
	(52, 'K99 Max '),
	(53, 'Air 2S'),
	(54, ' Quadcopter Drone'),
	(55, 'YH-19'),
	(56, 'EVO II 8K');

-- Dumping structure for table xflax.model_has_brand
CREATE TABLE IF NOT EXISTS `model_has_brand` (
  `model_model_id` int NOT NULL,
  `brand_brand_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_model_has_brand_brand1_idx` (`brand_brand_id`),
  KEY `fk_model_has_brand_model1_idx` (`model_model_id`),
  CONSTRAINT `fk_model_has_brand_brand1` FOREIGN KEY (`brand_brand_id`) REFERENCES `brand` (`brand_id`),
  CONSTRAINT `fk_model_has_brand_model1` FOREIGN KEY (`model_model_id`) REFERENCES `model` (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=139 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.model_has_brand: ~26 rows (approximately)
INSERT INTO `model_has_brand` (`model_model_id`, `brand_brand_id`, `id`) VALUES
	(29, 21, 99),
	(32, 23, 101),
	(33, 24, 102),
	(34, 25, 103),
	(35, 26, 104),
	(36, 27, 105),
	(37, 28, 106),
	(38, 24, 107),
	(39, 29, 108),
	(40, 30, 109),
	(41, 31, 110),
	(42, 32, 111),
	(43, 32, 112),
	(44, 33, 113),
	(45, 32, 114),
	(47, 35, 115),
	(48, 26, 116),
	(49, 37, 117),
	(50, 38, 118),
	(51, 39, 119),
	(52, 40, 120),
	(53, 41, 121),
	(54, 42, 122),
	(55, 43, 123),
	(56, 44, 124),
	(38, 26, 125),
	(44, 35, 129),
	(44, 27, 133),
	(44, 37, 134),
	(44, 38, 136),
	(45, 37, 137),
	(41, 35, 138);

-- Dumping structure for table xflax.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `description` text,
  `title` varchar(100) DEFAULT NULL,
  `datetime_added` datetime DEFAULT NULL,
  `delivery_fee_colombo` double DEFAULT NULL,
  `delivery_fee_other` double DEFAULT NULL,
  `category_id` int NOT NULL,
  `model_has_brand_id` int NOT NULL,
  `color_clr_id` int NOT NULL,
  `status_status_id` int NOT NULL,
  `condition_condition_id` int NOT NULL,
  `users_email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Product_category1_idx` (`category_id`),
  KEY `fk_Product_model_has_brand1_idx` (`model_has_brand_id`),
  KEY `fk_Product_color1_idx` (`color_clr_id`),
  KEY `fk_Product_status1_idx` (`status_status_id`),
  KEY `fk_Product_condition1_idx` (`condition_condition_id`),
  KEY `fk_Product_users1_idx` (`users_email`),
  CONSTRAINT `fk_Product_category1` FOREIGN KEY (`category_id`) REFERENCES `category` (`cat_id`),
  CONSTRAINT `fk_Product_color1` FOREIGN KEY (`color_clr_id`) REFERENCES `color` (`clr_id`),
  CONSTRAINT `fk_Product_condition1` FOREIGN KEY (`condition_condition_id`) REFERENCES `condition` (`condition_id`),
  CONSTRAINT `fk_Product_model_has_brand1` FOREIGN KEY (`model_has_brand_id`) REFERENCES `model_has_brand` (`id`),
  CONSTRAINT `fk_Product_status1` FOREIGN KEY (`status_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `fk_Product_users1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=187 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.product: ~25 rows (approximately)
INSERT INTO `product` (`id`, `price`, `qty`, `description`, `title`, `datetime_added`, `delivery_fee_colombo`, `delivery_fee_other`, `category_id`, `model_has_brand_id`, `color_clr_id`, `status_status_id`, `condition_condition_id`, `users_email`) VALUES
	(134, 189000, 20, 'Featuring a substantial storage space of 256GB, this smartphone is designed to meet your storage needs, allowing you to store a vast library of apps, photos, videos, and files with ease. Equipped with a 5000mAh battery, this 6.78-inch smartphone provides extended usage without the hassle of frequent charging concerns.', 'VIVO V30', '2024-06-08 15:39:16', 150, 350, 1, 99, 9, 1, 1, 'kavinduvishmith@gmail.com'),
	(135, 130000, 20, 'The device features 108 MP (wide) + 5 MP (ultrawide) + 2 MP (macro) camera on the rear side. On the front, there is a single camera: 16 MP (wide). The smartphone is fueled with Li-Po 5800 mAh + 35W wired + Reverse wired. The device comes in three colors: Sunrise Orange, Midnight Black, and Emerald Green.', 'HONOR X9B', '2024-06-08 15:58:18', 150, 350, 1, 101, 1, 1, 1, 'kavinduvishmith@gmail.com'),
	(136, 85000, 50, 'HUAWEI nova 11i boasts a 6.8-inch HUAWEI FullView Display and 1 mm ultra-narrow bezels that push the screen-to-body ratio to an astonishing 94.9%. The vivid clarity offered by the screen allows you to watch films and play games in glorious HD resolution.', 'Huawei Nova 11i ', '2024-06-08 16:11:07', 150, 350, 1, 102, 10, 1, 1, 'kavinduvishmith@gmail.com'),
	(137, 200000, 35, 'Experience lightning-fast 5G, a vibrant 6.5-inch FHD+ display, and a powerful Octa-Core processor. Capture amazing photos with the 64MP quad-camera, and enjoy all-day battery life with 25W fast charging. With 128GB storage (expandable to 1TB) and enhanced security, the Galaxy A54 5G is built for the future.', 'Samsung Galaxy A54 5G', '2024-06-08 16:20:19', 150, 350, 1, 103, 1, 1, 1, 'kavinduvishmith@gmail.com'),
	(138, 474000, 20, 'Experience unparalleled performance with the A17 Bionic chip and stunning visuals on the 6.1-inch Super Retina XDR display. Capture pro-quality photos and videos with the advanced triple-camera system. Enjoy all-day battery life, 5G connectivity, and enhanced security with Face ID. With up to 1TB of storage, the iPhone 15 Pro is the ultimate device for power and creativity.', 'Apple iPhone 15 Pro ', '2024-06-08 16:28:20', 150, 350, 1, 104, 11, 1, 1, 'kavinduvishmith@gmail.com'),
	(139, 240000, 15, 'Experience powerful performance with the 13th Gen Intel i5 processor. Featuring a 15.6-inch FHD display, 8GB RAM, and 512GB SSD, this laptop ensures smooth multitasking and ample storage. Ideal for work and play, the Dell Inspiron 3530 offers reliability and speed in a sleek design.', 'Dell Inspiron 3530 - 13th Gen i5 8GB RAM', '2024-06-08 16:41:51', 150, 350, 2, 105, 4, 1, 1, 'kavinduvishmith@gmail.com'),
	(140, 279000, 10, 'Enjoy powerful performance with the 13th Gen Intel i5 processor and a 15.6-inch Full HD display. The sleek design, ample storage, and robust battery life make it perfect for work and play. Experience seamless multitasking and enhanced productivity with the ASUS Vivobook 15 X1504.', 'ASUS Vivobook 15 X1504 - 13th Gen i5', '2024-06-08 16:46:26', 150, 350, 2, 106, 12, 1, 1, 'kavinduvishmith@gmail.com'),
	(141, 267000, 23, 'Experience seamless performance with the 13th Gen Intel i5 processor. Enjoy a vibrant 14-inch Full HD display, long-lasting battery, and ultra-slim design. Ideal for productivity and entertainment with 8GB RAM and 512GB SSD. Stay connected with fast Wi-Fi 6 and versatile ports.', 'HUAWEI MateBook D 14 - 13th Gen, i5', '2024-06-08 16:50:24', 150, 350, 2, 107, 4, 1, 1, 'kavinduvishmith@gmail.com'),
	(142, 417000, 22, 'Power through tasks with the Intel i7 13th Gen processor and enjoy stunning visuals on the 15.6-inch FHD display. Equipped with an NVIDIA GeForce RTX 4050, this laptop offers exceptional performance for gaming and productivity. With a sleek design, ample storage, and advanced cooling, the MSI THIN 15 B13VE is perfect for on-the-go professionals and gamers.', 'MSI THIN 15 B13VE - i7 13th Gen', '2024-06-08 16:54:28', 150, 350, 2, 108, 1, 1, 1, 'kavinduvishmith@gmail.com'),
	(143, 163000, 10, 'The ACER Aspire 5 features a 15.6-inch FHD display, Intel Core i3 processor, 8GB RAM, and 256GB SSD. Enjoy smooth performance, ample storage, and a sleek design perfect for everyday tasks.', 'ACER Aspire 5 - 13th Gen i3 8GB RAM', '2024-06-08 16:58:29', 150, 350, 2, 109, 13, 1, 1, 'kavinduvishmith@gmail.com'),
	(144, 127500, 8, 'Compact and capable, the Canon EOS 2000D is a sleek entry-level DSLR featuring versatile imaging capabilities and a helpful feature-set. Incorporating a 24.1MP APS-C CMOS sensor and DIGIC 4+ image processor, the 2000D produces high-resolution stills with notable clarity, reduced noise, and a flexible native sensitivity range from ISO 100-6400.', 'Canon EOS 2000D DSLR Camera ', '2024-06-08 17:07:07', 150, 350, 3, 110, 1, 1, 1, 'kavinduvishmith@gmail.com'),
	(145, 229000, 12, 'The Sony ZV-E10 is a versatile mirrorless camera designed for content creators. It features a 24.2MP sensor, 4K video recording, and a flip-out LCD screen, making it perfect for vlogging and capturing high-quality photos and videos. With easy-to-use controls and advanced autofocus, the ZV-E10 is ideal for beginners and experienced creators alike.', 'Sony ZV-E10 Mirrorless Camera ', '2024-06-08 17:14:06', 150, 350, 3, 111, 1, 1, 1, 'kavinduvishmith@gmail.com'),
	(146, 499000, 11, 'Capture life moments in stunning detail with the Sony Alpha a6600. This camera features a 24.2MP APS-C Exmor CMOS sensor, delivering high-quality images and 4K video. With 5-axis in-body image stabilization, fast autofocus, and a tiltable LCD touchscreen, the a6600 is perfect for enthusiasts and professionals. Plus, enjoy long battery life for extended shooting sessions.', 'Sony Alpha a6600 Mirrorless Digital Camera', '2024-06-08 17:21:34', 150, 350, 3, 112, 1, 1, 1, 'kavinduvishmith@gmail.com'),
	(147, 230000, 8, 'The Nikon D7500 is a powerful DSLR camera that delivers exceptional image quality and performance. Featuring a 20.9MP DX-format sensor and an EXPEED 5 image processor, it captures stunning photos and 4K UHD videos. With a fast 51-point autofocus system and continuous shooting up to 8 fps, you can capture fast-moving subjects with ease. The D7500 also features a tilting touchscreen, built-in Bluetooth and Wi-Fi connectivity, and a weather-sealed body, making it a versatile and reliable camera for enthusiasts and professionals alike.', 'Nikon D7500 DSLR Camera 4K UHD', '2024-06-08 17:27:54', 150, 350, 3, 113, 1, 1, 1, 'kavinduvishmith@gmail.com'),
	(148, 419000, 10, 'The Sony Alpha a7 III is a versatile mirrorless camera that combines high-resolution imaging with impressive low-light performance. It features a 24.2MP full-frame Exmor R CMOS sensor and BIONZ X image processor, delivering stunning images and 4K video. With 5-axis in-body image stabilization, fast autofocus, and a tiltable LCD screen, the a7 III is ideal for both photography and videography. Its durable magnesium alloy body, long battery life, and dual SD card slots make it a reliable choice for professionals and enthusiasts alike.', 'Sony Alpha a7 III Mirrorless Digital Camera ', '2024-06-08 17:32:01', 150, 350, 3, 114, 1, 1, 1, 'kavinduvishmith@gmail.com'),
	(149, 2300, 50, 'Stay connected and hands-free on the road with the 360° Universal Mount Holder Car Stand. This versatile stand keeps your device securely in place, allowing you to easily view maps, answer calls, or control music while driving. The adjustable design fits most smartphones and GPS devices, while the 360° rotation and tilting mechanism provide the perfect viewing angle. The strong suction cup ensures a stable hold on your dashboard or windshield, making it the perfect accessory for safe and convenient driving.', '360° Universal Mount Holder Car Stand', '2024-06-08 17:58:34', 150, 350, 4, 115, 1, 1, 1, 'kavinduvishmith@gmail.com'),
	(150, 2000, 38, 'Charge your iPhone 13 Pro Max quickly and efficiently with this 2 Port PD Plug 40W USB-C Fast Wall Charger. This adapter features two ports, allowing you to charge two devices simultaneously. The USB-C port supports Power Delivery (PD) technology, providing fast charging for your iPhone 13 Pro Max. With a compact and portable design, this charger is perfect for travel or everyday use. Stay powered up and connected with this convenient and reliable wall charger.', '2 Port PD Plug 40W Charger Adapter', '2024-06-08 18:14:31', 150, 350, 4, 116, 5, 1, 1, 'kavinduvishmith@gmail.com'),
	(151, 20000, 40, 'Stay charged on the go with this 25000mAh power bank. With Power Delivery (PD) technology, it quickly charges MacBook, laptops, and phones. Compact and portable, it is perfect for travel. Multiple outputs and built-in safety features make it a reliable choice.\r\n\r\n', '25000mAh Power Bank 100W PD', '2024-06-08 18:24:13', 150, 350, 4, 117, 4, 1, 1, 'kavinduvishmith@gmail.com'),
	(152, 5000, 16, 'Enjoy true wireless freedom with these Bluetooth 5.3 earbuds. They deliver high-quality stereo sound, are waterproof and sweatproof, and offer a comfortable, secure fit. With long battery life, quick charging, and smart touch controls, these earbuds are perfect for music lovers and active individuals alike.', 'Wireless Earbuds TWS Bluetooth 5.3 Earphone', '2024-06-08 18:40:43', 150, 350, 4, 118, 3, 1, 1, 'kavinduvishmith@gmail.com'),
	(153, 600, 39, 'Protect your Motorola Moto G Pure/G Power 2024 with this durable Ring Case Stand. Featuring a clear back to showcase the phone is design, this case offers 360-degree protection against bumps and scratches. The integrated ring stand provides convenient hands-free viewing, while the included tempered glass screen protector ensures added defense against scratches and cracks. Keep your device safe and stylish with this essential accessory combo.', '2024 Ring Case Motorola Moto G Power', '2024-06-08 18:49:10', 150, 500, 4, 119, 2, 1, 1, 'kavinduvishmith@gmail.com'),
	(154, 530000, 10, 'Capture stunning photos and videos with the K99 Max Drone, equipped with dual 4K HD cameras. Perfect for beginners, it features a headless mode for easier flight control. The altitude hold function ensures stable flight, while FPV transmission provides a live video feed. Its foldable design makes it portable and easy to store, making the K99 Max Drone a versatile choice for aerial photography enthusiasts.', 'K99 Max 4K camera drone ', '2024-06-08 19:12:49', 150, 350, 5, 120, 4, 1, 1, 'kavinduvishmith@gmail.com'),
	(155, 530000, 5, 'The DJI Air 2S is a compact, high-performance drone that features a 1-inch CMOS sensor camera capable of recording 5.1K video and 20-megapixel photos. It also has a 10-bit Dlog-M color profile for more advanced video editing. The Air 2S has a max flight time of 31 minutes and can reach speeds of up to 72 kph (45 mph) in Sport mode. It also has features like obstacle avoidance, ActiveTrack 4.0 object tracking, and MasterShots automated shooting modes.', 'DJI Air 2S', '2024-06-08 19:16:37', 150, 350, 5, 121, 4, 1, 1, 'kavinduvishmith@gmail.com'),
	(156, 22000, 12, 'The text on the box says that it is a quadcopter drone with a flight time of 40 minutes. It also has a 1080p HD camera with a 120° wide-angle lens. Other features mentioned include optical flow positioning, follow-me mode, and dual camera switching.', 'Foldable Quadcopter Drone', '2024-06-08 19:23:08', 250, 350, 5, 122, 1, 1, 1, 'kavinduvishmith@gmail.com'),
	(157, 7200, 5, 'The YH-19 is a mini foldable drone with a 0.3MP WiFi FPV camera. It features headless mode and altitude hold for easier flying. It also has a foldable design for portability.', 'YH-19 480P Camera Drone', '2024-06-08 19:27:36', 150, 350, 5, 123, 5, 1, 1, 'kavinduvishmith@gmail.com'),
	(158, 300000, 10, 'The Autel Robotics EVO II 8K is a high-performance foldable drone that features a Sony 48MP sensor capable of recording stunning 8K video and 48-megapixel photos. It also has a 10-bit color profile for more advanced video editing. The EVO II 8K has a max flight time of 40 minutes and can reach speeds of up to 72 kph (45 mph) in Sport mode. It also has features like omnidirectional obstacle avoidance, object tracking, and automatic flight modes.', 'Autel Robotics EVO II 8K', '2024-06-08 19:33:49', 150, 350, 5, 124, 3, 1, 1, 'kavinduvishmith@gmail.com');

-- Dumping structure for table xflax.product_img
CREATE TABLE IF NOT EXISTS `product_img` (
  `img_path` varchar(100) NOT NULL,
  `Product_id` int NOT NULL,
  PRIMARY KEY (`img_path`),
  KEY `fk_product_img_Product1_idx` (`Product_id`),
  CONSTRAINT `fk_product_img_Product1` FOREIGN KEY (`Product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.product_img: ~65 rows (approximately)
INSERT INTO `product_img` (`img_path`, `Product_id`) VALUES
	('resources//Product_Images//VIVO V30 _0_66643b3d91bdb.png', 134),
	('resources//Product_Images//VIVO V30 _1_66643b3d92c2e.png', 134),
	('resources//Product_Images//VIVO V30 _2_66643b3d9392d.png', 134),
	('resources//Product_Images//HONOR X9B_0_6664336f5cfb0.png', 135),
	('resources//Product_Images//HONOR X9B_1_6664336f5e610.png', 135),
	('resources//Product_Images//HONOR X9B_2_6664336f5f83b.png', 135),
	('resources//Product_Images//Huawei Nova 11i _0_66643a109b4a4.png', 136),
	('resources//Product_Images//Huawei Nova 11i _1_66643a109c7e1.png', 136),
	('resources//Product_Images//Huawei Nova 11i _2_66643a109d9f4.png', 136),
	('resources//Product_Images//Samsung Galaxy A54 5G_0_6664376b721dd.png', 137),
	('resources//Product_Images//Samsung Galaxy A54 5G_1_6664376b72d3e.png', 137),
	('resources//Product_Images//Samsung Galaxy A54 5G_2_6664376b73bb3.png', 137),
	('resources//Product_Images//Apple iPhone 15 Pro _0_6664394c1bdce.png', 138),
	('resources//Product_Images//Apple iPhone 15 Pro _1_6664394c1d37b.png', 138),
	('resources//Product_Images//Apple iPhone 15 Pro _2_6664394c1ed9e.png', 138),
	('resources//Product_Images//Dell Inspiron 3530 - 13th Gen i5 8GB RAM_0_666465d7e2596.png', 139),
	('resources//Product_Images//Dell Inspiron 3530 - 13th Gen i5 8GB RAM_1_666465d7e39da.png', 139),
	('resources//Product_Images//Dell Inspiron 3530 - 13th Gen i5 8GB RAM_2_666465d7e487e.png', 139),
	('resources//Product_Images//ASUS Vivobook 15 X1504 - 13th Gen i5_0_66643d8a4601f.png', 140),
	('resources//Product_Images//ASUS Vivobook 15 X1504 - 13th Gen i5_1_66643d8a46f80.png', 140),
	('resources//Product_Images//ASUS Vivobook 15 X1504 - 13th Gen i5_2_66643d8a482aa.png', 140),
	('resources//Product_Images//HUAWEI MateBook D 14 - 13th Gen, i5_0_66643e7841b6a.png', 141),
	('resources//Product_Images//HUAWEI MateBook D 14 - 13th Gen, i5_1_66643e7842b72.png', 141),
	('resources//Product_Images//HUAWEI MateBook D 14 - 13th Gen, i5_2_66643e7843cdf.png', 141),
	('resources//Product_Images//MSI THIN 15 B13VE - i7 13th Gen_0_66643f6cc4535.png', 142),
	('resources//Product_Images//MSI THIN 15 B13VE - i7 13th Gen_1_66643f6cc59b4.png', 142),
	('resources//Product_Images//MSI THIN 15 B13VE - i7 13th Gen_2_66643f6cc6c62.png', 142),
	('resources//Product_Images//ACER Aspire 5 - 13th Gen i3 8GB RAM_0_6664658ac495b.png', 143),
	('resources//Product_Images//ACER Aspire 5 - 13th Gen i3 8GB RAM_1_6664658ac59a7.png', 143),
	('resources//Product_Images//ACER Aspire 5 - 13th Gen i3 8GB RAM_2_6664658ac719d.png', 143),
	('resources//Product_Images//Canon EOS 2000D DSLR Camera _0_666442634ee2e.jpeg', 144),
	('resources//Product_Images//Canon EOS 2000D DSLR Camera _1_666442634fff2.jpeg', 144),
	('resources//Product_Images//Canon EOS 2000D DSLR Camera _2_666442635110b.jpeg', 144),
	('resources//Product_Images//Sony ZV-E10 Mirrorless Camera _0_66644406ec3d6.jpeg', 145),
	('resources//Product_Images//Sony ZV-E10 Mirrorless Camera _1_66644406edd5c.jpeg', 145),
	('resources//Product_Images//Sony ZV-E10 Mirrorless Camera _2_66644406ee71d.jpeg', 145),
	('resources//Product_Images//Sony Alpha a6600 Mirrorless Digital Camera_0_666445c69bd62.jpeg', 146),
	('resources//Product_Images//Sony Alpha a6600 Mirrorless Digital Camera_1_666445c69d03d.jpeg', 146),
	('resources//Product_Images//Sony Alpha a6600 Mirrorless Digital Camera_2_666445c69df12.jpeg', 146),
	('resources//Product_Images//Nikon D7500 DSLR Camera 4K UHD_0_666466882c5bc.jpeg', 147),
	('resources//Product_Images//Nikon D7500 DSLR Camera 4K UHD_1_666466882d949.jpeg', 147),
	('resources//Product_Images//Nikon D7500 DSLR Camera 4K UHD_2_666466882ea56.jpeg', 147),
	('resources//Product_Images//Sony Alpha a7 III Mirrorless Digital Camera _0_66644839d920f.jpeg', 148),
	('resources//Product_Images//Sony Alpha a7 III Mirrorless Digital Camera _1_66644839da5c9.jpeg', 148),
	('resources//Product_Images//Sony Alpha a7 III Mirrorless Digital Camera _2_66644839db167.jpeg', 148),
	('resources//Product_Images//360° Universal Mount Holder Car Stand_0_66644efeed0e4.png', 149),
	('resources//Product_Images//360° Universal Mount Holder Car Stand_1_66644efeedeb7.png', 149),
	('resources//Product_Images//360° Universal Mount Holder Car Stand_2_66644efeeed66.png', 149),
	('resources//Product_Images//2 Port PD Plug 40W Charger Adapter_0_6664522f943bb.png', 150),
	('resources//Product_Images//2 Port PD Plug 40W Charger Adapter_1_6664522f95d75.png', 150),
	('resources//Product_Images//2 Port PD Plug 40W Charger Adapter_2_6664522f97003.png', 150),
	('resources//Product_Images//25000mAh Power Bank 100W PD_0_66645636f3db5.png', 151),
	('resources//Product_Images//25000mAh Power Bank 100W PD_1_66645637016be.png', 151),
	('resources//Product_Images//25000mAh Power Bank 100W PD_2_6664563702973.png', 151),
	('resources//Product_Images//Wireless Earbuds TWS Bluetooth 5.3 Earphone_0_6664585356bb0.png', 152),
	('resources//Product_Images//Wireless Earbuds TWS Bluetooth 5.3 Earphone_1_6664585358234.png', 152),
	('resources//Product_Images//Wireless Earbuds TWS Bluetooth 5.3 Earphone_2_6664585359dc2.png', 152),
	('resources//Product_Images//2024 Ring Case Motorola Moto G Power_0_6664672880ea4.jpeg', 153),
	('resources//Product_Images//2024 Ring Case Motorola Moto G Power_1_6664672881bb8.jpeg', 153),
	('resources//Product_Images//2024 Ring Case Motorola Moto G Power_2_6664672882e70.jpeg', 153),
	('resources//Product_Images//K99 Max 4K camera drone _0_66645fd915984.jpeg', 154),
	('resources//Product_Images//DJI Air 2S_0_666460bd0afce.jpeg', 155),
	('resources//Product_Images//Foldable Quadcopter Drone_0_6664685057c13.jpeg', 156),
	('resources//Product_Images//YH-19 480P Camera Drone_0_666463509568d.jpeg', 157),
	('resources//Product_Images//Autel Robotics EVO II 8K _0_6664687c2ae95.png', 158);

-- Dumping structure for table xflax.profile_img
CREATE TABLE IF NOT EXISTS `profile_img` (
  `path` varchar(100) NOT NULL,
  `users_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_profile_img_users1_idx` (`users_email`),
  CONSTRAINT `fk_profile_img_users1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.profile_img: ~8 rows (approximately)
INSERT INTO `profile_img` (`path`, `users_email`) VALUES
	('resources/profile_images/Kavindu_684296d474ed1.jpeg', 'kavinduvishmith@gmail.com');

-- Dumping structure for table xflax.province
CREATE TABLE IF NOT EXISTS `province` (
  `province_id` int NOT NULL AUTO_INCREMENT,
  `province_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.province: ~8 rows (approximately)
INSERT INTO `province` (`province_id`, `province_name`) VALUES
	(1, 'Western Province'),
	(2, 'Central Province'),
	(3, 'Southern Province'),
	(4, 'Northern Province'),
	(5, ' Eastern Province'),
	(6, 'North Western Province'),
	(7, 'North Central Province'),
	(8, 'Uva Province'),
	(9, 'Sabaragamuwa Province');

-- Dumping structure for table xflax.status
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.status: ~2 rows (approximately)
INSERT INTO `status` (`status_id`, `status_name`) VALUES
	(1, 'Available'),
	(2, 'Not Available');

-- Dumping structure for table xflax.users
CREATE TABLE IF NOT EXISTS `users` (
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) DEFAULT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `joined_date` datetime DEFAULT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `user_type_id` int DEFAULT '2',
  `gender_id` int NOT NULL,
  `status_status_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_users_user_type1_idx` (`user_type_id`),
  KEY `fk_users_gender1_idx` (`gender_id`),
  KEY `fk_users_status1_idx` (`status_status_id`),
  CONSTRAINT `fk_users_gender1` FOREIGN KEY (`gender_id`) REFERENCES `gender` (`id`),
  CONSTRAINT `fk_users_status1` FOREIGN KEY (`status_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `fk_users_user_type1` FOREIGN KEY (`user_type_id`) REFERENCES `user_type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.users: ~20 rows (approximately)
INSERT INTO `users` (`fname`, `lname`, `email`, `password`, `mobile`, `joined_date`, `verification_code`, `user_type_id`, `gender_id`, `status_status_id`) VALUES
	('Ashen', 'Perera', 'amal@gmail.com', '1234567', '0751320701', '2023-10-09 13:53:47', '6666d84dd2270', 2, 1, 1),
	('Avishka', 'Jayalath', 'avishka@gmail.com', '1234567', '0789707496', '2025-06-01 01:24:54', NULL, 2, 1, 1),
	('Ashan', 'Ayodya', 'ayodya@gmail.com', '1234567', '0751320802', '2025-06-01 08:02:17', NULL, 2, 1, 1),
	('Amal', 'Deshan', 'deshan@gmail.com', '1234567', '0761429085', '2025-06-04 04:38:41', NULL, 2, 1, 1),
	('Sadun', 'vishmitha', 'heshan@gmail.com', 'fdhytutu', '0703616764', '2023-10-09 13:13:31', NULL, 2, 1, 1),
	('Imesha', 'Karunarathna', 'imesh@gmail.com', '1234567', '0752430900', '2025-06-04 04:22:10', NULL, 2, 1, 1),
	('Jude', 'Thamel', 'jude@gmail.com', '7654321', '0784513208', '2025-05-28 01:08:06', '683614ce5c4f6', 2, 1, 1),
	('Kaveesha', 'Dewmina', 'kaveesha1@gmail.com', '1234567', '0752430901', '2025-06-01 00:06:58', '6841be1650228', 2, 1, 1),
	('Kaveesha', 'induwara', 'kaveesha@gmail.com', '20091121', '0712654890', '2023-10-12 16:56:20', NULL, 2, 1, 1),
	('Kavindu', 'Vishmitha', 'kavinduvishmith@gmail.com', '1234567', '0751717203', '2023-10-09 13:08:44', NULL, 1, 1, 1),
	('Sanjana', 'Kumara', 'sanjana@gmail.com', '1234567', '0786513303', '2025-06-01 01:31:50', NULL, 2, 1, 1);

-- Dumping structure for table xflax.users_has_address
CREATE TABLE IF NOT EXISTS `users_has_address` (
  `address_id` int NOT NULL AUTO_INCREMENT,
  `line1` text,
  `line2` text,
  `postal_code` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `users_email` varchar(100) NOT NULL,
  `city_city_id` int DEFAULT NULL,
  PRIMARY KEY (`address_id`),
  KEY `fk_users_has_city_city1_idx` (`city_city_id`),
  KEY `fk_users_has_city_users1_idx` (`users_email`),
  CONSTRAINT `fk_users_has_city_city1` FOREIGN KEY (`city_city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `fk_users_has_city_users1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.users_has_address: ~9 rows (approximately)
INSERT INTO `users_has_address` (`address_id`, `line1`, `line2`, `postal_code`, `users_email`, `city_city_id`) VALUES
	(127, 'NO 30/2 Gampaha', 'Kotugoda', '12345', 'kavinduvishmith@gmail.com', 4);

-- Dumping structure for table xflax.user_type
CREATE TABLE IF NOT EXISTS `user_type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.user_type: ~2 rows (approximately)
INSERT INTO `user_type` (`id`, `type`) VALUES
	(1, 'Admin'),
	(2, 'User');

-- Dumping structure for table xflax.watchlist
CREATE TABLE IF NOT EXISTS `watchlist` (
  `w_id` int NOT NULL AUTO_INCREMENT,
  `Product_id` int NOT NULL,
  `users_email` varchar(100) NOT NULL,
  PRIMARY KEY (`w_id`),
  KEY `fk_watchlist_Product1_idx` (`Product_id`),
  KEY `fk_watchlist_users1_idx` (`users_email`),
  CONSTRAINT `fk_watchlist_Product1` FOREIGN KEY (`Product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_watchlist_users1` FOREIGN KEY (`users_email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=391 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table xflax.watchlist: ~8 rows (approximately)
INSERT INTO `watchlist` (`w_id`, `Product_id`, `users_email`) VALUES
	(211, 157, 'amal@gmail.com'),
	(212, 158, 'amal@gmail.com'),
	(215, 154, 'amal@gmail.com'),
	(216, 155, 'amal@gmail.com'),
	(217, 153, 'amal@gmail.com'),
	(218, 139, 'amal@gmail.com'),
	(219, 136, 'amal@gmail.com'),
	(220, 137, 'amal@gmail.com'),
	(390, 149, 'kavinduvishmith@gmail.com');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
