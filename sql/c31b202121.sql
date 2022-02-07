-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Gép: localhost
-- Létrehozás ideje: 2022. Feb 03. 08:11
-- Kiszolgáló verziója: 10.3.29-MariaDB-0+deb10u1
-- PHP verzió: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `c31b202121`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `adminok`
--

CREATE TABLE `adminok` (
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalok`
--

CREATE TABLE `felhasznalok` (
  `id` int(11) NOT NULL,
  `felhasznalonev` varchar(50) NOT NULL,
  `jelszo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `filmbenJatszottak`
--

CREATE TABLE `filmbenJatszottak` (
  `film_id` int(11) NOT NULL,
  `szinesz_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `filmek`
--

CREATE TABLE `filmek` (
  `id` int(11) NOT NULL,
  `nev` varchar(50) NOT NULL,
  `mufaj` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `filmekErtekelese`
--

CREATE TABLE `filmekErtekelese` (
  `felhasznalo2_Id` int(11) NOT NULL,
  `film_id` int(11) NOT NULL,
  `ertek1` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sorozatbanJatszottak`
--

CREATE TABLE `sorozatbanJatszottak` (
  `sorozat_id` int(11) NOT NULL,
  `szinesz_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sorozatok`
--

CREATE TABLE `sorozatok` (
  `id` int(11) NOT NULL,
  `nev` varchar(50) NOT NULL,
  `mufaj` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sorozatokErtekelese`
--

CREATE TABLE `sorozatokErtekelese` (
  `felhasznalo1_Id` int(11) NOT NULL,
  `sorozat_Id` int(11) NOT NULL,
  `ertek2` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szineszek`
--

CREATE TABLE `szineszek` (
  `id` int(11) NOT NULL,
  `nev` varchar(50) NOT NULL,
  `nem` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szineszekErtekelese`
--

CREATE TABLE `szineszekErtekelese` (
  `felhasznalo_Id` int(11) NOT NULL,
  `szinesz_Id` int(11) NOT NULL,
  `ertek3` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `adminok`
--
ALTER TABLE `adminok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `felhasznalok`
--
ALTER TABLE `felhasznalok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `filmbenJatszottak`
--
ALTER TABLE `filmbenJatszottak`
  ADD PRIMARY KEY (`film_id`,`szinesz_id`),
  ADD KEY `film_id` (`film_id`),
  ADD KEY `szinesz_id` (`szinesz_id`);

--
-- A tábla indexei `filmek`
--
ALTER TABLE `filmek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `filmekErtekelese`
--
ALTER TABLE `filmekErtekelese`
  ADD KEY `felhasznalo2Ertekelese` (`felhasznalo2_Id`),
  ADD KEY `filmekErtekelese` (`film_id`);

--
-- A tábla indexei `sorozatbanJatszottak`
--
ALTER TABLE `sorozatbanJatszottak`
  ADD KEY `jatszottSorozat` (`sorozat_id`),
  ADD KEY `jatszottSzinesz` (`szinesz_id`);

--
-- A tábla indexei `sorozatok`
--
ALTER TABLE `sorozatok`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `sorozatokErtekelese`
--
ALTER TABLE `sorozatokErtekelese`
  ADD KEY `felhasznalo1Ertekelese` (`felhasznalo1_Id`),
  ADD KEY `sorozatokErtekelese` (`sorozat_Id`);

--
-- A tábla indexei `szineszek`
--
ALTER TABLE `szineszek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `szineszekErtekelese`
--
ALTER TABLE `szineszekErtekelese`
  ADD KEY `felhasznaloErtekelese` (`felhasznalo_Id`),
  ADD KEY `szineszekErtekelese` (`szinesz_Id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `adminok`
--
ALTER TABLE `adminok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `felhasznalok`
--
ALTER TABLE `felhasznalok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `filmek`
--
ALTER TABLE `filmek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `sorozatok`
--
ALTER TABLE `sorozatok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT a táblához `szineszek`
--
ALTER TABLE `szineszek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `adminok`
--
ALTER TABLE `adminok`
  ADD CONSTRAINT `admin_felhasznalo` FOREIGN KEY (`id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `filmbenJatszottak`
--
ALTER TABLE `filmbenJatszottak`
  ADD CONSTRAINT `filmbenJatszottak_ibfk_1` FOREIGN KEY (`szinesz_id`) REFERENCES `szineszek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `filmbenJatszottak_ibfk_2` FOREIGN KEY (`film_id`) REFERENCES `filmek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `filmekErtekelese`
--
ALTER TABLE `filmekErtekelese`
  ADD CONSTRAINT `felhasznalo2Ertekelese` FOREIGN KEY (`felhasznalo2_Id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `filmekErtekelese` FOREIGN KEY (`film_id`) REFERENCES `filmek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `sorozatbanJatszottak`
--
ALTER TABLE `sorozatbanJatszottak`
  ADD CONSTRAINT `jatszottSorozat` FOREIGN KEY (`sorozat_id`) REFERENCES `sorozatok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `jatszottSzinesz` FOREIGN KEY (`szinesz_id`) REFERENCES `szineszek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `sorozatokErtekelese`
--
ALTER TABLE `sorozatokErtekelese`
  ADD CONSTRAINT `felhasznalo1Ertekelese` FOREIGN KEY (`felhasznalo1_Id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sorozatokErtekelese` FOREIGN KEY (`sorozat_Id`) REFERENCES `sorozatok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `szineszekErtekelese`
--
ALTER TABLE `szineszekErtekelese`
  ADD CONSTRAINT `felhasznaloErtekelese` FOREIGN KEY (`felhasznalo_Id`) REFERENCES `felhasznalok` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `szineszekErtekelese` FOREIGN KEY (`szinesz_Id`) REFERENCES `szineszek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
