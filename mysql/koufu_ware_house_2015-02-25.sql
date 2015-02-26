-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2015 at 12:04 PM
-- Server version: 5.6.21
-- PHP Version: 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `koufu_ware_house`
--

-- --------------------------------------------------------

--
-- Table structure for table `custom_fields`
--

CREATE TABLE IF NOT EXISTS `custom_fields` (
`id` int(11) NOT NULL,
  `fieldlabel` varchar(60) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `custom_fields`
--

INSERT INTO `custom_fields` (`id`, `fieldlabel`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(1, 'Item', 1, 1, '2015-02-04 02:16:34', '2015-02-04 02:16:34'),
(2, 'Size', 1, 1, '2015-02-04 02:18:19', '2015-02-04 02:18:19'),
(3, 'Qty', 1, 1, '2015-02-04 02:18:29', '2015-02-04 02:18:29'),
(4, 'Unit Price', 1, 1, '2015-02-04 02:19:05', '2015-02-04 02:19:05'),
(5, 'Material', 1, 1, '2015-02-04 02:19:21', '2015-02-04 02:19:21'),
(6, 'Color', 1, 1, '2015-02-04 02:19:29', '2015-02-04 02:19:29'),
(7, 'Process', 1, 1, '2015-02-04 02:19:37', '2015-02-04 02:19:37'),
(8, 'Packaging', 1, 1, '2015-02-04 02:19:48', '2015-02-04 02:19:48'),
(9, 'Other Specs', 1, 1, '2015-02-04 02:20:07', '2015-02-04 02:20:07'),
(10, 'Terms', 1, 1, '2015-02-04 02:20:13', '2015-02-04 02:20:13'),
(11, 'Vat Price', 1, 1, '2015-02-16 10:26:33', '2015-02-16 10:26:33'),
(12, 'Validity', 1, 1, '2015-02-16 10:36:58', '2015-02-16 10:36:58'),
(13, 'Remarks', 1, 1, '2015-02-16 10:37:06', '2015-02-16 10:37:06');

-- --------------------------------------------------------

--
-- Table structure for table `raw_materials`
--

CREATE TABLE IF NOT EXISTS `raw_materials` (
`id` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `unit_cost` int(11) DEFAULT NULL,
  `unit` varchar(250) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `raw_materials`
--

INSERT INTO `raw_materials` (`id`, `name`, `description`, `qty`, `unit_cost`, `unit`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(1, 'das', '312', 312, 31231, '123', 1, 1, '2015-02-25 10:36:45', '2015-02-25 10:36:45');

-- --------------------------------------------------------

--
-- Table structure for table `request_stocks`
--

CREATE TABLE IF NOT EXISTS `request_stocks` (
`id` int(11) NOT NULL,
  `description` varchar(250) DEFAULT NULL,
  `po` int(120) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request_stocks`
--

INSERT INTO `request_stocks` (`id`, `description`, `po`, `created_by`, `modified_by`, `created`, `modified`) VALUES
(4, 'dsadas', 89, 1, 1, '2015-02-24 03:31:22', '2015-02-24 03:31:22'),
(5, 'dsadas', 268, 1, 1, '2015-02-24 03:31:50', '2015-02-24 03:31:50');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `custom_fields`
--
ALTER TABLE `custom_fields`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `raw_materials`
--
ALTER TABLE `raw_materials`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request_stocks`
--
ALTER TABLE `request_stocks`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `custom_fields`
--
ALTER TABLE `custom_fields`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `raw_materials`
--
ALTER TABLE `raw_materials`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `request_stocks`
--
ALTER TABLE `request_stocks`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
