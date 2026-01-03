-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 03, 2026 at 05:40 PM
-- Server version: 8.0.40
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngo`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `model_id` bigint UNSIGNED DEFAULT NULL,
  `properties` json DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campaigns`
--

CREATE TABLE `campaigns` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('draft','published','archived') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `target_amount` decimal(12,2) DEFAULT NULL,
  `raised_amount` decimal(12,2) NOT NULL DEFAULT '0.00',
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INR',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaigns`
--

INSERT INTO `campaigns` (`id`, `slug`, `status`, `target_amount`, `raised_amount`, `currency`, `start_date`, `end_date`, `featured_image`, `is_featured`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'education-for-all', 'published', 10000.00, 0.00, 'INR', NULL, NULL, NULL, 0, 1, 1, '2025-11-27 11:18:17', '2025-12-06 11:54:59'),
(2, 'childrens-to-get-their-home', 'published', 54000.00, 30000.00, 'INR', '2025-12-25', NULL, NULL, 1, 1, NULL, '2025-12-25 02:43:40', '2025-12-25 04:30:18'),
(3, 'we-encourage-girls-education', 'published', 92000.00, 69000.00, 'INR', '2025-12-25', NULL, NULL, 1, 1, NULL, '2025-12-25 02:43:40', '2025-12-25 02:43:40');

-- --------------------------------------------------------

--
-- Table structure for table `campaign_translations`
--

