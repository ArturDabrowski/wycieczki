-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Kwi 2017, 13:49
-- Wersja serwera: 10.1.21-MariaDB
-- Wersja PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `wycieczki`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `login` varchar(10) COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL,
  `mail` varchar(30) COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `admin`
--

INSERT INTO `admin` (`id_admin`, `login`, `password`, `mail`) VALUES
(1, 'dabek', 'dabek', 'dabczasty89@gmail.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `exc`
--

CREATE TABLE `exc` (
  `id_exc` int(11) NOT NULL,
  `urlZdjecie` varchar(50) COLLATE utf8_polish_ci NOT NULL,
  `nazwa` varchar(80) COLLATE utf8_polish_ci NOT NULL,
  `opis` text COLLATE utf8_polish_ci NOT NULL,
  `cena` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `exc`
--

INSERT INTO `exc` (`id_exc`, `urlZdjecie`, `nazwa`, `opis`, `cena`) VALUES
(1, 'dokumenty/pexels3.jpg', 'Idziemy na kebsa', 'Po wysÅ‚aniu formularza rejestracyjnego aplikacja wysyÅ‚a na podanÄ… datÄ™ poczty elektronicznej, ktÃ³ra wypeÅ‚nia uÅ¼ytkownika i poprawnÄ… odpowiedÅº na pytanie.  Specification:  - text e-mail format  - e-mail data: Title: Thank You for registration in contest About Warsaw! Text: Name, Surname, Birth date, Sex, Phone, Address, Question 1, User Answer 1, Correct Answer 1, Question 2, User Answer 2, Correct Answer 2, Agreement tick, e-mail generation date', 'DoroÅ›li 55zÅ‚, dzieci 35zÅ‚'),
(4, 'dokumenty/tlo.jpeg', 'Jakas wycieczka22222', 'Po wysÅ‚aniu formularza rejestracyjnego aplikacja wysyÅ‚a na podanÄ… datÄ™ poczty elektronicznej, ktÃ³ra wypeÅ‚nia uÅ¼ytkownika i poprawnÄ… odpowiedÅº na pytanie.  Specification:  - text e-mail format  - e-mail data: Title: Thank You for registration in contest About Warsaw! Text: Name, Surname, Birth date, Sex, Phone, Address, Question 1, User Answer 1, Correct Answer 1, Question 2, User Answer 2, Correct Answer 2, Agreement tick, e-mail generation date', 'Malo i przejemnie'),
(6, 'dokumenty/syrenka.jpg', 'Jestesmy z programu AjmSorry', 'Czy pani wie od kogo sa te kwiaty ? A jak sie nie zejda ? Ona ma siostre', '500zÅ‚ 100 za malo piekny kawalerze');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klient`
--

CREATE TABLE `klient` (
  `id_klient` int(11) NOT NULL,
  `id_exc` int(11) NOT NULL,
  `nazwisko` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `imie` varchar(60) COLLATE utf8_polish_ci NOT NULL,
  `miejscowosc` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `ulica` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `nr_domu` varchar(6) COLLATE utf8_polish_ci NOT NULL,
  `nr_mieszkania` varchar(6) COLLATE utf8_polish_ci NOT NULL,
  `kod_pocztowy` varchar(6) COLLATE utf8_polish_ci DEFAULT NULL,
  `telefon` varchar(30) COLLATE utf8_polish_ci DEFAULT NULL,
  `mail` varchar(30) COLLATE utf8_polish_ci NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci ROW_FORMAT=COMPACT;

--
-- Zrzut danych tabeli `klient`
--

INSERT INTO `klient` (`id_klient`, `id_exc`, `nazwisko`, `imie`, `miejscowosc`, `ulica`, `nr_domu`, `nr_mieszkania`, `kod_pocztowy`, `telefon`, `mail`, `data`) VALUES
(20, 1, 'Chmiel', 'Karo', 'Wawka', 'Soko', '26', '6', '33-333', 'Waw', 'karo@karo.karo', '2017-04-10'),
(21, 5, 'Marceli', 'Marcelinski', 'Marcelowo', 'Marcelowa', 'M', 'm', 'mm-mmm', 'Marelowo', 'Marcel@marecel.marcel', '2017-04-11'),
(23, 1, 'Czencze', 'Kornel', 'jkada', 'jhfjhv', 'jhv', 'jhv', '44-444', 'vhj', 'dab@dab.plwes', '2017-04-15');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `exc`
--
ALTER TABLE `exc`
  ADD PRIMARY KEY (`id_exc`);

--
-- Indexes for table `klient`
--
ALTER TABLE `klient`
  ADD PRIMARY KEY (`id_klient`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `exc`
--
ALTER TABLE `exc`
  MODIFY `id_exc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT dla tabeli `klient`
--
ALTER TABLE `klient`
  MODIFY `id_klient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
