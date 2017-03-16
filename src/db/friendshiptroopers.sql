-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 16 Mars 2017 à 21:56
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `friendshiptroopers`
--

-- --------------------------------------------------------

--
-- Structure de la table `avatar`
--

CREATE TABLE `avatar` (
  `id` int(11) NOT NULL,
  `imagePath` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `altText` varchar(255) NOT NULL,
  `pack` int(11) NOT NULL DEFAULT '0',
  `price` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `avatar`
--

INSERT INTO `avatar` (`id`, `imagePath`, `description`, `altText`, `pack`, `price`) VALUES
(1, 'aliens.svg', 'aliens', 'aliens', 0, NULL),
(3, 'astro.svg', 'astro', 'astro', 0, NULL),
(4, 'dashboard.svg', 'dashboard', 'dashboard', 1, NULL),
(5, 'landscape.svg', 'landscape', 'landscape', 0, NULL),
(6, 'miror.svg', 'miror', 'miror', 0, NULL),
(7, 'planets.svg', 'planets', 'planets', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `badge`
--

CREATE TABLE `badge` (
  `id` int(11) NOT NULL,
  `label` varchar(60) NOT NULL,
  `description` varchar(500) NOT NULL,
  `funFact` text,
  `imagePath` varchar(100) NOT NULL,
  `locked` tinyint(4) DEFAULT NULL,
  `requirement` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `chatbox`
--

CREATE TABLE `chatbox` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `chatbox_publication`
--

CREATE TABLE `chatbox_publication` (
  `chatboxId` int(11) NOT NULL,
  `publicationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `chatbox_user`
--

CREATE TABLE `chatbox_user` (
  `chatboxId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `userId` int(11) NOT NULL,
  `publicationId` int(11) NOT NULL,
  `publishDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `comment`
--

INSERT INTO `comment` (`id`, `content`, `userId`, `publicationId`, `publishDate`, `modified`) VALUES
(1, 'version courte ou longue ?', 4, 1, '2017-03-10 19:10:08', 0),
(2, 'version longue tu me prend pour un terrien ?', 1, 1, '2017-03-10 19:33:13', NULL),
(3, 'ah ouf ! J\'ai eu peur !', 4, 1, '2017-03-10 20:04:21', NULL),
(4, 'euh… perso j\'préfère les versions courtes', 15, 1, '2017-03-10 20:04:21', NULL),
(5, 'euh…', 4, 1, '2017-03-11 11:27:56', NULL),
(6, 'Lisez la charte, vous ne pouvez pas penser du mal de moi !', 15, 1, '2017-03-11 11:31:48', NULL),
(7, 'Ouais t\'as raison, je ne te juge pas pour ce blasphème…', 1, 1, '2017-03-11 11:34:48', NULL),
(8, 'Ouais, t\'as grave raison ! StarTrek VS Delahousse, y a pas photo !', 29, 2, '2017-03-11 11:34:48', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `startDate` datetime NOT NULL,
  `endDate` datetime NOT NULL,
  `description` varchar(500) NOT NULL,
  `riddleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `friend`
--

CREATE TABLE `friend` (
  `userId` int(11) NOT NULL,
  `friendId` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `seeker` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `friend`
--

INSERT INTO `friend` (`userId`, `friendId`, `status`, `seeker`) VALUES
(1, 4, 0, 0),
(4, 1, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `imgupload`
--

CREATE TABLE `imgupload` (
  `id` int(11) NOT NULL,
  `imagePath` varchar(100) DEFAULT NULL,
  `alt` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `interest`
--

CREATE TABLE `interest` (
  `id` int(11) NOT NULL,
  `label` varchar(45) NOT NULL,
  `initInterest` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `interest`
--

INSERT INTO `interest` (`id`, `label`, `initInterest`) VALUES
(1, 'dinausores', 1),
(2, 'vueJS', 1),
(3, 'moutons', 1),
(4, 'tennis', 1),
(5, 'astérix', 1),
(6, 'dark vador', 1),
(7, 'gateaux', 1),
(8, 'kangourous', 1),
(9, 'neptune', 1),
(10, 'javelots', 1);

-- --------------------------------------------------------

--
-- Structure de la table `planet`
--

CREATE TABLE `planet` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `description` varchar(500) NOT NULL,
  `history` text,
  `imagePath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `planet`
--

INSERT INTO `planet` (`id`, `name`, `description`, `history`, `imagePath`) VALUES
(1, 'Terre', '', NULL, '/assets/images/planets/Terre.svg'),
(2, 'Paranose', '', NULL, '/assets/images/planets/Paranose.svg'),
(3, 'Technome', '', NULL, '/assets/images/planets/Technome.svg'),
(4, 'Sautien', '', NULL, '/assets/images/planets/Sautien.svg'),
(5, 'Multas', '', NULL, '/assets/images/planets/Multas.svg');

-- --------------------------------------------------------

--
-- Structure de la table `preference`
--

CREATE TABLE `preference` (
  `id` int(11) NOT NULL,
  `label` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `publication`
--

CREATE TABLE `publication` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `publishDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` tinyint(4) DEFAULT NULL,
  `userId` int(11) NOT NULL,
  `imageUploadId` int(11) DEFAULT NULL,
  `publicationTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `publication`
--

INSERT INTO `publication` (`id`, `content`, `publishDate`, `modified`, `userId`, `imageUploadId`, `publicationTypeId`) VALUES
(1, 'Enfin une bonne nuit de sommeil ! Je viens de me faire un petit marathon seigneur des anneaux !', '2017-03-10 19:09:47', NULL, 1, NULL, 1),
(2, 'Soirée pizza/Star-Trek en prévision pour demain soir ! Bien mieux que le JT de Delahousse !', '2017-03-10 19:44:01', NULL, 3, NULL, 3),
(3, 'Je viens enfin que finir mon nouveau site web !! Je me sens comme un gamin à la fin de Jurassic Park…', '2017-03-10 19:44:01', NULL, 3, NULL, 3),
(4, 'Vous pensez quoi du nouveau Star Wars ? Je pense offrir un calçon Chewbacca à mon copain pour son aniversaire !', '2017-03-13 07:31:55', NULL, 28, NULL, 3),
(5, 'Waou, super ce site, je viens juste de le découvrir ! Je suis un grand fan de Paul Verhoeven et de Starship Troopers !', '2017-03-13 07:34:04', NULL, 28, NULL, 3),
(6, 'Trop dur cette énigme ! Décidement je vais continuer le niveau facile !', '2017-03-15 21:45:20', NULL, 29, NULL, 3);

-- --------------------------------------------------------

--
-- Structure de la table `publication_type`
--

CREATE TABLE `publication_type` (
  `id` int(11) NOT NULL,
  `label` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `publication_type`
--

INSERT INTO `publication_type` (`id`, `label`) VALUES
(1, 'Univers'),
(2, 'Planète'),
(3, 'Profil'),
(4, 'Message Privé'),
(5, 'Enigme');

-- --------------------------------------------------------

--
-- Structure de la table `report`
--

CREATE TABLE `report` (
  `publicationId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `riddle`
--

CREATE TABLE `riddle` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `level` int(11) NOT NULL,
  `minReward` int(11) NOT NULL,
  `maxReward` int(11) NOT NULL,
  `nbParticipants` int(11) NOT NULL,
  `riddleTypeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `riddlephase`
--

CREATE TABLE `riddlephase` (
  `id` int(11) NOT NULL,
  `step` int(11) NOT NULL,
  `description` varchar(500) NOT NULL,
  `answer` varchar(500) DEFAULT NULL,
  `riddleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `riddle_type`
--

CREATE TABLE `riddle_type` (
  `id` int(11) NOT NULL,
  `label` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `label` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`id`, `label`) VALUES
(1, 'administrateur'),
(4, 'banni'),
(2, 'modérateur'),
(3, 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `smiley`
--

CREATE TABLE `smiley` (
  `id` int(11) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `label` varchar(20) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `stardust`
--

CREATE TABLE `stardust` (
  `userId` int(11) NOT NULL,
  `publicationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `title`
--

CREATE TABLE `title` (
  `id` int(11) NOT NULL,
  `honorificTitle` varchar(255) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `title`
--

INSERT INTO `title` (`id`, `honorificTitle`, `price`) VALUES
(1, 'Astronaute débutant', 0),
(2, 'Gentil alien', 0),
(3, 'Star galactique', 200),
(4, 'Monstre intersidéral', 500);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstName` varchar(45) DEFAULT NULL,
  `lastName` varchar(45) DEFAULT NULL,
  `username` varchar(30) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `planetId` int(11) NOT NULL,
  `roleId` int(11) NOT NULL,
  `activated` tinyint(4) NOT NULL DEFAULT '0',
  `hash` varchar(255) DEFAULT NULL,
  `registerDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `points` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=dec8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `firstName`, `lastName`, `username`, `mail`, `password`, `description`, `birthDate`, `planetId`, `roleId`, `activated`, `hash`, `registerDate`, `points`) VALUES
(1, NULL, NULL, 'Harrissa Ford', 'harrissa-ford@mail.fr', '$2y$10$HPsD8ZxTeNkKzkLC09w/FegMvas.f9jeQMB7igTUIpcIwxm8oTbV6', NULL, '2006-10-20', 1, 3, 0, 'f2217062e9a397a1dca429e7d70bc6ca', '2017-03-16 19:14:27', NULL),
(2, NULL, NULL, 'Katum', 'katum@mail.fr', '$2y$10$mpJiqj7mTlC/E4tqzxVXt.zldMxp/VA.IxspbDVtvvdtuAETUbBjO', NULL, '1999-03-12', 1, 3, 0, 'e0c641195b27425bb056ac56f8953d24', '2017-03-16 19:05:00', 12),
(3, NULL, NULL, 'Sarkophage', 'sarkophage@mail.fr', '$2y$10$jXQq.F9BuE1r1tipVyQrAeFNBfKxnbdr5svMtpg0dxZNkhFekF/Mu', NULL, '2004-06-07', 2, 3, 0, '57aeee35c98205091e18d1140e9f38cf', '2017-03-16 19:10:47', 100),
(4, NULL, NULL, 'Marmiton', 'marmiton@mail.fr', '$2y$10$l8hcDXKaDuy0T7mB3RjHdejQQWd224OvkV0za3vwIQ7ivIFIR6qVO', NULL, '2005-06-05', 1, 3, 0, '48ab2f9b45957ab574cf005eb8a76760', '2017-03-16 18:50:46', 120),
(15, NULL, NULL, 'Robocop', 'robocop@mail.fr', '$2y$10$Vm8sN0nSXN7I801T6Vwtse1CLorquhr3jWktjysCvRqW1WsvcXSda', NULL, '1995-10-30', 1, 3, 0, 'eae27d77ca20db309e056e3d2dcd7d69', '2017-03-16 19:06:43', 100),
(21, NULL, NULL, 'Einstein', 'einstein@mail.fr', '$2y$10$kCbLHTYl5q1Ggsmf30/0pupy3wNEuWZT/QCn0btdsOfYf8I2n2clm', NULL, '2011-04-07', 1, 3, 0, '0cb929eae7a499e50248a3a78f7acfc7', '2017-03-16 19:15:20', 150),
(25, NULL, NULL, 'Yakarico', 'yakarico@mail.fr', '$2y$10$L6pfCUUMJlxQb.4IWiA84e0MYeP9uNbbLMEVfXDof2m4CGCnHmMHK', NULL, '2010-12-12', 1, 3, 0, '5a4b25aaed25c2ee1b74de72dc03c14e', '2017-03-16 19:16:13', NULL),
(26, NULL, NULL, 'MegaKiller', 'mega-killer@mail.fr', '$2y$10$UCrlA8JwdTKngd3r3wsjteE77lWNh0e9MokqMVPYl.pj6KnbbYRZ2', NULL, '1939-02-20', 1, 3, 0, '289dff07669d7a23de0ef88d2f7129e7', '2017-03-16 18:54:23', NULL),
(27, NULL, NULL, 'Bug', 'bug@mail.fr', '$2y$10$Op2iLcfqp4TOiaSUSDzPLOvKN576BFkFfWsjK9G5KsVyum4vJ5CAG', NULL, '1993-04-13', 1, 3, 0, 'beb22fb694d513edcf5533cf006dfeae', '2017-03-16 19:11:48', 109),
(28, NULL, NULL, 'Dark Invador', 'dark-invador@mail.fr', '$2y$10$eIcTCzuFDUKW6Czrk48CNesGvyrm2mRsPsAXEP3Z3madRqcX7uJMa', NULL, '2012-03-12', 1, 3, 0, 'fe8c15fed5f808006ce95eddb7366e35', '2017-03-16 19:13:28', NULL),
(29, NULL, NULL, 'Voldyde', 'voldyde@mail.fr', '$2y$10$RAJDEqo2CtdluYdSVFEP6..HnElBC8hLrCFB7ZnFAjcoP313Ouwhi', NULL, '1995-03-12', 2, 3, 0, 'b2eeb7362ef83deff5c7813a67e14f0a', '2017-03-16 19:17:07', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user_avatar`
--

CREATE TABLE `user_avatar` (
  `userId` int(11) NOT NULL,
  `avatarId` int(11) NOT NULL,
  `currentAvatar` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user_avatar`
--

INSERT INTO `user_avatar` (`userId`, `avatarId`, `currentAvatar`) VALUES
(1, 1, 1),
(1, 4, 0),
(2, 3, 1),
(3, 4, 1),
(4, 3, 1),
(15, 3, 0),
(15, 4, 1),
(21, 1, 1),
(25, 3, 0),
(25, 4, 1),
(26, 3, 1),
(27, 1, 1),
(28, 3, 1),
(29, 1, 1),
(29, 3, 0);

-- --------------------------------------------------------

--
-- Structure de la table `user_badge`
--

CREATE TABLE `user_badge` (
  `userId` int(11) NOT NULL,
  `badgeId` int(11) NOT NULL,
  `display` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user_interest`
--

CREATE TABLE `user_interest` (
  `userId` int(11) NOT NULL,
  `interestId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user_interest`
--

INSERT INTO `user_interest` (`userId`, `interestId`) VALUES
(3, 1),
(15, 3),
(1, 4),
(4, 5),
(21, 5),
(26, 5),
(2, 6),
(27, 6),
(28, 6),
(1, 7),
(3, 7),
(25, 7),
(26, 7),
(28, 7),
(2, 8),
(4, 8),
(15, 8),
(21, 10),
(25, 10);

-- --------------------------------------------------------

--
-- Structure de la table `user_preference`
--

CREATE TABLE `user_preference` (
  `preferenceId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user_riddle`
--

CREATE TABLE `user_riddle` (
  `userId` int(11) NOT NULL,
  `riddleId` int(11) NOT NULL,
  `startDate` datetime DEFAULT CURRENT_TIMESTAMP,
  `endDate` datetime DEFAULT NULL,
  `current` tinyint(4) DEFAULT '1',
  `token` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user_smiley`
--

CREATE TABLE `user_smiley` (
  `userId` int(11) NOT NULL,
  `smileyId` int(11) NOT NULL,
  `lastUseDate` datetime DEFAULT NULL,
  `obtentionDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `user_title`
--

CREATE TABLE `user_title` (
  `titleId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `current` tinyint(4) NOT NULL DEFAULT '0',
  `obtentionDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user_title`
--

INSERT INTO `user_title` (`titleId`, `UserId`, `current`, `obtentionDate`) VALUES
(1, 21, 1, '2017-03-12 23:16:00'),
(1, 25, 1, '2017-03-12 23:16:00'),
(1, 26, 1, '2017-03-12 23:16:00'),
(1, 29, 1, '2017-03-15 22:47:29'),
(2, 1, 0, '2017-03-13 16:19:42'),
(2, 2, 0, '2017-03-12 23:10:38'),
(2, 3, 1, '2017-03-12 23:10:38'),
(2, 4, 1, '2017-03-13 16:18:52'),
(2, 27, 1, '2017-03-13 16:18:52'),
(2, 29, 0, '2017-03-15 22:47:29'),
(3, 1, 0, '2017-03-13 16:19:25'),
(3, 2, 0, '2017-03-13 16:20:12'),
(3, 15, 1, '2017-03-13 16:18:52'),
(3, 29, 0, '2017-03-15 22:47:29'),
(4, 1, 1, '2017-03-13 16:18:52'),
(4, 28, 1, '2017-03-13 16:18:52'),
(4, 29, 0, '2017-03-15 22:47:29');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `avatar`
--
ALTER TABLE `avatar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `imagePath_UNIQUE` (`imagePath`);

--
-- Index pour la table `badge`
--
ALTER TABLE `badge`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label_UNIQUE` (`label`),
  ADD UNIQUE KEY `imagePath_UNIQUE` (`imagePath`);

--
-- Index pour la table `chatbox`
--
ALTER TABLE `chatbox`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `chatbox_publication`
--
ALTER TABLE `chatbox_publication`
  ADD PRIMARY KEY (`chatboxId`,`publicationId`),
  ADD KEY `fk_CHATBOX_has_PUBLICATION_PUBLICATION1_idx` (`publicationId`),
  ADD KEY `fk_CHATBOX_has_PUBLICATION_CHATBOX1_idx` (`chatboxId`);

--
-- Index pour la table `chatbox_user`
--
ALTER TABLE `chatbox_user`
  ADD PRIMARY KEY (`chatboxId`,`userId`),
  ADD KEY `fk_CHATBOX_has_USER_USER1_idx` (`userId`),
  ADD KEY `fk_CHATBOX_has_USER_CHATBOX1_idx` (`chatboxId`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_USER_has_PUBLICATION_PUBLICATION1_idx` (`publicationId`),
  ADD KEY `fk_USER_has_PUBLICATION_USER1_idx` (`userId`);

--
-- Index pour la table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`,`riddleId`),
  ADD KEY `fk_EVENT_RIDDLE1_idx` (`riddleId`);

--
-- Index pour la table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`userId`,`friendId`),
  ADD KEY `fk_FRIENDS_USER2_idx` (`userId`),
  ADD KEY `fk_FRIENDS_USER1_idx` (`friendId`);

--
-- Index pour la table `imgupload`
--
ALTER TABLE `imgupload`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `imagePath_UNIQUE` (`imagePath`);

--
-- Index pour la table `interest`
--
ALTER TABLE `interest`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `planet`
--
ALTER TABLE `planet`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_UNIQUE` (`name`),
  ADD UNIQUE KEY `imagePath_UNIQUE` (`imagePath`);

--
-- Index pour la table `preference`
--
ALTER TABLE `preference`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `publication`
--
ALTER TABLE `publication`
  ADD PRIMARY KEY (`id`,`userId`,`publicationTypeId`),
  ADD KEY `fk_POST_USER1_idx` (`userId`),
  ADD KEY `fk_PUBLICATION_IMGUPLOAD1_idx` (`imageUploadId`),
  ADD KEY `fk_PUBLICATION_PUBLICATION_TYPE1_idx` (`publicationTypeId`);

--
-- Index pour la table `publication_type`
--
ALTER TABLE `publication_type`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`publicationId`,`userId`),
  ADD KEY `fk_SIGNALEMENT_PUBLICATION1_idx` (`publicationId`),
  ADD KEY `fk_SIGNALEMENT_USER1_idx` (`userId`);

--
-- Index pour la table `riddle`
--
ALTER TABLE `riddle`
  ADD PRIMARY KEY (`id`,`riddleTypeId`),
  ADD UNIQUE KEY `title_UNIQUE` (`title`),
  ADD UNIQUE KEY `description_UNIQUE` (`description`),
  ADD KEY `fk_RIDDLE_RIDDLE_TYPE1_idx` (`riddleTypeId`);

--
-- Index pour la table `riddlephase`
--
ALTER TABLE `riddlephase`
  ADD PRIMARY KEY (`id`,`riddleId`),
  ADD UNIQUE KEY `step_UNIQUE` (`step`),
  ADD KEY `fk_RIDDLEPHASE_RIDDLE1_idx` (`riddleId`);

--
-- Index pour la table `riddle_type`
--
ALTER TABLE `riddle_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label_UNIQUE` (`label`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `label_UNIQUE` (`label`);

--
-- Index pour la table `smiley`
--
ALTER TABLE `smiley`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `stardust`
--
ALTER TABLE `stardust`
  ADD PRIMARY KEY (`userId`,`publicationId`),
  ADD KEY `fk_PUBLICATION_has_USER_USER1_idx` (`userId`),
  ADD KEY `fk_PUBLICATION_has_USER_PUBLICATION1_idx` (`publicationId`);

--
-- Index pour la table `title`
--
ALTER TABLE `title`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`,`planetId`,`roleId`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `mail_UNIQUE` (`mail`),
  ADD KEY `fk_USER_PLANET1_idx` (`planetId`),
  ADD KEY `fk_USER_ROLE2_idx` (`roleId`);

--
-- Index pour la table `user_avatar`
--
ALTER TABLE `user_avatar`
  ADD PRIMARY KEY (`userId`,`avatarId`),
  ADD KEY `fk_USER_has_AVATAR_AVATAR1_idx` (`avatarId`),
  ADD KEY `fk_USER_has_AVATAR_USER1_idx` (`userId`);

--
-- Index pour la table `user_badge`
--
ALTER TABLE `user_badge`
  ADD PRIMARY KEY (`userId`,`badgeId`),
  ADD KEY `fk_USER_has_BADGE_BADGE1_idx` (`badgeId`),
  ADD KEY `fk_USER_has_BADGE_USER1_idx` (`userId`);

--
-- Index pour la table `user_interest`
--
ALTER TABLE `user_interest`
  ADD PRIMARY KEY (`userId`,`interestId`),
  ADD KEY `fk_USER_has_INTEREST_INTEREST1_idx` (`interestId`),
  ADD KEY `fk_USER_has_INTEREST_USER1_idx` (`userId`);

--
-- Index pour la table `user_preference`
--
ALTER TABLE `user_preference`
  ADD PRIMARY KEY (`preferenceId`,`userId`),
  ADD KEY `fk_PREFERENCE_has_USER_USER1_idx` (`userId`),
  ADD KEY `fk_PREFERENCE_has_USER_PREFERENCE1_idx` (`preferenceId`);

--
-- Index pour la table `user_riddle`
--
ALTER TABLE `user_riddle`
  ADD PRIMARY KEY (`userId`,`riddleId`),
  ADD KEY `fk_USER_has_RIDDLE_RIDDLE1_idx` (`riddleId`),
  ADD KEY `fk_USER_has_RIDDLE_USER1_idx` (`userId`);

--
-- Index pour la table `user_smiley`
--
ALTER TABLE `user_smiley`
  ADD PRIMARY KEY (`userId`,`smileyId`),
  ADD KEY `fk_USER_has_SMILEY_SMILEY1_idx` (`smileyId`),
  ADD KEY `fk_USER_has_SMILEY_USER1_idx` (`userId`);

--
-- Index pour la table `user_title`
--
ALTER TABLE `user_title`
  ADD PRIMARY KEY (`titleId`,`UserId`),
  ADD KEY `fk_TITLE_has_USER_USER1_idx` (`UserId`),
  ADD KEY `fk_TITLE_has_USER_TITLE1_idx` (`titleId`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `avatar`
--
ALTER TABLE `avatar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `badge`
--
ALTER TABLE `badge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `chatbox`
--
ALTER TABLE `chatbox`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `imgupload`
--
ALTER TABLE `imgupload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `interest`
--
ALTER TABLE `interest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `planet`
--
ALTER TABLE `planet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `publication`
--
ALTER TABLE `publication`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `publication_type`
--
ALTER TABLE `publication_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `riddle`
--
ALTER TABLE `riddle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `riddlephase`
--
ALTER TABLE `riddlephase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `riddle_type`
--
ALTER TABLE `riddle_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `smiley`
--
ALTER TABLE `smiley`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `title`
--
ALTER TABLE `title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `chatbox_publication`
--
ALTER TABLE `chatbox_publication`
  ADD CONSTRAINT `fk_CHATBOX_has_PUBLICATION_CHATBOX1` FOREIGN KEY (`chatboxId`) REFERENCES `chatbox` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CHATBOX_has_PUBLICATION_PUBLICATION1` FOREIGN KEY (`publicationId`) REFERENCES `publication` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `chatbox_user`
--
ALTER TABLE `chatbox_user`
  ADD CONSTRAINT `fk_CHATBOX_has_USER_CHATBOX1` FOREIGN KEY (`chatboxId`) REFERENCES `chatbox` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_CHATBOX_has_USER_USER1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `fk_USER_has_PUBLICATION_PUBLICATION1` FOREIGN KEY (`publicationId`) REFERENCES `publication` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_USER_has_PUBLICATION_USER1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `fk_EVENT_RIDDLE1` FOREIGN KEY (`riddleId`) REFERENCES `riddle` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `friend`
--
ALTER TABLE `friend`
  ADD CONSTRAINT `fk_FRIENDS_USER1` FOREIGN KEY (`friendId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_FRIENDS_USER2` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `publication`
--
ALTER TABLE `publication`
  ADD CONSTRAINT `fk_POST_USER1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PUBLICATION_IMGUPLOAD1` FOREIGN KEY (`imageUploadId`) REFERENCES `imgupload` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PUBLICATION_PUBLICATION_TYPE1` FOREIGN KEY (`publicationTypeId`) REFERENCES `publication_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `fk_SIGNALEMENT_PUBLICATION1` FOREIGN KEY (`publicationId`) REFERENCES `publication` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_SIGNALEMENT_USER1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `riddle`
--
ALTER TABLE `riddle`
  ADD CONSTRAINT `fk_RIDDLE_RIDDLE_TYPE1` FOREIGN KEY (`riddleTypeId`) REFERENCES `riddle_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `riddlephase`
--
ALTER TABLE `riddlephase`
  ADD CONSTRAINT `fk_RIDDLEPHASE_RIDDLE1` FOREIGN KEY (`riddleId`) REFERENCES `riddle` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `stardust`
--
ALTER TABLE `stardust`
  ADD CONSTRAINT `fk_PUBLICATION_has_USER_PUBLICATION1` FOREIGN KEY (`publicationId`) REFERENCES `publication` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PUBLICATION_has_USER_USER1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_USER_PLANET1` FOREIGN KEY (`planetId`) REFERENCES `planet` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_USER_ROLE2` FOREIGN KEY (`roleId`) REFERENCES `role` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_avatar`
--
ALTER TABLE `user_avatar`
  ADD CONSTRAINT `fk_USER_has_AVATAR_AVATAR1` FOREIGN KEY (`avatarId`) REFERENCES `avatar` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_USER_has_AVATAR_USER1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_badge`
--
ALTER TABLE `user_badge`
  ADD CONSTRAINT `fk_USER_has_BADGE_BADGE1` FOREIGN KEY (`badgeId`) REFERENCES `badge` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_USER_has_BADGE_USER1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_interest`
--
ALTER TABLE `user_interest`
  ADD CONSTRAINT `fk_USER_has_INTEREST_INTEREST1` FOREIGN KEY (`interestId`) REFERENCES `interest` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_USER_has_INTEREST_USER1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_preference`
--
ALTER TABLE `user_preference`
  ADD CONSTRAINT `fk_PREFERENCE_has_USER_PREFERENCE1` FOREIGN KEY (`preferenceId`) REFERENCES `preference` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_PREFERENCE_has_USER_USER1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_riddle`
--
ALTER TABLE `user_riddle`
  ADD CONSTRAINT `fk_USER_has_RIDDLE_RIDDLE1` FOREIGN KEY (`riddleId`) REFERENCES `riddle` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_USER_has_RIDDLE_USER1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_smiley`
--
ALTER TABLE `user_smiley`
  ADD CONSTRAINT `fk_USER_has_SMILEY_SMILEY1` FOREIGN KEY (`smileyId`) REFERENCES `smiley` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_USER_has_SMILEY_USER1` FOREIGN KEY (`userId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `user_title`
--
ALTER TABLE `user_title`
  ADD CONSTRAINT `fk_TITLE_has_USER_TITLE1` FOREIGN KEY (`titleId`) REFERENCES `title` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_TITLE_has_USER_USER1` FOREIGN KEY (`UserId`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
