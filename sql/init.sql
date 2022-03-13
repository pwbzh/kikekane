DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(512) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `is_admin` tinyint NOT NULL DEFAULT '0',
  `last_login_datetime` datetime DEFAULT NULL,
  `create_user_id` int unsigned NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_user_id` int unsigned DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `email` (`email`)
);


DROP TABLE IF EXISTS `game`;
CREATE TABLE `game` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) NOT NULL,
  `year` year NOT NULL,
  `open_bets` tinyint NOT NULL DEFAULT '0',
  `create_user_id` int unsigned NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_user_id` int unsigned DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `label` (`label`),
  KEY `create_user_id` (`create_user_id`),
  KEY `update_user_id` (`update_user_id`),
  CONSTRAINT `game_ibfk_1` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `game_ibfk_2` FOREIGN KEY (`update_user_id`) REFERENCES `user` (`id`)
);


DROP TABLE IF EXISTS `game_user`;
CREATE TABLE `game_user` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `game_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `create_user_id` int unsigned NOT NULL,
  `create_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `game_id` (`game_id`),
  KEY `user_id` (`user_id`),
  KEY `create_user_id` (`create_user_id`),
  CONSTRAINT `game_user_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`),
  CONSTRAINT `game_user_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `game_user_ibfk_3` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`)
);


DROP TABLE IF EXISTS `public_figure`;
CREATE TABLE `public_figure` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `death_date` date DEFAULT NULL,
  `wikipedia` varchar(512) DEFAULT NULL,
  `twitter` varchar(512) DEFAULT NULL,
  `note` longtext,
  `create_user_id` int unsigned NOT NULL,
  `create_datetime` datetime NOT NULL,
  `update_user_id` int unsigned DEFAULT NULL,
  `update_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `create_user_id` (`create_user_id`),
  KEY `update_user_id` (`update_user_id`),
  CONSTRAINT `public_figure_ibfk_1` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `public_figure_ibfk_2` FOREIGN KEY (`update_user_id`) REFERENCES `user` (`id`)
);


DROP TABLE IF EXISTS `bet`;
CREATE TABLE `bet` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `game_id` int unsigned NOT NULL,
  `user_id` int unsigned NOT NULL,
  `public_figure_id` int unsigned NOT NULL,
  `create_user_id` int unsigned NOT NULL,
  `create_datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `game_id` (`game_id`),
  KEY `user_id` (`user_id`),
  KEY `create_user_id` (`create_user_id`),
  KEY `public_figure_id` (`public_figure_id`),
  CONSTRAINT `bet_ibfk_1` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`),
  CONSTRAINT `bet_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `bet_ibfk_3` FOREIGN KEY (`create_user_id`) REFERENCES `user` (`id`),
  CONSTRAINT `bet_ibfk_4` FOREIGN KEY (`public_figure_id`) REFERENCES `public_figure` (`id`)
);

