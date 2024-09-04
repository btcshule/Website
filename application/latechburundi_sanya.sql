-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 28, 2023 at 04:30 AM
-- Server version: 10.5.23-MariaDB-log
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `latechburundi_sanya`
--

-- --------------------------------------------------------

--
-- Table structure for table `achats_sanya`
--

CREATE TABLE `achats_sanya` (
  `ID_ACHAT` int(11) NOT NULL,
  `ID_FOURNISSEUR` tinyint(4) NOT NULL,
  `DESIGNATION` varchar(100) NOT NULL,
  `QUANTITE` varchar(20) NOT NULL,
  `PU` varchar(20) NOT NULL,
  `PT` int(20) NOT NULL,
  `OBSERVATION` varchar(100) NOT NULL,
  `RESP_ACHAT` tinyint(4) NOT NULL,
  `DATE_ACHAT` date NOT NULL,
  `DATE_CREATION` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `STATUT` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cathegories`
--

CREATE TABLE `cathegories` (
  `CATH_ID` smallint(5) NOT NULL,
  `CATH_DESC` varchar(30) NOT NULL,
  `STATUT` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cathegories`
--

INSERT INTO `cathegories` (`CATH_ID`, `CATH_DESC`, `STATUT`) VALUES
(0, 'Services', 1),
(2, 'Materiels Bureatique', 1),
(3, 'Mat. Scolaires', 1),
(4, 'Mat. Artistiques', 1),
(5, 'Materiels de designs', 1),
(6, 'hshshshs', 1),
(7, 'Test', 1),
(8, 'Marakudja', 1),
(9, 'MAT BUREAUTIQUE', 1),
(10, 'IGISEKE NDUNDI', 1),
(11, 'Maintenance Informatique', 1),
(12, 'Formation en Informatique', 1),
(13, 'Secratariat', 1),
(14, 'Art Alimentaire', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cathegories_services`
--

CREATE TABLE `cathegories_services` (
  `CATH_ID` smallint(5) NOT NULL,
  `CATH_DESC` varchar(30) NOT NULL,
  `STATUT` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cathegories_services`
--

INSERT INTO `cathegories_services` (`CATH_ID`, `CATH_DESC`, `STATUT`) VALUES
(1, 'Services Mantenances', 1),
(2, 'Services Informatiques', 1);

-- --------------------------------------------------------

--
-- Table structure for table `clients_sanya`
--

CREATE TABLE `clients_sanya` (
  `ID_CLIENT` int(11) NOT NULL,
  `NOM_CLIENT` varchar(20) NOT NULL,
  `PRENOM_CLIENT` varchar(20) NOT NULL,
  `TEL_CLIENT` varchar(20) NOT NULL,
  `LOC_CLIENT` varchar(20) NOT NULL,
  `NIF` varchar(20) NOT NULL,
  `RS` varchar(100) NOT NULL,
  `RC` varchar(20) NOT NULL,
  `STATUT` tinyint(4) NOT NULL,
  `DATE_INSERTION` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients_sanya`
--

INSERT INTO `clients_sanya` (`ID_CLIENT`, `NOM_CLIENT`, `PRENOM_CLIENT`, `TEL_CLIENT`, `LOC_CLIENT`, `NIF`, `RS`, `RC`, `STATUT`, `DATE_INSERTION`) VALUES
(1, 'NDAYSENGA', 'Advaxe', '61128298', 'Muyinga', '4000002548', 'la tech', '8521/021', 1, '2023-11-27 08:36:20'),
(2, 'NIJIMBERE', 'Eric', '78524563', 'Gitega', '4000523678', 'MUKOPO SHOP', 'RC012/021', 1, '2023-11-29 09:19:05'),
(3, 'NDACAYISABA', 'Therence', '78965236', 'Gitega', '50004122', 'KIRA COMPANY', '4000/254', 1, '2023-12-08 07:27:47'),
(4, 'MIBURO', 'Eloge', '75486932', 'Muyinga', '4000255555', 'Eloge photography', '1111', 1, '2023-12-08 07:31:07'),
(5, 'KANYANA', 'Vestine', '78002255', 'Gitega', '400000000074', 'BWOGERA', 'RC 012455', 1, '2023-12-08 12:33:30'),
(6, 'Harerimana', 'Ezéchiel', '69283716', 'Ruzo', '400076453', 'Transport', '685', 1, '2023-12-08 17:32:00'),
(7, 'BIGIRIMANA', 'Joel', '68607794', 'ruzo', '40002547', 'MONGO SHOP', '2451', 1, '2023-12-09 11:56:28'),
(8, 'TUYIZERE', 'Olive', '67455625', 'GITEGA', '24000458', 'ARTDONT BUSINESS', '145872', 1, '2023-12-09 11:59:08'),
(9, 'NSAVYIMANA', 'J Marie', '61619514', 'MUYINGA', '24500125', 'HONNESTSHOP', '12504', 1, '2023-12-09 12:02:44'),
(10, 'NIJIMBERE', 'J Claude', '68536851', 'Bujumbura', '4000000568', 'MUSANISHOP', '5223', 1, '2023-12-09 14:10:49'),
(11, 'Adolphe', 'NIYIBIZI', '69686755', 'BUJUMBURA', '400875295', 'Maison Informatique', '2222', 1, '2023-12-09 14:12:15'),
(12, 'MILLY', 'SADI', '69116877', 'MUYINGA', '414141452563', 'STUDIO MILLYSADI', '2356', 1, '2023-12-09 14:13:32'),
(13, 'NDAYISABA', 'DAVIDE', '68125487', 'KARUSI', '5400125', 'IRUMVA SHOP', '254', 1, '2023-12-12 10:57:33'),
(14, 'IRANZI', 'IDI', '79766988', 'GITERANYI', '14875200', 'KEYCY TV', '14500', 1, '2023-12-12 10:59:30');

-- --------------------------------------------------------

--
-- Table structure for table `client_facture`
--

CREATE TABLE `client_facture` (
  `CLIENT_FACT_ID` bigint(50) NOT NULL,
  `CLIENT_ID` bigint(50) NOT NULL,
  `PATH_FACTURE` varchar(50) NOT NULL,
  `STATUT` tinyint(2) NOT NULL,
  `AMOUNT_DETTE` double NOT NULL DEFAULT 0,
  `IS_DETTE_PAID` tinyint(2) NOT NULL DEFAULT 0,
  `SELLER` varchar(50) NOT NULL,
  `DATE_ACTION` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comptes`
--

CREATE TABLE `comptes` (
  `ID_COMPTE` int(11) NOT NULL,
  `NO_COMPTE` int(11) NOT NULL,
  `DESC_COMPTE` varchar(100) NOT NULL,
  `STATUT` tinyint(4) NOT NULL,
  `DATE_CREATION` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comptes`
--

INSERT INTO `comptes` (`ID_COMPTE`, `NO_COMPTE`, `DESC_COMPTE`, `STATUT`, `DATE_CREATION`) VALUES
(1, 54, 'testimng', 1, '2023-11-26 07:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `data_electronique`
--

CREATE TABLE `data_electronique` (
  `ID_ELE` int(11) NOT NULL,
  `LIBELLE` varchar(100) NOT NULL,
  `IMPUTATION` varchar(50) NOT NULL,
  `DEBIT` varchar(20) NOT NULL,
  `CREDIT` varchar(20) NOT NULL,
  `SOLDE` varchar(20) NOT NULL,
  `DATE_ENTREE` date DEFAULT current_timestamp(),
  `EST_ENTREE` tinyint(4) NOT NULL,
  `STATUT` tinyint(4) NOT NULL DEFAULT 1,
  `DATE_ACTION` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `RESP_ELECT` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_livre_approvisionnement`
--

CREATE TABLE `data_livre_approvisionnement` (
  `ID_LIVRE_APPRO` int(11) NOT NULL,
  `LIBELLE` varchar(100) NOT NULL,
  `IMPUTATION` varchar(100) NOT NULL,
  `DEBIT` varchar(20) NOT NULL,
  `CREDIT` varchar(20) NOT NULL,
  `SOLDE` varchar(20) NOT NULL,
  `DATE_ENTREE` date NOT NULL,
  `EST_ENTREE` tinyint(4) NOT NULL DEFAULT 1,
  `STATUT` tinyint(4) NOT NULL,
  `DATE_ACTION` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `RESP_CAISSE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_livre_approvisionnement`
--

INSERT INTO `data_livre_approvisionnement` (`ID_LIVRE_APPRO`, `LIBELLE`, `IMPUTATION`, `DEBIT`, `CREDIT`, `SOLDE`, `DATE_ENTREE`, `EST_ENTREE`, `STATUT`, `DATE_ACTION`, `RESP_CAISSE`) VALUES
(1, 'alimentation de caisse', '21', '25000', '0', '25000', '2023-12-26', 1, 1, '2023-12-26 16:38:21', 10),
(2, 'ACHAT mat d\'entretien', '29', '0', '2000', '23000', '2023-12-28', 0, 1, '2023-12-28 09:14:37', 10);

-- --------------------------------------------------------

--
-- Table structure for table `data_livre_banque`
--

CREATE TABLE `data_livre_banque` (
  `ID_LIVRE_BANQUE` int(11) NOT NULL,
  `LIBELLE` varchar(100) NOT NULL,
  `IMPUTATION` varchar(100) NOT NULL,
  `DEBIT` varchar(20) NOT NULL,
  `CREDIT` varchar(20) NOT NULL,
  `SOLDE` varchar(20) NOT NULL,
  `DATE_ENTREE` date NOT NULL,
  `EST_ENTREE` tinyint(4) NOT NULL DEFAULT 1,
  `STATUT` tinyint(4) NOT NULL,
  `DATE_ACTION` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `RESP_CAISSE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_livre_banque`
--

INSERT INTO `data_livre_banque` (`ID_LIVRE_BANQUE`, `LIBELLE`, `IMPUTATION`, `DEBIT`, `CREDIT`, `SOLDE`, `DATE_ENTREE`, `EST_ENTREE`, `STATUT`, `DATE_ACTION`, `RESP_CAISSE`) VALUES
(1, 'versement en banque bgf cash', '18', '50000', '0', '50000', '2023-12-26', 1, 1, '2023-12-26 16:35:00', 10),
(2, 'retrait bcaincaire pour alimenter la caisse', '21', '0', '25000', '25000', '2023-12-26', 0, 1, '2023-12-26 16:37:17', 10);

-- --------------------------------------------------------

--
-- Table structure for table `data_livre_caisse`
--

CREATE TABLE `data_livre_caisse` (
  `ID_LIVRE_CAISSE` int(11) NOT NULL,
  `LIBELLE` varchar(100) NOT NULL,
  `IMPUTATION` varchar(50) NOT NULL,
  `DEBIT` varchar(20) NOT NULL,
  `CREDIT` varchar(20) NOT NULL,
  `SOLDE` varchar(20) NOT NULL,
  `DATE_ENTREE` date DEFAULT current_timestamp(),
  `EST_ENTREE` tinyint(4) NOT NULL,
  `STATUT` tinyint(4) NOT NULL DEFAULT 1,
  `DATE_ACTION` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `RESP_CAISSE` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_livre_caisse`
--

INSERT INTO `data_livre_caisse` (`ID_LIVRE_CAISSE`, `LIBELLE`, `IMPUTATION`, `DEBIT`, `CREDIT`, `SOLDE`, `DATE_ENTREE`, `EST_ENTREE`, `STATUT`, `DATE_ACTION`, `RESP_CAISSE`) VALUES
(1, 'vente de 4  boite de cahiers de 100f', '13', '60000', '0', '60000', '2023-12-26', 1, 0, '2023-12-26 16:27:45', 10),
(2, 'vente de 4boite de cahier de 100f', '13', '60000', '0', '60000', '2023-12-26', 1, 1, '2023-12-26 16:29:24', 10),
(3, 'versement en banque bgf', '18', '0', '50000', '10000', '2023-12-26', 0, 1, '2023-12-26 16:32:11', 10),
(4, 'vente de 5 falde à chemise', '13', '1500', '0', '11500', '2023-12-26', 1, 1, '2023-12-26 17:02:09', 10),
(5, 'paiement de la fact N', '26', '1000', '0', '12500', '2023-12-26', 1, 1, '2023-12-26 17:11:51', 10),
(6, 'formatage d\'ordinateur', '28', '60000', '0', '72500', '2023-12-26', 1, 1, '2023-12-26 17:31:10', 10),
(7, 'vente de 2 crayons et 4 panier idarapo ry\'uburundi', '13', '80400', '0', '152900', '2023-12-26', 1, 1, '2023-12-26 17:44:33', 10);

-- --------------------------------------------------------

--
-- Table structure for table `dettes_externes`
--

CREATE TABLE `dettes_externes` (
  `ID_DETTE_EXTERNE` int(11) NOT NULL,
  `ID_CLIENT` tinyint(4) NOT NULL,
  `DESIGNATION` varchar(50) NOT NULL,
  `MONTANT` varchar(20) NOT NULL,
  `DATE_DETTE` date NOT NULL,
  `DATE_INSERTION` datetime NOT NULL DEFAULT current_timestamp(),
  `STATUT` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dettes_externes`
--

INSERT INTO `dettes_externes` (`ID_DETTE_EXTERNE`, `ID_CLIENT`, `DESIGNATION`, `MONTANT`, `DATE_DETTE`, `DATE_INSERTION`, `STATUT`) VALUES
(1, 2, 'vente de 5 falde à chemise', '1000', '2023-12-26', '2023-12-26 09:03:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dettes_internes`
--

CREATE TABLE `dettes_internes` (
  `ID_DETTE_INTERNE` int(11) NOT NULL,
  `ID_FOURNISSEUR` tinyint(4) NOT NULL,
  `DESIGNATION` varchar(100) NOT NULL,
  `MONTANT` varchar(20) NOT NULL,
  `DATE_DETTE` date NOT NULL,
  `TYPE_DETTE` tinyint(4) NOT NULL DEFAULT 1,
  `DATE_INSERTION` datetime NOT NULL DEFAULT current_timestamp(),
  `STATUT` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dettes_internes`
--

INSERT INTO `dettes_internes` (`ID_DETTE_INTERNE`, `ID_FOURNISSEUR`, `DESIGNATION`, `MONTANT`, `DATE_DETTE`, `TYPE_DETTE`, `DATE_INSERTION`, `STATUT`) VALUES
(1, 13, 'achat ordinateur hp', '450000', '2023-12-26', 1, '2023-12-26 06:59:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `electroniques`
--

CREATE TABLE `electroniques` (
  `ID_AGENT` int(11) NOT NULL,
  `TYPE_AGENT` varchar(50) NOT NULL,
  `CASH` varchar(20) NOT NULL,
  `ELECTRONIQUE` varchar(20) NOT NULL,
  `DESC_TRANS` text NOT NULL,
  `DEBIT` int(11) NOT NULL,
  `CREDIT` int(11) NOT NULL,
  `SOLDE` int(11) NOT NULL,
  `EST_ENTREE` tinyint(4) NOT NULL DEFAULT 1,
  `DATE_INSERTION` timestamp NOT NULL DEFAULT current_timestamp(),
  `RESP_ELECT` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employes`
--

CREATE TABLE `employes` (
  `EMPLOYE_ID` bigint(20) NOT NULL,
  `NOM_EMP` varchar(150) NOT NULL,
  `PRENOM_EMP` varchar(150) NOT NULL,
  `EMAIL_EMP` varchar(100) DEFAULT NULL,
  `TEL_EMP` varchar(25) DEFAULT NULL,
  `PROFILE_ID` int(11) NOT NULL,
  `DIPLOME` tinyint(4) NOT NULL,
  `IS_USER_SYSTEM` tinyint(4) NOT NULL COMMENT '1=Oui/0=Non	',
  `MOT_DE_PASSE` varchar(250) DEFAULT NULL,
  `USER_ID` int(11) NOT NULL,
  `DATE_CREATION` datetime NOT NULL,
  `IS_ACTIF` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=En attente de validation/1=Valide/2=Annule',
  `IS_MUST_CHANGE_PWD` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=non/1=oui',
  `ID_BRANCHE` int(11) NOT NULL DEFAULT 1,
  `STATUT` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `employes`
--

INSERT INTO `employes` (`EMPLOYE_ID`, `NOM_EMP`, `PRENOM_EMP`, `EMAIL_EMP`, `TEL_EMP`, `PROFILE_ID`, `DIPLOME`, `IS_USER_SYSTEM`, `MOT_DE_PASSE`, `USER_ID`, `DATE_CREATION`, `IS_ACTIF`, `IS_MUST_CHANGE_PWD`, `ID_BRANCHE`, `STATUT`) VALUES
(1, 'NDAYISENGA', 'Advaxe', 'advaxe@latechburundi.org', '61128298', 6, 2, 1, 'e10adc3949ba59abbe56e057f20f883e', 1, '0000-00-00 00:00:00', 1, 0, 1, 1),
(2, 'BIGIRIMANA', 'Joel', 'infosanyaelectronics@gmail.com', '78569632', 4, 2, 1, '5edfc6451812523b09137418b57a636a', 0, '0000-00-00 00:00:00', 1, 1, 1, 1),
(4, 'RWASA', 'OSCAR', 'oscarbugagara@yahoo.fr', '79505127', 1, 3, 1, 'e10adc3949ba59abbe56e057f20f883e', 0, '0000-00-00 00:00:00', 1, 1, 1, 1),
(6, 'BUGAGARA', 'Datus', 'ciperconsulting@gmail.com', '62340446', 6, 4, 1, 'e10adc3949ba59abbe56e057f20f883e', 0, '0000-00-00 00:00:00', 1, 1, 6, 1),
(7, 'TEST', 'MOT DE PASSE', 'web@latechburundi.org', '69898947', 5, 1, 1, 'e10adc3949ba59abbe56e057f20f883e', 0, '0000-00-00 00:00:00', 1, 1, 1, 1),
(10, 'NSAVYIMANA', 'Jean Marie', 'jeanmarie2019nsavyimana@gmail.com', '61619514', 3, 2, 1, 'e10adc3949ba59abbe56e057f20f883e', 0, '0000-00-00 00:00:00', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `e_bank`
--

CREATE TABLE `e_bank` (
  `ID_E_BANK` int(11) NOT NULL,
  `LIBELLE` varchar(100) NOT NULL,
  `MONTANT` varchar(20) NOT NULL,
  `ELECTRONIQUE` varchar(20) NOT NULL,
  `COMMISSION` varchar(20) NOT NULL,
  `TYPE_AGENT` varchar(20) NOT NULL,
  `TELEPHONE` varchar(13) NOT NULL,
  `DATE_ENTREE` date DEFAULT current_timestamp(),
  `STATUT` tinyint(4) NOT NULL DEFAULT 1,
  `DATE_ACTION` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `RESP_ELECT` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `e_bank`
--

INSERT INTO `e_bank` (`ID_E_BANK`, `LIBELLE`, `MONTANT`, `ELECTRONIQUE`, `COMMISSION`, `TYPE_AGENT`, `TELEPHONE`, `DATE_ENTREE`, `STATUT`, `DATE_ACTION`, `RESP_ELECT`) VALUES
(1, 'CAPITAL SOCIAL', '300000', '200000', '0', 'Lumicash', '68607894', '0000-00-00', 1, '2023-12-28 11:50:27', 10),
(2, 'DEPOT', '20000', '20000', '800', 'Lumicash', '61619514', '2023-12-28', 1, '2023-12-28 11:51:31', 10);

-- --------------------------------------------------------

--
-- Table structure for table `fournisseurs_sanya`
--

CREATE TABLE `fournisseurs_sanya` (
  `ID_FOURNISSEUR` int(11) NOT NULL,
  `NOM_FOURNISSEUR` varchar(20) NOT NULL,
  `PRENOM_FOURNISSEUR` varchar(20) NOT NULL,
  `TEL_FOURNISSEUR` varchar(20) NOT NULL,
  `LOC_FOURNISSEUR` varchar(20) NOT NULL,
  `STATUT` tinyint(4) NOT NULL,
  `NIF` varchar(20) NOT NULL,
  `RC` varchar(20) NOT NULL,
  `RS` varchar(100) NOT NULL,
  `ID_BRANCHE` smallint(6) NOT NULL,
  `DATE_INSERTION` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fournisseurs_sanya`
--

INSERT INTO `fournisseurs_sanya` (`ID_FOURNISSEUR`, `NOM_FOURNISSEUR`, `PRENOM_FOURNISSEUR`, `TEL_FOURNISSEUR`, `LOC_FOURNISSEUR`, `STATUT`, `NIF`, `RC`, `RS`, `ID_BRANCHE`, `DATE_INSERTION`) VALUES
(1, 'RWASA', 'Oscar', '79066568', 'Bujumbura', 1, '400521', '7845/021', 'CIPER Consulting', 1, '2023-11-08 14:53:34'),
(2, 'NDIKUMANA', 'Pacifique', '78695100', 'Nyanza Lac', 1, '400057869', '23356/024', 'INFOTECH', 1, '2023-11-08 14:53:34'),
(3, 'Advaxe', 'NDAYISENGA', '78965478', 'Bujumbura', 1, '7845120/365', '12033/6541', 'IAU', 1, '2023-11-08 14:53:34'),
(4, 'NIYONKURU', 'Juliette', '78658956', 'Gitega', 1, '4000526/356', '1258/546', 'DUKORE TECH', 1, '2023-11-08 15:09:45'),
(5, 'NIYOMUKIZA', 'Gisele', '78965412', 'Bujumbura', 1, '400052665', '78541/021', 'GISELE SHOP', 1, '2023-11-09 16:42:37'),
(6, 'NAHIMANA', 'Jeanette', '69898947', 'Kayanza', 1, '40002532/211', 'RC/0214', 'MUYAGAA', 1, '2023-11-26 07:39:58'),
(7, 'TEST', 'HHH', '89446532', 'DRTFGHJ', 1, '856230', '86532', 'TGH', 1, '2023-11-26 07:49:24'),
(8, 'Test', 'Testing', '4563214', 'drftgyhuj', 1, '98465132', '489645134', 'resdtfyguh', 1, '2023-11-26 07:51:48'),
(9, 'ndayisenga', 'Advaxe', '6112598', 'tyghj', 1, '48526', '784652', '5ytguhj5465+', 1, '2023-11-27 06:08:43'),
(10, 'Mutessi', 'Odette', '67707700', 'Ngozi', 1, '400008994', '46786', 'Kora neza shop', 1, '2023-12-08 17:37:13'),
(11, 'DADA', 'KIKI', '68475621', 'KOBERO', 1, '458200', '3210', 'KIKI', 1, '2023-12-09 12:04:35'),
(12, 'CIMPAYE', 'Elissa', '76825202', 'NGOZI', 1, '125478', '136874', 'UMUHUZA SHOP', 1, '2023-12-09 12:08:02'),
(13, 'ZEBRA', 'MAISON INFO', '22223655', 'BUJA', 1, '44000058961', '78945', 'MAISON VENT DES MAT INFO', 1, '2023-12-09 14:15:11'),
(14, 'MAMA', 'SIFA', '69586959', 'MUYINGA', 1, '400000000007', '546', 'Magasininfo', 1, '2023-12-09 14:16:54'),
(15, 'TUYISHIMIRE', 'Jbosco', '68607498', 'KARUZI', 1, '711158810', '789', 'HOP TWESE TURASHOBOYE', 1, '2023-12-09 14:18:21'),
(16, 'MUGISHA', 'HASSAN', '79800000', 'BUTANYERERA', 1, '400123', '5214', 'RESHO SHOP', 1, '2023-12-12 11:00:59'),
(17, 'karim', 'ndakeza', '22456235', 'GITERANYI', 1, '1233004', '1465', 'RUMURI SHOP', 1, '2023-12-15 09:16:00'),
(18, 'NAHIMANA', 'Evelyne', '65653214', 'RUZO', 1, '00000000', '741', 'ASS des Femmes Burundaise', 1, '2023-12-17 15:08:53'),
(19, 'ALPHACD', 'TECHNOLOGIE', '22222256', 'Bujumbura-Mairie', 1, '4000000000145', '44569', 'M INFORMATIQUE', 1, '2023-12-19 11:03:52'),
(20, 'Ciza', 'Denis', '22457765', 'Buhumuza', 1, '40034', '19', 'Kora neza', 1, '2023-12-19 14:20:20'),
(21, 'kananga', 'bahbar', '69698547', 'tanzanie', 1, '', '', 'modelshop', 1, '2023-12-24 10:53:53'),
(22, 'BUKURU', 'DORIS', '078254410', 'GISANGAZUBA', 1, '41200047', '550', 'HUGUKA SHOP', 1, '2023-12-26 14:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `gros_client`
--

CREATE TABLE `gros_client` (
  `GROS_CLIENT_ID` tinyint(4) NOT NULL,
  `PRENOM_GROS_CLIENT` varchar(50) NOT NULL,
  `NOM_GROS_CLIENT` varchar(50) NOT NULL,
  `ADRESS_GROS_CLIENT` varchar(50) NOT NULL,
  `TEL_GROS_CLIENT` varchar(25) NOT NULL,
  `IS_CLIENT` int(11) NOT NULL DEFAULT 0,
  `STATUT` tinyint(4) NOT NULL DEFAULT 1,
  `NIF` varchar(20) NOT NULL,
  `RS` varchar(100) NOT NULL,
  `RC` varchar(20) NOT NULL,
  `ID_BRANCHE` int(11) NOT NULL DEFAULT 1,
  `DATE_INSERTION` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gros_client`
--

INSERT INTO `gros_client` (`GROS_CLIENT_ID`, `PRENOM_GROS_CLIENT`, `NOM_GROS_CLIENT`, `ADRESS_GROS_CLIENT`, `TEL_GROS_CLIENT`, `IS_CLIENT`, `STATUT`, `NIF`, `RS`, `RC`, `ID_BRANCHE`, `DATE_INSERTION`) VALUES
(1, 'Advaxe', 'NDAYISENGA', 'Muyinga', '61128298', 1, 0, '400056895', 'LA TECH BURUNDI COMPANY', '0458/021', 1, '2023-11-08 09:48:42'),
(2, 'Nestor', 'NIJIMBERE', 'Gitega', '69036956', 1, 1, '4000586857', 'NESTOR TV', '4758/022', 1, '2023-11-08 09:49:31'),
(3, 'clientpassager', '3', 'inconue', '00 000 000', 0, 0, '', 'Client3', '', 1, '2023-12-08 05:49:03'),
(4, 'Ange', 'NDIHOKUBWAYO', 'Gitega', '78556633', 1, 1, '400025866', 'KORA IBIKORWA', 'KORA021', 1, '2023-12-08 12:22:35'),
(5, 'Advaxe', 'NDAYISENGA', 'Bujumbura', '+25761128298', 1, 1, '478569222', 'HAGURUKA', '2222', 1, '2023-12-17 07:33:35'),
(6, 'Ezechiel', 'NDAYIZEYE', 'RUZO', '62659832', 1, 1, '40000085522', 'Secretariat public', '897', 1, '2023-12-17 15:06:00'),
(7, 'jean Marie Viany', 'nsavyimana', 'giteranyi', '71894285', 1, 1, '400005844', 'M INFO', '2346', 1, '2023-12-17 16:11:05'),
(8, 'PIERRE', 'NIMPAGARITSE', 'MISHIHA', '65646464', 1, 1, '111111100000', 'Studios', '11111', 1, '2023-12-17 18:58:40'),
(9, 'Jojo', 'Kim', 'Rusenyi', '67607794', 1, 1, '4086543', 'Mongo shop', '1982', 1, '2023-12-17 19:53:38'),
(10, 'Leoncie', 'NDAYISHIMIYE', 'RUZO', '65478608', 1, 1, '111144555', 'Magasin-boutique', '444', 1, '2023-12-19 11:00:39'),
(11, 'Leoncie', 'NDAYISHIMIYE', 'RUZO', '65478608', 1, 1, '111144555', 'Magasin-boutique', '444', 1, '2023-12-19 11:00:40'),
(12, 'déo', 'TUYIZERE', 'ruzo', '69897524', 1, 1, '4444444400', 'M electronic', '445', 1, '2023-12-19 11:01:58'),
(13, 'Aline', 'Butoyi', 'Cankuzo', '61412220', 1, 1, '40089', 'Irihoshop', '123', 1, '2023-12-19 14:17:27'),
(14, 'Alexis', 'BUCUMI', 'Giheta', '69898947', 1, 1, '', '', '', 1, '2023-12-20 05:34:22'),
(15, 'Isaac', 'NIMU', 'muy', '71869524', 1, 1, '', 'insgnshop', '', 1, '2023-12-24 10:52:25'),
(16, 'KEVINE', 'MUHOZA', 'GISHENYI', '68000555', 1, 1, '4001245', 'AKEZASHOP', '1100', 1, '2023-12-26 13:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `gros_client_facture`
--

CREATE TABLE `gros_client_facture` (
  `GROS_CLIENT_FACT_ID` bigint(50) NOT NULL,
  `NOM_CUSTOMER` varchar(50) NOT NULL,
  `TEL_CUSTOMER` varchar(20) DEFAULT NULL,
  `GROS_CLIENT_ID` bigint(50) NOT NULL,
  `PATH_FACTURE` varchar(50) NOT NULL,
  `STATUT` tinyint(2) NOT NULL,
  `AMOUNT_DETTE` double NOT NULL DEFAULT 0,
  `IS_DETTE_PAID` tinyint(2) NOT NULL DEFAULT 0,
  `SELLER` varchar(50) NOT NULL,
  `NUM_FACTURE` varchar(25) NOT NULL,
  `DATE_ACTION` datetime NOT NULL DEFAULT current_timestamp(),
  `PHAR_ID` tinyint(2) NOT NULL DEFAULT 1,
  `TYPE_VENTE_ID` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gros_entrees_stock`
--

CREATE TABLE `gros_entrees_stock` (
  `ID_ENTREE` int(20) NOT NULL,
  `GROS_STOCK_ID` int(255) NOT NULL,
  `TYPE_STOCK` tinyint(4) NOT NULL DEFAULT 1,
  `QUANTITE_PRODUIT` int(20) NOT NULL DEFAULT 0,
  `PRIX_ACHAT_UNITAIRE` int(11) NOT NULL DEFAULT 0,
  `ID_FOURNISSEUR` tinyint(4) NOT NULL,
  `RESP_CAISSE` tinyint(4) NOT NULL,
  `TOTAL_ACHAT` int(11) NOT NULL,
  `PRIX_VENTE_UNITAIRE` int(11) DEFAULT 0,
  `COMMENTAIRE` text NOT NULL,
  `DATE_INSERTION` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gros_entrees_stock`
--

INSERT INTO `gros_entrees_stock` (`ID_ENTREE`, `GROS_STOCK_ID`, `TYPE_STOCK`, `QUANTITE_PRODUIT`, `PRIX_ACHAT_UNITAIRE`, `ID_FOURNISSEUR`, `RESP_CAISSE`, `TOTAL_ACHAT`, `PRIX_VENTE_UNITAIRE`, `COMMENTAIRE`, `DATE_INSERTION`) VALUES
(1, 3, 2, 14, 25, 8, 7, 350, 25, 'test', '2023-12-26 16:34:46'),
(2, 1, 2, 12, 10000, 22, 10, 120000, 12000, 'achat au comptant', '2023-12-26 16:34:55'),
(3, 2, 1, 10, 150, 19, 10, 1500, 200, 'aprrov mses', '2023-12-26 16:40:33'),
(4, 6, 1, 10, 15000, 10, 10, 150000, 20000, 'achat au comptant', '2023-12-26 16:42:23');

-- --------------------------------------------------------

--
-- Table structure for table `gros_produit`
--

CREATE TABLE `gros_produit` (
  `GROS_PRODUIT_ID` int(11) NOT NULL,
  `GROS_PRODUIT_DESCR` varchar(50) DEFAULT NULL,
  `GROS_UNIT_ID` int(1) DEFAULT NULL,
  `DATE_INSERTION` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `gros_produit`
--

INSERT INTO `gros_produit` (`GROS_PRODUIT_ID`, `GROS_PRODUIT_DESCR`, `GROS_UNIT_ID`, `DATE_INSERTION`) VALUES
(1, 'Cadre A3', 2, '2023-11-02 22:36:37'),
(2, 'Crayon Long', 2, '2023-11-02 22:36:45'),
(3, 'Cadre A4', 1, '2023-11-02 22:36:54'),
(4, 'Cahier 100 Feuilles', 2, '2023-11-02 22:37:02'),
(5, 'Livre Kirundi 5 Eme', 2, '2023-11-03 05:00:47'),
(6, 'kjf', 3, '2023-11-05 11:55:13'),
(7, 'Inkoko 1', 3, '2023-11-05 15:43:24'),
(8, 'Test done88', 2, '2023-11-05 15:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `gros_stock`
--

CREATE TABLE `gros_stock` (
  `GROS_STOCK_ID` int(3) NOT NULL,
  `GROS_PRODUIT_ID` tinyint(4) DEFAULT NULL,
  `QNTE` int(10) DEFAULT 0,
  `PA_U` int(10) DEFAULT 0,
  `PV_U` int(10) DEFAULT 0,
  `PA_T` int(10) DEFAULT 0,
  `BRANCHE_ID` tinyint(4) NOT NULL DEFAULT 1,
  `STATUT` varchar(10) DEFAULT NULL,
  `DATE_INSERTION` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `gros_stock`
--

INSERT INTO `gros_stock` (`GROS_STOCK_ID`, `GROS_PRODUIT_ID`, `QNTE`, `PA_U`, `PV_U`, `PA_T`, `BRANCHE_ID`, `STATUT`, `DATE_INSERTION`) VALUES
(1, 1, 12, 15000, 20000, 180000, 1, '1', '2023-11-06 07:22:34'),
(2, 2, 5, 150, 200, 750, 1, '1', '2023-11-02 22:38:00'),
(3, 3, 111, 17000, 22000, 1887000, 1, '1', '2023-11-06 07:05:27'),
(4, 4, 90, 1500, 1800, 135000, 1, '1', '2023-11-02 23:01:19'),
(5, 5, 25, 15000, 20000, 375000, 1, '1', '2023-11-05 10:38:06'),
(6, 6, 0, 0, 0, 0, 1, '1', '2023-11-05 11:55:13'),
(7, 7, 174, 15000, 20000, 2610000, 1, '1', '2023-11-05 15:45:27'),
(8, 8, 0, 0, 0, 0, 1, '1', '2023-11-05 15:54:02');

-- --------------------------------------------------------

--
-- Table structure for table `gros_unite`
--

CREATE TABLE `gros_unite` (
  `GROS_UNIT_ID` int(11) NOT NULL,
  `UNITE_DESCR` varchar(25) NOT NULL,
  `STATUT` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gros_unite`
--

INSERT INTO `gros_unite` (`GROS_UNIT_ID`, `UNITE_DESCR`, `STATUT`) VALUES
(1, 'Mat Bureautiques', 1),
(2, 'Mat Scolaires', 1),
(3, 'Corbeille', 1),
(4, 'Fournitures de bureaux', 1),
(5, 'Alimentations', 1),
(6, 'jsduuidudduj', 1);

-- --------------------------------------------------------

--
-- Table structure for table `gros_ventes_produits`
--

CREATE TABLE `gros_ventes_produits` (
  `ID_VENTES` bigint(20) NOT NULL,
  `GROS_CLIENT_FACT_ID` bigint(50) NOT NULL,
  `GROS_STOCK_ID` int(11) NOT NULL,
  `QUANTITE` int(11) NOT NULL,
  `PRIX_UNITAIRE` int(11) NOT NULL,
  `PRIX_TOTAL` int(11) NOT NULL,
  `NET_PAID` int(11) NOT NULL,
  `P_ACHAT_TOTAL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gros_ventes_produits`
--

INSERT INTO `gros_ventes_produits` (`ID_VENTES`, `GROS_CLIENT_FACT_ID`, `GROS_STOCK_ID`, `QUANTITE`, `PRIX_UNITAIRE`, `PRIX_TOTAL`, `NET_PAID`, `P_ACHAT_TOTAL`) VALUES
(1, 1, 2, 20, 55000, 1100000, 1100000, 600000),
(2, 2, 1, 1, 35000, 35000, 35000, 20000),
(3, 3, 1, 1, 35000, 35000, 35000, 20000),
(4, 4, 1, 1, 25000, 25000, 25000, 20000),
(5, 5, 2, 2, 60000, 120000, 120000, 60000),
(6, 5, 1, 4, 35000, 140000, 140000, 80000),
(7, 6, 1, 6, 25000, 150000, 150000, 120000),
(8, 6, 2, 6, 45000, 270000, 270000, 180000);

-- --------------------------------------------------------

--
-- Table structure for table `immo_immobilier`
--

CREATE TABLE `immo_immobilier` (
  `ID_IMMOBILIER` bigint(11) NOT NULL,
  `IMMOB_DESC` text NOT NULL,
  `TYPE_IMMO_ID` tinyint(4) NOT NULL,
  `STATUT` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1.En bon etat 2.declassé'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `immo_immobilier`
--

INSERT INTO `immo_immobilier` (`ID_IMMOBILIER`, `IMMOB_DESC`, `TYPE_IMMO_ID`, `STATUT`) VALUES
(1, 'OK', 2, 1),
(2, 'TEST', 2, 1),
(3, 'EGO', 2, 1),
(4, 'SAWA', 2, 1),
(5, 'rf', 3, 1),
(6, 'ok', 3, 1),
(7, 'l', 1, 1),
(8, 'sss', 2, 1),
(9, 'ok', 2, 1),
(10, 'rev', 2, 1),
(11, 'ddd', 2, 1),
(12, 'mat', 2, 1),
(13, 'ok', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `imputations`
--

CREATE TABLE `imputations` (
  `ID_IMPUTATION` int(11) NOT NULL,
  `CODE_IMPUTATION` varchar(10) NOT NULL,
  `DESC_IMPUTATION` varchar(100) NOT NULL,
  `STATUT` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `imputations`
--

INSERT INTO `imputations` (`ID_IMPUTATION`, `CODE_IMPUTATION`, `DESC_IMPUTATION`, `STATUT`) VALUES
(1, '41', 'Clients', 1),
(2, '40', 'Fournisseurs', 1),
(3, '10', 'Capital', 1),
(4, '452', 'bhsygsgw', 1),
(5, '45', 'hhh', 1),
(6, '523', 'testing', 1),
(7, '101', 'Capital social', 1),
(8, '17', 'emprunt', 1),
(9, '4111', 'client Anette', 1),
(10, '4112', 'client RUNYARI', 1),
(11, '4113', 'Client Oscar', 1),
(12, '6010', 'Cout de marchandises vendues', 1),
(13, '7010', 'vente marchandises', 1),
(14, '371', 'Mses', 1),
(15, '6172', 'MFC', 1),
(16, '6300', 'ASC', 1),
(17, '6172', 'Carburant', 1),
(18, '5611', 'Banque BGF', 1),
(19, '5612', 'Banque BANCOBU', 1),
(20, '5613', 'FADECO', 1),
(21, '5710', 'Caisse', 1),
(22, '6346', 'frais de publicités', 1),
(23, '6343', 'frais de la main d\'oeuvre', 1),
(24, '6345', 'frais de déplacement et de communication', 1),
(25, '6690', 'Impot et taxe', 1),
(26, '4680', 'autres débiteurs divers', 1),
(27, '4690', 'autres crediteurs divers', 1),
(28, '6323', 'entretien et reparation', 1),
(29, '6175', 'produits d\'entretien et reparation', 1),
(30, '6175', 'produits d\'entretien et reparation', 1),
(31, '4190', 'Autres clients', 1),
(32, '6500', 'Charge du personnel de SANYA SHOP', 1),
(33, '1711', 'Emprunt bancaire', 1),
(34, '1712', 'Emprunt caisse d\'entreprise', 1),
(35, '2511', 'mat secolaire', 1),
(36, '2512', 'mat info', 1),
(37, '2513', 'mat art', 1),
(38, '5538', 'monnaie electronique', 1),
(39, '5624', 'E-MONEY BANK', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventaire_immobilier`
--

CREATE TABLE `inventaire_immobilier` (
  `INVENTAIRE_IMMO_ID` bigint(20) NOT NULL,
  `ID_IMMOBILIER` int(11) DEFAULT NULL,
  `BARCODE` varchar(100) NOT NULL,
  `PATH_BARCODE` varchar(100) DEFAULT NULL,
  `PRIX_IMMO` float DEFAULT NULL,
  `OU_EMPLACEMENT_ID` int(11) DEFAULT NULL,
  `DATE_ACHAT` date DEFAULT NULL,
  `ID_OU` int(11) DEFAULT NULL,
  `CODE_REF` varchar(50) DEFAULT NULL,
  `USER_ID` bigint(20) DEFAULT NULL,
  `CARACTERISTIQUES` text DEFAULT NULL,
  `PROPRIETAIRE_ID` bigint(20) NOT NULL COMMENT 'Proprietaire du materiel',
  `STATUT_IMMO_ID` tinyint(4) NOT NULL,
  `MARQUE_ID` int(11) NOT NULL COMMENT 'OU type',
  `DATE_INSERTION` datetime DEFAULT current_timestamp(),
  `STATUT` int(11) NOT NULL DEFAULT 0 COMMENT '0=En attente de validation/1=Valide/2=Annullé'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lumicash`
--

CREATE TABLE `lumicash` (
  `ID_LUMICASH` int(11) NOT NULL,
  `TYPE_AGENT` varchar(50) NOT NULL,
  `SOLDE_LUMICASH` varchar(20) NOT NULL,
  `ELECTRONIQUE` varchar(20) NOT NULL,
  `DESC_LUMICASH` text NOT NULL,
  `DATE_LUMICASH` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `RESP_LUMICASH` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mag_client_factur`
--

CREATE TABLE `mag_client_factur` (
  `GROS_CLIENT_FACT_ID` bigint(50) NOT NULL,
  `GROS_CLIENT_ID` bigint(50) NOT NULL,
  `PATH_FACTURE` varchar(50) NOT NULL,
  `STATUT` tinyint(2) NOT NULL,
  `AMOUNT_DETTE` double NOT NULL DEFAULT 0,
  `ECHEANCE` date DEFAULT NULL,
  `TYPE_DETTE` int(11) DEFAULT NULL,
  `IS_DETTE_PAID` tinyint(2) NOT NULL DEFAULT 0,
  `SELLER` varchar(50) NOT NULL,
  `NUM_FACTURE` varchar(25) NOT NULL,
  `DATE_ACTION` datetime NOT NULL,
  `ID_BRANCHE` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mag_client_factur`
--

INSERT INTO `mag_client_factur` (`GROS_CLIENT_FACT_ID`, `GROS_CLIENT_ID`, `PATH_FACTURE`, `STATUT`, `AMOUNT_DETTE`, `ECHEANCE`, `TYPE_DETTE`, `IS_DETTE_PAID`, `SELLER`, `NUM_FACTURE`, `DATE_ACTION`, `ID_BRANCHE`) VALUES
(1, 1, '', 1, 0, '0000-00-00', 1, 0, '10', '001-2023', '2023-12-26 19:20:17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mag_client_facture`
--

CREATE TABLE `mag_client_facture` (
  `GROS_CLIENT_FACT_ID` bigint(50) NOT NULL,
  `GROS_CLIENT_ID` bigint(50) NOT NULL,
  `PATH_FACTURE` varchar(50) NOT NULL,
  `STATUT` tinyint(2) NOT NULL,
  `AMOUNT_DETTE` double NOT NULL DEFAULT 0,
  `ECHEANCE` date DEFAULT NULL,
  `TYPE_DETTE` int(11) DEFAULT NULL,
  `IS_DETTE_PAID` tinyint(2) NOT NULL DEFAULT 0,
  `SELLER` varchar(50) NOT NULL,
  `NUM_FACTURE` varchar(25) NOT NULL,
  `DATE_ACTION` datetime NOT NULL,
  `ID_BRANCHE` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mag_client_facture`
--

INSERT INTO `mag_client_facture` (`GROS_CLIENT_FACT_ID`, `GROS_CLIENT_ID`, `PATH_FACTURE`, `STATUT`, `AMOUNT_DETTE`, `ECHEANCE`, `TYPE_DETTE`, `IS_DETTE_PAID`, `SELLER`, `NUM_FACTURE`, `DATE_ACTION`, `ID_BRANCHE`) VALUES
(1, 9, '', 1, 0, '0000-00-00', 1, 0, '10', '001-2023', '2023-12-26 17:21:39', 1),
(2, 14, '', 1, 0, '0000-00-00', 1, 0, '10', '002-2023', '2023-12-26 18:12:39', 1),
(3, 16, '', 0, 0, '0000-00-00', 1, 0, '10', '003-2023', '2023-12-26 18:23:37', 1),
(4, 2, '', 0, 1000, '2023-12-31', 1, 1, '10', '004-2023', '2023-12-26 18:58:51', 1),
(5, 14, '', 0, 0, '0000-00-00', 1, 0, '10', '005-2023', '2023-12-26 19:36:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mag_ventes_produits`
--

CREATE TABLE `mag_ventes_produits` (
  `ID_VENTES` bigint(20) NOT NULL,
  `GROS_CLIENT_FACT_ID` bigint(50) NOT NULL,
  `STOCK_ID` int(11) NOT NULL,
  `IS_SERVICE` tinyint(4) NOT NULL COMMENT '1.oui 0.non',
  `QUANTITE` int(11) NOT NULL,
  `PRIX_UNITAIRE` int(11) NOT NULL,
  `PRIX_TOTAL` int(11) NOT NULL,
  `NET_PAID` int(11) NOT NULL,
  `P_ACHAT_TOTAL` int(11) DEFAULT NULL,
  `POURC_REDUCTION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mag_ventes_produits`
--

INSERT INTO `mag_ventes_produits` (`ID_VENTES`, `GROS_CLIENT_FACT_ID`, `STOCK_ID`, `IS_SERVICE`, `QUANTITE`, `PRIX_UNITAIRE`, `PRIX_TOTAL`, `NET_PAID`, `P_ACHAT_TOTAL`, `POURC_REDUCTION`) VALUES
(1, 1, 3, 0, 6, 200, 1200, 1200, 900, 0),
(2, 2, 2, 0, 4, 15000, 60000, 60000, 40000, 0),
(3, 3, 2, 0, 2, 15000, 30000, 30000, 20000, 0),
(4, 4, 6, 0, 5, 500, 2500, 2500, 125, 0),
(5, 5, 3, 0, 2, 200, 400, 400, 300, 0),
(6, 5, 11, 0, 4, 20000, 80000, 80000, 60000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `mag_ventes_services`
--

CREATE TABLE `mag_ventes_services` (
  `ID_VENTES` bigint(20) NOT NULL,
  `GROS_CLIENT_FACT_ID` bigint(50) NOT NULL,
  `STOCK_ID` int(11) NOT NULL,
  `IS_SERVICE` tinyint(4) NOT NULL COMMENT '1.oui 0.non',
  `QUANTITE` int(11) NOT NULL,
  `PRIX_UNITAIRE` int(11) NOT NULL,
  `PRIX_TOTAL` int(11) NOT NULL,
  `NET_PAID` int(11) NOT NULL,
  `P_ACHAT_TOTAL` int(11) DEFAULT NULL,
  `POURC_REDUCTION` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mag_ventes_services`
--

INSERT INTO `mag_ventes_services` (`ID_VENTES`, `GROS_CLIENT_FACT_ID`, `STOCK_ID`, `IS_SERVICE`, `QUANTITE`, `PRIX_UNITAIRE`, `PRIX_TOTAL`, `NET_PAID`, `P_ACHAT_TOTAL`, `POURC_REDUCTION`) VALUES
(1, 1, 2, 1, 1, 60000, 60000, 60000, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `marque_immo`
--

CREATE TABLE `marque_immo` (
  `MARQUE_ID` int(11) NOT NULL,
  `DESCR_MARQUE` varchar(150) NOT NULL,
  `STATUT` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marque_immo`
--

INSERT INTO `marque_immo` (`MARQUE_ID`, `DESCR_MARQUE`, `STATUT`) VALUES
(1, 'ok', 1);

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `MENU_ID` int(11) NOT NULL,
  `MENU_DESC` varchar(100) NOT NULL,
  `STATUT` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=actif/0=Inactif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menu_users`
--

CREATE TABLE `menu_users` (
  `MENU_USER_ID` int(11) NOT NULL,
  `PROFIL_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `IS_DELETE` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=non/1=oui (suppression logique == desactivation)'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `niveaux`
--

CREATE TABLE `niveaux` (
  `ID_NIVEAU` int(11) NOT NULL,
  `DESC_NIVEAU` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `niveaux`
--

INSERT INTO `niveaux` (`ID_NIVEAU`, `DESC_NIVEAU`) VALUES
(1, 'Humanités Générales'),
(2, 'Baccalauréat'),
(3, 'Maitrise'),
(4, 'Doctorat');

-- --------------------------------------------------------

--
-- Table structure for table `occupations`
--

CREATE TABLE `occupations` (
  `OCCUPATION_ID` int(11) NOT NULL,
  `OCCUPATION_DESC` varchar(150) NOT NULL,
  `STATUT` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `occupations`
--

INSERT INTO `occupations` (`OCCUPATION_ID`, `OCCUPATION_DESC`, `STATUT`) VALUES
(1, 'Informaticien', 1),
(2, 'Directeur de l\'entreprise', 1),
(3, 'Responsable caisse', 1),
(4, 'Agent lumicash', 1),
(5, 'Gestionnaire', 1),
(6, 'Comptable', 1),
(7, 'planton', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ou`
--

CREATE TABLE `ou` (
  `ID_OU` int(11) NOT NULL,
  `OU_DESC` varchar(250) NOT NULL,
  `MINISTERE_ID` int(11) NOT NULL DEFAULT 1,
  `OU_NUM` varchar(25) DEFAULT NULL,
  `STATUT_OU` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Unité d''organisation';

--
-- Dumping data for table `ou`
--

INSERT INTO `ou` (`ID_OU`, `OU_DESC`, `MINISTERE_ID`, `OU_NUM`, `STATUT_OU`) VALUES
(1, 'SECRETARIAT PERMANENT', 1, 'BUREAU-01', 1),
(2, 'INSPECTION GENERALE DU MINISTERE', 1, 'BUREAU-02', 1),
(3, 'DIRECTION DE L\'INFORMATIQUE', 1, 'BUREAU-03', 1),
(4, 'DIRECTION GENERALE DE L\'ADMINISTRATION ET DES FINANCES', 1, 'BUREAU-04', 1),
(5, 'DIRECTION GENERALE DES FINANCES PUBLIQUES', 1, 'BUREAU-05', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ou_departement`
--

CREATE TABLE `ou_departement` (
  `OU_DEP_ID` int(11) NOT NULL,
  `DEP_DESC` varchar(250) NOT NULL,
  `OU_ID` int(11) NOT NULL,
  `STATUT` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ou_departement`
--

INSERT INTO `ou_departement` (`OU_DEP_ID`, `DEP_DESC`, `OU_ID`, `STATUT`) VALUES
(1, 'Ok', 4, 1),
(2, 'IT', 3, 1),
(3, 'GT', 3, 1),
(4, 'HAHAHA', 3, 1),
(5, 'HHHH', 5, 1),
(6, 'DADADAD', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ou_emplacement`
--

CREATE TABLE `ou_emplacement` (
  `OU_EMPLACEMENT_ID` int(11) NOT NULL,
  `DESCR_EMPLACEMENT_OU` varchar(250) NOT NULL,
  `STATUT_EMP` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ou_emplacement`
--

INSERT INTO `ou_emplacement` (`OU_EMPLACEMENT_ID`, `DESCR_EMPLACEMENT_OU`, `STATUT_EMP`) VALUES
(1, 'ol', 1),
(2, 'de', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ou_ministere`
--

CREATE TABLE `ou_ministere` (
  `MINISTERE_ID` int(11) NOT NULL,
  `DESC_MINISTERE` varchar(250) NOT NULL,
  `CODE_MINISTERE` varchar(100) NOT NULL,
  `STATUT_MIN` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `ou_ministere`
--

INSERT INTO `ou_ministere` (`MINISTERE_ID`, `DESC_MINISTERE`, `CODE_MINISTERE`, `STATUT_MIN`) VALUES
(1, 'Ministère des finances, du budget et de la planification economique', 'MIN124-74', 1),
(2, 'Ministère de la justice', 'MINI0041', 1),
(3, 'Ministère de l\'intérieur, du développement communautaire et de la sécurité publique', 'MIN45-007', 1),
(4, 'Ministère de l\'éducation nationale et de la recherche scientifique', 'MIN007-221', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `PRODUCT_ID` int(11) NOT NULL,
  `PRODUCT_DESC` varchar(30) NOT NULL,
  `CATH_ID` smallint(30) NOT NULL,
  `CODE` varchar(10) NOT NULL,
  `ID_BRANCHE` tinyint(4) NOT NULL DEFAULT 1,
  `PIECES` varchar(5) DEFAULT NULL,
  `DATE_INSERTION` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PRODUCT_ID`, `PRODUCT_DESC`, `CATH_ID`, `CODE`, `ID_BRANCHE`, `PIECES`, `DATE_INSERTION`) VALUES
(1, 'CAHIERS DE 100 feuilles', 3, 'c1', 1, '6', '2023-12-26 14:09:23'),
(2, 'crayon simple', 3, 'MS', 1, '12', '2023-12-26 14:11:03'),
(3, 'falde à chemise', 2, 'MB', 1, '12', '2023-12-26 14:11:47'),
(4, 'Falde à suspendre', 2, 'MB2', 1, '12', '2023-12-26 14:12:20'),
(5, 'panier in fibre synthetique', 4, 'MA1', 1, '1', '2023-12-26 14:12:59'),
(6, 'Panier idarapo ry\'ikarundi', 4, 'MA2', 1, '4', '2023-12-26 14:13:46'),
(7, 'raparation d\'ordinateur', 11, 'MI1', 1, '20', '2023-12-26 16:53:07'),
(8, 'Installation d\'anti-virus', 11, 'MI2', 1, '20', '2023-12-26 16:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `profil`
--

CREATE TABLE `profil` (
  `PROFILE_ID` int(11) NOT NULL,
  `DESC_PROFIL` varchar(250) NOT NULL,
  `IS_DELETED` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=non/1=oui'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci COMMENT='Rôles';

--
-- Dumping data for table `profil`
--

INSERT INTO `profil` (`PROFILE_ID`, `DESC_PROFIL`, `IS_DELETED`) VALUES
(1, 'Directeur', 0),
(2, 'Gestionnaire', 0),
(3, 'Informaticien', 0),
(4, 'Caissier', 0),
(5, 'Maintenance', 0),
(6, 'Administrateur', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sanya_branches`
--

CREATE TABLE `sanya_branches` (
  `ID_BRANCHE` int(11) NOT NULL,
  `DESCRIPTION_BRANCH` varchar(100) NOT NULL,
  `LOCALISATION` varchar(30) NOT NULL,
  `STATUT` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanya_branches`
--

INSERT INTO `sanya_branches` (`ID_BRANCHE`, `DESCRIPTION_BRANCH`, `LOCALISATION`, `STATUT`) VALUES
(1, 'SANYA SHOP', 'MUYNGA', 1),
(2, 'SANYASHOP', 'BUJA-MAIRIE', 1),
(3, 'Centre-Expo tourisme', 'Musée-vivant', 1),
(4, 'Maison Informatique', 'GITEGA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sanya_services`
--

CREATE TABLE `sanya_services` (
  `PRODUCT_ID` int(11) NOT NULL,
  `PRODUCT_DESC` varchar(30) NOT NULL,
  `CATH_ID` smallint(30) NOT NULL,
  `CODE` varchar(10) NOT NULL,
  `PRIX` varchar(15) NOT NULL,
  `ID_BRANCHE` tinyint(4) NOT NULL DEFAULT 1,
  `DATE_INSERTION` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sanya_services`
--

INSERT INTO `sanya_services` (`PRODUCT_ID`, `PRODUCT_DESC`, `CATH_ID`, `CODE`, `PRIX`, `ID_BRANCHE`, `DATE_INSERTION`) VALUES
(1, 'entretien d\'ordinateur', 1, 'MI4', '20000', 1, '2023-12-26 17:17:10'),
(2, 'Formatage d\'ordinateur', 1, 'MI5', '60000', 1, '2023-12-26 17:17:47');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `ID_SERVICE` int(11) NOT NULL,
  `DESIGNATION` varchar(50) NOT NULL,
  `ID_USER` tinyint(4) NOT NULL,
  `BRANCHE` tinyint(4) NOT NULL,
  `ID_CLIENT` tinyint(4) NOT NULL,
  `PC` varchar(20) NOT NULL,
  `MO` varchar(20) NOT NULL,
  `AF` varchar(20) NOT NULL,
  `PT` varchar(20) NOT NULL,
  `COMMENTAIRE` varchar(250) NOT NULL,
  `VA` varchar(20) NOT NULL,
  `PV` varchar(20) NOT NULL,
  `DATE_CREATION` datetime NOT NULL DEFAULT current_timestamp(),
  `STATUT` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`ID_SERVICE`, `DESIGNATION`, `ID_USER`, `BRANCHE`, `ID_CLIENT`, `PC`, `MO`, `AF`, `PT`, `COMMENTAIRE`, `VA`, `PV`, `DATE_CREATION`, `STATUT`) VALUES
(1, 'formatage d\'ordinateur', 10, 1, 1, '30000', '20000', '5000', '55000', 'on a bien installé un nouveau windows', '5000', '60000', '2023-12-26 19:27:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `session_table`
--

CREATE TABLE `session_table` (
  `id_session` bigint(100) NOT NULL,
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `data` text NOT NULL,
  `date_action` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `session_table`
--

INSERT INTO `session_table` (`id_session`, `id`, `ip_address`, `timestamp`, `data`, `date_action`) VALUES
(1122, 'm7t2nffdldve9m3h6h37p4nkv2jbh58p', '::1', 1701975747, '__ci_last_regenerate|i:1701975747;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-07 18:55:09'),
(1123, 'bv6p2md56gcbvohqbj5uiu7ctcreg7ps', '::1', 1701978417, '__ci_last_regenerate|i:1701978417;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-07 19:02:27'),
(1124, 'h4oo1fq4rge64c7p6g18unigfrva0269', '::1', 1701979263, '__ci_last_regenerate|i:1701979263;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-07 19:46:57'),
(1125, '0qe6p1j4njjloodqfek9lft5qgki51kp', '::1', 1701980637, '__ci_last_regenerate|i:1701980637;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-07 20:01:03'),
(1126, 'j28folbcjufnfqkscgu8dv5h644ajp37', '::1', 1701980896, '__ci_last_regenerate|i:1701980637;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-07 20:23:57'),
(1127, 'bkhb7tg6705qiubm2801g76c68s9b36g', '::1', 1702008477, '__ci_last_regenerate|i:1702008477;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 04:01:30'),
(1128, 'e68u1to39o0pgjh4mrafn4g5sb5pf6n5', '::1', 1702008857, '__ci_last_regenerate|i:1702008857;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 04:07:57'),
(1129, 'k5qrnq4oern244njc5nacq88umcjdofd', '::1', 1702009196, '__ci_last_regenerate|i:1702009196;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:222750;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"225000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-08 04:14:17'),
(1130, '1ib9ad11tot87jeh6s75m2e5jfthofen', '::1', 1702010332, '__ci_last_regenerate|i:1702010332;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:222750;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"225000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-08 04:19:56'),
(1131, 'pd7t3qduirtm4bs33555588l6em1ripo', '::1', 1702010854, '__ci_last_regenerate|i:1702010854;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:222750;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"225000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-08 04:38:52'),
(1132, 'fgdttmev8ha3u62k3kahtu6rjuu70i08', '::1', 1702011427, '__ci_last_regenerate|i:1702011427;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:222750;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"225000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-08 04:47:34'),
(1133, '58iv4pom7fhkglhciucft956d224me2t', '::1', 1702011841, '__ci_last_regenerate|i:1702011841;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:222750;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"225000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-08 04:57:07'),
(1134, 'i37jmkjbam3o373bg8jdrhjlmflfvbp3', '::1', 1702012544, '__ci_last_regenerate|i:1702012544;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:222750;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"225000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-08 05:04:01'),
(1135, '6vt9djjufprjga9va90gilsvutgufdli', '::1', 1702013111, '__ci_last_regenerate|i:1702013111;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:222750;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"225000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-08 05:15:44'),
(1136, 'opkagdrii4ri1mjrd8tspfips35hrdal', '::1', 1702013569, '__ci_last_regenerate|i:1702013569;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:222750;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"225000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-08 05:25:11'),
(1137, 'kds8oaj0k6ouno4tvoegf4emhrcvgpi1', '::1', 1702013874, '__ci_last_regenerate|i:1702013874;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:222750;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"225000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-08 05:32:49'),
(1138, 'a432q8emq57kbiglv15rskrafoldv6pf', '::1', 1702014244, '__ci_last_regenerate|i:1702014244;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 05:37:54'),
(1139, '00i62o7vv6gsj8i1lvj0h565444krj2s', '::1', 1702014549, '__ci_last_regenerate|i:1702014549;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"fa3e91445faf456102866ae1c3b3f311\";a:16:{s:2:\"id\";s:6:\"serv-5\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:12:\"type_produit\";N;s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:7500;s:12:\"UNITE_MESURE\";s:1:\"0\";s:2:\"pt\";s:4:\"7500\";s:11:\"DESIGNATION\";s:1:\"5\";s:13:\"PRIX_UNITAIRE\";s:3:\"500\";s:13:\"SECR_STOCK_ID\";s:1:\"5\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"fa3e91445faf456102866ae1c3b3f311\";s:8:\"subtotal\";d:1;}s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";a:16:{s:2:\"id\";s:4:\"px-1\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:24750;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"25000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:4:\"5000\";s:13:\"SECR_STOCK_ID\";s:1:\"1\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";s:8:\"subtotal\";d:1;}}', '2023-12-08 05:44:04'),
(1140, 'o0d202lseboprspblefgavq9b9nfa84o', '::1', 1702014859, '__ci_last_regenerate|i:1702014859;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"fa3e91445faf456102866ae1c3b3f311\";a:16:{s:2:\"id\";s:6:\"serv-5\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:12:\"type_produit\";N;s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:7500;s:12:\"UNITE_MESURE\";s:1:\"0\";s:2:\"pt\";s:4:\"7500\";s:11:\"DESIGNATION\";s:1:\"5\";s:13:\"PRIX_UNITAIRE\";s:3:\"500\";s:13:\"SECR_STOCK_ID\";s:1:\"5\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"fa3e91445faf456102866ae1c3b3f311\";s:8:\"subtotal\";d:1;}s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";a:16:{s:2:\"id\";s:4:\"px-1\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:24750;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"25000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:4:\"5000\";s:13:\"SECR_STOCK_ID\";s:1:\"1\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";s:8:\"subtotal\";d:1;}}', '2023-12-08 05:49:09'),
(1141, 'sir02cnens007fsaajnupukh5u64pgbd', '::1', 1702015166, '__ci_last_regenerate|i:1702015166;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"fa3e91445faf456102866ae1c3b3f311\";a:16:{s:2:\"id\";s:6:\"serv-5\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:12:\"type_produit\";N;s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:7500;s:12:\"UNITE_MESURE\";s:1:\"0\";s:2:\"pt\";s:4:\"7500\";s:11:\"DESIGNATION\";s:1:\"5\";s:13:\"PRIX_UNITAIRE\";s:3:\"500\";s:13:\"SECR_STOCK_ID\";s:1:\"5\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"fa3e91445faf456102866ae1c3b3f311\";s:8:\"subtotal\";d:1;}s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";a:16:{s:2:\"id\";s:4:\"px-1\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:24750;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"25000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:4:\"5000\";s:13:\"SECR_STOCK_ID\";s:1:\"1\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";s:8:\"subtotal\";d:1;}}', '2023-12-08 05:54:19'),
(1142, 'kshkmcj036jecl1ida8nlfs4e04372b8', '::1', 1702015527, '__ci_last_regenerate|i:1702015527;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"10\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"2\";s:9:\"netapayer\";i:245000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"250000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"25000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";a:16:{s:2:\"id\";s:4:\"px-1\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"2\";s:9:\"netapayer\";i:43120;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"44000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"22000\";s:13:\"SECR_STOCK_ID\";s:1:\"1\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";s:8:\"subtotal\";d:1;}}', '2023-12-08 05:59:27'),
(1143, 'jk9gjflof5482fg243h0n0mu877ghe4l', '::1', 1702015854, '__ci_last_regenerate|i:1702015854;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"10\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"2\";s:9:\"netapayer\";i:245000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"250000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"25000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";a:16:{s:2:\"id\";s:4:\"px-1\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"2\";s:9:\"netapayer\";i:43120;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"44000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"22000\";s:13:\"SECR_STOCK_ID\";s:1:\"1\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";s:8:\"subtotal\";d:1;}}', '2023-12-08 06:05:27'),
(1144, '5oau911g1qsbj6enj8o5nsoaq8aq8te1', '::1', 1702016169, '__ci_last_regenerate|i:1702016169;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"10\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"2\";s:9:\"netapayer\";i:245000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"250000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"25000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";a:16:{s:2:\"id\";s:4:\"px-1\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"2\";s:9:\"netapayer\";i:43120;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"44000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"22000\";s:13:\"SECR_STOCK_ID\";s:1:\"1\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";s:8:\"subtotal\";d:1;}}', '2023-12-08 06:10:54'),
(1145, '82nc0sc7pbrel2dvrvteidf45q8m40sc', '::1', 1702016471, '__ci_last_regenerate|i:1702016471;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"50\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"5\";s:9:\"netapayer\";i:1187500;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:7:\"1250000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"25000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-08 06:16:09'),
(1146, '0s29bhi3v55mrkcr0t29eks6gbr0iarg', '::1', 1702019547, '__ci_last_regenerate|i:1702019547;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"50\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"5\";s:9:\"netapayer\";i:1187500;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:7:\"1250000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"25000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-08 06:21:11'),
(1147, 'bggqtr9nm6ssenv0edbsva39i6q1hehg', '::1', 1702019548, '__ci_last_regenerate|i:1702019547;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"50\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"5\";s:9:\"netapayer\";i:1187500;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:7:\"1250000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"25000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-08 07:12:28'),
(1148, '64ipjhco7lvgjef9uquc5glivjifcbk7', '::1', 1702020429, '__ci_last_regenerate|i:1702020429;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 07:20:54'),
(1149, 'svl650k8g0c2fp0nb4tt9ssv5lc80d1f', '::1', 1702020675, '__ci_last_regenerate|i:1702020429;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 07:27:10'),
(1150, 'sckmvoh92of0ohi8mk9vlaic6eauhok9', '::1', 1702023968, '__ci_last_regenerate|i:1702023963;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 08:26:03'),
(1151, 'q0c9mgdcfqnqppuvka8g42jpchrhvo8p', '::1', 1702035574, '__ci_last_regenerate|i:1702035574;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 11:25:56'),
(1152, 'p8om8j4ghrun063j1l731ga0oi50cqce', '::1', 1702035923, '__ci_last_regenerate|i:1702035923;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 11:39:34'),
(1153, '99sv0eqeraouecalnvldmrc7jluu8ldc', '::1', 1702036336, '__ci_last_regenerate|i:1702036336;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 11:45:23'),
(1154, 'j2patcqtlkg0ppajqj8m8rj7opsq32dr', '::1', 1702036932, '__ci_last_regenerate|i:1702036932;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 11:52:16'),
(1155, 'va76nr3l2invaek5i4o2l6pp5f34mvt9', '::1', 1702037309, '__ci_last_regenerate|i:1702037309;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 12:02:12'),
(1156, '7pnu3frn12heo3uqq2h9c48ot5mrdkv5', '::1', 1702037956, '__ci_last_regenerate|i:1702037956;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 12:08:29'),
(1157, 'rl80sd67khi60pj6i9rpsu8aljmpgb0s', '::1', 1702038628, '__ci_last_regenerate|i:1702038628;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 12:19:16'),
(1158, 'n6gp6ft0navjkh36jv8tp21enduh50us', '::1', 1702038934, '__ci_last_regenerate|i:1702038934;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"10\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"2\";s:9:\"netapayer\";i:294000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"300000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"30000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-08 12:30:28'),
(1159, '2rt75d9k429kha9hb79hoihn31d9hki5', '::1', 1702039289, '__ci_last_regenerate|i:1702039289;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"10\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"2\";s:9:\"netapayer\";i:294000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"300000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"30000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-08 12:35:35'),
(1160, '24rkfn5nh1a9n1mefu52ht7mrm4eu25m', '::1', 1702039290, '__ci_last_regenerate|i:1702039289;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"10\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"2\";s:9:\"netapayer\";i:294000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"300000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"30000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-08 12:41:30'),
(1161, 'c92036cef93c47bd8a45e39894af88ccc9b3f46f', '154.117.195.56', 1702042144, '__ci_last_regenerate|i:1702042144;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 13:00:03'),
(1162, '4e23239c67b341cfa8157016068b5ef0bc0e0dcb', '154.117.195.56', 1702042467, '__ci_last_regenerate|i:1702042467;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 13:29:04'),
(1163, 'c910a6a74009b700c1c74730e9948d605994bd30', '154.117.195.56', 1702042775, '__ci_last_regenerate|i:1702042775;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 13:34:27'),
(1164, 'cedfc046b0d019ffea373aefdf6ec121b640b7b4', '154.117.195.56', 1702043199, '__ci_last_regenerate|i:1702043199;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 13:39:35'),
(1165, '4d7b784f43f3f4b1855b0ef0717f3d0e9e1fe4a7', '154.117.195.56', 1702043864, '__ci_last_regenerate|i:1702043864;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 13:46:39'),
(1166, '4cae7a452115e05b6a7d85527354219b5098daf8', '154.117.195.56', 1702045538, '__ci_last_regenerate|i:1702045538;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 13:57:44'),
(1167, 'ea9912033e5e4d607003b6cac82d4b655a753d1a', '154.117.195.100', 1702046868, '__ci_last_regenerate|i:1702046868;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 14:25:38'),
(1168, 'b67f36cdbbf66a74cc9335acd17c593ae4189263', '154.117.195.100', 1702046800, '__ci_last_regenerate|i:1702046800;', '2023-12-08 14:29:02'),
(1169, '9d790ff2c388d759058897055ff78d809137e90e', '154.117.195.100', 1702047812, '__ci_last_regenerate|i:1702047812;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 14:46:40'),
(1170, 'c98631ed453637cd13e379695f6eb08124d14129', '154.117.195.100', 1702047864, '__ci_last_regenerate|i:1702047864;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 14:47:48'),
(1171, 'd438b9aca09b165dbfdb65a45ea2bbbe085284dd', '154.117.195.100', 1702048678, '__ci_last_regenerate|i:1702048678;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 15:03:32'),
(1172, '15f0cd8e71cfd635067a056bcc320805da262ec3', '154.117.195.100', 1702048189, '__ci_last_regenerate|i:1702048189;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 15:04:24'),
(1173, '88c11cef061a3554af5f35102f23aeda228b5d62', '154.117.195.100', 1702049570, '__ci_last_regenerate|i:1702049570;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 15:09:50'),
(1174, 'f8d71cef1e00c94493092943fa12d0ed80e7cd2c', '154.117.195.100', 1702049041, '__ci_last_regenerate|i:1702049041;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 15:17:58'),
(1175, '041b8db39366f62df07a87b35a74277e3e8f759b', '154.117.195.100', 1702050215, '__ci_last_regenerate|i:1702050215;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 15:24:01'),
(1176, 'a1a4a467d441efc0dcb87dbb4d42c6bf350bcdce', '154.117.195.100', 1702051629, '__ci_last_regenerate|i:1702051629;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 15:32:50'),
(1177, '356eac3010ec10e8c6d816f276b89858aa38c398', '154.117.195.100', 1702050542, '__ci_last_regenerate|i:1702050542;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 15:43:35'),
(1178, '6e7500ac423eb941894917bc00f42c6f20677b53', '154.117.195.100', 1702050870, '__ci_last_regenerate|i:1702050870;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:123750;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"125000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"25000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-08 15:49:02'),
(1179, '2a0d03636836817efa63b9cf285472e13d5c2c35', '154.117.195.100', 1702051612, '__ci_last_regenerate|i:1702051612;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 15:54:30'),
(1180, '1cc2ecc3744f75cd330790521e94bf5343ae3513', '154.117.195.100', 1702052244, '__ci_last_regenerate|i:1702052244;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 16:06:52'),
(1181, '1b1cb79a165a7ce7792f2dc095c924470b937ee3', '154.117.195.100', 1702051947, '__ci_last_regenerate|i:1702051947;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 16:07:09'),
(1182, '706bed5da6e268a84dd542b9263d601de6866485', '154.117.195.100', 1702053855, '__ci_last_regenerate|i:1702053855;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 16:12:27'),
(1183, '2c3ab341996597600ef7536a07e6fd21f09551aa', '154.117.195.100', 1702052555, '__ci_last_regenerate|i:1702052555;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 16:17:24'),
(1184, '2a33bd4510fa4fa462de1e780e43506c9488eb65', '154.117.195.100', 1702053343, '__ci_last_regenerate|i:1702053343;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 16:22:36'),
(1185, '7591f90e627f7335614c5ff31cd35f514724518d', '154.117.195.100', 1702054115, '__ci_last_regenerate|i:1702054115;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 16:35:43'),
(1186, 'bb036a224d81403ed546f0743c49ebeb5f7e038f', '154.117.195.100', 1702055045, '__ci_last_regenerate|i:1702055045;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 16:44:15'),
(1187, '69837185b1418569d000fd91bbe5bbac8621c687', '154.117.195.100', 1702054458, '__ci_last_regenerate|i:1702054458;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 16:48:35'),
(1188, '07a2fba4d264ca13351ad5aafdc2fb2a9cd0d496', '154.117.195.100', 1702054359, '__ci_last_regenerate|i:1702054229;', '2023-12-08 16:50:29'),
(1189, '4a0afebd2f366252b018937f2312945df98a75ca', '154.117.195.100', 1702055258, '__ci_last_regenerate|i:1702055258;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 16:54:18'),
(1190, '207a892b462e0df7d3311e4fb0a9b5046775d720', '154.117.195.100', 1702055487, '__ci_last_regenerate|i:1702055487;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 17:04:05'),
(1191, '383c934d4c5a0938c0afa2bb1c2ab16db799eb3f', '154.117.195.100', 1702055382, '__ci_last_regenerate|i:1702055258;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 17:07:38'),
(1192, 'd2c6eb218052c2cb8a15c6fd7243ef47f20fd436', '154.117.195.100', 1702056003, '__ci_last_regenerate|i:1702056003;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 17:11:27'),
(1193, '6fd102e117e64929b5a7cc3b0a86312d2ae2c12d', '154.117.195.100', 1702055536, '__ci_last_regenerate|i:1702055536;', '2023-12-08 17:12:16'),
(1194, 'f2f5740d79dfb459658df90984350a3ac60ec6c5', '154.117.216.34', 1702056394, '__ci_last_regenerate|i:1702056394;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 17:19:24'),
(1195, 'fe78a394f3aad893b370b1a495bc7a7dedc14611', '154.117.195.100', 1702056115, '__ci_last_regenerate|i:1702056003;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 17:20:03'),
(1196, '5899777249c35ee24ecb48e06f938719f4f6e183', '154.117.216.34', 1702056811, '__ci_last_regenerate|i:1702056811;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 17:26:34'),
(1197, 'eb72ded38a9faed2ce3181349caaec2e84d2e782', '154.117.216.34', 1702057201, '__ci_last_regenerate|i:1702057201;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 17:33:31'),
(1198, '4b3da370461d64b7b318987d8ffaa8fc04f142f2', '154.117.216.34', 1702057760, '__ci_last_regenerate|i:1702057573;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 17:40:02'),
(1199, '5edb807d8abe3aeed6f4b38b330902913df0e752', '154.117.216.34', 1702057573, '__ci_last_regenerate|i:1702057573;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 17:46:13'),
(1200, 'c682938cf889b90be98c39db1c88d6a7c20f1241', '154.117.195.100', 1702061116, '__ci_last_regenerate|i:1702061116;', '2023-12-08 18:29:43'),
(1201, '17ed2753a6ebc58fd3c54c1c496bd72572d3edfc', '154.117.195.100', 1702061638, '__ci_last_regenerate|i:1702061638;', '2023-12-08 18:45:16'),
(1202, 'a13282e8d6a924d80996210f94d6bc2c6adec8a3', '154.117.195.100', 1702061832, '__ci_last_regenerate|i:1702061638;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 18:53:58'),
(1203, '4b5fa91e5d5211c42c3e9b42e0b3273fb437599f', '41.79.45.5', 1702064108, '__ci_last_regenerate|i:1702064009;', '2023-12-08 19:33:29'),
(1204, '24ee448a60a7efc4ee8b47b5eca991f8f89aa541', '154.117.195.100', 1702064515, '__ci_last_regenerate|i:1702064515;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 19:36:11'),
(1205, '6fa029064e049a2faf395fe531a4b21fd3a2dc98', '154.117.195.100', 1702064549, '__ci_last_regenerate|i:1702064515;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 19:41:55'),
(1210, '0ab02d3311abc342a270c335562c37e4c2722d8d', '154.117.195.100', 1702070422, '__ci_last_regenerate|i:1702070422;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 20:00:00'),
(1211, 'af72e9feffd921fbb11b9dd6c7dcaaf8f95b4ab2', '154.117.216.149', 1702074330, '__ci_last_regenerate|i:1702074330;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 21:20:22'),
(1212, '0c43b7bad7aadf4e12803b09ff513280da58df86', '154.117.216.149', 1702074330, '__ci_last_regenerate|i:1702074330;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-08 22:25:30'),
(1213, '7e9cf3a765437552d18991fadf724a9d70157026', '154.117.216.149', 1702074559, '__ci_last_regenerate|i:1702074559;', '2023-12-08 22:29:19'),
(1214, 'ddf327eaa9e40782f9dacaefe894be5a2cd1b494', '216.194.162.211', 1702102768, '__ci_last_regenerate|i:1702102768;', '2023-12-09 06:19:28'),
(1215, '6b3faa200b0b552badcb2731d9b9daee417db36a', '154.117.216.149', 1702107928, '__ci_last_regenerate|i:1702107928;', '2023-12-09 06:29:51'),
(1216, 'dd69d1876ef9553ecec1dee3ca020b7a33a48982', '154.117.216.149', 1702109877, '__ci_last_regenerate|i:1702109877;', '2023-12-09 07:45:29'),
(1217, '0aa404277f53b056aef5d6e4dea5aa7edd3af1fe', '154.117.216.149', 1702109877, '__ci_last_regenerate|i:1702109877;', '2023-12-09 08:17:57'),
(1218, '2a559acc7f9cdab462cb33c06a3830b3087fa08e', '154.117.216.178', 1702122343, '__ci_last_regenerate|i:1702122343;', '2023-12-09 11:45:43'),
(1219, '6942b3b28cefab0e04264e22be8ad86e3949eb15', '154.117.216.178', 1702122355, '__ci_last_regenerate|i:1702122355;', '2023-12-09 11:45:55'),
(1220, '5f3b3ee7333cea07e2e62d752394819c890c4589', '154.117.216.178', 1702122830, '__ci_last_regenerate|i:1702122830;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 11:47:30'),
(1221, '43b94af1d00d4f76fa5c46f2fcfa7497638fca52', '154.117.216.178', 1702122526, '__ci_last_regenerate|i:1702122526;', '2023-12-09 11:48:46'),
(1222, 'd1f7a836144125de6a355cfd0cbdbc5fde53bff2', '154.117.216.178', 1702123381, '__ci_last_regenerate|i:1702123381;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 11:53:50'),
(1223, '58075a25acff01101ccc55d3c9aaad973ac307da', '154.117.216.178', 1702123930, '__ci_last_regenerate|i:1702123930;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 12:03:01'),
(1224, 'aaf75274fbc0ee367027fed2153ff23cebfd7370', '154.117.216.178', 1702124311, '__ci_last_regenerate|i:1702124311;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 12:12:10'),
(1225, '37d2d03e2ae5ecddd8bea923f7f3b9047847a9a3', '154.117.216.178', 1702124671, '__ci_last_regenerate|i:1702124671;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 12:18:31'),
(1226, '6b1b2438dc6ee0249a961a4cf74b9fd6befa7de5', '154.117.216.178', 1702125199, '__ci_last_regenerate|i:1702125199;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 12:24:31');
INSERT INTO `session_table` (`id_session`, `id`, `ip_address`, `timestamp`, `data`, `date_action`) VALUES
(1227, '3b89e0faa1e3210c9f7ed0b4848cec58d452f29a', '154.117.216.178', 1702125737, '__ci_last_regenerate|i:1702125737;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 12:33:19'),
(1228, 'c331e5fab0800b4586ae69c1e5b350c42f258521', '154.117.216.178', 1702127395, '__ci_last_regenerate|i:1702127395;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 12:42:17'),
(1229, '20e030445de29cf9947357aa1849b6600e131800', '154.117.219.185', 1702127830, '__ci_last_regenerate|i:1702127830;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 13:09:56'),
(1230, '60fc7105f2fa8a91d8baba0428efac5f87fe400a', '154.117.219.185', 1702128168, '__ci_last_regenerate|i:1702128168;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 13:17:10'),
(1231, '1883e9c04ad14056303c3bbf45ddfffbbf570b01', '154.117.219.185', 1702128491, '__ci_last_regenerate|i:1702128491;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 13:22:48'),
(1232, '244cbdbc2724d93906725d35750f7d2062d15467', '154.117.219.185', 1702128883, '__ci_last_regenerate|i:1702128883;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 13:28:11'),
(1233, '258a91ff5fb4d1c44bded6e8cf2ada96655d29f6', '154.117.219.185', 1702129288, '__ci_last_regenerate|i:1702129288;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 13:34:43'),
(1234, 'f92bfee5e11e7cf3149a93128a4b518957bcd590', '154.117.219.185', 1702129703, '__ci_last_regenerate|i:1702129703;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 13:41:28'),
(1235, '6bcda609464b783af1fada9834f267b275cdebb3', '154.117.219.185', 1702130008, '__ci_last_regenerate|i:1702130008;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 13:48:23'),
(1236, '7588d4ad34e22e74b31bb508e39970c13cbb2ece', '154.117.219.185', 1702130370, '__ci_last_regenerate|i:1702130370;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 13:53:28'),
(1237, 'a694366964c899f4c0c32b067c76326e454aaa85', '154.117.219.185', 1702130373, '__ci_last_regenerate|i:1702130370;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 13:59:30'),
(1238, 'cb79f54a8c548a67ad02f4c830d3a1e5de235aec', '154.117.219.185', 1702130930, '__ci_last_regenerate|i:1702130930;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 14:02:38'),
(1239, '96bb86b32d6304b42a6623d16b91275de7ad78a2', '154.117.219.185', 1702131231, '__ci_last_regenerate|i:1702131231;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 14:08:50'),
(1240, '67a25201faf972fa6e9e18417d5b6c53f0ae02de', '154.117.219.185', 1702131542, '__ci_last_regenerate|i:1702131542;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 14:13:51'),
(1241, '80bd96e47977661de1f4fee8aaa900fd1620de78', '154.117.219.185', 1702131854, '__ci_last_regenerate|i:1702131854;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 14:19:02'),
(1242, 'bf0092c72103d03c6f6325ea1d759a92eccd33b5', '154.117.219.185', 1702132211, '__ci_last_regenerate|i:1702132211;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 14:24:14'),
(1243, '85427c209ed7272db5c396f288fd59753f40aa4e', '154.117.219.185', 1702132537, '__ci_last_regenerate|i:1702132537;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 14:30:11'),
(1244, '67ddf4c70da686aba62ca3857f9389b3c8c8d635', '154.117.219.185', 1702133033, '__ci_last_regenerate|i:1702133033;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 14:35:37'),
(1246, 'c4ef4e29274301223d0f6b1b4b83842472223b02', '154.117.219.185', 1702133816, '__ci_last_regenerate|i:1702133816;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 14:44:06'),
(1247, 'adb340f6b5c817457f11cf6eb24beb14edf56446', '154.117.219.185', 1702134218, '__ci_last_regenerate|i:1702134210;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 14:56:56'),
(1248, 'dfb3fd04663fcbb1782668fa11f460aaab40da92', '154.117.219.185', 1702134265, '__ci_last_regenerate|i:1702134210;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 15:03:30'),
(1249, '547feb31872994d5124c84432df7da4f51c8e0d2', '102.134.96.146', 1702135160, '__ci_last_regenerate|i:1702135160;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 15:12:22'),
(1250, '3799f5b24c5e2f1e4d523df11e8599c63328786c', '102.134.96.146', 1702135709, '__ci_last_regenerate|i:1702135709;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 15:19:20'),
(1251, '6c52ba6c8fcfeba91650c88e0c6644ac659a290d', '102.134.96.146', 1702136011, '__ci_last_regenerate|i:1702136011;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 15:28:30'),
(1252, 'd9d64e31c3e9e2237aadfbef0da787e7a08a5b1d', '102.134.96.146', 1702136338, '__ci_last_regenerate|i:1702136338;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 15:33:31'),
(1253, '35c397c4f591862c4f9fad30b1fa3a218002e374', '154.117.219.185', 1702136133, '__ci_last_regenerate|i:1702136133;', '2023-12-09 15:35:33'),
(1254, 'd3f31927dd41da703d55580a69d32492170e459b', '102.134.96.146', 1702137248, '__ci_last_regenerate|i:1702137248;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 15:38:59'),
(1255, '17e41cb699762a6070b4a28e6130308285951083', '102.134.96.146', 1702136895, '__ci_last_regenerate|i:1702136895;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 15:48:15'),
(1256, 'b0ed1d17e2671bcef696d75513da4aa80e1e9da0', '102.134.96.146', 1702137615, '__ci_last_regenerate|i:1702137615;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 15:54:08'),
(1257, '3c5d8aab0e4bca47492d98a79aade1e473879f06', '102.134.96.146', 1702138007, '__ci_last_regenerate|i:1702138007;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 16:00:16'),
(1258, '50b909b02df10b5a4183dbed4392f9b07692b3c2', '102.134.96.146', 1702138339, '__ci_last_regenerate|i:1702138339;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";PRODUCT_DESC|s:24:\"Igiseke karoboye ndakeza\";CATH_ID|s:2:\"10\";PIECES|s:1:\"0\";CODE|s:8:\"IGISE009\";message|s:330:\"<div class=\"alert alert-danger alert-dismissible alert-alt solid fade show\">\r\n      <button type=\"button\" class=\"close h-100\" data-dismiss=\"alert\" aria-label=\"Close\"><span><i class=\"mdi mdi-close\"></i></span>\r\n      </button>\r\n      <center><strong>Operation done,Igiseke karoboye ndakezainsérée.</strong></center>\r\n      </div>\";__ci_vars|a:5:{s:12:\"PRODUCT_DESC\";s:3:\"old\";s:7:\"CATH_ID\";s:3:\"old\";s:6:\"PIECES\";s:3:\"old\";s:4:\"CODE\";s:3:\"old\";s:7:\"message\";s:3:\"old\";}', '2023-12-09 16:06:47'),
(1259, '717a2300a7bbf6b5905ea0d796e61a99d4971c5e', '102.134.96.146', 1702138674, '__ci_last_regenerate|i:1702138674;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 16:12:19'),
(1260, 'b346e9221c197d22f6e1f31444f77c456392ff60', '102.134.96.146', 1702138985, '__ci_last_regenerate|i:1702138985;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 16:17:54'),
(1261, '34b811adbaa95ef77cd1694b4e9be1e4497bba2f', '102.134.96.146', 1702139310, '__ci_last_regenerate|i:1702139310;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 16:23:05'),
(1262, 'b9115d9d92d20dda2ac2ccce8669dcb71b1531b9', '102.134.96.146', 1702139556, '__ci_last_regenerate|i:1702139310;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 16:28:30'),
(1263, '7081c94538290f5a51b2b5ab8b4ef2918179c7e4', '198.235.24.48', 1702140153, '__ci_last_regenerate|i:1702140153;', '2023-12-09 16:42:33'),
(1264, 'c5fd268395ec4d13681c073be9c068ab26d2a37b', '205.210.31.41', 1702141710, '__ci_last_regenerate|i:1702141709;', '2023-12-09 17:08:30'),
(1265, 'e427402a6b0944fe5a0fbdbaf0b3d54a09ad89bd', '154.117.216.149', 1702143210, '__ci_last_regenerate|i:1702143210;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 17:28:15'),
(1266, 'f5da8d7d478822d22588f31c680a644a5d6e6273', '154.117.216.149', 1702143559, '__ci_last_regenerate|i:1702143559;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 17:33:30'),
(1267, '2b1352d1b2a4eb385c89c7e27644aadd9bc34a41', '154.117.216.149', 1702143944, '__ci_last_regenerate|i:1702143944;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 17:39:19'),
(1268, '64068ea30f825da426db05b9e3f58f3c86cf1689', '154.117.216.149', 1702144245, '__ci_last_regenerate|i:1702144245;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 17:45:44'),
(1269, '8713adf7e4bde6fe5897421447da968a77091e4f', '154.117.216.149', 1702147610, '__ci_last_regenerate|i:1702147610;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 17:50:45'),
(1270, '7b174ad455aaba3b45ac461045fa5512a96065ba', '102.134.96.146', 1702146369, '__ci_last_regenerate|i:1702146369;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 18:20:32'),
(1271, 'f4746b7ba4a9a61adc83841431490d762b051329', '102.134.96.146', 1702146673, '__ci_last_regenerate|i:1702146369;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 18:26:09'),
(1272, '666a7880559fef58f8386c5de29d0ab97ed73f45', '154.117.216.149', 1702147611, '__ci_last_regenerate|i:1702147610;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-09 18:46:51'),
(1273, 'ab3448890c2398ba825928c4d1903dd0e4cd3f0f', '154.117.219.148', 1702191224, '__ci_last_regenerate|i:1702191224;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 06:48:01'),
(1274, '2318fcd74ea4a218989a75b879d0a14ff4a74b38', '154.117.219.148', 1702191566, '__ci_last_regenerate|i:1702191566;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 06:53:44'),
(1275, '91eb97ee66167c6f59dd6bb791ec5703f1b55b25', '154.117.219.148', 1702192254, '__ci_last_regenerate|i:1702192254;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 06:59:26'),
(1276, '6a8ece336eb2e16cbe37eb2f4ff23b6933cbb247', '154.117.219.148', 1702192704, '__ci_last_regenerate|i:1702192704;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 07:10:55'),
(1277, '150a76c4141da37a0a062087fac735c84bb89732', '154.117.219.148', 1702193011, '__ci_last_regenerate|i:1702193011;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 07:18:24'),
(1278, '5c2223b180c71d4394b4158ce7dfca7dec8bb327', '154.117.219.148', 1702193353, '__ci_last_regenerate|i:1702193353;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 07:23:31'),
(1279, '2edd7b0f01c1cb88d8f6b8d9d38ae8b38680cb31', '154.117.219.148', 1702194151, '__ci_last_regenerate|i:1702194151;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 07:29:13'),
(1280, '8833cf7e7c26a610de22dbd78af1d290a8033b3d', '154.117.219.148', 1702194606, '__ci_last_regenerate|i:1702194606;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 07:42:31'),
(1281, '4af156a832e9b55820b6169f701b695207a85474', '154.117.219.148', 1702194934, '__ci_last_regenerate|i:1702194934;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 07:50:06'),
(1282, '22ee8aeb33067643ca1945d5ec5719cc48483253', '154.117.219.148', 1702195276, '__ci_last_regenerate|i:1702195276;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 07:55:34'),
(1283, 'bddd1c26f4129411415ca8b4dfae282151094bfc', '154.117.219.148', 1702195464, '__ci_last_regenerate|i:1702195276;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 08:01:16'),
(1284, 'fd0f83ce017c887b6f41dcb5d5f92e92a7812b92', '154.117.217.53', 1702211596, '__ci_last_regenerate|i:1702211596;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 12:20:10'),
(1285, '245dc239d9148b8a686f8184a32ddf6d1b8fac2f', '154.117.217.53', 1702211292, '__ci_last_regenerate|i:1702211292;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 12:28:12'),
(1286, '9a584e53ab16fe237db7e76f2f7a9d727245d811', '154.117.217.53', 1702211907, '__ci_last_regenerate|i:1702211907;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 12:33:16'),
(1287, '65330988f5c4c5369b3d7e4f817a1d87f996a027', '154.117.217.53', 1702212217, '__ci_last_regenerate|i:1702212217;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 12:38:27'),
(1288, '2f442e6c802c560d0874f753c8e24bbe760b9264', '154.117.217.53', 1702212523, '__ci_last_regenerate|i:1702212523;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 12:43:37'),
(1289, 'e1d266e84609043f12c36b86d2e28644d8736180', '154.117.217.53', 1702212925, '__ci_last_regenerate|i:1702212925;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 12:48:43'),
(1290, '34ccadfc7ce93afab349217ec608d2d72641d561', '154.117.217.53', 1702213231, '__ci_last_regenerate|i:1702213231;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 12:55:25'),
(1291, 'cfae8fe862d5821d58299bfbf94801b6f4e109ad', '154.117.217.53', 1702213637, '__ci_last_regenerate|i:1702213637;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 13:00:31'),
(1292, '0e40fed1f696b299e22671f3c2580e4369a5bb9e', '154.117.217.53', 1702214381, '__ci_last_regenerate|i:1702214381;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"50\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:99000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:4:\"2000\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-10 13:07:17'),
(1293, '56ecfd0a85e40432bb2f0c0624595da2aaeac95f', '154.117.217.53', 1702214700, '__ci_last_regenerate|i:1702214700;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-10 13:19:41'),
(1294, '98b1be4383f5f952793822154ca479cf1a5b08f8', '154.117.217.53', 1702215327, '__ci_last_regenerate|i:1702215327;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"50\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:100000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:4:\"2000\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-10 13:25:00'),
(1295, 'e38e3dc0f0dd4299450b9a7fc5d5daf0966df925', '154.117.217.53', 1702215956, '__ci_last_regenerate|i:1702215956;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"50\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:100000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:4:\"2000\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-10 13:35:27'),
(1296, '3b7af2befaa7d10cb55f5b5214d21522c66f27b7', '154.117.217.53', 1702218460, '__ci_last_regenerate|i:1702218460;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"50\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:100000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:4:\"2000\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-10 13:45:56'),
(1297, '25bca0a0c2efd49c9089660e5625dfcd47f4c2ec', '154.117.219.184', 1702218893, '__ci_last_regenerate|i:1702218893;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"50\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:100000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:4:\"2000\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-10 14:27:40'),
(1298, '2104f3686790a3e9ec8eb84ba0c3fe8fb97d5731', '154.117.219.184', 1702219229, '__ci_last_regenerate|i:1702219229;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"50\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:100000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:4:\"2000\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-10 14:34:53'),
(1299, 'dbf7ebe960e629a55e4b7e8dbf4357e26592c4d9', '154.117.219.184', 1702219858, '__ci_last_regenerate|i:1702219858;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"50\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:100000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:4:\"2000\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-10 14:40:29'),
(1300, 'ffba9a17d6b5a8f1fcb06362dc13ccb41aa78ecb', '154.117.216.114', 1702220186, '__ci_last_regenerate|i:1702220186;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"50\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:100000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:4:\"2000\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-10 14:50:58'),
(1301, '5035c2007d6cbe5508f987e05f02bbdd11b87b5a', '154.117.216.114', 1702221122, '__ci_last_regenerate|i:1702221122;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"50\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:100000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:4:\"2000\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-10 14:56:26'),
(1302, '44ac1c4270342274e9055b85233cf7d3ab73305c', '198.235.24.8', 1702220249, '__ci_last_regenerate|i:1702220248;', '2023-12-10 14:57:29'),
(1303, '3a9db1372174bba36b4673a9e0295594984d088f', '154.117.216.114', 1702221170, '__ci_last_regenerate|i:1702221122;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"50\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:100000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:4:\"2000\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-10 15:12:02'),
(1304, '0c9e93b7786f5d5e6d35d4f70547a9f6a1a3f862', '199.45.155.19', 1702238595, '__ci_last_regenerate|i:1702238594;', '2023-12-10 20:03:15'),
(1305, '3d269ce7bc2dc4f75b5d683e088318f0481ac089', '205.210.31.172', 1702244246, '__ci_last_regenerate|i:1702244245;', '2023-12-10 21:37:26'),
(1306, '21ae6eb005bf3eb5c2eb2d3232cf8a89f340e1bc', '216.194.162.211', 1702275591, '__ci_last_regenerate|i:1702275591;', '2023-12-11 06:19:51'),
(1307, 'a573178fed91f3045bf8a3b85981754bbb7b5100', '154.117.216.163', 1702296473, '__ci_last_regenerate|i:1702296473;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 12:02:39'),
(1308, '27164dbb910375ec24a6532559895cca1f62961b', '154.117.216.163', 1702296897, '__ci_last_regenerate|i:1702296897;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 12:07:53'),
(1309, '7d20e9a797c5f70a84a067d674848b65679e4ffd', '154.117.216.163', 1702297209, '__ci_last_regenerate|i:1702297209;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 12:14:57'),
(1310, '8a76621553c298e0384fc2bf5b8cc5946e70c21c', '154.117.216.163', 1702297555, '__ci_last_regenerate|i:1702297555;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 12:20:09'),
(1311, 'aaa2f6697fc339d6915abfa34e1a0dd230dccfab', '154.117.216.163', 1702298253, '__ci_last_regenerate|i:1702298253;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 12:25:55'),
(1312, '9d4a6577eca64f985d8be67051fd879721a903ec', '154.117.216.163', 1702297869, '__ci_last_regenerate|i:1702297869;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 12:31:09'),
(1313, 'dc8862d15d849f85393a46a2e5201e19c40c2a7f', '154.117.216.163', 1702298561, '__ci_last_regenerate|i:1702298561;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 12:37:34'),
(1314, 'ffcfe1134f8b10e356b47994059d334a1b96349a', '154.117.216.163', 1702298892, '__ci_last_regenerate|i:1702298892;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 12:42:41'),
(1315, 'ec61ba7693fde9af940bff5eb1350e8931c2f489', '154.117.216.163', 1702299275, '__ci_last_regenerate|i:1702299275;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 12:48:12'),
(1316, '0f266f51851b8452e0836af9e0c417427a784fa7', '154.117.216.163', 1702299669, '__ci_last_regenerate|i:1702299669;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 12:54:35'),
(1317, 'd098d29038160148b85ec140f96832d9e4c84981', '154.117.216.163', 1702300023, '__ci_last_regenerate|i:1702300023;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 13:01:10'),
(1318, '3485c4b61811075974d0325c328abc4c66aa9424', '154.117.216.163', 1702300359, '__ci_last_regenerate|i:1702300359;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"2\";s:9:\"netapayer\";i:29400;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:5:\"30000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:4:\"2000\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-11 13:07:03'),
(1319, '5f127026285ba16f4bab9a18a673b0b7503ee9cb', '154.117.216.163', 1702300852, '__ci_last_regenerate|i:1702300852;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"2\";s:9:\"netapayer\";i:29400;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:5:\"30000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:4:\"2000\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-11 13:12:39'),
(1320, '254e01c5369e74cd91cf9a4002904d0873f37b65', '154.117.216.163', 1702302280, '__ci_last_regenerate|i:1702302280;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"a2c9ed5bc139b0bf6d52a0701275e39e\";a:16:{s:2:\"id\";s:5:\"px-19\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:30000;s:12:\"UNITE_MESURE\";s:2:\"10\";s:2:\"pt\";s:5:\"30000\";s:11:\"DESIGNATION\";s:2:\"11\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:2:\"19\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"a2c9ed5bc139b0bf6d52a0701275e39e\";s:8:\"subtotal\";d:1;}}', '2023-12-11 13:20:52'),
(1321, 'eeb4bb6bfb5862140f57fc792e3874506eee9e8a', '154.117.216.163', 1702301453, '__ci_last_regenerate|i:1702301453;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"a2c9ed5bc139b0bf6d52a0701275e39e\";a:16:{s:2:\"id\";s:5:\"px-19\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:75000;s:12:\"UNITE_MESURE\";s:2:\"10\";s:2:\"pt\";s:5:\"75000\";s:11:\"DESIGNATION\";s:2:\"11\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:2:\"19\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"a2c9ed5bc139b0bf6d52a0701275e39e\";s:8:\"subtotal\";d:1;}}', '2023-12-11 13:30:53'),
(1322, 'da3f29e60acf140521d0b3d4ba57335e5ac987df', '154.117.216.163', 1702301914, '__ci_last_regenerate|i:1702301914;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"a2c9ed5bc139b0bf6d52a0701275e39e\";a:16:{s:2:\"id\";s:5:\"px-19\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:75000;s:12:\"UNITE_MESURE\";s:2:\"10\";s:2:\"pt\";s:5:\"75000\";s:11:\"DESIGNATION\";s:2:\"11\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:2:\"19\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"a2c9ed5bc139b0bf6d52a0701275e39e\";s:8:\"subtotal\";d:1;}}', '2023-12-11 13:38:34'),
(1323, '3e813307f3f2d27fdb314e47d5ae8df4a7d25f92', '154.117.216.163', 1702302637, '__ci_last_regenerate|i:1702302637;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"a2c9ed5bc139b0bf6d52a0701275e39e\";a:16:{s:2:\"id\";s:5:\"px-19\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:30000;s:12:\"UNITE_MESURE\";s:2:\"10\";s:2:\"pt\";s:5:\"30000\";s:11:\"DESIGNATION\";s:2:\"11\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:2:\"19\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"a2c9ed5bc139b0bf6d52a0701275e39e\";s:8:\"subtotal\";d:1;}}', '2023-12-11 13:44:41'),
(1324, '14fefafc748e7cf09bda490797e4b367552756ba', '154.117.216.163', 1702303605, '__ci_last_regenerate|i:1702303605;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"a2c9ed5bc139b0bf6d52a0701275e39e\";a:16:{s:2:\"id\";s:5:\"px-19\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:30000;s:12:\"UNITE_MESURE\";s:2:\"10\";s:2:\"pt\";s:5:\"30000\";s:11:\"DESIGNATION\";s:2:\"11\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:2:\"19\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"a2c9ed5bc139b0bf6d52a0701275e39e\";s:8:\"subtotal\";d:1;}}', '2023-12-11 13:50:37'),
(1325, '65dba98c8c128d01d26832430e4121c923c6ddec', '154.117.216.163', 1702303611, '__ci_last_regenerate|i:1702303605;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"a2c9ed5bc139b0bf6d52a0701275e39e\";a:16:{s:2:\"id\";s:5:\"px-19\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:30000;s:12:\"UNITE_MESURE\";s:2:\"10\";s:2:\"pt\";s:5:\"30000\";s:11:\"DESIGNATION\";s:2:\"11\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:2:\"19\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"a2c9ed5bc139b0bf6d52a0701275e39e\";s:8:\"subtotal\";d:1;}}', '2023-12-11 14:06:45'),
(1326, '2f5cfa80c1b43a4980ce8a5474da04010f8f781a', '154.117.217.109', 1702306946, '__ci_last_regenerate|i:1702306945;', '2023-12-11 15:02:26'),
(1327, '79a51beea813005b2baa027094aaee995473f970', '154.117.217.109', 1702307353, '__ci_last_regenerate|i:1702307353;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 15:03:59'),
(1328, '95ed508bdeaf81db7ee755ee8b536efc4e31fbb2', '154.117.217.109', 1702307709, '__ci_last_regenerate|i:1702307709;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 15:09:13'),
(1329, '39380e6ddf5f9aca447ac86b1a9dbefb099f0a68', '154.117.217.109', 1702308036, '__ci_last_regenerate|i:1702308036;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 15:15:09'),
(1330, '57c80eec737cb6db0b79907f6c69ecb4825786d8', '154.117.217.109', 1702308175, '__ci_last_regenerate|i:1702308036;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 15:20:36'),
(1331, '44fffe64b1328be648d871caaf6547ddfad2b345', '41.79.45.4', 1702320396, '__ci_last_regenerate|i:1702320396;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 18:40:30'),
(1332, '6011c6b316a8a1526a4739b565b4fc98401a65d5', '41.79.45.4', 1702320700, '__ci_last_regenerate|i:1702320700;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 18:46:36'),
(1333, 'f9acddefde2bdaa17c6d3158e5b9710c5150190b', '41.79.45.4', 1702321666, '__ci_last_regenerate|i:1702321666;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 18:51:40'),
(1334, '06fe9206e996dd6f9a235c410d87be583635c937', '41.79.45.4', 1702321973, '__ci_last_regenerate|i:1702321973;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 19:07:46'),
(1335, '7f19f7e7e67a4be9e1a7f6de5da09e7283ef6f52', '41.79.45.4', 1702323552, '__ci_last_regenerate|i:1702323552;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 19:12:53'),
(1336, '8a06468ed8c86ec96f33c254b3166e96216a12c4', '154.117.217.109', 1702323366, '__ci_last_regenerate|i:1702323366;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 19:16:38');
INSERT INTO `session_table` (`id_session`, `id`, `ip_address`, `timestamp`, `data`, `date_action`) VALUES
(1337, '7eb93b3ae62de9f8f07c137a6d58be1b55f2f368', '154.117.216.98', 1702324324, '__ci_last_regenerate|i:1702324324;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 19:36:07'),
(1338, 'ed199a66a30b3d9da40b4fa305c8b7d88f32d481', '41.79.45.4', 1702324674, '__ci_last_regenerate|i:1702324674;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 19:39:12'),
(1339, '859d597131f38f1a502b9df635133d842de92f17', '154.117.216.98', 1702324971, '__ci_last_regenerate|i:1702324971;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 19:52:04'),
(1340, '42871e7986b48a0d713825a0e22efada7289f636', '41.79.45.4', 1702326241, '__ci_last_regenerate|i:1702326241;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 19:57:54'),
(1341, 'e2aed45077083140a623d83acb7fc5dd725322d8', '154.117.216.98', 1702325096, '__ci_last_regenerate|i:1702324971;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 20:02:51'),
(1342, 'bb32753a3b9517de19184ed9ff0f01d531aff22f', '41.79.45.4', 1702327893, '__ci_last_regenerate|i:1702327893;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 20:24:01'),
(1343, '2b04a2d687ca53fc30f11993de4da489b0b78337', '41.79.45.4', 1702326695, '__ci_last_regenerate|i:1702326694;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 20:31:35'),
(1344, 'da8cb4fcda4427814f42474072756072fc0845ee', '41.79.45.4', 1702327893, '__ci_last_regenerate|i:1702327893;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-11 20:51:33'),
(1345, '0d41c9be7f331a8c35d2cf3b76fea04e03c8a64d', '41.79.46.247', 1702374256, '__ci_last_regenerate|i:1702374255;', '2023-12-12 09:44:16'),
(1346, '348ea49d3124a38066c9ca723c2bf5420b281abe', '41.79.46.247', 1702374794, '__ci_last_regenerate|i:1702374794;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 09:44:17'),
(1347, '423e30d9a2683bc64c70ade257cde3e141d99776', '41.79.46.247', 1702374800, '__ci_last_regenerate|i:1702374794;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 09:53:15'),
(1348, '4275a7b7410e7c7850eb2bfbc015e5dd426abcf3', '154.117.216.252', 1702378775, '__ci_last_regenerate|i:1702378775;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 10:51:52'),
(1349, '8cb447b1753e1816a3f5ae88febfb1455a241230', '154.117.216.252', 1702379137, '__ci_last_regenerate|i:1702379137;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 10:59:35'),
(1350, '261aeb8daae2ae2466ddc0c2399f31ca309152b6', '154.117.216.252', 1702379445, '__ci_last_regenerate|i:1702379445;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 11:05:37'),
(1351, 'b0823def3ef95e85ee100d6716dfe7497254b36f', '154.117.216.252', 1702379895, '__ci_last_regenerate|i:1702379895;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 11:10:45'),
(1352, 'c6e35ea9de8b85a5ba8d5c48eb5fc734c4826c2e', '154.117.216.252', 1702380298, '__ci_last_regenerate|i:1702380298;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 11:18:15'),
(1353, '3a4beb27ec5fc01fd89fbcd8ad96cd3b70d919fe', '154.117.216.252', 1702380741, '__ci_last_regenerate|i:1702380741;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 11:24:58'),
(1354, '3f7b9b5e6ace7d2d171a525f1ee12a41b6e6aa49', '154.117.216.252', 1702381317, '__ci_last_regenerate|i:1702381317;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 11:32:21'),
(1355, 'c787a3a9dd78e9beed9e58c87d2264ced8d181a2', '154.117.216.252', 1702381758, '__ci_last_regenerate|i:1702381758;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 11:41:57'),
(1356, '2dd3ceb445ab0a79ccc2df3f8bf998c8286c9d99', '154.117.216.252', 1702382174, '__ci_last_regenerate|i:1702382174;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 11:49:18'),
(1357, '48fd7605aae48e13acaba23bb4fe5bda8bde63eb', '154.117.216.252', 1702382608, '__ci_last_regenerate|i:1702382608;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 11:56:14'),
(1358, 'd602dcd893f51cd5f6f045a4a2f0221d2aaf46f6', '154.117.216.252', 1702383083, '__ci_last_regenerate|i:1702383083;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 12:03:28'),
(1359, '1807ea25bb73cad716c6c1a1e21a55c09fd40b57', '154.117.216.252', 1702383393, '__ci_last_regenerate|i:1702383393;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 12:11:23'),
(1360, 'bd576d6598e2ec46a70761ca21be6ad8d781eeee', '154.117.216.252', 1702383855, '__ci_last_regenerate|i:1702383855;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 12:16:33'),
(1361, 'f2d081bcee1b2943d691c246b887c3ca749bac42', '154.117.216.252', 1702384193, '__ci_last_regenerate|i:1702384193;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 12:24:15'),
(1362, '89ebabe64f9fad84131092498564d2e81075d197', '154.117.216.252', 1702384599, '__ci_last_regenerate|i:1702384599;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 12:29:53'),
(1363, '915df6f81f3027d166ea1c9733b0556657a73aa8', '154.117.216.252', 1702384961, '__ci_last_regenerate|i:1702384961;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 12:36:39'),
(1364, 'ee15176fb999f09db73aa75df15aee5cd16de7ec', '154.117.216.252', 1702385596, '__ci_last_regenerate|i:1702385596;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 12:42:41'),
(1365, 'c0d108db6f4b521cece4fb80eaef9f402e026966', '154.117.216.252', 1702385902, '__ci_last_regenerate|i:1702385902;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 12:53:16'),
(1366, 'a12cbd1a3138c961590911ebd85cf05a5e49e7c0', '154.117.216.252', 1702386525, '__ci_last_regenerate|i:1702386525;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 12:58:22'),
(1367, 'f18decb6a97ffd10825c1d952842e8de7dd3eac6', '154.117.216.252', 1702386551, '__ci_last_regenerate|i:1702386525;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 13:08:45'),
(1368, 'e9ccd0a49acc59fc0599db03e7d3eb6d22d38f51', '154.117.216.85', 1702408184, '__ci_last_regenerate|i:1702408184;', '2023-12-12 18:59:56'),
(1369, '4b46b5c735e409bfd35d5bd344f08a82f2168701', '154.117.216.85', 1702409573, '__ci_last_regenerate|i:1702409573;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 19:09:44'),
(1370, 'c94983dc69ec033c5b1c8c11cedbb3a1c437237e', '154.117.216.85', 1702409625, '__ci_last_regenerate|i:1702409573;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-12 19:32:53'),
(1371, '973191f402de926617486f72822f2be7fb5498c6', '216.194.162.211', 1702448408, '__ci_last_regenerate|i:1702448408;', '2023-12-13 06:20:08'),
(1372, 'ec025211f6cb70c00428140c92abe957f218c62d', '154.117.217.80', 1702456038, '__ci_last_regenerate|i:1702455881;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-13 08:24:41'),
(1373, 'f503e884a771c42fdab9fcc6e29adccecfd8044d', '154.117.219.154', 1702462938, '__ci_last_regenerate|i:1702462938;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-13 10:15:52'),
(1374, 'f6c91cd8d13710473029243c013b814fc3285b43', '154.117.219.154', 1702463277, '__ci_last_regenerate|i:1702463277;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-13 10:22:18'),
(1375, '3b2d00d0d84de726d155f5d0a9a58d71a0a8d842', '154.117.219.154', 1702463595, '__ci_last_regenerate|i:1702463595;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-13 10:27:57'),
(1376, 'baa14f0067baffb63720c7dd3b8e08de14177219', '154.117.219.154', 1702464094, '__ci_last_regenerate|i:1702464094;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-13 10:33:15'),
(1377, '003dbcf97eb42f743a49d55c6021f7e6173769b2', '154.117.219.154', 1702464150, '__ci_last_regenerate|i:1702464094;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-13 10:41:34'),
(1378, '29aa8e5b8a1e1a7b71f7750d23def2dfbf7234bd', '216.194.162.211', 1702621193, '__ci_last_regenerate|i:1702621193;', '2023-12-15 06:19:53'),
(1379, '39b8f5a24544e649887c14fb1484ea5e5ef4bb46', '154.117.217.206', 1702631772, '__ci_last_regenerate|i:1702631772;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-15 09:08:33'),
(1380, '528b7f2beecf02d26a722537c0a49f187d5a63e0', '154.117.217.206', 1702632539, '__ci_last_regenerate|i:1702632539;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-15 09:16:12'),
(1381, 'f6deb639fc6d535ca8f488898b9a45bf9d0a7cf5', '154.117.217.206', 1702632078, '__ci_last_regenerate|i:1702632078;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-15 09:21:18'),
(1382, 'aebd1e6895c329864da322e4d349ff9c892b740b', '154.117.217.206', 1702634016, '__ci_last_regenerate|i:1702634016;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-15 09:29:00'),
(1383, '159a99ba373159a82746a4ff7514404310498904', '154.117.217.206', 1702632902, '__ci_last_regenerate|i:1702632902;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-15 09:35:02'),
(1384, 'e94a5778ba04baaa8b5fadcb93783c196afc2183', '154.117.217.206', 1702633386, '__ci_last_regenerate|i:1702633386;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-15 09:43:06'),
(1385, '5cf9871c40a0ac4f2dd84d751d7949b7f72a7f16', '154.117.217.206', 1702634375, '__ci_last_regenerate|i:1702634375;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-15 09:53:36'),
(1386, 'a55f74aa565c5858c2643f13c1571acf76de43ca', '154.117.217.206', 1702634699, '__ci_last_regenerate|i:1702634699;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"9ab987321102556281fff7b4bb88e01d\";a:16:{s:2:\"id\";s:5:\"px-49\";s:3:\"qty\";d:2;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"30\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:900000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:6:\"900000\";s:11:\"DESIGNATION\";s:2:\"26\";s:13:\"PRIX_UNITAIRE\";s:5:\"30000\";s:13:\"SECR_STOCK_ID\";s:2:\"49\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9ab987321102556281fff7b4bb88e01d\";s:8:\"subtotal\";d:2;}}', '2023-12-15 09:59:35'),
(1387, '2765513f044309669fb865b77a074ec473e04635', '154.117.217.206', 1702635100, '__ci_last_regenerate|i:1702635100;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"9ab987321102556281fff7b4bb88e01d\";a:16:{s:2:\"id\";s:5:\"px-49\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"20\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:600000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:6:\"600000\";s:11:\"DESIGNATION\";s:2:\"26\";s:13:\"PRIX_UNITAIRE\";s:5:\"30000\";s:13:\"SECR_STOCK_ID\";s:2:\"49\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9ab987321102556281fff7b4bb88e01d\";s:8:\"subtotal\";d:1;}}', '2023-12-15 10:04:59'),
(1388, '7b9eeaf14aacb247b2292d1b61352fc96226abf8', '154.117.217.206', 1702635449, '__ci_last_regenerate|i:1702635449;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"9ab987321102556281fff7b4bb88e01d\";a:16:{s:2:\"id\";s:5:\"px-49\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"20\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:600000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:6:\"600000\";s:11:\"DESIGNATION\";s:2:\"26\";s:13:\"PRIX_UNITAIRE\";s:5:\"30000\";s:13:\"SECR_STOCK_ID\";s:2:\"49\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9ab987321102556281fff7b4bb88e01d\";s:8:\"subtotal\";d:1;}}', '2023-12-15 10:11:40'),
(1389, 'cebfcd3cd87fe2bff34431dd6b396af8d73f697d', '154.117.217.206', 1702635510, '__ci_last_regenerate|i:1702635449;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"9ab987321102556281fff7b4bb88e01d\";a:16:{s:2:\"id\";s:5:\"px-49\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"20\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:600000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:6:\"600000\";s:11:\"DESIGNATION\";s:2:\"26\";s:13:\"PRIX_UNITAIRE\";s:5:\"30000\";s:13:\"SECR_STOCK_ID\";s:2:\"49\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9ab987321102556281fff7b4bb88e01d\";s:8:\"subtotal\";d:1;}}', '2023-12-15 10:17:29'),
(1390, '5cdabfa476194e16ec85cf34d00f27e1c36d1761', '198.235.24.165', 1702662352, '__ci_last_regenerate|i:1702662352;', '2023-12-15 17:45:52'),
(1391, '66b588dd8f8a14508c84015465041939681817ce', '154.117.217.188', 1702663726, '__ci_last_regenerate|i:1702663726;', '2023-12-15 18:08:46'),
(1392, '2dcb43e058958b7199769c2cfb6e52547f1233bd', '154.117.217.188', 1702664159, '__ci_last_regenerate|i:1702663829;', '2023-12-15 18:10:29'),
(1393, 'fd8a4e962af16124a9faf8e457f3540809614ccc', '146.190.242.41', 1702712247, '__ci_last_regenerate|i:1702712247;', '2023-12-16 07:37:27'),
(1394, 'f23acba61248d8765cc1dd39fce7cdab72828200', '146.190.242.41', 1702712247, '__ci_last_regenerate|i:1702712247;', '2023-12-16 07:37:27'),
(1395, '561cc81fcd3264c7cc94eda5c5a1e2c07b937270', '154.117.217.44', 1702724653, '__ci_last_regenerate|i:1702724653;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"fa3e91445faf456102866ae1c3b3f311\";a:16:{s:2:\"id\";s:6:\"serv-5\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"25\";s:12:\"type_produit\";N;s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:12500;s:12:\"UNITE_MESURE\";s:1:\"0\";s:2:\"pt\";s:5:\"12500\";s:11:\"DESIGNATION\";s:1:\"5\";s:13:\"PRIX_UNITAIRE\";s:3:\"500\";s:13:\"SECR_STOCK_ID\";s:1:\"5\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"fa3e91445faf456102866ae1c3b3f311\";s:8:\"subtotal\";d:1;}s:32:\"d587cffbf1e0610f05bc5b6da40cc5dd\";a:16:{s:2:\"id\";s:5:\"px-10\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:9900;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"10000\";s:11:\"DESIGNATION\";s:1:\"6\";s:13:\"PRIX_UNITAIRE\";s:4:\"5000\";s:13:\"SECR_STOCK_ID\";s:2:\"10\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d587cffbf1e0610f05bc5b6da40cc5dd\";s:8:\"subtotal\";d:1;}}', '2023-12-16 10:59:08'),
(1396, '2efb05aca4fda7cf9458eb7e40cfe99c6304a604', '154.117.217.44', 1702725277, '__ci_last_regenerate|i:1702725277;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"fa3e91445faf456102866ae1c3b3f311\";a:16:{s:2:\"id\";s:6:\"serv-5\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"25\";s:12:\"type_produit\";N;s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:12500;s:12:\"UNITE_MESURE\";s:1:\"0\";s:2:\"pt\";s:5:\"12500\";s:11:\"DESIGNATION\";s:1:\"5\";s:13:\"PRIX_UNITAIRE\";s:3:\"500\";s:13:\"SECR_STOCK_ID\";s:1:\"5\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"fa3e91445faf456102866ae1c3b3f311\";s:8:\"subtotal\";d:1;}s:32:\"d587cffbf1e0610f05bc5b6da40cc5dd\";a:16:{s:2:\"id\";s:5:\"px-10\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:9900;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"10000\";s:11:\"DESIGNATION\";s:1:\"6\";s:13:\"PRIX_UNITAIRE\";s:4:\"5000\";s:13:\"SECR_STOCK_ID\";s:2:\"10\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d587cffbf1e0610f05bc5b6da40cc5dd\";s:8:\"subtotal\";d:1;}}', '2023-12-16 11:04:13'),
(1397, 'c4222404898693ee439474b636c4e408215e8b73', '154.117.217.44', 1702725655, '__ci_last_regenerate|i:1702725655;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"fa3e91445faf456102866ae1c3b3f311\";a:16:{s:2:\"id\";s:6:\"serv-5\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"25\";s:12:\"type_produit\";N;s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:12500;s:12:\"UNITE_MESURE\";s:1:\"0\";s:2:\"pt\";s:5:\"12500\";s:11:\"DESIGNATION\";s:1:\"5\";s:13:\"PRIX_UNITAIRE\";s:3:\"500\";s:13:\"SECR_STOCK_ID\";s:1:\"5\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"fa3e91445faf456102866ae1c3b3f311\";s:8:\"subtotal\";d:1;}s:32:\"d587cffbf1e0610f05bc5b6da40cc5dd\";a:16:{s:2:\"id\";s:5:\"px-10\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:9900;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"10000\";s:11:\"DESIGNATION\";s:1:\"6\";s:13:\"PRIX_UNITAIRE\";s:4:\"5000\";s:13:\"SECR_STOCK_ID\";s:2:\"10\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d587cffbf1e0610f05bc5b6da40cc5dd\";s:8:\"subtotal\";d:1;}}', '2023-12-16 11:14:37'),
(1398, '8029a0ceb832e6568912763c82d32e9b82575877', '154.117.217.44', 1702726053, '__ci_last_regenerate|i:1702726053;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"fa3e91445faf456102866ae1c3b3f311\";a:16:{s:2:\"id\";s:6:\"serv-5\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"25\";s:12:\"type_produit\";N;s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:12500;s:12:\"UNITE_MESURE\";s:1:\"0\";s:2:\"pt\";s:5:\"12500\";s:11:\"DESIGNATION\";s:1:\"5\";s:13:\"PRIX_UNITAIRE\";s:3:\"500\";s:13:\"SECR_STOCK_ID\";s:1:\"5\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"fa3e91445faf456102866ae1c3b3f311\";s:8:\"subtotal\";d:1;}s:32:\"d587cffbf1e0610f05bc5b6da40cc5dd\";a:16:{s:2:\"id\";s:5:\"px-10\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:9900;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"10000\";s:11:\"DESIGNATION\";s:1:\"6\";s:13:\"PRIX_UNITAIRE\";s:4:\"5000\";s:13:\"SECR_STOCK_ID\";s:2:\"10\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d587cffbf1e0610f05bc5b6da40cc5dd\";s:8:\"subtotal\";d:1;}}', '2023-12-16 11:20:56'),
(1400, '6fb33729b7b7f011949deb5419d87cea83dd6681', '154.117.217.44', 1702727072, '__ci_last_regenerate|i:1702727072;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-16 11:28:53'),
(1401, '2c3f5d1183ca9b5d9ea6088f9356f71aafe3cb1f', '154.117.217.44', 1702727423, '__ci_last_regenerate|i:1702727423;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-16 11:44:33'),
(1402, '2436455b4a00d298661e67f8c2bdb7aa0888211e', '154.117.217.44', 1702727490, '__ci_last_regenerate|i:1702727423;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-16 11:50:23'),
(1403, '05bbc4394844f568b2f9957ef458b5f4b7e0f45a', '198.235.24.52', 1702734182, '__ci_last_regenerate|i:1702734181;', '2023-12-16 13:43:02'),
(1404, '159eeb320f36b073878d8d3f231b96ed931d5921', '41.79.46.247', 1702739318, '__ci_last_regenerate|i:1702739318;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-16 15:02:54'),
(1405, 'f3d254408e7b5f2380901965197854b17985e1f3', '41.79.46.247', 1702739846, '__ci_last_regenerate|i:1702739846;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-16 15:08:38'),
(1406, 'ba296ed02f1687d828daff0cf7e3323a2b04dc12', '41.79.46.247', 1702740248, '__ci_last_regenerate|i:1702740248;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-16 15:17:26'),
(1407, '14558329aa05f3ea025b64654353174a1b64a9c9', '41.79.46.247', 1702740451, '__ci_last_regenerate|i:1702740248;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-16 15:24:08'),
(1408, 'ec80069fff549c41f53eaecc788129b69f3b176d', '205.210.31.10', 1702745645, '__ci_last_regenerate|i:1702745644;', '2023-12-16 16:54:05'),
(1409, '6fbada3cf615eb0aa6c1be7f1f62e7870070a48c', '205.210.31.51', 1702767924, '__ci_last_regenerate|i:1702767924;', '2023-12-16 23:05:24'),
(1410, '11fb781b7d7a4b981a8ebc2b2dac80e52fe43227', '188.165.87.101', 1702781061, '__ci_last_regenerate|i:1702781061;', '2023-12-17 02:44:21'),
(1411, '8e583823419973e841badb80b27fc720e98eb33a', '188.165.87.100', 1702781150, '__ci_last_regenerate|i:1702781150;', '2023-12-17 02:45:50'),
(1412, '89f1a568070908611184d3856c449e54d87f40d6', '188.165.87.109', 1702781232, '__ci_last_regenerate|i:1702781232;', '2023-12-17 02:47:12'),
(1413, '0598591456d680d8212cb9197dc0d7a3e3ae719c', '188.165.87.99', 1702781263, '__ci_last_regenerate|i:1702781263;', '2023-12-17 02:47:43'),
(1414, '904f4dfaac5e4f5f7a89c488911634ac724c3e2b', '51.254.49.110', 1702791041, '__ci_last_regenerate|i:1702791041;', '2023-12-17 05:30:41'),
(1415, 'af6229a9d47c6af28c806c7ba2cd24c5cf4c5676', '51.254.49.100', 1702792020, '__ci_last_regenerate|i:1702792020;', '2023-12-17 05:47:00'),
(1416, '23bfae2d3ba865366c9687156850cdedf6251c0d', '216.194.162.211', 1702794064, '__ci_last_regenerate|i:1702794064;', '2023-12-17 06:21:04'),
(1417, '7b6f4272fbd5203e053a09ff6cf3a2d5eafdb112', '154.117.219.56', 1702797541, '__ci_last_regenerate|i:1702797541;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 06:50:32'),
(1418, 'dc1ad202a04019a5db0f3dfc6d6817a171d39a14', '104.236.68.238', 1702797524, '__ci_last_regenerate|i:1702797524;', '2023-12-17 07:18:44'),
(1419, '95da26ae1671ced20e2a3887ec557c6ff215173f', '137.184.50.170', 1702797526, '__ci_last_regenerate|i:1702797526;', '2023-12-17 07:18:46'),
(1420, '2fd86d0268d3bfba5304ab4ab427fb07c8e60d80', '154.117.219.56', 1702798335, '__ci_last_regenerate|i:1702798335;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d587cffbf1e0610f05bc5b6da40cc5dd\";a:16:{s:2:\"id\";s:5:\"px-10\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"6\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:7200;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:4:\"7200\";s:11:\"DESIGNATION\";s:1:\"6\";s:13:\"PRIX_UNITAIRE\";s:4:\"1200\";s:13:\"SECR_STOCK_ID\";s:2:\"10\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d587cffbf1e0610f05bc5b6da40cc5dd\";s:8:\"subtotal\";d:1;}}', '2023-12-17 07:19:02'),
(1421, '84b9c6bb2d398e21556ce4a4dfaf5c2f1da33211', '154.117.219.56', 1702799324, '__ci_last_regenerate|i:1702799324;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 07:32:15'),
(1422, 'b904d763e1fa24d9b31dfe9570f31e1b67a222a6', '154.117.219.56', 1702799754, '__ci_last_regenerate|i:1702799754;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 07:48:44'),
(1423, '9c7e8f04ca32de81f767130c82fb4808b9d18fc9', '154.117.219.56', 1702800072, '__ci_last_regenerate|i:1702800072;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 07:55:54'),
(1424, '535c193e965eb3e863aad224935c25404f067d5c', '154.117.219.56', 1702800419, '__ci_last_regenerate|i:1702800419;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 08:01:12'),
(1425, '76117bf0fe2790790ba5448293b9d9eb86aacfa0', '154.117.219.56', 1702800751, '__ci_last_regenerate|i:1702800751;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 08:06:59'),
(1426, 'f68d6e6fb78ef0e03d965494d349e82c8bc59b28', '154.117.219.56', 1702800791, '__ci_last_regenerate|i:1702800751;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 08:12:31'),
(1427, '5a9f2c1456f17d5b02fdac00f65e763c1f597747', '41.79.45.5', 1702818303, '__ci_last_regenerate|i:1702818303;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 12:56:50'),
(1428, 'c9076f46d5d4e6ad8c4d07788e3df5892864df26', '41.79.45.5', 1702819306, '__ci_last_regenerate|i:1702819306;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 13:05:03'),
(1429, 'cce5aa018436247d92c5b2c7f57085d61ffdca3a', '41.79.45.5', 1702818717, '__ci_last_regenerate|i:1702818717;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 13:11:57'),
(1430, '4066ee73c8183d9b21999ec16aacafafbbe069ec', '41.79.45.5', 1702819710, '__ci_last_regenerate|i:1702819710;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 13:21:46'),
(1431, '54e1e911e4a39d1746d5874d53facc337a99bfde', '41.79.45.5', 1702820029, '__ci_last_regenerate|i:1702820029;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 13:28:30'),
(1432, 'a8138b83929a8e8fc0d0d3749a02b2f2733dc3a4', '41.79.45.5', 1702820502, '__ci_last_regenerate|i:1702820502;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 13:33:49'),
(1433, 'ac8f241d9583097c38435e5a89c44867f9d1231c', '41.79.45.5', 1702821181, '__ci_last_regenerate|i:1702821181;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 13:41:43'),
(1434, 'ff0a1a694c301755ff6942a86174ce0eb7101448', '41.79.45.5', 1702821726, '__ci_last_regenerate|i:1702821726;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 13:53:01'),
(1435, 'cc704769695d984e6ffeeff550cddbeb6c31ec2c', '41.79.45.5', 1702821978, '__ci_last_regenerate|i:1702821726;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 14:02:06'),
(1436, '1442801116e39f358797374b4d053246fd12336a', '154.117.219.56', 1702823376, '__ci_last_regenerate|i:1702823362;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 14:29:22'),
(1437, 'e1906cafe3f3c8759d5d1844830a7fc933e7d01f', '154.117.216.232', 1702824843, '__ci_last_regenerate|i:1702824843;', '2023-12-17 14:54:03'),
(1438, '9ffe0334c36b0ff05e24fd83de4c10184a56a949', '154.117.216.232', 1702825312, '__ci_last_regenerate|i:1702825312;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 14:55:22'),
(1439, 'e1dd1a3a7b8efb3d8f04239e377681badd07652c', '154.117.216.232', 1702825799, '__ci_last_regenerate|i:1702825799;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 15:01:52'),
(1440, '6faa0ac43d6965b7bf681de548f7f9fd6de9ad4d', '154.117.216.232', 1702826141, '__ci_last_regenerate|i:1702826141;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 15:09:59'),
(1441, '3fe5e46b8d05c0148a149b18d134fab808173cdf', '154.117.216.232', 1702826564, '__ci_last_regenerate|i:1702826564;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 15:15:41'),
(1442, '758d7cd80522cb1c84b0bf6c38965f327ffefc64', '154.117.216.232', 1702827062, '__ci_last_regenerate|i:1702827061;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 15:22:44'),
(1443, '9c01beb08a520774555c57ea2a12de2eaeb1e81a', '154.117.216.232', 1702827446, '__ci_last_regenerate|i:1702827446;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 15:31:02'),
(1444, '73bce18b879bd68a0d56544d38866ccbea7f4b5e', '154.117.216.232', 1702827809, '__ci_last_regenerate|i:1702827809;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 15:37:26'),
(1445, '2ceace26dc01a389c8f4b9be21d7834948f251d9', '154.117.216.232', 1702828158, '__ci_last_regenerate|i:1702828158;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"3\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:6600;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:4:\"6600\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:4:\"2200\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-17 15:43:30'),
(1446, '2a5a36a6f2c42269ecc76acf77b934132eb30d40', '154.117.216.232', 1702828512, '__ci_last_regenerate|i:1702828512;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:2500;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:4:\"2500\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:4:\"2500\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-17 15:49:18'),
(1447, 'ca68f2f8d555aa179178b9a79b959c9981c02648', '154.117.216.232', 1702828858, '__ci_last_regenerate|i:1702828858;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 15:55:12'),
(1448, '65a81dacfe0183add30691f92f4b039e77e20172', '154.117.216.232', 1702829216, '__ci_last_regenerate|i:1702829216;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 16:00:58'),
(1449, '8886206a81d3f005c737630ef70f69559e72470c', '154.117.216.232', 1702829528, '__ci_last_regenerate|i:1702829528;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 16:06:56'),
(1450, '2885ab12c2ea82b7590d6429ed2637ba33d83342', '154.117.216.232', 1702830163, '__ci_last_regenerate|i:1702830163;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 16:12:08'),
(1451, '03245be51c00de69f4167438c4209373d1da6767', '154.117.216.232', 1702829852, '__ci_last_regenerate|i:1702829852;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 16:17:32'),
(1452, 'c8bcd1b88a95d5253676d72746155c91a14a8cf3', '154.117.216.232', 1702830476, '__ci_last_regenerate|i:1702830476;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 16:22:43'),
(1453, 'fec0b4e7133188faca82f7c163b4374405a59fb1', '154.117.216.232', 1702830827, '__ci_last_regenerate|i:1702830827;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 16:27:56'),
(1454, 'd9527fe319a5187504989645d4e94415ff3709c0', '154.117.216.232', 1702831136, '__ci_last_regenerate|i:1702831136;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"9ab987321102556281fff7b4bb88e01d\";a:16:{s:2:\"id\";s:5:\"px-49\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"10\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:100000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:2:\"26\";s:13:\"PRIX_UNITAIRE\";s:5:\"10000\";s:13:\"SECR_STOCK_ID\";s:2:\"49\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9ab987321102556281fff7b4bb88e01d\";s:8:\"subtotal\";d:1;}}', '2023-12-17 16:33:47'),
(1455, '6a247a61cb5d9bbdf962a5cc2183d3d6ebe859c5', '154.117.216.232', 1702831503, '__ci_last_regenerate|i:1702831503;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"9ab987321102556281fff7b4bb88e01d\";a:16:{s:2:\"id\";s:5:\"px-49\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"10\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:100000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:2:\"26\";s:13:\"PRIX_UNITAIRE\";s:5:\"10000\";s:13:\"SECR_STOCK_ID\";s:2:\"49\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9ab987321102556281fff7b4bb88e01d\";s:8:\"subtotal\";d:1;}}', '2023-12-17 16:38:56'),
(1456, '9ca0a618e1947c4ebd09b96c1593529807de1163', '154.117.216.232', 1702831827, '__ci_last_regenerate|i:1702831827;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"9ab987321102556281fff7b4bb88e01d\";a:16:{s:2:\"id\";s:5:\"px-49\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"10\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:100000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:2:\"26\";s:13:\"PRIX_UNITAIRE\";s:5:\"10000\";s:13:\"SECR_STOCK_ID\";s:2:\"49\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9ab987321102556281fff7b4bb88e01d\";s:8:\"subtotal\";d:1;}}', '2023-12-17 16:45:03');
INSERT INTO `session_table` (`id_session`, `id`, `ip_address`, `timestamp`, `data`, `date_action`) VALUES
(1457, '7f9571385b2398f540e9cabc9ce6343ded3d3388', '154.117.216.232', 1702832198, '__ci_last_regenerate|i:1702832198;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"9ab987321102556281fff7b4bb88e01d\";a:16:{s:2:\"id\";s:5:\"px-49\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"10\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:100000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:2:\"26\";s:13:\"PRIX_UNITAIRE\";s:5:\"10000\";s:13:\"SECR_STOCK_ID\";s:2:\"49\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9ab987321102556281fff7b4bb88e01d\";s:8:\"subtotal\";d:1;}}', '2023-12-17 16:50:27'),
(1458, '19503a12a05db0286972d036d1fd7032cb19c2a8', '154.117.216.232', 1702837855, '__ci_last_regenerate|i:1702837855;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"9ab987321102556281fff7b4bb88e01d\";a:16:{s:2:\"id\";s:5:\"px-49\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"10\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:100000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:2:\"26\";s:13:\"PRIX_UNITAIRE\";s:5:\"10000\";s:13:\"SECR_STOCK_ID\";s:2:\"49\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9ab987321102556281fff7b4bb88e01d\";s:8:\"subtotal\";d:1;}}', '2023-12-17 16:56:38'),
(1459, '1d8cf13496daf69a74277a1ec74ca7adcbe65459', '154.117.217.152', 1702842255, '__ci_last_regenerate|i:1702842255;', '2023-12-17 18:28:19'),
(1460, 'a1cf1153436286ad699fd21477099cf184ffc987', '154.117.217.152', 1702838320, '__ci_last_regenerate|i:1702838320;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"9ab987321102556281fff7b4bb88e01d\";a:16:{s:2:\"id\";s:5:\"px-49\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"10\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:100000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:2:\"26\";s:13:\"PRIX_UNITAIRE\";s:5:\"10000\";s:13:\"SECR_STOCK_ID\";s:2:\"49\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9ab987321102556281fff7b4bb88e01d\";s:8:\"subtotal\";d:1;}}', '2023-12-17 18:30:55'),
(1461, '5d93b2027beccf62601bb5464a75a298c3a3b430', '154.117.217.152', 1702839340, '__ci_last_regenerate|i:1702839340;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 18:38:40'),
(1462, 'ce07481509a622d1d22c38239dacaec177468fb9', '154.117.217.152', 1702839023, '__ci_last_regenerate|i:1702839023;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 18:50:23'),
(1463, '31497d5ebd3ba81c024149500230f29749363e3c', '154.117.217.152', 1702839645, '__ci_last_regenerate|i:1702839645;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 18:55:40'),
(1464, '2cd1d73131d232e5a57e895320d7ab62064b6755', '154.117.217.152', 1702840214, '__ci_last_regenerate|i:1702840214;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 19:00:45'),
(1465, 'c39d6902cf7322b9a14f716c51326db086438b62', '154.117.219.89', 1702840709, '__ci_last_regenerate|i:1702840709;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 19:09:30'),
(1466, 'cbab09e608db391c4120d65cd882b834dafbe83d', '154.117.217.152', 1702840628, '__ci_last_regenerate|i:1702840628;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 19:10:14'),
(1467, 'cbe62d0bfa6c5ae014c8632e59571962b8349b10', '154.117.217.152', 1702840969, '__ci_last_regenerate|i:1702840969;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 19:17:09'),
(1468, 'e341377e5c8d7bcae9a468403c12d7112756f9b1', '154.117.219.89', 1702841055, '__ci_last_regenerate|i:1702841055;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 19:18:29'),
(1469, '114b95903ad4e702f75732b7a9d5709762dabd6b', '154.117.217.152', 1702841269, '__ci_last_regenerate|i:1702840969;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 19:22:49'),
(1470, '72f2114c2e5d91acc93a79f2dc848ed2ef844f60', '154.117.219.89', 1702841681, '__ci_last_regenerate|i:1702841681;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 19:24:15'),
(1471, '0654f8f8914a1ccd73cc5d8762240df528db4773', '154.117.219.89', 1702842131, '__ci_last_regenerate|i:1702842131;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 19:34:42'),
(1472, '2d7d2b80185bb13eae19380f284c3f1a91f0b919', '154.117.219.89', 1702842521, '__ci_last_regenerate|i:1702842521;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 19:42:11'),
(1473, '725220b268b5d06582808b0c6d48b7c9d4c4aac5', '154.117.217.152', 1702842634, '__ci_last_regenerate|i:1702842634;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:2000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:4:\"2000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:4:\"2000\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-17 19:44:15'),
(1474, '64a70ce4c9506fbe0024e44902d83fb6c6dc1c2d', '154.117.219.89', 1702842935, '__ci_last_regenerate|i:1702842935;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 19:48:41'),
(1475, 'a6ea11b9d7c500917a965db705bfef72093b936e', '154.117.217.152', 1702843067, '__ci_last_regenerate|i:1702843067;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:2000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:4:\"2000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:4:\"2000\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-17 19:50:34'),
(1476, '457b58b87cd3de6b8d376c108921258e84b6f748', '154.117.219.89', 1702843239, '__ci_last_regenerate|i:1702843239;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 19:55:35'),
(1477, '28fe761246738bbce1078a1a8255531f7e0e8fde', '154.117.217.152', 1702843099, '__ci_last_regenerate|i:1702843067;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 19:57:47'),
(1478, '2d6f2f54605308a4b3bf7f8ce46a8c2d644f8a89', '154.117.219.89', 1702843603, '__ci_last_regenerate|i:1702843603;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 20:00:39'),
(1479, '66e914b4681a8a7bf45d792df41116897dcfb06f', '154.117.219.89', 1702843606, '__ci_last_regenerate|i:1702843603;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-17 20:06:43'),
(1480, '6001e19d7492cc61409372b4f428ba1dec083e58', '54.241.93.188', 1702860660, '__ci_last_regenerate|i:1702860659;', '2023-12-18 00:51:00'),
(1481, '87e9c9604e17c3a01270999b8b457e3f2f766059', '13.57.39.16', 1702863751, '__ci_last_regenerate|i:1702863750;', '2023-12-18 01:42:31'),
(1482, '1bd6875f951b58fd1bbbc3ad806658be2acf4312', '147.182.158.38', 1702889265, '__ci_last_regenerate|i:1702889265;', '2023-12-18 08:47:45'),
(1483, '38d85fceffbe5b65771771608e3bc7c38650b6dc', '147.182.158.38', 1702889266, '__ci_last_regenerate|i:1702889266;', '2023-12-18 08:47:46'),
(1484, '6f902ced6e7fb3c0d0771ad2cfc9c0baceb1d879', '102.134.96.146', 1702893719, '__ci_last_regenerate|i:1702893719;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-18 09:51:01'),
(1485, 'f072955bcc11bb4e277612ce682d1edba83e8936', '102.134.96.146', 1702893068, '__ci_last_regenerate|i:1702893068;', '2023-12-18 09:51:08'),
(1486, 'a6867bfac23fdc57de05768a98acf311f6df3d3b', '102.134.96.146', 1702894251, '__ci_last_regenerate|i:1702894251;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-18 10:02:00'),
(1487, 'ddb45a6fd9d24a1639ca24998df36ef3bc700660', '102.134.96.146', 1702894596, '__ci_last_regenerate|i:1702894596;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-18 10:10:52'),
(1488, '163f3792356e6da64a5095f3f61a2eb72f4e1fd2', '102.134.96.146', 1702895119, '__ci_last_regenerate|i:1702895119;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-18 10:16:36'),
(1489, 'f74186d7a8e6a80f67ef5a649566f5dae01c1292', '102.134.96.146', 1702895447, '__ci_last_regenerate|i:1702895447;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-18 10:25:19'),
(1490, '461b5800339a6889141abd6c1b41803cd3fd2622', '102.134.96.146', 1702895998, '__ci_last_regenerate|i:1702895998;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-18 10:30:47'),
(1491, '4b4f30e9506c1796047190d71b321d9955de0432', '102.134.96.146', 1702896074, '__ci_last_regenerate|i:1702895998;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-18 10:39:58'),
(1492, '0a80e39f697dcaff494293a634d5d7e4b86adbae', '154.117.219.89', 1702904989, '__ci_last_regenerate|i:1702904989;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-18 13:04:05'),
(1494, '55eaaa70003824ede05e571f20b6b25750c4569f', '154.117.219.89', 1702905304, '__ci_last_regenerate|i:1702905304;', '2023-12-18 13:15:04'),
(1495, 'd1c7d60b9e3a4a816fcea1faee48b1da80999a41', '102.134.96.146', 1702915861, '__ci_last_regenerate|i:1702915861;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-18 16:02:27'),
(1496, 'ed3723e29b658a512ff5c5937bdade54c737a429', '102.134.96.146', 1702915899, '__ci_last_regenerate|i:1702915861;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-18 16:11:02'),
(1497, '14106326479866bd300b28a367f6a122623fdf6f', '216.194.162.211', 1702966842, '__ci_last_regenerate|i:1702966841;', '2023-12-19 06:20:42'),
(1498, '74bdfeb9bddfc3f4c97eb06e83bc8c352a59e20d', '154.117.219.98', 1702983737, '__ci_last_regenerate|i:1702983737;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-19 10:47:39'),
(1499, '53510aa7084c919f85370772da9646b28714db0c', '154.117.216.169', 1702983300, '__ci_last_regenerate|i:1702983299;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-19 10:55:00'),
(1500, 'dc88ce2d48e52b29a2df15d7b843d067f21133be', '154.117.219.98', 1702984433, '__ci_last_regenerate|i:1702984433;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-19 11:02:17'),
(1501, 'a1c83b64760126640e2196f993083681a1d1a6b1', '154.117.219.98', 1702984131, '__ci_last_regenerate|i:1702984131;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-19 11:08:51'),
(1502, 'b453558df46d53affeabb825ee8bedc8172e9df3', '154.117.219.98', 1702984796, '__ci_last_regenerate|i:1702984796;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"e5a3b6db5a7288230ef676d759c42f43\";a:16:{s:2:\"id\";s:5:\"px-47\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:20000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:5:\"20000\";s:11:\"DESIGNATION\";s:2:\"25\";s:13:\"PRIX_UNITAIRE\";s:5:\"20000\";s:13:\"SECR_STOCK_ID\";s:2:\"47\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"e5a3b6db5a7288230ef676d759c42f43\";s:8:\"subtotal\";d:1;}}', '2023-12-19 11:13:53'),
(1503, '4fc55269f1432bef99b87745d9b03e24da527dd8', '154.117.219.98', 1702985109, '__ci_last_regenerate|i:1702985109;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"e5a3b6db5a7288230ef676d759c42f43\";a:16:{s:2:\"id\";s:5:\"px-47\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:20000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:5:\"20000\";s:11:\"DESIGNATION\";s:2:\"25\";s:13:\"PRIX_UNITAIRE\";s:5:\"20000\";s:13:\"SECR_STOCK_ID\";s:2:\"47\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"e5a3b6db5a7288230ef676d759c42f43\";s:8:\"subtotal\";d:1;}}', '2023-12-19 11:19:56'),
(1504, '4186db2b3f24792bce52a40b3673223c5a71e4a3', '154.117.219.98', 1702985452, '__ci_last_regenerate|i:1702985452;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"e5a3b6db5a7288230ef676d759c42f43\";a:16:{s:2:\"id\";s:5:\"px-47\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:20000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:5:\"20000\";s:11:\"DESIGNATION\";s:2:\"25\";s:13:\"PRIX_UNITAIRE\";s:5:\"20000\";s:13:\"SECR_STOCK_ID\";s:2:\"47\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"e5a3b6db5a7288230ef676d759c42f43\";s:8:\"subtotal\";d:1;}}', '2023-12-19 11:25:09'),
(1505, 'f49d0f62294ee0c2c5b3bbd56b5da0445b0ba329', '154.117.219.98', 1702985831, '__ci_last_regenerate|i:1702985831;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"e5a3b6db5a7288230ef676d759c42f43\";a:16:{s:2:\"id\";s:5:\"px-47\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:20000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:5:\"20000\";s:11:\"DESIGNATION\";s:2:\"25\";s:13:\"PRIX_UNITAIRE\";s:5:\"20000\";s:13:\"SECR_STOCK_ID\";s:2:\"47\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"e5a3b6db5a7288230ef676d759c42f43\";s:8:\"subtotal\";d:1;}}', '2023-12-19 11:30:52'),
(1506, 'b6f4f55be2209ab120e3ec5bbbc19b242ab9ed51', '154.117.219.98', 1702986046, '__ci_last_regenerate|i:1702985831;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"e5a3b6db5a7288230ef676d759c42f43\";a:16:{s:2:\"id\";s:5:\"px-47\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:20000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:5:\"20000\";s:11:\"DESIGNATION\";s:2:\"25\";s:13:\"PRIX_UNITAIRE\";s:5:\"20000\";s:13:\"SECR_STOCK_ID\";s:2:\"47\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"e5a3b6db5a7288230ef676d759c42f43\";s:8:\"subtotal\";d:1;}}', '2023-12-19 11:37:11'),
(1507, '61a05531713a327d7237aa7eb69bafde7d1515cd', '102.134.96.146', 1702992909, '__ci_last_regenerate|i:1702992908;', '2023-12-19 13:35:08'),
(1508, 'f9524635f9d1f19b7301333c6ba317a0d2e4a783', '154.117.219.98', 1702995518, '__ci_last_regenerate|i:1702995518;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-19 14:12:33'),
(1509, '47d0446db2c9af493ec10f96450da7e2e138ef31', '154.117.219.98', 1702996782, '__ci_last_regenerate|i:1702996782;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-19 14:18:38'),
(1510, '64b567d5499b307dd106b0081901341b4f7e78c8', '154.117.219.98', 1702997103, '__ci_last_regenerate|i:1702997103;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-19 14:39:42'),
(1511, '851907fad7c07df954aff9147bb92821cf3f9595', '154.117.219.98', 1702997411, '__ci_last_regenerate|i:1702997411;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-19 14:45:03'),
(1512, 'ddc78074b336ff08ac28c3507abbf035a002ce33', '154.117.219.98', 1702997758, '__ci_last_regenerate|i:1702997758;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-19 14:50:11'),
(1513, '83abb2d3527c90d6c792f27be18929f32c92b24c', '154.117.219.98', 1702998128, '__ci_last_regenerate|i:1702998128;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-19 14:55:58'),
(1514, '6cc6eb144f5799e59c67be42dbea4b6a0c23ab7c', '154.117.219.98', 1702998552, '__ci_last_regenerate|i:1702998552;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-19 15:02:08'),
(1515, '066a2553fea9f153e640a71e7e4f61afa5b92f7b', '154.117.219.98', 1702999072, '__ci_last_regenerate|i:1702999023;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"1dc5073063802fb780b8a925034c5a71\";a:16:{s:2:\"id\";s:5:\"px-45\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:3000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:4:\"3000\";s:11:\"DESIGNATION\";s:2:\"24\";s:13:\"PRIX_UNITAIRE\";s:3:\"200\";s:13:\"SECR_STOCK_ID\";s:2:\"45\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"1dc5073063802fb780b8a925034c5a71\";s:8:\"subtotal\";d:1;}}', '2023-12-19 15:09:12'),
(1516, '9100fa1d7a95768c32fd49702dadf51d9b0ae217', '154.117.219.98', 1702999023, '__ci_last_regenerate|i:1702999023;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"1dc5073063802fb780b8a925034c5a71\";a:16:{s:2:\"id\";s:5:\"px-45\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:3000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:4:\"3000\";s:11:\"DESIGNATION\";s:2:\"24\";s:13:\"PRIX_UNITAIRE\";s:3:\"200\";s:13:\"SECR_STOCK_ID\";s:2:\"45\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"1dc5073063802fb780b8a925034c5a71\";s:8:\"subtotal\";d:1;}}', '2023-12-19 15:17:03'),
(1517, '4c3f7fb310260c9104a1f04b4c723f4e4e05ba3f', '176.123.7.11', 1703005174, '__ci_last_regenerate|i:1703005174;', '2023-12-19 16:59:34'),
(1518, 'a4637198477ec7b72200bf7f10c18353aa03a36e', '154.117.195.45', 1703048126, '__ci_last_regenerate|i:1703048126;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-20 04:48:32'),
(1519, '80c700d69c6119c1a0bb9fd60105c92fea7b1548', '154.117.195.45', 1703048431, '__ci_last_regenerate|i:1703048431;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-20 04:55:26'),
(1520, '4c1e3c4a41a95615abad8aad89e563481da352fc', '154.117.195.45', 1703048854, '__ci_last_regenerate|i:1703048854;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-20 05:00:31'),
(1521, '4a340b99d5f9b840bb1747b7e27edd9f9844c741', '154.117.195.45', 1703049210, '__ci_last_regenerate|i:1703049210;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-20 05:07:34'),
(1522, '180ea28413c06988df06f5154f14c1cabd285cac', '154.117.195.45', 1703050291, '__ci_last_regenerate|i:1703050291;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-20 05:13:30'),
(1523, '7e67e27ec9be983718f90f9d582b0863c7abf9cf', '154.117.195.45', 1703050799, '__ci_last_regenerate|i:1703050799;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-20 05:31:31'),
(1524, 'f0b5de4b39a54fa6d6e85d740223520fade5aa50', '154.117.195.45', 1703051171, '__ci_last_regenerate|i:1703051171;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";a:16:{s:2:\"id\";s:4:\"px-1\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:87500;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"87500\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"17500\";s:13:\"SECR_STOCK_ID\";s:1:\"1\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";s:8:\"subtotal\";d:1;}}', '2023-12-20 05:40:00'),
(1525, '8044f36ae441ff82bb0eebf0301f633a15c55f7e', '154.117.195.45', 1703051578, '__ci_last_regenerate|i:1703051578;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";a:16:{s:2:\"id\";s:4:\"px-1\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"2\";s:9:\"netapayer\";i:98000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"20000\";s:13:\"SECR_STOCK_ID\";s:1:\"1\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";s:8:\"subtotal\";d:1;}s:32:\"d587cffbf1e0610f05bc5b6da40cc5dd\";a:16:{s:2:\"id\";s:5:\"px-10\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"3\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"2\";s:9:\"netapayer\";i:41160;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"42000\";s:11:\"DESIGNATION\";s:1:\"6\";s:13:\"PRIX_UNITAIRE\";s:5:\"14000\";s:13:\"SECR_STOCK_ID\";s:2:\"10\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d587cffbf1e0610f05bc5b6da40cc5dd\";s:8:\"subtotal\";d:1;}}', '2023-12-20 05:46:11'),
(1526, 'ee4fe41d07c4443f8883bcb9368ce686b203b4c7', '154.117.195.45', 1703052194, '__ci_last_regenerate|i:1703052194;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-20 05:52:58'),
(1527, '8341e92b66edb27ee4e28b44ac2195feb1a2ee6f', '154.117.195.45', 1703052617, '__ci_last_regenerate|i:1703052617;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-20 06:03:14'),
(1528, '45e9d7266797f29ae1de54f48455c5dae9115d1a', '154.117.195.45', 1703052946, '__ci_last_regenerate|i:1703052946;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-20 06:10:17'),
(1529, 'c771c10f704c43945c77b710fe23ad0e62a1a84d', '154.117.195.45', 1703053253, '__ci_last_regenerate|i:1703053253;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-20 06:15:46'),
(1530, '920008bcc7a81d18d2a1b2b8b594af80412f3ea9', '154.117.216.252', 1703053361, '__ci_last_regenerate|i:1703053140;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-20 06:19:00'),
(1531, '81af88007873701703bdcbfac62d1ce374f5e135', '154.117.195.45', 1703054152, '__ci_last_regenerate|i:1703054152;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-20 06:20:53'),
(1532, '2d0fcf32dd6e83c9fc83a165ac5d047cc8930755', '154.117.195.45', 1703054461, '__ci_last_regenerate|i:1703054461;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-20 06:35:53'),
(1533, 'b747c3270773361fcfbd544f923da1d260615a64', '154.117.195.45', 1703054770, '__ci_last_regenerate|i:1703054770;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-20 06:41:02'),
(1534, 'a1756363ce22e5b6a03a212f596b6bc4e384acfe', '154.117.195.45', 1703054779, '__ci_last_regenerate|i:1703054770;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-20 06:46:11'),
(1535, 'c603abae4c281e2cbaa47c6f403cac4637ae0338', '199.45.154.17', 1703130591, '__ci_last_regenerate|i:1703130591;', '2023-12-21 03:49:51'),
(1536, 'fb73e565f11013bee3032010c4029f8aa0bcfabd', '199.45.154.51', 1703132979, '__ci_last_regenerate|i:1703132979;', '2023-12-21 04:29:39'),
(1537, 'a9f8629c9e6937bdcb257d7130393f2c3ae88451', '216.194.162.211', 1703139639, '__ci_last_regenerate|i:1703139638;', '2023-12-21 06:20:39'),
(1538, '92ec308950ed777a88d8ec3d451d211d0bb02c2f', '154.117.217.14', 1703147432, '__ci_last_regenerate|i:1703147402;', '2023-12-21 08:30:02'),
(1539, '87864e676dd58323fff77abc1379a47c91eb0658', '154.117.217.14', 1703147830, '__ci_last_regenerate|i:1703147830;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"49e22734237e23bee1136bb2e78f9c2c\";a:14:{s:2:\"id\";s:3:\"S-1\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:29700;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"30000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"49e22734237e23bee1136bb2e78f9c2c\";s:8:\"subtotal\";d:1;}}', '2023-12-21 08:31:58'),
(1540, '363e4185805c385bbae805a70d663801f7948a60', '154.117.217.14', 1703149045, '__ci_last_regenerate|i:1703149045;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"49e22734237e23bee1136bb2e78f9c2c\";a:14:{s:2:\"id\";s:3:\"S-1\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:29700;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"30000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"49e22734237e23bee1136bb2e78f9c2c\";s:8:\"subtotal\";d:1;}}', '2023-12-21 08:37:10'),
(1541, '9b2066c1561d2e9eb71bf256f99494845c860603', '154.117.217.14', 1703149362, '__ci_last_regenerate|i:1703149362;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"49e22734237e23bee1136bb2e78f9c2c\";a:14:{s:2:\"id\";s:3:\"S-1\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"50\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:742500;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:6:\"750000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"49e22734237e23bee1136bb2e78f9c2c\";s:8:\"subtotal\";d:1;}}', '2023-12-21 08:57:25'),
(1542, '832a6bf9c20e42d656a6f1a29298c0300abe559a', '154.117.217.14', 1703149680, '__ci_last_regenerate|i:1703149680;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"49e22734237e23bee1136bb2e78f9c2c\";a:14:{s:2:\"id\";s:3:\"S-1\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"50\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:742500;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:6:\"750000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"49e22734237e23bee1136bb2e78f9c2c\";s:8:\"subtotal\";d:1;}}', '2023-12-21 09:02:42'),
(1543, '3ee30402e5c19c7ba265d53f09dc251701511cf1', '154.117.217.14', 1703150086, '__ci_last_regenerate|i:1703150086;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"49e22734237e23bee1136bb2e78f9c2c\";a:14:{s:2:\"id\";s:3:\"S-1\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"50\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:742500;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:6:\"750000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"49e22734237e23bee1136bb2e78f9c2c\";s:8:\"subtotal\";d:1;}}', '2023-12-21 09:08:00'),
(1544, 'b11064efe674353a1f04a72adb416df5daadca4d', '154.117.217.14', 1703150401, '__ci_last_regenerate|i:1703150401;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"4c14ce63c8892f9e4f810607f32f23d4\";a:16:{s:2:\"id\";s:4:\"px-9\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:990;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:4:\"1000\";s:11:\"DESIGNATION\";s:1:\"6\";s:13:\"PRIX_UNITAIRE\";s:3:\"500\";s:13:\"SECR_STOCK_ID\";s:1:\"9\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"4c14ce63c8892f9e4f810607f32f23d4\";s:8:\"subtotal\";d:1;}}', '2023-12-21 09:14:46'),
(1545, '7b377b3eab3f1edd8936c9b1f2d2744df96872ee', '154.117.217.14', 1703150724, '__ci_last_regenerate|i:1703150724;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"4c14ce63c8892f9e4f810607f32f23d4\";a:16:{s:2:\"id\";s:4:\"px-9\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:990;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:4:\"1000\";s:11:\"DESIGNATION\";s:1:\"6\";s:13:\"PRIX_UNITAIRE\";s:3:\"500\";s:13:\"SECR_STOCK_ID\";s:1:\"9\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"4c14ce63c8892f9e4f810607f32f23d4\";s:8:\"subtotal\";d:1;}}', '2023-12-21 09:20:01'),
(1546, 'bbc22ff56d5095cb67f99530f71e39faecd4e891', '154.117.217.14', 1703150735, '__ci_last_regenerate|i:1703150724;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"4c14ce63c8892f9e4f810607f32f23d4\";a:16:{s:2:\"id\";s:4:\"px-9\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:990;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:4:\"1000\";s:11:\"DESIGNATION\";s:1:\"6\";s:13:\"PRIX_UNITAIRE\";s:3:\"500\";s:13:\"SECR_STOCK_ID\";s:1:\"9\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"4c14ce63c8892f9e4f810607f32f23d4\";s:8:\"subtotal\";d:1;}}', '2023-12-21 09:25:24'),
(1547, 'af20456923da19aaac23a872140172aaf35c18d4', '154.117.219.25', 1703151870, '__ci_last_regenerate|i:1703151870;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-21 09:39:05'),
(1548, 'd5287a5a2528ec7060732ce9509bb47486f91a61', '154.117.219.25', 1703152369, '__ci_last_regenerate|i:1703152369;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:4;s:11:\"total_items\";d:4;s:32:\"49e22734237e23bee1136bb2e78f9c2c\";a:14:{s:2:\"id\";s:3:\"S-1\";s:3:\"qty\";d:4;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:30000;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"30000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"30000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"49e22734237e23bee1136bb2e78f9c2c\";s:8:\"subtotal\";d:4;}}', '2023-12-21 09:44:30'),
(1549, 'd3962915b53c445e5b80e0edf571a63aff6ae42d', '154.117.219.25', 1703152688, '__ci_last_regenerate|i:1703152688;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:4;s:11:\"total_items\";d:4;s:32:\"49e22734237e23bee1136bb2e78f9c2c\";a:14:{s:2:\"id\";s:3:\"S-1\";s:3:\"qty\";d:4;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:30000;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"30000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"30000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"49e22734237e23bee1136bb2e78f9c2c\";s:8:\"subtotal\";d:4;}}', '2023-12-21 09:52:49'),
(1550, 'b2c3bbd039fae46ad7e39b24504da3facd81b169', '154.117.219.25', 1703152811, '__ci_last_regenerate|i:1703152688;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:4;s:11:\"total_items\";d:4;s:32:\"49e22734237e23bee1136bb2e78f9c2c\";a:14:{s:2:\"id\";s:3:\"S-1\";s:3:\"qty\";d:4;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:30000;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"30000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"30000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"49e22734237e23bee1136bb2e78f9c2c\";s:8:\"subtotal\";d:4;}}', '2023-12-21 09:58:08'),
(1551, 'f249a3660e0d9677abf50fe8a21919ecf1bc1bff', '154.117.216.1', 1703153671, '__ci_last_regenerate|i:1703153671;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-21 10:08:42'),
(1552, 'c9112fac4db033689795a03b73d32298edfb072b', '154.117.216.1', 1703154102, '__ci_last_regenerate|i:1703154102;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-21 10:14:31'),
(1553, '13a176d04f2bb8f25d8996e566f2280cbd067c54', '154.117.216.1', 1703154495, '__ci_last_regenerate|i:1703154495;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"49e22734237e23bee1136bb2e78f9c2c\";a:14:{s:2:\"id\";s:3:\"S-1\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:20000;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"20000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"20000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"49e22734237e23bee1136bb2e78f9c2c\";s:8:\"subtotal\";d:1;}}', '2023-12-21 10:21:43'),
(1554, '54805390209f397288cdeb7d5dd3369f8a883766', '154.117.216.1', 1703154837, '__ci_last_regenerate|i:1703154837;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"49e22734237e23bee1136bb2e78f9c2c\";a:14:{s:2:\"id\";s:3:\"S-1\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:20000;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"20000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"20000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"49e22734237e23bee1136bb2e78f9c2c\";s:8:\"subtotal\";d:1;}}', '2023-12-21 10:28:15'),
(1555, '0bcf53b1d6f5309cacac615f71e88d1e9bb61d28', '154.117.216.1', 1703155204, '__ci_last_regenerate|i:1703155204;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:20000;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"20000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"4000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-21 10:33:57');
INSERT INTO `session_table` (`id_session`, `id`, `ip_address`, `timestamp`, `data`, `date_action`) VALUES
(1556, '3fbd818adffe1dd6a41d5fe276e6a1b5087f988a', '154.117.216.1', 1703155638, '__ci_last_regenerate|i:1703155638;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:20000;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"20000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"4000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-21 10:40:05'),
(1557, 'ddc77f91131f57c96b39c64ddefb3bda77b82136', '154.117.216.1', 1703156343, '__ci_last_regenerate|i:1703156343;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:20000;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"20000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"4000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-21 10:47:18'),
(1558, 'f6e0644435cac58d7f4b434e997a1aace17aa501', '154.117.216.1', 1703157375, '__ci_last_regenerate|i:1703157375;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:20000;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"20000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"4000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-21 10:59:03'),
(1559, '4f95a8627e15edc94c0a584058e007287719f772', '154.117.216.1', 1703158081, '__ci_last_regenerate|i:1703158081;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:20000;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"20000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"4000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-21 11:16:16'),
(1560, '8c243fd53fb6fca0f24ad0fab48b33f0ee15bba2', '154.117.216.1', 1703158534, '__ci_last_regenerate|i:1703158534;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-21 11:28:01'),
(1561, '45986eb63803845cecec6c7a6b9dcc06c17380b7', '154.117.216.1', 1703159106, '__ci_last_regenerate|i:1703159106;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-21 11:35:34'),
(1562, 'cd2abe78cb439c3385beb974170dd2d43a1c5ee8', '154.117.216.1', 1703159214, '__ci_last_regenerate|i:1703159106;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";a:14:{s:2:\"id\";s:3:\"S-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:50000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"50000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:5:\"50000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";s:8:\"subtotal\";d:1;}}', '2023-12-21 11:45:06'),
(1563, '165187467d2727c2af05a060374455e6eb55347d', '65.154.226.168', 1703167269, '__ci_last_regenerate|i:1703167269;', '2023-12-21 14:01:09'),
(1564, '54d698ffa906d6e23ddc509c682926b7a7888ba5', '65.154.226.167', 1703168699, '__ci_last_regenerate|i:1703168699;', '2023-12-21 14:24:59'),
(1565, 'eaf3fb22ce0514e2333464964766458e2e0ae98e', '87.236.176.125', 1703183714, '__ci_last_regenerate|i:1703183713;', '2023-12-21 18:35:14'),
(1566, '90620742e71e9fea4caf6ccf109f7f87b9511596', '154.117.216.130', 1703255196, '__ci_last_regenerate|i:1703255195;', '2023-12-22 14:26:36'),
(1567, '75989bf94ddacdce707db83e6651c9aaa5ac7f5e', '154.117.219.101', 1703260288, '__ci_last_regenerate|i:1703260161;', '2023-12-22 15:49:22'),
(1568, '67ec92d2bc898f0abbc08d323a1bd2b9d4afb8f9', '54.183.200.253', 1703261204, '__ci_last_regenerate|i:1703261204;', '2023-12-22 16:06:44'),
(1569, 'ca95d193ce6498fae7ebb1b25452a56dc30a4f8d', '54.153.48.2', 1703276420, '__ci_last_regenerate|i:1703276420;', '2023-12-22 20:20:20'),
(1570, '74f69fc812fc7a383346b6f2571f3b4fc51f677e', '216.194.162.211', 1703312450, '__ci_last_regenerate|i:1703312449;', '2023-12-23 06:20:50'),
(1571, 'df640fe5d0c00b086fbca4f874a8ae8423b3f9d2', '154.117.216.201', 1703323660, '__ci_last_regenerate|i:1703323660;', '2023-12-23 09:27:40'),
(1572, '3b72e740bb4f66bd0612731025f112d19919d7cf', '154.117.216.201', 1703324033, '__ci_last_regenerate|i:1703324033;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";a:14:{s:2:\"id\";s:3:\"S-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"12\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:600000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"600000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:5:\"50000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";s:8:\"subtotal\";d:1;}s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:5940;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:4:\"6000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-23 09:27:57'),
(1573, 'a186f4f0f509ab05eb9f13367fded4cb4bd53627', '154.117.216.201', 1703324040, '__ci_last_regenerate|i:1703324033;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";a:14:{s:2:\"id\";s:3:\"S-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"12\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:600000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"600000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:5:\"50000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";s:8:\"subtotal\";d:1;}s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:5940;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:4:\"6000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-23 09:33:53'),
(1574, 'df8a363b0024c4631a647211f5ef6ab9b71e6075', '154.117.217.67', 1703334229, '__ci_last_regenerate|i:1703334228;', '2023-12-23 12:23:48'),
(1575, '5c07c71fa831204bbbca35ad22b2f3096192ea00', '41.79.45.5', 1703339980, '__ci_last_regenerate|i:1703339980;', '2023-12-23 13:15:47'),
(1576, 'd19c75d069b5770f8498cba5a2dcde4b669dc2e1', '41.79.45.5', 1703339980, '__ci_last_regenerate|i:1703339980;', '2023-12-23 13:59:40'),
(1577, 'e6c4cd16b7d54712cc66077d0b35efbe389e74e3', '154.117.216.201', 1703341807, '__ci_last_regenerate|i:1703341798;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-23 14:29:58'),
(1578, 'f5441856b4fd4e30addc3006400ea2d69f907293', '41.79.45.5', 1703349432, '__ci_last_regenerate|i:1703349432;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-23 16:31:36'),
(1579, '73090e61894ed6f1c8ff15ba5ea6726dd9dcce40', '41.79.45.5', 1703351812, '__ci_last_regenerate|i:1703351812;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-23 16:37:13'),
(1580, '789765ed98b0350889dc89a249488445cb2ebe29', '41.79.45.5', 1703349826, '__ci_last_regenerate|i:1703349826;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-23 16:43:46'),
(1581, 'ee7e23d5ec592631e237bfb0731863c6a00256e7', '41.79.45.5', 1703351831, '__ci_last_regenerate|i:1703351812;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-23 17:16:52'),
(1582, '0a502f618f9c7a5b757d7268500cd64642f23a9c', '154.117.216.165', 1703414540, '__ci_last_regenerate|i:1703414540;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-24 10:32:16'),
(1583, '8d2f1190ca238287cb24feb2032be69278b88ab9', '154.117.216.165', 1703414851, '__ci_last_regenerate|i:1703414851;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-24 10:42:20'),
(1584, '19cc01e5a6a7a36e60ae36fbfe7ff067a804a6f6', '154.117.216.165', 1703415174, '__ci_last_regenerate|i:1703415174;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-24 10:47:31'),
(1585, '68097e3672d5003b8e827614aa565270db0e72a3', '154.117.216.165', 1703415506, '__ci_last_regenerate|i:1703415506;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-24 10:52:54'),
(1586, '99831bce2191f68d56c6c86d65b536aefd276e4c', '154.117.216.165', 1703415823, '__ci_last_regenerate|i:1703415823;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-24 10:58:26'),
(1587, '57555a8a0d0a1367b27bd65f1a35dc224d2df5ca', '154.117.216.165', 1703416183, '__ci_last_regenerate|i:1703416183;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-24 11:03:43'),
(1588, 'e29dab0b53ca05eec37d3c839483abf4d2671bc7', '154.117.216.165', 1703416487, '__ci_last_regenerate|i:1703416487;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-24 11:09:43'),
(1589, 'f5bd4aa042c81c2af65b2f513222302235276e97', '154.117.216.165', 1703416844, '__ci_last_regenerate|i:1703416844;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-24 11:14:47'),
(1590, '9de1f4058e7ae6e4acf9d2ca5f12f7b45279c43f', '154.117.216.165', 1703417193, '__ci_last_regenerate|i:1703417193;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"e5a3b6db5a7288230ef676d759c42f43\";a:16:{s:2:\"id\";s:5:\"px-47\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:40000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:5:\"40000\";s:11:\"DESIGNATION\";s:2:\"25\";s:13:\"PRIX_UNITAIRE\";s:5:\"20000\";s:13:\"SECR_STOCK_ID\";s:2:\"47\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"e5a3b6db5a7288230ef676d759c42f43\";s:8:\"subtotal\";d:1;}}', '2023-12-24 11:20:44'),
(1591, '4f80849bc50060cef6200d85d2711ce8672391e6', '154.117.216.165', 1703417526, '__ci_last_regenerate|i:1703417526;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";a:14:{s:2:\"id\";s:3:\"S-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:50000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"50000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:5:\"50000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";s:8:\"subtotal\";d:1;}}', '2023-12-24 11:26:33'),
(1592, '173eff5e8e1615297ec7e612c3a2c605f8a46f57', '154.117.216.165', 1703417847, '__ci_last_regenerate|i:1703417847;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";a:14:{s:2:\"id\";s:3:\"S-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:50000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"50000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:5:\"50000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";s:8:\"subtotal\";d:1;}}', '2023-12-24 11:32:06'),
(1593, '4e2cf3719e0627da00818eb6c67b19fe01a284b2', '154.117.216.165', 1703418206, '__ci_last_regenerate|i:1703418206;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";a:14:{s:2:\"id\";s:3:\"S-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:50000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"50000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:5:\"50000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";s:8:\"subtotal\";d:1;}}', '2023-12-24 11:37:27'),
(1594, '35d078268e60d183483542c8b513b89494e1f903', '154.117.216.165', 1703418684, '__ci_last_regenerate|i:1703418684;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";a:14:{s:2:\"id\";s:3:\"S-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:50000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"50000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:5:\"50000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";s:8:\"subtotal\";d:1;}}', '2023-12-24 11:43:26'),
(1595, '0b0b5c883b72b3803c123cc73638ca1b99e61041', '154.117.216.165', 1703419343, '__ci_last_regenerate|i:1703419343;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";a:14:{s:2:\"id\";s:3:\"S-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:50000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"50000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:5:\"50000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";s:8:\"subtotal\";d:1;}}', '2023-12-24 11:51:24'),
(1596, '540d749a42559b7b4d37654eb4285e604cce3c07', '154.117.216.165', 1703419799, '__ci_last_regenerate|i:1703419799;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";a:14:{s:2:\"id\";s:3:\"S-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:50000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"50000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:5:\"50000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";s:8:\"subtotal\";d:1;}}', '2023-12-24 12:02:23'),
(1597, '7b70bc69793fc3190ef17ce67db29882873db7bd', '154.117.216.165', 1703420208, '__ci_last_regenerate|i:1703420208;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";a:14:{s:2:\"id\";s:3:\"S-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:50000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"50000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:5:\"50000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";s:8:\"subtotal\";d:1;}}', '2023-12-24 12:09:59'),
(1598, 'c990453c7c9d04d6ea30a3caf73cef139a84c10c', '154.117.216.165', 1703420522, '__ci_last_regenerate|i:1703420522;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";a:14:{s:2:\"id\";s:3:\"S-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:50000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"50000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:5:\"50000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";s:8:\"subtotal\";d:1;}}', '2023-12-24 12:16:48'),
(1599, '45348daf58e52485af12227cedee1d1817a49541', '154.117.216.165', 1703420573, '__ci_last_regenerate|i:1703420522;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";a:14:{s:2:\"id\";s:3:\"S-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:50000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"50000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:5:\"50000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";s:8:\"subtotal\";d:1;}}', '2023-12-24 12:22:02'),
(1600, 'fb962733364543358be2c4de80bbd9187a27c0cf', '154.117.217.110', 1703421629, '__ci_last_regenerate|i:1703421276;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-24 12:34:36'),
(1601, '3385ef07ab0e94c14109eff011f72b7a3ce40852', '41.79.46.246', 1703426796, '__ci_last_regenerate|i:1703426796;', '2023-12-24 14:06:36'),
(1602, '81cc5eb0e93831d93c18a836e71935daf90b001f', '154.117.216.124', 1703441148, '__ci_last_regenerate|i:1703441148;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-24 18:00:35'),
(1603, '43bd735355c1cececf9378f5ed01b40583f0e4e1', '154.117.216.124', 1703441336, '__ci_last_regenerate|i:1703441148;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-24 18:05:48'),
(1604, 'c0768b5380bd93e970f8124980eaaf3f18c3e8da', '154.117.216.97', 1703478056, '__ci_last_regenerate|i:1703478056;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-25 04:14:33'),
(1605, 'e90452d82eb5d293607e5983b5e12555f21bda6a', '154.117.216.97', 1703478374, '__ci_last_regenerate|i:1703478374;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 04:20:56'),
(1606, '8feb61474e0967a1fe8e1739a0057ff72224f942', '154.117.216.97', 1703478684, '__ci_last_regenerate|i:1703478684;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 04:26:14'),
(1607, '9b66b92e7906e8e227bb594621100827940fc5e0', '154.117.216.97', 1703479015, '__ci_last_regenerate|i:1703479015;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 04:31:24'),
(1608, '889c8cb1becd4fc943313b1fc7a68c0b32849bbd', '154.117.216.97', 1703480286, '__ci_last_regenerate|i:1703480286;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 04:36:55'),
(1609, 'e751c6094fbc6676af8e4fe6a18608031d50a00d', '154.117.216.97', 1703480597, '__ci_last_regenerate|i:1703480597;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 04:58:07'),
(1610, '5232375b795284c46cbc2ee01635c9635ed6095e', '154.117.216.97', 1703481004, '__ci_last_regenerate|i:1703481004;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 05:03:17'),
(1611, '02aa17b0f59400e09d9862380505cbbd667fdea7', '154.117.216.97', 1703481349, '__ci_last_regenerate|i:1703481349;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 05:10:04'),
(1612, '3348db24eddc52a1726009d828b23b5f0cd82ca4', '154.117.216.97', 1703481875, '__ci_last_regenerate|i:1703481875;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 05:15:49'),
(1613, 'fb5cc3c6ca7daa10f33c3654bf46f44fe0b8f627', '154.117.216.97', 1703482228, '__ci_last_regenerate|i:1703482228;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 05:24:35'),
(1614, '5c7ba35f7354db81e5ef9c694598c76f44f46be2', '154.117.216.97', 1703483092, '__ci_last_regenerate|i:1703483092;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 05:30:28'),
(1615, '88b3972912da8951541494140c71db7e62df7ef9', '154.117.216.97', 1703483440, '__ci_last_regenerate|i:1703483440;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 05:44:52'),
(1616, '4d9455f5b120c05495ae1518c559256032ec267b', '154.117.216.97', 1703485768, '__ci_last_regenerate|i:1703485768;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 05:50:40'),
(1617, '1ac1532cff50b4a903c4ce4a84d9ada140bfad58', '216.194.162.211', 1703485243, '__ci_last_regenerate|i:1703485242;', '2023-12-25 06:20:43'),
(1618, 'ec3f65a99daa86b8a3b45533f727af09114095ae', '154.117.216.97', 1703486088, '__ci_last_regenerate|i:1703486088;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 06:29:28'),
(1619, '26eb2faae22fb8b34837f86a22be539703fb40b7', '154.117.216.97', 1703486420, '__ci_last_regenerate|i:1703486420;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 06:34:48'),
(1620, 'b12bc0599af0bbf908a2d76164b4e3db2f81922f', '154.117.216.97', 1703486739, '__ci_last_regenerate|i:1703486739;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 06:40:20'),
(1621, '5a82d5d47cdf9896495b6d1d3088989c92ff2fee', '154.117.216.97', 1703488490, '__ci_last_regenerate|i:1703488490;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 06:45:39'),
(1622, '195c0d6f295995bc2dca0ca4e925e13dad193d77', '154.117.216.97', 1703489070, '__ci_last_regenerate|i:1703489070;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 07:14:51'),
(1623, '01f9999ae80d582f5c7782ce2e9c3bab9f16d4c1', '154.117.216.97', 1703489221, '__ci_last_regenerate|i:1703489070;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:14850;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"15000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}}', '2023-12-25 07:24:30'),
(1624, 'e1fbccab678a18fab06d2bbfff25c80e83efac01', '154.117.217.109', 1703501535, '__ci_last_regenerate|i:1703501535;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-25 10:45:36'),
(1625, '06e0ee600bd1796ef22afdfa72bffe5d526eba82', '154.117.217.109', 1703501897, '__ci_last_regenerate|i:1703501897;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-25 10:52:15'),
(1626, 'b7c996a30d6b8569b35a0ba268629befa1eea706', '154.117.217.109', 1703502226, '__ci_last_regenerate|i:1703502226;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-25 10:58:17'),
(1627, '0446270f18ca302ebeb1408df6cdfda2f4c8be8d', '154.117.217.109', 1703503450, '__ci_last_regenerate|i:1703503450;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-25 11:03:46'),
(1628, '883801ba69e47bda462685a1ac3001bd0c026b74', '154.117.217.109', 1703503757, '__ci_last_regenerate|i:1703503757;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-25 11:24:11'),
(1629, '15a71d82c6fa04c78fc9c3133e4d2748293c6539', '154.117.217.109', 1703504358, '__ci_last_regenerate|i:1703504358;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-25 11:29:17'),
(1630, '684f22db74f4275115647202a582224428e0cb4d', '154.117.217.109', 1703504710, '__ci_last_regenerate|i:1703504710;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-25 11:39:18'),
(1631, 'f6cf910fe7ee22c2b9c3a61f2c132798a6134670', '154.117.217.109', 1703505038, '__ci_last_regenerate|i:1703505038;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:5:{s:10:\"cart_total\";d:3;s:11:\"total_items\";d:3;s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";a:16:{s:2:\"id\";s:4:\"px-1\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"3\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:65340;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:5:\"66000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"22000\";s:13:\"SECR_STOCK_ID\";s:1:\"1\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"9f7d54a131c0f6cc1ae7feab543764ee\";s:8:\"subtotal\";d:1;}s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"10\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:12870;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:5:\"13000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:4:\"1300\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}s:32:\"2f01d7de747b10561bca7c10f5b74fd3\";a:16:{s:2:\"id\";s:4:\"px-5\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"6\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:148500;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:6:\"150000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:5:\"25000\";s:13:\"SECR_STOCK_ID\";s:1:\"5\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"2f01d7de747b10561bca7c10f5b74fd3\";s:8:\"subtotal\";d:1;}}', '2023-12-25 11:45:10'),
(1632, '34fc396acfdd8d6d66c6079173246653c1261e0e', '154.117.217.109', 1703507815, '__ci_last_regenerate|i:1703507815;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:44550;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"45000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";a:14:{s:2:\"id\";s:3:\"S-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:99000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:5:\"50000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";s:8:\"subtotal\";d:1;}}', '2023-12-25 11:50:38'),
(1633, 'afe9d5d0eda36f66e48ac478743f697a55bf3cfe', '154.117.217.109', 1703507840, '__ci_last_regenerate|i:1703507815;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"45795ca853ff6a338ccf2622454aa3b1\";a:14:{s:2:\"id\";s:3:\"S-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:2:\"15\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:44550;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"45000\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:4:\"3000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"45795ca853ff6a338ccf2622454aa3b1\";s:8:\"subtotal\";d:1;}s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";a:14:{s:2:\"id\";s:3:\"S-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"1\";s:9:\"netapayer\";i:99000;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:6:\"100000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:5:\"50000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";s:8:\"subtotal\";d:1;}}', '2023-12-25 12:36:56'),
(1634, 'f64b8f2523344702d9d95ed2335deff067972319', '154.117.217.4', 1703566986, '__ci_last_regenerate|i:1703566985;', '2023-12-26 05:03:05'),
(1635, '34d3f0063c91033db528e8bd04ccc947b5796e19', '154.117.216.160', 1703575409, '__ci_last_regenerate|i:1703575409;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 07:14:45'),
(1636, 'ba094ca7ab33c37db8dd6c0ce3b81b8ac2043459', '154.117.216.160', 1703575735, '__ci_last_regenerate|i:1703575735;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 07:23:29'),
(1637, '9e133948f9743d423f2f5863109704b5ae71fa13', '154.117.216.160', 1703576028, '__ci_last_regenerate|i:1703575735;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 07:28:55');
INSERT INTO `session_table` (`id_session`, `id`, `ip_address`, `timestamp`, `data`, `date_action`) VALUES
(1639, '212349a94754df435e8f05a36f8d1f6c17a6e8ae', '154.73.106.236', 1703595580, '__ci_last_regenerate|i:1703595579;EMPLOYE_ID|s:1:\"1\";EMAIL_EMP|s:24:\"advaxe@latechburundi.org\";EMPLOYE|s:17:\"NDAYISENGA Advaxe\";PROFILE_ID|s:1:\"6\";DESC_PROFIL|s:14:\"Administrateur\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"0\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 12:59:40'),
(1640, 'fa09bfdc93f3605e105e3eb097e4e5ce63a73064', '154.117.217.239', 1703596252, '__ci_last_regenerate|i:1703596252;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:02:00'),
(1641, '3434ca84cd8a178d8cc01751c8d0682580772459', '154.73.106.236', 1703596408, '__ci_last_regenerate|i:1703596408;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:03:54'),
(1642, 'b2a216fcfde4cccbc3e0bbc42b3da789cac8fb68', '154.117.217.239', 1703596970, '__ci_last_regenerate|i:1703596970;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:10:52'),
(1643, '2d3e65d1560db7fee6abf59642cc5036d7db7f84', '154.73.106.236', 1703596724, '__ci_last_regenerate|i:1703596724;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:13:28'),
(1644, '7336ae1f4cce66bd994544e921c7d73aff73d664', '154.73.106.236', 1703597064, '__ci_last_regenerate|i:1703597064;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:18:44'),
(1645, 'eaa0ad354e9e7f72567eb5dc8b19118dcee2bfbb', '154.117.217.239', 1703597367, '__ci_last_regenerate|i:1703597367;EMPLOYE_ID|s:1:\"2\";EMAIL_EMP|s:30:\"infosanyaelectronics@gmail.com\";EMPLOYE|s:15:\"BIGIRIMANA Joel\";PROFILE_ID|s:1:\"4\";DESC_PROFIL|s:8:\"Caissier\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:22:50'),
(1646, 'deea79e4c33225f2a477e40d94fe2fdd3835eeee', '154.73.106.236', 1703597367, '__ci_last_regenerate|i:1703597367;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:24:24'),
(1647, '04f6a0e9469d5f8b3fd2b5d5eb527b095c6ffad7', '154.73.106.236', 1703597706, '__ci_last_regenerate|i:1703597706;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:29:27'),
(1649, 'ba791a0937e53dc03038334cbd1c268e72f76f47', '154.117.217.239', 1703598129, '__ci_last_regenerate|i:1703598129;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:33:00'),
(1650, 'e1028dd6895ec9c3e9406cfce4205ab374b26b0b', '154.73.106.236', 1703598023, '__ci_last_regenerate|i:1703598023;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:35:06'),
(1651, 'b0ca9e73e55b788e56d03a80a1604244f2aa674e', '154.73.106.236', 1703598422, '__ci_last_regenerate|i:1703598422;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:40:24'),
(1652, 'd3aa99a6b76f3995b9691ef642ea4613ab81e987', '154.117.217.239', 1703598539, '__ci_last_regenerate|i:1703598539;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:42:09'),
(1653, 'a70927a0bdf18db8f2c96dde0d8d9ea38bea6b8f', '154.73.106.236', 1703598880, '__ci_last_regenerate|i:1703598880;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:47:02'),
(1654, '8843fdaf58dcf138dbe53d4d820a007d38c9e8b0', '154.117.217.239', 1703598872, '__ci_last_regenerate|i:1703598872;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:48:59'),
(1655, '81815487cbe08cf0261061ce9c8bf9e4f8ff5326', '154.117.217.239', 1703599190, '__ci_last_regenerate|i:1703599190;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:54:32'),
(1656, '38cc3f307d06b333b9cd3f8a4421538863bd8435', '154.73.106.236', 1703599186, '__ci_last_regenerate|i:1703599186;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:54:40'),
(1657, '78fe3037d9eb20f084cd3e466f534decf23205ad', '154.73.106.236', 1703599677, '__ci_last_regenerate|i:1703599677;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:59:47'),
(1658, 'dbf4dd17bc8c154ba59a568fe7655ce8001c84bf', '154.117.217.239', 1703599664, '__ci_last_regenerate|i:1703599664;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 13:59:50'),
(1659, '2d071c0595670490a6f79d19ef2cb03d89b53184', '154.117.217.239', 1703599979, '__ci_last_regenerate|i:1703599979;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 14:07:45'),
(1660, '4797ca5c5faefc1318dafc1b1a69f03c60d63a8a', '154.73.106.236', 1703599985, '__ci_last_regenerate|i:1703599985;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 14:07:57'),
(1661, 'ca310728bd6f5cd004bd2e896b5b61ccfe5bcce5', '154.117.217.239', 1703600377, '__ci_last_regenerate|i:1703600377;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 14:12:59'),
(1662, 'a24a4c19a34173bee7b9ec8c4c4e2637081cd61b', '154.73.106.236', 1703600454, '__ci_last_regenerate|i:1703600454;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 14:13:05'),
(1663, '70d9c48c461b227cc5eda85e2153a2b096448288', '154.117.217.239', 1703600697, '__ci_last_regenerate|i:1703600697;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 14:19:37'),
(1664, '289f933c1bfc7cf425cb46ab1709c2464cbc4eff', '154.73.106.236', 1703600759, '__ci_last_regenerate|i:1703600759;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 14:20:54'),
(1665, '13c21b5fa45951fb84a2ca0df6dfbf329c17dd3f', '154.117.217.239', 1703601295, '__ci_last_regenerate|i:1703601295;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 14:24:57'),
(1666, '784e1f6d146fb381468a1fbd8679a15fb821241c', '154.73.106.236', 1703601286, '__ci_last_regenerate|i:1703601286;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 14:25:59'),
(1667, '978075ecd66298a03ed252c620765e37b8bef026', '154.73.106.236', 1703601668, '__ci_last_regenerate|i:1703601668;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 14:34:46'),
(1668, '9badcc259ea863599444d702c3a61ccb8033e96b', '154.117.217.239', 1703601633, '__ci_last_regenerate|i:1703601633;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 14:34:55'),
(1669, '5905151fc66bb7667bbb6c6b22fd37f0f8dfab08', '154.117.217.239', 1703602684, '__ci_last_regenerate|i:1703602684;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 14:40:33'),
(1670, '300214af1a387f69f8c2ec2913dd71a9e88e44b8', '154.73.106.236', 1703602677, '__ci_last_regenerate|i:1703602677;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 14:41:08'),
(1671, '9eff58c47300d4c5d49fa4b6bdcd9c4bd0c9fb0e', '154.73.106.236', 1703603585, '__ci_last_regenerate|i:1703603585;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 14:57:57'),
(1672, 'c5405bbbb2f3649a9784fb5f245196f534cd0190', '154.117.217.239', 1703603481, '__ci_last_regenerate|i:1703603481;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 14:58:04'),
(1673, '2b5b7c535183daf4253b32c0efff5d6586b01908', '154.117.217.239', 1703603954, '__ci_last_regenerate|i:1703603954;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 15:11:21'),
(1674, '532e25e5848f7377770dac804916b47c051c9adf', '154.73.106.236', 1703605067, '__ci_last_regenerate|i:1703605067;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 15:13:05'),
(1675, '7de7f572d3013955d598e8c955dc0b50b2644985', '154.117.217.239', 1703604277, '__ci_last_regenerate|i:1703604277;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"6\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:1200;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:4:\"1200\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:3:\"200\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-26 15:19:14'),
(1676, '4e3dceba90db632c35d25b4cc021ccea5ea42071', '154.117.217.239', 1703604902, '__ci_last_regenerate|i:1703604902;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"6\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:1200;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:4:\"1200\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:3:\"200\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-26 15:24:37'),
(1677, 'd76df13b698b2058bc24519effcfd50c7bd02c85', '154.117.217.239', 1703605460, '__ci_last_regenerate|i:1703605460;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"6\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:1200;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:4:\"1200\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:3:\"200\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-26 15:35:02'),
(1678, 'fe176b479a70a5e219753fe16b7450e89c900d87', '154.73.106.236', 1703605493, '__ci_last_regenerate|i:1703605493;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 15:37:47'),
(1679, '23c62a761870c3299ba1b258885076d933520c19', '154.117.217.239', 1703605802, '__ci_last_regenerate|i:1703605802;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"6\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:1200;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:4:\"1200\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:3:\"200\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-26 15:44:20'),
(1680, '258ed54a747d24957a515f9adf2acc11480d9500', '154.73.106.236', 1703606895, '__ci_last_regenerate|i:1703606895;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 15:44:53'),
(1681, 'f649f02f6e2420e94e22354b87c8a06744d6d87f', '154.117.217.239', 1703606227, '__ci_last_regenerate|i:1703606227;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"6\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:1200;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:4:\"1200\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:3:\"200\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-26 15:50:02'),
(1682, 'daeca4434b81a95041d9857079696eb61922ad23', '154.117.217.239', 1703606907, '__ci_last_regenerate|i:1703606907;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"6\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:1200;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:4:\"1200\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:3:\"200\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}}', '2023-12-26 15:57:07'),
(1683, '82a749653a6a67cf334c0980457bea14570ff6e0', '154.117.219.113', 1703607471, '__ci_last_regenerate|i:1703607471;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 16:08:15'),
(1684, '4948b9441853491b436fc48900299fa7898d690e', '154.117.217.239', 1703607219, '__ci_last_regenerate|i:1703607219;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"4\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:60000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:5:\"60000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-26 16:08:27'),
(1685, 'b916f8308405ca048073b69920a4d4befcebc7c9', '154.117.217.239', 1703607710, '__ci_last_regenerate|i:1703607710;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"4\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:60000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:5:\"60000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-26 16:13:39'),
(1686, '767c30fbfe6d067c68031207d61a64e18a2ef5c2', '154.117.219.113', 1703607895, '__ci_last_regenerate|i:1703607895;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 16:17:51'),
(1687, '8e7e235df7ae4b3f9951674174b2e1771ee38935', '154.117.217.239', 1703608132, '__ci_last_regenerate|i:1703608132;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:30000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:5:\"30000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-26 16:21:50'),
(1688, 'c63d409805658cde8ef3ff74ac6011672aab14a2', '154.117.219.113', 1703608205, '__ci_last_regenerate|i:1703608205;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 16:24:55'),
(1689, 'db4cdc87aea7b334fb556eb7bac443e804975db8', '154.117.217.239', 1703608435, '__ci_last_regenerate|i:1703608435;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:30000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:5:\"30000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-26 16:28:52'),
(1690, 'a03925a44a33a6c7f4591b1416772ce4ebd7fd7b', '154.117.219.113', 1703608525, '__ci_last_regenerate|i:1703608525;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 16:30:05'),
(1691, 'ede788d5285bbbdb8792f0413464b5e2bd38fe38', '154.117.217.239', 1703608745, '__ci_last_regenerate|i:1703608745;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:30000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:5:\"30000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-26 16:33:55'),
(1692, '5cf0f763f850fd1b0b21a7dcfef19bbc7c0b151a', '154.117.219.113', 1703609760, '__ci_last_regenerate|i:1703609760;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 16:35:25'),
(1693, 'd02a9ebdcd916be37d82675818f677c173a2d808', '154.117.217.239', 1703609071, '__ci_last_regenerate|i:1703609071;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:30000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:5:\"30000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-26 16:39:05'),
(1694, 'db7c056651aca5ea5421610af0e14997e6cc6aaa', '154.117.217.239', 1703609520, '__ci_last_regenerate|i:1703609520;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"b78909e838cb064eceaa6a9e609993b5\";a:16:{s:2:\"id\";s:4:\"px-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:30000;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:5:\"30000\";s:11:\"DESIGNATION\";s:1:\"1\";s:13:\"PRIX_UNITAIRE\";s:5:\"15000\";s:13:\"SECR_STOCK_ID\";s:1:\"2\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"b78909e838cb064eceaa6a9e609993b5\";s:8:\"subtotal\";d:1;}}', '2023-12-26 16:44:31'),
(1695, '877ffd3d2aa46c5b5bbb1dd850a36a361d399fa2', '154.117.217.239', 1703609932, '__ci_last_regenerate|i:1703609932;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"36ca3d59b6317c27cb310462dbce0342\";a:16:{s:2:\"id\";s:4:\"px-6\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:2500;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:4:\"2500\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:3:\"500\";s:13:\"SECR_STOCK_ID\";s:1:\"6\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"36ca3d59b6317c27cb310462dbce0342\";s:8:\"subtotal\";d:1;}}', '2023-12-26 16:52:01'),
(1696, '8b49702b75a21efda915b5dd182a329d6f977a96', '154.117.219.113', 1703610156, '__ci_last_regenerate|i:1703610156;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 16:56:00'),
(1697, '7e9906642fa5000cbad60769d30599696109bfce', '154.117.217.239', 1703610338, '__ci_last_regenerate|i:1703610338;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"36ca3d59b6317c27cb310462dbce0342\";a:16:{s:2:\"id\";s:4:\"px-6\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:2500;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:4:\"2500\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:3:\"500\";s:13:\"SECR_STOCK_ID\";s:1:\"6\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"36ca3d59b6317c27cb310462dbce0342\";s:8:\"subtotal\";d:1;}}', '2023-12-26 16:58:52'),
(1698, 'dbea2fe432af6dabb1a44e7fc6a92ab101315370', '154.117.219.113', 1703610635, '__ci_last_regenerate|i:1703610635;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 17:02:36'),
(1699, '75850c96750d8944a65a7328b8d14a324636b28a', '154.117.217.239', 1703610742, '__ci_last_regenerate|i:1703610742;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"36ca3d59b6317c27cb310462dbce0342\";a:16:{s:2:\"id\";s:4:\"px-6\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:2500;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:4:\"2500\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:3:\"500\";s:13:\"SECR_STOCK_ID\";s:1:\"6\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"36ca3d59b6317c27cb310462dbce0342\";s:8:\"subtotal\";d:1;}}', '2023-12-26 17:05:38'),
(1700, '0df5d7db434598a034f1f469dbc9c5ea07b1756d', '154.117.219.113', 1703611098, '__ci_last_regenerate|i:1703611098;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 17:10:35'),
(1701, '50b90f8f76e0e969b8f9fbf0d5787f14f33721a3', '154.117.217.239', 1703611067, '__ci_last_regenerate|i:1703611067;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"36ca3d59b6317c27cb310462dbce0342\";a:16:{s:2:\"id\";s:4:\"px-6\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"5\";s:12:\"type_produit\";s:1:\"2\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:2500;s:12:\"UNITE_MESURE\";s:1:\"2\";s:2:\"pt\";s:4:\"2500\";s:11:\"DESIGNATION\";s:1:\"3\";s:13:\"PRIX_UNITAIRE\";s:3:\"500\";s:13:\"SECR_STOCK_ID\";s:1:\"6\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"36ca3d59b6317c27cb310462dbce0342\";s:8:\"subtotal\";d:1;}}', '2023-12-26 17:12:22'),
(1702, '3fc88c26cd0f652988dad0fac49e84af0be6e963', '154.117.217.239', 1703611665, '__ci_last_regenerate|i:1703611665;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";a:14:{s:2:\"id\";s:3:\"S-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:60000;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"60000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:5:\"60000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";s:8:\"subtotal\";d:1;}}', '2023-12-26 17:17:47'),
(1703, '6e6a09807f6ca49b2031ecc9143034a40598c0f1', '154.117.219.113', 1703611693, '__ci_last_regenerate|i:1703611693;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 17:18:18'),
(1704, '1794404babd379c3b092f83ea8ab64aed177c9f9', '154.117.217.239', 1703611988, '__ci_last_regenerate|i:1703611988;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:3:{s:10:\"cart_total\";d:1;s:11:\"total_items\";d:1;s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";a:14:{s:2:\"id\";s:3:\"S-2\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:60000;s:12:\"UNITE_MESURE\";s:1:\"1\";s:2:\"pt\";s:5:\"60000\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:5:\"60000\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"7ad64bca339e68e1b4a4a3d83cd69bb7\";s:8:\"subtotal\";d:1;}}', '2023-12-26 17:27:45'),
(1705, 'cace9c3edc8587f7719faaff5b173cec5f735571', '154.117.219.113', 1703612215, '__ci_last_regenerate|i:1703612215;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 17:28:14'),
(1706, 'eb158fa735ecdea35453268a875f4f60261ad02f', '154.117.217.239', 1703612599, '__ci_last_regenerate|i:1703612599;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:400;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:3:\"400\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:3:\"200\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}s:32:\"e8d1034c067992128ec99d83e038e719\";a:16:{s:2:\"id\";s:5:\"px-11\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"4\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:80000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:5:\"80000\";s:11:\"DESIGNATION\";s:1:\"6\";s:13:\"PRIX_UNITAIRE\";s:5:\"20000\";s:13:\"SECR_STOCK_ID\";s:2:\"11\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"e8d1034c067992128ec99d83e038e719\";s:8:\"subtotal\";d:1;}}', '2023-12-26 17:33:08'),
(1707, '7ec983c823563e0f1481d46e1d48a84a9e01d97b', '154.117.219.113', 1703612538, '__ci_last_regenerate|i:1703612538;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 17:36:55'),
(1708, '482c14a77ac5cdcc23a2846f7dda51f7b9419410', '154.117.219.113', 1703612867, '__ci_last_regenerate|i:1703612867;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 17:42:19'),
(1709, '057e12e66229ea983ed08865dd64895413541eaf', '154.117.217.239', 1703613964, '__ci_last_regenerate|i:1703613964;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:400;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:3:\"400\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:3:\"200\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}s:32:\"e8d1034c067992128ec99d83e038e719\";a:16:{s:2:\"id\";s:5:\"px-11\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"4\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:80000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:5:\"80000\";s:11:\"DESIGNATION\";s:1:\"6\";s:13:\"PRIX_UNITAIRE\";s:5:\"20000\";s:13:\"SECR_STOCK_ID\";s:2:\"11\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"e8d1034c067992128ec99d83e038e719\";s:8:\"subtotal\";d:1;}}', '2023-12-26 17:43:19'),
(1710, '17b297716db366013a67858348253daf7f5c36fc', '154.117.219.113', 1703613210, '__ci_last_regenerate|i:1703613210;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 17:47:47'),
(1711, '7836dd2da6cf2b76a9e4ba1404c4943451bb1baa', '154.117.219.113', 1703613597, '__ci_last_regenerate|i:1703613597;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 17:53:31'),
(1712, '798d9dd45085c1d8962739a7afec10446ef79554', '154.117.217.239', 1703613274, '__ci_last_regenerate|i:1703613274;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:400;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:3:\"400\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:3:\"200\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}s:32:\"e8d1034c067992128ec99d83e038e719\";a:16:{s:2:\"id\";s:5:\"px-11\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"4\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:80000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:5:\"80000\";s:11:\"DESIGNATION\";s:1:\"6\";s:13:\"PRIX_UNITAIRE\";s:5:\"20000\";s:13:\"SECR_STOCK_ID\";s:2:\"11\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"e8d1034c067992128ec99d83e038e719\";s:8:\"subtotal\";d:1;}}', '2023-12-26 17:54:34'),
(1713, '50694cd1a67fbf0b8a4e9d125704d8babd56ed09', '154.117.219.113', 1703613985, '__ci_last_regenerate|i:1703613985;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 17:59:57'),
(1714, '1385bf5c7fad2a1ff35d4bbe5bf2cb435deb9bbb', '154.117.217.239', 1703613641, '__ci_last_regenerate|i:1703613640;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:400;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:3:\"400\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:3:\"200\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}s:32:\"e8d1034c067992128ec99d83e038e719\";a:16:{s:2:\"id\";s:5:\"px-11\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"4\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:80000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:5:\"80000\";s:11:\"DESIGNATION\";s:1:\"6\";s:13:\"PRIX_UNITAIRE\";s:5:\"20000\";s:13:\"SECR_STOCK_ID\";s:2:\"11\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"e8d1034c067992128ec99d83e038e719\";s:8:\"subtotal\";d:1;}}', '2023-12-26 18:00:41'),
(1715, 'bdec4c7581f0a1852f38f77829950409ab2bd9c2', '154.117.217.239', 1703614515, '__ci_last_regenerate|i:1703614515;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:400;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:3:\"400\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:3:\"200\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}s:32:\"e8d1034c067992128ec99d83e038e719\";a:16:{s:2:\"id\";s:5:\"px-11\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"4\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:80000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:5:\"80000\";s:11:\"DESIGNATION\";s:1:\"6\";s:13:\"PRIX_UNITAIRE\";s:5:\"20000\";s:13:\"SECR_STOCK_ID\";s:2:\"11\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"e8d1034c067992128ec99d83e038e719\";s:8:\"subtotal\";d:1;}}', '2023-12-26 18:06:04'),
(1716, '35dc4ccde93c2ab99f47ed68b4dd038eab8764cd', '154.117.219.113', 1703614439, '__ci_last_regenerate|i:1703614439;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 18:06:25'),
(1717, '43b6e188e9d82b571de9d027087f3fe6dd29967d', '154.117.219.113', 1703614872, '__ci_last_regenerate|i:1703614872;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 18:13:59'),
(1718, '2fb337e2c02b585c51228087557ce659a887e48e', '154.117.217.239', 1703614920, '__ci_last_regenerate|i:1703614920;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:400;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:3:\"400\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:3:\"200\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}s:32:\"e8d1034c067992128ec99d83e038e719\";a:16:{s:2:\"id\";s:5:\"px-11\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"4\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:80000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:5:\"80000\";s:11:\"DESIGNATION\";s:1:\"6\";s:13:\"PRIX_UNITAIRE\";s:5:\"20000\";s:13:\"SECR_STOCK_ID\";s:2:\"11\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"e8d1034c067992128ec99d83e038e719\";s:8:\"subtotal\";d:1;}}', '2023-12-26 18:15:15'),
(1719, '389cb2377780f37b1973a06062b6b77bbba52dc9', '154.117.219.113', 1703615302, '__ci_last_regenerate|i:1703615302;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 18:21:12'),
(1720, 'c0f303c010a6fb8cafc1cab5176c931f1d428ce6', '154.117.217.239', 1703615460, '__ci_last_regenerate|i:1703615460;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:400;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:3:\"400\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:3:\"200\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}s:32:\"e8d1034c067992128ec99d83e038e719\";a:16:{s:2:\"id\";s:5:\"px-11\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"4\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:80000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:5:\"80000\";s:11:\"DESIGNATION\";s:1:\"6\";s:13:\"PRIX_UNITAIRE\";s:5:\"20000\";s:13:\"SECR_STOCK_ID\";s:2:\"11\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"e8d1034c067992128ec99d83e038e719\";s:8:\"subtotal\";d:1;}}', '2023-12-26 18:22:00'),
(1721, 'ddd18fae25b8a6cd786bbb1dc4689e02bf799c4b', '154.117.219.113', 1703615349, '__ci_last_regenerate|i:1703615302;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-26 18:28:22');
INSERT INTO `session_table` (`id_session`, `id`, `ip_address`, `timestamp`, `data`, `date_action`) VALUES
(1722, 'f880ed3baa523a0ac71c0d325f3126ff4fbf91ac', '154.117.217.239', 1703615685, '__ci_last_regenerate|i:1703615460;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:30:\"jeanmarie2019nsavyimana@gmail.\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";cart_contents|a:4:{s:10:\"cart_total\";d:2;s:11:\"total_items\";d:2;s:32:\"d4dec406640606e35b2a6adf061493af\";a:16:{s:2:\"id\";s:4:\"px-3\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"2\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:400;s:12:\"UNITE_MESURE\";s:1:\"3\";s:2:\"pt\";s:3:\"400\";s:11:\"DESIGNATION\";s:1:\"2\";s:13:\"PRIX_UNITAIRE\";s:3:\"200\";s:13:\"SECR_STOCK_ID\";s:1:\"3\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"d4dec406640606e35b2a6adf061493af\";s:8:\"subtotal\";d:1;}s:32:\"e8d1034c067992128ec99d83e038e719\";a:16:{s:2:\"id\";s:5:\"px-11\";s:3:\"qty\";d:1;s:5:\"price\";d:1;s:4:\"name\";s:1:\"T\";s:10:\"QUANTITEUN\";s:1:\"4\";s:12:\"type_produit\";s:1:\"1\";s:9:\"REDUCTION\";s:1:\"0\";s:9:\"netapayer\";i:80000;s:12:\"UNITE_MESURE\";s:1:\"4\";s:2:\"pt\";s:5:\"80000\";s:11:\"DESIGNATION\";s:1:\"6\";s:13:\"PRIX_UNITAIRE\";s:5:\"20000\";s:13:\"SECR_STOCK_ID\";s:2:\"11\";s:12:\"typecartitem\";s:4:\"FILE\";s:5:\"rowid\";s:32:\"e8d1034c067992128ec99d83e038e719\";s:8:\"subtotal\";d:1;}}', '2023-12-26 18:31:00'),
(1723, 'e2d8b7e9e7432b79e379e4359767f646565cbdd3', '51.81.46.212', 1703646891, '__ci_last_regenerate|i:1703646891;', '2023-12-27 03:14:51'),
(1724, '1dcda3d444147228b381c9a792c5ebc1155ef022', '216.194.162.211', 1703657983, '__ci_last_regenerate|i:1703657982;', '2023-12-27 06:19:43'),
(1725, '8722b7b7953ea55e7953368c88a49372e85572b7', '51.81.46.212', 1703659629, '__ci_last_regenerate|i:1703659629;', '2023-12-27 06:47:09'),
(1726, '8c9fb5d38e50e5da3a272a5c5a938dad69620bd4', '154.117.219.113', 1703660436, '__ci_last_regenerate|i:1703660436;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-27 06:55:05'),
(1727, 'fe3993fa5b27fee88d7ad1d041a5889fe3296ab4', '154.117.219.113', 1703660436, '__ci_last_regenerate|i:1703660436;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-27 07:00:36'),
(1728, 'd0fdf99783f0f03db1902f31478789f0b8000862', '154.117.219.113', 1703675026, '__ci_last_regenerate|i:1703674964;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-27 11:02:44'),
(1729, 'ecbf45ef111f79f6573e786b7af13dbf669eba48', '154.117.217.156', 1703752248, '__ci_last_regenerate|i:1703752248;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 08:16:38'),
(1730, 'dd69d74529d2a4161ffba860d8205a4d47eb5cd2', '154.117.217.156', 1703752574, '__ci_last_regenerate|i:1703752574;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 08:29:23'),
(1731, 'fb74a087dbabd99d755b2b0ff19020662e20781b', '154.117.217.156', 1703752631, '__ci_last_regenerate|i:1703752631;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 08:30:48'),
(1732, '02b609fb0f285d832ebd6daad6aa4a095314f775', '154.117.217.156', 1703753100, '__ci_last_regenerate|i:1703753100;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 08:36:14'),
(1733, '127aad6ff64350a0facad5b5976605bffb6370f7', '154.117.217.156', 1703753058, '__ci_last_regenerate|i:1703753058;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 08:37:11'),
(1734, 'bd5c87803a42de4d387d4cbd619c700c82dd4e05', '154.117.217.156', 1703753597, '__ci_last_regenerate|i:1703753597;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 08:44:18'),
(1735, '05f92c4c7a9db7320ce34b64581c682d0a200303', '154.117.217.156', 1703753607, '__ci_last_regenerate|i:1703753607;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 08:45:00'),
(1736, 'ad6140a2e05b0b9abd2a6d3b86970abc40b72d2e', '154.117.217.156', 1703754791, '__ci_last_regenerate|i:1703754791;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 08:53:17'),
(1737, '84444c8be3f6bface7789ef9a2e4168dbf2b4a97', '154.117.217.156', 1703753924, '__ci_last_regenerate|i:1703753924;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 08:53:27'),
(1738, 'd6446cdccd3429e79b5039dd65d0d062bf7eaf88', '154.117.217.156', 1703754235, '__ci_last_regenerate|i:1703754235;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 08:58:44'),
(1739, '51e95bf6a5887808779ce86aae7900bd0d926ec5', '154.117.217.156', 1703754761, '__ci_last_regenerate|i:1703754761;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 09:03:55'),
(1740, '7d6daf1ff7089d2cde28f9d7e226249cdb02a07b', '154.117.217.156', 1703755070, '__ci_last_regenerate|i:1703755070;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 09:12:42'),
(1741, '32377f45e37ea30e484d88664c772d56ca9b290c', '154.117.217.156', 1703755122, '__ci_last_regenerate|i:1703755122;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 09:13:11'),
(1742, '3c828ebb2d73d96bee7d198a63cb2aae0ec5edc4', '154.117.217.156', 1703755371, '__ci_last_regenerate|i:1703755371;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 09:17:50'),
(1743, 'cdcfd645c0a4bbb74defe92d32ae7d637eaf25ec', '154.117.217.156', 1703756088, '__ci_last_regenerate|i:1703756088;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 09:18:42'),
(1745, '67dc072a1488bba845c842891c394c40d7f7e7ca', '154.117.217.156', 1703755710, '__ci_last_regenerate|i:1703755710;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 09:23:20'),
(1746, 'b8bf477a06419430b913fa99b01557a7adbd7530', '154.117.217.156', 1703756031, '__ci_last_regenerate|i:1703756031;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 09:28:30'),
(1747, 'c50d838613c3fa3067eaa866e0218ff5006ec012', '154.117.217.156', 1703756443, '__ci_last_regenerate|i:1703756443;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 09:33:51'),
(1748, 'ef9e9e72a1fd137e7fb5e8b69914e92c0711e4bf', '154.117.217.156', 1703756567, '__ci_last_regenerate|i:1703756567;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 09:34:48'),
(1749, '314de2102d7094f6969624648b35a8fbbc0780ea', '154.117.217.156', 1703756815, '__ci_last_regenerate|i:1703756815;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 09:40:43'),
(1750, '2582ec6726db602b95823592fb6ac0dc92c635ec', '154.117.217.156', 1703756878, '__ci_last_regenerate|i:1703756878;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 09:42:47'),
(1751, '1f1f99b53a39723e76b9b422566fd1595fa431db', '154.117.217.156', 1703757132, '__ci_last_regenerate|i:1703757132;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 09:46:55'),
(1752, '3995f278f455514686a6856af850e7f6eaf0eae7', '154.117.217.156', 1703757248, '__ci_last_regenerate|i:1703757248;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 09:47:58'),
(1753, 'ea9edc270e31c8e93fb6e3e6262cafad7d1aeb12', '154.117.217.156', 1703757639, '__ci_last_regenerate|i:1703757639;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 09:52:12'),
(1754, 'ebad7912f76abf94cfc62576f48f088c5e188ac7', '154.117.217.156', 1703757918, '__ci_last_regenerate|i:1703757918;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 09:54:08'),
(1755, 'ed0b615039b2a5a3be044a62fc108b66fd15f284', '154.117.217.156', 1703758177, '__ci_last_regenerate|i:1703758177;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 10:00:39'),
(1756, 'b35e47ac7c1f1782bf38a7f522882eed31739acc', '154.117.217.156', 1703758253, '__ci_last_regenerate|i:1703758253;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 10:05:18'),
(1757, '453342640ab20df7549b9fed0c69c7e59a541153', '154.117.217.156', 1703758495, '__ci_last_regenerate|i:1703758495;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 10:09:37'),
(1758, '4c167da0be6dfc2960fb4bdab5596b8df8671620', '154.117.217.156', 1703758558, '__ci_last_regenerate|i:1703758558;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 10:10:53'),
(1759, '82e9b43a2d3757f8308023c1b0ccde7e86f6d26e', '154.117.217.156', 1703758886, '__ci_last_regenerate|i:1703758886;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 10:14:55'),
(1760, '3c79f15a4af0c26e0f38f6caa3d2b51d9bf48d35', '154.117.217.156', 1703758885, '__ci_last_regenerate|i:1703758885;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 10:15:58'),
(1761, 'a1ba497625dac77a4c26b2a3df1582640d7155d5', '154.117.217.156', 1703759209, '__ci_last_regenerate|i:1703759209;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 10:21:25'),
(1762, 'cf146995c39984ae9bd6c9dba166c4559da6ff5f', '154.117.217.156', 1703759257, '__ci_last_regenerate|i:1703759257;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 10:21:26'),
(1763, '86afeabd355e6fc1bbfea035bbad94f1fa219a99', '154.117.217.156', 1703759589, '__ci_last_regenerate|i:1703759589;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 10:26:49'),
(1764, '4903b5d54fb70b94950e09ca1cfb9c0a551ec559', '154.117.217.156', 1703759729, '__ci_last_regenerate|i:1703759729;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 10:27:37'),
(1765, '8a3289c0b2023248b352e4e21b188cc4756a2112', '154.117.217.156', 1703759947, '__ci_last_regenerate|i:1703759947;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 10:33:09'),
(1766, '8d4dcea2d88046397c32845336299640e892ef6f', '154.117.217.156', 1703760164, '__ci_last_regenerate|i:1703760164;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 10:35:29'),
(1767, 'bda5e4b27974da98a1aa5cf7f1fcf78c0cf13150', '154.117.217.156', 1703761213, '__ci_last_regenerate|i:1703761213;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 10:39:07'),
(1768, 'e15d631bdb720ac9fd451c25213e10e5999c5ad1', '154.117.217.156', 1703760631, '__ci_last_regenerate|i:1703760631;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 10:42:44'),
(1769, 'b7d9f41baf4ece4d8e86233a6353267e3c82a523', '154.117.217.156', 1703761188, '__ci_last_regenerate|i:1703761188;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 10:50:31'),
(1770, '0ed95343063098ed9410e4a16e1369f9b160049d', '154.117.217.156', 1703761503, '__ci_last_regenerate|i:1703761503;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 10:59:48'),
(1771, 'd22ec3c6115b48afcadeedeab278667ab1758872', '154.117.217.156', 1703761903, '__ci_last_regenerate|i:1703761903;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 11:00:13'),
(1772, 'f660731eb0720ee03e06c3a6abde53583fcf0cd0', '154.117.217.156', 1703762061, '__ci_last_regenerate|i:1703762061;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 11:05:03'),
(1773, 'bb94ca39b48240de35b6d77275a8841f3f0de418', '154.117.217.156', 1703762585, '__ci_last_regenerate|i:1703762585;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 11:11:43'),
(1774, '23469b46a8c4ebd349f930eebd2425ce7db28d21', '154.117.217.156', 1703762597, '__ci_last_regenerate|i:1703762597;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 11:14:21'),
(1775, '72389db71f630a0b7db80a98f59549c6e9f9424d', '154.117.217.156', 1703762901, '__ci_last_regenerate|i:1703762901;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 11:23:05'),
(1776, '4ac67f99effbfc4c92d90e856e415c015f0d39e4', '154.117.217.156', 1703762914, '__ci_last_regenerate|i:1703762914;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 11:23:17'),
(1777, 'f2446e474f0f6b248968df44b673d7954a9b4cb8', '154.117.217.156', 1703763481, '__ci_last_regenerate|i:1703763481;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 11:28:21'),
(1778, '9b5c61c65ba9a8d1e26111978706096d11dc293a', '154.117.217.156', 1703763493, '__ci_last_regenerate|i:1703763493;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 11:28:34'),
(1779, '681ee1105f0eabb3173e84a79d0303c201d218cf', '154.117.217.156', 1703763786, '__ci_last_regenerate|i:1703763786;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 11:38:02'),
(1780, '635569207c61be54fb25a5de5a9bea1c7816b27e', '154.117.217.156', 1703763806, '__ci_last_regenerate|i:1703763806;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 11:38:13'),
(1781, 'af82419cce42a6be165ae95df1d813a7c3519081', '154.117.217.156', 1703764096, '__ci_last_regenerate|i:1703764096;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 11:43:06'),
(1782, '5c6dd9acfc4f3a3602bc8689f3cd3174b01bece5', '154.117.217.156', 1703764131, '__ci_last_regenerate|i:1703764131;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 11:43:26'),
(1783, '211fc87f70dbd6040d77a6d1fd2423100140fb0e', '154.117.217.156', 1703764405, '__ci_last_regenerate|i:1703764405;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 11:48:17'),
(1784, '02c761b3a34afdb7161ad8de6b3208820d266be9', '154.117.217.156', 1703764498, '__ci_last_regenerate|i:1703764498;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 11:48:51'),
(1785, 'ec2734778cbda30bf74d0df5bfbfade91c55185e', '154.117.217.156', 1703764792, '__ci_last_regenerate|i:1703764792;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 11:53:25'),
(1786, 'af9a9c8e014a038753aa177ae9e3605da87e2cba', '154.117.217.156', 1703764836, '__ci_last_regenerate|i:1703764836;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 11:54:58'),
(1787, 'de08078da43a94547142025fe1ea203dac6e474f', '154.117.217.156', 1703765105, '__ci_last_regenerate|i:1703765105;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 11:59:53'),
(1788, '3ed0d719ad7a8e7640570a6d875a6b6da1410254', '154.117.217.156', 1703765198, '__ci_last_regenerate|i:1703765198;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 12:00:36'),
(1789, '17de714d01bfd088fc1565d6ba4b5f4e67b1d006', '154.117.217.156', 1703765466, '__ci_last_regenerate|i:1703765466;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 12:05:05'),
(1790, 'b1aca0020c9adb2a63a7e45a6c355f4ab550f106', '154.117.217.156', 1703765517, '__ci_last_regenerate|i:1703765517;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 12:06:38'),
(1791, '0de410594423d62ad9f9a0a253c33632cd1a58af', '154.117.217.156', 1703765897, '__ci_last_regenerate|i:1703765897;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 12:11:06'),
(1792, '2c0f4fadf6eaf8045d6c6eb5115d3e7d7ddd5d5f', '154.117.217.156', 1703765842, '__ci_last_regenerate|i:1703765842;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 12:11:57'),
(1793, '0a061b53ee10837a9c68bc4e8a027a2175450aa1', '154.117.217.156', 1703766180, '__ci_last_regenerate|i:1703766180;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 12:17:22'),
(1794, '995114f83b1786ee9f5a8bc06e8a68c78a54850a', '154.117.217.156', 1703766266, '__ci_last_regenerate|i:1703766266;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 12:18:17'),
(1795, '3cea2c182953f1a8216dc3aa2e3e86cf2fc1071a', '154.117.217.156', 1703766504, '__ci_last_regenerate|i:1703766504;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 12:23:00'),
(1796, '4769228a31c50a44b9a1ae3cc8627bdc38445288', '154.117.217.156', 1703766395, '__ci_last_regenerate|i:1703766266;EMPLOYE_ID|s:1:\"7\";EMAIL_EMP|s:21:\"web@latechburundi.org\";EMPLOYE|s:17:\"TEST MOT DE PASSE\";PROFILE_ID|s:1:\"5\";DESC_PROFIL|s:11:\"Maintenance\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 12:24:27'),
(1797, '9f3b76ceabc54d7f5443ae353beacd0f80acb640', '154.117.217.156', 1703766506, '__ci_last_regenerate|i:1703766504;EMPLOYE_ID|s:2:\"10\";EMAIL_EMP|s:33:\"jeanmarie2019nsavyimana@gmail.com\";EMPLOYE|s:21:\"NSAVYIMANA Jean Marie\";PROFILE_ID|s:1:\"3\";DESC_PROFIL|s:13:\"Informaticien\";IS_USER_SYSTEM|s:1:\"1\";IS_MUST_CHANGE_PWD|s:1:\"1\";ID_BRANCHE|s:1:\"1\";', '2023-12-28 12:28:24');

-- --------------------------------------------------------

--
-- Table structure for table `sorties`
--

CREATE TABLE `sorties` (
  `ID_SORTIE` int(11) NOT NULL,
  `DESC_SORTIE` varchar(50) NOT NULL,
  `SOMME_SORTIE` varchar(10) NOT NULL,
  `DATE_SORTIE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `RESP_SORTIE` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sous_menu_menu_rel`
--

CREATE TABLE `sous_menu_menu_rel` (
  `SOUS_MENU_ID` int(11) NOT NULL,
  `SOUS_MENU_DESC` varchar(200) NOT NULL,
  `MENU_ID` int(11) NOT NULL,
  `IS_DELETE` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1:Non/0:Oui'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `statut_immo`
--

CREATE TABLE `statut_immo` (
  `STATUT_IMMO_ID` int(11) NOT NULL,
  `STATUT_DESC` varchar(100) NOT NULL,
  `STATUT_IMMO` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `statut_immo`
--

INSERT INTO `statut_immo` (`STATUT_IMMO_ID`, `STATUT_DESC`, `STATUT_IMMO`) VALUES
(1, 'Cassé', 1),
(2, 'Endomage', 1),
(3, 'En bon état', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock_secretariat`
--

CREATE TABLE `stock_secretariat` (
  `SECR_STOCK_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(3) DEFAULT NULL,
  `TYPE_STOCK` tinyint(4) NOT NULL DEFAULT 1,
  `QNTE` varchar(10) DEFAULT '0',
  `PA_U` varchar(10) DEFAULT NULL,
  `PV_U` varchar(10) DEFAULT NULL,
  `PA_T` varchar(10) DEFAULT NULL,
  `STATUT` tinyint(4) DEFAULT 1,
  `DATE_INSERTION` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `stock_secretariat`
--

INSERT INTO `stock_secretariat` (`SECR_STOCK_ID`, `PRODUCT_ID`, `TYPE_STOCK`, `QNTE`, `PA_U`, `PV_U`, `PA_T`, `STATUT`, `DATE_INSERTION`) VALUES
(1, 1, 1, '0', NULL, NULL, NULL, 1, '2023-12-26 14:09:23'),
(2, 1, 2, '6', '10000', '12000', '60000', 1, '2023-12-27 00:34:55'),
(3, 2, 1, '2', '150', '200', '300', 1, '2023-12-27 00:40:33'),
(4, 2, 2, '0', NULL, NULL, NULL, 1, '2023-12-26 14:11:03'),
(5, 3, 1, '0', NULL, NULL, NULL, 1, '2023-12-26 14:11:47'),
(6, 3, 2, '9', '25', '25', '225', 1, '2023-12-27 00:34:46'),
(7, 4, 1, '0', NULL, NULL, NULL, 1, '2023-12-26 14:12:20'),
(8, 4, 2, '0', NULL, NULL, NULL, 1, '2023-12-26 14:12:20'),
(9, 5, 1, '0', NULL, NULL, NULL, 1, '2023-12-26 14:12:59'),
(10, 5, 2, '0', NULL, NULL, NULL, 1, '2023-12-26 14:12:59'),
(11, 6, 1, '6', '15000', '20000', '90000', 1, '2023-12-27 00:42:23'),
(12, 6, 2, '0', NULL, NULL, NULL, 1, '2023-12-26 14:13:46'),
(13, 7, 1, '0', NULL, NULL, NULL, 1, '2023-12-26 16:53:07'),
(14, 7, 2, '0', NULL, NULL, NULL, 1, '2023-12-26 16:53:07'),
(15, 8, 1, '0', NULL, NULL, NULL, 1, '2023-12-26 16:53:45'),
(16, 8, 2, '0', NULL, NULL, NULL, 1, '2023-12-26 16:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `suivi_ebank`
--

CREATE TABLE `suivi_ebank` (
  `ID_SUIVI_EBANK` int(11) NOT NULL,
  `CASH` varchar(20) NOT NULL,
  `ELECTRONIQUE` varchar(20) NOT NULL,
  `RESP_ELECT` tinyint(4) NOT NULL,
  `DATE_INSERTION` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suivi_ebank`
--

INSERT INTO `suivi_ebank` (`ID_SUIVI_EBANK`, `CASH`, `ELECTRONIQUE`, `RESP_ELECT`, `DATE_INSERTION`) VALUES
(1, '300000', '200000', 10, '2023-12-28 11:50:27'),
(2, '320000', '180800', 10, '2023-12-28 11:51:31'),
(3, '270000', '232300', 10, '2023-12-28 11:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `s_bank`
--

CREATE TABLE `s_bank` (
  `ID_E_BANK` int(11) NOT NULL,
  `LIBELLE` varchar(100) NOT NULL,
  `MONTANT` varchar(20) NOT NULL,
  `ELECTRONIQUE` varchar(20) NOT NULL,
  `COMMISSION` varchar(20) NOT NULL,
  `TYPE_AGENT` varchar(20) NOT NULL,
  `TELEPHONE` varchar(13) NOT NULL,
  `DATE_ENTREE` date DEFAULT current_timestamp(),
  `STATUT` tinyint(4) NOT NULL DEFAULT 1,
  `DATE_ACTION` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `RESP_ELECT` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `s_bank`
--

INSERT INTO `s_bank` (`ID_E_BANK`, `LIBELLE`, `MONTANT`, `ELECTRONIQUE`, `COMMISSION`, `TYPE_AGENT`, `TELEPHONE`, `DATE_ENTREE`, `STATUT`, `DATE_ACTION`, `RESP_ELECT`) VALUES
(1, 'RETRAIT', '50000', '50000', '1500', 'Ecocash', '79072913', '2023-12-29', 1, '2023-12-28 11:52:57', 10);

-- --------------------------------------------------------

--
-- Table structure for table `s_electroniques`
--

CREATE TABLE `s_electroniques` (
  `ID_AGENT` int(11) NOT NULL,
  `TYPE_AGENT` varchar(50) NOT NULL,
  `CASH` varchar(20) NOT NULL,
  `ELECTRONIQUE` varchar(20) NOT NULL,
  `DESC_TRANS` text NOT NULL,
  `DATE_INSERTION` timestamp NOT NULL DEFAULT current_timestamp(),
  `RESP_ELECT` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `type_immobiler`
--

CREATE TABLE `type_immobiler` (
  `TYPE_IMMO_ID` int(11) NOT NULL,
  `TYPE_IMMO_DESC` varchar(30) NOT NULL,
  `STATUT_TYPE` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `type_immobiler`
--

INSERT INTO `type_immobiler` (`TYPE_IMMO_ID`, `TYPE_IMMO_DESC`, `STATUT_TYPE`) VALUES
(1, 'Tables', 1),
(2, 'Chaises', 1),
(3, 'Equipements informatiques', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ventes_sanya`
--

CREATE TABLE `ventes_sanya` (
  `ID_VENTE` int(11) NOT NULL,
  `ID_CLIENT` tinyint(4) NOT NULL,
  `DESIGNATION` varchar(100) NOT NULL,
  `QUANTITE` varchar(20) NOT NULL,
  `FACTURE` varchar(100) NOT NULL,
  `PU` varchar(20) NOT NULL,
  `PT` varchar(20) NOT NULL,
  `OBSERVATION` varchar(200) NOT NULL,
  `RESP_VENTE` tinyint(4) NOT NULL,
  `DATE_VENTE` datetime NOT NULL,
  `DATE_CREATION` datetime NOT NULL DEFAULT current_timestamp(),
  `STATUT` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ventes_sanya`
--

INSERT INTO `ventes_sanya` (`ID_VENTE`, `ID_CLIENT`, `DESIGNATION`, `QUANTITE`, `FACTURE`, `PU`, `PT`, `OBSERVATION`, `RESP_VENTE`, `DATE_VENTE`, `DATE_CREATION`, `STATUT`) VALUES
(1, 9, '2', '6', '17', '200', '1200', 'vente a credit des mses', 10, '2023-12-26 17:12:47', '2023-12-26 07:12:47', 1),
(2, 14, '2', '2', '005-23', '200', '400', 'vente au comptant', 10, '2023-12-26 19:41:33', '2023-12-26 09:41:33', 1),
(3, 14, '6', '4', '005-23', '20000', '80000', 'vente au comptant', 10, '2023-12-26 19:42:49', '2023-12-26 09:42:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ventes_stock`
--

CREATE TABLE `ventes_stock` (
  `ID_VENTES` bigint(20) NOT NULL,
  `CLIENT_FACT_ID` bigint(50) NOT NULL,
  `STOCK_ID` int(11) NOT NULL,
  `QTY` int(11) NOT NULL,
  `PRIX_UNITAIRE` int(11) NOT NULL,
  `PRIX_TOTAL` int(11) NOT NULL,
  `P_ACHAT_TOTAL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achats_sanya`
--
ALTER TABLE `achats_sanya`
  ADD PRIMARY KEY (`ID_ACHAT`);

--
-- Indexes for table `cathegories`
--
ALTER TABLE `cathegories`
  ADD PRIMARY KEY (`CATH_ID`);

--
-- Indexes for table `cathegories_services`
--
ALTER TABLE `cathegories_services`
  ADD PRIMARY KEY (`CATH_ID`);

--
-- Indexes for table `clients_sanya`
--
ALTER TABLE `clients_sanya`
  ADD PRIMARY KEY (`ID_CLIENT`);

--
-- Indexes for table `client_facture`
--
ALTER TABLE `client_facture`
  ADD PRIMARY KEY (`CLIENT_FACT_ID`);

--
-- Indexes for table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`ID_COMPTE`);

--
-- Indexes for table `data_electronique`
--
ALTER TABLE `data_electronique`
  ADD PRIMARY KEY (`ID_ELE`);

--
-- Indexes for table `data_livre_approvisionnement`
--
ALTER TABLE `data_livre_approvisionnement`
  ADD PRIMARY KEY (`ID_LIVRE_APPRO`);

--
-- Indexes for table `data_livre_banque`
--
ALTER TABLE `data_livre_banque`
  ADD PRIMARY KEY (`ID_LIVRE_BANQUE`);

--
-- Indexes for table `data_livre_caisse`
--
ALTER TABLE `data_livre_caisse`
  ADD PRIMARY KEY (`ID_LIVRE_CAISSE`);

--
-- Indexes for table `dettes_externes`
--
ALTER TABLE `dettes_externes`
  ADD PRIMARY KEY (`ID_DETTE_EXTERNE`);

--
-- Indexes for table `dettes_internes`
--
ALTER TABLE `dettes_internes`
  ADD PRIMARY KEY (`ID_DETTE_INTERNE`);

--
-- Indexes for table `electroniques`
--
ALTER TABLE `electroniques`
  ADD PRIMARY KEY (`ID_AGENT`);

--
-- Indexes for table `employes`
--
ALTER TABLE `employes`
  ADD PRIMARY KEY (`EMPLOYE_ID`);

--
-- Indexes for table `e_bank`
--
ALTER TABLE `e_bank`
  ADD PRIMARY KEY (`ID_E_BANK`);

--
-- Indexes for table `fournisseurs_sanya`
--
ALTER TABLE `fournisseurs_sanya`
  ADD PRIMARY KEY (`ID_FOURNISSEUR`);

--
-- Indexes for table `gros_client`
--
ALTER TABLE `gros_client`
  ADD PRIMARY KEY (`GROS_CLIENT_ID`);

--
-- Indexes for table `gros_client_facture`
--
ALTER TABLE `gros_client_facture`
  ADD PRIMARY KEY (`GROS_CLIENT_FACT_ID`);

--
-- Indexes for table `gros_entrees_stock`
--
ALTER TABLE `gros_entrees_stock`
  ADD PRIMARY KEY (`ID_ENTREE`);

--
-- Indexes for table `gros_produit`
--
ALTER TABLE `gros_produit`
  ADD PRIMARY KEY (`GROS_PRODUIT_ID`);

--
-- Indexes for table `gros_stock`
--
ALTER TABLE `gros_stock`
  ADD PRIMARY KEY (`GROS_STOCK_ID`);

--
-- Indexes for table `gros_unite`
--
ALTER TABLE `gros_unite`
  ADD PRIMARY KEY (`GROS_UNIT_ID`);

--
-- Indexes for table `gros_ventes_produits`
--
ALTER TABLE `gros_ventes_produits`
  ADD PRIMARY KEY (`ID_VENTES`);

--
-- Indexes for table `immo_immobilier`
--
ALTER TABLE `immo_immobilier`
  ADD PRIMARY KEY (`ID_IMMOBILIER`);

--
-- Indexes for table `imputations`
--
ALTER TABLE `imputations`
  ADD PRIMARY KEY (`ID_IMPUTATION`);

--
-- Indexes for table `inventaire_immobilier`
--
ALTER TABLE `inventaire_immobilier`
  ADD PRIMARY KEY (`INVENTAIRE_IMMO_ID`);

--
-- Indexes for table `lumicash`
--
ALTER TABLE `lumicash`
  ADD PRIMARY KEY (`ID_LUMICASH`);

--
-- Indexes for table `mag_client_factur`
--
ALTER TABLE `mag_client_factur`
  ADD PRIMARY KEY (`GROS_CLIENT_FACT_ID`);

--
-- Indexes for table `mag_client_facture`
--
ALTER TABLE `mag_client_facture`
  ADD PRIMARY KEY (`GROS_CLIENT_FACT_ID`);

--
-- Indexes for table `mag_ventes_produits`
--
ALTER TABLE `mag_ventes_produits`
  ADD PRIMARY KEY (`ID_VENTES`);

--
-- Indexes for table `mag_ventes_services`
--
ALTER TABLE `mag_ventes_services`
  ADD PRIMARY KEY (`ID_VENTES`);

--
-- Indexes for table `marque_immo`
--
ALTER TABLE `marque_immo`
  ADD PRIMARY KEY (`MARQUE_ID`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`MENU_ID`);

--
-- Indexes for table `menu_users`
--
ALTER TABLE `menu_users`
  ADD PRIMARY KEY (`MENU_USER_ID`);

--
-- Indexes for table `niveaux`
--
ALTER TABLE `niveaux`
  ADD PRIMARY KEY (`ID_NIVEAU`);

--
-- Indexes for table `occupations`
--
ALTER TABLE `occupations`
  ADD PRIMARY KEY (`OCCUPATION_ID`);

--
-- Indexes for table `ou`
--
ALTER TABLE `ou`
  ADD PRIMARY KEY (`ID_OU`);

--
-- Indexes for table `ou_departement`
--
ALTER TABLE `ou_departement`
  ADD PRIMARY KEY (`OU_DEP_ID`);

--
-- Indexes for table `ou_emplacement`
--
ALTER TABLE `ou_emplacement`
  ADD PRIMARY KEY (`OU_EMPLACEMENT_ID`);

--
-- Indexes for table `ou_ministere`
--
ALTER TABLE `ou_ministere`
  ADD PRIMARY KEY (`MINISTERE_ID`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PRODUCT_ID`);

--
-- Indexes for table `profil`
--
ALTER TABLE `profil`
  ADD PRIMARY KEY (`PROFILE_ID`);

--
-- Indexes for table `sanya_branches`
--
ALTER TABLE `sanya_branches`
  ADD PRIMARY KEY (`ID_BRANCHE`);

--
-- Indexes for table `sanya_services`
--
ALTER TABLE `sanya_services`
  ADD PRIMARY KEY (`PRODUCT_ID`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`ID_SERVICE`);

--
-- Indexes for table `session_table`
--
ALTER TABLE `session_table`
  ADD PRIMARY KEY (`id_session`);

--
-- Indexes for table `sorties`
--
ALTER TABLE `sorties`
  ADD PRIMARY KEY (`ID_SORTIE`);

--
-- Indexes for table `sous_menu_menu_rel`
--
ALTER TABLE `sous_menu_menu_rel`
  ADD PRIMARY KEY (`SOUS_MENU_ID`);

--
-- Indexes for table `statut_immo`
--
ALTER TABLE `statut_immo`
  ADD PRIMARY KEY (`STATUT_IMMO_ID`);

--
-- Indexes for table `stock_secretariat`
--
ALTER TABLE `stock_secretariat`
  ADD PRIMARY KEY (`SECR_STOCK_ID`);

--
-- Indexes for table `suivi_ebank`
--
ALTER TABLE `suivi_ebank`
  ADD PRIMARY KEY (`ID_SUIVI_EBANK`);

--
-- Indexes for table `s_bank`
--
ALTER TABLE `s_bank`
  ADD PRIMARY KEY (`ID_E_BANK`);

--
-- Indexes for table `s_electroniques`
--
ALTER TABLE `s_electroniques`
  ADD PRIMARY KEY (`ID_AGENT`);

--
-- Indexes for table `type_immobiler`
--
ALTER TABLE `type_immobiler`
  ADD PRIMARY KEY (`TYPE_IMMO_ID`);

--
-- Indexes for table `ventes_sanya`
--
ALTER TABLE `ventes_sanya`
  ADD PRIMARY KEY (`ID_VENTE`);

--
-- Indexes for table `ventes_stock`
--
ALTER TABLE `ventes_stock`
  ADD PRIMARY KEY (`ID_VENTES`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achats_sanya`
--
ALTER TABLE `achats_sanya`
  MODIFY `ID_ACHAT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cathegories`
--
ALTER TABLE `cathegories`
  MODIFY `CATH_ID` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cathegories_services`
--
ALTER TABLE `cathegories_services`
  MODIFY `CATH_ID` smallint(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `clients_sanya`
--
ALTER TABLE `clients_sanya`
  MODIFY `ID_CLIENT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `client_facture`
--
ALTER TABLE `client_facture`
  MODIFY `CLIENT_FACT_ID` bigint(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `ID_COMPTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_electronique`
--
ALTER TABLE `data_electronique`
  MODIFY `ID_ELE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_livre_approvisionnement`
--
ALTER TABLE `data_livre_approvisionnement`
  MODIFY `ID_LIVRE_APPRO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_livre_banque`
--
ALTER TABLE `data_livre_banque`
  MODIFY `ID_LIVRE_BANQUE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_livre_caisse`
--
ALTER TABLE `data_livre_caisse`
  MODIFY `ID_LIVRE_CAISSE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dettes_externes`
--
ALTER TABLE `dettes_externes`
  MODIFY `ID_DETTE_EXTERNE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dettes_internes`
--
ALTER TABLE `dettes_internes`
  MODIFY `ID_DETTE_INTERNE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `electroniques`
--
ALTER TABLE `electroniques`
  MODIFY `ID_AGENT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employes`
--
ALTER TABLE `employes`
  MODIFY `EMPLOYE_ID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `e_bank`
--
ALTER TABLE `e_bank`
  MODIFY `ID_E_BANK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fournisseurs_sanya`
--
ALTER TABLE `fournisseurs_sanya`
  MODIFY `ID_FOURNISSEUR` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `gros_client`
--
ALTER TABLE `gros_client`
  MODIFY `GROS_CLIENT_ID` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `gros_client_facture`
--
ALTER TABLE `gros_client_facture`
  MODIFY `GROS_CLIENT_FACT_ID` bigint(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gros_entrees_stock`
--
ALTER TABLE `gros_entrees_stock`
  MODIFY `ID_ENTREE` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `gros_produit`
--
ALTER TABLE `gros_produit`
  MODIFY `GROS_PRODUIT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gros_stock`
--
ALTER TABLE `gros_stock`
  MODIFY `GROS_STOCK_ID` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gros_unite`
--
ALTER TABLE `gros_unite`
  MODIFY `GROS_UNIT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `gros_ventes_produits`
--
ALTER TABLE `gros_ventes_produits`
  MODIFY `ID_VENTES` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `imputations`
--
ALTER TABLE `imputations`
  MODIFY `ID_IMPUTATION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `lumicash`
--
ALTER TABLE `lumicash`
  MODIFY `ID_LUMICASH` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mag_client_factur`
--
ALTER TABLE `mag_client_factur`
  MODIFY `GROS_CLIENT_FACT_ID` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `mag_client_facture`
--
ALTER TABLE `mag_client_facture`
  MODIFY `GROS_CLIENT_FACT_ID` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `mag_ventes_produits`
--
ALTER TABLE `mag_ventes_produits`
  MODIFY `ID_VENTES` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mag_ventes_services`
--
ALTER TABLE `mag_ventes_services`
  MODIFY `ID_VENTES` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `niveaux`
--
ALTER TABLE `niveaux`
  MODIFY `ID_NIVEAU` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `occupations`
--
ALTER TABLE `occupations`
  MODIFY `OCCUPATION_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `PRODUCT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `profil`
--
ALTER TABLE `profil`
  MODIFY `PROFILE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sanya_branches`
--
ALTER TABLE `sanya_branches`
  MODIFY `ID_BRANCHE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sanya_services`
--
ALTER TABLE `sanya_services`
  MODIFY `PRODUCT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `ID_SERVICE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `session_table`
--
ALTER TABLE `session_table`
  MODIFY `id_session` bigint(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1798;

--
-- AUTO_INCREMENT for table `sorties`
--
ALTER TABLE `sorties`
  MODIFY `ID_SORTIE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stock_secretariat`
--
ALTER TABLE `stock_secretariat`
  MODIFY `SECR_STOCK_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `suivi_ebank`
--
ALTER TABLE `suivi_ebank`
  MODIFY `ID_SUIVI_EBANK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `s_bank`
--
ALTER TABLE `s_bank`
  MODIFY `ID_E_BANK` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `s_electroniques`
--
ALTER TABLE `s_electroniques`
  MODIFY `ID_AGENT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ventes_sanya`
--
ALTER TABLE `ventes_sanya`
  MODIFY `ID_VENTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ventes_stock`
--
ALTER TABLE `ventes_stock`
  MODIFY `ID_VENTES` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
