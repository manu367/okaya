-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 10.1.20.253:3306
-- Generation Time: Feb 11, 2026 at 01:28 PM
-- Server version: 10.5.29-MariaDB
-- PHP Version: 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `okaya2_crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(5) NOT NULL,
  `uid` int(11) NOT NULL,
  `sapid` varchar(30) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `utype` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `emailid` varchar(50) DEFAULT NULL,
  `stateid` int(4) NOT NULL,
  `cityid` int(4) NOT NULL,
  `designation_id` int(5) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `createdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updatedate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tt_access` varchar(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `uid`, `sapid`, `username`, `password`, `name`, `utype`, `phone`, `emailid`, `stateid`, `cityid`, `designation_id`, `status`, `createdate`, `updatedate`, `tt_access`) VALUES
(1, 1, '121212', 'test', 'pass@123', 'Candour (Admin)', 'admin', '8826693946', 'info@candoursoft.com', 0, 0, 23, 1, '0000-00-00 00:00:00', '2026-01-24 12:36:20', 'Y'),
(19, 2, 'EMP000709', 'OKAYAUSR002', 'Okaya@12345', 'Ajay Kumar Shaw', 'admin', '8860785258', 'ajay.shaw@okaya.in', 0, 0, 45, 1, '2026-01-24 02:22:17', '2026-02-02 23:18:31', ''),
(20, 3, 'EMP000684', 'OKAYAUSR003', 'Uday@54321', 'Udaybhan Prasad', 'admin', '9971894448', 'uday.prasad@okaya.in', 0, 0, 29, 1, '2026-01-24 18:26:52', '2026-02-02 11:16:57', ''),
(21, 4, 'EMP001742', 'OKAYAUSR004', 'Vinit@54321', 'Vinit Kumar', 'admin', '9319993338', 'bsi.gurgaon@okaya.in', 0, 0, 45, 1, '2026-01-24 18:30:23', '2026-02-02 11:04:43', ''),
(22, 5, 'EMP000570', 'OKAYAUSR005', 'Rajeev@54321', 'Rajeev Kumar', 'admin', '9971115241', 'rajeev.kumar@okaya.in', 0, 0, 23, 1, '2026-01-24 19:38:04', '2026-02-02 15:20:29', ''),
(23, 6, 'EMP001435', 'OKAYAUSR006', 'Navin@54321', 'Navin Kumar', 'admin', '9650222447', 'navin.kumar@okaya.in', 0, 0, 21, 1, '2026-01-24 19:46:03', '2026-02-02 15:11:33', ''),
(24, 7, 'EMP000265', 'OKAYAUSR007', 'Ankush@54321', 'Ankush Jyoti Sharma', 'admin', '9858846564', 'bsi.jammu@okaya.in', 0, 0, 45, 1, '2026-02-02 11:19:09', '0000-00-00 00:00:00', ''),
(25, 8, 'EMP000328', 'OKAYAUSR008', 'Mukesh@54321', 'Mukesh Kumar', 'admin', '9625270857', 'bsi.lucknow@okaya.in', 0, 0, 45, 1, '2026-02-02 11:33:55', '0000-00-00 00:00:00', ''),
(26, 9, 'EMP000574', 'OKAYAUSR009', 'Sunil@54321', 'Sunil Kumar', 'admin', '8818080035', 'bsi.ambala@okaya.in', 0, 0, 45, 1, '2026-02-02 11:38:53', '0000-00-00 00:00:00', ''),
(27, 10, 'EMP000576', 'OKAYAUSR010', 'Utkarsh@54321', 'Utkarsh Rai', 'admin', '8858215804', 'bsi.varanasi@okaya.in', 0, 0, 45, 1, '2026-02-02 11:45:01', '0000-00-00 00:00:00', ''),
(28, 11, 'EMP000580', 'OKAYAUSR011', 'Bagish@54321', 'Bagish Kumar Tripathi', 'admin', '9839154105', 'bsi.gorakhpur@okaya.in', 0, 0, 45, 1, '2026-02-02 11:51:07', '0000-00-00 00:00:00', ''),
(29, 12, 'EMP000629', 'OKAYAUSR012', 'Amit@54321', 'Amit Kumar Sinha', 'admin', '9135004163', 'bsi.patna@okaya.in', 0, 0, 45, 1, '2026-02-02 11:53:28', '0000-00-00 00:00:00', ''),
(30, 13, 'EMP000714', 'OKAYAUSR013', 'Sanjay@54321', 'Sanjay Rautela', 'admin', '9760321135', 'bsi.dehradun@okaya.in', 0, 0, 45, 1, '2026-02-02 11:57:27', '0000-00-00 00:00:00', ''),
(31, 14, 'EMP000766', 'OKAYAUSR014', 'Sheo@54321', 'Sheo Kumar Singh', 'admin', '7979890785', 'bsi.ranchi@okaya.in', 0, 0, 45, 1, '2026-02-02 12:00:27', '0000-00-00 00:00:00', ''),
(32, 15, 'EMP000767', 'OKAYAUSR015', 'Sayyed@54321', 'Sayyed Hasan', 'admin', '8269047417', 'bsi.indore@okaya.in', 0, 0, 45, 1, '2026-02-02 12:05:01', '0000-00-00 00:00:00', ''),
(33, 16, 'EMP000827', 'OKAYAUSR016', 'Saumya@54321', 'Saumya Ranjan Swain', 'admin', '8895821789', 'bsi.cuttack@okaya.in', 0, 0, 45, 1, '2026-02-02 12:09:52', '0000-00-00 00:00:00', ''),
(34, 17, 'EMP001064', 'OKAYAUSR017', 'Mahesh@54321', 'Mahesh A Surve', 'admin', '8208519122', 'asi.gujarat@okaya.in', 0, 0, 45, 1, '2026-02-02 12:12:45', '0000-00-00 00:00:00', ''),
(35, 18, 'EMP001103', 'OKAYAUSR018', 'Atul@54321', 'Atul Sneh Pandey', 'admin', '8960343061', 'atul.pandey@okaya.in', 0, 0, 45, 1, '2026-02-02 12:16:27', '0000-00-00 00:00:00', ''),
(36, 19, 'EMP001226', 'OKAYAUSR019', 'Banshidhar@54321', 'Banshidhar Biswal', 'admin', '9711194992', 'bsi.hyderabad@okaya.in', 0, 0, 45, 1, '2026-02-02 12:18:22', '0000-00-00 00:00:00', ''),
(37, 20, 'EMP001278', 'OKAYAUSR020', 'Debjyoti@54321', 'Debjyoti Chakraborty', 'admin', '9771421165', 'bsi.bangalore@okaya.in', 0, 0, 45, 1, '2026-02-02 12:23:07', '0000-00-00 00:00:00', ''),
(38, 21, 'EMP001282', 'OKAYAUSR021', 'Lokesh@54321', 'Lokesh Kumar', 'admin', '9949764412', 'bsi.ghaziabad@okaya.in', 0, 0, 45, 1, '2026-02-02 12:25:07', '0000-00-00 00:00:00', ''),
(39, 22, 'EMP001287', 'OKAYAUSR022', 'Jitendra@54321', 'Jitendra Kumar Singh', 'admin', '9548844994', 'bsi.agra@okaya.in', 0, 0, 45, 1, '2026-02-02 12:26:54', '0000-00-00 00:00:00', ''),
(40, 23, 'EMP001736', 'OKAYAUSR023', 'Ditu@54321', 'Ditu Pal', 'admin', '6296868521', 'bsi.kolkata@okaya.in', 0, 0, 45, 1, '2026-02-02 12:28:58', '0000-00-00 00:00:00', ''),
(41, 24, 'EMP001743', 'OKAYAUSR024', 'Shailesh@54321', 'Shailesh Choudhary', 'admin', '9120896961', 'bsi.jaipur@okaya.in', 0, 0, 45, 1, '2026-02-02 12:33:54', '0000-00-00 00:00:00', ''),
(42, 25, 'EMP001772', 'OKAYAUSR025', 'Suresh@54321', 'Suresh Prajapati', 'admin', '8909718383', 'bsi.bareilly@okaya.in', 0, 0, 45, 1, '2026-02-02 12:36:57', '0000-00-00 00:00:00', ''),
(43, 26, 'EMP000946', 'OKAYAUSR026', 'Logesh@54321', 'R Logesh', 'admin', '9952862968', 'bsi.coimbatore@okaya.in', 0, 0, 45, 1, '2026-02-02 12:40:56', '0000-00-00 00:00:00', ''),
(44, 27, 'EMP000547', 'OKAYAUSR027', 'Avadhesh@54321', 'Avadhesh Kumar Pal', 'admin', '8448872634', 'avadhesh.pal@okaya.in', 0, 0, 45, 1, '2026-02-02 13:02:28', '0000-00-00 00:00:00', ''),
(45, 28, 'EMP000841', 'OKAYAUSR028', 'Renu@54321', 'Renu Yadav', 'admin', '9319666027', 'renu@okaya.in', 0, 0, 28, 1, '2026-02-02 15:14:41', '0000-00-00 00:00:00', ''),
(46, 29, 'EMP000528', 'OKAYAUSR029', 'Amar@54321', 'Amar Singh', 'admin', '9999331421', 'amar.singh@okaya.in', 0, 0, 2, 1, '2026-02-02 16:25:49', '0000-00-00 00:00:00', ''),
(47, 30, 'EMP0001156', 'OKAYAUSR030', 'Munesh@12345', 'Munesh Kumar', 'admin', '9868433090', 'munesh.kumar@okaya.in', 0, 0, 2, 1, '2026-02-03 13:04:33', '0000-00-00 00:00:00', ''),
(48, 31, 'EMP001521', 'OKAYAUSR031', 'Joshi@54321', 'Chandrakant Joshi', 'admin', '6260229110', 'asi.nagpur@okaya.in', 0, 0, 45, 1, '2026-02-03 14:56:26', '0000-00-00 00:00:00', ''),
(49, 32, 'EMP001372', 'OKAYAUSR032', 'Indranil@54321', 'Indranil Maji', 'admin', '8388013676', 'indranil.maji@okaya.in', 0, 0, 2, 1, '2026-02-03 17:40:31', '0000-00-00 00:00:00', ''),
(50, 33, 'EMP000992', 'OKAYAUSR033', 'Saravanan@123', 'P Saravanan', 'admin', '9444109577', 'p.saravanan@okaya.in', 0, 0, 2, 1, '2026-02-03 17:47:01', '0000-00-00 00:00:00', ''),
(51, 34, 'EMP000755', 'OKAYAUSR034', 'Simran@54321', 'Simran', 'admin', '8010665383', 'simransingh2181998@gmail.com', 0, 0, 29, 1, '2026-02-03 18:55:14', '0000-00-00 00:00:00', ''),
(52, 35, 'EMP000310', 'OKAYAUSR035', 'Chakravarti@12345', 'Chakravarti', 'admin', '8376829729', 'abc@gmail.com', 0, 0, 28, 1, '2026-02-05 18:13:17', '0000-00-00 00:00:00', ''),
(53, 36, 'EMP001374', 'OKAYAUSR036', 'Umesh@54321', 'Umesh Prajapati', 'admin', '9759687639', 'UMESH.PRAJAPATI@OKAYA.IN', 0, 0, 2, 1, '2026-02-07 21:21:31', '0000-00-00 00:00:00', ''),
(54, 37, 'EMP001653', 'OKAYAUSR037', 'Abhishek@54321', 'Abhishek Kumar Tripathi', 'admin', '9560859689', 'Abhishek.kumar1@okaya.in', 0, 0, 2, 1, '2026-02-07 21:28:29', '0000-00-00 00:00:00', ''),
(55, 38, 'EMP000009', 'OKAYAUSR038', 'Surya@54321', 'Surya Prakash Arora', 'admin', '9312214493', 'sparora@okaya.in', 0, 0, 23, 1, '2026-02-07 21:45:34', '0000-00-00 00:00:00', ''),
(56, 39, 'EMP001253', 'OKAYAUSR039', 'Anil@54321', 'Anil Verma', 'admin', '9899114737', 'anil.verma@okaya.in', 0, 0, 23, 1, '2026-02-07 21:50:50', '0000-00-00 00:00:00', ''),
(57, 40, 'EMP001513', 'OKAYAUSR040', 'Prashansa@54321', 'Prashansa Dixit', 'admin', '1234567890', 'prashansa.dixit@okaya.in', 0, 0, 29, 1, '2026-02-07 21:54:51', '0000-00-00 00:00:00', ''),
(58, 41, 'EMP001775', 'OKAYAUSR041', 'Pardeep@54321', 'Pardeep Pahwaal', 'admin', '9466456195', 'pardeep.pahwaal@okaya.in', 0, 0, 2, 1, '2026-02-07 21:57:15', '0000-00-00 00:00:00', ''),
(59, 42, 'EMP000649', 'OKAYAUSR042', 'Nivedita@54321', 'Nivedita', 'admin', '8377871938', 'nehabiswas1908@gmail.com', 0, 0, 29, 1, '2026-02-07 22:01:51', '0000-00-00 00:00:00', ''),
(60, 43, 'EMP000629', 'OKAYAUSR043', 'Kaushal@54321', 'Kaushal Kumar', 'admin', '7903993873', 'asi.bihar@okaya.in', 0, 0, 45, 1, '2026-02-07 22:05:28', '2026-02-07 22:05:40', ''),
(61, 44, 'EMP001736', 'OKAYAUSR044', 'Surajit@54321', 'Surajit Bachar', 'admin', '7278000767', 'asi.kolkata@okaya.in', 0, 0, 45, 1, '2026-02-07 22:11:10', '0000-00-00 00:00:00', ''),
(62, 45, 'EMP000767', 'OKAYAUSR045', 'Vikash@54321', 'Vikash Singh', 'admin', '8103338647', 'asi.indore@okaya.in', 0, 0, 45, 1, '2026-02-07 22:13:51', '0000-00-00 00:00:00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
