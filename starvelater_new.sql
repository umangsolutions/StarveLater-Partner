-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 03, 2020 at 06:18 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `starvelater`
--
CREATE DATABASE IF NOT EXISTS `starvelater` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `starvelater`;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `Category_ID` varchar(50) NOT NULL,
  `Restaurant_ID` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Category_ID`),
  KEY `Restaurant_ID` (`Restaurant_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_ID`, `Restaurant_ID`, `Name`) VALUES
('5ecf6c056a9d9', '5ebf4545dc955', 'Main Course'),
('5ecfeb90ed6bf', '5ebe566fba6c3', 'Soup'),
('5ed265d70964b', '5ebe566fba6c3', 'Main Course'),
('5ed4f30c1698e', '5ebec48f8a153', 'Main Course'),
('5ed7926c8deb9', '5ebec48f8a153', 'Soup');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `City_ID` varchar(50) NOT NULL,
  `Name` varchar(80) NOT NULL,
  `State_ID` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`City_ID`),
  KEY `State_ID` (`State_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`City_ID`, `Name`, `State_ID`) VALUES
('5ebeda1838ea8', 'Kakinada', '5ebecfaf33a27'),
('5ebedb532bef4', 'Mumbai', '5ebed01868399'),
('5ebf40ca597bb', 'Rajahmundry', '5ebecfaf33a27'),
('5ebf40faa69de', 'Bhilai', '5ebed07a8cfc6'),
('5ebf414f4829c', 'Berhampur', '5ebf41404e9f6'),
('5ec127391a319', 'Chennai', '5ec1272724b34'),
('5ec13085e3877', 'Tiruvananthapuram', '5ec13078342e3'),
('5ec7880201c66', 'Dispur', '5ec787f678945'),
('5ed78d05af42e', 'Panaji', '5ed78cfa8b9b2');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `Customer_ID` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email_ID` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Phone` varchar(50) DEFAULT NULL,
  `Address` varchar(50) NOT NULL,
  `Total_Orders` varchar(50) NOT NULL,
  PRIMARY KEY (`Customer_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_ID`, `Name`, `Email_ID`, `Password`, `Phone`, `Address`, `Total_Orders`) VALUES
