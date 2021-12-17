-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : jeu. 16 déc. 2021 à 16:07
-- Version du serveur : 5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `article` text NOT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `id_categorie` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `titre`, `article`, `id_utilisateur`, `id_categorie`, `date`) VALUES
(1, 'Post-Self-Evident Poem', 'This poem was written too late\r\nto be included in the book.', NULL, 1, '2021-12-15 15:52:36'),
(2, 'Spontaneous Generation Poem', 'This one just happened.', 2, 3, '2021-12-15 16:11:42'),
(6, 'Self-Promotion Poem', 'This poem was written\r\nfor the sole purpose of\r\nself-promotion.\r\n\r\nI am not trying\r\nto say something important,\r\nor even interesting\r\nwith it;\r\nthe point is simply\r\nto say something,\r\nanything really.\r\n\r\nIt doesn’t concern me\r\nthat you like this poem\r\nprovided you talk about it,\r\nand when you do so\r\nthat you not neglect to mention\r\nthat I am the one\r\nwho wrote it.', NULL, 1, '2021-12-15 16:12:42'),
(17, 'Antisocial Media Poem', 'I refuse to tell you about it.', 5, 1, '2021-12-15 16:14:00'),
(18, 'Now with 25 % More Poetry Poem', 'As originally written,\r\nthis poem had only four lines.\r\n\r\nIn order to give readers\r\nmore perceived value for money\r\nI added this fifth verse.', NULL, 1, '2021-12-15 16:15:00'),
(19, 'Expired Poem', 'This one’s no good to read anymore.', 2, 1, '2021-12-15 16:18:49'),
(20, 'Surveillance Poem', 'This poem is being written\r\nin front of a surveillance camera.\r\n\r\nI dedicate it to the security professionals\r\nobserving me write it.', 2, 1, '2021-12-15 16:18:49'),
(21, 'Homeless Poem\r\n', 'If the sight of this poem troubles you\r\nor makes you feel uncomfortable in any way,\r\nyou can always try turning the page\r\nand pretending you never read it.', 2, 3, '2021-12-16 12:54:07');

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `nom` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'Poésie'),
(3, 'Essais');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE `commentaires` (
  `id` int(11) NOT NULL,
  `commentaire` varchar(1024) NOT NULL,
  `id_article` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES
(1, 'wsh', 1, NULL, '2021-12-03 12:55:11'),
(2, 'yo', 2, NULL, '2021-12-03 12:55:11'),
(5, 'wsh', 18, NULL, '2021-12-15 11:49:48'),
(6, 'ils sont trop cute', 18, NULL, '2021-12-15 11:50:36'),
(7, 'ils sont trop cute', 18, NULL, '2021-12-15 00:00:26'),
(8, 'superbe', 18, 5, '2021-12-15 02:47:27'),
(9, 'wahou.', 19, 5, '2021-12-16 11:43:31'),
(10, 'olala', 21, 6, '2021-12-16 00:35:35'),
(45, 'magnifique', 17, 6, '2021-12-16 02:52:58'),
(46, 'amazing', 2, 6, '2021-12-16 03:00:21');

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

CREATE TABLE `droits` (
  `id` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id`, `nom`) VALUES
(1, 'utilisateur'),
(42, 'modérateur'),
(1337, 'administrateur');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_droits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`, `id_droits`) VALUES
(2, 'boboya', 'bobo', 'bobo.lafripouille@aol.fr', 1),
(5, 'admin', '$2y$10$YF5BOEsSUL91Isa1isnLkecc1Zrp3.2SMGB0VTIx6wu5OSbO36/Ui', 'lowsco8@gmail.com', 1337),
(6, 'loloya', '$2y$10$ELyKPB3QHGeohQp.Z79e8uE6y56.VqZ6eYWotvL1WFXUxGb0mgYDK', 'lowsco8@gmail.com', 42);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id user` (`id_utilisateur`),
  ADD KEY `id cat` (`id_categorie`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_article` (`id_article`),
  ADD KEY `relationuser` (`id_utilisateur`);

--
-- Index pour la table `droits`
--
ALTER TABLE `droits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `commentaires`
--
ALTER TABLE `commentaires`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `id cat` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `id user` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `commentaires`
--
ALTER TABLE `commentaires`
  ADD CONSTRAINT `commentaires_ibfk_1` FOREIGN KEY (`id_article`) REFERENCES `articles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `relationuser` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
