-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql303.epizy.com
-- Generation Time: Jul 29, 2022 at 04:08 AM
-- Server version: 10.3.27-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `epiz_32206392_db_odc_echeckup`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_table`
--

CREATE TABLE `admin_table` (
  `admin_id` int(20) NOT NULL,
  `admin_username` varchar(45) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_name` varchar(45) NOT NULL,
  `admin_sex` enum('M','F') DEFAULT NULL,
  `admin_age` int(10) NOT NULL,
  `admin_birthdate` date NOT NULL,
  `admin_email` varchar(45) NOT NULL,
  `admin_phone_no` varchar(11) NOT NULL,
  `admin_address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_table`
--

INSERT INTO `admin_table` (`admin_id`, `admin_username`, `admin_password`, `admin_name`, `admin_sex`, `admin_age`, `admin_birthdate`, `admin_email`, `admin_phone_no`, `admin_address`) VALUES
(1, 'adminMendinueta', '*58948813BE0F3457D82045C7B43B0FC67BDC6418', 'Christian Jay M. Mendinueta', 'M', 21, '2000-12-24', 'mendinueta.christianjay.pup@gmail.com', '09958363511', 'Blk 36 Lot 16 P2 A2 Maya-Maya St., Brgy. NBBS Dagat-Dagatan, Navotas City');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_table`
--

CREATE TABLE `appointment_table` (
  `appointment_id` int(20) NOT NULL,
  `doctor_id` int(20) DEFAULT NULL,
  `patient_id` int(20) DEFAULT NULL,
  `appointment_reason` varchar(300) NOT NULL,
  `appointment_comms` enum('Video Conferencing','Phone Call') NOT NULL,
  `appointment_date` date DEFAULT NULL,
  `appointment_status` enum('Waiting for schedule','Scheduled','Completed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment_table`
--

INSERT INTO `appointment_table` (`appointment_id`, `doctor_id`, `patient_id`, `appointment_reason`, `appointment_comms`, `appointment_date`, `appointment_status`) VALUES
(1, 1, 1, 'Acne and thigh rashes', 'Phone Call', '2022-07-13', 'Completed'),
(2, 3, 2, 'Itchy Rashes', 'Video Conferencing', '2022-07-13', 'Completed'),
(3, 2, 3, 'Acne', 'Video Conferencing', '2022-07-20', 'Completed'),
(4, 3, 4, 'Discolored patches of skin', 'Video Conferencing', '2022-07-20', 'Completed'),
(5, 2, 1, 'Follow up: Acne', 'Phone Call', '2022-07-20', 'Completed'),
(6, 2, 5, 'Acne', 'Phone Call', '2022-07-20', 'Completed'),
(7, 3, 6, 'Acne', 'Video Conferencing', '2022-07-20', 'Completed'),
(8, 1, 7, 'Eczema', 'Phone Call', '2022-07-31', 'Scheduled'),
(9, 2, 8, 'Rashes', 'Phone Call', '2022-07-31', 'Scheduled'),
(10, 3, 1, 'Follow up: Acne', 'Phone Call', '2022-07-31', 'Scheduled'),
(11, 2, 9, 'Peeling of skin', 'Video Conferencing', '2022-08-01', 'Scheduled'),
(12, 1, 4, 'Follow up: Discolored patches of skin', 'Phone Call', '2022-08-01', 'Scheduled'),
(13, 1, 5, 'Follow up: Acne', 'Phone Call', '2022-08-01', 'Scheduled'),
(14, 2, 10, 'Rashes', 'Phone Call', '2022-08-01', 'Scheduled'),
(15, 3, 6, 'Follow up: Acne', 'Video Conferencing', '2022-08-01', 'Scheduled'),
(16, 4, 3, 'Follow up: Acne', 'Video Conferencing', '2022-08-01', 'Scheduled'),
(17, 5, 11, 'Scaly skin', 'Phone Call', '2022-08-02', 'Completed'),
(18, NULL, 12, 'Acne', 'Video Conferencing', NULL, 'Waiting for schedule'),
(19, NULL, 13, 'Acne', 'Video Conferencing', NULL, 'Waiting for schedule'),
(20, 4, 14, 'Acne', 'Video Conferencing', '2022-08-01', 'Scheduled'),
(21, 4, 15, 'Baby\'s rashes', 'Video Conferencing', '2022-08-01', 'Scheduled');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_table`
--

CREATE TABLE `doctor_table` (
  `doctor_id` int(20) NOT NULL,
  `doctor_username` varchar(45) NOT NULL,
  `doctor_password` varchar(255) NOT NULL,
  `doctor_name` varchar(45) NOT NULL,
  `doctor_sex` enum('M','F') NOT NULL,
  `doctor_age` int(10) NOT NULL,
  `doctor_birthdate` date NOT NULL,
  `doctor_email` varchar(45) NOT NULL,
  `doctor_phone_no` varchar(11) NOT NULL,
  `doctor_address` varchar(100) NOT NULL,
  `doctor_status` enum('Active','Inactive') NOT NULL DEFAULT 'Active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor_table`
