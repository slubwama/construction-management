-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 16, 2014 at 01:14 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `birus`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `delete_date` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `deleted_by` (`deleted_by`,`created_by`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`id`, `name`, `deleted_by`, `delete_date`, `created_by`, `created_date`, `record_status`) VALUES
(1, 'Roofing', NULL, '0000-00-00 00:00:00', 2, '2014-05-14 00:00:00', 'active'),
(2, 'Excavation', NULL, '0000-00-00 00:00:00', 2, '2014-05-14 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `person_id` int(11) NOT NULL,
  `email` text,
  `phone_no` varchar(100) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `delete_date` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `person_id` (`person_id`),
  KEY `deleted_by` (`deleted_by`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `person_id`, `email`, `phone_no`, `deleted_by`, `delete_date`, `created_by`, `created_date`, `record_status`) VALUES
(1, 2, 'lubwamasamuel3@gmail.com', '+256772310404 	', NULL, '0000-00-00 00:00:00', NULL, '2014-05-14 00:00:00', 'active'),
(2, 3, 'lubwamasamuel3@gmail.com', '+256772310404 	', NULL, '0000-00-00 00:00:00', NULL, '2014-05-14 00:00:00', 'active'),
(4, 5, 'lubmix@yahoo.com', '+256772310404', NULL, '0000-00-00 00:00:00', 1, '2014-05-15 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `delete_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `deleted_by` (`deleted_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `name`, `created_by`, `created_date`, `deleted_by`, `delete_date`, `record_status`) VALUES
(1, 'cement', NULL, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plot_no` text,
  `town` varchar(100) NOT NULL,
  `village` varchar(100) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `delete_date` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `deleted_by` (`deleted_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `plot_no`, `town`, `village`, `deleted_by`, `delete_date`, `created_by`, `created_date`, `record_status`) VALUES
(1, '19 Vetinary', 'Kampala', 'Makerere', NULL, '0000-00-00 00:00:00', 1, '2014-05-15 00:00:00', ''),
(2, NULL, 'Kampala', 'Makerere', NULL, '0000-00-00 00:00:00', 1, '2014-05-15 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `main_store`
--

CREATE TABLE IF NOT EXISTS `main_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `site_req_item_id` int(11) NOT NULL,
  `pr_item_id` int(11) NOT NULL,
  `previous_id` int(11) NOT NULL,
  `next_id` int(11) NOT NULL,
  `balance` int(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_req_item_id` (`site_req_item_id`,`pr_item_id`,`previous_id`,`next_id`),
  KEY `created_by` (`created_by`,`deleted_by`),
  KEY `previous_id` (`previous_id`,`next_id`),
  KEY `site_req_item_id_2` (`site_req_item_id`,`pr_item_id`),
  KEY `next_id` (`next_id`),
  KEY `deleted_by` (`deleted_by`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE IF NOT EXISTS `person` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `deleted_by` (`deleted_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `first_name`, `last_name`, `gender`, `created_by`, `created_date`, `record_status`, `deleted_by`, `deleted_date`) VALUES
(2, 'Atuhaire', 'Doreen', 'male', NULL, '2014-05-14 00:00:00', 'active', NULL, NULL),
(3, 'Lubwama', 'Samuel', 'male', NULL, '2014-05-14 00:00:00', 'active', NULL, NULL),
(5, 'Lubwama', 'Samuel', 'male', 1, '2014-05-15 00:00:00', 'active', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pr_item`
--

CREATE TABLE IF NOT EXISTS `pr_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `qty_required` double DEFAULT NULL,
  `qty_recieved` double DEFAULT NULL,
  `amount` double NOT NULL,
  `pr_id` int(11) NOT NULL,
  `unit_of_measure_id` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `delete_date` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`,`pr_id`,`unit_of_measure_id`),
  KEY `pr_id` (`pr_id`),
  KEY `deleted_by` (`deleted_by`),
  KEY `created_by` (`created_by`),
  KEY `unit_of_measure_id` (`unit_of_measure_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `pr_item`
--

INSERT INTO `pr_item` (`id`, `item_id`, `qty_required`, `qty_recieved`, `amount`, `pr_id`, `unit_of_measure_id`, `deleted_by`, `delete_date`, `created_by`, `created_date`, `record_status`) VALUES
(1, 1, 100, NULL, 0, 1, 1, NULL, '0000-00-00 00:00:00', 1, '2014-05-16 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_req`
--

CREATE TABLE IF NOT EXISTS `purchase_req` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `req_no` varchar(100) NOT NULL,
  `delivery_note_no` varchar(100) NOT NULL,
  `delivery_note_url` text NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `delete_date` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `recieved_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `approved_date` datetime NOT NULL,
  `recieve_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `deleted_by` (`deleted_by`),
  KEY `created_by` (`created_by`),
  KEY `approved_by` (`approved_by`),
  KEY `recieved_by` (`recieved_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `purchase_req`
--

INSERT INTO `purchase_req` (`id`, `req_no`, `delivery_note_no`, `delivery_note_url`, `deleted_by`, `delete_date`, `created_by`, `approved_by`, `recieved_by`, `created_date`, `approved_date`, `recieve_date`, `record_status`) VALUES
(1, 'Pr1', '', '', NULL, '0000-00-00 00:00:00', 1, 1, NULL, '2014-05-16 00:00:00', '2014-05-16 00:00:00', '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `deleted_by` (`deleted_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `created_by`, `created_date`, `deleted_date`, `deleted_by`, `record_status`) VALUES
(1, 'admin', NULL, '2014-05-14 00:00:00', NULL, NULL, 'active'),
(2, 'Store Keeper', 2, '2014-05-14 00:00:00', NULL, NULL, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `site`
--

CREATE TABLE IF NOT EXISTS `site` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `start_date` date NOT NULL,
  `completion_date` date NOT NULL,
  `site_supervisor` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `delete_date` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  `locaction_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_supervisor` (`site_supervisor`),
  KEY `locaction_id` (`locaction_id`),
  KEY `site_supervisor_2` (`site_supervisor`),
  KEY `deleted_by` (`deleted_by`),
  KEY `created_by` (`created_by`),
  KEY `locaction_id_2` (`locaction_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `site`
--

INSERT INTO `site` (`id`, `name`, `start_date`, `completion_date`, `site_supervisor`, `deleted_by`, `delete_date`, `created_by`, `created_date`, `record_status`, `locaction_id`) VALUES
(7, 'Makerere University', '2014-05-15', '2014-05-31', 1, NULL, '0000-00-00 00:00:00', 1, '2014-05-15 00:00:00', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_activity`
--

CREATE TABLE IF NOT EXISTS `site_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `activity_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `delete_date` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `activity_id_2` (`activity_id`,`site_id`),
  KEY `activity_id` (`activity_id`),
  KEY `deleted_by` (`deleted_by`),
  KEY `created_by` (`created_by`),
  KEY `site_id` (`site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `site_activity`
--

INSERT INTO `site_activity` (`id`, `activity_id`, `site_id`, `deleted_by`, `delete_date`, `created_by`, `created_date`, `record_status`) VALUES
(1, 1, 7, NULL, '0000-00-00 00:00:00', 1, '2014-05-15 00:00:00', ''),
(2, 2, 7, NULL, '0000-00-00 00:00:00', 1, '2014-05-15 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `site_item_issue`
--

CREATE TABLE IF NOT EXISTS `site_item_issue` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `issueing_officer` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `approval_date` datetime NOT NULL,
  `qty_required` int(10) NOT NULL,
  `qty_issued` int(10) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  KEY `id` (`id`,`item_id`,`issueing_officer`),
  KEY `created_by` (`created_by`,`deleted_by`),
  KEY `item_id` (`item_id`),
  KEY `issueing_officer` (`issueing_officer`),
  KEY `approved_by` (`approved_by`),
  KEY `created_by_2` (`created_by`),
  KEY `deleted_by` (`deleted_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site_item_returns`
--

CREATE TABLE IF NOT EXISTS `site_item_returns` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `recieving_officer` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `approval_date` datetime NOT NULL,
  `qty_required` int(10) DEFAULT NULL,
  `qty_issued` int(10) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  KEY `id` (`id`,`item_id`,`recieving_officer`),
  KEY `created_by` (`created_by`,`deleted_by`),
  KEY `recieving_officer` (`recieving_officer`),
  KEY `approved_by` (`approved_by`),
  KEY `deleted_by` (`deleted_by`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `site_req`
--

CREATE TABLE IF NOT EXISTS `site_req` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `req_no` varchar(100) NOT NULL,
  `site_id` int(11) NOT NULL,
  `delivery_note_no` varchar(100) NOT NULL,
  `delivery_note_url` text NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `delete_date` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `recieved_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `approved_date` datetime NOT NULL,
  `recieve_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_id` (`site_id`),
  KEY `created_by` (`created_by`),
  KEY `approved_by` (`approved_by`),
  KEY `recieved_by` (`recieved_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `site_req`
--

INSERT INTO `site_req` (`id`, `req_no`, `site_id`, `delivery_note_no`, `delivery_note_url`, `deleted_by`, `delete_date`, `created_by`, `approved_by`, `recieved_by`, `created_date`, `approved_date`, `recieve_date`, `record_status`) VALUES
(1, 'SReq1', 7, '', '', NULL, '0000-00-00 00:00:00', 1, NULL, NULL, '2014-05-16 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'active'),
(2, 'SReq2', 7, '', '', NULL, '0000-00-00 00:00:00', 1, 1, NULL, '2014-05-16 00:00:00', '2014-05-16 00:00:00', '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `site_req_item`
--

CREATE TABLE IF NOT EXISTS `site_req_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `qty_required` double DEFAULT NULL,
  `qty_issued` double DEFAULT NULL,
  `qty_recieved` double DEFAULT NULL,
  `site_req_id` int(11) NOT NULL,
  `unit_of_measure_id` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `delete_date` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`,`site_req_id`,`unit_of_measure_id`),
  KEY `site_req_id` (`site_req_id`),
  KEY `unit_of_measure_id` (`unit_of_measure_id`),
  KEY `deleted_by` (`deleted_by`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `site_req_item`
--

INSERT INTO `site_req_item` (`id`, `item_id`, `qty_required`, `qty_issued`, `qty_recieved`, `site_req_id`, `unit_of_measure_id`, `deleted_by`, `delete_date`, `created_by`, `created_date`, `record_status`) VALUES
(1, 1, 100, 0, NULL, 1, 1, NULL, '0000-00-00 00:00:00', 1, '2014-05-16 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `site_store`
--

CREATE TABLE IF NOT EXISTS `site_store` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `site_req_item_id` int(11) DEFAULT NULL,
  `site_item_issue_id` int(11) DEFAULT NULL,
  `site_item_return_id` int(11) DEFAULT NULL,
  `previous_id` int(11) DEFAULT NULL,
  `next_id` int(11) DEFAULT NULL,
  `balance` int(100) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_date` datetime NOT NULL,
  `created_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `site_req_item_id` (`site_req_item_id`,`site_item_issue_id`,`previous_id`,`next_id`),
  KEY `created_by` (`created_by`,`deleted_by`),
  KEY `previous_id` (`previous_id`,`next_id`),
  KEY `site_item_return_id` (`site_item_return_id`),
  KEY `site_item_issue_id` (`site_item_issue_id`),
  KEY `next_id` (`next_id`),
  KEY `deleted_by` (`deleted_by`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location_id` int(11) NOT NULL DEFAULT '1',
  `person_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `delete_date` datetime NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `person_id` (`person_id`),
  KEY `deleted_by` (`deleted_by`),
  KEY `created_by` (`created_by`),
  KEY `locaction_id` (`location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `location_id`, `person_id`, `name`, `deleted_by`, `delete_date`, `created_by`, `created_date`, `record_status`) VALUES
(1, 2, 5, 'Hardware Solutions', NULL, '0000-00-00 00:00:00', 1, '2014-05-15 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `unit_of_measure`
--

CREATE TABLE IF NOT EXISTS `unit_of_measure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `qty_in_kg` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `delete_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `deleted_by` (`deleted_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `unit_of_measure`
--

INSERT INTO `unit_of_measure` (`id`, `name`, `qty_in_kg`, `created_by`, `created_date`, `deleted_by`, `delete_date`, `record_status`) VALUES
(1, 'Bag', 100, 1, '2014-05-15 00:00:00', NULL, '0000-00-00 00:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `password` varchar(100) NOT NULL,
  `person_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `record_status` enum('active','deactivated') NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `person_id` (`person_id`),
  KEY `role_id` (`role_id`),
  KEY `created_by` (`created_by`),
  KEY `deleted_by` (`deleted_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `person_id`, `role_id`, `created_by`, `created_date`, `record_status`, `deleted_by`, `delete_date`) VALUES
(1, 'lubwamasamuel3@gmail.com', '7fbd9b361741831d383394ee2aab4cd2', 2, 1, NULL, '2014-05-14 00:00:00', 'active', NULL, NULL),
(2, 'lubwamasamuel3@gmail.com', '7fbd9b361741831d383394ee2aab4cd2', 3, 1, NULL, '2014-05-14 00:00:00', 'active', NULL, NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity`
--
ALTER TABLE `activity`
  ADD CONSTRAINT `activity_ibfk_1` FOREIGN KEY (`deleted_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `activity_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `contact`
--
ALTER TABLE `contact`
  ADD CONSTRAINT `contact_ibfk_1` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_ibfk_6` FOREIGN KEY (`deleted_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `contact_ibfk_7` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `item_ibfk_4` FOREIGN KEY (`deleted_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`deleted_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `location_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `main_store`
--
ALTER TABLE `main_store`
  ADD CONSTRAINT `main_store_ibfk_10` FOREIGN KEY (`site_req_item_id`) REFERENCES `site_req_item` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `main_store_ibfk_11` FOREIGN KEY (`previous_id`) REFERENCES `main_store` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `main_store_ibfk_12` FOREIGN KEY (`next_id`) REFERENCES `main_store` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `main_store_ibfk_13` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `main_store_ibfk_14` FOREIGN KEY (`deleted_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `main_store_ibfk_9` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `person`
--
ALTER TABLE `person`
  ADD CONSTRAINT `person_ibfk_5` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `person_ibfk_6` FOREIGN KEY (`deleted_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `pr_item`
--
ALTER TABLE `pr_item`
  ADD CONSTRAINT `pr_item_ibfk_11` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pr_item_ibfk_12` FOREIGN KEY (`unit_of_measure_id`) REFERENCES `unit_of_measure` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pr_item_ibfk_13` FOREIGN KEY (`deleted_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pr_item_ibfk_14` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pr_item_ibfk_3` FOREIGN KEY (`pr_id`) REFERENCES `purchase_req` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchase_req`
--
ALTER TABLE `purchase_req`
  ADD CONSTRAINT `purchase_req_ibfk_1` FOREIGN KEY (`deleted_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_req_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_req_ibfk_3` FOREIGN KEY (`approved_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `purchase_req_ibfk_4` FOREIGN KEY (`recieved_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `site`
--
ALTER TABLE `site`
  ADD CONSTRAINT `site_ibfk_10` FOREIGN KEY (`deleted_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_ibfk_11` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_ibfk_12` FOREIGN KEY (`locaction_id`) REFERENCES `location` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_ibfk_9` FOREIGN KEY (`site_supervisor`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `site_activity`
--
ALTER TABLE `site_activity`
  ADD CONSTRAINT `site_activity_ibfk_4` FOREIGN KEY (`activity_id`) REFERENCES `activity` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `site_activity_ibfk_5` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`),
  ADD CONSTRAINT `site_activity_ibfk_6` FOREIGN KEY (`deleted_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_activity_ibfk_7` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `site_item_issue`
--
ALTER TABLE `site_item_issue`
  ADD CONSTRAINT `site_item_issue_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_item_issue_ibfk_2` FOREIGN KEY (`issueing_officer`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_item_issue_ibfk_3` FOREIGN KEY (`approved_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_item_issue_ibfk_4` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_item_issue_ibfk_5` FOREIGN KEY (`deleted_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `site_item_returns`
--
ALTER TABLE `site_item_returns`
  ADD CONSTRAINT `site_item_returns_ibfk_1` FOREIGN KEY (`recieving_officer`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_item_returns_ibfk_2` FOREIGN KEY (`approved_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_item_returns_ibfk_3` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_item_returns_ibfk_4` FOREIGN KEY (`deleted_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `site_req`
--
ALTER TABLE `site_req`
  ADD CONSTRAINT `site_req_ibfk_1` FOREIGN KEY (`site_id`) REFERENCES `site` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_req_ibfk_2` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_req_ibfk_3` FOREIGN KEY (`approved_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_req_ibfk_4` FOREIGN KEY (`recieved_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `site_req_item`
--
ALTER TABLE `site_req_item`
  ADD CONSTRAINT `site_req_item_ibfk_1` FOREIGN KEY (`site_req_id`) REFERENCES `site_req` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `site_req_item_ibfk_5` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_req_item_ibfk_6` FOREIGN KEY (`unit_of_measure_id`) REFERENCES `unit_of_measure` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_req_item_ibfk_7` FOREIGN KEY (`deleted_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_req_item_ibfk_8` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `site_store`
--
ALTER TABLE `site_store`
  ADD CONSTRAINT `site_store_ibfk_10` FOREIGN KEY (`site_item_issue_id`) REFERENCES `site_item_issue` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_store_ibfk_11` FOREIGN KEY (`site_item_return_id`) REFERENCES `site_item_returns` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_store_ibfk_12` FOREIGN KEY (`previous_id`) REFERENCES `site_store` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_store_ibfk_13` FOREIGN KEY (`next_id`) REFERENCES `site_store` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_store_ibfk_14` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_store_ibfk_15` FOREIGN KEY (`deleted_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_store_ibfk_8` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `site_store_ibfk_9` FOREIGN KEY (`site_req_item_id`) REFERENCES `site_req_item` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_14` FOREIGN KEY (`location_id`) REFERENCES `location` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_ibfk_15` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_ibfk_16` FOREIGN KEY (`deleted_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `supplier_ibfk_17` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `unit_of_measure`
--
ALTER TABLE `unit_of_measure`
  ADD CONSTRAINT `unit_of_measure_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `unit_of_measure_ibfk_2` FOREIGN KEY (`deleted_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_10` FOREIGN KEY (`person_id`) REFERENCES `person` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_11` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_12` FOREIGN KEY (`created_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_ibfk_13` FOREIGN KEY (`deleted_by`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
