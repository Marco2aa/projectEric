-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : lun. 26 fév. 2024 à 08:18
-- Version du serveur : 11.2.3-MariaDB-1:11.2.3+maria~ubu2204
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `pizzeriadb`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id_client`, `nom`) VALUES
(11, 'Marco'),
(12, 'Eric'),
(13, 'Gabriel'),
(14, 'Mario'),
(15, 'Jean-Marc'),
(16, 'Silvio');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `dateCommande` datetime NOT NULL,
  `tableCommande` int(11) DEFAULT NULL,
  `id_client` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `dateCommande`, `tableCommande`, `id_client`) VALUES
(39, '2024-02-25 22:15:00', 10, 11),
(40, '2024-02-25 22:16:00', 14, 12),
(41, '2024-02-25 22:16:00', 7, 13),
(42, '2024-02-25 22:19:00', 8, 15),
(43, '2024-02-25 22:30:00', 12, 16);

-- --------------------------------------------------------

--
-- Structure de la table `ingredientPizza`
--

CREATE TABLE `ingredientPizza` (
  `quantite` int(11) DEFAULT NULL,
  `id_ingredient` int(11) NOT NULL,
  `id_pizza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `ingredientPizza`
--

INSERT INTO `ingredientPizza` (`quantite`, `id_ingredient`, `id_pizza`) VALUES
(100, 56, 98),
(80, 56, 99),
(100, 56, 100),
(50, 56, 103),
(250, 57, 98),
(250, 57, 99),
(250, 57, 100),
(200, 57, 103),
(100, 58, 98),
(100, 58, 99),
(100, 58, 100),
(50, 58, 103),
(100, 60, 99),
(100, 60, 100),
(100, 62, 100),
(125, 63, 98),
(50, 63, 103);

-- --------------------------------------------------------

--
-- Structure de la table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `calorie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `ingredients`
--

INSERT INTO `ingredients` (`id`, `nom`, `prix`, `calorie`) VALUES
(54, 'Ananas', 10.00, 5),
(55, 'Boeuf de kobe', 125.00, 7),
(56, 'Tomates', 10.00, 4),
(57, 'Pate à Pizza', 15.00, 8),
(58, 'Fromage', 20.00, 9),
(59, 'Anchois', 28.00, 7),
(60, 'Jambon', 25.00, 7),
(61, 'Oeuf', 12.00, 6),
(62, 'Crème fraiche', 10.00, 9),
(63, 'Chorizo', 25.00, 8);

-- --------------------------------------------------------

--
-- Structure de la table `pizza`
--

CREATE TABLE `pizza` (
  `id` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `pizza`
--

INSERT INTO `pizza` (`id`, `nom`, `prix`) VALUES
(98, 'Chorizo', 14.00),
(99, 'Reine', 12.00),
(100, 'Reine blanche', 13.00),
(103, 'Espagnole', 15.00);

-- --------------------------------------------------------

--
-- Structure de la table `pizzaCommande`
--

CREATE TABLE `pizzaCommande` (
  `id_pizza` int(11) NOT NULL,
  `id_commande` int(11) NOT NULL,
  `nombre` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Déchargement des données de la table `pizzaCommande`
--

INSERT INTO `pizzaCommande` (`id_pizza`, `id_commande`, `nombre`) VALUES
(98, 39, 1),
(98, 40, 5),
(98, 41, 2),
(98, 43, 1),
(99, 39, 1),
(99, 42, 15),
(99, 43, 1),
(100, 39, 1),
(100, 43, 1),
(103, 41, 2),
(103, 43, 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_commande_client` (`id_client`);

--
-- Index pour la table `ingredientPizza`
--
ALTER TABLE `ingredientPizza`
  ADD PRIMARY KEY (`id_ingredient`,`id_pizza`),
  ADD KEY `id_pizza` (`id_pizza`);

--
-- Index pour la table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pizza`
--
ALTER TABLE `pizza`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `pizzaCommande`
--
ALTER TABLE `pizzaCommande`
  ADD PRIMARY KEY (`id_pizza`,`id_commande`),
  ADD KEY `id_commande` (`id_commande`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT pour la table `pizza`
--
ALTER TABLE `pizza`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fk_commande_client` FOREIGN KEY (`id_client`) REFERENCES `client` (`id_client`);

--
-- Contraintes pour la table `ingredientPizza`
--
ALTER TABLE `ingredientPizza`
  ADD CONSTRAINT `ingredientPizza_ibfk_1` FOREIGN KEY (`id_ingredient`) REFERENCES `ingredients` (`id`),
  ADD CONSTRAINT `ingredientPizza_ibfk_2` FOREIGN KEY (`id_pizza`) REFERENCES `pizza` (`id`);

--
-- Contraintes pour la table `pizzaCommande`
--
ALTER TABLE `pizzaCommande`
  ADD CONSTRAINT `pizzaCommande_ibfk_1` FOREIGN KEY (`id_pizza`) REFERENCES `pizza` (`id`),
  ADD CONSTRAINT `pizzaCommande_ibfk_2` FOREIGN KEY (`id_commande`) REFERENCES `commande` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
