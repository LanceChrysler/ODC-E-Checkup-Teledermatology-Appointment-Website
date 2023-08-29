-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2022 at 08:35 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

CREATE DATABASE IF NOT EXISTS `db_ODC_ECheckUp`;

USE `db_ODC_ECheckUp`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ODC_ECheckUp`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment_table`
--
DROP TABLE IF EXISTS `appointment_table`;

CREATE TABLE `appointment_table` (
  `appointment_id` int(20) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(20) NULL,
  `patient_id` int(20) NULL,
  `appointment_reason` varchar(300) NOT NULL,
  `appointment_comms` enum('Video Conferencing','Phone Call') NOT NULL,
  `appointment_date` date NULL,
  `appointment_status` enum('Waiting for schedule','Scheduled','Completed') NOT NULL,
  PRIMARY KEY (`appointment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_table`
--
DROP TABLE IF EXISTS `doctor_table`;

CREATE TABLE `doctor_table` (
  `doctor_id` int(20) NOT NULL AUTO_INCREMENT,
  `doctor_username` varchar(45) NOT NULL,
  `doctor_password` varchar(45) NOT NULL,
  `doctor_name` varchar(45) NOT NULL,
  `doctor_sex` enum('M', 'F') NOT NULL,
  `doctor_age` int(10) NOT NULL,
  `doctor_birthdate` date NOT NULL,
  `doctor_email` varchar(45) NOT NULL,
  `doctor_phone_no` varchar(11) NOT NULL,
  `doctor_address` varchar(100)  NOT NULL,
  `doctor_status` enum('Active','Inactive') NOT NULL,
  PRIMARY KEY (`doctor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `patient_table`
--
DROP TABLE IF EXISTS `patient_table`;

CREATE TABLE `patient_table` (
  `patient_id` int(20) NOT NULL AUTO_INCREMENT,
  `patient_name` varchar(100) NULL,
  `patient_sex` enum('M', 'F') NULL,
  `patient_age` int(10) NULL,
  `patient_birthdate` date NULL,
  `patient_birthplace` varchar(45) NULL,
  `patient_phone_no` varchar(11) NULL,
  `patient_email` varchar(45) NOT NULL,
  `patient_address` varchar(100) NULL,
  `patient_civil_status` enum('Single','Married','Widowed','Separated') NULL,
  `patient_username` varchar(45) NOT NULL,
  `patient_password` varchar(45) NOT NULL,
  `patient_nationality` enum('Filipino','Foreign National') NULL,
  `patient_religion` varchar(45) NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_table`
--
DROP TABLE IF EXISTS `admin_table`;

CREATE TABLE `admin_table` (
  `admin_id` int(20) NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(45) NOT NULL,
  `admin_password` varchar(45) NOT NULL,
  `admin_name` varchar(45) NOT NULL,
  `admin_sex` enum('M', 'F') NULL,
  `admin_age` int(10) NOT NULL,
  `admin_birthdate` date NOT NULL,
  `admin_email` varchar(45) NOT NULL,
  `admin_phone_no` varchar(11) NOT NULL,
  `admin_address` varchar(100) NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Foreign keys for table `appointment_table`
--
ALTER TABLE `appointment_table` 
  ADD FOREIGN KEY (`doctor_id`) 
  REFERENCES `doctor_table`(`doctor_id`) 
  ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `appointment_table` 
  ADD FOREIGN KEY (`patient_id`) 
  REFERENCES `patient_table`(`patient_id`) 
  ON DELETE RESTRICT ON UPDATE RESTRICT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
