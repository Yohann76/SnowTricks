-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 10 oct. 2019 à 19:59
-- Version du serveur :  5.7.26
-- Version de PHP :  7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `snowtricks`
--

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tricks_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526C3B153154` (`tricks_id`),
  KEY `IDX_9474526CA76ED395` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `tricks_id`, `user_id`, `content`, `published_at`) VALUES
(111, 246, 169, 'magnifico !! ', '2019-10-09 22:56:39'),
(112, 247, 169, 'magnifico !! ', '2019-10-09 22:56:39'),
(113, 248, 169, 'Picture is attractive <3', '2019-10-09 22:56:39'),
(114, 249, 169, 'Picture is attractive <3', '2019-10-09 22:56:39'),
(115, 250, 169, 'magnifico !! ', '2019-10-09 22:56:39'),
(116, 251, 169, 'good but its not easy', '2019-10-09 22:56:39'),
(117, 252, 169, 'nice !! i try this after ', '2019-10-09 22:56:39'),
(118, 253, 169, 'good but its not easy', '2019-10-09 22:56:39'),
(119, 254, 169, 'magnifico !! ', '2019-10-09 22:56:39'),
(120, 255, 169, 'Excellent, more information please', '2019-10-09 22:56:39');

-- --------------------------------------------------------

--
-- Structure de la table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tricks_id` int(11) DEFAULT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumbnail` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_6A2CA10C3B153154` (`tricks_id`)
) ENGINE=InnoDB AUTO_INCREMENT=222 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `media`
--

INSERT INTO `media` (`id`, `tricks_id`, `path`, `text`, `thumbnail`) VALUES
(195, 246, 'Media5Tricks5.jpg', 'Hello World1', 1),
(196, 247, 'Media5Tricks5.jpg', 'Hello World2', 1),
(197, 248, 'Media8Tricks8.jpg', 'Hello World3', 1),
(198, 249, 'Media5Tricks5.jpg', 'Hello World4', 1),
(199, 250, 'Media6Tricks6.jpg', 'Hello World5', 1),
(200, 251, 'Media3Tricks3.jpg', 'Hello World6', 1),
(201, 252, 'Media10Tricks10.jpg', 'Hello World7', 1),
(202, 253, 'Media6Tricks6.jpg', 'Hello World8', 1),
(203, 254, 'Media3Tricks3.jpg', 'Hello World9', 1),
(204, 255, 'Media6Tricks6.jpg', 'Hello World10', 1),
(205, 256, 'Media3Tricks3.jpg', 'Hello World11', 1),
(206, 257, 'Media3Tricks3.jpg', 'Hello World12', 1),
(207, 258, 'Media7Tricks7.jpg', 'Hello World13', 1),
(208, 259, 'Media2Tricks2.jpg', 'Hello World14', 1),
(209, 260, 'Media4Tricks4.jpg', 'Hello World15', 1),
(210, 261, 'Media9Tricks9.jpg', 'Hello World16', 1),
(211, 262, 'Media7Tricks7.jpg', 'Hello World17', 1),
(212, 263, 'Media6Tricks6.jpg', 'Hello World18', 1),
(213, 264, 'Media6Tricks6.jpg', 'Hello World19', 1),
(214, 265, 'Media4Tricks4.jpg', 'Hello World20', 1),
(215, 266, 'Media6Tricks6.jpg', 'Hello World21', 1),
(216, 267, 'Media4Tricks4.jpg', 'Hello World22', 1),
(217, 268, 'Media5Tricks5.jpg', 'Hello World23', 1),
(218, 269, 'Media9Tricks9.jpg', 'Hello World24', 1),
(219, 270, 'Media7Tricks7.jpg', 'Hello World25', 1),
(220, 271, 'Media9Tricks9.jpg', 'Hello World26', 1),
(221, 272, 'Media4Tricks4.jpg', 'Hello World27', 1);

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190910111959', '2019-10-06 17:16:35'),
('20191006171624', '2019-10-06 17:18:55');

-- --------------------------------------------------------

--
-- Structure de la table `tricks`
--

DROP TABLE IF EXISTS `tricks`;
CREATE TABLE IF NOT EXISTS `tricks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `difficulty` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `published_at` datetime DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E1D902C1F675F31B` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=273 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `tricks`
--

