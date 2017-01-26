-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 26, 2017 at 11:08 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baza`
--
CREATE DATABASE IF NOT EXISTS `baza` DEFAULT CHARACTER SET utf8 COLLATE utf8_slovenian_ci;
USE `baza`;

-- --------------------------------------------------------

--
-- Table structure for table `kontakt`
--

CREATE TABLE `kontakt` (
  `id` int(11) NOT NULL,
  `id_korisnika` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `komentar` text COLLATE utf8_slovenian_ci NOT NULL,
  `pomoc_u_radu` int(1) NOT NULL,
  `donacija` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `kontakt`
--

INSERT INTO `kontakt` (`id`, `id_korisnika`, `email`, `komentar`, `pomoc_u_radu`, `donacija`) VALUES
(1, 1, 'admin@gmail.com', 'Sve pet', 1, 1),
(2, 2, 'emir@gmail.com', 'Nista ne valja', 0, 0),
(3, 2, 'emir@gmail.com', 'Ma nije lose tolko', 1, 0),
(4, 1, 'abc@gmail.com', 'aaaa', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id` int(11) NOT NULL,
  `username` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `ime` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `ocjena_stranice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id`, `username`, `password`, `ime`, `ocjena_stranice`) VALUES
(1, 'admin', '1a1dc91c907325c69271ddf0c944bc72', 'Admin Adminovic', 3),
(2, 'emiremir', 'c4ca4238a0b923820dcc509a6f75849b', 'Emir Barucija', 0),
(4, 'probni', 'c4ca4238a0b923820dcc509a6f75849b', 'Probni Probnic', 5);

-- --------------------------------------------------------

--
-- Table structure for table `novost`
--

