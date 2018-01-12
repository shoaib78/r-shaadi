-- phpMyAdmin SQL Dump
-- version 4.0.10.18
-- https://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: May 09, 2017 at 05:02 AM
-- Server version: 5.6.33-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shaadivibes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profession` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8mb4_unicode_ci,
  `isAdmin` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_username_unique` (`username`),
  UNIQUE KEY `admin_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `firstname`, `lastname`, `username`, `email`, `password`, `profile_pic`, `profession`, `about_me`, `isAdmin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Alexander', 'Admin', 'admin', 'admin@admin.com', '$2y$10$VMkvK32.AjlXKMwL91nXQumYfxVysqVROYsB15.X9fg3FV7wGLeG2', '1489544056531799.jpg', 'Wedding Arrangement', NULL, '1', 'PapmQ2IHLcQXCyRoE4XAfDHPkFGBWMURf1He99JqVHqMBG0WgECHafz3FVZ5', '2017-03-08 23:39:52', '2017-03-15 09:18:46');

-- --------------------------------------------------------

--
-- Table structure for table `admin_password_resets`
--

CREATE TABLE IF NOT EXISTS `admin_password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE IF NOT EXISTS `bookmarks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bookmark_by` int(10) unsigned NOT NULL,
  `bookmark_for` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookmarks_bookmark_by_foreign` (`bookmark_by`),
  KEY `bookmarks_bookmark_for_foreign` (`bookmark_for`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `bookmark_by`, `bookmark_for`, `created_at`, `updated_at`) VALUES
