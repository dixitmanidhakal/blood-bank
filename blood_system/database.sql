-- Blood Bank Management System Database
-- Simple version for college project

CREATE DATABASE IF NOT EXISTS blood_system;
USE blood_system;

-- Admin Users Table
CREATE TABLE IF NOT EXISTS admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Donors Table
CREATE TABLE IF NOT EXISTS donors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    blood_type VARCHAR(5) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    location VARCHAR(100) NOT NULL,
    status VARCHAR(20) DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Blood Inventory Table
CREATE TABLE IF NOT EXISTS blood_inventory (
    id INT AUTO_INCREMENT PRIMARY KEY,
    blood_type VARCHAR(5) NOT NULL,
    units INT NOT NULL,
    location VARCHAR(100) DEFAULT 'Main Storage',
    expiry_date DATE,
    status VARCHAR(20) DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin (username: admin, password: admin123)
INSERT INTO admin_users (username, password) VALUES 
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Insert sample donors
INSERT INTO donors (name, blood_type, phone, location) VALUES
('John Doe', 'O+', '555-0101', 'New York'),
('Jane Smith', 'A+', '555-0102', 'Los Angeles'),
('Mike Johnson', 'B+', '555-0103', 'Chicago'),
('Sarah Wilson', 'AB+', '555-0104', 'Houston');

-- Insert sample blood inventory
INSERT INTO blood_inventory (blood_type, units, expiry_date) VALUES
('O+', 25, DATE_ADD(CURDATE(), INTERVAL 30 DAY)),
('A+', 20, DATE_ADD(CURDATE(), INTERVAL 30 DAY)),
('B+', 15, DATE_ADD(CURDATE(), INTERVAL 30 DAY)),
('AB+', 10, DATE_ADD(CURDATE(), INTERVAL 30 DAY));
