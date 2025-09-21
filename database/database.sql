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
  `iata` varchar(3) NOT NULL,
  `icao` varchar(4) NOT NULL,
  `model` varchar(100) NOT NULL,
  `seats_f` int NOT NULL DEFAULT '0',
  `seats_c` int NOT NULL DEFAULT '0',
  `seats_y` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.aircraft: ~0 rows (approximately)

-- Dumping structure for table amadeus.airlines
CREATE TABLE IF NOT EXISTS `airlines` (
  `id` int NOT NULL AUTO_INCREMENT,
  `iata` varchar(3) NOT NULL,
  `icao` varchar(4) NOT NULL,
  `airline` varchar(100) NOT NULL,
  `callsign` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `comments` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.airlines: ~10 rows (approximately)

-- Dumping structure for table amadeus.airline_users
CREATE TABLE IF NOT EXISTS `airline_users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `airline_id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_airline` (`airline_id`),
  CONSTRAINT `FK_airline` FOREIGN KEY (`airline_id`) REFERENCES `airlines` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.airline_users: ~0 rows (approximately)

-- Dumping structure for table amadeus.airports
CREATE TABLE IF NOT EXISTS `airports` (
  `id` int NOT NULL AUTO_INCREMENT,
  `iata` varchar(3) NOT NULL,
  `icao` varchar(4) NOT NULL,
  `airport_name` varchar(100) NOT NULL,
  `location_served` varchar(100) NOT NULL,
  `time` varchar(100) NOT NULL,
  `dst` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.airports: ~0 rows (approximately)

-- Dumping structure for table amadeus.flight_routes
CREATE TABLE IF NOT EXISTS `flight_routes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `airline_id` int NOT NULL,
  `origin_airport_id` int NOT NULL,
  `destination_airport_id` int NOT NULL,
  `round_trip` tinyint NOT NULL DEFAULT '1',
  `aircraft_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_flight_routes_airline` (`airline_id`),
  KEY `FK_flight_routes_origin` (`origin_airport_id`),
  KEY `FK_flight_routes_dest` (`destination_airport_id`),
  KEY `FK_flight_routes_aircraft` (`aircraft_id`),
  CONSTRAINT `FK_flight_routes_aircraft` FOREIGN KEY (`aircraft_id`) REFERENCES `aircraft` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_flight_routes_airline` FOREIGN KEY (`airline_id`) REFERENCES `airlines` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_flight_routes_dest` FOREIGN KEY (`destination_airport_id`) REFERENCES `airports` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_flight_routes_origin` FOREIGN KEY (`origin_airport_id`) REFERENCES `airports` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.flight_routes: ~0 rows (approximately)

-- Dumping structure for table amadeus.flight_schedules
CREATE TABLE IF NOT EXISTS `flight_schedules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `airline_user_id` int NOT NULL,
  `flight_route_id` int NOT NULL,
  `date_departure` varchar(50) NOT NULL,
  `time_departure` varchar(50) NOT NULL,
  `date_arrival` varchar(50) NOT NULL,
  `time_arrival` varchar(50) NOT NULL,
  `aircraft` int DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  `price_f` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price_c` decimal(10,2) NOT NULL DEFAULT '0.00',
  `price_y` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `FK_flight_schedules_user` (`airline_user_id`),
  KEY `FK_flight_schedules_route` (`flight_route_id`),
  CONSTRAINT `FK_flight_schedules_route` FOREIGN KEY (`flight_route_id`) REFERENCES `flight_routes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_flight_schedules_user` FOREIGN KEY (`airline_user_id`) REFERENCES `airline_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.flight_schedules: ~0 rows (approximately)

-- Dumping structure for table amadeus.seats
CREATE TABLE IF NOT EXISTS `seats` (
  `id` int NOT NULL AUTO_INCREMENT,
  `flight_schedule_id` int NOT NULL,
  `ticket_id` int DEFAULT NULL,
  `seat_no` varchar(10) NOT NULL,
  `class` enum('F','C','Y') NOT NULL,
  `status` enum('available','occupied','blocked') NOT NULL DEFAULT 'available',
  PRIMARY KEY (`id`),
  KEY `FK_seats_schedule` (`flight_schedule_id`),
  CONSTRAINT `FK_seats_schedule` FOREIGN KEY (`flight_schedule_id`) REFERENCES `flight_schedules` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.seats: ~42 rows (approximately)

-- Dumping structure for table amadeus.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` enum('user','admin','staff') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.users: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
