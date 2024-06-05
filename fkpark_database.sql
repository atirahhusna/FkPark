-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: May 22, 2024 at 01:27 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fkpark_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `AdminID` varchar(15) NOT NULL,
  `AdminName` varchar(30) NOT NULL,
  `AdminPhoneNum` varchar(11) NOT NULL,
  `AdminEmail` varchar(30) NOT NULL,
  `userID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`AdminID`, `AdminName`, `AdminPhoneNum`, `AdminEmail`, `userId`) VALUES
('AA001', 'Asyraf Mazlan', '0128479823', 'asyrafmz@gmail.com', 'UA001'),
('AA002', 'Hidayat', '0119853859', 'Hidayat@gmail.com', 'UA002');

-- --------------------------------------------------------

--
-- Table structure for table `dashboard`
--

CREATE TABLE `dashboard` (
  `DashBoardID` varchar(15) NOT NULL,
  `TotalDamage` int(100) NOT NULL,
  `AdminID` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dashboard`
--

INSERT INTO `dashboard` (`DashBoardID`, `TotalDamage`, `AdminID`) VALUES
('J001', 3, 'AA001'),
('J002', 4, 'AA002');

-- --------------------------------------------------------

--
-- Table structure for table `dmerit_point`
--

CREATE TABLE `dmerit_point` (
  `DmeritID` varchar(15) NOT NULL,
  `totalDmeritPoint` double NOT NULL,
  `enforcementStatus` varchar(100) NOT NULL,
  `StudentID` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dmerit_point`
--

INSERT INTO `dmerit_point` (`DmeritID`, `totalDmeritPoint`, `enforcementStatus`, `StudentID`) VALUES
('K001', 12.5, 'Warning', 'CA001'),
('K002', 89.2, 'Revoke of in campus vehicle permission for the entire study duration', 'CA002');

-- --------------------------------------------------------

--
-- Table structure for table `make_booking`
--

CREATE TABLE `make_booking` (
  `bookID` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `StudentID` varchar(15) NOT NULL,
  `SpaceID` varchar(15) NOT NULL,
  `VehicleID` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `make_booking`
--

INSERT INTO `make_booking` (`bookID`, `date`, `start_time`, `end_time`, `StudentID`, `SpaceID`, `VehicleID`) VALUES
('B001', '2024-05-08', '19:13:26', '19:44:26', 'CA001', 'SA001', 'VB002'),
('B002', '2024-05-15', '02:09:26', '06:09:26', 'CA001', 'SA001', 'VB002');

-- --------------------------------------------------------

--
-- Table structure for table `parking_area`
--

CREATE TABLE `parking_area` (
  `AreaID` varchar(15) NOT NULL,
  `AreaName` varchar(30) NOT NULL,
  `Status` varchar(15) NOT NULL,
  `Reason` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parking_area`
--

INSERT INTO `parking_area` (`AreaID`, `AreaName`, `Status`, `Reason`) VALUES
('Z001', 'Left Wing', 'Open', '-'),
('Z002', 'Right Wing', 'Closed', 'Event'),
('Z003', 'Front', 'Open', '-'),
('Z004', 'Back', 'Open', '-');

-- --------------------------------------------------------

--
-- Table structure for table `parking_availability`
--

CREATE TABLE `parking_availability` (
  `AvailabilityID` varchar(15) NOT NULL,
  `Date` date NOT NULL,
  `TotalSpace` int(100) NOT NULL,
  `AreaID` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parking_availability`
--

INSERT INTO `parking_availability` (`AvailabilityID`, `Date`, `TotalSpace`, `AreaID`) VALUES
('DA001', '2024-05-02', 4, 'Z001'),
('DA002', '2024-05-04', 2, 'Z002');

-- --------------------------------------------------------

--
-- Table structure for table `parking_space`
--

CREATE TABLE `parking_space` (
  `SpaceID` varchar(15) NOT NULL,
  `Location` varchar(30) NOT NULL,
  `Status` varchar(15) NOT NULL,
  `AreaID` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parking_space`
--

INSERT INTO `parking_space` (`SpaceID`, `Location`, `Status`, `AreaID`) VALUES
('SA001', 'B', 'Empty', 'Z001'),
('SA002', 'A', 'Empty', 'Z003'),
('SB002', 'A', 'Occupied', 'Z002');

-- --------------------------------------------------------

--
-- Table structure for table `register_account`
--

CREATE TABLE `register_account` (
  `RegAccID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Name` VARCHAR(30) NOT NULL,
  `Email` VARCHAR(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register_account`
--

INSERT INTO `register_account` (`Name`, `Email`) VALUES
('Muhd Irfan', 'IrfanRosli@gmail.com'),
('Aiman Soleh', 'AimanSoleh@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `register_vehicle`
--

CREATE TABLE `register_vehicle` (
  `VehicleID` varchar(15) NOT NULL,
  `VehicleType` varchar(30) NOT NULL,
  `VehicleName` varchar(30) NOT NULL,
  `VehicleGrant` varchar(15) NOT NULL,
  `NoPlate` varchar(10) NOT NULL,
  `OwnerName` varchar(30) NOT NULL,
  `OwnerAddress` varchar(30) NOT NULL,
  `PhoneNumberOwner` varchar(11) NOT NULL,
  `StudentID` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register_vehicle`
--

INSERT INTO `register_vehicle` (`VehicleID`, `VehicleType`, `VehicleName`, `VehicleGrant`, `NoPlate`, `OwnerName`, `OwnerAddress`, `PhoneNumberOwner`, `StudentID`, `StaffID`) VALUES
('VB002', 'Bike', 'Yamaha', 'Grant456', 'UYT5241', 'Muhd Irfan', 'Kampung Marhum, pekan', '0138373782', 'CA001', NULL),
('VC001', 'Car', 'Toyota', 'Grant123', 'SD4593', 'Ramiza Ramli', 'Pekan, Pahang', '0123837242', NULL, 'LA002'),
('VC002', 'Car', 'Nissan', 'Grant765', 'HUI8673', 'Aiman Soleh', 'Kuala Pahang, Pekan', '0128927482', 'CA002', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `ReportID` varchar(15) NOT NULL,
  `TotalDemerit` double NOT NULL,
  `semester` int(10) NOT NULL,
  `StudentID` varchar(15) NOT NULL,
  `DmeritID` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`ReportID`, `TotalDemerit`, `semester`, `StudentID`, `DmeritID`) VALUES
('R001', 12.5, 3, 'CA001', 'K001'),
('R002', 89.2, 4, 'CA002', 'K002');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `StaffID` varchar(15) NOT NULL,
  `StaffName` varchar(30) NOT NULL,
  `StaffEmail` varchar(30) NOT NULL,
  `StaffPhoneNum` varchar(11) NOT NULL,
  `userID` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`StaffID`, `StaffName`, `StaffEmail`, `StaffPhoneNum`, `userID`) VALUES
('LA001', 'Muhd Ariffin', 'AriffinS@gmail.com', '0182732234', 'UB001'),
('LA002', 'Ramiza Ramli', 'Ramiza@gmail.com', '0123837242', 'UB002');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `StudentID` varchar(15) NOT NULL,
  `StudName` varchar(30) NOT NULL,
  `StudPhoneNum` varchar(11) NOT NULL,
  `StudSemester` int(15) NOT NULL,
  `userID` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`StudentID`, `StudName`, `StudPhoneNum`, `StudSemester`, `userID`) VALUES
('CA001', 'Muhd Irfan', '0138373782', 3, 'US001'),
('CA002', 'Aiman Soleh', '0128927482', 4, 'US002');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `userID` varchar(15) NOT NULL,
  `userPassword` varchar(20) NOT NULL,
  `userRole` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`userID`, `userPassword`, `userRole`) VALUES
('atirahhusna873@gmail.com', '123abc', 'Administrator'),
('UA002', '456abc', 'Administrator'),
('UB001', '123678', 'Staff'),
('UB002', '987654', 'Staff'),
('US001', 'abcdef', 'Student'),
('US002', '56789', 'Student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`AdminID`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `dashboard`
--
ALTER TABLE `dashboard`
  ADD PRIMARY KEY (`DashBoardID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `dmerit_point`
--
ALTER TABLE `dmerit_point`
  ADD PRIMARY KEY (`DmeritID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `make_booking`
--
ALTER TABLE `make_booking`
  ADD PRIMARY KEY (`bookID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `SpaceID` (`SpaceID`),
  ADD KEY `VehicleID` (`VehicleID`);

--
-- Indexes for table `parking_area`
--
ALTER TABLE `parking_area`
  ADD PRIMARY KEY (`AreaID`);

--
-- Indexes for table `parking_availability`
--
ALTER TABLE `parking_availability`
  ADD PRIMARY KEY (`AvailabilityID`),
  ADD KEY `AreaID` (`AreaID`);

--
-- Indexes for table `parking_space`
--
ALTER TABLE `parking_space`
  ADD PRIMARY KEY (`SpaceID`),
  ADD KEY `AreaID` (`AreaID`);

--
-- Indexes for table `register_account`
--
ALTER TABLE `register_account`
  ADD PRIMARY KEY (`RegAccID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- Indexes for table `register_vehicle`
--
ALTER TABLE `register_vehicle`
  ADD PRIMARY KEY (`VehicleID`),
  ADD KEY `StudentID` (`StudentID`),


--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`ReportID`),
  ADD KEY `StudentID` (`StudentID`),
  ADD KEY `DmeritID` (`DmeritID`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`StaffID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`StudentID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`userID`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `administrator_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `user_profile` (`userID`);

--
-- Constraints for table `dashboard`
--
ALTER TABLE `dashboard`
  ADD CONSTRAINT `dashboard_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `administrator` (`AdminID`);

--
-- Constraints for table `dmerit_point`
--
ALTER TABLE `dmerit_point`
  ADD CONSTRAINT `dmerit_point_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`);

--
-- Constraints for table `make_booking`
--
ALTER TABLE `make_booking`
  ADD CONSTRAINT `make_booking_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`),
  ADD CONSTRAINT `make_booking_ibfk_2` FOREIGN KEY (`SpaceID`) REFERENCES `parking_space` (`SpaceID`),
  ADD CONSTRAINT `make_booking_ibfk_3` FOREIGN KEY (`VehicleID`) REFERENCES `register_vehicle` (`VehicleID`);

--
-- Constraints for table `parking_availability`
--
ALTER TABLE `parking_availability`
  ADD CONSTRAINT `parking_availability_ibfk_1` FOREIGN KEY (`AreaID`) REFERENCES `parking_area` (`AreaID`);

--
-- Constraints for table `parking_space`
--
ALTER TABLE `parking_space`
  ADD CONSTRAINT `parking_space_ibfk_1` FOREIGN KEY (`AreaID`) REFERENCES `parking_area` (`AreaID`);

--
-- Constraints for table `register_account`
--
ALTER TABLE `register_account`
  ADD CONSTRAINT `register_account_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`),
  ADD CONSTRAINT `register_account_ibfk_2` FOREIGN KEY (`AdminID`) REFERENCES `administrator` (`AdminID`);

--
-- Constraints for table `register_vehicle`
--
ALTER TABLE `register_vehicle`
  ADD CONSTRAINT `register_vehicle_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`),

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`StudentID`) REFERENCES `student` (`StudentID`),
  ADD CONSTRAINT `report_ibfk_2` FOREIGN KEY (`DmeritID`) REFERENCES `dmerit_point` (`DmeritID`);

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user_profile` (`userID`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `user_profile` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
