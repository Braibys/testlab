-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 12 2020 г., 07:53
-- Версия сервера: 5.7.23
-- Версия PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `qatestlab_library`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(32) NOT NULL,
  PRIMARY KEY (`author_id`),
  UNIQUE KEY `author_name` (`author_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`author_id`, `author_name`) VALUES
(1, 'author1'),
(2, 'author2'),
(3, 'author3');

-- --------------------------------------------------------

--
-- Структура таблицы `author_to_book`
--

DROP TABLE IF EXISTS `author_to_book`;
CREATE TABLE IF NOT EXISTS `author_to_book` (
  `author_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`,`author_id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `author_to_book`
--

INSERT INTO `author_to_book` (`author_id`, `book_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 5),
(3, 2),
(3, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(32) NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`book_id`, `book_name`) VALUES
(1, 'book1'),
(2, 'book2'),
(3, 'book3'),
(5, 'book5');

-- --------------------------------------------------------

--
-- Структура таблицы `publishers`
--

DROP TABLE IF EXISTS `publishers`;
CREATE TABLE IF NOT EXISTS `publishers` (
  `publisher_id` int(11) NOT NULL AUTO_INCREMENT,
  `publisher_name` varchar(32) NOT NULL,
  PRIMARY KEY (`publisher_id`),
  UNIQUE KEY `publisher_name` (`publisher_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `publishers`
--

INSERT INTO `publishers` (`publisher_id`, `publisher_name`) VALUES
(1, 'publisher1'),
(2, 'publisher2'),
(3, 'publisher3');

-- --------------------------------------------------------

--
-- Структура таблицы `publisher_to_book`
--

DROP TABLE IF EXISTS `publisher_to_book`;
CREATE TABLE IF NOT EXISTS `publisher_to_book` (
  `publisher_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  PRIMARY KEY (`book_id`,`publisher_id`),
  UNIQUE KEY `book_id` (`book_id`),
  KEY `publisher_id` (`publisher_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `publisher_to_book`
--

INSERT INTO `publisher_to_book` (`publisher_id`, `book_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 5);

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `author_to_book`
--
ALTER TABLE `author_to_book`
  ADD CONSTRAINT `author_to_book_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `author_to_book_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `authors` (`author_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `publisher_to_book`
--
ALTER TABLE `publisher_to_book`
  ADD CONSTRAINT `publisher_to_book_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `publisher_to_book_ibfk_2` FOREIGN KEY (`publisher_id`) REFERENCES `publishers` (`publisher_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
