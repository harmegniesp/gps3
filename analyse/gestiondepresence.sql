-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 21 Novembre 2016 à 10:20
-- Version du serveur :  5.7.14
-- Version de PHP :  7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestiondepresence`
--
CREATE DATABASE IF NOT EXISTS `gestiondepresence` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `gestiondepresence`;

-- --------------------------------------------------------

--
-- Structure de la table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `street` varchar(100) NOT NULL,
  `zipCode` varchar(10) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `codeCourse` varchar(45) NOT NULL,
  `codeUt` varchar(45) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `lessonNumber` int(11) NOT NULL,
  `nbPeriods` int(11) NOT NULL,
  `pathDocument` varchar(100) NOT NULL,
  `timeslot` varchar(45) NOT NULL,
  `School_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `course`
--

INSERT INTO `course` (`id`, `name`, `codeCourse`, `codeUt`, `startDate`, `endDate`, `lessonNumber`, `nbPeriods`, `pathDocument`, `timeslot`, `School_id`) VALUES
(1, 'Web Développement', '458669966', 'prweb2', '2016-09-18', '2016-12-22', 25, 100, '', 'soir', 7),
(2, 'réseau', '458963333', 'res2', '2016-09-11', '2017-04-10', 100, 25, '', 'soir', 7);

-- --------------------------------------------------------

--
-- Structure de la table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nameCreate` varchar(50) NOT NULL,
  `pathDocument` varchar(100) NOT NULL,
  `format` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `comment` mediumtext,
  `uploadedDate` datetime NOT NULL,
  `Course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='	';

-- --------------------------------------------------------

--
-- Structure de la table `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `dateChanged` date NOT NULL,
  `classroom` varchar(45) DEFAULT NULL,
  `nbPeriods` int(11) NOT NULL,
  `absenceTeacher` tinyint(1) NOT NULL,
  `Course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `school`
--

CREATE TABLE `school` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `codeSchool` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `school`
--

INSERT INTO `school` (`id`, `name`, `codeSchool`, `phone`, `address`) VALUES
(6, 'IRAM', '5789656', '065123245', 'rue de Binche, 7000 Mons'),
(7, 'PROMSOC SUP', '5896369', '065723245', 'avenue du Tir, 7000 Mons');

-- --------------------------------------------------------

--
-- Structure de la table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `birthday` date NOT NULL,
  `Address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `student_course`
--

CREATE TABLE `student_course` (
  `Student_id` int(11) NOT NULL,
  `Course_id` int(11) NOT NULL,
  `hasPassed` tinyint(1) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `rating` float NOT NULL,
  `comment` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `student_lesson`
--

CREATE TABLE `student_lesson` (
  `Lesson_id` int(11) NOT NULL,
  `Student_id` int(11) NOT NULL,
  `hasArrivedLate` tinyint(1) NOT NULL,
  `hasAttend` tinyint(1) NOT NULL,
  `hasLeftEarlier` tinyint(1) NOT NULL,
  `certificate` tinyint(1) NOT NULL,
  `scanCertificate` varchar(100) DEFAULT NULL,
  `motive` tinyint(1) NOT NULL,
  `comment` mediumtext,
  `testSession` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tb_erreur`
--

CREATE TABLE `tb_erreur` (
  `idErreur` int(11) NOT NULL,
  `dateErreur` varchar(50) NOT NULL,
  `messageErreur` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Course_School_idx` (`School_id`);

--
-- Index pour la table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nameCreateUnique` (`nameCreate`),
  ADD KEY `fk_Document_Course1_idx` (`Course_id`);

--
-- Index pour la table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_Lesson_Course1_idx` (`Course_id`);

--
-- Index pour la table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codeSchoolUnique` (`codeSchool`) USING BTREE;

--
-- Index pour la table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emailUnique` (`email`),
  ADD KEY `fk_Student_Address1_idx` (`Address_id`);

--
-- Index pour la table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`Student_id`,`Course_id`),
  ADD KEY `fk_Student_has_Course_Course1_idx` (`Course_id`),
  ADD KEY `fk_Student_has_Course_Student1_idx` (`Student_id`);

--
-- Index pour la table `student_lesson`
--
ALTER TABLE `student_lesson`
  ADD PRIMARY KEY (`Lesson_id`,`Student_id`),
  ADD KEY `fk_Lesson_has_Student_Student1_idx` (`Student_id`),
  ADD KEY `fk_Lesson_has_Student_Lesson1_idx` (`Lesson_id`);

--
-- Index pour la table `tb_erreur`
--
ALTER TABLE `tb_erreur`
  ADD PRIMARY KEY (`idErreur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `school`
--
ALTER TABLE `school`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `tb_erreur`
--
ALTER TABLE `tb_erreur`
  MODIFY `idErreur` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `fk_Course_School` FOREIGN KEY (`School_id`) REFERENCES `school` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `fk_Document_Course1` FOREIGN KEY (`Course_id`) REFERENCES `course` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `lesson`
--
ALTER TABLE `lesson`
  ADD CONSTRAINT `fk_Lesson_Course1` FOREIGN KEY (`Course_id`) REFERENCES `course` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `fk_Student_Address1` FOREIGN KEY (`Address_id`) REFERENCES `address` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `student_course`
--
ALTER TABLE `student_course`
  ADD CONSTRAINT `fk_Student_has_Course_Course1` FOREIGN KEY (`Course_id`) REFERENCES `course` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Student_has_Course_Student1` FOREIGN KEY (`Student_id`) REFERENCES `student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `student_lesson`
--
ALTER TABLE `student_lesson`
  ADD CONSTRAINT `fk_Lesson_has_Student_Lesson1` FOREIGN KEY (`Lesson_id`) REFERENCES `lesson` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Lesson_has_Student_Student1` FOREIGN KEY (`Student_id`) REFERENCES `student` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
