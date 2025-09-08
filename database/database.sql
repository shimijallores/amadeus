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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.aircraft: ~10 rows (approximately)
INSERT INTO `aircraft` (`id`, `iata`, `icao`, `model`) VALUES
	(1, '388', 'A388', 'Airbus A380-800'),
	(2, '359', 'A359', 'Airbus A350-900'),
	(3, '789', 'B789', 'Boeing 787-9 Dreamliner'),
	(4, '77W', 'B77W', 'Boeing 777-300ER'),
	(5, '320', 'A320', 'Airbus A320-200'),
	(6, '321', 'A321', 'Airbus A321neo'),
	(7, '738', 'B738', 'Boeing 737-800'),
	(8, '73M', 'B737', 'Boeing 737 MAX 8'),
	(9, '223', 'BCS3', 'Airbus A220-300'),
	(10, 'E90', 'E190', 'Embraer E190');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.airlines: ~10 rows (approximately)
INSERT INTO `airlines` (`id`, `iata`, `icao`, `airline`, `callsign`, `country`, `comments`) VALUES
	(1, 'EK', 'UAE', 'Emirates', 'EMIRATES', 'United Arab Emirates', ''),
	(2, 'SQ', 'SIA', 'Singapore Airlines', 'SINGAPORE', 'Singapore', ''),
	(3, 'DL', 'DAL', 'Delta Air Lines', 'DELTA', 'United States', ''),
	(4, 'LH', 'DLH', 'Lufthansa', 'LUFTHANSA', 'Germany', ''),
	(5, 'NH', 'ANA', 'All Nippon Airways', 'ALL NIPPON', 'Japan', ''),
	(6, 'QR', 'QTR', 'Qatar Airways', 'QATARI', 'Qatar', ''),
	(7, 'AF', 'AFR', 'Air France', 'AIRFRANS', 'France', ''),
	(8, 'QF', 'QFA', 'Qantas', 'QANTAS', 'Australia', ''),
	(9, 'BA', 'BAW', 'British Airways', 'SPEEDBIRD', 'United Kingdom', ''),
	(10, 'CX', 'CPA', 'Cathay Pacific', 'CATHAY', 'Hong Kong', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.airline_users: ~11 rows (approximately)
INSERT INTO `airline_users` (`id`, `airline_id`, `username`, `password`, `role`) VALUES
	(1, 1, 'ek_staff', 'hashed_pw', 'staff'),
	(2, 2, 'sq_staff', 'hashed_pw', 'staff'),
	(3, 3, 'dl_staff', 'hashed_pw', 'staff'),
	(4, 4, 'lh_staff', 'hashed_pw', 'staff'),
	(5, 5, 'nh_staff', 'hashed_pw', 'staff'),
	(6, 6, 'qr_staff', 'hashed_pw', 'staff'),
	(7, 7, 'af_staff', 'hashed_pw', 'staff'),
	(8, 8, 'qf_staff', 'hashed_pw', 'staff'),
	(9, 9, 'ba_staff', 'hashed_pw', 'staff'),
	(10, 10, 'cx_staff', 'hashed_pw', 'staff'),
	(11, 2, 'shimi', '$2y$10$wSumzyrmcM3Z308.SVdrSuc.mnoptKPi4n5M4J/xFlha1XR5t39SO', 'staff');

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.airports: ~10 rows (approximately)
INSERT INTO `airports` (`id`, `iata`, `icao`, `airport_name`, `location_served`, `time`, `dst`) VALUES
	(1, 'DXB', 'OMDB', 'Dubai International Airport', 'Dubai, UAE', 'UTC+4', 'No'),
	(2, 'SIN', 'WSSS', 'Singapore Changi Airport', 'Singapore', 'UTC+8', 'No'),
	(3, 'ATL', 'KATL', 'Hartsfield–Jackson Atlanta Intl', 'Atlanta, USA', 'UTC-5', 'Yes'),
	(4, 'FRA', 'EDDF', 'Frankfurt Airport', 'Frankfurt, Germany', 'UTC+1', 'Yes'),
	(5, 'HND', 'RJTT', 'Tokyo Haneda Airport', 'Tokyo, Japan', 'UTC+9', 'No'),
	(6, 'DOH', 'OTHH', 'Hamad International Airport', 'Doha, Qatar', 'UTC+3', 'No'),
	(7, 'CDG', 'LFPG', 'Paris Charles de Gaulle Airport', 'Paris, France', 'UTC+1', 'Yes'),
	(8, 'SYD', 'YSSY', 'Sydney Kingsford Smith Airport', 'Sydney, Australia', 'UTC+10', 'Yes'),
	(9, 'LHR', 'EGLL', 'London Heathrow Airport', 'London, UK', 'UTC+0', 'Yes'),
	(10, 'HKG', 'VHHH', 'Hong Kong Intl Airport', 'Hong Kong', 'UTC+8', 'No');

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.flight_routes: ~30 rows (approximately)
INSERT INTO `flight_routes` (`id`, `airline_id`, `origin_airport_id`, `destination_airport_id`, `round_trip`, `aircraft_id`) VALUES
	(1, 1, 1, 9, 1, 1),
	(2, 1, 1, 2, 1, 2),
	(3, 1, 1, 3, 1, 4),
	(4, 2, 2, 9, 1, 2),
	(5, 2, 2, 5, 1, 3),
	(6, 2, 2, 1, 1, 1),
	(7, 3, 3, 7, 1, 4),
	(8, 3, 3, 9, 1, 3),
	(9, 3, 3, 2, 1, 7),
	(10, 4, 4, 9, 1, 2),
	(11, 4, 4, 7, 1, 3),
	(12, 4, 4, 10, 1, 4),
	(13, 5, 5, 2, 1, 2),
	(14, 5, 5, 9, 1, 3),
	(15, 5, 5, 6, 1, 4),
	(16, 6, 6, 9, 1, 1),
	(17, 6, 6, 2, 1, 2),
	(18, 6, 6, 5, 1, 3),
	(19, 7, 7, 9, 1, 2),
	(20, 7, 7, 3, 1, 3),
	(21, 7, 7, 5, 1, 4),
	(22, 8, 8, 9, 1, 3),
	(23, 8, 8, 2, 1, 2),
	(24, 8, 8, 6, 1, 4),
	(25, 9, 9, 1, 1, 1),
	(26, 9, 9, 2, 1, 2),
	(27, 9, 9, 3, 1, 3),
	(28, 10, 10, 9, 1, 2),
	(29, 10, 10, 2, 1, 3),
	(30, 10, 10, 5, 1, 4);

-- Dumping structure for table amadeus.flight_schedules
CREATE TABLE IF NOT EXISTS `flight_schedules` (
  `id` int NOT NULL AUTO_INCREMENT,
  `airline_user_id` int NOT NULL,
  `flight_route_id` int NOT NULL,
  `date_departure` varchar(50) NOT NULL,
  `time_departure` varchar(50) NOT NULL,
  `date_arrival` varchar(50) NOT NULL,
  `time_arrival` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_flight_schedules_user` (`airline_user_id`),
  KEY `FK_flight_schedules_route` (`flight_route_id`),
  CONSTRAINT `FK_flight_schedules_route` FOREIGN KEY (`flight_route_id`) REFERENCES `flight_routes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_flight_schedules_user` FOREIGN KEY (`airline_user_id`) REFERENCES `airline_users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.flight_schedules: ~60 rows (approximately)
INSERT INTO `flight_schedules` (`id`, `airline_user_id`, `flight_route_id`, `date_departure`, `time_departure`, `date_arrival`, `time_arrival`, `status`) VALUES
	(1, 1, 1, '2025-09-10', '14:00', '2025-09-10', '18:30', 'On Time'),
	(2, 1, 1, '2025-09-11', '14:00', '2025-09-11', '18:30', 'Scheduled'),
	(3, 1, 2, '2025-09-12', '09:00', '2025-09-12', '17:00', 'On Time'),
	(4, 1, 2, '2025-09-13', '09:00', '2025-09-13', '17:00', 'Scheduled'),
	(5, 1, 3, '2025-09-14', '01:00', '2025-09-14', '11:00', 'On Time'),
	(6, 1, 3, '2025-09-15', '01:00', '2025-09-15', '11:00', 'Scheduled'),
	(7, 2, 4, '2025-09-10', '23:00', '2025-09-11', '05:00', 'On Time'),
	(8, 2, 4, '2025-09-11', '23:00', '2025-09-12', '05:00', 'Scheduled'),
	(9, 2, 5, '2025-09-12', '08:00', '2025-09-12', '14:00', 'On Time'),
	(10, 2, 5, '2025-09-13', '08:00', '2025-09-13', '14:00', 'Scheduled'),
	(11, 2, 6, '2025-09-14', '15:00', '2025-09-14', '19:30', 'On Time'),
	(12, 2, 6, '2025-09-15', '15:00', '2025-09-15', '19:30', 'Scheduled'),
	(13, 3, 7, '2025-09-10', '16:00', '2025-09-11', '06:00', 'On Time'),
	(14, 3, 7, '2025-09-11', '16:00', '2025-09-12', '06:00', 'Scheduled'),
	(15, 3, 8, '2025-09-12', '18:00', '2025-09-13', '06:30', 'On Time'),
	(16, 3, 8, '2025-09-13', '18:00', '2025-09-14', '06:30', 'Scheduled'),
	(17, 3, 9, '2025-09-14', '10:00', '2025-09-15', '22:00', 'On Time'),
	(18, 3, 9, '2025-09-15', '10:00', '2025-09-16', '22:00', 'Scheduled'),
	(19, 4, 10, '2025-09-10', '06:00', '2025-09-10', '07:00', 'On Time'),
	(20, 4, 10, '2025-09-11', '06:00', '2025-09-11', '07:00', 'Scheduled'),
	(21, 4, 11, '2025-09-12', '09:00', '2025-09-12', '10:30', 'On Time'),
	(22, 4, 11, '2025-09-13', '09:00', '2025-09-13', '10:30', 'Scheduled'),
	(23, 4, 12, '2025-09-14', '20:00', '2025-09-15', '13:00', 'On Time'),
	(24, 4, 12, '2025-09-15', '20:00', '2025-09-16', '13:00', 'Scheduled'),
	(25, 5, 13, '2025-09-10', '12:00', '2025-09-10', '18:00', 'On Time'),
	(26, 5, 13, '2025-09-11', '12:00', '2025-09-11', '18:00', 'Scheduled'),
	(27, 5, 14, '2025-09-12', '10:00', '2025-09-12', '18:00', 'On Time'),
	(28, 5, 14, '2025-09-13', '10:00', '2025-09-13', '18:00', 'Scheduled'),
	(29, 5, 15, '2025-09-14', '22:00', '2025-09-15', '03:00', 'On Time'),
	(30, 5, 15, '2025-09-15', '22:00', '2025-09-16', '03:00', 'Scheduled'),
	(31, 6, 16, '2025-09-10', '08:00', '2025-09-10', '13:00', 'On Time'),
	(32, 6, 16, '2025-09-11', '08:00', '2025-09-11', '13:00', 'Scheduled'),
	(33, 6, 17, '2025-09-12', '18:00', '2025-09-13', '04:00', 'On Time'),
	(34, 6, 17, '2025-09-13', '18:00', '2025-09-14', '04:00', 'Scheduled'),
	(35, 6, 18, '2025-09-14', '02:00', '2025-09-14', '09:00', 'On Time'),
	(36, 6, 18, '2025-09-15', '02:00', '2025-09-15', '09:00', 'Scheduled'),
	(37, 7, 19, '2025-09-10', '07:00', '2025-09-10', '07:45', 'On Time'),
	(38, 7, 19, '2025-09-11', '07:00', '2025-09-11', '07:45', 'Scheduled'),
	(39, 7, 20, '2025-09-12', '15:00', '2025-09-12', '21:00', 'On Time'),
	(40, 7, 20, '2025-09-13', '15:00', '2025-09-13', '21:00', 'Scheduled'),
	(41, 7, 21, '2025-09-14', '22:00', '2025-09-15', '12:00', 'On Time'),
	(42, 7, 21, '2025-09-15', '22:00', '2025-09-16', '12:00', 'Scheduled'),
	(43, 8, 22, '2025-09-10', '16:00', '2025-09-11', '07:00', 'On Time'),
	(44, 8, 22, '2025-09-11', '16:00', '2025-09-12', '07:00', 'Scheduled'),
	(45, 8, 23, '2025-09-12', '14:00', '2025-09-12', '18:00', 'On Time'),
	(46, 8, 23, '2025-09-13', '14:00', '2025-09-13', '18:00', 'Scheduled'),
	(47, 8, 24, '2025-09-14', '06:00', '2025-09-14', '12:00', 'On Time'),
	(48, 8, 24, '2025-09-15', '06:00', '2025-09-15', '12:00', 'Scheduled'),
	(49, 9, 25, '2025-09-10', '10:00', '2025-09-10', '20:00', 'On Time'),
	(50, 9, 25, '2025-09-11', '10:00', '2025-09-11', '20:00', 'Scheduled'),
	(51, 9, 26, '2025-09-12', '11:00', '2025-09-12', '19:00', 'On Time'),
	(52, 9, 26, '2025-09-13', '11:00', '2025-09-13', '19:00', 'Scheduled'),
	(53, 9, 27, '2025-09-14', '12:00', '2025-09-14', '22:00', 'On Time'),
	(54, 9, 27, '2025-09-15', '12:00', '2025-09-15', '22:00', 'Scheduled'),
	(55, 10, 28, '2025-09-10', '20:00', '2025-09-11', '04:00', 'On Time'),
	(56, 10, 28, '2025-09-11', '20:00', '2025-09-12', '04:00', 'Scheduled'),
	(57, 10, 29, '2025-09-12', '21:00', '2025-09-13', '03:30', 'On Time'),
	(58, 10, 29, '2025-09-13', '21:00', '2025-09-14', '03:30', 'Scheduled'),
	(59, 10, 30, '2025-09-14', '22:00', '2025-09-15', '08:00', 'On Time'),
	(60, 10, 30, '2025-09-15', '22:00', '2025-09-16', '08:00', 'Scheduled');

-- Dumping structure for table amadeus.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `role` enum('user','admin','staff') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table amadeus.users: ~1 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
	(4, 'admin', '$2y$10$qY9CZtq50aKpdmd1ZU7stOgycTUprbSKPOqSupqm0a2iKUjadTs3.', 'admin');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
