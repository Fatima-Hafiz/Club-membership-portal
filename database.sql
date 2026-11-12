-- Club Membership Registration Portal Database
-- Simple database for Level 4 PHP/MySQL project

CREATE DATABASE IF NOT EXISTS club_portal;
USE club_portal;

-- Table for student club applications
CREATE TABLE IF NOT EXISTS applications (
    ApplicationID INT AUTO_INCREMENT PRIMARY KEY,
    FullName VARCHAR(100) NOT NULL,
    StudentID VARCHAR(30) NOT NULL,
    Email VARCHAR(100) NOT NULL,
    Phone VARCHAR(30) NOT NULL,
    Programme VARCHAR(100) NOT NULL,
    Level VARCHAR(20) NOT NULL,
    ClubName VARCHAR(100) NOT NULL,
    Reason TEXT NOT NULL,
    Status ENUM('Pending', 'Approved', 'Rejected') NOT NULL DEFAULT 'Pending',
    SubmittedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_application (StudentID, ClubName)
);

-- Table for admin users
CREATE TABLE IF NOT EXISTS admin_users (
    AdminID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL UNIQUE,
    PasswordHash VARCHAR(255) NOT NULL,
    CreatedAt TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Default admin account
-- Username: admin
-- Password: admin123
-- The password below is hashed using PHP password_hash().
INSERT INTO admin_users (Username, PasswordHash)
VALUES ('admin', '$2y$12$aInYKRdsJCKjMnpjOSTLSe4SEyqqZuXadRjPNWN6SjHnb8oQ5NB/m')
ON DUPLICATE KEY UPDATE Username = Username;
