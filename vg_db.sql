-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  Dim 19 mai 2019 à 03:22
-- Version du serveur :  10.1.38-MariaDB
-- Version de PHP :  7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `vg`
--

-- --------------------------------------------------------

--
-- Structure de la table `caracteres`
--

CREATE TABLE `caracteres` (
  `ID_CARACTERE` int(11) NOT NULL,
  `NOM_CARACTERE` varchar(100) NOT NULL,
  `TYPE_CARACTERE` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `caracteres`
--

INSERT INTO `caracteres` (`ID_CARACTERE`, `NOM_CARACTERE`, `TYPE_CARACTERE`) VALUES
(1, 'Longueur', 0),
(2, 'Largueur', 0),
(3, 'Forme', 1),
(4, 'Diamètre', 0),
(5, 'Couleur', 1),
(6, 'Poids', 0),
(7, 'Nombre de couleurs', 1),
(8, 'Taille', 0),
(9, 'Fil de la suture ventrale', 1),
(10, 'Assise d\'abscission', NULL),
(11, 'Type de limbe', NULL),
(12, 'Port', NULL),
(13, 'Couleur de la chair', NULL),
(14, 'Epaisseur', NULL),
(15, 'Couleur (avant maturité)', NULL),
(16, 'Couleur (à maturité)', NULL),
(17, 'Dépression pédonculaire', NULL),
(18, 'Longueur du sommet', NULL),
(19, 'Couleur de l\'aile', NULL),
(20, 'Intensité de la couleur verte', NULL),
(21, 'Couleur de l\'étendard', NULL),
(22, 'Acidité(%)', NULL),
(23, 'Fermeté (% de compression)', NULL),
(24, 'Densité', NULL),
(25, 'Présence', NULL),
(26, 'Rugosité', NULL),
(27, 'Forme générale en vue latérale', NULL),
(28, 'Présence de pigmentation anthocyanique', NULL),
(29, 'Indice de forme', NULL),
(30, 'Présence du col', NULL),
(31, 'Présence d\'une aréole', NULL),
(32, 'Ondulation du bord', NULL),
(33, 'Couleur verte', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `especes`
--

CREATE TABLE `especes` (
  `ID_ESPECE` int(11) NOT NULL,
  `NOM_ESPECE` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `especes`
--

INSERT INTO `especes` (`ID_ESPECE`, `NOM_ESPECE`) VALUES
(1, 'Poivron'),
(2, 'Haricot'),
(3, 'Tomate'),
(5, 'Orange'),
(6, 'Framboise');

-- --------------------------------------------------------

--
-- Structure de la table `niveau_expressions`
--

CREATE TABLE `niveau_expressions` (
  `ID_NIVEAU_EXPRESSION` int(11) NOT NULL,
  `NOM_NIVEAU_EXPRESSION` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `niveau_expressions`
--

INSERT INTO `niveau_expressions` (`ID_NIVEAU_EXPRESSION`, `NOM_NIVEAU_EXPRESSION`) VALUES
(1, 'A mesurer'),
(2, 'Deux'),
(3, 'Grande'),
(4, 'Présent'),
(5, 'Lancéolée'),
(6, 'Vert'),
(7, 'Ovale'),
(8, 'Absente'),
(9, 'Foncée'),
(10, 'Compléte'),
(11, 'Absent'),
(12, 'rouge foncée'),
(13, 'Dense'),
(14, 'Présentes'),
(15, 'Pourpre brunâtre'),
(16, 'Faible'),
(17, 'Demi retombant'),
(18, 'Bipenné'),
(19, 'Aplatie'),
(20, 'Petite'),
(21, 'Jaune'),
(22, 'Rouge'),
(23, 'Rose'),
(24, 'Blanche'),
(25, 'Blanc'),
(26, 'Moyenne'),
(27, 'Intermédiaire'),
(28, 'Retombant');

-- --------------------------------------------------------

--
-- Structure de la table `notations`
--

CREATE TABLE `notations` (
  `ID_NOTATION` int(11) NOT NULL,
  `ID_VARIETE` int(11) NOT NULL,
  `ID_ORGANE` int(11) NOT NULL,
  `ID_CARACTERE` int(11) NOT NULL,
  `ID_NIVEAU_EXPRESSION` int(11) NOT NULL,
  `NOTATION` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `notations`
--

INSERT INTO `notations` (`ID_NOTATION`, `ID_VARIETE`, `ID_ORGANE`, `ID_CARACTERE`, `ID_NIVEAU_EXPRESSION`, `NOTATION`) VALUES
(1, 1, 1, 1, 1, 15.56),
(2, 1, 1, 2, 1, 8.02),
(4, 1, 2, 1, 1, 20.82),
(5, 1, 2, 4, 1, 5.28),
(6, 1, 2, 5, 6, NULL),
(8, 2, 1, 2, 1, 6.78),
(9, 2, 1, 3, 5, NULL),
(10, 2, 2, 1, 1, 15.67),
(11, 2, 2, 4, 1, 4.87),
(12, 2, 2, 5, 6, NULL),
(16, 3, 4, 1, 1, 0.5),
(17, 3, 4, 6, 1, 0.29),
(19, 4, 5, 1, 1, 1.048),
(20, 4, 2, 4, 1, 7.18),
(21, 4, 2, 8, 3, NULL),
(23, 4, 2, 1, 1, 5.99),
(25, 2, 1, 1, 1, 34),
(26, 5, 7, 29, 1, 1.85),
(27, 5, 7, 2, 1, 5.45),
(28, 5, 7, 1, 1, 10.12),
(29, 5, 2, 1, 1, 10.42),
(30, 6, 7, 29, 1, 2.16),
(31, 6, 7, 1, 1, 10.26),
(32, 6, 7, 2, 1, 4.76),
(33, 6, 2, 2, 1, 9.32),
(34, 6, 2, 4, 1, 8.43),
(35, 6, 2, 31, 10, NULL),
(36, 6, 7, 33, 9, NULL),
(37, 6, 2, 30, 11, NULL),
(38, 6, 7, 32, 8, NULL),
(39, 7, 2, 1, 1, 2.03),
(40, 7, 2, 2, 1, 1.8),
(41, 7, 2, 29, 1, 1.12),
(42, 7, 2, 16, 12, NULL),
(43, 7, 1, 26, 16, NULL),
(44, 7, 9, 25, 14, NULL),
(45, 7, 9, 24, 13, NULL),
(46, 8, 2, 1, 1, 2.05),
(47, 8, 2, 2, 1, 1.78),
(48, 8, 2, 29, 1, 1.14),
(49, 8, 2, 16, 12, NULL),
(50, 8, 9, 25, 14, NULL),
(52, 8, 9, 24, 13, NULL),
(53, 8, 1, 26, 16, NULL),
(54, 9, 5, 1, 1, 0.63),
(55, 9, 2, 1, 1, 1.14),
(56, 9, 2, 4, 1, 1.05),
(57, 9, 2, 29, 1, 0.87),
(58, 9, 2, 13, 23, NULL),
(59, 9, 2, 16, 22, NULL),
(60, 9, 5, 10, 4, NULL),
(61, 9, 1, 11, 18, NULL),
(62, 9, 1, 12, 17, NULL),
(63, 10, 3, 1, 1, 22.64),
(64, 10, 3, 2, 1, 1.53),
(65, 10, 4, 1, 1, 0.76),
(66, 10, 4, 6, 1, 0.87),
(68, 10, 4, 7, 2, NULL),
(69, 10, 8, 21, 25, NULL),
(70, 10, 8, 19, 24, NULL),
(72, 3, 8, 19, 24, NULL),
(73, 3, 8, 21, 25, NULL),
(74, 3, 3, 1, 1, 14.22),
(75, 3, 3, 2, 1, 0.58),
(76, 3, 4, 7, 2, NULL),
(77, 4, 2, 29, 1, 0.81),
(78, 4, 5, 10, 4, NULL),
(79, 4, 1, 12, 17, NULL),
(80, 4, 1, 11, 18, NULL),
(81, 9, 2, 8, 20, NULL),
(82, 4, 2, 16, 22, NULL),
(83, 4, 2, 13, 23, NULL),
(84, 5, 2, 29, 1, 1.01),
(85, 5, 2, 30, 4, NULL),
(86, 5, 2, 31, 10, NULL),
(87, 5, 7, 32, 27, NULL),
(88, 5, 7, 33, 9, NULL),
(89, 2, 2, 29, 1, 2.87),
(90, 2, 5, 12, 28, NULL),
(91, 1, 5, 12, 28, NULL),
(92, 1, 2, 29, 1, 3.99),
(93, 11, 1, 1, 1, 15.91),
(94, 11, 1, 2, 1, 6.89),
(95, 11, 1, 3, 5, NULL),
(96, 11, 2, 1, 1, 15.78),
(97, 11, 2, 4, 1, 5.5),
(98, 11, 2, 29, 1, 2.9),
(101, 11, 2, 5, 6, NULL),
(102, 11, 5, 12, 27, NULL),
(103, 12, 3, 1, 1, 23.96),
(104, 12, 3, 2, 1, 1.81),
(105, 12, 4, 1, 1, 0.89),
(106, 12, 4, 6, 1, 1.08),
(107, 12, 4, 7, 2, NULL),
(108, 12, 8, 21, 25, NULL),
(109, 12, 8, 19, 24, NULL),
(110, 13, 1, 11, 18, NULL),
(111, 13, 1, 12, 17, NULL),
(112, 13, 2, 1, 1, 1.98),
(113, 13, 2, 4, 1, 1.21),
(114, 13, 2, 29, 1, 1.12),
(115, 13, 2, 13, 23, NULL),
(116, 13, 2, 16, 22, NULL),
(117, 13, 2, 8, 20, NULL),
(118, 13, 5, 1, 1, 0.52),
(119, 13, 5, 10, 4, NULL),
(120, 14, 1, 26, 26, NULL),
(121, 14, 2, 1, 1, 2.34),
(122, 14, 2, 2, 1, 1.89),
(123, 14, 2, 29, 1, 1.23),
(124, 14, 2, 16, 12, NULL),
(125, 14, 9, 25, 14, NULL),
(126, 14, 9, 24, 13, NULL),
(127, 15, 2, 1, 1, 9.2),
(128, 15, 2, 29, 1, 1.04),
(129, 15, 2, 4, 1, 8.29),
(132, 15, 2, 30, 11, NULL),
(133, 15, 2, 31, 11, NULL),
(134, 15, 7, 1, 1, 10.14),
(135, 15, 7, 2, 1, 4.72),
(136, 15, 7, 29, 1, 2.17),
(137, 15, 7, 32, 8, NULL),
(138, 15, 7, 33, 9, NULL),
(139, 6, 2, 29, 1, 1.01),
(140, 5, 2, 4, 1, 9.14),
(141, 1, 1, 3, 5, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `organes`
--

CREATE TABLE `organes` (
  `ID_ORGANE` int(11) NOT NULL,
  `NOM_ORGANE` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `organes`
--

INSERT INTO `organes` (`ID_ORGANE`, `NOM_ORGANE`) VALUES
(1, 'Feuille'),
(2, 'Fruit'),
(3, 'Gousse'),
(4, 'Grain'),
(5, 'Pédoncule'),
(6, 'Arbre'),
(7, 'Limbe'),
(8, 'Fleur'),
(9, 'Epines');

-- --------------------------------------------------------

--
-- Structure de la table `pathotypes`
--

CREATE TABLE `pathotypes` (
  `ID_PATHOTYPE` int(11) NOT NULL,
  `NOM_PATHOTYPE` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `resistances`
--

CREATE TABLE `resistances` (
  `ID_RESISTANCE` int(11) NOT NULL,
  `ID_VARIETE` int(11) NOT NULL,
  `ID_PATHOTYPE` int(11) NOT NULL,
  `NOM_RESISTANCE` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `ID_UTILISATEUR` int(11) NOT NULL,
  `IDENTIFIANT` varchar(100) NOT NULL,
  `MOT_DE_PASSE` varchar(100) NOT NULL,
  `NOM` varchar(100) NOT NULL,
  `PRENOM` varchar(100) NOT NULL,
  `TYPE_COMPTE` varchar(100) NOT NULL,
  `IMAGE_UTILISATEUR` varchar(300) NOT NULL,
  `DATE_INSCRIPTION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`ID_UTILISATEUR`, `IDENTIFIANT`, `MOT_DE_PASSE`, `NOM`, `PRENOM`, `TYPE_COMPTE`, `IMAGE_UTILISATEUR`, `DATE_INSCRIPTION`) VALUES
(1, 'admin1', '123', 'Boudouch', 'Mustapha', 'admin', 'avatar.jpg', '2019-01-18 16:35:30'),
(2, 'corrector1', '123', 'Majjad', 'Mustafa', 'correcteur', 'avatar.jpg', '2019-02-08 16:37:15'),
(5, 'user1', '123', 'Boutaib', 'Ahmed', 'utilisateur', 'avatar.jpg', '2019-02-01 16:35:59'),
(6, 'author1', '123', 'Rafi', 'Amal', 'auteur', 'avatar.jpg', '2019-01-28 16:36:51'),
(7, 'author2', '123', 'Hadi', 'Mouad', 'auteur', 'avatar.jpg', '2019-01-08 18:00:46'),
(8, 'author3', '123', 'Nasri', 'Fatima', 'auteur', 'avatar.jpg', '2019-03-02 18:00:47'),
(9, 'author4', '123', 'Amine', 'Mohammed', 'auteur', 'avatar.jpg', '2019-02-02 18:02:16'),
(10, 'author5', '123', 'zora', 'Anouar', 'auteur', 'avatar.jpg', '2019-01-10 18:03:10');

-- --------------------------------------------------------

--
-- Structure de la table `varietes`
--

CREATE TABLE `varietes` (
  `ID_VARIETE` int(11) NOT NULL,
  `ID_ESPECE` int(11) NOT NULL,
  `ID_UTILISATEUR` int(11) NOT NULL,
  `NOM_VARIETE` varchar(100) NOT NULL,
  `IMAGE_VARIETE` varchar(200) DEFAULT NULL,
  `ETAT_VARIETE` tinyint(1) NOT NULL,
  `DATE_CREATION` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `varietes`
--

INSERT INTO `varietes` (`ID_VARIETE`, `ID_ESPECE`, `ID_UTILISATEUR`, `NOM_VARIETE`, `IMAGE_VARIETE`, `ETAT_VARIETE`, `DATE_CREATION`) VALUES
(1, 1, 6, 'Coach', 'poivron-coach.jpg', 1, '2019-02-14 20:29:30'),
(2, 1, 6, 'Marconi', 'marconi.jpg', 1, '2019-03-14 20:24:39'),
(3, 2, 7, 'Salamanca', 'haricots-verts-fins.jpg', 1, '2019-05-19 00:14:10'),
(4, 3, 8, 'Calvi', 'Tomate-calvi.jpg', 1, '2018-12-31 23:14:10'),
(5, 5, 8, 'Navel Lane Late', '_09_05_42_18_05_2019_navel_lane_late.jpg', 1, '2019-02-18 23:14:10'),
(6, 5, 7, 'Washington Navel', '_09_05_54_18_05_2019_washingto_navel.jpg', 0, '2019-04-18 23:14:10'),
(7, 6, 10, 'Cardinal', '10662426.jpg', 0, '0000-00-00 00:00:00'),
(8, 6, 9, 'Sévillana', 'framboisier-vsevillana.jpg', 1, '2019-03-07 23:14:10'),
(9, 3, 7, 'Génio', 'tomate-genio.jpg', 1, '2018-12-31 23:14:10'),
(10, 2, 6, 'Faiza', 'fiche-techniqe-haricot-vert-660x330.jpg', 1, '2019-03-02 23:08:06'),
(11, 1, 9, 'Kapia', 'Poivron-kapia.jpg', 1, '2019-04-30 23:14:10'),
(12, 2, 10, 'Estiphania', 'haricot-estiphania.jpg', 1, '2019-04-03 23:14:10'),
(13, 3, 9, 'Angel', 'angel_tomate.jpg', 1, '2019-03-10 23:14:10'),
(14, 6, 6, 'Rivira', 'gurney-s-fruit-trees-plants-79433-64_1000.jpg', 1, '2019-04-30 23:07:34'),
(15, 5, 10, 'Washington Sanguine', 'Washington_sanguine.jpg', 1, '2019-01-27 23:14:10');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `caracteres`
--
ALTER TABLE `caracteres`
  ADD PRIMARY KEY (`ID_CARACTERE`);

--
-- Index pour la table `especes`
--
ALTER TABLE `especes`
  ADD PRIMARY KEY (`ID_ESPECE`);

--
-- Index pour la table `niveau_expressions`
--
ALTER TABLE `niveau_expressions`
  ADD PRIMARY KEY (`ID_NIVEAU_EXPRESSION`);

--
-- Index pour la table `notations`
--
ALTER TABLE `notations`
  ADD PRIMARY KEY (`ID_NOTATION`),
  ADD KEY `FK_NOTATION_CARACTISE_CARACTER` (`ID_CARACTERE`),
  ADD KEY `FK_NOTATION_DECRIRE_ORGANE` (`ID_ORGANE`),
  ADD KEY `FK_NOTATION_DEFINIR_VARIETE` (`ID_VARIETE`),
  ADD KEY `FK_NOTATION_MESURER_NIVEAUEX` (`ID_NIVEAU_EXPRESSION`);

--
-- Index pour la table `organes`
--
ALTER TABLE `organes`
  ADD PRIMARY KEY (`ID_ORGANE`);

--
-- Index pour la table `pathotypes`
--
ALTER TABLE `pathotypes`
  ADD PRIMARY KEY (`ID_PATHOTYPE`);

--
-- Index pour la table `resistances`
--
ALTER TABLE `resistances`
  ADD PRIMARY KEY (`ID_RESISTANCE`),
  ADD KEY `FK_RESISTAN_INFECTER_PATHOTYP` (`ID_PATHOTYPE`),
  ADD KEY `FK_RESISTAN_RESISTER_VARIETE` (`ID_VARIETE`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`ID_UTILISATEUR`);

--
-- Index pour la table `varietes`
--
ALTER TABLE `varietes`
  ADD PRIMARY KEY (`ID_VARIETE`),
  ADD KEY `FK_VARIETE_APPARTENI_ESPECE` (`ID_ESPECE`),
  ADD KEY `FK_VARIETE_CREER_PAR_UTILISAT` (`ID_UTILISATEUR`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `caracteres`
--
ALTER TABLE `caracteres`
  MODIFY `ID_CARACTERE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `especes`
--
ALTER TABLE `especes`
  MODIFY `ID_ESPECE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `niveau_expressions`
--
ALTER TABLE `niveau_expressions`
  MODIFY `ID_NIVEAU_EXPRESSION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `notations`
--
ALTER TABLE `notations`
  MODIFY `ID_NOTATION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT pour la table `organes`
--
ALTER TABLE `organes`
  MODIFY `ID_ORGANE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `pathotypes`
--
ALTER TABLE `pathotypes`
  MODIFY `ID_PATHOTYPE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `resistances`
--
ALTER TABLE `resistances`
  MODIFY `ID_RESISTANCE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `ID_UTILISATEUR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `varietes`
--
ALTER TABLE `varietes`
  MODIFY `ID_VARIETE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `notations`
--
ALTER TABLE `notations`
  ADD CONSTRAINT `FK_NOTATION_CARACTISE_CARACTER` FOREIGN KEY (`ID_CARACTERE`) REFERENCES `caracteres` (`ID_CARACTERE`),
  ADD CONSTRAINT `FK_NOTATION_DECRIRE_ORGANE` FOREIGN KEY (`ID_ORGANE`) REFERENCES `organes` (`ID_ORGANE`),
  ADD CONSTRAINT `FK_NOTATION_DEFINIR_VARIETE` FOREIGN KEY (`ID_VARIETE`) REFERENCES `varietes` (`ID_VARIETE`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_NOTATION_MESURER_NIVEAUEX` FOREIGN KEY (`ID_NIVEAU_EXPRESSION`) REFERENCES `niveau_expressions` (`ID_NIVEAU_EXPRESSION`);

--
-- Contraintes pour la table `resistances`
--
ALTER TABLE `resistances`
  ADD CONSTRAINT `FK_RESISTAN_INFECTER_PATHOTYP` FOREIGN KEY (`ID_PATHOTYPE`) REFERENCES `pathotypes` (`ID_PATHOTYPE`),
  ADD CONSTRAINT `FK_RESISTAN_RESISTER_VARIETE` FOREIGN KEY (`ID_VARIETE`) REFERENCES `varietes` (`ID_VARIETE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `varietes`
--
ALTER TABLE `varietes`
  ADD CONSTRAINT `FK_VARIETE_APPARTENI_ESPECE` FOREIGN KEY (`ID_ESPECE`) REFERENCES `especes` (`ID_ESPECE`),
  ADD CONSTRAINT `FK_VARIETE_CREER_PAR_UTILISAT` FOREIGN KEY (`ID_UTILISATEUR`) REFERENCES `utilisateurs` (`ID_UTILISATEUR`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
