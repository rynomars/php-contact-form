CREATE DATABASE IF NOT EXISTS `dealerinspire` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
CREATE USER If NOT EXISTS 'di_user'@'localhost' IDENTIFIED BY 'secret';
GRANT ALL PRIVILEGES ON dealerinspire.* TO 'di_user'@'localhost';