INSERT INTO `tricks` (`id`, `author_id`, `name`, `content`, `difficulty`, `category`, `published_at`, `description`) VALUES
(246, 169, 'Grab Line', 'The following figure is a beginner figure. It allows all new to make the hand. Be welcome and try snowboarding with this figure.', 2, 0, '2019-10-09 22:56:39', 'The following figure is known by all beginners, it\'s a great classic snowboarding, it\'s about doing small jumps repeated. This figure must be acquired before attempting other harder figures.'),
(247, 169, 'Grab Line', 'The following figure is known by all beginners, it\'s a great classic snowboarding, it\'s about doing small jumps repeated. This figure must be acquired before attempting other harder figures.', 0, 2, '2019-10-09 22:56:39', 'Try this charming figure only in the springboard more than 40 ° inclination from the ground, risk of falling with this figure.'),
(248, 169, 'Seat Grab', 'Its a easy tricks Snow, with that, you can make other tricks, its a basical technique', 2, 0, '2019-10-09 22:56:39', 'it\'s an imposing figure and extremely easy to do, you can impress your friends with it. You will learn this figure in about a week'),
(249, 169, 'Nose Grab', 'Try this charming figure only in the springboard more than 40 ° inclination from the ground, risk of falling with this figure.', 0, 0, '2019-10-09 22:56:39', 'Its a easy tricks Snow, with that, you can make other tricks, its a basical technique'),
(250, 169, 'Mute', 'Good bye, hello difficulty, this figure is complicated but worth the detour. This is the first figure to learn after the easy series', 1, 1, '2019-10-09 22:56:39', 'it\'s an imposing figure and extremely easy to do, you can impress your friends with it. You will learn this figure in about a week'),
(251, 169, 'Seat Belt', 'Good bye, hello difficulty, this figure is complicated but worth the detour. This is the first figure to learn after the easy series', 0, 1, '2019-10-09 22:56:39', 'Good bye, hello difficulty, this figure is complicated but worth the detour. This is the first figure to learn after the easy series'),
(252, 169, 'Mac Twist', 'The following figure is known by all beginners, it\'s a great classic snowboarding, it\'s about doing small jumps repeated. This figure must be acquired before attempting other harder figures.', 0, 0, '2019-10-09 22:56:39', 'This complex figure is without doubt one of the most impressive. It is very difficult to learn and generates a lot of applause every time it is done in public. It will take you long hours to learn it.'),
(253, 169, 'Nose Slide', 'Its a easy tricks Snow, with that, you can make other tricks, its a basical technique', 2, 2, '2019-10-09 22:56:39', 'The following figure is known by all beginners, it\'s a great classic snowboarding, it\'s about doing small jumps repeated. This figure must be acquired before attempting other harder figures.'),
(254, 169, 'Tail Slide', 'Les figures de snowboard sont toutes compliquées, mais celle-ci ne devrait pas vous posez trop de probleme. Même si vous débutez dans cette discipline.', 2, 0, '2019-10-09 22:56:39', 'This complex figure is without doubt one of the most impressive. It is very difficult to learn and generates a lot of applause every time it is done in public. It will take you long hours to learn it.'),
(255, 169, 'Tail Slide', 'Good bye, hello difficulty, this figure is complicated but worth the detour. This is the first figure to learn after the easy series', 2, 0, '2019-10-09 22:56:39', 'The following figure is known by all beginners, it\'s a great classic snowboarding, it\'s about doing small jumps repeated. This figure must be acquired before attempting other harder figures.'),
(256, 169, 'Grab Line', 'Its a easy tricks Snow, with that, you can make other tricks, its a basical technique', 0, 2, '2019-10-09 22:56:39', 'The following figure is known by all beginners, it\'s a great classic snowboarding, it\'s about doing small jumps repeated. This figure must be acquired before attempting other harder figures.'),
(257, 169, 'Indie Slide', 'it\'s an imposing figure and extremely easy to do, you can impress your friends with it. You will learn this figure in about a week', 0, 1, '2019-10-09 22:56:39', 'The following figure is known by all beginners, it\'s a great classic snowboarding, it\'s about doing small jumps repeated. This figure must be acquired before attempting other harder figures.'),
(258, 169, 'Old School Flip', 'This complex figure is without doubt one of the most impressive. It is very difficult to learn and generates a lot of applause every time it is done in public. It will take you long hours to learn it.', 1, 1, '2019-10-09 22:56:39', 'it\'s an imposing figure and extremely easy to do, you can impress your friends with it. You will learn this figure in about a week'),
(259, 169, 'Sad Flip', 'This complex figure is without doubt one of the most impressive. It is very difficult to learn and generates a lot of applause every time it is done in public. It will take you long hours to learn it.', 2, 2, '2019-10-09 22:56:39', 'Les figures de snowboard sont toutes compliquées, mais celle-ci ne devrait pas vous posez trop de probleme. Même si vous débutez dans cette discipline.'),
(260, 169, 'Seat Belt', 'Good bye, hello difficulty, this figure is complicated but worth the detour. This is the first figure to learn after the easy series', 2, 2, '2019-10-09 22:56:39', 'The following figure is a beginner figure. It allows all new to make the hand. Be welcome and try snowboarding with this figure.'),
(261, 169, 'Grab Line', 'The following figure is known by all beginners, it\'s a great classic snowboarding, it\'s about doing small jumps repeated. This figure must be acquired before attempting other harder figures.', 2, 1, '2019-10-09 22:56:39', 'The following figure is a beginner figure. It allows all new to make the hand. Be welcome and try snowboarding with this figure.'),
(262, 169, 'Front Flip', 'The following figure is a beginner figure. It allows all new to make the hand. Be welcome and try snowboarding with this figure.', 1, 2, '2019-10-09 22:56:39', 'The following figure is a beginner figure. It allows all new to make the hand. Be welcome and try snowboarding with this figure.'),
(263, 169, 'Truck Driver', 'The following figure is a beginner figure. It allows all new to make the hand. Be welcome and try snowboarding with this figure.', 1, 2, '2019-10-09 22:56:39', 'Try this charming figure only in the springboard more than 40 ° inclination from the ground, risk of falling with this figure.'),
(264, 169, 'Truck Driver', 'This complex figure is without doubt one of the most impressive. It is very difficult to learn and generates a lot of applause every time it is done in public. It will take you long hours to learn it.', 0, 2, '2019-10-09 22:56:39', 'Good bye, hello difficulty, this figure is complicated but worth the detour. This is the first figure to learn after the easy series'),
(265, 169, 'Japan Air', 'Good bye, hello difficulty, this figure is complicated but worth the detour. This is the first figure to learn after the easy series', 0, 2, '2019-10-09 22:56:39', 'Its a easy tricks Snow, with that, you can make other tricks, its a basical technique'),
(266, 169, 'Tail Slide', 'Good bye, hello difficulty, this figure is complicated but worth the detour. This is the first figure to learn after the easy series', 0, 2, '2019-10-09 22:56:39', 'Its a easy tricks Snow, with that, you can make other tricks, its a basical technique'),
(267, 169, 'Mac Twist', 'Try this charming figure only in the springboard more than 40 ° inclination from the ground, risk of falling with this figure.', 1, 0, '2019-10-09 22:56:39', 'This complex figure is without doubt one of the most impressive. It is very difficult to learn and generates a lot of applause every time it is done in public. It will take you long hours to learn it.'),
(268, 169, 'Sad Flip', 'The following figure is known by all beginners, it\'s a great classic snowboarding, it\'s about doing small jumps repeated. This figure must be acquired before attempting other harder figures.', 0, 0, '2019-10-09 22:56:39', 'it\'s an imposing figure and extremely easy to do, you can impress your friends with it. You will learn this figure in about a week'),
(269, 169, 'Style Week', 'Les figures de snowboard sont toutes compliquées, mais celle-ci ne devrait pas vous posez trop de probleme. Même si vous débutez dans cette discipline.', 2, 1, '2019-10-09 22:56:39', 'it\'s an imposing figure and extremely easy to do, you can impress your friends with it. You will learn this figure in about a week'),
(270, 169, 'Flip', 'This complex figure is without doubt one of the most impressive. It is very difficult to learn and generates a lot of applause every time it is done in public. It will take you long hours to learn it.', 1, 2, '2019-10-09 22:56:39', 'The following figure is known by all beginners, it\'s a great classic snowboarding, it\'s about doing small jumps repeated. This figure must be acquired before attempting other harder figures.'),
(271, 169, 'Seat Grab', 'Good bye, hello difficulty, this figure is complicated but worth the detour. This is the first figure to learn after the easy series', 0, 1, '2019-10-09 22:56:39', 'Good bye, hello difficulty, this figure is complicated but worth the detour. This is the first figure to learn after the easy series'),
(272, 169, 'Back Flip', 'The following figure is known by all beginners, it\'s a great classic snowboarding, it\'s about doing small jumps repeated. This figure must be acquired before attempting other harder figures.', 0, 0, '2019-10-09 22:56:39', 'Its a easy tricks Snow, with that, you can make other tricks, its a basical technique');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'UserPicture.png',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `first_name`, `password`, `token`, `picture`) VALUES
(169, 'yohanndurand76@gmail.com', '[]', 'Yohann', '$2y$13$jVyA12tSkvYNZAw5AyuTZOhoCHm66uXziDJYGpKPhiBYYBZJ8kFdq', NULL, 'yohann.jpg'),
(170, 'yohanndurand0@gmail.com', '[]', 'Norbert', '$2y$13$D6EJeBgLWRwG4WIoO91Gxu0b9Ri6OzO4hTb17jcgJCpcT3zEyHPdm', NULL, 'UserPicture.png'),
(171, 'yohanndurand1@gmail.com', '[]', 'Gina', '$2y$13$FsM1pIJiDDLyKH1JWECShOFYEVyQBHsr9L9zPoG6xi5EE2VjohZpi', NULL, 'UserPicture.png'),
(172, 'yohanndurand2@gmail.com', '[]', 'Kaela', '$2y$13$UTe9dp0pOJl9sSWGvzI0x./FY5WBl7aQpV.4k2srTQwmjh1SLqjUS', NULL, 'UserPicture.png'),
(173, 'yohanndurand3@gmail.com', '[]', 'Jon', '$2y$13$x5b/jNps9K.qYk1JQiEB8.nxY.1oBv1OpRZL95wzqzJkc.Fs7hHYm', NULL, 'UserPicture.png'),
(174, 'yohanndurand4@gmail.com', '[]', 'Clair', '$2y$13$lSeedqdYEwU..ZaOty8lEOGO0Yr7hGp5Gjdx248HtN5eXlnejB/GS', NULL, 'UserPicture.png'),
(175, 'yohanndurand5@gmail.com', '[]', 'Myron', '$2y$13$lWBnBQm0UPXZwGs/bz6v7Okm7TNV6pSA4BGzRCKaoIMcQIkh.mbUu', NULL, 'UserPicture.png'),
(176, 'yohanndurand6@gmail.com', '[]', 'Eldred', '$2y$13$vSGql9cgDB0AshLZ6hcNj.JD0zc1uQ6XqBEfVgVkL1uCdxP.sSadG', NULL, 'UserPicture.png'),
(177, 'yohanndurand7@gmail.com', '[]', 'Adah', '$2y$13$MK4m3UJA75UKiUYcnDCtZ.K6YiiF1pt.XUHBVLTvdihDScq3SLr0O', NULL, 'UserPicture.png'),
(178, 'yohanndurand8@gmail.com', '[]', 'Ruth', '$2y$13$pj8ikDqPohnS4ptVSwMBeObvlx3lvDt6cSJFFxv07obAUCZu0ZG3q', NULL, 'UserPicture.png'),
(179, 'yohanndurand9@gmail.com', '[]', 'Shawna', '$2y$13$zPeXO3wvxZcYpLKQBMExCuG7eKlVnaHJjZ45FFgjfsmBRhy2yu/c.', NULL, 'UserPicture.png'),
(180, 'yohanndurand760@gmail.com', '[]', 'Yohann', '$2y$13$WsJvlVnrAKq4nPiDy0T6x.UKiQHxjBqv678XTk/ho8N0xk6nA/FbS', NULL, 'UserPicture.png');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C3B153154` FOREIGN KEY (`tricks_id`) REFERENCES `tricks` (`id`),
  ADD CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `media`
--
ALTER TABLE `media`
  ADD CONSTRAINT `FK_6A2CA10C3B153154` FOREIGN KEY (`tricks_id`) REFERENCES `tricks` (`id`);

--
-- Contraintes pour la table `tricks`
--
ALTER TABLE `tricks`
  ADD CONSTRAINT `FK_E1D902C1F675F31B` FOREIGN KEY (`author_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
