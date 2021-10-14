-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 18, 2021 at 06:46 AM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tos`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` varchar(10) NOT NULL,
  `password` varchar(10) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `password`) VALUES
('admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `ambulance`
--

DROP TABLE IF EXISTS `ambulance`;
CREATE TABLE IF NOT EXISTS `ambulance` (
  `amb_id` varchar(10) NOT NULL,
  `location` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  PRIMARY KEY (`amb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ambulance`
--

INSERT INTO `ambulance` (`amb_id`, `location`, `mobile`) VALUES
('amb1', 'Manipay, Jaffna', '0212227890'),
('amb10', 'Akkaraipattu, Ambara', '0636541290'),
('amb2', 'Thirunelveli, Jaffna', '0210215676'),
('amb3', 'Pointpetro, Jaffna', '0212295421'),
('amb4', 'Vinayakapuram, Ampara', '0634531754'),
('amb5', 'Vinayakapuram, Ampara', '0632347658'),
('amb6', 'Kandhapuram, Vavuniya', '0243452876'),
('amb7', 'Karainagar, Jaffna', '0212236798'),
('amb8', 'Manipay, Jaffna', '0212255656'),
('amb9', 'Negombo', '0315647896');

-- --------------------------------------------------------


--
-- Table structure for table `citizens`
--

DROP TABLE IF EXISTS `citizens`;
CREATE TABLE IF NOT EXISTS `citizens` (
  `nic` varchar(12) NOT NULL,
  `fname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lname` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `nic_issued` date NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(50) NOT NULL,
  PRIMARY KEY (`nic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `citizens`
--

INSERT INTO `citizens` (`nic`, `fname`, `lname`, `nic_issued`, `dob`, `address`) VALUES
('456789123v', 'Sairaman', 'Aanathasivam', '1964-01-08', '1945-06-03', '12/B , kumaari veethi, kompai paalam. Vavuniya'),
('952832301v', 'Sivakaran', 'Nadarajah', '0000-00-00', '1995-10-09', 'Oddumadam jaffna\\r\\n'),
('962000088v', 'Dinushan', 'Selvarasa', '2012-07-27', '1996-07-18', '54/3, main street, vavuniya'),
('962610536v', 'Karthigan', 'Selvarajan', '2012-11-22', '1996-11-22', 'Koolavady east, Inuvil, Jaffna'),
('962683355v', 'Jeyasuntharam', 'Kamaniecharan', '2012-11-22', '1996-09-24', 'Cental road, Selvanagar, Arayampathy'),
('962820249v', 'Mathusan', 'Sivalingam', '2020-06-03', '1996-10-08', 'atchuvely ,jaffna'),
('966090090v ', 'Chethana', 'Wickramaarachchi ', '2014-10-23', '1996-04-18', '109/11 beliatta road walasmulla'),
('966094141v ', 'Prasagini', 'Bandara ', '2014-05-17', '1997-04-18', '104/1B main street, walasmulla'),
('970783288V', 'Nerojan', 'Balasubramaniyam', '2013-09-18', '1997-03-18', 'Kalanithy road, Erlalai north, Erlalai'),
('970901159v', 'Udula', 'Eranda', '2013-07-04', '1997-03-30', 'No 33/c/4,samagi place, walpola, rickghawila'),
('970990259V', 'Lasitha', 'Priyalal', '2013-05-13', '1997-04-08', '\"Jayalath\", Meegahapitiya, Dambagalla, Monaragala.'),
('973011952v ', 'Maathusan ', 'Gnanamoorthy ', '2013-11-06', '1997-10-27', 'Atchuvley west Atchuvley, jaffna'),
('977730651v', 'Subahary', 'Ketheeswaran', '2013-10-10', '1997-09-29', 'Katpakapillayar kovilady Kopay South Kopay kopy'),
('977803055V', 'Ielamathy', 'Manivannan', '2013-11-05', '1997-10-06', 'Koolavady east, Anaicoddai, Jaffna'),
('977972981V', 'Sobika', 'Balakrishnan', '2013-11-05', '1997-10-23', '\"Mathavady road,Kaddudai, Manipay,Jaffna'),
('982490677V', 'Kapilan', 'Sriranjan', '2014-10-14', '1998-09-05', '394/5 K.K.S Road, Jaffna'),
('982511224V', 'Tharsalan', 'Mahendran', '2014-10-14', '1998-09-05', '12/B , kumaari veethi, kompai paalam. Vavuniya'),
('988341193v', 'Suganthini', 'Gobalakrishnan ', '2015-02-24', '1998-11-29', 'Sasthiriyar Lane,Thumpalai,Point pedro');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE IF NOT EXISTS `drivers` (
  `license_no` varchar(15) NOT NULL,
  `nic` varchar(12) NOT NULL,
  `issued_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `type` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`license_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`license_no`, `nic`, `issued_date`, `expiry_date`, `status`, `type`) VALUES
('\'B3372426\'', '\'973011952v ', '0000-00-00', '0000-00-00', 0, 'A1;A;B1;B;G1'),
('\'B3465815\'', '\'977803055V\'', '2017-01-19', '2025-01-17', 0, 'A1;A;B;G1'),
('\'B3570042\'', '\'977730651v\'', '2018-01-05', '2025-12-26', 0, 'A1;A;B;G1'),
('\'B3588512\'', '\'962683355v\'', '2016-11-17', '2024-10-11', 0, 'A1;A;B1;B;G1'),
('B3204354', '952832301v', '2016-01-22', '2023-10-01', 0, 'A1;A;B;G1');

-- --------------------------------------------------------

--
-- Table structure for table `duty_details`
--

DROP TABLE IF EXISTS `duty_details`;
CREATE TABLE IF NOT EXISTS `duty_details` (
  `attend_no` varchar(15) NOT NULL,
  `location` varchar(40) NOT NULL,
  `off_time` time NOT NULL,
  `officer_id` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`attend_no`,`officer_id`),
  KEY `fk_officerid` (`officer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `duty_details`
--

INSERT INTO `duty_details` (`attend_no`, `location`, `off_time`, `officer_id`) VALUES
('a001', 'Karainagar', '21:30:22', 't002'),
('a002', 'Kopay', '20:00:00', 't005'),
('a003', 'Kalmunai', '19:30:00', 't001'),
('a004', 'Petta, no 6', '18:00:00', 't008');

-- --------------------------------------------------------

--
-- Table structure for table `fine_details`
--

DROP TABLE IF EXISTS `fine_details`;
CREATE TABLE IF NOT EXISTS `fine_details` (
  `act_no` varchar(15) NOT NULL,
  `offence_name` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `amount` int NOT NULL,
  PRIMARY KEY (`act_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `fine_details`
--

INSERT INTO `fine_details` (`act_no`, `offence_name`, `amount`) VALUES
('d001', 'Drunk driving', 1500),
('d002', 'Traffic light violation', 1000),
('d003', 'No helmet', 500),
('d004', 'No seatbelt', 500),
('d005', 'No child seatbelt', 1500),
('d006', 'No stopping or standing', 3000),
('d007', 'Defect of vehicle maintence', 5000),
('d008', 'over Speed', 5500),
('d009', 'Violation of mobile phone restriction', 2000),
('d011', 'Failure to stop at a stop sign', 3500),
('d012', 'Designated turning violation', 2500);

-- --------------------------------------------------------

--
-- Table structure for table `found_vehicle`
--

DROP TABLE IF EXISTS `found_vehicle`;
CREATE TABLE IF NOT EXISTS `found_vehicle` (
  `serial_no` int NOT NULL AUTO_INCREMENT,
  `cessi_no` varchar(15) NOT NULL,
  `reporter_id` varchar(10) NOT NULL,
  `reg_no` varchar(10) NOT NULL,
  `location` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`serial_no`),
  KEY `reporter_id` (`reporter_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18009 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `found_vehicle`
--

INSERT INTO `found_vehicle` (`serial_no`, `cessi_no`, `reporter_id`, `reg_no`, `location`, `date`, `status`) VALUES
(18001, 'J75623W23', 't001', 'r0056', 'Puthukudijirupu', '2018-12-03', 'found'),
(18002, 'V75203D23', 't004', 'r0041', 'udupiidy', '2020-11-02', 'not found'),
(18003, 'b75624t12', 't007', 'r52695', 'kalawanchikudi', '2021-01-18', 'not found'),
(18004, 'V15623D43', 't002', 'r45200', 'pasara', '2019-01-11', 'found');

-- --------------------------------------------------------

--
-- Table structure for table `help`
--

DROP TABLE IF EXISTS `help`;
CREATE TABLE IF NOT EXISTS `help` (
  `request_no` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `location` varchar(40) NOT NULL,
  `message` varchar(40) NOT NULL,
  `license_no` varchar(15) NOT NULL,
  PRIMARY KEY (`request_no`),
  KEY `fk_license_no` (`license_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `help`
--

INSERT INTO `help` (`request_no`, `date`, `location`, `message`, `license_no`) VALUES
('rq384200', '2021-06-10', 'point pedro', 'accident', '\'B3588512\''),
('rq534201', '2021-03-31', 'Wellikul oya', 'accident', '\'B3465815\''),
('rq984247', '2021-04-29', 'kelani', 'accident', 'B3204354');

-- --------------------------------------------------------

--
-- Table structure for table `offence`
--

DROP TABLE IF EXISTS `offence`;
CREATE TABLE IF NOT EXISTS `offence` (
  `offence_id` varchar(10) NOT NULL,
  `offender_id` varchar(10) NOT NULL,
  `reporter_id` varchar(10) NOT NULL,
  `act_no` varchar(10) NOT NULL,
  `location` varchar(40) NOT NULL,
  `time` date NOT NULL,
  PRIMARY KEY (`offence_id`),
  KEY `fk_act_no` (`act_no`),
  KEY `fk_reporter_id` (`reporter_id`),
  KEY `fk_offender_id` (`offender_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `offence`
--

INSERT INTO `offence` (`offence_id`, `offender_id`, `reporter_id`, `act_no`, `location`, `time`) VALUES
('off20154', '\'B3588512\'', 't005', 'd008', 'Maankulam', '2021-03-15'),
('off56234', '\'B3372426\'', 't008', 'd001', 'pasara', '2021-06-01'),
('off56277', '\'B3570042\'', 't004', 'd005', 'Pesaalai', '2021-04-01'),
('off565482', 'B3204354', 't001', 'd003', 'Vinayagapuram', '2021-05-10'),
('off95214', '\'B3570042\'', 't007', 'd005', 'Welimada', '2021-03-09');

-- --------------------------------------------------------

--
-- Table structure for table `officer`
--

DROP TABLE IF EXISTS `officer`;
CREATE TABLE IF NOT EXISTS `officer` (
  `officer_id` varchar(10) NOT NULL,
  `fname` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `lname` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `station` varchar(20) NOT NULL,
  `password` varchar(15) NOT NULL,
  `address` varchar(40) NOT NULL,
  `email` varchar(25) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  PRIMARY KEY (`officer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `officer`
--

INSERT INTO `officer` (`officer_id`, `fname`, `lname`, `station`, `password`, `address`, `email`, `mobile`) VALUES
('t001', 'Lasith', 'Malinga', 'Rathgama,Galle', 't001(1)', '564/2, Bazaar street, Rathgama', 'malingaa65@gmail.com', '0775842369'),
('t002', 'Malsha', 'Jayaweera', 'puliyampokuna', 't002(2)', '52/2A, Kandawala,puliyampokuna', 'malsha@yahoo.com', '0746523001'),
('t003', 'Thanushan', 'Kanagendran', 'Thirukovil', 't003(3)', '982/2, thirukovil, ampara', 'cst18030@cst.uwu.ac.lk', '0774215980'),
('t004', 'Kirubantan', 'shiyamalan', 'navatkuli', 't004(4)', 'Navatkuli south, navatkuli', 'mrt18020@hotmail.com', '0778978877'),
('t005', 'Sinnaiyah', 'kishalan', 'idalgashina', 't005(5)', '45/8D, Oliypad lane, hatton', 'pichumani@yahoo.com', '0774521001'),
('t006', 'Lahiru', 'Sandaruwan', 'negochu', 't006(6)', 'No9, pillwana road, negombo', 'lahiru345@gmail.com', '0785301898'),
('t007', 'sangaralingam', 'jathukulan', 'kinniya', 't007(7)', '55B, bus stand, trincomalee', 'cst18050@gmail.com', '0789510015'),
('t008', 'Shanthikumar', 'kowsalya', 'petta', 't008(8)', '85/B, floor street, colmbo no5', 'iit18000@gmail.com', '0775144744');

-- --------------------------------------------------------

--
-- Table structure for table `spotfine`
--

DROP TABLE IF EXISTS `spotfine`;
CREATE TABLE IF NOT EXISTS `spotfine` (
  `spotfine_no` varchar(10) NOT NULL,
  `payment` int NOT NULL,
  `expiry_date` date NOT NULL,
  `offence_id` varchar(10) NOT NULL,
  PRIMARY KEY (`spotfine_no`),
  KEY `fk_offence_id` (`offence_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `spotfine`
--

INSERT INTO `spotfine` (`spotfine_no`, `payment`, `expiry_date`, `offence_id`) VALUES
('sf251452', 2000, '2021-06-15', 'off56234'),
('sf253546', 3000, '2021-06-16', 'off20154'),
('sf253998', 1500, '2021-04-06', 'off56277');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `nic` varchar(12) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(25) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`nic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`nic`, `mobile`, `email`, `password`) VALUES
('959632004v', '0789809878', 'nadarajahsivakaran1995@gm', 'u10'),
('962000088v', '778965436', 'dash@gmail.com', 'u01'),
('962683355v', '712121789', 'Maathusan6@gmail.com', 'u02'),
('970783288V', '776542314', 'nirojanros97@gmail.com', 'u03'),
('970990259V', '711909456', 'lasithapriyalal111@gmail.', 'u04'),
('973011952v ', '712345678', 'kamaniechar7276@gmail.com', 'u05'),
('977730651v', '778998980', 'subaharyk@gmail.com', 'u06'),
('977803055V', '764610992', 'mielamathy@gmail.com', 'u07'),
('977972981V', '759996756', 'sobisobika23@gmail.com', 'u09'),
('988341193v', '783427657', 'suganthini29@gmail.com', 'u09');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
CREATE TABLE IF NOT EXISTS `vehicles` (
  `reg_no` varchar(10) NOT NULL,
  `reg_date` date NOT NULL,
  `cessi_no` varchar(10) NOT NULL,
  `owner_nic` varchar(12) NOT NULL,
  `type` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`reg_no`),
  KEY `kf_nic` (`owner_nic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`reg_no`, `reg_date`, `cessi_no`, `owner_nic`, `type`) VALUES
('r106943', '2010-01-21', 'b75678jE12', '977803055V', 'car'),
('r423795', '2012-07-12', 'S99623D43', '977803055V', 'motor bike'),
('r458523', '2016-09-22', 'V1564Wj43', '966090090v ', 'bus'),
('r865424', '2015-05-12', 'V75207E56', '952832301v', 'car');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_lost`
--

DROP TABLE IF EXISTS `vehicle_lost`;
CREATE TABLE IF NOT EXISTS `vehicle_lost` (
  `complaint_id` varchar(15) NOT NULL,
  `reg_no` varchar(15) NOT NULL,
  `cessi_no` varchar(15) NOT NULL,
  `owner_nic` varchar(12) NOT NULL,
  `lost_date` date NOT NULL,
  PRIMARY KEY (`complaint_id`),
  KEY `fk_owner_nic` (`owner_nic`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `vehicle_lost`
--

INSERT INTO `vehicle_lost` (`complaint_id`, `reg_no`, `cessi_no`, `owner_nic`, `lost_date`) VALUES
('cm568230', 'r865213', 'b756gUK79', '962683355v', '2021-01-05'),
('cm568953', 'r563278', 'V15W463D43', '962000088v', '2014-05-19'),
('cm982100', 'r689578', 'V1562J56M4', '970990259V', '2021-06-17'),
('cm982243', 'r541515', 'V7Un3D23', '977803055V', '2021-02-08');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `duty_details`
--
ALTER TABLE `duty_details`
  ADD CONSTRAINT `fk_officerid` FOREIGN KEY (`officer_id`) REFERENCES `officer` (`officer_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `found_vehicle`
--
ALTER TABLE `found_vehicle`
  ADD CONSTRAINT `found_vehicle_ibfk_1` FOREIGN KEY (`reporter_id`) REFERENCES `officer` (`officer_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `help`
--
ALTER TABLE `help`
  ADD CONSTRAINT `fk_license_no` FOREIGN KEY (`license_no`) REFERENCES `drivers` (`license_no`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `offence`
--
ALTER TABLE `offence`
  ADD CONSTRAINT `fk_act_no` FOREIGN KEY (`act_no`) REFERENCES `fine_details` (`act_no`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_offender_id` FOREIGN KEY (`offender_id`) REFERENCES `drivers` (`license_no`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `fk_reporter_id` FOREIGN KEY (`reporter_id`) REFERENCES `officer` (`officer_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `spotfine`
--
ALTER TABLE `spotfine`
  ADD CONSTRAINT `fk_offence_id` FOREIGN KEY (`offence_id`) REFERENCES `offence` (`offence_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `kf_nic` FOREIGN KEY (`owner_nic`) REFERENCES `citizens` (`nic`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `vehicle_lost`
--
ALTER TABLE `vehicle_lost`
  ADD CONSTRAINT `fk_owner_nic` FOREIGN KEY (`owner_nic`) REFERENCES `user` (`nic`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
