--
-- Database: `jeoczvkk_thecochinpetshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `cancel` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `username`, `password`, `type`, `cancel`) VALUES
(1, 'admin', 'admin', 'Admin', '0');

-- --------------------------------------------------------

--
-- Table structure for table `breeds`
--

CREATE TABLE `breeds` (
  `Bid` int NOT NULL,
  `breedName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `breeds`
--

INSERT INTO `breeds` (`Bid`, `breedName`) VALUES
(3, 'AFRICAN LOVE BIRDS'),
(4, 'ALEXANDRINE PARROT'),
(5, 'AMERICAN BULLY');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int NOT NULL,
  `doctorname` varchar(100) NOT NULL,
  `phoneno` varchar(15) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'available',
  `cancel` varchar(100) NOT NULL DEFAULT '0',
  `submitdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `doctorname`, `phoneno`, `status`, `cancel`, `submitdate`) VALUES
(5, 'Dr.MIYADA YOOSUF', '', 'available', '0', '2024-07-05 10:55:39'),
(7, 'Dr.HILDA ALIAS', '', 'available', '0', '2024-10-27 07:25:51');

-- --------------------------------------------------------

--
-- Table structure for table `grooming`
--

CREATE TABLE `grooming` (
  `GId` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `amount` varchar(10) NOT NULL,
  `submittedBy` varchar(100) NOT NULL DEFAULT 'petshop',
  `submitteddate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cancel` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `grooming`
--

INSERT INTO `grooming` (`GId`, `name`, `amount`, `submittedBy`, `submitteddate`, `cancel`) VALUES
(2, 'DRY BATH ', '500', 'petshop', '2023-09-18 12:47:37', '0'),
(21, 'NAIL CUTTING', '50', 'petshop', '2023-09-18 12:47:37', '0');

-- --------------------------------------------------------

--
-- Table structure for table `laboratory`
--

CREATE TABLE `laboratory` (
  `Lid` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` TEXT DEFAULT NULL,
  `amount` varchar(10) NOT NULL,
  `submittedBy` varchar(100) NOT NULL,
  `submitteddate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cancel` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `laboratory`
--

INSERT INTO `laboratory` (`Lid`, `name`, `amount`, `submittedBy`, `submitteddate`, `cancel`) VALUES
(17, 'ALT/SGPT', '300', 'petshop', '2023-09-15 08:09:13', '0'),
(22, 'CBC', '400', 'petshop', '2023-09-15 08:11:07', '0');

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `other_charges` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `cost` varchar(100) NOT NULL,
  `cancel` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `medicines` (
  `Mid` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `stock_quantity` INT NOT NULL DEFAULT 0,
  `reorder_level` INT NOT NULL DEFAULT 10,
  `UnitPrice` varchar(100) NOT NULL,
  `taxExcluded_price` varchar(100) NOT NULL,
  `taxAmount` varchar(100) NOT NULL,
  `hsn` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `taxable` varchar(10) NOT NULL DEFAULT 'yes',
  `Itax` varchar(10) NOT NULL,
  `cess` varchar(10) NOT NULL,
  `submittedby` varchar(100) NOT NULL,
  `submitteddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(100) NOT NULL DEFAULT 'available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `RegID` int NOT NULL,
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
  `dt` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surgery`
--

CREATE TABLE `surgery` (
  `surgeryID` int NOT NULL,
  `surName` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `surAmount` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `submitBy` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `submitDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cancel` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `surgery`
--

INSERT INTO `surgery` (`surgeryID`, `surName`, `surAmount`, `submitBy`, `submitDate`, `cancel`) VALUES
(1, 'Leg Surgery', '2000', 'petshop', '2023-10-30 08:53:42', '0'),
(3, 'HERNIA- DOG ', '10000', 'petshop', '2023-10-30 11:51:10', '0');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination`
--

CREATE TABLE `vaccination` (
  `VId` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `amount` varchar(10) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `duration` varchar(10) NOT NULL,
  `submittedBy` varchar(100) NOT NULL,
  `submitteddate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cancel` varchar(10) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vaccination`
--

INSERT INTO `vaccination` (`VId`, `name`, `amount`, `type`, `duration`, `submittedBy`, `submitteddate`, `cancel`) VALUES
(1, 'PUPPY DP', '800', NULL, '21', 'petshop', '2023-08-17 00:00:00', '0'),
(2, 'MCV1', '800', NULL, '21', 'petshop', '2023-08-17 00:00:00', '0');

--
-- AUTO_INCREMENT for dumped tables
--

ALTER TABLE `other_charges`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `admin_user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
ALTER TABLE `breeds`
  MODIFY `Bid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=145;
ALTER TABLE `doctors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
ALTER TABLE `grooming`
  MODIFY `GId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
ALTER TABLE `laboratory`
  MODIFY `Lid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
ALTER TABLE `medicines`
  MODIFY `Mid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1042;
ALTER TABLE `registration`
  MODIFY `RegID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12145;
ALTER TABLE `surgery`
  MODIFY `surgeryID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
ALTER TABLE `vaccination`
  MODIFY `VId` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
