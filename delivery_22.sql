-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: MySQL-8.2
-- Время создания: Апр 07 2025 г., 15:17
-- Версия сервера: 8.2.0
-- Версия PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `delivery_22`
--
CREATE DATABASE IF NOT EXISTS `delivery_22` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `delivery_22`;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `created_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `type` smallint NOT NULL,
  `description` text COLLATE utf8mb3_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8mb3_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int DEFAULT NULL,
  `updated_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `title`) VALUES
(1, 'Продукты'),
(2, 'Одежда'),
(4, 'Животные');

-- --------------------------------------------------------

--
-- Структура таблицы `favourite`
--

DROP TABLE IF EXISTS `favourite`;
CREATE TABLE `favourite` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `status` tinyint UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `favourite`
--

INSERT INTO `favourite` (`id`, `user_id`, `product_id`, `status`) VALUES
(1, 2, 1, 1),
(2, 2, 2, 0),
(3, 2, 3, 0),
(4, 2, 4, 0),
(5, 2, 8, 0),
(6, 2, 6, 1),
(7, 2, 5, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE `item` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `item`
--

INSERT INTO `item` (`id`, `title`) VALUES
(22, 'werqw fghg fdg ');

-- --------------------------------------------------------

--
-- Структура таблицы `item_prop`
--

DROP TABLE IF EXISTS `item_prop`;
CREATE TABLE `item_prop` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `value` int UNSIGNED NOT NULL DEFAULT '0',
  `item_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `item_prop`
--

INSERT INTO `item_prop` (`id`, `title`, `value`, `item_id`) VALUES
(14, 'wer e23rerfwegrgw', 1, 22),
(15, 'wrwr 342 3t134', 2, 22),
(20, 'qweqwe', 1, 22),
(21, 'sadasd', 1, 22);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8mb4_general_ci NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1741759793),
('m140506_102106_rbac_init', 1741759908),
('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1741759908),
('m180523_151638_rbac_updates_indexes_without_prefix', 1741759908),
('m200409_110543_rbac_update_mssql_trigger', 1741759908);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_order` date NOT NULL,
  `time_order` time NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `status_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `pay_type_id` int UNSIGNED NOT NULL,
  `outpost_id` int UNSIGNED DEFAULT NULL,
  `comment_admin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `created_at`, `date_order`, `time_order`, `address`, `comment`, `user_id`, `status_id`, `product_id`, `pay_type_id`, `outpost_id`, `comment_admin`) VALUES
(2, '2024-11-18 08:22:17', '2024-11-18', '11:11:00', '111', NULL, 2, 1, 1, 1, 1, NULL),
(3, '2024-11-18 08:35:59', '2024-11-19', '11:11:00', '111', NULL, 2, 1, 1, 1, 3, NULL),
(4, '2024-11-18 10:36:03', '2024-11-18', '11:11:00', '111', '1111', 2, 1, 1, 1, NULL, NULL),
(5, '2024-11-18 08:22:17', '2024-11-18', '11:11:00', '111', NULL, 2, 1, 1, 1, 1, NULL),
(6, '2024-11-18 08:35:59', '2024-11-19', '11:11:00', '111', NULL, 2, 1, 1, 1, 3, NULL),
(7, '2024-11-18 10:36:03', '2024-11-18', '11:11:00', '111', '1111', 2, 1, 1, 1, NULL, NULL),
(9, '2024-11-18 08:35:59', '2024-11-19', '11:11:00', '111', NULL, 2, 1, 1, 1, 3, NULL),
(10, '2024-11-18 10:36:03', '2024-11-18', '11:11:00', '111', '1111', 2, 1, 1, 1, NULL, NULL),
(11, '2024-11-18 08:22:17', '2024-11-18', '11:11:00', '111', NULL, 2, 1, 1, 1, 1, NULL),
(12, '2024-11-18 08:35:59', '2024-11-19', '11:11:00', '111', NULL, 2, 1, 1, 1, 3, NULL),
(13, '2024-11-18 10:36:03', '2024-11-18', '11:11:00', '111', '1111', 2, 1, 1, 1, NULL, NULL),
(14, '2024-11-18 21:39:52', '2024-11-19', '11:01:00', '111', '111', 2, 1, 1, 1, NULL, NULL),
(15, '2024-11-18 21:40:19', '2024-11-19', '11:11:00', '111', NULL, 2, 1, 1, 1, 1, NULL),
(16, '2024-11-18 21:41:36', '2024-11-19', '11:11:00', '111', NULL, 2, 3, 4, 2, 2, 'q'),
(17, '2024-11-25 07:11:45', '2024-11-26', '11:01:00', '11', NULL, 2, 3, 1, 1, 3, 'www'),
(18, '2024-11-25 07:13:31', '2024-11-26', '11:01:00', '111', '111', 2, 3, 1, 2, NULL, 'ZczxCzxC'),
(19, '2024-11-25 07:13:55', '2024-11-26', '11:11:00', '111', NULL, 2, 3, 1, 2, 4, 'asdasdasd'),
(20, '2024-11-25 08:25:55', '2024-11-26', '11:01:00', '111', '123123', 2, 2, 1, 2, NULL, NULL),
(21, '2024-11-25 08:26:15', '2024-11-27', '11:01:00', '111', NULL, 2, 2, 1, 2, 2, NULL),
(22, '2024-11-25 08:26:37', '2024-11-27', '11:11:00', '11', NULL, 2, 2, 1, 1, 3, NULL),
(24, '2024-11-25 10:33:26', '2024-11-26', '11:01:00', '1111', '111', 2, 3, 1, 2, NULL, 'пвпфывп'),
(25, '2024-11-25 10:34:57', '2024-11-26', '09:01:00', 'qqq', 'qqq', 2, 2, 1, 1, NULL, NULL),
(26, '2024-11-25 11:58:09', '2024-11-27', '11:11:00', '111', NULL, 2, 1, 1, 1, 1, 'wwww');