(4, 6, 5, '2017-04-02 03:16:15', '2017-04-02 03:16:15'),
(13, 6, 14, '2017-04-02 04:16:45', '2017-04-02 04:16:45'),
(14, 6, 9, '2017-04-02 04:16:47', '2017-04-02 04:16:47'),
(15, 6, 4, '2017-04-02 04:16:50', '2017-04-02 04:16:50'),
(16, 6, 2, '2017-04-02 04:16:52', '2017-04-02 04:16:52'),
(18, 1, 3, '2017-04-16 11:16:13', '2017-04-16 11:16:13'),
(21, 1, 14, '2017-04-16 11:16:33', '2017-04-16 11:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `created_at`, `updated_at`) VALUES
(1, 'Wedding Venues', '2017-02-26 16:13:14', '2017-02-26 16:13:14'),
(2, 'Wedding Decorations', '2017-02-26 16:49:55', '2017-02-26 16:49:55'),
(3, 'Wedding Florists', '2017-02-26 16:50:29', '2017-02-26 16:50:29'),
(4, 'Wedding Photographers', '2017-02-26 16:50:42', '2017-02-26 16:50:42'),
(5, 'Wedding Videographers', '2017-02-26 16:50:54', '2017-02-26 16:50:54'),
(6, 'Bridal Hair & Makeup', '2017-02-26 16:51:07', '2017-02-26 16:51:07'),
(7, 'Bridal Wear', '2017-02-26 16:51:21', '2017-02-26 16:51:21'),
(8, 'Wedding DJ', '2017-02-26 16:51:40', '2017-02-26 16:51:40'),
(9, 'Wedding Entertainment', '2017-02-26 16:51:54', '2017-02-26 16:51:54'),
(10, 'Groom Wear', '2017-02-26 16:52:06', '2017-02-26 16:52:06'),
(11, 'Mehndi Artists', '2017-02-26 16:52:18', '2017-02-26 16:52:18'),
(12, 'Wedding Cakes', '2017-02-26 16:52:31', '2017-02-26 16:52:31'),
(13, 'Wedding Cards', '2017-02-26 16:52:42', '2017-02-26 16:52:42'),
(14, 'Wedding Catering', '2017-02-26 16:52:52', '2017-02-26 16:52:52'),
(15, 'Officiant', '2017-03-06 04:57:47', '2017-03-06 04:57:47'),
(16, 'Wedding Planner', '2017-03-06 05:17:58', '2017-03-06 05:17:58'),
(17, 'Transportation', '2017-03-06 06:52:34', '2017-03-06 06:52:34'),
(18, 'Jewelers', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `message` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `reason`, `message`, `created_at`, `updated_at`) VALUES
(1, 'John Doe', 'dbassi@mailinator.com', '-1', 'Hello can you blah balshasjhdkljklqwjrklfjnosafgh', '2017-04-02 03:29:06', '2017-04-02 03:29:06'),
(2, 'Hi', 'raeknor@mailinator.com', '-1', 'asdasdas', '2017-04-24 07:52:24', '2017-04-24 07:52:24'),
(3, 'John Smith', 'raeknor@mailinator.com', '-1', 'asdasdasdasd', '2017-04-24 07:56:56', '2017-04-24 07:56:56'),
(4, 'Test', 'shoebuddin@mailinator.com', '-1', 'Test', '2017-04-26 21:10:15', '2017-04-26 21:10:15'),
(5, 'Test', 'shoebuddin@mailinator.com', '-1', 'Test', '2017-04-26 21:13:59', '2017-04-26 21:13:59'),
(6, 'Ray Singh', 'raeknor@mailinator.com', 'Community', 'sdjfasdjklfasdklfjasdklj', '2017-04-30 09:50:11', '2017-04-30 09:50:11'),
(7, 'Ray Singh', 'raeknor@mailinator.com', 'Planning Tools', 'sdasdasdasdsad', '2017-05-05 13:46:27', '2017-05-05 13:46:27');

-- --------------------------------------------------------

--
-- Table structure for table `featured_vendors`
--

CREATE TABLE IF NOT EXISTS `featured_vendors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `featured_image` varchar(100) DEFAULT NULL,
  `vendor_profile_link` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `featured_vendors`
--

INSERT INTO `featured_vendors` (`id`, `company_name`, `category`, `featured_image`, `vendor_profile_link`, `created_at`, `updated_at`) VALUES
(1, 'Company 1', 'Wedding  2123', '1490265653742704.jpg', 'http://shaadivibes.com/vendor/profile/2', '2017-03-22 19:42:34', '2017-05-09 12:17:11'),
(2, 'XYZ', 'Wedding Venue', '1490265679275440.jpg', 'http://shaadivibes.ca/vendor/profile/2', '2017-03-22 20:09:32', '2017-03-29 12:27:08'),
(3, 'XYZ', 'Wedding Venue', '1490265751902057.jpg', 'http://shaadivibes.ca/vendor/profile/2', '2017-03-22 20:10:33', '2017-03-29 12:27:17'),
(4, 'XYZ', 'Wedding Venue', '1490265773504703.jpg', 'http://shaadivibes.ca/vendor/profile/2', '2017-03-22 20:10:48', '2017-03-29 12:27:29'),
(5, 'XYZ', 'Wedding Venue', '1490265791199891.jpg', 'http://shaadivibes.ca/vendor/profile/2', '2017-03-22 20:11:20', '2017-03-29 12:27:37'),
(6, 'XYZ', 'Wedding Venue', '1490265808729931.jpg', 'http://shaadivibes.ca/vendor/profile/2', '2017-03-22 20:11:39', '2017-03-29 12:27:45');

-- --------------------------------------------------------

--
-- Table structure for table `gallary`
--

CREATE TABLE IF NOT EXISTS `gallary` (
  `gallary_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `gallary_img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`gallary_id`),
  KEY `gallary_user_id_foreign` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=106 ;

--
-- Dumping data for table `gallary`
--

INSERT INTO `gallary` (`gallary_id`, `user_id`, `gallary_img`, `path`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '1489198712268188.png', 'http://www.shaadivibes.ca/public/uploads/gallary/1489198712268188.png', 0, '2017-03-11 10:18:32', '2017-03-11 10:18:32'),
(2, 2, '1489198712187713.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1489198712187713.jpg', 0, '2017-03-11 10:18:32', '2017-03-11 10:18:32'),
(3, 2, '1489198712796783.png', 'http://www.shaadivibes.ca/public/uploads/gallary/1489198712796783.png', 0, '2017-03-11 10:18:32', '2017-03-11 10:18:32'),
(4, 2, '1489198712103149.png', 'http://www.shaadivibes.ca/public/uploads/gallary/1489198712103149.png', 0, '2017-03-11 10:18:32', '2017-03-11 10:18:32'),
(8, 2, '1489839266334589.png', 'http://www.shaadivibes.ca/public/uploads/gallary/1489839266334589.png', 0, '2017-03-18 19:14:26', '2017-03-18 19:14:26'),
(9, 2, '1489839266946794.png', 'http://www.shaadivibes.ca/public/uploads/gallary/1489839266946794.png', 0, '2017-03-18 19:14:30', '2017-03-18 19:14:30'),
(10, 2, '1489839270960577.png', 'http://www.shaadivibes.ca/public/uploads/gallary/1489839270960577.png', 0, '2017-03-18 19:14:30', '2017-03-18 19:14:30'),
(11, 3, '1490241842183385.jpg', 'http://shaadivibes.ca/public/uploads/gallary/1490241842183385.jpg', 0, '2017-03-23 11:04:02', '2017-03-23 11:04:02'),
(12, 3, '1490241845855255.jpg', 'http://shaadivibes.ca/public/uploads/gallary/1490241845855255.jpg', 0, '2017-03-23 11:04:05', '2017-03-23 11:04:05'),
(13, 3, '1490241849415419.jpg', 'http://shaadivibes.ca/public/uploads/gallary/1490241849415419.jpg', 0, '2017-03-23 11:04:09', '2017-03-23 11:04:09'),
(14, 3, '1490241850230903.jpg', 'http://shaadivibes.ca/public/uploads/gallary/1490241850230903.jpg', 0, '2017-03-23 11:04:10', '2017-03-23 11:04:10'),
(15, 3, '1490241850255742.jpg', 'http://shaadivibes.ca/public/uploads/gallary/1490241850255742.jpg', 0, '2017-03-23 11:04:10', '2017-03-23 11:04:10'),
(16, 3, '1490241851864306.jpg', 'http://shaadivibes.ca/public/uploads/gallary/1490241851864306.jpg', 0, '2017-03-23 11:04:11', '2017-03-23 11:04:11'),
(17, 3, '1490241854138656.Jpeg', 'http://shaadivibes.ca/public/uploads/gallary/1490241854138656.Jpeg', 0, '2017-03-23 11:04:14', '2017-03-23 11:04:14'),
(18, 3, '1490241854736217.jpg', 'http://shaadivibes.ca/public/uploads/gallary/1490241854736217.jpg', 0, '2017-03-23 11:04:14', '2017-03-23 11:04:14'),
(19, 7, '1490471362633755.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490471362633755.jpg', 0, '2017-03-26 02:49:22', '2017-03-26 02:49:22'),
(20, 7, '1490471363316180.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490471363316180.jpg', 0, '2017-03-26 02:49:23', '2017-03-26 02:49:23'),
(21, 7, '149047136540696.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/149047136540696.jpg', 0, '2017-03-26 02:49:25', '2017-03-26 02:49:25'),
(22, 7, '1490471366260660.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490471366260660.jpg', 0, '2017-03-26 02:49:26', '2017-03-26 02:49:26'),
(23, 7, '1490471366428538.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490471366428538.jpg', 0, '2017-03-26 02:49:26', '2017-03-26 02:49:26'),
(24, 7, '1490471366802560.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490471366802560.jpg', 0, '2017-03-26 02:49:26', '2017-03-26 02:49:26'),
(25, 7, '1490471367259766.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490471367259766.jpg', 0, '2017-03-26 02:49:27', '2017-03-26 02:49:27'),
(26, 7, '1490471368298027.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490471368298027.jpg', 0, '2017-03-26 02:49:28', '2017-03-26 02:49:28'),
(27, 7, '149047136932922.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/149047136932922.jpg', 0, '2017-03-26 02:49:29', '2017-03-26 02:49:29'),
(28, 7, '1490471369369641.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490471369369641.jpg', 0, '2017-03-26 02:49:29', '2017-03-26 02:49:29'),
(29, 8, '1490480448456406.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490480448456406.jpg', 0, '2017-03-26 05:20:48', '2017-03-26 05:20:48'),
(30, 8, '1490480448982577.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490480448982577.jpg', 0, '2017-03-26 05:20:48', '2017-03-26 05:20:48'),
(31, 8, '1490480449863200.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490480449863200.jpg', 0, '2017-03-26 05:20:49', '2017-03-26 05:20:49'),
(32, 8, '1490480449682359.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490480449682359.jpg', 0, '2017-03-26 05:20:49', '2017-03-26 05:20:49'),
(33, 8, '1490480452387211.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490480452387211.jpg', 0, '2017-03-26 05:20:52', '2017-03-26 05:20:52'),
(34, 8, '1490480452279376.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490480452279376.jpg', 0, '2017-03-26 05:20:53', '2017-03-26 05:20:53'),
(35, 8, '1490480453568678.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490480453568678.jpg', 0, '2017-03-26 05:20:53', '2017-03-26 05:20:53'),
(36, 8, '1490480453222977.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490480453222977.jpg', 0, '2017-03-26 05:20:53', '2017-03-26 05:20:53'),
(37, 8, '1490480454342291.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490480454342291.jpg', 0, '2017-03-26 05:20:54', '2017-03-26 05:20:54'),
(38, 8, '1490480454756975.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490480454756975.jpg', 0, '2017-03-26 05:20:54', '2017-03-26 05:20:54'),
(39, 9, '1490490943728837.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490490943728837.jpg', 0, '2017-03-26 08:15:43', '2017-03-26 08:15:43'),
(40, 9, '1490490944267362.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490490944267362.jpg', 0, '2017-03-26 08:15:44', '2017-03-26 08:15:44'),
(41, 9, '1490490944244370.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490490944244370.jpg', 0, '2017-03-26 08:15:44', '2017-03-26 08:15:44'),
(42, 9, '1490490945103403.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490490945103403.jpg', 0, '2017-03-26 08:15:45', '2017-03-26 08:15:45'),
(43, 9, '1490490947683982.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490490947683982.jpg', 0, '2017-03-26 08:15:47', '2017-03-26 08:15:47'),
(44, 9, '1490490947659369.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490490947659369.jpg', 0, '2017-03-26 08:15:48', '2017-03-26 08:15:48'),
(45, 9, '1490490948799957.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490490948799957.jpg', 0, '2017-03-26 08:15:48', '2017-03-26 08:15:48'),
(46, 9, '149049094838684.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/149049094838684.jpg', 0, '2017-03-26 08:15:48', '2017-03-26 08:15:48'),
(47, 9, '1490490948481668.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490490948481668.jpg', 0, '2017-03-26 08:15:48', '2017-03-26 08:15:48'),
(48, 9, '1490490949896651.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490490949896651.jpg', 0, '2017-03-26 08:15:49', '2017-03-26 08:15:49'),
(49, 10, '1490498164621511.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498164621511.jpg', 0, '2017-03-26 10:16:04', '2017-03-26 10:16:04'),
(50, 10, '1490498167979427.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498167979427.jpg', 0, '2017-03-26 10:16:07', '2017-03-26 10:16:07'),
(51, 10, '149049816727663.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/149049816727663.jpg', 0, '2017-03-26 10:16:07', '2017-03-26 10:16:07'),
(52, 10, '1490498167618969.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498167618969.jpg', 0, '2017-03-26 10:16:07', '2017-03-26 10:16:07'),
(53, 10, '1490498167961682.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498167961682.jpg', 0, '2017-03-26 10:16:07', '2017-03-26 10:16:07'),
(54, 10, '1490498168540811.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498168540811.jpg', 0, '2017-03-26 10:16:08', '2017-03-26 10:16:08'),
(55, 10, '1490498169709643.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498169709643.jpg', 0, '2017-03-26 10:16:09', '2017-03-26 10:16:09'),
(56, 10, '1490498169967883.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498169967883.jpg', 0, '2017-03-26 10:16:09', '2017-03-26 10:16:09'),
(57, 10, '1490498170605496.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498170605496.jpg', 0, '2017-03-26 10:16:10', '2017-03-26 10:16:10'),
(58, 10, '149049817120312.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/149049817120312.jpg', 0, '2017-03-26 10:16:11', '2017-03-26 10:16:11'),
(59, 10, '1490498193294567.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498193294567.jpg', 0, '2017-03-26 10:16:33', '2017-03-26 10:16:33'),
(60, 10, '1490498195480983.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498195480983.jpg', 0, '2017-03-26 10:16:35', '2017-03-26 10:16:35'),
(61, 10, '1490498196329952.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498196329952.jpg', 0, '2017-03-26 10:16:36', '2017-03-26 10:16:36'),
(62, 10, '1490498197125506.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498197125506.jpg', 0, '2017-03-26 10:16:37', '2017-03-26 10:16:37'),
(63, 10, '14904981977924.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/14904981977924.jpg', 0, '2017-03-26 10:16:41', '2017-03-26 10:16:41'),
(64, 10, '1490498201612295.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498201612295.jpg', 0, '2017-03-26 10:16:41', '2017-03-26 10:16:41'),
(65, 10, '1490498202960811.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498202960811.jpg', 0, '2017-03-26 10:16:42', '2017-03-26 10:16:42'),
(66, 10, '1490498202346958.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498202346958.jpg', 0, '2017-03-26 10:16:42', '2017-03-26 10:16:42'),
(67, 10, '1490498203888120.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498203888120.jpg', 0, '2017-03-26 10:16:43', '2017-03-26 10:16:43'),
(68, 10, '1490498203145537.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498203145537.jpg', 0, '2017-03-26 10:16:43', '2017-03-26 10:16:43'),
(69, 11, '1490498601896323.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498601896323.jpg', 0, '2017-03-26 10:23:21', '2017-03-26 10:23:21'),
(70, 11, '1490498604557740.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490498604557740.jpg', 0, '2017-03-26 10:23:24', '2017-03-26 10:23:24'),
(71, 12, '1490499184122692.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1490499184122692.jpg', 0, '2017-03-26 10:33:04', '2017-03-26 10:33:04'),
(72, 14, '1490642180183165.jpg', 'http://shaadivibes.ca/public/uploads/gallary/1490642180183165.jpg', 0, '2017-03-28 02:16:20', '2017-03-28 02:16:20'),
(73, 14, '1490642180641524.jpg', 'http://shaadivibes.ca/public/uploads/gallary/1490642180641524.jpg', 0, '2017-03-28 02:16:21', '2017-03-28 02:16:21'),
(74, 14, '1490642181419073.jpg', 'http://shaadivibes.ca/public/uploads/gallary/1490642181419073.jpg', 0, '2017-03-28 02:16:21', '2017-03-28 02:16:21'),
(75, 15, '1490642520834527.jpg', 'http://shaadivibes.ca/public/uploads/gallary/1490642520834527.jpg', 0, '2017-03-28 02:22:00', '2017-03-28 02:22:00'),
(78, 5, '1491081536140605.jpg', 'http://shaadivibes.ca/public/uploads/gallary/1491081536140605.jpg', 0, '2017-04-02 04:18:56', '2017-04-02 04:18:56'),
(79, 5, '1491081537734822.jpg', 'http://shaadivibes.ca/public/uploads/gallary/1491081537734822.jpg', 0, '2017-04-02 04:18:57', '2017-04-02 04:18:57'),
(80, 5, '1491081541713681.jpg', 'http://shaadivibes.ca/public/uploads/gallary/1491081541713681.jpg', 0, '2017-04-02 04:19:01', '2017-04-02 04:19:01'),
(81, 5, '149108162015998.jpg', 'http://shaadivibes.ca/public/uploads/gallary/149108162015998.jpg', 0, '2017-04-02 04:20:20', '2017-04-02 04:20:20'),
(82, 2, '1491488691988599.jpg', 'http://www.shaadivibes.ca/public/uploads/gallary/1491488691988599.jpg', 0, '2017-04-06 21:24:52', '2017-04-06 21:24:52'),
(85, 2, '1491541865655106.jpg', 'http://shaadivibes.ca/public/uploads/gallary/1491541865655106.jpg', 0, '2017-04-07 12:11:05', '2017-04-07 12:11:05'),
(87, 4, '1492496254180893.jpg', 'http://shaadivibes.com/public/uploads/gallary/1492496254180893.jpg', 0, '2017-04-18 13:17:34', '2017-04-18 13:17:34'),
(88, 4, '1492496255658358.jpg', 'http://shaadivibes.com/public/uploads/gallary/1492496255658358.jpg', 0, '2017-04-18 13:17:35', '2017-04-18 13:17:35'),
(89, 4, '1492496255224623.jpg', 'http://shaadivibes.com/public/uploads/gallary/1492496255224623.jpg', 0, '2017-04-18 13:17:35', '2017-04-18 13:17:35'),
(90, 4, '1492496256479311.jpg', 'http://shaadivibes.com/public/uploads/gallary/1492496256479311.jpg', 0, '2017-04-18 13:17:36', '2017-04-18 13:17:36'),
(91, 4, '1492496256851680.jpg', 'http://shaadivibes.com/public/uploads/gallary/1492496256851680.jpg', 0, '2017-04-18 13:17:37', '2017-04-18 13:17:37'),
(92, 23, '1492497174191727.jpg', 'http://shaadivibes.com/public/uploads/gallary/1492497174191727.jpg', 0, '2017-04-18 13:32:54', '2017-04-18 13:32:54'),
(93, 23, '1492497174871853.jpg', 'http://shaadivibes.com/public/uploads/gallary/1492497174871853.jpg', 0, '2017-04-18 13:32:54', '2017-04-18 13:32:54'),
(94, 23, '1492497176417870.jpg', 'http://shaadivibes.com/public/uploads/gallary/1492497176417870.jpg', 0, '2017-04-18 13:32:56', '2017-04-18 13:32:56'),
(95, 23, '1492497176955973.jpg', 'http://shaadivibes.com/public/uploads/gallary/1492497176955973.jpg', 0, '2017-04-18 13:32:56', '2017-04-18 13:32:56'),
(96, 23, '1492497177255910.jpg', 'http://shaadivibes.com/public/uploads/gallary/1492497177255910.jpg', 0, '2017-04-18 13:32:57', '2017-04-18 13:32:57'),
(97, 23, '1492497177672369.jpg', 'http://shaadivibes.com/public/uploads/gallary/1492497177672369.jpg', 0, '2017-04-18 13:32:57', '2017-04-18 13:32:57'),
(98, 23, '1492497178270778.jpg', 'http://shaadivibes.com/public/uploads/gallary/1492497178270778.jpg', 0, '2017-04-18 13:32:58', '2017-04-18 13:32:58'),
(99, 23, '1492497178188527.jpg', 'http://shaadivibes.com/public/uploads/gallary/1492497178188527.jpg', 0, '2017-04-18 13:32:59', '2017-04-18 13:32:59'),
(100, 74, '1492909291972496.jpg', 'http://www.shaadivibes.com/public/uploads/gallary/1492909291972496.jpg', 0, '2017-04-23 08:01:31', '2017-04-23 08:01:31'),
(101, 74, '1492909298430496.jpg', 'http://www.shaadivibes.com/public/uploads/gallary/1492909298430496.jpg', 0, '2017-04-23 08:01:38', '2017-04-23 08:01:38'),
(102, 84, '1492918917624633.jpg', 'http://shaadivibes.com/public/uploads/gallary/1492918917624633.jpg', 0, '2017-04-23 10:41:57', '2017-04-23 10:41:57'),
(103, 84, '1492918919801396.jpg', 'http://shaadivibes.com/public/uploads/gallary/1492918919801396.jpg', 0, '2017-04-23 10:41:59', '2017-04-23 10:41:59'),
(104, 84, '1492918922862849.jpg', 'http://shaadivibes.com/public/uploads/gallary/1492918922862849.jpg', 0, '2017-04-23 10:42:02', '2017-04-23 10:42:02'),
(105, 2, '1493731088622806.png', 'http://www.shaadivibes.com/public/uploads/gallary/1493731088622806.png', 0, '2017-05-02 20:18:08', '2017-05-02 20:18:08');

-- --------------------------------------------------------

--
-- Table structure for table `local_vendor_contents`
--

CREATE TABLE IF NOT EXISTS `local_vendor_contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `description` text,
  `image` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `local_vendor_contents`
--

INSERT INTO `local_vendor_contents` (`id`, `title`, `description`, `image`, `link`, `created_at`, `updated_at`) VALUES
(1, 'Wedding <br/> Venue', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '1490334610683486.jpg', 'http://www.shaadivibes.ca/listings/1', '2017-03-22 20:48:29', '2017-03-24 12:50:10'),
(2, 'Wedding<br/> Decoration', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '1490264029344446.jpg', 'http://www.shaadivibes.ca/listings/2', '2017-03-23 17:13:49', '2017-03-24 12:22:46'),
(3, 'Wedding<br/> Photographers', 'Capture your wedding', '1490594391227336.jpg', 'http://www.shaadivibes.ca/listings/4', '2017-03-23 17:14:25', '2017-05-05 13:42:31'),
(4, 'Bridal<br/> Makeup', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '149026410424788.jpg', 'http://www.shaadivibes.ca/listings/6', '2017-03-23 17:15:04', '2017-03-24 12:23:54'),
(5, 'Bridal<br/> Wear', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '1490264146924583.jpg', 'http://www.shaadivibes.ca/listings/7', '2017-03-23 17:15:46', '2017-03-24 12:24:17'),
(6, 'Wedding<br/> DJ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', '1490264181709910.jpg', 'http://www.shaadivibes.ca/listings/8', '2017-03-23 17:16:21', '2017-03-24 12:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_admin_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_admin_password_resets_table', 1),
(4, '2014_10_12_100000_create_password_resets_table', 1),
(5, '2017_02_24_000000_create_category_table', 1),
(6, '2017_02_28_031636_create_slider_table', 1),
(7, '2017_02_28_203609_create_photo_table', 1),
(8, '2017_03_01_213344_create_vendor_inforamations_table', 1),
(9, '2017_03_03_195141_create_gallaries_table', 1),
(10, '2017_03_04_002321_create_services_detail_infos_table', 1),
(11, '2017_03_07_233112_create_reviews_table', 1),
(12, '2017_03_08_211830_create_bookmarks_table', 1),
(13, '2017_03_09_203805_create_subscribers_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `slug` varchar(100) DEFAULT NULL,
  `content` text,
  `publish` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `slug`, `content`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'About Us', 'about_us', '<h2>Privacy Policy</h2>\r\n\r\n<p>New Policyipsum dolor sit amet, consectetur adipiscing elit. Mauris molestie lorem metus. Donec quis tempus sapien. In in malesuada urna. Sed nec augue cursus libero posuere vulputate in at lectus. Vestibulum posuere at elit in feugiat. Nulla sit amet tincidunt augue. Donec molestie fringilla hendrerit. Donec ac mattis lacus. Quisque mauris nibh, posuere vel blandit sit amet, tempor ac magna. Morbi pharetra sapien nec diam rutrum, quis cursus mauris varius. Sed finibus et metus quis tristique. Etiam vehicula fringilla dui, a consectetur quam porta eget. Nulla ac porta dolor. Nullam accumsan, nunc vel bibendum rutrum, quam tellus blandit urna, eget volutpat lectus metus a odio. Pellentesque vel iaculis dui, vitae faucibus nisl.</p>\r\n\r\n<p>Nulla facilisi. Integer at est mattis, posuere dolor et, finibus nisi. Duis et neque et dui vehicula interdum sed eget mauris. Integer sed augue in eros tempor feugiat. Ut urna nisl, luctus scelerisque lacus et, ultricies auctor elit. Sed nunc enim, laoreet eget viverra id, bibendum ac mauris. Aenean nec est vel odio tempus laoreet. Integer tincidunt augue vitae nulla rutrum placerat. Suspendisse mollis blandit dolor et aliquet. Pellentesque turpis tortor, commodo ut elit eget, facilisis iaculis arcu. Nulla fringilla ipsum euismod arcu tincidunt tristique at vitae sem. Maecenas eget dui non nibh viverra imperdiet sit amet at tellus. Nunc quis consequat justo, eget eleifend sem. Phasellus nulla augue, fermentum id posuere at, rutrum interdum lorem. Donec ullamcorper suscipit dui, nec lobortis turpis porttitor nec. Ut ac commodo nunc.</p>\r\n\r\n<h2>Lorem ipsum dolor sit amet</h2>\r\n\r\n<p>Pellentesque eu tincidunt dolor. Cras eu tincidunt est. Nam sed vehicula justo, sit amet sollicitudin nisl. Suspendisse potenti. Aliquam nec euismod nisl. Maecenas non laoreet diam, sed congue tellus. In tempor vitae risus vitae tincidunt. Morbi finibus ex gravida neque volutpat, ac porta dui efficitur.</p>\r\n\r\n<p>Praesent ullamcorper nisl odio, quis laoreet justo ultricies a. Aliquam blandit consequat sem eget dictum. Etiam accumsan erat id turpis molestie, vel auctor quam tincidunt. Nunc vel est viverra, ultricies nulla vitae,.</p>\r\n\r\n<p>Duis et neque et dui vehicula interdum sed eget mauris. Integer sed augue in eros tempor feugiat. Ut urna nisl, luctus scelerisque lacus et, ultricies auctor elit.</p>\r\n\r\n<h2>Mauris molestie lorem metus</h2>\r\n\r\n<p>Pellentesque eu tincidunt dolor. Cras eu tincidunt est. Nam sed vehicula justo, sit amet sollicitudin nisl. Suspendisse potenti. Aliquam nec euismod nisl. Maecenas non laoreet diam, sed congue tellus. In tempor vitae risus vitae tincidunt. Morbi finibus ex gravida neque volutpat, ac porta dui efficitur.</p>\r\n\r\n<p>Integer tincidunt augue vitae nulla rutrum placerat. Suspendisse mollis blandit dolor et aliquet. Pellentesque turpis tortor, commodo ut elit eget, facilisis iaculis arcu. Nulla fringilla ipsum euismod arcu tincidunt tristique at vitae sem. Maecenas eget dui non nibh viverra imperdiet sit amet at tellus. Nunc quis consequat justo, eget eleifend sem. Phasellus nulla augue, fermentum id posuere at, rutrum interdum lorem. Donec ullamcorper suscipit dui, nec lobortis turpis porttitor nec. Ut ac commodo</p>\r\n\r\n<p>Integer tincidunt augue vitae nulla rutrum placerat. Suspendisse mollis blandit dolor et aliquet. Pellentesque turpis tortor, commodo ut elit eget, facilisis iaculis arcu. Nulla fringilla ipsum euismod arcu tincidunt tristique at vitae sem. Maecenas eget dui non nibh viverra imperdiet sit amet at tellus. Nunc quis consequat justo, eget eleifend sem. Phasellus nulla augue, fermentum id posuere at, rutrum interdum lorem. Donec ullamcorper suscipit dui, nec lobortis turpis porttitor nec. Ut ac commodoInteger tincidunt augue vitae nulla rutrum placerat. Suspendisse mollis blandit dolor et aliquet. Pellentesque turpis tortor, commodo ut elit eget, facilisis iaculis arcu. Nulla fringilla ipsum euismod arcu tincidunt tristique at vitae sem. Maecenas eget dui non nibh viverra imperdiet sit amet at tellus. Nunc quis consequat justo, eget eleifend sem. Phasellus nulla augue, fermentum id posuere at, rutrum interdum lorem.<br />\r\nDonec ullamcorper suscipit dui, nec lobortis turpis porttitor nec. Ut ac commodoInteger tincidunt augue vitae nulla rutrum placerat. Suspendisse mollis blandit dolor et aliquet. Pellentesque turpis tortor, commodo ut elit eget, facilisis iaculis arcu. Nulla fringilla ipsum euismod arcu tincidunt tristique at vitae sem. Maecenas eget dui non nibh viverra imperdiet sit amet at tellus. Nunc quis consequat justo, eget eleifend sem. Phasellus nulla augue, fermentum id posuere at, rutrum interdum lorem. Donec ullamcorper suscipit dui, nec lobortis turpis porttitor nec. Ut ac commodo</p>', 1, '2017-03-21 19:30:23', '2017-05-05 13:25:20'),
(2, 'Terms & Conditions', 'terms_conditions', '<h2>Terms &amp; Conditions</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris molestie lorem metus. Donec quis tempus sapien. In in malesuada urna. Sed nec augue cursus libero posuere vulputate in at lectus. Vestibulum posuere at elit in feugiat. Nulla sit amet tincidunt augue. Donec molestie fringilla hendrerit. Donec ac mattis lacus. Quisque mauris nibh, posuere vel blandit sit amet, tempor ac magna. Morbi pharetra sapien nec diam rutrum, quis cursus mauris varius. Rahda like to party on the dance floor. Etiam vehicula fringilla dui, a consectetur quam porta eget. Nulla ac porta dolor. Nullam accumsan, nunc vel bibendum rutrum, quam tellus blandit urna, eget volutpat lectus metus a odio. Pellentesque vel iaculis dui, vitae faucibus nisl.</p>\r\n\r\n<p>Nulla facilisi. Integer at est mattis, posuere dolor et, finibus nisi. Duis et neque et dui vehicula interdum sed eget mauris. Integer sed augue in eros tempor feugiat. Ut urna nisl, luctus scelerisque lacus et, ultricies auctor elit. Sed nunc enim, laoreet eget viverra id, bibendum ac mauris. Aenean nec est vel odio tempus laoreet. Integer tincidunt augue vitae nulla rutrum placerat. Suspendisse mollis blandit dolor et aliquet. Pellentesque turpis tortor, commodo ut elit eget, facilisis iaculis arcu. Nulla fringilla ipsum euismod arcu tincidunt tristique at vitae sem. Maecenas eget dui non nibh viverra imperdiet sit amet at tellus. Nunc quis consequat justo, eget eleifend sem. Phasellus nulla augue, fermentum id posuere at, rutrum interdum lorem. Donec ullamcorper suscipit dui, nec lobortis turpis porttitor nec. Ut ac commodo nunc.</p>\r\n\r\n<h2>Lorem ipsum dolor sit amet</h2>\r\n\r\n<p>Pellentesque eu tincidunt dolor. Cras eu tincidunt est. Nam sed vehicula justo, sit amet sollicitudin nisl. Suspendisse potenti. Aliquam nec euismod nisl. Maecenas non laoreet diam, sed congue tellus. In tempor vitae risus vitae tincidunt. Morbi finibus ex gravida neque volutpat, ac porta dui efficitur.</p>\r\n\r\n<p>Praesent ullamcorper nisl odio, quis laoreet justo ultricies a. Aliquam blandit consequat sem eget dictum. Etiam accumsan erat id turpis molestie, vel auctor quam tincidunt. Nunc vel est viverra, ultricies nulla vitae,.</p>\r\n\r\n<p>Duis et neque et dui vehicula interdum sed eget mauris. Integer sed augue in eros tempor feugiat. Ut urna nisl, luctus scelerisque lacus et, ultricies auctor elit.</p>\r\n\r\n<h2>Mauris molestie lorem metus</h2>\r\n\r\n<p>Pellentesque eu tincidunt dolor. Cras eu tincidunt est. Nam sed vehicula justo, sit amet sollicitudin nisl. Suspendisse potenti. Aliquam nec euismod nisl. Maecenas non laoreet diam, sed congue tellus. In tempor vitae risus vitae tincidunt. Morbi finibus ex gravida neque volutpat, ac porta dui efficitur.</p>\r\n\r\n<p>Integer tincidunt augue vitae nulla rutrum placerat. Suspendisse mollis blandit dolor et aliquet. Pellentesque turpis tortor, commodo ut elit eget, facilisis iaculis arcu. Nulla fringilla ipsum euismod arcu tincidunt tristique at vitae sem. Maecenas eget dui non nibh viverra imperdiet sit amet at tellus. Nunc quis consequat justo, eget eleifend sem. Phasellus nulla augue, fermentum id posuere at, rutrum interdum lorem. Donec ullamcorper suscipit dui, nec lobortis turpis porttitor nec. Ut ac commodo</p>\r\n\r\n<p>Integer tincidunt augue vitae nulla rutrum placerat. Suspendisse mollis blandit dolor et aliquet. Pellentesque turpis tortor, commodo ut elit eget, facilisis iaculis arcu. Nulla fringilla ipsum euismod arcu tincidunt tristique at vitae sem. Maecenas eget dui non nibh viverra imperdiet sit amet at tellus. Nunc quis consequat justo, eget eleifend sem. Phasellus nulla augue, fermentum id posuere at, rutrum interdum lorem. Donec ullamcorper suscipit dui, nec lobortis turpis porttitor nec. Ut ac commodoInteger tincidunt augue vitae nulla rutrum placerat. Suspendisse mollis blandit dolor et aliquet. Pellentesque turpis tortor, commodo ut elit eget, facilisis iaculis arcu. Nulla fringilla ipsum euismod arcu tincidunt tristique at vitae sem. Maecenas eget dui non nibh viverra imperdiet sit amet at tellus. Nunc quis consequat justo, eget eleifend sem. Phasellus nulla augue, fermentum id posuere at, rutrum interdum lorem.<br />\r\nDonec ullamcorper suscipit dui, nec lobortis turpis porttitor nec. Ut ac commodoInteger tincidunt augue vitae nulla rutrum placerat. Suspendisse mollis blandit dolor et aliquet. Pellentesque turpis tortor, commodo ut elit eget, facilisis iaculis arcu. Nulla fringilla ipsum euismod arcu tincidunt tristique at vitae sem. Maecenas eget dui non nibh viverra imperdiet sit amet at tellus. Nunc quis consequat justo, eget eleifend sem. Phasellus nulla augue, fermentum id posuere at, rutrum interdum lorem. Donec ullamcorper suscipit dui, nec lobortis turpis porttitor nec. Ut ac commodo</p>', 1, '2017-03-21 19:40:43', '2017-05-05 13:26:05'),
(3, 'Privacy Policy', 'privacy_policy', '<h2>Privacy Policy</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris molestie lorem metus. Donec quis tempus sapien. In in malesuada urna. Sed nec augue cursus libero posuere vulputate in at lectus. Vestibulum posuere at elit in feugiat. Nulla sit amet tincidunt augue. Donec molestie fringilla hendrerit. Donec ac mattis lacus. Quisque mauris nibh, posuere vel blandit sit amet, tempor ac magna. Morbi pharetra sapien nec diam rutrum, amiwami pudding and pie. Sed finibus et metus quis tristique. Etiam vehicula fringilla dui, a consectetur quam porta eget. Nulla ac porta dolor. Nullam accumsan, nunc vel bibendum rutrum, quam tellus blandit urna, eget volutpat lectus metus a odio. Pellentesque vel iaculis dui, vitae faucibus nisl.</p>\r\n\r\n<p>Nulla facilisi. Integer at est mattis, posuere dolor et, finibus nisi. Duis et neque et dui vehicula interdum sed eget mauris. Integer sed augue in eros tempor feugiat. Ut urna nisl, luctus scelerisque lacus et, ultricies auctor elit. Sed nunc enim, laoreet eget viverra id, bibendum ac mauris. Aenean nec est vel odio tempus laoreet. Integer tincidunt augue vitae nulla rutrum placerat. Suspendisse mollis blandit dolor et aliquet. Pellentesque turpis tortor, commodo ut elit eget, facilisis iaculis arcu. Nulla fringilla ipsum euismod arcu tincidunt tristique at vitae sem. Maecenas eget dui non nibh viverra imperdiet sit amet at tellus. Nunc quis consequat justo, eget eleifend sem. Phasellus nulla augue, fermentum id posuere at, rutrum interdum lorem. Donec ullamcorper suscipit dui, nec lobortis turpis porttitor nec. Ut ac commodo nunc.</p>\r\n\r\n<h2>Lorem ipsum dolor sit amet</h2>\r\n\r\n<p>Pellentesque eu tincidunt dolor. Cras eu tincidunt est. Nam sed vehicula justo, sit amet sollicitudin nisl. Suspendisse potenti. Aliquam nec euismod nisl. Maecenas non laoreet diam, sed congue tellus. In tempor vitae risus vitae tincidunt. Morbi finibus ex gravida neque volutpat, ac porta dui efficitur.</p>\r\n\r\n<p>Praesent ullamcorper nisl odio, quis laoreet justo ultricies a. Aliquam blandit consequat sem eget dictum. Etiam accumsan erat id turpis molestie, vel auctor quam tincidunt. Nunc vel est viverra, ultricies nulla vitae,.</p>\r\n\r\n<p>Duis et neque et dui vehicula interdum sed eget mauris. Integer sed augue in eros tempor feugiat. Ut urna nisl, luctus scelerisque lacus et, ultricies auctor elit.</p>\r\n\r\n<h2>Mauris molestie lorem metus</h2>\r\n\r\n<p>Pellentesque eu tincidunt dolor. Cras eu tincidunt est. Nam sed vehicula justo, sit amet sollicitudin nisl. Suspendisse potenti. Aliquam nec euismod nisl. Maecenas non laoreet diam, sed congue tellus. In tempor vitae risus vitae tincidunt. Morbi finibus ex gravida neque volutpat, ac porta dui efficitur.</p>\r\n\r\n<p>Integer tincidunt augue vitae nulla rutrum placerat. Suspendisse mollis blandit dolor et aliquet. Pellentesque turpis tortor, commodo ut elit eget, facilisis iaculis arcu. Nulla fringilla ipsum euismod arcu tincidunt tristique at vitae sem. Maecenas eget dui non nibh viverra imperdiet sit amet at tellus. Nunc quis consequat justo, eget eleifend sem. Phasellus nulla augue, fermentum id posuere at, rutrum interdum lorem. Donec ullamcorper suscipit dui, nec lobortis turpis porttitor nec. Ut ac commodo</p>\r\n\r\n<p>Integer tincidunt augue vitae nulla rutrum placerat. Suspendisse mollis blandit dolor et aliquet. Pellentesque turpis tortor, commodo ut elit eget, facilisis iaculis arcu. Nulla fringilla ipsum euismod arcu tincidunt tristique at vitae sem. Maecenas eget dui non nibh viverra imperdiet sit amet at tellus. Nunc quis consequat justo, eget eleifend sem. Phasellus nulla augue, fermentum id posuere at, rutrum interdum lorem. Donec ullamcorper suscipit dui, nec lobortis turpis porttitor nec. Ut ac commodoInteger tincidunt augue vitae nulla rutrum placerat. Suspendisse mollis blandit dolor et aliquet. Pellentesque turpis tortor, commodo ut elit eget, facilisis iaculis arcu. Nulla fringilla ipsum euismod arcu tincidunt tristique at vitae sem. Maecenas eget dui non nibh viverra imperdiet sit amet at tellus. Nunc quis consequat justo, eget eleifend sem. Phasellus nulla augue, fermentum id posuere at, rutrum interdum lorem.<br />\r\nDonec ullamcorper suscipit dui, nec lobortis turpis porttitor nec. Ut ac commodoInteger tincidunt augue vitae nulla rutrum placerat. Suspendisse mollis blandit dolor et aliquet. Pellentesque turpis tortor, commodo ut elit eget, facilisis iaculis arcu. Nulla fringilla ipsum euismod arcu tincidunt tristique at vitae sem. Maecenas eget dui non nibh viverra imperdiet sit amet at tellus. Nunc quis consequat justo, eget eleifend sem. Phasellus nulla augue, fermentum id posuere at, rutrum interdum lorem. Donec ullamcorper suscipit dui, nec lobortis turpis porttitor nec. Ut ac commodo</p>', 1, '2017-03-21 19:51:46', '2017-05-05 13:26:57');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('user1@user.com', '$2y$10$ki9qnj/NyhLyQWc.qKRzEeUkMEz921zW9ziJd8CRWNxUVw/Izj8X.', '2017-03-10 10:58:00');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `file`, `created_at`, `updated_at`) VALUES
(2, '1490155978774283.jpg', '2017-03-22 11:12:58', '2017-03-22 11:12:58'),
(6, '1490593584862709.jpg', '2017-03-27 12:46:24', '2017-03-27 12:46:24'),
(7, '1490593607294552.jpg', '2017-03-27 12:46:47', '2017-03-27 12:46:47'),
(11, '1490770591360411.jpg', '2017-03-29 13:56:31', '2017-03-29 13:56:31'),
(12, '1491517870365580.jpg', '2017-04-07 05:31:10', '2017-04-07 05:31:10'),
(13, '1491517930630386.jpg', '2017-04-07 05:32:10', '2017-04-07 05:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `anonymous` tinyint(4) DEFAULT '0',
  `rating` decimal(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `review_by` int(10) unsigned NOT NULL,
  `review_for` int(10) unsigned NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_review_by_foreign` (`review_by`),
  KEY `reviews_review_for_foreign` (`review_for`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=34 ;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `anonymous`, `rating`, `description`, `review_by`, `review_for`, `approved`, `created_at`, `updated_at`) VALUES
(3, NULL, '4.00', 'ThisparagraphcontainsaverylongwordthisisaveryveryveryveryveryverylongwordThelongwordwillbreakandwraptothenextline.ThisparagraphcontainsaverylongwordthisisaveryveryveryveryveryverylongwordThelongwordwillbreakandwraptothenextline.Thisparagraphcontainsf', 1, 2, 1, '2017-03-20 14:08:04', '2017-03-20 14:08:04'),
(4, NULL, '2.00', 'Hello\r\n\r\nI purchased this USB memory stick to access my music library in my car. I have about 5,000 songs loaded and it is plugged into the USB port in my console. My old memory stick, while being slightly shorter than the standard memory sticks and th', 1, 2, 1, '2017-03-21 06:35:35', '2017-03-21 06:35:35'),
(5, NULL, '5.00', 'Hello I purchased this USB memory stick to access my music library in my car. I have about 5,000 songs loaded and it is plugged into the USB port in my console. My old memory stick, while being slightly shorter than the standard memory sticks and thHello I purchased this USB memory stick to access my music library in my car. I have about 5,000 songs loaded and it is plugged into the USB port in my console. My old memory stick, while being slightly shorter than the standard memory sticks and thHello I purchased this USB memory stick to access my music library in my car. I have about 5,000 songs loaded and it is plugged into the USB port in my console. My old memory stick, while being slightly shorter \r\n\r\nthan the standard memory sticks and thHello I purchased this USB memory stick to access my music library in my car. I have about 5,000 songs loaded and it is plugged into the USB port in my console. My old memory stick, while being slightly shorter than the standard memory sticks and thHello I purchased this USB memory stick to access my music library in my car. I have about 5,000 songs loaded and it is plugged into the USB port in my console. My old memory stick, while being slightly shorter than the standard memory sticks and thHello I purchased this USB memory stick to access my music library in my car. I have about 5,000 songs loaded and it is plugged into the USB port in my console. My old memory stick, while being slightly shorter than the standard memory sticks and thHello I \r\n\r\npurchased this USB memory stick to access my music library in my car. I have about 5,000 songs loaded and it is plugged into the USB port in my console. My old memory stick, while being slightly shorter than the standard memory sticks and thHello I purchased this USB memory stick to access my music library in my car. I have about \r\n\r\n5,000 songs loaded and it is plugged into the USB port in my console. My old memory stick, while being slightly shorter than the standard memory sticks and thHello I purchased this USB memory stick to access my music library in my car. I have about 5,000 songs loaded and it is plugged into the USB port in my console. My old memory stick, while being slightly shorter than the standard memory sticks and thHello I purchased this USB memory stick to access my music library in my car. I have about 5,000 songs loaded and it is plugged into the USB port in my console. My old memory stick, while being slightly shorter than the standard memory sticks and thHello I purchased this USB memory stick to access my music library in my car. I have about 5,000 songs loaded and it is plugged into the USB port in my console. My old memory stick, while being slightly shorter than the standard memory sticks and thHello I purchased this USB memory stick to access my music library in my car. I have about 5,000 songs loaded and it is plugged into the USB port in my console. My old memory stick, while being slightly shorter than the standard memory sticks and th', 1, 2, 1, '2017-03-23 10:19:12', '2017-03-23 10:19:12'),
(6, NULL, '2.00', 'Amazing game. Blizzard hit it out of the park with this one.\n\nThis is a team based match shooter game. Which means there''s no story or single player. It only consists of online play with other people in matches. You choose a hero from a decent selection and are put in one of two teams with a different goal depending on the match type. There are 21 total heroes to choose from and each focuses on a different role (broken down into groups of Attacker, Defender, Support, Healing)\n\nThis is definitely a team based game, so while a great player can influence a match he can''t win it by himself. What sets this game apart from a similar role-style team shooter game like CS or TF2 is that each character get''s a super move called an ULT that does a wide range of things from being a super attack, to reviving team mates, seeing through walls. This adds a lot of flavour and strategy to the game and balances things out for attacking and defending teams.\n\nLots of fun, updated frequently with new maps, items, and competitive seasons it''s definitely a must try for any avid gamer.', 1, 2, 1, '2017-03-23 10:29:09', '2017-03-23 10:29:09'),
(10, NULL, '4.00', 'Amazing game. Blizzard hit it out of the park with this one.<br />\n<br />\nThis is a team based match shooter game. Which means there''s no story or single player. It only consists of online play with other people in matches. You choose a hero from a decent selection and are put in one of two teams with a different goal depending on the match type. There are 21 total heroes to choose from and each focuses on a different role (broken down into groups of Attacker, Defender, Support, Healing)', 1, 2, 1, '2017-03-28 18:07:44', '2017-03-28 18:07:44'),
(11, NULL, '4.00', 'This is a team based match shooter game. Which means there''s no story or single player. It only consists of online play with other people in matches. You choose a hero from a decent selection and are put in one of two teams with a different goal depending on the match type. There are 21 total heroes to choose from and each focuses on a different role (broken down into groups of Attacker, Defender, Support, Healing)', 1, 5, 1, '2017-03-29 20:54:12', '2017-03-29 20:54:12'),
(13, 1, '4.00', 'This is a paragraph.', 1, 2, 1, '2017-03-30 20:15:00', '2017-03-30 20:15:00'),
(17, 1, '3.00', 'New Review', 1, 15, 1, '2017-04-01 00:15:36', '2017-04-01 00:15:36'),
(18, 1, '5.00', 'Suits are cool', 1, 5, 1, '2017-04-02 03:57:16', '2017-04-02 03:57:16'),
(19, NULL, '4.00', 'aasdasdasddasw', 1, 5, 1, '2017-04-02 03:57:51', '2017-04-02 03:57:51'),
(20, NULL, '4.00', 'Reviekasfdjkasfjkasj kijoreaw', 21, 15, 1, '2017-04-02 04:18:44', '2017-04-02 04:18:44'),
(21, 1, '5.00', 'hjdhsa<br />\r\n<br />\r\n<br />\r\n<br />\r\nsajkhfdjshaldhljwehfjhelqkajwdklhjqeljahfioqjlwkjdCNWJLFNDS<br />\r\nQWLJDKJANSDJKASBND<br />\r\n<br />\r\n<br />\r\n<br />\r\nJKSAFDASJDFJHSLHJAKFEHDS', 6, 5, 1, '2017-04-02 04:44:47', '2017-04-02 04:44:47'),
(22, NULL, '3.00', 'Hey this review is a test to make sure the filter by star rating works correctly', 1, 10, 1, '2017-04-03 09:03:24', '2017-04-03 09:03:24'),
(23, 1, '4.00', 'Blah', 1, 2, 1, '2017-04-03 14:06:18', '2017-04-03 14:06:18'),
(24, NULL, '4.00', 'sfds', 1, 2, 1, '2017-04-03 14:07:07', '2017-04-03 14:07:07'),
(25, 1, '4.00', 'Test', 1, 2, 1, '2017-04-06 13:01:08', '2017-04-06 13:01:08'),
(26, 1, '4.00', 'Test', 1, 2, 1, '2017-04-06 13:01:08', '2017-04-06 13:01:08'),
(27, 1, '5.00', 'Test', 1, 2, 1, '2017-04-06 13:01:28', '2017-04-06 13:01:28'),
(28, 1, '4.00', 'I purchased this USB memory stick to access my music library in my car. I have about 5,000 songs loaded and it is plugged into the USB port in my console.', 1, 2, 1, '2017-04-06 13:08:23', '2017-04-06 13:08:23'),
(29, 0, '3.00', 'xyz', 1, 2, 1, '2017-04-06 13:25:49', '2017-04-06 13:25:49'),
(30, 0, '1.00', 'test', 1, 2, 1, '2017-04-06 20:44:37', '2017-04-06 20:44:37'),
(31, 0, '1.00', 'test', 1, 2, 1, '2017-04-06 20:44:37', '2017-04-06 20:44:37'),
(32, 1, '5.00', 'We have a teacher like that at our school. He was a substitute in our class one day, where he was supposed to teach us something about electronics. After about 3-4 hours of him telling us everything from when his high pressure water hose (english is not my first language if you couldn''t allready tell...) broke down to the one time his mothers house test all most burned down because of a defective socket, we ended up getting a break. After the break he started repeating the storries he started telling us 4 hours ago. We didn''t learn shit that day. <br />\n<br />\nNew started repeating the storries he started telling us 4 hours ago. We didn''t learn shit that day. started repeating the storries he started telling us 4 hours ago. We didn''t learn shit that day. started repeating the storries he started telling us 4 hours ago. We didn''t learn shit that day. started repeating the storries he started telling us 4 hours ago. We didn''t learn shit that day. started repeating the storries he started telling us 4 hours ago. We didn''t learn shit that day.', 1, 2, 1, '2017-04-07 05:24:44', '2017-04-07 05:24:44'),
(33, 1, '2.00', 'test', 1, 15, 1, '2017-04-16 11:47:17', '2017-04-16 11:47:17');

-- --------------------------------------------------------

--
-- Table structure for table `services_detail_infos`
--

CREATE TABLE IF NOT EXISTS `services_detail_infos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `vendor_category` int(10) DEFAULT NULL,
  `vanue_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vanue_settings` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vanue_min_price` decimal(50,2) DEFAULT NULL,
  `vanue_max_price` decimal(50,2) DEFAULT NULL,
  `bridal_makeup_offer` tinyint(4) NOT NULL DEFAULT '0',
  `bridal_makeup_starting_price` decimal(50,2) DEFAULT NULL,
  `photographer_vidoegraphy_service_provide` tinyint(4) NOT NULL DEFAULT '0',
  `photographer_photo_booth_service_provide` tinyint(4) NOT NULL DEFAULT '0',
  `photographer_starting_price` decimal(50,2) DEFAULT NULL,
  `videographer_photography_service_provide` tinyint(4) NOT NULL DEFAULT '0',
  `videographer_starting_price` decimal(50,2) DEFAULT NULL,
  `wedding_dj_music_offer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `transportation_vechile_available` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wedding_entertainment_sub_category` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `officiant_religion` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `additional_service` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_detail_infos_user_id_foreign` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `services_detail_infos`
--

INSERT INTO `services_detail_infos` (`id`, `user_id`, `vendor_category`, `vanue_type`, `vanue_settings`, `vanue_min_price`, `vanue_max_price`, `bridal_makeup_offer`, `bridal_makeup_starting_price`, `photographer_vidoegraphy_service_provide`, `photographer_photo_booth_service_provide`, `photographer_starting_price`, `videographer_photography_service_provide`, `videographer_starting_price`, `wedding_dj_music_offer`, `transportation_vechile_available`, `wedding_entertainment_sub_category`, `officiant_religion`, `additional_service`, `created_at`, `updated_at`) VALUES
(1, 2, 1, '["hotel","restaurant \\/ lounge"]', '["indoor"]', '500.00', '1000.00', 0, NULL, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-18 18:45:55', '2017-03-28 19:59:53'),
(3, 7, 6, NULL, NULL, NULL, NULL, 1, NULL, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-26 02:44:49', '2017-03-26 02:44:49'),
(4, 14, 17, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, NULL, 0, NULL, NULL, '["standard_limo","motercycle","suv","shuttle_bus","horse_&_carriage"]', NULL, NULL, NULL, '2017-03-28 02:15:51', '2017-03-28 02:15:51'),
(5, 74, 9, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, NULL, 0, NULL, NULL, NULL, 'wedding_singers_/_musicia', NULL, NULL, '2017-04-23 07:36:39', '2017-04-23 07:36:39'),
(6, 93, 4, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2017-04-24 07:14:39', '2017-04-24 07:14:39'),
(7, 94, 4, NULL, NULL, NULL, NULL, 0, NULL, 1, 1, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2017-04-24 07:18:54', '2017-04-24 07:18:54'),
(8, 95, 5, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, NULL, 1, '1222.00', NULL, NULL, NULL, NULL, NULL, '2017-04-24 09:08:23', '2017-04-24 09:08:23'),
(9, 96, 5, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2017-04-24 09:09:52', '2017-04-24 09:10:19'),
(10, 97, 1, '["banquet hall"]', '["indoor","outdoor"]', NULL, NULL, 0, NULL, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, '2017-04-25 06:58:42', '2017-04-25 06:58:42'),
(11, 109, 17, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, NULL, 0, NULL, NULL, '["standard_limo","van","classic_car","sedan","shuttle_bus","horse_&_carriage"]', NULL, NULL, NULL, '2017-05-05 13:40:02', '2017-05-05 13:40:02'),
(12, 110, 15, NULL, NULL, NULL, NULL, 0, NULL, 0, 0, NULL, 0, NULL, NULL, NULL, NULL, 'Buddhist', NULL, '2017-05-05 13:41:32', '2017-05-05 13:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` text,
  `value` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'logo', '1489626592115325.png', '2017-03-16 06:54:11', '2017-03-16 08:09:52'),
(2, 'favicon', '1489622067247924.png', '2017-03-16 06:54:11', '2017-03-16 06:54:27'),
(3, 'site_name', 'Shadi Vibes', '2017-03-16 06:54:11', '2017-03-16 08:10:59'),
(4, 'site_email', 'site@shadivibes.com', '2017-03-16 06:54:11', '2017-03-16 08:10:59'),
(5, 'site_link', 'www.shaadivibes.ca', '2017-03-16 06:54:11', '2017-03-16 08:10:59'),
(6, 'site_phone', '+0731 1234567890', '2017-03-16 06:54:11', '2017-03-16 08:10:59'),
(7, 'site_mobile', '+91 1234567890', '2017-03-16 06:54:11', '2017-03-16 08:10:59'),
(8, 'site_fax', '+91 1234567890', '2017-03-16 06:54:11', '2017-03-16 08:10:59'),
(9, 'site_address', 'Torronto, Canada', '2017-03-16 06:54:11', '2017-03-16 08:10:59'),
(10, 'site_keywords', NULL, '2017-03-16 06:54:11', '2017-03-16 08:10:59'),
(11, 'site_meta_desc', NULL, '2017-03-16 06:54:11', '2017-03-16 08:10:59'),
(12, 'noreply_email', 'admin@noreply.com', '2017-03-16 06:54:11', '2017-03-16 08:10:59'),
(13, 'copyright', 'Copyright © 2017 Shaadi Vibes. All rights reserved.', '2017-03-16 06:54:11', '2017-04-24 08:45:18'),
(14, 'admin_email', 'admin@admin.com', '2017-03-16 07:11:52', '2017-03-16 08:10:59'),
(15, 'fb_url', 'https://www.facebook.com/activision.blizzard.atvi/?ref=br_rs', '2017-03-16 07:41:08', '2017-04-07 01:14:16'),
(16, 'twitter_url', 'https://twitter.com/blizzard_ent?lang=en', '2017-03-16 07:41:08', '2017-04-07 01:14:16'),
(17, 'linkedin_url', NULL, '2017-03-16 07:41:08', '2017-04-07 01:14:16'),
(18, 'gplus_url', 'https://plus.google.com/+Blizzard', '2017-03-16 07:41:08', '2017-04-07 01:14:16'),
(19, 'snapchat_url', 'https://plus.google.com/+Blizzard', '2017-03-16 07:41:08', '2017-04-07 01:14:16'),
(20, 'instagram_url', 'https://www.instagram.com/blizzard_fans/?hl=en', '2017-03-16 08:03:14', '2017-04-07 01:14:16'),
(21, 'contact_email', 'info@shaadivibes.com', '2017-03-21 20:48:15', '2017-03-22 20:59:59'),
(22, 'contact_address', 'Toronto, ON, Canada', '2017-03-21 20:48:15', '2017-03-22 16:40:47'),
(23, 'contact_location', 'Toronto, ON, Canada', '2017-03-21 20:48:15', '2017-03-22 20:59:59'),
(24, 'contact_lat', '43.653226', '2017-03-21 20:48:15', '2017-03-22 20:59:59'),
(25, 'contact_long', '-79.38318429999998', '2017-03-21 20:48:15', '2017-03-22 20:59:59'),
(26, 'contact_phone', '+(31)46 475 7193', '2017-03-21 20:48:15', '2017-03-22 20:59:59'),
(27, 'site_footer_text', 'orem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tortor nisi, finibus vitae sollicitudin in, viverra id metus. Fusce orci sapien, gravida in nulla ac, tristique dapibus turpis. Praesent ut purus mauris. Vestibulum congue eros purus, ac porta ipsum accumsan in. Sed condimentum diam dui, vitae dignissim libero molestie eget.', '2017-03-22 16:38:00', '2017-04-24 08:45:18'),
(28, 'home_section4_inbox_text', 'Never miss out on important tips by subscribing to our latest newsletters, offering the latest wedding and fashion trends.', '2017-03-22 18:22:07', '2017-04-24 08:37:25'),
(29, 'home_section4_collaborate_text', 'Narrow down your search for that those perfect vendors by utilizing our review system with real feedback from local couples just like you!', '2017-03-22 18:22:07', '2017-04-24 08:37:25'),
(30, 'home_section4_finalize_vendors_text', 'Bookmark your favorite vendors to review later, allowing you to shortlist multiple vendors and decide which ones meet your wedding needs.', '2017-03-22 18:22:07', '2017-04-24 08:37:25'),
(31, 'home_section4_checklist_text', 'Never miss out on important tips by subscribing to our latest newsletters, offering the latest wedding and fashion trends.', '2017-03-22 18:22:07', '2017-04-24 08:37:25');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int(11) NOT NULL DEFAULT '999',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`id`, `title`, `image`, `order`, `created_at`, `updated_at`) VALUES
(2, 'Slider2', '1490770591360411.jpg', 1, '2017-03-29 13:56:32', '2017-03-29 13:57:05'),
(3, 'SLider 3', '1491517930630386.jpg', 999, '2017-04-07 05:32:20', '2017-04-07 05:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `social_accounts`
--

CREATE TABLE IF NOT EXISTS `social_accounts` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `provider_user_id` varchar(100) NOT NULL,
  `provider` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE IF NOT EXISTS `subscribers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subscribers_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'test@mailinator.com', '2017-03-10 08:58:13', '2017-03-10 08:58:13'),
(2, 'danishbir@gmail.com', '2017-04-02 04:07:37', '2017-04-02 04:07:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `usertype` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `profile_pic` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `banner` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthdate` datetime DEFAULT NULL,
  `category` text COLLATE utf8mb4_unicode_ci,
  `street` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_code` int(11) DEFAULT NULL,
  `phone_number` bigint(20) DEFAULT NULL,
  `mobile_num` bigint(20) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=112 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `username`, `company_name`, `email`, `password`, `usertype`, `profile_pic`, `banner`, `gender`, `birthdate`, `category`, `street`, `city`, `state`, `country`, `pincode`, `area_code`, `phone_number`, `mobile_num`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'User1', 'test1', NULL, 'user1@user.com', '$2y$10$TDH63rn3nnyOp4LYehvfKe4XYQhaxD8d1nwUd9nau1s3yEx75rfji', '1', '1490867059.png', NULL, '1', '2000-03-22 00:00:00', NULL, '126, Pwd Office street near sbi bank', 'Toronto', 'Ontario', 'Canada', '123456', 123, 2365891, 9632587140, 1, 'ObsPyEFRPw2zJCrxxW3YCL89DTHy6vhoEEB7AZpxgmG6RPumdS9y2wiO5Qz7', '2017-03-05 08:53:53', '2017-04-02 04:42:43'),
(2, 'John', 'Geo', 'test22', 'XYZ', 'user2@user.com', '$2y$10$M8x/K.gmnDx469lLniRlx.t7dt3Deqmm7cDQVzC1wRjxydjtlYDSC', '2', '1488853223.jpg', '1490242402766310.jpg', '1', NULL, '1', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 1, 'lylCFm605oBjNf1bVLegfhRoY6dqjJ45QEJfkCHzPQQoBO1bOVRy62xZ67Rt', '2017-03-05 08:53:53', '2017-04-28 21:04:37'),
(3, 'Chandulal', 'Bhindi', 'bbhindi', 'Golden Tree Jewellers', 'user3@user.com', '$2y$10$4GMyQ/BpAWoBlLFF0DkjB.byDf3GZIg1CxaSJY1AKVLEk95tFHd/u', '2', NULL, '1490241823648570.jpg', NULL, NULL, '18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'iCmVt6YXtNDSxjaNNOf9GCgChDZFzzBzn99R4Y3sBhRjbp5pAyS0EdOI1MLL', '2017-03-21 05:11:05', '2017-04-05 09:57:58'),
(4, 'Suki', 'F', '', 'Suki''s House of Flowers', 'suki@sukisflowers.com', '$2y$10$LKg54vUhHzXs4mZ1rzX5xOELW3BFc8FTc18mQXNmjwPjU5ZBGeqdq', '2', NULL, '1492496379622603.jpg', NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nbOG1rCgoGk1UjeDUrJiimqfbzAn5H92pzffpXT4oPDGywYTKoo3Fnt1gK9W', '2017-03-21 12:52:38', '2017-04-18 13:19:39'),
(5, 'Danny', 'Bassi', 'wearmodello', 'Modello Bespoke Suiting', 'wearmodello@gmail.com', '$2y$10$1HCHsonikrlGj0.p4PgSdejYK8rfWTpKyyY48by6ad712XjMz.ana', '2', '1490326347.jpg', '1490327313469394.jpg', NULL, NULL, '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'OOzLSwEQl7d7bmaJK9CYUjRo8OYEA50qaeJDgQMpUbuDvzvHYEMAIsCOjipE', '2017-03-24 10:27:27', '2017-04-16 12:07:39'),
(6, 'Danny', 'Bassi', 'dannybassi', NULL, 'danishbir@gmail.com', '$2y$10$9e.kA44nJNnso3DqFcFojOkBT/WgY2mYvCsPsxaCuEF31koHsbkEC', '1', NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'D5FXYUQlwJS6fvuOK15eYpebvYOMb8nH4Q0uoiwVKTETx9Tipd0vnJUUkieD', '2017-03-24 11:03:06', '2017-03-24 11:10:11'),
(7, 'Person', '1', 'a', 'New Hair & Makeup Blue Rose', 'user86@user.com', '$2y$10$n4FwbZXzUeWIepDpn0EKvup9Z8OFORdO4DRR0FNkf7yFy5ntJ7eTa', '2', '1490471117.jpg', '1490471346708889.png', NULL, NULL, '6', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'bvSJgshPOrJUCUrHPdFDuVXPmIPILVnCQbxRuFhe590IECbGvZhK7wuGNZ81', '2017-03-26 02:44:26', '2017-03-26 04:33:14'),
(8, 'Person', '2', 'b', 'New Bridal Wear', 'user_2@user.com', '$2y$10$LeoXWwyuK6uGqUL6msCYoezSXwO.AVGz01D5.BXCnCpFWA54wBSua', '2', NULL, '1490480444498567.png', NULL, NULL, '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'TeAsF96YNLQTowrkSAas39u76xjrLQbb9PleNUvUQnrnFhte8fSQrgANFRFt', '2017-03-26 05:20:31', '2017-03-26 05:22:25'),
(9, 'Person', '3', 'c', 'New Mehndi Designs', 'user_3@user.com', '$2y$10$G3jn4lV4DhOC4sbZ6zXR5uHz7jZM.A.a1VbY9mGHJeLIzHa/N.PCe', '2', NULL, '1490490939321986.png', NULL, NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'hty6S2COuPPLPrGkW2wIbpYycNWEZFbyhJs1Ujcetm4hT7GqnzyuEIu9EMKn', '2017-03-26 08:15:21', '2017-03-26 08:17:10'),
(10, 'Person', '4', 'd', 'New Groom Wear', 'user_4@user.com', '$2y$10$qI/vCDYw3HPqCsMK/1LN/.wYu6wNkADUHjmKXw/BFdbmlO.mHNyDW', '2', NULL, '1490498209607041.png', NULL, NULL, '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'wHpuKWyPuDc6zHJbhIZT8LiX83WtCc7Pw3GKh74NBUxXAPxFYW2vCwgYwdx0', '2017-03-26 09:34:13', '2017-03-26 10:33:35'),
(11, 'Person', '5', 'E', 'Groom WearX', 'user_5@user.com', '$2y$10$T84JEI0RQLaquR9vwvia/ewqyvcYa4GMKY7E5FRVFUjXTahXkSK0u', '2', NULL, '1490498604648857.png', NULL, NULL, '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '6W1NNF3EphHajUqHkhZsXkA0WyIyYEjAx0tbgs1Br4RoBGQXbdad8eUElMqJ', '2017-03-26 10:21:58', '2017-03-26 10:33:37'),
(12, 'Person', '6', 'F', 'New Jeweler', 'user_6@user.com', '$2y$10$wldjxeXEkpWQCLAPpn53vedzejy2LNPAMOEYObYX6xvrM..lUzqzq', '2', NULL, '1490499179181712.png', NULL, NULL, '18', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'AuRfadI1vmwTooNXlQjANMd4QmTA0E05H871IV6QhV9fzvAwTh4Fq2i58m3E', '2017-03-26 10:31:18', '2017-04-03 08:34:42'),
(14, 'Person', '7', 'p7', 'New Transport Vendor', 'user_7@user.com', '$2y$10$FkqH7f8tq7YqKY7vVaT55eclmzeLDReLXWgLS3gAKO1cwl6bErMKC', '2', NULL, '1490642188579833.jpg', NULL, NULL, '17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'U0iArUo4z7IH4A9gg5kFkTjbHfc1oawubJgqmLvuWDg6D2qKgxefMxSPZrnZ', '2017-03-28 02:15:42', '2017-03-28 02:17:33'),
(15, 'James', 'Ramsey', 'jramsey', 'Bistro 101 Catering', 'user_8@user.com', '$2y$10$I40EufStcj/QnyHHVFRZl.LKhqr4jOLvT3i7.a5WmRKz4bIYwxtOu', '2', NULL, '1490642526153140.jpg', NULL, NULL, '14', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'jjcVcRpBER3V0UtXeTcHWbuFCFNOtj5sg6GdcKT3MbzcWQk4EGTIcKph56Gc', '2017-03-28 02:21:11', '2017-03-28 02:22:06'),
(20, 'Risen', 'Sys', 'risen12268', NULL, 'developers.risensys@gmail.com', '$2y$10$Af98cHGXggoopyZalIN/ieqR0FlGIts5.0Qe4U/qQyvvypjVT7fBa', '1', NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2iSwyYatra4tP52xcbKFMGE5oHjPYso7Po4FwAMxvLiKoHbODsikX3Bx5Bgd', '2017-03-30 16:32:43', '2017-03-30 17:10:47'),
(21, 'Shaadi', 'Vibes', '', NULL, 'shaadi.vibes.bc@gmail.com', '$2y$10$Z9gfVgWOqSpuJnhKh2y01.QFMrleATfB4tJd4n1BEYqMbH5GLfGju', '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'BNjiKZY6hSqZZ8LU2izrANgOQGiEpuGFNz2sBFsNOp33LQLGKmGQEPc3AvNP', '2017-04-02 04:15:06', '2017-04-02 04:15:06'),
(23, 'No', 'Name', '', 'Surrey Flower Shop', 'user1@fake.com', '$2y$10$jKVTsJEq3.Yb08yodkwFS.XLXxQ9JC6ScRbra7mnjkGSXYeGHLv1u', '2', NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'goLti6qJDwiC746clvelncAj1ItucRye9xsb53sbjwbRrPDUT7bom7PBXWEI', '2017-04-18 13:23:26', '2017-04-18 13:25:52'),
(24, 'Jessica', 'Name', '', 'Amazing Keepsakes', 'jessica@amazingkeepsakes.ca', '$2y$10$Pr1hkaadihgx.ZuheJv/o.PlZDUK6YreGuHD4qeM/oDgpqe.1HtX2', '2', NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '4luY1cdqPJ9GC7CTEj2KZcDszsQyYc64bxWa54J6RnpzUPuQRHlrTdzg3xQ8', '2017-04-18 13:37:56', '2017-04-18 13:42:49'),
(25, 'No', 'Name', '', 'Sunflower Florist', 'info@sunflowerflorist.ca', '$2y$10$1bSWPzMhJqy36nZN/CkoF..lyIkQk4giFOOv6G9WLXVXDuigYcfKq', '2', NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'dUSnovZWgkuWzDuwv1ZelcNcZL6vmOupxZH53eYBaH3gxGYH3tt7mFQb1PPa', '2017-04-18 13:47:54', '2017-04-18 13:49:12'),
(26, 'No', 'Name', '', 'Reel Silks', 'info@reelsilks.com', '$2y$10$c9oqmK4YKEs4Bcn6mY20ce8wqUo0I4biofKB9XEKmrpCGmZcvegG6', '2', NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'HeReKXIU6i9LIzbeJtypkF7v7kPKUlTMoRtI5YzPahrU7ZbssjBlU5cIgq9W', '2017-04-18 13:52:30', '2017-04-18 13:54:14'),
(27, 'Raj', 'Bains', '', 'Didi''s Flowers', 'raj@didisflowers.com', '$2y$10$admckFUcakDkKQXhE2mdbe.7bVTc81kNNP3KCKnRSWE4nRx6y7Esq', '2', NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'dZ1acK2F3HcRh4UdAJ5rFyNszfHHrmV0AMpYTFYRb1i2v2rdCwHDzlpo16ZE', '2017-04-18 13:55:59', '2017-04-18 13:58:42'),
(28, 'No', 'Name', '', 'Bootah Jardine Florists', 'info@bootahjardin.com', '$2y$10$cHXecbcStCYNO2pBoet/Ruh5DheCGI5nsn/vIxODRjxAK1OEp47i.', '2', NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kvbxUfKB5jyYXrGFllw1ZmyjCsz7abtAF3YKS1k5Xx7NAIC0oBIbxdyWAUmR', '2017-04-18 14:00:25', '2017-04-18 14:02:13'),
(29, 'No', 'Name', '', 'Destination or Not Floral Design', 'info@destinationornot.com', '$2y$10$P6vntpi.ihHZ/vJSUYgHP.ZaM46G4zMaIAj9DfMxMSnWN5pk2KR4u', '2', NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ofDqiaV8z0l2A6Fr9Uu3vvnwHDT2TYfKZbs60cxO3Lz8McrqdOOgdrPz6d8F', '2017-04-18 14:03:44', '2017-04-18 14:05:16'),
(30, 'Gala', 'Name', '', 'Rococo Floral & Events', 'info@rococofloral.ca', '$2y$10$xEOCa1eh/POVi1JZmLD1guJekNQ9pyeq9WaRCWa5jzplqGrpk52pS', '2', NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'tehJK8qCGyAphPfa3Gq6vvZnHzLDgkFx1pN44YycreKXIOS8LDgGYegpRm2s', '2017-04-18 14:06:58', '2017-04-18 14:09:38'),
(31, 'No', 'Name', '', 'Katsura Designs', 'info@weddingflowersvancouver.com', '$2y$10$AxczPQ2ifkT5bm9RazTzp.Dv85zN2yB3HqhYdquPOpV4dxGzQITr2', '2', NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'EmUEoT5X7xt2NWuUa95DQasxkbTtVAqKfHDUyXVn6vbD2QwG8Fp0b1BLtaPg', '2017-04-18 14:10:36', '2017-04-18 14:12:03'),
(32, 'Denise', 'Name', '', 'Half Yard Designs', 'denise@halfyarddesigns.com', '$2y$10$77k4beVoPiRNlqHmoOJpPOmsxpwMN.6le7l9XNhEP0puP2iD0AcGi', '2', NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1E8V4xzVRKR02iVusLAulIZnTSjwTgt6xXALcZGnVi5rFrV2oBxz6tmK9DAG', '2017-04-18 14:15:44', '2017-04-18 14:18:11'),
(33, 'Josephine', 'Name', '', 'Josephine''s Floral Expressions', 'josephinesfloralexpressions@gmail.com', '$2y$10$1PJmiGrhi2uUK74nF03ZBuwvcC4X6cuB6m51VNYY0vhauRKqyrRvS', '2', NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'An877QSiKAI8irSNk1690N3NNS3HOjCTrpdSplUThlhis3cCK3A7afrxPFgi', '2017-04-18 14:19:27', '2017-04-18 14:25:18'),
(34, 'Fran', 'Inden', '', 'Fran''s Flowers', 'coquitlamcentre@fransflowers.ca', '$2y$10$Kvfr8DoJ/DRFlV5ZPcZRauwTDT0D2OQImyO1D/v26huRkBJiE6AHC', '2', NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'tA2TXMfTdRjcN5V4XV9ql8nkVrW7QVRb0OmLLhPaDG6xQKbzapVXmZ4W7UDB', '2017-04-18 14:26:01', '2017-04-18 14:28:27'),
(35, 'Marlee', 'Van Oord', '', 'Flowerella Event Florals', 'Flowerellainfo@gmail.com', '$2y$10$mJ9ysqCM50Vhg4BsJUCvDuLWgc1.a9knINxxW5tSZ9VrFyxILu4/2', '2', NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'H3rHEvdeTyIIyMEwnIlwvVM5gICo02Iv4cOkAtwD83yNK44gEwl1gzxfEmUs', '2017-04-18 14:29:13', '2017-04-18 14:30:58'),
(36, 'No', 'Name', '', 'River and Sea Flowers', 'riverandseaflowers@gmail.com', '$2y$10$/hZoHD0vpg92JB4CnQwxD.JPYaJj2ybEUYhsYdpbP3T5mzd6.H5/q', '2', NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'OItduR9oa6JQiUv28N1P1MpymTFGdzDBu7MJ3jWpx2gVPwBAIMi0h2jqswma', '2017-04-18 14:33:34', '2017-04-18 14:35:57'),
(37, 'No', 'Name', '', 'Divine Vines Florists', 'info@divinevines.ca', '$2y$10$fVq79FdpfjhuiQ.9s6l81O/K6LXyABntCL/CWWa1U3tYpLmQTeH/W', '2', NULL, NULL, NULL, NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-04-18 14:36:52', '2017-04-18 14:38:15'),
(38, 'No', 'Name', '', 'Red Carpet Decor', 'redcarpeteventvan@gmail.com', '$2y$10$2BrYEoEp/E1FFVZHFcQR6OkDotyDdEQbvcqzahP9Wxwu29bmsSyyW', '2', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'eZZkm3LXuiCrorEUkAW6ds6bTuo5k5HZjw8Vf6Gd1VsY8w04fZrqwJwnYjV9', '2017-04-19 12:26:34', '2017-04-19 12:28:48'),
(39, 'No', 'Name', '', 'Universal Decor', 'universal_decor@yahoo.ca', '$2y$10$iXirr5AD5jmSGLQ6cpiX3OyOBkO.iQKrQ6/OKORAhao.XU/1tFy2y', '2', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Hmv9vgVy7paRjDnwNNJcMZGjLj09Y2xdtU8OeZ70sfELaDTKO01oc7tbhs5K', '2017-04-19 12:30:00', '2017-04-19 12:33:03'),
(40, 'No', 'Name', '', 'Charming Affairs', 'charmingdecor@gmail.com', '$2y$10$0AbpFXxHGElvmwg9VUZbbeoEq/XYMVClp.u.5WGtfQXM33RaSUp6m', '2', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'DASpAGmDu8jF9SjACaW1HsnDGREBCyfNm2Sc2jTzaP5RUvGHbIdPWByBycZF', '2017-04-19 12:33:31', '2017-04-19 12:36:14'),
(41, 'Raymon', 'Name', '', 'Raymon''s Decor', 'info@raymonsdecor.com', '$2y$10$MMZc0cfOzED7sOm60j8NAOJEiPUOHn63T7SvMjt6iZAuj37Ny9FQ2', '2', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Y1SiTJfWhnSsGvNZiKFo6xwqhU4P61SLf74L85lpSoxA186G5rdcfh5YYRMi', '2017-04-19 12:37:05', '2017-04-19 12:38:36'),
(42, 'No', 'Name', '', 'Kaur Decor', 'kaurdecor@outlook.com', '$2y$10$waVE.Bi4pw/WtTB4SJ/9IOdulHQTzVZBe2VuqBhG/C9DF8PIvnAp2', '2', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'W9i0dAcwSb5e9ibOzQdpf1Kj1cax1fy56PkMSAap3ScR0Q0QNApV28LfCfWb', '2017-04-19 12:39:02', '2017-04-19 12:39:57'),
(43, 'No', 'Name', '', 'Lux Affairs', 'info@luxaffairs.com', '$2y$10$WFynXmHwh081aZoOaqxSDO67olBC7iQEvdCr1tOJYwWItVdUDHr7a', '2', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'IAfRFdXXic44X2akXsWLrDoIs9jhm2vyiJCvwACZkdvcJkskkqhGXkOZ0MBn', '2017-04-19 12:40:49', '2017-04-19 12:41:49'),
(44, 'Sukhy', 'Nijjar', '', 'Eternal Bliss Decor', 'info@eternalblissdecor.com', '$2y$10$unFqsvRW7jh42FJu.gKpjuUYDjDThSU8dsKjYKpAeTdi1dNvg6Zga', '2', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'AJHELeVsV5LJfLgDltqJyoIxWNEUNqUopxg1hwG83IdlTogLtrp0gvW1DtA4', '2017-04-19 12:42:47', '2017-04-19 12:44:00'),
(45, 'No', 'Name', '', 'Moonlight Wedding Decor', 'info@moonlightweddingdecor.com', '$2y$10$48.bUKbQ9fsg1NK1VtzDu.PxocNlYqX6f2y9JoKG1nfysp1ibvnw6', '2', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '54TIliMzdgwTyBy7Uu9vnXYcqPOaJIEeMgq8kkZsI0znBx0twC3jDR4Xdwzt', '2017-04-19 12:44:34', '2017-04-19 12:46:12'),
(46, 'Jesse', 'Khaira', '', 'Jesse Khaira Events', 'info@jessiekhaira.com', '$2y$10$DWVXTChfl2rQJqxytwTUV.H3M5n9.5yr1eQBQQOMNBoVlT3AzQiom', '2', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'r36BrQ2XZc8Az4UO1IgsieirVHGi1GbXzRcJ6YBPZgkUCcssmqzvNQBdwwgi', '2017-04-19 12:46:46', '2017-04-19 12:48:33'),
(47, 'No', 'Name', '', 'Bespoke Decor', 'hello@bespokedecor.ca', '$2y$10$Xjl8qlK4r.JX6IhsVf0cUeeGBWtpZovc/LKXA4ctl6S3FlmUlwFAG', '2', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'q8LRQUKHLwINz7sKuPP9CnNlS5tRHpcRVzlun5zKVl0DTiHrGyCurayTVHrd', '2017-04-19 12:49:24', '2017-04-19 12:50:37'),
(48, 'No', 'Name', '', 'Pink Paisley Decor', 'pinkpaisleydecor@gmail.com', '$2y$10$3PJnYwUIktb1CMs9UYz38uueZzRb4PAcajahPZxsCP71xSXGlmWFG', '2', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Y8EVhICK1NJQ57U15jBBO9QMSIvy2x1ndUnuffIA3ZYyNFUau0y0LNavfYZD', '2017-04-19 12:51:32', '2017-04-19 12:52:22'),
(49, 'No', 'Name', '', 'Lovestory 101', 'user2@fake.com', '$2y$10$ilgQST1IIDtU0a4RM1SZIeLAvnGoz442jeUmKeD1N6VW9GQpfBsji', '2', NULL, NULL, NULL, NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'rTwu4V2HvSnHPzGC6DFopPx4tksGPxF8F0z1o3i1hjARNuUZfpCiVkodh7c0', '2017-04-19 13:51:32', '2017-04-19 13:53:23'),
(50, 'Jason', 'Sarai', '', 'Style By Sarai', 'info@stylebysarai.com', '$2y$10$bdLMMunF2AUZwFv3jOr7Beu/sCv.tJKw1u9Eu6kb6NHs7LoAZB8N2', '2', NULL, NULL, NULL, NULL, '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'czLtUP1HQFbpYbVNFHJWRNVkx6zcYKneSyRld3iWagN50aXhJdl24GfA7A3C', '2017-04-19 14:00:55', '2017-04-19 14:05:57'),
(51, 'No', 'Name', '', 'Well Groomed', 'sales1@wellgroomed.ca', '$2y$10$m2rBLzqb59bgaG58JyAUL.ooSwzjaL0yYwrwvFm55uSrCOquH3.uW', '2', NULL, NULL, NULL, NULL, '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2ZsI7Kaegj9J0pQSMFRGAkNgO0gLakMn8gtIxvdshJDGWwq1LtG9tDuXg5yG', '2017-04-19 14:08:04', '2017-04-19 14:11:28'),
(52, 'Joseph', 'Chanan', '', 'Joseph and Chanan', 'info@josephchanan.com', '$2y$10$VN7ilY/iTqJlcgbcyIxH9uIF4cAH3X9Y3bgbZHx2AEMvBbElXfO66', '2', NULL, NULL, NULL, NULL, '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'XWhdRoImgRby5Th4oFceZt7WLVHPUF9MWlrVA5T4pd1C05Qa8NH7iuPcWaRD', '2017-04-19 14:12:13', '2017-04-19 14:15:32'),
(53, 'No', 'Name', '', 'Baynes and Baker', 'info@baynesandbaker.com', '$2y$10$vHOGtfHzDLC6wiAlVUvyHu07fhF8/8QYtpbiVGeOIaba.Nq3Ej40S', '2', NULL, NULL, NULL, NULL, '10', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'yfo50OWmuFZTYRnbfW41hfbZfzvetHBe4j7wyOXlHvcE7cmUETpY5SA5zais', '2017-04-19 14:16:21', '2017-04-19 14:26:29'),
(54, 'Asad', 'Khan', '', 'Decibel Entertainment', 'info@decibelentertainment.com', '$2y$10$8nGAQN0rXBcn73YD.R8Ife9WoYVbjB3pLZh4P1E9Xi4oJrjSZsJS6', '2', NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'pfu8jsSNBgF5S5L8x5aXMn5Zot4lJTY2ob1jeQJMc9A0miXLqU0sJq0XiVX2', '2017-04-19 14:27:42', '2017-04-19 14:29:15'),
(55, 'No', 'Name', '', 'AfterShock Roadshow', 'info@aftershockroadshow.com', '$2y$10$ttuksqtEMsqX9we6zUWGQ.bKLX0dWebkFq97z2Me9APbfLy8kwtM.', '2', NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'NLVBvud7blbYT6RSOwp5LuAU3KDCswZmp7VhLEPXVrZ14ySegMvie3DS7bky', '2017-04-19 14:29:51', '2017-04-19 14:31:15'),
(56, 'No', 'Name', '', 'XFusion Roadshow', 'info@xfusionroadshow.com', '$2y$10$xzXHfBBeHc9htKGbSIi6SeES9VoHxZVx3VQ6PiiGWvBux/zcFYHHi', '2', NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'WKhVKul0NiJav8hGeAYdE8rfCDcv64NGfLjXno1wct2E1i6nCzaNEMD57Wct', '2017-04-19 14:32:00', '2017-04-19 14:34:25'),
(57, 'No', 'Name', '', 'High Voltage Roadshow', 'info@highvoltageroadshow.com', '$2y$10$zjQbc6UYLSORROSdmW72o.9C6DfVp47pnBa1tC2d9Jobo2aZSOa9m', '2', NULL, NULL, NULL, NULL, '8', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'iiXNIAk6QrlqX5YlhIec1452EtfVhmO8Fj0hjYZ8uwHldUm6fMCulzeLX8fV', '2017-04-19 14:35:10', '2017-04-19 14:37:43'),
(58, 'Sunny', 'Name', '', 'Sunny''s Bridal', 'info@sunnysbridal.com', '$2y$10$lXy.xrLepuMr3vk5xFTr.OgkcdrFCYNcZaZMqGgyPVo/yYveflJui', '2', NULL, NULL, NULL, NULL, '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'lM4oIDqjJxwQWUeCi6KBG6xfhs6BaqZRC3Tn87gganbeafQ9e2sBwJlmZA6X', '2017-04-21 12:18:01', '2017-04-21 12:19:09'),
(59, 'No', 'Name', '', 'Made In India', 'user3@fake.com', '$2y$10$hjeForFP8B2KSdaXH8/5xelafiXmH/lZlfPshL5nNoFWHKEvxc79.', '2', NULL, NULL, NULL, NULL, '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'M4EsS0R8GcRmHsGOyy0R4r6HbSuigCeH13zbrj3AgNgJrQpWFox9GqLxnJXg', '2017-04-21 12:20:08', '2017-04-21 12:21:00'),
(60, 'No', 'Name', '', 'Well Groomed', 'sales@wellgroomed.ca', '$2y$10$rEmQ4IIE1d/uAsGnXvqeY.6d2OLYbzeZLDfexTvGJvekeI2MjjJOy', '2', NULL, NULL, NULL, NULL, '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Vfw5touL04HMDtZfLjQBVYFTaF7gMxaqMTSZKB7ZLdBBiJelPloj9nz2rwUF', '2017-04-21 12:22:03', '2017-04-21 12:23:39'),
(61, 'No', 'Name', '', 'Vivah Collections', 'vivah_collection@hotmail.com', '$2y$10$hI8g8XyLAAT7kVb3yoh4.unmSZHn22BD58a/fUNpgM0/hPCokT0R.', '2', NULL, NULL, NULL, NULL, '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'GMwkdMUciUmCMHRuDOkFIzjCH8nTTRnfywbIGvj2hxdJilnKffCNM7eF9PUz', '2017-04-21 12:24:34', '2017-04-21 12:26:54'),
(62, 'No', 'Name', '', 'Frontier Bridal', 'frontiersurrey@gmail.com', '$2y$10$JxDJ0/03HCFXKi8iQui/3OCwxYYeRlCuZDdC4gBnILMuS.rj2xl3y', '2', NULL, NULL, NULL, NULL, '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'LdTO5qjwspxPAkYwLUr7MRnu85xEr2VisrmYU8O9s0BivLw5HrwntOieBjMS', '2017-04-21 12:27:36', '2017-04-21 12:28:40'),
(63, 'No', 'Name', '', 'Bombay Couture', 'info@bombaycouture.ca', '$2y$10$Ssq1Ijc0qwF9WkfhmVpNleI2Q9O53QtairceI.4gvgNMVxq4Xb2BS', '2', NULL, NULL, NULL, NULL, '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'rmACC114R6ezaGoE6JGjPwEpHdfHJ2HrYq4yKlnf8Udre0w3K4n0aE9leykY', '2017-04-21 12:29:16', '2017-04-21 12:31:00'),
(64, 'No', 'Name', '', 'Aakarshan Fashion', 'user4@fake.com', '$2y$10$P6jcEBtt9ta2V.YKEU7iner.RnWPc4T/L0zmFMBi8bPoeENwNhrei', '2', NULL, NULL, NULL, NULL, '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2Isa8qaKdMDtx4KElBPevZshgq0bqF6DcjSenzPuREd5etsxyzRw6AZUj5hP', '2017-04-21 12:32:42', '2017-04-21 12:34:04'),
(65, 'Raji', 'Name', '', 'Crossover Bollywood Se', 'raji@crossoverbollywoodse.ca', '$2y$10$KVGvenL7P1G7PTiYDyB6H.2D3fQtF4I3ME2TZwrPrNNZ8Ym3zQDYO', '2', NULL, NULL, NULL, NULL, '7', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-04-21 12:35:03', '2017-04-21 12:37:18'),
(66, 'justine', 'Name', '', 'Justines Bakery', 'justineslittlebakery@gmail.com', '$2y$10$EWF2UssH/LhmGNSLoGrvK.1pd/mS8gjuLADeFkV0VbgiK0H2mnGky', '2', NULL, NULL, NULL, NULL, '12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Zh2iSslK0GGBwMBd35rV6EClEdnqA8f4z5KqDWCSnjZmwr1evPD0OJltI9LZ', '2017-04-22 11:33:10', '2017-04-22 11:34:25'),
(67, 'Neeta', 'Name', '', 'Neets Treats', 'neeta@neetstreats.com', '$2y$10$eW.FvOC/2qUTsZZ1jl6ZTudF2I0Ckj7EihnaRZASo/Jhsub51rs0i', '2', NULL, NULL, NULL, NULL, '12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'mTwQM4fZPtcFzVFgm7iNZijUD66s9Ivd2Nox4Oxmkw8qcF7Gu0Deuxn1ux2r', '2017-04-22 11:36:00', '2017-04-22 11:42:44'),
(68, 'No', 'Name', '', 'Cakes by Anjan', 'cakesbyanjan@yahoo.ca', '$2y$10$wn6HgCynDCLeDK5TW1at4OUH2AgTd1oN2x.SigLf0wlC3JLEuCaR.', '2', NULL, NULL, NULL, NULL, '12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ogH2stVLxmbwQygth3UK7PsgRBAXPtCDX37S6W5ImidcxF6NBw8Qx5sirwur', '2017-04-22 11:50:26', '2017-04-22 11:53:10'),
(69, 'No', 'Name', '', 'Wedding Card Boutique', 'info@weddingcardboutique.com', '$2y$10$ZUTwvmuglh9l4P5nzsL5Zu3N01Jgg5WsDxx8R/IP.zWn68zzUi.KC', '2', NULL, NULL, NULL, NULL, '13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'TWPFy9T3k1QaXXmbWk3VMQLdeEIbWdRHCbtvsuPGQG6GMZNEQiZlVfr73spA', '2017-04-22 12:00:50', '2017-04-22 12:14:50'),
(70, 'No', 'Name', '', 'Kohaly Printing', 'info@kohalyprinting.com', '$2y$10$nv66XYWKFRDS75RUGyDOH.z9zZqQ/EYo/fFyEqYXM7xleoQGc39hG', '2', NULL, NULL, NULL, NULL, '13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'EG8FwbdB5zNla78eTg4oHEtVCLtYYhRsupCHX3CHSt4XS805O6499IccNN7a', '2017-04-22 12:23:06', '2017-04-22 12:27:00'),
(71, 'No', 'Name', '', 'Indian Wedding Invitations', 'sales@indianweddinginvitations.ca', '$2y$10$Dtxek1wr/ksuPIVqNGZXE.WAs9OTmxBPEYMUfWWhZ6vwvKJWN2P66', '2', NULL, NULL, NULL, NULL, '13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'RyaqDDL5A9EJB8qrddM4NHR65NDbJpp85BxvB6uPOn5K5AbRX4e1DNWdrSqq', '2017-04-22 12:28:50', '2017-04-22 12:31:28'),
(72, 'No', 'Name', '', 'Lux Wedding Invitations', 'user10@fake.com', '$2y$10$v9dsD.XOQnU1dpUBgHZWt.hf.A10EsDeM19JTva/PxQvjqFTmZu1W', '2', NULL, NULL, NULL, NULL, '13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Jc9LkGLCefjtJChzc9BGhpnlLhcOeHm8Wr6CUD9CDFfsF3qt8BSnm7qHx8NR', '2017-04-22 12:39:20', '2017-04-22 12:42:17'),
(73, 'No', 'Name', '', 'Delta Wedding Centre', 'info@deltaweddingcentre.com', '$2y$10$YO/acDlf3Yi/QzcyVJMqFe2YiVQQ49lPiyVIImQV/jBtuWlMYdK1S', '2', NULL, NULL, NULL, NULL, '13', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'n2wtsM5xzFOQ0ZqemxTp5Gmiiw67oAxNdVRtNogks4FW6ACOCG4TPTHRNf5h', '2017-04-22 12:46:05', '2017-04-22 12:48:32'),
(74, 'No', 'Name', '', 'Band Bhaja Entertainment', 'info@bandbajhaentertainment.com', '$2y$10$0n5Wb8Vlqsn6YIQywPlHI.w9zz4QsJgD6.MlO3X0felqYUXFvzctm', '2', NULL, NULL, NULL, NULL, '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'iILJcuVshlxjwJSGVm7SUNr3bZ33ld1bz7vMp6S7mF4cO5th1aQQwlIzaf06', '2017-04-23 07:33:59', '2017-04-23 07:35:55'),
(75, 'No', 'Name', '', 'Vancouver Break Dancers', 'boss@vancouverbreakdancers.com', '$2y$10$TZNIPnRGSDZYLJJrtsLlJeC7qYlQyY/b4N9XI3oVK06BCgvI3WdYe', '2', NULL, NULL, NULL, NULL, '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'dQRDLJdoLmOna7y1npNKxBd2Fz7cDnib43uDZX1VwogwN8pvGmrygBmJ07tZ', '2017-04-23 07:38:00', '2017-04-23 07:40:09'),
(76, 'No', 'Name', '', 'Now or Never Crew Break Dancers', 'non@nowornevercrew.com', '$2y$10$aNo.BhmMfTD5N.ppZLstFeUJwHraPPBx6/YqjwaiWK0ZwQCzHcvXm', '2', NULL, NULL, NULL, NULL, '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'hQAH6SeWPqDVdmGZvCzHfpUfrl3mzYlwUC4DlstYRtkkdxpwD1muR02PW1kL', '2017-04-23 07:41:57', '2017-04-23 07:45:24'),
(77, 'No', 'Name', '', 'Lana Belly Dancing', 'lana.bellydance@gmail.com', '$2y$10$QqdCLYojpjY9KyMFxyZC0ObkR4SVWtxI12kdhg1bZp351wNmwUADO', '2', NULL, NULL, NULL, NULL, '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'lYW5wVdZhjD3Qk5UcNKufqiD4ia8n874TDpAwnxaH0QxgGuL9iJ0FtyaBNDf', '2017-04-23 07:46:12', '2017-04-23 07:50:12'),
(78, 'No', 'Name', '', 'Zahra Bollywood Dancer', 'user11@fake.com', '$2y$10$CFViscVWcNba6ztew9Vo5uDMa4K4A7tLsvNrk4OQWQYh9h0hVUcA6', '2', NULL, NULL, NULL, NULL, '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ctAETWKgRRl77Bsk07ImJ5j40D8r7jv7cl15M8o2rG1Yomc4rOtY8Bx3Xwci', '2017-04-23 07:52:56', '2017-04-23 07:56:02'),
(79, 'No', 'Name', '', 'Chameleon Entertainment', 'info@chameleonentertianment.ca', '$2y$10$5YMjox9FHXkMHEzkv/G.Me4250Fu8OXt4yhEGR1ePQ4V0NPHq0hUW', '2', NULL, NULL, NULL, NULL, '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'A5xNLw9C7Pz3eyhF9EnLUuWdvulqhJLuQSqWSWcBSsL8G2Par38XtxpBz7fY', '2017-04-23 07:57:28', '2017-04-23 08:03:04'),
(80, 'No', 'Name', '', 'Impressions Live Art', 'info@impressionsliveart.com', '$2y$10$.YOuue0hMlwI8sKrF3VfguqLLEPJj.zouHyHtT.mBmwQs8..Xfwte', '2', NULL, NULL, NULL, NULL, '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'HzEUaMvBHim4JfZcVvlnfmTeN78v9FRRWElU3PgJ7Zj9zo7TijuR4LxHwugs', '2017-04-23 08:05:05', '2017-04-23 08:11:38'),
(81, 'No', 'Name', '', 'Lavish Liquid Event Bartending', 'info@lavishliquid.com', '$2y$10$QH/BKms48wCr6a6wwIbVvebX8eRcbyyqEJnJKFfCbDjz8YtZ5pZCC', '2', NULL, NULL, NULL, NULL, '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kix5MZZkxXnWJjA0RP9XRxzgKBROsLE9CCTLBQpooJ3u0dgyDuTX90VPcR3N', '2017-04-23 08:16:28', '2017-04-23 08:19:37'),
(82, 'No', 'Name', '', 'Sarah Draws a Crowd', 'info@sarahdrawsacrowd.com', '$2y$10$pKwvjOd7kX.IOq0hucnUEeX2E28gtSVcVeNMclJtLtx18lIrXu11y', '2', NULL, NULL, NULL, NULL, '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'vcSGBZCkAXnNnsxRTFer2SlFBmHRSY1OeC2gxZWx8ya7GUWrhGE5KQcmK4OS', '2017-04-23 08:20:47', '2017-04-23 08:24:36'),
(83, 'No', 'Name', '', 'Shan E Punjab Bhangra Group', 'jatinder@spacbc.com', '$2y$10$kqsG5Lx5x7IvWn5zAjF1YuxqJxGjBL5VX97UsB5Cmx6JrA4cgYaGm', '2', NULL, NULL, NULL, NULL, '9', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'qQzfnuM5MqWVHlJgTpuzzbys9gU9581M17ZMfrC5zrgvBp6QmbTUmG5JNpa4', '2017-04-23 08:27:00', '2017-04-23 08:30:51'),
(84, 'No', 'Name', '', 'Kavita Mohan Event Planning', 'info@kavitamohan.com', '$2y$10$u1GBj7xEA5fZEUUiO5itW.O0kac0IIsTF1ZaqV5w2LTOXqURDA5kG', '2', NULL, NULL, NULL, NULL, '16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'pMs1S81y36xm5TE2gh516gbpY7jyUyFOL50uAAcNEOcWNZDIc807VbbwgXjY', '2017-04-23 10:15:21', '2017-04-23 10:19:25'),
(85, 'No', 'Name', '', 'Always and Forever Weddings', 'info@alwaysandforeverweddings.ca', '$2y$10$hqwmlWxoy2WZVJLRySYMu.OSvjL5wCY.XaqgSCBVl79bb4bLbgOd.', '2', NULL, NULL, NULL, NULL, '16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Zwol44kh5X8X4Eavq1oDMbgxplm6wqIDrqhdt9h8HD4wxIQanvmjYoLD7qJB', '2017-04-23 10:20:12', '2017-04-23 10:28:55'),
(86, 'No', 'Name', '', 'Alicia Keats Wedding and Events', 'info@aliciakeats.com', '$2y$10$UIiDV06iJ8/vae3NZIp70OuXAoNVIQk0af4E3YYiEM/LQfkoklqSi', '2', NULL, NULL, NULL, NULL, '16', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '1PziC56wbsu4HbCm8drRWmXfYcmYc8oPjppV8fRiMjuM8sFWphJCVxfhijYP', '2017-04-23 10:30:40', '2017-04-23 10:33:50'),
(87, 'No', 'Name', '', 'Fatma Studio', 'fatmamehendi@yahoo.ca', '$2y$10$KZQwh.PxF.K9I9eSGXsrmeg4tEd1SoLP0U4vn6HKn9v5RSGjEwGxy', '2', NULL, NULL, NULL, NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'NbXilSG4G0jg3SsmfnHSzxyUlzIM5wpEQ7G0XneIZUJZxASoofsgg4D9XW2P', '2017-04-23 10:47:59', '2017-04-23 10:52:03'),
(88, 'No', 'Name', '', 'Sonika''s Henna Art', 'sonikashennaart@gmail.com', '$2y$10$E9cWTPrcQzNGO2pqVsum3ODirtBFCrzHrKoqnZGhRKDx9rCXx13D.', '2', NULL, NULL, NULL, NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'rj54BXYiJulasPopiHlmj80qU9nwrrx0fPEMtkLWh4TtFm5mPSZXL2f43TMh', '2017-04-23 10:53:09', '2017-04-23 10:56:22'),
(89, 'No', 'Name', '', 'Almas Bridal Henna', 'user12@fake.com', '$2y$10$eYNMqfqY6CbEFfyHQZyH9OLGTfEctUCkM4d9UPtF8c9UTzSnlfR7.', '2', NULL, NULL, NULL, NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'OvJs5qBozS7E38tTRPkcqvFmnrRIYEEryx9s3uCilzJ6JmtVbyB18b068w1Y', '2017-04-23 10:57:21', '2017-04-23 11:00:50'),
(90, 'No', 'Name', '', 'Maharani Mehendi', 'maharanimehendi@gmail.com', '$2y$10$mcTBGBqV4sH9JdRtiC5sDOKT.mLVDzlcL/Rcz5k84KgmKKpVb2aoK', '2', NULL, NULL, NULL, NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '953NJHIS5KnCXBE74Nzw2ItV61jJ8cHqACnOF7g8Yb4SVjIcJKgrpH6VKjoM', '2017-04-23 11:01:37', '2017-04-23 11:05:02'),
(91, 'No', 'Name', '', '604 Mehndi by Farhath', 'info@604mehndi.com', '$2y$10$71GcV6oQgUDxZxZr6kkNv.d/.EF3LgjvJnhR/EoShiKVttf.9elzq', '2', NULL, NULL, NULL, NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'SnbjVQKadX33IWmYH076wzrpwgDnhQaozcl3oeVAffRP4Ct7pyM6aJbBSXtz', '2017-04-23 11:05:47', '2017-04-23 11:08:07'),
(92, 'No', 'Name', '', 'Munira''s Mehndi', 'muniramotani@yahoo.com', '$2y$10$quRbOs5l6VcKPzL/E.cDUO5sd.JrIYGAVKYVntRSJZePxdWKiB932', '2', NULL, NULL, NULL, NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-04-23 11:09:34', '2017-04-23 11:14:02'),
(93, 'Gurm', 'Sohal', '', 'Gurm Sohal', 'mywedding@gurmsohal.com', '$2y$10$de8BTyEu5HWMMtE/7eiMDuulMJLPFon1Q/iVd3tCiUf1Uc1/hcJ2q', '2', NULL, NULL, NULL, NULL, '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'YV6E6VR8gV1Gny74GQkZFZvsW7wTGIK718EyamDaUlIzJeF6BuwnFSJB7C9G', '2017-04-24 07:10:43', '2017-04-24 07:12:51'),
(94, 'No', 'Name', '', 'Deo Studios', 'info@deostudios.com', '$2y$10$cXxHfdbpDNWqBsU61grWweIWhGP/e7Gj/vm2nqk8xUomWOc2fx.cW', '2', NULL, NULL, NULL, NULL, '4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'ocjhojZ2zmO9aoXIERRTt38q8zWAV84MrqGkFNgrbiaS85uMtOAnpOnulQfa', '2017-04-24 07:16:08', '2017-04-24 07:18:32'),
(95, 'a', 'a', '', 'Test Video1', 'ap@a.com', '$2y$10$6AFemnHcMpJuKUf/7aqx/.eqCYySznihlusEkvIS1TAB3cbPySAPK', '2', NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Uvf06j40510AqAMlfYmZGyvUzpurKR1TzNbQZFwWNhPzgO6x2rLiqTUHwB2H', '2017-04-24 09:07:48', '2017-04-24 09:08:16'),
(96, 'a', 'a', '', 'Test Video 2', 'a@asd.com', '$2y$10$rUWkr9ynNm1wLP8zSb/jAubfE6V8XPoNa0pps58sET2BpTFj.og3a', '2', NULL, NULL, NULL, NULL, '5', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-04-24 09:09:15', '2017-04-24 09:09:34'),
(97, 'No', 'Name', '', 'Aria', 'info@ariabanquet.ca', '$2y$10$kl42F2/AYSAfULWAgEErpOrpbtRaStGyFVReksPjwT2xxcWknf8ri', '2', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'DSluMbxGpwSB3XQ3r3BbHllOOomXfZ7wYfqvmEyhHdxTNyuaMSZzCwUhmHqC', '2017-04-25 06:58:13', '2017-04-25 07:03:00'),
(98, 'No', 'Name', '', 'Crown Palace Banquet Hall', 'ssmann@crownpalace.ca', '$2y$10$pQk5Vc5dJuKvRTi8h.5TmOuhrq.y1L2HvVFOU/TfAzERw9mH9UXJG', '2', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'wIfA7TrCB4ebylEba6ZjSz7th9CS1KIBq6MdvcPuqi68pRvqMBUJBMxDHHZW', '2017-04-25 07:05:39', '2017-04-25 07:16:21'),
(99, 'No', 'Name', '', 'Dhaliwal Banquet', 'user13@fake.com', '$2y$10$350ABBV3mInu5uRcKCiqz.qXg5K1OFNpuDzwP8eJ3WNJ57nXDqPw2', '2', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'UVp273TqcPs3FLhW5KHRFVOxjdxCcmMU1MNv1NV9W0ximoAEMkDd2FhexjTP', '2017-04-25 07:19:17', '2017-04-25 07:20:55'),
(100, 'No', 'Name', '', 'Bombay Banquet Hall', 'info@bombaybanquethall.com', '$2y$10$afcF3XuvrQoAJIeyI.5v8uDDphNn57kpK2wlCa./dnvHREW.W6CTq', '2', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'PJb44zfkXKHY6hv5YMITnzXwLMZ635p87gbLnRvqogVvvXSgu8Idee6SAIci', '2017-04-25 07:21:51', '2017-04-25 07:35:04'),
(101, 'No', 'Name', '', 'Crystal York', 'info@crystalatyork.com', '$2y$10$7TYLZOf.o4e/dWVrLS8fPex/NaysqQM/ZKO28w7MZ.eVr9YFFz45O', '2', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'hMjZF2KhVDcW7jiY70zqxXL4XTVSdY3iUezKZDyGAz75NTQyp4FgiR3Eg9dc', '2017-04-25 07:35:47', '2017-04-25 07:42:51'),
(102, 'No', 'Name', '', 'Fraserview Hall', 'info@fraserviewhall.com', '$2y$10$48hQx06bT9fXo1lPXTrnbuvD7kt8bDLiiZ6KQw7cs/0AckXNFQLBa', '2', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'FCbuQMCxPNymZua0UQ5BiJWMxC7CN3mltyGbVKaEAF6nsgoASCYdkl9dhg6a', '2017-04-25 07:43:35', '2017-04-25 07:50:17'),
(103, 'No', 'Name', '', 'South Hall', 'events@southhall.ca', '$2y$10$yMFteFTulsfLthEAZ4Is8un1qBod/6LXLM1jjJnFuA8Zb9lhnpiJK', '2', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'b7oc5CvSzBzUDOywrGJceoflKfI4NKNYLPTGuHmRjTX4ghqHge8PZSsyYjqB', '2017-04-25 07:50:50', '2017-04-25 07:52:17'),
(104, 'No', 'Name', '', 'Riverside Banquet Hall', 'info@riversidehalls.com', '$2y$10$BfGzseFU6FUGGRrbJMwXUeQtouxAZM/U66AzZbCRHr0Zu19q1WkZi', '2', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'l9YAa8DPf1NV5AbS8d9vKIsO3S8t0z9TtvSuRvDummjr4qGwJR6kVlPue8lz', '2017-04-25 07:53:06', '2017-04-25 07:59:24'),
(105, 'No', 'Name', '', 'Swaneset Bay', 'harmstrong@swaneset.com', '$2y$10$UL3Rv4V4s.NsTuFkZjecyO9qmhO3lP6NzpqxTk8stTEMAiKUmLDjK', '2', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'Ti0GwlOH3LzpJPeXNlOjh159tJvlRIC0zUFvNeqnPX3Y6jiPvnaT08R9Dz7F', '2017-04-25 08:00:27', '2017-04-25 08:06:19'),
(106, 'No', 'Name', '', 'Royal King Palace', 'info@royalkingpalace.com', '$2y$10$bf.dSm6/GLS5UHFGxIr1NOwLvBKTNzU2BxdM72NVbd6Wgc3ihqfD.', '2', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kzF8fpBWs7kns5PNdx5zmnQq5Xu3yoWtRos2uVKgykPgCw6sBMxFNn9V9FXM', '2017-04-25 08:09:46', '2017-04-25 08:14:39'),
(107, 'No', 'Name', '', 'Grand Taj', 'info@grandtaj.com', '$2y$10$Y2oOCWFGplO2sMOy7sPhq.yhtUDoghPf9irWVaTxLVSBeHiEBlPh6', '2', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'nhXWpxWqxvpE2TC5AeoaBA3TqUSOJsAWG0DUi3cHJHvoBHRRRRl4eKJxm5eI', '2017-04-25 08:23:17', '2017-04-25 08:35:43'),
(108, 'No', 'Name', '', 'Mirage Banquet Hall', 'user15@fake.com', '$2y$10$7OJqKwM24dNYD54QlC3/BOre9eNbGpo0nBkNRD1aem647BpB.jslm', '2', NULL, NULL, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'kiitCPfLmTJcpYNUiciH5yIy8SJeVuFcCL8u97RETZ1aw2NKzH50xOzAsyWC', '2017-04-25 08:36:49', '2017-04-25 08:41:06'),
(109, 'no', 'Name', '', 'Transport2', 'transport1@t.com', '$2y$10$J4cBWQd6rHt.DBXSTEH4gOfiTmFR8lG/1U46Pv2T2tuNWWgFPEtZW', '2', NULL, NULL, NULL, NULL, '17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'OWBWJ9JUGTtOtwvbHqwHmQhTdSiXUgN6yR9YgIeLWjsjoyldT1ETGX81N6ye', '2017-05-05 13:39:34', '2017-05-05 13:39:54'),
(110, 'No', 'Name', '', 'Offciant 1', 'off1@off.com', '$2y$10$H4WHch5.703CUWiEMTpWjuK0e845yWHH1Gnamxjpql0p0Tk3Vrhne', '2', NULL, NULL, NULL, NULL, '15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 'YB6ixYkitjpR8z72KYoUZeY3P1tm1wS8ZWCon8iEozjTxULDH3RI0UtfaaSg', '2017-05-05 13:41:10', '2017-05-05 13:41:25'),
(111, 'Off', 'Name', '', 'Officiant 2', 'off2@off.com', '$2y$10$TapJTXkwDRZk5kIE9emeMe3IWlz3AdzXIBtedbP8LdBbIyrMNYXFK', '2', NULL, NULL, NULL, NULL, '15', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2017-05-05 13:43:05', '2017-05-05 13:43:05');

-- --------------------------------------------------------

--
-- Table structure for table `user_comments`
--

CREATE TABLE IF NOT EXISTS `user_comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `profile_pic` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `user_comments`
--

INSERT INTO `user_comments` (`id`, `name`, `description`, `profile_pic`, `created_at`, `updated_at`) VALUES
(1, 'John Smith', 'Sales coaches will be able to lead more reps and provide more focused and valuable coaching through the use of automated sales analytics from companies like ClearSlide', '1490193134442029.png', '2017-03-22 21:32:14', '2017-04-24 08:42:57'),
(2, 'John Geo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tortor nisi, finibus vitae sollicitudin in, viverra id metus. Fusce orci sapien, gravida in nulla ac, tristique dapibus turpis. Praesent ut purus mauris. Vestibulum congue eros purus, ac porta ipsum accumsan in. Sed condimentum diam dui, vitae dignissim libero molestie eget.', '1490270655481718.png', '2017-03-23 19:04:15', '2017-03-23 19:04:15'),
(3, 'John Geo', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce tortor nisi, finibus vitae sollicitudin in, viverra id metus. Fusce orci sapien, gravida in nulla ac, tristique dapibus turpis. Praesent ut purus mauris. Vestibulum congue eros purus, ac porta ipsum accumsan in. Sed condimentum diam dui, vitae dignissim libero molestie eget.', '1490270684324793.png', '2017-03-23 19:04:44', '2017-03-27 12:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_inforamations`
--

CREATE TABLE IF NOT EXISTS `vendor_inforamations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `contact_email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` int(10) DEFAULT NULL,
  `address1` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address2` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pincode` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area_code` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` bigint(20) DEFAULT NULL,
  `website_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `instagram_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_me` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `vendor_inforamations_user_id_foreign` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=101 ;

--
-- Dumping data for table `vendor_inforamations`
--

INSERT INTO `vendor_inforamations` (`id`, `user_id`, `contact_email`, `category`, `address1`, `address2`, `city`, `state`, `country`, `pincode`, `area_code`, `phone_number`, `website_url`, `facebook_url`, `instagram_url`, `twitter_url`, `youtube_url`, `about_me`, `created_at`, `updated_at`) VALUES
(1, 2, 'test@test.com', 1, NULL, NULL, 'Toronto', 'Ontario', 'Canada', NULL, NULL, NULL, 'http://www.yahoo.com', 'http://www.microsoft.com', 'https://www.instagram.com/blizzard_fans/', 'https://twitter.com/blizzard_ent', 'https://www.youtube.com/user/blizzard', 'Amazing game. Blizzard hit it out of the park with this one.\r\n\r\nThis is a team based match shooter game. Which means there''s no story or single player. It only consists of online play with other people in matches. You choose a hero from a decent selection and are put in one of two teams with a different goal depending on the match type. There are 21 total heroes to choose from and each focuses on a different role (broken down into groups of Attacker, Defender, Support, Healing)\r\n\r\nThis is definitely a team based game, so while a great player can influence a match he can''t win it by himself. What sets this game apart from a similar role-style team shooter game like CS or TF2 is that each character get''s a super move called an ULT that does a wide range of things from being a super attack, to reviving team mates, seeing through walls. This adds a lot of flavour and strategy to the game and balances things out for attacking and defending teams.\r\n\r\nLots of fun, updated frequently with new maps, items, and competitive seasons it''s definitely a must try for any avid gamer.', '2017-03-04 01:35:02', '2017-04-28 21:04:37'),
(2, 3, 'info@goldentreejewellers.com', 18, '215 Willowbrook Shopping Centre ', '19705 Fraser Hwy', 'Langley', 'British Columbia', 'Canada', 'V3A7E9', '604', 5307221, 'https://www.goldentreejewellers.com/', 'https://www.facebook.com/GTJewellers', 'https://www.instagram.com/goldentreejewellers/', 'https://twitter.com/GTJewellers', NULL, 'At Golden Tree Jewellers our most valuable asset is you - The Customer \n\nEveryday my staff and I take any and all necessary steps to reach our goal of making YOU number one. Without customers like you, we wouldn''t exist. If, for some reason, we have failed our daily goal, please tell me and I will make any problem disappear and of course when we have succeeded, please tell all of your friends. Many thanks for your patronage. \n\nChandulal Bhindi ', '2017-03-21 11:40:06', '2017-03-21 15:00:37'),
(3, 4, 'suki@sukisflowers.com', 3, '16695 92a Ave', NULL, 'Surrey', 'British Columbia', 'Canada', 'V4N 0C7', '604', 7240396, 'https://sukisflowers.com/', 'https://www.facebook.com/sukisflowers/', 'https://www.instagram.com/sukisflowers/', 'https://twitter.com/sukisflowers', NULL, 'In business for over 10 years, and a trusted florist based out of Surrey, BC; Suki’s flowers offers clients personalized and unique floral arrangements for weddings or special events. \r\n\r\nSpecializing in wedding floral arrangements, we are committed to making floral arrangements which compliment your desired style by beautifully arranging flowers that suits your flair. . Dependability, creativity and attention to detail are just a few of the qualities that make Suki’s Flowers “the go to” florist for clients all over the lower mainland. We also offer reliable and on time delivery service to clients in the lower mainland.\r\n\r\nSuki’s Flowers now offers clients the option of preserving floral bouquets and keeping other wedding memorabilia such as photos, invitations, and other special items for a life time in a personalized and custom made memory box. The boxes are artistically and elegantly arranged with the desired items in frames selected by the clients just the way they have visualized preserving the memories of their special day for a lifetime.', '2017-03-21 12:53:49', '2017-04-18 13:15:01'),
(4, 5, 'info@wearmodello.com', 10, 'Unit 2, 8555 Scott Road', NULL, 'Delta', 'British Columbia', 'Canada', NULL, '778', 2421038, 'http://wearmodello.com', 'http://facebook.com/wearmodello', 'http://instagram.com/wearmodello', NULL, NULL, 'Modello Bespoke Suiting is a Vancouver based company offering Bespoke Tailoring and \r\nLuxury Custom Suiting services to the modern day man who appreciates quality craftsmanship, \r\nunique fabric and attention to fit and detail.\r\n\r\nWith wools from Italy, England and Australia, all Modello suits are handmade in Mumbai, India.\r\n\r\nEach suit’s design – from the type of lapels to surgical cuffs, are personalized for the client, \r\noffering timeless quality and the perfect fit.', '2017-03-24 10:31:01', '2017-04-16 12:07:39'),
(5, 7, NULL, 6, '1111 West Georgia Street', NULL, 'Vancouver', 'British Columbia', 'Canada', 'V6E 4M3', '123', 4567890, NULL, 'a', 'www.blizard.com', 'www.microsoft.com', 'https://www.microsoft.com', 'We make windows software', '2017-03-26 02:48:35', '2017-03-26 04:33:14'),
(6, 8, NULL, NULL, '1111 West Georgia Street', NULL, 'Vancouver', 'British Columbia', 'Canada', 'V6E 4M3', '123', 4567891, NULL, NULL, 'www.blizzard.com', 'microsof', 'asdasd', 'I am an new bridal wear vendor', '2017-03-26 05:22:25', '2017-03-26 05:22:25'),
(7, 9, NULL, NULL, '1111 W Georgia St', NULL, 'Vancouver', 'British Columbia', 'Canada', 'V6E 4G2', '123', 1234567, NULL, NULL, NULL, NULL, NULL, 'New Test Vendor', '2017-03-26 08:17:10', '2017-03-26 08:17:10'),
(8, 10, NULL, 10, '123 W Street', NULL, 'Vancouver', 'Alberta', 'Canada', '3v2 17b', '123', 1234567, 'www.apple.com', NULL, 'www.blizard.com', 'www.blizard.com', 'www.blizard.com', 'Hello', '2017-03-26 10:12:31', '2017-03-26 10:20:18'),
(9, 11, NULL, NULL, '1111 W Georgia St', NULL, 'Vancouver', 'British Columbia', 'Canada', 'v5w 3b2', '123', 1234567, NULL, NULL, NULL, NULL, NULL, 'New Vendor', '2017-03-26 10:23:09', '2017-03-26 10:23:09'),
(10, 12, 'acme@jdogg.com', 18, '3421 Main Street', NULL, 'Toronto', 'Ontario', 'Canada', 'O2N 3P1', '123', 1234567, NULL, NULL, NULL, NULL, NULL, 'Shine bright like a diamond!', '2017-03-26 10:32:50', '2017-04-03 08:34:42'),
(11, 14, NULL, NULL, '1234 Main Steet', NULL, 'Edmonton', 'Alberta', 'Canada', 'e3b 2w1', '123', 1234567, NULL, NULL, NULL, NULL, NULL, 'I own lots of cars, for your renting pleasure', '2017-03-28 02:17:33', '2017-03-28 02:17:33'),
(12, 15, NULL, NULL, '321 Waterloo Street', NULL, 'Vancouver', 'British Columbia', 'Canada', 'v6j 5k8', '123', 1234567, NULL, NULL, NULL, NULL, NULL, 'New Catering', '2017-03-28 02:21:49', '2017-03-28 02:21:49'),
(13, 23, NULL, NULL, '135 - 13711 72 Ave', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 2P2', '604', 5967511, 'http://www.surreyflowershop.net/', 'http://www.facebook.com/pages/Surrey-Flower-Shop/458854094270702?rf=165775956854168', 'http://www.instagram.com/surreyflowershop/', NULL, NULL, 'Surrey Flower Shop has been proudly serving the residents of Surrey area for over 25 years. We are family owned and operated and are committed to offering only the finest floral arrangements and gifts, backed by service that is friendly and prompt. Because all of our customers are important, our professional staff is dedicated to making your experience a pleasant one. That is why we always go the extra mile to make your floral gift perfect.', '2017-04-18 13:25:52', '2017-04-18 13:25:52'),
(14, 24, NULL, 3, NULL, NULL, 'Ladner', 'British Columbia', 'Canada', NULL, '604', 3469856, 'http://www.amazingkeepsakes.ca/', 'https://www.facebook.com/Amazing-Keepsakes-129941870384433/', 'https://www.instagram.com/amazing_keepsakes/', 'https://twitter.com/AmazinKeepsakes', NULL, 'It was approximately 12 years ago when Jessica wanted to preserve her wedding bouquet and could not afford to. The thought of preserving her bouquet stayed with her seeing others friends and families keepsakes. The wedding card was under the bed, her tiara sitting in the washroom collecting dust and the wedding album somewhere in the house? (Yes the album, there was no digital anything then). It was an evening when her sister came home with her preserved wedding bouquet a few months after her wedding that prompted Jessica to launch Amazing Keepsakes, specializing in freeze drying wedding bouquets, funeral flowers and special – occasion flowers. Today, Jessica attends and exhibits her product at numerous bridal shows and enjoys meeting new customers and making friends in the process.\r\nServing clients with special event flowers, Amazing Keepsakes offers brides the ability to keep their actual wedding bouquet!\r\nAmazing Keepsakes prides itself on quality and individualized attention, allowing brides the flexibility they need at one of, if not the most, stressful times in their lives. We are a small, owner-operated business with quality on our minds.', '2017-04-18 13:41:02', '2017-04-18 13:42:49'),
(15, 25, 'info@sunflowerflorist.ca', NULL, '1359 Richards St', NULL, 'Vancouver', 'British Columbia', 'Canada', 'V6B 3G7', '604', 6767677, 'http://sunflowerflorist.ca/', 'https://www.facebook.com/sunflowerflorist', 'https://www.instagram.com/vancouverflorist/', 'https://twitter.com/VancouverFlower?ref_src=twsrc%5Etfw&ref_url=http%3A%2F%2Fsunflowerflorist.ca%2F', NULL, 'At Sunflower Florist, we believe in staying focused on the quality of our designs while staying within the budget. We love designing flowers and our unique designs reflect our client’s vision. Whether you are looking for an elegant and luxury design , timeless traditional, modern chic, vintage or a simple design, we can custom design your floral orders along with creative details that reflect your unique style and stay within your budget. We are experience in creating grand floral designs to make your special day unforgettable. Our designs are impeccable, innovative, and are unique to each client . We take pride in our floral masterpiece and our exceptional service which is reflected in the positive reviews left by our clients.\r\n\r\nWe cater for all occasions such as Weddings, Funerals, Corporate events, Galas, Anniversaries and Birthdays. As not one order is the same, we take the time to discuss your individual requirements.', '2017-04-18 13:49:12', '2017-04-18 13:49:12'),
(16, 26, 'info@reelsilks.com', 3, '8250 Fraser St', NULL, 'Vancouver', 'British Columbia', 'Canada', 'V5X 3X7', '604', 3225707, 'http://www.reelsilks.com/', 'http://www.facebook.com/Reelsilks', NULL, NULL, NULL, 'Our distinctive décor is known for creating extraordinary environments. Whether you’re looking for one item or enough to fill a full banquet room, we have everything from linens, vases and table accents, to specialty trees and theme props as well as much, much more.\r\n\r\nAt Reel Silks we work extremely hard to provide each client with something a little bit different and special so that every event has it’s own special flair and personality. Working with both industry professionals as well as directly with event hosts and brides we are available to assist with small private functions or large extravagant affairs.\r\n\r\nWhether you come to us with your own ideas and concepts or we assist you in creating the design we will work together to create a truly memorable experience.\r\n\r\nWith an exceptional design team, our dedicated staff and talented designers work together to create extraordinary environments.', '2017-04-18 13:53:57', '2017-04-18 13:54:14'),
(17, 27, NULL, 3, NULL, NULL, 'Surrey', 'British Columbia', 'Canada', NULL, '604', 8663434, 'http://didisflowers.com/', 'https://www.facebook.com/didisflowers', 'https://www.instagram.com/didisflowers/', 'https://twitter.com/didisflowers', NULL, 'My name is Raj Bains, owner/operator of Didi’s flowers. I started my business in 2007 after completing commercial floristry program at Kwantlen Polytechnic University. My passion for design and love for flowers made starting a business that much easier. As the business grows, so do my skills.  I love to learn, I’m always updating my skills by attending symposiums and learning new skills and techniques by designers from around the world.  Over the years, my work has been featured in the WedLuxe magazine as well as Real Weddings.  I have also been honoured with a few awards.', '2017-04-18 13:58:17', '2017-04-18 13:58:42'),
(18, 28, 'info@bootahjardin.com', 3, NULL, NULL, 'Surrey', 'British Columbia', 'Canada', NULL, '604', 5031593, 'http://www.bootahjardin.com/', 'https://www.facebook.com/Bootah-Jardin-Florists-1420399511509274/', NULL, NULL, NULL, 'Thank you for considering Bootah Jardin for your event and wedding floral needs!\r\n\r\nWe are a licensed family-run business in Surrey, BC, and we specialize in do-it-yourself event and wedding flowers in the greater Vancouver area. Our mission is to connect customers looking for bulk flowers with the products they need.\r\n\r\nIf you’ve decided to DIY your own wedding flowers but don’t know where to start, you’ve come to the right place. In addition to the floral products we sell through our online store, we’ve also compiled numerous tips and demos to help you get started. As huge fans of the DIY movement, we’re dedicated to assisting brides and grooms in the Vancouver area understand what’s possible (and budget-friendly!) for their special day.', '2017-04-18 14:01:46', '2017-04-18 14:02:13'),
(19, 29, 'info@destinationornot.com', NULL, '21137 43 A Ave', NULL, 'Langley', 'British Columbia', 'Canada', 'V3A 8L8', '604', 5101260, 'http://destinationornot.com/', 'https://www.facebook.com/Destination-or-Not-Bridal-Bouquets-363643960320926/', NULL, 'https://twitter.com/realtouchbridal', NULL, 'Destination or Not is a faux floral studio in Langley, BC. We specialize in Real Touch Flowers / Natural Touch Flowers for weddings that look and feel incredibly realistic. Floramatique® real to the touch flowers are fade-resistant, waterproof, and crush proof (yes, you can pack them in your suitcase!). They will maintain their colour, texture and beauty for years to come- giving you a wonderful keepsake from your special day. It is your choice – tell people or not… if you do, they will likely not believe that your bouquet is not fresh flowers!\r\n\r\nWe work closely with each of our clients via telephone and email to ensure that we create the wedding flowers of your dreams! Each wedding bouquet, boutonniere and corsage is arranged by hand in our Langley floral studio.\r\n\r\nWe are very choosy about the flowers that make it into our bridal bouquets so in order to avoid disappointment, we need as much time as possible to order from our suppliers as sometimes, their most popular choices are backordered. Request a custom bouquet or feel free to browse our online real touch flower shop.', '2017-04-18 14:05:16', '2017-04-18 14:05:16'),
(20, 30, 'info@rococofloral.ca', 3, NULL, NULL, 'Vancouver', 'British Columbia', 'Canada', NULL, '604', 6525131, 'http://www.rococofloral.ca/', 'https://www.facebook.com/rococofloral/', 'https://www.instagram.com/rococofloral/', NULL, NULL, 'Founder and Principal Designer, Gala, started floral arranging as a hobby and it eventually grew into a lifelong passion. Throughout the years, she has completed various floral arrangement programs and certifications to enhance her knowledge of the industry, \r\nas well, being up-to-date on the latest trends. \r\n\r\nShe founded Rococo Floral & Events in 2015, as a home-based business. Working out of her home, she aims to create exquisite wedding floral arrangements for couples who are looking for a \r\ncost-efficient yet experienced florist to fit their wedding budget.', '2017-04-18 14:08:56', '2017-04-18 14:09:38'),
(21, 31, 'info@weddingflowersvancouver.com', 3, NULL, NULL, NULL, 'British Columbia', 'Canada', NULL, '604', 8130157, 'http://www.weddingflowersvancouver.com/', 'https://www.facebook.com/katsuradesigns/', 'https://www.instagram.com/katsuradesigns/', NULL, NULL, 'loral Design, Event Decor and Planning have been our full-time passion for many years. We absolutely love seeing people''s faces when they first walk into the Ceremony or Reception venue after we have decorated it. Their laughter, their happy tears, their joy, it makes us love what we do.  There is  nothing greater than being able to share a happy moment with our friends and clients. Most especially, being a part of a couple''s wedding day. It is something so incredibly special for us, and we will do our best to exceed your expectations and dreams. \r\n\r\nWhen your wedding day arrives, you will be able to enjoy it without worrying about the set-up, the take-down, the details, etc. Everything will be taken care of, so you can start your "happily ever after" with a big smile on your face.', '2017-04-18 14:11:53', '2017-04-18 14:12:03'),
(22, 32, 'denise@halfyarddesigns.com', NULL, NULL, NULL, 'Richmond', 'British Columbia', 'Canada', NULL, '604', 8123925, 'http://www.halfyarddesigns.com/', 'https://www.facebook.com/halfyarddesigns/?hc_location=ufi', NULL, NULL, NULL, 'Denise developed a passion for flowers from her first flower shop in a small northern BC town and quickly discovered she has an eye for design. Now, over ten years later, after working with the lower mainland’s top florists, Denise is now an independent designer, doing what she truly loves to do.\r\n\r\nDenise hails from the Tsimshian and Wet''suwet''en. As a First Nations entrepreneur in Vancouver, Denise has made her mark in the wedding industry and in Aboriginal business, after being awarded a BC Aboriginal Business Award in 2011, for Outstanding Achievement in a one to two person enterprise.\r\n\r\nDuring your complimentary consultation, Denise will walk you through your options of flowers and styles, and have you leaving confident that your event is going to be absolutely beautiful! Whether it''s a wedding, a gala or a birthday party, Halfyard Designs will deliver designs beyond your expectations.', '2017-04-18 14:18:11', '2017-04-18 14:18:11'),
(23, 33, NULL, 3, '2208 Hamilton Street', NULL, 'NewWestminster', 'British Columbia', 'Canada', 'V3M 2R1', '778', 8983569, NULL, NULL, NULL, NULL, NULL, 'Hi there I am Denise Hubick, Owner and Designer  of  JF Expressions I took a class with Joan Johnston School of Floral design back in 1985. Upon completion of that course , off I went to become a Florist.\r\nI spent many years at many different Jobs in and around the floral industry but now the time has come to follow my dreams .', '2017-04-18 14:22:20', '2017-04-18 14:25:18'),
(24, 34, 'coquitlamcentre@fransflowers.ca', NULL, '2929 Barnet Hwy', NULL, 'Coquitam', 'British Columbia', 'Canada', 'V3V 5R5', '604', 8393794, 'http://fransflowers.ca/', 'https://www.facebook.com/frans.flowersbc/', 'https://www.instagram.com/fransflowersabbotsford/', NULL, NULL, 'In 2011, after 20 years of working Downtown, Frans’ and his wife Sue, opened up fresh flower kiosks in shopping centres, transportation hubs and other locations. Bringing Fresh bouquets at amazing prices to Greater Vancouver, making fresh flowers affordable at everyday prices. Frans and Sue continue to build the business on 3 key elements:\r\n\r\n• Outstanding customer service\r\n\r\n• Fresh high quality flowers\r\n\r\n• And convenient “express” locations.\r\n\r\nFrans’ Flowers is a family owned & operated business, based out of Port Coquitlam. With retail locations in Coquitlam Centre Mall, Sevenoaks Mall and Downtown Vancouver. Even the youngest members of the family are sharing Dad’s passion for creating beautiful bouquets!!', '2017-04-18 14:28:27', '2017-04-18 14:28:27'),
(25, 35, 'Flowerellainfo@gmail.com', NULL, '2966 Coyote Court', NULL, 'Coquitlam', 'British Columbia', 'Canada', 'V3E 3A6', NULL, NULL, 'http://www.flowerella.ca/', 'https://www.facebook.com/Flowerella.Event.Florals/', 'https://www.instagram.com/flowerella_eventflorals/', NULL, NULL, 'Flowerella Event Florals and Coordination is a professional wedding florist and event planning company from Coquitlam, British Columbia. We service weddings throughout the local area, including Vancouver, Fraser Valley, and the Tri-Cities. We specialize in creating personalized floral arrangements and day-of wedding coordination to meet your vision and budg', '2017-04-18 14:30:58', '2017-04-18 14:30:58'),
(26, 36, 'riverandseaflowers@gmail.com', NULL, '4362 Tamboline Rd', NULL, 'Delta', 'British Columbia', 'Canada', 'V4K 3N2', '778', 8772224, 'https://www.riverandseaflowers.com/', 'https://www.facebook.com/riverandseaflowers/', 'https://www.instagram.com/explore/locations/483759308490380/', NULL, NULL, 'River and Sea Flowers is a local family farm growing certified organic flowers on beautiful Westham Island just outside Ladner BC, 30 km from Vancouver. The flower farm is run by Rachel Ryall with help from her husband, young children and extended family.\r\n​\r\n​We grow specialty cut flowers supplying florists, a CSA, our farmstand as well as DIY weddings and other events. Our flowers are grown with love and care from seed to bloom. We begin the season with seeds sown in the winter carrying right through till summer, with flowers arriving in the spring and overflowing into the fall.', '2017-04-18 14:35:57', '2017-04-18 14:35:57'),
(27, 37, 'info@divinevines.ca', NULL, '1024 Mainland Street', NULL, 'Vancouver', 'British Columbia', 'Canada', 'V6B 2T4', '604', 6960211, 'https://www.divinevines.ca/', 'https://www.facebook.com/riverandseaflowers/', 'https://www.instagram.com/explore/locations/483759308490380/', 'https://twitter.com/divine_vines?lang=en', NULL, 'Established in 2006 as Yaletown’s full service friendly upscale flower shop, nestled amongst the trendy clothing boutiques, spas and Vancouver’s finest restaurants. The beauty of the flowers in our windows will draw your attention as you pass by. You will find lush orchid plants amongst the freshest unique flowers available from our local & international growers. Our trendy website showcases creative, unique, chic European floral designs, exclusive to Divine Vines elegant style for everyday occasions, as well as specialty arrangements for wedding, funerals, graduation and corporate events. Your floral needs will be fulfilled whether it is for a special occasion or a custom design created especially for you.\r\n\r\nDivine Vines serves Vancouver’s West End and Yaletown districts, not to leave out the surrounding areas of Metro Vancouver.', '2017-04-18 14:38:15', '2017-04-18 14:38:15'),
(28, 38, 'redcarpeteventvan@gmail.com', NULL, '#123-12885 85th Ave', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 0K8', '778', 8666041, 'https://www.redcarpeteventsvan.com/', 'https://www.facebook.com/polly.polly.3139', 'https://www.instagram.com/redcarpetevents_van/', 'https://twitter.com/RCeventsvan', NULL, 'We specialize in large, luxurious, cultural affairs and offer all inclusive décor packages for ceremonies, receptions and pre-wedding functions. However no event or budget is too small — we also offer a la cate décor services and individual item rentals including chair covers, luxury table linen, centre pieces, chivari chairs, charger plates and more.\r\n \r\nOur team has been styling weddings for over 15 years and have extensive knowledge and experience working at a venues across the lower mainland.\r\n \r\nWe’re passionate about creating truly unique events that stand out from the rest and reflect your individual style and personality without breaking the bank. Let us make your event one to remember!', '2017-04-19 12:28:48', '2017-04-19 12:28:48'),
(29, 39, 'universal_decor@yahoo.ca', 2, '#2-3979 Marine Way', NULL, 'Burnaby', 'British Columbia', 'Canada', 'V5J 5E3', '604', 4358001, 'https://www.universaldecorevents.com/', 'https://www.facebook.com/universaldecor/', 'https://www.instagram.com/universaldecor/', NULL, NULL, 'Universal Decor is Vancouver''s premier Event design and decor company Specializing in Wholesale and Rental.  Now with our new offices in Seattle and Calgary offering full service venue decor (delivery, installation and removal), custom-designs, and floral we uniquely bring to life the atmosphere you’ve been envisioning. With the largest collection of wedding decor in both our locations, we are able to provide traditional and novel items, including literally thousands of chair covers, sashes and linens differing in colour, texture and fabric. If you can dream it – we can create it!', '2017-04-19 12:32:39', '2017-04-19 12:33:03'),
(30, 40, 'charmingdecor@gmail.com', NULL, '#305-8128 128 St', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 0L9', '604', 6141157, 'http://www.charmingaffairs.ca/', 'https://www.facebook.com/charmingaffairs/', 'https://www.instagram.com/charmingaffairsdecor/?hl=en', NULL, NULL, 'Making your wedding beautiful!', '2017-04-19 12:36:14', '2017-04-19 12:36:14'),
(31, 41, 'info@raymonsdecor.com', NULL, '12138 86 Ave', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 3H7', '604', 7628752, 'http://www.fascinare.ca/', 'https://www.facebook.com/raymonsdecor/', 'https://www.instagram.com/raymons_decor/?hl=en', NULL, NULL, 'Raymon’s Decor is a family owned and opereated event decor company focusing and specializing in indoor, outdoor events, corporate functions and non-profit galas. We have been in the industry for over Six years, quickly evolving into a full event decor company. The company is an eclectic mix of young highly trained creative professionals that work relentlessly to ensure every event is unique and exquisite, While keeping in tune with the market’s latest trends.', '2017-04-19 12:38:36', '2017-04-19 12:38:36'),
(32, 42, 'kaurdecor@outlook.com', 2, NULL, NULL, NULL, 'British Columbia', 'Canada', NULL, NULL, NULL, NULL, NULL, 'https://www.instagram.com/kaurdecor/', NULL, NULL, 'Event stylists located in Vancouver', '2017-04-19 12:39:45', '2017-04-19 12:39:57'),
(33, 43, NULL, NULL, NULL, NULL, 'Surrey', 'British Columbia', 'Canada', NULL, NULL, NULL, NULL, 'https://www.facebook.com/LUXaffairsBC/', 'https://www.instagram.com/luxaffairs/?hl=en', NULL, NULL, 'Lux Affairs is an event design and décor\r\ncompany located in Surrey, BC. \r\n\r\nOur team works with you to design your ideal event. In addition to event design and décor, we offer tent rental, table and chair rental, LED bars and LED furniture rental. \r\n\r\nWe are able to customize your event to meet your needs. \r\n\r\nMake your next event a LUX Affair!', '2017-04-19 12:41:49', '2017-04-19 12:41:49'),
(34, 44, 'info@eternalblissdecor.com', NULL, NULL, NULL, 'Surrey', 'British Columbia', 'Canada', NULL, '604', 8070407, 'http://www.eternalblissdecor.com', 'https://www.facebook.com/eternalblissdecor', 'https://www.instagram.com/eternalbliss_decor/', NULL, NULL, 'Eternal Bliss Décor is a family owned and operated event décor company specializing in indoor, outdoor events and non-profit social events. We are an up and coming décor company with a diverse mix of experienced and creative professionals who work tirelessly to ensure every event is exceptional, imaginative, and a mirror image of our clients’ wants and desires. Memories are made in seconds, which is why our company is determined to guarantee eternal bliss…', '2017-04-19 12:44:00', '2017-04-19 12:44:00'),
(35, 45, 'info@moonlightweddingdecor.com', NULL, '#402-13303 78 Ave', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 5B9', '778', 8399476, NULL, 'https://www.facebook.com/moonlightweddingdecor/', NULL, NULL, NULL, 'We provide event decor and tent setup services for all occasions', '2017-04-19 12:46:12', '2017-04-19 12:46:12'),
(36, 46, NULL, NULL, '12788 76A Ave', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 1S9', '778', 5656505, 'http://jessiekhaira.com', 'https://www.facebook.com/jessiekhaira', 'https://www.instagram.com/jessiekhaira/', NULL, NULL, 'Award-winning event stylist Jessie Khaira does more than style events – she creates experiences.\r\n\r\nJessie is celebrated for events which are as beautiful as they are personal, and as elegant as they are ornate.  She knows the soul of an event is about the people it celebrates – and she infuses every occasion with the couple’s personality and unique style.\r\n\r\nJessie’s experience spans over more than a decade, with hundreds of happy couples.  She’s studied with the best of the industry, including celebrity stylists Preston Bailey & Karen Tran.  Now a sought-after instructor herself, Jessie teaches the nuances and complexities of flawless events to other stylists.\r\n\r\nWith her joyful let’s do this! attitude, bright smile, and warmth, Jessie which makes you feel like you’ve met your next best friend – making your wedding planning refreshingly fun and enjoyable.  \r\n\r\nIt’s easy to see that making people’s dreams come true is Jessie’s passion – and her calling.\r\n\r\nMake your dream wedding a reality!', '2017-04-19 12:48:33', '2017-04-19 12:48:33'),
(37, 47, 'hello@bespokedecor.ca', NULL, '119 - 408 East Kent Ave S', NULL, 'Vancouver', 'British Columbia', 'Canada', 'V5X 2X7', '604', 8090660, 'http://www.bespokedecor.ca', 'https://www.facebook.com/bespokedecorvancouver/?fref=ts&ref=br_tf', 'https://www.instagram.com/bespokedecor/', 'https://twitter.com/bespokedecor', NULL, 'At Bespoke Decor Rentals, our mission in life is to create seriously awesome events in beautiful\r\nVancouver BC using vintage decor rentals, calligraphy, made-to-order stationery and full decor\r\nstyling services. Whatever the occasion, our infectiously fun and uber creative styling team will\r\nmake your event first-rate! Planning a wedding or awesome hang out?', '2017-04-19 12:50:37', '2017-04-19 12:50:37'),
(38, 48, NULL, NULL, NULL, NULL, NULL, 'British Columbia', 'Canada', NULL, NULL, NULL, NULL, 'https://www.facebook.com/pinkpaisleydecor/', 'https://www.instagram.com/pinkpaisleydecor/', NULL, NULL, 'Pink Paisley Decor provides stunning decor for a wide range of event styles from baby & bridal showers, birthday parties, indoor & outdoor weddings to corporate events & more. Contact us to bring your dream event decor to life!', '2017-04-19 12:52:22', '2017-04-19 12:52:22'),
(39, 49, NULL, 2, NULL, NULL, 'Surrey', 'British Columbia', 'Canada', NULL, '778', 8912627, 'https://www.lovestory101.com', NULL, 'https://www.instagram.com/lovestory101dotcom/', NULL, NULL, 'I have a deep knowledge and appreciation for design stemming from my passion for decor and experience as an interior decorator.\r\n\r\nI specializes in colour coordination and transforming ordinary venues into stunning showpieces.\r\n\r\nAt Love Story 101 Wedding Decor, we create distinctive events which reflect your personality and style. We love out of the box, creative ideas and would love to work together with you to make your next event beautiful!', '2017-04-19 13:52:50', '2017-04-19 13:53:23'),
(40, 50, 'info@stylebysarai.com', NULL, '507 - 207 W Hastings St', NULL, 'Vancouver', 'British Columbia', 'Canada', 'V6B 2N4', '778', 7720972, 'http://www.stylebysarai.com', 'https://www.facebook.com/StyleBySarai/', 'https://www.instagram.com/stylebysarai/', 'https://www.facebook.com/StyleBySarai/', 'https://www.youtube.com/user/stylebysarai', 'No two people are built exactly the same, and at Style by Sarai, we believe no two Sarai Bespoke suits should be built the same. Each suit is custom made for every individual, using only the measurements and specifications from you, instead of any existing patterns or templates like Made-to-Measure. By taking over 36 measurements, we ensure that the suit leaves no doubt in your mind that it was made specifically for you. But what sets bespoke apart is not only the fit of the suit in the end, but the journey along the way. Taking inspiration from all over the world into account, we tailor each garment not only for your frame, but your personality and lifestyle, making it truly unique to you.', '2017-04-19 14:05:57', '2017-04-19 14:05:57'),
(41, 51, 'sales@wellgroomed.ca', NULL, '321 - 8128 128', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 1R1', '604', 5935459, 'https://wellgroomed.ca', 'https://www.facebook.com/wgroomed', 'https://www.instagram.com/wellgroomedinc/', 'https://twitter.com/WellGroomedInc', NULL, 'Shopping for your wedding outfit is a really BIG deal. You want to make sure that the boutique you buy your outfit from delivers on its promises. The only way to make sure that you chose the right bridal shop is to look at the track record', '2017-04-19 14:11:28', '2017-04-19 14:11:28'),
(42, 52, 'info@josephchanan.com', 10, NULL, NULL, 'Vancouver', 'British Columbia', 'Canada', NULL, '844', 5456219, 'https://josephchanan.com', 'https://www.facebook.com/JosephChanan', 'https://www.instagram.com/josephchanan/', 'https://twitter.com/JosephChanan', NULL, 'JC believes that every man should have access to great looking, well designed, fine quality clothing. Further, we believe that men need to take pride in what they wear; if you look good, you feel good. Price and convenience are big issues so we’ve taken care of that by making our suits some of the most affordable suits around without compromising quality. By being a web-based company, we’ve made your shopping experience convenient and easily accessible. Its time to Suit up!', '2017-04-19 14:14:12', '2017-04-19 14:15:32'),
(43, 53, 'info@baynesandbaker.com', NULL, '263 Columbia Street', NULL, 'Vancouver', 'British Columbia', 'Canada', 'V6A 1K3', '888', 9122632, 'http://baynesandbaker.com', 'https://www.facebook.com/baynesandbaker/', 'https://www.instagram.com/baynesandbaker/?hl=en', 'https://www.facebook.com/baynesandbaker/', NULL, 'Baynes + Baker was established in order to provide a solution to the continuously increasing costs and processes associated with custom suits. A booming response to our line originating in Vancouver has lead to our 2016 launch in New York City and our upcoming launch in Shanghai in 2017. We have mastered the custom suit process to provide a seamless experience for our clients. At Baynes + Baker we believe that price should not inhibit your ability to don style, quality, and comfort. Baynes + Baker understands the nuances we face everyday and ordering a suit should not be one of them – we handle the details, you control the design. Quality and choice is a non-negotiable with Baynes + Baker and only offer our clients the best of the best. Our suits are created with the finest material imported from Europe and Asia with a selection of over 1,000 fabrics to choose from. Further, we are extremely pleased to say from initial order to delivery we can have your suit complete and at your doorstep within 3 weeks.', '2017-04-19 14:26:29', '2017-04-19 14:26:29'),
(44, 54, 'info@decibelentertainment.com', NULL, NULL, NULL, 'Vancouver', 'British Columbia', 'Canada', NULL, '778', 9559271, 'http://decibelentertainment.com', 'https://www.facebook.com/DecibelVan/', 'https://www.instagram.com/decibelvan/?hl=en', NULL, NULL, 'Decibel Entertainment is a multi-award winning Wedding Entertainment Company that provides DJ, Photobooth, Sound & Lighting services for various events. At Decibel, the focus is not just on the music, but on the overall Decibel Experience.\r\nThe vision of our fundamental values: music, innovation and excellence infuses interactivity of the crowd alongside good music.\r\nOur passion for the craft radiates through our performances, and our fundamental values guarantee that our music, innovation and excellence in entertainment service delivery will be legendary.', '2017-04-19 14:29:15', '2017-04-19 14:29:15'),
(45, 55, 'info@aftershockroadshow.com', NULL, '8696 166b St', NULL, 'Surrey', 'British Columbia', 'Canada', 'V4N 5B2', '604', 7811307, 'http://aftershockroadshow.com', 'https://www.facebook.com/aftershock.roadshow/', 'https://www.instagram.com/aftershock_roadshow/?hl=en', NULL, NULL, 'Experienced, well-respected and dedicated to turning dreams into reality, you won’t find DJs quite like those associated with the Aftershock Roadshow.\r\n\r\nWe are renowned for making any occasion special – from intimate and ambient, to up-scale and elaborate, The Aftershock Roadshow crew are used to ‘fixing it’ for all kinds of parties including wedding receptions, corporate and private events. We work closely with our clients to tailor-make the best package for each individual style, budget and venue.\r\n\r\nSelection of music is the most important element to an event. You might have the best sound, light and visuals, but it’s the music that differentiates between a ‘good’ or an ‘exceptional’ event.\r\n\r\nTo provide you with the best DJ services, entertainment and lighting our goal is to exceed your expectations. It’s no secret that our success is down to providing a professional service with creative flair and practical know-how.\r\n\r\nWith over 20 years of experience, the team behind the turntables brings together a wealth of skill and knowledge of the Indian wedding market to be able to create the perfect setting for your wedding day.', '2017-04-19 14:31:15', '2017-04-19 14:31:15'),
(46, 56, 'info@xfusionroadshow.com', NULL, NULL, NULL, NULL, 'British Columbia', 'Canada', NULL, '604', 7839645, 'http://www.xfusionroadshow.com', 'https://www.instagram.com/xfusionroadshow/?hl=en', 'https://www.instagram.com/xfusionroadshow/?hl=en', NULL, NULL, 'Services We Provide:\r\n-Experienced and versitle, professional DJ''s\r\n-Full Concert Sound System\r\n-Latest Intelligent Lighting and Laser Shows (best in B.C.)\r\n-Visual Lighting Transformations with Mood/Decor Lighting\r\n-LED Curtains\r\n-Plasma and Projector Screens\r\n-Professional Dhol Players', '2017-04-19 14:34:25', '2017-04-19 14:34:25'),
(47, 57, 'info@highvoltageroadshow.com', NULL, '155 - 1020 Mainland St', NULL, 'Vancouver', 'British Columbia', 'Canada', 'V6B 2T4', '604', 2592853, 'http://highvoltageroadshow.com', 'https://www.facebook.com/HighVoltageRoadshow1', 'https://www.instagram.com/highvoltageroadshow/', NULL, NULL, 'Jograj Randhawa, aka DJ High Voltage’s sound repertoire is a unique blend of sounds ranging from high-energy beats to chill and aesthetic tracks to fit any crowd or special occasion. It is his passion to enhance any space with sound along with a belief that there is an appropriate musical soundtrack for any time or place. He brings his own deeply felt brand of emotional resonance to genres from soul to Bhangra, hip-hop and Hindi tracks. Spinning high-quality sounds, DJ High Voltage has a strong South Asian fan base, but appeals to music lovers of all types and backgrounds. “I’m a play the whole song type of guy,” says Jograj. “I like to get into the artist and bring the crowds back to their high school days or that first reception party back in the day.”', '2017-04-19 14:37:43', '2017-04-19 14:37:43'),
(48, 58, 'info@sunnysbridal.com', NULL, '100 - 12960 84 Ave', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 1K7', '604', 3231333, 'http://www.sunnysbridal.com', 'https://www.facebook.com/sunnysbridalgallery', 'https://www.instagram.com/sunnysbridal/', NULL, NULL, 'Sunny’s Bridal Gallery opened its doors in 1995 and was the first high end East Indian Bridal Boutique in Vancouver. Since our inception, we have transformed the bridal market by offering the best designer Lenghas, Sarees, Suits and Accessories available. We were also the first to offer a complete range of Men’s outfits including Achkans, Jodhpuris and Kurta Pajamas. We continue to be at the forefront of the fashion market in the Lower Mainland and have helped hundreds of couples over the last 2 decades with their wedding attire. Our extensive boutique selection has drawn customers from all over North America. We would love to show you our collection so come in today for a personal shopping experience.', '2017-04-21 12:19:09', '2017-04-21 12:19:09'),
(49, 59, NULL, NULL, '8312 128 St', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 4G2', '604', 5012577, NULL, 'https://www.facebook.com/madeinindiasurrey', 'https://www.instagram.com/madeinindia_surrey/?hl=en', NULL, NULL, 'Discover the latest in Indian Fashion and Design at Made in India.', '2017-04-21 12:21:00', '2017-04-21 12:21:00'),
(50, 60, 'sales@wellgroomed.ca', NULL, '321 - 8128 128', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 1R1', '604', 5935459, 'https://wellgroomed.ca', 'https://www.facebook.com/wgroomed', 'https://www.instagram.com/wellgroomedinc/', 'https://twitter.com/WellGroomedInc', NULL, 'Come in an see the latest bridal designs at Well Groomed!', '2017-04-21 12:23:39', '2017-04-21 12:23:39'),
(51, 61, 'vivah_collection@hotmail.com', NULL, '160 - 12899 80 Ave', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 0E6', '604', 5935214, 'https://www.vivahcollection.ca', 'https://www.facebook.com/Vivah-Collection-326537397393497/', 'https://www.instagram.com/vivah_collection/?hl=en', NULL, NULL, 'Get the latest bridal wear at Vivah Collections!', '2017-04-21 12:26:54', '2017-04-21 12:26:54'),
(52, 62, 'frontiersurrey@gmail.com', NULL, '105 - 8140 120 St', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 3V3', '604', 5254424, NULL, NULL, 'https://www.instagram.com/frontierbridalboutique/?hl=en', NULL, NULL, 'Frontier Bridal Vancouver based high end bridal boutique serving the South Asian community for over 40 years.', '2017-04-21 12:28:40', '2017-04-21 12:28:40'),
(53, 63, 'info@bombaycouture.ca', NULL, '112 - 8166 128 St', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 1R1', '604', 5010888, 'http://bombaycouture.ca', 'https://www.facebook.com/bombaycollection1/', 'https://www.instagram.com/bombay_couture/?hl=en', NULL, NULL, 'BOMBAY Couture is the aristocracy store space owned by BOMBAY Collection specializing in matchless Indian to fusion bridal and party wear (Anarkali’s, Lehenga’s, Saree’s) and endless range of accessories and handbags; all in conjunction with phenomenal quality and exceptional customer service experiences. Whether you are a style innovator on the quest for a neck breaker statement piece, a woman of class opting for elegance and sophistication, a dare devil pushing the boundaries with something sultry in mind or a simple gal seeking for an outfit that falls under the category as this seasons ‘IT’ trend; BOMBAY Couture has got you covered for all your prosperous and candid events.', '2017-04-21 12:31:00', '2017-04-21 12:31:00'),
(54, 64, NULL, 7, '163 - 12899 80 Ave', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 0E6', '778', 8594745, NULL, 'https://www.facebook.com/aakarshanfashion/', 'https://www.instagram.com/aakarshanfashion/', NULL, NULL, 'Welcome to AAKARSHAN FASHION, the favorite shopping destination for shoppers: An exclusive for Indian dresses, we offer an exclusive collection of Indian', '2017-04-21 12:34:04', '2017-04-21 12:34:04'),
(55, 65, 'raji@crossoverbollywoodse.ca', NULL, '8138 128 St', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 1R1', '604', 5028818, 'http://crossoverbollywoodse.ca', 'https://www.facebook.com/crossoverbollywoodse', 'https://www.instagram.com/crossoverbollywoodse/', 'https://twitter.com/CrossoverBSe', NULL, 'Crossover Bollywood Se (CBS) is Canada’s premier designer storefront and an online luxury Indian fashion retailer. Our store and website offers the style-savvy Indian fashionista exactly what she wants – access to the hottest pret-a-porter and bespoke looks from celebrated labels via worldwide express delivery.\r\n\r\nOver the years we’ve built a strong connection with up and coming fashion insiders and in 2015 we added several Vancouver-based designers to our store, a scheme which allows us to foster new design talent and provide a global platform for the scene’s brightest new stars. We’re also the first Indian fashion brand to showcase at Vancouver Fashion Week.', '2017-04-21 12:37:18', '2017-04-21 12:37:18'),
(56, 66, 'justineslittlebakery@gmail.com', NULL, NULL, NULL, 'Surrey', 'British Columbia', 'Canada', NULL, NULL, NULL, 'https://justineslittlebakery.wordpress.com', NULL, 'https://www.instagram.com/justineslittlebakery/', NULL, NULL, 'From custom cakes to cupcakes, Justine’s Little Bakery offers a range of sweet treats to make every celebration a little sweeter.', '2017-04-22 11:34:25', '2017-04-22 11:34:25'),
(57, 67, 'neeta@neetstreats.com', NULL, '210-7270 Market Crossing Way', NULL, 'Burnaby', 'British Columbia', 'Canada', 'V5J 0A2', '778', 2417700, 'http://neetstreats.com', 'https://www.facebook.com/neetstreats', 'https://www.instagram.com/neetstreats/', NULL, NULL, 'Neet’s Treats is a fully licensed commercial bakery, specializing in custom cakes for all life’s celebrations. We work hard to make your special day a little sweeter. Wedding cake consultations/tastings are held by appointment only. If you’d like to book an appointment, or have any cake questions please contact us directly or fill out the form below.', '2017-04-22 11:42:44', '2017-04-22 11:42:44'),
(58, 68, 'cakesbyanjan@yahoo.ca', NULL, NULL, NULL, NULL, 'British Columbia', 'Canada', NULL, NULL, NULL, NULL, 'https://www.facebook.com/Cakes-By-Anjan-862148773862650/', 'https://www.instagram.com/cakesbyanjan/', 'https://twitter.com/CakesByAnjan', NULL, 'Wedding Cakes, Dessert Tables, Corporate gifts and much more', '2017-04-22 11:53:10', '2017-04-22 11:53:10'),
(59, 69, 'info@weddingcardboutique.com', NULL, NULL, NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 5B9', '604', 5949476, 'http://weddingcardboutique.com/', NULL, NULL, NULL, NULL, 'We provied unique invitations for any occasion. You can pick and choose from a readily available selection or have a custom designed card in any colour or design. Beautiful wedding card invitations is what we promise and that is excactly what we deliver. With over 20 years of experience you can rest assure your invitations will be designed, printed, and delivered just the way you want.', '2017-04-22 12:14:50', '2017-04-22 12:14:50'),
(60, 70, 'info@kohalyprinting.com', NULL, '210 - 12837 76 Ave', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 2V3', '604', 5942324, 'http://www.kohalyprinting.com/', 'https://www.facebook.com/KohalyPrintingBinderyLtd/', NULL, NULL, NULL, 'Kohaly Printing and Bindery Ltd customize your special occasions.Whether you are looking for logos, business cards, wedding invitations, or any other printing services for your personal or business needs, Kohaly Printing and Bindery Ltd is the place to visit. Located in Surrey BC, Kohaly Printing and Bindery Ltd since 1975 working as a team to ensure their print quality, speed, price and service is exceptional. Whatever your needs, Kohaly Printing and Bindery Ltd works with you – matching your tastes, theme and budget to set the right tone for your product or event.', '2017-04-22 12:27:00', '2017-04-22 12:27:00'),
(61, 71, 'sales@indianweddinginvitations.ca', NULL, '26 Parkfield Crt', NULL, 'Woodbridge', 'Ontario', 'Canada', 'L4L 9E6', '647', 2389260, 'http://indianweddinginvitations.ca/south-asian-wedding-invitations-surrey-newton.html', NULL, NULL, NULL, NULL, 'We make wedding cards for indian events.', '2017-04-22 12:31:28', '2017-04-22 12:31:28'),
(62, 72, 'user10@fake.com', NULL, NULL, NULL, NULL, 'British Columbia', 'Canada', NULL, '604', 5272040, 'http://www.luxweddinginvitations.com/', 'https://www.facebook.com/luxweddinginvitations/', 'https://www.instagram.com/luxweddinginvitations/', NULL, NULL, 'Welcome to Lux Wedding Invitations.  We are Canada’s premiere boutique print shop and custom graphic design studio specializing in high-quality Wedding Invitations, Save the Date Invitations, Place Cards, Table Menus, Thank You Cards, and wedding websites.\r\n\r\nWe offer two types of luxurious shimmer card stocks that you will not find anywhere else – Lux Linen Shimmer & Lux Smooth Shimmer.  Both sheets are ultra thick with a sparkling pearl finish that shines through the ink.  We also include matching Lux Linen or Lux Smooth envelopes with all invitation orders.\r\n\r\nA unique feature about Lux Invitations is that we can also incorporate your custom invitation design and fonts onto the envelopes.  A feature that is sure to make your invitations stand out from the rest.  As an added time saver we also offer guest addressing and return addressing for all invitation designs.\r\n\r\nWant to customize your order?  No problem.  Our talented in-house designers will work with you one-on-one to help you create and perfect your dream wedding stationary.', '2017-04-22 12:42:17', '2017-04-22 12:42:17'),
(63, 73, 'info@deltaweddingcentre.com', NULL, NULL, NULL, 'Surrey', 'British Columbia', 'Canada', NULL, '604', 7829884, 'http://www.krushdesignstudio.com', 'https://www.facebook.com/krushdesignstudio/', 'https://www.instagram.com/krushdesignstudio/', NULL, NULL, 'Krush Design Studio is a boutique graphic design firm located in Surrey, BC, Canada that designs and creates all types of stationery as well as business and marketing material. We specialize in custom, handmade wedding stationery. As your invitation sets the tone for your event, it is important for us to customize the invitation to fit your personality and adhere to the highest quality to meet and exceed your expectations and needs. Each invitation is handmade and assembled by us.\r\n\r\nFor business and promotional material, Krush Design Studio offers a free consultation which includes a marketing assessment to ensure your brand is well represented in the marketing material that is created.', '2017-04-22 12:48:32', '2017-04-22 12:48:32');
INSERT INTO `vendor_inforamations` (`id`, `user_id`, `contact_email`, `category`, `address1`, `address2`, `city`, `state`, `country`, `pincode`, `area_code`, `phone_number`, `website_url`, `facebook_url`, `instagram_url`, `twitter_url`, `youtube_url`, `about_me`, `created_at`, `updated_at`) VALUES
(64, 74, 'info@bandbajhaentertainment.com', NULL, NULL, NULL, NULL, 'British Columbia', 'Canada', NULL, NULL, NULL, 'http://www.bandbajhaentertainment.com', 'https://www.facebook.com/bandbajhabrass', NULL, 'https://twitter.com/bandbajhaent', NULL, 'PROVIDING A WIDE VARIETY OF LIVE MUSIC OPTIONS TO CREATE A FRESH, HIP AND EXCITING ATMOSPHERE FOR CORPORATE EVENTS, GLAMOROUS WEDDINGS, OR ELEGANT PRIVATE PARTIES. WHETHER IT''S BOLLYWOOD OR MARDI GRAS, BAND BAJHA ENTERTAINMENT CAN CUSTOMIZE YOUR EVENT TO PERFECTLY FIT ANY THEME OR GENRE.', '2017-04-23 07:35:55', '2017-04-23 07:35:55'),
(65, 75, 'boss@vancouverbreakdancers.com', NULL, NULL, NULL, NULL, 'British Columbia', 'Canada', NULL, '778', 8055928, 'http://vancouverbreakdancers.com', 'https://www.facebook.com/VancouverBreakdancers/', NULL, NULL, NULL, 'Vancouver Breakdancers is a solution to the event needs of staff to run your party and function, while you sit back with your guests to enjoy the festivities, and you definitely earned the right to celebrate!\r\n\r\nWe offer a variety of event and entertainment staff to suit your wants and needs, in one simple stop, to save time, money, and get talent at a great value.\r\n\r\nAll of our staff do great work, have good attitudes and have the skills necessary in their chosen field.', '2017-04-23 07:40:09', '2017-04-23 07:40:09'),
(66, 76, 'non@nowornevercrew.com', NULL, NULL, NULL, NULL, 'British Columbia', 'Canada', NULL, '778', 8690661, 'http://nowornevercrew.com', 'https://www.facebook.com/NowOrNeverCrew', NULL, 'https://twitter.com/nowornevercrew?lang=en', NULL, 'In 1997, Coquitlam B.C. Canada, a youngster named Lawrence started his Break-Dancing Career after watching a few Break-Dancing clips his brother downloaded from the internet. After finding a few like minded young individuals in the area, the Now Or Never Crew was formed. Since then, the crew went on to travel the world representing Canada in countries like Germany, Belgium, Netherlands, Japan, South Korea and the USA. \r\n\r\nEarly in the year 2010, Now Or Never crew was also featured on the world stage at the 2010 Winter Olympics Closing Ceremony. Boasting over 2 billion viewers worldwide.', '2017-04-23 07:45:25', '2017-04-23 07:45:25'),
(67, 77, 'lana.bellydance@gmail.com', NULL, NULL, NULL, NULL, 'British Columbia', 'Canada', NULL, '604', 6168359, 'http://www.lanadance.com/weddings', 'https://www.facebook.com/lanadance', NULL, NULL, NULL, 'Lana is a multi award-winning professional belly dance artist and instructor based in Vancouver, BC. Offering high quality belly dance performances for weddings, birthdays, holiday events, stage galas, and more, Lana has earned a reputation for being a premier entertainer who brightens celebrations with her energy, charm and vibrance. Serving the greater Vancouver area, Lana is also involved internationally in multiple aspects of belly dance from training and performance to competitions. Known for her fun-loving spirit, natural musicality, and warm engagement with the audience, Lana’s performances are captivating and inviting. Treat yourself and your guests to Lana’s artistry for celebratory entertainment to be remembered.', '2017-04-23 07:50:12', '2017-04-23 07:50:12'),
(68, 78, 'user11@fake.com', NULL, NULL, NULL, NULL, 'British Columbia', 'Canada', NULL, '604', 7891969, 'http://www.zahradream.com', 'https://www.facebook.com/wwwzahradreamcom', 'https://www.instagram.com/zahradream/', 'https://twitter.com/zhdreams', NULL, 'A Nationally acclaimed dance artist with over a decade of professional experience, Zahra  has been dazzling audiences with her mesmerizing  medley fusion performances.\r\n​\r\nZahra performs at wedding receptions, bridal showers, engagements, birthdays, anniversaries, retirements, festivals, special events, corporate functions to any song upon request.', '2017-04-23 07:56:02', '2017-04-23 07:56:02'),
(69, 79, 'info@chameleonentertianment.ca', 9, '1111 Beach Ave', NULL, 'Vancouver', 'British Columbia', 'Canada', 'V6E 1V1', '778', 9896929, 'http://www.chameleonentertainment.ca', 'https://www.facebook.com/ChameleonEntertainmentCanada/', NULL, NULL, NULL, 'Chameleon Entertainment is collaborative, community based company that focuses on providing the very best performances for entertainment and education. We work closely with clients to help bring their vision to life and customize our acts to meet the needs of any type of event. Chameleon provides many different forms of work opportunities for local  artists to showcase their talent and also help train emerging artists to expand their skill sets.\r\n\r\nOur roster of highly adaptable entertainers use their imagination and experience to bring something new and exciting to the entertainment scene. In addition to providing entertainment locally, Chameleon offers entertainment throughout Canada, sending artists far and wide for corporate events, festivals and private functions. We have talent based out of Vancouver, Calgary and Toronto.\r\n\r\nWe offer reduced rates for Hospital visits, Retirement Homes and Charity Events. Please contact us for more details.', '2017-04-23 08:03:04', '2017-04-23 08:03:04'),
(70, 80, 'info@impressionsliveart.com', 9, NULL, NULL, NULL, 'British Columbia', 'Canada', NULL, '778', 8382455, 'https://impressionsliveart.com', NULL, 'https://www.instagram.com/impressionsliveart/', 'https://twitter.com/ImpressionsLive', NULL, 'Imagine having a wedding, business function, private party or anything you can conjure up in your imagination caught on canvas while it is actually happening!\r\n\r\nThrough painting on site, we specialize in capturing the mood and overall feel of the event as it is being experienced, providing a piece of quality art which is finished, ready to take home and hang or presented as a gift even before the event has finished.', '2017-04-23 08:10:01', '2017-04-23 08:11:38'),
(71, 81, 'info@lavishliquid.com', NULL, '504 - 298 E11 Ave', NULL, 'Vancouver', 'British Columbia', 'Canada', 'V5T 0A2', '604', 8071740, 'http://www.lavishliquid.com', 'https://www.facebook.com/lavishliquid', 'https://www.instagram.com/lavishliquidbar/', 'https://twitter.com/LavishLiquidBar', NULL, 'With more than 30 years combined experience in bartending, hospitality management, event production, and sales/marketing, combined with a passion for outstanding customer service, Lavish Liquid is raising the bar for special event bartending in Vancouver.\r\n\r\nSince 2009, we have provided the Lavish Liquid event bar experience to a broad range of clients. From intimate cocktail receptions for 20 to outdoor festivals for 100,000, our team of experienced bartenders and event managers has set a new standard for event bar service in Vancouver', '2017-04-23 08:19:37', '2017-04-23 08:19:37'),
(72, 82, 'info@sarahdrawsacrowd.com', NULL, NULL, NULL, NULL, 'British Columbia', 'Canada', NULL, NULL, NULL, 'http://sarahdrawsacrowd.com', 'https://www.facebook.com/sarahdrawsacrowd', NULL, 'https://twitter.com/sarahhenghartse', NULL, 'Hello! I’ve been in the caricature business for around 20 years, and have drawn more people than I can calculate, being not that good at math.', '2017-04-23 08:24:36', '2017-04-23 08:24:36'),
(73, 83, 'jatinder@spacbc.com', NULL, '6655 Main St', NULL, 'Vancouver', 'British Columbia', 'Canada', 'V5X 3H3', '604', 5187001, 'https://www.spacbc.com', 'https://www.facebook.com/shanepunjabartsclub/?ref=hl', 'https://www.instagram.com/shanepunjab/', 'https://twitter.com/SPACBHANGRA', NULL, 'Shan-E-Punjab Arts Club promises to keep the next generation linked with their beautiful folk dances and to keep the ethnic Punjabi culture and heritage alive.\r\n\r\nThough the organization is only five years young, Shan-E-Punjab Arts Club can proudly declare they are one of North America’s Best. Through winning numerous competitions coast to coast throughout North America, they have helped their students build confidence, important life skills and lifelong relationships.', '2017-04-23 08:30:51', '2017-04-23 08:30:51'),
(74, 84, 'info@kavitamohan.com', NULL, NULL, NULL, 'Burnaby', 'British Columbia', 'Canada', NULL, '604', 7263020, 'http://www.kavitamohan.com', 'https://www.facebook.com/kavitamohanevents/', 'https://www.instagram.com/kavitamohanevents', NULL, NULL, 'Kavita has always enjoyed planning parties and events. She loves the sense of joy she gets planning, creating and organizing all of the little details that go into an event from the invitations, flowers, menu selection and so much more. The possibilities are endless in the creative process and this is what she is most passionate about as no two events are ever the same and each event is truly tailored to your tastes.', '2017-04-23 10:19:25', '2017-04-23 10:19:25'),
(75, 85, 'info@alwaysandforeverweddings.ca', NULL, NULL, NULL, NULL, 'British Columbia', 'Canada', NULL, '604', 5493455, 'http://alwaysandforeverweddings.ca', 'https://www.facebook.com/AlwaysForeverWeddings/', 'https://www.instagram.com/alwaysandforeverwedding/?hl=en', NULL, NULL, 'Congratulations on your upcoming nuptials. Whether your wedding is big, small, traditional, or unconventional—A&F Wedding planners in Vancouver will manage it with style and flare.\r\n\r\nPlanning a wedding in Vancouver can be a daunting task, especially with everything going on in your day-to-day life. As professional wedding planners in Vancouver, we guide couples through every aspect of the planning process, from vendor negotiations and budget management to time lines and décor.\r\n\r\nMinimize stress and costs. Clients become family to us, and we’ll work hard to make sure your day is beautiful and effortless, from start to finish.', '2017-04-23 10:28:55', '2017-04-23 10:28:55'),
(76, 86, 'info@aliciakeats.com', NULL, '308-525 Seymour St', NULL, 'Vancouver', 'British Columbia', 'Canada', 'V6B 3H6', '778', 2279974, 'http://www.aliciakeats.com', 'https://www.facebook.com/AliciaKeatsWeddingsandEvents/', 'https://www.instagram.com/aliciakeats/?hl=en', 'https://twitter.com/aliciakeats?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor', NULL, 'Alicia Keats Weddings and Events is an award winning, full-service event planning company based in Vancouver, British Columbia, that offers the inspiration, the experience, and the integrity necessary to make any event perfectly unique.\r\n\r\nSince your dreams and desires are particular to you as an individual, we believe that catering to your individuality is the key to an extraordinary wedding.\r\n\r\nGetting to know you as a person, and helping to express your distinctive style as creatively and luxuriously as possible, is our most important goal. This philosophy underlies everything we do, from meeting you the first time to preparing you to walk down the aisle.', '2017-04-23 10:33:50', '2017-04-23 10:33:50'),
(77, 87, 'fatmamehendi@yahoo.ca', 11, '2 - 9200 120 Street', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3V 4B7', '778', 8290781, 'http://fatmastudio.com/', 'https://www.facebook.com/Fatma-Studio-405388022872060/', 'https://www.instagram.com/fatmamehendi/?hl=en', NULL, NULL, 'With 18 years of experience and knowledge of Skin Care and Hairdressing from Bombay School it was very easy to upgrade her studies in Canada as well. After coming to Canada in 2003, Fatma started her job as an esthetician and hairdresser. But didn’t have much time to explore her mehendi talent. But soon after upgrading her studies in hair and skincare, she started her career as a full time mehendi artist and it didn’t took any longer to spread her name and fame. “Fatma Mehendi Art” became a well known name in Mehendi industry. Her clientele are not only Vancouver based, but they are from Seattle, Squamish, Vancouver Island, Calgary, England, Edmonton, Toronto and many more other cities.', '2017-04-23 10:51:14', '2017-04-23 10:52:03'),
(78, 88, 'sonikashennaart@gmail.com', NULL, NULL, NULL, NULL, 'British Columbia', 'Canada', NULL, '778', 9821777, 'http://sonikashennaart.webs.com/', 'https://www.facebook.com/SonikasHennaArt/', 'https://www.instagram.com/sonikashennaart/?hl=en', NULL, NULL, 'Welcome to our website! We provide exquisite mehndi/henna services for all occasions. Specializing in bridal and sangeet mehndi. Sonika''s Henna Art also offers henna classes for beginners and products for artists such as ready made cones and henna powder. Please contact us with questions/comments or to book us for an event.', '2017-04-23 10:56:22', '2017-04-23 10:56:22'),
(79, 89, 'user12@fake.com', 11, '12331 75 Ave', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 2S7', '778', 3870138, 'http://www.bridalhenna.ca/', 'https://www.facebook.com/bridalhenna.ca', 'https://www.instagram.com/almasbridalhenna/', NULL, NULL, 'Scientifically known as Lawsonia Inermis, the henna plant is a flowering shrub whose leaves and flowers have immense value according to Ayurveda medicine. Today, its popular as a dye to temporarily stain nails, hands, feet and hair.\r\n​\r\nFor Centuries, The art of Mehndi-Henna has been practiced in India, Africa, the Middle East and in many other countries and cultures.\r\n​\r\nThe leaves from the henna plant are crushed and mixed with essential oils. The paste is then filled in a cone for easy application. The henna plant originally was used for its healing and cooling astringent properties. People began to see it for cosmetic uses due its beautiful and long lasting stain on skin.', '2017-04-23 10:59:38', '2017-04-23 11:00:50'),
(80, 90, 'maharanimehendi@gmail.com', 11, '223 - 13820 72 Ave', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 7V9', '604', 7673987, 'http://www.maharanimehendi.ca/', 'https://www.facebook.com/Maharani-Mehandi-780325705429266/', 'https://www.instagram.com/maharani.mehendi/', 'https://twitter.com/maharanimehendi', NULL, 'My name is Farhana Sattar founder of Maharani Mehndi. I am based in surrey Vancouver BC, who loves spending free time and extra time  doing beautiful henna designs as a henna artist. I am not  think of henna as “work” – for me it’s more of a passion. From doing henna on herself while still in primary school, my art form has since evolved into more of a profession, and it thankfully now looks less like a 9-year old’s spiderweb and more like work of art expert.\r\n\r\nI started doing henna on myself  I taught myself from pictures and trial-and-error on my own hands. It always intrigued me how something so ‘simple’ can be made into an art form – how you can use the human body as a canvas for something beautiful.​', '2017-04-23 11:04:43', '2017-04-23 11:05:02'),
(81, 91, 'info@604mehndi.com', NULL, NULL, NULL, NULL, 'British Columbia', 'Canada', NULL, '604', 6197585, 'http://www.604mehndi.com', 'https://www.facebook.com/604mehndibyFarhath/', 'https://www.instagram.com/604mehndi/', NULL, NULL, 'Farhath is a professional Mehndi Artist serving Surrey, Vancouver and the rest of the Lower Mainland, BC Canada.', '2017-04-23 11:08:07', '2017-04-23 11:08:07'),
(82, 92, 'muniramotani@yahoo.com', NULL, NULL, NULL, NULL, 'Alberta', 'Canada', NULL, NULL, NULL, NULL, 'https://www.facebook.com/muniramehndi', 'https://www.instagram.com/munirasmehndi/?hl=en', NULL, NULL, 'Munira''s Mehndi Award winning Henna Artist', '2017-04-23 11:14:02', '2017-04-23 11:14:02'),
(83, 93, 'mywedding@gurmsohal.com', NULL, '288 West 1st Ave', NULL, 'Vancouver', 'British Columbia', 'Canada', 'V5Y 3T2', '604', 7202473, 'http://www.gurmsohal.com', NULL, NULL, NULL, NULL, 'As a Vancouver wedding photographer, I believe in  bringing a blend of photojournalism with a modern candid edge, offering you beautiful and memorable wedding photography in Vancouver. Recently my work was published the sixth edition of  the Cultural Wedding Planner. I am primarily a Vancouver wedding photographer. However, I have built a diverse collection of imagery from destinations such as Paris, Beijing, Hong Kong, and Kyoto.  I am proud to be a Vancouver wedding photographer. I believe Vancouver is a diverse city that can offer couples imagery that they will love. Although I specialize in Vancouver Wedding photography, we do welcome destination weddings as well. Please feel free to contact me regarding Vancouver wedding photography as well as destination weddings.', '2017-04-24 07:12:51', '2017-04-24 07:12:51'),
(84, 94, 'info@deostudios.com', NULL, NULL, NULL, 'Vancouver', 'British Columbia', 'Canada', NULL, NULL, NULL, 'http://www.deostudios.com', NULL, NULL, NULL, NULL, 'Deo Studios is a creative agency located in Vancouver, BC. Our services include Film, Photography and Web and Graphic Design.', '2017-04-24 07:18:32', '2017-04-24 07:18:32'),
(85, 95, NULL, NULL, NULL, NULL, 'Vancouver', 'British Columbia', 'Canada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'some description', '2017-04-24 09:08:16', '2017-04-24 09:08:16'),
(86, 96, NULL, 5, NULL, NULL, 'Vancouver', 'British Columbia', 'Canada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'asd', '2017-04-24 09:09:26', '2017-04-24 09:09:34'),
(87, 97, 'info@ariabanquet.ca', NULL, '12350 Pattullo Pl', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3V 8C3', '604', 4961616, 'http://www.ariabanquet.ca', 'https://www.facebook.com/ariabanquet/', NULL, NULL, NULL, 'The Centre is a purpose-built, world-class events venue offering superb flexibility and versatility, with its major appeal being its team of personable and professional staff.\r\n\r\nAria Convention Centre offers a comprehensive range of fully integrated in-house services. Clients need to look no further to find everything they need. Our facility also has expertise in providing a more intimate venue for small and medium sized corporate meetings and events, all to the same high standards of personal service excellence for each and every event.', '2017-04-25 07:03:00', '2017-04-25 07:03:00'),
(88, 98, 'ssmann@crownpalace.ca', 1, '201 - 12025 Nordel Way', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 1W1', '604', 5918100, 'http://www.crownpalace.ca', NULL, NULL, NULL, NULL, 'With two amazing rooms, we can accommodate small or large gatherings for weddings, receptions, corporate events, fundraisers, meetings, special events and more. Over 15 menus to choose from – full turkey dinners, ethnic cuisines or fusion food customized to your party and theme. Click here to view our menu.We offer competitive rates, lots of options, custom décor, top DJ’s, best chef, staff and we will even throw in the door prize for your next event. Ask for details today and find out why we were voted #1 banquet hall in Surrey/Delta and have become the trusted name for the biggest events year round.\r\n\r\nCrown Palace Banquet Hall is the perfect facility for your special occasion or large gathering. Measuring 19,000 square feet and with over 200 parking stalls, we can accommodate the largest of groups. A list of our features: Prime location in the heart of Surrey 19,000 Square Feet BBQ Deck (Covered) Catering Services', '2017-04-25 07:15:35', '2017-04-25 07:16:21'),
(89, 99, NULL, NULL, '230 - 8166 128 St', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 1R1', '604', 5981165, 'http://www.dhaliwalbanquethall.com', NULL, NULL, NULL, NULL, 'Then this is a right place to be in. Diverse and unique in nature, our banquet hall is beyond your possible imagination can take you. No matter what type of event you''re planning, the banquet hall at our resort is surely a location to suit it. Come the wedding season, the scarcity of wedding locations can be well felt. But with us, you are definitely not at risk of searching the location, even at the last moment.\r\n\r\nOur banquet halls must be booked in advance. The arrangements and the architectural settings can vary to match the popular demands and your unique choice. Your choice of wedding reception venue is crucial as this is one of the most important days of your life. Considering this in mind, our crew and dedicated team work throughout the day to ensure every arrangement is done to utmost perfection.', '2017-04-25 07:20:55', '2017-04-25 07:20:55'),
(90, 100, 'info@bombaybanquethall.com', 1, '7475 135 St', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 0M8', '604', 5942019, 'http://www.bombaybanquethall.com', NULL, NULL, NULL, NULL, 'ombay Banquet Hall Convention Center provides the finest convention facilities (like conference halls, guest rooms and business centres) that are equipped with state-of-the-art facilities. Fitted with all modern business aids the venue is ideal for conferences, seminars, banquets, exhibitions, board meetings, press interactions, corporate presentations, workshops, parties, film screenings, presentations, theatre and cultural performances of all kinds.\r\n\r\nWhether your function is for ten, a thousand or tens of thousands, our Catering Staff have the flexibility to feed all of them. We can prepare any dish that’s required, whether it’s local or international. Gourmet meals prepared in our immense kitchen areas are overseen by internationally renowned chefs who understand that even when you’re feeding thousands of people, every meal counts.', '2017-04-25 07:35:03', '2017-04-25 07:35:04'),
(91, 101, 'info@crystalatyork.com', 1, '210 - 12888 80th Ave', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 3A8', '604', 5944333, 'http://crystalatyork.com', NULL, NULL, NULL, NULL, 'Thank you for considering the Crystal At York or the York Conference Center for your Wedding or Reception. This will be one of the most important days in your life. From that understanding, we offer our unfailing commitment to exceed your expectations in presentation, service, quality of food, and to make Your day full of smiles.', '2017-04-25 07:37:39', '2017-04-25 07:42:51'),
(92, 102, 'info@fraserviewhall.com', NULL, '8240 Fraser St', NULL, 'Vancouver', 'British Columbia', 'Canada', 'V5X 3X6', '604', 3226526, 'http://www.fraserviewhall.com', NULL, NULL, NULL, NULL, 'raserview Hall has been a staple of Vancouver for several decades. Our facility is one of kind; The main banquet hall can accomodate seating for 1500 and features a spacious raised stage, full length dance floor, and beverage bar. We offer full service catering, event planning, and are renowned for combining exquisite East Indian Gourmet with detailed presentation and flawless service.\r\n\r\nWe are fully equipped with state of the art lighting, sound systems, and video equipment.\r\n\r\nCome discover the perfect union of beautiful surroundings and thoughtful service in an environment of perfect elegance and prestige.', '2017-04-25 07:50:17', '2017-04-25 07:50:17'),
(93, 103, 'events@southhall.ca', NULL, '8273 Ross St', NULL, 'Vancouver', 'British Columbia', 'Canada', 'V5X 4W1', '604', 3238273, 'http://www.southhall.ca', 'https://www.facebook.com/South-Hall-Banquet-Wedding-Palace-154368104655822/', NULL, NULL, NULL, 'For years South Hall has earned a reputation for providing excellent food quality and exceptional service, specializing in authentic East Indian cuisine as well as creating unique menus that appeal to the most diverse of crowds. With over 35 years of experience South Hall Staff makes sure nothing is left to chance. South Hall is exquisitely designed with complete care and fine décor. The facility features a grand foyer, and a spacious banquet room with a lounge and bar area, and a outdoor patio great for summer BBQ’s and special events. We also offer complete event services not limited to rentals, tents, and catering.\r\n\r\nSouth Hall is centrally located at the crossroad of Marine Drive and Ross Street in Vancouver. We are just 15 minutes from downtown Vancouver and 10 minutes from Vancouver International Airport. Also conveniently located from all neighboring cities of Richmond, Burnaby, Surrey, White Rock, West/North Vancouver.', '2017-04-25 07:52:17', '2017-04-25 07:52:17'),
(94, 104, 'info@riversidehalls.com', 1, '14500 River Rd', NULL, 'Richmond', 'British Columbia', 'Canada', 'V6V 1L4', '604', 2447755, 'http://riversidehalls.com', 'https://www.facebook.com/riversidebanquethalls/', NULL, NULL, NULL, 'Riverside Banquet Halls is Richmond and Surrey''s largest group of banquet venues, providing a selection of spectacular settings and serving clients from Greater Vancouver and all across the lower mainland. We provide complete end-to-end banquet hall services, including planning, decorating and catering.\r\n\r\nWith over 18 years of experience in the local hospitality market, we’re experts in planning and executing important special events, such as wedding ceremonies and receptions, corporate events, anniversary celebrations, fundraisers, birthdays, and much more.\r\n\r\nMany clients choose Riverside Banquet Halls again and again for their most special of occasions—proof of our outstanding venues and superior client service.', '2017-04-25 07:54:27', '2017-04-25 07:59:24'),
(95, 105, 'harmstrong@swaneset.com', 1, '16651 Rannie Rd', NULL, 'PittMeadows', 'British Columbia', 'Canada', 'V3Y 1Z1', '604', 4659380, 'http://www.swanesetevents.com', NULL, NULL, NULL, NULL, 'Swaneset''s 65,000 square foot, chateau style clubhouse is nestled amongst the impressive, coastal mountains. Our Grand Ballroom has floor to ceiling windows, 60-foot ceilings and stunning chandeliers, with fantastic views of our manicured golf courses. With reception seating of 50 to 350 guests, it is the perfect choice for your ceremony and wedding reception. Our executive chef has the expertise and flexibility to assist you in creating a custom menu for your day. We offer a selection of picturesque, outdoor and indoor ceremony venues with seating from 170 to 225 guests.\r\n\r\nAt Swaneset you will receive personalized service. We are pleased to offer our couples a dedicated Wedding Expert, to ensure care and attention to both your day and your needs. Stress free planning with everyone moving in the same direction to make your day exquisite. Our Wedding Expert is at your service and there to help inspire and guide your unique wedding vision. This service includes creative meetings, custom menu planning, day of coordination of ceremony and reception, wedding rehearsal and so much more.', '2017-04-25 08:03:46', '2017-04-25 08:06:19'),
(96, 106, 'info@royalkingpalace.com', 1, '366 - 8158 128 St', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 1R1', '604', 5946161, 'http://royalkingpalace.com', 'https://www.facebook.com/RoyalKingPalace/', NULL, NULL, NULL, 'The Royal King Palace and Convention Center is one of the leading Banquet Hall in Metro Vancouver area and is catering to cities of Surrey, Delta, Richmond and Vancouver. The Royal King Banquet Hall has won WEDLUX “Excellence in Event Venue” award.\r\n\r\nOur Banquet Hall is resplendent with large, elegant foyer and Hall facility is artfully decorated and can also be custom decorated based on your party or events theme. Those themes might be of wedding, wedding anniversaries, reception, beauty pageant or any other corporate or social events.\r\n\r\nWith years of experience in hospitality industry the management of Banquet Hall has transformed the team into customers focus and to work towards the goal achieving and exceeding the customer’s satisfaction. For the management and the team no event is small event and no event is too big.\r\n\r\nThe design of Our Banquet- Hall is elegant with a large crystal chandelier, wood paneling, crowning molding and custom designed carpeting through-out the Banquet –Hall.', '2017-04-25 08:11:22', '2017-04-25 08:14:39'),
(97, 107, 'info@grandtaj.com', 1, '8388 128 Street', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3W 4G2', '604', 5994342, 'http://www.grandtaj.com', 'https://www.facebook.com/GrandTaj/', NULL, NULL, NULL, 'We offer complete packages as well as individualized services to suit any occasion. Our banquet hall and ballroom are available to use 7 days a week, 365 days a year. Please call ahead to check for availability of our facilities as they are usually booked first-come, first-serve basis.\r\n\r\nWe offer experienced personal consultants to help make your occasion special and memorable. We can help you manage the extra details such as ordering invitations, cakes, transportation, photographer, D.J. and other services you may need.', '2017-04-25 08:24:54', '2017-04-25 08:35:43'),
(98, 108, NULL, NULL, '201 - 17767 64 Ave', NULL, 'Surrey', 'British Columbia', 'Canada', 'V3S 1Z2', '604', 5750304, 'http://www.miragebanquethall.com', 'https://www.facebook.com/pages/Mirage-Banquet-Hall-Surrey/171781222917090', NULL, NULL, NULL, 'Please contact Mirage Banquet Hall for event inquries', '2017-04-25 08:41:06', '2017-04-25 08:41:06'),
(99, 109, 'transport1@t.com', NULL, NULL, NULL, NULL, 'Alberta', 'Canada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Transporter', '2017-05-05 13:39:54', '2017-05-05 13:39:54'),
(100, 110, NULL, NULL, NULL, NULL, 'New Westminster', 'British Columbia', 'Canada', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'asasdas', '2017-05-05 13:41:25', '2017-05-05 13:41:25');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_bookmark_by_foreign` FOREIGN KEY (`bookmark_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `bookmarks_bookmark_for_foreign` FOREIGN KEY (`bookmark_for`) REFERENCES `users` (`id`);

--
-- Constraints for table `gallary`
--
ALTER TABLE `gallary`
  ADD CONSTRAINT `gallary_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_review_by_foreign` FOREIGN KEY (`review_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `reviews_review_for_foreign` FOREIGN KEY (`review_for`) REFERENCES `users` (`id`);

--
-- Constraints for table `services_detail_infos`
--
ALTER TABLE `services_detail_infos`
  ADD CONSTRAINT `services_detail_infos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `vendor_inforamations`
--
ALTER TABLE `vendor_inforamations`
  ADD CONSTRAINT `vendor_inforamations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