('5ebcfa887eeba', 'Saikiran Kopparthi', 'knvrssaikiran@gmail.com', 'sai123', '9381384234', 'D.NO 70-14-8/32/101, UDAY SOUDHA APARTMENT', '0'),
('5ebcfd3b86013', 'Koushik Modekurti', 'koushikmodekurti00@gmail.com', 'koushik123', '8639796138', 'Bhilai, Chattisgarh', '0');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `item_id` varchar(50) NOT NULL,
  `Restaurant_ID` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `category` varchar(50) NOT NULL,
  `price` varchar(50) NOT NULL,
  `availability` varchar(50) NOT NULL,
  `Discount` varchar(50) NOT NULL,
  `Final_Price` varchar(50) NOT NULL,
  `photoname` varchar(200) NOT NULL,
  PRIMARY KEY (`item_id`),
  KEY `Restaurant_ID` (`Restaurant_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `Restaurant_ID`, `Name`, `Type`, `category`, `price`, `availability`, `Discount`, `Final_Price`, `photoname`) VALUES
('5ece831d6aa79', '5ebec48f8a153', 'Paneer Butter Masala', 'Non-Vegetarian', 'Starters', 'â‚¹15000', 'Yes', '0', '', 'roy.jpg'),
('5ed500ff74045', '5ebec48f8a153', 'Paneer Butter Masala', 'Vegetarian', 'Main Course', '205', 'Yes', '30 %', '143.5', 'roy.jpg'),
('5ed792b23be06', '5ebec48f8a153', 'Biryani', 'Vegetarian', 'Main Course', '250', 'No', '30 %', '175', 'group_107_shutterstock_84904912.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `order_Id` varchar(50) NOT NULL,
  `item_ids` varchar(50) DEFAULT NULL,
  `Restaurant_ID` varchar(50) DEFAULT NULL,
  `Customer_ID` varchar(50) DEFAULT NULL,
  `Order_Type` varchar(50) NOT NULL,
  `Order_Date` varchar(50) NOT NULL,
  `Order_Status` varchar(50) NOT NULL,
  `Net_Bill` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_ids` (`item_ids`),
  KEY `Restaurant_ID` (`Restaurant_ID`),
  KEY `Customer_ID` (`Customer_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_Id`, `item_ids`, `Restaurant_ID`, `Customer_ID`, `Order_Type`, `Order_Date`, `Order_Status`, `Net_Bill`) VALUES
(1, '201', '5ece831d6aa79', '5ebec48f8a153', '5ebcfa887eeba', 'Take Away', '2020-06-01', 'Completed', '250'),
(2, '201', '5ece831d6aa79', '5ebec48f8a153', '5ebcfa887eeba', 'Take Away', '2020-06-01', 'Completed', '250'),
(3, '201', '5ece831d6aa79', '5ebec48f8a153', '5ebcfa887eeba', 'Take Away', '2020-06-01', 'Completed', '250'),
(4, '202', '5ece831d6aa79', '5ebec48f8a153', '5ebcfa887eeba', 'Take Away', '2020-06-01', 'Completed', '2500'),
(5, '202', '5ece831d6aa79', '5ebec48f8a153', '5ebcfa887eeba', 'Take Away', '2020-06-01', 'Completed', '150'),
(6, '202', '5ece831d6aa79', '5ebec48f8a153', '5ebcfa887eeba', 'Take Away', '2020-06-01', 'Completed', '25000'),
(7, '202', '5ece831d6aa79', '5ebec48f8a153', '5ebcfa887eeba', 'Take Away', '2020-06-01', 'Processing', '250'),
(8, '209', '5ece831d6aa79', '5ebe566fba6c3', '5ebcfa887eeba', 'Take Away', '2020-06-13', 'Completed', '250'),
(9, '210', '5ece831d6aa79', '5ec1364f769c9', '5ebcfa887eeba', 'Take Away', '2020-05-31', 'Completed', '250'),
(10, '211', '5ece831d6aa79', '5ebe566fba6c3', '5ebcfa887eeba', 'Take Away', '2020-05-31', 'Completed', '250'),
(11, '213', '5ece831d6aa79', '5ebe566fba6c3', '5ebcfa887eeba', 'Take Away', '2020-06-01', 'Completed', '250'),
(12, '215', '5ece831d6aa79', '5ebe566fba6c3', '5ebcfa887eeba', 'Take Away', '2020-06-01', 'Completed', '150'),
(13, '203', '5ece831d6aa79', '5ebec48f8a153', '5ebcfa887eeba', 'Take Away', '2020-05-28', 'Completed', '250'),
(14, '204', '5ece831d6aa79', '5ebec48f8a153', '5ebcfa887eeba', 'Take Away', '2020-05-02', 'Completed', '2500'),
(15, '202', '5ece831d6aa79', '5ebec48f8a153', '5ebcfa887eeba', 'Take Away', '2020-06-01', 'Completed', '250');

-- --------------------------------------------------------

--
-- Table structure for table `restaurants`
--

CREATE TABLE IF NOT EXISTS `restaurants` (
  `Restaurant_ID` varchar(50) NOT NULL,
  `Restaurant_Name` varchar(60) NOT NULL,
  `Email_ID` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Phone` varchar(50) NOT NULL,
  `SeatingCapacity` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `Address` varchar(60) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `GSTIN` varchar(50) NOT NULL,
  `FoodLicense` varchar(50) NOT NULL,
  `LabourLicense` varchar(50) NOT NULL,
  `Margin` varchar(50) NOT NULL,
  `OrdersReceived` varchar(50) NOT NULL,
  `logoFileName` varchar(80) NOT NULL,
  `OperationStatus` varchar(50) NOT NULL,
  `AvgPrepTime` varchar(50) NOT NULL,
  PRIMARY KEY (`Restaurant_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `restaurants`
--

INSERT INTO `restaurants` (`Restaurant_ID`, `Restaurant_Name`, `Email_ID`, `Password`, `Phone`, `SeatingCapacity`, `fname`, `lname`, `Address`, `City`, `State`, `GSTIN`, `FoodLicense`, `LabourLicense`, `Margin`, `OrdersReceived`, `logoFileName`, `OperationStatus`, `AvgPrepTime`) VALUES
('5ebe566fba6c3', 'KFC Restaurant', 'kfc@gmail.com', 'kfc123', '9908721573', '250', 'Sai Kiran', 'Kopparthi', 'Kakinada', 'Rajam', 'Andhra Pradesh', 'ABC12345', 'SAMOK123', 'DERTFY12345', '25', '0', '1200px-KFC_logo.svg.png', 'Open', '155'),
('5ebec48f8a153', 'GMRIT Canteen', 'gmrit@gmail.com', 'gmrit123', '8639796138', '152', 'Padma', 'Kopparthi', 'Godarigunta, Rajahmundry', 'Kakinada', 'Andhra Pradesh', 'KRITIKA123', 'ASDFF', 'DMDMD', '50', '0', 'log4.png', 'Open', '35 mins'),
('5ebf4545dc955', 'City Inn ', 'city@gmail.com', 'city123', '998844552', '0', 'Padma', 'Kopparthi', 'Warangal', '5ebeda1838ea8', '5ebecfaf33a27', 'abc123', 'ABC$%^', 'DRFTY', '1', '0', 'logo1.jpg', 'Closed', '0'),
('5ec1364f769c9', 'Sample Ress', 'samplekiran@gmail.com', 'Sample@123', '8106103193', '0', 'Sample', 'Test', 'Kakinada', '5ebeda1838ea8', '5ebecfaf33a27', 'KRITIKA123', '0', '0', '0', '0', 'logo3.png', 'Closed', '0'),
('5ed1e0351fbc9', 'Subbaya', 'gowkas@gmail.com', 'gowkas123', '9381384234', '0', 'Gowtham', 'Kopparthi', 'KAKINADA', '5ebeda1838ea8', '5ebecfaf33a27', 'ABC123', '0', '0', '0', '0', 'logo2.jpg', 'Open', '0'),
('5ed3a46e62d1f', 'Ramkumar FoodEx ', 'ramkumar@gmail.com', 'ramkumar123', '+919908721573', '0', 'Ramkumar', 'Kopparthi', 'Kakinada', '5ebedb532bef4', '5ebed01868399', 'DMFMF12345', '0', '0', '0', '0', 'congratulations-icon-22.jpg', 'Open', '0'),
('5ed78c3222aa5', 'Haveli Dakshin Pvt Ltd.', 'haveli@gmail.com', 'haveli123', '+919381384234', '0', 'Ram', 'Kumar', 'KAKINADA', '5ebeda1838ea8', '5ebecfaf33a27', 'ADD12345', 'GET123', 'FKEEK123', '1', '0', 'logo1.jpg', 'Open', '0'),
('5ed7b7528095b', 'City INN', 'kakinada@gmail.com', 'kiran123', '+919381384234', '0', 'Gowtham', 'Kopparthi', 'Kakinada', '5ebeda1838ea8', '5ebecfaf33a27', 'ADDDJ12345', '0', '0', '0', '0', '1317.png', 'Open', '0');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `State_ID` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`State_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`State_ID`, `Name`) VALUES
('5ebecfaf33a27', 'Andhra Pradesh'),
('5ebed01868399', 'Maharastra'),
('5ebed07a8cfc6', 'Chattisgarh'),
('5ebed28ae76ee', 'Telangana'),
('5ebf41404e9f6', 'Odisha'),
('5ec1272724b34', 'Tamil Nadu'),
('5ec13078342e3', 'Kerala'),
('5ec787f678945', 'Assam'),
('5ed78cfa8b9b2', 'Goa');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurants` (`Restaurant_ID`);

--
-- Constraints for table `city`
--
ALTER TABLE `city`
  ADD CONSTRAINT `city_ibfk_1` FOREIGN KEY (`State_ID`) REFERENCES `state` (`State_ID`);

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurants` (`Restaurant_ID`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`item_ids`) REFERENCES `items` (`item_id`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`Restaurant_ID`) REFERENCES `restaurants` (`Restaurant_ID`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
