-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 16 2023 г., 16:24
-- Версия сервера: 8.0.15
-- Версия PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `brigada24`
--

-- --------------------------------------------------------

--
-- Структура таблицы `adverts`
--

CREATE TABLE `adverts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `import_id` bigint(20) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `sub_category` int(11) DEFAULT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `price` double(8,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adress` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `parent_region_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_up` datetime DEFAULT NULL,
  `views` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `advert_categories`
--

CREATE TABLE `advert_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `favorite` smallint(1) DEFAULT NULL,
  `footer` smallint(1) DEFAULT NULL,
  `name_adv` smallint(1) DEFAULT '0',
  `show_short_description` tinyint(1) DEFAULT '1',
  `popular` tinyint(1) DEFAULT '0',
  `show_col` tinyint(1) DEFAULT '0',
  `service` tinyint(1) DEFAULT '0',
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `h1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name_bread` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `master_1` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `master_2` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `master_3` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `measure` tinyint(2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `advert_categories`
--

INSERT INTO `advert_categories` (`id`, `name`, `parent_id`, `favorite`, `footer`, `name_adv`, `show_short_description`, `popular`, `show_col`, `service`, `url`, `icon`, `title`, `h1`, `description`, `text`, `name_bread`, `master_1`, `master_2`, `master_3`, `measure`, `created_at`, `updated_at`) VALUES
(1, 'Вывоз мусора', 0, 1, 0, 0, 0, 0, 0, 0, 'vyvoz-musora', 'vyvoz-musora.png', 'Вывоз мусора', 'Вывоз мусора', 'Вывоз мусора', '<ul>\r\n<li>автоинструкторы в Красноярске c проверенными отзывами и фото на тутуслуги.ru;</li>\r\n<li>быстрый поиск специалистов рядом с вами в Красноярске;</li>\r\n<li>мы нашли 43 автоинструктора с информацией о ценах и стаже работы.</li>\r\n</ul>', NULL, NULL, NULL, NULL, NULL, '2022-12-08 15:20:32', '2022-12-23 07:12:02'),
(3, 'Строительные работы', 0, 1, 0, 0, 0, 0, 0, 0, 'stroitelnye-raboty', 'stroitelnye-raboty.png', 'Строительные работы', 'Строительные работы', 'Строительные работы', 'Строительные работы', NULL, NULL, NULL, NULL, NULL, '2022-12-08 15:23:42', '2022-12-23 07:42:23'),
(5, 'Ремонт и установка техники', 0, 1, 0, 0, 0, 0, 0, 0, 'remont-i-ustanovka-texniki', 'remont-i-ustanovka-texniki.png', 'Ремонт и установка техники', 'Ремонт и установка техники', 'Ремонт и установка техники', 'Ремонт и установка техники', 'Ремонт и установка техники', NULL, NULL, NULL, NULL, '2022-12-08 15:23:57', '2022-12-23 07:42:50'),
(7, 'Установка дверей', 1, 0, 0, 0, 0, 0, 0, 0, 'ustanovka-dverei', '', NULL, NULL, NULL, NULL, NULL, 'установка дверей', NULL, NULL, NULL, '2022-12-21 14:08:55', '2022-12-23 05:14:41'),
(8, 'Ремонт квартир и домов', 1, 0, 0, 0, 0, 0, 0, 0, 'remont-kvartir-i-domov', '', NULL, NULL, NULL, NULL, NULL, 'ремонтник', NULL, NULL, NULL, '2022-12-21 14:09:03', '2022-12-23 05:14:18'),
(9, 'Охранные системы и контроль доступа', 1, 0, 0, 0, 0, 0, 0, 0, 'oxrannye-sistemy-i-kontrol-dostupa', '', 'Охранные системы и контроль доступа', 'Охранные системы и контроль доступа', 'Охранные системы и контроль доступа', 'Охранные системы и контроль доступа', 'Охранные системы и контроль доступа', 'охранник', NULL, NULL, NULL, '2022-12-21 14:09:11', '2022-12-23 07:43:30'),
(10, 'Копка котлована', 9, 0, 0, 0, 0, 1, 1, 1, '2', '3', '4', '6', '5', '8', '7', '9', '10', '11', 3, '2022-12-22 04:33:26', '2022-12-22 06:20:55'),
(11, 'Столбчатый фундамент', 8, 0, 0, 0, 0, 0, 0, 0, 'stolbcatyi-fundament', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2022-12-22 06:27:03', '2022-12-22 06:27:03'),
(12, 'Ремонт телефонов', 5, 0, 0, 0, 0, 0, 0, 0, 'remont-telefonov', '', 'Ремонт телефонов', 'Ремонт телефонов', 'Ремонт телефонов', 'Ремонт телефонов', 'Ремонт телефонов', 'мастер по ремонту телефон', NULL, NULL, NULL, '2022-12-22 06:27:37', '2022-12-23 07:43:00'),
(13, 'Строительство плитного фундамента', 1, 0, 0, 0, 0, 0, 0, 0, 'stroitelstvo-plitnogo-fundamenta', '', 'Строительство плитного фундамента', 'Строительство плитного фундамента', 'Строительство плитного фундамента', 'Строительство плитного фундамента', 'Строительство плитного фундамента', NULL, NULL, NULL, 1, '2022-12-22 06:27:46', '2022-12-23 07:43:08'),
(14, 'Строительство винтового свайного фундамента', 7, 0, 0, 0, 0, 0, 0, 0, 'stroitelstvo-vintovogo-svainogo-fundamenta', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 5, '2022-12-22 06:27:57', '2022-12-22 06:27:57'),
(15, 'Установка монолитной плиты в основании ленточного фундамента', 9, 0, 0, 0, 0, 0, 0, 0, 'ustanovka-monolitnoi-plity-v-osnovanii-lentocnogo-fundamenta', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 8, '2022-12-22 06:29:26', '2022-12-22 06:29:26'),
(16, 'Строительство домов', 3, 0, 0, 0, 0, 0, 0, 0, 'stroitelstvo-domov', '', 'Строительство домов', 'Строительство домов', 'Строительство домов', 'Строительство домов', 'Строительство домов', NULL, NULL, NULL, NULL, '2022-12-23 07:33:32', '2022-12-23 07:42:31'),
(17, 'Строительство коттеджей', 1, 0, 0, 0, 0, 0, 0, 0, 'stroitelstvo-kottedzei', '', 'Строительство коттеджей', 'Строительство коттеджей', 'Строительство коттеджей', 'Строительство коттеджей', 'Строительство коттеджей', NULL, NULL, NULL, 1, '2022-12-23 07:33:50', '2022-12-23 07:42:39');

-- --------------------------------------------------------

--
-- Структура таблицы `advert_prices`
--

CREATE TABLE `advert_prices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `advert_id` int(11) NOT NULL,
  `masure` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `banners`
--