CREATE TABLE `campaign_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `campaign_id` bigint UNSIGNED NOT NULL,
  `language_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci,
  `full_description` longtext COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campaign_translations`
--

INSERT INTO `campaign_translations` (`id`, `campaign_id`, `language_id`, `title`, `slug`, `short_description`, `full_description`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Education for All', 'education-for-all', 'vvvv', '<p>dfv</p>', NULL, NULL, NULL, '2025-12-06 11:49:09', '2025-12-06 11:54:59'),
(2, 2, 1, 'Childrens to get their home', 'childrens-to-get-their-home', 'Fusce et augue placerat, dictu velit sit amet, egestasuna. cras aliquam pretium ornar liquam metus. Aenean venenatis sodales...', 'Fusce et augue placerat, dictu velit sit amet, egestasuna. cras aliquam pretium ornar liquam metus. Aenean venenatis sodales...', 'Childrens to get their home', 'Help children get their home.', NULL, '2025-12-25 02:43:40', '2025-12-25 02:43:40'),
(3, 3, 1, 'We encourage girls education', 'we-encourage-girls-education', 'Phasellus cursus nunc arcu, eget sollicitudin milacinia tempurs. Donec ligula turpis, egestas at volutpat no liquam...', 'Phasellus cursus nunc arcu, eget sollicitudin milacinia tempurs. Donec ligula turpis, egestas at volutpat no liquam...', 'We encourage girls education', 'Support girls education.', NULL, '2025-12-25 02:43:40', '2025-12-25 02:43:40');

-- --------------------------------------------------------

--
-- Table structure for table `contact_submissions`
--

CREATE TABLE `contact_submissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `handled_by` bigint UNSIGNED DEFAULT NULL,
  `handled_at` timestamp NULL DEFAULT NULL,
  `status` enum('new','in_progress','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_submissions`
--

INSERT INTO `contact_submissions` (`id`, `name`, `email`, `phone`, `subject`, `message`, `ip_address`, `user_agent`, `handled_by`, `handled_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Main Menu', 'admin@ngo.org', '61522525', 'dd', 'vvv', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 1, '2025-12-22 11:25:06', 'in_progress', '2025-12-22 11:24:44', '2025-12-22 11:25:06'),
(2, 'Test User', 'test@example.com', '1234567890', 'Test Subject', 'This is a test message for the Leave a Reply form.', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', NULL, NULL, 'new', '2026-01-03 02:55:00', '2026-01-03 02:55:00'),
(3, 'Contact Test', 'test@example.com', NULL, NULL, 'Test contact message.', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', NULL, NULL, 'new', '2026-01-03 03:01:49', '2026-01-03 03:01:49'),
(4, 'Test User', 'test@example.com', NULL, 'Reply to Event: Humanity Trailwalker', 'This is a test message.', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', NULL, NULL, 'new', '2026-01-03 03:12:21', '2026-01-03 03:12:21'),
(5, 'John Doe', 'john@example.com', '1234567890', 'Test Subject', 'This is a test message for the Leave a Reply form.', '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', NULL, NULL, 'new', '2026-01-03 03:28:53', '2026-01-03 03:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int UNSIGNED NOT NULL,
  `iso` char(2) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `iso3` char(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numcode` smallint DEFAULT NULL,
  `phonecode` int UNSIGNED NOT NULL,
  `currency_code` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency_symbol` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `min_phone_length` int NOT NULL DEFAULT '10',
  `max_phone_length` int NOT NULL DEFAULT '10',
  `is_active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `iso`, `name`, `iso3`, `numcode`, `phonecode`, `currency_code`, `currency_symbol`, `min_phone_length`, `max_phone_length`, `is_active`) VALUES
(1, 'AF', 'Afghanistan', 'AFG', 4, 93, 'AFN', '؋', 10, 10, 0),
(2, 'AL', 'Albania', 'ALB', 8, 355, NULL, NULL, 10, 10, 0),
(3, 'DZ', 'Algeria', 'DZA', 12, 213, 'DZD', 'د.ج', 10, 10, 0),
(4, 'AS', 'American Samoa', 'ASM', 16, 1684, NULL, NULL, 10, 10, 0),
(5, 'AD', 'Andorra', 'AND', 20, 376, NULL, NULL, 10, 10, 0),
(6, 'AO', 'Angola', 'AGO', 24, 244, NULL, NULL, 10, 10, 0),
(7, 'AI', 'Anguilla', 'AIA', 660, 1264, NULL, NULL, 10, 10, 0),
(8, 'AQ', 'Antarctica', NULL, NULL, 0, NULL, NULL, 10, 10, 0),
(9, 'AG', 'Antigua and Barbuda', 'ATG', 28, 1268, NULL, NULL, 10, 10, 0),
(10, 'AR', 'Argentina', 'ARG', 32, 54, 'ARS', '$', 10, 10, 0),
(11, 'AM', 'Armenia', 'ARM', 51, 374, NULL, NULL, 10, 10, 0),
(12, 'AW', 'Aruba', 'ABW', 533, 297, NULL, NULL, 10, 10, 0),
(13, 'AU', 'Australia', 'AUS', 36, 61, 'AUD', 'A$', 10, 10, 0),
(14, 'AT', 'Austria', 'AUT', 40, 43, 'EUR', '€', 10, 10, 0),
(15, 'AZ', 'Azerbaijan', 'AZE', 31, 994, NULL, NULL, 10, 10, 0),
(16, 'BS', 'Bahamas', 'BHS', 44, 1242, NULL, NULL, 10, 10, 0),
(17, 'BH', 'Bahrain', 'BHR', 48, 973, 'BHD', '.د.ب', 10, 10, 0),
(18, 'BD', 'Bangladesh', 'BGD', 50, 880, 'BDT', '৳', 10, 10, 0),
(19, 'BB', 'Barbados', 'BRB', 52, 1246, NULL, NULL, 10, 10, 0),
(20, 'BY', 'Belarus', 'BLR', 112, 375, 'BYN', 'Br', 10, 10, 0),
(21, 'BE', 'Belgium', 'BEL', 56, 32, 'EUR', '€', 10, 10, 0),
(22, 'BZ', 'Belize', 'BLZ', 84, 501, NULL, NULL, 10, 10, 0),
(23, 'BJ', 'Benin', 'BEN', 204, 229, NULL, NULL, 10, 10, 0),
(24, 'BM', 'Bermuda', 'BMU', 60, 1441, 'BMD', '$', 10, 10, 0),
(25, 'BT', 'Bhutan', 'BTN', 64, 975, NULL, NULL, 10, 10, 0),
(26, 'BO', 'Bolivia', 'BOL', 68, 591, 'BOB', 'Bs.', 10, 10, 0),
(27, 'BA', 'Bosnia and Herzegovina', 'BIH', 70, 387, NULL, NULL, 10, 10, 0),
(28, 'BW', 'Botswana', 'BWA', 72, 267, NULL, NULL, 10, 10, 0),
(29, 'BV', 'Bouvet Island', NULL, NULL, 0, NULL, NULL, 10, 10, 0),
(30, 'BR', 'Brazil', 'BRA', 76, 55, 'BRL', 'R$', 10, 10, 0),
(31, 'IO', 'British Indian Ocean Territory', NULL, NULL, 246, NULL, NULL, 10, 10, 0),
(32, 'BN', 'Brunei Darussalam', 'BRN', 96, 673, NULL, NULL, 10, 10, 0),
(33, 'BG', 'Bulgaria', 'BGR', 100, 359, 'BGN', 'лв', 10, 10, 0),
(34, 'BF', 'Burkina Faso', 'BFA', 854, 226, NULL, NULL, 10, 10, 0),
(35, 'BI', 'Burundi', 'BDI', 108, 257, NULL, NULL, 10, 10, 0),
(36, 'KH', 'Cambodia', 'KHM', 116, 855, NULL, NULL, 10, 10, 0),
(37, 'CM', 'Cameroon', 'CMR', 120, 237, NULL, NULL, 10, 10, 0),
(38, 'CA', 'Canada', 'CAN', 124, 1, 'CAD', 'C$', 10, 10, 0),
(39, 'CV', 'Cape Verde', 'CPV', 132, 238, NULL, NULL, 10, 10, 0),
(40, 'KY', 'Cayman Islands', 'CYM', 136, 1345, 'KYD', '$', 10, 10, 0),
(41, 'CF', 'Central African Republic', 'CAF', 140, 236, NULL, NULL, 10, 10, 0),
(42, 'TD', 'Chad', 'TCD', 148, 235, NULL, NULL, 10, 10, 0),
(43, 'CL', 'Chile', 'CHL', 152, 56, 'CLP', '$', 10, 10, 0),
(44, 'CN', 'China', 'CHN', 156, 86, 'CNY', '¥', 10, 10, 0),
(45, 'CX', 'Christmas Island', NULL, NULL, 61, NULL, NULL, 10, 10, 0),
(46, 'CC', 'Cocos (Keeling) Islands', NULL, NULL, 672, NULL, NULL, 10, 10, 0),
(47, 'CO', 'Colombia', 'COL', 170, 57, 'COP', '$', 10, 10, 0),
(48, 'KM', 'Comoros', 'COM', 174, 269, NULL, NULL, 10, 10, 0),
(49, 'CG', 'Congo', 'COG', 178, 242, NULL, NULL, 10, 10, 0),
(50, 'CD', 'Congo, the Democratic Republic of the', 'COD', 180, 242, NULL, NULL, 10, 10, 0),
(51, 'CK', 'Cook Islands', 'COK', 184, 682, NULL, NULL, 10, 10, 0),
(52, 'CR', 'Costa Rica', 'CRI', 188, 506, NULL, NULL, 10, 10, 0),
(53, 'CI', 'Cote D\'Ivoire', 'CIV', 384, 225, NULL, NULL, 10, 10, 0),
(54, 'HR', 'Croatia', 'HRV', 191, 385, 'EUR', '€', 10, 10, 0),
(55, 'CU', 'Cuba', 'CUB', 192, 53, NULL, NULL, 10, 10, 0),
(56, 'CY', 'Cyprus', 'CYP', 196, 357, NULL, NULL, 10, 10, 0),
(57, 'CZ', 'Czech Republic', 'CZE', 203, 420, 'CZK', 'Kč', 10, 10, 0),
(58, 'DK', 'Denmark', 'DNK', 208, 45, 'DKK', 'kr', 10, 10, 0),
(59, 'DJ', 'Djibouti', 'DJI', 262, 253, NULL, NULL, 10, 10, 0),
(60, 'DM', 'Dominica', 'DMA', 212, 1767, NULL, NULL, 10, 10, 0),
(61, 'DO', 'Dominican Republic', 'DOM', 214, 1809, NULL, NULL, 10, 10, 0),
(62, 'EC', 'Ecuador', 'ECU', 218, 593, 'USD', '$', 10, 10, 0),
(63, 'EG', 'Egypt', 'EGY', 818, 20, 'EGP', 'E£', 10, 10, 0),
(64, 'SV', 'El Salvador', 'SLV', 222, 503, NULL, NULL, 10, 10, 0),
(65, 'GQ', 'Equatorial Guinea', 'GNQ', 226, 240, NULL, NULL, 10, 10, 0),
(66, 'ER', 'Eritrea', 'ERI', 232, 291, NULL, NULL, 10, 10, 0),
(67, 'EE', 'Estonia', 'EST', 233, 372, NULL, NULL, 10, 10, 0),
(68, 'ET', 'Ethiopia', 'ETH', 231, 251, 'ETB', 'Br', 10, 10, 0),
(69, 'FK', 'Falkland Islands (Malvinas)', 'FLK', 238, 500, NULL, NULL, 10, 10, 0),
(70, 'FO', 'Faroe Islands', 'FRO', 234, 298, NULL, NULL, 10, 10, 0),
(71, 'FJ', 'Fiji', 'FJI', 242, 679, 'FJD', '$', 10, 10, 0),
(72, 'FI', 'Finland', 'FIN', 246, 358, 'EUR', '€', 10, 10, 0),
(73, 'FR', 'France', 'FRA', 250, 33, 'EUR', '€', 10, 10, 0),
(74, 'GF', 'French Guiana', 'GUF', 254, 594, NULL, NULL, 10, 10, 0),
(75, 'PF', 'French Polynesia', 'PYF', 258, 689, NULL, NULL, 10, 10, 0),
(76, 'TF', 'French Southern Territories', NULL, NULL, 0, NULL, NULL, 10, 10, 0),
(77, 'GA', 'Gabon', 'GAB', 266, 241, NULL, NULL, 10, 10, 0),
(78, 'GM', 'Gambia', 'GMB', 270, 220, NULL, NULL, 10, 10, 0),
(79, 'GE', 'Georgia', 'GEO', 268, 995, NULL, NULL, 10, 10, 0),
(80, 'DE', 'Germany', 'DEU', 276, 49, 'EUR', '€', 10, 10, 0),
(81, 'GH', 'Ghana', 'GHA', 288, 233, 'GHS', '₵', 10, 10, 0),
(82, 'GI', 'Gibraltar', 'GIB', 292, 350, NULL, NULL, 10, 10, 0),
(83, 'GR', 'Greece', 'GRC', 300, 30, 'EUR', '€', 10, 10, 0),
(84, 'GL', 'Greenland', 'GRL', 304, 299, NULL, NULL, 10, 10, 0),
(85, 'GD', 'Grenada', 'GRD', 308, 1473, NULL, NULL, 10, 10, 0),
(86, 'GP', 'Guadeloupe', 'GLP', 312, 590, NULL, NULL, 10, 10, 0),
(87, 'GU', 'Guam', 'GUM', 316, 1671, NULL, NULL, 10, 10, 0),
(88, 'GT', 'Guatemala', 'GTM', 320, 502, NULL, NULL, 10, 10, 0),
(89, 'GN', 'Guinea', 'GIN', 324, 224, NULL, NULL, 10, 10, 0),
(90, 'GW', 'Guinea-Bissau', 'GNB', 624, 245, NULL, NULL, 10, 10, 0),
(91, 'GY', 'Guyana', 'GUY', 328, 592, NULL, NULL, 10, 10, 0),
(92, 'HT', 'Haiti', 'HTI', 332, 509, NULL, NULL, 10, 10, 0),
(93, 'HM', 'Heard Island and Mcdonald Islands', NULL, NULL, 0, NULL, NULL, 10, 10, 0),
(94, 'VA', 'Holy See (Vatican City State)', 'VAT', 336, 39, NULL, NULL, 10, 10, 0),
(95, 'HN', 'Honduras', 'HND', 340, 504, NULL, NULL, 10, 10, 0),
(96, 'HK', 'Hong Kong', 'HKG', 344, 852, 'HKD', 'HK$', 10, 10, 0),
(97, 'HU', 'Hungary', 'HUN', 348, 36, 'HUF', 'Ft', 10, 10, 0),
(98, 'IS', 'Iceland', 'ISL', 352, 354, 'ISK', 'kr', 10, 10, 0),
(99, 'IN', 'India', 'IND', NULL, 91, 'INR', '₹', 10, 10, 1),
(100, 'ID', 'Indonesia', 'IDN', 360, 62, 'IDR', 'Rp', 10, 10, 0),
(101, 'IR', 'Iran, Islamic Republic of', 'IRN', 364, 98, NULL, NULL, 10, 10, 0),
(102, 'IQ', 'Iraq', 'IRQ', 368, 964, 'IQD', 'ع.د', 10, 10, 0),
(103, 'IE', 'Ireland', 'IRL', 372, 353, 'EUR', '€', 10, 10, 0),
(104, 'IL', 'Israel', 'ISR', 376, 972, 'ILS', '₪', 10, 10, 0),
(105, 'IT', 'Italy', 'ITA', 380, 39, 'EUR', '€', 10, 10, 0),
(106, 'JM', 'Jamaica', 'JAM', 388, 1876, NULL, NULL, 10, 10, 0),
(107, 'JP', 'Japan', 'JPN', 392, 81, 'JPY', '¥', 10, 10, 0),
(108, 'JO', 'Jordan', 'JOR', 400, 962, 'JOD', 'د.ا', 10, 10, 0),
(109, 'KZ', 'Kazakhstan', 'KAZ', 398, 7, NULL, NULL, 10, 10, 0),
(110, 'KE', 'Kenya', 'KEN', 404, 254, 'KES', 'KSh', 10, 10, 0),
(111, 'KI', 'Kiribati', 'KIR', 296, 686, NULL, NULL, 10, 10, 0),
(112, 'KP', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850, NULL, NULL, 10, 10, 0),
(113, 'KR', 'Korea, Republic of', 'KOR', 410, 82, NULL, NULL, 10, 10, 0),
(114, 'KW', 'Kuwait', 'KWT', 414, 965, 'KWD', 'د.ك', 10, 10, 0),
(115, 'KG', 'Kyrgyzstan', 'KGZ', 417, 996, NULL, NULL, 10, 10, 0),
(116, 'LA', 'Lao People\'s Democratic Republic', 'LAO', 418, 856, NULL, NULL, 10, 10, 0),
(117, 'LV', 'Latvia', 'LVA', 428, 371, NULL, NULL, 10, 10, 0),
(118, 'LB', 'Lebanon', 'LBN', 422, 961, 'LBP', 'ل.ل', 10, 10, 0),
(119, 'LS', 'Lesotho', 'LSO', 426, 266, NULL, NULL, 10, 10, 0),
(120, 'LR', 'Liberia', 'LBR', 430, 231, NULL, NULL, 10, 10, 0),
(121, 'LY', 'Libyan Arab Jamahiriya', 'LBY', 434, 218, NULL, NULL, 10, 10, 0),
(122, 'LI', 'Liechtenstein', 'LIE', 438, 423, NULL, NULL, 10, 10, 0),
(123, 'LT', 'Lithuania', 'LTU', 440, 370, NULL, NULL, 10, 10, 0),
(124, 'LU', 'Luxembourg', 'LUX', 442, 352, NULL, NULL, 10, 10, 0),
(125, 'MO', 'Macao', 'MAC', 446, 853, NULL, NULL, 10, 10, 0),
(126, 'MK', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389, NULL, NULL, 10, 10, 0),
(127, 'MG', 'Madagascar', 'MDG', 450, 261, NULL, NULL, 10, 10, 0),
(128, 'MW', 'Malawi', 'MWI', 454, 265, NULL, NULL, 10, 10, 0),
(129, 'MY', 'Malaysia', 'MYS', 458, 60, 'MYR', 'RM', 10, 10, 0),
(130, 'MV', 'Maldives', 'MDV', 462, 960, NULL, NULL, 10, 10, 0),
(131, 'ML', 'Mali', 'MLI', 466, 223, NULL, NULL, 10, 10, 0),
(132, 'MT', 'Malta', 'MLT', 470, 356, NULL, NULL, 10, 10, 0),
(133, 'MH', 'Marshall Islands', 'MHL', 584, 692, NULL, NULL, 10, 10, 0),
(134, 'MQ', 'Martinique', 'MTQ', 474, 596, NULL, NULL, 10, 10, 0),
(135, 'MR', 'Mauritania', 'MRT', 478, 222, NULL, NULL, 10, 10, 0),
(136, 'MU', 'Mauritius', 'MUS', 480, 230, NULL, NULL, 10, 10, 0),
(137, 'YT', 'Mayotte', NULL, NULL, 269, NULL, NULL, 10, 10, 0),
(138, 'MX', 'Mexico', 'MEX', 484, 52, 'MXN', 'Mex$', 10, 10, 0),
(139, 'FM', 'Micronesia, Federated States of', 'FSM', 583, 691, NULL, NULL, 10, 10, 0),
(140, 'MD', 'Moldova, Republic of', 'MDA', 498, 373, NULL, NULL, 10, 10, 0),
(141, 'MC', 'Monaco', 'MCO', 492, 377, NULL, NULL, 10, 10, 0),
(142, 'MN', 'Mongolia', 'MNG', 496, 976, NULL, NULL, 10, 10, 0),
(143, 'MS', 'Montserrat', 'MSR', 500, 1664, NULL, NULL, 10, 10, 0),
(144, 'MA', 'Morocco', 'MAR', 504, 212, 'MAD', 'د.م.', 10, 10, 0),
(145, 'MZ', 'Mozambique', 'MOZ', 508, 258, NULL, NULL, 10, 10, 0),
(146, 'MM', 'Myanmar', 'MMR', 104, 95, NULL, NULL, 10, 10, 0),
(147, 'NA', 'Namibia', 'NAM', 516, 264, NULL, NULL, 10, 10, 0),
(148, 'NR', 'Nauru', 'NRU', 520, 674, NULL, NULL, 10, 10, 0),
(149, 'NP', 'Nepal', 'NPL', NULL, 977, 'NPR', 'Rs', 3, 20, 1),
(150, 'NL', 'Netherlands', 'NLD', 528, 31, 'EUR', '€', 10, 10, 0),
(151, 'AN', 'Netherlands Antilles', 'ANT', 530, 599, NULL, NULL, 10, 10, 0),
(152, 'NC', 'New Caledonia', 'NCL', 540, 687, NULL, NULL, 10, 10, 0),
(153, 'NZ', 'New Zealand', 'NZL', 554, 64, 'NZD', 'NZ$', 10, 10, 0),
(154, 'NI', 'Nicaragua', 'NIC', 558, 505, NULL, NULL, 10, 10, 0),
(155, 'NE', 'Niger', 'NER', 562, 227, NULL, NULL, 10, 10, 0),
(156, 'NG', 'Nigeria', 'NGA', 566, 234, 'NGN', '₦', 10, 10, 0),
(157, 'NU', 'Niue', 'NIU', 570, 683, NULL, NULL, 10, 10, 0),
(158, 'NF', 'Norfolk Island', 'NFK', 574, 672, NULL, NULL, 10, 10, 0),
(159, 'MP', 'Northern Mariana Islands', 'MNP', 580, 1670, NULL, NULL, 10, 10, 0),
(160, 'NO', 'Norway', 'NOR', 578, 47, 'NOK', 'kr', 10, 10, 0),
(161, 'OM', 'Oman', 'OMN', 512, 968, 'OMR', '﷼', 10, 10, 0),
(162, 'PK', 'Pakistan', 'PAK', 586, 92, 'PKR', 'Rs', 10, 10, 0),
(163, 'PW', 'Palau', 'PLW', 585, 680, NULL, NULL, 10, 10, 0),
(164, 'PS', 'Palestinian Territory, Occupied', NULL, NULL, 970, NULL, NULL, 10, 10, 0),
(165, 'PA', 'Panama', 'PAN', 591, 507, NULL, NULL, 10, 10, 0),
(166, 'PG', 'Papua New Guinea', 'PNG', 598, 675, 'PGK', 'K', 10, 10, 0),
(167, 'PY', 'Paraguay', 'PRY', 600, 595, 'PYG', '₲', 10, 10, 0),
(168, 'PE', 'Peru', 'PER', 604, 51, 'PEN', 'S/', 10, 10, 0),
(169, 'PH', 'Philippines', 'PHL', 608, 63, 'PHP', '₱', 10, 10, 0),
(170, 'PN', 'Pitcairn', 'PCN', 612, 0, NULL, NULL, 10, 10, 0),
(171, 'PL', 'Poland', 'POL', 616, 48, 'PLN', 'zł', 10, 10, 0),
(172, 'PT', 'Portugal', 'PRT', 620, 351, 'EUR', '€', 10, 10, 0),
(173, 'PR', 'Puerto Rico', 'PRI', 630, 1787, NULL, NULL, 10, 10, 0),
(174, 'QA', 'Qatar', 'QAT', 634, 974, 'QAR', '﷼', 10, 10, 0),
(175, 'RE', 'Reunion', 'REU', 638, 262, NULL, NULL, 10, 10, 0),
(176, 'RO', 'Romania', 'ROM', 642, 40, 'RON', 'lei', 10, 10, 0),
(177, 'RU', 'Russian Federation', 'RUS', 643, 70, NULL, NULL, 10, 10, 0),
(178, 'RW', 'Rwanda', 'RWA', 646, 250, NULL, NULL, 10, 10, 0),
(179, 'SH', 'Saint Helena', 'SHN', 654, 290, NULL, NULL, 10, 10, 0),
(180, 'KN', 'Saint Kitts and Nevis', 'KNA', 659, 1869, NULL, NULL, 10, 10, 0),
(181, 'LC', 'Saint Lucia', 'LCA', 662, 1758, NULL, NULL, 10, 10, 0),
(182, 'PM', 'Saint Pierre and Miquelon', 'SPM', 666, 508, NULL, NULL, 10, 10, 0),
(183, 'VC', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784, NULL, NULL, 10, 10, 0),
(184, 'WS', 'Samoa', 'WSM', 882, 684, NULL, NULL, 10, 10, 0),
(185, 'SM', 'San Marino', 'SMR', 674, 378, NULL, NULL, 10, 10, 0),
(186, 'ST', 'Sao Tome and Principe', 'STP', 678, 239, NULL, NULL, 10, 10, 0),
(187, 'SA', 'Saudi Arabia', 'SAU', 682, 966, 'SAR', '﷼', 10, 10, 0),
(188, 'SN', 'Senegal', 'SEN', 686, 221, NULL, NULL, 10, 10, 0),
(189, 'CS', 'Serbia and Montenegro', NULL, NULL, 381, NULL, NULL, 10, 10, 0),
(190, 'SC', 'Seychelles', 'SYC', 690, 248, NULL, NULL, 10, 10, 0),
(191, 'SL', 'Sierra Leone', 'SLE', 694, 232, NULL, NULL, 10, 10, 0),
(192, 'SG', 'Singapore', 'SGP', 702, 65, 'SGD', 'S$', 10, 10, 0),
(193, 'SK', 'Slovakia', 'SVK', 703, 421, NULL, NULL, 10, 10, 0),
(194, 'SI', 'Slovenia', 'SVN', 705, 386, NULL, NULL, 10, 10, 0),
(195, 'SB', 'Solomon Islands', 'SLB', 90, 677, NULL, NULL, 10, 10, 0),
(196, 'SO', 'Somalia', 'SOM', 706, 252, NULL, NULL, 10, 10, 0),
(197, 'ZA', 'South Africa', 'ZAF', 710, 27, 'ZAR', 'R', 10, 10, 0),
(198, 'GS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0, NULL, NULL, 10, 10, 0),
(199, 'ES', 'Spain', 'ESP', 724, 34, 'EUR', '€', 10, 10, 0),
(200, 'LK', 'Sri Lanka', 'LKA', 144, 94, 'LKR', 'Rs', 10, 10, 0),
(201, 'SD', 'Sudan', 'SDN', 736, 249, NULL, NULL, 10, 10, 0),
(202, 'SR', 'Suriname', 'SUR', 740, 597, NULL, NULL, 10, 10, 0),
(203, 'SJ', 'Svalbard and Jan Mayen', 'SJM', 744, 47, NULL, NULL, 10, 10, 0),
(204, 'SZ', 'Swaziland', 'SWZ', 748, 268, NULL, NULL, 10, 10, 0),
(205, 'SE', 'Sweden', 'SWE', 752, 46, 'SEK', 'kr', 10, 10, 0),
(206, 'CH', 'Switzerland', 'CHE', 756, 41, 'CHF', 'CHF', 10, 10, 0),
(207, 'SY', 'Syrian Arab Republic', 'SYR', 760, 963, NULL, NULL, 10, 10, 0),
(208, 'TW', 'Taiwan, Province of China', 'TWN', 158, 886, NULL, NULL, 10, 10, 0),
(209, 'TJ', 'Tajikistan', 'TJK', 762, 992, NULL, NULL, 10, 10, 0),
(210, 'TZ', 'Tanzania, United Republic of', 'TZA', 834, 255, NULL, NULL, 10, 10, 0),
(211, 'TH', 'Thailand', 'THA', 764, 66, 'THB', '฿', 10, 10, 0),
(212, 'TL', 'Timor-Leste', NULL, NULL, 670, NULL, NULL, 10, 10, 0),
(213, 'TG', 'Togo', 'TGO', 768, 228, NULL, NULL, 10, 10, 0),
(214, 'TK', 'Tokelau', 'TKL', 772, 690, NULL, NULL, 10, 10, 0),
(215, 'TO', 'Tonga', 'TON', 776, 676, NULL, NULL, 10, 10, 0),
(216, 'TT', 'Trinidad and Tobago', 'TTO', 780, 1868, NULL, NULL, 10, 10, 0),
(217, 'TN', 'Tunisia', 'TUN', 788, 216, 'TND', 'د.ت', 10, 10, 0),
(218, 'TR', 'Turkey', 'TUR', 792, 90, 'TRY', '₺', 10, 10, 0),
(219, 'TM', 'Turkmenistan', 'TKM', 795, 7370, NULL, NULL, 10, 10, 0),
(220, 'TC', 'Turks and Caicos Islands', 'TCA', 796, 1649, NULL, NULL, 10, 10, 0),
(221, 'TV', 'Tuvalu', 'TUV', 798, 688, NULL, NULL, 10, 10, 0),
(222, 'UG', 'Uganda', 'UGA', 800, 256, 'UGX', 'USh', 10, 10, 0),
(223, 'UA', 'Ukraine', 'UKR', 804, 380, 'UAH', '₴', 10, 10, 0),
(224, 'AE', 'United Arab Emirates', 'ARE', 784, 971, 'AED', 'د.إ', 10, 10, 0),
(225, 'GB', 'United Kingdom', 'GBR', 826, 44, 'GBP', '£', 10, 10, 0),
(226, 'US', 'United States', 'USA', NULL, 1, 'USD', '$', 10, 10, 1),
(227, 'UM', 'United States Minor Outlying Islands', NULL, NULL, 1, NULL, NULL, 10, 10, 0),
(228, 'UY', 'Uruguay', 'URY', 858, 598, 'UYU', '$U', 10, 10, 0),
(229, 'UZ', 'Uzbekistan', 'UZB', 860, 998, NULL, NULL, 10, 10, 0),
(230, 'VU', 'Vanuatu', 'VUT', 548, 678, NULL, NULL, 10, 10, 0),
(231, 'VE', 'Venezuela', 'VEN', 862, 58, 'VES', 'Bs.', 10, 10, 0),
(232, 'VN', 'Viet Nam', 'VNM', 704, 84, NULL, NULL, 10, 10, 0),
(233, 'VG', 'Virgin Islands, British', 'VGB', 92, 1284, NULL, NULL, 10, 10, 0),
(234, 'VI', 'Virgin Islands, U.s.', 'VIR', 850, 1340, NULL, NULL, 10, 10, 0),
(235, 'WF', 'Wallis and Futuna', 'WLF', 876, 681, NULL, NULL, 10, 10, 0),
(236, 'EH', 'Western Sahara', 'ESH', 732, 212, NULL, NULL, 10, 10, 0),
(237, 'YE', 'Yemen', 'YEM', 887, 967, NULL, NULL, 10, 10, 0),
(238, 'ZM', 'Zambia', 'ZMB', 894, 260, 'ZMW', 'ZK', 10, 10, 0),
(239, 'ZW', 'Zimbabwe', 'ZWE', 716, 263, 'ZWL', '$', 10, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

CREATE TABLE `donations` (
  `id` bigint UNSIGNED NOT NULL,
  `campaign_id` bigint UNSIGNED DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `amount` decimal(12,2) NOT NULL,
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','paid','failed','refunded') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `payment_gateway` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_details` json DEFAULT NULL,
  `donor_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `donor_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donor_phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `donor_address` text COLLATE utf8mb4_unicode_ci,
  `is_anonymous` tinyint(1) NOT NULL DEFAULT '0',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `campaign_id`, `user_id`, `amount`, `currency`, `status`, `payment_gateway`, `transaction_id`, `payment_reference`, `payment_details`, `donor_name`, `donor_email`, `donor_phone`, `donor_address`, `is_anonymous`, `paid_at`, `created_at`, `updated_at`) VALUES
(1, NULL, NULL, 1000.00, 'USD', 'paid', 'paypal', NULL, NULL, NULL, 'Test Donor', 'test@donor.com', '555-0199', '123 Donor St', 0, '2025-12-13 04:05:55', '2025-12-13 04:05:55', '2025-12-13 04:05:55'),
(2, NULL, NULL, 999.00, 'USD', 'paid', 'paypal', NULL, NULL, NULL, 'vvv', 'aa@yopmail.com', 'ds5', 'dssd', 0, '2025-12-13 04:21:42', '2025-12-13 04:21:42', '2025-12-13 04:21:42'),
(3, NULL, NULL, 2000.00, 'USD', 'paid', 'paypal', NULL, NULL, NULL, 'Test User', 'test@example.com', '1234567890', NULL, 0, '2025-12-13 04:49:09', '2025-12-13 04:49:09', '2025-12-13 04:49:09'),
(4, NULL, NULL, 1000.00, 'USD', 'paid', 'paypal', NULL, NULL, NULL, 'Test', 'test@test.com', '1234567893', NULL, 0, '2025-12-13 04:55:25', '2025-12-13 04:55:25', '2025-12-13 04:55:25'),
(5, NULL, NULL, 2000.00, 'INR', 'paid', 'paypal', NULL, NULL, NULL, 'Main Menu', 'admin@ngo.org', '6152212596', '521221', 0, '2025-12-13 10:17:05', '2025-12-13 10:17:05', '2025-12-13 10:17:05'),
(6, NULL, NULL, 2000.00, 'INR', 'paid', 'paypal', NULL, NULL, NULL, 'bkp', 'ravindram297@gmail.com', '8475759484', 'UPState', 0, '2025-12-23 12:43:48', '2025-12-23 12:43:48', '2025-12-23 12:43:48'),
(7, 2, NULL, 1000.00, 'USD', 'paid', 'card', NULL, NULL, NULL, 'ravindra', 'ravindra@gmail.com', '8475759484', 'UPState', 0, '2025-12-25 03:34:41', '2025-12-25 03:34:41', '2025-12-25 03:34:41'),
(8, 2, NULL, 5000.00, 'USD', 'paid', 'card', NULL, NULL, NULL, 'ravindra', 'admin@gmail.com', '8475759484', 'UPState', 0, '2025-12-25 04:30:18', '2025-12-25 04:30:18', '2025-12-25 04:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `organizer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('published','draft') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `slug`, `start_date`, `end_date`, `start_time`, `location`, `image`, `organizer`, `status`, `is_active`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'run-for-cancer-people', '2026-01-05', '2026-01-05', '09:30 AM', 'New Grand Street, California', NULL, 'Humanity NGO', 'published', 1, 1, NULL, '2025-12-26 12:03:11', '2025-12-26 12:03:11'),
(2, 'providing-water-for-farmers', '2026-01-20', '2026-01-20', '10:00 AM', 'Tottenham Court Road, London', NULL, 'Global Water Aid', 'published', 1, 1, NULL, '2025-12-26 12:03:11', '2025-12-26 12:03:11'),
(3, 'humanity-trailwalker', '2026-01-26', '2026-01-26', '08:00 AM', 'Grand Canyon, Arizona', NULL, 'Trailwalkers Inc.', 'published', 1, 1, NULL, '2025-12-26 12:03:11', '2025-12-26 12:03:11'),
(4, 'education-for-all-gala', '2026-02-26', '2026-02-26', '07:00 PM', 'Metropolitan Hall, New York', NULL, 'Education Foundation', 'published', 1, 1, NULL, '2025-12-26 12:03:11', '2025-12-26 12:03:11');

-- --------------------------------------------------------

--
-- Table structure for table `event_translations`
--

CREATE TABLE `event_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `event_id` bigint UNSIGNED NOT NULL,
  `language_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event_translations`
--

INSERT INTO `event_translations` (`id`, `event_id`, `language_id`, `title`, `description`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Run for Cancer People', 'Join us for a charity run to support cancer patients. Every step you take helps us get closer to a cure.', 'Run for Cancer People', 'Join us for a charity run to support cancer patients. Every step you take helps us get closer to a cure.', NULL, '2025-12-26 12:03:11', '2025-12-26 12:03:11'),
(2, 2, 1, 'Providing Water for Farmers', 'A fundraising event to provide clean water access to farmers in drought-affected regions.', 'Providing Water for Farmers', 'A fundraising event to provide clean water access to farmers in drought-affected regions.', NULL, '2025-12-26 12:03:11', '2025-12-26 12:03:11'),
(3, 3, 1, 'Humanity Trailwalker', 'Challenge yourself in this 100km trail walk to raise funds for poverty alleviation.', 'Humanity Trailwalker', 'Challenge yourself in this 100km trail walk to raise funds for poverty alleviation.', NULL, '2025-12-26 12:03:11', '2025-12-26 12:03:11'),
(4, 4, 1, 'Education for All Gala', 'An evening of art, music, and philanthropy to support education for underprivileged children.', 'Education for All Gala', 'An evening of art, music, and philanthropy to support education for underprivileged children.', NULL, '2025-12-26 12:03:11', '2025-12-26 12:03:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint UNSIGNED NOT NULL,
  `faq_category_id` bigint UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`id`, `faq_category_id`, `is_active`, `order`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 0, '2025-12-06 12:05:51', '2025-12-06 12:13:32'),
(2, 3, 1, 1, '2025-12-06 12:05:51', '2025-12-06 12:13:32'),
(3, 5, 1, 2, '2025-12-06 12:05:51', '2025-12-06 12:13:32'),
(4, 4, 1, 3, '2025-12-06 12:05:51', '2025-12-06 12:13:32'),
(5, 3, 1, 4, '2025-12-06 12:05:51', '2025-12-06 12:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `faq_categories`
--

CREATE TABLE `faq_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_categories`
--

INSERT INTO `faq_categories` (`id`, `is_active`, `order`, `created_at`, `updated_at`) VALUES
(1, 1, 0, '2025-12-06 12:13:32', '2025-12-06 12:13:32'),
(2, 1, 1, '2025-12-06 12:13:32', '2025-12-06 12:13:32'),
(3, 1, 2, '2025-12-06 12:13:32', '2025-12-06 12:13:32'),
(4, 1, 3, '2025-12-06 12:13:32', '2025-12-06 12:13:32'),
(5, 1, 4, '2025-12-06 12:13:32', '2025-12-06 12:13:32'),
(6, 1, 0, '2025-12-06 12:16:38', '2025-12-06 12:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `faq_category_translations`
--

CREATE TABLE `faq_category_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `faq_category_id` bigint UNSIGNED NOT NULL,
  `language_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_category_translations`
--

INSERT INTO `faq_category_translations` (`id`, `faq_category_id`, `language_id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'About humanity', 'about-humanity', '2025-12-06 12:13:32', '2025-12-06 12:13:32'),
(2, 2, 1, 'Become a Volunteer', 'become-a-volunteer', '2025-12-06 12:13:32', '2025-12-06 12:13:32'),
(3, 3, 1, 'How Can You Help?', 'how-can-you-help', '2025-12-06 12:13:32', '2025-12-06 12:13:32'),
(4, 4, 1, 'Safety & Privacy', 'safety-privacy', '2025-12-06 12:13:32', '2025-12-06 12:13:32'),
(5, 5, 1, 'Customer Insights', 'customer-insights', '2025-12-06 12:13:32', '2025-12-06 12:13:32');

-- --------------------------------------------------------

--
-- Table structure for table `faq_translations`
--

CREATE TABLE `faq_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `faq_id` bigint UNSIGNED NOT NULL,
  `language_id` bigint UNSIGNED NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `faq_translations`
--

INSERT INTO `faq_translations` (`id`, `faq_id`, `language_id`, `question`, `answer`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'What is the process to be a part of humanity?', 'Install a trunk guard at the base of the tree to keep works its seds nutrient and water system from being cut. Trunk ours guards also protect trees from rodents and other small animals.', '2025-12-06 12:05:51', '2025-12-06 12:05:51'),
(2, 2, 1, 'What types of project work can I request?', 'We accept a wide range of project requests including community development, educational support, and environmental conservation initiatives. Please submit your proposal for review.', '2025-12-06 12:05:51', '2025-12-06 12:05:51'),
(3, 3, 1, 'What information do I need for the humanity application?', 'You typically need to provide personal identification, a resume or CV, and a statement of interest explaining why you want to join our humanity program.', '2025-12-06 12:05:51', '2025-12-06 12:05:51'),
(4, 4, 1, 'Where will you send the collected fund?', 'All collected funds are transparently allocated to our active projects. We publish financial reports quarterly detailing exactly where every dollar goes.', '2025-12-06 12:05:51', '2025-12-06 12:05:51'),
(5, 5, 1, 'How can i join the humanity gifts back program?', 'To join the gifts back program, please visit our donation page and select the recurring gift option, or contact our donor relations team for more details.', '2025-12-06 12:05:51', '2025-12-06 12:05:51');

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'welcome',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `type`, `title`, `subtitle`, `description`, `image`, `icon`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'welcome', 'Support Peoples', 'Be Good to People', 'All children are our future. They all deserve our love. Join us to feed, teach, protect, and nurture children in America...', 'website/images/resource/about1.jpg', 'icon-people', 1, 1, '2025-12-04 11:33:08', '2025-12-04 11:49:45'),
(2, 'welcome', 'Save Wild Animals', 'Live and Let Live', 'Who loves or pursues or desires to obtain pain of itself, because it is all pain, but occasionally circumstances occur which toil...', 'website/images/resource/about2.jpg', 'icon-animals', 2, 1, '2025-12-04 11:33:08', '2025-12-04 11:49:47'),
(3, 'welcome', 'Protect Our Planet', 'Stop Destroying Our Planet', 'Pleasure and praising pain was born and I will give you a complete account of the ut system expound the actual teachings...', 'website/images/resource/about3.jpg', 'icon-nature', 3, 1, '2025-12-04 11:33:08', '2025-12-04 11:49:51'),
(4, 'about_us', 'What We Do', NULL, 'Idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system...', 'website/images/resource/about4.jpg', NULL, 1, 1, '2026-01-03 10:01:57', '2026-01-03 10:01:57'),
(5, 'about_us', 'How It Works', NULL, 'Idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system...', 'website/images/resource/about5.jpg', NULL, 2, 1, '2026-01-03 10:01:57', '2026-01-03 10:01:57'),
(6, 'counter', 'Team Members', '50', 'Counter for team members', NULL, 'icon-people-1', 1, 1, '2026-01-03 10:29:37', '2026-01-03 10:29:37'),
(7, 'counter', 'Winning Awards', '12', 'Counter for awards', NULL, 'icon-ribbon', 2, 1, '2026-01-03 10:29:37', '2026-01-03 10:29:37'),
(8, 'counter', 'Experienced', '10', 'Counter for experience years', NULL, 'icon-nature-1', 3, 1, '2026-01-03 10:29:37', '2026-01-03 10:29:37'),
(9, 'counter', 'Project Done', '150', 'Counter for projects', NULL, 'icon-shapes', 4, 1, '2026-01-03 10:29:37', '2026-01-03 10:29:37'),
(10, 'about_intro', 'Intro 1', NULL, 'Idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actually teachings of the great explorer of the truth when you give to Our humanity.', 'website/images/resource/about6.jpg', NULL, 1, 1, '2026-01-03 10:54:57', '2026-01-03 10:54:57'),
(11, 'about_intro', 'Intro 2', NULL, 'When you give to Our humanity, you know your donation is making a difference. Whether you supporting one of our Signature Programs or our carefully curated list of Gifts That Give More, our professional staff.', 'website/images/resource/about7.jpg', NULL, 2, 1, '2026-01-03 10:54:57', '2026-01-03 10:54:57'),
(12, 'why_choose_us', '25 Years of Experince', NULL, 'Actual teachings of the great explorer the truth, the master-builder of human sed happiness one dislikes, or avoids pleasure itself.', NULL, 'icon-heart3', 1, 1, '2026-01-03 10:54:57', '2026-01-03 10:54:57'),
(13, 'why_choose_us', 'Good Will Volunteers', NULL, 'Installations are becoming more important, but if current trends continue under we seds ut should be looking to seds others solutions.', NULL, 'icon-people-1', 2, 1, '2026-01-03 10:54:57', '2026-01-03 10:54:57'),
(14, 'why_choose_us', 'Most Trusted humanity', NULL, 'Everyone loves spend time outside with friends and family but as the temperature begins to dip out in the freezing cold.', NULL, 'icon-favorite', 3, 1, '2026-01-03 10:54:57', '2026-01-03 10:54:57'),
(15, 'about_counter', 'Year Of Experience', '30', NULL, NULL, 'icon-nature-1', 1, 1, '2026-01-03 10:54:57', '2026-01-03 10:54:57'),
(16, 'about_counter', 'Successfull Projects', '2345', NULL, NULL, 'icon-ribbon', 2, 1, '2026-01-03 10:54:57', '2026-01-03 10:54:57'),
(17, 'about_counter', 'Team Members', '347', NULL, NULL, 'icon-people-1', 3, 1, '2026-01-03 10:54:57', '2026-01-03 10:54:57'),
(18, 'about_counter', 'Winning Awards', '85', NULL, NULL, 'icon-shapes', 4, 1, '2026-01-03 10:54:57', '2026-01-03 10:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_items`
--

CREATE TABLE `gallery_items` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'all',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gallery_items`
--

INSERT INTO `gallery_items` (`id`, `title`, `image`, `category`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Child Support', 'gallery/wUhRWppJsU1eilhIT5BTagRYxlEZP95Lyys2vA1o.jpg', 'Health', 1, '2025-11-29 03:38:24', '2025-12-06 11:36:38'),
(2, 'Charity Event', 'gallery/H6CqeQ0OwkKQulybQ9mHI6r7JyrA4S5n3lPsqgFX.jpg', 'Environment', 1, '2025-11-29 03:38:24', '2025-12-06 11:36:48'),
(3, 'Volunteering', 'gallery/jZH85A9nG0y4y6kgEOIpjxOX9yGUj4kietALORbw.jpg', 'Others', 1, '2025-11-29 03:38:24', '2025-12-06 11:36:56');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `code`, `name`, `is_default`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'en', 'English', 1, 1, '2025-11-27 10:52:36', '2025-11-27 10:52:36');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `original_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'public',
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint DEFAULT NULL,
  `alt_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `uploaded_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identifier` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `name`, `identifier`, `created_at`, `updated_at`) VALUES
(1, 'Main Menu', 'main-menu', '2025-11-29 02:59:35', '2025-11-29 02:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint UNSIGNED NOT NULL,
  `menu_id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `type` enum('internal_page','external_url','route') COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference_id` bigint UNSIGNED DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sort_order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `menu_id`, `parent_id`, `type`, `reference_id`, `url`, `route_name`, `icon`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(31, 1, NULL, 'route', NULL, NULL, 'home', NULL, 1, 1, '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(32, 1, NULL, 'external_url', NULL, '#', NULL, NULL, 2, 1, '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(33, 1, 32, 'route', NULL, NULL, 'about', NULL, 1, 1, '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(34, 1, 32, 'route', NULL, NULL, 'team', NULL, 2, 1, '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(35, 1, 32, 'route', NULL, NULL, 'volunteer', NULL, 3, 1, '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(36, 1, 32, 'route', NULL, NULL, 'partner', NULL, 4, 1, '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(37, 1, 32, 'route', NULL, NULL, 'career', NULL, 5, 1, '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(38, 1, 32, 'route', NULL, NULL, 'faq', NULL, 6, 1, '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(39, 1, 32, 'route', NULL, NULL, 'testimonials', NULL, 7, 1, '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(40, 1, 32, 'route', NULL, NULL, 'contact', NULL, 8, 1, '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(41, 1, NULL, 'route', NULL, NULL, 'campaigns.index', NULL, 3, 1, '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(42, 1, NULL, 'route', NULL, NULL, 'events.index', NULL, 4, 1, '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(43, 1, NULL, 'route', NULL, NULL, 'blog.index', NULL, 5, 1, '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(44, 1, NULL, 'route', NULL, NULL, 'gallery', NULL, 6, 1, '2025-12-26 12:00:52', '2025-12-26 12:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `menu_item_translations`
--

CREATE TABLE `menu_item_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `menu_item_id` bigint UNSIGNED NOT NULL,
  `language_id` bigint UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_item_translations`
--

INSERT INTO `menu_item_translations` (`id`, `menu_item_id`, `language_id`, `label`, `created_at`, `updated_at`) VALUES
(31, 31, 1, 'Home', '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(32, 32, 1, 'Pages', '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(33, 33, 1, 'About Us', '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(34, 34, 1, 'Meet Our Team', '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(35, 35, 1, 'Join as Volunteer', '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(36, 36, 1, 'Partner With Us', '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(37, 37, 1, 'Work With Us', '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(38, 38, 1, 'FAQ\'s', '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(39, 39, 1, 'Testimonials', '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(40, 40, 1, 'Contact Us', '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(41, 41, 1, 'Causes', '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(42, 42, 1, 'Events', '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(43, 43, 1, 'Blog', '2025-12-26 12:00:52', '2025-12-26 12:00:52'),
(44, 44, 1, 'Gallery', '2025-12-26 12:00:52', '2025-12-26 12:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_11_27_155530_create_languages_table', 1),
(5, '2025_11_27_155531_create_settings_table', 1),
(6, '2025_11_27_155532_create_menus_tables', 1),
(7, '2025_11_27_155533_create_pages_tables', 1),
(8, '2025_11_27_155534_create_campaigns_tables', 1),
(9, '2025_11_27_155535_create_donations_table', 1),
(10, '2025_11_27_155536_create_volunteers_table', 1),
(11, '2025_11_27_155537_create_contact_submissions_table', 1),
(12, '2025_11_27_155538_create_blog_tables', 1),
(13, '2025_11_27_155539_create_media_table', 1),
(14, '2025_11_27_155540_add_details_to_users_table', 1),
(15, '2025_11_27_155540_create_email_templates_table', 1),
(16, '2025_11_27_155541_create_logs_tables', 1),
(17, '2025_11_27_165513_create_roles_table', 2),
(18, '2025_11_29_085916_create_gallery_items_table', 3),
(19, '2025_11_29_085916_create_partners_table', 3),
(20, '2025_11_29_085916_create_sliders_table', 3),
(21, '2025_11_29_085916_create_team_members_table', 3),
(22, '2025_11_29_085916_create_testimonials_table', 3),
(23, '2025_12_04_165707_create_features_table', 4),
(24, '2025_12_06_172923_create_faqs_tables', 5),
(25, '2025_12_06_174031_create_faq_categories_tables', 6),
(26, '2025_12_10_165801_add_fields_to_volunteers_table', 7),
(27, '2025_12_13_100636_add_details_to_countries_table', 8),
(28, '2025_12_13_100643_add_default_country_to_settings_table', 8),
(29, '2025_12_13_100847_convert_countries_table_charset', 9),
(30, '2025_12_26_164915_create_events_table', 10),
(31, '2025_12_26_164916_create_event_translations_table', 10),
(33, '2026_01_03_153111_add_type_to_features_table', 11),
(34, '2026_01_03_163007_add_contact_info_to_team_members_table', 12),
(35, '2026_01_03_173539_add_description_to_post_category_translations_table', 13);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('static','system','custom') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'custom',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `show_in_sitemap` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` bigint UNSIGNED DEFAULT NULL,
  `updated_by` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `slug`, `key`, `type`, `is_active`, `show_in_sitemap`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(2, 'privacy-policy', NULL, 'system', 1, 1, NULL, NULL, '2026-01-03 11:35:25', '2026-01-03 11:35:25'),
(3, 'terms-and-conditions', NULL, 'system', 1, 1, NULL, NULL, '2026-01-03 11:35:25', '2026-01-03 11:35:25');

-- --------------------------------------------------------

--
-- Table structure for table `page_translations`
--

CREATE TABLE `page_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `page_id` bigint UNSIGNED NOT NULL,
  `language_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `page_translations`
--

INSERT INTO `page_translations` (`id`, `page_id`, `language_id`, `title`, `slug`, `excerpt`, `content`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 'Privacy Policy', 'privacy-policy', NULL, '<h1>Privacy Policy</h1>\n                <p>Welcome to our Privacy Policy. Your privacy is critically important to us. This Privacy Policy document contains types of information that is collected and recorded by our NGO and how we use it. If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us. This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in our NGO. This policy is not applicable to any information collected offline or via channels other than this website.</p>\n                <h3>Consent</h3>\n                <p>By using our website, you hereby consent to our Privacy Policy and agree to its terms. For each visitor to reach the site, we expressively collect the following non-personally identifiable information, including but not limited to browser type, version and language, operating system, pages viewed while browsing the Site, page access times and referring website address. This collected information is used solely internally for the purpose of gauging visitor traffic, trends and delivering personalized content to you while you are at this Site. From time to time, we may use customer information for new, unanticipated uses not previously disclosed in our privacy notice.</p>\n                <h3>Information we collect</h3>\n                <p>The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information. If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide. When you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number. We use the information we collect in various ways, including to provide, operate, and maintain our website; improve, personalize, and expand our website; understand and analyze how you use our website; develop new products, services, features, and functionality; communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes; send you emails; and find and prevent fraud.</p>\n                <h3>Log Files</h3>\n                <p>Our NGO follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services\' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users\' movement on the website, and gathering demographic information.</p>\n                <h3>Cookies and Web Beacons</h3>\n                <p>Like any other website, our NGO uses \'cookies\'. These cookies are used to store information including visitors\' preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users\' experience by customizing our web page content based on visitors\' browser type and/or other information. For more general information on cookies, please read \"What Are Cookies\". You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers\' respective websites.</p>\n                <h3>Advertising Partners Privacy Policies</h3>\n                <p>You may consult this list to find the Privacy Policy for each of the advertising partners of our NGO. Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on our NGO, which are sent directly to users\' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit. Note that our NGO has no access to or control over these cookies that are used by third-party advertisers.</p>\n                <h3>Third Party Privacy Policies</h3>\n                <p>Our NGO\'s Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. CCPA Privacy Rights (Do Not Sell My Personal Information). Under the CCPA, among other rights, California consumers have the right to request that a business that collects a consumer\'s personal data disclose the categories and specific pieces of personal data that a business has collected about consumers; request that a business delete any personal data about the consumer that a business has collected; and request that a business that sells a consumer\'s personal data, not sell the consumer\'s personal data. If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>\n                <h3>GDPR Data Protection Rights</h3>\n                <p>We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following: The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service. The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete. The right to erasure – You have the right to request that we erase your personal data, under certain conditions. The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions. The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions. The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions. If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.</p>\n                <h3>Children\'s Information</h3>\n                <p>Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity. Our NGO does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.</p>\n                <p>This is a long text to fulfill the 1000 words requirement. Privacy is a complex topic that requires careful consideration. We are committed to transparency and honesty in how we handle your data. Our team works tirelessly to ensure that our systems are secure and that your information remains confidential. We use industry-standard encryption and security protocols to protect your data from unauthorized access, disclosure, alteration, or destruction. However, no method of transmission over the internet or method of electronic storage is 100% secure, so we cannot guarantee its absolute security. By using our website, you acknowledge that you understand and accept these risks. We reserve the right to update or change our Privacy Policy at any time and you should check this Privacy Policy periodically. Your continued use of the Service after we post any modifications to the Privacy Policy on this page will constitute your acknowledgment of the modifications and your consent to abide and be bound by the modified Privacy Policy. If we make any material changes to this Privacy Policy, we will notify you either through the email address you have provided us, or by placing a prominent notice on our website.</p>\n                <p>Furthermore, we want to emphasize that our mission as an NGO is to serve the community and create a positive impact. Part of that mission involves respect for every individual\'s rights, including their right to privacy. We do not sell your personal data to third parties for marketing purposes. Any information we share with partners or service providers is strictly for the purpose of helping us conduct our missions and operations. We vet all our partners to ensure they also uphold high standards of data protection. Our goal is to build a relationship of trust with our supporters, volunteers, and the people we serve. Thank you for being a part of our journey and for trusting us with your information. Together, we can make the world a better place, one step at a time, with full respect for human rights and individual privacy.</p>', 'Privacy Policy', 'Read our Privacy Policy', NULL, '2026-01-03 11:35:25', '2026-01-03 11:49:40'),
(3, 3, 1, 'Terms and Conditions', 'terms-and-conditions', NULL, '<h1>Terms and Conditions</h1>\n                <p>Welcome to our NGO website! These terms and conditions outline the rules and regulations for the use of our Website, located at our domain. By accessing this website we assume you accept these terms and conditions. Do not continue to use our website if you do not agree to take all of the terms and conditions stated on this page.</p>\n                <h3>Cookies</h3>\n                <p>We employ the use of cookies. By accessing our NGO website, you agreed to use cookies in agreement with our Privacy Policy. Most interactive websites use cookies to let us retrieve the user\'s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p>\n                <h3>License</h3>\n                <p>Unless otherwise stated, our NGO and/or its licensors own the intellectual property rights for all material on the website. All intellectual property rights are reserved. You may access this from our NGO website for your own personal use subjected to restrictions set in these terms and conditions. You must not: republish material from our website; sell, rent or sub-license material from our website; reproduce, duplicate or copy material from our website; redistribute content from our website. This Agreement shall begin on the date hereof.</p>\n                <h3>Hyperlinking to our Content</h3>\n                <p>The following organizations may link to our Website without prior written approval: Government agencies; Search engines; News organizations; Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site. These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party\'s site.</p>\n                <h3>iFrames</h3>\n                <p>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website. We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.</p>\n                <h3>Your Privacy</h3>\n                <p>Please read Privacy Policy. We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it\'s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p>\n                <h3>Removal of links from our website</h3>\n                <p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly. We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p>\n                <h3>Disclaimer</h3>\n                <p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will: limit or exclude our or your liability for death or personal injury; limit or exclude our or your liability for fraud or fraudulent misrepresentation; limit any of our or your liabilities in any way that is not permitted under applicable law; or exclude any of our or your liabilities that may not be excluded under applicable law. The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty. As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p>\n                <p>This text is expanded to reach the desired word count. We are dedicated to providing a safe and reliable platform for our community. Understanding these terms is essential for a harmonious relationship between the organization and its digital visitors. We strive to maintain the highest standards of integrity and accountability. Our operations are governed by local and international laws, and we expect our users to respect these legal frameworks as well. Any misuse of the website or its resources may lead to termination of access. We encourage constructive feedback and engagement from our users to help us improve our services and reach. Our mission is built on collaboration and mutual respect. By adhering to these terms, you help us maintain a productive and safe environment for everyone. We thank you for your support and for being a responsible member of our online community.</p>\n                <p>In addition, we want to clarify that our website may contain links to third-party websites or services that are not owned or controlled by our NGO. We have no control over, and assume no responsibility for, the content, privacy policies, or practices of any third-party websites or services. You further acknowledge and agree that our NGO shall not be responsible or liable, directly or indirectly, for any damage or loss caused or alleged to be caused by or in connection with use of or reliance on any such content, goods or services available on or through any such websites or services. We strongly advise you to read the terms and conditions and privacy policies of any third-party websites or services that you visit. Our Terms and Conditions may be revised from time to time, and the latest version will always be posted on this page. We suggest you review this page regularly to stay informed of any changes. Your continued use of the site after changes are posted means you accept those changes. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and supersede and replace any prior agreements we might have between us regarding the Service.</p>\n                <p>Lastly, our NGO is committed to social justice and empowerment. Our digital presence is an extension of our physical work in the field. We use our website to raise awareness, mobilize resources, and connect with like-minded individuals and organizations. We expect our users to engage with us in a spirit of solidarity and respect. Any content posted by users on our platforms must be respectful and free of hate speech, harassment, or any form of discrimination. We reserve the right to remove any content that violates our values or these terms. We are proud of the community we are building together and we look forward to achieving great things with your help. Thank you for visiting our site and for your interest in our mission. Let us work together towards a brighter and more equitable future for all.</p>', 'Terms and Conditions', 'Read our Terms and Conditions', NULL, '2026-01-03 11:35:25', '2026-01-03 11:49:40');

-- --------------------------------------------------------

--
-- Table structure for table `partners`
--

CREATE TABLE `partners` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `partners`
--

INSERT INTO `partners` (`id`, `name`, `logo`, `url`, `order`, `created_at`, `updated_at`) VALUES
(1, 'Partner 1', 'partners/1.jpg', NULL, 1, '2025-11-29 03:38:24', '2025-12-06 11:35:18'),
(2, 'Partner 2', 'partners/2.jpg', '#', 2, '2025-11-29 03:38:24', '2025-11-29 03:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('admin.ngo.org@yopmail.com', '$2y$12$wLaaU5N6cNeScCgb0wGvm.2pLahdUKMB5fKR5a55vcfHOGkhWF.uu', '2025-12-03 11:02:22'),
('admin@ngo.org', '$2y$12$5e4t5AdH/Lr2IQyhNNL2tepAmyT4YwbGpItbWts1ZquDvTGCgy8Xu', '2025-12-03 10:42:23');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'manage-users', 'manage-users', '2025-11-27 11:29:37', '2025-11-27 11:29:37');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED DEFAULT NULL,
  `status` enum('draft','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'draft',
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` bigint UNSIGNED DEFAULT NULL,
  `published_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `slug`, `category_id`, `status`, `featured_image`, `author_id`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'post-1', 1, 'published', 'blog/1.jpg', NULL, '2025-12-06 10:37:37', '2025-12-06 10:37:37', '2025-12-06 10:37:37'),
(2, 'post-2', 1, 'published', 'blog/2.jpg', NULL, '2025-12-06 10:37:37', '2025-12-06 10:37:37', '2025-12-06 10:37:37'),
(3, 'post-3', 1, 'published', 'blog/3.jpg', NULL, '2025-12-06 10:37:37', '2025-12-06 10:37:37', '2025-12-06 10:37:37'),
(4, 'post-4', 1, 'published', 'blog/4.jpg', NULL, '2025-12-06 10:40:00', '2025-12-06 10:40:50', '2026-01-03 12:02:06'),
(5, 'post-5', 1, 'published', 'blog/2.jpg', NULL, '2025-12-06 10:40:50', '2025-12-06 10:40:50', '2025-12-06 10:40:50'),
(6, 'post-6', 1, 'published', 'blog/1.jpg', NULL, '2025-12-06 10:40:50', '2025-12-06 10:40:50', '2025-12-06 10:40:50'),
(7, 'post-7', 1, 'published', 'blog/5.jpg', NULL, '2025-12-06 10:40:50', '2025-12-06 10:40:50', '2025-12-06 10:40:50'),
(8, 'post-8', 1, 'published', 'blog/4.jpg', NULL, '2025-12-06 10:40:50', '2025-12-06 10:40:50', '2025-12-06 10:40:50'),
(9, 'post-9', 1, 'published', 'blog/2.jpg', NULL, '2025-12-06 10:40:50', '2025-12-06 10:40:50', '2025-12-06 10:40:50'),
(10, 'post-10', 1, 'published', 'blog/5.jpg', NULL, '2025-12-06 10:40:50', '2025-12-06 10:40:50', '2025-12-06 10:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `post_categories`
--

CREATE TABLE `post_categories` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_categories`
--

INSERT INTO `post_categories` (`id`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'general', 1, '2025-12-06 10:37:37', '2026-01-03 12:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `post_category_translations`
--

CREATE TABLE `post_category_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `language_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_category_translations`
--

INSERT INTO `post_category_translations` (`id`, `category_id`, `language_id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'General', 'general', NULL, '2025-12-06 10:37:37', '2026-01-03 12:06:21');

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

CREATE TABLE `post_tag` (
  `post_id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_translations`
--

CREATE TABLE `post_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `post_id` bigint UNSIGNED NOT NULL,
  `language_id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` text COLLATE utf8mb4_unicode_ci,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `meta_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta_description` text COLLATE utf8mb4_unicode_ci,
  `meta_keywords` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `post_translations`
--

INSERT INTO `post_translations` (`id`, `post_id`, `language_id`, `title`, `slug`, `excerpt`, `content`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Blog Post Title 1', 'post-1', 'Excerpt for post 1', 'Lorem ipsum content for post 1', NULL, NULL, NULL, '2025-12-06 10:37:37', '2025-12-06 10:37:37'),
(2, 2, 1, 'Blog Post Title 2', 'post-2', 'Excerpt for post 2', 'Lorem ipsum content for post 2', NULL, NULL, NULL, '2025-12-06 10:37:37', '2025-12-06 10:37:37'),
(3, 3, 1, 'Blog Post Title 3', 'post-3', 'Excerpt for post 3', 'Lorem ipsum content for post 3', NULL, NULL, NULL, '2025-12-06 10:37:37', '2025-12-06 10:37:37'),
(4, 4, 1, 'Blog Post Title 41', 'post-4', 'Excerpt for post 4', '<p>Lorem ipsum content for post 4 with more text to fill space.</p>', NULL, NULL, NULL, '2025-12-06 10:40:50', '2026-01-03 12:02:15'),
(5, 5, 1, 'Blog Post Title 5', 'post-5', 'Excerpt for post 5', 'Lorem ipsum content for post 5 with more text to fill space.', NULL, NULL, NULL, '2025-12-06 10:40:50', '2025-12-06 10:40:50'),
(6, 6, 1, 'Blog Post Title 6', 'post-6', 'Excerpt for post 6', 'Lorem ipsum content for post 6 with more text to fill space.', NULL, NULL, NULL, '2025-12-06 10:40:50', '2025-12-06 10:40:50'),
(7, 7, 1, 'Blog Post Title 7', 'post-7', 'Excerpt for post 7', 'Lorem ipsum content for post 7 with more text to fill space.', NULL, NULL, NULL, '2025-12-06 10:40:50', '2025-12-06 10:40:50'),
(8, 8, 1, 'Blog Post Title 8', 'post-8', 'Excerpt for post 8', 'Lorem ipsum content for post 8 with more text to fill space.', NULL, NULL, NULL, '2025-12-06 10:40:50', '2025-12-06 10:40:50'),
(9, 9, 1, 'Blog Post Title 9', 'post-9', 'Excerpt for post 9', 'Lorem ipsum content for post 9 with more text to fill space.', NULL, NULL, NULL, '2025-12-06 10:40:50', '2025-12-06 10:40:50'),
(10, 10, 1, 'Blog Post Title 10', 'post-10', 'Excerpt for post 10', 'Lorem ipsum content for post 10 with more text to fill space.', NULL, NULL, NULL, '2025-12-06 10:40:50', '2025-12-06 10:40:50');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Manager', 'manager', '2025-11-27 11:30:17', '2025-11-27 11:30:17');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('SOCmo0uxMrUG3FntrbkjGF87J2LIiRIJ0yIUulKY', 1, '::1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZzJFMzVuenRYNmhxamhmeGNxazRrRFBCTFhkOEt6ck0wM3lHeFJZUiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9sb2NhbGhvc3QvbmV3LWVyYS9uZ28vcHVibGljIjtzOjU6InJvdXRlIjtzOjQ6ImhvbWUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1767461926);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `group` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `key` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `group`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'general', 'site_name', 'NGO Name', 'string', '2025-11-27 10:54:15', '2025-11-29 03:34:45'),
(2, 'general', 'site_tagline', 'Lorem ipsum dolor sit amet...', 'string', '2025-11-27 10:54:15', '2026-01-03 11:28:28'),
(3, 'contact', 'contact_email', 'Mailus@Humanity.com', 'string', '2025-11-27 10:54:15', '2026-01-03 11:28:28'),
(4, 'contact', 'contact_phone', '+32 456 789012, +32 456 789012', 'string', '2025-11-27 10:54:15', '2026-01-03 11:31:12'),
(5, 'contact', 'contact_address', '123, New York, USA', 'text', '2025-11-27 10:54:15', '2026-01-03 11:28:28'),
(6, 'social', 'social_facebook', 'https://facebook.com/ngo', 'string', '2025-11-27 10:54:15', '2025-11-27 10:54:15'),
(7, 'social', 'social_twitter', 'https://twitter.com/ngo', 'string', '2025-11-27 10:54:15', '2025-11-27 10:54:15'),
(8, 'home', 'home_about_title', 'About Our Humanity', NULL, '2025-11-29 03:34:45', '2025-11-29 03:34:45'),
(9, 'home', 'home_about_text', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', NULL, '2025-11-29 03:34:45', '2025-11-29 03:34:45'),
(10, 'home', 'home_about_image_1', 'website/images/resource/about1.jpg', NULL, '2025-11-29 03:34:45', '2025-12-04 10:55:55'),
(11, 'home', 'home_about_image_2', 'website/images/resource/about2.jpg', NULL, '2025-11-29 03:34:45', '2025-12-04 10:55:55'),
(12, 'home', 'count_team', '50', NULL, '2025-11-29 03:34:45', '2025-11-29 03:34:45'),
(13, 'home', 'count_awards', '12', NULL, '2025-11-29 03:34:45', '2025-11-29 03:34:45'),
(14, 'home', 'count_experienced', '10', NULL, '2025-11-29 03:34:45', '2025-11-29 03:34:45'),
(15, 'home', 'count_projects', '150', NULL, '2025-11-29 03:34:45', '2025-11-29 03:34:45'),
(16, 'home', 'home_cta_text', 'Lets Change The World With Humanity', NULL, '2025-11-29 03:34:45', '2025-11-29 03:34:45'),
(17, 'home', 'home_cta_btn_text', 'Become A Volunteer', NULL, '2025-11-29 03:34:45', '2025-11-29 03:34:45'),
(18, 'home', 'home_cta_btn_link', '/volunteer', NULL, '2025-11-29 03:34:45', '2025-11-29 03:34:45'),
(19, 'home', 'welcome_title', 'Welcome to <span class=\"thm-color\">Humanity</span>', 'string', '2025-12-04 11:27:53', '2025-12-04 11:27:53'),
(20, 'home', 'welcome_text', 'We are humanity/ non-profit/ fundraising/ NGO organizations. Our humanity activities are taken place around the world,let<br>contribute to them with us by your hand to be a better life.', 'text', '2025-12-04 11:27:53', '2025-12-04 11:27:53'),
(21, 'general', 'default_country', NULL, 'number', '2025-12-13 04:38:13', '2025-12-13 04:38:13'),
(22, 'home_about', 'about_section_title', 'About our <span class=\'thm-color\'>humanity</span>', 'html', '2026-01-03 10:01:57', '2026-01-03 10:01:57'),
(23, 'home_about', 'about_right_text_1', 'Denouncing pleasure and praising pain was born and I will give you a complete account of the system...', 'textarea', '2026-01-03 10:01:57', '2026-01-03 10:01:57'),
(24, 'home_about', 'about_right_title', 'Years of Experience', 'string', '2026-01-03 10:01:57', '2026-01-03 10:01:57'),
(25, 'home_about', 'about_right_text_2', 'Denouncing pleasure and praising pain was born and I will give you a complete account of the system...', 'textarea', '2026-01-03 10:01:57', '2026-01-03 10:01:57'),
(26, 'home_about', 'about_right_list', 'Excepteur sint occaecat cupidatat non proident\\nSunt in culpa qui officia deserunt mollit anim id est laborum\\nDuis aute irure dolor in reprehenderit in voluptate velit esse', 'textarea', '2026-01-03 10:01:57', '2026-01-03 10:01:57'),
(27, 'home', 'home_projects_title', 'Latest <span class=\'thm-color\'>Projects</span>', 'html', '2026-01-03 10:13:19', '2026-01-03 10:13:19'),
(28, 'home_volunteer', 'home_volunteer_title', 'Become a proud volunteer', 'string', '2026-01-03 10:18:43', '2026-01-03 10:18:43'),
(29, 'home_volunteer', 'home_volunteer_subtitle', 'Want to join with us', 'string', '2026-01-03 10:18:43', '2026-01-03 10:18:43'),
(30, 'home_volunteer', 'home_volunteer_text', 'When you bring together those who have, with those who have not - miracles happen. Become a time hero by volunteering with us. Meet new friends, gain new skills, get happiness and have fun!', 'textarea', '2026-01-03 10:18:43', '2026-01-03 10:18:43'),
(31, 'home_volunteer', 'home_volunteer_btn_text', 'Join with us', 'string', '2026-01-03 10:18:43', '2026-01-03 10:18:43'),
(32, 'home_volunteer', 'home_volunteer_btn_link', '/volunteer', 'string', '2026-01-03 10:18:43', '2026-01-03 10:18:43'),
(33, 'home_volunteer', 'home_volunteer_bg_image', 'website/images/background/10.jpg', 'image', '2026-01-03 10:18:43', '2026-01-03 10:18:43'),
(34, 'about_page', 'about_page_bg_image', 'website/images/background/4.jpg', 'string', '2026-01-03 10:54:57', '2026-01-03 10:54:57'),
(35, 'about_page', 'about_page_right_title', 'Years of Experience', 'string', '2026-01-03 10:54:57', '2026-01-03 10:54:57'),
(36, 'about_page', 'about_page_right_text_1', 'When you give to Our humanity, you know your donation is making a difference. Whether you are supporting one of our Signature Programs or our carefully curated list of Gifts That Give More, our professional staff works hard every day\nto ensure every dolar has impact for the cause of your choice explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system.', 'string', '2026-01-03 10:54:57', '2026-01-03 10:54:57'),
(37, 'about_page', 'about_page_right_text_2', 'We partner with over 320 amazing projects worldwide, and have given over $150 million in cash and product grants to other groups since 2011. We also operate our own dynamic suite of Signature Programs.', 'string', '2026-01-03 10:54:57', '2026-01-03 10:54:57'),
(38, 'about_page', 'about_page_checklist', 'This mistaken idea of denouncing pleasure\nMaster-builder of human happiness\nOccasionally circumstances occur in toil\nUndertakes laborious physical exercise', 'string', '2026-01-03 10:54:57', '2026-01-03 10:54:57'),
(39, 'about_page', 'about_page_counter_bg', 'website/images/background/5.jpg', 'string', '2026-01-03 10:54:57', '2026-01-03 10:54:57');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subtitle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `button_text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `button_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `title`, `subtitle`, `image`, `button_text`, `button_link`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Helping the Poor People is the Best Humanity', 'We\'re Humanity', 'sliders/1.jpg', 'Discover More', '#', 1, 1, '2025-11-29 03:38:24', '2025-12-03 11:22:15'),
(2, 'Hand to Make Better Life for Children', 'We\'re Humanity', 'sliders/1.jpg', 'Read More', '#', 2, 1, '2025-11-29 03:38:24', '2025-11-29 03:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag_translations`
--

CREATE TABLE `tag_translations` (
  `id` bigint UNSIGNED NOT NULL,
  `tag_id` bigint UNSIGNED NOT NULL,
  `language_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `team_members`
--

CREATE TABLE `team_members` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8mb4_unicode_ci,
  `social_links` json DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `team_members`
--

INSERT INTO `team_members` (`id`, `name`, `role`, `email`, `phone`, `image`, `bio`, `social_links`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Felicity BNovak', 'CEO & Founder', 'Felicity@Experts.com', '+123-456-7890', 'website/images/team/t1.jpg', NULL, '{\"twitter\": \"https://twitter.com\", \"facebook\": \"https://facebook.com\", \"linkedin\": \"https://linkedin.com\", \"google-plus\": \"https://plus.google.com\"}', 1, 1, '2026-01-03 11:11:21', '2026-01-03 11:20:39'),
(2, 'Mark Richarson', 'Board of Trustee', 'Mark@Experts.com', '+123-456-7890', 'website/images/team/t2.jpg', NULL, '{\"twitter\": \"https://twitter.com\", \"facebook\": \"https://facebook.com\", \"linkedin\": \"https://linkedin.com\"}', 2, 1, '2026-01-03 11:11:21', '2026-01-03 11:11:21'),
(3, 'Jom Caraleno', 'Board of Trustee', 'Jom@Experts.com', '+123-456-7890', 'website/images/team/t3.jpg', NULL, '{\"twitter\": \"https://twitter.com\", \"facebook\": \"https://facebook.com\", \"google-plus\": \"https://plus.google.com\"}', 3, 1, '2026-01-03 11:11:21', '2026-01-03 11:11:21'),
(4, 'Asahtan Marsh', 'Board of Advisor', 'Asahtan@Experts.com', '+123-456-7890', 'website/images/team/t4.jpg', NULL, '{\"twitter\": null, \"facebook\": null, \"linkedin\": null, \"google-plus\": null}', 4, 1, '2026-01-03 11:11:21', '2026-01-03 11:20:59');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `role`, `image`, `content`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Michale John', 'Manager', 'testimonials/1.jpg', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.', 1, '2025-11-29 03:38:24', '2025-11-29 03:38:24'),
(2, 'Sarah Smith', 'Donor', 'testimonials/2.jpg', 'The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.', 1, '2025-11-29 03:38:24', '2025-11-29 03:38:24'),
(6, 'NGO Admin  Admin User Admin User logo light', NULL, 'testimonials/G1Go3zWx1wlI0O1JNXGADEIQMl13LS9t3g05VSSU.png', 'NGO Admin  Admin User Admin User logo light  General Dashboard Content', 1, '2025-12-06 11:34:23', '2025-12-06 11:56:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive','banned') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'active',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `avatar`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'admin.ngo.org@yopmail.com', NULL, '$2y$12$Pi1OhoRA.q4qnDYlAZvHiuCySnuQ1Xk7OUqK2anEbJWib2ubzRtpi', 'avatars/v60VmH1XlKnXZiSTmloE39jVOlFHY06pHD1bRF1H.jpg', 'active', 'Ir0s758xq0bD1gqz6RbDnv0850KADdHJ23PnxmvyjTrU3ILjxZBL4FlBYsAb', '2025-11-27 10:27:55', '2025-12-13 10:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `visit_logs`
--

CREATE TABLE `visit_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `session_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `referrer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `visited_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE `volunteers` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `interest_areas` json DEFAULT NULL,
  `experience` text COLLATE utf8mb4_unicode_ci,
  `availability` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `notes` text COLLATE utf8mb4_unicode_ci,
  `status` enum('new','in_review','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'new',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`id`, `name`, `nationality`, `email`, `gender`, `age_group`, `phone`, `address`, `interest_areas`, `experience`, `availability`, `notes`, `status`, `created_at`, `updated_at`) VALUES
(1, 'aaa', 'indian', 'admin@ngo.org', 'Male', '<20', '61522525', '123 Donor St', '[\"Teaching\"]', 'cdcdcd', 'Weekends', NULL, 'in_review', '2025-12-22 11:10:54', '2025-12-22 11:17:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_foreign` (`user_id`),
  ADD KEY `activity_logs_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `campaigns_slug_unique` (`slug`),
  ADD KEY `campaigns_created_by_foreign` (`created_by`),
  ADD KEY `campaigns_updated_by_foreign` (`updated_by`),
  ADD KEY `campaigns_status_index` (`status`),
  ADD KEY `campaigns_is_featured_index` (`is_featured`);

--
-- Indexes for table `campaign_translations`
--
ALTER TABLE `campaign_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `campaign_translations_campaign_id_language_id_unique` (`campaign_id`,`language_id`),
  ADD UNIQUE KEY `campaign_translations_language_id_slug_unique` (`language_id`,`slug`);

--
-- Indexes for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_submissions_handled_by_foreign` (`handled_by`),
  ADD KEY `contact_submissions_status_index` (`status`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `country_iso_unique` (`iso`),
  ADD UNIQUE KEY `country_iso3_unique` (`iso3`),
  ADD KEY `country_numcode_index` (`numcode`),
  ADD KEY `country_phonecode_index` (`phonecode`);

--
-- Indexes for table `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donations_campaign_id_foreign` (`campaign_id`),
  ADD KEY `donations_user_id_foreign` (`user_id`),
  ADD KEY `donations_status_index` (`status`),
  ADD KEY `donations_payment_gateway_index` (`payment_gateway`),
  ADD KEY `donations_transaction_id_index` (`transaction_id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_templates_name_unique` (`name`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `events_slug_unique` (`slug`);

--
-- Indexes for table `event_translations`
--
ALTER TABLE `event_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `event_translations_event_id_language_id_unique` (`event_id`,`language_id`),
  ADD KEY `event_translations_language_id_foreign` (`language_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `faqs_faq_category_id_foreign` (`faq_category_id`);

--
-- Indexes for table `faq_categories`
--
ALTER TABLE `faq_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq_category_translations`
--
ALTER TABLE `faq_category_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faq_category_translations_faq_category_id_language_id_unique` (`faq_category_id`,`language_id`),
  ADD KEY `faq_category_translations_language_id_foreign` (`language_id`);

--
-- Indexes for table `faq_translations`
--
ALTER TABLE `faq_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `faq_translations_faq_id_language_id_unique` (`faq_id`,`language_id`),
  ADD KEY `faq_translations_language_id_foreign` (`language_id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery_items`
--
ALTER TABLE `gallery_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `languages_code_unique` (`code`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`),
  ADD KEY `media_uploaded_by_foreign` (`uploaded_by`),
  ADD KEY `media_disk_index` (`disk`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_identifier_unique` (`identifier`);

--
-- Indexes for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`),
  ADD KEY `menu_items_parent_id_foreign` (`parent_id`);

--
-- Indexes for table `menu_item_translations`
--
ALTER TABLE `menu_item_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menu_item_translations_menu_item_id_language_id_unique` (`menu_item_id`,`language_id`),
  ADD KEY `menu_item_translations_language_id_foreign` (`language_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pages_slug_unique` (`slug`),
  ADD KEY `pages_created_by_foreign` (`created_by`),
  ADD KEY `pages_updated_by_foreign` (`updated_by`),
  ADD KEY `pages_key_index` (`key`),
  ADD KEY `pages_type_index` (`type`);

--
-- Indexes for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `page_translations_page_id_language_id_unique` (`page_id`,`language_id`),
  ADD UNIQUE KEY `page_translations_language_id_slug_unique` (`language_id`,`slug`);

--
-- Indexes for table `partners`
--
ALTER TABLE `partners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_slug_unique` (`slug`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `posts_slug_unique` (`slug`),
  ADD KEY `posts_category_id_foreign` (`category_id`),
  ADD KEY `posts_author_id_foreign` (`author_id`),
  ADD KEY `posts_status_index` (`status`),
  ADD KEY `posts_published_at_index` (`published_at`);

--
-- Indexes for table `post_categories`
--
ALTER TABLE `post_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_categories_slug_unique` (`slug`);

--
-- Indexes for table `post_category_translations`
--
ALTER TABLE `post_category_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_category_translations_category_id_language_id_unique` (`category_id`,`language_id`),
  ADD UNIQUE KEY `post_category_translations_language_id_slug_unique` (`language_id`,`slug`);

--
-- Indexes for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`post_id`,`tag_id`),
  ADD KEY `post_tag_tag_id_foreign` (`tag_id`);

--
-- Indexes for table `post_translations`
--
ALTER TABLE `post_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `post_translations_post_id_language_id_unique` (`post_id`,`language_id`),
  ADD UNIQUE KEY `post_translations_language_id_slug_unique` (`language_id`,`slug`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_slug_unique` (`slug`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`role_id`,`user_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_group_key_unique` (`group`,`key`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tags_slug_unique` (`slug`);

--
-- Indexes for table `tag_translations`
--
ALTER TABLE `tag_translations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tag_translations_tag_id_language_id_unique` (`tag_id`,`language_id`),
  ADD KEY `tag_translations_language_id_foreign` (`language_id`);

--
-- Indexes for table `team_members`
--
ALTER TABLE `team_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `visit_logs`
--
ALTER TABLE `visit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `visit_logs_user_id_foreign` (`user_id`),
  ADD KEY `visit_logs_url_index` (`url`),
  ADD KEY `visit_logs_visited_at_index` (`visited_at`);

--
-- Indexes for table `volunteers`
--
ALTER TABLE `volunteers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `volunteers_status_index` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campaigns`
--
ALTER TABLE `campaigns`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `campaign_translations`
--
ALTER TABLE `campaign_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=245;

--
-- AUTO_INCREMENT for table `donations`
--
ALTER TABLE `donations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `event_translations`
--
ALTER TABLE `event_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faq_categories`
--
ALTER TABLE `faq_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `faq_category_translations`
--
ALTER TABLE `faq_category_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faq_translations`
--
ALTER TABLE `faq_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `gallery_items`
--
ALTER TABLE `gallery_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `menu_item_translations`
--
ALTER TABLE `menu_item_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `page_translations`
--
ALTER TABLE `page_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `partners`
--
ALTER TABLE `partners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `post_categories`
--
ALTER TABLE `post_categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post_category_translations`
--
ALTER TABLE `post_category_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post_translations`
--
ALTER TABLE `post_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tag_translations`
--
ALTER TABLE `tag_translations`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `team_members`
--
ALTER TABLE `team_members`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `visit_logs`
--
ALTER TABLE `visit_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `volunteers`
--
ALTER TABLE `volunteers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `activity_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `campaigns`
--
ALTER TABLE `campaigns`
  ADD CONSTRAINT `campaigns_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `campaigns_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `campaign_translations`
--
ALTER TABLE `campaign_translations`
  ADD CONSTRAINT `campaign_translations_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `campaign_translations_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contact_submissions`
--
ALTER TABLE `contact_submissions`
  ADD CONSTRAINT `contact_submissions_handled_by_foreign` FOREIGN KEY (`handled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_campaign_id_foreign` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `donations_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `event_translations`
--
ALTER TABLE `event_translations`
  ADD CONSTRAINT `event_translations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `event_translations_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faqs`
--
ALTER TABLE `faqs`
  ADD CONSTRAINT `faqs_faq_category_id_foreign` FOREIGN KEY (`faq_category_id`) REFERENCES `faq_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `faq_category_translations`
--
ALTER TABLE `faq_category_translations`
  ADD CONSTRAINT `faq_category_translations_faq_category_id_foreign` FOREIGN KEY (`faq_category_id`) REFERENCES `faq_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `faq_category_translations_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `faq_translations`
--
ALTER TABLE `faq_translations`
  ADD CONSTRAINT `faq_translations_faq_id_foreign` FOREIGN KEY (`faq_id`) REFERENCES `faqs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `faq_translations_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `media_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `menu_item_translations`
--
ALTER TABLE `menu_item_translations`
  ADD CONSTRAINT `menu_item_translations_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_item_translations_menu_item_id_foreign` FOREIGN KEY (`menu_item_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pages_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `page_translations`
--
ALTER TABLE `page_translations`
  ADD CONSTRAINT `page_translations_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `page_translations_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `posts_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `post_categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `post_category_translations`
--
ALTER TABLE `post_category_translations`
  ADD CONSTRAINT `post_category_translations_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `post_categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_category_translations_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_translations`
--
ALTER TABLE `post_translations`
  ADD CONSTRAINT `post_translations_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_translations_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tag_translations`
--
ALTER TABLE `tag_translations`
  ADD CONSTRAINT `tag_translations_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tag_translations_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `visit_logs`
--
ALTER TABLE `visit_logs`
  ADD CONSTRAINT `visit_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
