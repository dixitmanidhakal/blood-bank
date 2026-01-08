# 🚀 Quick Setup Guide - Blood Bank System

## Step 1: Install XAMPP (Required)

### For Mac:

1. Download XAMPP from: https://www.apachefriends.org/download.html
2. Choose "XAMPP for macOS"
3. Open the downloaded .dmg file
4. Drag XAMPP to Applications folder
5. Open XAMPP from Applications

### For Windows:

1. Download XAMPP from: https://www.apachefriends.org/download.html
2. Run the installer
3. Install to default location (C:\xampp)
4. Launch XAMPP Control Panel

---

## Step 2: Start Services

### Open XAMPP Control Panel and start:

- ✅ Apache (Web Server)
- ✅ MySQL (Database)

**Wait until both show "Running" status**

---

## Step 3: Setup Database

1. Open your browser and go to: `http://localhost/phpmyadmin`

2. Click on "Import" tab at the top

3. Click "Choose File" and select: `database.sql` from the blood_system folder

4. Click "Go" button at the bottom

5. You should see: "Import has been successfully finished"

---

## Step 4: Copy Project Files

### For Mac:

```bash
# Copy the blood_system folder to XAMPP htdocs
cp -r blood_system /Applications/XAMPP/htdocs/
```

### For Windows:

- Copy the `blood_system` folder
- Paste it into: `C:\xampp\htdocs\`

---

## Step 5: Access the System

Open your browser and visit:

### Public Page (Anyone can use):

```
http://localhost/blood_system/index.php
```

### Admin Panel:

```
http://localhost/blood_system/admin_login.php
```

**Login Credentials:**

- Username: `admin`
- Password: `admin123`

---

## 🎯 Quick Test

1. Go to: `http://localhost/blood_system/index.php`
2. You should see the Blood Donor Management System
3. Try adding a donor
4. Try editing a donor
5. Try deleting a donor

---

## ❌ Troubleshooting

### Problem: "Connection failed"

**Solution:**

- Make sure MySQL is running in XAMPP
- Check if database was imported correctly

### Problem: "404 Not Found"

**Solution:**

- Make sure Apache is running in XAMPP
- Check if files are in the correct folder (htdocs)

### Problem: "Access denied for user 'root'"

**Solution:**

- Open `config.php`
- Check database credentials (default is root with no password)

### Problem: Blank page

**Solution:**

- Check if PHP is enabled in XAMPP
- Restart Apache service

---

## 📱 Features to Test

### Public Page (index.php):

- ✅ Add new donor
- ✅ View all donors
- ✅ Edit donor information
- ✅ Delete donor

### Admin Panel (admin_dashboard.php):

- ✅ Login with admin credentials
- ✅ View statistics
- ✅ Manage donors
- ✅ Access blood stock management

### Blood Stock (blood_stock.php):

- ✅ Add blood inventory
- ✅ View total units
- ✅ Delete inventory items

---

## 🎓 For Your College Presentation

### Key Points to Mention:

1. **Security**: Uses prepared statements to prevent SQL injection
2. **CRUD Operations**: Complete Create, Read, Update, Delete functionality
3. **Authentication**: Secure admin login with password hashing
4. **Design**: Responsive Bootstrap 5 interface
5. **Database**: Well-structured MySQL database

### Demo Flow:

1. Show public page - add/edit/delete donor
2. Login to admin panel
3. Show statistics dashboard
4. Demonstrate blood stock management
5. Explain security features (prepared statements)

---

## 📞 Need Help?

If you encounter any issues:

1. Check XAMPP services are running
2. Verify database is imported
3. Check browser console for errors (F12)
4. Review error logs in XAMPP

---

**Good luck with your college project! 🎉**
