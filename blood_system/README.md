# Blood Bank Management System

Simple college project for blood donor management

## Setup Instructions

### 1. Start XAMPP

- Start Apache and MySQL

### 2. Create Database

- Open phpMyAdmin: `http://localhost/phpmyadmin`
- Click "Import" tab
- Select `database.sql` file
- Click "Go"

### 3. Access the System

- Public page: `http://localhost/blood-bank/blood_system/index.php`
- Admin login: `http://localhost/blood-bank/blood_system/admin_login.php`

### Default Admin Login

```
Username: admin
Password: admin123
```

## Features

- ✅ Add, Edit, Delete donors
- ✅ Blood stock management
- ✅ Admin authentication
- ✅ Secure with prepared statements
- ✅ Bootstrap responsive design

## Files

- `config.php` - Database connection
- `database.sql` - Database setup
- `index.php` - Public donor management
- `admin_login.php` - Admin login
- `admin_dashboard.php` - Admin panel
- `blood_stock.php` - Blood inventory
- `logout.php` - Logout

## What Was Fixed

1. ✅ Fixed SQL injection vulnerabilities (now using prepared statements)
2. ✅ Fixed syntax error in blood_stock.php (removed extra comma)
3. ✅ Added proper database connection
4. ✅ Added password hashing for admin
5. ✅ Created complete database schema

## Technologies

- PHP
- MySQL
- Bootstrap 5
- Font Awesome

---

**College Project - Blood Bank Management System**
