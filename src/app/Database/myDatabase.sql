-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: db:3306
-- Čas generovania: Št 07.Sep 2023, 11:51
-- Verzia serveru: 8.0.32
-- Verzia PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `myDatabase`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `recipes`
--

CREATE TABLE `recipes` (
  `id` int UNSIGNED NOT NULL,
  `recipe_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipe_img_path` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `recipes`
--

INSERT INTO `recipes` (`id`, `recipe_name`, `recipe_img_path`) VALUES
(1, 'Palacinky', 'palacinky.jpg');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `recipe_ingredients`
--

CREATE TABLE `recipe_ingredients` (
  `id` int UNSIGNED NOT NULL,
  `recipe_id` int UNSIGNED NOT NULL,
  `ingredient_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ingredient_count` int DEFAULT NULL,
  `ingredient_count_type` enum('polievkové lyžice','čajové lyžice','kusy','balenia','kilogramy','gramy','mililitre','decilitre','litre','trochu','veľa') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `recipe_ingredients`
--

INSERT INTO `recipe_ingredients` (`id`, `recipe_id`, `ingredient_name`, `ingredient_count`, `ingredient_count_type`) VALUES
(1, 1, 'polohrubej múky', 10, 'polievkové lyžice'),
(2, 1, 'mlieka', 4, 'decilitre'),
(3, 1, 'vajec', 4, 'kusy'),
(4, 1, 'vanilkový cukor', 1, 'kusy'),
(5, 1, 'škorica', NULL, 'trochu');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `recipe_steps`
--

CREATE TABLE `recipe_steps` (
  `id` int UNSIGNED NOT NULL,
  `recipe_id` int UNSIGNED NOT NULL,
  `step_number` int NOT NULL,
  `step_description` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Sťahujem dáta pre tabuľku `recipe_steps`
--

INSERT INTO `recipe_steps` (`id`, `recipe_id`, `step_number`, `step_description`) VALUES
(1, 1, 1, 'Všetko hodiť do misky.'),
(2, 1, 2, 'Poriadne pomixovať.'),
(3, 1, 3, 'Na rozohriatý olej (nie veľa oleja) postupne nalievať cesto.');

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- Indexy pre tabuľku `recipe_steps`
--
ALTER TABLE `recipe_steps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recipe_id` (`recipe_id`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `recipes`
--
ALTER TABLE `recipes`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pre tabuľku `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pre tabuľku `recipe_steps`
--
ALTER TABLE `recipe_steps`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Obmedzenie pre exportované tabuľky
--

--
-- Obmedzenie pre tabuľku `recipe_ingredients`
--
ALTER TABLE `recipe_ingredients`
  ADD CONSTRAINT `recipe_ingredients_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Obmedzenie pre tabuľku `recipe_steps`
--
ALTER TABLE `recipe_steps`
  ADD CONSTRAINT `recipe_steps_ibfk_1` FOREIGN KEY (`recipe_id`) REFERENCES `recipes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
