-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2020. Máj 26. 16:15
-- Kiszolgáló verziója: 10.4.11-MariaDB
-- PHP verzió: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `bidwebpagedatabase`
--

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `bid`
--

CREATE TABLE `bid` (
  `Bid_ID` int(11) NOT NULL,
  `BidPrice` int(11) NOT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Item_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `item`
--

CREATE TABLE `item` (
  `Item_ID` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL,
  `StartingPrice` int(11) NOT NULL,
  `Title` varchar(40) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `Description` varchar(150) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `Category` varchar(20) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `Picture` varchar(100) COLLATE utf8mb4_hungarian_ci DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `item`
--

INSERT INTO `item` (`Item_ID`, `StartDate`, `EndDate`, `StartingPrice`, `Title`, `Description`, `Category`, `Picture`, `User_ID`) VALUES
(5, '2020-05-26', '2020-06-23', 570, 'iPhone tok', 'eladó új iphone 8 tok', 'muszakiCikkek', 'case.jpg', 1);

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `registeredusers`
--

CREATE TABLE `registeredusers` (
  `User_ID` int(11) NOT NULL,
  `Lastname` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `Firstname` varchar(30) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `EMail` varchar(50) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `Address` varchar(100) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `Phonenumber` varchar(12) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `UserPassword` varchar(32) COLLATE utf8mb4_hungarian_ci NOT NULL,
  `AdminCheck` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

--
-- A tábla adatainak kiíratása `registeredusers`
--

INSERT INTO `registeredusers` (`User_ID`, `Lastname`, `Firstname`, `EMail`, `Address`, `Phonenumber`, `UserPassword`, `AdminCheck`) VALUES
(1, 'Horváth', 'Lajos', 'lali@email.hu', 'valami lakcím', '18651685', '1a1dc91c907325c69271ddf0c944bc72', 0),
(2, 'Lakner ', 'Laci', 'laci@email.com', 'ahol a laci lakik', '12345678', '1a1dc91c907325c69271ddf0c944bc72', 0);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`Bid_ID`),
  ADD KEY `User_ID` (`User_ID`),
  ADD KEY `Item_ID` (`Item_ID`);

--
-- A tábla indexei `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`Item_ID`),
  ADD KEY `User_ID` (`User_ID`);

--
-- A tábla indexei `registeredusers`
--
ALTER TABLE `registeredusers`
  ADD PRIMARY KEY (`User_ID`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `bid`
--
ALTER TABLE `bid`
  MODIFY `Bid_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `item`
--
ALTER TABLE `item`
  MODIFY `Item_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT a táblához `registeredusers`
--
ALTER TABLE `registeredusers`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `bid_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `registeredusers` (`User_ID`),
  ADD CONSTRAINT `bid_ibfk_2` FOREIGN KEY (`Item_ID`) REFERENCES `item` (`Item_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Megkötések a táblához `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `item_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `registeredusers` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
