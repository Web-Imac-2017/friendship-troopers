INSERT INTO `role` (`id`, `label`) VALUES
(1, 'administrateur'),
(4, 'banni'),
(2, 'modérateur'),
(3, 'utilisateur');

INSERT INTO `planet` (`id`, `name`, `description`, `history`, `imagePath`) VALUES
(1, 'Terre', '', NULL, '/a'),
(2, 'Paranose', '', NULL, '/b'),
(3, 'Technome', '', NULL, '/c'),
(4, 'Sautien', '', NULL, '/d'),
(5, 'Multas', '', NULL, '/e');

INSERT INTO `publication_type` (`id`, `label`) VALUES
(1, 'Univers'),
(2, 'Planète'),
(3, 'Profil'),
(4, 'Message Privé'),
(5, 'Enigme');

INSERT INTO `user` ( `firstName`, `lastName`, `username`, `mail`, `password`, `description`, `birthDate`, `planetId`, `roleId`, `activated`, `registerDate`, `points`) VALUES
(NULL, NULL, 'coulon', 'micheldu13@mail.fr', '$2y$10$48s1XV53pcNdDdFR6nfQKur8ro0MddGBp/qTIBdzeIY9ozjC51cIu', NULL, '2013-02-05', 1, 3, 0, '2017-03-05 22:31:47', NULL),
(NULL, NULL, 'Altair', 'creed@mail.fr', '$2y$10$SuF9rhbtvVoQHI6tPaj.QejBXCOUrtF1OwUlQ3UAmUZOb13PTUQD6', NULL, '1215-02-05', 1, 1, 1, '2017-03-06 15:08:40', NULL),
(NULL, NULL, 'Ezio', 'creed2@mail.fr', '$2y$10$WHs7cxtUT99zrPkacSfc.eNl5V0.fqCt4n7tEWU.FNCKW6i4q6PeW', NULL, '1415-02-05', 1, 2, 1, '2017-03-06 15:09:18', NULL),
(NULL, NULL, 'Connor', 'creed3@mail.fr', '$2y$10$l6WqoFKp98V2N3FikOLSOOSLM2xp.UsqXhcqa3vXSmXGo6/qb5zeC', NULL, '1615-02-05', 1, 4, 0, '2017-03-06 15:13:03', NULL);
