-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 18, 2023 at 10:29 AM
-- Server version: 5.7.33
-- PHP Version: 8.1.4

-- SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
-- START TRANSACTION;
-- SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `traveller_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`id`, `created_at`, `updated_at`, `name`, `img`) VALUES
(1, '2023-01-18 08:21:53', '2023-01-18 08:21:53', 'Balloning', 'activities/balloning.png'),
(2, '2023-01-18 08:36:46', '2023-01-18 08:36:46', 'Hiking', 'activities/hiking.png'),
(3, '2023-01-18 08:22:52', '2023-01-18 08:22:52', 'Kayaking', 'activities/kayaking.png'),
(4, '2023-01-18 08:22:52', '2023-01-18 08:22:52', 'Snorkling', 'activities/snorkling.png');

-- --------------------------------------------------------

--
-- Table structure for table `activity_festival`
--

CREATE TABLE `activity_festival` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `activity_id` bigint(20) UNSIGNED NOT NULL,
  `festival_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_festival`
--

INSERT INTO `activity_festival` (`id`, `created_at`, `updated_at`, `activity_id`, `festival_id`) VALUES
(1, '2023-01-19 21:31:22', '2023-01-19 21:31:22', 1, 1),
(2, '2023-01-19 21:32:11', '2023-01-19 21:32:11', 2, 1),
(3, '2023-01-19 21:32:11', '2023-01-19 21:32:11', 3, 2),
(4, '2023-01-19 21:32:11', '2023-01-19 21:32:11', 4, 5),
(5, '2023-01-19 21:32:11', '2023-01-19 21:32:11', 4, 4),
(6, '2023-01-19 21:32:11', '2023-01-19 21:32:11', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `activity_place`
--

CREATE TABLE `activity_place` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `activity_id` bigint(20) UNSIGNED NOT NULL,
  `place_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_place`
--

INSERT INTO `activity_place` (`id`, `created_at`, `updated_at`, `activity_id`, `place_id`) VALUES
(1, '2023-01-18 08:34:21', '2023-01-18 08:34:21', 2, 2),
(2, '2023-01-18 08:34:21', '2023-01-18 08:34:21', 3, 2),
(3, '2023-01-18 08:34:21', '2023-01-18 08:34:21', 1, 3),
(4, '2023-01-18 08:34:21', '2023-01-18 08:34:21', 2, 4),
(5, '2023-01-18 08:34:21', '2023-01-18 08:34:21', 4, 4),
(6, '2023-01-18 08:34:21', '2023-01-18 08:34:21', 2, 5),
(7, '2023-01-18 09:31:08', '2023-01-18 09:31:08', 1, 6),
(8, '2023-01-18 09:31:08', '2023-01-18 09:31:08', 2, 6);

-- --------------------------------------------------------

--
-- Table structure for table `emotions`
--

CREATE TABLE `emotions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activity_id` bigint(20) UNSIGNED DEFAULT NULL,
  `festival_id` bigint(20) UNSIGNED DEFAULT NULL,
  `place_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emotions`
--

INSERT INTO `emotions` (`id`, `created_at`, `updated_at`, `img`, `activity_id`, `festival_id`, `place_id`) VALUES
(1, '2023-01-18 09:45:00', '2023-01-18 09:45:00', 'emotions/carnival_pic.jpg', NULL, 1, NULL),
(2, '2023-01-18 09:45:00', '2023-01-18 09:45:00', 'emotions/carnival_pic_2.jpg', NULL, 1, NULL),
(3, '2023-01-18 09:49:12', '2023-01-18 09:49:12', 'emotions/durbar_festival_pic.jpg', NULL, 2, NULL),
(4, '2023-01-18 09:49:12', '2023-01-18 09:49:12', 'emotions/erin_snorkling.jpg', 4, NULL, 5),
(5, '2023-01-18 09:52:39', '2023-01-18 09:52:39', 'emotions/gashaka_ballon.png', 1, NULL, 4),
(6, '2023-01-18 09:52:39', '2023-01-18 09:52:39', 'emotions/new_yam_pic.jpg', NULL, 5, NULL),
(7, '2023-01-18 09:57:06', '2023-01-18 09:57:06', 'emotions/okomu_pic.jpg', 3, NULL, 6),
(8, '2023-01-18 09:57:06', '2023-01-18 09:57:06', 'emotions/yankari_hiking.jpg', 2, NULL, 2),
(9, '2023-01-18 10:01:05', '2023-01-18 10:01:05', 'emotions/yankari_pic.jpg', 3, NULL, 2);

-- --------------------------------------------------------

--
-- Table structure for table `festivals`
--

CREATE TABLE `festivals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stars` int(11) NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `people` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `festivals`
--

INSERT INTO `festivals` (`id`, `created_at`, `updated_at`, `name`, `img`, `description`, `stars`, `location`, `people`) VALUES
(1, '2023-01-18 07:57:55', '2023-01-18 07:57:55', 'Calabar Carnival', 'festivals/calabar_carnival.jpg', 'Calabar Carnival, also known as \"Africa\'s Biggest Street Party\" or the \"Pride of Nigeria\", is an annual carnival held in Cross River State, Nigeria. The carnival holds every December.', 4, 'Cross River State', 8),
(2, '2023-01-18 07:57:55', '2023-01-18 07:57:55', 'Durbar Festival', 'festivals/durbar_festival.jpg', 'The Durbar festival is an annual cultural, religious and equestrian festival celebrated in several northern cities of Nigeria including Kano.', 4, 'Kano State', 8),
(3, '2023-01-18 08:09:15', '2023-01-18 08:09:15', 'Eyo Festival', 'festivals/eyo_festival.jpg', 'The Eyo Festival, otherwise known as the Adamu Orisha Play, is a Yoruba festival unique to Lagos, Nigeria. In modern times, it is presented by the people of Lagos as a tourist event and due to its history, is traditionally performed on Lagos Island', 5, 'Lagos State', 8),
(4, '2023-01-18 08:09:15', '2023-01-18 08:09:15', 'Argungu Fishing Festival', 'festivals/fishing_festival.jpg', 'The Argungu Fishing Festival or Argungu Dance Festival is an annual four-day festival in the state of Kebbi, and other northern states like Niger in the north-western part of Northern Nigeria.', 5, 'Kebbi State', 8),
(5, '2023-01-18 08:09:15', '2023-01-18 08:09:15', 'New Yam Festival', 'festivals/new_yam.jpg', 'The New Yam Festival, in the Ogidi community, is an important way of marking the beginning and end of the farming season. It is a celebration of life, accomplishments in the community, culture and well-being.', 5, 'Anambra State', 8);

-- --------------------------------------------------------

--
-- Table structure for table `places`
--

CREATE TABLE `places` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `stars` int(11) NOT NULL,
  `people` int(11) NOT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `places`
--

INSERT INTO `places` (`id`, `name`, `description`, `price`, `stars`, `people`, `img`, `location`, `created_at`, `updated_at`) VALUES
(2, 'Yankari National Park', 'Whether you make the arduous journey east from Abuja and south\r\nfrom Gombe to the Yankari in search of the roaming herds of African \r\nelephants (rumored to be the most numerous on the continent) or to seek out \r\nthe fascinating relics of earlier peoples in the caves, you can rest assured that\r\nthis well-serviced national park won’t disappoint.', 12450.00, 4, 5, 'places/Yankari-National-Park.jpg', 'Bauchi State', '2023-01-18 09:18:06', '2023-01-18 09:18:06'),
(3, 'Kainji Lake National Park', 'One of the natural jewels of north-western Nigeria is actually\r\nnot all that natural at all. Yep, the eponymous Kainji Lake of the Kainji Lake \r\nNational Park is actually a reservoir, created in 1968 and now surrounded by \r\nprotected game reserves.', 23900.00, 5, 7, 'places/Kainji-Lake-National-Park.jpg', 'Kwara State', '2023-01-18 09:18:22', '2023-01-18 09:18:22'),
(4, 'Gashaka Gumti National Park', 'Vast and breathtaking at every turn, the Gashaka Gumti National Park\r\ncovers more than 6,000 square kilometers of land in the extreme south-east of the country.\r\nMade in 1991 after the fusion of two great Nigerian game reserves, \r\nit’s famed for its winding rivers (some of which also occasionally turn into \r\nawesome shows of roaring waterfalls) and riparian habitats, which host rare avian species \r\nlike the red-faced lovebird.', 12900.00, 3, 5, 'places/Gashaka-Gumti-National-Park.jpg', 'Adamawa State', '2023-01-18 09:18:37', '2023-01-18 09:18:37'),
(5, 'Erin Ijesha Falls', 'The tiny town of Erin-Ijesha is really only known for one thing and \r\none thing only: it’s eponymous waterfall that crashes through the southern \r\nNigerian jungles, spans two individual states, and counts as many as seven \r\ntiers in total! The beautiful water feature draws oodles of people to this \r\ntiny speck on the map a little way from the historic city of Ilesa.', 31000.00, 5, 5, 'places/Erin-Ijesha.jpg', 'Osun State', '2023-01-18 09:18:53', '2023-01-18 09:18:53'),
(6, 'Okomu National Park', 'The Okomu National Park, formerly the Okomu Wildlife Sanctuary, is a forest block within the 1,082 km² Okomu Forest Reserve in the Ovia South-West Local Government Area of Edo State in Nigeria. The park is about 60 km north west of Benin City.', 13000.00, 4, 9, 'places/Okomu-National-Park.jpg', 'Edo State', '2023-01-18 09:14:55', '2023-01-18 09:14:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_festival`
--
ALTER TABLE `activity_festival`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activity_place`
--
ALTER TABLE `activity_place`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emotions`
--
ALTER TABLE `emotions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `festivals`
--
ALTER TABLE `festivals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `places`
--
ALTER TABLE `places`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `activity_festival`
--
ALTER TABLE `activity_festival`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `activity_place`
--
ALTER TABLE `activity_place`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `emotions`
--
ALTER TABLE `emotions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `festivals`
--
ALTER TABLE `festivals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `places`
--
ALTER TABLE `places`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
