-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 21 mars 2021 à 16:35
-- Version du serveur :  8.0.22
-- Version de PHP : 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet2_parc_zoo`
--

-- --------------------------------------------------------

--
-- Structure de la table `amenager`
--

DROP TABLE IF EXISTS `amenager`;
CREATE TABLE IF NOT EXISTS `amenager` (
  `code_enclos` int NOT NULL,
  `id_profil_entretien` int NOT NULL,
  PRIMARY KEY (`code_enclos`,`id_profil_entretien`),
  KEY `id_profil_entretien` (`id_profil_entretien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `amenager`
--

INSERT INTO `amenager` (`code_enclos`, `id_profil_entretien`) VALUES
(1, 3),
(8, 3),
(5, 5),
(14, 5),
(2, 9),
(3, 9),
(4, 11),
(6, 11);

-- --------------------------------------------------------

--
-- Structure de la table `animal`
--

DROP TABLE IF EXISTS `animal`;
CREATE TABLE IF NOT EXISTS `animal` (
  `code_espece` int NOT NULL,
  `nomb_animal` varchar(10) NOT NULL,
  `sexe_animal` varchar(10) DEFAULT NULL,
  `dn_animal` date DEFAULT NULL,
  `dd_animal` date DEFAULT NULL,
  PRIMARY KEY (`code_espece`,`nomb_animal`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `animal`
--

INSERT INTO `animal` (`code_espece`, `nomb_animal`, `sexe_animal`, `dn_animal`, `dd_animal`) VALUES
(1, 'Léa', 'F', '2015-01-01', NULL),
(1, 'Leo', 'M', '2000-01-01', NULL),
(2, 'Marc', 'M', '2000-01-01', NULL),
(2, 'Sophie', 'F', '2005-01-01', NULL),
(3, 'Tigrou', 'M', '2010-01-01', NULL),
(4, 'Titi', 'F', '2015-01-01', NULL),
(5, 'Titi', 'F', '2020-01-01', NULL),
(6, 'Léon', 'M', '2018-01-01', NULL),
(7, 'Ota', 'F', '2015-01-01', NULL),
(7, 'Oto', 'M', '2016-01-01', NULL),
(8, 'Flipper', 'M', '2010-01-01', NULL),
(9, 'Fisher', 'M', '2019-01-01', NULL),
(9, 'Georges', 'M', '2019-01-01', NULL),
(10, 'Orsa', 'F', '2012-01-01', NULL),
(11, 'Zèbra', 'F', '2009-01-01', NULL),
(12, 'Pan', 'F', '2014-01-01', NULL),
(14, 'Pitchu', 'M', '2017-01-01', NULL),
(15, 'Aiglon', 'M', '2019-01-01', NULL),
(16, 'Croca', 'F', '2014-01-01', NULL),
(17, 'Babar', 'M', '2020-07-01', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cohabiter`
--

DROP TABLE IF EXISTS `cohabiter`;
CREATE TABLE IF NOT EXISTS `cohabiter` (
  `code_espece` int NOT NULL,
  `code_espece_1` int NOT NULL,
  PRIMARY KEY (`code_espece`,`code_espece_1`),
  KEY `code_espece_1` (`code_espece_1`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `cohabiter`
--

INSERT INTO `cohabiter` (`code_espece`, `code_espece_1`) VALUES
(3, 1),
(11, 2),
(1, 3),
(12, 4),
(14, 5),
(8, 7),
(7, 8),
(9, 8),
(12, 10),
(2, 11),
(4, 12),
(10, 12),
(13, 12),
(12, 13),
(5, 14);

-- --------------------------------------------------------

--
-- Structure de la table `enclos`
--

DROP TABLE IF EXISTS `enclos`;
CREATE TABLE IF NOT EXISTS `enclos` (
  `code_enclos` int NOT NULL AUTO_INCREMENT,
  `nom_enclos` varchar(50) DEFAULT NULL,
  `superficie_enclos` decimal(7,2) DEFAULT NULL,
  PRIMARY KEY (`code_enclos`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `enclos`
--

INSERT INTO `enclos` (`code_enclos`, `nom_enclos`, `superficie_enclos`) VALUES
(1, 'Savanne', '20000.00'),
(2, 'Voliere', '1000.00'),
(3, 'Fosse aux reptiles', '500.00'),
(4, 'Jungle', '2000.00'),
(5, 'Lac', '6000.00'),
(6, 'Forêt primaire', '10000.00'),
(8, 'Brousse', '10000.00'),
(14, 'Prairie', '80000.00');

-- --------------------------------------------------------

--
-- Structure de la table `espece`
--

DROP TABLE IF EXISTS `espece`;
CREATE TABLE IF NOT EXISTS `espece` (
  `code_espece` int NOT NULL AUTO_INCREMENT,
  `nom_espece` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`code_espece`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `espece`
--

INSERT INTO `espece` (`code_espece`, `nom_espece`) VALUES
(1, 'Lion d\'Afrique'),
(2, 'Girafe'),
(3, 'Tigre'),
(4, 'Ouistiti'),
(5, 'Canari'),
(6, 'Caméléon'),
(7, 'Otarie'),
(8, 'Dauphin'),
(9, 'Orque'),
(10, 'Ours des pyrennées'),
(11, 'Zèbre'),
(12, 'Panda'),
(13, 'Koala'),
(14, 'Perroquet'),
(15, 'Aigle'),
(16, 'Crocodile'),
(17, 'Eléphant');

-- --------------------------------------------------------

--
-- Structure de la table `habiter`
--

DROP TABLE IF EXISTS `habiter`;
CREATE TABLE IF NOT EXISTS `habiter` (
  `code_espece` int NOT NULL,
  `nomb_animal` varchar(10) NOT NULL,
  `date_debut` date NOT NULL,
  `encours` tinyint(1) DEFAULT NULL,
  `code_enclos` int NOT NULL,
  PRIMARY KEY (`code_espece`,`nomb_animal`,`date_debut`),
  KEY `code_enclos` (`code_enclos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `habiter`
--

INSERT INTO `habiter` (`code_espece`, `nomb_animal`, `date_debut`, `encours`, `code_enclos`) VALUES
(1, 'Leo', '2005-01-01', 1, 1),
(2, 'Sophie', '2010-01-01', 1, 1),
(4, 'Titi', '2017-01-01', 1, 6),
(5, 'Titi', '2020-01-01', 1, 2),
(6, 'Léon', '2018-01-01', 1, 3),
(8, 'Flipper', '2018-01-01', 1, 5),
(9, 'Fisher', '2020-01-01', 1, 5),
(11, 'Zèbra', '2010-01-01', 1, 14),
(12, 'Pan', '2015-01-01', 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `manger`
--

DROP TABLE IF EXISTS `manger`;
CREATE TABLE IF NOT EXISTS `manger` (
  `code_espece` int NOT NULL,
  `nomb_animal` varchar(10) NOT NULL,
  `dh_repas` datetime NOT NULL,
  `qte_distribuee` int DEFAULT NULL,
  `code_menu` int NOT NULL,
  PRIMARY KEY (`code_espece`,`nomb_animal`,`dh_repas`),
  KEY `code_menu` (`code_menu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `manger`
--

INSERT INTO `manger` (`code_espece`, `nomb_animal`, `dh_repas`, `qte_distribuee`, `code_menu`) VALUES
(1, 'Leo', '2021-03-01 12:30:00', 500, 1),
(2, 'Sophie', '2021-03-02 12:00:00', 1000, 2),
(5, 'Titi', '2021-03-03 20:00:00', 200, 3);

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `code_menu` int NOT NULL AUTO_INCREMENT,
  `libelle_menus` varchar(50) DEFAULT NULL,
  `qte_recommandee_menus` decimal(7,2) DEFAULT NULL,
  `code_espece` int NOT NULL,
  PRIMARY KEY (`code_menu`),
  KEY `code_espece` (`code_espece`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `menus`
--

INSERT INTO `menus` (`code_menu`, `libelle_menus`, `qte_recommandee_menus`, `code_espece`) VALUES
(1, 'viande crue', '500.00', 1),
(2, 'feuilles et herbes', '1000.00', 2),
(3, 'graines', '100.00', 5);

-- --------------------------------------------------------

--
-- Structure de la table `objet`
--

DROP TABLE IF EXISTS `objet`;
CREATE TABLE IF NOT EXISTS `objet` (
  `code_objet` int NOT NULL AUTO_INCREMENT,
  `nom_objet` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`code_objet`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `objet`
--

INSERT INTO `objet` (`code_objet`, `nom_objet`) VALUES
(1, 'Echelle de cordes'),
(2, 'Ballon'),
(3, 'Nichoir'),
(4, 'Bassin amovible'),
(5, 'Anneau'),
(6, 'Rondin de bois'),
(7, 'Liane'),
(8, 'Canne à pêche'),
(9, 'Baton');

-- --------------------------------------------------------

--
-- Structure de la table `objet_achete`
--

DROP TABLE IF EXISTS `objet_achete`;
CREATE TABLE IF NOT EXISTS `objet_achete` (
  `code_objet` int NOT NULL,
  PRIMARY KEY (`code_objet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `objet_achete`
--

INSERT INTO `objet_achete` (`code_objet`) VALUES
(4),
(5),
(6),
(7);

-- --------------------------------------------------------

--
-- Structure de la table `objet_prete`
--

DROP TABLE IF EXISTS `objet_prete`;
CREATE TABLE IF NOT EXISTS `objet_prete` (
  `code_objet` int NOT NULL,
  PRIMARY KEY (`code_objet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `objet_prete`
--

INSERT INTO `objet_prete` (`code_objet`) VALUES
(1),
(2),
(3),
(8),
(9);

-- --------------------------------------------------------

--
-- Structure de la table `parent`
--

DROP TABLE IF EXISTS `parent`;
CREATE TABLE IF NOT EXISTS `parent` (
  `a_pour_parent` int NOT NULL,
  `nomb_animal_a_pour_parent` varchar(10) NOT NULL,
  `a_pour_enfant` int NOT NULL,
  `nomb_animal_a_pour_enfant` varchar(10) NOT NULL,
  PRIMARY KEY (`a_pour_parent`,`nomb_animal_a_pour_parent`,`a_pour_enfant`,`nomb_animal_a_pour_enfant`),
  KEY `a_pour_enfant` (`a_pour_enfant`,`nomb_animal_a_pour_enfant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `present`
--

DROP TABLE IF EXISTS `present`;
CREATE TABLE IF NOT EXISTS `present` (
  `code_enclos` int NOT NULL,
  `code_objet` int NOT NULL,
  `qte_objet` int DEFAULT NULL,
  PRIMARY KEY (`code_enclos`,`code_objet`),
  KEY `code_objet` (`code_objet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `present`
--

INSERT INTO `present` (`code_enclos`, `code_objet`, `qte_objet`) VALUES
(2, 3, 30),
(3, 4, 10),
(4, 1, 50),
(5, 2, 40);

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

DROP TABLE IF EXISTS `profil`;
CREATE TABLE IF NOT EXISTS `profil` (
  `id_profil` int NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `mdp` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `adresse` varchar(255) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `role` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_profil`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `profil`
--

INSERT INTO `profil` (`id_profil`, `identifiant`, `mdp`, `nom`, `prenom`, `adresse`, `telephone`, `role`) VALUES
(1, 'admin', '$2y$10$d8Pk3UR94AmIdY7omf/pcOJ7RqXkn43WMgEbdngXCECpBVbjTd8J6', 'DUPONT', 'Yves', '1 rue des Arènes 49100 Angers', '0123456789', 'administrateur'),
(2, 's1', '$2y$10$8TMFehw2EgmoFgV2CVDMu.AeSS0TTkQg6mfKfc.ltS8OnKVJ/3mFC', 'FROGER', 'Isabelle', '1 rue de la Poste 49000 Angers', '0123456987', 'soignant'),
(3, 'e1', '$2y$10$FkPBHjyiaLqoAEy8PJNIIOKu8v8r.CO342WbpKoLuo/YuAsuvROZW', 'ROGER', 'Paul', '1 avenue Pasteur 49000 Angers', '0213456789', 'entretien'),
(4, 's2', '$2y$10$HldeYCj4oGnvG4Jq7OgoZuySRHVBE.IT3PX6NfcQJE/pcmBPbsABK', 'DURANT', 'Sylvain', '90 boulevard Saint Michel 49000 Angers', '0312456789', 'soignant'),
(5, 'e2', '$2y$10$ItPldLXEr6RY7bYKj3aBn.hC/BMJy7ISOyC/uFzy4IFWl0wRq0HHy', 'PROPRE', 'Camille', '1 rue Boreau 49000 Angers', '0412356789', 'entretien'),
(8, 's3', '$2y$10$2YEP5g1r9hVl8AIlyAibHefxuKDAlokGB62wqWXuWmSz7b4p5d3aW', 'MARTIN', 'Thierry', '1 Bd du Maréchal Foch 49000 Angers', '0512346789', 'soignant'),
(9, 'e3', '$2y$10$XNVSDfilA.MSA/BsliyYpeVMVd5m84FqyWz9xqi6PbNLrQzO9ikzO', 'VOISIN', 'Jacqueline', '1 rue de la Gare 49000 Angers', '0123456798', 'entretien'),
(10, 's4', '$2y$10$hvKAsehgUdadZWssZyBOy.KiSQIpzSO3ldZURDc8W9ifoAYeKw2q6', 'LABELLE', 'Zoé', '1 rue Toussaint 49000 Angers', '0123456879', 'soignant'),
(11, 'e4', '$2y$10$R/.f/D/.7nsNJ3aM4v.VheMoKR4kSLK3rvI8uEY6qJx2wnwrXQspC', 'SAPIN', 'Noël', '1 place du Château 49000 Angers', '0231456789', 'entretien');

-- --------------------------------------------------------

--
-- Structure de la table `specialiser`
--

DROP TABLE IF EXISTS `specialiser`;
CREATE TABLE IF NOT EXISTS `specialiser` (
  `code_espece` int NOT NULL,
  `id_profil_soignant` int NOT NULL,
  PRIMARY KEY (`code_espece`,`id_profil_soignant`),
  KEY `id_profil_soignant` (`id_profil_soignant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `specialiser`
--

INSERT INTO `specialiser` (`code_espece`, `id_profil_soignant`) VALUES
(1, 2),
(2, 2),
(5, 4),
(14, 4),
(6, 8),
(16, 8),
(8, 10),
(9, 10);

-- --------------------------------------------------------

--
-- Structure de la table `vivre`
--

DROP TABLE IF EXISTS `vivre`;
CREATE TABLE IF NOT EXISTS `vivre` (
  `code_espece` int NOT NULL,
  `code_enclos` int NOT NULL,
  PRIMARY KEY (`code_espece`,`code_enclos`),
  KEY `code_enclos` (`code_enclos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `vivre`
--

INSERT INTO `vivre` (`code_espece`, `code_enclos`) VALUES
(1, 1),
(2, 1),
(5, 2),
(6, 3),
(4, 4),
(3, 8);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `amenager`
--
ALTER TABLE `amenager`
  ADD CONSTRAINT `amenager_ibfk_1` FOREIGN KEY (`code_enclos`) REFERENCES `enclos` (`code_enclos`),
  ADD CONSTRAINT `amenager_ibfk_2` FOREIGN KEY (`id_profil_entretien`) REFERENCES `profil` (`id_profil`);

--
-- Contraintes pour la table `animal`
--
ALTER TABLE `animal`
  ADD CONSTRAINT `animal_ibfk_1` FOREIGN KEY (`code_espece`) REFERENCES `espece` (`code_espece`);

--
-- Contraintes pour la table `cohabiter`
--
ALTER TABLE `cohabiter`
  ADD CONSTRAINT `cohabiter_ibfk_1` FOREIGN KEY (`code_espece`) REFERENCES `espece` (`code_espece`),
  ADD CONSTRAINT `cohabiter_ibfk_2` FOREIGN KEY (`code_espece_1`) REFERENCES `espece` (`code_espece`);

--
-- Contraintes pour la table `habiter`
--
ALTER TABLE `habiter`
  ADD CONSTRAINT `habiter_ibfk_1` FOREIGN KEY (`code_espece`,`nomb_animal`) REFERENCES `animal` (`code_espece`, `nomb_animal`),
  ADD CONSTRAINT `habiter_ibfk_2` FOREIGN KEY (`code_enclos`) REFERENCES `enclos` (`code_enclos`);

--
-- Contraintes pour la table `manger`
--
ALTER TABLE `manger`
  ADD CONSTRAINT `manger_ibfk_1` FOREIGN KEY (`code_espece`,`nomb_animal`) REFERENCES `animal` (`code_espece`, `nomb_animal`),
  ADD CONSTRAINT `manger_ibfk_2` FOREIGN KEY (`code_menu`) REFERENCES `menus` (`code_menu`);

--
-- Contraintes pour la table `menus`
--
ALTER TABLE `menus`
  ADD CONSTRAINT `menus_ibfk_1` FOREIGN KEY (`code_espece`) REFERENCES `espece` (`code_espece`);

--
-- Contraintes pour la table `objet_achete`
--
ALTER TABLE `objet_achete`
  ADD CONSTRAINT `objet_achete_ibfk_1` FOREIGN KEY (`code_objet`) REFERENCES `objet` (`code_objet`);

--
-- Contraintes pour la table `objet_prete`
--
ALTER TABLE `objet_prete`
  ADD CONSTRAINT `objet_prete_ibfk_1` FOREIGN KEY (`code_objet`) REFERENCES `objet` (`code_objet`);

--
-- Contraintes pour la table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `parent_ibfk_1` FOREIGN KEY (`a_pour_parent`,`nomb_animal_a_pour_parent`) REFERENCES `animal` (`code_espece`, `nomb_animal`),
  ADD CONSTRAINT `parent_ibfk_2` FOREIGN KEY (`a_pour_enfant`,`nomb_animal_a_pour_enfant`) REFERENCES `animal` (`code_espece`, `nomb_animal`);

--
-- Contraintes pour la table `present`
--
ALTER TABLE `present`
  ADD CONSTRAINT `present_ibfk_1` FOREIGN KEY (`code_enclos`) REFERENCES `enclos` (`code_enclos`),
  ADD CONSTRAINT `present_ibfk_2` FOREIGN KEY (`code_objet`) REFERENCES `objet` (`code_objet`);

--
-- Contraintes pour la table `specialiser`
--
ALTER TABLE `specialiser`
  ADD CONSTRAINT `specialiser_ibfk_1` FOREIGN KEY (`code_espece`) REFERENCES `espece` (`code_espece`),
  ADD CONSTRAINT `specialiser_ibfk_2` FOREIGN KEY (`id_profil_soignant`) REFERENCES `profil` (`id_profil`);

--
-- Contraintes pour la table `vivre`
--
ALTER TABLE `vivre`
  ADD CONSTRAINT `vivre_ibfk_1` FOREIGN KEY (`code_espece`) REFERENCES `espece` (`code_espece`),
  ADD CONSTRAINT `vivre_ibfk_2` FOREIGN KEY (`code_enclos`) REFERENCES `enclos` (`code_enclos`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
