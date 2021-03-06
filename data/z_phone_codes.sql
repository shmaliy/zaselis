-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июл 02 2013 г., 12:15
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `zaselis`
--

-- --------------------------------------------------------

--
-- Структура таблицы `z_phone_codes`
--

DROP TABLE IF EXISTS `z_phone_codes`;
CREATE TABLE IF NOT EXISTS `z_phone_codes` (
  `z_phone_codes_id` int(11) NOT NULL AUTO_INCREMENT,
  `z_countries_id` int(11) NOT NULL,
  `z_countries_title` text NOT NULL,
  `code` int(10) NOT NULL,
  PRIMARY KEY (`z_phone_codes_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=379 ;

--
-- Дамп данных таблицы `z_phone_codes`
--

INSERT INTO `z_phone_codes` (`z_phone_codes_id`, `z_countries_id`, `z_countries_title`, `code`) VALUES
(1, 20, 'United States', 1),
(2, 21, 'Kazakhstan', 7),
(3, 22, 'Russia', 7),
(4, 23, 'Egypt', 20),
(5, 24, 'Algeria', 21),
(6, 25, 'Tunisia', 21),
(7, 26, 'South Africa', 27),
(8, 27, 'Greece', 30),
(9, 28, 'The Netherlands', 31),
(10, 29, 'Belgium', 32),
(11, 30, 'France', 33),
(12, 31, 'Spain', 34),
(13, 32, 'Hungary', 36),
(14, 33, 'Vatican City', 39),
(15, 34, 'Italy', 39),
(16, 35, 'Romania', 40),
(17, 36, 'Switzerland', 41),
(18, 37, 'Austria', 43),
(19, 38, 'United Kingdom', 44),
(20, 39, 'Denmark', 45),
(21, 40, 'Sweden', 46),
(22, 41, 'Norway', 47),
(23, 42, 'Poland', 48),
(24, 43, 'Germany', 49),
(25, 44, 'Peru', 51),
(26, 45, 'Mexico', 52),
(27, 46, 'Cuba', 53),
(28, 47, 'Argentina', 54),
(29, 48, 'Brazil', 55),
(30, 49, 'Chile', 56),
(31, 50, 'Colombia', 57),
(32, 51, 'Venezuela', 58),
(33, 52, 'Malaysia', 60),
(34, 53, 'Australia', 61),
(35, 54, 'Indonesia', 62),
(36, 30, 'France', 63),
(37, 55, 'New Zealand', 64),
(38, 56, 'Singapore', 65),
(39, 57, 'Thailand', 66),
(40, 58, 'Japan', 81),
(41, 59, 'South Korea', 82),
(42, 60, 'Vietnam', 84),
(43, 61, 'China', 86),
(44, 62, 'Turkey', 90),
(45, 63, 'India', 91),
(46, 64, 'Pakistan', 92),
(47, 65, 'Afghanistan', 93),
(48, 66, 'Sri Lanka', 94),
(49, 67, 'Iran', 98),
(50, 68, 'Morocco', 212),
(51, 69, 'Senegal', 221),
(52, 70, 'Mali', 223),
(53, 71, 'Guinea', 224),
(54, 72, 'Côte d''Ivoire', 225),
(55, 73, 'Nigeria', 234),
(56, 74, 'Cameroon', 237),
(57, 75, 'Commonwealth of The Bahamas', 242),
(58, 76, 'Congo', 242),
(59, 77, 'Angola', 244),
(60, 78, 'Seychelles', 248),
(61, 79, 'Ethiopia', 251),
(62, 80, 'Somalia', 252),
(63, 81, 'Tanzania', 255),
(64, 81, 'Tanzania', 259),
(65, 82, 'Madagascar', 261),
(66, 83, 'Zimbabwe', 263),
(67, 84, 'Greenland', 299),
(68, 85, 'Gibraltar', 350),
(69, 86, 'Portugal', 351),
(70, 87, 'Luxembourg', 352),
(71, 88, 'Ireland', 353),
(72, 89, 'Iceland', 354),
(73, 90, 'Albania', 355),
(74, 91, 'Cyprus', 357),
(75, 92, 'Finland', 358),
(76, 93, 'Bulgaria', 359),
(77, 94, 'Lithuania', 370),
(78, 95, 'Latvia', 371),
(79, 96, 'Estonia', 372),
(80, 97, 'Moldova', 373),
(81, 98, 'Armenia', 374),
(82, 99, 'Belarus', 375),
(83, 100, 'Andorra', 376),
(84, 101, 'Monaco', 377),
(85, 2, 'Ukraine', 380),
(86, 45, 'Mexico', 381),
(87, 102, 'Croatia', 385),
(88, 103, 'Slovenia', 386),
(89, 104, 'Bosnia and Herzegovina', 387),
(90, 105, 'Macedonia (FYROM)', 389),
(91, 106, 'Czech Republic', 420),
(92, 107, 'Slovakia', 421),
(93, 108, 'Bermuda', 441),
(94, 109, 'Honduras', 504),
(95, 110, 'Costa Rica', 506),
(96, 111, 'Panama', 507),
(97, 112, 'Haiti', 509),
(98, 113, 'Ecuador', 593),
(99, 114, 'Paraguay', 595),
(100, 115, 'Uruguay', 598),
(101, 116, 'Papua New Guinea', 675),
(102, 117, 'Fiji', 679),
(103, 118, 'Cook Islands', 682),
(104, 119, 'Dominican Republic', 809),
(105, 120, 'North Korea', 850),
(106, 121, 'Hong Kong', 852),
(107, 122, 'Cambodia', 855),
(108, 123, 'Jamaica', 876),
(109, 124, 'Bangladesh', 880),
(110, 125, 'Taiwan', 886),
(111, 126, 'Maldives', 960),
(112, 127, 'Lebanon', 961),
(113, 128, 'Jordan', 962),
(114, 129, 'Syria', 963),
(115, 130, 'Iraq', 964),
(116, 131, 'Kuwait', 965),
(117, 132, 'Saudi Arabia', 966),
(118, 133, 'United Arab Emirates', 971),
(119, 134, 'Israel', 972),
(120, 135, 'Mongolia', 976),
(121, 136, 'Tajikistan', 992),
(122, 137, 'Turkmenistan', 993),
(123, 138, 'Azerbaijan', 994),
(124, 139, 'Georgia', 995),
(125, 140, 'Kyrgyzstan', 996),
(126, 141, 'Uzbekistan', 998),
(127, 53, 'Australia', 61),
(128, 37, 'Austria', 43),
(129, 138, 'Azerbaijan', 994),
(130, 90, 'Albania', 355),
(131, 24, 'Algeria', 21),
(132, 77, 'Angola', 244),
(133, 100, 'Andorra', 376),
(134, 47, 'Argentina', 54),
(135, 98, 'Armenia', 374),
(136, 65, 'Afghanistan', 93),
(137, 75, 'Commonwealth of The Bahamas', 242),
(138, 124, 'Bangladesh', 880),
(139, 99, 'Belarus', 375),
(140, 29, 'Belgium', 32),
(142, 108, 'Bermuda', 441),
(143, 93, 'Bulgaria', 359),
(144, 104, 'Bosnia and Herzegovina', 387),
(145, 48, 'Brazil', 55),
(146, 33, 'Vatican City', 39),
(147, 38, 'United Kingdom', 44),
(148, 32, 'Hungary', 36),
(149, 51, 'Venezuela', 58),
(150, 60, 'Vietnam', 84),
(151, 112, 'Haiti', 509),
(152, 71, 'Guinea', 224),
(153, 43, 'Germany', 49),
(154, 85, 'Gibraltar', 350),
(155, 109, 'Honduras', 504),
(156, 121, 'Hong Kong', 852),
(157, 84, 'Greenland', 299),
(158, 27, 'Greece', 30),
(159, 139, 'Georgia', 995),
(160, 39, 'Denmark', 45),
(161, 119, 'Dominican Republic', 809),
(162, 23, 'Egypt', 20),
(163, 81, 'Tanzania', 259),
(164, 83, 'Zimbabwe', 263),
(165, 134, 'Israel', 972),
(166, 63, 'India', 91),
(167, 54, 'Indonesia', 62),
(168, 128, 'Jordan', 962),
(169, 130, 'Iraq', 964),
(170, 67, 'Iran', 98),
(171, 88, 'Ireland', 353),
(172, 89, 'Iceland', 354),
(173, 31, 'Spain', 34),
(174, 34, 'Italy', 39),
(175, 21, 'Kazakhstan', 7),
(176, 122, 'Cambodia', 855),
(177, 74, 'Cameroon', 237),
(178, 91, 'Cyprus', 357),
(179, 140, 'Kyrgyzstan', 996),
(180, 61, 'China', 86),
(181, 50, 'Colombia', 57),
(182, 76, 'Congo', 242),
(183, 110, 'Costa Rica', 506),
(184, 46, 'Cuba', 53),
(185, 131, 'Kuwait', 965),
(186, 95, 'Latvia', 371),
(187, 127, 'Lebanon', 961),
(188, 94, 'Lithuania', 370),
(189, 87, 'Luxembourg', 352),
(190, 82, 'Madagascar', 261),
(191, 105, 'Macedonia (FYROM)', 389),
(192, 52, 'Malaysia', 60),
(193, 70, 'Mali', 223),
(195, 68, 'Morocco', 212),
(196, 45, 'Mexico', 52),
(197, 97, 'Moldova', 373),
(198, 101, 'Monaco', 377),
(199, 135, 'Mongolia', 976),
(200, 73, 'Nigeria', 234),
(201, 28, 'The Netherlands', 31),
(202, 55, 'New Zealand', 64),
(203, 41, 'Norway', 47),
(204, 133, 'United Arab Emirates', 971),
(205, 118, 'Cook Islands', 682),
(206, 64, 'Pakistan', 92),
(207, 111, 'Panama', 507),
(208, 116, 'Papua New Guinea', 675),
(209, 114, 'Paraguay', 595),
(210, 44, 'Peru', 51),
(211, 42, 'Poland', 48),
(212, 86, 'Portugal', 351),
(213, 22, 'Russia', 7),
(214, 35, 'Romania', 40),
(215, 132, 'Saudi Arabia', 966),
(216, 120, 'North Korea', 850),
(217, 78, 'Seychelles', 248),
(218, 69, 'Senegal', 221),
(219, 56, 'Singapore', 65),
(220, 129, 'Syria', 963),
(221, 107, 'Slovakia', 421),
(222, 103, 'Slovenia', 386),
(223, 80, 'Somalia', 252),
(224, 20, 'United States', 1),
(225, 136, 'Tajikistan', 992),
(226, 125, 'Taiwan', 886),
(227, 57, 'Thailand', 66),
(228, 81, 'Tanzania', 255),
(229, 25, 'Tunisia', 21),
(230, 137, 'Turkmenistan', 993),
(231, 62, 'Turkey', 90),
(232, 141, 'Uzbekistan', 998),
(233, 2, 'Ukraine', 380),
(234, 115, 'Uruguay', 598),
(235, 117, 'Fiji', 679),
(236, 30, 'France', 63),
(237, 92, 'Finland', 358),
(238, 30, 'France', 33),
(239, 102, 'Croatia', 385),
(240, 106, 'Czech Republic', 420),
(241, 49, 'Chile', 56),
(242, 36, 'Switzerland', 41),
(243, 40, 'Sweden', 46),
(244, 66, 'Sri Lanka', 94),
(245, 113, 'Ecuador', 593),
(246, 96, 'Estonia', 372),
(247, 79, 'Ethiopia', 251),
(248, 26, 'South Africa', 27),
(249, 45, 'Mexico', 381),
(250, 59, 'South Korea', 82),
(251, 123, 'Jamaica', 876),
(252, 58, 'Japan', 81),
(253, 65, 'Afghanistan', 93),
(254, 90, 'Albania', 355),
(255, 24, 'Algeria', 21),
(256, 100, 'Andorra', 376),
(257, 77, 'Angola', 244),
(258, 47, 'Argentina', 54),
(259, 98, 'Armenia', 374),
(260, 53, 'Australia', 61),
(261, 37, 'Austria', 43),
(262, 138, 'Azerbaijan', 994),
(263, 75, 'Commonwealth of The Bahamas', 242),
(264, 124, 'Bangladesh', 880),
(265, 99, 'Belarus', 375),
(266, 29, 'Belgium', 32),
(267, 108, 'Bermuda', 441),
(268, 104, 'Bosnia and Herzegovina', 387),
(269, 48, 'Brazil', 55),
(270, 93, 'Bulgaria', 359),
(271, 122, 'Cambodia', 855),
(272, 74, 'Cameroon', 237),
(273, 49, 'Chile', 56),
(274, 61, 'China', 86),
(275, 50, 'Colombia', 57),
(276, 76, 'Congo', 242),
(277, 118, 'Cook Islands', 682),
(278, 110, 'Costa Rica', 506),
(279, 102, 'Croatia', 385),
(280, 46, 'Cuba', 53),
(281, 91, 'Cyprus', 357),
(282, 106, 'Czech Republic', 420),
(283, 39, 'Denmark', 45),
(284, 119, 'Dominican Republic', 809),
(285, 113, 'Ecuador', 593),
(286, 23, 'Egypt', 20),
(287, 96, 'Estonia', 372),
(288, 79, 'Ethiopia', 251),
(289, 117, 'Fiji', 679),
(290, 92, 'Finland', 358),
(291, 30, 'France', 33),
(292, 20, 'United States', 995),
(293, 43, 'Germany', 49),
(294, 85, 'Gibraltar', 350),
(295, 27, 'Greece', 30),
(296, 84, 'Greenland', 299),
(297, 71, 'Guinea', 224),
(298, 112, 'Haiti', 509),
(299, 109, 'Honduras', 504),
(300, 121, 'Hong Kong', 852),
(301, 32, 'Hungary', 36),
(302, 89, 'Iceland', 354),
(303, 63, 'India', 91),
(304, 54, 'Indonesia', 62),
(305, 67, 'Iran', 98),
(306, 130, 'Iraq', 964),
(307, 20, 'United States', 353),
(308, 134, 'Israel', 972),
(309, 34, 'Italy', 39),
(310, 72, 'Côte d''Ivoire', 225),
(311, 123, 'Jamaica', 876),
(312, 58, 'Japan', 81),
(313, 128, 'Jordan', 962),
(314, 21, 'Kazakhstan', 7),
(315, 57, 'Thailand', 850),
(316, 20, 'United States', 82),
(317, 131, 'Kuwait', 965),
(318, 140, 'Kyrgyzstan', 996),
(319, 95, 'Latvia', 371),
(320, 127, 'Lebanon', 961),
(321, 94, 'Lithuania', 370),
(322, 87, 'Luxembourg', 352),
(323, 105, 'Macedonia (FYROM)', 389),
(324, 82, 'Madagascar', 261),
(325, 52, 'Malaysia', 60),
(326, 126, 'Maldives', 960),
(327, 70, 'Mali', 223),
(328, 45, 'Mexico', 52),
(329, 97, 'Moldova', 373),
(330, 101, 'Monaco', 377),
(331, 135, 'Mongolia', 976),
(332, 68, 'Morocco', 212),
(333, 28, 'The Netherlands', 31),
(334, 55, 'New Zealand', 64),
(335, 73, 'Nigeria', 234),
(336, 41, 'Norway', 47),
(337, 64, 'Pakistan', 92),
(338, 111, 'Panama', 507),
(339, 116, 'Papua New Guinea', 675),
(340, 114, 'Paraguay', 595),
(341, 44, 'Peru', 51),
(342, 142, 'Philippines', 63),
(343, 42, 'Poland', 48),
(344, 86, 'Portugal', 351),
(345, 35, 'Romania', 40),
(346, 22, 'Russia', 7),
(347, 132, 'Saudi Arabia', 966),
(348, 69, 'Senegal', 221),
(349, 78, 'Seychelles', 248),
(350, 56, 'Singapore', 65),
(351, 107, 'Slovakia', 421),
(352, 103, 'Slovenia', 386),
(353, 80, 'Somalia', 252),
(354, 26, 'South Africa', 27),
(355, 31, 'Spain', 34),
(356, 66, 'Sri Lanka', 94),
(357, 40, 'Sweden', 46),
(358, 36, 'Switzerland', 41),
(359, 129, 'Syria', 963),
(360, 125, 'Taiwan', 886),
(361, 136, 'Tajikistan', 992),
(362, 81, 'Tanzania', 255),
(363, 57, 'Thailand', 66),
(364, 25, 'Tunisia', 21),
(365, 62, 'Turkey', 90),
(366, 137, 'Turkmenistan', 993),
(367, 2, 'Ukraine', 380),
(368, 133, 'United Arab Emirates', 971),
(369, 38, 'United Kingdom', 44),
(370, 115, 'Uruguay', 598),
(372, 141, 'Uzbekistan', 998),
(373, 33, 'Vatican City', 39),
(374, 51, 'Venezuela', 58),
(375, 60, 'Vietnam', 84),
(376, 45, 'Mexico', 381),
(377, 81, 'Tanzania', 259),
(378, 83, 'Zimbabwe', 263);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
