INSERT INTO `role` (`id`, `label`) VALUES
(1, 'administrateur'),
(4, 'banni'),
(2, 'modérateur'),
(3, 'utilisateur');

INSERT INTO `publication_type` (`id`, `label`) VALUES
(1, 'Univers'),
(2, 'Planète'),
(3, 'Profil'),
(4, 'Message Privé'),
(5, 'Enigme');

INSERT INTO `planet` (`id`, `name`, `description`, `history`, `imagePath`) VALUES
(1, 'Terre #AA001', 'Ceci est la Terre', NULL, 'pathImage');

INSERT INTO `user` (`id`, `firstName`, `lastName`, `username`, `mail`, `password`, `description`, `birthDate`, `planetId`, `roleId`, `activated`) VALUES
(3, 'Jean', 'Robert', 'JR', 'mail@mail.fr', 'pass123', 'blabla', '2017-02-13', 1, 3, 1);
