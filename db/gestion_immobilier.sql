-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  sam. 30 sep. 2023 à 20:41
-- Version du serveur :  10.1.40-MariaDB
-- Version de PHP :  7.1.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gestion_immobilier`
--

-- --------------------------------------------------------

--
-- Structure de la table `cat_immobilier`
--

CREATE TABLE `cat_immobilier` (
  `ID_CAT` int(11) NOT NULL,
  `DESCR_CAT` varchar(150) NOT NULL,
  `STATUT_CAT` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `employes`
--

CREATE TABLE `employes` (
  `EMPLOYE_ID` bigint(20) NOT NULL,
  `NOM_EMP` varchar(150) NOT NULL,
  `PRENOM_EMP` varchar(150) NOT NULL,
  `EMAIL_EMP` varchar(30) DEFAULT NULL,
  `MINISTERE_ID` int(11) NOT NULL,
  `OU_ID` int(11) NOT NULL,
  `PROFILE_ID` int(11) NOT NULL,
  `IS_USER_SYSTEM` tinyint(4) NOT NULL COMMENT '1=Oui/0=Non	',
  `MATRICULE` varchar(30) NOT NULL,
  `MOT_DE_PASSE` varchar(250) DEFAULT NULL,
  `USER_ID` int(11) NOT NULL,
  `DATE_CREATION` datetime NOT NULL,
  `IS_ACTIF` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=En attente de validation/1=Valide/2=Annule',
  `IS_MUST_CHANGE_PWD` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=non/1=oui',
  `TOKEN` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `immobilisations`
--

CREATE TABLE `immobilisations` (
  `ID_IMMOBILISATION` int(11) NOT NULL,
  `CATH_ID` tinyint(4) NOT NULL,
  `DESCR_IMMOBILISATION` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `immo_immobilier`
--

CREATE TABLE `immo_immobilier` (
  `ID_IMMOBILIER` bigint(11) NOT NULL,
  `ID_CAT` int(11) NOT NULL,
  `TYPE_IMMO_ID` int(11) NOT NULL,
  `DATE_DEBUT_UTILISATION` date NOT NULL,
  `BARCODE` varchar(100) NOT NULL,
  `TAUX_AMORTISSEMENT` double NOT NULL COMMENT 'en pourcentage',
  `STATUT` int(11) NOT NULL COMMENT '1.En bon etat 2.declassé',
  `DATE_CREATION` datetime NOT NULL,
  `CREE_PAR` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `menus`
--

CREATE TABLE `menus` (
  `MENU_ID` int(11) NOT NULL,
  `MENU_DESC` varchar(100) NOT NULL,
  `STATUT` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=actif/0=Inactif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `menu_users`
--

CREATE TABLE `menu_users` (
  `MENU_USER_ID` int(11) NOT NULL,
  `PROFIL_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `IS_DELETE` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=non/1=oui (suppression logique == desactivation)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ou`
--

CREATE TABLE `ou` (
  `ID_OU` int(11) NOT NULL,
  `OU_DESC` varchar(250) NOT NULL,
  `OU_NIV_ID` int(11) NOT NULL,
  `MINISTERE_ID` int(11) NOT NULL,
  `STATUT_OU` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `ou_ministere`
--

CREATE TABLE `ou_ministere` (
  `MINISTERE_ID` int(11) NOT NULL,
  `DESC_MINISTERE` varchar(250) NOT NULL,
  `CODE_MINISTERE` varchar(100) NOT NULL,
  `STATUT_MIN` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `ou_niveau`
--

CREATE TABLE `ou_niveau` (
  `OU_NIV_ID` int(11) NOT NULL,
  `DESCR_NIV_OU` varchar(100) NOT NULL,
  `STATUT_NIV` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `profil`
--

CREATE TABLE `profil` (
  `PROFILE_ID` int(11) NOT NULL,
  `DESC_PROFIL` varchar(250) NOT NULL,
  `IS_DELETED` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=non/1=oui'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Rôles';

-- --------------------------------------------------------

--
-- Structure de la table `session_table`
--

CREATE TABLE `session_table` (
  `id_session` bigint(100) NOT NULL,
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `date_action` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `session_table`
--

INSERT INTO `session_table` (`id_session`, `id`, `ip_address`, `timestamp`, `data`, `date_action`) VALUES
(1, 'ofjukbvgddh2t1cp89i1st5rs8rmprej', '::1', 1696084988, '__ci_last_regenerate|i:1696084988;', '2023-09-30 14:37:06'),
(2, '04g3g9puno3gldupjc7neofa9qpuq4u4', '::1', 1696085207, '__ci_last_regenerate|i:1696084988;', '2023-09-30 14:43:08');

-- --------------------------------------------------------

--
-- Structure de la table `sous_menu_menu_rel`
--

CREATE TABLE `sous_menu_menu_rel` (
  `SOUS_MENU_ID` int(11) NOT NULL,
  `SOUS_MENU_DESC` varchar(200) NOT NULL,
  `MENU_ID` int(11) NOT NULL,
  `IS_DELETE` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1:Non/0:Oui'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `statut_immo`
--

CREATE TABLE `statut_immo` (
  `STATUT_IMMO_ID` int(11) NOT NULL,
  `STATUT_DESC` varchar(100) NOT NULL,
  `STATUT_IMMO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type_immobiler`
--

CREATE TABLE `type_immobiler` (
  `TYPE_IMMO_ID` int(11) NOT NULL,
  `TYPE_IMMO_DESC` varchar(30) NOT NULL,
  `STATUT_TYPE` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type_immobiler`
