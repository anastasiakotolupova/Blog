-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  lun. 30 juil. 2018 à 22:29
-- Version du serveur :  10.1.33-MariaDB
-- Version de PHP :  7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE `posts` (
  `id_post` int(5) NOT NULL,
  `id_user` int(5) NOT NULL,
  `content` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `posts`
--

INSERT INTO `posts` (`id_post`, `id_user`, `content`, `title`, `status`, `picture`, `datetime`) VALUES
(42, 3, 'The biggest wall you have to climb is the one you build in your mind: Never let your mind talk you out of your dreams, trick you into giving up. Never let your mind become the greatest obstacle to success. To get your mind on the right track, the rest will follow.', 'Succes', 1, '', '2018-07-30 22:12:44'),
(43, 4, 'Do not stop thinking of life as an adventure. You have no security unless you can live bravely, excitingly, imaginatively; unless you can choose a challenge instead of competence.', 'Life is an adventure', 1, '', '2018-07-30 22:14:58'),
(44, 5, 'One, remember to look up at the stars and not down at your feet. Two, never give up work. Work gives you meaning and purpose and life is empty without it. Three, if you are lucky enough to find love, remember it is there and don\\\'t throw it away.', 'Three things you should never forget', 1, '', '2018-07-30 22:21:53');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id_user` int(5) NOT NULL,
  `nickname` varchar(30) NOT NULL,
  `password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_user`, `nickname`, `password`) VALUES
(1, 'heyhey', '$2y$10$ckSR0BF1yUL7rRcau6EuSOLs3dOBcjQxoExgVzFZFxhVRQ1EU1boy'),
(2, 'Joe', '$2y$10$yxvbf.AKqJ5425vdlj4Uzer66xlHrDrTo81.XsnJMCtgJ/0sQIQ5W'),
(3, 'RobertBennett', '$2y$10$wRCUU9VEIyfEWXGWSge4LeoN7.JDHvisH3thdCRKfHm46oGMdCt1u'),
(4, 'EleanorRoosevelt', '$2y$10$.UhNUerpuNfG46W7jc02uOyG6WheprB/H3ajYXQvYsTCiPXR5c7zG'),
(5, 'StephenHawking', '$2y$10$0hofpZeh4F1PZnNgLgU0TOjc2G.4hVwRteQSyvDROR9KqjEzoCWa6');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
