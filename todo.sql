-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июл 12 2019 г., 19:59
-- Версия сервера: 5.6.43
-- Версия PHP: 5.6.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `todo`
--

-- --------------------------------------------------------

--
-- Структура таблицы `task`
--

CREATE TABLE `task` (
  `id` int(32) NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `user_id` int(64) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `task`
--

INSERT INTO `task` (`id`, `name`, `description`, `user_id`, `parent_id`, `status`) VALUES
(4, 'Приготовить ужин', 'Здесь должно быть описание.', 13, NULL, 2),
(5, 'Сходить в магазин', '', 13, NULL, 1),
(8, 'Сделать зарядку', '', 14, NULL, 0),
(9, 'Купить картошку', '', 13, 5, 0),
(10, 'Купить лук', '', 13, 5, 0),
(15, 'Сделать зарядку', '', 13, NULL, 4),
(17, 'Завершенная 1', '', 13, NULL, 4),
(18, 'Активная 2', '', 13, NULL, 4),
(19, 'Моя задача', '', 14, NULL, 0),
(20, 'подзадача 1', '...', 13, NULL, 0),
(21, 'подзадача 2', '...', 13, NULL, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(16) NOT NULL,
  `name` varchar(16) NOT NULL,
  `password` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `password`, `status`) VALUES
(12, 'admin', '$2y$13$Yoq5JOsritGliutQIE/Ll..nSv1KB.qZt.caYghRbTBPgfPpmbTLy', 1),
(13, 'Николай', '$2y$13$H60FianBfKTznwH3YJJ30uylYaLra8B514fkQUT70Bd.rDEIBPuMC', 1),
(14, 'Владимир', '$2y$13$8xhanlbbfJrBobB8wjtgluOMWScU4.WIqGMFrcTDF2rY0Rg2FaKBa', 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `task`
--
ALTER TABLE `task`
  MODIFY `id` int(32) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
