# Quick Start Guide

Get Sahitya Sangam up and running in 5 minutes!

## 🚀 Prerequisites

- ✅ XAMPP installed
- ✅ Git initialized (already done)

## 📝 Setup Steps

### 1. Configure Environment

Copy the example environment file:

```powershell
Copy-Item .env.example .env
```

Edit `.env` with your credentials:

```powershell
notepad .env
```

Update these values:
```env
DB_HOST=localhost
DB_USERNAME=root
DB_PASSWORD=
DB_DATABASE=sahitya_db

MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-gmail-app-password
```

**📧 Gmail Setup**: See [ENV_SETUP.md](ENV_SETUP.md) for Gmail App Password instructions

### 2. Start XAMPP

Open XAMPP Control Panel and start:
- ✅ Apache
- ✅ MySQL

### 3. Create Database

Open browser: `http://localhost/phpmyadmin`

Run this SQL:
```sql
CREATE DATABASE sahitya_db;
```

### 4. Run Migrations

Open PowerShell in project folder:

```powershell
cd C:\xampp\htdocs\Sahitya_Sangam2

# Run all migrations (use full PHP path for XAMPP)
C:\xampp\php\php.exe database/migrate.php up
```

**Alternative:** Add PHP to your PATH or use:
```powershell
# If PHP is in your PATH
php database/migrate.php up
```

You should see:
```
Running 6 migration(s)...

→ Migrating: 20260312000001_create_users_table.sql
✓ Migrated:  20260312000001_create_users_table.sql

...

✓ All migrations completed successfully!
```

### 5. Add Sample Data (Optional)

```powershell
C:\xampp\php\php.exe database/seed.php
```

This adds:
- 5 sample books
- 5 authors
- 1 test user (test@sahityasangam.com / password123)

### 6. Open Application

Browser: `http://localhost/Sahitya_Sangam2/`

## ✅ You're Done!

### Test Login
- Email: `test@sahityasangam.com`
- Password: `password123`

### Next Steps

- Browse books at `/products.php`
- Add to cart
- Place an order
- Contact form at `/contact.php`

## 🔄 Daily Development

```powershell
# Start XAMPP (Apache + MySQL)

# Check for new migrations
C:\xampp\php\php.exe database/migrate.php status

# Run pending migrations
C:\xampp\php\php.exe database/migrate.php up

# Start coding!
```

## 📚 Documentation

- [Full README](README.md)
- [Environment Setup](ENV_SETUP.md)
- [Migration Guide](database/MIGRATIONS.md)

## ⚠️ Troubleshooting

**".env file not found"**
→ Copy: `Copy-Item .env.example .env`
→ Must be in project root directory

**"'php' is not recognized"**
→ Use full path: `C:\xampp\php\php.exe database/migrate.php`
→ Or add `C:\xampp\php` to your system PATH

**"Connection failed"**
→ Start MySQL in XAMPP
→ Check `.env` database credentials

**"Email not sending"**
→ Update `.env` with Gmail App Password
→ See [ENV_SETUP.md](ENV_SETUP.md) for setup

**"Table doesn't exist"**
→ Run migrations: `C:\xampp\php\php.exe database/migrate.php up`

**"Migration already exists"**
→ Check status: `C:\xampp\php\php.exe database/migrate.php status`

---

**Need help?** Read [database/MIGRATIONS.md](database/MIGRATIONS.md)
