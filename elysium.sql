-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 12, 2024 at 08:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `elysium`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_ID` int(11) NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `admin_fname` varchar(50) NOT NULL,
  `admin_lname` varchar(50) NOT NULL,
  `admin_pwd` varchar(100) NOT NULL,
  `access` enum('Employer','Employee','Admin') NOT NULL DEFAULT 'Admin'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_ID`, `admin_username`, `admin_fname`, `admin_lname`, `admin_pwd`, `access`) VALUES
(1, 'mitski@gmail.com', 'Mitski', 'Leonora', '123', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `applicant_ID` int(10) NOT NULL,
  `user_fname` varchar(180) DEFAULT NULL,
  `user_lname` varchar(180) DEFAULT NULL,
  `user_email` varchar(180) DEFAULT NULL,
  `user_contact` varchar(20) DEFAULT NULL,
  `user_pwd` varchar(180) DEFAULT NULL,
  `access` enum('Employer','Applicant','Admin') DEFAULT NULL,
  `user_addressLine` varchar(180) NOT NULL,
  `user_barangay` varchar(180) NOT NULL,
  `user_city` varchar(180) NOT NULL,
  `user_province` varchar(180) NOT NULL,
  `user_educ` varchar(100) NOT NULL,
  `user_gender` varchar(50) NOT NULL,
  `user_mstat` varchar(50) NOT NULL,
  `user_dob` date NOT NULL,
  `user_age` int(10) NOT NULL,
  `user_license` varchar(100) NOT NULL,
  `user_cred` int(180) NOT NULL,
  `user_level` varchar(1) NOT NULL,
  `user_CV` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`applicant_ID`, `user_fname`, `user_lname`, `user_email`, `user_contact`, `user_pwd`, `access`, `user_addressLine`, `user_barangay`, `user_city`, `user_province`, `user_educ`, `user_gender`, `user_mstat`, `user_dob`, `user_age`, `user_license`, `user_cred`, `user_level`, `user_CV`) VALUES
(5, 'Laufey', 'Cruz', 'laufeycruz@gmail.com', '09455111105', 'qqq', 'Applicant', '111B, Duhat St.', 'Las Piñas', 'Las Piñas', 'Metro Manila', 'HS', 'F', 'Single', '2024-02-15', 23, '', 0, 'S', ''),
(6, 'Lizbeth', 'Jimera', 'lizjimera@gmail.com', '09455111105', 'a', 'Applicant', 'Unit 6, Zeta St., Brgy. Estefania', 'Bacolod City', 'Bacolod City', 'Negros Occidental', 'High School', 'Female', 'Married', '2024-07-17', 47, '', 0, 'D', ''),
(8, 'Water', 'Melon', 'watermelon@gmail.com', '09455111105', 'abcd', 'Applicant', 'Unit 6, Zeta St., Brgy. Estefania', 'Bacolod City', 'Bacolod City', 'Negros Occidental', 'High Scool Muscal', 'Female', 'Single asf', '2003-06-20', 23, '', 0, 'D', ''),
(10, 'Tuesday', 'Summers', 'sa@gmail.com', '09455111105', 'as', 'Applicant', 'Capitol', 'Brgy Manadalagan', 'Bacolod', 'Negros Occidental', 'Experimental Psychology', 'Binary', 'Married', '1997-03-22', 34, '', 0, 'A', ''),
(11, 'Arielle', 'Jimera', 'aa@gmail.com', '09367597255', 'a', 'Applicant', '111B, Duhat St.', 'Las Piñas', 'Las Piñas', 'Metro Manila', 'Major in Gaslighting', 'Female', 'Single', '2024-02-29', 21, '', 0, 'D', ''),
(12, 'Liz Angel', 'Jimera', 'angeljim@gmail.com', '09789789266', 'a', 'Applicant', '111B, Duhat St.', 'Las Piñas', 'Las Piñas', 'Metro Manila', 'BS Radiologic Technology', 'Female', 'Single', '2001-10-20', 21, '', 0, 'D', ''),
(19, 'Junwon', 'Batayola', 'JB@korea.com', '09347297266', 'ancient', 'Applicant', 'South', 'Patyo', 'Daegu', 'South Korea', 'Mechanical Engineering', 'Male', 'Single', '2001-06-15', 29, '', 0, 'D', ''),
(20, 'Benzydamine', 'Hyrdrochloride', 'benz@gmail.com', '09455111105', 'aa', 'Applicant', 'Unit 6, Zeta St., Brgy. Estefania', 'Bacolod City', 'Bacolod City', 'Negros Occidental', 'High School', 'Female', 'Single', '2024-03-28', 32, '', 0, 'D', '');

