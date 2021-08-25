-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 26, 2021 at 03:18 PM
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
-- Database: `courier`
--
CREATE DATABASE IF NOT EXISTS `courier` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `courier`;

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `getprice`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getprice` ()  MODIFIES SQL DATA
BEGIN
DECLARE from_pin INT;
DECLARE to_pin INT;
DECLARE quant TINYINT;
DECLARE weig TINYINT;
DECLARE delivery VARCHAR(10);
DECLARE id INT;
DECLARE cal_price DECIMAL(3,2);
DECLARE aquote CURSOR FOR SELECT f_pincode,t_pincode,quantity,weigh,delivery_service,quote_id FROM quote WHERE quote_id = (SELECT quote_id FROM quote ORDER BY quote_id DESC LIMIT 1);

SET cal_price = 35.14;
OPEN aquote;
	read_loop: LOOP

	FETCH aquote INTO from_pin,to_pin,quant,weig,delivery,id;
	IF(delivery="SPEED")THEN
		SET cal_price = (((from_pin+to_pin+quant+weig)/123456)*10+30);
	ELSEIF(delivery="BEST")THEN
		SET cal_price = (((from_pin+to_pin+quant+weig)/123456)*10+20);
	ELSEIF(delivery="ECONOMY")THEN
		SET cal_price = (((from_pin+to_pin+quant+weig)/123456)*10+10);
	UPDATE quote SET price = cal_price
	WHERE quote_id = id;
	END IF;
	END LOOP;
	CLOSE aquote;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `courier`
--

DROP TABLE IF EXISTS `courier`;
CREATE TABLE IF NOT EXISTS `courier` (
  `courier_id` int NOT NULL AUTO_INCREMENT,
  `price` decimal(10,0) NOT NULL,
  `length` tinyint NOT NULL,
  `height` text COLLATE utf8mb4_bin NOT NULL,
  `courier_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quote_id` int NOT NULL,
  PRIMARY KEY (`courier_id`),
  UNIQUE KEY `quote_id` (`quote_id`),
  KEY `courier_id` (`courier_id`),
  KEY `price` (`price`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `courier`
--

INSERT INTO `courier` (`courier_id`, `price`, `length`, `height`, `courier_time`, `quote_id`) VALUES
(1, '0', 124, '154', '2021-01-25 14:43:24', 0),
(2, '0', 127, '254', '2021-01-25 16:02:32', 4),
(3, '0', 127, '321', '2021-01-25 16:27:13', 5);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `cu_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `cu_phone_no` bigint NOT NULL,
  `cu_email_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `cu_address` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `pickup_date` text COLLATE utf8mb4_bin NOT NULL,
  `quote_id` int NOT NULL,
  `courier_id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`courier_id`) USING BTREE,
  UNIQUE KEY `quote_id` (`quote_id`),
  KEY `courier_id` (`courier_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cu_name`, `cu_phone_no`, `cu_email_id`, `cu_address`, `pickup_date`, `quote_id`, `courier_id`) VALUES
