-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 11 sep. 2022 à 20:45
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `villagegreensf`
--
CREATE DATABASE IF NOT EXISTS `villagegreensf` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `villagegreensf`;

-- --------------------------------------------------------

--
-- Structure de la table `approvisionner`
--

DROP TABLE IF EXISTS `approvisionner`;
CREATE TABLE `approvisionner` (
  `id` int(11) NOT NULL,
  `fournisseurs_id` int(11) DEFAULT NULL,
  `produits_id` int(11) DEFAULT NULL,
  `prix_achat` int(11) NOT NULL,
  `date_commande` date DEFAULT NULL,
  `date_liv` date DEFAULT NULL,
  `qtite` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONS POUR LA TABLE `approvisionner`:
--   `fournisseurs_id`
--       `fournisseur` -> `id`
--   `produits_id`
--       `produit` -> `id`
--

--
-- Déchargement des données de la table `approvisionner`
--

INSERT INTO `approvisionner` (`id`, `fournisseurs_id`, `produits_id`, `prix_achat`, `date_commande`, `date_liv`, `qtite`) VALUES
(1, 1, 1, 27000, '2022-05-16', '2022-05-16', 200);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONS POUR LA TABLE `categorie`:
--

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id`, `nom`, `description`, `photos`) VALUES
(1, 'Batterie', 'Viens jouer de la baguette!', 'CATEGORIES Batterie.png'),
(2, 'Cases', 'Des caissons à n\'en plus finir', 'CATEGORIES Cases.png'),
(3, 'Cordes', 'Viens gratter de la corde', 'CATEGORIES Cordes.png'),
(4, 'Studio', 'Parfait pour la futur nouvelle star', 'CATEGORIES Studio.png'),
(5, 'Claviers', 'Joue ton meilleur \\\"Harry potter thème\\\"', 'CATEGORIES Claviers.png'),
(6, 'Vents', 'Souffle aussi fort que le loup', 'CATEGORIES Vents.png'),
(7, 'Sono', 'David ? c\'est toi ?', 'CATEGORIES Sono.png'),
(8, 'Cables', 'Pour en finir avec le pétage de cables !', 'CATEGORIES Cable.png');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE `client` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `raison` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `genre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONS POUR LA TABLE `client`:
--

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`id`, `nom`, `prenom`, `raison`, `adresse`, `ville`, `cp`, `tel`, `genre`) VALUES
(1, '', '', 'GUITARLAND', '145 Rue des poins levés', 'Amiens', '80000', '0322457815', ''),
(2, '', '', 'WOODSTOCK', '105 bd vaucluse', 'Beauvais', '60000', '0345781236', ''),
(3, '', '', 'LOCAVIOLON', '10 allée de l\'ecce tarre', 'Reims', '51100', '0163985247', ''),
(4, 'user', 'Jean', '', '18 Quai des Orfèvres', 'Paris', '75001', '0582937145', 'Mme'),
(5, 'admin', 'admin', NULL, NULL, NULL, NULL, NULL, 'M'),
(6, 'sth', 'elyse', NULL, NULL, NULL, NULL, NULL, 'M.');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE `commande` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `livraison_id` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `reduc` int(11) DEFAULT NULL,
  `prix_tot` decimal(10,2) DEFAULT NULL,
  `date_reglem` date DEFAULT NULL,
  `date_fact` date DEFAULT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse_livraison` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville_livraison` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_livraison` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse_facturation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville_facturation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp_facturation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONS POUR LA TABLE `commande`:
--   `client_id`
--       `client` -> `id`
--   `livraison_id`
--       `livraison` -> `id`
--

--
-- Déchargement des données de la table `commande`
--

INSERT INTO `commande` (`id`, `client_id`, `livraison_id`, `date`, `reduc`, `prix_tot`, `date_reglem`, `date_fact`, `etat`, `adresse_livraison`, `ville_livraison`, `cp_livraison`, `adresse_facturation`, `ville_facturation`, `cp_facturation`) VALUES
(1, 4, 1, '2022-05-20', NULL, '2867.55', '2022-07-26', '2022-05-20', '75001', '18 Quai des Orfèvres', 'Paris', '75001', '18 Quai des Orfèvres', 'Paris', '75001');

-- --------------------------------------------------------

--
-- Structure de la table `commercial`
--

DROP TABLE IF EXISTS `commercial`;
CREATE TABLE `commercial` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONS POUR LA TABLE `commercial`:
--   `client_id`
--       `client` -> `id`
--

--
-- Déchargement des données de la table `commercial`
--

INSERT INTO `commercial` (`id`, `client_id`, `nom`, `prenom`, `tel`) VALUES
(1, 1, 'BERNARD', 'Thomas', '0345725145'),
(2, 2, 'MAGNOLIA', 'Orphée', '0645781236'),
(3, 3, 'WATIN', 'Sylvain', '0322568974');

-- --------------------------------------------------------

--
-- Structure de la table `contenir`
--

DROP TABLE IF EXISTS `contenir`;
CREATE TABLE `contenir` (
  `id` int(11) NOT NULL,
  `produits_id` int(11) DEFAULT NULL,
  `commande_id` int(11) NOT NULL,
  `qtite_commande` int(11) NOT NULL,
  `prix_vente` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONS POUR LA TABLE `contenir`:
--   `commande_id`
--       `commande` -> `id`
--   `produits_id`
--       `produit` -> `id`
--

--
-- Déchargement des données de la table `contenir`
--

INSERT INTO `contenir` (`id`, `produits_id`, `commande_id`, `qtite_commande`, `prix_vente`) VALUES
(1, 1, 1, 2, '656.00'),
(2, 2, 1, 4, '98.00'),
(3, 3, 1, 1, '429.00'),
(4, 5, 1, 1, '598.00');

-- --------------------------------------------------------

--
-- Structure de la table `envoyer`
--

DROP TABLE IF EXISTS `envoyer`;
CREATE TABLE `envoyer` (
  `id` int(11) NOT NULL,
  `produits_id` int(11) DEFAULT NULL,
  `livraison_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONS POUR LA TABLE `envoyer`:
