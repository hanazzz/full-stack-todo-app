-- Create tasks table

CREATE TABLE IF NOT EXISTS `tasks` (
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `is_important` TINYINT(1) NOT NULL DEFAULT 0,
    `is_done` TINYINT(1) NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `user_id` varchar(255) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create scheduled event to clear data from tasks table every 7 days
CREATE EVENT IF NOT EXISTS `empty_tasks`
    ON SCHEDULE
    EVERY 7 DAY
    DO DELETE FROM `tasks`;


-- Create users table
CREATE TABLE IF NOT EXISTS `users` (
    `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id` varchar(255) NOT NULL UNIQUE,
    PRIMARY KEY (`id`)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- Create scheduled event to clear data from users table every 7 days
CREATE EVENT IF NOT EXISTS `empty_users`
    ON SCHEDULE
    EVERY 7 DAY
    DO DELETE FROM `users`;