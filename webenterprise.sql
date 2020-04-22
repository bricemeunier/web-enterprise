-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 22 avr. 2020 à 09:24
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `webenterprise`
--

-- --------------------------------------------------------

--
-- Structure de la table `badword`
--

DROP TABLE IF EXISTS `badword`;
CREATE TABLE IF NOT EXISTS `badword` (
  `word_id` int(11) NOT NULL AUTO_INCREMENT,
  `bad_word` text NOT NULL,
  PRIMARY KEY (`word_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `badword`
--

INSERT INTO `badword` (`word_id`, `bad_word`) VALUES
(1, 'sex'),
(2, 'shit'),
(3, 'fuck'),
(4, 'hci'),
(5, 'aberdeen uni');

-- --------------------------------------------------------

--
-- Structure de la table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `city_num` int(11) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(100) NOT NULL,
  PRIMARY KEY (`city_num`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `city`
--

INSERT INTO `city` (`city_num`, `city_name`) VALUES
(1, 'Unknown'),
(18, 'Aberdeen'),
(20, 'Edinburgh');

-- --------------------------------------------------------

--
-- Structure de la table `mark`
--

DROP TABLE IF EXISTS `mark`;
CREATE TABLE IF NOT EXISTS `mark` (
  `quo_num` int(11) NOT NULL,
  `per_num` int(11) NOT NULL,
  `mark_value` int(11) NOT NULL,
  PRIMARY KEY (`quo_num`,`per_num`),
  KEY `vote_ibfk_3` (`per_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `mark`
--

INSERT INTO `mark` (`quo_num`, `per_num`, `mark_value`) VALUES
(61, 77, 11),
(63, 77, 17),
(64, 1, 14);

-- --------------------------------------------------------

--
-- Structure de la table `people`
--

DROP TABLE IF EXISTS `people`;
CREATE TABLE IF NOT EXISTS `people` (
  `per_num` int(11) NOT NULL AUTO_INCREMENT,
  `per_name` varchar(30) NOT NULL,
  `per_f_name` varchar(30) NOT NULL,
  `per_phone` char(14) NOT NULL,
  `per_email` varchar(30) NOT NULL,
  `per_admin` int(11) NOT NULL DEFAULT 0,
  `per_login` varchar(20) NOT NULL,
  `per_pwd` varchar(100) NOT NULL,
  PRIMARY KEY (`per_num`),
  UNIQUE KEY `per_login` (`per_login`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `people`
--

INSERT INTO `people` (`per_num`, `per_name`, `per_f_name`, `per_phone`, `per_email`, `per_admin`, `per_login`, `per_pwd`) VALUES
(1, 'Isaacs', 'John', '0000555020', 'j.p.isaacs@rgu.ac.uk', 1, 'john', '63f892a53b17f9e5c5c0da396630dc81'),
(3, 'Kieran', 'Matthews', '01224263665', 'presspa@rguunion.co.uk', 0, 'rgupresspa', '63f892a53b17f9e5c5c0da396630dc81'),
(63, 'David', 'Corsar', '1566146132', 'd.corsar1@rgu.ac.uk', 0, 'david', '63f892a53b17f9e5c5c0da396630dc81'),
(67, 'Roger', 'McDermott', '1340016541', 'roger.mcdermott@rgu.ac.uk', 0, 'roger', '63f892a53b17f9e5c5c0da396630dc81'),
(77, 'Meunier', 'Brice', '030564646', 'b.meunier@rgu.ac.uk', 1, 'brice', '63f892a53b17f9e5c5c0da396630dc81');

-- --------------------------------------------------------

--
-- Structure de la table `position`
--

DROP TABLE IF EXISTS `position`;
CREATE TABLE IF NOT EXISTS `position` (
  `pos_num` int(11) NOT NULL AUTO_INCREMENT,
  `pos_name` varchar(30) NOT NULL,
  PRIMARY KEY (`pos_num`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `position`
--

INSERT INTO `position` (`pos_num`, `pos_name`) VALUES
(1, 'Principal'),
(2, 'Head of School'),
(3, 'Course leader'),
(4, 'Lecturer'),
(5, 'Tutor'),
(6, 'Staff');

-- --------------------------------------------------------

--
-- Structure de la table `quote`
--

DROP TABLE IF EXISTS `quote`;
CREATE TABLE IF NOT EXISTS `quote` (
  `quo_num` int(11) NOT NULL AUTO_INCREMENT,
  `per_num` int(11) NOT NULL,
  `per_num_valid` int(11) DEFAULT NULL,
  `per_num_stu` int(11) NOT NULL,
  `quo_quote` tinytext NOT NULL,
  `quo_date` date NOT NULL,
  `quo_valid` bit(1) NOT NULL DEFAULT b'0',
  `quo_date_valid` date DEFAULT NULL,
  `quo_date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  UNIQUE KEY `citation_pk` (`quo_num`),
  KEY `est_auteur_fk` (`per_num`),
  KEY `valide_fk` (`per_num_valid`),
  KEY `depose_fk` (`per_num_stu`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `quote`
--

INSERT INTO `quote` (`quo_num`, `per_num`, `per_num_valid`, `per_num_stu`, `quo_quote`, `quo_date`, `quo_valid`, `quo_date_valid`, `quo_date_added`) VALUES
(61, 1, 77, 77, 'Your hour exercise time is important for your health', '2020-04-07', b'1', '2020-04-16', '2020-04-16 07:00:07'),
(62, 1, NULL, 3, 'Death stranding is dark but pretty game', '2020-04-15', b'0', NULL, '2020-04-16 07:00:51'),
(63, 63, 77, 77, 'I\'m sure it will be a wonderful poster', '2020-04-15', b'1', '2020-04-16', '2020-04-16 07:02:00'),
(64, 67, 77, 3, 'A login page?!? That\'s very good work !', '2020-03-18', b'1', '2020-04-16', '2020-04-16 07:02:48');

-- --------------------------------------------------------

--
-- Structure de la table `school`
--

DROP TABLE IF EXISTS `school`;
CREATE TABLE IF NOT EXISTS `school` (
  `sch_num` int(11) NOT NULL AUTO_INCREMENT,
  `sch_name` varchar(30) NOT NULL,
  `city_num` int(11) DEFAULT NULL,
  PRIMARY KEY (`sch_num`),
  KEY `vil_num` (`city_num`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `school`
--

INSERT INTO `school` (`sch_num`, `sch_name`, `city_num`) VALUES
(1, 'Computer Science', 18),
(2, 'Business School', 18),
(3, 'Engineering', 18),
(4, 'Biology', 18),
(5, 'Architecture', 18),
(6, 'Health & Sport Science', 18);

-- --------------------------------------------------------

--
-- Structure de la table `staff`
--

DROP TABLE IF EXISTS `staff`;
CREATE TABLE IF NOT EXISTS `staff` (
  `per_num` int(11) NOT NULL,
  `staff_pro_phone` varchar(20) NOT NULL,
  `pos_num` int(11) NOT NULL,
  PRIMARY KEY (`per_num`),
  KEY `fon_num` (`pos_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `staff`
--

INSERT INTO `staff` (`per_num`, `staff_pro_phone`, `pos_num`) VALUES
(1, '00123456908', 2),
(63, '0654237860', 3),
(67, '01237498432', 4);

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `per_num` int(11) NOT NULL,
  `sch_num` int(11) NOT NULL,
  `year_num` int(11) NOT NULL,
  PRIMARY KEY (`per_num`),
  KEY `dep_num` (`sch_num`),
  KEY `div_num` (`year_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `student`
--

INSERT INTO `student` (`per_num`, `sch_num`, `year_num`) VALUES
(3, 3, 4),
(77, 1, 4);

-- --------------------------------------------------------

--
-- Structure de la table `year`
--

DROP TABLE IF EXISTS `year`;
CREATE TABLE IF NOT EXISTS `year` (
  `year_num` int(11) NOT NULL AUTO_INCREMENT,
  `year_name` varchar(30) NOT NULL,
  PRIMARY KEY (`year_num`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `year`
--

INSERT INTO `year` (`year_num`, `year_name`) VALUES
(1, 'First year'),
(2, 'Second year'),
(3, 'Third Year'),
(4, 'Honours year'),
(5, 'Master'),
(6, 'PhD');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `badword`
--
ALTER TABLE `badword` ADD FULLTEXT KEY `mot_interdit` (`bad_word`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `mark`
--
ALTER TABLE `mark`
  ADD CONSTRAINT `mark_ibfk_2` FOREIGN KEY (`quo_num`) REFERENCES `quote` (`quo_num`),
  ADD CONSTRAINT `mark_ibfk_3` FOREIGN KEY (`per_num`) REFERENCES `people` (`per_num`);

--
-- Contraintes pour la table `quote`
--
ALTER TABLE `quote`
  ADD CONSTRAINT `quote_ibfk_1` FOREIGN KEY (`per_num`) REFERENCES `people` (`per_num`),
  ADD CONSTRAINT `quote_ibfk_2` FOREIGN KEY (`per_num_valid`) REFERENCES `people` (`per_num`),
  ADD CONSTRAINT `quote_ibfk_3` FOREIGN KEY (`per_num_stu`) REFERENCES `student` (`per_num`);

--
-- Contraintes pour la table `school`
--
ALTER TABLE `school`
  ADD CONSTRAINT `school_ibfk_1` FOREIGN KEY (`city_num`) REFERENCES `city` (`city_num`);

--
-- Contraintes pour la table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`per_num`) REFERENCES `people` (`per_num`),
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`pos_num`) REFERENCES `position` (`pos_num`);

--
-- Contraintes pour la table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`per_num`) REFERENCES `people` (`per_num`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`sch_num`) REFERENCES `school` (`sch_num`),
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`year_num`) REFERENCES `year` (`year_num`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
