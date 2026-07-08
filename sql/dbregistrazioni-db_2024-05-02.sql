-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Mag 02, 2024 alle 08:04
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
  `orarioricevuto` time DEFAULT NULL,
  `orariovisualizzato` time DEFAULT NULL,
  `testo` text NOT NULL,
  `idutenteinviato` int(11) NOT NULL,
  `idutentericevuto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `messaggi`
--

INSERT INTO `messaggi` (`id`, `datainvio`, `orarioinvio`, `orarioricevuto`, `orariovisualizzato`, `testo`, `idutenteinviato`, `idutentericevuto`) VALUES
(3, '2024-02-02', '11:55:26', '25:55:26', '31:55:26', 'CIAO REGA BONASERA', 17, 25),
(14, '2024-03-12', '08:56:32', '13:56:32', '18:56:32', 'yhtytytytytyty', 25, 17),
(15, '2024-03-16', '10:13:30', NULL, NULL, 'ciao', 17, 25),
(16, '2024-03-16', '10:14:06', NULL, NULL, 'ou', 17, 25),
(17, '2024-03-16', '10:15:36', NULL, NULL, 'CIAO', 25, 17),
(18, '2024-03-16', '10:16:21', NULL, NULL, 'AAAAAAAAAAAAA', 17, 25),
(19, '2024-03-16', '10:17:05', NULL, NULL, 'ciao come stai?', 25, 17),
(20, '2024-03-16', '10:17:07', NULL, NULL, 'ciao come stai?', 25, 17),
(21, '2024-03-16', '10:17:48', NULL, NULL, 'ciao bene te?', 17, 25),
(22, '2024-03-16', '10:18:59', NULL, NULL, 'bene bene grazie', 25, 17),
(23, '2024-03-16', '10:24:43', NULL, NULL, 'ti voglio bene', 17, 25),
(24, '2024-03-16', '10:26:04', NULL, NULL, 'anche io', 25, 17),
(25, '2024-03-19', '08:18:42', NULL, NULL, 'ccccc', 17, 25),
(26, '2024-04-06', '09:44:19', NULL, NULL, 'eccomi caro', 17, 25),
(27, '2024-04-06', '09:44:44', NULL, NULL, 'ciaoooo', 17, 25),
(28, '2024-04-06', '09:45:14', NULL, NULL, 'ciao', 25, 17),
(29, '2024-04-23', '08:16:13', NULL, NULL, 'ciao', 17, 25),
(30, '2024-04-30', '07:14:49', NULL, NULL, 'sono tornato', 17, 25),
(31, '2024-04-30', '07:25:01', NULL, NULL, 'ciao', 17, 25),
(58, '2024-05-02', '07:31:33', NULL, NULL, 'come stai', 17, 25);

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
('Piebbe', 'Pietro', 'Brutti', 'pietrobrutti05@gmail.com', 'pietro2005', 27),
('LuigiVerdi', 'Luigi', 'Verdi', 'luigiverdi@gmail.com', 'luigi2005', 28),
('BianchPaolo', 'Paolo', 'Bianchi', 'bianchipaolo@gmail.com', '222222222222222', 31);

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
-- AUTO_INCREMENT per la tabella `messaggi`
--
ALTER TABLE `messaggi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

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
