SET FOREIGN_KEY_CHECKS=0;

START TRANSACTION;

DROP TABLE IF EXISTS `pizza`;

CREATE TABLE IF NOT EXISTS `pizza` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pos` int(10) unsigned NOT NULL,
  `neg` int(10) unsigned NOT NULL,
  `rate` float(6,4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=17 ;

INSERT INTO `pizza` (`id`, `name`, `image`, `pos`, `neg`, `rate`) VALUES
(1, 'Pizza Mista', '/assets/custom/pizza/001.jpg', 10, 3, 0.7692),
(2, 'Pizza Oliva', '/assets/custom/pizza/002.jpg', 12, 5, 0.7059),
(3, 'Pizza Margherita', '/assets/custom/pizza/003.jpg', 5, 8, 0.3846),
(4, 'Pizza Gambero', '/assets/custom/pizza/004.jpg', 3, 11, 0.2143),
(5, 'Pizza Verdura', '/assets/custom/pizza/005.jpg', 6, 7, 0.4615),
(6, 'Pizza Peperone', '/assets/custom/pizza/006.jpg', 2, 9, 0.1818),
(7, 'Pizza Vegetariana', '/assets/custom/pizza/007.jpg', 4, 13, 0.2353),
(8, 'Pizza Salame', '/assets/custom/pizza/008.jpg', 15, 3, 0.8333),
(9, 'Pizza Funghi e Oliva', '/assets/custom/pizza/009.jpg', 6, 8, 0.4286),
(10, 'Pizza Salame e Pomodoro', '/assets/custom/pizza/010.jpg', 8, 5, 0.6154),
(11, 'Pizza Frutti di Mare', '/assets/custom/pizza/011.jpg', 7, 9, 0.4375),
(12, 'Pizza Salame e Speciale', '/assets/custom/pizza/012.jpg', 15, 1, 0.9375),
(13, 'Pizza Prosciutto', '/assets/custom/pizza/013.jpg', 9, 4, 0.6923),
(14, 'Pizza Melanzane', '/assets/custom/pizza/014.jpg', 8, 8, 0.5000),
(15, 'Pizza Salame e Prosciutto', '/assets/custom/pizza/015.jpg', 13, 5, 0.7222),
(16, 'Pizza alla Mamma', '/assets/custom/pizza/016.jpg', 9, 7, 0.5625);

DROP TABLE IF EXISTS `restaurant`;

CREATE TABLE IF NOT EXISTS `restaurant` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `pizza` smallint(5) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float(5,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pizza` (`pizza`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=22 ;

INSERT INTO `restaurant` (`id`, `pizza`, `date`, `name`, `price`) VALUES
(1, 1, '2015-11-19 15:31:34', 'Luigis Pizza Service', 7.95),
(2, 2, '2015-11-19 15:32:59', 'Luigis Pizza Service', 6.95),
(3, 3, '2015-11-19 15:33:12', 'Luigis Pizza Service', 5.95),
(4, 4, '2015-11-19 15:33:21', 'Luigis Pizza Service', 9.95),
(5, 6, '2015-11-19 15:33:31', 'Luigis Pizza Service', 7.95),
(6, 7, '2015-11-19 15:33:45', 'Luigis Pizza Service', 6.95),
(7, 9, '2015-11-19 15:33:53', 'Luigis Pizza Service', 6.95),
(8, 10, '2015-11-19 15:34:01', 'Luigis Pizza Service', 6.95),
(9, 12, '2015-11-19 15:34:11', 'Luigis Pizza Service', 8.95),
(10, 13, '2015-11-19 15:34:20', 'Luigis Pizza Service', 7.95),
(11, 14, '2015-11-19 15:34:31', 'Luigis Pizza Service', 6.95),
(12, 15, '2015-11-19 15:34:36', 'Luigis Pizza Service', 8.95),
(13, 16, '2015-11-19 15:34:43', 'Luigis Pizza Service', 9.95),
(14, 3, '2015-11-19 15:35:17', 'Alessandros Pizza Flitzer', 6.50),
(15, 7, '2015-11-19 15:37:10', 'Alessandros Pizza Flitzer', 7.50),
(16, 8, '2015-11-19 15:37:28', 'Alessandros Pizza Flitzer', 6.50),
(17, 10, '2015-11-19 15:37:43', 'Alessandros Pizza Flitzer', 7.50),
(18, 11, '2015-11-19 15:38:48', 'Alessandros Pizza Flitzer', 9.50),
(19, 12, '2015-11-19 15:39:05', 'Alessandros Pizza Flitzer', 7.50),
(20, 13, '2015-11-19 15:39:16', 'Alessandros Pizza Flitzer', 7.50),
(21, 15, '2015-11-19 15:39:33', 'Alessandros Pizza Flitzer', 7.50);

ALTER TABLE `restaurant`
  ADD CONSTRAINT `restaurant_ibfk_1` FOREIGN KEY (`pizza`) REFERENCES `pizza` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

SET FOREIGN_KEY_CHECKS=1;

COMMIT;