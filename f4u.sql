-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 04 Janvier 2016 à 09:36
-- Version du serveur :  5.6.15-log
-- Version de PHP :  5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `f4u`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

CREATE TABLE IF NOT EXISTS `administrateur` (
  `id_Personne` int(11) NOT NULL,
  PRIMARY KEY (`id_Personne`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `administrateur`
--

INSERT INTO `administrateur` (`id_Personne`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Structure de la table `avoir`
--

CREATE TABLE IF NOT EXISTS `avoir` (
  `id_Personne` int(11) NOT NULL,
  `id_Personne_PERSONNE` int(11) NOT NULL,
  PRIMARY KEY (`id_Personne`,`id_Personne_PERSONNE`),
  KEY `FK_AVOIR_id_Personne_PERSONNE` (`id_Personne_PERSONNE`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `choisir`
--

CREATE TABLE IF NOT EXISTS `choisir` (
  `id_Personne` int(11) NOT NULL,
  `id_Fourniture` int(11) NOT NULL,
  PRIMARY KEY (`id_Personne`,`id_Fourniture`),
  KEY `FK_CHOISIR_id_Fourniture` (`id_Fourniture`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE IF NOT EXISTS `contenir` (
  `Quantite` int(11) NOT NULL,
  `id_Liste` int(11) NOT NULL,
  `id_Fourniture` int(11) NOT NULL,
  PRIMARY KEY (`id_Liste`,`id_Fourniture`),
  KEY `FK_CONTENIR_id_Fourniture` (`id_Fourniture`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE IF NOT EXISTS `eleve` (
  `Classe` varchar(25) NOT NULL,
  `id_Personne` int(11) NOT NULL,
  `id_Liste` int(11) NOT NULL,
  PRIMARY KEY (`id_Personne`),
  KEY `FK_ELEVE_id_Liste` (`id_Liste`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `fourniture`
--

CREATE TABLE IF NOT EXISTS `fourniture` (
  `id_Fourniture` int(11) NOT NULL AUTO_INCREMENT,
  `Libelle` varchar(25) NOT NULL,
  PRIMARY KEY (`id_Fourniture`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `liste`
--

CREATE TABLE IF NOT EXISTS `liste` (
  `id_Liste` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_Liste`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `personne`
--

CREATE TABLE IF NOT EXISTS `personne` (
  `id_Personne` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(25) NOT NULL,
  `Prenom` varchar(25) NOT NULL,
  `login` varchar(25) NOT NULL,
  `mdp` varchar(25) NOT NULL,
  PRIMARY KEY (`id_Personne`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`id_Personne`, `Nom`, `Prenom`, `login`, `mdp`) VALUES
(1, 'EUSTACHE', 'Alvin', 'alvin.eustache@gmail.com', 'bitch'),
(2, 'TOYBA', 'Hamada', 'hamada.toyba@u-psud.fr', 'bitch2');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE IF NOT EXISTS `professeur` (
  `Matiere` varchar(25) NOT NULL,
  `id_Personne` int(11) NOT NULL,
  PRIMARY KEY (`id_Personne`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `FK_ADMINISTRATEUR_id_Personne` FOREIGN KEY (`id_Personne`) REFERENCES `personne` (`id_Personne`);

--
-- Contraintes pour la table `avoir`
--
ALTER TABLE `avoir`
  ADD CONSTRAINT `FK_AVOIR_id_Personne_PERSONNE` FOREIGN KEY (`id_Personne_PERSONNE`) REFERENCES `personne` (`id_Personne`),
  ADD CONSTRAINT `FK_AVOIR_id_Personne` FOREIGN KEY (`id_Personne`) REFERENCES `personne` (`id_Personne`);

--
-- Contraintes pour la table `choisir`
--
ALTER TABLE `choisir`
  ADD CONSTRAINT `FK_CHOISIR_id_Fourniture` FOREIGN KEY (`id_Fourniture`) REFERENCES `fourniture` (`id_Fourniture`),
  ADD CONSTRAINT `FK_CHOISIR_id_Personne` FOREIGN KEY (`id_Personne`) REFERENCES `personne` (`id_Personne`);

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `FK_CONTENIR_id_Fourniture` FOREIGN KEY (`id_Fourniture`) REFERENCES `fourniture` (`id_Fourniture`),
  ADD CONSTRAINT `FK_CONTENIR_id_Liste` FOREIGN KEY (`id_Liste`) REFERENCES `liste` (`id_Liste`);

--
-- Contraintes pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `FK_ELEVE_id_Liste` FOREIGN KEY (`id_Liste`) REFERENCES `liste` (`id_Liste`),
  ADD CONSTRAINT `FK_ELEVE_id_Personne` FOREIGN KEY (`id_Personne`) REFERENCES `personne` (`id_Personne`);

--
-- Contraintes pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD CONSTRAINT `FK_PROFESSEUR_id_Personne` FOREIGN KEY (`id_Personne`) REFERENCES `personne` (`id_Personne`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
