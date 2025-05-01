-- phpMyAdmin SQL Dump
-- version 4.5.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bdCG`
--

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

CREATE TABLE `compte` (
  `Matricule` int(11) DEFAULT NULL,
  `login` varchar(100) DEFAULT NULL,
  `motdepasse` varchar(100) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `Prenom` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `TypeCompte` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Contenu de la table `compte`
--

INSERT INTO `compte` (`Matricule`, `login`, `motdepasse`, `nom`, `Prenom`, `Email`, `photo`, `TypeCompte`) VALUES
(1900, 'admin', '1111', 'Allaoui', 'Ali', 'admin@exemple.com', 'images/Allaoui1900.jpg', 'admin'),
(1901, 'hamzaoui', '1111', 'Hamzaoui', 'Said', 'hamza@exemple.com', 'images/Hamzaoui1901.jpg', 'personnel'),
(1902, 'fadil', '1111', 'fadil', 'Sara', 'fadil@exemple.com', 'images/fadil1902.jpg', 'personnel'),
(1903, 'dahbi', '1111', 'dahbi', 'saad', 'dahbi@exemple.com', 'images/dahbi1903.jpg', 'personnel'),
(1904, 'raji', '1111', 'raji', 'ahmed', 'raji@exemple.com', 'images/raji1904.jpg', 'personnel'),
(1905, 'fahmaoui', '1111', 'fahmaoui', 'kamal', 'fahmaoui@exemple.com', 'images/fahmaoui1905.jpg', 'personnel'),
(1906, 'kamali', '1111', 'kamali', 'rachid', 'kamali@exemple.com', 'images/kamali1906.jpg', 'personnel'),
(1907, 'hamdaoui', '1111', 'hamdaoui', 'fatima', 'hamdaoui@exemple.com', 'images/hamdaoui1907.jpg', 'personnel'),
(1908, 'daki', '1111', 'daki', 'Sara', 'daki@exemple.com', 'images/daki1908.jpg', 'personnel'),
(1909, 'fahnaoui', '1111', 'fahnaoui', 'hind', 'fahnaoui@exemple.com', 'images/fahnaoui1909.jpg', 'personnel'),
(1910, 'rochdi', '1111', 'rochdi', 'oumima', 'rochdi@exemple.com', 'images/rochdi1910.jpg', 'personnel'),
(1911, 'rahamni', '1111', 'rahamni', 'ibtissam', 'rahamni@exemple.com', 'images/rahamni1911.jpg', 'personnel'),
(1912, 'bahi', '1111', 'bahi', 'ali', 'bahi@exemple.com', 'images/bahi1912.jpg', 'personnel'),
(1913, 'fadi', '1111', 'fadi', 'rachid', 'fadi@exemple.com', 'images/fadi1913.jpg', 'personnel'),
(1914, 'bahamaoui', '1111', 'mohamed', 'Sara', 'bahamaoui@exemple.com', 'images/mohamed1914.jpg', 'personnel'),
(1915, 'dahi', '1111', 'dahi', 'khadija', 'fadil@exemple.com', 'images/dahi1915.jpg', 'personnel'),
(1916, 'anaflouss', '1111', 'anaflouss', 'youssef', 'anaflouss@exemple.com', 'images/anaflouss1916.jpg', 'personnel'),
(1917, 'kharmoudi', '1111', 'kharmoudi', 'youssef', 'kharmoudi@exemple.com', 'images/kharmoudi1917.jpg', 'personnel'),
(1918, 'rachidi', '1111', 'rachidi', 'Noureddine', 'rachidi@exemple.com', 'images/rachidi1918.jpg', 'personnel'),
(1919, 'badil', '1111', 'badil', 'Noureddine', 'badil@exemple.com', 'images/badil1919.jpg', 'personnel'),
(1920, 'sadil', '1111', 'sadil', 'brahim', 'sadil@exemple.com', 'images/sadil1920.jpg', 'personnel'),
(1921, 'hadil', '1111', 'hadil', 'hicham', 'hadil@exemple.com', 'images/hadil1921.jpg', 'personnel'),
(1922, 'kandil', '1111', 'kandil', 'hachem', 'kandil@exemple.com', 'images/kandil1922.jpg', 'personnel'),
(1923, 'raghib', '1111', 'raghib', 'redouane', 'raghib@exemple.com', 'images/raghib1923.jpg', 'personnel'),
(1924, 'sadaoui', '1111', 'sadaoui', 'ahmed', 'sadaoui@exemple.com', 'images/sadaoui1924.jpg', 'personnel'),
(1925, 'sad', '1111', 'sad', 'oussama', 'sad@exemple.com', 'images/sad1925.jpg', 'personnel'),
(1926, 'sah', '1111', 'sah', 'Sara', 'sah@exemple.com', 'images/sah1926.jpg', 'personnel');

-- --------------------------------------------------------

--
-- Structure de la table `reservation`
--

CREATE TABLE `reservation` (
  `ID` int(11) DEFAULT NULL,
  `DateReservation` date DEFAULT NULL,
  `Repat1` bit(1) DEFAULT NULL,
  `Repat2` bit(1) DEFAULT NULL,
  `Repat3` bit(1) DEFAULT NULL,
  `Matricule` int(11) DEFAULT NULL,
  `Annulation` bit(1) DEFAULT b'1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `reservation`
--
ALTER TABLE `reservation`
  ADD KEY `Matricule` (`Matricule`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
