-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2023 at 09:27 PM
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
-- Dumping data for table `assembly`
--

INSERT INTO `assembly` (`assemblyID`, `inventoryId`, `branchID`, `usersID`, `assemblyName`, `assemblyStatus`, `assemblyQuatty`, `editor`, `added`, `updated`) VALUES
(15, 38, 10, 43, 'Create Automatic tubig Machine', 'Finished', 100, 0, '2022-06-09 16:00:00', '2023-07-22 14:07:17'),
(16, 38, 10, 43, 'Create Automatic tubig Machine', 'Finished', 520, 0, '2023-07-19 17:51:55', '2023-07-22 14:02:39'),
(17, 38, 10, 43, 'Create Automatic tubig Machine', 'Finished', 100, 0, '2022-07-19 17:51:55', '2023-07-22 14:02:45'),
(18, 40, 10, 45, 'Create Automatic Tubig Machine', 'Assemble', 3, 43, '2023-07-27 18:38:03', '2023-07-27 18:48:11');

--
-- Triggers `assembly`
--
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

CREATE TABLE `assembly_inventory` (
  `assembly_inventoryID` int(11) NOT NULL,
  `assemblyID` int(11) NOT NULL,
  `inventory_list` int(11) NOT NULL,
  `inventory_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(11, 18, 39, 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

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
(73, 10, 45, 'face.gif', 'Absent', 'Absent', '0', '0', '', 'July 27, 2023', 0),
(74, 10, 43, 'face.gif', 'Absent', 'Absent', '0', '0', '', 'July 27, 2023', 0),
(75, 10, 43, '7c51108bbddfdb55965d1e4755854d6a.jpg', '0', '0', '0', '0', '', 'July 28, 2023', 0),
(76, 10, 45, '7c51108bbddfdb55965d1e4755854d6a.jpg', '0', '0', '0', '0', '', 'July 28, 2023', 0);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

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
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`branchID`, `usersID`, `Branch_Name`, `Branch_Address`, `city`, `Branch_Contact_number`, `DateCreated`, `branch_email`, `status`) VALUES
(10, 3, 'Fayeed Electronics Main Branch', 'tumaga tupperware bldg', 'Zamboanga City', '908087686', '2023-07-15', 'fernandoaragon117@yahoo.com', 2),
(11, 3, 'Fayeed Electronics Basilan', 'Basilan', 'Basilan', '08909678232', '2023-07-15', 'argonfernando453@gmail.com', 2);

-- --------------------------------------------------------

--
-- Table structure for table `branch_staff`
--

CREATE TABLE `branch_staff` (
  `staffID` int(11) NOT NULL,
  `branchID` int(11) NOT NULL,
  `usersID` int(11) NOT NULL,
  `assigndby` int(11) DEFAULT NULL,
  `roles` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch_staff`
--

INSERT INTO `branch_staff` (`staffID`, `branchID`, `usersID`, `assigndby`, `roles`) VALUES
(104, 11, 13, 3, 1),
(105, 11, 16, 3, 2),
(106, 11, 30, 3, 3),
(108, 11, 44, 3, 1),
(109, 10, 43, 3, 3),
(110, 10, 45, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

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
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`checkoutID`, `branchID`, `usersID`, `inventoryId`, `Transaction_code`, `quantity`, `cleint_name`, `cleint_number`, `amount_payment`, `mop`, `date`, `time`, `month`, `day`, `year`) VALUES
(4, 10, 44, 45, 'July605-164-984', 1, 'dsadsss', 935824568, '5000.00', 'BankTransfer', 'July 16, 2021', '1:50 pm', 'July', '16', '2021'),
(5, 11, 44, 46, 'July605-164-984', 1, 'dsadsss', 935824568, '25000.00', 'BankTransfer', 'July 16, 2021', '1:50 pm', 'July', '16', '2021'),
(6, 10, 44, 38, 'July477-593-441', 2, 'Atty Lawrence Escudero', 2147483647, '10000.00', 'Gcash', 'June 15, 2023', '1:47 pm', 'June', '15', '2023'),
(7, 11, 44, 44, 'July361-212-457', 0, 'Fern Aragon', 2147483647, '333.00', 'Cash', 'July 16, 2023', '12:45 pm', 'July', '16', '2023'),
(8, 11, 44, 44, 'July733-567-314', 1, 'Fern Aragon', 2147483647, '10000.00', 'Remittance', 'July 16, 2023', '12:51 pm', 'July', '16', '2023'),
(9, 11, 44, 44, 'July588-580-642', 3, 'Fern Aragon', 2147483647, '30000.00', 'Cash', 'July 17, 2023', '12:52 pm', 'July', '17', '2023'),
(10, 11, 44, 44, 'July464-136-281', 2, 'Fern Aragon', 2147483647, '20000.00', 'Cash', 'July 16, 2023', '1:36 pm', 'July', '16', '2023'),
(11, 11, 44, 44, 'August669-559-804', 3, 'Fern Aragon', 2147483647, '30000.00', 'Remittance', 'August 16, 2023', '1:39 pm', 'August', '16', '2023'),
(12, 11, 44, 46, 'July605-164-983', 4, 'dsadsss', 935824568, '80000.00', 'BankTransfer', 'July 16, 2022', '1:50 pm', 'July', '16', '2022'),
(13, 10, 43, 42, 'July502-186-638', 85, 'sample', 2147483647, '100000.00', 'Cash', 'July 23, 2023', '4:53 pm', 'July', '23', '2023'),
(14, 10, 43, 38, 'July838-564-435', 1, 'Steffi Wong', 2147483647, '10000.00', 'Cash', 'July 27, 2023', '11:19 pm', 'July', '27', '2023');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

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
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`inventoryId`, `usersID`, `branchID`, `inventory_picture`, `inventoryName`, `inventoryDesc`, `inventoryQty`, `product_code`, `price`, `added_date`, `updated`) VALUES
(38, 44, 10, NULL, 'Automatic Tubig Machine', 'tuibg tuibg tuibg tuibg tuibg tuibg tuibg tuibg ', 45, 'HFBHSDBVH42333', 10000, '2023-07-28 09:12:00', '2023-07-28 11:00:00'),
(39, 44, 10, NULL, 'Tubig Machine case', 'sdasdasdasd', 14, 'SDSSDJ2B32', 0, '2023-07-28 05:00:25', '2023-07-28 09:00:36'),
(40, 44, 10, NULL, 'Water Bottle', 'sdsdsdfsdfsfdf', 14, 'ASGDVHASDG', 300, '2023-07-28 07:00:00', '2023-07-28 01:12:00'),
(41, 44, 10, NULL, 'fan', 'dfsdfsdfsdf', 20, 'DVASJDHJASD', 0, '2023-07-28 07:31:00', '2023-07-28 03:07:00'),
(42, 44, 10, NULL, 'Coin Slot', 'dfsdfsdfsdf', 77, 'HSADJHASBD', 0, '2023-07-28 07:42:30', '2023-07-28 00:00:00'),
(43, 44, 10, NULL, 'Male plug', 'dfgdfgsfg', 14, 'DFSDF', 20, '2023-07-28 12:21:47', '2023-07-28 00:00:00'),
(44, 44, 11, NULL, 'Piso WIfi Bendo', 'sdfsdfsdf', 20, 'SSSA324FDSF', 10000, '2023-07-28 23:22:22', '2023-07-28 22:16:40'),
(45, 44, 11, NULL, 'Gcash Vendo Machine', 'ajhasbdjhabsd', 20, 'ASHDBJHBHJ32JHBJHASD', 20000, '2023-07-28 14:16:06', '2023-07-28 00:00:00'),
(46, 44, 11, NULL, 'Insert coin vendo machine', 'djkfnsdkjfnjksdfnkjsdnf', 26, 'ASKJDBJ334XC', 20000, '2023-07-28 10:25:28', '2023-07-28 23:35:00');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `LogsID` int(11) NOT NULL,
  `usersID` int(11) NOT NULL,
  `branchID` int(11) NOT NULL,
  `Activity` varchar(300) NOT NULL,
  `date` varchar(20) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`LogsID`, `usersID`, `branchID`, `Activity`, `date`, `time`) VALUES
