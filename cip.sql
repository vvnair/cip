-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 09, 2017 at 10:26 AM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cip`
--

-- --------------------------------------------------------

--
-- Table structure for table `cip_address`
--

CREATE TABLE `cip_address` (
  `id` int(11) NOT NULL,
  `baddress1` varchar(200) NOT NULL,
  `baddress2` varchar(200) NOT NULL,
  `baddress3` varchar(100) NOT NULL,
  `bcity` varchar(100) NOT NULL,
  `bstate` varchar(100) NOT NULL,
  `bcountry` varchar(100) NOT NULL,
  `bzipcode` int(10) NOT NULL,
  `iaddress1` varchar(100) NOT NULL,
  `iaddress2` varchar(100) NOT NULL,
  `iaddress3` varchar(100) NOT NULL,
  `icity` varchar(100) NOT NULL,
  `istate` varchar(100) NOT NULL,
  `icountry` varchar(100) NOT NULL,
  `izipcode` int(10) NOT NULL,
  `request_number` varchar(100) NOT NULL,
  `request_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `localcontact` varchar(100) NOT NULL,
  `localcontactnum1` int(15) NOT NULL,
  `localcontactnum2` int(15) NOT NULL,
  `localcontactemail` varchar(100) NOT NULL,
  `bandwidth` int(100) NOT NULL,
  `igst` varchar(50) NOT NULL,
  `bgst` varchar(50) NOT NULL,
  `company` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cip_companies`
--

CREATE TABLE `cip_companies` (
  `id` int(11) NOT NULL,
  `company` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cip_company_users`
--

CREATE TABLE `cip_company_users` (
  `id` int(11) NOT NULL,
  `company` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cip_customer_uploads`
--

CREATE TABLE `cip_customer_uploads` (
  `id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `filepath` varchar(200) NOT NULL,
  `fullpath` varchar(200) NOT NULL,
  `sr_request_number` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cip_proposal_status`
--

CREATE TABLE `cip_proposal_status` (
  `id` int(11) NOT NULL,
  `sr_request_number` varchar(100) NOT NULL,
  `proposal_status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cip_sr_date`
--

CREATE TABLE `cip_sr_date` (
  `id` int(11) NOT NULL,
  `sr_request_number` varchar(50) NOT NULL,
  `update_date` date NOT NULL,
  `updated_by` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cip_sr_status`
--

CREATE TABLE `cip_sr_status` (
  `id` int(11) NOT NULL,
  `sr_request_id` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `sr_request_number` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cip_uploads`
--

CREATE TABLE `cip_uploads` (
  `id` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `filepath` varchar(200) NOT NULL,
  `fullpath` varchar(200) NOT NULL,
  `sr_request_number` varchar(100) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cip_users`
--

CREATE TABLE `cip_users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `isadmin` int(1) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cip_users`
--

INSERT INTO `cip_users` (`id`, `email`, `name`, `password`, `company_name`, `isadmin`, `role`) VALUES
(1, 'admin@gmail.com', 'admin', 'pass', 'company', 1, 'vendoradmin'),
(2, 'bijusn@gmail.com', 'biju', 'pass', 'Brit', 0, 'customer'),
(3, 'customeradmin@gmail.com', 'Customer Admin', 'pass', 'Brit', 0, 'customeradmin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cip_address`
--
ALTER TABLE `cip_address`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `request_number` (`request_number`);

--
-- Indexes for table `cip_companies`
--
ALTER TABLE `cip_companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cip_company_users`
--
ALTER TABLE `cip_company_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cip_customer_uploads`
--
ALTER TABLE `cip_customer_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cip_proposal_status`
--
ALTER TABLE `cip_proposal_status`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sr_request_number` (`sr_request_number`);

--
-- Indexes for table `cip_sr_date`
--
ALTER TABLE `cip_sr_date`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cip_sr_status`
--
ALTER TABLE `cip_sr_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cip_uploads`
--
ALTER TABLE `cip_uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cip_users`
--
ALTER TABLE `cip_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cip_address`
--
ALTER TABLE `cip_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cip_companies`
--
ALTER TABLE `cip_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cip_company_users`
--
ALTER TABLE `cip_company_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cip_customer_uploads`
--
ALTER TABLE `cip_customer_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cip_proposal_status`
--
ALTER TABLE `cip_proposal_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cip_sr_date`
--
ALTER TABLE `cip_sr_date`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cip_sr_status`
--
ALTER TABLE `cip_sr_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cip_uploads`
--
ALTER TABLE `cip_uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cip_users`
--
ALTER TABLE `cip_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
