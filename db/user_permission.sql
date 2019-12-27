CREATE USER 'musicshuffle'@'localhost' IDENTIFIED BY '';
GRANT SELECT, UPDATE, INSERT, DELETE ON musicshuffle.* TO musicshuffle@'localhost';

FLUSH PRIVILEGES;
SHOW GRANTS FOR 'musicshuffle'@'localhost';
