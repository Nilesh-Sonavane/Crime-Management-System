-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2024 at 07:55 AM
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
-- Database: `crime_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(15) NOT NULL,
  `pass` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `pass`) VALUES
(1, 'admin@gmail.com', '0000');

-- --------------------------------------------------------

--
-- Table structure for table `arrested_person`
--

CREATE TABLE `arrested_person` (
  `arrested_id` int(11) NOT NULL,
  `arrested_name` varchar(50) NOT NULL,
  `dob` varchar(15) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `arrested_date` varchar(15) NOT NULL,
  `arrested_time` varchar(15) NOT NULL,
  `crime_id` int(11) NOT NULL,
  `location` varchar(80) NOT NULL,
  `bail_amount` varchar(10) NOT NULL,
  `img` varchar(100) NOT NULL,
  `payment_id` varchar(50) NOT NULL DEFAULT 'Pending',
  `police_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `arrested_person`
--

INSERT INTO `arrested_person` (`arrested_id`, `arrested_name`, `dob`, `gender`, `arrested_date`, `arrested_time`, `crime_id`, `location`, `bail_amount`, `img`, `payment_id`, `police_id`, `station_id`) VALUES
(9, 'rajesh kumar', '2003-09-03', 'Male', '2024-03-10', '22:05', 2, 'near ring road', '1200', '1arreste65.jpg', 'Pending', 15, 20),
(11, 'naveen gupta', '2003-09-02', 'Male', '2024-03-10', '22:22', 4, 'mfreklf mvre fmrefc', '800', '11areest123.jpg', 'pay_NkjDVZsJRiJpvD', 15, 20),
(12, 'kirtan', '1990-02-14', 'Female', '2024-03-11', '12:09', 4, 'near saroli bridge ', '1500', '12abc.jpg', 'pay_NkxaS7ZVA3N3FH', 16, 22),
(13, 'jay', '2006-03-11', 'Male', '2024-03-11', '16:11', 1, 'ede3cd 3f ', '1200', '13arretesd8569.jpg', 'Pending', 17, 20);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(50) NOT NULL,
  `state_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`city_id`, `city_name`, `state_id`) VALUES
(1, 'Visakhapatnam', 1),
(2, 'Vijayawada', 1),
(3, 'Guntur', 1),
(4, 'Nellore', 1),
(5, 'Kurnool', 1),
(6, 'Rajahmundry', 1),
(7, 'Kakinada', 1),
(8, 'Tirupati', 1),
(9, 'Anantapur', 1),
(10, 'Kadapa (Cuddapah)', 1),
(11, 'Vizianagaram', 1),
(12, 'Eluru', 1),
(13, 'Ongole', 1),
(14, 'Machilipatnam (Masulipatnam)', 1),
(15, 'Itanagar (Capital city)', 2),
(16, 'Naharlagun', 2),
(17, 'Tawang', 2),
(18, 'Pasighat', 2),
(19, 'Aalo (Along)', 2),
(20, 'Roing', 2),
(21, 'Tezu', 2),
(22, 'Bomdila', 2),
(23, 'Ziro', 2),
(24, 'Daporijo', 2),
(25, 'Yingkiong', 2),
(26, 'Khonsa', 2),
(27, 'Longding', 2),
(28, 'Guwahati', 3),
(29, 'Dibrugarh', 3),
(30, 'Jorhat', 3),
(31, 'Silchar', 3),
(32, 'Nagaon', 3),
(33, 'Tezpur', 3),
(34, 'Tinsukia', 3),
(35, 'Bongaigaon', 3),
(36, 'Sivasagar', 3),
(37, 'Barpeta', 3),
(38, 'Kokrajhar', 3),
(39, 'Diphu', 3),
(40, 'North Lakhimpur', 3),
(41, 'Karimganj', 3),
(42, 'Patna (Capital city)', 4),
(43, 'Gaya', 4),
(44, 'Muzaffarpur', 4),
(45, 'Bhagalpur', 4),
(46, 'Darbhanga', 4),
(47, 'Purnia', 4),
(48, 'Arrah', 4),
(49, 'Katihar', 4),
(50, 'Munger', 4),
(51, 'Bihar Sharif', 4),
(52, 'Bettiah', 4),
(53, 'Saharsa', 4),
(54, 'Sasaram', 4),
(55, 'Hajipur', 4),
(56, 'Raipur (Capital city)', 5),
(57, 'Bilaspur', 5),
(58, 'Bhilai', 5),
(59, 'Durg', 5),
(60, 'Korba', 5),
(61, 'Raigarh', 5),
(62, 'Jagdalpur', 5),
(63, 'Ambikapur', 5),
(64, 'Rajnandgaon', 5),
(65, 'Chirmiri', 5),
(66, 'Kanker', 5),
(67, 'Dhamtari', 5),
(68, 'Janjgir', 5),
(69, 'Kawardha', 5),
(70, 'Panaji (Capital city)', 6),
(71, 'Margao', 6),
(72, 'Vasco da Gama', 6),
(73, 'Mapusa', 6),
(74, 'Ponda', 6),
(75, 'Calangute', 6),
(76, 'Curchorem', 6),
(77, 'Quepem', 6),
(78, 'Sanquelim', 6),
(79, 'Valpoi', 6),
(80, 'Cuncolim', 6),
(81, 'Sanguem', 6),
(82, 'Bicholim', 6),
(83, 'Colva', 6),
(84, 'Ahmedabad', 7),
(85, 'Surat', 7),
(86, 'Vadodara (Baroda)', 7),
(87, 'Rajkot', 7),
(88, 'Bhavnagar', 7),
(89, 'Jamnagar', 7),
(90, 'Gandhinagar (Capital city)', 7),
(91, 'Anand', 7),
(92, 'Vapi', 7),
(93, 'Bharuch', 7),
(94, 'Navsari', 7),
(95, 'Morbi', 7),
(96, 'Surendranagar', 7),
(97, 'Gandhidham', 7),
(98, 'Porbandar', 7),
(99, 'Valsad', 7),
(100, 'Mehsana', 7),
(101, 'Bhuj', 7),
(102, 'Amreli', 7),
(103, 'Junagadh', 7),
(104, 'Chandigarh', 8),
(105, 'Faridabad', 8),
(106, 'Gurgaon (Gurugram)', 8),
(107, 'Hisar', 8),
(108, 'Rohtak', 8),
(109, 'Panipat', 8),
(110, 'Karnal', 8),
(111, 'Ambala', 8),
(112, 'Yamunanagar', 8),
(113, 'Panchkula', 8),
(114, 'Sonipat', 8),
(115, 'Bhiwani', 8),
(116, 'Sirsa', 8),
(117, 'Kurukshetra', 8),
(118, 'Shimla (Capital city)', 9),
(119, 'Manali', 9),
(120, 'Dharamshala', 9),
(121, 'Solan', 9),
(122, 'Hamirpur', 9),
(123, 'Mandi', 9),
(124, 'Kangra', 9),
(125, 'Una', 9),
(126, 'Bilaspur', 9),
(127, 'Chamba', 9),
(128, 'Kullu', 9),
(129, 'Nahan', 9),
(130, 'Palampur', 9),
(131, 'Paonta Sahib', 9),
(132, 'Ranchi (Capital city)', 10),
(133, 'Jamshedpur', 10),
(134, 'Dhanbad', 10),
(135, 'Bokaro Steel City', 10),
(136, 'Hazaribagh', 10),
(137, 'Deoghar', 10),
(138, 'Giridih', 10),
(139, 'Ramgarh', 10),
(140, 'Dumka', 10),
(141, 'Sahibganj', 10),
(142, 'Jharia', 10),
(143, 'Gumla', 10),
(144, 'Simdega', 10),
(145, 'Chaibasa', 10),
(146, 'Bangalore (Bengaluru)', 11),
(147, 'Mysore (Mysuru)', 11),
(148, 'Hubli-Dharwad ', 11),
(149, 'Mangalore (Mangaluru)', 11),
(150, 'Belgaum (Belagavi)', 11),
(151, 'Gulbarga (Kalaburagi)', 11),
(152, 'Davangere', 11),
(153, 'Bellary (Ballari) ', 11),
(154, 'Bijapur (Vijayapura)', 11),
(155, 'Hospet', 11),
(156, 'Udupi', 11),
(157, 'Bidar', 11),
(158, 'Hassan', 11),
(159, 'Raichur', 11),
(160, 'Thiruvananthapuram', 12),
(161, 'Kochi (Cochin)', 12),
(162, 'Kozhikode (Calicut)', 12),
(163, 'Thrissur', 12),
(164, 'Kollam (Quilon)', 12),
(165, 'Kannur (Cannanore)', 12),
(166, 'Alappuzha (Alleppey)', 12),
(167, 'Palakkad', 12),
(168, 'Malappuram', 12),
(169, 'Kottayam', 12),
(170, 'Pathanamthitta', 12),
(171, 'Kasaragod', 12),
(172, 'Idukki', 12),
(173, 'Wayanad', 12),
(174, 'Bhopal', 13),
(175, 'Indore', 13),
(176, 'Jabalpur', 13),
(177, 'Gwalior', 13),
(178, 'Ujjain', 13),
(179, 'Sagar', 13),
(180, 'Rewa', 13),
(181, 'Satna', 13),
(182, 'Ratlam', 13),
(183, 'Khandwa', 13),
(184, 'Burhanpur', 13),
(185, 'Chhindwara', 13),
(186, 'Shivpuri', 13),
(187, 'Vidisha', 13),
(188, 'Mumbai (Capital of Maharashtra)', 14),
(189, 'Pune', 14),
(190, 'Nagpur', 14),
(191, 'Thane', 14),
(192, 'Nashik', 14),
(193, 'Aurangabad', 14),
(194, 'Solapur', 14),
(195, 'Amravati', 14),
(196, 'Navi Mumbai', 14),
(197, 'Kolhapur', 14),
(198, 'Akola', 14),
(199, 'Latur', 14),
(200, 'Jalgaon', 14),
(201, 'Ahmednagar', 14),
(202, 'Imphal (State Capital)', 15),
(203, 'Thoubal', 15),
(204, 'Bishnupur', 15),
(205, 'Churachandpur', 15),
(206, 'Kakching', 15),
(207, 'Moirang', 15),
(208, 'Ukhrul', 15),
(209, 'Senapati', 15),
(210, 'Tamenglong', 15),
(211, 'Jiribam', 15),
(212, 'Chandel', 15),
(213, 'Moreh', 15),
(214, 'Noney', 15),
(215, 'Kangpokpi', 15),
(216, 'Shillong (State Capital)', 16),
(217, 'Tura', 16),
(218, 'Jowai', 16),
(219, 'Nongpoh', 16),
(220, 'Baghmara', 16),
(221, 'Williamnagar', 16),
(222, 'Resubelpara', 16),
(223, 'Nongstoin', 16),
(224, 'Khliehriat', 16),
(225, 'Mairang', 16),
(226, 'Sohra (Cherrapunji)', 16),
(227, 'Ampati', 16),
(228, 'Mawkyrwat', 16),
(229, 'Amlarem', 16),
(230, 'Aizawl (State Capital)', 17),
(231, 'Lunglei', 17),
(232, 'Champhai', 17),
(233, 'Serchhip', 17),
(234, 'Kolasib', 17),
(235, 'Saiha', 17),
(236, 'Lawngtlai', 17),
(237, 'Mamit', 17),
(238, 'Hnahthial', 17),
(239, 'Thenzawl', 17),
(240, 'Khawzawl', 17),
(241, 'Bilkhawthlir', 17),
(242, 'Chawngte', 17),
(243, 'Saitual', 17),
(244, 'Kohima (State Capital)', 18),
(245, 'Dimapur', 18),
(246, 'Mokokchung', 18),
(247, 'Tuensang', 18),
(248, 'Wokha', 18),
(249, 'Zunheboto', 18),
(250, 'Phek', 18),
(251, 'Mon', 18),
(252, 'Kiphire', 18),
(253, 'Longleng', 18),
(254, 'Bhubaneswar (State Capital)', 19),
(255, 'Cuttack', 19),
(256, 'Rourkela', 19),
(257, 'Puri', 19),
(258, 'Sambalpur', 19),
(259, 'Berhampur', 19),
(260, 'Balasore', 19),
(261, 'Baripada', 19),
(262, 'Bhadrak', 19),
(263, 'Jharsuguda', 19),
(264, 'Anugul (Angul)', 19),
(265, 'Kendujhar', 19),
(266, 'Jagatsinghpur', 19),
(267, 'Paradeep', 19),
(268, 'Chandigarh (Union Territory and Capital)', 20),
(269, 'Amritsar', 20),
(270, 'Ludhiana', 20),
(271, 'Jalandhar', 20),
(272, 'Patiala', 20),
(273, 'Bathinda', 20),
(274, 'Hoshiarpur', 20),
(275, 'Mohali (Sahibzada Ajit Singh Nagar)', 20),
(276, 'Pathankot', 20),
(277, 'Moga', 20),
(278, 'Batala', 20),
(279, 'Sangrur', 20),
(280, 'Gurdaspur', 20),
(281, 'Kapurthala', 20),
(282, 'Jaipur (the capital city)', 21),
(283, 'Jodhpur', 21),
(284, 'Udaipur', 21),
(285, 'Ajmer', 21),
(286, 'Kota', 21),
(287, 'Bikaner', 21),
(288, 'Alwar', 21),
(289, 'Sikar', 21),
(290, 'Bhilwara', 21),
(291, 'Jhunjhunu', 21),
(292, 'Chittorgarh', 21),
(293, 'Pali', 21),
(294, 'Ganganagar', 21),
(295, 'Bharatpur', 21),
(296, 'Gangtok (Capital city)', 22),
(297, 'Namchi', 22),
(298, 'Mangan', 22),
(299, 'Jorethang', 22),
(300, 'Singtam', 22),
(301, 'Rangpo', 22),
(302, 'Ravangla', 22),
(303, 'Pakyong', 22),
(304, 'Gyalshing ', 22),
(305, 'Lachen', 22),
(306, 'Lachung', 22),
(307, 'Chungthang', 22),
(308, 'Yuksom', 22),
(309, 'Chennai (Capital and largest city)', 23),
(310, 'Coimbatore', 23),
(311, 'Madurai', 23),
(312, 'Tiruchirappalli (Trichy)', 23),
(313, 'Salem', 23),
(314, 'Tirunelveli', 23),
(315, 'Vellore', 23),
(316, 'Erode', 23),
(317, 'Thoothukudi (Tuticorin)', 23),
(318, 'Thanjavur', 23),
(319, 'Dindigul', 23),
(320, 'Nagercoil', 23),
(321, 'Cuddalore', 23),
(322, 'Kancheepuram', 23),
(323, 'Hyderabad (Capital and largest city)', 24),
(324, 'Warangal', 24),
(325, 'Nizamabad', 24),
(326, 'Karimnagar', 24),
(327, 'Ramagundam', 24),
(328, 'Khammam', 24),
(329, 'Mahbubnagar', 24),
(330, 'Nalgonda', 24),
(331, 'Siddipet', 24),
(332, 'Adilabad', 24),
(333, 'Miryalaguda', 24),
(334, 'Jagtial', 24),
(335, 'Suryapet', 24),
(336, 'Wanaparthy', 24),
(337, 'Agartala (Capital)', 25),
(338, 'Udaipur', 25),
(339, 'Dharmanagar', 25),
(340, 'Ambassa', 25),
(341, 'Kailasahar', 25),
(342, 'Belonia', 25),
(343, 'Kamalpur', 25),
(344, 'Sabroom', 25),
(345, 'Sonamura', 25),
(346, 'Khowai', 25),
(347, 'Bishalgarh', 25),
(348, 'Amarpur', 25),
(349, 'Ranirbazar', 25),
(350, 'Lucknow (Capital)', 26),
(351, 'Kanpur', 26),
(352, 'Varanasi', 26),
(353, 'Agra', 26),
(354, 'Allahabad (Prayagraj)', 26),
(355, 'Meerut', 26),
(356, 'Ghaziabad', 26),
(357, 'Noida', 26),
(358, 'Bareilly', 26),
(359, 'Aligarh', 26),
(360, 'Moradabad', 26),
(361, 'Gorakhpur', 26),
(362, 'Saharanpur', 26),
(363, 'Firozabad', 26),
(364, 'Dehradun (Capital)', 27),
(365, 'Haridwar', 27),
(366, 'Rishikesh', 27),
(367, 'Nainital', 27),
(368, 'Mussoorie', 27),
(369, 'Haldwani', 27),
(370, 'Rudrapur', 27),
(371, 'Kashipur', 27),
(372, 'Udham Singh Nagar', 27),
(373, 'Almora', 27),
(374, 'Pithoragarh', 27),
(375, 'Chamoli', 27),
(376, 'Bageshwar', 27),
(377, 'Tehri', 27),
(378, 'Kolkata (Capital)', 28),
(379, 'Asansol', 28),
(380, 'Siliguri', 28),
(381, 'Durgapur', 28),
(382, 'Howrah', 28),
(383, 'Darjeeling', 28),
(384, 'Malda', 28),
(385, 'Kharagpur', 28),
(386, 'Haldia', 28),
(387, 'Bardhaman (Burdwan)', 28),
(388, 'Raiganj', 28),
(389, 'Krishnanagar', 28),
(390, 'Baharampur (Berhampore)', 28),
(391, 'Jalpaiguri', 28),
(392, 'Port Blair (Capital)', 29),
(393, 'Havelock Island (Swaraj Island)', 29),
(394, 'Neil Island (Shaheed Island)', 29),
(395, 'Diglipur', 29),
(396, 'Rangat', 29),
(397, 'Mayabunder', 29),
(398, 'Car Nicobar', 29),
(400, 'Daman', 30),
(401, 'Diu', 30),
(402, 'Silvassa (Capital of Dadra and Nagar Haveli)', 30),
(403, 'Kavaratti (Capital)', 31),
(404, 'Agatti', 31),
(405, 'Amini', 31),
(406, 'Andrott', 31),
(407, 'Bitra', 31),
(408, 'Chetlat', 31),
(409, 'Kadmat', 31),
(410, 'Kalpeni', 31),
(411, 'Kiltan', 31),
(412, 'Minicoy', 31),
(413, 'Kalpitti (Cheriyam)', 31),
(414, 'Pitti (Cheriyam)', 31),
(415, 'Suheli Par', 31),
(416, 'Bangaram', 31),
(417, 'New Delhi (Central Delhi)', 32),
(418, 'Old Delhi (Shahjahanabad)', 32),
(419, 'South Delhi', 32),
(420, 'North Delhi', 32),
(421, 'East Delhi', 32),
(422, 'West Delhi', 32),
(423, 'Central Delhi', 32),
(424, 'North West Delhi', 32),
(425, 'North East Delhi', 32),
(426, 'South West Delhi', 32),
(427, 'Puducherry (Pondicherry) - Capital', 33),
(428, 'Karaikal', 33),
(429, 'Mahe', 33),
(430, 'Yanam', 33),
(431, 'Leh (Ladakh\'s largest town and administrative capi', 34),
(432, 'Kargil', 34),
(433, 'Diskit', 34),
(434, 'Nubra Valley', 34),
(435, 'Pangong Lake', 34),
(436, 'Tso Moriri Lake', 34),
(437, 'Lamayuru', 34),
(438, 'Drass', 34),
(439, 'Zanskar Valley', 34),
(440, 'Jammu (Winter capital)', 35),
(441, 'Udhampur', 35),
(442, 'Katra', 35),
(443, 'Samba', 35),
(444, 'Rajouri', 35),
(445, 'Poonch', 35),
(446, 'Doda', 35),
(447, 'Ramban', 35),
(448, 'Kishtwar', 35),
(449, 'Srinagar (Summer capital)', 35),
(450, 'Anantnag', 35),
(451, 'Baramulla', 35),
(452, 'Pulwama', 35),
(453, 'Sopore', 35);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`) VALUES
(1, 'India');

