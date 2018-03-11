-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2018 at 06:55 PM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `IT350`
--

-- --------------------------------------------------------

--
-- Table structure for table `Category`
--

CREATE TABLE `Category` (
  `categoryId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Category`
--

INSERT INTO `Category` (`categoryId`, `name`) VALUES
(1, 'tools'),
(2, 'yes'),
(3, 'banana');

-- --------------------------------------------------------

--
-- Table structure for table `CustomerOrder`
--

CREATE TABLE `CustomerOrder` (
  `orderNumber` int(11) NOT NULL,
  `trackingNumber` varchar(10) DEFAULT NULL,
  `username` varchar(40) NOT NULL,
  `paymentMethod` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `transactionDate` date NOT NULL,
  `fulfilled` date DEFAULT NULL,
  `totalCost` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CustomerOrder`
--

INSERT INTO `CustomerOrder` (`orderNumber`, `trackingNumber`, `username`, `paymentMethod`, `cartId`, `transactionDate`, `fulfilled`, `totalCost`) VALUES
(1, '1232', 'unam', 1, 1, '2018-03-01', '2018-03-10', '100'),
(2, NULL, 'username', 1, 1, '2018-03-02', NULL, '122');

-- --------------------------------------------------------

--
-- Table structure for table `Feedback`
--

CREATE TABLE `Feedback` (
  `feedbackId` int(11) NOT NULL,
  `orderNumber` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Feedback`
--

INSERT INTO `Feedback` (`feedbackId`, `orderNumber`, `description`) VALUES
(1, 12, 'yay it works');

-- --------------------------------------------------------

--
-- Table structure for table `Item`
--

CREATE TABLE `Item` (
  `itemId` int(11) NOT NULL,
  `itemName` varchar(255) NOT NULL,
  `description` varchar(512) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `categoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Item`
--

INSERT INTO `Item` (`itemId`, `itemName`, `description`, `quantity`, `cost`, `categoryId`) VALUES
(2, 'test', 'we', 123, '123.00', 1),
(3, 'Tent', 'nice little tent for 2 people', 3, '85.00', 1),
(4, 'lighter', 'cool lighter', 132, '523.00', 1),
(5, '12', 'allow fraction', 213, '123.23', 1),
(6, '12', '12', 1, '12.33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `List`
--

CREATE TABLE `List` (
  `cartId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `List`
--

INSERT INTO `List` (`cartId`, `itemId`, `quantity`) VALUES
(1, 2, 3),
(1, 3, 30);

-- --------------------------------------------------------

--
-- Table structure for table `PaymentMethod`
--

CREATE TABLE `PaymentMethod` (
  `paymentMethodId` int(11) NOT NULL,
  `paymentinfo` varchar(255) NOT NULL,
  `paymentType` int(11) NOT NULL,
  `username` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `PaymentMethod`
--

INSERT INTO `PaymentMethod` (`paymentMethodId`, `paymentinfo`, `paymentType`, `username`) VALUES
(1, 'this is credit card information or gift card info', 1, 'unam');

-- --------------------------------------------------------

--
-- Table structure for table `ProcessingCompany`
--

CREATE TABLE `ProcessingCompany` (
  `paymentTypeId` int(11) NOT NULL,
  `processingCompany` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ProcessingCompany`
--

INSERT INTO `ProcessingCompany` (`paymentTypeId`, `processingCompany`) VALUES
(1, 'PayPal'),
(2, 'FjellProducts');

-- --------------------------------------------------------

--
-- Table structure for table `Review`
--

CREATE TABLE `Review` (
  `reviewId` int(11) NOT NULL,
  `itemId` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `description` varchar(512) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Review`
--

INSERT INTO `Review` (`reviewId`, `itemId`, `username`, `description`) VALUES
(1, 1, 'unam', 'i liked this item');

-- --------------------------------------------------------

--
-- Table structure for table `ShoppingCart`
--

CREATE TABLE `ShoppingCart` (
  `cartId` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `totalCost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ShoppingCart`
--

INSERT INTO `ShoppingCart` (`cartId`, `username`, `totalCost`) VALUES
(1, 'unam', 100);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `username` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `phonenumber` varchar(40) NOT NULL DEFAULT '111-333-4444',
  `address` varchar(255) NOT NULL DEFAULT '"fake address"',
  `email` varchar(40) NOT NULL,
  `privilege` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`username`, `password`, `firstname`, `lastname`, `phonenumber`, `address`, `email`, `privilege`) VALUES
('123', '601f1889667efaebb33b8c12572835da3f027f78', 'va', 'va', 'asv', 'avsd', 'asdv@D.C', 0),
('asdf', '601f1889667efaebb33b8c12572835da3f027f78', 'asdf', 'sadf', '111-333-4444', '"fake address"', 'asdf@d.c', 1),
('unam', '601f1889667efaebb33b8c12572835da3f027f78', 't3', 'fakename', '111-333-4444', '"fake address"', 'em@l.e', 2),
('username', '601f1889667efaebb33b8c12572835da3f027f78', 'first', 'last', 'phonenumber', 'addres', 'emai@ema.co', 0),
('va', '601f1889667efaebb33b8c12572835da3f027f78', 'va', 'va', 'va', 'va', 'va@va.c', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Category`
--
ALTER TABLE `Category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `CustomerOrder`
--
ALTER TABLE `CustomerOrder`
  ADD PRIMARY KEY (`orderNumber`);

--
-- Indexes for table `Feedback`
--
ALTER TABLE `Feedback`
  ADD PRIMARY KEY (`feedbackId`);

--
-- Indexes for table `Item`
--
ALTER TABLE `Item`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `List`
--
ALTER TABLE `List`
  ADD PRIMARY KEY (`cartId`,`itemId`);

--
-- Indexes for table `PaymentMethod`
--
ALTER TABLE `PaymentMethod`
  ADD PRIMARY KEY (`paymentMethodId`);

--
-- Indexes for table `ProcessingCompany`
--
ALTER TABLE `ProcessingCompany`
  ADD PRIMARY KEY (`paymentTypeId`);

--
-- Indexes for table `Review`
--
ALTER TABLE `Review`
  ADD PRIMARY KEY (`reviewId`);

--
-- Indexes for table `ShoppingCart`
--
ALTER TABLE `ShoppingCart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Category`
--
ALTER TABLE `Category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `CustomerOrder`
--
ALTER TABLE `CustomerOrder`
  MODIFY `orderNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Feedback`
--
ALTER TABLE `Feedback`
  MODIFY `feedbackId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `Item`
--
ALTER TABLE `Item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `PaymentMethod`
--
ALTER TABLE `PaymentMethod`
  MODIFY `paymentMethodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ProcessingCompany`
--
ALTER TABLE `ProcessingCompany`
  MODIFY `paymentTypeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Review`
--
ALTER TABLE `Review`
  MODIFY `reviewId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ShoppingCart`
--
ALTER TABLE `ShoppingCart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
