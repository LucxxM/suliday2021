-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 06 mai 2021 à 09:52
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `stuliday`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_name` varchar(255) NOT NULL,
  PRIMARY KEY (`categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`) VALUES
(1, 'Appartement'),
(2, 'Maison'),
(3, 'Villa'),
(4, 'Parking/garage'),
(5, 'Maison de Luxe'),
(7, 'Maison de Campagne'),
(8, 'Chalet'),
(9, 'Residence secondaire'),
(10, 'Residence Senior'),
(11, 'Chalet Ã  la montagne');

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `products_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_name` varchar(255) NOT NULL,
  `products_description` text NOT NULL,
  `products_price` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `author` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  PRIMARY KEY (`products_id`),
  KEY `fk_author_users` (`author`),
  KEY `fk_category_categories` (`category`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`products_id`, `products_name`, `products_description`, `products_price`, `created_at`, `author`, `category`) VALUES
(10, 'Appartement', '95mÂ²', 75000, '2021-05-03 13:20:27', 8, 1),
(13, 'maison', '250mÂ²', 150000, '2021-05-04 11:47:32', 13, 2),
(14, 'Appartement', '75mÂ²', 75000, '2021-05-04 13:17:02', 14, 1),
(16, 'Villa', '1000mÂ² plus un super terrain avec arbres fruitiers', 850000, '2021-05-04 13:19:33', 16, 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` mediumtext NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'ROLE_USER',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'a1', 'a@a.com', '$2y$10$t74koQpJ3zUFEvvCryNw9ecItaR1bpoLDy1A0161XJJTQqJ5DGJ1e', 'ROLE USER'),
(8, 'Hamza', 'Hbdx@gg.com', '$2y$10$n08nNjDA9kEsM9lbHEDmfOaQ/KNM6Fsg3HGB0v.SyiFIGbHYVElBm', 'ROLE USER'),
(9, 'luc', 'admin@gg.com', '$2y$10$5jX5V9qvHcqYsDNErEp/fuiZ7UMNavq4oVqGOluVTalmPcBhKZ9ce', 'ROLE ADMIN'),
(13, 'didier2', 'test2@ggg.com', '$2y$10$uvZb4rojGRDhnXaXfzEQ9uVwEzgzr3kyJKQCD46R4yjKU6I5fGjrW', 'ROLE USER'),
(14, 'Jeremy', 'jeje@gg.com', '$2y$10$JFX92cfOe.lU7.uRN3YyYeDJ1nAcfD1.LhAKjcWBEqtN2r434qgCO', 'ROLE USER'),
(16, 'KarimBenze', 'cryptokb@gg.com', '$2y$10$Nnj7cxbKR/txSWR4PlAETegjfgEl1KGpdkiMMDSI4HDgYhOL3JosG', 'ROLE USER'),
(17, 'Mili', 'Mili@cambodge.com', '$2y$10$bNE3BJU9go8jTBo.yYmi0OW8.aoMdICa7dgp5vfomXiLaUMQp1n9u', 'ROLE_USER'),
(18, 'Jean-didier', 'jd@gg.com', '$2y$10$hwNNYMu6OH4zTI60rqyix.Fq7vlDbWXZY0CO4zG76YIqFs5I2g.rq', 'ROLE_USER');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_author_users` FOREIGN KEY (`author`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_category_categories` FOREIGN KEY (`category`) REFERENCES `categories` (`categories_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
