-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Dim 14 Février 2016 à 20:38
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
-- Structure de la table `choisir`
--

CREATE TABLE IF NOT EXISTS `choisir` (
  `id_Personne` int(11) NOT NULL,
  `id_Fourniture` int(11) NOT NULL,
  PRIMARY KEY (`id_Personne`,`id_Fourniture`),
  KEY `FK_CHOISIR_id_Fourniture` (`id_Fourniture`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `choisir`
--

INSERT INTO `choisir` (`id_Personne`, `id_Fourniture`) VALUES
(4, 11),
(4, 12),
(4, 13),
(4, 14),
(6, 15);

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE IF NOT EXISTS `classe` (
  `id_Classe` int(11) NOT NULL AUTO_INCREMENT,
  `Niveau` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id_Classe`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `classe`
--

INSERT INTO `classe` (`id_Classe`, `Niveau`) VALUES
(1, 'Seconde'),
(2, 'Premiere'),
(3, 'Terminale');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

CREATE TABLE IF NOT EXISTS `contenir` (
  `Quantite` int(11) NOT NULL,
  `id_Liste` int(11) NOT NULL DEFAULT '0',
  `id_Fourniture` int(11) NOT NULL,
  PRIMARY KEY (`id_Liste`,`id_Fourniture`),
  KEY `FK_CONTENIR_id_Fourniture` (`id_Fourniture`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `contenir`
--

INSERT INTO `contenir` (`Quantite`, `id_Liste`, `id_Fourniture`) VALUES
(2, 0, 11),
(1, 0, 12),
(3, 0, 13),
(3, 0, 14),
(2, 0, 15);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE IF NOT EXISTS `eleve` (
  `id_Personne` int(11) NOT NULL,
  `id_Liste` int(11) DEFAULT NULL,
  `id_Classe` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_Personne`),
  KEY `FK_ELEVE_id_Liste` (`id_Liste`),
  KEY `FK_ELEVE_id_Classe` (`id_Classe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `eleve`
--

INSERT INTO `eleve` (`id_Personne`, `id_Liste`, `id_Classe`) VALUES
(3, NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `est_prof`
--

CREATE TABLE IF NOT EXISTS `est_prof` (
  `id_Classe` int(11) NOT NULL,
  `id_Personne` int(11) NOT NULL,
  PRIMARY KEY (`id_Classe`,`id_Personne`),
  KEY `FK_EST_PROF_id_Personne` (`id_Personne`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `est_prof`
--

INSERT INTO `est_prof` (`id_Classe`, `id_Personne`) VALUES
(1, 4),
(1, 6);

-- --------------------------------------------------------

--
-- Structure de la table `fourniture`
--

CREATE TABLE IF NOT EXISTS `fourniture` (
  `id_Fourniture` int(11) NOT NULL AUTO_INCREMENT,
  `Libelle` varchar(25) NOT NULL,
  PRIMARY KEY (`id_Fourniture`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `fourniture`
--

INSERT INTO `fourniture` (`id_Fourniture`, `Libelle`) VALUES
(11, 'Testing'),
(12, 'Cahier petit carreau '),
(13, 'Test 3'),
(14, 'bitch'),
(15, 'testSecondProf');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `personne`
--

INSERT INTO `personne` (`id_Personne`, `Nom`, `Prenom`, `login`, `mdp`) VALUES
(1, 'EUSTACHE', 'Alvin', 'alvin.eustache@gmail.com', 'bitchtest'),
(2, 'TOYBA', 'Hamada', 'hamada.toyba@u-psud.fr', 'bitch2test'),
(3, 'eleve', 'test', 'eleve@test.com', 'testeleve'),
(4, 'prof', 'test', 'prof1@test.com', 'testprof'),
(5, 'prof2', 'test2', 'prof2@test.com', '0'),
(6, 'prof3', 'test3', 'prof3@test.com', 'prof3test3');

-- --------------------------------------------------------

--
-- Structure de la table `professeur`
--

CREATE TABLE IF NOT EXISTS `professeur` (
  `Matiere` varchar(25) DEFAULT NULL,
  `id_Personne` int(11) NOT NULL,
  PRIMARY KEY (`id_Personne`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `professeur`
--

INSERT INTO `professeur` (`Matiere`, `id_Personne`) VALUES
('mathematiques', 4),
(NULL, 5),
('francais', 6);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `administrateur`
--
ALTER TABLE `administrateur`
  ADD CONSTRAINT `FK_ADMINISTRATEUR_id_Personne` FOREIGN KEY (`id_Personne`) REFERENCES `personne` (`id_Personne`);

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
  ADD CONSTRAINT `FK_CONTENIR_id_Fourniture` FOREIGN KEY (`id_Fourniture`) REFERENCES `fourniture` (`id_Fourniture`);

--
-- Contraintes pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `FK_ELEVE_id_Classe` FOREIGN KEY (`id_Classe`) REFERENCES `classe` (`id_Classe`),
  ADD CONSTRAINT `FK_ELEVE_id_Liste` FOREIGN KEY (`id_Liste`) REFERENCES `liste` (`id_Liste`),
  ADD CONSTRAINT `FK_ELEVE_id_Personne` FOREIGN KEY (`id_Personne`) REFERENCES `personne` (`id_Personne`);

--
-- Contraintes pour la table `est_prof`
--
ALTER TABLE `est_prof`
  ADD CONSTRAINT `FK_EST_PROF_id_Classe` FOREIGN KEY (`id_Classe`) REFERENCES `classe` (`id_Classe`),
  ADD CONSTRAINT `FK_EST_PROF_id_Personne` FOREIGN KEY (`id_Personne`) REFERENCES `personne` (`id_Personne`);

--
-- Contraintes pour la table `professeur`
--
ALTER TABLE `professeur`
  ADD CONSTRAINT `FK_PROFESSEUR_id_Personne` FOREIGN KEY (`id_Personne`) REFERENCES `personne` (`id_Personne`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
