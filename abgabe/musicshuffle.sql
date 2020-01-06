-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Erstellungszeit: 06. Jan 2020 um 21:16
-- Server-Version: 5.7.26-log-cll-lve
-- PHP-Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `musicshuffle`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `playlists`
--

INSERT INTO `playlists` (`id`, `name`, `created`, `updated`, `user_id`) VALUES
(1, 'Russian Hard Bass', '2020-01-06 19:13:27', '2020-01-06 19:17:16', 1),
(3, 'Tschüsch', '2020-01-06 19:18:39', '2020-01-06 19:18:39', 2),
(4, '8Bit', '2020-01-06 19:54:02', '2020-01-06 19:54:02', 1),
(5, 'empty', '2020-01-06 20:02:25', '2020-01-06 20:02:25', 1),
(6, 'test playlists', '2020-01-06 20:02:33', '2020-01-06 20:04:47', 1),
(7, 'to', '2020-01-06 20:02:38', '2020-01-06 20:02:38', 1),
(8, 'show', '2020-01-06 20:02:41', '2020-01-06 20:02:41', 1),
(9, 'pagination', '2020-01-06 20:02:52', '2020-01-06 20:02:52', 1),
(10, 'only', '2020-01-06 20:03:07', '2020-01-06 20:03:07', 1),
(11, 'one', '2020-01-06 20:03:12', '2020-01-06 20:03:12', 1),
(12, 'more', '2020-01-06 20:03:17', '2020-01-06 20:03:17', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `playlist_items`
--

CREATE TABLE `playlist_items` (
  `id` int(11) NOT NULL,
  `song_id` int(11) DEFAULT NULL,
  `playlist_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `playlist_items`
--

INSERT INTO `playlist_items` (`id`, `song_id`, `playlist_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 3),
(6, 5, 4),
(7, 6, 4),
(8, 7, 4),
(9, 8, 4);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `songs`
--

CREATE TABLE `songs` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `url` varchar(255) NOT NULL,
  `youtube_id` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `songs`
--

INSERT INTO `songs` (`id`, `name`, `url`, `youtube_id`) VALUES
(1, 'Hard Bass School - narkotik kal', 'https://www.youtube.com/watch?v=fro6je9L5kg', 'fro6je9L5kg'),
(2, 'HardBass- Raz Raz Raz Raz', 'https://www.youtube.com/watch?v=dWlLF3cCzOg', 'dWlLF3cCzOg'),
(3, 'XS Project - Bochka, Bass, Kolbaser [Bass Boosted] (Russian Spec', 'https://www.youtube.com/watch?v=VLW1ieY4Izw&t=82s', 'VLW1ieY4Izw'),
(4, 'Black Pumas - Colors (Official Live Session)', 'https://www.youtube.com/watch?v=0G383538qzQ', '0G383538qzQ'),
(5, 'Super Robotic Encounters - Volcano Kid', 'https://www.youtube.com/watch?v=rnIKuVuRU8E', 'rnIKuVuRU8E'),
(6, 'Laffe the Fox - Left Alone in Outer Space', 'https://www.youtube.com/watch?v=3rysbn9bZ54', '3rysbn9bZ54'),
(7, 'Laffe the Fox - The Luxury of Being Dead', 'https://www.youtube.com/watch?v=uapMQRv7Z0M', 'uapMQRv7Z0M'),
(8, 'Best of Chiptune [8 bit music, retro visuals]', 'https://www.youtube.com/watch?v=rf_p3-8fTo0', 'rf_p3-8fTo0');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `upvotes`
--

CREATE TABLE `upvotes` (
  `id` int(11) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `user` int(11) DEFAULT NULL,
  `playlist_item` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `upvotes`
--

INSERT INTO `upvotes` (`id`, `created`, `user`, `playlist_item`) VALUES
(1, '2020-01-06 19:53:34', 1, 4),
(2, '2020-01-06 19:57:09', 1, 6);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created`, `updated`) VALUES
(1, 'malte', 'malte@dahlheim.ch', '$2y$10$Nr0V5/tit8boTWrYMb9xgOBExf/xbhKl9ValCjP.uF8gR1OYXZDO6', '2020-01-06 19:12:15', '2020-01-06 20:12:41'),
(2, 'Tatyana', 'tatyana.vogel@gibmit.ch', '$2y$10$cmsXU94tLrSH7jpyCy8SYuiMavK16pDM0mR9TQfxFBMipoNI9btyq', '2020-01-06 19:17:22', '2020-01-06 19:17:22'),
(3, 'di', 'di@cyon.ch', '$2y$10$uX7lwx4128ERaxyBd.yTGuWc6usaLmZ35Vb5b7ONiX99fig7dW1Wy', '2020-01-06 19:58:29', '2020-01-06 19:58:29'),
(4, 'mr', 'mr@cyon.ch', '$2y$10$sSiqWSKth33J1YqP6gqx3.bfrkZZ5c2CfXxtaik1MgyEinm8leuSO', '2020-01-06 20:00:17', '2020-01-06 20:00:17'),
(5, 'notMalte', 'henning@dahlheim.ch', '$2y$10$SPiXYvVpTvmtekD9O4MLUudbs2/uNZzxnLH.9Pi/kilfKhkwAj3tC', '2020-01-06 20:01:46', '2020-01-06 20:01:46');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `playlists`
--
ALTER TABLE `playlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indizes für die Tabelle `playlist_items`
--
ALTER TABLE `playlist_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `song_id` (`song_id`,`playlist_id`),
  ADD KEY `playlist_id` (`playlist_id`);

--
-- Indizes für die Tabelle `songs`
--
ALTER TABLE `songs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `youtube_id` (`youtube_id`);

--
-- Indizes für die Tabelle `upvotes`
--
ALTER TABLE `upvotes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `USER` (`user`,`playlist_item`),
  ADD KEY `playlist_item` (`playlist_item`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `playlists`
--
ALTER TABLE `playlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT für Tabelle `playlist_items`
--
ALTER TABLE `playlist_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `songs`
--
ALTER TABLE `songs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT für Tabelle `upvotes`
--
ALTER TABLE `upvotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `playlists`
--
ALTER TABLE `playlists`
  ADD CONSTRAINT `playlists_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints der Tabelle `playlist_items`
--
ALTER TABLE `playlist_items`
  ADD CONSTRAINT `playlist_items_ibfk_1` FOREIGN KEY (`song_id`) REFERENCES `songs` (`id`),
  ADD CONSTRAINT `playlist_items_ibfk_2` FOREIGN KEY (`playlist_id`) REFERENCES `playlists` (`id`);

--
-- Constraints der Tabelle `upvotes`
--
ALTER TABLE `upvotes`
  ADD CONSTRAINT `upvotes_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `upvotes_ibfk_2` FOREIGN KEY (`playlist_item`) REFERENCES `playlist_items` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