('ADARSH N', 8088753057, 'adarshkumar738291@gmail.com', 'adinarayanahalli village hampasandra post gudibande thaluk chikkaballapura district karnataka 561209', '2021-01-25', 0, 1),
('MASDBJKLASDHKL', 1245789635, 'asdhkjdsbjhb@gmail.com', 'lkfsakljfnls ;fkjds ofnlsdkf vdsjvo;asdmfs ', '2021-01-25', 4, 2),
('ADARSH N', 918088753057, 'adarsh_kumar_123@outlook.com', 'kjafhspodiufhsalkd;fhsadifuhosaiuhflksdhfoiushfiuhsaduhfouisahgf', '2021-01-25', 5, 3),
('ADARSH N', 8088753057, 'adarshkumar738291@gmail.com', 'adinarayanahalli village hampasandra post gudibande thaluk chikkaballapura district karnataka 561209', '2021-01-26', 6, 5);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `emp_id` int NOT NULL,
  `f_name` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `l_name` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `email_id` varchar(30) COLLATE utf8mb4_bin NOT NULL,
  `dob` date NOT NULL,
  `phone_no` bigint NOT NULL,
  `address` varchar(150) COLLATE utf8mb4_bin NOT NULL,
  `designation` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`phone_no`) USING BTREE,
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `f_name`, `l_name`, `email_id`, `dob`, `phone_no`, `address`, `designation`) VALUES
(109, 'Koushik', 'Vardan', 'koushikvardan@outlook.com', '2001-08-17', 9123456784, 'Adlimane Road, Penshan Mohalla, Hassan, Karnataka 573201', 'Delivery Boy'),
(107, 'Kevin ', 'Peterson', 'kevinpeter@outlook.com', '1998-07-19', 9632587412, '963/1A, New Kanthraju Urs Road Near C.K.C School, Lakshmipuram, Mysuru, Karnataka 570004', 'Delivery Boy'),
(108, 'Siddarth', 'Joshi', 'siddarthjosh234@gmail.com', '1989-12-12', 9745632182, '7/73(1, SH27, Mahadevpet, Madikeri, Karnataka 571201', 'Delivery Boy'),
(104, 'Kohili', 'Virat', 'viratkohili345@rediffmail.com', '1992-04-28', 9745681238, 'Door No. 11/53/1, G-2 Arvind S Kabini Apartments, Uttarahalli Main Rd, Banashankari Stage II, Bendre Nagar, Bengaluru, Karnataka 560078', 'Staff'),
(110, 'Suresh', 'Reddy', 'sureshreddy@yahoo.com', '1999-01-15', 9852147631, ' 1st Floor, Sridhar Towers, MG Road, Near Town, Lakshmishanagara, Chikmagalur, Karnataka 577101', 'Delivery Boy'),
(101, 'Ramesh ', 'Kumar', 'rameshkumar876@gmail.com', '1999-09-09', 9856327418, '#234, 1st main , 25th cross , mig 2nd stage, yelahanka new town Bangalore north Bangalore Urban 560064', 'Manager'),
(103, 'Dhanush', 'sheety', 'dhanushsheety@yahoo.com', '1999-04-05', 9874563214, '#51 haveri main road near temple haveri thaluk belaghavi district 560321', 'Staff'),
(105, 'Ram', 'Murthy', 'rammurthy@hotmail.com', '1991-04-18', 9874596258, '2Nd Floor, Banashankari Complex, near Federal Bank, Vidya Nagar, Haveri, Karnataka 581110', 'Delivery Boy');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `login_id` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `emp_id` int NOT NULL,
  `password` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  `designation` varchar(15) COLLATE utf8mb4_bin NOT NULL,
  PRIMARY KEY (`login_id`) USING BTREE,
  KEY `emp_id` (`emp_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `emp_id`, `password`, `designation`) VALUES
('dhanush@v3courier', 103, 'Dhanush345@', 'Staff'),
('kevin@v3courier', 107, 'Kevin987@', 'Delivery Boy'),
('kohili@v3courier', 104, 'Kohili123@', 'Staff'),
('koushik@v3courier', 109, 'Koushik765@', 'Delivery Boy'),
('ramesh@v3courier', 101, 'Ramesh987@', 'Manager'),
('rammurthy@v3courier', 105, 'Rammurthy567@', 'Delivery Boy'),
('siddarth@v3courier', 108, 'Siddarth986@', 'Delivery Boy'),
('sumeedh@v3courier', 106, 'Sumeedh653@', 'Delivery Boy'),
('suresh@v3courier', 110, 'Suresh765@', 'Delivery Boy'),
('vamshi@v3courier', 102, 'Vamshi456@', 'Staff');

-- --------------------------------------------------------

--
-- Table structure for table `quote`
--

DROP TABLE IF EXISTS `quote`;
CREATE TABLE IF NOT EXISTS `quote` (
  `f_pincode` int NOT NULL,
  `t_pincode` int NOT NULL,
  `quantity` tinyint NOT NULL,
  `weigh` smallint NOT NULL,
  `delivery_service` varchar(10) COLLATE utf8mb4_bin NOT NULL,
  `quote_id` int NOT NULL AUTO_INCREMENT,
  `price` decimal(3,2) DEFAULT NULL,
  PRIMARY KEY (`quote_id`),
  KEY `price` (`price`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `quote`
--

INSERT INTO `quote` (`f_pincode`, `t_pincode`, `quantity`, `weigh`, `delivery_service`, `quote_id`, `price`) VALUES
(560064, 562109, 4, 125, 'Speed', 1, NULL),
(560064, 560014, 4, 124, 'Speed', 2, NULL),
(560064, 560000, 4, 124, 'Speed', 3, NULL),
(560000, 569999, 1, 124, 'Speed', 4, NULL),
(561234, 569874, 3, 127, 'Economy', 5, NULL),
(560001, 569999, 2, 127, 'Best', 6, NULL),
(560000, 569999, 1, 127, 'Speed', 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reciever`
--

DROP TABLE IF EXISTS `reciever`;
CREATE TABLE IF NOT EXISTS `reciever` (
  `r_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `r_phone_no` bigint NOT NULL,
  `r_email_id` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `r_address` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `delivery_date` date NOT NULL,
  `courier_id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`courier_id`),
  KEY `courier_id` (`courier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Dumping data for table `reciever`
--

INSERT INTO `reciever` (`r_name`, `r_phone_no`, `r_email_id`, `r_address`, `delivery_date`, `courier_id`) VALUES
('vinayak', 1213456789, 'sfgskdjghlsdkfgh@gmail.com', 'aklsjdfnlkj fsakdjhfkjsd nfskjdfhjsdnf sdlfsdklf', '2021-01-26', 1),
('KDJSANDILHd', 1234698574, 'ksajfnkjsdfh@gmail.com', 'jsakf asllskadfmn sljsdfsncv,.vmx, ;lsriputq ', '2021-01-26', 2),
('VINAYAK S B', 12457896325, 'sadjfhklashfl kjshdoifuh skjcnbsjdhfps', 'fals jfsd jfkl;jsd fos dvnc ,mcvnaosf iejnr', '2021-01-29', 3),
('NITHIN KUMAR B', 3214567894, 'nithinkumarb@gmail.com', 'ksnfklj kfjnaskjdfhuis dfkjenrkjbg,cxmvn lkhihtkjbnemngkc', '2021-01-28', 4);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courier`
--
ALTER TABLE `courier`
  ADD CONSTRAINT `courier_ibfk_1` FOREIGN KEY (`courier_id`) REFERENCES `customer` (`courier_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `courier_ibfk_2` FOREIGN KEY (`courier_id`) REFERENCES `reciever` (`courier_id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `courier_ibfk_3` FOREIGN KEY (`quote_id`) REFERENCES `customer` (`quote_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `login` (`emp_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `quote`
--
ALTER TABLE `quote`
  ADD CONSTRAINT `quote_ibfk_1` FOREIGN KEY (`price`) REFERENCES `courier` (`price`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
