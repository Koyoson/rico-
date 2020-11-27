-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2020 at 04:47 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rico`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(12) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `username`, `password`) VALUES
(1, 'mzee ', 'pepe'),
(2, 'diablo', 'zeus'),
(3, 'Pepe', '$2y$10$etHinskcAH80M38jYhffuu8dGeVKw8rYstcATWBcjuNPKYzm5YsTu');

-- --------------------------------------------------------

--
-- Table structure for table `breed`
--

CREATE TABLE `breed` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `breed`
--

INSERT INTO `breed` (`id`, `name`) VALUES
(200, 'German Shepherd Dogs'),
(201, 'Dachshund'),
(202, 'Newyorkshire Terrier'),
(203, 'Labs');

-- --------------------------------------------------------

--
-- Table structure for table `deworming_records`
--

CREATE TABLE `deworming_records` (
  `id` int(10) NOT NULL,
  `medicine_batch_no` int(10) NOT NULL,
  `dog_reg_no` int(10) NOT NULL,
  `vet_kvb_no` int(10) NOT NULL,
  `deworming_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `deworming_records`
--

INSERT INTO `deworming_records` (`id`, `medicine_batch_no`, `dog_reg_no`, `vet_kvb_no`, `deworming_date`) VALUES
(180925, 207944, 18676, 2417, '2020-11-11'),
(180926, 207944, 18677, 3103, '2020-11-11');

-- --------------------------------------------------------

--
-- Table structure for table `dog`
--

