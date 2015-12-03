-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 12 Novembre 2015 à 17:25
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `p1408263`
--

-- --------------------------------------------------------

--
-- Structure de la table `projet-objet`
--

CREATE TABLE IF NOT EXISTS `projet-objet` (
  `id_objet` int(11) NOT NULL AUTO_INCREMENT,
  `nom_objet` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `photo` text COLLATE utf8_unicode_ci NOT NULL,
  `prix_debut` double NOT NULL,
  `prix_actuel` double DEFAULT NULL,
  `date_debut` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_fin` datetime NOT NULL,
  `id_vendeur` int(11) NOT NULL,
  `id_acheteur` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_objet`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Contenu de la table `projet-objet`
--

INSERT INTO `projet-objet` (`id_objet`, `nom_objet`, `description`, `photo`, `prix_debut`, `prix_actuel`, `date_debut`, `date_fin`, `id_vendeur`, `id_acheteur`) VALUES
(1, 'Collier sablier', 'Collier pendentif retourneur de temps', '56d149ccd952b10631a7180d66fe7135.jpg', 6.99, 9, '2015-11-03 00:00:00', '2015-11-30 00:00:00', 2, 1),
(2, 'RÃ©plique baguette de Neville', 'RÃ©plique en rÃ©sine peinte Ã  la main de la baguette de Neville Longbottom.', 'd013a7e5c5bf521bf54cab053b5f9f4e.jpg', 14, 14, '2015-11-03 00:00:00', '2015-11-29 00:00:00', 2, 0),
(3, 'DÃ©luminator', 'd', '5493f9e8b9e3e39e8278479833e20ab0.jpg', 9, 9, '2015-11-03 00:00:00', '2015-11-28 00:00:00', 2, 0),
(4, 'Montre', 'Montre de poche pendentif en bronze', 'c0dfdcd23cedd7b243789465ce0c9103.jpg', 15, 15, '2015-11-03 00:00:00', '2015-11-27 00:00:00', 2, 0),
(5, 'Ã‰charpe', 'Ã‰charpe costume Slytherin', '0b4413a8cc9ebb5460d1094d25a6f845.jpg', 14, 15, '2015-11-03 00:00:00', '2015-11-26 00:00:00', 1, 2),
(7, 'Balai magique', 'Accessoire Coupe de Quidditch - Balai magique Firebolt Broom - Non interactif - en plastique', 'ee7ada628631fca4758454dc2037b45a.jpg', 23, 23, '2015-11-12 00:00:00', '2015-12-01 00:00:00', 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `projet-personne`
--

CREATE TABLE IF NOT EXISTS `projet-personne` (
  `id_personne` int(11) NOT NULL AUTO_INCREMENT,
  `prenom` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `nom` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `genre` char(1) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `mail` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `mdp` text CHARACTER SET utf8 COLLATE utf8_general_mysql500_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_personne`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=26 ;

--
-- Contenu de la table `projet-personne`
--

INSERT INTO `projet-personne` (`id_personne`, `prenom`, `nom`, `genre`, `mail`, `mdp`, `admin`) VALUES
(0, 'admin', 'admin', 'H', 'admin@fr', 'admin', 1),
(1, 'Axel', 'Le Bot', 'H', 'axellebot@gmail.com', 'test', 1),
(2, 'JÃ©rÃ©mie', 'BERNARD', 'H', 'jb@fr', 'jb', 0),
(18, 'Yann', 'Penven', 'F', 'yannpenven@gmail.com', 'lili', 0),
(19, 'Gaëtan', 'Jacquemin', 'H', 'gaetan.jacquemin@gmail.com', 'choco39', 0),
(21, 'Axel', 'Le Bot', 'H', 'axellebot@orange.fr', 'axel', 0),
(22, 'g', 'g', 'H', 'p1408263@ffa.c', 'o', 0),
(23, 'Emeline', 'Thelliez', 'F', 'emeline@fr', 'test', 0),
(24, 'Un', 'tru', 'H', 'untru@gmail.com', '1234', 0),
(25, 'random', 'test', 'H', 'random@test', 'test', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
