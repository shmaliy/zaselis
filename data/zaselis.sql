-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Июн 04 2013 г., 23:27
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
-- Структура таблицы `z_countries`
--

DROP TABLE IF EXISTS `z_countries`;
CREATE TABLE IF NOT EXISTS `z_countries` (
  `z_countries_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `day_price` double NOT NULL,
  `avaliable` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `alias` varchar(255) NOT NULL,
  `z_languages_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`z_countries_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `z_currencies`
--

DROP TABLE IF EXISTS `z_currencies`;
CREATE TABLE IF NOT EXISTS `z_currencies` (
  `z_currencies_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `course` double NOT NULL,
  `image` text NOT NULL,
  `avaliable` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `alias` varchar(255) NOT NULL,
  `default` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `symbol` text NOT NULL,
  PRIMARY KEY (`z_currencies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `z_currencies`
--

INSERT INTO `z_currencies` (`z_currencies_id`, `title`, `course`, `image`, `avaliable`, `alias`, `default`, `symbol`) VALUES
(5, 'eyJydSI6Ilx1MDQxNFx1MDQzZVx1MDQzYlx1MDQzYlx1MDQzMFx1MDQ0MCBcdTA0MjFcdTA0MjhcdTA0MTAiLCJlbiI6IlVTIERvbGxhciJ9', 1, 'usd.png', 'YES', 'USD', 'NO', '$'),
(6, 'eyJydSI6Ilx1MDQxNVx1MDQzMlx1MDQ0MFx1MDQzZSIsImVuIjoiRXVybyJ9', 1.31, 'eur.png', 'YES', 'EUR', 'NO', '&euro;'),
(7, 'eyJydSI6Ilx1MDQxM1x1MDQ0MFx1MDQzOFx1MDQzMlx1MDQzZFx1MDQzMCIsImVuIjoiVUFIIn0=', 0.12, 'uah.png', 'YES', 'UAH', 'YES', '&#8372;'),
(8, 'eyJydSI6Ilx1MDQyMFx1MDQ0M1x1MDQzMVx1MDQzYlx1MDQ0YyIsImVuIjoiUlVSIn0=', 0.03, 'rur.png', 'YES', 'RUR', 'NO', 'RUR');

-- --------------------------------------------------------

--
-- Структура таблицы `z_districts`
--

DROP TABLE IF EXISTS `z_districts`;
CREATE TABLE IF NOT EXISTS `z_districts` (
  `z_districts_id` int(11) NOT NULL AUTO_INCREMENT,
  `z_countries_id` int(11) NOT NULL DEFAULT '0',
  `z_states_id` int(11) NOT NULL DEFAULT '0',
  `z_towns_id` int(11) NOT NULL DEFAULT '0',
  `title` text NOT NULL,
  `avaliable` enum('YES','NO') NOT NULL DEFAULT 'YES',
  PRIMARY KEY (`z_districts_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `z_flats`
--

DROP TABLE IF EXISTS `z_flats`;
CREATE TABLE IF NOT EXISTS `z_flats` (
  `z_flats_id` int(11) NOT NULL AUTO_INCREMENT,
  `z_users_id` int(11) NOT NULL,
  `z_countries_id` int(11) NOT NULL DEFAULT '0',
  `z_states_id` int(11) NOT NULL DEFAULT '0',
  `z_towns_id` int(11) NOT NULL DEFAULT '0',
  `z_districts_id` int(11) NOT NULL DEFAULT '0',
  `z_metros_id` int(11) NOT NULL DEFAULT '0',
  `district_description` text NOT NULL,
  `main_description` text NOT NULL,
  `rooms_count` int(5) NOT NULL,
  `is_studio` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `price` double NOT NULL,
  `gps` text NOT NULL,
  `finance_avaliable_till_ts` bigint(25) NOT NULL,
  `photos` text NOT NULL,
  `status` enum('Visible','Hidden','Draft') NOT NULL DEFAULT 'Draft',
  `created_ts` bigint(25) NOT NULL,
  `edited_ts` bigint(25) NOT NULL,
  `votes` text NOT NULL,
  PRIMARY KEY (`z_flats_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `z_flats_in_top`
--

DROP TABLE IF EXISTS `z_flats_in_top`;
CREATE TABLE IF NOT EXISTS `z_flats_in_top` (
  `z_flats_in_top_id` int(11) NOT NULL AUTO_INCREMENT,
  `z_flats_id` int(11) NOT NULL,
  `z_flats_top_list_id` int(11) NOT NULL,
  `avaliable_till_ts` bigint(25) NOT NULL,
  PRIMARY KEY (`z_flats_in_top_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `z_flats_params`
--

DROP TABLE IF EXISTS `z_flats_params`;
CREATE TABLE IF NOT EXISTS `z_flats_params` (
  `z_flats_params_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `type` enum('TEXT','BOOLEAN') NOT NULL DEFAULT 'BOOLEAN',
  `icon` text NOT NULL,
  PRIMARY KEY (`z_flats_params_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `z_flats_params_values`
--

DROP TABLE IF EXISTS `z_flats_params_values`;
CREATE TABLE IF NOT EXISTS `z_flats_params_values` (
  `z_flats_params_values_id` int(11) NOT NULL AUTO_INCREMENT,
  `z_flats_id` int(11) NOT NULL DEFAULT '0',
  `z_flats_params_id` int(11) NOT NULL DEFAULT '0',
  `text_value` text NOT NULL,
  `boolean_value` enum('FALSE','TRUE') NOT NULL DEFAULT 'FALSE',
  PRIMARY KEY (`z_flats_params_values_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `z_flats_tops_countries_prices`
--

DROP TABLE IF EXISTS `z_flats_tops_countries_prices`;
CREATE TABLE IF NOT EXISTS `z_flats_tops_countries_prices` (
  `z_flats_tops_countries_prices_id` int(11) NOT NULL AUTO_INCREMENT,
  `z_countries_id` int(11) NOT NULL DEFAULT '0',
  `z_flats_top_list_id` int(11) NOT NULL DEFAULT '0',
  `price` double NOT NULL,
  PRIMARY KEY (`z_flats_tops_countries_prices_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `z_flats_tops_list`
--

DROP TABLE IF EXISTS `z_flats_tops_list`;
CREATE TABLE IF NOT EXISTS `z_flats_tops_list` (
  `z_flats_tops_list_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `default_price` double NOT NULL,
  PRIMARY KEY (`z_flats_tops_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `z_flats_tops_towns_prices`
--

DROP TABLE IF EXISTS `z_flats_tops_towns_prices`;
CREATE TABLE IF NOT EXISTS `z_flats_tops_towns_prices` (
  `z_flats_tops_towns_prices_id` int(11) NOT NULL AUTO_INCREMENT,
  `z_towns_id` int(11) NOT NULL DEFAULT '0',
  `z_flats_top_list_id` int(11) NOT NULL DEFAULT '0',
  `price` double NOT NULL,
  PRIMARY KEY (`z_flats_tops_towns_prices_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `z_languages`
--

DROP TABLE IF EXISTS `z_languages`;
CREATE TABLE IF NOT EXISTS `z_languages` (
  `z_languages_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `alias` varchar(50) NOT NULL,
  `avaliable` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `default` enum('YES','NO') NOT NULL DEFAULT 'NO',
  PRIMARY KEY (`z_languages_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `z_languages`
--

INSERT INTO `z_languages` (`z_languages_id`, `title`, `alias`, `avaliable`, `default`) VALUES
(1, 'eyJydSI6Ilx1MDQyMFx1MDQ0M1x1MDQ0MVx1MDQ0MVx1MDQzYVx1MDQzOFx1MDQzOSIsImVuIjoiUnVzc2lhbiJ9', 'ru', 'YES', 'YES'),
(2, '\neyJydSI6Ilx1MDQxMFx1MDQzZFx1MDQzM1x1MDQzYlx1MDQzOFx1MDQzOVx1MDQ0MVx1MDQzYVx1MDQzOFx1MDQzOSIsImVuIjoiRW5nbGlzaCJ9 ', 'en', 'YES', 'NO');

-- --------------------------------------------------------

--
-- Структура таблицы `z_metros`
--

DROP TABLE IF EXISTS `z_metros`;
CREATE TABLE IF NOT EXISTS `z_metros` (
  `z_metros_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `avaliable` enum('YES','NO') NOT NULL DEFAULT 'YES',
  PRIMARY KEY (`z_metros_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `z_states`
--

DROP TABLE IF EXISTS `z_states`;
CREATE TABLE IF NOT EXISTS `z_states` (
  `z_states_id` int(11) NOT NULL AUTO_INCREMENT,
  `z_countries_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `day_price` double NOT NULL,
  `avaliable` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `alias` varchar(255) NOT NULL,
  PRIMARY KEY (`z_states_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `z_towns`
--

DROP TABLE IF EXISTS `z_towns`;
CREATE TABLE IF NOT EXISTS `z_towns` (
  `z_towns_id` int(11) NOT NULL AUTO_INCREMENT,
  `z_countries_id` int(11) NOT NULL,
  `z_states_id` int(11) NOT NULL DEFAULT '0',
  `title` text NOT NULL,
  `day_price` double NOT NULL,
  `avaliable` enum('YES','NO') NOT NULL DEFAULT 'YES',
  `alias` varchar(255) NOT NULL,
  PRIMARY KEY (`z_towns_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `z_users`
--

DROP TABLE IF EXISTS `z_users`;
CREATE TABLE IF NOT EXISTS `z_users` (
  `z_users_id` int(11) NOT NULL AUTO_INCREMENT,
  `z_users_roles_id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` text NOT NULL,
  `about` text NOT NULL,
  `documentation` enum('YES','NO') NOT NULL DEFAULT 'NO',
  `office_addr` text NOT NULL,
  `type_of_settle` enum('Office','OnPlace','Both') NOT NULL DEFAULT 'OnPlace',
  `phones` text NOT NULL,
  `avatar` text NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Inactive',
  `z_countries_id` int(11) NOT NULL DEFAULT '0',
  `z_states_id` int(11) NOT NULL DEFAULT '0',
  `z_towns_id` int(11) NOT NULL DEFAULT '0',
  `z_districts_id` int(11) NOT NULL DEFAULT '0',
  `z_languages_array` text NOT NULL,
  `balance` float NOT NULL DEFAULT '0',
  `created_ts` bigint(40) NOT NULL,
  `edited_ts` bigint(40) NOT NULL,
  `votes` text NOT NULL,
  `simple_price_drop` double NOT NULL DEFAULT '0',
  `tops_price_drop` text NOT NULL,
  `activate_code` text NOT NULL,
  PRIMARY KEY (`z_users_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `z_users`
--

INSERT INTO `z_users` (`z_users_id`, `z_users_roles_id`, `email`, `password`, `name`, `firstname`, `about`, `documentation`, `office_addr`, `type_of_settle`, `phones`, `avatar`, `status`, `z_countries_id`, `z_states_id`, `z_towns_id`, `z_districts_id`, `z_languages_array`, `balance`, `created_ts`, `edited_ts`, `votes`, `simple_price_drop`, `tops_price_drop`, `activate_code`) VALUES
(1, 1, 'shmaliy.maxim@gmail.com', 'OnxcyutMYEg=', 'eyJydSI6Ilx1MDQxY1x1MDQzMFx1MDQzYVx1MDQ0MVx1MDQzOFx1MDQzYyJ9', 'eyJydSI6Ilx1MDQyOFx1MDQzY1x1MDQzMFx1MDQzYlx1MDQzOFx1MDQzOSJ9', '', 'NO', '', 'OnPlace', '', '', 'Active', 0, 0, 0, 0, '', 0, 1369576770, 0, '', 0, '', ''),
(2, 2, 'zaselis@mail.ru', 'gVOm6xLKhNI=', 'eyJydSI6Ilx1MDQxMlx1MDQzMFx1MDQzYlx1MDQzNVx1MDQzZFx1MDQ0Mlx1MDQzOFx1MDQzZCJ9', 'eyJydSI6Ilx1MDQyMVx1MDQ0Mlx1MDQzNVx1MDQzZlx1MDQzMFx1MDQzZFx1MDQ0N1x1MDQ0M1x1MDQzYSJ9', '', 'NO', '', 'OnPlace', '', '', 'Active', 0, 0, 0, 0, '', 0, 1369579102, 0, '', 0, '', ''),
(3, 2, 'pass.dnapr@gmail.com', 'OnxcyutMYEg=', 'eyJydSI6Ilx1MDQxY1x1MDQzMFx1MDQzYVx1MDQ0MVx1MDQzOFx1MDQzYyJ9', 'eyJydSI6Ilx1MDQyOFx1MDQzY1x1MDQzMFx1MDQzYlx1MDQzOFx1MDQzOSJ9', '', 'NO', '', 'OnPlace', '', '', 'Inactive', 0, 0, 0, 0, '', 0, 1369607067, 0, '', 0, '', '7e428ad9a0e5f19492e344383c69fad2');

-- --------------------------------------------------------

--
-- Структура таблицы `z_users_finance_log`
--

DROP TABLE IF EXISTS `z_users_finance_log`;
CREATE TABLE IF NOT EXISTS `z_users_finance_log` (
  `z_users_finance_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `z_users_id` int(11) NOT NULL,
  `type` enum('Fill','Pay') NOT NULL,
  `summ` double NOT NULL,
  `status` enum('Wait','Done') NOT NULL DEFAULT 'Wait',
  `comment` text NOT NULL,
  `created_ts` bigint(25) NOT NULL,
  PRIMARY KEY (`z_users_finance_log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `z_users_roles`
--

DROP TABLE IF EXISTS `z_users_roles`;
CREATE TABLE IF NOT EXISTS `z_users_roles` (
  `z_users_roles_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`z_users_roles_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `z_users_roles`
--

INSERT INTO `z_users_roles` (`z_users_roles_id`, `title`, `alias`, `description`) VALUES
(1, 'Администратор', 'siteAdmin', 'Администратор сайта'),
(2, 'Владелец', 'flatsOwner', 'Владелец квартир'),
(3, 'Посетитель', 'guest', 'Неавторизованный посетитель');

-- --------------------------------------------------------

--
-- Структура таблицы `z_users_sessions`
--

DROP TABLE IF EXISTS `z_users_sessions`;
CREATE TABLE IF NOT EXISTS `z_users_sessions` (
  `z_users_sessions_id` int(11) NOT NULL AUTO_INCREMENT,
  `z_users_id` int(11) NOT NULL,
  `phpsessid` int(11) NOT NULL,
  `created_ts` bigint(40) NOT NULL,
  `ttl` bigint(40) NOT NULL DEFAULT '86400',
  `ip` varchar(255) NOT NULL,
  PRIMARY KEY (`z_users_sessions_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `z_users_sessions`
--

INSERT INTO `z_users_sessions` (`z_users_sessions_id`, `z_users_id`, `phpsessid`, `created_ts`, `ttl`, `ip`) VALUES
(1, 1, 0, 1370080633, 7507, '127.0.0.1'),
(2, 1, 0, 1370088172, 5457, '127.0.0.1'),
(3, 1, 0, 1370093947, 1, '127.0.0.1'),
(4, 1, 0, 1370094146, 86400, '127.0.0.1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
