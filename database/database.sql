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
	(1, 'A1', 'ICA1', 'Airbus A320'),
	(2, 'A2', 'ICA2', 'Boeing 737'),
	(3, 'A3', 'ICA3', 'Embraer E190'),
	(4, 'A4', 'ICA4', 'Bombardier Q400'),
	(5, 'A5', 'ICA5', 'Airbus A350'),
	(6, 'A6', 'ICA6', 'Boeing 787'),
	(7, 'A7', 'ICA7', 'Cessna 172'),
	(8, 'A8', 'ICA8', 'Gulfstream G650'),
	(9, 'A9', 'ICA9', 'ATR 72'),
	(10, 'A0', 'ICA0', 'Concorde');

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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.airlines: ~9 rows (approximately)
INSERT INTO `airlines` (`id`, `iata`, `icao`, `airline`, `callsign`, `country`, `comments`) VALUES
	(1, 'AL1', 'ICL1', 'Airline One', 'ONEAIR', 'USA', 'demodemo'),
	(2, 'AL2', 'ICL2', 'Airline Two', 'TWOAIR', 'UK', ''),
	(4, 'AL4', 'ICL4', 'Airline Four', 'FOURAIR', 'Germany', ''),
	(5, 'AL5', 'ICL5', 'Airline Five', 'FIVEAIR', 'France', ''),
	(6, 'AL6', 'ICL6', 'Airline Six', 'SIXAIR', 'Japan', ''),
	(7, 'AL7', 'ICL7', 'Airline Seven', 'SEVENAIR', 'UAE', ''),
	(8, 'AL8', 'ICL8', 'Airline Eight', 'EIGHTAIR', 'India', ''),
	(9, 'AL9', 'ICL9', 'Airline Nine', 'NINEAIR', 'Brazil', ''),
	(10, 'AL0', 'ICL0', 'Airline Ten', 'TENAIR', 'Australia', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.airline_users: ~27 rows (approximately)
INSERT INTO `airline_users` (`id`, `airline_id`, `user`, `password`, `type`) VALUES
	(1, 1, 'user1a', 'pass1a', 'admin'),
	(2, 1, 'user1b', 'pass1b', 'staff'),
	(3, 1, 'user1c', 'pass1c', 'user'),
	(4, 2, 'user2a', 'pass2a', 'admin'),
	(5, 2, 'user2b', 'pass2b', 'staff'),
	(6, 2, 'user2c', 'pass2c', 'staff'),
	(10, 4, 'user4a', 'pass4a', 'admin'),
	(11, 4, 'user4b', 'pass4b', 'user'),
	(12, 4, 'user4c', 'pass4c', 'staff'),
	(13, 5, 'user5a', 'pass5a', 'admin'),
	(14, 5, 'user5b', 'pass5b', 'staff'),
	(15, 5, 'user5c', 'pass5c', 'user'),
	(16, 6, 'user6a', 'pass6a', 'admin'),
	(17, 6, 'user6b', 'pass6b', 'staff'),
	(18, 6, 'user6c', 'pass6c', 'user'),
	(19, 7, 'user7a', 'pass7a', 'admin'),
	(20, 7, 'user7b', 'pass7b', 'staff'),
	(21, 7, 'user7c', 'pass7c', 'staff'),
	(22, 8, 'user8a', 'pass8a', 'admin'),
	(23, 8, 'user8b', 'pass8b', 'staff'),
	(24, 8, 'user8c', 'pass8c', 'user'),
	(25, 9, 'user9a', 'pass9a', 'admin'),
	(26, 9, 'user9b', 'pass9b', 'staff'),
	(27, 9, 'user9c', 'pass9c', 'staff'),
	(28, 10, 'user10a', 'pass10a', 'admin'),
	(29, 10, 'user10b', 'pass10b', 'staff'),
	(30, 10, 'user10c', 'pass10c', 'staff');

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
	(1, 'AAA', 'ICA1', 'Alpha Airport', 'City A', 'UTC+1', 'Y'),
	(2, 'BBB', 'ICA2', 'Bravo Airport', 'City B', 'UTC+2', 'Y'),
	(3, 'CCC', 'ICA3', 'Charlie Airport', 'City C', 'UTC+3', 'N'),
	(4, 'DDD', 'ICA4', 'Delta Airport', 'City D', 'UTC+4', 'N'),
	(5, 'EEE', 'ICA5', 'Echo Airport', 'City E', 'UTC+5', 'Y'),
	(6, 'FFF', 'ICA6', 'Foxtrot Airport', 'City F', 'UTC+6', 'Y'),
	(7, 'GGG', 'ICA7', 'Golf Airport', 'City G', 'UTC+7', 'N'),
	(8, 'HHH', 'ICA8', 'Hotel Airport', 'City H', 'UTC+8', 'N'),
	(9, 'III', 'ICA9', 'India Airport', 'City I', 'UTC+9', 'Y'),
	(10, 'JJJ', 'ICA0', 'Juliet Airport', 'City J', 'UTC+10', 'Y');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.flight_routes: ~12 rows (approximately)
INSERT INTO `flight_routes` (`id`, `airline_id`, `origin_airport_id`, `destination_airport_id`, `round_trip`, `aircraft_id`) VALUES
	(1, 1, 1, 2, 1, 1),
	(2, 1, 2, 3, 1, 2),
	(3, 1, 3, 4, 1, 3),
	(4, 2, 4, 5, 1, 4),
	(5, 2, 5, 6, 1, 5),
	(6, 2, 6, 7, 1, 6),
	(10, 4, 10, 1, 1, 10),
	(11, 4, 1, 2, 1, 1),
	(12, 4, 2, 3, 1, 2),
	(13, 10, 9, 10, 1, 9),
	(14, 10, 10, 1, 1, 10),
	(15, 10, 1, 2, 1, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.flight_schedules: ~24 rows (approximately)
INSERT INTO `flight_schedules` (`id`, `airline_user_id`, `flight_route_id`, `date_departure`, `time_departure`, `date_arrival`, `time_arrival`, `status`) VALUES
	(45, 1, 1, '2025-09-01', '08:00', '2025-09-01', '10:00', 'Scheduled'),
	(46, 2, 2, '2025-09-01', '09:00', '2025-09-01', '11:00', 'Scheduled'),
	(47, 3, 3, '2025-09-01', '10:00', '2025-09-01', '12:00', 'Scheduled'),
	(48, 4, 4, '2025-09-02', '08:00', '2025-09-02', '10:00', 'Scheduled'),
	(49, 5, 5, '2025-09-02', '09:00', '2025-09-02', '11:00', 'Scheduled'),
	(50, 6, 6, '2025-09-02', '10:00', '2025-09-02', '12:00', 'Scheduled'),
	(54, 10, 10, '2025-09-04', '08:00', '2025-09-04', '10:00', 'Scheduled'),
	(55, 11, 11, '2025-09-04', '09:00', '2025-09-04', '11:00', 'Scheduled'),
	(56, 12, 12, '2025-09-04', '10:00', '2025-09-04', '12:00', 'Scheduled'),
	(57, 13, 13, '2025-09-05', '08:00', '2025-09-05', '10:00', 'Scheduled'),
	(58, 14, 14, '2025-09-05', '09:00', '2025-09-05', '11:00', 'Scheduled'),
	(59, 15, 15, '2025-09-05', '10:00', '2025-09-05', '12:00', 'Scheduled'),
	(60, 1, 1, '2025-09-01', '08:00', '2025-09-01', '10:00', 'Scheduled'),
	(61, 2, 2, '2025-09-01', '09:00', '2025-09-01', '11:00', 'Scheduled'),
	(62, 3, 3, '2025-09-01', '10:00', '2025-09-01', '12:00', 'Scheduled'),
	(63, 4, 4, '2025-09-02', '08:00', '2025-09-02', '10:00', 'Scheduled'),
	(64, 5, 5, '2025-09-02', '09:00', '2025-09-02', '11:00', 'Scheduled'),
	(65, 6, 6, '2025-09-02', '10:00', '2025-09-02', '12:00', 'Scheduled'),
	(69, 10, 10, '2025-09-04', '08:00', '2025-09-04', '10:00', 'Scheduled'),
	(70, 11, 11, '2025-09-04', '09:00', '2025-09-04', '11:00', 'Scheduled'),
	(71, 12, 12, '2025-09-04', '10:00', '2025-09-04', '12:00', 'Scheduled'),
	(72, 13, 13, '2025-09-05', '08:00', '2025-09-05', '10:00', 'Scheduled'),
	(73, 14, 14, '2025-09-05', '09:00', '2025-09-05', '11:00', 'Scheduled'),
	(74, 15, 15, '2025-09-05', '10:00', '2025-09-05', '12:00', 'Scheduled');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
