-- Registration Table as specified by the user
CREATE TABLE `registration` (
  `RegID` int NOT NULL AUTO_INCREMENT,
  `custType` varchar(100) NOT NULL DEFAULT 'regular',
  `RegDt` varchar(100) NOT NULL,
  `RegNo` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `Pettyp` varchar(100) NOT NULL,
  `petnam` varchar(100) NOT NULL,
  `petclr` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `petsex` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `petbred` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `year` varchar(10) NOT NULL,
  `month` varchar(10) NOT NULL,
  `gram` varchar(10) NOT NULL,
  `kg` varchar(10) NOT NULL,
  `petsp` varchar(100) NOT NULL,
  `doctor` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ownnam` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ownadd1` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ownadd2` varchar(100) DEFAULT NULL,
  `ownloc` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ownpin` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ownmob` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ownres` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `ownemail` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `Reports` tinyint(1) DEFAULT '0',
  `cancel` varchar(100) NOT NULL DEFAULT '0',
  `canceldoneby` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `dt` date DEFAULT NULL,
  PRIMARY KEY (`RegID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Users Table: Stores login credentials for all staff
CREATE TABLE `users` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('Admin', 'Front Desk', 'Doctor', 'Lab', 'Pharmacy', 'Groomer') NOT NULL,
  `staff_id` INT,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Staff Table: Stores information about staff members
CREATE TABLE `staff` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) UNIQUE,
  `phone` VARCHAR(20),
  `address` TEXT,
  `role` ENUM('Admin', 'Front Desk', 'Doctor', 'Lab', 'Pharmacy', 'Groomer') NOT NULL,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Medicines Table
CREATE TABLE `medicines` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `stock_quantity` INT NOT NULL DEFAULT 0,
  `reorder_level` INT NOT NULL DEFAULT 10,
  `price` DECIMAL(10, 2) NOT NULL,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Lab Tests Table
CREATE TABLE `lab_tests` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `cost` DECIMAL(10, 2) NOT NULL,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Grooming Services Table
CREATE TABLE `grooming_services` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `cost` DECIMAL(10, 2) NOT NULL,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Vaccinations Table
CREATE TABLE `vaccinations` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `details` TEXT,
  `cost` DECIMAL(10, 2) NOT NULL,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Other Charges Table
CREATE TABLE `other_charges` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `cost` DECIMAL(10, 2) NOT NULL,
  `status` ENUM('active', 'inactive') DEFAULT 'active',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ID Counters Table
CREATE TABLE `id_counters` (
  `id_type` VARCHAR(20) NOT NULL,
  `year` INT NOT NULL,
  `last_id` INT NOT NULL,
  PRIMARY KEY (`id_type`, `year`)
);

-- Initialize counters
INSERT INTO `id_counters` (`id_type`, `year`, `last_id`) VALUES ('RegNo', YEAR(CURDATE()), 1000);
INSERT INTO `id_counters` (`id_type`, `year`, `last_id`) VALUES ('BillId', 0, 1000);

-- Other tables from previous schema that might be needed later
-- (Consultations, Prescriptions, etc.)
-- These will be reviewed and possibly redesigned when implementing other modules.
-- For now, the focus is on the Admin module's master data.
