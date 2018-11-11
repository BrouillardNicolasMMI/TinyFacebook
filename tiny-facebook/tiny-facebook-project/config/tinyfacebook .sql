-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Ven 09 Novembre 2018 à 17:52
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `tinyfacebook`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `idAuteur` int(11) NOT NULL,
  `idComment` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `idLiked` tinyint(1) DEFAULT NULL,
  `datecom` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ecrit`
--

CREATE TABLE `ecrit` (
  `id` int(11) NOT NULL,
  `contenu` text,
  `dateEcrit` datetime NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `idAuteurPost` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `friends`
--

CREATE TABLE `friends` (
  `iduser` int(255) NOT NULL,
  `idfriend` int(255) NOT NULL,
  `isvalidate` tinyint(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `remember` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT 'user404.png'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `login`, `mdp`, `email`, `remember`, `avatar`) VALUES
(1, 'gilles', '*A4B6157319038724E3560894F7F932C8886EBFCF', 'gilles@toto.fr', '', 'zelda.png'),
(2, 'Said', '*2CE34926DEDE731C32296F5E6B87D6C9A5C287D7', NULL, NULL, ''),
(4, 'Adri', '*2CE34926DEDE731C32296F5E6B87D6C9A5C287D7', NULL, NULL, 'totor.png');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ecrit`
--
ALTER TABLE `ecrit`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT pour la table `ecrit`
--
ALTER TABLE `ecrit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;




-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Dim 11 Novembre 2018 à 22:12
-- Version du serveur: 5.5.57-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `tinyfacebook`
--

-- --------------------------------------------------------

--
-- Structure de la table `rating_info`
--

CREATE TABLE IF NOT EXISTS `rating_info` (
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `rating_action` varchar(30) NOT NULL,
  UNIQUE KEY `UC_rating_info` (`user_id`,`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `rating_info`
--

INSERT INTO `rating_info` (`user_id`, `post_id`, `rating_action`) VALUES
(1, 27, 'like'),
(4, 17, 'dislike'),
(4, 27, 'like');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