-- --------------------------------------------------------

--
-- Table structure for table `applications_list`
--

CREATE TABLE `applications_list` (
  `application_ID` int(11) NOT NULL,
  `job_ID` int(11) NOT NULL,
  `applicant_ID` int(11) NOT NULL,
  `dateApplied` date DEFAULT NULL,
  `application_status` enum('Ongoing','Rejected','Pending','Waiting for Payment','Completed') DEFAULT NULL,
  `status_Date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications_list`
--

INSERT INTO `applications_list` (`application_ID`, `job_ID`, `applicant_ID`, `dateApplied`, `application_status`, `status_Date`) VALUES
(8, 29, 5, '2024-03-12', 'Pending', NULL),
(9, 30, 5, '2024-03-12', 'Pending', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `client_ID` int(10) NOT NULL,
  `client_fname` varchar(180) DEFAULT NULL,
  `client_lname` varchar(180) DEFAULT NULL,
  `client_email` varchar(180) DEFAULT NULL,
  `client_contact` varchar(20) DEFAULT NULL,
  `client_pwd` varchar(180) DEFAULT NULL,
  `access` enum('Employer','Employee','Admin') DEFAULT NULL,
  `client_organization` varchar(180) NOT NULL,
  `client_occupation` varchar(180) NOT NULL,
  `client_addressLine` varchar(180) NOT NULL,
  `client_barangay` varchar(180) NOT NULL,
  `client_city` varchar(180) NOT NULL,
  `client_province` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`client_ID`, `client_fname`, `client_lname`, `client_email`, `client_contact`, `client_pwd`, `access`, `client_organization`, `client_occupation`, `client_addressLine`, `client_barangay`, `client_city`, `client_province`) VALUES
(28, 'Arielle', 'Jimera', 'crypticdystopian@gmail.com', '09786457846', 'aaa', 'Employer', 'BDO', 'Software Developer', 'Avida Parkway', 'Nuvali', 'Laguna', 'Metro Manila'),
(29, 'Aishki', 'Daiteru', 'ad@gmail.com', '09567345345', 'abc', 'Employer', 'World Trade Organization', 'Pirate', '928, Marikina St.', 'Brgy. 15', 'Buenos', 'Spain'),
(30, 'Tuesday', 'Simmons', 'tusdaysimmons@gmail.com', '09455111105', 'abc', 'Employer', 'Dystopia', 'Engr', '111B, Duhat St.', 'Las Piñas', 'Las Piñas', 'Metro Manila'),
(32, 'Aqua', 'Black', 'aquablack@gmail.com', '09455111105', 'abc', 'Employer', 'ABC Corporation', 'CEO', '123 Main Street', 'Cityville', 'Texas', 'North Carolina'),
(33, 'Lizbeth', 'Jimera', 'aaaa@gmail.com', '09455111105', 'a', 'Employer', 'for Personal Errands', 'Housewife', 'Unit 6, Zeta St., Brgy. Estefania', 'Bacolod City', 'Bacolod City', 'Negros Occidental'),
(47, 'Dairin', 'Jaganap', 'dj@gmail.com', '09678567233', 'abcd', 'Employer', 'University of St. La Salle', 'Developer/Professor', '289 Ave St.,', 'Mansilingan', 'Bacolod City', 'Negros Occidental');

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `job_ID` int(11) NOT NULL,
  `client_ID` int(11) DEFAULT NULL,
  `remuneration` decimal(10,2) DEFAULT NULL,
  `jobName` varchar(255) DEFAULT NULL,
  `jobDescription` text DEFAULT NULL,
  `dateAdded` date DEFAULT NULL,
  `job_rank` varchar(50) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `job_status` enum('Pending','Completed','Not Completed') DEFAULT NULL,
  `dateCompleted` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`job_ID`, `client_ID`, `remuneration`, `jobName`, `jobDescription`, `dateAdded`, `job_rank`, `deadline`, `job_status`, `dateCompleted`) VALUES
