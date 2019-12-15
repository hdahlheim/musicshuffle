CREATE USER IF NOT EXISTS 'musicshuffle' IDENTIFIED BY 'password';
GRANT SELECT, UPDATE, INSERT, DELETE ON musicshuffle.* TO 'musicshuffle'@'%';
FLUSH PRIVILEGES;
SHOW GRANTS FOR 'musicshuffle';
