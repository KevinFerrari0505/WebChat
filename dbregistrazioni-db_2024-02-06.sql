-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Feb 06, 2024 alle 09:00
-- Versione del server: 8.0.18
-- Versione PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbregistrazioni`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `file`
--

CREATE TABLE `file` (
  `id` int(11) NOT NULL,
  `contenuto` varchar(100) NOT NULL,
  `tipo` char(1) NOT NULL,
  `idmessaggio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `messaggi`
--

CREATE TABLE `messaggi` (
  `id` int(11) NOT NULL,
  `datainvio` date NOT NULL,
  `orarioinvio` time NOT NULL,
  `orarioricevuto` time NOT NULL,
  `orariovisualizzato` time NOT NULL,
  `testo` text NOT NULL,
  `idutenteinviato` int(11) NOT NULL,
  `idutentericevuto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Nome` varchar(60) NOT NULL,
  `Cognome` varchar(60) NOT NULL,
  `email` varchar(200) NOT NULL,
  `pwd` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`username`, `Nome`, `Cognome`, `email`, `pwd`, `id`) VALUES
('Ferrari06', 'Kevin', 'Ferrari', 'ferrarikevin2005@gmail.com', '12345678', 17),
('Santi05', 'Mattia', 'Santinelli', 'SantinelliEmail@gmail.com', '1234567890', 25),
('Piebbe', 'Pietro', 'Brutti', 'pietrobrutti05@gmail.com', 'pietro2005', 27);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idmessagge` (`idmessaggio`);

--
-- Indici per le tabelle `messaggi`
--
ALTER TABLE `messaggi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idutentemittente` (`idutenteinviato`),
  ADD KEY `idutentedestinatario` (`idutentericevuto`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `idmessagge` FOREIGN KEY (`idmessaggio`) REFERENCES `file` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `messaggi`
--
ALTER TABLE `messaggi`
  ADD CONSTRAINT `idutentedestinatario` FOREIGN KEY (`idutentericevuto`) REFERENCES `utenti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idutentemittente` FOREIGN KEY (`idutenteinviato`) REFERENCES `utenti` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
