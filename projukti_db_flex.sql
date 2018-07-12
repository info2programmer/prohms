-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2018 at 01:40 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projukti_db_flex`
--

-- --------------------------------------------------------

--
-- Table structure for table `td_attendance`
--

CREATE TABLE `td_attendance` (
  `attendance_id` int(11) NOT NULL,
  `attendance_date` varchar(250) NOT NULL,
  `branch_id` int(11) NOT NULL,
  `present_id` varchar(250) NOT NULL,
  `late_id` varchar(250) NOT NULL,
  `halfday_id` varchar(250) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_attendance`
--

INSERT INTO `td_attendance` (`attendance_id`, `attendance_date`, `branch_id`, `present_id`, `late_id`, `halfday_id`, `published`) VALUES
(1, '2018-06-01', 2, '1', '', '', 1),
(2, '2018-06-05', 2, '1', '1', '', 1),
(3, '2018-06-07', 2, '1', '', '', 1),
(4, '2018-06-10', 2, '1', '', '', 1),
(5, '2018-06-13', 2, '1', '1', '', 1),
(6, '2018-06-17', 2, '1', '', '', 1),
(7, '2018-06-19', 2, '1', '', '', 1),
(8, '2018-06-23', 2, '', '', '', 1),
(9, '2018-06-27', 2, '1', '1', '', 1),
(10, '2018-06-29', 2, '1', '1', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `td_company_location`
--

CREATE TABLE `td_company_location` (
  `loc_id` int(11) NOT NULL,
  `loc_name` varchar(255) NOT NULL,
  `loc_address` longtext NOT NULL,
  `loc_phone` varchar(255) NOT NULL,
  `loc_email` varchar(255) NOT NULL,
  `published` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_company_location`
--

INSERT INTO `td_company_location` (`loc_id`, `loc_name`, `loc_address`, `loc_phone`, `loc_email`, `published`) VALUES
(1, 'KASBA', '29/B, KASBA MAIN ROAD KOLKATA, 700036 ', '033 6548-6255', 'MARKETING@PROJUKTI.INFO', 1),
(2, 'GARIA', 'KANUNGO PARK, GARIA KOLKATA 700087', '033 6548-6255', 'SALES@PROJUKTI.INFO', 1),
(3, 'TOLLYGUNGE', 'B/73/H, N.S.ROAD, KOLKATA 700069', '033 6548-6255', 'TECH@PROJUKTI.INFO', 1);

-- --------------------------------------------------------

--
-- Table structure for table `td_company_settings`
--

CREATE TABLE `td_company_settings` (
  `com_id` int(11) NOT NULL,
  `com_name` varchar(255) NOT NULL,
  `com_address` longtext NOT NULL,
  `com_phone` varchar(255) NOT NULL,
  `com_email` varchar(255) NOT NULL,
  `com_logo` varchar(255) NOT NULL,
  `absent_due_to_late` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_company_settings`
--

INSERT INTO `td_company_settings` (`com_id`, `com_name`, `com_address`, `com_phone`, `com_email`, `com_logo`, `absent_due_to_late`) VALUES
(1, 'PROJUKTI', 'P-24, GREEN VIEW, GARIA, KOLKATA 700-084', '033 65486255', 'PROJUKTIITCOMPANY@GMAIL.COM', 'logo21522418016.png', '2');

-- --------------------------------------------------------

--
-- Table structure for table `td_country`
--

CREATE TABLE `td_country` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(250) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_country`
--

INSERT INTO `td_country` (`country_id`, `country_name`, `published`) VALUES
(1, 'Afghanistan ', 1),
(2, 'Albania ', 1),
(3, 'Algeria ', 1),
(4, 'American Samoa ', 1),
(5, 'Andorra ', 1),
(6, 'Angola ', 1),
(7, 'Anguilla ', 1),
(8, 'Antigua & Barbuda ', 1),
(9, 'Argentina ', 1),
(10, 'Armenia ', 1),
(11, 'Aruba ', 1),
(12, 'Australia ', 1),
(13, 'Austria ', 1),
(14, 'Azerbaijan ', 1),
(15, 'Bahamas, The ', 1),
(16, 'Bahrain ', 1),
(17, 'Bangladesh ', 1),
(18, 'Barbados ', 1),
(19, 'Belarus ', 1),
(20, 'Belgium ', 1),
(21, 'Belize ', 1),
(22, 'Benin ', 1),
(23, 'Bermuda ', 1),
(24, 'Bhutan ', 1),
(25, 'Bolivia ', 1),
(26, 'Bosnia & Herzegovina ', 1),
(27, 'Botswana ', 1),
(28, 'Brazil ', 1),
(29, 'British Virgin Is. ', 1),
(30, 'Brunei ', 1),
(31, 'Bulgaria ', 1),
(32, 'Burkina Faso ', 1),
(33, 'Burma ', 1),
(34, 'Burundi ', 1),
(35, 'Cambodia ', 1),
(36, 'Cameroon ', 1),
(37, 'Canada ', 1),
(38, 'Cape Verde ', 1),
(39, 'Cayman Islands ', 1),
(40, 'Central African Rep. ', 1),
(41, 'Chad ', 1),
(42, 'Chile ', 1),
(43, 'China ', 1),
(44, 'Colombia ', 1),
(45, 'Comoros ', 1),
(46, 'Congo, Dem. Rep. ', 1),
(47, 'Congo, Repub. of the ', 1),
(48, 'Cook Islands ', 1),
(49, 'Costa Rica ', 1),
(50, 'Cote d\'Ivoire ', 1),
(51, 'Croatia ', 1),
(52, 'Cuba ', 1),
(53, 'Cyprus ', 1),
(54, 'Czech Republic ', 1),
(55, 'Denmark ', 1),
(56, 'Djibouti ', 1),
(57, 'Dominica ', 1),
(58, 'Dominican Republic ', 1),
(59, 'East Timor ', 1),
(60, 'Ecuador ', 1),
(61, 'Egypt ', 1),
(62, 'El Salvador ', 1),
(63, 'Equatorial Guinea ', 1),
(64, 'Eritrea ', 1),
(65, 'Estonia ', 1),
(66, 'Ethiopia ', 1),
(67, 'Faroe Islands ', 1),
(68, 'Fiji ', 1),
(69, 'Finland ', 1),
(70, 'France ', 1),
(71, 'French Guiana ', 1),
(72, 'French Polynesia ', 1),
(73, 'Gabon ', 1),
(74, 'Gambia, The ', 1),
(75, 'Gaza Strip ', 1),
(76, 'Georgia ', 1),
(77, 'Germany ', 1),
(78, 'Ghana ', 1),
(79, 'Gibraltar ', 1),
(80, 'Greece ', 1),
(81, 'Greenland ', 1),
(82, 'Grenada ', 1),
(83, 'Guadeloupe ', 1),
(84, 'Guam ', 1),
(85, 'Guatemala ', 1),
(86, 'Guernsey ', 1),
(87, 'Guinea ', 1),
(88, 'Guinea-Bissau ', 1),
(89, 'Guyana ', 1),
(90, 'Haiti ', 1),
(91, 'Honduras ', 1),
(92, 'Hong Kong ', 1),
(93, 'Hungary ', 1),
(94, 'Iceland ', 1),
(95, 'India ', 1),
(96, 'Indonesia ', 1),
(97, 'Iran ', 1),
(98, 'Iraq ', 1),
(99, 'Ireland ', 1),
(100, 'Isle of Man ', 1),
(101, 'Israel ', 1),
(102, 'Italy ', 1),
(103, 'Jamaica ', 1),
(104, 'Japan ', 1),
(105, 'Jersey ', 1),
(106, 'Jordan ', 1),
(107, 'Kazakhstan ', 1),
(108, 'Kenya ', 1),
(109, 'Kiribati ', 1),
(110, 'Korea, North ', 1),
(111, 'Korea, South ', 1),
(112, 'Kuwait ', 1),
(113, 'Kyrgyzstan ', 1),
(114, 'Laos ', 1),
(115, 'Latvia ', 1),
(116, 'Lebanon ', 1),
(117, 'Lesotho ', 1),
(118, 'Liberia ', 1),
(119, 'Libya ', 1),
(120, 'Liechtenstein ', 1),
(121, 'Lithuania ', 1),
(122, 'Luxembourg ', 1),
(123, 'Macau ', 1),
(124, 'Macedonia ', 1),
(125, 'Madagascar ', 1),
(126, 'Malawi ', 1),
(127, 'Malaysia ', 1),
(128, 'Maldives ', 1),
(129, 'Mali ', 1),
(130, 'Malta ', 1),
(131, 'Marshall Islands ', 1),
(132, 'Martinique ', 1),
(133, 'Mauritania ', 1),
(134, 'Mauritius ', 1),
(135, 'Mayotte ', 1),
(136, 'Mexico ', 1),
(137, 'Micronesia, Fed. St. ', 1),
(138, 'Moldova ', 1),
(139, 'Monaco ', 1),
(140, 'Mongolia ', 1),
(141, 'Montserrat ', 1),
(142, 'Morocco ', 1),
(143, 'Mozambique ', 1),
(144, 'Namibia ', 1),
(145, 'Nauru ', 1),
(146, 'Nepal ', 1),
(147, 'Netherlands ', 1),
(148, 'Netherlands Antilles ', 1),
(149, 'New Caledonia ', 1),
(150, 'New Zealand ', 1),
(151, 'Nicaragua ', 1),
(152, 'Niger ', 1),
(153, 'Nigeria ', 1),
(154, 'N. Mariana Islands ', 1),
(155, 'Norway ', 1),
(156, 'Oman ', 1),
(157, 'Pakistan ', 1),
(158, 'Palau ', 1),
(159, 'Panama ', 1),
(160, 'Papua New Guinea ', 1),
(161, 'Paraguay ', 1),
(162, 'Peru ', 1),
(163, 'Philippines ', 1),
(164, 'Poland ', 1),
(165, 'Portugal ', 1),
(166, 'Puerto Rico ', 1),
(167, 'Qatar ', 1),
(168, 'Reunion ', 1),
(169, 'Romania ', 1),
(170, 'Russia ', 1),
(171, 'Rwanda ', 1),
(172, 'Saint Helena ', 1),
(173, 'Saint Kitts & Nevis ', 1),
(174, 'Saint Lucia ', 1),
(175, 'St Pierre & Miquelon ', 1),
(176, 'Saint Vincent and the Grenadines ', 1),
(177, 'Samoa ', 1),
(178, 'San Marino ', 1),
(179, 'Sao Tome & Principe ', 1),
(180, 'Saudi Arabia ', 1),
(181, 'Senegal ', 1),
(182, 'Serbia ', 1),
(183, 'Seychelles ', 1),
(184, 'Sierra Leone ', 1),
(185, 'Singapore ', 1),
(186, 'Slovakia ', 1),
(187, 'Slovenia ', 1),
(188, 'Solomon Islands ', 1),
(189, 'Somalia ', 1),
(190, 'South Africa ', 1),
(191, 'Spain ', 1),
(192, 'Sri Lanka ', 1),
(193, 'Sudan ', 1),
(194, 'Suriname ', 1),
(195, 'Swaziland ', 1),
(196, 'Sweden ', 1),
(197, 'Switzerland ', 1),
(198, 'Syria ', 1),
(199, 'Taiwan ', 1),
(200, 'Tajikistan ', 1),
(201, 'Tanzania ', 1),
(202, 'Thailand ', 1),
(203, 'Togo ', 1),
(204, 'Tonga ', 1),
(205, 'Trinidad & Tobago ', 1),
(206, 'Tunisia ', 1),
(207, 'Turkey ', 1),
(208, 'Turkmenistan ', 1),
(209, 'Turks & Caicos Is ', 1),
(210, 'Tuvalu ', 1),
(211, 'Uganda ', 1),
(212, 'Ukraine ', 1),
(213, 'United Arab Emirates ', 1),
(214, 'United Kingdom ', 1),
(215, 'United States ', 1),
(216, 'Uruguay ', 1),
(217, 'Uzbekistan ', 1),
(218, 'Vanuatu ', 1),
(219, 'Venezuela ', 1),
(220, 'Vietnam ', 1),
(221, 'Virgin Islands ', 1),
(222, 'Wallis and Futuna ', 1),
(223, 'West Bank ', 1),
(224, 'Western Sahara ', 1),
(225, 'Yemen ', 1),
(226, 'Zambia ', 1),
(227, 'Zimbabwe ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `td_department`
--

CREATE TABLE `td_department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(250) NOT NULL,
  `department_prefix` varchar(250) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_department`
--

INSERT INTO `td_department` (`department_id`, `department_name`, `department_prefix`, `published`) VALUES
(3, 'SALES', 'SLS', 1),
(4, 'MARKETING', 'MKT', 1),
(5, 'ACCOUNTS', 'ACS', 1),
(6, 'HUMAN RESOURCE', 'HR', 1),
(7, 'OPERATIONS', 'OPS', 1),
(8, 'PRODUCTION', 'PDN', 1);

-- --------------------------------------------------------

--
-- Table structure for table `td_designation`
--

CREATE TABLE `td_designation` (
  `designation_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_name` varchar(250) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_designation`
--

INSERT INTO `td_designation` (`designation_id`, `department_id`, `designation_name`, `published`) VALUES
(1, 5, 'JUNIOR ACCOUNTS EXECUTIVE', 1),
(2, 5, 'SENIOR ACCOUNTS EXECUTIVE', 1),
(3, 4, 'JUNIOR MARKETING EXECUTIVE', 1),
(4, 4, 'SENIOR MARKETING EXECUTIVE', 1),
(5, 6, 'HUMAN RESOURCE MANAGER', 1),
(6, 8, 'JUNIOR WEB DEVELOPER', 1),
(7, 8, 'SENIOR WEB DEVELOPER', 1);

-- --------------------------------------------------------

--
-- Table structure for table `td_employee_office_details`
--

CREATE TABLE `td_employee_office_details` (
  `office_details_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `joining_date` varchar(250) NOT NULL,
  `confirmation_period` varchar(250) NOT NULL,
  `emp_type` varchar(250) NOT NULL,
  `emp_skill` varchar(100) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `payment_mode` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `increment_date` varchar(250) NOT NULL,
  `resignation_date` varchar(250) NOT NULL,
  `last_working_date` varchar(250) NOT NULL,
  `is_pf` tinyint(1) NOT NULL,
  `pf_no` varchar(250) NOT NULL,
  `epf_no` varchar(250) NOT NULL,
  `relationship` varchar(250) DEFAULT NULL,
  `pf_enrollment_date` varchar(250) NOT NULL,
  `is_esi` tinyint(1) NOT NULL,
  `esi_no` varchar(250) NOT NULL,
  `esi_date` varchar(250) NOT NULL,
  `bank_acc_no` varchar(250) NOT NULL,
  `bank_name` varchar(250) NOT NULL,
  `bank_acc_holder_name` varchar(250) NOT NULL,
  `bank_ifsc_code` varchar(250) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_employee_office_details`
--

INSERT INTO `td_employee_office_details` (`office_details_id`, `emp_id`, `joining_date`, `confirmation_period`, `emp_type`, `emp_skill`, `designation_id`, `payment_mode`, `location`, `increment_date`, `resignation_date`, `last_working_date`, `is_pf`, `pf_no`, `epf_no`, `relationship`, `pf_enrollment_date`, `is_esi`, `esi_no`, `esi_date`, `bank_acc_no`, `bank_name`, `bank_acc_holder_name`, `bank_ifsc_code`, `username`, `password`, `published`) VALUES
(1, 1, '2018-06-01', '2018-06-01', 'Full Time', 'S', 7, 'Transfer', '2', '2018-07-10', '2018-07-10', '2018-07-10', 0, '', '', NULL, '', 0, '', '', '634634', 'UCO BANK', 'SUBHOMOY SAMANTA', 'UCBA09330013', 'subho951', 'subho123', 1);

-- --------------------------------------------------------

--
-- Table structure for table `td_employee_performance`
--

CREATE TABLE `td_employee_performance` (
  `emp_performance_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `from_date` varchar(250) NOT NULL,
  `to_date` varchar(250) NOT NULL,
  `sale_details` varchar(250) NOT NULL,
  `sale_amount` varchar(250) NOT NULL,
  `sale_note` text NOT NULL,
  `sale_total` float(10,2) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_employee_personal_details`
--

CREATE TABLE `td_employee_personal_details` (
  `emp_id` int(11) NOT NULL,
  `emp_code` varchar(250) NOT NULL,
  `department_id` int(11) NOT NULL,
  `salutation` varchar(250) NOT NULL,
  `emp_name` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `father_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `dob` varchar(250) NOT NULL,
  `present_address` text NOT NULL,
  `permanent_address` text NOT NULL,
  `phone` varchar(250) NOT NULL,
  `country` int(250) NOT NULL,
  `state` varchar(250) NOT NULL,
  `city` varchar(250) NOT NULL,
  `pin` int(11) NOT NULL,
  `personal_email` varchar(250) NOT NULL,
  `mobile` varchar(250) NOT NULL,
  `blood_group` varchar(250) NOT NULL,
  `votar_no` varchar(250) NOT NULL,
  `pan_no` varchar(250) NOT NULL,
  `passport_no` varchar(250) NOT NULL,
  `passport_expiry` varchar(250) NOT NULL,
  `aadhar_no` varchar(250) NOT NULL,
  `marital_status` varchar(250) NOT NULL,
  `spouse_name` varchar(250) NOT NULL,
  `profile_image` varchar(250) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_employee_personal_details`
--

INSERT INTO `td_employee_personal_details` (`emp_id`, `emp_code`, `department_id`, `salutation`, `emp_name`, `gender`, `father_name`, `email`, `dob`, `present_address`, `permanent_address`, `phone`, `country`, `state`, `city`, `pin`, `personal_email`, `mobile`, `blood_group`, `votar_no`, `pan_no`, `passport_no`, `passport_expiry`, `aadhar_no`, `marital_status`, `spouse_name`, `profile_image`, `published`) VALUES
(1, 'PDN/00001', 8, 'Mrs.', 'SUBHOMOY SAMANTA', 'M', 'BABA SAMANTA', 'subhomoy.projukti@gmail.com', '1989-02-21', 'jagacha', 'jagacha', '8981374267', 95, 'West Bengal', 'howrah', 711112, 'subhomoysamanta1989@gmail.com', '8981374267', 'B+', '123456', '456789', '159753', '2018-09-13', '123498750357', 'Married', 'SAMPA SAMANTA', '1531204190Koala.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `td_employee_skill_matrix`
--

CREATE TABLE `td_employee_skill_matrix` (
  `sm_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `sm_details` longtext NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_emp_salary`
--

CREATE TABLE `td_emp_salary` (
  `emp_sal_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `basic_pay` varchar(250) DEFAULT NULL,
  `rate_per_hour` varchar(250) DEFAULT NULL,
  `emp_type` varchar(250) NOT NULL,
  `sal_heads` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_emp_salary`
--

INSERT INTO `td_emp_salary` (`emp_sal_id`, `emp_id`, `basic_pay`, `rate_per_hour`, `emp_type`, `sal_heads`) VALUES
(1, 1, '12000', NULL, 'S', '1,2,4,6,7,3,5,10,11');

-- --------------------------------------------------------

--
-- Table structure for table `td_finance`
--

CREATE TABLE `td_finance` (
  `fin_id` int(11) NOT NULL,
  `fin_purpose` varchar(255) NOT NULL,
  `fin_type` varchar(255) NOT NULL,
  `fin_date` varchar(255) NOT NULL,
  `fin_particulars` text NOT NULL,
  `fin_amount` varchar(255) NOT NULL,
  `fin_uniq_no` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_half_day_assign`
--

CREATE TABLE `td_half_day_assign` (
  `halfday_assign_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `halfday_date` varchar(250) NOT NULL,
  `halfday_type` int(11) NOT NULL,
  `leave_left` varchar(250) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_job_type`
--

CREATE TABLE `td_job_type` (
  `jobtype_id` int(11) NOT NULL,
  `jobtype_name` varchar(250) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_job_type`
--

INSERT INTO `td_job_type` (`jobtype_id`, `jobtype_name`, `published`) VALUES
(1, 'FULL TIME', 1),
(2, 'PART TIME', 1),
(4, 'CONTRACTUAL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `td_late`
--

CREATE TABLE `td_late` (
  `late_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `from_date` varchar(250) NOT NULL,
  `to_date` varchar(250) NOT NULL,
  `late` int(11) NOT NULL,
  `half_day` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_late`
--

INSERT INTO `td_late` (`late_id`, `emp_id`, `from_date`, `to_date`, `late`, `half_day`, `published`) VALUES
(1, 1, '2018-06-01', '2018-06-30', 4, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `td_leave`
--

CREATE TABLE `td_leave` (
  `leave_id` int(11) NOT NULL,
  `leave_name` varchar(250) NOT NULL,
  `leave_type` varchar(250) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_leave`
--

INSERT INTO `td_leave` (`leave_id`, `leave_name`, `leave_type`, `published`) VALUES
(1, 'CASUAL LEAVE', 'Paid', 1),
(2, 'SICK LEAVE', 'Paid', 1),
(3, 'MATERNITY LEAVE', 'Unpaid', 1);

-- --------------------------------------------------------

--
-- Table structure for table `td_leave_allocation`
--

CREATE TABLE `td_leave_allocation` (
  `leave_allocation_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `from_date` varchar(250) NOT NULL,
  `to_date` varchar(250) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_leave_allocation`
--

INSERT INTO `td_leave_allocation` (`leave_allocation_id`, `emp_id`, `from_date`, `to_date`, `published`) VALUES
(1, 1, '2018-06-01', '2018-06-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `td_leave_allocation_details`
--

CREATE TABLE `td_leave_allocation_details` (
  `leave_allocation_details_id` int(11) NOT NULL,
  `leave_allocation_id` int(11) NOT NULL,
  `leave_id` int(11) NOT NULL,
  `number_of_leave` varchar(250) NOT NULL,
  `leave_balance` varchar(250) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_leave_allocation_details`
--

INSERT INTO `td_leave_allocation_details` (`leave_allocation_details_id`, `leave_allocation_id`, `leave_id`, `number_of_leave`, `leave_balance`, `published`) VALUES
(1, 1, 1, '6', '5', 1),
(2, 1, 2, '6', '5', 1),
(3, 1, 3, '0', '0', 1);

-- --------------------------------------------------------

--
-- Table structure for table `td_leave_assign`
--

CREATE TABLE `td_leave_assign` (
  `leave_assign_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `leave_date` varchar(250) NOT NULL,
  `leave_type` int(11) NOT NULL,
  `leave_left` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_leave_assign`
--

INSERT INTO `td_leave_assign` (`leave_assign_id`, `emp_id`, `leave_date`, `leave_type`, `leave_left`, `published`) VALUES
(1, 1, '2018-06-13', 1, 5, 1),
(2, 1, '2018-06-22', 2, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `td_salary`
--

CREATE TABLE `td_salary` (
  `salary_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `emp_type` varchar(250) NOT NULL,
  `from_date` varchar(250) NOT NULL,
  `to_date` varchar(250) NOT NULL,
  `salary_date` varchar(250) NOT NULL,
  `basic_pay` float(10,2) DEFAULT NULL,
  `rate_per_hour` float(10,2) DEFAULT NULL,
  `working_hours` float(10,2) DEFAULT NULL,
  `cheque_no` varchar(250) DEFAULT NULL,
  `transaction_id` varchar(250) DEFAULT NULL,
  `total_salary` float(10,2) DEFAULT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_salary`
--

INSERT INTO `td_salary` (`salary_id`, `emp_id`, `emp_type`, `from_date`, `to_date`, `salary_date`, `basic_pay`, `rate_per_hour`, `working_hours`, `cheque_no`, `transaction_id`, `total_salary`, `published`) VALUES
(1, 1, 'S', '2018-06-01', '2018-06-30', '2018-07-10', 12000.00, NULL, NULL, NULL, 'DHGDFHGFJHFF', 13480.00, 1),
(4, 1, 'S', '2018-06-01', '2018-06-30', '2018-07-10', 12000.00, NULL, NULL, NULL, 'DHGDFHGFJHFF', 12280.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `td_salary_all`
--

CREATE TABLE `td_salary_all` (
  `salary_id` int(11) NOT NULL,
  `from_date` varchar(250) NOT NULL,
  `to_date` varchar(250) NOT NULL,
  `month_year` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `payslip_no` varchar(250) NOT NULL,
  `basic_pay` varchar(250) NOT NULL,
  `total_salary` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_salary_details`
--

CREATE TABLE `td_salary_details` (
  `salary_details_id` int(11) NOT NULL,
  `salary_id` int(11) NOT NULL,
  `salary_head_id` int(11) NOT NULL,
  `salary_head_type` varchar(250) NOT NULL,
  `salary_head_value` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_salary_details`
--

INSERT INTO `td_salary_details` (`salary_details_id`, `salary_id`, `salary_head_id`, `salary_head_type`, `salary_head_value`) VALUES
(1, 1, 1, 'E', 12000.00),
(2, 1, 2, 'E', 480.00),
(3, 1, 4, 'E', 1800.00),
(4, 1, 6, 'E', 400.00),
(5, 1, 7, 'E', 1200.00),
(6, 1, 3, 'D', 960.00),
(7, 1, 5, 'D', 1440.00),
(24, 4, 1, 'E', 12000.00),
(25, 4, 2, 'E', 480.00),
(26, 4, 4, 'E', 1800.00),
(27, 4, 6, 'E', 400.00),
(28, 4, 7, 'E', 1200.00),
(29, 4, 3, 'D', 960.00),
(30, 4, 5, 'D', 1440.00),
(31, 4, 10, 'D', 400.00),
(32, 4, 11, 'D', 800.00);

-- --------------------------------------------------------

--
-- Table structure for table `td_salary_detail_all`
--

CREATE TABLE `td_salary_detail_all` (
  `salary_detail_id` int(11) NOT NULL,
  `salary_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `salary_head_id` int(11) NOT NULL,
  `salary_head_type` varchar(250) NOT NULL,
  `salary_head_value` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_salary_head`
--

CREATE TABLE `td_salary_head` (
  `salary_head_id` int(11) NOT NULL,
  `salary_head_name` varchar(250) NOT NULL,
  `salary_head_description` text NOT NULL,
  `emp_type` varchar(250) NOT NULL,
  `salary_head_type` varchar(250) NOT NULL,
  `is_fixed_percent` tinyint(1) NOT NULL,
  `percent_rate` float(10,2) NOT NULL,
  `is_optional` tinyint(1) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_salary_head`
--

INSERT INTO `td_salary_head` (`salary_head_id`, `salary_head_name`, `salary_head_description`, `emp_type`, `salary_head_type`, `is_fixed_percent`, `percent_rate`, `is_optional`, `published`) VALUES
(1, 'Basic Pay', 'Basic Pay', 'S', 'E', 0, 0.00, 0, 1),
(2, 'DA', 'DA', 'S', 'E', 1, 4.00, 0, 1),
(3, 'ESI', 'ESI', 'S', 'D', 1, 8.00, 0, 1),
(4, 'HRA', 'HRA', 'S', 'E', 1, 15.00, 0, 1),
(5, 'Provident Fund', 'Provident Fund', 'S', 'D', 1, 12.00, 0, 1),
(6, 'Mobile Reimbursement', 'Mobile Reimbursement', 'S', 'E', 0, 0.00, 1, 1),
(7, 'Travelling Allowance', 'Travelling Allowance', 'S', 'E', 0, 0.00, 1, 1),
(8, 'Advance', 'Advance from Salary', 'S', 'D', 0, 0.00, 1, 1),
(9, 'Washing Allowance', 'Washing Allowance', 'S', 'E', 0, 0.00, 1, 1),
(10, 'Deduction For Absent', 'Deduction For Absent', 'S', 'D', 0, 0.00, 1, 1),
(11, 'Deduction For Late', 'Deduction For Late', 'S', 'D', 0, 0.00, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `td_salary_head_value`
--

CREATE TABLE `td_salary_head_value` (
  `salary_head_value_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `basic_pay` float(10,2) NOT NULL,
  `total` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_salary_head_value_details`
--

CREATE TABLE `td_salary_head_value_details` (
  `salary_head_value_details_id` int(11) NOT NULL,
  `salary_head_value_id` int(11) NOT NULL,
  `salary_head_id` int(11) NOT NULL,
  `salary_head_type` varchar(250) NOT NULL,
  `salary_head_value` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_salary_head_value_details`
--

INSERT INTO `td_salary_head_value_details` (`salary_head_value_details_id`, `salary_head_value_id`, `salary_head_id`, `salary_head_type`, `salary_head_value`) VALUES
(1, 1, 2, 'E', 600.00),
(2, 1, 4, 'E', 2250.00),
(3, 1, 6, 'E', 500.00),
(4, 1, 7, 'E', 400.00),
(5, 1, 3, 'D', 1200.00),
(6, 1, 5, 'D', 1800.00),
(7, 3, 2, 'E', 800.00),
(8, 3, 4, 'E', 3000.00),
(9, 3, 6, 'E', 1000.00),
(10, 3, 7, 'E', 800.00),
(11, 3, 3, 'D', 1600.00),
(12, 3, 5, 'D', 2400.00),
(13, 4, 2, 'E', 560.00),
(14, 4, 4, 'E', 2100.00),
(15, 4, 6, 'E', 1000.00),
(16, 4, 7, 'E', 1000.00),
(17, 4, 3, 'D', 1120.00),
(18, 4, 5, 'D', 1680.00),
(27, 4, 9, 'E', 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `td_site_settings`
--

CREATE TABLE `td_site_settings` (
  `site_id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_logo` varchar(250) NOT NULL,
  `site_email_address` varchar(250) NOT NULL,
  `site_phone` varchar(250) NOT NULL,
  `site_meta` varchar(255) NOT NULL,
  `site_desc` varchar(255) NOT NULL,
  `site_fblink` varchar(255) NOT NULL,
  `site_twtlink` varchar(255) NOT NULL,
  `total_deletion_time` int(11) NOT NULL,
  `remaining_deletion_time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_site_settings`
--

INSERT INTO `td_site_settings` (`site_id`, `site_name`, `site_logo`, `site_email_address`, `site_phone`, `site_meta`, `site_desc`, `site_fblink`, `site_twtlink`, `total_deletion_time`, `remaining_deletion_time`) VALUES
(1, 'Human Resource and Payroll Management', 'logo1482000521.png', 'hrm@gmail.com', '9830006120', 'HRM', 'P-24 Green View, Kolkata - 700084', 'https://www.facebook.com/hrm', 'https://twitter.com/hrm', 86400, 0);

-- --------------------------------------------------------

--
-- Table structure for table `td_skill`
--

CREATE TABLE `td_skill` (
  `skill_id` int(11) NOT NULL,
  `skill_name` varchar(250) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `td_skill`
--

INSERT INTO `td_skill` (`skill_id`, `skill_name`, `published`) VALUES
(9, 'TECHNICAL', 1),
(10, 'NON-TECHNICAL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `td_training`
--

CREATE TABLE `td_training` (
  `trn_id` int(11) NOT NULL,
  `trn_name` varchar(255) NOT NULL,
  `trn_skill` varchar(255) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `published` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_training_details`
--

CREATE TABLE `td_training_details` (
  `trn_det_id` int(11) NOT NULL,
  `trn_id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `note` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `td_users`
--

CREATE TABLE `td_users` (
  `id` int(11) NOT NULL,
  `user_type` varchar(250) NOT NULL COMMENT 'admin==>A,college==>C,student==>S,pg==>P',
  `college_cat` varchar(250) NOT NULL,
  `college_name` int(11) NOT NULL,
  `student_name` varchar(250) NOT NULL,
  `logo_image` varchar(250) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `college_website` varchar(250) NOT NULL,
  `college_city` varchar(250) NOT NULL,
  `college_description` longtext NOT NULL,
  `college_establish` int(11) NOT NULL,
  `student_diploma_college` int(11) NOT NULL,
  `student_degree_college` int(11) NOT NULL,
  `student_pg_college_name` varchar(250) NOT NULL,
  `other_qualification` varchar(250) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip_address` varchar(250) NOT NULL,
  `last_login` varchar(250) NOT NULL,
  `last_browser_used` varchar(250) NOT NULL,
  `published` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `td_users`
--

INSERT INTO `td_users` (`id`, `user_type`, `college_cat`, `college_name`, `student_name`, `logo_image`, `address`, `phone`, `email`, `college_website`, `college_city`, `college_description`, `college_establish`, `student_diploma_college`, `student_degree_college`, `student_pg_college_name`, `other_qualification`, `username`, `password`, `ip_address`, `last_login`, `last_browser_used`, `published`) VALUES
(1, 'A', '0', 0, '', 'admin_logo_bongineers.jpg', '', '', '', '', '', '', 0, 0, 0, '', '', 'admin', 'admin', '::1', '2018-07-10 12:33:08pm', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `td_attendance`
--
ALTER TABLE `td_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `td_company_location`
--
ALTER TABLE `td_company_location`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `td_company_settings`
--
ALTER TABLE `td_company_settings`
  ADD PRIMARY KEY (`com_id`);

--
-- Indexes for table `td_country`
--
ALTER TABLE `td_country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `td_department`
--
ALTER TABLE `td_department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `td_designation`
--
ALTER TABLE `td_designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `td_employee_office_details`
--
ALTER TABLE `td_employee_office_details`
  ADD PRIMARY KEY (`office_details_id`);

--
-- Indexes for table `td_employee_performance`
--
ALTER TABLE `td_employee_performance`
  ADD PRIMARY KEY (`emp_performance_id`);

--
-- Indexes for table `td_employee_personal_details`
--
ALTER TABLE `td_employee_personal_details`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `td_employee_skill_matrix`
--
ALTER TABLE `td_employee_skill_matrix`
  ADD PRIMARY KEY (`sm_id`);

--
-- Indexes for table `td_emp_salary`
--
ALTER TABLE `td_emp_salary`
  ADD PRIMARY KEY (`emp_sal_id`);

--
-- Indexes for table `td_finance`
--
ALTER TABLE `td_finance`
  ADD PRIMARY KEY (`fin_id`);

--
-- Indexes for table `td_half_day_assign`
--
ALTER TABLE `td_half_day_assign`
  ADD PRIMARY KEY (`halfday_assign_id`);

--
-- Indexes for table `td_job_type`
--
ALTER TABLE `td_job_type`
  ADD PRIMARY KEY (`jobtype_id`);

--
-- Indexes for table `td_late`
--
ALTER TABLE `td_late`
  ADD PRIMARY KEY (`late_id`);

--
-- Indexes for table `td_leave`
--
ALTER TABLE `td_leave`
  ADD PRIMARY KEY (`leave_id`);

--
-- Indexes for table `td_leave_allocation`
--
ALTER TABLE `td_leave_allocation`
  ADD PRIMARY KEY (`leave_allocation_id`);

--
-- Indexes for table `td_leave_allocation_details`
--
ALTER TABLE `td_leave_allocation_details`
  ADD PRIMARY KEY (`leave_allocation_details_id`);

--
-- Indexes for table `td_leave_assign`
--
ALTER TABLE `td_leave_assign`
  ADD PRIMARY KEY (`leave_assign_id`);

--
-- Indexes for table `td_salary`
--
ALTER TABLE `td_salary`
  ADD PRIMARY KEY (`salary_id`);

--
-- Indexes for table `td_salary_all`
--
ALTER TABLE `td_salary_all`
  ADD PRIMARY KEY (`salary_id`);

--
-- Indexes for table `td_salary_details`
--
ALTER TABLE `td_salary_details`
  ADD PRIMARY KEY (`salary_details_id`);

--
-- Indexes for table `td_salary_detail_all`
--
ALTER TABLE `td_salary_detail_all`
  ADD PRIMARY KEY (`salary_detail_id`);

--
-- Indexes for table `td_salary_head`
--
ALTER TABLE `td_salary_head`
  ADD PRIMARY KEY (`salary_head_id`);

--
-- Indexes for table `td_salary_head_value`
--
ALTER TABLE `td_salary_head_value`
  ADD PRIMARY KEY (`salary_head_value_id`);

--
-- Indexes for table `td_salary_head_value_details`
--
ALTER TABLE `td_salary_head_value_details`
  ADD PRIMARY KEY (`salary_head_value_details_id`);

--
-- Indexes for table `td_site_settings`
--
ALTER TABLE `td_site_settings`
  ADD PRIMARY KEY (`site_id`);

--
-- Indexes for table `td_skill`
--
ALTER TABLE `td_skill`
  ADD PRIMARY KEY (`skill_id`);

--
-- Indexes for table `td_training`
--
ALTER TABLE `td_training`
  ADD PRIMARY KEY (`trn_id`);

--
-- Indexes for table `td_training_details`
--
ALTER TABLE `td_training_details`
  ADD PRIMARY KEY (`trn_det_id`);

--
-- Indexes for table `td_users`
--
ALTER TABLE `td_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `td_attendance`
--
ALTER TABLE `td_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `td_company_location`
--
ALTER TABLE `td_company_location`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `td_company_settings`
--
ALTER TABLE `td_company_settings`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `td_country`
--
ALTER TABLE `td_country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT for table `td_department`
--
ALTER TABLE `td_department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `td_designation`
--
ALTER TABLE `td_designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `td_employee_office_details`
--
ALTER TABLE `td_employee_office_details`
  MODIFY `office_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `td_employee_performance`
--
ALTER TABLE `td_employee_performance`
  MODIFY `emp_performance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_employee_personal_details`
--
ALTER TABLE `td_employee_personal_details`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `td_employee_skill_matrix`
--
ALTER TABLE `td_employee_skill_matrix`
  MODIFY `sm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_emp_salary`
--
ALTER TABLE `td_emp_salary`
  MODIFY `emp_sal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `td_finance`
--
ALTER TABLE `td_finance`
  MODIFY `fin_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_half_day_assign`
--
ALTER TABLE `td_half_day_assign`
  MODIFY `halfday_assign_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_job_type`
--
ALTER TABLE `td_job_type`
  MODIFY `jobtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `td_late`
--
ALTER TABLE `td_late`
  MODIFY `late_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `td_leave`
--
ALTER TABLE `td_leave`
  MODIFY `leave_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `td_leave_allocation`
--
ALTER TABLE `td_leave_allocation`
  MODIFY `leave_allocation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `td_leave_allocation_details`
--
ALTER TABLE `td_leave_allocation_details`
  MODIFY `leave_allocation_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `td_leave_assign`
--
ALTER TABLE `td_leave_assign`
  MODIFY `leave_assign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `td_salary`
--
ALTER TABLE `td_salary`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `td_salary_all`
--
ALTER TABLE `td_salary_all`
  MODIFY `salary_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_salary_details`
--
ALTER TABLE `td_salary_details`
  MODIFY `salary_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `td_salary_detail_all`
--
ALTER TABLE `td_salary_detail_all`
  MODIFY `salary_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_salary_head`
--
ALTER TABLE `td_salary_head`
  MODIFY `salary_head_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `td_salary_head_value`
--
ALTER TABLE `td_salary_head_value`
  MODIFY `salary_head_value_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_salary_head_value_details`
--
ALTER TABLE `td_salary_head_value_details`
  MODIFY `salary_head_value_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `td_site_settings`
--
ALTER TABLE `td_site_settings`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `td_skill`
--
ALTER TABLE `td_skill`
  MODIFY `skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `td_training`
--
ALTER TABLE `td_training`
  MODIFY `trn_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_training_details`
--
ALTER TABLE `td_training_details`
  MODIFY `trn_det_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_users`
--
ALTER TABLE `td_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
