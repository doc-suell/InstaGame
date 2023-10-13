-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 13 oct. 2023 à 13:38
-- Version du serveur : 8.0.30
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `instagame`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `post_id` (`post_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `post_id`, `comment`, `created_at`) VALUES
(10, 14, 111, 'ggg', '2023-10-13 12:39:20'),
(11, 14, 113, 'Hello', '2023-10-13 12:39:28'),
(12, 14, 113, 'Yes', '2023-10-13 12:39:32'),
(13, 14, 113, 'OK', '2023-10-13 12:39:35'),
(14, 14, 113, 'No', '2023-10-13 12:39:40');

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `post_picture` varchar(255) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_picture`, `description`, `created_at`) VALUES
(110, 13, 'http://localhost/instaGame/images/desktop-wallpaper-guts-berserk-guts-phone.jpg', 'Berserk (ベルセルク, Beruseruku) est une série japonaise de mangas écrit et dessiné par Kentarō Miura. Il est prépublié depuis 1989 dans les magazines ...', '2023-09-28 10:23:46'),
(111, 13, 'http://localhost/instaGame/images/desktop-wallpaper-berserk-manga-for-tech-berserk-minimalist.jpg', 'Hunter × Hunter est une série japonaise de manga écrit et dessiné par Yoshihiro Togashi', '2023-09-28 10:24:04'),
(112, 13, 'http://localhost/instaGame/images/82bb4aef73cd957a33851f80d29a1460.jpg', 'Berserk (ベルセルク, Beruseruku) est une série japonaise de mangas écrit et dessiné par Kentarō Miura. Il est prépublié depuis 1989 dans les magazines ...', '2023-09-28 10:24:20'),
(113, 14, 'http://localhost/instaGame/images/artworks-G4nZvNecTJXQtxxQ-K0qk7w-t500x500.jpg', 'Berserk (ベルセルク, Beruseruku) est une série japonaise de mangas écrit et dessiné par Kentarō Miura. Il est prépublié depuis 1989 dans les magazines ...', '2023-09-28 12:16:04');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `profile_picture`, `created_at`) VALUES
(13, 'Gumball', 'gumball@gmail.com', '123', 'http://localhost/instaGame/images/82bb4aef73cd957a33851f80d29a1460.jpg', '2023-09-28 10:23:23'),
(14, 'toto', 'toto@gmail.com', '123', 'http://localhost/instaGame/images/i5eqdtk854s21.jpg', '2023-09-28 12:15:29');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