CREATE TABLE `dog` (
  `reg_no` int(10) NOT NULL,
  `breed_id` int(10) NOT NULL,
  `description` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `gender` tinyint(10) NOT NULL,
  `reg_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dog`
--

INSERT INTO `dog` (`reg_no`, `breed_id`, `description`, `dob`, `gender`, `reg_name`) VALUES
(18676, 200, 'Black and Tan', '2020-11-13', 0, 'Euro Salamanda'),
(18677, 201, 'Black and Tan', '2020-11-13', 0, 'Oreo Kado');

-- --------------------------------------------------------

--
-- Table structure for table `dog_certificates`
--

CREATE TABLE `dog_certificates` (
  `certificate_no` int(10) NOT NULL,
  `dog_reg_no` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dog_certificates`
--

INSERT INTO `dog_certificates` (`certificate_no`, `dog_reg_no`) VALUES
(221017, 18676),
(221018, 18677);

-- --------------------------------------------------------

--
-- Table structure for table `dog_medication`
--

CREATE TABLE `dog_medication` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dog_medication`
--

INSERT INTO `dog_medication` (`id`, `name`, `quantity`) VALUES
(3280, 'Vermic Total', 50),
(8617, 'Parvo Virus', 8);

-- --------------------------------------------------------

--
-- Table structure for table `dog_owner`
--

CREATE TABLE `dog_owner` (
  `id` int(10) NOT NULL,
  `dog_reg_no` int(10) NOT NULL,
  `owner_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dog_owner`
--

INSERT INTO `dog_owner` (`id`, `dog_reg_no`, `owner_id`) VALUES
(150, 18676, 300),
(151, 18677, 301);

-- --------------------------------------------------------

--
-- Table structure for table `medicine_flow`
--

CREATE TABLE `medicine_flow` (
  `batch_no` int(10) NOT NULL,
  `medicine_id` int(10) NOT NULL,
  `purchase_date` datetime(6) NOT NULL,
  `purchase_quantity` int(10) NOT NULL,
  `expiry_date` date NOT NULL,
  `buying_price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine_flow`
--

INSERT INTO `medicine_flow` (`batch_no`, `medicine_id`, `purchase_date`, `purchase_quantity`, `expiry_date`, `buying_price`) VALUES
(207944, 3280, '2020-11-10 13:26:52.000000', 10, '2021-03-16', 250),
(221840, 8617, '2020-11-10 13:26:52.000000', 10, '2021-01-27', 500);

-- --------------------------------------------------------

--
-- Table structure for table `microchip_details`
--

CREATE TABLE `microchip_details` (
  `microchip_no` int(10) NOT NULL,
  `dog_reg_no` int(10) NOT NULL,
  `implanted by` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `microchip_details`
--

INSERT INTO `microchip_details` (`microchip_no`, `dog_reg_no`, `implanted by`) VALUES
(10738235, 18677, 'Lilyan'),
(10738236, 18676, 'Kitheka ');

-- --------------------------------------------------------

--
-- Table structure for table `owner_contacts`
--

CREATE TABLE `owner_contacts` (
  `contact` int(20) NOT NULL,
  `owner_id` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner_contacts`
--

INSERT INTO `owner_contacts` (`contact`, `owner_id`) VALUES
(737100911, 300),
(702242533, 301);

-- --------------------------------------------------------

--
-- Table structure for table `owner_details`
--

CREATE TABLE `owner_details` (
  `id` int(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner_details`
--

INSERT INTO `owner_details` (`id`, `name`, `address`) VALUES
(300, 'Argwings O', '9327-00100'),
(301, 'Koyoson As', '020-4227, ');

-- --------------------------------------------------------

--
-- Table structure for table `vaccination`
--

CREATE TABLE `vaccination` (
  `id` int(10) NOT NULL,
  `medicine_batch_no` int(10) NOT NULL,
  `dog_reg_no` int(10) NOT NULL,
  `vet_kvb_no` int(10) NOT NULL,
  `vaccination date` datetime(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vaccination`
--

INSERT INTO `vaccination` (`id`, `medicine_batch_no`, `dog_reg_no`, `vet_kvb_no`, `vaccination date`) VALUES
(49007, 221840, 18676, 2417, '2020-11-13 13:28:48.000000'),
(49008, 221840, 18677, 3103, '2020-11-13 13:29:25.000000');

-- --------------------------------------------------------

--
-- Table structure for table `vet_contacts`
--

CREATE TABLE `vet_contacts` (
  `contact` int(15) NOT NULL,
  `kvb_no` int(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vet_contacts`
--

INSERT INTO `vet_contacts` (`contact`, `kvb_no`) VALUES
(720737646, 2417),
(716274562, 3103);

-- --------------------------------------------------------

--
-- Table structure for table `vet_details`
--

CREATE TABLE `vet_details` (
  `kvb_no` int(20) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vet_details`
--

INSERT INTO `vet_details` (`kvb_no`, `name`) VALUES
(2417, 'Lilyan'),
(3103, 'Kitheka ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `breed`
--
ALTER TABLE `breed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `deworming_records`
--
ALTER TABLE `deworming_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicine_batch_no` (`medicine_batch_no`),
  ADD KEY `vet_kvb_no` (`vet_kvb_no`),
  ADD KEY `deworming_records_ibfk_1` (`dog_reg_no`);

--
-- Indexes for table `dog`
--
ALTER TABLE `dog`
  ADD PRIMARY KEY (`reg_no`),
  ADD KEY `breed_id` (`breed_id`);

--
-- Indexes for table `dog_certificates`
--
ALTER TABLE `dog_certificates`
  ADD PRIMARY KEY (`certificate_no`),
  ADD KEY `dog_reg_no` (`dog_reg_no`);

--
-- Indexes for table `dog_medication`
--
ALTER TABLE `dog_medication`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dog_owner`
--
ALTER TABLE `dog_owner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dog_reg_no` (`dog_reg_no`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `medicine_flow`
--
ALTER TABLE `medicine_flow`
  ADD PRIMARY KEY (`batch_no`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Indexes for table `microchip_details`
--
ALTER TABLE `microchip_details`
  ADD PRIMARY KEY (`microchip_no`),
  ADD KEY `dog_reg_no` (`dog_reg_no`);

--
-- Indexes for table `owner_contacts`
--
ALTER TABLE `owner_contacts`
  ADD PRIMARY KEY (`contact`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `owner_details`
--
ALTER TABLE `owner_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicine_batch_no` (`medicine_batch_no`),
  ADD KEY `vet_kvb_no` (`vet_kvb_no`),
  ADD KEY `vaccination_ibfk_1` (`dog_reg_no`);

--
-- Indexes for table `vet_contacts`
--
ALTER TABLE `vet_contacts`
  ADD PRIMARY KEY (`contact`),
  ADD KEY `kvb_no` (`kvb_no`);

--
-- Indexes for table `vet_details`
--
ALTER TABLE `vet_details`
  ADD PRIMARY KEY (`kvb_no`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `deworming_records`
--
ALTER TABLE `deworming_records`
  ADD CONSTRAINT `deworming_records_ibfk_1` FOREIGN KEY (`dog_reg_no`) REFERENCES `dog` (`reg_no`),
  ADD CONSTRAINT `deworming_records_ibfk_2` FOREIGN KEY (`medicine_batch_no`) REFERENCES `medicine_flow` (`batch_no`),
  ADD CONSTRAINT `deworming_records_ibfk_3` FOREIGN KEY (`vet_kvb_no`) REFERENCES `vet_details` (`kvb_no`);

--
-- Constraints for table `dog`
--
ALTER TABLE `dog`
  ADD CONSTRAINT `dog_ibfk_1` FOREIGN KEY (`breed_id`) REFERENCES `breed` (`id`);

--
-- Constraints for table `dog_certificates`
--
ALTER TABLE `dog_certificates`
  ADD CONSTRAINT `dog_certificates_ibfk_1` FOREIGN KEY (`dog_reg_no`) REFERENCES `dog` (`reg_no`);

--
-- Constraints for table `dog_owner`
--
ALTER TABLE `dog_owner`
  ADD CONSTRAINT `dog_owner_ibfk_1` FOREIGN KEY (`dog_reg_no`) REFERENCES `dog` (`reg_no`),
  ADD CONSTRAINT `dog_owner_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `owner_details` (`id`);

--
-- Constraints for table `medicine_flow`
--
ALTER TABLE `medicine_flow`
  ADD CONSTRAINT `medicine_flow_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `dog_medication` (`id`);

--
-- Constraints for table `microchip_details`
--
ALTER TABLE `microchip_details`
  ADD CONSTRAINT `microchip_details_ibfk_1` FOREIGN KEY (`dog_reg_no`) REFERENCES `dog` (`reg_no`);

--
-- Constraints for table `owner_contacts`
--
ALTER TABLE `owner_contacts`
  ADD CONSTRAINT `owner_contacts_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owner_details` (`id`);

--
-- Constraints for table `vaccination`
--
ALTER TABLE `vaccination`
  ADD CONSTRAINT `vaccination_ibfk_1` FOREIGN KEY (`dog_reg_no`) REFERENCES `dog` (`reg_no`),
  ADD CONSTRAINT `vaccination_ibfk_2` FOREIGN KEY (`medicine_batch_no`) REFERENCES `medicine_flow` (`batch_no`),
  ADD CONSTRAINT `vaccination_ibfk_3` FOREIGN KEY (`vet_kvb_no`) REFERENCES `vet_details` (`kvb_no`);

--
-- Constraints for table `vet_contacts`
--
ALTER TABLE `vet_contacts`
  ADD CONSTRAINT `vet_contacts_ibfk_1` FOREIGN KEY (`kvb_no`) REFERENCES `vet_details` (`kvb_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
