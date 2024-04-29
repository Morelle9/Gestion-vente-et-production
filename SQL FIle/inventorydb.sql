-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2020 at 07:20 PM
-- Server version: 10.3.15-MariaDB
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventorydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(200) DEFAULT NULL,
  `UserName` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 1234567890, 'admin@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2020-06-25 07:19:31');

-- --------------------------------------------------------

--
-- Table structure for table `tblbrand`
--

CREATE TABLE `tblbrand` (
  `ID` int(10) NOT NULL,
  `BrandName` varchar(200) DEFAULT NULL,
  `Status` int(2) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblbrand`
--

INSERT INTO `tblbrand` (`ID`, `BrandName`, `Status`, `CreationDate`) VALUES
(1, 'Voltas', 1, '2020-06-26 06:13:29'),
(2, 'LG', 1, '2020-06-26 06:17:16'),
(3, 'Mitsubishi', 1, '2020-06-26 06:17:54'),
(4, 'Loreal', 1, '2020-06-26 06:18:08'),
(5, 'Johnson & Johnson', 1, '2020-06-26 06:18:28'),
(6, 'Jawra', 1, '2020-06-26 06:18:45'),
(7, 'Abbot', 1, '2020-06-26 06:18:55'),
(8, 'Life Xtra', 1, '2020-06-26 06:19:11'),
(9, 'Mangun', 1, '2020-06-26 06:19:20'),
(10, 'Sagun', 0, '2020-06-26 06:19:28'),
(11, 'Fortune', 1, '2020-06-26 06:19:40'),
(12, 'Hyan', 1, '2020-06-26 06:19:49'),
(13, 'Tyan', 1, '2020-06-26 06:19:55'),
(14, 'Kaina', 1, '2020-06-26 06:20:04'),
(15, 'Meeroso', 1, '2020-06-26 06:20:14'),
(16, 'Teeroso', 1, '2020-06-26 06:20:22'),
(17, 'Patanjali', 1, '2020-06-26 06:20:46'),
(18, 'Hindustan Lever', 1, '2020-06-26 06:21:04'),
(19, 'Dabur', 1, '2020-06-26 06:21:16'),
(20, 'Aquasure', 1, '2020-06-26 06:21:38'),
(21, 'Accu-Check', 1, '2020-06-26 06:22:04'),
(22, 'Dr Trust', 1, '2020-06-26 06:22:13'),
(23, 'Dr More-pan', 1, '2020-06-26 06:22:32'),
(24, 'Samsung', 1, '2020-06-26 11:21:25'),
(25, 'Test Brand ', 1, '2020-10-03 14:14:14');

-- --------------------------------------------------------

--
-- Table structure for table `tblcart`
--

CREATE TABLE `tblcart` (
  `ID` int(10) NOT NULL,
  `ProductId` int(5) DEFAULT NULL,
  `BillingId` int(11) DEFAULT NULL,
  `ProductQty` int(11) DEFAULT NULL,
  `IsCheckOut` int(5) DEFAULT NULL,
  `CartDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcart`
--

INSERT INTO `tblcart` (`ID`, `ProductId`, `BillingId`, `ProductQty`, `IsCheckOut`, `CartDate`) VALUES
(1, 5, 295895096, 1, 1, '2020-08-27 05:37:21'),
(2, 1, 295895096, 2, 1, '2020-08-27 05:37:21'),
(4, 5, 915520085, 1, 1, '2019-08-27 05:57:42'),
(5, 13, 255048845, 5, 1, '2020-08-26 12:14:38'),
(6, 5, 558104108, 16, 1, '2020-08-27 14:58:03'),
(25, 14, 122198457, 1, 1, '2020-09-02 05:53:15'),
(26, 14, 122198457, 1, 1, '2020-09-02 05:53:15'),
(36, 16, 262592136, 2, 1, '2020-10-03 14:17:19'),
(37, 13, 262592136, 1, 1, '2020-10-03 14:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `ID` int(10) NOT NULL,
  `CategoryName` varchar(200) DEFAULT NULL,
  `Status` int(2) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`ID`, `CategoryName`, `Status`, `CreationDate`) VALUES
(1, 'Electrical', 1, '2020-06-25 14:38:43'),
(2, 'Medical Supplies', 1, '2020-06-25 14:39:23'),
(3, 'Toys', 1, '2020-06-25 14:39:48'),
(4, 'Baby Products', 0, '2020-06-25 14:41:14'),
(5, 'Cosmetic', 1, '2020-06-25 14:41:33'),
(6, 'Groceries', 1, '2020-06-25 14:41:50'),
(7, 'Lab Supplies', 1, '2020-06-25 14:41:59'),
(8, 'Hand Tools', 1, '2020-06-25 14:51:50'),
(9, 'Bathroom Supplies', 1, '2020-06-25 15:27:20'),
(10, 'Essential Goods', 1, '2020-06-26 04:33:35'),
(11, 'Stationery', 1, '2020-06-26 04:34:05'),
(12, 'Kitchen Supplies', 1, '2020-06-26 04:34:27'),
(13, 'Home Appliances', 1, '2020-06-26 04:34:41'),
(14, 'Game Products', 1, '2020-06-26 04:34:55'),
(15, 'Stationery', 1, '2020-08-31 05:29:07'),
(16, 'Test Category', 1, '2020-10-03 14:12:50');

-- --------------------------------------------------------

--
-- Table structure for table `tblcustomer`
--

CREATE TABLE `tblcustomer` (
  `ID` int(10) NOT NULL,
  `BillingNumber` varchar(120) DEFAULT NULL,
  `CustomerName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(11) DEFAULT NULL,
  `ModeofPayment` varchar(50) DEFAULT NULL,
  `BillingDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblcustomer`
--

INSERT INTO `tblcustomer` (`ID`, `BillingNumber`, `CustomerName`, `MobileNumber`, `ModeofPayment`, `BillingDate`) VALUES
(1, '295895096', 'Sarita', 7797987987, 'cash', '2020-08-27 05:37:21'),
(2, '915520085', 'Sarita', 6465464646, 'cash', '2020-08-27 05:57:42'),
(3, '255048845', 'Harish', 7987978979, 'cash', '2020-08-27 12:14:38'),
(4, '558104108', 'Rahul', 6665464654, 'card', '2020-08-27 14:58:03'),
(5, '122198457', 'RaviKumar', 5765557576, 'cash', '2020-09-02 05:53:15'),
(6, '262592136', 'Anuj kumar', 9354778033, 'card', '2020-10-03 14:17:19');

-- --------------------------------------------------------

--
-- Table structure for table `tblproducts`
--

CREATE TABLE `tblproducts` (
  `ID` int(10) NOT NULL,
  `ProductName` varchar(200) DEFAULT NULL,
  `CatID` int(5) DEFAULT NULL,
  `SubcatID` int(5) DEFAULT NULL,
  `BrandName` varchar(200) DEFAULT NULL,
  `ModelNumber` varchar(200) DEFAULT NULL,
  `Stock` int(10) DEFAULT NULL,
  `Price` decimal(10,0) DEFAULT NULL,
  `Status` int(2) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblproducts`
--

INSERT INTO `tblproducts` (`ID`, `ProductName`, `CatID`, `SubcatID`, `BrandName`, `ModelNumber`, `Stock`, `Price`, `Status`, `CreationDate`) VALUES
(1, 'Thomson R9 80cm (32 inch) HD Ready LED TV', 1, 3, 'LG', '32TM3', 26, '7900', 1, '2020-06-26 11:17:19'),
(2, ' 4A 100 cm (40) Full HD LED Smart Android TV With Google Data Saver', 1, 3, 'Teeroso', '40THD', 15, '17999', 1, '2020-06-26 11:20:36'),
(3, '192 L Direct Cool Single Door 4 Star (2020) Refrigerator with Base Drawer', 1, 4, 'Mitsubishi', 'MIT89', 12, '18999', 1, '2020-06-26 11:22:41'),
(4, 'Samsung 253 L Frost Free Double Door 2 Star (2020) Refrigerator', 1, 4, 'Samsung', 'RT28T', 15, '19999', 1, '2020-06-26 11:24:27'),
(5, 'Dr Morepen Weighing Machine', 2, 6, 'Dr More-pan', 'DRMR6', 25, '1999', 1, '2020-06-26 11:25:32'),
(6, 'Accu Check Glucometer', 2, 8, 'Accu-Check', 'ACCU9', 50, '3999', 1, '2020-06-26 11:26:22'),
(7, 'Mmicry Toys', 3, 12, 'Teeroso', 'TR123', 15, '500', 1, '2020-06-26 11:27:24'),
(8, 'Lab Equipment Burret', 7, 17, 'Dr Trust', '90987', 50, '450', 1, '2020-06-26 11:28:16'),
(9, 'Faucet Bathroom XYUSZ', 9, 22, 'Mangun', 'MAN67', 50, '800', 1, '2020-06-26 11:29:16'),
(10, 'Glass of Korean ', 12, 23, 'Jawra', 'JAW34', 25, '89', 1, '2020-06-26 11:31:16'),
(11, 'Aqua Filter with UV filter', 1, 5, 'LG', 'AF123', 45, '1200', 1, '2020-06-26 11:32:22'),
(12, 'Air Condition FGH Rccbjhbvnkj', 1, 1, 'Mitsubishi', 'MIT54', 25, '29000', 1, '2020-06-26 11:33:03'),
(13, 'GHH Grooming Machine', 5, 26, 'Teeroso', 'GHH56', 26, '7900', 1, '2020-08-27 07:13:24'),
(14, 'XYZ Eletrical Machine', 1, 3, 'Life Xtra', 'jik79', 25, '8900', 1, '2020-08-27 07:16:49'),
(15, 'HJK Air Condition', 1, 1, 'Teeroso', 'Thu89', 5, '45003', 1, '2020-08-27 07:17:28'),
(16, ' TV Full HD 32 Inch', 1, 3, 'LG', 'AB091', 100, '25000', 1, '2020-10-03 14:15:27');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubcategory`
--

CREATE TABLE `tblsubcategory` (
  `ID` int(10) NOT NULL,
  `CatID` int(5) DEFAULT NULL,
  `SubCategoryname` varchar(200) DEFAULT NULL,
  `Status` int(2) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsubcategory`
--

INSERT INTO `tblsubcategory` (`ID`, `CatID`, `SubCategoryname`, `Status`, `CreationDate`) VALUES
(1, 1, 'Air Condition', 1, '2020-06-26 04:49:43'),
(2, 1, 'Bulb', 1, '2020-06-26 04:50:16'),
(3, 1, 'TV', 1, '2020-06-26 04:50:29'),
(4, 1, 'Freeze', 1, '2020-06-26 04:50:44'),
(5, 1, 'Aqua Filter', 1, '2020-06-26 04:51:04'),
(6, 2, 'Weight Machine', 1, '2020-06-26 04:51:41'),
(7, 2, 'BP Machine', 1, '2020-06-26 04:51:59'),
(8, 2, 'Glucometer', 1, '2020-06-26 04:52:28'),
(9, 2, 'Glucometer Strip', 1, '2020-06-26 04:52:45'),
(10, 2, 'Thero Band', 1, '2020-06-26 04:53:13'),
(11, 3, 'Music Toys', 1, '2020-06-26 04:53:32'),
(12, 3, 'Battery Toys', 1, '2020-06-26 04:57:35'),
(13, 4, 'Baby Swaddle', 1, '2020-06-26 04:59:00'),
(14, 4, 'Baby Bottle', 1, '2020-06-26 04:59:25'),
(15, 4, 'Baby Shampoo', 1, '2020-06-26 04:59:40'),
(16, 4, 'Baby Powder', 1, '2020-06-26 04:59:59'),
(17, 7, 'Burret', 1, '2020-06-26 05:00:15'),
(18, 7, 'Puppet', 1, '2020-06-26 05:00:27'),
(19, 7, 'Jar', 1, '2020-06-26 05:00:36'),
(20, 6, 'Mustard Oil', 1, '2020-06-26 05:00:57'),
(21, 6, 'Almond', 1, '2020-06-26 05:01:11'),
(22, 9, 'Fuccet', 1, '2020-06-26 05:01:25'),
(23, 12, 'Glass', 1, '2020-06-26 05:01:50'),
(24, 12, 'Plates', 1, '2020-06-26 05:02:02'),
(25, 12, 'Juicer', 1, '2020-06-26 05:02:14'),
(26, 5, 'Grooming', 1, '2020-08-27 07:12:39'),
(27, 16, 'Test  subCat', 1, '2020-10-03 14:13:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblbrand`
--
ALTER TABLE `tblbrand`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcart`
--
ALTER TABLE `tblcart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `BillingNumber` (`BillingNumber`);

--
-- Indexes for table `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbrand`
--
ALTER TABLE `tblbrand`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tblcart`
--
ALTER TABLE `tblcart`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tblcustomer`
--
ALTER TABLE `tblcustomer`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
