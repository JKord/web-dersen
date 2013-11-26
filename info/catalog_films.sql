-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.27 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             7.0.0.4338
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table web-dersen.actors
CREATE TABLE IF NOT EXISTS `actors` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table web-dersen.actors: ~1 rows (approximately)
/*!40000 ALTER TABLE `actors` DISABLE KEYS */;
INSERT INTO `actors` (`id`, `name`, `birthday`) VALUES
	(1, 'Метю', '2008-01-01'),
	(2, 'Шон Пен', '0000-00-00'),
	(3, 'Скарелет Йохансон', '0000-00-00'),
	(4, 'Хю Гран', '0000-00-00'),
	(5, 'Містер Бін', '0000-00-00'),
	(6, 'Еванжеліна Лілі', '0000-00-00');
/*!40000 ALTER TABLE `actors` ENABLE KEYS */;


-- Dumping structure for table web-dersen.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table web-dersen.categories: ~1 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`) VALUES
	(5, 'Школярам'),
	(6, 'Діятм'),
	(7, 'Дорослим');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


-- Dumping structure for table web-dersen.films
CREATE TABLE IF NOT EXISTS `films` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table web-dersen.films: ~0 rows (approximately)
/*!40000 ALTER TABLE `films` DISABLE KEYS */;
INSERT INTO `films` (`id`, `name`, `description`) VALUES
	(1, 'Марс', 'іва'),
	(2, 'Рокет Мен', 'іва'),
	(3, 'Форсаж', NULL);
/*!40000 ALTER TABLE `films` ENABLE KEYS */;


-- Dumping structure for table web-dersen.films_actors
CREATE TABLE IF NOT EXISTS `films_actors` (
  `film_id` int(10) NOT NULL,
  `actor_id` int(10) NOT NULL,
  PRIMARY KEY (`film_id`,`actor_id`),
  KEY `FK_films_actors_actors` (`actor_id`),
  KEY `film_id` (`film_id`),
  CONSTRAINT `FK_films_actors_actors` FOREIGN KEY (`actor_id`) REFERENCES `actors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_films_actors_films` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table web-dersen.films_actors: ~0 rows (approximately)
/*!40000 ALTER TABLE `films_actors` DISABLE KEYS */;
INSERT INTO `films_actors` (`film_id`, `actor_id`) VALUES
	(1, 1),
	(3, 1),
	(1, 2),
	(3, 3),
	(1, 4);
/*!40000 ALTER TABLE `films_actors` ENABLE KEYS */;


-- Dumping structure for table web-dersen.films_categories
CREATE TABLE IF NOT EXISTS `films_categories` (
  `film_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  PRIMARY KEY (`film_id`,`category_id`),
  KEY `FK_films_categories_categories` (`category_id`),
  KEY `film_id` (`film_id`),
  CONSTRAINT `FK_films_categories_films` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_films_categories_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table web-dersen.films_categories: ~0 rows (approximately)
/*!40000 ALTER TABLE `films_categories` DISABLE KEYS */;
INSERT INTO `films_categories` (`film_id`, `category_id`) VALUES
	(1, 7),
	(3, 7);
/*!40000 ALTER TABLE `films_categories` ENABLE KEYS */;


-- Dumping structure for table web-dersen.films_genres
CREATE TABLE IF NOT EXISTS `films_genres` (
  `film_id` int(10) NOT NULL,
  `genre_id` int(10) NOT NULL,
  PRIMARY KEY (`film_id`,`genre_id`),
  KEY `FK_films_genres_genres` (`genre_id`),
  KEY `film_id` (`film_id`),
  CONSTRAINT `FK_films_genres_films` FOREIGN KEY (`film_id`) REFERENCES `films` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_films_genres_genres` FOREIGN KEY (`genre_id`) REFERENCES `genres` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table web-dersen.films_genres: ~0 rows (approximately)
/*!40000 ALTER TABLE `films_genres` DISABLE KEYS */;
INSERT INTO `films_genres` (`film_id`, `genre_id`) VALUES
	(3, 1),
	(1, 2),
	(1, 3),
	(3, 3),
	(3, 4);
/*!40000 ALTER TABLE `films_genres` ENABLE KEYS */;


-- Dumping structure for table web-dersen.genres
CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table web-dersen.genres: ~0 rows (approximately)
/*!40000 ALTER TABLE `genres` DISABLE KEYS */;
INSERT INTO `genres` (`id`, `name`) VALUES
	(1, 'Комедія'),
	(2, 'Трілер'),
	(3, 'Містика'),
	(4, 'Ужас');
/*!40000 ALTER TABLE `genres` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