--

INSERT INTO `type_immobiler` (`TYPE_IMMO_ID`, `TYPE_IMMO_DESC`, `STATUT_TYPE`) VALUES
(1, 'Incorporelle', 1),
(2, 'Corporelle', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `cat_immobilier`
--
ALTER TABLE `cat_immobilier`
  ADD PRIMARY KEY (`ID_CAT`);

--
-- Index pour la table `employes`
--
ALTER TABLE `employes`
  ADD PRIMARY KEY (`EMPLOYE_ID`);

--
-- Index pour la table `immobilisations`
--
ALTER TABLE `immobilisations`
  ADD PRIMARY KEY (`ID_IMMOBILISATION`);

--
-- Index pour la table `immo_immobilier`
--
ALTER TABLE `immo_immobilier`
  ADD PRIMARY KEY (`ID_IMMOBILIER`);

--
-- Index pour la table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`MENU_ID`);

--
-- Index pour la table `menu_users`
--
ALTER TABLE `menu_users`
  ADD PRIMARY KEY (`MENU_USER_ID`);

--
-- Index pour la table `ou`
--
ALTER TABLE `ou`
  ADD PRIMARY KEY (`ID_OU`);

--
-- Index pour la table `ou_ministere`
--
ALTER TABLE `ou_ministere`
  ADD PRIMARY KEY (`MINISTERE_ID`);

--
-- Index pour la table `ou_niveau`
--
ALTER TABLE `ou_niveau`
  ADD PRIMARY KEY (`OU_NIV_ID`);

--
-- Index pour la table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`PROFILE_ID`);

--
-- Index pour la table `session_table`
--
ALTER TABLE `session_table`
  ADD PRIMARY KEY (`id_session`);

--
-- Index pour la table `sous_menu_menu_rel`
--
ALTER TABLE `sous_menu_menu_rel`
  ADD PRIMARY KEY (`SOUS_MENU_ID`);

--
-- Index pour la table `statut_immo`
--
ALTER TABLE `statut_immo`
  ADD PRIMARY KEY (`STATUT_IMMO_ID`);

--
-- Index pour la table `type_immobiler`
--
ALTER TABLE `type_immobiler`
  ADD PRIMARY KEY (`TYPE_IMMO_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `cat_immobilier`
--
ALTER TABLE `cat_immobilier`
  MODIFY `ID_CAT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `employes`
--
ALTER TABLE `employes`
  MODIFY `EMPLOYE_ID` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `immobilisations`
--
ALTER TABLE `immobilisations`
  MODIFY `ID_IMMOBILISATION` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `immo_immobilier`
--
ALTER TABLE `immo_immobilier`
  MODIFY `ID_IMMOBILIER` bigint(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `menus`
--
ALTER TABLE `menus`
  MODIFY `MENU_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `menu_users`
--
ALTER TABLE `menu_users`
  MODIFY `MENU_USER_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ou`
--
ALTER TABLE `ou`
  MODIFY `ID_OU` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ou_ministere`
--
ALTER TABLE `ou_ministere`
  MODIFY `MINISTERE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ou_niveau`
--
ALTER TABLE `ou_niveau`
  MODIFY `OU_NIV_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `profil`
--
ALTER TABLE `profil`
  MODIFY `PROFILE_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `session_table`
--
ALTER TABLE `session_table`
  MODIFY `id_session` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `sous_menu_menu_rel`
--
ALTER TABLE `sous_menu_menu_rel`
  MODIFY `SOUS_MENU_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `statut_immo`
--
ALTER TABLE `statut_immo`
  MODIFY `STATUT_IMMO_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `type_immobiler`
--
ALTER TABLE `type_immobiler`
  MODIFY `TYPE_IMMO_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
