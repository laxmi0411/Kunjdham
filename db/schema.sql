-- Run this SQL to create the bookings table
CREATE TABLE IF NOT EXISTS `bookings` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(50) DEFAULT NULL,
  `checkin` DATE DEFAULT NULL,
  `checkout` DATE DEFAULT NULL,
  `adults` INT DEFAULT 1,
  `children` INT DEFAULT 0,
  `room` VARCHAR(100) NOT NULL,
  `message` TEXT,
  `status` VARCHAR(20) DEFAULT 'new',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
