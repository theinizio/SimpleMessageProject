-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Хост: lamp107
-- Время создания: Мар 11 2018 г., 19:03
-- Версия сервера: 5.5.56
-- Версия PHP: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

-- --------------------------------------------------------

--
-- Структура таблицы `smp_comments`
--

CREATE TABLE IF NOT EXISTS `smp_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'comment id',
  `message_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` bigint(100) NOT NULL,
  `text` varchar(512) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT '2018-03-06 12:07:09',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- Дамп данных таблицы `smp_comments`
--

INSERT INTO `smp_comments` (`id`, `message_id`, `parent_id`, `timestamp`, `author_id`, `text`, `last_edited`) VALUES
(1, 2, 0, '2018-03-06 12:07:09', 1, 'комментарий к сообщению', '2018-03-06 12:07:09'),
(2, 2, 1, '2018-03-06 12:07:43', 1, 'комментарий к комментарию', '2018-03-06 12:07:43'),
(3, 2, 0, '2018-03-06 12:08:17', 1, 'еще один комментарий к сообщению', '2018-03-06 12:08:17'),
(4, 3, 0, '2018-03-09 20:03:46', 1, '&lt;font color=green&gt;ЗЕЛЕНЫЙ&lt;/font&gt;', '2018-03-09 20:03:46'),
(5, 9, 0, '2018-03-09 20:37:15', 1, 'rgergfdsvdvsdvfa', '2018-03-09 20:37:15'),
(6, 2, 0, '2018-03-10 16:29:31', 1, 'dfgfghghjhngjgh', '2018-03-10 16:29:31'),
(7, 2, 0, '2018-03-10 16:29:31', 1, 'dfgfghghjhngjgh', '2018-03-10 16:29:31'),
(8, 18, 0, '2018-03-11 17:18:14', 2, '12', '2018-03-11 17:18:14'),
(9, 20, 0, '2018-03-11 18:10:04', 2, 'sdvsdcsdcsd', '2018-03-11 18:10:04'),
(10, 9, 0, '2018-03-11 18:10:14', 2, 'sdvvdsvdsvdsvsd', '2018-03-11 18:10:14'),
(11, 21, 0, '2018-03-11 18:32:42', 2, 'да', '2018-03-11 18:32:42'),
(12, 9, 0, '2018-03-11 18:39:51', 2, 'face again', '2018-03-11 18:39:51'),
(13, 19, 0, '2018-03-11 18:45:46', 2, 'zas2', '2018-03-11 18:45:46'),
(17, 17, 0, '2018-03-11 20:09:17', 2, 'Ммммм', '2018-03-11 20:09:17'),
(18, 10, 0, '2018-03-11 20:09:42', 2, 'Ииии', '2018-03-11 20:09:42'),
(19, 15, 0, '2018-03-11 20:10:15', 2, 'Акуапррррррр', '2018-03-11 20:10:33'),
(20, 7, 0, '2018-03-11 20:11:01', 2, '', '2018-03-11 20:11:01'),
(23, 19, 0, '2018-03-11 20:39:10', 2, '', '2018-03-11 20:39:10'),
(24, 5, 0, '2018-03-11 20:50:08', 2, 'не весь', '2018-03-11 20:50:08'),
(25, 5, 24, '2018-03-11 21:00:52', 2, 'конечно', '2018-03-11 21:00:52'),
(28, 26, 0, '2018-03-11 21:08:11', 2, 'Кошка мур', '2018-03-11 21:08:21'),
(29, 11, 0, '2018-03-11 21:47:26', 2, 'укк', '2018-03-11 21:47:26');

-- --------------------------------------------------------

--
-- Структура таблицы `smp_messages`
--

CREATE TABLE IF NOT EXISTS `smp_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'message id',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author_id` bigint(100) NOT NULL,
  `message_text` varchar(512) NOT NULL,
  `last_edited` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Дамп данных таблицы `smp_messages`
--

INSERT INTO `smp_messages` (`id`, `timestamp`, `author_id`, `message_text`, `last_edited`) VALUES
(1, '2018-03-06 11:04:41', 1, 'сообщение', '2014-03-06 11:04:41'),
(2, '2018-03-06 11:06:13', 1, 'другое сообщение', '2018-03-06 11:06:13'),
(3, '2018-03-06 11:07:09', 1, 'Абракадабра какая-то', '2018-03-06 11:07:09'),
(4, '2018-03-06 11:07:43', 1, 'Похоже, кто-то любит вводить текст', '2018-03-06 15:46:43'),
(5, '2018-03-06 11:08:17', 1, 'собака съела товар', '2018-03-06 15:44:17'),
(6, '2018-03-06 21:35:42', 1, 'Ваше сообщение...', '2018-03-06 21:35:42'),
(7, '2018-03-06 21:36:04', 1, 'Всем привет!', '2018-03-06 21:36:04'),
(11, '2018-03-11 10:28:12', 1, 'Колумб открыл Америку', '2018-03-11 10:28:12'),
(17, '2018-03-11 17:13:13', 3, 'my first message as user', '2018-03-11 17:13:13'),
(18, '2018-03-11 17:14:39', 3, 'бяка', '2018-03-11 17:14:39'),
(21, '2018-03-11 18:32:06', 3, 'facebook???', '2018-03-11 18:32:06'),
(25, '2018-03-11 20:07:48', 3, 'Работает', '2018-03-11 20:07:48'),
(26, '2018-03-11 20:08:58', 3, 'Мммммм', '2018-03-11 20:08:58'),
(27, '2018-03-11 21:43:30', 2, 'Надо много работать', '2018-03-11 21:43:30'),
(28, '2018-03-11 21:45:02', 2, 'Где мои сообщения?', '2018-03-11 21:45:02'),
(29, '2018-03-11 21:46:36', 1, 'непонятно', '2018-03-11 21:46:36'),
(30, '2018-03-11 21:47:33', 1, 'вввавава', '2018-03-11 21:47:33'),
(31, '2018-03-11 21:53:21', 3, 'РАботает теперь?', '2018-03-11 21:53:21'),
(32, '2018-03-11 21:54:02', 3, 'всывывмывм', '2018-03-11 21:54:02'),
(33, '2018-03-11 22:06:25', 3, 'bgfccccncvngfn', '2018-03-11 22:06:25'),
(34, '2018-03-11 22:08:52', 2, 'sfdsfsgdsfg', '2018-03-11 22:08:52');

-- --------------------------------------------------------

--
-- Структура таблицы `smp_users`
--

CREATE TABLE IF NOT EXISTS `smp_users` (
  `userid` bigint(100) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `key` varchar(50) NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9223372036854775807 ;

--
-- Дамп данных таблицы `smp_users`
--

INSERT INTO `smp_users` (`userid`, `username`, `display_name`, `email`, `key`) VALUES
(1, 'admin', 'Admin', 'admin@gmail.com', ''),
(2, 'Кирилл Олегович', 'Кирилл Олегович', 'theinizio@gmail.com', '989180104579525'),
(3, 'Kirill Potapenkov', 'Kirill Potapenkov', 'potapenkov@gmail.com', '100093854247420636648');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
