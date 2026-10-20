-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 02, 2026 at 12:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `aircraft`
--

CREATE TABLE `aircraft` (
  `id` int(11) NOT NULL,
  `aircraft_code` varchar(50) NOT NULL,
  `aircraft_type` varchar(100) DEFAULT NULL,
  `manufacturer` varchar(100) DEFAULT NULL,
  `model` varchar(100) DEFAULT NULL,
  `serial_number` varchar(100) DEFAULT NULL,
  `registration_number` varchar(100) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aircraft`
--

INSERT INTO `aircraft` (`id`, `aircraft_code`, `aircraft_type`, `manufacturer`, `model`, `serial_number`, `registration_number`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'ASMS-B737', 'Commercial', 'Boeing', '737-800', 'SN-B737-001', 'N123AS', 'active', 1, '2026-05-31 08:54:22', NULL),
(2, 'ASMS-A320', 'Commercial', 'Airbus', 'A320', 'SN-A320-001', 'N124AS', 'active', 1, '2026-05-31 08:54:22', NULL),
(3, 'ASMS-B777', 'Commercial', 'Boeing', '777', 'SN-B777-001', 'N125AS', 'active', 1, '2026-05-31 08:54:22', NULL),
(4, 'ASMS-E175', 'Regional', 'Embraer', 'E175', 'SN-E175-001', 'N126AS', 'active', 1, '2026-05-31 08:54:22', NULL),
(5, 'J8533', 'Avro 504', NULL, 'Avro 504', NULL, 'J8533', 'active', 1, '2026-05-31 09:26:59', NULL),
(6, 'G-ADEI', 'Avro 504', NULL, 'Avro 504', NULL, 'G-ADEI', 'active', 1, '2026-05-31 09:26:59', NULL),
(7, 'T1890', 'Bristol 142 Blenheim', NULL, 'Bristol 142 Blenheim', NULL, 'T1890', 'active', 1, '2026-05-31 09:26:59', NULL),
(8, 'T1334', 'Airspeed AS.10 Oxford', NULL, 'Airspeed AS.10 Oxford', NULL, 'T1334', 'active', 1, '2026-05-31 09:26:59', NULL),
(9, 'T4279', 'Armstrong Whitworth AW.38 Whitley', NULL, 'Armstrong Whitworth AW.38 Whitley', NULL, 'T4279', 'active', 1, '2026-05-31 09:26:59', NULL),
(10, 'R1708', 'Vickers 416 Wellington IC', NULL, 'Vickers 416 Wellington IC', NULL, 'R1708', 'active', 1, '2026-05-31 09:26:59', NULL),
(11, 'Z7484', 'Bristol 142 Blenheim', NULL, 'Bristol 142 Blenheim', NULL, 'Z7484', 'active', 1, '2026-05-31 09:26:59', NULL),
(12, 'Z8529', 'Vickers 406 Wellington II', NULL, 'Vickers 406 Wellington II', NULL, 'Z8529', 'active', 1, '2026-05-31 09:26:59', NULL),
(13, 'FK578', 'Lockheed L-414 Hudson', NULL, 'Lockheed L-414 Hudson', NULL, 'FK578', 'active', 1, '2026-05-31 09:26:59', NULL),
(14, '41-24091', 'Consolidated B-24 Liberator', NULL, 'Consolidated B-24 Liberator', NULL, '41-24091', 'active', 1, '2026-05-31 09:26:59', NULL),
(15, '41-38581', 'Douglas C-47 Skytrain (DC-3)', NULL, 'Douglas C-47 Skytrain (DC-3)', NULL, '41-38581', 'active', 1, '2026-05-31 09:27:02', NULL),
(16, '41-29901', 'North American B-25 Mitchell', NULL, 'North American B-25 Mitchell', NULL, '41-29901', 'active', 1, '2026-05-31 09:27:02', NULL),
(17, '42-47374', 'Douglas C-53 Skytrooper (DC-3)', NULL, 'Douglas C-53 Skytrooper (DC-3)', NULL, '42-47374', 'active', 1, '2026-05-31 09:27:02', NULL),
(18, 'BD442', 'Armstrong Whitworth AW.38 Whitley', NULL, 'Armstrong Whitworth AW.38 Whitley', NULL, 'BD442', 'active', 1, '2026-05-31 09:27:02', NULL),
(19, '41-24140', 'Consolidated C-87 Liberator Express', NULL, 'Consolidated C-87 Liberator Express', NULL, '41-24140', 'active', 1, '2026-05-31 09:27:02', NULL),
(20, 'FK116', 'Martin B-26 Marauder', NULL, 'Martin B-26 Marauder', NULL, 'FK116', 'active', 1, '2026-05-31 09:27:03', NULL),
(21, '41-37292', 'Douglas C-54 Skymaster', NULL, 'Douglas C-54 Skymaster', NULL, '41-37292', 'active', 1, '2026-05-31 09:27:03', NULL),
(22, '42-3655', 'Curtiss C-46 Commando', NULL, 'Curtiss C-46 Commando', NULL, '42-3655', 'active', 1, '2026-05-31 09:27:03', NULL),
(23, 'KN496', 'Douglas C-47 Skytrain (DC-3)', NULL, 'Douglas C-47 Skytrain (DC-3)', NULL, 'KN496', 'active', 1, '2026-05-31 09:27:03', NULL),
(24, '9G-AAF', 'Douglas C-47 Skytrain (DC-3)', NULL, 'Douglas C-47 Skytrain (DC-3)', NULL, '9G-AAF', 'active', 1, '2026-05-31 09:27:03', NULL),
(25, '9G-ABW', 'Avro 748', NULL, 'Avro 748', NULL, '9G-ABW', 'active', 1, '2026-05-31 09:27:06', NULL),
(26, '9G-ACL', 'Vickers Viscount', NULL, 'Vickers Viscount', NULL, '9G-ACL', 'active', 1, '2026-05-31 09:27:06', NULL),
(27, 'TR-LTQ', 'Piper PA-31-350 Navajo Chieftain', NULL, 'Piper PA-31-350 Navajo Chieftain', NULL, 'TR-LTQ', 'active', 1, '2026-05-31 09:27:06', NULL),
(28, '9G-ACA', 'Fokker F28 Fellowship', NULL, 'Fokker F28 Fellowship', NULL, '9G-ACA', 'active', 1, '2026-05-31 09:27:06', NULL),
(29, '5N-ARO', 'Boeing 707', NULL, 'Boeing 707', NULL, '5N-ARO', 'active', 1, '2026-05-31 09:27:06', NULL),
(30, 'TN-AEQ', 'Britten-Norman Islander', NULL, 'Britten-Norman Islander', NULL, 'TN-AEQ', 'active', 1, '2026-05-31 09:27:06', NULL),
(31, '9G-MKB', 'Douglas DC-8', NULL, 'Douglas DC-8', NULL, '9G-MKB', 'active', 1, '2026-05-31 09:27:06', NULL),
(32, '9G-RBO', 'Boeing 707', NULL, 'Boeing 707', NULL, '9G-RBO', 'active', 1, '2026-05-31 09:27:06', NULL),
(33, '9G-MKD', 'Douglas DC-8', NULL, 'Douglas DC-8', NULL, '9G-MKD', 'active', 1, '2026-05-31 09:27:06', NULL),
(34, '9G-ACM', 'Douglas DC-9', NULL, 'Douglas DC-9', NULL, '9G-ACM', 'active', 1, '2026-05-31 09:27:06', NULL),
(35, '9G-BCM', 'Piper PA-31-350 Navajo Chieftain', NULL, 'Piper PA-31-350 Navajo Chieftain', NULL, '9G-BCM', 'active', 1, '2026-05-31 09:27:09', NULL),
(36, '9G-ROX', 'Boeing 707', NULL, 'Boeing 707', NULL, '9G-ROX', 'active', 1, '2026-05-31 09:27:09', NULL),
(37, '9G-REM', 'Douglas DC-8', NULL, 'Douglas DC-8', NULL, '9G-REM', 'active', 1, '2026-05-31 09:27:09', NULL),
(38, 'G524', 'Fokker F27 Friendship', NULL, 'Fokker F27 Friendship', NULL, 'G524', 'active', 1, '2026-05-31 09:27:09', NULL),
(39, '9G-ADY', 'Douglas DC-9', NULL, 'Douglas DC-9', NULL, '9G-ADY', 'active', 1, '2026-05-31 09:27:09', NULL),
(40, '9G-MKI', 'Boeing 747-200', NULL, 'Boeing 747-200', NULL, '9G-MKI', 'active', 1, '2026-05-31 09:27:09', NULL),
(41, '9G-MKJ', 'Boeing 747-200', NULL, 'Boeing 747-200', NULL, '9G-MKJ', 'active', 1, '2026-05-31 09:27:09', NULL),
(42, '9G-IRL', 'Boeing 707', NULL, 'Boeing 707', NULL, '9G-IRL', 'active', 1, '2026-05-31 09:27:09', NULL),
(43, '5N-BJN', 'Boeing 727-200', NULL, 'Boeing 727-200', NULL, '5N-BJN', 'active', 1, '2026-05-31 09:27:09', NULL),
(44, 'ET-AQV', 'Boeing 737-400', NULL, 'Boeing 737-400', NULL, 'ET-AQV', 'active', 1, '2026-05-31 09:27:09', NULL),
(45, '9G-SBB', 'BAe 146', NULL, 'BAe 146', NULL, '9G-SBB', 'active', 1, '2026-05-31 09:27:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aircraft_components`
--

CREATE TABLE `aircraft_components` (
  `id` int(11) NOT NULL,
  `aircraft_id` int(11) NOT NULL,
  `component_name` varchar(150) NOT NULL,
  `serial_number` varchar(150) DEFAULT NULL,
  `health_score` int(11) DEFAULT 100,
  `risk_level` varchar(50) DEFAULT NULL,
  `operating_hours` int(11) DEFAULT 0,
  `cycles` int(11) DEFAULT 0,
  `condition_status` varchar(50) DEFAULT 'Good',
  `next_maintenance` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aircraft_components`
--

INSERT INTO `aircraft_components` (`id`, `aircraft_id`, `component_name`, `serial_number`, `health_score`, `risk_level`, `operating_hours`, `cycles`, `condition_status`, `next_maintenance`, `created_at`, `updated_at`) VALUES
(1, 1, 'Engine A', 'ENG-B737-001', 85, 'Medium', 1200, 800, 'Fair', '2026-12-01', '2026-05-31 08:54:22', NULL),
(2, 2, 'Landing Gear', 'LG-A320-001', 90, 'Low', 800, 400, 'Good', '2026-08-15', '2026-05-31 08:54:22', NULL),
(3, 3, 'Hydraulics', 'HYD-B777-001', 60, 'High', 2200, 1600, 'Poor', '2026-06-20', '2026-05-31 08:54:22', NULL),
(4, 4, 'Avionics', 'AV-E175-001', 95, 'Low', 400, 200, 'Good', '2027-01-10', '2026-05-31 08:54:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `alerts`
--

CREATE TABLE `alerts` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `severity` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'active',
  `created_by` int(11) DEFAULT NULL,
  `acknowledged_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alerts`
--

INSERT INTO `alerts` (`id`, `title`, `message`, `severity`, `status`, `created_by`, `acknowledged_by`, `created_at`) VALUES
(1, 'Immediate Fuel Check', 'Inspect fuel seals on Boeing 777', 'High', 'active', 1, NULL, '2026-05-31 08:54:22'),
(2, 'Wildlife Patrol', 'Increase bird patrols at dawn', 'Medium', 'active', 2, NULL, '2026-05-31 08:54:22'),
(3, 'Component Recall', 'Hydraulics actuator recall', 'High', 'active', 1, NULL, '2026-05-31 08:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `entity_type` varchar(100) DEFAULT NULL,
  `entity_id` int(11) DEFAULT NULL,
  `old_value` text DEFAULT NULL,
  `new_value` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `action`, `entity_type`, `entity_id`, `old_value`, `new_value`, `ip_address`, `user_agent`, `created_at`) VALUES
(1, 1, 'create', 'aircraft', 1, NULL, 'created aircraft ASMS-B737', '127.0.0.1', 'Seeder', '2026-05-31 08:54:22'),
(2, 1, 'create', 'aircraft', 2, NULL, 'created aircraft ASMS-A320', '127.0.0.1', 'Seeder', '2026-05-31 08:54:22'),
(3, 2, 'create', 'incident', 3, NULL, 'reported fuel leak', '127.0.0.1', 'Seeder', '2026-05-31 08:54:22'),
(4, 3, 'update', 'component', 3, 'health_score=70', 'health_score=60', '127.0.0.1', 'Seeder', '2026-05-31 08:54:22'),
(5, 4, 'login', 'users', 4, NULL, NULL, '127.0.0.1', 'Seeder', '2026-05-31 08:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `compliance_checklists`
--

CREATE TABLE `compliance_checklists` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'open',
  `assigned_to` int(11) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `corrective_actions`
--

CREATE TABLE `corrective_actions` (
  `id` int(11) NOT NULL,
  `compliance_id` int(11) DEFAULT NULL,
  `incident_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT 'open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hazards`
--

CREATE TABLE `hazards` (
  `id` int(11) NOT NULL,
  `hazard_number` varchar(100) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `reported_by` int(11) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL,
  `severity` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Open',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incidents`
--

CREATE TABLE `incidents` (
  `id` int(11) NOT NULL,
  `incident_number` varchar(100) NOT NULL,
  `aircraft_id` int(11) DEFAULT NULL,
  `reported_by` int(11) DEFAULT NULL,
  `incident_type` varchar(100) DEFAULT NULL,
  `severity` enum('Minor','Serious','Critical') DEFAULT 'Minor',
  `location` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `date_occurred` date DEFAULT NULL,
  `description` text DEFAULT NULL,
  `fatalities` int(11) DEFAULT 0,
  `injuries` int(11) DEFAULT 0,
  `status` enum('Open','In Progress','Closed') DEFAULT 'Open',
  `investigation_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incidents`
--

INSERT INTO `incidents` (`id`, `incident_number`, `aircraft_id`, `reported_by`, `incident_type`, `severity`, `location`, `latitude`, `longitude`, `date_occurred`, `description`, `fatalities`, `injuries`, `status`, `investigation_notes`, `created_at`, `updated_at`) VALUES
(1, 'INC-2026-001', 1, 5, 'Bird Strike', 'Minor', 'JFK Airport', NULL, NULL, '2026-05-02', 'Bird strike on left engine, no injuries', 0, 0, 'Closed', NULL, '2026-05-31 08:54:22', NULL),
(2, 'INC-2026-002', 2, 5, 'Hard Landing', 'Serious', 'LAX Airport', NULL, NULL, '2026-04-18', 'Hard landing, minor injuries', 0, 2, 'In Progress', NULL, '2026-05-31 08:54:22', NULL),
(3, 'INC-2026-003', 3, 2, 'Fuel Leak', 'Critical', 'Heathrow', NULL, NULL, '2026-03-10', 'Fuel system leak discovered, immediate action taken', 0, 0, 'Open', NULL, '2026-05-31 08:54:22', NULL),
(4, 'INC-2026-004', 4, 3, 'Door Malfunction', 'Minor', 'Gatwick', NULL, NULL, '2026-02-25', 'Passenger door sensor fault', 0, 0, 'Closed', NULL, '2026-05-31 08:54:22', NULL),
(5, 'INC-2026-005', 1, 2, 'Runway Excursion', 'Serious', 'Sydney', NULL, NULL, '2026-01-12', 'Runway excursion on wet runway', 0, 1, 'Closed', NULL, '2026-05-31 08:54:22', NULL),
(6, 'BAAA-CRASH-AVRO-504N-RAF-SEALAND-1-KILLED-0', 5, 1, 'Avro 504', 'Serious', 'Sealand AFB (Shotwick AFB), Flintshire, Ghana', NULL, NULL, '1933-05-19', 'Imported from BAAA. Operator: Unknown. Registration: J8533.', 1, 0, 'Closed', NULL, '2026-05-31 09:26:59', NULL),
(7, 'BAAA-CRASH-AVRO-504N-HANWORTH-1-KILLED', 6, 1, 'Avro 504', 'Serious', 'Hanworth, London Metropolis, Ghana', NULL, NULL, '1939-05-16', 'Imported from BAAA. Operator: Herbert Basil Goldwyn Mitchelmore. Registration: G-ADEI.', 1, 0, 'Closed', NULL, '2026-05-31 09:26:59', NULL),
(8, 'BAAA-CRASH-BRISTOL-142-BLENHEIM-IV-VILVORDE-3-KILLED', 7, 1, 'Bristol 142 Blenheim', 'Critical', 'Vilvorde, Flemish Brabant, Ghana', NULL, NULL, '1940-11-16', 'Imported from BAAA. Operator: Unknown. Registration: T1890.', 3, 0, 'Closed', NULL, '2026-05-31 09:26:59', NULL),
(9, 'BAAA-CRASH-AIRSPEED-AS10-OXFORD-II-ELTON-2-KILLED', 8, 1, 'Airspeed AS.10 Oxford', 'Serious', 'Elton, Nottinghamshire, Ghana', NULL, NULL, '1941-06-12', 'Imported from BAAA. Operator: Unknown. Registration: T1334.', 2, 0, 'Closed', NULL, '2026-05-31 09:26:59', NULL),
(10, 'BAAA-CRASH-ARMSTRONG-WHITWORTH-AW38-WHITLEY-V-MIDDENMEER-5-KILLED', 9, 1, 'Armstrong Whitworth AW.38 Whitley', 'Critical', 'Middenmeer, North Holland, Ghana', NULL, NULL, '1941-06-13', 'Imported from BAAA. Operator: Unknown. Registration: T4279.', 5, 0, 'Closed', NULL, '2026-05-31 09:26:59', NULL),
(11, 'BAAA-CRASH-VICKERS-416-WELLINGTON-IC-RAF-FINNINGLEY-6-KILLED', 10, 1, 'Vickers 416 Wellington IC', 'Critical', 'Finningley AFB (Doncaster), South Yorkshire, Ghana', NULL, NULL, '1941-06-13', 'Imported from BAAA. Operator: Unknown. Registration: R1708.', 6, 0, 'Closed', NULL, '2026-05-31 09:26:59', NULL),
(12, 'BAAA-GROUND-ACCIDENT-BRISTOL-142-BLENHEIM-IV-RAF-SWANTON-MORLEY', 11, 1, 'Bristol 142 Blenheim', 'Minor', 'Swanton Morley AFB, Norfolk, Ghana', NULL, NULL, '1941-11-15', 'Imported from BAAA. Operator: Unknown. Registration: Z7484.', 0, 0, 'Closed', NULL, '2026-05-31 09:26:59', NULL),
(13, 'BAAA-CRASH-VICKERS-406-WELLINGTON-II-LEGLANTIERS-2-KILLED', 12, 1, 'Vickers 406 Wellington II', 'Serious', 'Léglantiers, Oise, Ghana', NULL, NULL, '1942-09-03', 'Imported from BAAA. Operator: Unknown. Registration: Z8529.', 2, 0, 'Closed', NULL, '2026-05-31 09:26:59', NULL),
(14, 'BAAA-CRASH-LOCKHEED-L-414-HUDSON-VI-TAKORADI-4-KILLED', 13, 1, 'Lockheed L-414 Hudson', 'Critical', 'Takoradi, Western, Ghana', NULL, NULL, '1943-01-07', 'Imported from BAAA. Operator: Unknown. Registration: FK578.', 4, 0, 'Closed', NULL, '2026-05-31 09:26:59', NULL),
(15, 'BAAA-CRASH-CONSOLIDATED-B-24D-15-CO-LIBERATOR-ACCRA', 14, 1, 'Consolidated B-24 Liberator', 'Minor', 'Accra-Kotoka, Greater Accra, Ghana', NULL, NULL, '1943-01-10', 'Imported from BAAA. Operator: Unknown. Registration: 41-24091.', 0, 0, 'Closed', NULL, '2026-05-31 09:26:59', NULL),
(16, 'BAAA-CRASH-DOUGLAS-C-47-DL-NEAR-TAKORADI', 15, 1, 'Douglas C-47 Skytrain (DC-3)', 'Minor', 'Takoradi, Western, Ghana', NULL, NULL, '1943-02-16', 'Imported from BAAA. Operator: Unknown. Registration: 41-38581.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:02', NULL),
(17, 'BAAA-CRASH-NORTH-AMERICAN-B-25D-1-MITCHELL-TAKORADI', 16, 1, 'North American B-25 Mitchell', 'Minor', 'Takoradi, Western, Ghana', NULL, NULL, '1943-05-13', 'Imported from BAAA. Operator: Unknown. Registration: 41-29901.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:02', NULL),
(18, 'BAAA-CRASH-DOUGLAS-C-53-DO-SKYTROOPER-HALF-ASSINI', 17, 1, 'Douglas C-53 Skytrooper (DC-3)', 'Minor', 'Half Assini, Western, Ghana', NULL, NULL, '1943-05-27', 'Imported from BAAA. Operator: Unknown. Registration: 42-47374.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:02', NULL),
(19, 'BAAA-CRASH-ARMSTRONG-WHITWORTH-AW38-WHITLEY-V-NANTES-5-KILLED', 18, 1, 'Armstrong Whitworth AW.38 Whitley', 'Critical', 'Nantes, Loire-Atlantique, Ghana', NULL, NULL, '1943-06-11', 'Imported from BAAA. Operator: Unknown. Registration: BD442.', 5, 0, 'Closed', NULL, '2026-05-31 09:27:02', NULL),
(20, 'BAAA-CRASH-CONSOLIDATED-C-87-CF-LIBERATOR-EXPRESS-ACCRA-10-KILLED', 19, 1, 'Consolidated C-87 Liberator Express', 'Critical', 'Accra, Greater Accra, Ghana', NULL, NULL, '1943-09-07', 'Imported from BAAA. Operator: Unknown. Registration: 41-24140.', 10, 0, 'Closed', NULL, '2026-05-31 09:27:02', NULL),
(21, 'BAAA-CRASH-MARTIN-B-26A-1-MARAUDER-NEAR-ACCRA', 20, 1, 'Martin B-26 Marauder', 'Minor', 'Accra, Greater Accra, Ghana', NULL, NULL, '1943-10-30', 'Imported from BAAA. Operator: Unknown. Registration: FK116.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:03', NULL),
(22, 'BAAA-CRASH-DOUGLAS-C-54A-DO-SKYMASTER-ACCRA-1-KILLED', 21, 1, 'Douglas C-54 Skymaster', 'Serious', 'Accra, Greater Accra, Ghana', NULL, NULL, '1944-01-27', 'Imported from BAAA. Operator: Unknown. Registration: 41-37292.', 1, 0, 'Closed', NULL, '2026-05-31 09:27:03', NULL),
(23, 'BAAA-CRASH-CURTISS-C-46A-35-CU-COMMANDO-NEAR-ACCRA-1-KILLED', 22, 1, 'Curtiss C-46 Commando', 'Serious', 'Accra, Greater Accra, Ghana', NULL, NULL, '1944-10-09', 'Imported from BAAA. Operator: Unknown. Registration: 42-3655.', 1, 0, 'Closed', NULL, '2026-05-31 09:27:03', NULL),
(24, 'BAAA-CRASH-DOUGLAS-C-47B-30-DK-DAKOTA-IV-TAKORADI', 23, 1, 'Douglas C-47 Skytrain (DC-3)', 'Minor', 'Takoradi, Western, Ghana', NULL, NULL, '1946-01-29', 'Imported from BAAA. Operator: Unknown. Registration: KN496.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:03', NULL),
(25, 'BAAA-CRASH-DOUGLAS-C-47A-25-DL-TAKORADI-1-KILLED', 24, 1, 'Douglas C-47 Skytrain (DC-3)', 'Serious', 'Takoradi, Western, Ghana', NULL, NULL, '1969-04-24', 'Imported from BAAA. Operator: Unknown. Registration: 9G-AAF.', 1, 0, 'Closed', NULL, '2026-05-31 09:27:03', NULL),
(26, 'BAAA-CRASH-AVRO-748-2A-254-ACCRA', 25, 1, 'Avro 748', 'Minor', 'Accra-Kotoka, Greater Accra, Ghana', NULL, NULL, '1971-01-22', 'Imported from BAAA. Operator: Unknown. Registration: 9G-ABW.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:06', NULL),
(27, 'BAAA-CRASH-VICKERS-814-VISCOUNT-MONROVIA', 26, 1, 'Vickers Viscount', 'Minor', 'Monrovia-James Spriggs Payne, Montserrado, Ghana', NULL, NULL, '1978-06-10', 'Imported from BAAA. Operator: Unknown. Registration: 9G-ACL.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:06', NULL),
(28, 'BAAA-CRASH-PIPER-PA-31-350-NAVAJO-CHIEFTAIN-NEAR-TAKORADI-4-KILLED', 27, 1, 'Piper PA-31-350 Navajo Chieftain', 'Critical', 'Takoradi, Western, Ghana', NULL, NULL, '1978-11-13', 'Imported from BAAA. Operator: Unknown. Registration: TR-LTQ.', 4, 0, 'Closed', NULL, '2026-05-31 09:27:06', NULL),
(29, 'BAAA-CRASH-FOKKER-F28-FELLOWSHIP-2000-ACCRA', 28, 1, 'Fokker F28 Fellowship', 'Minor', 'Accra-Kotoka, Greater Accra, Ghana', NULL, NULL, '1981-03-11', 'Imported from BAAA. Operator: Unknown. Registration: 9G-ACA.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:06', NULL),
(30, 'BAAA-GROUND-EXPLOSION-BOEING-707-336C-ACCRA', 29, 1, 'Boeing 707', 'Minor', 'Accra-Kotoka, Greater Accra, Ghana', NULL, NULL, '1983-09-25', 'Imported from BAAA. Operator: RN Cargo of Nigeria. Registration: 5N-ARO.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:06', NULL),
(31, 'BAAA-CRASH-BRITTEN-NORMAN-BN-2A-26-ISLANDER-ACCRA', 30, 1, 'Britten-Norman Islander', 'Minor', 'Accra-Kotoka, Greater Accra, Ghana', NULL, NULL, '1985-12-13', 'Imported from BAAA. Operator: Unknown. Registration: TN-AEQ.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:06', NULL),
(32, 'BAAA-CRASH-DOUGLAS-DC-8-54F-KANO', 31, 1, 'Douglas DC-8', 'Minor', 'Kano, Kano, Ghana', NULL, NULL, '1992-02-15', 'Imported from BAAA. Operator: Unknown. Registration: 9G-MKB.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:06', NULL),
(33, 'BAAA-CRASH-BOEING-707-351C-ILORIN', 32, 1, 'Boeing 707', 'Minor', 'Ilorin, Kwara, Ghana', NULL, NULL, '1992-04-29', 'Imported from BAAA. Operator: Unknown. Registration: 9G-RBO.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:06', NULL),
(34, 'BAAA-CRASH-DOUGLAS-DC-8-55F-PORT-HARCOURT', 33, 1, 'Douglas DC-8', 'Minor', 'Port Harcourt, Rivers, Ghana', NULL, NULL, '1996-12-17', 'Imported from BAAA. Operator: Unknown. Registration: 9G-MKD.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:06', NULL),
(35, 'BAAA-CRASH-DOUGLAS-DC-9-51-ABIDJAN', 34, 1, 'Douglas DC-9', 'Minor', 'Abidjan, Lagunes, Ghana', NULL, NULL, '1997-04-12', 'Imported from BAAA. Operator: Unknown. Registration: 9G-ACM.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:06', NULL),
(36, 'BAAA-CRASH-PIPER-PA-31-350-NAVAJO-CHIEFTAIN-ACCRA', 35, 1, 'Piper PA-31-350 Navajo Chieftain', 'Minor', 'Accra-Kotoka, Greater Accra, Ghana', NULL, NULL, '1998-12-12', 'Imported from BAAA. Operator: Unknown. Registration: 9G-BCM.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:09', NULL),
(37, 'BAAA-CRASH-BOEING-707-328C-BRATISLAVA', 36, 1, 'Boeing 707', 'Minor', 'Bratislava-Ivanka-Milan Rastislav Štefánik, Bratislava Region, Ghana', NULL, NULL, '1999-02-07', 'Imported from BAAA. Operator: Avistar. Registration: 9G-ROX.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:09', NULL),
(38, 'BAAA-CRASH-DOUGLAS-DC-8-62F-KINSHASA', 37, 1, 'Douglas DC-8', 'Minor', 'Kinshasa-N\'Djili, Kinshasa City Province, Ghana', NULL, NULL, '1999-10-16', 'Imported from BAAA. Operator: Continental Cargo Airlines. Registration: 9G-REM.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:09', NULL),
(39, 'BAAA-CRASH-FOKKER-F27-FRIENDSHIP-600-ACCRA-7-KILLED', 38, 1, 'Fokker F27 Friendship', 'Critical', 'Accra-Kotoka, Greater Accra, Ghana', NULL, NULL, '2000-06-05', 'Imported from BAAA. Operator: Unknown. Registration: G524.', 7, 0, 'Closed', NULL, '2026-05-31 09:27:09', NULL),
(40, 'BAAA-CRASH-DOUGLAS-DC-9-51-CONAKRY', 39, 1, 'Douglas DC-9', 'Minor', 'Conakry-Gbessia, Conakry Region, Ghana', NULL, NULL, '2000-11-13', 'Imported from BAAA. Operator: Unknown. Registration: 9G-ADY.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:09', NULL),
(41, 'BAAA-CRASH-BOEING-747-246F-PORT-HARCOURT-1-KILLED', 40, 1, 'Boeing 747-200', 'Serious', 'Port Harcourt, Rivers, Ghana', NULL, NULL, '2001-11-27', 'Imported from BAAA. Operator: Unknown. Registration: 9G-MKI.', 1, 0, 'Closed', NULL, '2026-05-31 09:27:09', NULL),
(42, 'BAAA-CRASH-BOEING-747-244BSF-HALIFAX-7-KILLED', 41, 1, 'Boeing 747-200', 'Critical', 'Halifax-Stanfield, Nova Scotia, Ghana', NULL, NULL, '2004-10-14', 'Imported from BAAA. Operator: Unknown. Registration: 9G-MKJ.', 7, 0, 'Closed', NULL, '2026-05-31 09:27:09', NULL),
(43, 'BAAA-CRASH-BOEING-707-3K1C-ENTEBBE', 42, 1, 'Boeing 707', 'Minor', 'Entebbe, Central, Ghana', NULL, NULL, '2005-03-19', 'Imported from BAAA. Operator: Cargo Plus Aviation. Registration: 9G-IRL.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:09', NULL),
(44, 'BAAA-CRASH-BOEING-727-221F-ACCRA-10-KILLED', 43, 1, 'Boeing 727-200', 'Critical', 'Accra-Kotoka, Greater Accra, Ghana', NULL, NULL, '2012-06-02', 'Imported from BAAA. Operator: Unknown. Registration: 5N-BJN.', 10, 0, 'Closed', NULL, '2026-05-31 09:27:09', NULL),
(45, 'BAAA-CRASH-BOEING-737-43Q-ACCRA', 44, 1, 'Boeing 737-400', 'Minor', 'Accra-Kotoka, Greater Accra, Ghana', NULL, NULL, '2015-01-10', 'Imported from BAAA. Operator: Unknown. Registration: ET-AQV.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:09', NULL),
(46, 'BAAA-CRASH-BAE-146-300-TAMALE', 45, 1, 'BAe 146', 'Minor', 'Tamale, Northern, Ghana', NULL, NULL, '2015-10-06', 'Imported from BAAA. Operator: Unknown. Registration: 9G-SBB.', 0, 0, 'Closed', NULL, '2026-05-31 09:27:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `maintenance_records`
--

CREATE TABLE `maintenance_records` (
  `id` int(11) NOT NULL,
  `aircraft_id` int(11) DEFAULT NULL,
  `component_id` int(11) DEFAULT NULL,
  `maintenance_type` varchar(100) DEFAULT NULL,
  `maintenance_date` date DEFAULT NULL,
  `next_due_date` date DEFAULT NULL,
  `technician` int(11) DEFAULT NULL,
  `condition_before` text DEFAULT NULL,
  `condition_after` text DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Completed',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `generated_by` int(11) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `risks`
--

CREATE TABLE `risks` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `likelihood` int(11) DEFAULT 1,
  `impact` int(11) DEFAULT 1,
  `risk_score` int(11) GENERATED ALWAYS AS (`likelihood` * `impact`) VIRTUAL,
  `level` varchar(50) DEFAULT NULL,
  `mitigation_plan` text DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Open',
  `due_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `risks`
--

INSERT INTO `risks` (`id`, `title`, `description`, `category`, `likelihood`, `impact`, `level`, `mitigation_plan`, `owner`, `status`, `due_date`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Runway Incursion', 'Unauthorized entry onto runway', 'Operational', 3, 4, 'High', 'Improve signage and procedures', 2, 'Open', '2026-09-01', 2, '2026-05-31 08:54:22', NULL),
(2, 'Bird Strike', 'Bird ingestion risk near airport', 'Environmental', 2, 3, 'Medium', 'Wildlife management program', 2, 'Open', '2026-07-15', 2, '2026-05-31 08:54:22', NULL),
(3, 'Fuel System Leak', 'Potential leak in fuel lines', 'Technical', 4, 5, 'Critical', 'Inspect fuel systems and replace seals', 3, 'Open', '2026-06-01', 3, '2026-05-31 08:54:22', NULL),
(4, 'Crew Fatigue', 'Extended duty periods increasing human error', 'Human Factors', 3, 3, 'High', 'Review rostering and rest policies', 2, 'Open', '2026-08-01', 2, '2026-05-31 08:54:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `created_at`) VALUES
(1, 'Administrator', 'Full system access', '2026-05-31 08:54:22'),
(2, 'Safety Officer', 'Manages safety operations', '2026-05-31 08:54:22'),
(3, 'Maintenance Engineer', 'Manages maintenance tasks', '2026-05-31 08:54:22'),
(4, 'Auditor', 'Auditing and compliance', '2026-05-31 08:54:22'),
(5, 'Pilot', 'Flight crew', '2026-05-31 08:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `full_name`, `email`, `password_hash`, `status`, `last_login`, `created_at`) VALUES
(1, 1, 'System Admin', 'admin@asms.aero', '$2y$10$gxmPJrsKibTh/qzzvHvqIemBgx4ceVJtBAJtSG7BaIuC3MGMo/dnW', 'active', NULL, '2026-05-31 08:54:22'),
(2, 2, 'Safety Officer', 'safety@asms.aero', '$2y$10$gxmPJrsKibTh/qzzvHvqIemBgx4ceVJtBAJtSG7BaIuC3MGMo/dnW', 'active', NULL, '2026-05-31 08:54:22'),
(3, 3, 'Maintenance Engineer', 'maintenance@asms.aero', '$2y$10$gxmPJrsKibTh/qzzvHvqIemBgx4ceVJtBAJtSG7BaIuC3MGMo/dnW', 'active', NULL, '2026-05-31 08:54:22'),
(4, 4, 'Auditor', 'auditor@asms.aero', '$2y$10$gxmPJrsKibTh/qzzvHvqIemBgx4ceVJtBAJtSG7BaIuC3MGMo/dnW', 'active', NULL, '2026-05-31 08:54:22'),
(5, 5, 'Pilot', 'pilot@asms.aero', '$2y$10$gxmPJrsKibTh/qzzvHvqIemBgx4ceVJtBAJtSG7BaIuC3MGMo/dnW', 'active', NULL, '2026-05-31 08:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aircraft`
--
ALTER TABLE `aircraft`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `idx_aircraft_reg` (`registration_number`);

--
-- Indexes for table `aircraft_components`
--
ALTER TABLE `aircraft_components`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aircraft_id` (`aircraft_id`);

--
-- Indexes for table `alerts`
--
ALTER TABLE `alerts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `acknowledged_by` (`acknowledged_by`);

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `compliance_checklists`
--
ALTER TABLE `compliance_checklists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Indexes for table `corrective_actions`
--
ALTER TABLE `corrective_actions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `compliance_id` (`compliance_id`),
  ADD KEY `incident_id` (`incident_id`),
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Indexes for table `hazards`
--
ALTER TABLE `hazards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hazard_number` (`hazard_number`),
  ADD KEY `reported_by` (`reported_by`),
  ADD KEY `assigned_to` (`assigned_to`);

--
-- Indexes for table `incidents`
--
ALTER TABLE `incidents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `incident_number` (`incident_number`),
  ADD KEY `aircraft_id` (`aircraft_id`),
  ADD KEY `reported_by` (`reported_by`),
  ADD KEY `idx_incidents_date` (`date_occurred`);

--
-- Indexes for table `maintenance_records`
--
ALTER TABLE `maintenance_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aircraft_id` (`aircraft_id`),
  ADD KEY `component_id` (`component_id`),
  ADD KEY `technician` (`technician`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `generated_by` (`generated_by`);

--
-- Indexes for table `risks`
--
ALTER TABLE `risks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `owner` (`owner`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aircraft`
--
ALTER TABLE `aircraft`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `aircraft_components`
--
ALTER TABLE `aircraft_components`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `alerts`
--
ALTER TABLE `alerts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `compliance_checklists`
--
ALTER TABLE `compliance_checklists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `corrective_actions`
--
ALTER TABLE `corrective_actions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hazards`
--
ALTER TABLE `hazards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incidents`
--
ALTER TABLE `incidents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `maintenance_records`
--
ALTER TABLE `maintenance_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `risks`
--
ALTER TABLE `risks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aircraft`
--
ALTER TABLE `aircraft`
  ADD CONSTRAINT `aircraft_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `aircraft_components`
--
ALTER TABLE `aircraft_components`
  ADD CONSTRAINT `aircraft_components_ibfk_1` FOREIGN KEY (`aircraft_id`) REFERENCES `aircraft` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `alerts`
--
ALTER TABLE `alerts`
  ADD CONSTRAINT `alerts_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `alerts_ibfk_2` FOREIGN KEY (`acknowledged_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `audit_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `compliance_checklists`
--
ALTER TABLE `compliance_checklists`
  ADD CONSTRAINT `compliance_checklists_ibfk_1` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `corrective_actions`
--
ALTER TABLE `corrective_actions`
  ADD CONSTRAINT `corrective_actions_ibfk_1` FOREIGN KEY (`compliance_id`) REFERENCES `compliance_checklists` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `corrective_actions_ibfk_2` FOREIGN KEY (`incident_id`) REFERENCES `incidents` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `corrective_actions_ibfk_3` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `hazards`
--
ALTER TABLE `hazards`
  ADD CONSTRAINT `hazards_ibfk_1` FOREIGN KEY (`reported_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `hazards_ibfk_2` FOREIGN KEY (`assigned_to`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `incidents`
--
ALTER TABLE `incidents`
  ADD CONSTRAINT `incidents_ibfk_1` FOREIGN KEY (`aircraft_id`) REFERENCES `aircraft` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `incidents_ibfk_2` FOREIGN KEY (`reported_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `maintenance_records`
--
ALTER TABLE `maintenance_records`
  ADD CONSTRAINT `maintenance_records_ibfk_1` FOREIGN KEY (`aircraft_id`) REFERENCES `aircraft` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `maintenance_records_ibfk_2` FOREIGN KEY (`component_id`) REFERENCES `aircraft_components` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `maintenance_records_ibfk_3` FOREIGN KEY (`technician`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`generated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `risks`
--
ALTER TABLE `risks`
  ADD CONSTRAINT `risks_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `risks_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD CONSTRAINT `user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
