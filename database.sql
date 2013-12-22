-- phpMyAdmin SQL Dump
-- version 4.0.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 22, 2013 at 05:02 PM
-- Server version: 5.1.70-cll
-- PHP Version: 5.3.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `adamstes_p4_adamstest_biz`
--

-- --------------------------------------------------------

--
-- Table structure for table `income_tables`
--

CREATE TABLE IF NOT EXISTS `income_tables` (
  `income_table_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  PRIMARY KEY (`income_table_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Stores the id''s for income_tables, as well as a name and cap' AUTO_INCREMENT=41 ;

--
-- Dumping data for table `income_tables`
--

INSERT INTO `income_tables` (`income_table_id`, `user_id`, `created`, `modified`, `name`, `caption`) VALUES
(38, 1, 1387749128, 1387749657, 'Test Table', 'This is a test table. With a test caption. This will be included in the sample structure submitted with assignment.'),
(40, 1, 1387749490, 1387749624, 'Agriculture Income Statement', 'Agriculture Example');

-- --------------------------------------------------------

--
-- Table structure for table `table_entries`
--

CREATE TABLE IF NOT EXISTS `table_entries` (
  `table_entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `income_table_id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL,
  `idx` int(11) NOT NULL,
  `value` decimal(10,0) NOT NULL,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'row name',
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY (`table_entry_id`),
  KEY `income_table_id` (`income_table_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `table_entries`
--

INSERT INTO `table_entries` (`table_entry_id`, `income_table_id`, `category`, `idx`, `value`, `created`, `modified`, `name`, `comment`) VALUES
(21, 38, 'revenue', 0, '100', 1387749128, 1387749647, 'Entry #1', ''),
(22, 38, 'cos', 0, '20', 1387749128, 1387749651, 'Entry #2', ''),
(23, 38, 'opex', 0, '15', 1387749128, 1387749654, 'Entry #3', ''),
(24, 38, 'otherex', 0, '10', 1387749128, 1387749657, 'Entry #4', ''),
(29, 40, 'revenue', 0, '3000000', 1387749490, 1387749623, 'Vegetables', ''),
(30, 40, 'cos', 0, '100000', 1387749490, 1387749624, 'Water', ''),
(31, 40, 'opex', 0, '50000', 1387749490, 1387749624, 'Office Expenses', ''),
(32, 40, 'otherex', 0, '30000', 1387749490, 1387749624, 'Income Taxes', ''),
(33, 40, 'revenue', 1, '1000000', 1387749509, 1387749623, 'Herbs', ''),
(34, 40, 'revenue', 2, '40000', 1387749509, 1387749623, 'Other', ''),
(35, 40, 'cos', 1, '400300', 1387749534, 1387749624, 'Electricity', ''),
(36, 40, 'cos', 2, '500000', 1387749534, 1387749624, 'Soil', ''),
(37, 40, 'cos', 3, '1500000', 1387749553, 1387749624, 'Agricultural Labor', ''),
(38, 40, 'opex', 1, '1000300', 1387749564, 1387749624, 'Office Labor', ''),
(39, 40, 'otherex', 1, '200000', 1387749590, 1387749624, 'Depreciation', ''),
(40, 40, 'otherex', 2, '50000', 1387749599, 1387749624, 'Property Taxes', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `created` int(11) NOT NULL,
  `modified` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` int(11) NOT NULL,
  `timezone` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL COMMENT 'User Avatar',
  `photo` varchar(255) NOT NULL COMMENT 'User Profile Photo',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `created`, `modified`, `token`, `password`, `last_login`, `timezone`, `first_name`, `last_name`, `email`, `avatar`, `photo`) VALUES
(1, 1386719509, 1386719509, '098bfccd789485b4d2156da3f46ad3b2652a8e79', 'dc84846ce9b610d9e9110a41d797484fdbcceb25', 0, '', 'Adam', 'Beerman', 'adamthebeerman@gmail.com', 'example.gif', 'p_example.gif');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `income_tables`
--
ALTER TABLE `income_tables`
  ADD CONSTRAINT `income_tables_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `table_entries`
--
ALTER TABLE `table_entries`
  ADD CONSTRAINT `table_entries_ibfk_1` FOREIGN KEY (`income_table_id`) REFERENCES `income_tables` (`income_table_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
