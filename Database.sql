-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for my_store
CREATE DATABASE IF NOT EXISTS `my_store` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `my_store`;

-- Dumping structure for table my_store.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.category: ~6 rows (approximately)
INSERT INTO `category` (`id`, `name`, `description`) VALUES
	(1, 'Điện thoại', 'Danh mục các loại điện thoại'),
	(2, 'Laptop', 'Danh mục các loại laptop'),
	(3, 'Máy tính bảng', 'Danh mục các loại máy tính bảng'),
	(4, 'Phụ kiện', 'Danh mục phụ kiện điện tử'),
	(5, 'Thiết bị âm thanh', 'Danh mục loa, tai nghe, micro'),
	(6, 'HAHA', 'aaa'),
	(9, 'vzxv', 'ádasdas');

-- Dumping structure for table my_store.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.orders: ~7 rows (approximately)
INSERT INTO `orders` (`id`, `name`, `phone`, `address`, `created_at`) VALUES
	(1, 'kan', '012', 'kkkk', '2025-03-28 06:39:11'),
	(2, 'kan', '012', 'jnjkn', '2025-03-28 06:39:47'),
	(3, 'ádcfhsdikh', 'ạodiasjoid', 'ạ23uweuoijdi', '2025-03-28 06:40:35'),
	(4, 'kan', '75645', 'fgthdrtyh', '2025-03-28 06:43:59'),
	(5, 'ádasd', 'ádasdas', 'âsdasd', '2025-03-28 06:59:30'),
	(6, 'sxdvfsdv', 'sdvsdvsd', 'sdvsdvsd', '2025-03-28 07:20:40'),
	(7, 'ưeqe', '342342342', 'ádasdasdas', '2025-03-28 07:46:28');

-- Dumping structure for table my_store.order_details
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.order_details: ~12 rows (approximately)
INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
	(1, 1, 1, 1, 12343534.00),
	(2, 1, 5, 1, 1234.00),
	(3, 2, 1, 1, 12343534.00),
	(4, 3, 4, 1, 434343.00),
	(5, 4, 4, 4, 434343.00),
	(6, 5, 5, 2, 1234.00),
	(7, 6, 1, 1, 12343534.00),
	(8, 6, 4, 5, 434343.00),
	(9, 7, 1, 1, 12343534.00),
	(10, 7, 4, 1, 434343.00),
	(11, 7, 14, 1, 12313.00),
	(12, 7, 7, 3, 324234.00);

-- Dumping structure for table my_store.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=367 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.product: ~15 rows (approximately)
INSERT INTO `product` (`id`, `name`, `description`, `price`, `image`, `category_id`) VALUES
	(4, 'ùawe4t', 'dgtsrdeg', 434343.00, 'uploads/products/67e6429f66fa7.png', 2),
	(5, 'Kan Trun', 'Không', 1234.00, 'uploads/products/67e643c9c6956.png', 6),
	(7, 'sdfsdf', 'sdfsdfd', 324234.00, 'uploads/products/67e64c73b3b0b.jpg', 4),
	(8, 'kan', 'đâsdđâsdádasd', 2132.00, 'uploads/products/67e64d223832e.png', 2),
	(9, 'kan', 'đâsdđâsdádasd', 2132.00, 'uploads/products/67e64d3d7cf19.png', 2),
	(15, 'ádasdasd', 'sffsdfsdfsdfsd', 231212.00, 'uploads/products/67e655b8a3af0.png', 1),
	(16, 'HAHA', 'ẻgergergerg', 4354.00, 'uploads/products/67e65611b807a.png', 3),
	(17, 'Laptop Hutech', 'A high-performance laptop', 1999.99, '', 1),
	(18, 'Laptop Hutech', 'A high-performance laptop', 1999.99, NULL, 1),
	(19, 'Laptop Hutech', 'A high-performance laptop', 1999.99, NULL, 1),
	(20, 'Laptop Hutech PUT 33', 'A high-performance laptop', 1999.99, NULL, 1),
	(21, 'Laptop Hutech PUT 33', 'A high-performance laptop', 1999.99, NULL, 1),
	(22, 'Laptop Hutech PUT 35', 'A high-performance laptop', 1999.99, NULL, 1),
	(23, 'Laptop Hutech PUT 35', 'A high-performance laptop', 1999.99, NULL, 1),
	(366, 'Laptop Hutech PUT 366101010', 'A high-performance laptop', 2.00, 'uploads/products/67e667be9778f.jpg', 1);

-- Dumping structure for table my_store.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table my_store.users: ~2 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`, `name`, `role`, `created_at`) VALUES
	(1, 'kan', '$2y$12$/zImXnSoNkMpXKwv.dD6n.cF0Oro0YLMtNEaSO/0X68keCeSnbg3y', 'kantrun', 'admin', '2025-03-28 05:38:39'),
	(2, 'hu', '$2y$12$b8LgRSzU0oKibEW214zkJOFjYf3RJdNc/RL/PKRRxjkIfZjAfdl42', 'huhu', 'user', '2025-03-28 06:46:18');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