CREATE TABLE `novost` (
  `id` int(11) NOT NULL,
  `naslov` varchar(100) COLLATE utf8_slovenian_ci NOT NULL,
  `tekst` text COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `novost`
--

INSERT INTO `novost` (`id`, `naslov`, `tekst`) VALUES
(1, 'Poziv za Skupštinu Društva fizičara u BiH', 'Poštovane kolege i kolegice,\n\nNa osnovu odluke Upravnog odbora sa sjednice održane 03. 12. 2016. godine, obavještavamo Vas da će se Skupština Društva fizičara u BiH održati u subotu, 14. 01. 2017. godine na Prirodno-matematičkom fakultetu u Sarajevu s početkom u 11:00 h u amfiteatru Branko Galeb.\n\nPrijedlog Dnevnog reda.\n\nOvim putem Vas pozivamo da postanete član Društva fizičara u BiH i da svojim idejama, savjetima, projektima, članstvom i znanjem pomognete radu i unapređenju Društva fizičara u Bosni i Hercegovini. Ukoliko postanete član Društva fizičara, imat ćete pristup informacijama o svim aktivnostima ovog društva, kao što su organizacija škola fizike, kampova fizike, seminara za nastavnike i profesore, zatim pristup kalendaru raznih nivoa takmičenja, listi literature preporučene za pripreme učenika za takmičenja iz fizike, kao i sve ostale privilegije koje članstvo uključuje. S obzirom da u Bosni i Hercegovini trenutno radi 500 fizičara, ali je tek mali broj njih uključen u  aktivnosti koje sprovodi Društvo, smatrali smo da je neophodno da svim nastavnicima / profesorima fizike uputimo ovaj poziv. Želja nam je da što veći broj fizičara bude uključen u rad Društva, kako bi povećanjem  ljudskih i materijalnih resursa  proširivali i poboljšavali  aktivnosti Društva.  \n\nDa biste postali član našeg Društva potrebno je da na email adresu dfubih@gmail.com pošaljete ispunjen registracioni obrazac. Više detalja o Društvu (dosadašnjim aktivnostima i uspjesima, budućim ciljevi i planovima) možete naći  na našoj web stranici i FB stranici https://www.facebook.com/dfubih/?fref=ts.\n\nPozivamo Vas da prisustvujete Skupštini Društva i svojim glasom i članstvom doprinesete boljem položaju fizičara i fizike u BiH.\n\nZa sve dodatne informacije  možete nam se obratiti na mail dfubih@gmail.com\nSrdačan pozdrav\n\nUpravni odbor\n\nPredsjednik Skupštine Benjamin Fetić'),
(2, 'Ipho 2016 Lihtenstajn', 'Predstavnici Bosne i Hercegovine na 47. Međunarodnoj olimpijadi iz fizike koja se ove godine održava u Švicarskoj osvojili su dvije srebrene medalje i jednu pohvalu. Učenici Bahrudin Trbalić i Nermedin Džeković osvojili su srebrenu medalju dok je Dženan Devedžić osvojio pohvalu. Nakon prošlogodišnjeg uspjeha u Indiji (srebrena i bronzana medalja, te dvije pohvale), ovo je najbolji uspjeh mladih fizičara iz BiH na Međunarodnoj olimpijadi iz fizike od 1997. godine.\n\nNa Olimpijadi je učestvovalo 450 učenika iz 90 država svijeta. Voditelji bh. tima bili su prof.dr. Rajfa Musemić, te studenti Odsjeka za fiziku PMF-a u Sarajevu, Selver Pepić i Nudžeim Selimović.\n\nOdlazak bh. mladih fizičara na IPho 2016 finansijski su podržali Ured premijera Tuzlanskog kantona, Ministarstvo za obrazovanje, nauku i mlade Kantona Sarajevo, i Rektorat Univerziteta u Sarajevu preko studentskog projekta finansiranog iz fonda "Akademik Edhem Čamo".');

-- --------------------------------------------------------

--
-- Table structure for table `takmicar`
--

CREATE TABLE `takmicar` (
  `id` int(11) NOT NULL,
  `id_takmicenja` int(11) NOT NULL,
  `ime` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `plasman` varchar(50) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `takmicar`
--

INSERT INTO `takmicar` (`id`, `id_takmicenja`, `ime`, `plasman`) VALUES
(1, 1, 'Bahrudin Trbalic', 'bronzana medalja'),
(2, 2, 'Bahrudin Trbalic', 'bronzana medalja'),
(3, 1, 'Nermedin Dzekovic', 'srebrena medalja'),
(4, 2, 'Nermedin Dzekovic', 'bronzana medalja'),
(5, 1, 'Dzenan Devedzic', 'pocasna pohvala');

-- --------------------------------------------------------

--
-- Table structure for table `takmicenje`
--

CREATE TABLE `takmicenje` (
  `id` int(11) NOT NULL,
  `naziv` varchar(50) COLLATE utf8_slovenian_ci NOT NULL,
  `lokacija` varchar(50) COLLATE utf8_slovenian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;

--
-- Dumping data for table `takmicenje`
--

INSERT INTO `takmicenje` (`id`, `naziv`, `lokacija`) VALUES
(1, 'IPHO 2016', 'Svicarska i Lihtenstajn, Zeneva'),
(2, 'IPHO 2015', 'Indija, Mumbai'),
(3, 'IPHO 2014', 'Kazahstan, Astana'),
(4, 'RMPh 2015', 'Rumunija, Bukurešt');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kontakt`
--
ALTER TABLE `kontakt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_korisnika` (`id_korisnika`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `novost`
--
ALTER TABLE `novost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `takmicar`
--
ALTER TABLE `takmicar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_takmicenja` (`id_takmicenja`);

--
-- Indexes for table `takmicenje`
--
ALTER TABLE `takmicenje`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kontakt`
--
ALTER TABLE `kontakt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `novost`
--
ALTER TABLE `novost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `takmicar`
--
ALTER TABLE `takmicar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `takmicenje`
--
ALTER TABLE `takmicenje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `kontakt`
--
ALTER TABLE `kontakt`
  ADD CONSTRAINT `kontakt_ibfk_1` FOREIGN KEY (`id_korisnika`) REFERENCES `korisnik` (`id`);

--
-- Constraints for table `takmicar`
--
ALTER TABLE `takmicar`
  ADD CONSTRAINT `takmicar_ibfk_1` FOREIGN KEY (`id_takmicenja`) REFERENCES `takmicenje` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
