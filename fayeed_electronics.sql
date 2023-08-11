-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 11, 2023 at 04:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fayeed_electronics`
--
CREATE DATABASE IF NOT EXISTS `fayeed_electronics` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fayeed_electronics`;

-- --------------------------------------------------------

--
-- Table structure for table `assembly`
--
-- Creation: Jul 29, 2023 at 09:31 PM
-- Last update: Aug 01, 2023 at 11:27 PM
--

DROP TABLE IF EXISTS `assembly`;
CREATE TABLE IF NOT EXISTS `assembly` (
  `assemblyID` int(11) NOT NULL,
  `inventoryId` int(11) NOT NULL,
  `branchID` int(11) NOT NULL,
  `usersID` int(11) NOT NULL,
  `assemblyName` varchar(50) NOT NULL,
  `assemblyStatus` varchar(30) DEFAULT 'Standby',
  `assemblyQuatty` int(11) NOT NULL,
  `editor` int(11) DEFAULT 0,
  `added` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`assemblyID`,`inventoryId`,`branchID`,`usersID`),
  KEY `fkassembly` (`inventoryId`),
  KEY `fkassembly1` (`branchID`),
  KEY `fkassembly2` (`usersID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `assembly`
--
DROP TRIGGER IF EXISTS `update_assembly`;
DELIMITER $$
CREATE TRIGGER `update_assembly` BEFORE UPDATE ON `assembly` FOR EACH ROW BEGIN
  SET NEW.updated = CURRENT_TIMESTAMP;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `assembly_inventory`
--
-- Creation: Jul 29, 2023 at 09:31 PM
-- Last update: Aug 01, 2023 at 11:25 PM
--

DROP TABLE IF EXISTS `assembly_inventory`;
CREATE TABLE IF NOT EXISTS `assembly_inventory` (
  `assembly_inventoryID` int(11) NOT NULL,
  `assemblyID` int(11) NOT NULL,
  `inventory_list` int(11) NOT NULL,
  `inventory_qty` int(11) NOT NULL,
  PRIMARY KEY (`assembly_inventoryID`,`assemblyID`,`inventory_list`),
  KEY `fkassembly_inventory` (`assemblyID`),
  KEY `fkassembly_inventory1` (`inventory_list`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--
-- Creation: Jul 29, 2023 at 09:31 PM
-- Last update: Aug 01, 2023 at 11:31 PM
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `attendanceID` int(11) NOT NULL,
  `branchID` int(11) NOT NULL,
  `usersID` int(11) NOT NULL,
  `enrtypic` varchar(100) DEFAULT 'face.gif',
  `morning_in` varchar(50) DEFAULT '0',
  `morning_out` varchar(50) DEFAULT '0',
  `afternoon_in` varchar(50) DEFAULT '0',
  `afternoon_out` varchar(50) DEFAULT '0',
  `absent` varchar(50) NOT NULL,
  `dtrdate` varchar(50) NOT NULL,
  `confirm` int(1) DEFAULT 0,
  PRIMARY KEY (`attendanceID`,`branchID`,`usersID`),
  KEY `pkattendance` (`branchID`),
  KEY `pkattendance1` (`usersID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--
-- Creation: Jul 29, 2023 at 09:31 PM
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `branchID` int(11) NOT NULL,
  `usersID` int(11) NOT NULL,
  `Branch_Name` varchar(100) NOT NULL,
  `Branch_Address` varchar(100) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `Branch_Contact_number` varchar(20) NOT NULL,
  `DateCreated` varchar(50) NOT NULL,
  `branch_email` varchar(50) NOT NULL,
  `status` int(1) DEFAULT 2,
  PRIMARY KEY (`branchID`,`usersID`),
  KEY `fkbranches` (`usersID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `branch_staff`
--
-- Creation: Jul 29, 2023 at 09:31 PM
-- Last update: Aug 01, 2023 at 11:26 PM
--

DROP TABLE IF EXISTS `branch_staff`;
CREATE TABLE IF NOT EXISTS `branch_staff` (
  `staffID` int(11) NOT NULL,
  `branchID` int(11) NOT NULL,
  `usersID` int(11) NOT NULL,
  `assigndby` int(11) DEFAULT NULL,
  `roles` int(1) NOT NULL,
  PRIMARY KEY (`staffID`,`branchID`,`usersID`),
  KEY `fkstaff` (`branchID`),
  KEY `fkstaff2` (`usersID`),
  KEY `fkstaff3` (`assigndby`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--
-- Creation: Jul 29, 2023 at 09:31 PM
--

DROP TABLE IF EXISTS `checkout`;
CREATE TABLE IF NOT EXISTS `checkout` (
  `checkoutID` int(11) NOT NULL,
  `branchID` int(11) NOT NULL,
  `usersID` int(11) NOT NULL,
  `inventoryId` int(11) NOT NULL,
  `Transaction_code` varchar(100) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `cleint_name` varchar(100) NOT NULL,
  `cleint_number` int(11) NOT NULL,
  `amount_payment` decimal(10,2) NOT NULL,
  `mop` varchar(40) DEFAULT NULL,
  `date` varchar(30) NOT NULL,
  `time` varchar(30) NOT NULL,
  `month` varchar(30) NOT NULL,
  `day` varchar(30) NOT NULL,
  `year` varchar(30) NOT NULL,
  PRIMARY KEY (`checkoutID`,`branchID`,`usersID`,`inventoryId`),
  KEY `fkcheckout` (`branchID`),
  KEY `fkcheckout1` (`usersID`),
  KEY `fkcheckout2` (`inventoryId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--
-- Creation: Jul 29, 2023 at 09:31 PM
-- Last update: Aug 01, 2023 at 11:29 PM
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE IF NOT EXISTS `inventory` (
  `inventoryId` int(11) NOT NULL AUTO_INCREMENT,
  `usersID` int(11) NOT NULL,
  `branchID` int(11) NOT NULL,
  `inventory_picture` varchar(255) DEFAULT NULL,
  `inventoryName` varchar(50) NOT NULL,
  `inventoryDesc` varchar(100) NOT NULL,
  `inventoryQty` int(30) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`inventoryId`,`usersID`,`branchID`),
  KEY `fkinven1` (`usersID`),
  KEY `fkinven2` (`branchID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--
-- Creation: Jul 29, 2023 at 09:31 PM
-- Last update: Aug 01, 2023 at 11:29 PM
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `LogsID` int(11) NOT NULL,
  `usersID` int(11) NOT NULL,
  `branchID` int(11) NOT NULL,
  `Activity` varchar(300) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(30) NOT NULL,
  PRIMARY KEY (`LogsID`,`usersID`,`branchID`),
  KEY `fklogs` (`usersID`),
  KEY `fklogs1` (`branchID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--
-- Creation: Jul 29, 2023 at 09:31 PM
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `SettingsId` int(11) NOT NULL,
  `System_Name` varchar(255) NOT NULL,
  `System_Email` varchar(255) NOT NULL,
  `System_number` varchar(255) NOT NULL,
  `Smtp_email` varchar(255) NOT NULL,
  `Smatp_password` varchar(255) NOT NULL,
  `Smtp_Provider` varchar(255) NOT NULL,
  `Smtp_port` varchar(25) NOT NULL,
  `System_link` varchar(100) NOT NULL,
  `product_control` int(11) NOT NULL,
  `latetimein_morning` varchar(30) NOT NULL,
  `latetimein_afternoon` varchar(30) NOT NULL,
  PRIMARY KEY (`SettingsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`SettingsId`, `System_Name`, `System_Email`, `System_number`, `Smtp_email`, `Smatp_password`, `Smtp_Provider`, `Smtp_port`, `System_link`, `product_control`, `latetimein_morning`, `latetimein_afternoon`) VALUES
(1, 'Fayeed Electronics', 'teff.wong@gmail.com', '09550636794', 'teff.wong@gmail.com', 'cdpovrewmcixgpin', 'smtp.gmail.com', '465', '192.168.1.49', 10, '09:15', '13:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Jul 29, 2023 at 09:31 PM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `usersID` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `profile` varchar(255) DEFAULT 'user.png',
  `cover_photo` varchar(255) DEFAULT 'fayeedcover.png',
  `usersFirstName` varchar(50) NOT NULL,
  `usersLastName` varchar(50) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `Address` varchar(100) NOT NULL,
  `CellNumber` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(225) DEFAULT NULL,
  `code` int(11) NOT NULL,
  `status` text NOT NULL,
  `roles` int(1) DEFAULT 2,
  PRIMARY KEY (`usersID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assembly`
--
ALTER TABLE `assembly`
  ADD CONSTRAINT `fkassembly` FOREIGN KEY (`inventoryId`) REFERENCES `inventory` (`inventoryId`) ON DELETE CASCADE,
  ADD CONSTRAINT `fkassembly1` FOREIGN KEY (`branchID`) REFERENCES `branches` (`branchID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fkassembly2` FOREIGN KEY (`usersID`) REFERENCES `users` (`usersID`) ON DELETE CASCADE;

--
-- Constraints for table `assembly_inventory`
--
ALTER TABLE `assembly_inventory`
  ADD CONSTRAINT `fkassembly_inventory` FOREIGN KEY (`assemblyID`) REFERENCES `assembly` (`assemblyID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fkassembly_inventory1` FOREIGN KEY (`inventory_list`) REFERENCES `inventory` (`inventoryId`) ON DELETE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `pkattendance` FOREIGN KEY (`branchID`) REFERENCES `branches` (`branchID`) ON DELETE CASCADE,
  ADD CONSTRAINT `pkattendance1` FOREIGN KEY (`usersID`) REFERENCES `users` (`usersID`) ON DELETE CASCADE;

--
-- Constraints for table `branches`
--
ALTER TABLE `branches`
  ADD CONSTRAINT `fkbranches` FOREIGN KEY (`usersID`) REFERENCES `users` (`usersID`);

--
-- Constraints for table `branch_staff`
--
ALTER TABLE `branch_staff`
  ADD CONSTRAINT `fkstaff` FOREIGN KEY (`branchID`) REFERENCES `branches` (`branchID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fkstaff2` FOREIGN KEY (`usersID`) REFERENCES `users` (`usersID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fkstaff3` FOREIGN KEY (`assigndby`) REFERENCES `users` (`usersID`) ON DELETE CASCADE;

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `fkcheckout` FOREIGN KEY (`branchID`) REFERENCES `branches` (`branchID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fkcheckout1` FOREIGN KEY (`usersID`) REFERENCES `users` (`usersID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fkcheckout2` FOREIGN KEY (`inventoryId`) REFERENCES `inventory` (`inventoryId`) ON DELETE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `fkinven1` FOREIGN KEY (`usersID`) REFERENCES `users` (`usersID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fkinven2` FOREIGN KEY (`branchID`) REFERENCES `branches` (`branchID`) ON DELETE CASCADE;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `fklogs` FOREIGN KEY (`usersID`) REFERENCES `users` (`usersID`) ON DELETE CASCADE,
  ADD CONSTRAINT `fklogs1` FOREIGN KEY (`branchID`) REFERENCES `branches` (`branchID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