-- --------------------------------------------------------

--
-- Table structure for table `crimetype`
--

CREATE TABLE `crimetype` (
  `crime_id` int(11) NOT NULL,
  `crime_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crimetype`
--

INSERT INTO `crimetype` (`crime_id`, `crime_name`) VALUES
(1, 'Mobile Theft'),
(2, 'Vehical Theft'),
(4, 'Fraud'),
(5, 'murder'),
(6, 'Child Abuse'),
(7, 'Domestic abuse');

-- --------------------------------------------------------

--
-- Table structure for table `fir`
--

CREATE TABLE `fir` (
  `fir_id` bigint(20) NOT NULL,
  `crime_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fir_date` varchar(12) NOT NULL,
  `fir_time` varchar(15) NOT NULL,
  `fir_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fir`
--

INSERT INTO `fir` (`fir_id`, `crime_id`, `user_id`, `fir_date`, `fir_time`, `fir_status`) VALUES
(20241003092148, 2, 31, '2024-03-10', '09:21:48pm', 1),
(20241103010410, 2, 33, '2024-03-11', '01:04:10pm', 2),
(20241103041817, 1, 31, '2024-03-11', '04:18:17pm', 1),
(20241103122641, 1, 32, '2024-03-11', '12:26:41pm', 3);

-- --------------------------------------------------------

--
-- Table structure for table `fir_status`
--

CREATE TABLE `fir_status` (
  `status_id` int(11) NOT NULL,
  `status_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fir_status`
--

INSERT INTO `fir_status` (`status_id`, `status_name`) VALUES
(1, 'Registered'),
(2, 'Under Investigation'),
(3, 'Closed'),
(4, 'Charges Filed'),
(5, 'Arrest Made'),
(6, 'Case Pending Trial'),
(7, 'Conviction'),
(8, 'Acquittal'),
(9, 'Unsolved');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `img_id` int(11) NOT NULL,
  `img_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`img_id`, `img_name`) VALUES
(17, '1media-1.jpg'),
(18, '18media-2.jpg'),
(19, '19media-3.jpg'),
(20, '20media-4.jpg'),
(21, '21media-5.jpg'),
(22, '22media-6.jpg'),
(23, '23media-7.jpeg'),
(24, '24media-8.jpg'),
(25, '25media-9.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `mobile_fir`
--

CREATE TABLE `mobile_fir` (
  `mobile_fir_id` int(11) NOT NULL,
  `fir_id` bigint(20) NOT NULL,
  `imei_no` varchar(17) NOT NULL,
  `brand` varchar(15) NOT NULL,
  `model` varchar(15) NOT NULL,
  `color` varchar(15) NOT NULL,
  `location_of_theft` varchar(50) NOT NULL,
  `city_id` int(11) NOT NULL,
  `station_id` int(11) NOT NULL,
  `date_of_theft` varchar(15) NOT NULL,
  `time_of_theft` varchar(15) NOT NULL,
  `mobail_bill` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mobile_fir`
--

INSERT INTO `mobile_fir` (`mobile_fir_id`, `fir_id`, `imei_no`, `brand`, `model`, `color`, `location_of_theft`, `city_id`, `station_id`, `date_of_theft`, `time_of_theft`, `mobail_bill`) VALUES
(43, 20241103122641, '986523124562326', 'vivo', 'v27', 'blue', 'chor bazzar vhfjvg7 ghukj', 85, 20, '2024-03-11', '12:23:00pm', '1bill_mobil_image.jpeg'),
(44, 20241103041817, '854679845612569', 'vivo', 'cdsc', 'cdcd', 'cdsc', 85, 20, '2024-03-11', '04:14:00pm', '44bill_mobil_image.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `news&announcement`
--

CREATE TABLE `news&announcement` (
  `id` int(11) NOT NULL,
  `date` varchar(15) NOT NULL,
  `link` varchar(500) NOT NULL,
  `text` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `news&announcement`
--

INSERT INTO `news&announcement` (`id`, `date`, `link`, `text`) VALUES
(10, '2024-03-10', 'https://timesofindia.indiatimes.com/city/ahmedabad/malware-rate-surat-ahmedabad-in-top-5-cities/articleshow/106910908.cms', 'Malware rate: Surat, Ahmedabad in top 5 cities'),
(11, '2024-03-10', 'https://timesofindia.indiatimes.com/city/mumbai/surat-company-director-arrested-for-buying-diamonds-not-paying-rs-42cr/articleshow/107736576.cms', 'Surat company director arrested for buying diamonds, not paying Rs 42cr'),
(12, '2024-03-10', 'https://www.indiatoday.in/crime/story/uttar-pradesh-teen-girl-beaten-to-death-her-mutilated-body-found-in-cane-field-2447534-2023-10-11', 'Minor girls mutilated body found in cane field in UPs Lakhimpur Kheri');

-- --------------------------------------------------------

--
-- Table structure for table `police`
--

CREATE TABLE `police` (
  `police_id` int(3) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `middle_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `dob` varchar(10) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `city_id` int(3) NOT NULL,
  `rank_id` int(3) NOT NULL,
  `station_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `police`
--

INSERT INTO `police` (`police_id`, `first_name`, `middle_name`, `last_name`, `dob`, `contact`, `email`, `pass`, `city_id`, `rank_id`, `station_id`) VALUES
(15, 'Ajay', 'Kumar', 'Tomar', '1991-06-04', '8457956238', 'srsonawane2005@gmail.com', '$2y$10$WKsz9BtfAGeccp5rvcprjOKwkexofWiDO3M8NtfvE34xZ6KVS4ni2', 85, 6, 20),
(16, 'Priya', 'ganesh', 'ronivala', '2003-03-11', '9316223287', 'dreamwinner4918@gmail.com', '$2y$10$oi3UV4Udb1t4uSZpwtqiMes1n6BSRdlWmito0Z9omLuOnpl4.d6wK', 85, 9, 22),
(17, 'ndeksd', 'xqxxs', 'xnqkx', '2003-03-04', '9541789546', 'nrsonawane2003@gmail.com', '$2y$10$xeIWVKRxlfxMgcZrw8RWaOvJ01bqbnZr0G/sZycF.8gAgxDM3lFMi', 85, 6, 20);

-- --------------------------------------------------------

--
-- Table structure for table `police_ranks`
--

CREATE TABLE `police_ranks` (
  `rank_id` int(11) NOT NULL,
  `rank_name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `police_ranks`
--

INSERT INTO `police_ranks` (`rank_id`, `rank_name`) VALUES
(1, 'DGP'),
(2, 'ADG'),
(3, 'IGP'),
(4, 'DIGP'),
(5, 'SSP'),
(6, 'SP'),
(7, 'ASP'),
(8, 'DSP'),
(9, 'Inspector'),
(10, 'Sub-Inspector'),
(11, 'Assistant Sub-Inspector'),
(12, 'Head Constable'),
(13, 'Constable');

-- --------------------------------------------------------

--
-- Table structure for table `police_station`
--

CREATE TABLE `police_station` (
  `station_id` int(5) NOT NULL,
  `station_name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city_id` int(5) NOT NULL,
  `contact` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `police_station`
--

INSERT INTO `police_station` (`station_id`, `station_name`, `address`, `city_id`, `contact`) VALUES
(20, 'chock bajar police station', 'section 19, near chock bajar', 85, '8456951256'),
(21, 'mumbai central police station', 'near shivaji road', 188, '8456921659'),
(22, 'pal police station', 'near pal rto', 85, '5689485679'),
(23, 'ved police station', 'near ved road', 85, '8516495623');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `id` int(11) NOT NULL,
  `img` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `img`) VALUES
(5, '1maxresdefault.jpg'),
(6, '6maxresdefault1.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(40) NOT NULL,
  `country_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`state_id`, `state_name`, `country_id`) VALUES
(1, 'Andhra Pradesh', 1),
(2, 'Arunachal Pradesh', 1),
(3, 'Assam', 1),
(4, 'Bihar', 1),
(5, 'Chhattisgarh', 1),
(6, 'Goa', 1),
(7, 'Gujarat', 1),
(8, 'Haryana', 1),
(9, 'Himachal Pradesh', 1),
(10, 'Jharkhand', 1),
(11, 'Karnataka', 1),
(12, 'Kerala', 1),
(13, 'Madhya Pradesh', 1),
(14, 'Maharashtra', 1),
(15, 'Manipur', 1),
(16, 'Meghalaya', 1),
(17, 'Mizoram', 1),
(18, 'Nagaland', 1),
(19, 'Odisha', 1),
(20, 'Punjab', 1),
(21, 'Rajasthan', 1),
(22, 'Sikkim', 1),
(23, 'Tamil Nadu', 1),
(24, 'Telangana', 1),
(25, 'Tripura', 1),
(26, 'Uttar Pradesh', 1),
(27, 'Uttarakhand', 1),
(28, 'West Bengal', 1),
(29, 'Andaman and Nicobar Islands', 1),
(30, 'Dadra and Nagar Haveli and Daman and Diu', 1),
(31, 'Lakshadweep', 1),
(32, 'Delhi (National Capital Territory of Del', 1),
(33, 'Puducherry', 1),
(34, 'Ladakh', 1),
(35, 'Jammu and Kashmir', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(3) NOT NULL,
  `fname` varchar(25) NOT NULL,
  `mname` varchar(25) NOT NULL,
  `lname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` varchar(12) NOT NULL,
  `aadhar_no` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `city_id` int(3) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img_url` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `fname`, `mname`, `lname`, `email`, `contact`, `gender`, `dob`, `aadhar_no`, `address`, `city_id`, `password`, `img_url`) VALUES
(31, 'shubham', 'ratilal', 'sonavane', 'srsonawane2005@gmail.com', '6353174640', 'Male', '2005-10-23', '8547 5962 4875', '09, bajarang nagar society dabholi road', 85, '$2y$10$bQYS7DwQOphwLX/tPNGvReOZ7TM/Rn8uat0VgUBmtyf365ihda4iq', 'male-user.png'),
(32, 'shivam', 'brijraj', 'prajapati', 'shivam4918@gmail.com', '8469428342', 'Male', '2006-02-11', '8956 2356 8956', '67,laxman nagar near ass pass dada temple godadara', 85, '$2y$10$E.XMt9kj7DFZOV5n97z4V.7hwymMQCrqR/aIBNtG4f3Bt9BQLc9cG', '33TeYNRqm2.jpg'),
(33, 'Kiran', 'Ajay', 'Kumar', 'kiranajay9979@gmail.com', '9979437961', 'Male', '2002-02-13', '2358 8521 3258', 'Shreenathji Tyres mumbai colony bhatha surat', 85, '$2y$10$x7il7pdMLSLUSHaHnFbUXeb3zGF7.07pjxCsaxFBJi3OLs7KsE2tK', 'male-user.png');

-- --------------------------------------------------------

--
-- Table structure for table `vehical_fir`
--

CREATE TABLE `vehical_fir` (
  `vehical_fir_id` int(11) NOT NULL,
  `fir_id` bigint(20) NOT NULL,
  `plate_no` varchar(15) NOT NULL,
  `brand` varchar(30) NOT NULL,
  `model_name` varchar(25) NOT NULL,
  `model_year` varchar(5) NOT NULL,
  `color` varchar(15) NOT NULL,
  `type` varchar(25) NOT NULL,
  `location_of_theft` varchar(50) NOT NULL,
  `city_id` int(5) NOT NULL,
  `station_id` int(5) NOT NULL,
  `date_of_theft` varchar(15) NOT NULL,
  `time_of_theft` varchar(15) NOT NULL,
  `vehical_rc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehical_fir`
--

INSERT INTO `vehical_fir` (`vehical_fir_id`, `fir_id`, `plate_no`, `brand`, `model_name`, `model_year`, `color`, `type`, `location_of_theft`, `city_id`, `station_id`, `date_of_theft`, `time_of_theft`, `vehical_rc`) VALUES
(23, 20241003092148, 'GJ 05 NS 5846', 'Honda', 'shine', '2015', 'Red And Black', 'two whleer', 'near railway station', 85, 20, '2024-03-10', '08:18:00pm', '1RC Front.JPG'),
(24, 20241103010410, 'GJ 05 NF 1252', 'Honda', 'City', '2015', 'grey', 'four ', 'pal', 85, 20, '2024-03-11', '01:01:00pm', '44IMG_RCBOOK.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `wanted_person`
--

CREATE TABLE `wanted_person` (
  `person_id` int(11) NOT NULL,
  `police_id` int(11) NOT NULL,
  `person_name` varchar(50) NOT NULL,
  `dob` varchar(15) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `height` varchar(15) NOT NULL,
  `weight` varchar(15) NOT NULL,
  `eye_color` varchar(20) NOT NULL,
  `hair_color` varchar(20) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `reward` varchar(50) NOT NULL,
  `photo_url` varchar(50) NOT NULL,
  `last_known_location` varchar(50) NOT NULL,
  `description` varchar(80) NOT NULL,
  `added_date` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wanted_person`
--

INSERT INTO `wanted_person` (`person_id`, `police_id`, `person_name`, `dob`, `gender`, `height`, `weight`, `eye_color`, `hair_color`, `nationality`, `reward`, `photo_url`, `last_known_location`, `description`, `added_date`) VALUES
(7, 15, 'navneet kumar', '1998-01-11', 'Male', '210cm', '68kg', 'black', 'black', 'indian', '12000', '8criminal.jpg', 'near railway station', 'please help and get reward.', '2024-03-10'),
(8, 15, 'amit shrma', '1991-10-17', 'Male', '205cm', '69kg', 'black', 'black', 'indian', '10000', '8criminal1236.jpg', 'near ring road', 'please help and get reward.', '2024-03-10'),
(9, 16, 'suraj', '2002-07-11', 'Male', '985cm', '56kg', 'black', 'blue', 'australia', '1500000', '9criminal1236.jpg', 'godadara', 'please contact me you see that person', '2024-03-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arrested_person`
--
ALTER TABLE `arrested_person`
  ADD PRIMARY KEY (`arrested_id`),
  ADD KEY `police_id` (`police_id`),
  ADD KEY `station_id` (`station_id`),
  ADD KEY `crime_id` (`crime_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`city_id`),
  ADD KEY `state_id` (`state_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `crimetype`
--
ALTER TABLE `crimetype`
  ADD PRIMARY KEY (`crime_id`);

--
-- Indexes for table `fir`
--
ALTER TABLE `fir`
  ADD PRIMARY KEY (`fir_id`),
  ADD KEY `crime_id` (`crime_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `fir_status`
--
ALTER TABLE `fir_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `mobile_fir`
--
ALTER TABLE `mobile_fir`
  ADD PRIMARY KEY (`mobile_fir_id`),
  ADD KEY `fir_id` (`fir_id`),
  ADD KEY `mobile_fir_ibfk_2` (`city_id`),
  ADD KEY `station_id` (`station_id`);

--
-- Indexes for table `news&announcement`
--
ALTER TABLE `news&announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `police`
--
ALTER TABLE `police`
  ADD PRIMARY KEY (`police_id`),
  ADD KEY `station_id` (`station_id`),
  ADD KEY `rank_id` (`rank_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `police_ranks`
--
ALTER TABLE `police_ranks`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indexes for table `police_station`
--
ALTER TABLE `police_station`
  ADD PRIMARY KEY (`station_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`state_id`),
  ADD KEY `country_id` (`country_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `city_id` (`city_id`);

--
-- Indexes for table `vehical_fir`
--
ALTER TABLE `vehical_fir`
  ADD PRIMARY KEY (`vehical_fir_id`),
  ADD KEY `fir_id` (`fir_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `station_id` (`station_id`);

--
-- Indexes for table `wanted_person`
--
ALTER TABLE `wanted_person`
  ADD PRIMARY KEY (`person_id`),
  ADD KEY `police_id` (`police_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `arrested_person`
--
ALTER TABLE `arrested_person`
  MODIFY `arrested_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `crimetype`
--
ALTER TABLE `crimetype`
  MODIFY `crime_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `mobile_fir`
--
ALTER TABLE `mobile_fir`
  MODIFY `mobile_fir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `news&announcement`
--
ALTER TABLE `news&announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `police`
--
ALTER TABLE `police`
  MODIFY `police_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `police_ranks`
--
ALTER TABLE `police_ranks`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `police_station`
--
ALTER TABLE `police_station`
  MODIFY `station_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `vehical_fir`
--
ALTER TABLE `vehical_fir`
  MODIFY `vehical_fir_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `wanted_person`
--
ALTER TABLE `wanted_person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `arrested_person`
--
ALTER TABLE `arrested_person`
  ADD CONSTRAINT `arrested_person_ibfk_1` FOREIGN KEY (`police_id`) REFERENCES `police` (`police_id`),
  ADD CONSTRAINT `arrested_person_ibfk_2` FOREIGN KEY (`station_id`) REFERENCES `police_station` (`station_id`),
  ADD CONSTRAINT `arrested_person_ibfk_3` FOREIGN KEY (`crime_id`) REFERENCES `crimetype` (`crime_id`);

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`state_id`);

--
-- Constraints for table `fir`
--
ALTER TABLE `fir`
  ADD CONSTRAINT `fir_ibfk_1` FOREIGN KEY (`crime_id`) REFERENCES `crimetype` (`crime_id`),
  ADD CONSTRAINT `fir_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `mobile_fir`
--
ALTER TABLE `mobile_fir`
  ADD CONSTRAINT `mobile_fir_ibfk_1` FOREIGN KEY (`fir_id`) REFERENCES `fir` (`fir_id`),
  ADD CONSTRAINT `mobile_fir_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`),
  ADD CONSTRAINT `mobile_fir_ibfk_3` FOREIGN KEY (`station_id`) REFERENCES `police_station` (`station_id`);

--
-- Constraints for table `police`
--
ALTER TABLE `police`
  ADD CONSTRAINT `police_ibfk_1` FOREIGN KEY (`station_id`) REFERENCES `police_station` (`station_id`),
  ADD CONSTRAINT `police_ibfk_2` FOREIGN KEY (`rank_id`) REFERENCES `police_ranks` (`rank_id`),
  ADD CONSTRAINT `police_ibfk_3` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`);

--
-- Constraints for table `police_station`
--
ALTER TABLE `police_station`
  ADD CONSTRAINT `police_station_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`);

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_ibfk_1` FOREIGN KEY (`country_id`) REFERENCES `countries` (`country_id`);

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`);

--
-- Constraints for table `vehical_fir`
--
ALTER TABLE `vehical_fir`
  ADD CONSTRAINT `vehical_fir_ibfk_1` FOREIGN KEY (`fir_id`) REFERENCES `fir` (`fir_id`),
  ADD CONSTRAINT `vehical_fir_ibfk_2` FOREIGN KEY (`city_id`) REFERENCES `cities` (`city_id`),
  ADD CONSTRAINT `vehical_fir_ibfk_3` FOREIGN KEY (`station_id`) REFERENCES `police_station` (`station_id`);

--
-- Constraints for table `wanted_person`
--
ALTER TABLE `wanted_person`
  ADD CONSTRAINT `wanted_person_ibfk_1` FOREIGN KEY (`police_id`) REFERENCES `police` (`police_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
