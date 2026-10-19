CREATE DATABASE IF NOT EXISTS lost_and_found CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE lost_and_found;
CREATE TABLE IF NOT EXISTS users (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 full_name VARCHAR(120) NOT NULL,
 username VARCHAR(50) NOT NULL UNIQUE,
 email VARCHAR(190) NOT NULL UNIQUE,
 password_hash VARCHAR(255) NOT NULL,
 role ENUM('user','admin') NOT NULL DEFAULT 'user',
 created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS items (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 user_id INT UNSIGNED NOT NULL,
 item_type ENUM('lost','found') NOT NULL,
 title VARCHAR(160) NOT NULL,
 category VARCHAR(80) NOT NULL,
 place VARCHAR(255) NOT NULL,
 item_date DATE NOT NULL,
 description TEXT,
 contact_info VARCHAR(255) NOT NULL,
 photo_path VARCHAR(255) DEFAULT NULL,
 status ENUM('active','returned','closed') NOT NULL DEFAULT 'active',
 created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_items_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
 INDEX idx_items_type (item_type), INDEX idx_items_category (category), INDEX idx_items_status (status), INDEX idx_items_date (item_date)
) ENGINE=InnoDB;
CREATE TABLE IF NOT EXISTS claims (
 id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 item_id INT UNSIGNED NOT NULL,
 claimant_user_id INT UNSIGNED NOT NULL,
 claim_message TEXT NOT NULL,
 claim_status ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
 created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
 CONSTRAINT fk_claims_item FOREIGN KEY (item_id) REFERENCES items(id) ON DELETE CASCADE,
 CONSTRAINT fk_claims_user FOREIGN KEY (claimant_user_id) REFERENCES users(id) ON DELETE CASCADE,
 INDEX idx_claim_status (claim_status)
) ENGINE=InnoDB;
