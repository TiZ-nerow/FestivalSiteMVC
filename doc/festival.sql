-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 04 nov. 2022 à 20:08
-- Version du serveur :  8.0.21
-- Version de PHP : 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `festival`
--

-- --------------------------------------------------------

--
-- Structure de la table `attribution`
--

DROP TABLE IF EXISTS `attribution`;
CREATE TABLE IF NOT EXISTS `attribution` (
  `idEtab` char(8) NOT NULL,
  `idGroupe` char(4) NOT NULL,
  `nombreChambres` int NOT NULL,
  PRIMARY KEY (`idEtab`,`idGroupe`),
  KEY `fk2_Attribution` (`idGroupe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `attribution`
--

INSERT INTO `attribution` (`idEtab`, `idGroupe`, `nombreChambres`) VALUES
('00000001', 'L001', 11),
('00000001', 'L002', 9),
('00000002', 'L003', 8),
('00000002', 'L004', 13),
('00000003', 'L001', 3),
('00000003', 'L006', 10),
('00000003', 'L007', 7);

-- --------------------------------------------------------

--
-- Structure de la table `etablissement`
--

DROP TABLE IF EXISTS `etablissement`;
CREATE TABLE IF NOT EXISTS `etablissement` (
  `id` char(8) NOT NULL,
  `nom` varchar(45) NOT NULL,
  `adresseRue` varchar(45) NOT NULL,
  `codePostal` char(5) NOT NULL,
  `ville` varchar(35) NOT NULL,
  `tel` varchar(13) NOT NULL,
  `adresseElectronique` varchar(70) DEFAULT NULL,
  `type` tinyint NOT NULL,
  `civiliteResponsable` varchar(12) NOT NULL,
  `nomResponsable` varchar(25) NOT NULL,
  `prenomResponsable` varchar(25) DEFAULT NULL,
  `nombreChambresOffertes` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `etablissement`
--

INSERT INTO `etablissement` (`id`, `nom`, `adresseRue`, `codePostal`, `ville`, `tel`, `adresseElectronique`, `type`, `civiliteResponsable`, `nomResponsable`, `prenomResponsable`, `nombreChambresOffertes`) VALUES
('00000001', 'College Montaigu', '1 rue du college', '54180', 'Heillecourt', '0355668945', NULL, 1, 'M.', 'Dupont', 'Alain', 20),
('00000002', 'College Louis Armand', '33 avenue de Barbois', '54000', 'Nancy', '0399561459', NULL, 1, 'Mme', 'Lefort', 'Anne', 58),
('00000003', 'College Albert Camus', '21 boulevard Joffre', '54000', 'Nancy', '0399117474', NULL, 1, 'M.', 'Durand', 'Pierre', 60),
('00000004', 'Centre de rencontres regional', '32 rue de Vandoeuvre', '54600', 'Villiers les Nancy', '0399000000', NULL, 0, 'M.', 'Guenroc', 'Guy', 200);

-- --------------------------------------------------------

--
-- Structure de la table `groupe`
--

DROP TABLE IF EXISTS `groupe`;
CREATE TABLE IF NOT EXISTS `groupe` (
  `id` char(4) NOT NULL,
  `nom` varchar(40) NOT NULL,
  `identiteResponsable` varchar(40) DEFAULT NULL,
  `adressePostale` varchar(120) DEFAULT NULL,
  `nombrePersonnes` int NOT NULL,
  `nomPays` varchar(40) NOT NULL,
  `hebergement` char(1) NOT NULL,
  `stand` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `groupe`
--

INSERT INTO `groupe` (`id`, `nom`, `identiteResponsable`, `adressePostale`, `nombrePersonnes`, `nomPays`, `hebergement`, `stand`) VALUES
('L001', 'Ligue Lorraine escrime', NULL, NULL, 40, 'France', 'O', NULL),
('L002', 'Ligue Lorraine football', NULL, NULL, 60, 'France', 'O', NULL),
('L003', 'Ligue Lorraine basketball', NULL, NULL, 32, 'France', 'O', 'teste'),
('L004', 'Ligue Lorraine babyfoot', NULL, NULL, 77, 'France', 'O', ''),
('L005', 'Ligue Lorraine tennis', NULL, NULL, 26, 'France', 'O', NULL),
('L006', 'Ligue Lorraine piscine', NULL, NULL, 53, 'France', 'O', NULL),
('L007', 'Ligue Lorraine baseball', NULL, NULL, 45, 'France', 'O', NULL);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `attribution`
--
ALTER TABLE `attribution`
  ADD CONSTRAINT `fk1_Attribution` FOREIGN KEY (`idEtab`) REFERENCES `etablissement` (`id`),
  ADD CONSTRAINT `fk2_Attribution` FOREIGN KEY (`idGroupe`) REFERENCES `groupe` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