-- --------------------------------------------------------

--
-- Структура таблицы `outpost`
--

DROP TABLE IF EXISTS `outpost`;
CREATE TABLE `outpost` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `outpost`
--

INSERT INTO `outpost` (`id`, `title`) VALUES
(1, 'Пункт выдачи 1'),
(2, 'Пункт выдачи 2'),
(3, 'Пункт выдачи 3'),
(4, 'Пункт выдачи 4');

-- --------------------------------------------------------

--
-- Структура таблицы `pay_type`
--

DROP TABLE IF EXISTS `pay_type`;
CREATE TABLE `pay_type` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `pay_type`
--

INSERT INTO `pay_type` (`id`, `title`) VALUES
(1, 'Наличные'),
(2, 'Банковская карта'),
(3, 'QR-код'),
(4, 'Электронные деньги');

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `price` float UNSIGNED NOT NULL,
  `count` int UNSIGNED NOT NULL DEFAULT '0',
  `like` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `dislike` tinyint UNSIGNED NOT NULL DEFAULT '0',
  `weight` float UNSIGNED DEFAULT '0',
  `kilocalories` float UNSIGNED DEFAULT '0',
  `shelf_life` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `title`, `photo`, `price`, `count`, `like`, `dislike`, `weight`, `kilocalories`, `shelf_life`, `description`, `category_id`) VALUES
