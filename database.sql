-- Users Table: Stores login credentials for all staff
CREATE TABLE `users` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('Admin', 'Front Desk', 'Doctor', 'Lab', 'Pharmacy', 'Groomer') NOT NULL,
  `staff_id` INT,
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
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Owners Table: Stores information about pet owners
CREATE TABLE `owners` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) UNIQUE,
  `phone` VARCHAR(20),
  `address` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Pets Table: Stores information about pets
CREATE TABLE `pets` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `owner_id` INT,
  `name` VARCHAR(100) NOT NULL,
  `breed` VARCHAR(100),
  `age` INT,
  `gender` ENUM('Male', 'Female'),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`owner_id`) REFERENCES `owners`(`id`) ON DELETE SET NULL
);

-- Medicines Table
CREATE TABLE `medicines` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `stock_quantity` INT NOT NULL DEFAULT 0,
  `reorder_level` INT NOT NULL DEFAULT 10,
  `price` DECIMAL(10, 2) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Lab Tests Table
CREATE TABLE `lab_tests` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `cost` DECIMAL(10, 2) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Grooming Services Table
CREATE TABLE `grooming_services` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` TEXT,
  `cost` DECIMAL(10, 2) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Vaccinations Table
CREATE TABLE `vaccinations` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `details` TEXT,
  `cost` DECIMAL(10, 2) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Other Charges Table
CREATE TABLE `other_charges` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `cost` DECIMAL(10, 2) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Consultations Table
CREATE TABLE `consultations` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `pet_id` INT NOT NULL,
  `doctor_id` INT NOT NULL,
  `consultation_date` DATE NOT NULL,
  `diagnosis` TEXT,
  `notes` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`pet_id`) REFERENCES `pets`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`doctor_id`) REFERENCES `staff`(`id`)
);

-- Prescriptions Table (Medicines prescribed in a consultation)
CREATE TABLE `prescriptions` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `consultation_id` INT NOT NULL,
  `medicine_id` INT NOT NULL,
  `dosage` VARCHAR(100),
  `quantity` INT NOT NULL,
  `status` ENUM('Prescribed', 'Dispensed') DEFAULT 'Prescribed',
  FOREIGN KEY (`consultation_id`) REFERENCES `consultations`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`medicine_id`) REFERENCES `medicines`(`id`)
);

-- Prescribed Lab Tests Table
CREATE TABLE `prescribed_lab_tests` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `consultation_id` INT NOT NULL,
  `lab_test_id` INT NOT NULL,
  `results` TEXT,
  `status` ENUM('Pending', 'Completed') DEFAULT 'Pending',
  FOREIGN KEY (`consultation_id`) REFERENCES `consultations`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`lab_test_id`) REFERENCES `lab_tests`(`id`)
);

-- Administered Vaccinations Table
CREATE TABLE `administered_vaccinations` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `pet_id` INT NOT NULL,
  `vaccination_id` INT NOT NULL,
  `date_administered` DATE NOT NULL,
  `next_due_date` DATE,
  `notes` TEXT,
  FOREIGN KEY (`pet_id`) REFERENCES `pets`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`vaccination_id`) REFERENCES `vaccinations`(`id`)
);

-- Billing and Payments Table
CREATE TABLE `billing` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `owner_id` INT NOT NULL,
  `consultation_id` INT,
  `total_amount` DECIMAL(10, 2) NOT NULL,
  `payment_status` ENUM('Paid', 'Unpaid', 'Partial') DEFAULT 'Unpaid',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`owner_id`) REFERENCES `owners`(`id`),
  FOREIGN KEY (`consultation_id`) REFERENCES `consultations`(`id`)
);

CREATE TABLE `payments` (
    `id` INT PRIMARY KEY AUTO_INCREMENT,
    `billing_id` INT NOT NULL,
    `amount_paid` DECIMAL(10, 2) NOT NULL,
    `payment_method` ENUM('Cash', 'Card', 'GPay') NOT NULL,
    `payment_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`billing_id`) REFERENCES `billing`(`id`) ON DELETE CASCADE
);

-- Today's Collection Table
CREATE TABLE `todays_collection` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `date` DATE NOT NULL,
  `amount` DECIMAL(10, 2) NOT NULL,
  UNIQUE (`date`)
);
