
-- ----------------------------------------------------------------------
-- USER MANAGEMENT & COMMUNITY
-- ----------------------------------------------------------------------

-- The players' main table
CREATE TABLE IF NOT EXISTS `players` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) DEFAULT NULL,
    `created` DATETIME NOT NULL,
    `updated` DATETIME DEFAULT NULL,
    `active` DATETIME DEFAULT NULL,
    `money` INT(11) NOT NULL,
    PRIMARY KEY(`id`),
    UNIQUE(`username`),
    UNIQUE(`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- The email validation code table
CREATE TABLE IF NOT EXISTS `email_tokens` (
    `player` INT(11) UNSIGNED NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `token` varchar(255) NOT NULL,
    `created` DATETIME NOT NULL,
    PRIMARY KEY(`player`),
    UNIQUE(`email`),
    FOREIGN KEY(`player`) REFERENCES `players` (`id`)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- The password reset codes table
CREATE TABLE IF NOT EXISTS `password_reset_codes` (
    `player` INT(11) UNSIGNED NOT NULL,
    `code` varchar(255) NOT NULL,
    `created` DATETIME NOT NULL,
    PRIMARY KEY(`player`),
    FOREIGN KEY(`player`) REFERENCES `players` (`id`)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;