(1, 'qq', '1_1731311211_ohPaQVBiNX.jpeg', 12, 12, 9, 7, 12, 0, '12', '<p><strong>dfgsdfgsdfg&nbsp; <span style=\"color:#008000\">edrgerger </span></strong></p>\r\n\r\n<p><span style=\"font-size:16px\"><strong><span style=\"background-color:#EE82EE\">sdfgsdfg <sup>dbvdfv</sup></span></strong></span></p>\r\n\r\n<p><input name=\"rtretyerty\" type=\"radio\" value=\"1\" /></p>\r\n\r\n<p><img alt=\"\" src=\"/img/1717087068_ATMGvehY2Y0vWm6fzjzO.jpg\" style=\"height:209px; width:264px\" /></p>\r\n\r\n<p>&nbsp;</p>\r\n', 4),
(2, 'молоко', '1_1731315465_AKqzck42ov.jpg', 100, 100, 3, 1, 1000, 100, '11', 'молоко', 1),
(3, 'хомяк', '1_1731311211_ohPaQVBiNX.jpeg', 12, 12, 3, 1, 12, 0, '12', 'хомяк пушистый', 4),
(4, 'молоко 2', '1_1731315465_AKqzck42ov.jpg', 100, 100, 10, 1, 1000, 100, '11', 'молоко 2', 1),
(5, 'хомяк 3', '1_1731311211_ohPaQVBiNX.jpeg', 12, 12, 1, 0, 12, 0, '12', 'хомяк 3', 4),
(6, 'молоко 3', '1_1731315465_AKqzck42ov.jpg', 100, 100, 1, 0, 1000, 100, '11', 'молоко', 1),
(7, 'хомяк 4', '1_1731311211_ohPaQVBiNX.jpeg', 12, 12, 1, 0, 12, 0, '12', 'хомяк пушистый', 4),
(8, 'молоко 4', '1_1731315465_AKqzck42ov.jpg', 100, 100, 0, 0, 1000, 100, '11', 'молоко 4', 1),
(9, 'хомяк 5', '1_1731311211_ohPaQVBiNX.jpeg', 12, 12, 0, 0, 12, 0, '12', 'хомяк 5 пушистый', 4),
(10, 'молоко 5', '1_1731315465_AKqzck42ov.jpg', 100, 100, 0, 0, 1000, 100, '11', 'молоко', 1),
(11, 'хомяк 6', '1_1731311211_ohPaQVBiNX.jpeg', 12, 12, 0, 0, 12, 0, '12', 'хомяк пушистый', 4),
(12, 'молоко 6', '1_1731315465_AKqzck42ov.jpg', 100, 100, 0, 0, 1000, 100, '11', 'молоко 6', 1),
(13, 'хомяк 7', '1_1731311211_ohPaQVBiNX.jpeg', 12, 12, 0, 0, 12, 0, '12', 'хомяк 7', 4),
(14, 'молоко 7', '1_1731315465_AKqzck42ov.jpg', 100, 100, 0, 0, 1000, 100, '11', 'молоко', 1),
(15, 'хомяк 8', '1_1731311211_ohPaQVBiNX.jpeg', 12, 12, 0, 0, 12, 0, '12', 'хомяк пушистый', 4),
(16, 'молоко 8', '1_1731315465_AKqzck42ov.jpg', 100, 100, 0, 0, 1000, 100, '11', 'молоко 8', 1),
(17, 'qq', 'noImage.png', 1, 1, 0, 0, 1, 1, '1', '1', 4),
(18, '111 qqq', 'noImage.png', 1, 1, 0, 0, 1, 1, '1', '1', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `reaction_user`
--

DROP TABLE IF EXISTS `reaction_user`;
CREATE TABLE `reaction_user` (
  `id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `status` tinyint DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `reaction_user`
--

INSERT INTO `reaction_user` (`id`, `product_id`, `user_id`, `status`) VALUES
(1, 4, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`id`, `title`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `status`
--

DROP TABLE IF EXISTS `status`;
CREATE TABLE `status` (
  `id` int UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `status`
--

INSERT INTO `status` (`id`, `title`) VALUES
(1, 'Новый'),
(2, 'Готов к выдаче'),
(3, 'Отмена');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `surname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `patronymic` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `login` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role_id` int UNSIGNED NOT NULL,
  `auth_key` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `patronymic`, `login`, `email`, `phone`, `password`, `photo`, `created_at`, `role_id`, `auth_key`) VALUES
(1, 'й', 'й', 'й', 'q', 'q', 'q', '$2y$13$PdjXxAQInyv3Wufkx3Tj2O/qvLfakOgdyfc6xe3wXjyGEYfarsm7O', NULL, '2024-10-28 08:45:50', 1, 'sadjkhfkajshdflkjahsdlfkjha'),
(2, 'Вася', 'Васильев', 'Васильевич', 'user', 'q@q.q', '+7(999)999-99-99', '$2y$13$.Pm3xuBrxPUOVr2rWQuAUuql1AYXDB0lMp5j.1xeL6BBPqzfi6M..', NULL, '2024-10-28 09:53:51', 2, 'XPLcU1N8Smbs7M3EornMurGde8e5y7hu'),
(3, 'й', 'й', 'й', 'admin', 'q@q.q', '+7(999)999-99-99', '$2y$13$e0yRyQMtlUdYRvnEWXnzheWyITUDxql1QsUmBRlkEvXka8kY1eUna', NULL, '2024-10-28 09:53:51', 1, 'XPLcU1N8Smbs7M3Eoe4tqrqeqfrwq4rws2');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD PRIMARY KEY (`item_name`,`user_id`),
  ADD KEY `idx-auth_assignment-user_id` (`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD PRIMARY KEY (`parent`,`child`),
  ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
  ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `favourite`
--
ALTER TABLE `favourite`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `item_prop`
--
ALTER TABLE `item_prop`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_id` (`item_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `pay_type_id` (`pay_type_id`),
  ADD KEY `outpost_id` (`outpost_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Индексы таблицы `outpost`
--
ALTER TABLE `outpost`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pay_type`
--
ALTER TABLE `pay_type`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Индексы таблицы `reaction_user`
--
ALTER TABLE `reaction_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_user_login` (`login`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `favourite`
--
ALTER TABLE `favourite`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `item`
--
ALTER TABLE `item`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `item_prop`
--
ALTER TABLE `item_prop`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `outpost`
--
ALTER TABLE `outpost`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `pay_type`
--
ALTER TABLE `pay_type`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `reaction_user`
--
ALTER TABLE `reaction_user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `status`
--
ALTER TABLE `status`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `favourite_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `favourite_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `item_prop`
--
ALTER TABLE `item_prop`
  ADD CONSTRAINT `item_prop_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_3` FOREIGN KEY (`pay_type_id`) REFERENCES `pay_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_4` FOREIGN KEY (`outpost_id`) REFERENCES `outpost` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_5` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `reaction_user`
--
ALTER TABLE `reaction_user`
  ADD CONSTRAINT `reaction_user_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reaction_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
