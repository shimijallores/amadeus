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

-- Dumping structure for table amadeus.aircraft
CREATE TABLE IF NOT EXISTS `aircraft` (
  `id` int NOT NULL AUTO_INCREMENT,
  `iata` varchar(3) NOT NULL DEFAULT '0',
  `icao` varchar(4) NOT NULL DEFAULT '0',
  `model` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.aircraft: ~10 rows (approximately)
INSERT INTO `aircraft` (`id`, `iata`, `icao`, `model`) VALUES
	(1, '320', 'A320', 'Airbus A320-200'),
	(2, '321', 'A321', 'Airbus A321-200'),
	(3, '330', 'A330', 'Airbus A330-300'),
	(4, '738', 'B738', 'Boeing 737-800'),
	(5, '77W', 'B77W', 'Boeing 777-300ER'),
	(6, '789', 'B788', 'Boeing 787-9 Dreamliner'),
	(7, '359', 'A359', 'Airbus A350-900'),
	(8, 'AT7', 'AT76', 'ATR 72-600'),
	(9, 'DH4', 'DH8D', 'Bombardier Dash 8 Q400'),
	(10, 'E90', 'E190', 'Embraer E-Jet E190');

-- Dumping structure for table amadeus.airlines
CREATE TABLE IF NOT EXISTS `airlines` (
  `id` int NOT NULL AUTO_INCREMENT,
  `iata` varchar(3) NOT NULL DEFAULT '0',
  `icao` varchar(4) NOT NULL DEFAULT '0',
  `airline` varchar(100) NOT NULL DEFAULT '0',
  `callsign` varchar(100) NOT NULL DEFAULT '0',
  `country` varchar(100) NOT NULL DEFAULT '0',
  `comments` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.airlines: ~10 rows (approximately)
INSERT INTO `airlines` (`id`, `iata`, `icao`, `airline`, `callsign`, `country`, `comments`) VALUES
	(1, 'PR', 'PAL', 'Philippine Airlines', 'PHILIPPINE', 'Philippines', 'Philippine flag carrier'),
	(2, '5J', 'CEB', 'Cebu Pacific', 'CEBU', 'Philippines', 'Low-cost carrier Philippines'),
	(3, 'Z2', 'APG', 'Philippines AirAsia', 'AIRASIA', 'Philippines', 'Low-cost carrier'),
	(4, 'SQ', 'SIA', 'Singapore Airlines', 'SINGAPORE', 'Singapore', 'Premium Asian carrier'),
	(5, 'CX', 'CPA', 'Cathay Pacific', 'CATHAY', 'Hong Kong', 'Hong Kong flag carrier'),
	(6, 'TG', 'THA', 'Thai Airways', 'THAI', 'Thailand', 'Thai flag carrier'),
	(7, 'MH', 'MAS', 'Malaysia Airlines', 'MALAYSIAN', 'Malaysia', 'Malaysian flag carrier'),
	(8, 'GA', 'GIA', 'Garuda Indonesia', 'INDONESIA', 'Indonesia', 'Indonesian flag carrier'),
	(9, 'VN', 'HVN', 'Vietnam Airlines', 'VIETNAM', 'Vietnam', 'Vietnamese flag carrier'),
	(10, 'CI', 'CAL', 'China Airlines', 'DYNASTY', 'Taiwan', 'Taiwanese flag carrier');

-- Dumping structure for table amadeus.airline_users
CREATE TABLE IF NOT EXISTS `airline_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `airline_id` int NOT NULL DEFAULT '0',
  `user` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(250) NOT NULL DEFAULT '0',
  `type` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__airline` (`airline_id`),
  CONSTRAINT `FK__airline` FOREIGN KEY (`airline_id`) REFERENCES `airlines` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.airline_users: ~10 rows (approximately)
INSERT INTO `airline_users` (`id`, `airline_id`, `user`, `password`, `type`) VALUES
	(1, 1, 'pal_pilot_cruz', '$2y$10$FSdC..p9hnwfaD2BHucH9ePn.UNOYX4ezUWMDibk2Amm0omAXGViu', 'pilot'),
	(2, 2, 'ceb_ops_santos', '$2y$10$FQOC7MEAIUWGSrxj66RieuSxVuHuI5hc8vPeylww5e9R6IUjOaaH2', 'operations'),
	(3, 3, 'airasia_dispatch', '$2y$10$jp3OBqPp3y2oDBH1UFGQieih.BaLtvISXaDvOAkZHHAJR28zLGpV6', 'dispatcher'),
	(4, 4, 'sq_captain_lim', '$2y$10$FSdC..p9hnwfaD2BHucH9ePn.UNOYX4ezUWMDibk2Amm0omAXGViu', 'pilot'),
	(5, 5, 'cx_ops_wong', '$2y$10$FQOC7MEAIUWGSrxj66RieuSxVuHuI5hc8vPeylww5e9R6IUjOaaH2', 'operations'),
	(6, 6, 'thai_crew_manager', '$2y$10$jp3OBqPp3y2oDBH1UFGQieih.BaLtvISXaDvOAkZHHAJR28zLGpV6', 'crew'),
	(7, 7, 'mh_pilot_ahmad', '$2y$10$FSdC..p9hnwfaD2BHucH9ePn.UNOYX4ezUWMDibk2Amm0omAXGViu', 'pilot'),
	(8, 8, 'garuda_ops', '$2y$10$FQOC7MEAIUWGSrxj66RieuSxVuHuI5hc8vPeylww5e9R6IUjOaaH2', 'operations'),
	(9, 9, 'vn_dispatcher', '$2y$10$jp3OBqPp3y2oDBH1UFGQieih.BaLtvISXaDvOAkZHHAJR28zLGpV6', 'dispatcher'),
	(10, 10, 'cal_manager_chen', '$2y$10$FSdC..p9hnwfaD2BHucH9ePn.UNOYX4ezUWMDibk2Amm0omAXGViu', 'manager');

-- Dumping structure for table amadeus.airports
CREATE TABLE IF NOT EXISTS `airports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `iata` varchar(3) NOT NULL DEFAULT '0',
  `icao` varchar(4) NOT NULL DEFAULT '0',
  `airport_name` varchar(100) NOT NULL DEFAULT '0',
  `location_served` varchar(100) NOT NULL DEFAULT '0',
  `time` varchar(100) NOT NULL DEFAULT '0',
  `dst` varchar(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.airports: ~10 rows (approximately)
INSERT INTO `airports` (`id`, `iata`, `icao`, `airport_name`, `location_served`, `time`, `dst`) VALUES
	(1, 'MNL', 'RPLL', 'Ninoy Aquino International Airport', 'Manila, Philippines', 'UTC+8', 'UTC+8'),
	(2, 'CEB', 'RPVM', 'Mactan-Cebu International Airport', 'Cebu, Philippines', 'UTC+8', 'UTC+8'),
	(3, 'DVO', 'RPMD', 'Francisco Bangoy International Airport', 'Davao, Philippines', 'UTC+8', 'UTC+8'),
	(4, 'ILO', 'RPVI', 'Iloilo International Airport', 'Iloilo, Philippines', 'UTC+8', 'UTC+8'),
	(5, 'SIN', 'WSSS', 'Singapore Changi Airport', 'Singapore', 'UTC+8', 'UTC+8'),
	(6, 'BKK', 'VTBS', 'Suvarnabhumi Airport', 'Bangkok, Thailand', 'UTC+7', 'UTC+7'),
	(7, 'KUL', 'WMKK', 'Kuala Lumpur International Airport', 'Kuala Lumpur, Malaysia', 'UTC+8', 'UTC+8'),
	(8, 'CGK', 'WIII', 'Soekarno-Hatta International Airport', 'Jakarta, Indonesia', 'UTC+7', 'UTC+7'),
	(9, 'HKG', 'VHHH', 'Hong Kong International Airport', 'Hong Kong', 'UTC+8', 'UTC+8'),
	(10, 'TPE', 'RCTP', 'Taiwan Taoyuan International Airport', 'Taipei, Taiwan', 'UTC+8', 'UTC+8');

-- Dumping structure for table amadeus.flight_routes
CREATE TABLE IF NOT EXISTS `flight_routes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `airline_id` int NOT NULL DEFAULT '0',
  `origin_airport_id` int NOT NULL DEFAULT '0',
  `destination_airport_id` int NOT NULL DEFAULT '0',
  `round_trip` tinyint NOT NULL DEFAULT '0',
  `aircraft_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__airlines` (`airline_id`),
  KEY `FK__airports` (`origin_airport_id`),
  KEY `FK__airports_2` (`destination_airport_id`),
  KEY `FK__aircraft` (`aircraft_id`),
  CONSTRAINT `FK__aircraft` FOREIGN KEY (`aircraft_id`) REFERENCES `aircraft` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__airlines` FOREIGN KEY (`airline_id`) REFERENCES `airlines` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__airports` FOREIGN KEY (`origin_airport_id`) REFERENCES `airports` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK__airports_2` FOREIGN KEY (`destination_airport_id`) REFERENCES `airports` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.flight_routes: ~10 rows (approximately)
INSERT INTO `flight_routes` (`id`, `airline_id`, `origin_airport_id`, `destination_airport_id`, `round_trip`, `aircraft_id`) VALUES
	(1, 1, 1, 2, 1, 1),
	(2, 1, 1, 3, 1, 2),
	(3, 2, 2, 4, 1, 1),
	(4, 2, 1, 5, 0, 4),
	(5, 3, 1, 6, 1, 1),
	(6, 4, 5, 1, 0, 5),
	(7, 5, 9, 1, 1, 3),
	(8, 6, 6, 2, 0, 2),
	(9, 7, 7, 1, 1, 4),
	(10, 8, 8, 5, 1, 6);

-- Dumping structure for table amadeus.flight_schedules
CREATE TABLE IF NOT EXISTS `flight_schedules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `airline_user_id` int NOT NULL DEFAULT '0',
  `flight_route_id` int NOT NULL DEFAULT '0',
  `date_departure` varchar(50) NOT NULL DEFAULT '0',
  `time_departure` varchar(50) NOT NULL DEFAULT '0',
  `date_arrival` varchar(50) NOT NULL DEFAULT '0',
  `time_arrival` varchar(50) NOT NULL DEFAULT '0',
  `status` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__airline_users` (`airline_user_id`),
  KEY `FK_flight_schedules_flight_routes` (`flight_route_id`),
  CONSTRAINT `FK__airline_users` FOREIGN KEY (`airline_user_id`) REFERENCES `airline_users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_flight_schedules_flight_routes` FOREIGN KEY (`flight_route_id`) REFERENCES `flight_routes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.flight_schedules: ~10 rows (approximately)
INSERT INTO `flight_schedules` (`id`, `airline_user_id`, `flight_route_id`, `date_departure`, `time_departure`, `date_arrival`, `time_arrival`, `status`) VALUES
	(1, 1, 1, '2025-09-15', '06:30', '2025-09-15', '08:05', 'scheduled'),
	(2, 1, 2, '2025-09-15', '10:15', '2025-09-15', '12:25', 'on-time'),
	(3, 2, 3, '2025-09-16', '14:20', '2025-09-16', '15:35', 'scheduled'),
	(4, 2, 4, '2025-09-16', '16:45', '2025-09-16', '20:15', 'delayed'),
	(5, 3, 5, '2025-09-17', '07:00', '2025-09-17', '09:30', 'scheduled'),
	(6, 4, 6, '2025-09-17', '23:55', '2025-09-18', '04:20', 'scheduled'),
	(7, 5, 7, '2025-09-18', '08:45', '2025-09-18', '12:15', 'on-time'),
	(8, 6, 8, '2025-09-18', '15:30', '2025-09-18', '20:10', 'scheduled'),
	(9, 7, 9, '2025-09-19', '11:25', '2025-09-19', '14:55', 'scheduled'),
	(10, 8, 10, '2025-09-19', '13:40', '2025-09-19', '16:25', 'scheduled');

-- Dumping structure for table amadeus.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` enum('user','admin','staff') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
	(5, 'admin', '$2y$10$FSdC..p9hnwfaD2BHucH9ePn.UNOYX4ezUWMDibk2Amm0omAXGViu', 'admin'),
	(6, 'staff', '$2y$10$FQOC7MEAIUWGSrxj66RieuSxVuHuI5hc8vPeylww5e9R6IUjOaaH2', 'staff'),
	(7, 'user', '$2y$10$jp3OBqPp3y2oDBH1UFGQieih.BaLtvISXaDvOAkZHHAJR28zLGpV6', 'user');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