(62, 44, 10, 'Created New inventory Name :<b>Automatic Tubig Machine</b> with Product code :<b>HFBHSDBVH42333</b>  - Branch Maniger', 'July 15, 2023', '1:30 pm'),
(63, 44, 10, 'Created New inventory Name :<b>Tubig Machine case</b> with Product code :<b>SDSSDJ2B32</b>  - Branch Maniger', 'July 15, 2023', '1:31 pm'),
(64, 44, 10, 'Created New inventory Name :<b>Water Bottle</b> with Product code :<b>ASGDVHASDG</b>  - Branch Maniger', 'July 15, 2023', '1:34 pm'),
(65, 44, 10, 'Created New inventory Name :<b>fan</b> with Product code :<b>DVASJDHJASD</b>  - Branch Maniger', 'July 15, 2023', '1:34 pm'),
(66, 44, 10, 'Created New inventory Name :<b>Coin Slot</b> with Product code :<b>HSADJHASBD</b>  - Branch Maniger', 'July 15, 2023', '1:34 pm'),
(67, 44, 10, 'Created New inventory Name :<b>Male plug</b> with Product code :<b>DFSDF</b>  - Branch Maniger', 'July 15, 2023', '1:34 pm'),
(68, 44, 10, 'Updated Details of  inventory Name :<b>Water Bottle</b> with Product code :<b>ASGDVHASDG</b>  - Branch Maniger', 'July 15, 2023', '1:36 pm'),
(69, 44, 10, 'Added new Assemble Inventory Named :<b>Create Automatic tubig Machine</b> for this Branch - Inventory Maniger', 'July 15, 2023', '1:38 pm'),
(70, 44, 10, 'Inventory \"Create Automatic tubig Machine\" is Set to Asembly and Performing Procedures  - Branch Staff', 'July 15, 2023', '1:41 pm'),
(71, 44, 10, ' Inventory \"Create Automatic tubig Machine\" Finished Succesfully and Produced 1 x - Branch Staff', 'July 15, 2023', '1:43 pm'),
(72, 44, 10, 'Inventory \"Create Automatic tubig Machine\" is Set to Asembly and Performing Procedures  - Branch Staff', 'July 15, 2023', '1:43 pm'),
(73, 44, 10, ' Inventory \"Create Automatic tubig Machine\" Finished Succesfully and Produced 5 x - Branch Staff', 'July 15, 2023', '1:44 pm'),
(74, 44, 10, 'Item Transaction Code <b><u>:July477-593-441 </u></b> Sold <b>2</b> x in amount of <b>₱ 10000</b> by using <b>Gcash</b> from customer : <b>Atty Lawrence Escudero</b>,  Contact # : <b>09358250452</b> . <br> - Branch Maniger', 'July 15, 2023', '1:48 pm'),
(75, 44, 11, 'Created New inventory Name :<b>Piso WIfi Bendo</b> with Product code :<b>SSSA324FDSF</b>  - Branch Maniger', 'July 16, 2023', '11:27 am'),
(76, 44, 11, 'Updated Details of  inventory Name :<b>Piso WIfi Bendo</b> with Product code :<b>SSSA324FDSF</b>  - Branch Maniger', 'July 16, 2023', '11:32 am'),
(77, 44, 11, 'Created New inventory Name :<b>Gcash Vendo Machine</b> with Product code of <b>ASHDBJHBHJ32JHBJHASD</b> and Price tag of <b>20000</b>  - Branch Maniger', 'July 16, 2023', '11:34 am'),
(78, 44, 11, 'Created 30 x of Inventory Name : <b>Insert coin vendo machine</b> with product code of <b>ASKJDBJ334XC</b> and price tag <b>₱ 20000</b>- Inventory Maniger', 'July 16, 2023', '11:40 am'),
(79, 44, 11, 'Edited Inventory Details of Inventory Name : <b>Gcash Vendo Machine</b> with product code : <b>ASHDBJHBHJ32JHBJHASD</b> - Inventory Maniger', 'July 16, 2023', '11:41 am'),
(80, 44, 11, 'Updated Details of  inventory Name :<b>Gcash Vendo Machine</b> with Product code :<b>ASHDBJHBHJ32JHBJHASD</b>  - Branch Maniger', 'July 16, 2023', '12:37 pm'),
(81, 44, 11, 'Item Transaction Code <b><u>:July361-212-457 </u></b> Sold <b>1</b> x in amount of <b>₱ 333</b> by using <b>Cash</b> from customer : <b>Fern Aragon</b>,  Contact # : <b>08909678232</b> . <br> - Branch Maniger', 'July 16, 2023', '12:45 pm'),
(82, 44, 11, 'Item Transaction Code <b><u>:July733-567-314 </u></b> Sold <b>1</b> x in amount of <b>₱ 10000</b> by using <b>Remittance</b> from customer : <b>Fern Aragon</b>,  Contact # : <b>08909678232</b> . <br> - Branch Maniger', 'July 16, 2023', '12:51 pm'),
(83, 44, 11, 'Item Transaction Code <b><u>:July588-580-642 </u></b> Sold <b>3</b> x in amount of <b>₱ 30000</b> by using <b>Cash</b> from customer : <b>Fern Aragon</b>,  Contact # : <b>08909678232</b> . <br> - Branch Maniger', 'July 16, 2023', '12:52 pm'),
(84, 44, 11, 'Item Transaction Code <b><u>:July464-136-281 </u></b> Sold <b>2</b> x in amount of <b>₱ 20000</b> by using <b>Cash</b> from customer : <b>Fern Aragon</b>,  Contact # : <b>08909678232</b> . <br> - Branch Maniger', 'July 16, 2023', '1:37 pm'),
(85, 44, 11, 'Item Transaction Code <b><u>:August669-559-804 </u></b> Sold <b>3</b> x in amount of <b>₱ 30000</b> by using <b>Remittance</b> from customer : <b>Fern Aragon</b>,  Contact # : <b>08909678232</b> . <br> - Branch Maniger', 'August 16, 2023', '1:39 pm'),
(86, 44, 11, 'Item Transaction Code <b><u>:July605-164-983 </u></b> Sold <b>4</b> x in amount of <b>₱ 80000</b> by using <b>BankTransfer</b> from customer : <b>dsadsss</b>,  Contact # : <b>935824568</b> . <br> - Branch Maniger', 'July 16, 2024', '1:50 pm'),
(87, 43, 10, 'Item Transaction Code <b><u>:July502-186-638 </u></b> Sold <b>85</b> x in amount of <b>₱ 0</b> by using <b>Cash</b> from customer : <b>sample</b>,  Contact # : <b>09123456789</b> . <br> - Branch Maniger', 'July 23, 2023', '4:54 pm'),
(88, 43, 10, 'Item Transaction Code <b><u>:July838-564-435 </u></b> Sold <b>1</b> x in amount of <b>₱ 10000</b> by using <b>Cash</b> from customer : <b>Steffi Wong</b>,  Contact # : <b>09550636794</b> . <br> - Branch Maniger', 'July 27, 2023', '11:20 pm'),
(89, 45, 10, 'Edited Inventory Details of Inventory Name : <b>Automatic Tubig Machine</b> with product code : <b>HFBHSDBVH42333</b> - Inventory Maniger', 'July 28, 2023', '2:37 am'),
(90, 45, 10, 'Added new Assemble Inventory Named :<b>Create Automatic Tubig Machine</b> for this Branch - Inventory Maniger', 'July 28, 2023', '2:38 am'),
(91, 43, 10, 'Inventory \"Create Automatic Tubig Machine\" is Set to Asembly and Performing Procedures  - Branch Staff', 'July 28, 2023', '2:47 am');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

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
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`SettingsId`, `System_Name`, `System_Email`, `System_number`, `Smtp_email`, `Smatp_password`, `Smtp_Provider`, `Smtp_port`, `System_link`, `product_control`, `latetimein_morning`, `latetimein_afternoon`) VALUES
(1, 'Fayeed Electronics', 'hsfsjhdbsdjf@email.com', '09358250452', 'argonfernando453@gmail.com', 'kremkgslusntjhpr', 'smtp.gmail.com', '587', '192.168.2.49', 10, '09:15', '13:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`usersID`, `username`, `profile`, `cover_photo`, `usersFirstName`, `usersLastName`, `age`, `Address`, `CellNumber`, `email`, `password`, `code`, `status`, `roles`) VALUES
(3, 'Aragon123_', '', '', 'Fernando', 'Aragon', 21, 'j,a gamboa drive putik zamboanga city', '09358250452', 'argonfernando453@gmail.com', '$2y$10$h4RJUkT46z2z/gCHTJOPzObzv.UDa2Zt2uhOhI1DLNWyxnQ90yjhq', 0, 'verified', 1),
(13, 'Aragon123_s', 'Index 1.png', 'https://c4.wallpaperflare.com/wallpaper/767/612/930/nature-landscape-trees-digital-art-wallpaper-preview.jpg', 'Arag', 'Gonnnnnn', 212, 'Basque', '09358250452', 'argon4458@gmail.com', '$2y$10$M6ieaMj5D6ORrpYQ/Xc9eO38uspDqsnWrip9SyU4ql2YXXSI3Tkzq', 0, 'verified', 2),
(16, 'Keneth123', 'user.png', 'fayeedcover.png', 'Kenneth ', 'Tan', 21, 'ABS CBN', '09358250454', 'tannkenneth1220@gmail.com', '$2y$10$t7fDkHpDQGWEfnSRiYgFiOTmPOpXIuKv7JCHUREPpcmT364k9NBKC', 0, 'verified', 2),
(30, 'Leo123', 'user.png', 'fayeedcover.png', '', '', NULL, '', NULL, 'olsenfrancisco39@gmail.com', '$2y$10$bVY4nCrZqTZDoSxDXVrg1e6hKLsqVPlpktpwM2L5pOiUsravFdPqK', 933850, 'notverified', 2),
(43, 'Stefi123', 'fayeed_logo-removebg-preview (1).png', 'https://c4.wallpaperflare.com/wallpaper/365/244/884/uchiha-itachi-naruto-shippuuden-anbu-silhouette-wallpaper-preview.jpg', 'steffi', 'wong', 19, 'tetuan', '09550636794', 'teff.wong@gmail.com', '$2y$10$zwd0QfRKH2j8MkzsXWbPbOnqGQMbM5/c7HDbUZNg4LSHguJGcQ43K', 0, 'verified', 2),
(44, 'Aragon145', 'sssssss-removebg.png', 'https://c4.wallpaperflare.com/wallpaper/533/163/784/digital-digital-art-artwork-illustration-minimalism-hd-wallpaper-preview.jpg', 'Fern', 'wmsu', 23, 'j,a gamboa drive putik zamboanga city', '935824568', 'gt201900484@wmsu.edu.ph', '$2y$10$rG.87GZGBd/RNO6WPOCBSOTkUhSHfGNje24WiAwBL44PYE3WW.C0i', 0, 'verified', 2),
(45, 'sampletest.5275', 'doc.jpg', 'fayeedcover.png', 'Sample', 'Staff', 25, 'Falcatan St. Tetuan Zamboanga City', '09550636794', 'sampletest.5275@gmail.com', '$2y$10$auX9k3vpK5492DXLxeAFdukidWBu5JdXAxpCa1sEV6KFNaM4xIPsS', 0, 'verified', 2);

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
  MODIFY `assemblyID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `assembly_inventory`
--
ALTER TABLE `assembly_inventory`
  MODIFY `assembly_inventoryID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `branchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `branch_staff`
--
ALTER TABLE `branch_staff`
  MODIFY `staffID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `checkoutID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `LogsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `SettingsId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `usersID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

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