(29, 29, 5000.00, 'Pet Sitting', 'Taking care of a pet while the owner is away, including feeding, walking, and playing.', '2024-03-11', 'B', '2024-03-22', 'Pending', NULL),
(30, 30, 8000.00, 'Data Entry', ' Entering customer information into a database system.', '2024-03-11', 'B', '2024-04-02', 'Pending', NULL),
(35, 28, 2000.00, ' Clean the House', 'Perform general cleaning tasks in the house.', '2024-03-13', 'C', '2024-03-23', 'Not Completed', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `petition`
--

CREATE TABLE `petition` (
  `req_ID` int(11) NOT NULL,
  `applicant_ID` int(11) DEFAULT NULL,
  `client_ID` int(11) DEFAULT NULL,
  `req_name` varchar(255) DEFAULT NULL,
  `req_description` text DEFAULT NULL,
  `req_category` enum('DELETE','RANK') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `petition`
--

INSERT INTO `petition` (`req_ID`, `applicant_ID`, `client_ID`, `req_name`, `req_description`, `req_category`) VALUES
(8, NULL, 28, 'Account Deletion', 'User wants to delete account', 'DELETE'),
(21, 5, NULL, 'Account Deletion', 'User wants to delete account', 'DELETE'),
(23, 5, NULL, 'Account Deletion', 'User wants to delete account', 'RANK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_ID`);

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`applicant_ID`);

--
-- Indexes for table `applications_list`
--
ALTER TABLE `applications_list`
  ADD PRIMARY KEY (`application_ID`),
  ADD KEY `job_ID` (`job_ID`),
  ADD KEY `applicant_ID` (`applicant_ID`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`client_ID`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`job_ID`),
  ADD KEY `client_ID` (`client_ID`);

--
-- Indexes for table `petition`
--
ALTER TABLE `petition`
  ADD PRIMARY KEY (`req_ID`),
  ADD KEY `employee_ID` (`applicant_ID`),
  ADD KEY `client_ID` (`client_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `applicant`
--
ALTER TABLE `applicant`
  MODIFY `applicant_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `applications_list`
--
ALTER TABLE `applications_list`
  MODIFY `application_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `client_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `job_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `petition`
--
ALTER TABLE `petition`
  MODIFY `req_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications_list`
--
ALTER TABLE `applications_list`
  ADD CONSTRAINT `fk_application_applicant` FOREIGN KEY (`applicant_ID`) REFERENCES `applicant` (`applicant_ID`),
  ADD CONSTRAINT `fk_application_job` FOREIGN KEY (`job_ID`) REFERENCES `job` (`job_ID`);

--
-- Constraints for table `job`
--
ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_2` FOREIGN KEY (`client_ID`) REFERENCES `employer` (`client_ID`);

--
-- Constraints for table `petition`
--
ALTER TABLE `petition`
  ADD CONSTRAINT `client_ID` FOREIGN KEY (`client_ID`) REFERENCES `employer` (`client_ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `petition_ibfk_1` FOREIGN KEY (`applicant_ID`) REFERENCES `applicant` (`applicant_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