--   `livraison_id`
--       `livraison` -> `id`
--   `produits_id`
--       `produit` -> `id`
--

--
-- Déchargement des données de la table `envoyer`
--

INSERT INTO `envoyer` (`id`, `produits_id`, `livraison_id`) VALUES
(1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
CREATE TABLE `fournisseur` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `raison` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ville` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tel` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_prenom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONS POUR LA TABLE `fournisseur`:
--

--
-- Déchargement des données de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`, `prenom`, `raison`, `adresse`, `ville`, `cp`, `tel`, `contact_nom`, `contact_prenom`) VALUES
(1, 'Armozo', 'Galotino', 'ARMOZO', '06 rue laymes', 'Paris', '75003', '0173481178', 'Vermesh', 'Salome'),
(2, 'Bolies', 'Paul', 'Aarpège', '63 bd marguerite levant', 'Paris', '75009', '0785898682', 'DUPONT', 'François');

-- --------------------------------------------------------

--
-- Structure de la table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
CREATE TABLE `livraison` (
  `id` int(11) NOT NULL,
  `num_bon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date DEFAULT NULL,
  `etat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONS POUR LA TABLE `livraison`:
--

--
-- Déchargement des données de la table `livraison`
--

INSERT INTO `livraison` (`id`, `num_bon`, `date`, `etat`) VALUES
(1, '1', '2022-05-16', 'en préparation');

-- --------------------------------------------------------

--
-- Structure de la table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONS POUR LA TABLE `messenger_messages`:
--

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE `produit` (
  `id` int(11) NOT NULL,
  `souscategorie_id` int(11) NOT NULL,
  `caracteristiques` tinytext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `prixht` decimal(10,2) DEFAULT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONS POUR LA TABLE `produit`:
--   `souscategorie_id`
--       `sous_categorie` -> `id`
--

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `souscategorie_id`, `caracteristiques`, `nom`, `photo`, `stock`, `prixht`, `description`) VALUES
(1, 1, NULL, 'Guitare C-40', 'C-40.jpeg', 25, '139.00', 'Yamaha c-40 Guitare Classique'),
(2, 17, NULL, 'Trombone SSL-45', 'SSL-45.jpg', 17, '138.00', 'Startone SSL-45 Bb-Tenor Trombone'),
(3, 15, NULL, 'Piano P-45', 'P-45.jpg', 10, '429.00', 'Yamaha P-45 Piano numérique'),
(4, 13, NULL, 'Table mixage analogique X1204', 'X1204.jpg', 5, '179.00', 'Behringer Xenyx X1204 USB Table de mixage'),
(5, 7, NULL, 'Millenium Focus 22 Drum Set Black', 'Batterie22.jpeg', 2, '258.00', 'Batterie Acoustique Millenium Focus 22 Drum Set Black'),
(6, 10, NULL, 'Etui rigide Thomann E-Guitar Case ABS', 'Etuiguitarelec.jpg', 25, '66.00', 'Thomann E-Guitar Case ABS'),
(7, 9, NULL, 'Housse Thomann Stage Piano Bag', 'houssepiano.jpg', 25, '45.00', 'Thomann Stage Piano Bag'),
(8, 18, NULL, 'Sono caisson HK Audio Sonar 115 Sub D', 'Sonocaissonbasse.jpg', 13, '656.00', 'HK Audio Sonar 115 Sub D');

-- --------------------------------------------------------

--
-- Structure de la table `sous_categorie`
--

DROP TABLE IF EXISTS `sous_categorie`;
CREATE TABLE `sous_categorie` (
  `id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONS POUR LA TABLE `sous_categorie`:
--   `categorie_id`
--       `categorie` -> `id`
--

--
-- Déchargement des données de la table `sous_categorie`
--

INSERT INTO `sous_categorie` (`id`, `categorie_id`, `nom`, `description`, `photos`) VALUES
(1, 3, 'Guitares Electriques', '', 'Guitare_electrique.png'),
(2, 3, 'Guitares Acoustiques', '', 'Guitare_acoustique.png'),
(3, 3, 'Guitares Electro Acoustiques', '', 'Guitare_electro_acoustique.png'),
(4, 3, 'Basses Electriques', '', 'Basse_electrique.png'),
(5, 3, 'Basses Acoustiques', '', 'Basse_acoustique.png'),
(6, 1, 'Ma sous catégorie modifiée', 'Un jolie description de notre sous catégorie', 'Ukulele.png'),
(7, 1, 'Batteries Acoustiques', '', 'Batterie_Acoustique.png'),
(8, 1, 'Bateries Electroniques', '', 'Batterie_Electronique.png'),
(9, 2, 'Housses', '', 'Housses.png'),
(10, 2, 'Flight Cases', '', 'Rigide.png'),
(11, 2, 'Etuis Rigide', '', 'Etuis_rigide.png'),
(12, 4, 'Micro     ', 'Prise de son', 'Micro.png'),
(13, 4, 'Mixage', 'Table de mixage', 'Mixage.png'),
(14, 5, 'Pianos à queues', '', 'Piano_a_queue.png'),
(15, 5, 'Pianos synthétiseurs', '', 'Piano_synthetiseur.png'),
(16, 6, 'Saxophones', '', 'Saxo.png'),
(17, 6, 'Trombones', '', 'Trombonne.png'),
(18, 7, 'Caissons de basses', '', 'Caisson_basse.png'),
(19, 7, 'Ampli à guitare', '', 'Ampli.png'),
(20, 8, 'Câbles pour instruments', NULL, 'Cable_instru.png'),
(21, 8, 'Câbles pour microphones', NULL, 'Cable_micro.png'),
(22, 8, 'Câbles MIDI', NULL, 'Cable_mdi.png');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_verified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELATIONS POUR LA TABLE `user`:
--   `client_id`
--       `client` -> `id`
--

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `client_id`, `email`, `roles`, `password`, `is_verified`) VALUES
(1, 1, 'user@user', '[]', '$2y$13$aCy/6xmFVHV9EKQ4Q364Ze67amSvMvqLKqzY66H5h2zXEZaMxUK.W', 1),
(2, 2, 'admin@admin', '[\"ROLE_ADMIN\"]', '$2y$13$q2ccX5xB/XWFJR9yApur0uCDziJTA12UIUwRuFD9AQLahPJFcEiMW', 0),
(3, 6, 'elyse94@gmail.com', '[]', '$2y$13$Quvnhgp2I9Rsjr7cYbkexODAagk3a/HLXtIXyyeTUsW.jThoUOhUa', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `approvisionner`
--
ALTER TABLE `approvisionner`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_4240C2B827ACDDFD` (`fournisseurs_id`),
  ADD KEY `IDX_4240C2B8CD11A2CF` (`produits_id`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_6EEAA67D19EB6921` (`client_id`),
  ADD KEY `IDX_6EEAA67D8E54FB25` (`livraison_id`);

--
-- Index pour la table `commercial`
--
ALTER TABLE `commercial`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_7653F3AE19EB6921` (`client_id`);

--
-- Index pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_3C914DFDCD11A2CF` (`produits_id`),
  ADD KEY `IDX_3C914DFD82EA2E54` (`commande_id`);

--
-- Index pour la table `envoyer`
--
ALTER TABLE `envoyer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_9E6AFC01CD11A2CF` (`produits_id`),
  ADD KEY `IDX_9E6AFC018E54FB25` (`livraison_id`);

--
-- Index pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `livraison`
--
ALTER TABLE `livraison`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Index pour la table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_29A5EC27A27126E0` (`souscategorie_id`);

--
-- Index pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_52743D7BBCF5E72D` (`categorie_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`),
  ADD KEY `IDX_8D93D64919EB6921` (`client_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `approvisionner`
--
ALTER TABLE `approvisionner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `commercial`
--
ALTER TABLE `commercial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `contenir`
--
ALTER TABLE `contenir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `envoyer`
--
ALTER TABLE `envoyer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `fournisseur`
--
ALTER TABLE `fournisseur`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `livraison`
--
ALTER TABLE `livraison`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produit`
--
ALTER TABLE `produit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `approvisionner`
--
ALTER TABLE `approvisionner`
  ADD CONSTRAINT `FK_4240C2B827ACDDFD` FOREIGN KEY (`fournisseurs_id`) REFERENCES `fournisseur` (`id`),
  ADD CONSTRAINT `FK_4240C2B8CD11A2CF` FOREIGN KEY (`produits_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `FK_6EEAA67D19EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`),
  ADD CONSTRAINT `FK_6EEAA67D8E54FB25` FOREIGN KEY (`livraison_id`) REFERENCES `livraison` (`id`);

--
-- Contraintes pour la table `commercial`
--
ALTER TABLE `commercial`
  ADD CONSTRAINT `FK_7653F3AE19EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);

--
-- Contraintes pour la table `contenir`
--
ALTER TABLE `contenir`
  ADD CONSTRAINT `FK_3C914DFD82EA2E54` FOREIGN KEY (`commande_id`) REFERENCES `commande` (`id`),
  ADD CONSTRAINT `FK_3C914DFDCD11A2CF` FOREIGN KEY (`produits_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `envoyer`
--
ALTER TABLE `envoyer`
  ADD CONSTRAINT `FK_9E6AFC018E54FB25` FOREIGN KEY (`livraison_id`) REFERENCES `livraison` (`id`),
  ADD CONSTRAINT `FK_9E6AFC01CD11A2CF` FOREIGN KEY (`produits_id`) REFERENCES `produit` (`id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC27A27126E0` FOREIGN KEY (`souscategorie_id`) REFERENCES `sous_categorie` (`id`);

--
-- Contraintes pour la table `sous_categorie`
--
ALTER TABLE `sous_categorie`
  ADD CONSTRAINT `FK_52743D7BBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_8D93D64919EB6921` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