CREATE TABLE `banners` (
  `id` int(6) NOT NULL,
  `type` varchar(25) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `page` varchar(25) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `path` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `banners`
--

INSERT INTO `banners` (`id`, `type`, `name`, `page`, `link`, `path`) VALUES
(1, 'vertical', 'Вертикальный на главной', 'index', '', ''),
(2, 'horisontal', 'Горизонтальный на главной', 'index', '', ''),
(3, 'vertical', 'Вертикальный в листинге', 'category', '', ''),
(4, 'horisontal', 'Горизонтальный в листинге', 'category', '', ''),
(5, 'vertical', 'Вертикальный в карточке', 'advert', '', ''),
(6, 'horisontal', 'Горизонтальный в карточке', 'advert', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `contacts`
--

CREATE TABLE `contacts` (
  `id` int(6) NOT NULL,
  `adv_id` bigint(20) DEFAULT NULL,
  `type` smallint(1) DEFAULT '1',
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `theme` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `text` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `date_add` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `contacts`
--

INSERT INTO `contacts` (`id`, `adv_id`, `type`, `name`, `email`, `theme`, `text`, `date_add`) VALUES
(4, NULL, 1, 'Denis', 'din1s@ya.ru', 'Платное размещение', 'TEST', '2022-11-04 08:25:37'),
(5, NULL, 1, 'Denis', 'din1s@ya.ru', 'Платное размещение', 'test', '2022-11-04 09:55:44'),
(6, NULL, 1, 'Denis', 'din1s@ya.ru', 'Платное размещение', 'test', '2022-11-04 09:55:49'),
(7, NULL, 1, 'Denis', 'din1s@ya.ru', 'Платное размещение', 'test', '2022-11-04 09:56:00');

-- --------------------------------------------------------

--
-- Структура таблицы `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_10_19_065557_create_adverts_table', 2),
(6, '2021_10_19_084947_create_regions_table', 2),
(7, '2021_10_19_085059_create_advert_categories_table', 2),
(8, '2021_10_19_101157_create_advert_images_table', 3),
(9, '2021_10_24_113603_create_advert_prices_table', 4),
(10, '2022_12_21_102544_create_user_regions_table', 5),
(11, '2022_12_22_095213_create_user_categories_table', 6),
(12, '2022_12_22_095828_create_user_services_table', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` int(11) DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name_case` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `favorite` int(1) DEFAULT NULL,
  `footer` int(1) DEFAULT NULL,
  `public` int(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_id` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `regions`
--

INSERT INTO `regions` (`id`, `type`, `name`, `name_case`, `url`, `favorite`, `footer`, `public`, `created_at`, `updated_at`, `parent_id`) VALUES
(2, 1, 'Адыгея', 'Адыгея', 'adygeya', 0, 0, 0, NULL, '2021-12-13 16:20:22', 0),
(3, 1, 'Алтай', 'Алтай', 'altay', 0, 0, 0, NULL, '2021-12-14 12:34:25', 0),
(4, 1, 'Алтайский край', 'в Алтайском крае', 'altayskiy-kray', 0, 0, 1, NULL, '2021-12-16 14:43:30', 0),
(5, 1, 'Амурская область', 'в Амурской области', 'amurskaya-oblast', 1, 0, 1, NULL, '2021-12-17 11:13:27', 0),
(6, 1, 'Архангельская область', 'в Архангельской области', 'arhangelskaya-oblast', 0, 0, 1, NULL, '2021-12-17 04:01:12', 0),
(7, 1, 'Астраханская область', 'в Астраханской области', 'astrahanskaya-oblast', 0, 0, 1, NULL, '2021-12-16 15:56:21', 0),
(8, 1, 'Башкортостан', 'в Башкортостане', 'bashkortostan', 1, 0, 1, NULL, '2021-12-16 13:56:30', 0),
(9, 1, 'Белгородская область', 'в Белгородской области', 'belgorodskaya-oblast', 0, 0, 1, NULL, '2021-12-17 04:00:24', 0),
(10, 1, 'Брянская область', 'в Брянской области', 'bryanskaya-oblast', 0, 0, 1, NULL, '2021-12-16 16:08:48', 0),
(11, 1, 'Бурятия', 'в Бурятии', 'buryatiya', 0, 0, 1, NULL, '2021-12-17 03:56:19', 0),
(12, 1, 'Владимирская область', 'в Владимирской области', 'vladimirskaya-oblast', 0, 0, 1, NULL, '2021-12-17 04:02:21', 0),
(13, 1, 'Волгоградская область', 'в Волгоградской области', 'volgogradskaya-oblast', 1, 0, 1, NULL, '2021-12-16 14:05:54', 0),
(14, 1, 'Вологодская область', 'в Вологодской области', 'vologodskaya-oblast', 0, 0, 1, NULL, '2021-12-17 04:49:52', 0),
(15, 1, 'Воронежская область', 'в Воронежской области', 'voronezhskaya-oblast', 1, 0, 1, NULL, '2021-12-16 14:16:09', 0),
(16, 1, 'Дагестан', 'в Дагестане', 'dagestan', 0, 0, 1, NULL, '2021-12-16 15:44:40', 0),
(17, 1, 'Еврейская АО', 'Еврейская АО', 'evreyskaya-ao', NULL, NULL, 0, NULL, '2021-10-25 15:58:49', NULL),
(18, 1, 'Забайкальский край', 'в Забайкальском крае', 'zabaykalskiy-kray', 0, 0, 1, NULL, '2021-12-17 04:18:43', 0),
(19, 1, 'Ивановская область', 'в Ивановской области', 'ivanovskaya-oblast', 1, 0, 1, NULL, '2021-12-17 03:53:37', 0),
(20, 1, 'Ингушетия', 'Ингушетия', 'ingushetiya', NULL, NULL, 0, NULL, '2021-10-25 15:58:49', NULL),
(21, 1, 'Иркутская область', 'в Иркутской области', 'irkutskaya-oblast', 0, 0, 1, NULL, '2021-12-16 15:40:56', 0),
(22, 1, 'Кабардино-Балкария', 'в Кабардино-Балкарии', 'kabardino-balkariya', 0, 0, 1, NULL, '2021-12-17 11:06:50', 0),
(23, 1, 'Калининградская область', 'в Калининградской области', 'kaliningradskaya-oblast', 0, 0, 1, NULL, '2021-12-16 16:07:35', 0),
(24, 1, 'Калмыкия', 'Калмыкия', 'kalmykiya', NULL, NULL, 0, NULL, '2021-10-25 15:58:49', NULL),
(25, 1, 'Калужская область', 'в Калужской области', 'kaluzhskaya-oblast', 0, 0, 1, NULL, '2021-12-17 04:17:14', 0),
(26, 1, 'Камчатский край', 'в Камчатском крае', 'kamchatskiy-kray', 0, 0, 1, NULL, '2021-12-17 11:41:11', 0),
(27, 1, 'Карачаево-Черкессия', 'Карачаево-Черкессия', 'karachaevo-cherkessiya', NULL, NULL, 0, NULL, '2021-10-25 15:58:49', NULL),
(28, 1, 'Карелия', 'в Карелии', 'kareliya', 0, 0, 1, NULL, '2021-12-17 10:50:41', 0),
(29, 1, 'Кемеровская область', 'в Кемеровской области', 'kemerovskaya-oblast', 0, 0, 1, NULL, '2021-12-16 15:46:30', 0),
(30, 1, 'Кировская область', 'в Кировской области', 'kirovskaya-oblast', 0, 0, 1, NULL, '2021-12-16 16:01:29', 0),
(31, 1, 'Коми', 'в Коми', 'komi', 0, 0, 1, NULL, '2021-12-17 11:08:09', 0),
(32, 1, 'Костромская область', 'в Костромской области', 'kostromskaya-oblast', 0, 0, 1, NULL, '2021-12-17 10:47:42', 0),
(33, 1, 'Краснодарский край', 'в Краснодарском крае', 'krasnodarskiy-kray', 1, 0, 1, NULL, '2021-12-16 14:18:27', 0),
(34, 1, 'Красноярский край', 'в Красноярском крае', 'krasnoyarskiy-kray', 1, 0, 1, NULL, '2021-12-16 14:08:35', 0),
(35, 1, 'Курганская область', 'в Курганской области', 'kurganskaya-oblast', 1, 0, 1, NULL, '2021-12-17 04:04:21', 0),
(36, 1, 'Курская область', 'в Курской области', 'kurskaya-oblast', 0, 0, 1, NULL, '2021-12-16 16:09:51', 0),
(37, 1, 'Ленинградская область', 'Ленинградская область', 'leningradskaya-oblast', 1, 0, 1, NULL, '2021-12-16 13:42:45', 0),
(38, 1, 'Липецкая область', 'в Липецкой области', 'lipeckaya-oblast', 0, 0, 1, NULL, '2021-12-16 15:58:31', 0),
(39, 1, 'Магаданская область', 'Магаданская область', 'magadanskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:49', NULL),
(40, 1, 'Марий Эл', 'в Марий Эл', 'mariy-el', 0, 0, 1, NULL, '2021-12-17 10:56:11', 0),
(41, 1, 'Мордовия', 'в Мордовии', 'mordoviya', 0, 0, 1, NULL, '2021-12-17 10:42:46', 0),
(43, 1, 'Московская область', 'в Московской области', 'moskovskaya-oblast', 1, 0, 1, NULL, '2021-12-14 12:36:24', 0),
(44, 1, 'Мурманская область', 'в Мурманской области', 'murmanskaya-oblast', 0, 0, 1, NULL, '2021-12-17 04:52:43', 0),
(45, 1, 'Ненецкий АО', 'Ненецкий АО', 'neneckiy-ao', NULL, NULL, 0, NULL, '2021-10-25 15:58:49', NULL),
(46, 1, 'Нижегородская область', 'в Нижегородской области', 'nizhegorodskaya-oblast', 1, 0, 1, NULL, '2021-12-16 13:49:33', 0),
(47, 1, 'Новгородская область', 'в Новгородской области', 'novgorodskaya-oblast', 0, 0, 1, NULL, '2021-12-17 11:11:50', 0),
(48, 1, 'Новосибирская область', 'Новосибирская область', 'novosibirskaya-oblast', 1, 0, 1, NULL, '2021-12-16 13:47:06', 0),
(49, 1, 'Омская область', 'в Омской области', 'omskaya-oblast', 1, 0, 1, NULL, '2021-12-16 13:51:58', 0),
(50, 1, 'Оренбургская область', 'в Оренбургской области', 'orenburgskaya-oblast', 0, 0, 1, NULL, '2021-12-16 15:47:38', 0),
(51, 1, 'Орловская область', 'в Орловской области', 'orlovskaya-oblast', 0, 0, 1, NULL, '2021-12-17 04:20:25', 0),
(52, 1, 'Пензенская область', 'в Пензенской области', 'penzenskaya-oblast', 0, 0, 1, NULL, '2021-12-16 15:56:59', 0),
(53, 1, 'Пермский край', 'в Пермском крае', 'permskiy-kray', 1, 0, 1, NULL, '2021-12-16 14:06:20', 0),
(54, 1, 'Приморский край', 'в Приморском крае', 'primorskiy-kray', 0, 0, 1, NULL, '2021-12-16 15:04:31', 0),
(55, 1, 'Псковская область', 'в Псковской области', 'pskovskaya-oblast', 0, 0, 1, NULL, '2021-12-17 11:18:00', 0),
(56, 1, 'Ростовская область', 'в Ростовской области', 'rostovskaya-oblast', 1, 0, 1, NULL, '2021-12-16 13:55:43', 0),
(57, 1, 'Рязанская область', 'в Рязанской области', 'ryazanskaya-oblast', 0, 0, 1, NULL, '2021-12-16 15:54:56', 0),
(58, 1, 'Самарская область', 'в Самарской области', 'samarskaya-oblast', 1, 0, 1, NULL, '2021-12-16 13:50:56', 0),
(60, 1, 'Саратовская область', 'в Саратовской области', 'saratovskaya-oblast', 1, 0, 1, NULL, '2021-12-16 14:17:29', 0),
(61, 1, 'Саха (Якутия)', 'в Сахе (Якутия)', 'saha-yakutiya', 0, 0, 1, NULL, '2021-12-17 10:46:54', 0),
(62, 1, 'Сахалинская область', 'в Сахалинской области', 'sahalinskaya-oblast', 1, 0, 1, NULL, '2021-12-17 11:30:23', 0),
(63, 1, 'Свердловская область', 'Свердловская область', 'sverdlovskaya-oblast', 1, 0, 1, NULL, '2021-12-16 13:47:37', 0),
(64, 1, 'Северная Осетия', 'в Северной Осетии', 'severnaya-osetiya', 0, 0, 1, NULL, '2021-12-18 05:02:06', 0),
(65, 1, 'Смоленская область', 'в Смоленской области', 'smolenskaya-oblast', 0, 0, 1, NULL, '2021-12-17 04:07:33', 0),
(66, 1, 'Ставропольский край', 'в Ставропольском крае', 'stavropolskiy-kray', 0, 0, 1, NULL, '2021-12-17 03:58:16', 0),
(67, 1, 'Тамбовская область', 'в Тамбовской области', 'tambovskaya-oblast', 0, 0, 1, NULL, '2021-12-17 10:43:20', 0),
(68, 1, 'Татарстан', 'в Татарстане', 'tatarstan', 1, 0, 1, NULL, '2021-12-16 13:53:34', 0),
(69, 1, 'Тверская область', 'в Тверской области', 'tverskaya-oblast', 0, 0, 1, NULL, '2021-12-17 03:57:16', 0),
(70, 1, 'Томская область', 'в Томской области', 'tomskaya-oblast', 0, 0, 1, NULL, '2021-12-16 15:55:47', 0),
(71, 1, 'Тульская область', 'в Тульской области', 'tulskaya-oblast', 0, 0, 1, NULL, '2021-12-16 15:59:11', 0),
(72, 1, 'Тыва', 'Тыва', 'tyva', NULL, NULL, 0, NULL, '2021-10-25 15:58:49', NULL),
(73, 1, 'Тюменская область', 'Тюменская область', 'tyumenskaya-oblast', 1, 0, 1, NULL, '2021-12-16 15:42:21', 0),
(74, 1, 'Удмуртия', 'в Удмуртии', 'udmurtiya', 1, 0, 1, NULL, '2021-12-16 14:20:12', 0),
(75, 1, 'Ульяновская область', 'в Ульяновской области', 'ulyanovskaya-oblast', 0, 0, 1, NULL, '2021-12-16 14:41:09', 0),
(76, 1, 'Хабаровский край', 'в Хабаровском крае', 'habarovskiy-kray', 0, 0, 1, NULL, '2021-12-16 15:45:27', 0),
(77, 1, 'Хакасия', 'в Хакасии', 'hakasiya', 1, 0, 1, NULL, '2021-12-17 11:55:41', 0),
(78, 1, 'Ханты-Мансийский АО', 'в Ханты-Мансийском АО', 'hanty-mansiyskiy-ao', 0, 0, 1, NULL, '2021-12-17 04:54:16', 0),
(79, 1, 'Челябинская область', 'в Челябинской области', 'chelyabinskaya-oblast', 1, 0, 1, NULL, '2021-12-16 13:54:30', 0),
(80, 1, 'Чеченская республика', 'в Чеченской республике', 'chechenskaya-respublika', 0, 0, 1, NULL, '2021-12-17 10:45:20', 0),
(81, 1, 'Чувашия', 'в Чувашии', 'chuvashiya', 0, 0, 1, NULL, '2021-12-16 16:05:17', 0),
(82, 1, 'Чукотский АО', 'Чукотский АО', 'chukotskiy-ao', NULL, NULL, 0, NULL, '2021-10-25 15:58:49', NULL),
(83, 1, 'Ямало-Ненецкий АО', 'Ямало-Ненецкий АО', 'yamalo-neneckiy-ao', NULL, NULL, 0, NULL, '2021-10-25 15:58:49', NULL),
(84, 1, 'Ярославская область', 'в Ярославской области', 'yaroslavskaya-oblast', 0, 0, 1, NULL, '2021-12-16 15:22:16', 0),
(86, 1, 'Крым', 'Крым', 'krym', NULL, NULL, 0, NULL, '2021-10-25 15:58:49', NULL),
(87, 1, 'Севастополь', 'Севастополь', 'sevastopol', NULL, NULL, 0, NULL, '2021-10-25 15:58:49', NULL),
(88, 2, 'Майкоп', 'Майкоп', 'maykop', 0, 0, 0, NULL, '2021-12-13 16:17:43', 2),
(89, 2, 'Горно-Алтайск', 'Горно-Алтайск', 'gorno-altaysk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 3),
(90, 2, 'Барнаул', 'Барнаул', 'barnaul', 1, 0, 1, NULL, '2021-12-16 14:45:45', 4),
(91, 2, 'Бийск', 'в Бийске', 'biysk', 1, 0, 1, NULL, '2021-12-17 11:16:44', 4),
(92, 2, 'Рубцовск', 'Рубцовск', 'rubcovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 4),
(93, 2, 'Новоалтайск', 'Новоалтайск', 'novoaltaysk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 4),
(94, 2, 'Заринск', 'Заринск', 'zarinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 4),
(95, 2, 'Благовещенск', 'в Благовещенске', 'blagoveschensk', 1, 0, 1, NULL, '2021-12-20 16:06:44', 5),
(96, 2, 'Белогорск (Амурская область)', 'Белогорск (Амурская область)', 'belogorsk-amurskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 5),
(97, 2, 'Свободный', 'Свободный', 'svobodnyy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 5),
(98, 2, 'Архангельск', 'в Архангельске', 'arhangelsk', 1, 0, 1, NULL, '2021-12-17 04:01:52', 6),
(99, 2, 'Северодвинск', 'в Северодвинске', 'severodvinsk', 1, 0, 1, NULL, '2021-12-17 11:22:32', 6),
(100, 2, 'Котлас', 'Котлас', 'kotlas', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 6),
(101, 2, 'Астрахань', 'в Астрахани', 'astrahan', 1, 0, 1, NULL, '2021-12-16 15:56:33', 7),
(102, 2, 'Ахтубинск', 'Ахтубинск', 'ahtubinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 7),
(103, 2, 'Знаменск', 'Знаменск', 'znamensk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 7),
(104, 2, 'Уфа', 'в Уфе', 'ufa', 1, 1, 1, NULL, '2022-03-24 13:19:57', 8),
(105, 2, 'Стерлитамак', 'в Стерлитамаке', 'sterlitamak', 1, 0, 1, NULL, '2021-12-17 10:44:10', 8),
(106, 2, 'Салават', 'Салават', 'salavat', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 8),
(107, 2, 'Нефтекамск', 'Нефтекамск', 'neftekamsk', 0, 0, 0, NULL, '2021-12-16 13:57:36', 8),
(108, 2, 'Октябрьский', 'Октябрьский', 'oktyabrskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 8),
(109, 2, 'Белорецк', 'Белорецк', 'beloreck', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 8),
(110, 2, 'Благовещенск (Башкортостан)', 'Благовещенск (Башкортостан)', 'blagoveschensk-bashkortostan', 0, 0, 0, NULL, '2021-12-16 13:57:19', 8),
(111, 2, 'Белгород', 'в Белгороде', 'belgorod', 1, 0, 1, NULL, '2021-12-17 04:00:40', 9),
(112, 2, 'Старый Оскол', 'в Старом Осколе', 'staryy-oskol', 1, 0, 1, NULL, '2021-12-17 11:11:05', 9),
(113, 2, 'Губкин', 'Губкин', 'gubkin', 0, 0, 1, NULL, '2022-04-08 16:56:25', 9),
(114, 2, 'Шебекино', 'Шебекино', 'shebekino', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 9),
(115, 2, 'Новый Оскол', 'Новый Оскол', 'novyy-oskol', 1, NULL, 0, NULL, '2021-10-25 15:58:59', 9),
(116, 2, 'Брянск', 'в Брянске', 'bryansk', 1, 0, 1, NULL, '2021-12-16 16:09:00', 10),
(117, 2, 'Клинцы', 'Клинцы', 'klincy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 10),
(118, 2, 'Улан-Удэ', 'в Улан-Удэ', 'ulan-ude', 1, 0, 1, NULL, '2021-12-17 03:56:49', 11),
(119, 2, 'Северобайкальск', 'Северобайкальск', 'severobaykalsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 11),
(120, 2, 'Владимир', 'в Владимире', 'vladimir', 1, 0, 1, NULL, '2021-12-17 04:02:47', 12),
(121, 2, 'Ковров', 'Ковров', 'kovrov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 12),
(122, 2, 'Муром', 'Муром', 'murom', 1, NULL, 0, NULL, '2021-10-25 15:58:59', 12),
(123, 2, 'Александров', 'Александров', 'aleksandrov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 12),
(124, 2, 'Гусь-Хрустальный', 'Гусь-Хрустальный', 'gus-hrustalnyy', 1, NULL, 0, NULL, '2021-10-25 15:58:58', 12),
(125, 2, 'Киржач', 'Киржач', 'kirzhach', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 12),
(126, 2, 'Волгоград', 'в Волгограде', 'volgograd', 1, 1, 1, NULL, '2022-03-24 13:21:23', 13),
(127, 2, 'Волжский Волгоградской области', 'в Волжском', 'volzhskiy-volgogradskoy-oblasti', 1, 0, 1, NULL, '2021-12-18 05:14:54', 13),
(128, 2, 'Камышин', 'Камышин', 'kamyshin', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 13),
(129, 2, 'Калач-на-Дону', 'Калач-на-Дону', 'kalach-na-donu', 0, 0, 0, NULL, '2021-12-16 14:05:31', 13),
(130, 2, 'Череповец', 'в Череповце', 'cherepovec', 1, 0, 1, NULL, '2021-12-17 04:49:33', 14),
(131, 2, 'Вологда', 'в Вологде', 'vologda', 1, 0, 1, NULL, '2021-12-17 04:50:06', 14),
(132, 2, 'Сокол', 'Сокол', 'sokol', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 14),
(133, 2, 'Воронеж', 'в Воронеже', 'voronezh', 1, 1, 1, NULL, '2022-03-24 13:20:42', 15),
(134, 2, 'Борисоглебск', 'Борисоглебск', 'borisoglebsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 15),
(135, 2, 'Россошь', 'Россошь', 'rossosh', 1, NULL, 0, NULL, '2021-10-25 15:58:59', 15),
(136, 2, 'Лиски', 'Лиски', 'liski', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 15),
(137, 2, 'Павловск', 'Павловск', 'pavlovsk', 1, NULL, 0, NULL, '2021-10-25 15:58:59', 15),
(138, 2, 'Махачкала', 'в Махачкале', 'mahachkala', 1, 0, 1, NULL, '2021-12-16 15:45:01', 16),
(139, 2, 'Хасавюрт', 'Хасавюрт', 'hasavyurt', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 16),
(140, 2, 'Дербент', 'Дербент', 'derbent', 1, NULL, 0, NULL, '2021-10-25 15:58:58', 16),
(141, 2, 'Биробиджан', 'Биробиджан', 'birobidzhan', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 17),
(142, 2, 'Чита', 'в Чите', 'chita', 1, 0, 1, NULL, '2021-12-17 04:18:57', 18),
(143, 2, 'Краснокаменск', 'Краснокаменск', 'krasnokamensk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 18),
(144, 2, 'Иваново', 'в Иваново', 'ivanovo', 1, 0, 1, NULL, '2021-12-17 03:54:20', 19),
(145, 2, 'Кинешма', 'Кинешма', 'kineshma', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 19),
(146, 2, 'Шуя', 'Шуя', 'shuya', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 19),
(147, 2, 'Назрань', 'Назрань', 'nazran', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 20),
(148, 2, 'Иркутск', 'в Иркутске', 'irkutsk', 1, 0, 1, NULL, '2021-12-16 15:41:53', 21),
(149, 2, 'Братск', 'в Братске', 'bratsk', 1, 0, 1, NULL, '2021-12-17 10:58:21', 21),
(150, 2, 'Ангарск', 'в Ангарске', 'angarsk', 1, 0, 1, NULL, '2021-12-17 11:10:16', 21),
(151, 2, 'Усть-Илимск', 'Усть-Илимск', 'ust-ilimsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 21),
(152, 2, 'Нальчик', 'Нальчик', 'nalchik', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 22),
(153, 2, 'Прохладный', 'Прохладный', 'prohladnyy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 22),
(154, 2, 'Калининград', 'Калининград', 'kaliningrad', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 23),
(155, 2, 'Советск (Калининградская область)', 'Советск (Калининградская область)', 'sovetsk-kaliningradskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 23),
(156, 2, 'Элиста', 'Элиста', 'elista', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 24),
(157, 2, 'Калуга', 'в Калуге', 'kaluga', 1, 0, 1, NULL, '2021-12-17 04:17:30', 25),
(158, 2, 'Обнинск', 'Обнинск', 'obninsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 25),
(159, 2, 'Петропавловск-Камчатский', 'в Петропавловск-Камчатском', 'petropavlovsk-kamchatskiy', 1, 0, 1, NULL, '2021-12-17 11:41:50', 26),
(160, 2, 'Елизово', 'Елизово', 'elizovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 26),
(161, 2, 'Вилючинск', 'Вилючинск', 'vilyuchinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 26),
(162, 2, 'Черкесск', 'Черкесск', 'cherkessk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 27),
(163, 2, 'Петрозаводск', 'в Петрозаводске', 'petrozavodsk', 1, 0, 1, NULL, '2021-12-17 10:50:31', 28),
(164, 2, 'Кондопога', 'Кондопога', 'kondopoga', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 28),
(165, 2, 'Новокузнецк', 'в Новокузнецке', 'novokuzneck', 1, 0, 1, NULL, '2021-12-16 15:47:07', 29),
(166, 2, 'Кемерово', 'в Кемерово', 'kemerovo', 1, 0, 1, NULL, '2021-12-16 15:54:23', 29),
(167, 2, 'Прокопьевск', 'в Прокопьевске', 'prokopevsk', 1, 0, 1, NULL, '2021-12-17 11:16:03', 29),
(168, 2, 'Ленинск-Кузнецкий', 'Ленинск-Кузнецкий', 'leninsk-kuzneckiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 29),
(169, 2, 'Междуреченск', 'Междуреченск', 'mezhdurechensk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 29),
(170, 2, 'Киселёвск', 'Киселёвск', 'kiselevsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 29),
(171, 2, 'Юрга', 'Юрга', 'yurga', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 29),
(172, 2, 'Киров', 'в Кирове', 'kirov', 1, 0, 1, NULL, '2021-12-16 16:03:13', 30),
(173, 2, 'Кирово-Чепецк', 'Кирово-Чепецк', 'kirovo-chepeck', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 30),
(174, 2, 'Сыктывкар', 'в Сыктывкаре', 'syktyvkar', 1, 0, 1, NULL, '2021-12-17 11:08:24', 31),
(175, 2, 'Ухта', 'Ухта', 'uhta', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 31),
(176, 2, 'Воркута', 'Воркута', 'vorkuta', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 31),
(177, 2, 'Печора', 'Печора', 'pechora', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 31),
(178, 2, 'Кострома', 'в Костроме', 'kostroma', 1, 0, 1, NULL, '2021-12-17 10:48:03', 32),
(179, 2, 'Краснодар', 'Краснодар', 'krasnodar', 1, NULL, 0, NULL, '2021-10-25 15:58:59', 33),
(180, 2, 'Сочи', 'в Сочи', 'sochi', 1, 0, 1, NULL, '2021-12-17 04:03:45', 33),
(181, 2, 'Новороссийск', 'в Новороссийске', 'novorossiysk', 1, 0, 1, NULL, '2021-12-17 10:59:39', 33),
(182, 2, 'Армавир', 'в Армавире', 'armavir', 1, 0, 1, NULL, '2021-12-17 11:23:17', 33),
(183, 2, 'Ейск', 'Ейск', 'eysk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 33),
(184, 2, 'Кропоткин', 'Кропоткин', 'kropotkin', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 33),
(185, 2, 'Туапсе', 'Туапсе', 'tuapse', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 33),
(186, 2, 'Тихорецк', 'Тихорецк', 'tihoreck', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 33),
(187, 2, 'Анапа', 'Анапа', 'anapa', 1, NULL, 0, NULL, '2021-10-25 15:58:58', 33),
(188, 2, 'Белореченск', 'Белореченск', 'belorechensk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 33),
(189, 2, 'Геленджик', 'Геленджик', 'gelendzhik', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 33),
(190, 2, 'Красноярск', 'в Красноярске', 'krasnoyarsk', 1, 1, 1, NULL, '2022-03-24 13:20:26', 34),
(191, 2, 'Норильск', 'в Норильске', 'norilsk', 1, 0, 1, NULL, '2021-12-17 11:42:56', 34),
(192, 2, 'Ачинск', 'Ачинск', 'achinsk', 0, 0, 0, NULL, '2021-12-16 14:09:39', 34),
(193, 2, 'Канск', 'Канск', 'kansk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 34),
(194, 2, 'Железногорск (Красноярский край)', 'Железногорск (Красноярский край)', 'zheleznogorsk-krasnoyarskiy-kray', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 34),
(195, 2, 'Зеленогорск', 'Зеленогорск', 'zelenogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 34),
(196, 2, 'Курган', 'в Кургане', 'kurgan', 1, 0, 1, NULL, '2021-12-17 04:04:47', 35),
(197, 2, 'Шадринск', 'Шадринск', 'shadrinsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 35),
(198, 2, 'Курск', 'в Курске', 'kursk', 1, 0, 1, NULL, '2021-12-16 16:10:53', 36),
(199, 2, 'Железногорск (Курская область)', 'Железногорск (Курская область)', 'zheleznogorsk-kurskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 36),
(200, 2, 'Курчатов', 'Курчатов', 'kurchatov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 36),
(201, 2, 'Гатчина', 'Гатчина', 'gatchina', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 37),
(202, 2, 'Выборг', 'Выборг', 'vyborg', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 37),
(203, 2, 'Сосновый Бор', 'Сосновый Бор', 'sosnovyy-bor', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(204, 2, 'Тихвин', 'Тихвин', 'tihvin', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(205, 2, 'Кириши', 'Кириши', 'kirishi', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(206, 2, 'Кингисепп', 'Кингисепп', 'kingisepp', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(207, 2, 'Всеволожск', 'Всеволожск', 'vsevolozhsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 37),
(208, 2, 'Волхов', 'Волхов', 'volhov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 37),
(209, 2, 'Сертолово', 'Сертолово', 'sertolovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(210, 2, 'Луга', 'Луга', 'luga', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(211, 2, 'Тосно', 'Тосно', 'tosno', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(212, 2, 'Сланцы', 'Сланцы', 'slancy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(213, 2, 'Кировск (Ленинградская область)', 'Кировск (Ленинградская область)', 'kirovsk-leningradskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(214, 2, 'Лодейное Поле', 'Лодейное Поле', 'lodeynoe-pole', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(215, 2, 'Пикалёво', 'Пикалёво', 'pikalevo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(216, 2, 'Отрадное', 'Отрадное', 'otradnoe', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(217, 2, 'Подпорожье', 'Подпорожье', 'podporozhe', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(218, 2, 'Коммунар', 'Коммунар', 'kommunar', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(219, 2, 'Приозерск', 'Приозерск', 'priozersk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(220, 2, 'Никольское', 'Никольское', 'nikolskoe', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(221, 2, 'Бокситогорск', 'Бокситогорск', 'boksitogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 37),
(222, 2, 'Светогорск', 'Светогорск', 'svetogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(223, 2, 'Сясьстрой', 'Сясьстрой', 'syasstroy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(224, 2, 'Шлиссельбург', 'Шлиссельбург', 'shlisselburg', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 37),
(225, 2, 'Сиверский', 'Сиверский', 'siverskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(226, 2, 'Волосово', 'Волосово', 'volosovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 37),
(227, 2, 'Ивангород', 'Ивангород', 'ivangorod', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 37),
(228, 2, 'Вырица', 'Вырица', 'vyrica', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 37),
(229, 2, 'Поселок им. Морозова', 'Поселок им. Морозова', 'poselok-im-morozova', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(230, 2, 'Липецк', 'в Липецке', 'lipeck', 1, 0, 1, NULL, '2021-12-16 15:58:48', 38),
(231, 2, 'Елец', 'Елец', 'elec', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 38),
(232, 2, 'Магадан', 'Магадан', 'magadan', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 39),
(233, 2, 'Йошкар-Ола', 'в Йошкар-Оле', 'yoshkar-ola', 1, 0, 1, NULL, '2021-12-17 10:57:40', 40),
(234, 2, 'Волжск', 'Волжск', 'volzhsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 40),
(235, 2, 'Саранск', 'в Саранске', 'saransk', 1, 0, 1, NULL, '2021-12-17 10:43:00', 41),
(236, 2, 'Рузаевка', 'Рузаевка', 'ruzaevka', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 41),
(237, 2, 'Балашиха', 'в Балашихе', 'balashiha', 1, 0, 1, NULL, '2021-12-17 11:12:55', 43),
(238, 2, 'Химки', 'в Химках', 'himki', 1, 0, 1, NULL, '2021-12-17 11:17:27', 43),
(239, 2, 'Подольск', 'в Подольске', 'podolsk', 1, 0, 1, NULL, '2021-12-17 11:24:26', 43),
(240, 2, 'Королёв', 'в Королёве', 'korolev', 1, 0, 1, NULL, '2021-12-17 11:29:16', 43),
(241, 2, 'Мытищи', 'в Мытищах', 'mytischi', 1, 0, 1, NULL, '2021-12-17 11:53:14', 43),
(242, 2, 'Люберцы', 'в Люберцах', 'lyubercy', 1, 0, 1, NULL, '2021-12-17 11:53:44', 43),
(243, 2, 'Коломна', 'Коломна', 'kolomna', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(244, 2, 'Электросталь', 'Электросталь', 'elektrostal', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 43),
(245, 2, 'Одинцово', 'Одинцово', 'odincovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(246, 2, 'Железнодорожный (Балашиха)', 'Железнодорожный (Балашиха)', 'zheleznodorozhnyy-balashiha', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(247, 2, 'Серпухов', 'Серпухов', 'serpuhov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(248, 2, 'Орехово-Зуево', 'Орехово-Зуево', 'orehovo-zuevo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(249, 2, 'Ногинск', 'Ногинск', 'noginsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(250, 2, 'Щёлково', 'Щёлково', 'schelkovo', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 43),
(251, 2, 'Сергиев Посад', 'Сергиев Посад', 'sergiev-posad', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(252, 2, 'Жуковский', 'Жуковский', 'zhukovskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(253, 2, 'Красногорск', 'Красногорск', 'krasnogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(254, 2, 'Пушкино', 'Пушкино', 'pushkino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(255, 2, 'Воскресенск', 'Воскресенск', 'voskresensk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(256, 2, 'Домодедово', 'Домодедово', 'domodedovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(257, 2, 'Раменское', 'Раменское', 'ramenskoe', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(258, 2, 'Реутов', 'Реутов', 'reutov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(259, 2, 'Долгопрудный', 'Долгопрудный', 'dolgoprudnyy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(260, 2, 'Клин', 'Клин', 'klin', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(261, 2, 'Чехов', 'Чехов', 'chehov', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 43),
(262, 2, 'Наро-Фоминск', 'Наро-Фоминск', 'naro-fominsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(263, 2, 'Лобня', 'Лобня', 'lobnya', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(264, 2, 'Егорьевск', 'Егорьевск', 'egorevsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(265, 2, 'Ступино', 'Ступино', 'stupino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(266, 2, 'Дмитров', 'Дмитров', 'dmitrov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(267, 2, 'Дубна', 'Дубна', 'dubna', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(268, 2, 'Павловский Посад', 'Павловский Посад', 'pavlovskiy-posad', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(269, 2, 'Солнечногорск', 'Солнечногорск', 'solnechnogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(270, 2, 'Ивантеевка', 'Ивантеевка', 'ivanteevka', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(271, 2, 'Климовск (Москва)', 'Климовск (Москва)', 'klimovsk-moskva', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 42),
(272, 2, 'Видное', 'Видное', 'vidnoe', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(273, 2, 'Фрязино', 'Фрязино', 'fryazino', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 43),
(274, 2, 'Лыткарино', 'Лыткарино', 'lytkarino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(275, 2, 'Дзержинский', 'Дзержинский', 'dzerzhinskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(276, 2, 'Кашира', 'Кашира', 'kashira', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(277, 2, 'Протвино', 'Протвино', 'protvino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(278, 2, 'Троицк (Москва)', 'Троицк (Москва)', 'troick-moskva', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 42),
(279, 2, 'Юбилейный (Москва)', 'Юбилейный (Москва)', 'yubileynyy-moskva', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 42),
(280, 2, 'Истра', 'Истра', 'istra', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(281, 2, 'Нахабино', 'Нахабино', 'nahabino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(282, 2, 'Краснознаменск (Московская область)', 'Краснознаменск (Московская область)', 'krasnoznamensk-moskovskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(283, 2, 'Луховицы', 'Луховицы', 'luhovicy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(284, 2, 'Щербинка (Москва)', 'Щербинка (Москва)', 'scherbinka-moskva', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 42),
(285, 2, 'Шатура', 'Шатура', 'shatura', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 43),
(286, 2, 'Ликино-Дулёво', 'Ликино-Дулёво', 'likino-dulevo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(287, 2, 'Можайск', 'Можайск', 'mozhaysk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(288, 2, 'Томилино', 'Томилино', 'tomilino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(289, 2, 'Дедовск', 'Дедовск', 'dedovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(290, 2, 'Красноармейск (Московская область)', 'Красноармейск (Московская область)', 'krasnoarmeysk-moskovskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(291, 2, 'Кубинка', 'Кубинка', 'kubinka', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(292, 2, 'Озёры', 'Озёры', 'ozery', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(293, 2, 'Зарайск', 'Зарайск', 'zaraysk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(294, 2, 'Калининец', 'Калининец', 'kalininec', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(295, 2, 'Волоколамск', 'Волоколамск', 'volokolamsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(296, 2, 'Лосино-Петровский', 'Лосино-Петровский', 'losino-petrovskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(297, 2, 'Старая Купавна', 'Старая Купавна', 'staraya-kupavna', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(298, 2, 'Рошаль', 'Рошаль', 'roshal', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(299, 2, 'Электрогорск', 'Электрогорск', 'elektrogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 43),
(300, 2, 'Электроугли', 'Электроугли', 'elektrougli', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 43),
(301, 2, 'Черноголовка', 'Черноголовка', 'chernogolovka', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 43),
(302, 2, 'Котельники', 'Котельники', 'kotelniki', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(303, 2, 'Пущино', 'Пущино', 'puschino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(304, 2, 'Красково', 'Красково', 'kraskovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(305, 2, 'Мурманск', 'в Мурманске', 'murmansk', 1, 0, 1, NULL, '2021-12-17 04:52:58', 44),
(306, 2, 'Апатиты', 'Апатиты', 'apatity', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 44),
(307, 2, 'Североморск', 'Североморск', 'severomorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 44),
(308, 2, 'Нарьян-Мар', 'Нарьян-Мар', 'naryan-mar', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 45),
(309, 2, 'Нижний Новгород', 'в Нижнем Новгороде', 'nizhniy-novgorod', 1, 1, 1, NULL, '2021-12-16 13:50:17', 46),
(310, 2, 'Дзержинск', 'в Дзержинске', 'dzerzhinsk', 1, 0, 1, NULL, '2021-12-17 11:00:51', 46),
(311, 2, 'Арзамас', 'Арзамас', 'arzamas', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 46),
(312, 2, 'Саров', 'Саров', 'sarov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 46),
(313, 2, 'Бор', 'Бор', 'bor', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 46),
(314, 2, 'Кстово', 'Кстово', 'kstovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 46),
(315, 2, 'Павлово', 'Павлово', 'pavlovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 46),
(316, 2, 'Выкса', 'Выкса', 'vyksa', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 46),
(317, 2, 'Балахна', 'Балахна', 'balahna', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 46),
(318, 2, 'Великий Новгород', 'в Великом Новгороде', 'velikiy-novgorod', 1, 0, 1, NULL, '2021-12-17 11:12:10', 47),
(319, 2, 'Боровичи', 'Боровичи', 'borovichi', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 47),
(320, 2, 'Старая Русса', 'Старая Русса', 'staraya-russa', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 47),
(321, 2, 'Новосибирск', 'в Новосибирске', 'novosibirsk', 1, 1, 1, NULL, '2021-12-16 13:48:29', 48),
(322, 2, 'Бердск', 'Бердск', 'berdsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 48),
(323, 2, 'Куйбышев', 'Куйбышев', 'kuybyshev', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 48),
(324, 2, 'Омск', 'Омск', 'omsk', 1, 1, 1, NULL, '2022-03-24 13:18:53', 49),
(325, 2, 'Оренбург', 'в Оренбурге', 'orenburg', 1, 0, 1, NULL, '2021-12-16 15:49:53', 50),
(326, 2, 'Орск', 'в Орске', 'orsk', 1, 0, 1, NULL, '2021-12-17 11:07:46', 50),
(327, 2, 'Новотроицк', 'Новотроицк', 'novotroick', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 50),
(328, 2, 'Бузулук', 'Бузулук', 'buzuluk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 50),
(329, 2, 'Орёл', 'в Орле', 'orel', 1, 0, 1, NULL, '2021-12-17 04:27:54', 51),
(330, 2, 'Ливны', 'Ливны', 'livny', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 51),
(331, 2, 'Мценск', 'Мценск', 'mcensk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 51),
(332, 2, 'Пенза', 'в Пензе', 'penza', 1, 0, 1, NULL, '2021-12-16 15:57:15', 52),
(333, 2, 'Кузнецк', 'Кузнецк', 'kuzneck', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 52),
(334, 2, 'Заречный (Пензенская область)', 'Заречный (Пензенская область)', 'zarechnyy-penzenskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 52),
(335, 2, 'Каменка', 'Каменка', 'kamenka', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 52),
(336, 2, 'Пермь', 'в Перми', 'perm', 1, 1, 1, NULL, '2022-03-24 13:20:57', 53),
(337, 2, 'Березники', 'Березники', 'berezniki', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 53),
(338, 2, 'Соликамск', 'Соликамск', 'solikamsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 53),
(339, 2, 'Чайковский', 'Чайковский', 'chaykovskiy', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 53),
(340, 2, 'Лысьва', 'Лысьва', 'lysva', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 53),
(341, 2, 'Кунгур', 'Кунгур', 'kungur', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 53),
(342, 2, 'Краснокамск', 'Краснокамск', 'krasnokamsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 53),
(343, 2, 'Владивосток', 'в Владивостоке', 'vladivostok', 1, 0, 1, NULL, '2022-03-24 13:11:32', 54),
(344, 2, 'Находка', 'в Находке', 'nahodka', 1, 0, 1, NULL, '2021-12-17 11:56:31', 54),
(345, 2, 'Уссурийск', 'Уссурийск', 'ussuriysk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 54),
(346, 2, 'Артём', 'Артём', 'artem', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 54),
(347, 2, 'Псков', 'в Пскове', 'pskov', 1, 0, 1, NULL, '2021-12-17 11:18:19', 55),
(348, 2, 'Великие Луки', 'Великие Луки', 'velikie-luki', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 55),
(349, 2, 'Ростов-на-Дону', 'в Ростове-на-Дону', 'rostov-na-donu', 1, 1, 1, NULL, '2022-03-24 13:19:27', 56),
(350, 2, 'Таганрог', 'в Таганроге', 'taganrog', 1, 0, 1, NULL, '2021-12-17 10:52:58', 56),
(351, 2, 'Шахты', 'в Шахтах', 'shahty', 1, 0, 1, NULL, '2021-12-17 11:01:32', 56),
(352, 2, 'Новочеркасск', 'в Новочеркасске', 'novocherkassk', 1, 0, 1, NULL, '2021-12-17 11:55:08', 56),
(353, 2, 'Волгодонск', 'в Волгодонске', 'volgodonsk', 1, 0, 1, NULL, '2021-12-17 11:54:11', 56),
(354, 2, 'Новошахтинск', 'Новошахтинск', 'novoshahtinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 56),
(355, 2, 'Батайск', 'Батайск', 'bataysk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 56),
(356, 2, 'Каменск-Шахтинский', 'Каменск-Шахтинский', 'kamensk-shahtinskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 56),
(357, 2, 'Азов', 'Азов', 'azov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 56),
(358, 2, 'Гуково', 'Гуково', 'gukovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 56),
(359, 2, 'Сальск', 'Сальск', 'salsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 56),
(360, 2, 'Донецк', 'Донецк', 'doneck', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 56),
(361, 2, 'Белая Калитва', 'Белая Калитва', 'belaya-kalitva', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 56),
(362, 2, 'Рязань', 'в Рязани', 'ryazan', 1, 0, 1, NULL, '2021-12-16 15:55:23', 57),
(363, 2, 'Касимов', 'Касимов', 'kasimov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 57),
(364, 2, 'Самара', 'в Самаре', 'samara', 1, 1, 1, NULL, '2021-12-16 08:32:50', 58),
(365, 2, 'Тольятти', 'в Тольятти', 'tolyatti', 1, 0, 1, NULL, '2021-12-16 14:19:03', 58),
(366, 2, 'Сызрань', 'в Сызрани', 'syzran', 1, 0, 1, NULL, '2021-12-17 11:42:20', 58),
(367, 2, 'Новокуйбышевск', 'Новокуйбышевск', 'novokuybyshevsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 58),
(368, 2, 'Чапаевск', 'Чапаевск', 'chapaevsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 58),
(369, 2, 'Жигулёвск', 'Жигулёвск', 'zhigulevsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 58),
(370, 2, 'Саратов', 'в Саратове', 'saratov', 1, 0, 1, NULL, '2021-12-16 14:18:02', 60),
(371, 2, 'Энгельс', 'в Энгельсе', 'engels', 1, 0, 1, NULL, '2021-12-17 11:20:49', 60),
(372, 2, 'Балаково', 'в Балаково', 'balakovo', 1, 0, 1, NULL, '2021-12-17 11:22:03', 60),
(373, 2, 'Балашов', 'Балашов', 'balashov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 60),
(374, 2, 'Вольск', 'Вольск', 'volsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 60),
(375, 2, 'Якутск', 'в Якутске', 'yakutsk', 1, 0, 1, NULL, '2021-12-17 10:47:13', 61),
(376, 2, 'Нерюнгри', 'Нерюнгри', 'neryungri', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 61),
(377, 2, 'Мирный', 'Мирный', 'mirnyy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 61),
(378, 2, 'Южно-Сахалинск', 'в Южно-Сахалинске', 'yuzhno-sahalinsk', 1, 0, 1, NULL, '2021-12-17 11:30:41', 62),
(379, 2, 'Екатеринбург', 'в Екатеринбурге', 'ekaterinburg', 1, 1, 1, NULL, '2021-12-16 13:48:45', 63),
(380, 2, 'Нижний Тагил', 'в НижнимТагиле', 'nizhniy-tagil', 1, 0, 1, NULL, '2021-12-17 03:59:57', 63),
(381, 2, 'Каменск-Уральский', 'в Каменск-Уральском', 'kamensk-uralskiy', 1, 0, 1, NULL, '2021-12-17 11:51:20', 63),
(382, 2, 'Первоуральск', 'Первоуральск', 'pervouralsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(383, 2, 'Серов', 'Серов', 'serov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(384, 2, 'Новоуральск', 'Новоуральск', 'novouralsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(385, 2, 'Асбест', 'Асбест', 'asbest', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(386, 2, 'Полевской', 'Полевской', 'polevskoy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(387, 2, 'Ревда', 'Ревда', 'revda', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(388, 2, 'Краснотурьинск', 'Краснотурьинск', 'krasnoturinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(389, 2, 'Владикавказ', 'в Владикавказе', 'vladikavkaz', 1, 0, 1, NULL, '2021-12-17 04:52:13', 64),
(390, 2, 'Моздок', 'Моздок', 'mozdok', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 64),
(391, 2, 'Смоленск', 'в Смоленске', 'smolensk', 1, 0, 1, NULL, '2021-12-17 04:07:57', 65),
(392, 2, 'Вязьма', 'Вязьма', 'vyazma', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 65),
(393, 2, 'Ставрополь', 'в Ставрополе', 'stavropol', 1, 0, 1, NULL, '2021-12-17 03:58:43', 66),
(394, 2, 'Пятигорск', 'Пятигорск', 'pyatigorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 66),
(395, 2, 'Кисловодск', 'Кисловодск', 'kislovodsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 66),
(396, 2, 'Ессентуки', 'Ессентуки', 'essentuki', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 66),
(397, 2, 'Минеральные Воды', 'Минеральные Воды', 'mineralnye-vody', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 66),
(398, 2, 'Будённовск', 'Будённовск', 'budennovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 66),
(399, 2, 'Тамбов', 'в Тамбове', 'tambov', 1, 0, 1, NULL, '2021-12-17 10:43:34', 67),
(400, 2, 'Мичуринск', 'Мичуринск', 'michurinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 67),
(401, 2, 'Казань', 'в Казани', 'kazan', 1, 1, 1, NULL, '2022-03-24 13:18:03', 68),
(402, 2, 'Набережные Челны', 'в Набережных Челнах', 'naberezhnye-chelny', 1, 0, 1, NULL, '2021-12-16 15:57:59', 68),
(403, 2, 'Нижнекамск', 'в Нижнекамск', 'nizhnekamsk', 1, 0, 1, NULL, '2021-12-17 11:09:33', 68),
(404, 2, 'Альметьевск', 'Альметьевск', 'almetevsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 68),
(405, 2, 'Зеленодольск', 'Зеленодольск', 'zelenodolsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 68),
(406, 2, 'Бугульма', 'Бугульма', 'bugulma', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 68),
(407, 2, 'Тверь', 'в Твери', 'tver', 1, 0, 1, NULL, '2021-12-17 03:57:36', 69),
(408, 2, 'Ржев', 'Ржев', 'rzhev', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 69),
(409, 2, 'Томск', 'в Томске', 'tomsk', 1, 0, 1, NULL, '2021-12-16 15:56:03', 70),
(410, 2, 'Северск', 'Северск', 'seversk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 70),
(411, 2, 'Тула', 'в Туле', 'tula', 1, 0, 1, NULL, '2021-12-16 15:59:46', 71),
(412, 2, 'Новомосковск', 'Новомосковск', 'novomoskovsk', 0, 0, 1, NULL, '2022-03-24 13:13:53', 71),
(413, 2, 'Узловая', 'Узловая', 'uzlovaya', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 71),
(414, 2, 'Кызыл', 'Кызыл', 'kyzyl', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 72),
(415, 2, 'Тюмень', 'в Тюмени', 'tyumen', 1, 0, 1, NULL, '2021-12-16 15:42:39', 73),
(416, 2, 'Тобольск', 'Тобольск', 'tobolsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 73),
(417, 2, 'Ижевск', 'Ижевск', 'izhevsk', 1, 0, 1, NULL, '2021-12-16 14:20:28', 74),
(418, 2, 'Сарапул', 'Сарапул', 'sarapul', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 74),
(419, 2, 'Глазов', 'Глазов', 'glazov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 74),
(420, 2, 'Воткинск', 'Воткинск', 'votkinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 74),
(421, 2, 'Ульяновск', 'в Ульяновске', 'ul-yanovsk', 1, 0, 1, NULL, '2021-12-16 14:42:14', 75),
(422, 2, 'Димитровград', 'Димитровград', 'dimitrovgrad', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 75),
(423, 2, 'Хабаровск', 'в Хабаровске', 'habarovsk', 1, 0, 1, NULL, '2021-12-16 15:45:50', 76),
(424, 2, 'Комсомольск-на-Амуре', 'в Комсомольске-на-Амуре', 'komsomolsk-na-amure', 1, 0, 1, NULL, '2021-12-17 10:48:40', 76),
(425, 2, 'Амурск', 'Амурск', 'amursk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 76),
(426, 2, 'Абакан', 'в Абакане', 'abakan', 1, 0, 1, NULL, '2021-12-17 11:55:57', 77),
(427, 2, 'Черногорск', 'Черногорск', 'chernogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 77),
(428, 2, 'Сургут', 'в Сургуте', 'surgut', 1, 0, 1, NULL, '2021-12-17 04:54:31', 78),
(429, 2, 'Нижневартовск', 'в Нижневартовске', 'nizhnevartovsk', 1, 0, 1, NULL, '2021-12-17 10:53:45', 78),
(430, 2, 'Нефтеюганск', 'Нефтеюганск', 'nefteyugansk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 78),
(431, 2, 'Ханты-Мансийск', 'Ханты-Мансийск', 'hanty-mansiysk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 78),
(432, 2, 'Челябинск', 'в Челябинске', 'chelyabinsk', 1, 1, 1, NULL, '2022-03-24 13:18:31', 79),
(433, 2, 'Магнитогорск', 'в Магнитогорске', 'magnitogorsk', 1, 0, 1, NULL, '2021-12-17 03:54:57', 79),
(434, 2, 'Златоуст', 'в Златоусте', 'zlatoust', 1, 0, 1, NULL, '2021-12-17 11:47:42', 79),
(435, 2, 'Миасс', 'Миасс', 'miass', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 79),
(436, 2, 'Копейск', 'Копейск', 'kopeysk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 79),
(437, 2, 'Озёрск', 'Озёрск', 'ozersk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 79),
(438, 2, 'Троицк', 'Троицк', 'troick', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 79),
(439, 2, 'Снежинск', 'Снежинск', 'snezhinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 79),
(440, 2, 'Сатка', 'Сатка', 'satka', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 79),
(441, 2, 'Грозный', 'в Грозном', 'groznyy', 1, 0, 1, NULL, '2021-12-17 10:45:01', 80),
(442, 2, 'Урус-Мартан', 'Урус-Мартан', 'urus-martan', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 80),
(443, 2, 'Чебоксары', 'в Чебоксарах', 'cheboksary', 1, 0, 1, NULL, '2021-12-16 16:05:38', 81),
(444, 2, 'Новочебоксарск', 'Новочебоксарск', 'novocheboksarsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 81),
(445, 2, 'Новый Уренгой', 'Новый Уренгой', 'novyy-urengoy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 83),
(446, 2, 'Ноябрьск', 'Ноябрьск', 'noyabrsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 83),
(447, 2, 'Ярославль', 'в Ярославле', 'yaroslavl', 0, 0, 1, NULL, '2021-12-16 15:24:15', 84),
(448, 2, 'Рыбинск', 'в Рыбинске', 'rybinsk', 1, 0, 1, NULL, '2021-12-17 11:21:31', 84),
(449, 2, 'Переславль-Залесский', 'Переславль-Залесский', 'pereslavl--zalesskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 84),
(450, 2, 'Москва', 'в Москве', 'moskva', 1, 1, 1, NULL, '2021-12-14 10:07:30', 43),
(451, 2, 'Санкт-Петербург', 'Санкт-Петербурге', 'sankt-peterburg', 1, 1, 1, NULL, '2021-12-14 10:07:36', 37),
(452, 2, 'Абаза', 'Абаза', 'abaza', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 77),
(453, 2, 'Абдулино', 'Абдулино', 'abdulino', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 50),
(454, 2, 'Абинск', 'Абинск', 'abinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 33),
(455, 2, 'Агидель', 'Агидель', 'agidel', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 8),
(456, 2, 'Агрыз', 'Агрыз', 'agryz', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 68),
(457, 2, 'Адыгейск', 'Адыгейск', 'adygeysk', 0, 0, 0, NULL, '2021-12-13 16:17:27', 2),
(458, 2, 'Азнакаево', 'Азнакаево', 'aznakaevo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 68),
(459, 2, 'Ак-Довурак', 'Ак-Довурак', 'ak-dovurak', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 72),
(460, 2, 'Аксай', 'Аксай', 'aksay', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 56),
(461, 2, 'Алагир', 'Алагир', 'alagir', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 64),
(462, 2, 'Алапаевск', 'Алапаевск', 'alapaevsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(463, 2, 'Алатырь', 'Алатырь', 'alatyr', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 81),
(464, 2, 'Алдан', 'Алдан', 'aldan', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 61),
(465, 2, 'Алейск', 'Алейск', 'aleysk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 4),
(466, 2, 'Александровск', 'Александровск', 'aleksandrovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 53),
(467, 2, 'Александровск-Сахалинский', 'Александровск-Сахалинский', 'aleksandrovsk-sahalinskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 62),
(468, 2, 'Алексеевка', 'Алексеевка', 'alekseevka', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 9),
(469, 2, 'Алексин', 'Алексин', 'aleksin', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 71),
(470, 2, 'Алзамай', 'Алзамай', 'alzamay', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 21),
(471, 2, 'Анадырь', 'Анадырь', 'anadyr', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 82),
(472, 2, 'Андреаполь', 'Андреаполь', 'andreapol', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 69),
(473, 2, 'Анжеро-Судженск', 'Анжеро-Судженск', 'anzhero-sudzhensk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 29),
(474, 2, 'Анива', 'Анива', 'aniva', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 62),
(475, 2, 'Апрелевка', 'Апрелевка', 'aprelevka', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(476, 2, 'Апшеронск', 'Апшеронск', 'apsheronsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 33),
(477, 2, 'Арамиль', 'Арамиль', 'aramil', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(478, 2, 'Аргун', 'Аргун', 'argun', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 80),
(479, 2, 'Ардатов', 'Ардатов', 'ardatov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 41),
(480, 2, 'Ардон', 'Ардон', 'ardon', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 64),
(481, 2, 'Аркадак', 'Аркадак', 'arkadak', 1, 1, 0, NULL, '2021-12-08 07:32:32', 60),
(482, 2, 'Арсеньев', 'Арсеньев', 'arsenev', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 54),
(483, 2, 'Арск', 'Арск', 'arsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 68),
(484, 2, 'Артёмовск', 'Артёмовск', 'artemovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 34),
(485, 2, 'Артёмовский', 'Артёмовский', 'artemovskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(486, 2, 'Асино', 'Асино', 'asino', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 70),
(487, 2, 'Аткарск', 'Аткарск', 'atkarsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 60),
(488, 2, 'Аша', 'Аша', 'asha', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 79),
(489, 2, 'Бабаево', 'Бабаево', 'babaevo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 14),
(490, 2, 'Бабушкин', 'Бабушкин', 'babushkin', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 11),
(491, 2, 'Бавлы', 'Бавлы', 'bavly', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 68),
(492, 2, 'Багратионовск', 'Багратионовск', 'bagrationovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 23),
(493, 2, 'Байкальск', 'Байкальск', 'baykalsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 21),
(494, 2, 'Баймак', 'Баймак', 'baymak', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 8),
(495, 2, 'Бакал', 'Бакал', 'bakal', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 79),
(496, 2, 'Баксан', 'Баксан', 'baksan', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 22),
(497, 2, 'Балабаново', 'Балабаново', 'balabanovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 25),
(498, 2, 'Балей', 'Балей', 'baley', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 18),
(499, 2, 'Балтийск', 'Балтийск', 'baltiysk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 23),
(500, 2, 'Барабинск', 'Барабинск', 'barabinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 48),
(501, 2, 'Барыш', 'Барыш', 'barysh', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 75),
(502, 2, 'Бежецк', 'Бежецк', 'bezheck', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 69),
(503, 2, 'Белёв', 'Белёв', 'belev', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 71),
(504, 2, 'Белая Холуница', 'Белая Холуница', 'belaya-holunica', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 30),
(505, 2, 'Белебей', 'Белебей', 'belebey', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 8),
(506, 2, 'Белинский', 'Белинский', 'belinskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 52),
(507, 2, 'Белово', 'Белово', 'belovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 29),
(508, 2, 'Белозерск', 'Белозерск', 'belozersk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 14),
(509, 2, 'Белокуриха', 'Белокуриха', 'belokuriha', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 4),
(510, 2, 'Беломорск', 'Беломорск', 'belomorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 28),
(511, 2, 'Белоусово', 'Белоусово', 'belousovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 25),
(512, 2, 'Белоярский', 'Белоярский', 'beloyarskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 78),
(513, 2, 'Белый', 'Белый', 'belyy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 69),
(514, 2, 'Березовский (Кемеровская область)', 'Березовский (Кемеровская область)', 'berezovskiy-kemerovskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 29),
(515, 2, 'Березовский (Свердловская область)', 'Березовский (Свердловская область)', 'berezovskiy-sverdlovskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(516, 2, 'Беслан', 'Беслан', 'beslan', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 64),
(517, 2, 'Бикин', 'Бикин', 'bikin', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 76),
(518, 2, 'Билибино', 'Билибино', 'bilibino', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 82),
(519, 2, 'Бирск', 'Бирск', 'birsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 8);
INSERT INTO `regions` (`id`, `type`, `name`, `name_case`, `url`, `favorite`, `footer`, `public`, `created_at`, `updated_at`, `parent_id`) VALUES
(520, 2, 'Бирюсинск', 'Бирюсинск', 'biryusinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 21),
(521, 2, 'Бирюч', 'Бирюч', 'biryuch', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 9),
(522, 2, 'Благодарный', 'Благодарный', 'blagodarnyy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 66),
(523, 2, 'Бобров', 'Бобров', 'bobrov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 15),
(524, 2, 'Богданович', 'Богданович', 'bogdanovich', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(525, 2, 'Богородицк', 'Богородицк', 'bogorodick', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 71),
(526, 2, 'Богородск', 'Богородск', 'bogorodsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 46),
(527, 2, 'Боготол', 'Боготол', 'bogotol', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 34),
(528, 2, 'Богучар', 'Богучар', 'boguchar', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 15),
(529, 2, 'Бодайбо', 'Бодайбо', 'bodaybo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 21),
(530, 2, 'Болгар', 'Болгар', 'bolgar', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 68),
(531, 2, 'Бологое', 'Бологое', 'bologoe', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 69),
(532, 2, 'Болотное', 'Болотное', 'bolotnoe', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 48),
(533, 2, 'Болохово', 'Болохово', 'bolohovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 71),
(534, 2, 'Болхов', 'Болхов', 'bolhov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 51),
(535, 2, 'Большой Камень', 'Большой Камень', 'bolshoy-kamen', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 54),
(536, 2, 'Борзя', 'Борзя', 'borzya', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 18),
(537, 2, 'Боровск', 'Боровск', 'borovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 25),
(538, 2, 'Бородино', 'Бородино', 'borodino', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 34),
(539, 2, 'Бронницы', 'Бронницы', 'bronnicy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(540, 2, 'Бугуруслан', 'Бугуруслан', 'buguruslan', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 50),
(541, 2, 'Буинск', 'Буинск', 'buinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 68),
(542, 2, 'Буй', 'Буй', 'buy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 32),
(543, 2, 'Буйнакск', 'Буйнакск', 'buynaksk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 16),
(544, 2, 'Бутурлиновка', 'Бутурлиновка', 'buturlinovka', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 15),
(545, 2, 'Валдай', 'Валдай', 'valday', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 47),
(546, 2, 'Валуйки', 'Валуйки', 'valuyki', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 9),
(547, 2, 'Велиж', 'Велиж', 'velizh', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 65),
(548, 2, 'Великий Устюг', 'Великий Устюг', 'velikiy-ustyug', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 14),
(549, 2, 'Вельск', 'Вельск', 'velsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 6),
(550, 2, 'Венёв', 'Венёв', 'venev', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 71),
(551, 2, 'Верещагино', 'Верещагино', 'vereschagino', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 53),
(552, 2, 'Верея', 'Верея', 'vereya', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(553, 2, 'Верхнеуральск', 'Верхнеуральск', 'verhneuralsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 79),
(554, 2, 'Верхний Тагил', 'Верхний Тагил', 'verhniy-tagil', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(555, 2, 'Верхний Уфалей', 'Верхний Уфалей', 'verhniy-ufaley', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 79),
(556, 2, 'Верхняя Пышма', 'Верхняя Пышма', 'verhnyaya-pyshma', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(557, 2, 'Верхняя Салда', 'Верхняя Салда', 'verhnyaya-salda', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(558, 2, 'Верхняя Тура', 'Верхняя Тура', 'verhnyaya-tura', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(559, 2, 'Верхотурье', 'Верхотурье', 'verhoture', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(560, 2, 'Верхоянск', 'Верхоянск', 'verhoyansk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 61),
(561, 2, 'Весьегонск', 'Весьегонск', 'vesegonsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 69),
(562, 2, 'Ветлуга', 'Ветлуга', 'vetluga', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 46),
(563, 2, 'Вилюйск', 'Вилюйск', 'vilyuysk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 61),
(564, 2, 'Вихоревка', 'Вихоревка', 'vihorevka', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 21),
(565, 2, 'Вичуга', 'Вичуга', 'vichuga', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 19),
(566, 2, 'Волгореченск', 'Волгореченск', 'volgorechensk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 32),
(567, 2, 'Володарск', 'Володарск', 'volodarsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 46),
(568, 2, 'Волчанск', 'Волчанск', 'volchansk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(569, 2, 'Ворсма', 'Ворсма', 'vorsma', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 46),
(570, 2, 'Вуктыл', 'Вуктыл', 'vuktyl', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 31),
(571, 2, 'Высоковск', 'Высоковск', 'vysokovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(572, 2, 'Высоцк', 'Высоцк', 'vysock', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 37),
(573, 2, 'Вытегра', 'Вытегра', 'vytegra', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 14),
(574, 2, 'Вышний Волочёк', 'Вышний Волочёк', 'vyshniy-volochek', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 69),
(575, 2, 'Вяземский', 'Вяземский', 'vyazemskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 76),
(576, 2, 'Вязники', 'Вязники', 'vyazniki', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 12),
(577, 2, 'Вятские Поляны', 'Вятские Поляны', 'vyatskie-polyany', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 30),
(578, 2, 'Гаврилов Посад', 'Гаврилов Посад', 'gavrilov-posad', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 19),
(579, 2, 'Гаврилов-Ям', 'Гаврилов-Ям', 'gavrilov-yam', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 84),
(580, 2, 'Гагарин', 'Гагарин', 'gagarin', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 65),
(581, 2, 'Гаджиево', 'Гаджиево', 'gadzhievo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 44),
(582, 2, 'Гай', 'Гай', 'gay', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 50),
(583, 2, 'Галич', 'Галич', 'galich', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 32),
(584, 2, 'Гвардейск', 'Гвардейск', 'gvardeysk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 23),
(585, 2, 'Гдов', 'Гдов', 'gdov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 55),
(586, 2, 'Георгиевск', 'Георгиевск', 'georgievsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 66),
(587, 2, 'Голицыно', 'Голицыно', 'golicyno', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(588, 2, 'Горбатов', 'Горбатов', 'gorbatov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 46),
(589, 2, 'Горнозаводск', 'Горнозаводск', 'gornozavodsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 53),
(590, 2, 'Горняк', 'Горняк', 'gornyak', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 4),
(591, 2, 'Городец', 'Городец', 'gorodec', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 46),
(592, 2, 'Городище', 'Городище', 'gorodische', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 52),
(593, 2, 'Городовиковск', 'Городовиковск', 'gorodovikovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 24),
(594, 2, 'Гороховец', 'Гороховец', 'gorohovec', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 12),
(595, 2, 'Горячий Ключ', 'Горячий Ключ', 'goryachiy-klyuch', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 33),
(596, 2, 'Грайворон', 'Грайворон', 'grayvoron', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 9),
(597, 2, 'Гремячинск', 'Гремячинск', 'gremyachinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 53),
(598, 2, 'Грязи', 'Грязи', 'gryazi', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 38),
(599, 2, 'Грязовец', 'Грязовец', 'gryazovec', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 14),
(600, 2, 'Губаха', 'Губаха', 'gubaha', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 53),
(601, 2, 'Губкинский', 'Губкинский', 'gubkinskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 83),
(602, 2, 'Гудермес', 'Гудермес', 'gudermes', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 80),
(603, 2, 'Гулькевичи', 'Гулькевичи', 'gulkevichi', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 33),
(604, 2, 'Гурьевск (Калининградская область)', 'Гурьевск (Калининградская область)', 'gurevsk-kaliningradskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 23),
(605, 2, 'Гурьевск (Кемеровская область)', 'Гурьевск (Кемеровская область)', 'gurevsk-kemerovskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 29),
(606, 2, 'Гусев', 'Гусев', 'gusev', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 23),
(607, 2, 'Гусиноозёрск', 'Гусиноозёрск', 'gusinoozersk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 11),
(608, 2, 'Давлеканово', 'Давлеканово', 'davlekanovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 8),
(609, 2, 'Дагестанские Огни', 'Дагестанские Огни', 'dagestanskie-ogni', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 16),
(610, 2, 'Далматово', 'Далматово', 'dalmatovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 35),
(611, 2, 'Дальнегорск', 'Дальнегорск', 'dalnegorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 54),
(612, 2, 'Дальнереченск', 'Дальнереченск', 'dalnerechensk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 54),
(613, 2, 'Данилов', 'Данилов', 'danilov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 84),
(614, 2, 'Данков', 'Данков', 'dankov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 38),
(615, 2, 'Дегтярск', 'Дегтярск', 'degtyarsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(616, 2, 'Демидов', 'Демидов', 'demidov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 65),
(617, 2, 'Десногорск', 'Десногорск', 'desnogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 65),
(618, 2, 'Дивногорск', 'Дивногорск', 'divnogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 34),
(619, 2, 'Дигора', 'Дигора', 'digora', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 64),
(620, 2, 'Дмитриев', 'Дмитриев', 'dmitriev', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 36),
(621, 2, 'Дмитровск', 'Дмитровск', 'dmitrovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 51),
(622, 2, 'Дно', 'Дно', 'dno', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 55),
(623, 2, 'Добрянка', 'Добрянка', 'dobryanka', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 53),
(624, 2, 'Долинск', 'Долинск', 'dolinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 62),
(625, 2, 'Донской', 'Донской', 'donskoy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 71),
(626, 2, 'Дорогобуж', 'Дорогобуж', 'dorogobuzh', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 65),
(627, 2, 'Дрезна', 'Дрезна', 'drezna', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(628, 2, 'Дубовка', 'Дубовка', 'dubovka', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 13),
(629, 2, 'Дудинка', 'Дудинка', 'dudinka', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 34),
(630, 2, 'Духовщина', 'Духовщина', 'duhovschina', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 65),
(631, 2, 'Дюртюли', 'Дюртюли', 'dyurtyuli', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 8),
(632, 2, 'Дятьково', 'Дятьково', 'dyatkovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 10),
(633, 2, 'Елабуга', 'Елабуга', 'elabuga', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 68),
(634, 2, 'Ельня', 'Ельня', 'elnya', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 65),
(635, 2, 'Еманжелинск', 'Еманжелинск', 'emanzhelinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 79),
(636, 2, 'Емва', 'Емва', 'emva', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 31),
(637, 2, 'Енисейск', 'Енисейск', 'eniseysk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 34),
(638, 2, 'Ермолино', 'Ермолино', 'ermolino', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 25),
(639, 2, 'Ершов', 'Ершов', 'ershov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 60),
(640, 2, 'Ефремов', 'Ефремов', 'efremov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 71),
(641, 2, 'Железноводск', 'Железноводск', 'zheleznovodsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 66),
(642, 2, 'Железногорск-Илимский', 'Железногорск-Илимский', 'zheleznogorsk-ilimskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 21),
(643, 2, 'Жердевка', 'Жердевка', 'zherdevka', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 67),
(644, 2, 'Жиздра', 'Жиздра', 'zhizdra', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 25),
(645, 2, 'Жирновск', 'Жирновск', 'zhirnovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 13),
(646, 2, 'Жуков', 'Жуков', 'zhukov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 25),
(647, 2, 'Жуковка', 'Жуковка', 'zhukovka', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 10),
(648, 2, 'Завитинск', 'Завитинск', 'zavitinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 5),
(649, 2, 'Заводоуковск', 'Заводоуковск', 'zavodoukovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 73),
(650, 2, 'Заволжск', 'Заволжск', 'zavolzhsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 19),
(651, 2, 'Заволжье', 'Заволжье', 'zavolzhe', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 46),
(652, 2, 'Задонск', 'Задонск', 'zadonsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 38),
(653, 2, 'Заинск', 'Заинск', 'zainsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 68),
(654, 2, 'Закаменск', 'Закаменск', 'zakamensk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 11),
(655, 2, 'Заозёрный', 'Заозёрный', 'zaozernyy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 34),
(656, 2, 'Заозёрск', 'Заозёрск', 'zaozersk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 44),
(657, 2, 'Западная Двина', 'Западная Двина', 'zapadnaya-dvina', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 69),
(658, 2, 'Заполярный', 'Заполярный', 'zapolyarnyy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 44),
(659, 2, 'Заречный (Свердловская область)', 'Заречный (Свердловская область)', 'zarechnyy-sverdlovskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(660, 2, 'Звенигово', 'Звенигово', 'zvenigovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 40),
(661, 2, 'Звенигород', 'Звенигород', 'zvenigorod', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 43),
(662, 2, 'Зверево', 'Зверево', 'zverevo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 56),
(663, 2, 'Зеленоградск', 'Зеленоградск', 'zelenogradsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 23),
(664, 2, 'Зеленокумск', 'Зеленокумск', 'zelenokumsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 66),
(665, 2, 'Зерноград', 'Зерноград', 'zernograd', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 56),
(666, 2, 'Зея', 'Зея', 'zeya', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 5),
(667, 2, 'Зима', 'Зима', 'zima', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 21),
(668, 2, 'Злынка', 'Злынка', 'zlynka', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 10),
(669, 2, 'Змеиногорск', 'Змеиногорск', 'zmeinogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 4),
(670, 2, 'Зубцов', 'Зубцов', 'zubcov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 69),
(671, 2, 'Зуевка', 'Зуевка', 'zuevka', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 30),
(672, 2, 'Ивдель', 'Ивдель', 'ivdel', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(673, 2, 'Игарка', 'Игарка', 'igarka', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 34),
(674, 2, 'Избербаш', 'Избербаш', 'izberbash', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 16),
(675, 2, 'Изобильный', 'Изобильный', 'izobilnyy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 66),
(676, 2, 'Иланский', 'Иланский', 'ilanskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 34),
(677, 2, 'Инза', 'Инза', 'inza', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 75),
(678, 2, 'Инсар', 'Инсар', 'insar', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 41),
(679, 2, 'Инта', 'Инта', 'inta', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 31),
(680, 2, 'Ипатово', 'Ипатово', 'ipatovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 66),
(681, 2, 'Ирбит', 'Ирбит', 'irbit', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(682, 2, 'Исилькуль', 'Исилькуль', 'isilkul', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 49),
(683, 2, 'Искитим', 'Искитим', 'iskitim', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 48),
(684, 2, 'Ишим', 'Ишим', 'ishim', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 73),
(685, 2, 'Ишимбай', 'Ишимбай', 'ishimbay', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 8),
(686, 2, 'Кадников', 'Кадников', 'kadnikov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 14),
(687, 2, 'Калач', 'Калач', 'kalach', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 15),
(688, 2, 'Калачинск', 'Калачинск', 'kalachinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 49),
(689, 2, 'Калининск', 'Калининск', 'kalininsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 60),
(690, 2, 'Калтан', 'Калтан', 'kaltan', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 29),
(691, 2, 'Калязин', 'Калязин', 'kalyazin', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 69),
(692, 2, 'Камбарка', 'Камбарка', 'kambarka', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 74),
(693, 2, 'Каменногорск', 'Каменногорск', 'kamennogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 37),
(694, 2, 'Камень-на-Оби', 'Камень-на-Оби', 'kamen-na-obi', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 4),
(695, 2, 'Камешково', 'Камешково', 'kameshkovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 12),
(696, 2, 'Камызяк', 'Камызяк', 'kamyzyak', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 7),
(697, 2, 'Камышлов', 'Камышлов', 'kamyshlov', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(698, 2, 'Канаш', 'Канаш', 'kanash', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 81),
(699, 2, 'Кандалакша', 'Кандалакша', 'kandalaksha', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 44),
(700, 2, 'Карабаново', 'Карабаново', 'karabanovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 12),
(701, 2, 'Карабаш', 'Карабаш', 'karabash', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 79),
(702, 2, 'Карабулак', 'Карабулак', 'karabulak', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 20),
(703, 2, 'Карасук', 'Карасук', 'karasuk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 48),
(704, 2, 'Карачаевск', 'Карачаевск', 'karachaevsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 27),
(705, 2, 'Карачев', 'Карачев', 'karachev', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 10),
(706, 2, 'Каргат', 'Каргат', 'kargat', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 48),
(707, 2, 'Каргополь', 'Каргополь', 'kargopol', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 6),
(708, 2, 'Карпинск', 'Карпинск', 'karpinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 63),
(709, 2, 'Карталы', 'Карталы', 'kartaly', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 79),
(710, 2, 'Касли', 'Касли', 'kasli', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 79),
(711, 2, 'Каспийск', 'Каспийск', 'kaspiysk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 16),
(712, 2, 'Катав-Ивановск', 'Катав-Ивановск', 'katav-ivanovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 79),
(713, 2, 'Катайск', 'Катайск', 'kataysk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 35),
(714, 2, 'Качканар', 'Качканар', 'kachkanar', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(715, 2, 'Кашин', 'Кашин', 'kashin', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 69),
(716, 2, 'Кедровый', 'Кедровый', 'kedrovyy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 70),
(717, 2, 'Кемь', 'Кемь', 'kem', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 28),
(718, 2, 'Кизел', 'Кизел', 'kizel', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 53),
(719, 2, 'Кизилюрт', 'Кизилюрт', 'kizilyurt', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 16),
(720, 2, 'Кизляр', 'Кизляр', 'kizlyar', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 16),
(721, 2, 'Кимовск', 'Кимовск', 'kimovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 71),
(722, 2, 'Кимры', 'Кимры', 'kimry', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 69),
(723, 2, 'Кинель', 'Кинель', 'kinel', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 58),
(724, 2, 'Киреевск', 'Киреевск', 'kireevsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 71),
(725, 2, 'Киренск', 'Киренск', 'kirensk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 21),
(726, 2, 'Кириллов', 'Кириллов', 'kirillov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 14),
(727, 2, 'Киров (Калужская область)', 'Киров (Калужская область)', 'kirov-kaluzhskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 25),
(728, 2, 'Кировград', 'Кировград', 'kirovgrad', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(729, 2, 'Кировск (Мурманская область)', 'Кировск (Мурманская область)', 'kirovsk-murmanskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 44),
(730, 2, 'Кирс', 'Кирс', 'kirs', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 30),
(731, 2, 'Кирсанов', 'Кирсанов', 'kirsanov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 67),
(732, 2, 'Княгинино', 'Княгинино', 'knyaginino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 46),
(733, 2, 'Ковдор', 'Ковдор', 'kovdor', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 44),
(734, 2, 'Ковылкино', 'Ковылкино', 'kovylkino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 41),
(735, 2, 'Когалым', 'Когалым', 'kogalym', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 78),
(736, 2, 'Кодинск', 'Кодинск', 'kodinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 34),
(737, 2, 'Козельск', 'Козельск', 'kozelsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 25),
(738, 2, 'Козловка', 'Козловка', 'kozlovka', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 81),
(739, 2, 'Козьмодемьянск', 'Козьмодемьянск', 'kozmodemyansk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 40),
(740, 2, 'Кола', 'Кола', 'kola', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 44),
(741, 2, 'Кологрив', 'Кологрив', 'kologriv', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 32),
(742, 2, 'Колпашево', 'Колпашево', 'kolpashevo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 70),
(743, 2, 'Кольчугино', 'Кольчугино', 'kolchugino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 12),
(744, 2, 'Комсомольск', 'Комсомольск', 'komsomolsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 19),
(745, 2, 'Конаково', 'Конаково', 'konakovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 69),
(746, 2, 'Кондрово', 'Кондрово', 'kondrovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 25),
(747, 2, 'Константиновск', 'Константиновск', 'konstantinovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 56),
(748, 2, 'Кораблино', 'Кораблино', 'korablino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 57),
(749, 2, 'Кореновск', 'Кореновск', 'korenovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 33),
(750, 2, 'Коркино', 'Коркино', 'korkino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 79),
(751, 2, 'Короча', 'Короча', 'korocha', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 9),
(752, 2, 'Корсаков', 'Корсаков', 'korsakov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 62),
(753, 2, 'Коряжма', 'Коряжма', 'koryazhma', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 6),
(754, 2, 'Костерёво', 'Костерёво', 'kosterevo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 12),
(755, 2, 'Костомукша', 'Костомукша', 'kostomuksha', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 28),
(756, 2, 'Котельниково', 'Котельниково', 'kotelnikovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 13),
(757, 2, 'Котельнич', 'Котельнич', 'kotelnich', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 30),
(758, 2, 'Котово', 'Котово', 'kotovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 13),
(759, 2, 'Котовск', 'Котовск', 'kotovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 67),
(760, 2, 'Кохма', 'Кохма', 'kohma', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 19),
(761, 2, 'Красавино', 'Красавино', 'krasavino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 14),
(762, 2, 'Красноармейск (Саратовская область)', 'Красноармейск (Саратовская область)', 'krasnoarmeysk-saratovskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 60),
(763, 2, 'Красновишерск', 'Красновишерск', 'krasnovishersk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 53),
(764, 2, 'Краснозаводск', 'Краснозаводск', 'krasnozavodsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(765, 2, 'Краснослободск (Волгоградская область)\r\n', 'Краснослободск (Волгоградская область)\r\n', 'krasnoslobodsk-volgogradskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 13),
(766, 2, 'Краснослободск (Мордовия)', 'Краснослободск (Мордовия)', 'krasnoslobodsk-mordoviya', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 41),
(767, 2, 'Красноуральск', 'Красноуральск', 'krasnouralsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(768, 2, 'Красноуфимск', 'Красноуфимск', 'krasnoufimsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(769, 2, 'Красный Кут', 'Красный Кут', 'krasnyy-kut', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 60),
(770, 2, 'Красный Сулин', 'Красный Сулин', 'krasnyy-sulin', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 56),
(771, 2, 'Красный Холм', 'Красный Холм', 'krasnyy-holm', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 69),
(772, 2, 'Кремёнки', 'Кремёнки', 'kremenki', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 25),
(773, 2, 'Крымск', 'Крымск', 'krymsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 33),
(774, 2, 'Кувандык', 'Кувандык', 'kuvandyk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 50),
(775, 2, 'Кувшиново', 'Кувшиново', 'kuvshinovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 69),
(776, 2, 'Кудымкар', 'Кудымкар', 'kudymkar', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 53),
(777, 2, 'Кулебаки', 'Кулебаки', 'kulebaki', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 46),
(778, 2, 'Кумертау', 'Кумертау', 'kumertau', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 8),
(779, 2, 'Купино', 'Купино', 'kupino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 48),
(780, 2, 'Курганинск', 'Курганинск', 'kurganinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 33),
(781, 2, 'Курильск', 'Курильск', 'kurilsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 62),
(782, 2, 'Курлово', 'Курлово', 'kurlovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 12),
(783, 2, 'Куровское', 'Куровское', 'kurovskoe', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(784, 2, 'Куртамыш', 'Куртамыш', 'kurtamysh', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 35),
(785, 2, 'Куса', 'Куса', 'kusa', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 79),
(786, 2, 'Кушва', 'Кушва', 'kushva', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(787, 2, 'Кыштым', 'Кыштым', 'kyshtym', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 79),
(788, 2, 'Кяхта', 'Кяхта', 'kyahta', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 11),
(789, 2, 'Лабинск', 'Лабинск', 'labinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 33),
(790, 2, 'Лабытнанги', 'Лабытнанги', 'labytnangi', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 83),
(791, 2, 'Лагань', 'Лагань', 'lagan', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 24),
(792, 2, 'Ладушкин', 'Ладушкин', 'ladushkin', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 23),
(793, 2, 'Лаишево', 'Лаишево', 'laishevo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 68),
(794, 2, 'Лакинск', 'Лакинск', 'lakinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 12),
(795, 2, 'Лангепас', 'Лангепас', 'langepas', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 78),
(796, 2, 'Лахденпохья', 'Лахденпохья', 'lahdenpohya', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 28),
(797, 2, 'Лебедянь', 'Лебедянь', 'lebedyan', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 38),
(798, 2, 'Лениногорск', 'Лениногорск', 'leninogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 68),
(799, 2, 'Ленинск', 'Ленинск', 'leninsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 13),
(800, 2, 'Ленск', 'Ленск', 'lensk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 61),
(801, 2, 'Лермонтов', 'Лермонтов', 'lermontov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 66),
(802, 2, 'Лесной', 'Лесной', 'lesnoy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(803, 2, 'Лесозаводск', 'Лесозаводск', 'lesozavodsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 54),
(804, 2, 'Лесосибирск', 'Лесосибирск', 'lesosibirsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 34),
(805, 2, 'Липки', 'Липки', 'lipki', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 71),
(806, 2, 'Лихославль', 'Лихославль', 'lihoslavl', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 69),
(807, 2, 'Луза', 'Луза', 'luza', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 30),
(808, 2, 'Лукоянов', 'Лукоянов', 'lukoyanov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 46),
(809, 2, 'Лысково', 'Лысково', 'lyskovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 46),
(810, 2, 'Льгов', 'Льгов', 'lgov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 36),
(811, 2, 'Любань', 'Любань', 'lyuban', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(812, 2, 'Любим', 'Любим', 'lyubim', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 84),
(813, 2, 'Людиново', 'Людиново', 'lyudinovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 25),
(814, 2, 'Лянтор', 'Лянтор', 'lyantor', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 78),
(815, 2, 'Магас', 'Магас', 'magas', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 20),
(816, 2, 'Майский', 'Майский', 'mayskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 22),
(817, 2, 'Макаров', 'Макаров', 'makarov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 62),
(818, 2, 'Макарьев', 'Макарьев', 'makarev', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 32),
(819, 2, 'Макушино', 'Макушино', 'makushino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 35),
(820, 2, 'Малая Вишера', 'Малая Вишера', 'malaya-vishera', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 47),
(821, 2, 'Малгобек', 'Малгобек', 'malgobek', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 20),
(822, 2, 'Малмыж', 'Малмыж', 'malmyzh', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 30),
(823, 2, 'Малоархангельск', 'Малоархангельск', 'maloarhangelsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 51),
(824, 2, 'Малоярославец', 'Малоярославец', 'maloyaroslavec', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 25),
(825, 2, 'Мамадыш', 'Мамадыш', 'mamadysh', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 68),
(826, 2, 'Мамоново', 'Мамоново', 'mamonovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 23),
(827, 2, 'Мантурово', 'Мантурово', 'manturovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 32),
(828, 2, 'Мариинск', 'Мариинск', 'mariinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 29),
(829, 2, 'Мариинский Посад', 'Мариинский Посад', 'mariinskiy-posad', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 81),
(830, 2, 'Маркс', 'Маркс', 'marks', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 60),
(831, 2, 'Мглин', 'Мглин', 'mglin', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 10),
(832, 2, 'Мегион', 'Мегион', 'megion', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 78),
(833, 2, 'Медвежьегорск', 'Медвежьегорск', 'medvezhegorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 28),
(834, 2, 'Медногорск', 'Медногорск', 'mednogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 50),
(835, 2, 'Медынь', 'Медынь', 'medyn', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 25),
(836, 2, 'Межгорье', 'Межгорье', 'mezhgore', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 8),
(837, 2, 'Мезень', 'Мезень', 'mezen', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 6),
(838, 2, 'Меленки', 'Меленки', 'melenki', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 12),
(839, 2, 'Мелеуз', 'Мелеуз', 'meleuz', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 8),
(840, 2, 'Менделеевск', 'Менделеевск', 'mendeleevsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 68),
(841, 2, 'Мензелинск', 'Мензелинск', 'menzelinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 68),
(842, 2, 'Мещовск', 'Мещовск', 'meschovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 25),
(843, 2, 'Микунь', 'Микунь', 'mikun', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 31),
(844, 2, 'Миллерово', 'Миллерово', 'millerovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 56),
(845, 2, 'Минусинск', 'Минусинск', 'minusinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 34),
(846, 2, 'Миньяр', 'Миньяр', 'minyar', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 79),
(847, 2, 'Михайлов', 'Михайлов', 'mihaylov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 57),
(848, 2, 'Михайловка', 'Михайловка', 'mihaylovka', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 13),
(849, 2, 'Михайловск (Свердловская область)', 'Михайловск (Свердловская область)', 'mihaylovsk-sverdlovskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(850, 2, 'Михайловск (Ставропольский край)', 'Михайловск (Ставропольский край)', 'mihaylovsk-stavropol-skiy-kray', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 66),
(851, 2, 'Могоча', 'Могоча', 'mogocha', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 18),
(852, 2, 'Можга', 'Можга', 'mozhga', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 74),
(853, 2, 'Мончегорск', 'Мончегорск', 'monchegorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 44),
(854, 2, 'Морозовск', 'Морозовск', 'morozovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 56),
(855, 2, 'Моршанск', 'Моршанск', 'morshansk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 67),
(856, 2, 'Мосальск', 'Мосальск', 'mosalsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 25),
(857, 2, 'Муравленко', 'Муравленко', 'muravlenko', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 83),
(858, 2, 'Мураши', 'Мураши', 'murashi', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 30),
(859, 2, 'Мыски', 'Мыски', 'myski', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 29),
(860, 2, 'Мышкин', 'Мышкин', 'myshkin', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 84),
(861, 2, 'Навашино', 'Навашино', 'navashino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 46),
(862, 2, 'Наволоки', 'Наволоки', 'navoloki', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 19),
(863, 2, 'Надым', 'Надым', 'nadym', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 83),
(864, 2, 'Назарово', 'Назарово', 'nazarovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 34),
(865, 2, 'Называевск', 'Называевск', 'nazyvaevsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 49),
(866, 2, 'Нариманов', 'Нариманов', 'narimanov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 7),
(867, 2, 'Нарткала', 'Нарткала', 'nartkala', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 22),
(868, 2, 'Невель', 'Невель', 'nevel', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 55),
(869, 2, 'Невельск', 'Невельск', 'nevelsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 62),
(870, 2, 'Невинномысск', 'Невинномысск', 'nevinnomyssk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 66),
(871, 2, 'Невьянск', 'Невьянск', 'nevyansk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(872, 2, 'Нелидово', 'Нелидово', 'nelidovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 69),
(873, 2, 'Неман', 'Неман', 'neman', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 23),
(874, 2, 'Нерехта', 'Нерехта', 'nerehta', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 32),
(875, 2, 'Нерчинск', 'Нерчинск', 'nerchinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 18),
(876, 2, 'Нестеров', 'Нестеров', 'nesterov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 23),
(877, 2, 'Нефтегорск', 'Нефтегорск', 'neftegorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 58),
(878, 2, 'Нефтекумск', 'Нефтекумск', 'neftekumsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 66),
(879, 2, 'Нея', 'Нея', 'neya', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 32),
(880, 2, 'Нижнеудинск', 'Нижнеудинск', 'nizhneudinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 21),
(881, 2, 'Нижние Серги', 'Нижние Серги', 'nizhnie-sergi', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(882, 2, 'Нижний Ломов', 'Нижний Ломов', 'nizhniy-lomov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 52),
(883, 2, 'Нижняя Салда', 'Нижняя Салда', 'nizhnyaya-salda', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(884, 2, 'Нижняя Тура', 'Нижняя Тура', 'nizhnyaya-tura', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(885, 2, 'Николаевск', 'Николаевск', 'nikolaevsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 13),
(886, 2, 'Николаевск-на-Амуре', 'Николаевск-на-Амуре', 'nikolaevsk-na-amure', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 76),
(887, 2, 'Никольск (Вологодская область)', 'Никольск (Вологодская область)', 'nikolsk-vologodskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 14),
(888, 2, 'Никольск (Пензенская область)', 'Никольск (Пензенская область)', 'nikolsk-penzenskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 52),
(889, 2, 'Новая Ладога', 'Новая Ладога', 'novaya-ladoga', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(890, 2, 'Новая Ляля', 'Новая Ляля', 'novaya-lyalya', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(891, 2, 'Новоалександровск', 'Новоалександровск', 'novoaleksandrovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 66),
(892, 2, 'Новоаннинский', 'Новоаннинский', 'novoanninskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 13),
(893, 2, 'Нововоронеж', 'Нововоронеж', 'novovoronezh', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 15),
(894, 2, 'Новодвинск', 'Новодвинск', 'novodvinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 6),
(895, 2, 'Новозыбков', 'Новозыбков', 'novozybkov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 10),
(896, 2, 'Новокубанск', 'Новокубанск', 'novokubansk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 33),
(897, 2, 'Новомичуринск', 'Новомичуринск', 'novomichurinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 57),
(898, 2, 'Новопавловск', 'Новопавловск', 'novopavlovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 66),
(899, 2, 'Новоржев', 'Новоржев', 'novorzhev', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 55),
(900, 2, 'Новосиль', 'Новосиль', 'novosil', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 51),
(901, 2, 'Новосокольники', 'Новосокольники', 'novosokolniki', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 55),
(902, 2, 'Новоузенск', 'Новоузенск', 'novouzensk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 60),
(903, 2, 'Новоульяновск', 'Новоульяновск', 'novoulyanovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 75),
(904, 2, 'Новохопёрск', 'Новохопёрск', 'novohopersk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 15),
(905, 2, 'Нолинск', 'Нолинск', 'nolinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 30),
(906, 2, 'Нурлат', 'Нурлат', 'nurlat', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 68),
(907, 2, 'Нытва', 'Нытва', 'nytva', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 53),
(908, 2, 'Нюрба', 'Нюрба', 'nyurba', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 61),
(909, 2, 'Нягань', 'Нягань', 'nyagan', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 78),
(910, 2, 'Нязепетровск', 'Нязепетровск', 'nyazepetrovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 79),
(911, 2, 'Няндома', 'Няндома', 'nyandoma', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 6),
(912, 2, 'Облучье', 'Облучье', 'obluche', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 17),
(913, 2, 'Обоянь', 'Обоянь', 'oboyan', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 36),
(914, 2, 'Обь', 'Обь', 'ob', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 48),
(915, 2, 'Ожерелье', 'Ожерелье', 'ozherele', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(916, 2, 'Октябрьск', 'Октябрьск', 'oktyabrsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 58),
(917, 2, 'Окуловка', 'Окуловка', 'okulovka', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 47),
(918, 2, 'Олёкминск', 'Олёкминск', 'olekminsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 61),
(919, 2, 'Оленегорск', 'Оленегорск', 'olenegorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 44),
(920, 2, 'Олонец', 'Олонец', 'olonec', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 28),
(921, 2, 'Омутнинск', 'Омутнинск', 'omutninsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 30),
(922, 2, 'Онега', 'Онега', 'onega', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 6),
(923, 2, 'Опочка', 'Опочка', 'opochka', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 55),
(924, 2, 'Орлов', 'Орлов', 'orlov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 30),
(925, 2, 'Оса', 'Оса', 'osa', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 53),
(926, 2, 'Осинники', 'Осинники', 'osinniki', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 29),
(927, 2, 'Осташков', 'Осташков', 'ostashkov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 69),
(928, 2, 'Остров', 'Остров', 'ostrov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 55),
(929, 2, 'Островной', 'Островной', 'ostrovnoy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 44),
(930, 2, 'Острогожск', 'Острогожск', 'ostrogozhsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 15),
(931, 2, 'Отрадный', 'Отрадный', 'otradnyy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 58),
(932, 2, 'Оха', 'Оха', 'oha', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 62),
(933, 2, 'Оханск', 'Оханск', 'ohansk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 53),
(934, 2, 'Очёр', 'Очёр', 'ocher', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 53),
(935, 2, 'Палласовка', 'Палласовка', 'pallasovka', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 13),
(936, 2, 'Партизанск', 'Партизанск', 'partizansk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 54),
(937, 2, 'Певек', 'Певек', 'pevek', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 82),
(938, 2, 'Первомайск', 'Первомайск', 'pervomaysk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 46),
(939, 2, 'Перевоз', 'Перевоз', 'perevoz', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 46),
(940, 2, 'Пересвет', 'Пересвет', 'peresvet', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(941, 2, 'Пестово', 'Пестово', 'pestovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 47),
(942, 2, 'Петров Вал', 'Петров Вал', 'petrov-val', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 13),
(943, 2, 'Петровск', 'Петровск', 'petrovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 60),
(944, 2, 'Петровск-Забайкальский', 'Петровск-Забайкальский', 'petrovsk-zabaykalskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 18),
(945, 2, 'Петухово', 'Петухово', 'petuhovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 35),
(946, 2, 'Петушки', 'Петушки', 'petushki', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 12),
(947, 2, 'Печоры', 'Печоры', 'pechory', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 55),
(948, 2, 'Пионерский', 'Пионерский', 'pionerskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 23),
(949, 2, 'Питкяранта', 'Питкяранта', 'pitkyaranta', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 28),
(950, 2, 'Плёс', 'Плёс', 'ples', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 19),
(951, 2, 'Плавск', 'Плавск', 'plavsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 71),
(952, 2, 'Пласт', 'Пласт', 'plast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 79),
(953, 2, 'Поворино', 'Поворино', 'povorino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 15),
(954, 2, 'Покачи', 'Покачи', 'pokachi', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 78),
(955, 2, 'Покров', 'Покров', 'pokrov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 12),
(956, 2, 'Покровск', 'Покровск', 'pokrovsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 61),
(957, 2, 'Полесск', 'Полесск', 'polessk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 23),
(958, 2, 'Полысаево', 'Полысаево', 'polysaevo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 29),
(959, 2, 'Полярные Зори', 'Полярные Зори', 'polyarnye-zori', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 44),
(960, 2, 'Полярный', 'Полярный', 'polyarnyy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 44),
(961, 2, 'Поронайск', 'Поронайск', 'poronaysk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 62),
(962, 2, 'Порхов', 'Порхов', 'porhov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 55),
(963, 2, 'Похвистнево', 'Похвистнево', 'pohvistnevo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 58),
(964, 2, 'Почеп', 'Почеп', 'pochep', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 10),
(965, 2, 'Починок', 'Починок', 'pochinok', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 65),
(966, 2, 'Пошехонье', 'Пошехонье', 'poshehone', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 84),
(967, 2, 'Правдинск', 'Правдинск', 'pravdinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 23),
(968, 2, 'Приволжск', 'Приволжск', 'privolzhsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 19),
(969, 2, 'Приморск (Калининградская область)', 'Приморск (Калининградская область)', 'primorsk-kaliningradskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 23),
(970, 2, 'Приморск (Ленинградская область)', 'Приморск (Ленинградская область)', 'primorsk-leningradskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 37),
(971, 2, 'Приморско-Ахтарск', 'Приморско-Ахтарск', 'primorsko-ahtarsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 33),
(972, 2, 'Пролетарск', 'Пролетарск', 'proletarsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 56),
(973, 2, 'Пугачёв', 'Пугачёв', 'pugachev', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 60),
(974, 2, 'Пудож', 'Пудож', 'pudozh', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 28),
(975, 2, 'Пустошка', 'Пустошка', 'pustoshka', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 55),
(976, 2, 'Пучеж', 'Пучеж', 'puchezh', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 19),
(977, 2, 'Пыталово', 'Пыталово', 'pytalovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 55),
(978, 2, 'Пыть-Ях', 'Пыть-Ях', 'pyt-yah', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 78),
(979, 2, 'Радужный (Владимирская область)', 'Радужный (Владимирская область)', 'raduzhnyy-vladimirskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 12),
(980, 2, 'Радужный (Ханты-Мансийский АО - Югра)', 'Радужный (Ханты-Мансийский АО - Югра)', 'raduzhnyy-hanty-mansiyskiy-ao---yugra', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 78),
(981, 2, 'Райчихинск', 'Райчихинск', 'raychihinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 5),
(982, 2, 'Рассказово', 'Рассказово', 'rasskazovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 67),
(983, 2, 'Реж', 'Реж', 'rezh', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(984, 2, 'Родники', 'Родники', 'rodniki', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 19),
(985, 2, 'Рославль', 'Рославль', 'roslavl', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 65),
(986, 2, 'Ростов', 'Ростов', 'rostov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 84),
(987, 2, 'Ртищево', 'Ртищево', 'rtischevo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 60),
(988, 2, 'Рудня', 'Рудня', 'rudnya', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 65),
(989, 2, 'Руза', 'Руза', 'ruza', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(990, 2, 'Рыбное', 'Рыбное', 'rybnoe', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 57),
(991, 2, 'Рыльск', 'Рыльск', 'rylsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 36),
(992, 2, 'Ряжск', 'Ряжск', 'ryazhsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 57),
(993, 2, 'Салаир', 'Салаир', 'salair', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 29),
(994, 2, 'Салехард', 'Салехард', 'salehard', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 83),
(995, 2, 'Сасово', 'Сасово', 'sasovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 57),
(996, 2, 'Сафоново', 'Сафоново', 'safonovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 65),
(997, 2, 'Саяногорск', 'Саяногорск', 'sayanogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 77),
(998, 2, 'Саянск', 'Саянск', 'sayansk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 21),
(999, 2, 'Светлогорск', 'Светлогорск', 'svetlogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 23),
(1000, 2, 'Светлоград', 'Светлоград', 'svetlograd', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 66),
(1001, 2, 'Светлый', 'Светлый', 'svetlyy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 23),
(1002, 2, 'Свирск', 'Свирск', 'svirsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 21),
(1003, 2, 'Себеж', 'Себеж', 'sebezh', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 55),
(1004, 2, 'Северо-Курильск', 'Северо-Курильск', 'severo-kurilsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 62),
(1005, 2, 'Североуральск', 'Североуральск', 'severouralsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(1006, 2, 'Севск', 'Севск', 'sevsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 10),
(1007, 2, 'Сегежа', 'Сегежа', 'segezha', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 28),
(1008, 2, 'Сельцо', 'Сельцо', 'selco', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 10),
(1009, 2, 'Семёнов', 'Семёнов', 'semenov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 46),
(1010, 2, 'Семикаракорск', 'Семикаракорск', 'semikarakorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 56),
(1011, 2, 'Семилуки', 'Семилуки', 'semiluki', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 15),
(1012, 2, 'Сенгилей', 'Сенгилей', 'sengiley', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 75),
(1013, 2, 'Серафимович', 'Серафимович', 'serafimovich', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 13),
(1014, 2, 'Сергач', 'Сергач', 'sergach', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 46),
(1015, 2, 'Сердобск', 'Сердобск', 'serdobsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 52),
(1016, 2, 'Сибай', 'Сибай', 'sibay', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 8),
(1017, 2, 'Сим', 'Сим', 'sim', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 79),
(1018, 2, 'Сковородино', 'Сковородино', 'skovorodino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 5),
(1019, 2, 'Скопин', 'Скопин', 'skopin', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 57),
(1020, 2, 'Славгород', 'Славгород', 'slavgorod', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 4),
(1021, 2, 'Славск', 'Славск', 'slavsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 23),
(1022, 2, 'Славянск-на-Кубани', 'Славянск-на-Кубани', 'slavyansk-na-kubani', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 33),
(1023, 2, 'Слободской', 'Слободской', 'slobodskoy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 30),
(1024, 2, 'Слюдянка', 'Слюдянка', 'slyudyanka', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 21),
(1025, 2, 'Снежногорск', 'Снежногорск', 'snezhnogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 44),
(1026, 2, 'Собинка', 'Собинка', 'sobinka', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 12),
(1027, 2, 'Советск (Кировская область)', 'Советск (Кировская область)', 'sovetsk-kirovskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 30),
(1028, 2, 'Советск (Тульская область)', 'Советск (Тульская область)', 'sovetsk-tulskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 71),
(1029, 2, 'Советская Гавань', 'Советская Гавань', 'sovetskaya-gavan', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 76),
(1030, 2, 'Советский', 'Советский', 'sovetskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 78),
(1031, 2, 'Солигалич', 'Солигалич', 'soligalich', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 32),
(1032, 2, 'Соль-Илецк', 'Соль-Илецк', 'sol-ileck', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 50),
(1033, 2, 'Сольвычегодск', 'Сольвычегодск', 'solvychegodsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 6),
(1034, 2, 'Сольцы', 'Сольцы', 'solcy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 47),
(1035, 2, 'Сорочинск', 'Сорочинск', 'sorochinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 50),
(1036, 2, 'Сорск', 'Сорск', 'sorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 77),
(1037, 2, 'Сортавала', 'Сортавала', 'sortavala', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 28),
(1038, 2, 'Сосенский', 'Сосенский', 'sosenskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 25),
(1039, 2, 'Сосновка', 'Сосновка', 'sosnovka', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 30),
(1040, 2, 'Сосновоборск', 'Сосновоборск', 'sosnovoborsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 34),
(1041, 2, 'Сосногорск', 'Сосногорск', 'sosnogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 31);
INSERT INTO `regions` (`id`, `type`, `name`, `name_case`, `url`, `favorite`, `footer`, `public`, `created_at`, `updated_at`, `parent_id`) VALUES
(1042, 2, 'Спас-Деменск', 'Спас-Деменск', 'spas-demensk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 25),
(1043, 2, 'Спас-Клепики', 'Спас-Клепики', 'spas-klepiki', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 57),
(1044, 2, 'Спасск', 'Спасск', 'spassk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 52),
(1045, 2, 'Спасск-Дальний', 'Спасск-Дальний', 'spassk-dalniy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 54),
(1046, 2, 'Спасск-Рязанский', 'Спасск-Рязанский', 'spassk-ryazanskiy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 57),
(1047, 2, 'Среднеколымск', 'Среднеколымск', 'srednekolymsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 61),
(1048, 2, 'Среднеуральск', 'Среднеуральск', 'sredneuralsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(1049, 2, 'Сретенск', 'Сретенск', 'sretensk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 18),
(1050, 2, 'Старица', 'Старица', 'starica', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 69),
(1051, 2, 'Стародуб', 'Стародуб', 'starodub', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 10),
(1052, 2, 'Стрежевой', 'Стрежевой', 'strezhevoy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 70),
(1053, 2, 'Строитель', 'Строитель', 'stroitel', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 9),
(1054, 2, 'Струнино', 'Струнино', 'strunino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 12),
(1055, 2, 'Суворов', 'Суворов', 'suvorov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 71),
(1056, 2, 'Суджа', 'Суджа', 'sudzha', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 36),
(1057, 2, 'Судогда', 'Судогда', 'sudogda', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 12),
(1058, 2, 'Суздаль', 'Суздаль', 'suzdal', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 12),
(1059, 2, 'Суоярви', 'Суоярви', 'suoyarvi', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 28),
(1060, 2, 'Сураж', 'Сураж', 'surazh', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 10),
(1061, 2, 'Суровикино', 'Суровикино', 'surovikino', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 13),
(1062, 2, 'Сурск', 'Сурск', 'sursk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 52),
(1063, 2, 'Сусуман', 'Сусуман', 'susuman', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 39),
(1064, 2, 'Сухиничи', 'Сухиничи', 'suhinichi', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 25),
(1065, 2, 'Сухой Лог', 'Сухой Лог', 'suhoy-log', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(1066, 2, 'Сысерть', 'Сысерть', 'sysert', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(1067, 2, 'Сычёвка', 'Сычёвка', 'sychevka', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 65),
(1068, 2, 'Тавда', 'Тавда', 'tavda', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(1069, 2, 'Тайга', 'Тайга', 'tayga', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 29),
(1070, 2, 'Тайшет', 'Тайшет', 'tayshet', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 21),
(1071, 2, 'Талдом', 'Талдом', 'taldom', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 43),
(1072, 2, 'Талица', 'Талица', 'talica', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(1073, 2, 'Тара', 'Тара', 'tara', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 49),
(1074, 2, 'Тарко-Сале', 'Тарко-Сале', 'tarko-sale', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 83),
(1075, 2, 'Таруса', 'Таруса', 'tarusa', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 25),
(1076, 2, 'Татарск', 'Татарск', 'tatarsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 48),
(1077, 2, 'Таштагол', 'Таштагол', 'tashtagol', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 29),
(1078, 2, 'Теберда', 'Теберда', 'teberda', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 27),
(1079, 2, 'Тейково', 'Тейково', 'teykovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 19),
(1080, 2, 'Темников', 'Темников', 'temnikov', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 41),
(1081, 2, 'Темрюк', 'Темрюк', 'temryuk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 33),
(1082, 2, 'Терек', 'Терек', 'terek', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 22),
(1083, 2, 'Тетюши', 'Тетюши', 'tetyushi', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 68),
(1084, 2, 'Тимашевск', 'Тимашевск', 'timashevsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 33),
(1085, 2, 'Тогучин', 'Тогучин', 'toguchin', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 48),
(1086, 2, 'Томари', 'Томари', 'tomari', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 62),
(1087, 2, 'Томмот', 'Томмот', 'tommot', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 61),
(1088, 2, 'Топки', 'Топки', 'topki', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 29),
(1089, 2, 'Торжок', 'Торжок', 'torzhok', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 69),
(1090, 2, 'Торопец', 'Торопец', 'toropec', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 69),
(1091, 2, 'Тотьма', 'Тотьма', 'totma', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 14),
(1092, 2, 'Трёхгорный', 'Трёхгорный', 'trehgornyy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 79),
(1093, 2, 'Трубчевск', 'Трубчевск', 'trubchevsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 10),
(1094, 2, 'Туймазы', 'Туймазы', 'tuymazy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 8),
(1095, 2, 'Тулун', 'Тулун', 'tulun', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 21),
(1096, 2, 'Туран', 'Туран', 'turan', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 72),
(1097, 2, 'Туринск', 'Туринск', 'turinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 63),
(1098, 2, 'Тутаев', 'Тутаев', 'tutaev', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 84),
(1099, 2, 'Тында', 'Тында', 'tynda', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 5),
(1100, 2, 'Тырныауз', 'Тырныауз', 'tyrnyauz', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 22),
(1101, 2, 'Тюкалинск', 'Тюкалинск', 'tyukalinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 49),
(1102, 2, 'Уварово', 'Уварово', 'uvarovo', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 67),
(1103, 2, 'Углегорск', 'Углегорск', 'uglegorsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 62),
(1104, 2, 'Углич', 'Углич', 'uglich', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 84),
(1105, 2, 'Удачный', 'Удачный', 'udachnyy', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 61),
(1106, 2, 'Удомля', 'Удомля', 'udomlya', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 69),
(1107, 2, 'Ужур', 'Ужур', 'uzhur', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 34),
(1108, 2, 'Унеча', 'Унеча', 'unecha', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 10),
(1109, 2, 'Урай', 'Урай', 'uray', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 78),
(1110, 2, 'Урень', 'Урень', 'uren', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 46),
(1111, 2, 'Уржум', 'Уржум', 'urzhum', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 30),
(1112, 2, 'Урюпинск', 'Урюпинск', 'uryupinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 13),
(1113, 2, 'Усинск', 'Усинск', 'usinsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 31),
(1114, 2, 'Усмань', 'Усмань', 'usman', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 38),
(1115, 2, 'Усолье', 'Усолье', 'usole', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 53),
(1116, 2, 'Усолье-Сибирское', 'Усолье-Сибирское', 'usole-sibirskoe', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 21),
(1117, 2, 'Усть-Джегута', 'Усть-Джегута', 'ust-dzheguta', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 27),
(1118, 2, 'Усть-Катав', 'Усть-Катав', 'ust-katav', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 79),
(1119, 2, 'Усть-Кут', 'Усть-Кут', 'ust-kut', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 21),
(1120, 2, 'Усть-Лабинск', 'Усть-Лабинск', 'ust-labinsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 33),
(1121, 2, 'Устюжна', 'Устюжна', 'ustyuzhna', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 14),
(1122, 2, 'Учалы', 'Учалы', 'uchaly', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 8),
(1123, 2, 'Уяр', 'Уяр', 'uyar', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 34),
(1124, 2, 'Фатеж', 'Фатеж', 'fatezh', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 36),
(1125, 2, 'Фокино (Брянская область)', 'Фокино (Брянская область)', 'fokino-bryanskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 10),
(1126, 2, 'Фокино (Приморский край)\n', 'Фокино (Приморский край)\n', 'fokino-primorskiy-kray', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 54),
(1127, 2, 'Фролово', 'Фролово', 'frolovo', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 13),
(1128, 2, 'Фурманов', 'Фурманов', 'furmanov', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 19),
(1129, 2, 'Хадыженск', 'Хадыженск', 'hadyzhensk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 33),
(1130, 2, 'Харабали', 'Харабали', 'harabali', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 7),
(1131, 2, 'Харовск', 'Харовск', 'harovsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 14),
(1132, 2, 'Хвалынск', 'Хвалынск', 'hvalynsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 60),
(1133, 2, 'Хилок', 'Хилок', 'hilok', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 18),
(1134, 2, 'Холм', 'Холм', 'holm', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 47),
(1135, 2, 'Холмск', 'Холмск', 'holmsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 62),
(1136, 2, 'Хотьково', 'Хотьково', 'hotkovo', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 43),
(1137, 2, 'Цивильск', 'Цивильск', 'civilsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 81),
(1138, 2, 'Цимлянск', 'Цимлянск', 'cimlyansk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 56),
(1139, 2, 'Чёрмоз', 'Чёрмоз', 'chermoz', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 53),
(1140, 2, 'Чадан', 'Чадан', 'chadan', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 72),
(1141, 2, 'Чаплыгин', 'Чаплыгин', 'chaplygin', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 38),
(1142, 2, 'Чебаркуль', 'Чебаркуль', 'chebarkul', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 79),
(1143, 2, 'Чегем', 'Чегем', 'chegem', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 22),
(1144, 2, 'Чекалин', 'Чекалин', 'chekalin', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 71),
(1145, 2, 'Чердынь', 'Чердынь', 'cherdyn', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 53),
(1146, 2, 'Черемхово', 'Черемхово', 'cheremhovo', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 21),
(1147, 2, 'Черепаново', 'Черепаново', 'cherepanovo', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 48),
(1148, 2, 'Чернушка', 'Чернушка', 'chernushka', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 53),
(1149, 2, 'Черняховск', 'Черняховск', 'chernyahovsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 23),
(1150, 2, 'Чистополь', 'Чистополь', 'chistopol', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 68),
(1151, 2, 'Чкаловск', 'Чкаловск', 'chkalovsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 46),
(1152, 2, 'Чудово', 'Чудово', 'chudovo', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 47),
(1153, 2, 'Чулым', 'Чулым', 'chulym', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 48),
(1154, 2, 'Чусовой', 'Чусовой', 'chusovoy', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 53),
(1155, 2, 'Чухлома', 'Чухлома', 'chuhloma', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 32),
(1156, 2, 'Шагонар', 'Шагонар', 'shagonar', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 72),
(1157, 2, 'Шали', 'Шали', 'shali', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 80),
(1158, 2, 'Шарыпово', 'Шарыпово', 'sharypovo', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 34),
(1159, 2, 'Шарья', 'Шарья', 'sharya', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 32),
(1160, 2, 'Шахтёрск', 'Шахтёрск', 'shahtersk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 62),
(1161, 2, 'Шахунья', 'Шахунья', 'shahunya', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 46),
(1162, 2, 'Шацк', 'Шацк', 'shack', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 57),
(1163, 2, 'Шелехов', 'Шелехов', 'shelehov', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 21),
(1164, 2, 'Шенкурск', 'Шенкурск', 'shenkursk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 6),
(1165, 2, 'Шилка', 'Шилка', 'shilka', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 18),
(1166, 2, 'Шимановск', 'Шимановск', 'shimanovsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 5),
(1167, 2, 'Шиханы', 'Шиханы', 'shihany', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 60),
(1168, 2, 'Шумерля', 'Шумерля', 'shumerlya', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 81),
(1169, 2, 'Шумиха', 'Шумиха', 'shumiha', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 35),
(1170, 2, 'Щёкино', 'Щёкино', 'schekino', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 71),
(1171, 2, 'Щигры', 'Щигры', 'schigry', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 36),
(1172, 2, 'Щучье', 'Щучье', 'schuche', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 35),
(1173, 2, 'Эртиль', 'Эртиль', 'ertil', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 15),
(1174, 2, 'Югорск', 'Югорск', 'yugorsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 78),
(1175, 2, 'Южа', 'Южа', 'yuzha', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 19),
(1176, 2, 'Южно-Сухокумск', 'Южно-Сухокумск', 'yuzhno-suhokumsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 16),
(1177, 2, 'Южноуральск', 'Южноуральск', 'yuzhnouralsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 79),
(1178, 2, 'Юрьев-Польский', 'Юрьев-Польский', 'yurev-polskiy', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 12),
(1179, 2, 'Юрьевец', 'Юрьевец', 'yurevec', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 19),
(1180, 2, 'Юрюзань', 'Юрюзань', 'yuryuzan', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 79),
(1181, 2, 'Юхнов', 'Юхнов', 'yuhnov', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 25),
(1182, 2, 'Ядрин', 'Ядрин', 'yadrin', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 81),
(1183, 2, 'Ялуторовск', 'Ялуторовск', 'yalutorovsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 73),
(1184, 2, 'Янаул', 'Янаул', 'yanaul', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 8),
(1185, 2, 'Яранск', 'Яранск', 'yaransk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 30),
(1186, 2, 'Яровое', 'Яровое', 'yarovoe', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 4),
(1187, 2, 'Ярцево', 'Ярцево', 'yarcevo', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 65),
(1188, 2, 'Ясногорск', 'Ясногорск', 'yasnogorsk', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 71),
(1189, 2, 'Ясный', 'Ясный', 'yasnyy', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 50),
(1190, 2, 'Яхрома', 'Яхрома', 'yahroma', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 43),
(1191, 2, 'Алупка', 'Алупка', 'alupka', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 86),
(1192, 2, 'Алушта', 'Алушта', 'alushta', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 86),
(1193, 2, 'Армянск\r\n', 'Армянск\r\n', 'armyansk', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 86),
(1194, 2, 'Бахчисарай', 'Бахчисарай', 'bahchisaray', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 86),
(1195, 2, 'Белогорск (Крым)', 'Белогорск (Крым)', 'belogorsk-krym', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 86),
(1196, 2, 'Джанкой', 'Джанкой', 'dzhankoy', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 86),
(1197, 2, 'Евпатория', 'Евпатория', 'evpatoriya', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 86),
(1198, 2, 'Инкерман', 'Инкерман', 'inkerman', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 87),
(1199, 2, 'Иннополис', 'Иннополис', 'innopolis', NULL, NULL, 0, NULL, '2021-10-25 15:58:58', 68),
(1200, 2, 'Керчь', 'Керчь', 'kerch', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 86),
(1201, 2, 'Краснознаменск (Калининградская область)', 'Краснознаменск (Калининградская область)', 'krasnoznamensk-kaliningradskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 23),
(1202, 2, 'Красноперекопск', 'Красноперекопск', 'krasnoperekopsk', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 86),
(1203, 2, 'Мирный (Архангельская область)', 'Мирный (Архангельская область)', 'mirnyy-arhangelskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 6),
(1204, 2, 'Озерск (Калининградская область)', 'Озерск (Калининградская область)', 'ozersk-kaliningradskaya-oblast', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 23),
(1205, 2, 'Саки', 'Саки', 'saki', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 86),
(1206, 2, 'Севастополь', 'Севастополь', 'sevastopol', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 87),
(1207, 2, 'Симферополь', 'Симферополь', 'simferopol', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 86),
(1208, 2, 'Старый Крым', 'Старый Крым', 'staryy-krym', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 86),
(1209, 2, 'Судак', 'Судак', 'sudak', NULL, NULL, 0, NULL, '2021-10-25 15:58:59', 86),
(1210, 2, 'Циолковский', 'Циолковский', 'ciolkovskiy', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 5),
(1211, 2, 'Феодосия', 'Феодосия', 'feodosiya', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 86),
(1212, 2, 'Щелкино', 'Щелкино', 'schelkino', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 86),
(1213, 2, 'Ялта', 'Ялта', 'yalta', NULL, NULL, 0, NULL, '2021-10-25 15:59:00', 86);

-- --------------------------------------------------------

--
-- Структура таблицы `seo_pages`
--

CREATE TABLE `seo_pages` (
  `id` int(11) NOT NULL,
  `category` int(11) DEFAULT '0',
  `subcategory` int(11) DEFAULT '0',
  `seo_query` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `url` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `h1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `master_1` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `master_2` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `master_3` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `popular_adv` tinyint(1) DEFAULT NULL,
  `name_adv` tinyint(1) DEFAULT NULL,
  `show_short_description` tinyint(1) DEFAULT '1',
  `block_adv` tinyint(1) DEFAULT NULL,
  `public` tinyint(1) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Структура таблицы `seo_pages_relations`
--

CREATE TABLE `seo_pages_relations` (
  `id` int(11) NOT NULL,
  `advert_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=FIXED;

-- --------------------------------------------------------

--
-- Структура таблицы `seo_settings`
--

CREATE TABLE `seo_settings` (
  `id` int(1) NOT NULL,
  `position` int(2) NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `h1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `seo_settings`
--

INSERT INTO `seo_settings` (`id`, `position`, `name`, `page_type`, `title`, `h1`, `description`, `text`) VALUES
(1, 1, 'Главная страница', 'home', 'Главная страница', 'Маркетплейс строительных услуг', 'Главная страница', '<ul>\r\n<li>автоинструкторы в Красноярске c проверенными отзывами и фото на тутуслуги.ru;</li>\r\n<li>быстрый поиск специалистов рядом с вами в Красноярске;</li>\r\n<li>мы нашли 43 автоинструктора с информацией о ценах и стаже работы.</li>\r\n</ul>'),
(2, 2, 'Главная регионы', 'home_region', '🛠️Главная {city.in} регионы 1', '🛠️Главная {city.in} регионы2', '🛠️Главная {city.in} регионы3', '🛠️Главная {city.in} регионы4'),
(6, 3, 'Карта сайта', 'map', 'Карта сайта {city.in}', 'Карта сайта {city.in}', 'Карта сайта {city.in}', 'Карта сайта {city.in}'),
(7, 4, 'Выбор региона', 'select_region', 'Выбор региона', 'Выбор региона', 'Выбор региона', 'Выбор региона'),
(8, 6, 'Регистрация', 'registration', 'Регистрация', 'Регистрация на ТутУслуги', ' Регистрация на ТутУслуги', 'Регистрация'),
(9, 7, 'Авторизация', 'login', 'Войти в личный кабинет', 'Вход на ТутУслуги', 'Войти в личный кабинет ТутУслуги', 'Авторизация'),
(10, 8, 'Сброс пароля', 'reset', 'Сброс пароля', 'Сброс пароля', 'Сброс пароля', 'Сброс пароля'),
(13, 11, 'Служба поддержки', 'support', 'Служба поддержки', 'Служба поддержки', 'Служба поддержки', 'Служба поддержки'),
(14, 12, 'Пользовательское соглашение', 'user_terms', 'Пользовательское соглашение', 'Пользовательское соглашение', 'Пользовательское соглашение', '<p>Полным и безоговорочным принятием условий данного Пользовательского соглашения является совершение Пользователем действий, направленных на использование Сайта, в том числе, включая, но не ограничиваясь, поиск, просмотр или подача объявлений, регистрация на Сайте, направление сообщений через форму связи и прочие действия по использованию функционала Сайта.</p>\r\n\r\n<p>Пользовательское соглашение может быть изменено Администрацией Сайта в любое время без какого-либо специального уведомления об этом Пользователя. Новая редакция Пользовательского соглашения вступает в силу с момента её размещения на Сайте, если Администрацией Сайта прямо не указано иное. Регулярное ознакомление с действующей редакцией Пользовательского соглашения является обязанностью Пользователя.</p>\r\n\r\n<p>\r\nИспользование Сайта после вступления в силу новой редакции Пользовательского соглашения означает согласие с ней Пользователя и применение к нему в полном объёме положений новой редакции.</p>'),
(15, 13, 'Политика конфиденциальности', 'user_politics', 'Политика конфиденциальности', 'Политика конфиденциальности', 'Политика конфиденциальности', 'Политика конфиденциальности'),
(16, 5, 'Выбор города', 'select_city', 'Выбор города {region.in}', 'Выбор города {region.in}', 'Выбор города {region.in}', 'Выбор города {region.in}');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_type` int(2) DEFAULT '0',
  `status` int(2) DEFAULT '0',
  `confirm_phone` int(2) DEFAULT '0',
  `confirm_email` int(2) DEFAULT '0',
  `views_total` int(6) DEFAULT '0',
  `views_today` int(6) DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hash` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `last_phone_call` datetime DEFAULT NULL,
  `work_experience` int(2) DEFAULT NULL,
  `discount` int(2) DEFAULT NULL,
  `discount_text` varchar(140) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `about_text` text COLLATE utf8mb4_unicode_ci,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `user_type`, `status`, `confirm_phone`, `confirm_email`, `views_total`, `views_today`, `name`, `phone`, `photo`, `hash`, `email`, `email_verified_at`, `last_login`, `last_phone_call`, `work_experience`, `discount`, `discount_text`, `about_text`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(6, 2, 1, 0, 0, 0, 0, 'Family Name', '0000000', NULL, '', 'din1s@yandex.ru', NULL, '2022-12-23 07:11:13', NULL, NULL, NULL, NULL, NULL, '$2y$10$A/N2SlEluZArFMCsmpSc4u9OLSFC6eefuezoMD2b1AghZ89zpan.u', 'gBzofj1zWL1C8h17biGxqbff8oKOjT04nRg5l1bLHjRyIT2n7ATqA9E7Mmu8', '2021-10-18 16:00:15', '2022-12-23 07:11:13'),
(390, 0, 1, 0, 0, 6, 6, 'Family Name', '3752929871621', '/users/390/e4136862975ae52c9d1a348c55ae0c86.jpg', '8808bd0263795748112373ad44a8a730', NULL, NULL, '2022-12-23 04:55:00', NULL, 15, 5, 'за первый заказ!', 'Расскажите подробно о себе: про ваш опыт, навыки и преимущества, как давно работаете,\r\nчто умеете. Это поможет клиентам лучше узнать вас.', '$2y$10$MyvhtLtq2m1JTHEefasR7.7Z1KZ3Kx8W3p3q48aI0mHkG95ALGIbe', NULL, '2022-12-16 04:07:25', '2022-12-26 09:06:43'),
(391, 0, 1, 0, 0, 8, 8, 'Family Name', '3752929871624', '/users/391/a8f25b1ffa6bb9a777e681c80bca2019.jpg', '57e2cf9f492e3611b8f1637619a08db1', NULL, NULL, '2022-12-26 09:05:35', NULL, 25, 50, 'Вот такая скидка!!!!', 'Я работаю персональным водителем более 4 года. В мои обязанности входила не только доставка непосредственного начальника, но и выполнение личных поручений руководителей. Мне доверяли перевозку материальных ценностей, особо важных документов. Также при необходимости я возил членов семьи своего руководителя, помогал решать хозяйственные и бытовые вопросы. Имею 4-х летний стаж безаварийного вождения, прекрасно знаю и выполняю требования ПДД, ответственно отношусь к вождению, не лихачу и не рискую на дороге. Ответственен, исполнителен, воспитан. Знаю правила делового этикета. Умею работать в ненормированном графике.', '$2y$10$cSppa8SpN6IfbOh5blKhV.H47iH0lNemWUhnWjdlMPjF9tYfoNw9e', NULL, '2022-12-18 13:51:50', '2022-12-26 09:12:48'),
(392, 0, 0, 0, 0, 0, 0, 'Family Name', '3', NULL, '9c206b94a58da8079f06b53ae8c95312', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$XlaqUv.U3ICzzFGgCQmk4eczlqGzGH2pIvnvx1ldwdqkz.v7zsTp6', NULL, '2022-12-26 08:44:35', '2022-12-26 08:44:35'),
(393, 0, 0, 0, 0, 0, 0, 'Family Name', '3752929871627', NULL, '4065a0c30708af93bffe049ea645a656', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$KYYOuPkt.rE9dJnlPLDoyumz7LKYlpJRyToF.xDRcHyOdfeEvy64e', NULL, '2022-12-26 08:48:47', '2022-12-26 08:49:05'),
(394, 0, 0, 0, 0, 0, 0, 'Family Name', '3752929871621', NULL, '941bc42bba4cdec273f73bfb2903a4c7', NULL, NULL, NULL, NULL, 15, NULL, NULL, 'Расскажите подробно о себе: про ваш опыт, навыки и преимущества, как давно работаете,\r\nчто умеете. Это поможет клиентам лучше узнать вас.', '$2y$10$Rxeo51PTRzRhznfu5ZYEi.tdDlzkMVdxLVaxpnBWHiVCeN0ZhJgPe', NULL, '2022-12-26 09:01:47', '2022-12-26 09:02:52'),
(395, 0, 1, 0, 0, 0, 0, 'Family Name', '375292987162', NULL, '3e47e969c8dbd2a87f6428a5286ce928', NULL, NULL, '2023-06-16 10:23:19', NULL, NULL, NULL, NULL, NULL, '$2y$10$8NtkC8uauuAtJed9Uf7ok.QdTwcMlQpU3.Dyep6sxkEQBzYFCbMru', NULL, '2022-12-26 09:14:45', '2023-06-16 10:23:19');

-- --------------------------------------------------------

--
-- Структура таблицы `user_categories`
--

CREATE TABLE `user_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_categories`
--

INSERT INTO `user_categories` (`id`, `user_id`, `category_id`, `sub_category_id`, `created_at`, `updated_at`) VALUES
(91, 390, 1, 9, '2022-12-23 04:58:47', '2022-12-23 04:58:47'),
(92, 390, 1, 8, '2022-12-23 04:58:47', '2022-12-23 04:58:47'),
(93, 390, 1, 7, '2022-12-23 04:58:47', '2022-12-23 04:58:47'),
(114, 391, 1, 9, '2022-12-26 09:12:22', '2022-12-26 09:12:22'),
(115, 391, 1, 8, '2022-12-26 09:12:22', '2022-12-26 09:12:22');

-- --------------------------------------------------------

--
-- Структура таблицы `user_images`
--

CREATE TABLE `user_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_images`
--

INSERT INTO `user_images` (`id`, `user_id`, `path`, `created_at`, `updated_at`) VALUES
(128, 390, '/users/390/8a30a8510d14ec15e36ef0022ab512b4_small.jpg', '2022-12-23 04:56:32', '2022-12-23 04:56:32'),
(129, 391, '/users/391/ff29c43465cfcc437756395743af9490_small.jpg', '2022-12-26 09:07:23', '2022-12-26 09:07:23'),
(130, 391, '/users/391/f3df9277223dbdb860bf54e5551b9e11_small.jpg', '2022-12-26 09:07:28', '2022-12-26 09:07:28'),
(131, 391, '/users/391/092ee6e73b07b228fc25074f064d51a6_small.jpg', '2022-12-26 09:07:43', '2022-12-26 09:07:43'),
(132, 391, '/users/391/7ce67c2fc28e8d42419425cd7338c198_small.jpg', '2022-12-26 09:11:14', '2022-12-26 09:11:14');

-- --------------------------------------------------------

--
-- Структура таблицы `user_regions`
--

CREATE TABLE `user_regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_regions`
--

INSERT INTO `user_regions` (`id`, `user_id`, `city_id`, `created_at`, `updated_at`) VALUES
(134, 390, 450, '2022-12-23 04:56:52', '2022-12-23 04:56:52'),
(135, 390, 241, '2022-12-23 04:56:52', '2022-12-23 04:56:52'),
(274, 391, 457, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(275, 391, 89, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(276, 391, 1203, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(277, 391, 702, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(278, 391, 815, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(279, 391, 821, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(280, 391, 147, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(281, 391, 570, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(282, 391, 636, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(283, 391, 679, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(284, 391, 843, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(285, 391, 177, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(286, 391, 1041, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(287, 391, 174, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(288, 391, 1113, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(289, 391, 450, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(290, 391, 241, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(291, 391, 262, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(292, 391, 249, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(293, 391, 245, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(294, 391, 800, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(295, 391, 908, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(296, 391, 649, '2022-12-26 09:12:03', '2022-12-26 09:12:03'),
(297, 391, 415, '2022-12-26 09:12:03', '2022-12-26 09:12:03');

-- --------------------------------------------------------

--
-- Структура таблицы `user_services`
--

CREATE TABLE `user_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL,
  `price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_services`
--

INSERT INTO `user_services` (`id`, `user_id`, `category_id`, `sub_category_id`, `services_id`, `price`, `created_at`, `updated_at`) VALUES
(87, 390, 1, 9, 10, '257', '2022-12-23 05:00:01', '2022-12-23 05:00:01'),
(88, 390, 1, 9, 15, '55', '2022-12-23 05:00:01', '2022-12-23 05:00:01'),
(89, 390, 1, 7, 14, '15', '2022-12-23 05:00:01', '2022-12-23 05:00:01'),
(103, 391, 1, 9, 10, '15', '2022-12-26 09:12:29', '2022-12-26 09:12:29'),
(104, 391, 1, 9, 15, '255', '2022-12-26 09:12:29', '2022-12-26 09:12:29'),
(105, 391, 1, 8, 11, '555', '2022-12-26 09:12:29', '2022-12-26 09:12:29');

-- --------------------------------------------------------

--
-- Структура таблицы `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `advert_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `adverts`
--
ALTER TABLE `adverts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `sub_category` (`sub_category`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `region_id` (`region_id`),
  ADD KEY `parent_region_id` (`parent_region_id`),
  ADD KEY `status` (`status`),
  ADD KEY `import_id` (`import_id`),
  ADD KEY `date_up` (`date_up`);
ALTER TABLE `adverts` ADD FULLTEXT KEY `text` (`text`);

--
-- Индексы таблицы `advert_categories`
--
ALTER TABLE `advert_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `url` (`url`);

--
-- Индексы таблицы `advert_prices`
--
ALTER TABLE `advert_prices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advert_id` (`advert_id`);

--
-- Индексы таблицы `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Индексы таблицы `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `url` (`url`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `type` (`type`),
  ADD KEY `public` (`public`);

--
-- Индексы таблицы `seo_pages`
--
ALTER TABLE `seo_pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category` (`category`),
  ADD KEY `subcategory` (`subcategory`),
  ADD KEY `url` (`url`);

--
-- Индексы таблицы `seo_pages_relations`
--
ALTER TABLE `seo_pages_relations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advert_id` (`advert_id`),
  ADD KEY `page_id` (`page_id`),
  ADD KEY `city_id` (`city_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `sub_category` (`sub_category`);

--
-- Индексы таблицы `seo_settings`
--
ALTER TABLE `seo_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `page_type` (`page_type`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `user_categories`
--
ALTER TABLE `user_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_categories_user_id_index` (`user_id`),
  ADD KEY `user_categories_category_id_index` (`category_id`),
  ADD KEY `user_categories_sub_category_id_index` (`sub_category_id`);

--
-- Индексы таблицы `user_images`
--
ALTER TABLE `user_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advert_id` (`user_id`);

--
-- Индексы таблицы `user_regions`
--
ALTER TABLE `user_regions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_regions_user_id_index` (`user_id`),
  ADD KEY `user_regions_city_id_index` (`city_id`);

--
-- Индексы таблицы `user_services`
--
ALTER TABLE `user_services`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_services_user_id_index` (`user_id`),
  ADD KEY `user_services_category_id_index` (`category_id`),
  ADD KEY `user_services_sub_category_id_index` (`sub_category_id`),
  ADD KEY `user_services_services_id_index` (`services_id`);

--
-- Индексы таблицы `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `session_id` (`session_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `adverts`
--
ALTER TABLE `adverts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `advert_categories`
--
ALTER TABLE `advert_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT для таблицы `advert_prices`
--
ALTER TABLE `advert_prices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `banners`
--
ALTER TABLE `banners`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1216;

--
-- AUTO_INCREMENT для таблицы `seo_pages`
--
ALTER TABLE `seo_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `seo_pages_relations`
--
ALTER TABLE `seo_pages_relations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `seo_settings`
--
ALTER TABLE `seo_settings`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=396;

--
-- AUTO_INCREMENT для таблицы `user_categories`
--
ALTER TABLE `user_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT для таблицы `user_images`
--
ALTER TABLE `user_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT для таблицы `user_regions`
--
ALTER TABLE `user_regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT для таблицы `user_services`
--
ALTER TABLE `user_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT для таблицы `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
