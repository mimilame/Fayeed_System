-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 02, 2023 at 01:37 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

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

-- --------------------------------------------------------

--
-- Table structure for table `assembly`
--
-- Creation: Jul 29, 2023 at 09:31 PM
-- Last update: Aug 01, 2023 at 11:27 PM
--

DROP TABLE IF EXISTS `assembly`;
CREATE TABLE `assembly` (
  `assemblyID` int(11) NOT NULL,
  `inventoryId` int(11) NOT NULL,
  `branchID` int(11) NOT NULL,
  `usersID` int(11) NOT NULL,
  `assemblyName` varchar(50) NOT NULL,
  `assemblyStatus` varchar(30) DEFAULT 'Standby',
  `assemblyQuatty` int(11) NOT NULL,
  `editor` int(11) DEFAULT 0,
  `added` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `assembly`:
--   `inventoryId`
--       `inventory` -> `inventoryId`
--   `branchID`
--       `branches` -> `branchID`
--   `usersID`
--       `users` -> `usersID`
--

--
-- Dumping data for table `assembly`
--

INSERT INTO `assembly` (`assemblyID`, `inventoryId`, `branchID`, `usersID`, `assemblyName`, `assemblyStatus`, `assemblyQuatty`, `editor`, `added`, `updated`) VALUES
(15, 38, 10, 43, 'Create Automatic tubig Machine', 'Finished', 100, 0, '2022-06-09 16:00:00', '2023-07-22 14:07:17'),
(16, 38, 10, 43, 'Create Automatic tubig Machine', 'Finished', 520, 0, '2023-07-19 17:51:55', '2023-07-22 14:02:39'),
(17, 38, 10, 43, 'Create Automatic tubig Machine', 'Finished', 100, 0, '2022-07-19 17:51:55', '2023-07-22 14:02:45'),
(18, 40, 10, 45, 'Create Automatic Tubig Machine', 'Finished', 3, 0, '2023-07-27 18:38:03', '2023-08-01 23:27:49'),
(19, 42, 10, 43, 'seatgw', 'Standby', 4, 0, '2023-07-31 09:00:40', '2023-07-31 09:00:40');

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
CREATE TABLE `assembly_inventory` (
  `assembly_inventoryID` int(11) NOT NULL,
  `assemblyID` int(11) NOT NULL,
  `inventory_list` int(11) NOT NULL,
  `inventory_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `assembly_inventory`:
--   `assemblyID`
--       `assembly` -> `assemblyID`
--   `inventory_list`
--       `inventory` -> `inventoryId`
--

--
-- Dumping data for table `assembly_inventory`
--

INSERT INTO `assembly_inventory` (`assembly_inventoryID`, `assemblyID`, `inventory_list`, `inventory_qty`) VALUES
(1, 15, 38, 1),
(2, 16, 38, 1),
(3, 17, 38, 1),
(4, 15, 40, 1),
(5, 16, 40, 1),
(6, 17, 40, 1),
(7, 15, 42, 1),
(8, 16, 42, 1),
(9, 17, 42, 1),
(10, 18, 43, 1),
(12, 18, 42, 3),
(13, 18, 38, 1),
(39, 18, 40, 1),
(40, 19, 38, 1),
(41, 19, 40, 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--
-- Creation: Jul 29, 2023 at 09:31 PM
-- Last update: Aug 01, 2023 at 11:31 PM
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE `attendance` (
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
  `confirm` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `attendance`:
--   `branchID`
--       `branches` -> `branchID`
--   `usersID`
--       `users` -> `usersID`
--

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceID`, `branchID`, `usersID`, `enrtypic`, `morning_in`, `morning_out`, `afternoon_in`, `afternoon_out`, `absent`, `dtrdate`, `confirm`) VALUES
(39, 11, 44, 'face.gif', 'Absent', 'Absent', '0', '0', '', 'June 16, 2021', 0),
(40, 11, 43, 'face.gif', '0', '0', 'Late : 1:27 pm', '0', '1', 'July 20, 2021', 0),
(41, 11, 13, 'face.gif', 'Absent', 'Absent', '0', '0', '', 'August 16, 2021', 0),
(42, 10, 43, 'face.gif', 'Absent', 'Absent', 'Absent', 'Absent', '1', 'July 12, 2022', 1),
(43, 10, 44, 'smartfusion (1).png', 'Absent', 'Absent', 'Late : 1:27 pm', '0', '', 'July 13, 2022', 1),
(44, 10, 44, 'smartfusion (1).png', 'Absent', 'Absent', 'Absent', 'Absent', '1', 'July 14, 2022', 1),
(45, 10, 44, 'smartfusion (1).png', 'Late : 10:27 am', 'Late : 1:00 pm', 'Late : 1:27 pm', '0', '', 'July 15, 2022', 1),
(46, 10, 16, 'smartfusion (1).png', 'Absent', 'Absent', 'Late : 1:27 pm', '0', '', 'July 15, 2022', 1),
(47, 11, 44, 'face.gif', 'Absent', 'Absent', '0', '0', '', 'July 15, 2023', 1),
(48, 11, 44, 'hourglass.gif', 'Absent', 'Absent', 'Absent', 'Absent', '1', 'July 16, 2023', 0),
(49, 11, 44, 'face.gif', 'Absent', 'Absent', '0', '0', '', 'August 16, 2023', 0),
(50, 11, 44, 'face.gif', 'Absent', 'Absent', '0', '0', '', 'July 16, 2022', 0),
(51, 11, 43, 'face.gif', 'Absent', 'Absent', '0', '0', '', 'July 19, 2023', 0),
(52, 11, 43, 'face.gif', '0', '0', 'Late : 1:27 pm', '0', '1', 'July 20, 2023', 0),
(53, 10, 16, 'face.gif', '0', '0', 'Late : 1:27 pm', '0', '1', 'July 20, 2023', 0),
(57, 10, 43, 'face.gif', 'Absent', 'Absent', 'Absent', 'Absent', '1', 'July 20, 2022', 1),
(58, 10, 44, 'smartfusion (1).png', 'Absent', 'Absent', 'Late : 1:27 pm', '0', '', 'July 13, 2022', 1),
(59, 10, 44, 'smartfusion (1).png', 'Absent', 'Absent', 'Absent', 'Absent', '1', 'July 14, 2022', 1),
(60, 10, 13, 'smartfusion (1).png', 'Late : 10:27 am', 'Late : 1:00 pm', 'Late : 1:27 pm', '0', '', 'July 15, 2022', 1),
(61, 10, 44, 'smartfusion (1).png', 'Absent', 'Absent', 'Late : 1:27 pm', '0', '', 'July 15, 2022', 1),
(62, 11, 44, 'face.gif', 'Absent', 'Absent', '0', '0', '', 'July 15, 2023', 1),
(63, 11, 44, 'hourglass.gif', 'Absent', 'Absent', 'Absent', 'Absent', '1', 'July 16, 2023', 0),
(66, 11, 43, 'face.gif', 'Absent', 'Absent', '0', '0', '', 'July 19, 2023', 0),
(68, 10, 43, 'face.gif', '0', '0', 'Late : 1:27 pm', '0', '1', 'July 20, 2023', 0),
(69, 10, 43, 'face.gif', 'Absent', 'Absent', '0', '0', '', 'July 22, 2023', 0),
(70, 10, 43, '9f998d5e71bbfe2e57772a1c506697d9.jpg', 'Absent', 'Absent', '0', '0', '', 'July 23, 2023', 0),
(71, 10, 43, 'face.gif', '0', '0', '0', '0', '', 'July 24, 2023', 0),
(72, 10, 45, 'doc.jpg', 'Late : 10:20 am', '10:20 am', '10:20 am', '10:20 am', '', 'July 24, 2023', 0),
(73, 10, 45, 'face.gif', 'Absent', 'Absent', '0', '0', '1', 'July 27, 2023', 0),
(74, 10, 43, 'face.gif', 'Absent', 'Absent', '0', '0', '1', 'July 27, 2023', 0),
(75, 10, 43, '7c51108bbddfdb55965d1e4755854d6a.jpg', '0', '0', '0', '0', '', 'July 28, 2023', 0),
(76, 10, 45, '7c51108bbddfdb55965d1e4755854d6a.jpg', '0', '0', '0', '0', '', 'July 28, 2023', 0),
(77, 10, 45, 'face.gif', '0', '0', '0', '0', '1', 'July 30, 2023', 0),
(78, 10, 43, 'face.gif', '0', '0', '0', '0', '1', 'July 30, 2023', 0),
(79, 10, 43, 'face.gif', 'Absent', 'Absent', '0', '0', '1', 'July 31, 2023', 0),
(80, 10, 45, 'face.gif', 'Absent', 'Absent', '0', '0', '1', 'July 31, 2023', 0),
(81, 10, 46, 'face.gif', 'Absent', 'Absent', '0', '0', '', 'July 31, 2023', 0),
(82, 10, 46, 'c6804422a6aaf92b3911cc329b67304f.jpg', '6:14 am', '0', '0', '0', '', 'August 1, 2023', 1),
(83, 10, 45, '96e325723df9868622e35559ace32635.gif', '8:00 am', '0', '0', '0', '', 'August 1, 2023', 1),
(84, 10, 43, '869f0930730b73e87623bfce19c424ec.jpg', '8:01 am', '8:17 am', '0', '0', '', 'August 1, 2023', 0),
(85, 10, 45, '310955300_413724110956765_4242116260943545102_n.jpg', '7:17 am', '0', '0', '0', '', 'August 2, 2023', 0),
(86, 10, 43, 'download.png', '0', '0', '0', '0', '', 'August 2, 2023', 0);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--
-- Creation: Jul 29, 2023 at 09:31 PM
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE `branches` (
  `branchID` int(11) NOT NULL,
  `usersID` int(11) NOT NULL,
  `Branch_Name` varchar(100) NOT NULL,
  `Branch_Address` varchar(100) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `Branch_Contact_number` varchar(20) NOT NULL,
  `DateCreated` varchar(50) NOT NULL,
  `branch_email` varchar(50) NOT NULL,
  `status` int(1) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `branches`:
--   `usersID`
--       `users` -> `usersID`
--

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branchID`, `usersID`, `Branch_Name`, `Branch_Address`, `city`, `Branch_Contact_number`, `DateCreated`, `branch_email`, `status`) VALUES
(10, 3, 'Fayeed Electronics Main Branch', 'tumaga tupperware bldg', 'Zamboanga City', '908087686', '2023-07-15', 'fernandoaragon117@yahoo.com', 2),
(11, 3, 'Fayeed Electronics Basilan', 'Basilan', 'Basilan', '090967823223', '2023-07-15', 'argonfernando453@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `branch_staff`
--
-- Creation: Jul 29, 2023 at 09:31 PM
-- Last update: Aug 01, 2023 at 11:26 PM
--

DROP TABLE IF EXISTS `branch_staff`;
CREATE TABLE `branch_staff` (
  `staffID` int(11) NOT NULL,
  `branchID` int(11) NOT NULL,
  `usersID` int(11) NOT NULL,
  `assigndby` int(11) DEFAULT NULL,
  `roles` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `branch_staff`:
--   `branchID`
--       `branches` -> `branchID`
--   `usersID`
--       `users` -> `usersID`
--   `assigndby`
--       `users` -> `usersID`
--

--
-- Dumping data for table `branch_staff`
--

INSERT INTO `branch_staff` (`staffID`, `branchID`, `usersID`, `assigndby`, `roles`) VALUES
(104, 11, 13, 3, 3),
(105, 11, 16, 3, 2),
(108, 11, 44, 3, 1),
(110, 10, 45, 3, 2),
(111, 10, 46, 3, 1),
(119, 10, 43, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--
-- Creation: Jul 29, 2023 at 09:31 PM
--

DROP TABLE IF EXISTS `checkout`;
CREATE TABLE `checkout` (
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
  `year` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `checkout`:
--   `branchID`
--       `branches` -> `branchID`
--   `usersID`
--       `users` -> `usersID`
--   `inventoryId`
--       `inventory` -> `inventoryId`
--

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`checkoutID`, `branchID`, `usersID`, `inventoryId`, `Transaction_code`, `quantity`, `cleint_name`, `cleint_number`, `amount_payment`, `mop`, `date`, `time`, `month`, `day`, `year`) VALUES
(4, 10, 44, 45, 'July605-164-984', 1, 'dsadsss', 935824568, '5000.00', 'BankTransfer', 'July 16, 2021', '1:50 pm', 'July', '16', '2021'),
(5, 11, 44, 46, 'July605-164-984', 1, 'dsadsss', 935824568, '25000.00', 'BankTransfer', 'July 16, 2021', '1:50 pm', 'July', '16', '2021'),
(6, 10, 44, 38, 'July477-593-441', 2, 'Atty Lawrence Escudero', 2147483647, '10000.00', 'Gcash', 'June 15, 2023', '1:47 pm', 'June', '15', '2023'),
(12, 11, 44, 46, 'July605-164-983', 4, 'dsadsss', 935824568, '80000.00', 'BankTransfer', 'July 16, 2022', '1:50 pm', 'July', '16', '2022'),
(13, 10, 43, 42, 'July502-186-638', 85, 'sample', 2147483647, '100000.00', 'Cash', 'July 23, 2023', '4:53 pm', 'July', '23', '2023'),
(14, 10, 43, 38, 'July838-564-435', 1, 'Steffi Wong', 2147483647, '10000.00', 'Cash', 'July 27, 2023', '11:19 pm', 'July', '27', '2023'),
(15, 10, 46, 38, 'July308-822-490', 1, 'Steffi Wong', 2147483647, '10000.00', 'Cash', 'July 31, 2023', '8:45 pm', 'July', '31', '2023'),
(16, 10, 46, 40, 'July165-278-233', 1, 'Steffi Wong', 2147483647, '300.00', 'Cash', 'July 31, 2023', '9:23 pm', 'July', '31', '2023'),
(17, 10, 46, 40, 'August470-246-660', 1, '4y7w4', 34645, '300.00', 'Gcash', 'August 1, 2023', '6:14 am', 'August', '1', '2023'),
(18, 10, 46, 40, 'August233-442-234', 1, 'dwsqa', 12312, '300.00', 'Gcash', 'August 1, 2023', '7:58 am', 'August', '1', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--
-- Creation: Jul 29, 2023 at 09:31 PM
-- Last update: Aug 01, 2023 at 11:29 PM
--

DROP TABLE IF EXISTS `inventory`;
CREATE TABLE `inventory` (
  `inventoryId` int(11) NOT NULL,
  `usersID` int(11) NOT NULL,
  `branchID` int(11) NOT NULL,
  `inventory_picture` varchar(255) DEFAULT NULL,
  `inventoryName` varchar(50) NOT NULL,
  `inventoryDesc` varchar(100) NOT NULL,
  `inventoryQty` int(30) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `price` int(11) NOT NULL,
  `added_date` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `inventory`:
--   `usersID`
--       `users` -> `usersID`
--   `branchID`
--       `branches` -> `branchID`
--

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventoryId`, `usersID`, `branchID`, `inventory_picture`, `inventoryName`, `inventoryDesc`, `inventoryQty`, `product_code`, `price`, `added_date`, `updated`) VALUES
(38, 44, 10, NULL, 'Automatic Tubig Machine', 'tuibg tuibg tuibg tuibg tuibg tuibg tuibg tuibg ', 26, 'HFBHSDBVH42333', 10000, '2023-07-28 09:12:00', '2023-07-28 11:00:00'),
(40, 44, 10, NULL, 'Water Bottle', 'sdsdsdfsdfsfdf', 26, 'ASGDVHASDG', 300, '2023-07-28 07:00:00', '2023-07-28 01:12:00'),
(41, 44, 10, NULL, 'fan', 'dfsdfsdfsdf', 20, 'DVASJDHJASD', 86, '2023-07-28 07:31:00', '2023-07-28 03:07:00'),
(42, 44, 10, NULL, 'Coin Slot', 'dfsdfsdfsdf', 24, 'HSADJHASBD', 80, '2023-07-28 07:42:30', '2023-07-28 00:00:00'),
(43, 44, 10, NULL, 'Male plug', 'dfgdfgsfg', 10, 'DFSDF', 20, '2023-07-28 12:21:47', '2023-07-28 00:00:00'),
(45, 44, 11, NULL, 'Gcash Vendo Machine', 'ajhasbdjhabsd', 20, 'ASHDBJHBHJ32JHBJHASD', 20000, '2023-07-28 14:16:06', '2023-07-28 00:00:00'),
(46, 44, 11, NULL, 'Insert coin vendo machine', 'djkfnsdkjfnjksdfnkjsdnf', 26, 'ASKJDBJ334XC', 20000, '2023-07-28 10:25:28', '2023-07-28 23:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--
-- Creation: Jul 29, 2023 at 09:31 PM
-- Last update: Aug 01, 2023 at 11:29 PM
--

DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `LogsID` int(11) NOT NULL,
  `usersID` int(11) NOT NULL,
  `branchID` int(11) NOT NULL,
  `Activity` varchar(300) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `logs`:
--   `usersID`
--       `users` -> `usersID`
--   `branchID`
--       `branches` -> `branchID`
--

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`LogsID`, `usersID`, `branchID`, `Activity`, `date`, `time`) VALUES
(62, 44, 10, 'Created New inventory Name :<b>Automatic Tubig Machine</b> with Product code :<b>HFBHSDBVH42333</b>  - Branch Manager', 'July 15, 2023', '1:30 pm'),
(63, 44, 10, 'Created New inventory Name :<b>Tubig Machine case</b> with Product code :<b>SDSSDJ2B32</b>  - Branch Manager', 'July 15, 2023', '1:31 pm'),
(64, 44, 10, 'Created New inventory Name :<b>Water Bottle</b> with Product code :<b>ASGDVHASDG</b>  - Branch Manager', 'July 15, 2023', '1:34 pm'),
(65, 44, 10, 'Created New inventory Name :<b>fan</b> with Product code :<b>DVASJDHJASD</b>  - Branch Manager', 'July 15, 2023', '1:34 pm'),
(66, 44, 10, 'Created New inventory Name :<b>Coin Slot</b> with Product code :<b>HSADJHASBD</b>  - Branch Manager', 'July 15, 2023', '1:34 pm'),
(67, 44, 10, 'Created New inventory Name :<b>Male plug</b> with Product code :<b>DFSDF</b>  - Branch Manager', 'July 15, 2023', '1:34 pm'),
(68, 44, 10, 'Updated Details of  inventory Name :<b>Water Bottle</b> with Product code :<b>ASGDVHASDG</b>  - Branch Manager', 'July 15, 2023', '1:36 pm'),
(69, 44, 10, 'Added new Assemble Inventory Named :<b>Create Automatic tubig Machine</b> for this Branch - Inventory Manager', 'July 15, 2023', '1:38 pm'),
(70, 44, 10, 'Inventory \"Create Automatic tubig Machine\" is Set to Asembly and Performing Procedures  - Branch Staff', 'July 15, 2023', '1:41 pm'),
(71, 44, 10, ' Inventory \"Create Automatic tubig Machine\" Finished Succesfully and Produced 1 x - Branch Staff', 'July 15, 2023', '1:43 pm'),
(72, 44, 10, 'Inventory \"Create Automatic tubig Machine\" is Set to Asembly and Performing Procedures  - Branch Staff', 'July 15, 2023', '1:43 pm'),
(73, 44, 10, ' Inventory \"Create Automatic tubig Machine\" Finished Succesfully and Produced 5 x - Branch Staff', 'July 15, 2023', '1:44 pm'),
(74, 44, 10, 'Item Transaction Code <b><u>:July477-593-441 </u></b> Sold <b>2</b> x in amount of <b>₱ 10000</b> by using <b>Gcash</b> from customer : <b>Atty Lawrence Escudero</b>,  Contact # : <b>09358250452</b> . <br> - Branch Manager', 'July 15, 2023', '1:48 pm'),
(75, 44, 11, 'Created New inventory Name :<b>Piso WIfi Bendo</b> with Product code :<b>SSSA324FDSF</b>  - Branch Manager', 'July 16, 2023', '11:27 am'),
(76, 44, 11, 'Updated Details of  inventory Name :<b>Piso WIfi Bendo</b> with Product code :<b>SSSA324FDSF</b>  - Branch Manager', 'July 16, 2023', '11:32 am'),
(77, 44, 11, 'Created New inventory Name :<b>Gcash Vendo Machine</b> with Product code of <b>ASHDBJHBHJ32JHBJHASD</b> and Price tag of <b>20000</b>  - Branch Manager', 'July 16, 2023', '11:34 am'),
(78, 44, 11, 'Created 30 x of Inventory Name : <b>Insert coin vendo machine</b> with product code of <b>ASKJDBJ334XC</b> and price tag <b>₱ 20000</b>- Inventory Manager', 'July 16, 2023', '11:40 am'),
(79, 44, 11, 'Edited Inventory Details of Inventory Name : <b>Gcash Vendo Machine</b> with product code : <b>ASHDBJHBHJ32JHBJHASD</b> - Inventory Manager', 'July 16, 2023', '11:41 am'),
(80, 44, 11, 'Updated Details of  inventory Name :<b>Gcash Vendo Machine</b> with Product code :<b>ASHDBJHBHJ32JHBJHASD</b>  - Branch Manager', 'July 16, 2023', '12:37 pm'),
(81, 44, 11, 'Item Transaction Code <b><u>:July361-212-457 </u></b> Sold <b>1</b> x in amount of <b>₱ 333</b> by using <b>Cash</b> from customer : <b>Fern Aragon</b>,  Contact # : <b>08909678232</b> . <br> - Branch Manager', 'July 16, 2023', '12:45 pm'),
(82, 44, 11, 'Item Transaction Code <b><u>:July733-567-314 </u></b> Sold <b>1</b> x in amount of <b>₱ 10000</b> by using <b>Remittance</b> from customer : <b>Fern Aragon</b>,  Contact # : <b>08909678232</b> . <br> - Branch Manager', 'July 16, 2023', '12:51 pm'),
(83, 44, 11, 'Item Transaction Code <b><u>:July588-580-642 </u></b> Sold <b>3</b> x in amount of <b>₱ 30000</b> by using <b>Cash</b> from customer : <b>Fern Aragon</b>,  Contact # : <b>08909678232</b> . <br> - Branch Manager', 'July 16, 2023', '12:52 pm'),
(84, 44, 11, 'Item Transaction Code <b><u>:July464-136-281 </u></b> Sold <b>2</b> x in amount of <b>₱ 20000</b> by using <b>Cash</b> from customer : <b>Fern Aragon</b>,  Contact # : <b>08909678232</b> . <br> - Branch Manager', 'July 16, 2023', '1:37 pm'),
(85, 44, 11, 'Item Transaction Code <b><u>:August669-559-804 </u></b> Sold <b>3</b> x in amount of <b>₱ 30000</b> by using <b>Remittance</b> from customer : <b>Fern Aragon</b>,  Contact # : <b>08909678232</b> . <br> - Branch Manager', 'August 16, 2023', '1:39 pm'),
(86, 44, 11, 'Item Transaction Code <b><u>:July605-164-983 </u></b> Sold <b>4</b> x in amount of <b>₱ 80000</b> by using <b>BankTransfer</b> from customer : <b>dsadsss</b>,  Contact # : <b>935824568</b> . <br> - Branch Manager', 'July 16, 2024', '1:50 pm'),
(87, 43, 10, 'Item Transaction Code <b><u>:July502-186-638 </u></b> Sold <b>85</b> x in amount of <b>₱ 0</b> by using <b>Cash</b> from customer : <b>sample</b>,  Contact # : <b>09123456789</b> . <br> - Branch Manager', 'July 23, 2023', '4:54 pm'),
(88, 43, 10, 'Item Transaction Code <b><u>:July838-564-435 </u></b> Sold <b>1</b> x in amount of <b>₱ 10000</b> by using <b>Cash</b> from customer : <b>Steffi Wong</b>,  Contact # : <b>09550636794</b> . <br> - Branch Manager', 'July 27, 2023', '11:20 pm'),
(89, 45, 10, 'Edited Inventory Details of Inventory Name : <b>Automatic Tubig Machine</b> with product code : <b>HFBHSDBVH42333</b> - Inventory Manager', 'July 28, 2023', '2:37 am'),
(90, 45, 10, 'Added new Assemble Inventory Named :<b>Create Automatic Tubig Machine</b> for this Branch - Inventory Manager', 'July 28, 2023', '2:38 am'),
(91, 43, 10, 'Inventory \"Create Automatic Tubig Machine\" is Set to Asembly and Performing Procedures  - Branch Staff', 'July 28, 2023', '2:47 am'),
(92, 43, 10, 'Inventory \"Create Automatic Tubig Machine\" is Set to Asembly and Performing Procedures  - Branch Staff', 'July 31, 2023', '3:09 pm'),
(93, 43, 10, ' Inventory \"Create Automatic Tubig Machine\" Finished Succesfully and Produced 3 x - Branch Staff', 'July 31, 2023', '3:09 pm'),
(94, 43, 10, 'Inventory \"Create Automatic Tubig Machine\" is Set to Asembly and Performing Procedures  - Branch Staff', 'July 31, 2023', '3:09 pm'),
(95, 43, 10, ' Inventory \"Create Automatic Tubig Machine\" Finished Succesfully and Produced 3 x - Branch Staff', 'July 31, 2023', '3:09 pm'),
(96, 43, 10, ' Inventory \"Create Automatic Tubig Machine\" Finished Succesfully and Produced 3 x - Branch Staff', 'July 31, 2023', '3:38 pm'),
(97, 43, 10, 'Inventory \"Create Automatic Tubig Machine\" is Set to Asembly and Performing Procedures  - Branch Staff', 'July 31, 2023', '3:39 pm'),
(98, 43, 10, 'Inventory \"Create Automatic Tubig Machine\" is Set to Asembly and Performing Procedures  - Branch Staff', 'July 31, 2023', '4:53 pm'),
(99, 43, 10, 'Inventory \"Create Automatic Tubig Machine\" is Set to Asembly and Performing Procedures  - Branch Staff', 'July 31, 2023', '5:00 pm'),
(100, 43, 10, 'Inventory is Set to Standby and Ready to perform procedures  - Branch Staff', 'July 31, 2023', '5:00 pm'),
(101, 43, 10, 'Inventory is Set to Standby and Ready to perform procedures  - Branch Staff', 'July 31, 2023', '5:00 pm'),
(102, 43, 10, 'Inventory \"Create Automatic Tubig Machine\" is Set to Asembly and Performing Procedures  - Branch Staff', 'July 31, 2023', '5:00 pm'),
(103, 43, 10, ' Inventory \"Create Automatic Tubig Machine\" Finished Succesfully and Produced 3 x - Branch Staff', 'July 31, 2023', '5:01 pm'),
(104, 43, 10, 'Inventory \"Create Automatic Tubig Machine\" is Set to Assemble and Performing Procedures - Branch Staff', 'July 31, 2023', '5:01 pm'),
(105, 43, 10, ' Inventory \"Create Automatic Tubig Machine\" Finished Succesfully and Produced 3 x - Branch Staff', 'July 31, 2023', '5:01 pm'),
(106, 43, 10, 'Inventory \"Create Automatic Tubig Machine\" is Set to Assemble and Performing Procedures - Branch Staff', 'July 31, 2023', '5:07 pm'),
(107, 43, 10, 'Inventory is Set to Standby and Ready to perform procedures  - Branch Staff', 'July 31, 2023', '5:07 pm'),
(108, 46, 10, 'Item Transaction Code <b><u>:July308-822-490 </u></b> Sold <b>1</b> x in amount of <b>₱ 10000</b> by using <b>Cash</b> from customer : <b>Steffi Wong</b>,  Contact # : <b>09263359096</b> . <br> - Branch Manager', 'July 31, 2023', '8:45 pm'),
(109, 45, 10, 'Created 1 x of Inventory Name : <b>setge</b> with product code of <b>2484</b> and price tag <b>₱ 1296</b> - Inventory Manager', 'July 31, 2023', '8:47 pm'),
(110, 45, 10, 'One Unessesary inventory has been Deleted - Inventory Manager', 'July 31, 2023', '8:47 pm'),
(111, 45, 10, 'Added new Assemble Inventory Named :<b>Cre</b> for this Branch - Inventory Manager', 'July 31, 2023', '8:48 pm'),
(112, 45, 10, 'Added new Assemble Inventory Named :<b>Create Au</b> for this Branch - Inventory Manager', 'July 31, 2023', '8:58 pm'),
(113, 45, 10, 'You Deleted 1 Assembly - Inventory Manager', 'July 31, 2023', '9:00 pm'),
(114, 45, 10, 'You Deleted 1 Assembly - Inventory Manager', 'July 31, 2023', '9:01 pm'),
(115, 46, 10, 'Item Transaction Code <b><u>:July165-278-233 </u></b> Sold <b>1</b> x in amount of <b>₱ 300</b> by using <b>Cash</b> from customer : <b>Steffi Wong</b>,  Contact # : <b>09263359096</b> . <br> - Branch Manager', 'July 31, 2023', '9:25 pm'),
(116, 46, 10, 'Item Transaction Code <b><u>:August470-246-660 </u></b> Sold <b>1</b> x in amount of <b>₱ 300</b> by using <b>Gcash</b> from customer : <b>4y7w4</b>,  Contact # : <b>034645</b> . <br> - Branch Manager', 'August 1, 2023', '6:16 am'),
(117, 46, 10, 'Modify New Branch Staff with specific role of code 3 - Branch Manager', 'August 1, 2023', '6:25 am'),
(118, 46, 10, 'Modify New Branch Staff with specific role of code 2 - Branch Manager', 'August 1, 2023', '6:26 am'),
(119, 46, 10, 'Modify New Branch Staff with specific role of code 3 - Branch Manager', 'August 1, 2023', '6:26 am'),
(120, 46, 10, 'Modify New Branch Staff with specific role of code 2 - Branch Manager', 'August 1, 2023', '6:26 am'),
(121, 46, 10, 'Modify New Branch Staff with specific role of code 3 - Branch Manager', 'August 1, 2023', '6:27 am'),
(122, 46, 10, 'Modify New Branch Staff with specific role of code 2 - Branch Manager', 'August 1, 2023', '6:35 am'),
(123, 46, 10, 'Created New inventory Name :<b>M</b> with Product code of <b>7489</b> and Price tag of <b>₱ 468</b>  - Branch Manager', 'August 1, 2023', '6:40 am'),
(124, 46, 10, 'Updated Details of  inventory Name :<b>M</b> with Product code :<b>7489</b>  - Branch Manager', 'August 1, 2023', '6:40 am'),
(125, 46, 10, 'The One Item Has been Deleted  - Branch Manager', 'August 1, 2023', '6:40 am'),
(126, 46, 10, 'Created New inventory Name :<b>rwywr</b> with Product code of <b>84985</b> and Price tag of <b>₱ 456</b>  - Branch Manager', 'August 1, 2023', '6:41 am'),
(127, 46, 10, 'The One Item Has been Deleted  - Branch Manager', 'August 1, 2023', '6:41 am'),
(128, 46, 10, 'Add New Branch Staff with specific role of code 3 - Branch Manager', 'August 1, 2023', '7:03 am'),
(129, 46, 10, 'Item Transaction Code <b><u>:August233-442-234 </u></b> Sold <b>1</b> x in amount of <b>₱ 300</b> by using <b>Gcash</b> from customer : <b>dwsqa</b>,  Contact # : <b>12312</b> . <br> - Branch Manager', 'August 1, 2023', '7:58 am'),
(130, 45, 10, 'Edited Inventory Details of Inventory Name : <b>Coin Slot</b> with product code : <b>HSADJHASBD</b> - Inventory Manager', 'August 1, 2023', '8:19 am'),
(131, 45, 10, 'Added new Assemble Inventory Named :<b>rew</b> for this Branch - Inventory Manager', 'August 1, 2023', '8:25 am'),
(132, 45, 10, 'Update Assemble Details of Inventory Named :<b>rew</b> for this Branch - Inventory Manager', 'August 1, 2023', '8:25 am'),
(133, 45, 10, 'You Deleted 1 Assembly - Inventory Manager', 'August 1, 2023', '8:25 am'),
(134, 45, 10, 'Created 456 x of Inventory Name : <b>set</b> with product code of <b>2484</b> and price tag <b>₱ 456456</b> - Inventory Manager', 'August 1, 2023', '9:34 am'),
(135, 45, 10, 'One Unessesary inventory has been Deleted - Inventory Manager', 'August 1, 2023', '9:34 am'),
(136, 45, 10, 'Added new Assemble Inventory Named :<b>rew</b> for this Branch - Inventory Manager', 'August 1, 2023', '9:35 am'),
(137, 45, 10, 'You Deleted 1 Assembly - Inventory Manager', 'August 1, 2023', '9:35 am'),
(138, 46, 10, 'Modify New Branch Staff with specific role of code 3 - Branch Manager', 'August 1, 2023', '10:19 am'),
(139, 46, 10, 'Modify New Branch Staff with specific role of code 2 - Branch Manager', 'August 1, 2023', '10:19 am'),
(140, 46, 10, 'Modify New Branch Staff with specific role of code 3 - Branch Manager', 'August 1, 2023', '10:22 am'),
(141, 43, 10, 'Inventory \"Create Automatic Tubig Machine\" is Set to Asembly and Performing Procedures  - Branch Staff', 'August 2, 2023', '7:27 am'),
(142, 43, 10, ' Inventory \"Create Automatic Tubig Machine\" Finished Succesfully and Produced 3 x - Branch Staff', 'August 2, 2023', '7:27 am'),
(143, 45, 10, 'Edited Inventory Details of Inventory Name : <b>Male plug</b> with product code : <b>DFSDF</b> - Inventory Manager', 'August 2, 2023', '7:29 am');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--
-- Creation: Jul 29, 2023 at 09:31 PM
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
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
  `latetimein_afternoon` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `settings`:
--

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`SettingsId`, `System_Name`, `System_Email`, `System_number`, `Smtp_email`, `Smatp_password`, `Smtp_Provider`, `Smtp_port`, `System_link`, `product_control`, `latetimein_morning`, `latetimein_afternoon`) VALUES
(1, 'Fayeed Electronics', 'hsfsjhdbsdjf@email.com', '09358250452', 'argonfernando453@gmail.com', 'kremkgslusntjhpr', 'smtp.gmail.com', '587', '192.168.2.49', 10, '09:15', '13:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Jul 29, 2023 at 09:31 PM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
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
  `roles` int(1) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `users`:
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersID`, `username`, `profile`, `cover_photo`, `usersFirstName`, `usersLastName`, `age`, `Address`, `CellNumber`, `email`, `password`, `code`, `status`, `roles`) VALUES
(3, 'Aragon123', 'fayeed_logo-removebg-preview (1).png', 'fayeedcover.png', 'Fern', 'Aragon', 21, 'j,a gamboa drive putik zamboanga city', '09358250452', 'argonfernando453@gmail.com', '$2y$10$h4RJUkT46z2z/gCHTJOPzObzv.UDa2Zt2uhOhI1DLNWyxnQ90yjhq', 0, 'verified', 1),
(13, 'Aragon123_s', 'Index 1.png', 'https://c4.wallpaperflare.com/wallpaper/767/612/930/nature-landscape-trees-digital-art-wallpaper-preview.jpg', 'Arag', 'Gonnnnnn', 212, 'Basque', '09358250452', 'argon4458@gmail.com', '$2y$10$M6ieaMj5D6ORrpYQ/Xc9eO38uspDqsnWrip9SyU4ql2YXXSI3Tkzq', 0, 'verified', 2),
(16, 'Keneth123', 'user.png', 'fayeedcover.png', 'Kenneth ', 'Tan', 21, 'ABS CBN', '09358250454', 'tannkenneth1220@gmail.com', '$2y$10$t7fDkHpDQGWEfnSRiYgFiOTmPOpXIuKv7JCHUREPpcmT364k9NBKC', 0, 'verified', 2),
(43, 'Stefi123', 'fayeed_logo-removebg-preview (1).png', 'https://c4.wallpaperflare.com/wallpaper/365/244/884/uchiha-itachi-naruto-shippuuden-anbu-silhouette-wallpaper-preview.jpg', 'steffi', 'wong', 19, 'tetuan', '09550636794', 'teff.wong@gmail.com', '$2y$10$zwd0QfRKH2j8MkzsXWbPbOnqGQMbM5/c7HDbUZNg4LSHguJGcQ43K', 0, 'verified', 2),
(44, 'Aragon145', 'sssssss-removebg.png', 'https://c4.wallpaperflare.com/wallpaper/533/163/784/digital-digital-art-artwork-illustration-minimalism-hd-wallpaper-preview.jpg', 'Fern', 'wmsu', 23, 'j,a gamboa drive putik zamboanga city', '935824568', 'gt201900484@wmsu.edu.ph', '$2y$10$rG.87GZGBd/RNO6WPOCBSOTkUhSHfGNje24WiAwBL44PYE3WW.C0i', 0, 'verified', 2),
(45, 'sampletest.5275', 'doc.jpg', 'fayeedcover.png', 'Sample', 'Staff', 25, 'Falcatan St. Tetuan Zamboanga City', '09550636794', 'sampletest.5275@gmail.com', '$2y$10$auX9k3vpK5492DXLxeAFdukidWBu5JdXAxpCa1sEV6KFNaM4xIPsS', 0, 'verified', 2),
(46, 'Steffi', 'user.png', 'fayeedcover.png', 'steffi', 'wong', 19, 'tetuan zamboanga city', '09123456789', 'wongsteffi@gmail.com', '$2y$10$.1rRLqSWuh1Mxy4AQ5QG6e0ZUCYwHEWd9fxnPH/3VmSAP1hXKYiay', 0, 'verified', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assembly`
--
ALTER TABLE `assembly`
  ADD PRIMARY KEY (`assemblyID`,`inventoryId`,`branchID`,`usersID`),
  ADD KEY `fkassembly` (`inventoryId`),
  ADD KEY `fkassembly1` (`branchID`),
  ADD KEY `fkassembly2` (`usersID`);

--
-- Indexes for table `assembly_inventory`
--
ALTER TABLE `assembly_inventory`
  ADD PRIMARY KEY (`assembly_inventoryID`,`assemblyID`,`inventory_list`),
  ADD KEY `fkassembly_inventory` (`assemblyID`),
  ADD KEY `fkassembly_inventory1` (`inventory_list`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceID`,`branchID`,`usersID`),
  ADD KEY `pkattendance` (`branchID`),
  ADD KEY `pkattendance1` (`usersID`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`branchID`,`usersID`),
  ADD KEY `fkbranches` (`usersID`);

--
-- Indexes for table `branch_staff`
--
ALTER TABLE `branch_staff`
  ADD PRIMARY KEY (`staffID`,`branchID`,`usersID`),
  ADD KEY `fkstaff` (`branchID`),
  ADD KEY `fkstaff2` (`usersID`),
  ADD KEY `fkstaff3` (`assigndby`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`checkoutID`,`branchID`,`usersID`,`inventoryId`),
  ADD KEY `fkcheckout` (`branchID`),
  ADD KEY `fkcheckout1` (`usersID`),
  ADD KEY `fkcheckout2` (`inventoryId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventoryId`,`usersID`,`branchID`),
  ADD KEY `fkinven1` (`usersID`),
  ADD KEY `fkinven2` (`branchID`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`LogsID`,`usersID`,`branchID`),
  ADD KEY `fklogs` (`usersID`),
  ADD KEY `fklogs1` (`branchID`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`SettingsId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`usersID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assembly`
--
ALTER TABLE `assembly`
  MODIFY `assemblyID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assembly_inventory`
--
ALTER TABLE `assembly_inventory`
  MODIFY `assembly_inventoryID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branchID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `branch_staff`
--
ALTER TABLE `branch_staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `checkoutID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventoryId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `LogsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `SettingsId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersID` int(11) NOT NULL AUTO_INCREMENT;

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