--

INSERT INTO `doctor_table` (`doctor_id`, `doctor_username`, `doctor_password`, `doctor_name`, `doctor_sex`, `doctor_age`, `doctor_birthdate`, `doctor_email`, `doctor_phone_no`, `doctor_address`, `doctor_status`) VALUES
(1, 'doctorA', '*EF97E376A7321A952B110C4FDD3430BC6A559FF6', 'Alpha', 'F', 28, '1992-05-13', 'doctorA@gmail.com', '09324435190', 'Makati Ave. cor. H.V. dela Costa St, Salcedo Village, Makakti City, Metro Manila', 'Active'),
(2, 'doctorB', '*CEABB64F1A188E000674437576AD73DE4F8F97F5', 'Bravo', 'M', 32, '1990-07-22', 'doctorB@gmail.com', '9428590021', 'G/F D L T D Building919 Juan Luna Street 1000, Manila, Metro Manila', 'Active'),
(3, 'doctorC', '*F0A38CCFE684971A530C23C43FEF2162EC9ADBDE', 'Charlie', 'M', 30, '1992-12-01', 'doctorC@gmail.com', '09492778002', 'Room 307 Clf Building, 1167 Pasong Tamo, Makati City, Metro Manila', 'Active'),
(4, 'doctorD', '*C049BB2D32B342BC74ACE650A75CF55ACE0A098E', 'Delta', 'F', 28, '1994-04-13', 'doctorD@gmail.com', '09704022918', 'Rm. 1505 Cityland 10 Tower 1, 6815 North Ayala Avenue, Makati City, Metro Manila', 'Inactive'),
(5, 'doctorE', '*66CA881259DE5DA08418A57AF793743FA1B647DB', 'Echo', 'F', 28, '1994-06-06', 'doctorE@gmail.com', '09478001991', 'Maligaya Building 1200, Makati City, Metro Manila', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `patient_table`
--

CREATE TABLE `patient_table` (
  `patient_id` int(20) NOT NULL,
  `patient_name` varchar(100) DEFAULT NULL,
  `patient_sex` enum('M','F') DEFAULT NULL,
  `patient_age` int(10) DEFAULT NULL,
  `patient_birthdate` date DEFAULT NULL,
  `patient_birthplace` varchar(45) DEFAULT NULL,
  `patient_phone_no` varchar(11) DEFAULT NULL,
  `patient_email` varchar(45) NOT NULL,
  `patient_address` varchar(100) DEFAULT NULL,
  `patient_civil_status` enum('Single','Married','Widowed','Separated') DEFAULT NULL,
  `patient_username` varchar(45) NOT NULL,
  `patient_password` varchar(255) NOT NULL,
  `patient_nationality` enum('Filipino','Foreign National') DEFAULT NULL,
  `patient_religion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient_table`
--

INSERT INTO `patient_table` (`patient_id`, `patient_name`, `patient_sex`, `patient_age`, `patient_birthdate`, `patient_birthplace`, `patient_phone_no`, `patient_email`, `patient_address`, `patient_civil_status`, `patient_username`, `patient_password`, `patient_nationality`, `patient_religion`) VALUES
(1, 'Lance Chrysler M. Cabana', 'M', 22, '2000-03-14', 'Baler, Aurora', '09497174923', 'lancecabana@gmail.com', '014 Burgos Street, Barangay 5, Baler, Aurora', 'Single', 'lancecabana', '*B16316626269C24499581EFEB85E8B83446968E3', 'Filipino', 'Roman Catholic'),
(2, 'Kathrine Mae E. Boado', 'F', 20, '2001-11-10', 'Agoo, La Union', '09279759166', 'kathrineboado@gmail.com', 'Block 22, Lot 32, Tierra Solana Phase 2, Buenavista III, General Trias City, Cavite', 'Single', 'kathrineboado', '*67174A5D86FB6C1B0B537EE7B59E84B742A9849C', 'Filipino', 'Roman Catholic'),
(3, 'Nicole Alex C. Galban', 'F', 22, '2000-02-21', 'Baler, Aurora', '0935885214', 'galban.nicole@clsu2.edu.ph', 'Brgy. Magtanggol, Licaong, Science City of MuÃ±oz', 'Single', 'alexgalban', '*FEE77092520B105FFA2B16F2687D8F1EE538246D', 'Filipino', 'Roman Catholic'),
(4, 'Kirby', 'M', 25, '1996-07-27', 'Balanga, Bataan', '09610060145', 'kirby_swin@yahoo.com', '1G Molave, Suntrust Parkview, Natividad Almeda Lopez St., Brgy. 659-A, Ermita, Manila', 'Single', 'kirby', '*B955C42D9161FB4850181505500875FDFCA97176', 'Filipino', 'Catholic'),
(5, 'Edrienne A. Dingcon', 'F', 21, NULL, 'Manila', '09155685842', 'edriennedingcon12@gmail.com', '924 Norma St., Brgy. 565 Sampaloc, Manila, Metro Manila', 'Single', 'edriennedingcon', '*8F5CB689FED6C092248980532A3E8CA7A05D67C6', 'Filipino', 'Roman Catholic'),
(6, 'Sophia Espinosa', 'F', 21, '2000-11-13', 'Caloocan', '09275630995', 'prettygurl143@gmail.com', 'P3 E2, Kaunlaran, Longos, Malabon City', 'Married', 'sopheng', '*EBB4946FAC99E9205A3C93E010B45100CD37F745', 'Foreign National', 'Catholic'),
(7, 'Miguel Batumbakal', 'M', 23, '2000-02-12', NULL, '09059181700', 'amazing_miggy01@yahoo.com', '1016 Anonas, Sta. Mesa, Manila, Metro Manila', 'Single', 'miggy', '*BE845B2F64009A401A3241006C653DD1BEC82ED1', 'Filipino', 'Catholic'),
(8, 'Vanessa White', 'F', 31, '1991-06-18', 'Arizona, USA', '09208271377', 'vunnyessa69@yahoo.com', '626 Ramon Magsaysay Blvd., Sta. Mesa, Manila, Metro Manila', 'Married', 'vunny', '*AA9DAF03A7379B6D334A3C3FC4E545C859295AB4', 'Foreign National', NULL),
(9, 'Alira', 'F', 22, NULL, NULL, NULL, 'alirailagan@gmail.com', NULL, NULL, 'alira_ilagan', '*CFA231ABA5DFBDF4572DE6A8AFF3966F37D5E812', 'Filipino', NULL),
(10, 'Karyl Angela Enriquez', 'F', 18, '2004-06-30', 'General Trias, Cavite', '09959785177', 'karylangela@gmail.com', '81 Purok 3, Capiducaan, Bulaoen East, Sison, Pangasinan', 'Single', 'karylangela1', '*2B716224A04F9A79B8D82B17ABCCEB170CF21CB9', 'Filipino', 'Roman Catholic'),
(11, 'Joshua Sing', 'M', 19, '2003-03-05', 'Cabanatuan', '09994876165', 'joshuasing.slcv@gmail.com', '64 Roseville, White Plains, Quezon City', 'Single', 'sing', '*6A7A490FB9DC8C33C2B025A91737077A7E9CC5E5', 'Filipino', 'Catholic'),
(12, 'Amana Nair', 'F', 18, '2004-05-26', 'Abu Dhabi, UAE', '09451175983', 'purpleecryst@gmail.com', 'Aurora Blvd., Cubao, Quezon City, Metro Manila', 'Single', 'purple_crystal', '*161335CD4636153C04AF3B7B37ACC893270DDE75', 'Foreign National', NULL),
(13, 'Ken Wei Amper', 'M', 22, '1999-09-02', 'Berkley, California', NULL, 'amperkenwei@yahoo.com', 'Maligaya St., Bagbag, Quezon City', 'Married', 'ken_wei', '*D8C9B051E76C908541850183EB7BF79BB8328098', 'Foreign National', 'Christian'),
(14, 'Mary Anne Andaya', 'F', 20, '2001-07-12', 'Zambales', '09673636372', 'maryanne@gmail.com', 'Hermosa St., Subic, Zambales', 'Single', 'mhean', '*616E722FA85AA1C0A48F352A85A55FAEED15F8EF', 'Filipino', 'Roman Catholic'),
(15, 'Roselyn Montera', 'F', 44, '1978-05-29', 'Makati', '09172871654', 'rxmontera@gmail.com', 'Guadalupe Viejo, Makati', 'Married', 'roselyn', '*5F926EC8D52303DCE94F2E142EAD438ED0ED7840', 'Filipino', 'Roman Catholic');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_table`
--
ALTER TABLE `admin_table`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appointment_table`
--
ALTER TABLE `appointment_table`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `doctor_id` (`doctor_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `doctor_table`
--
ALTER TABLE `doctor_table`
  ADD PRIMARY KEY (`doctor_id`);

--
-- Indexes for table `patient_table`
--
ALTER TABLE `patient_table`
  ADD PRIMARY KEY (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_table`
--
ALTER TABLE `admin_table`
  MODIFY `admin_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointment_table`
--
ALTER TABLE `appointment_table`
  MODIFY `appointment_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `doctor_table`
--
ALTER TABLE `doctor_table`
  MODIFY `doctor_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient_table`
--
ALTER TABLE `patient_table`
  MODIFY `patient_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment_table`
--
ALTER TABLE `appointment_table`
  ADD CONSTRAINT `appointment_table_ibfk_1` FOREIGN KEY (`doctor_id`) REFERENCES `doctor_table` (`doctor_id`),
  ADD CONSTRAINT `appointment_table_ibfk_2` FOREIGN KEY (`patient_id`) REFERENCES `patient_table` (`patient_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
