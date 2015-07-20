-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 05, 2015 at 06:05 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mytechdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
`activityID` int(11) NOT NULL,
  `ticketID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `timespent` int(11) NOT NULL,
  `remark` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activityID`, `ticketID`, `employeeID`, `timespent`, `remark`) VALUES
(1, 7, 1, 30, 'I got this..  fixed.'),
(2, 8, 2, 20, 'tried to fix.  No luck.'),
(3, 8, 3, 30, 'paid a visit to customer.  told to come back later.'),
(4, 8, 5, 60, 'I think I found the problem....');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
`customerID` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `location` varchar(10) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerID`, `firstname`, `lastname`, `location`, `phone`, `username`, `password`) VALUES
(1, 'Eddie', 'Munster', 'G001', '2155551212', 'eddie', 'password'),
(2, 'Marylin', 'Munster', 'G002', '6105551212', 'marylin', 'password'),
(3, 'Gomez', 'Addams', '1301', '2155551313', 'gomez', 'password'),
(4, 'Pugsley', 'Addams', '1302', '6105551313', 'pugsley', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
`employeeID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `type` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employeeID`, `username`, `password`, `firstName`, `lastName`, `type`) VALUES
(1, 'mike', 'password', 'Mike', 'Brady', 'admin'),
(2, 'carol', 'password', 'Carol', 'Brady', 'mgr'),
(3, 'alice', 'password', 'Alice', 'Nelson', 'emp'),
(4, 'bobby', 'password', 'Bobby', 'Brady', 'emp'),
(5, 'greg', 'password', 'Greg', 'Brady', 'emp');

-- --------------------------------------------------------

--
-- Table structure for table `eventLog`
--

DROP TABLE IF EXISTS `eventLog`;
CREATE TABLE IF NOT EXISTS `eventLog` (
`eventid` int(11) NOT NULL,
  `eventdate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `eventdetail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `eventLog`
--

INSERT INTO `eventLog` (`eventid`, `eventdate`, `eventdetail`) VALUES
(1, '2015-02-04 23:33:12', 'No errors.  This is a test record.');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
`feedbackID` int(11) NOT NULL,
  `customerID` int(11) NOT NULL,
  `ticketID` int(11) NOT NULL,
  `remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedbackID`, `customerID`, `ticketID`, `remark`) VALUES
(1, 1, 7, 'Great service!  Thanks.');

-- --------------------------------------------------------

--
-- Table structure for table `serviceType`
--

DROP TABLE IF EXISTS `serviceType`;
CREATE TABLE IF NOT EXISTS `serviceType` (
`serviceID` int(11) NOT NULL,
  `serviceName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `serviceType`
--

INSERT INTO `serviceType` (`serviceID`, `serviceName`) VALUES
(1, 'Add/Remove Software'),
(2, 'Hardware Repair/Replacement'),
(3, 'Workstation Backup / Recovery'),
(4, 'Desk-side Assistance for Microsoft Office'),
(5, 'Mobile device support');

-- --------------------------------------------------------

--
-- Table structure for table `suggestion`
--

DROP TABLE IF EXISTS `suggestion`;
CREATE TABLE IF NOT EXISTS `suggestion` (
`suggestionID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `suggestionText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `suggestion`
--

INSERT INTO `suggestion` (`suggestionID`, `employeeID`, `suggestionText`) VALUES
(1, 2, 'We should charge more for our services.'),
(2, 2, 'I should get a raise'),
(3, 3, 'We need to discontinue support of Windows Vista.  It is a pain in the ass.'),
(4, 4, 'We need to support more Mac products.');

-- --------------------------------------------------------

--
-- Table structure for table `systemNotice`
--

DROP TABLE IF EXISTS `systemNotice`;
CREATE TABLE IF NOT EXISTS `systemNotice` (
`noticeID` int(11) NOT NULL,
  `employeeID` int(11) NOT NULL,
  `noticeText` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `systemNotice`
--

INSERT INTO `systemNotice` (`noticeID`, `employeeID`, `noticeText`) VALUES
(1, 1, 'The system will be going down for maintenance on Friday night.');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

DROP TABLE IF EXISTS `ticket`;
CREATE TABLE IF NOT EXISTS `ticket` (
`ticketid` int(11) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `problem` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `comment` varchar(100) DEFAULT NULL,
  `CustomerID` int(11) NOT NULL,
  `EmployeeID` int(11) NOT NULL,
  `serviceID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`ticketid`, `phone`, `location`, `problem`, `status`, `comment`, `CustomerID`, `EmployeeID`, `serviceID`) VALUES
(7, '2155551212', 'G001', 'machine won''t start.  Just get a blue screen.', 'Complete', 'Employee comment would go here..', 1, 1, 1),
(8, '6105551212', 'G002', 'I think I have a virus', 'In Progress', 'None at this time...', 2, 2, 1),
(9, '2155551212', 'G001', 'oops.  a mistake... going to cancel this ticket.', 'Canceled', 'canceled ticket here', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
 ADD PRIMARY KEY (`activityID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
 ADD PRIMARY KEY (`customerID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
 ADD PRIMARY KEY (`employeeID`);

--
-- Indexes for table `eventLog`
--
ALTER TABLE `eventLog`
 ADD PRIMARY KEY (`eventid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
 ADD PRIMARY KEY (`feedbackID`);

--
-- Indexes for table `serviceType`
--
ALTER TABLE `serviceType`
 ADD PRIMARY KEY (`serviceID`);

--
-- Indexes for table `suggestion`
--
ALTER TABLE `suggestion`
 ADD PRIMARY KEY (`suggestionID`);

--
-- Indexes for table `systemNotice`
--
ALTER TABLE `systemNotice`
 ADD PRIMARY KEY (`noticeID`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
 ADD PRIMARY KEY (`ticketid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
MODIFY `activityID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
MODIFY `customerID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
MODIFY `employeeID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `eventLog`
--
ALTER TABLE `eventLog`
MODIFY `eventid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
MODIFY `feedbackID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `serviceType`
--
ALTER TABLE `serviceType`
MODIFY `serviceID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `suggestion`
--
ALTER TABLE `suggestion`
MODIFY `suggestionID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `systemNotice`
--
ALTER TABLE `systemNotice`
MODIFY `noticeID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
MODIFY `ticketid` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
