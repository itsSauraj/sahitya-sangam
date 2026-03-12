# Sahitya Sangam 📚

A literary e-commerce platform for book lovers and authors, featuring a complete book catalog, shopping cart, user authentication, and order management system.

## 🚀 Quick Start

**New to the project?** See [QUICKSTART.md](QUICKSTART.md) for a 5-minute setup guide!

```powershell
# 1. Copy environment file
Copy-Item .env.example .env

# 2. Edit .env with your credentials (database & email)

# 3. Create database
CREATE DATABASE sahitya_db;

# 4. Run migrations
C:\xampp\php\php.exe database/migrate.php up

# 5. Seed sample data (optional)
C:\xampp\php\php.exe database/seed.php

# 6. Open browser
http://localhost/Sahitya_Sangam2/
```

📖 **Environment Setup**: See [ENV_SETUP.md](ENV_SETUP.md) for detailed .env configuration

## 📋 Table of Contents

- [Project Structure](#project-structure)
- [Technology Stack](#technology-stack)
- [Features](#features)
- [Setup Instructions](#setup-instructions)
- [Database Migrations](#database-migrations)
- [Email Configuration](#email-configuration)
- [Development Workflow](#development-workflow)
- [Security Considerations](#security-considerations)
- [Troubleshooting](#troubleshooting)

## Project Structure

```
Sahitya_Sangam2/
│
├── 📄 Main Pages (Root Directory)
│   ├── index.php           # Homepage
│   ├── about.php           # About page
│   ├── authors.php         # Authors listing
│   ├── products.php        # Books/products catalog
│   ├── cart.php            # Shopping cart
│   ├── catalog.php         # Book catalog
│   ├── contact.php         # Contact page
│   ├── login.php           # User login page
│   └── register.php        # User registration page
│
├── 📁 includes/            # Backend processing files
│   ├── config/
│   │   └── db.php          # Database configuration
│   │
│   ├── auth/               # Authentication handlers
│   │   ├── loginprocess.php       # Login processing
│   │   ├── registerprocess.php    # Registration processing
│   │   └── logout.php             # Logout handler
│   │
│   ├── order/              # Order management
│   │   └── placeorder.php         # Order placement handler
│   │
│   └── process/            # Other processing scripts
│       ├── contact_process.php    # Contact form handler
│       └── test_mail.php          # Email testing script
│
├── 📁 vendor/              # Third-party libraries
│   └── phpmailer/          # PHPMailer library
│       ├── src/
│       ├── language/
│       └── ...
│
├── 📁 database/            # Database migrations & seeds
│   ├── migrate.php         # Migration runner
│   ├── seed.php            # Database seeder
│   ├── MIGRATIONS.md       # Migration guide
│   └── migrations/         # SQL migration files
│
├── .gitignore              # Git ignore rules
└── README.md               # This file
```

## Technology Stack

### Backend
- **PHP 7.4+** - Server-side logic
- **MySQLi** - Database connectivity
- **Sessions** - User authentication & cart management
- **PHPMailer** - Email functionality

### Frontend
- **HTML5** - Semantic markup
- **Tailwind CSS** - Utility-first styling
- **JavaScript** - Interactive features
- **Responsive Design** - Mobile-friendly

### Database
- **MySQL/MariaDB** - Relational database
- **Custom Migration System** - Version control for schema
- **Foreign Keys** - Data integrity
- **Indexes** - Query optimization

### Development Tools
- **XAMPP** - Local development environment
- **Git** - Version control
- **VS Code** - Recommended editor

## Features

### Core Features
- 📖 **Book Catalog** - Browse and search books with detailed information
- 👤 **User Authentication** - Secure login/register with password hashing
- 🛒 **Shopping Cart** - Add books, manage quantities, place orders
- 📦 **Order Management** - Track orders with status updates
- 👥 **Author Profiles** - Detailed author biographies and information
- 📧 **Contact Form** - Email notifications via PHPMailer

### Technical Features
- 🗄️ **Database Migrations** - Version-controlled schema changes
- 🔄 **Rollback Support** - Safely revert database changes
- 🌱 **Database Seeding** - Sample data for testing
- 🔒 **Security** - Password hashing, session management
- 📱 **Responsive Design** - Tailwind CSS styling
- 🔐 **Environment Variables** - Secure credential management via .env

## Setup Instructions

### Prerequisites

1. **XAMPP** installed (Apache + MySQL)

### Installation

1. **Environment Configuration**
   ```powershell
   # Copy example environment file
   Copy-Item .env.example .env
   
   # Edit .env with your credentials
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
   
   📖 **See [ENV_SETUP.md](ENV_SETUP.md) for Gmail App Password setup**

2. **Database Setup**
   ```sql
   CREATE DATABASE sahitya_db;
   ```

3. **Run Migrations**
   ```powershell
   # Navigate to project root
   cd C:\xampp\htdocs\Sahitya_Sangam2
   
   # Run all migrations
   php database/migrate.php up
   
   # Seed sample data (optional)
   php database/seed.php
   ```
   
   📖 **See [database/MIGRATIONS.md](database/MIGRATIONS.md) for complete migration guide**

3. **Configure Database** (if needed)
   - Edit `includes/config/db.php`
   - Default credentials:
     ```php
     $conn = new mysqli("localhost","root","","sahitya_db");
     ```

4. **Start XAMPP Services**
   - Start Apache
   - Start MySQL

5. **Access Application**
   - Navigate to: `http://localhost/Sahitya_Sangam2/`

## Email Configuration

Email is configured via environment variables in the `.env` file:

```env
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-gmail-app-password
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Sahitya Sangam"
MAIL_ENCRYPTION=tls
```

### Setting Up Gmail App Password

1. Go to [Google Account Security](https://myaccount.google.com/security)
2. Enable **2-Step Verification** (required)
3. Go to **App passwords**
4. Select app: **Mail**
5. Select device: **Other (Custom name)** → "Sahitya Sangam"
6. Copy the 16-character password
7. Paste into `.env` as `MAIL_PASSWORD`

**Important**: 
- ✅ Use App Password, not your regular Gmail password
- ✅ Keep App Password in `.env` file (never commit to Git)
- ✅ 2-Step Verification must be enabled

📖 **Full Guide**: See [ENV_SETUP.md](ENV_SETUP.md) for complete email setup

## File Organization

### Main Pages
All user-facing pages are in the root directory for easy access.

### Includes Directory
- **cEnvironment Variables**: All credentials stored in `.env` file
   - ✅ `.env` is gitignored (never committed)
   - ✅ Use `.env.example` as template
   - ✅ Never hardcode credentials in code
   
2. **Database Security**
   - ✅ Credentials in `.env` file
   - ⚠️ Consider using prepared statements instead of direct queries
   - ✅ Using `password_hash()` for secure password storage
   
3. **Email Security**
   - ✅ Gmail App Passwords (not actual password)
   - ✅ Credentials in `.env` file
   - ✅ SMTP over TLS encryption
   
4. **Session Security**
   - ✅ Sessions properly initialized with `session_start()`
   - ✅ Session lifetime configurable in `.env`
   
5. **File Permissions**
   - ⚠️ Ensure `.env` has restricted access (not web-accessible)
   - ⚠️ Keep `includes/` folder above webroot in production

📖 **Best Practices**: See [ENV_SETUP.md](ENV_SETUP.md) for security guidelines
### Vendor Directory
Third-party libraries follow PSR-4 standards:
- PHPMailer for email functionality

## Security Considerations

⚠️ **Important Security Notes**:

1. **Database Configuration**: The `includes/config/db.php` is gitignored to protect credentials
2. **SQL Injection**: Consider using prepared statements instead of direct queries
3. **Password Storage**: Using `password_hash()` for secure password storage ✓
4. **Session Security**: Sessions are properly initialized with `session_start()`
5. **Email Credentials**: Keep PHPMailer credentials secure (use environment variables)

## Development Workflow

### Daily Workflow

```powershell
# 1. Start XAMPP services (Apache + MySQL)

# 2. Navigate to project
cd C:\xampp\htdocs\Sahitya_Sangam2

# 3. Check for new migrations
C:\xampp\php\php.exe database/migrate.php status

# 4. Run pending migrations (if any)
C:\xampp\php\php.exe database/migrate.php up

# 5. Start coding!
```

### Access Application

Browser: `http://localhost/Sahitya_Sangam2/`

**Test Account**:
- Email: `test@sahityasangam.com`
- Password: `password123`

## Database Migrations

### Quick Start

```powershell
# Check migration status
C:\xampp\php\php.exe database/migrate.php status

# Run all pending migrations
C:\xampp\php\php.exe database/migrate.php up

# Seed sample data
C:\xampp\php\php.exe database/seed.php
```

### Common Commands

```powershell
# Create new migration
C:\xampp\php\php.exe database/migrate.php create AddColumnToTable

# Rollback last migration
C:\xampp\php\php.exe database/migrate.php down

# Rollback last 3 migrations
C:\xampp\php\php.exe database/migrate.php down 3
```

**Note**: If PHP is in your system PATH, you can use `php` instead of full path.

📖 **Full Guide**: See [database/MIGRATIONS.md](database/MIGRATIONS.md) for complete documentation

### Current Tables
.env` file
   - Ensure database exists: `CREATE DATABASE sahitya_db;`
   - Check `.env` file exists (copy from `.env.example`)
- ✅ **books** - Book catalog with pricing
- ✅ **authors** - Author profiles
- ✅ **orders** - Order records
- ✅ **order_items** - Order line items
- ✅ **contact_messages** - Contact form submissions

## Git Usage

```bash
# Check status
git status

# Stage changes
git add .

# Commit changes
git commit -m "Your message"

# Push to remote
git push origin main
```

## Contributing

1. Create a new branch
2. Make your changes
3. **Run migrations** if you added database changes
4. Test thoroughly
5. Submit a pull request
.env` file
   - Use Gmail App Password (not regular password)
   - Ensure 2-Step Verification is enabled on Gmail
   - Check `MAIL_PORT` (587 for TLS, 465 for SSL)
   - See [ENV_SETUP.md](ENV_SETUP.md) for Gmail setup
### Common Issues

1. **Database Connection Failed**
   - Check XAMPP MySQL is running
   - Verify credentials in `includes/config/db.php`
   - Ensure database exists: `CREATE DATABASE sahitya_db;`

2. **Migration Errors**
   - Check status first: `C:\xampp\php\php.exe database/migrate.php status`
   - Read full guide: [database/MIGRATIONS.md](database/MIGRATIONS.md)
   - Common fix: Rollback and re-run
     ```powershell
     C:\xampp\php\php.exe database/migrate.php down
     C:\xampp\php\php.exe database/migrate.php up
     ```

8. **".env file not found" Error**
   - Copy `.env.example` to `.env`: `Copy-Item .env.example .env`
   - Edit `.env` with your credentials
   - Place `.env` in project root directory

3. **Email Not Sending**
   - Verify SMTP credentials in `includes/process/contact_process.php`
   - Check Gmail App Password is correct
   - Ensure `allow_url_fopen` is enabled in php.ini

4. **404 Errors on Form Submission**
   - Verify file paths are correct
   - Check that includes directory structure matches README

5. **Session Not Working**
   - Ensure `session_start()` is called before any output
   - Check session directory permissions

6. **"Table doesn't exist" Error**
   - You need to run migrations: `C:\xampp\php\php.exe database/migrate.php up`
   - Check migration status: `C:\xampp\php\php.exe database/migrate.php status`

7. **"'php' is not recognized" Error**
   - ENV_SETUP.md](ENV_SETUP.md)** - Environment variable configuration guide
- **[Use full XAMPP path: `C:\xampp\php\php.exe`
   - Or add `C:\xampp\php` to your system PATH
   - Restart PowerShell after adding to PATH

## 📚 Documentation & Resources

### Project Documentation
- **[QUICKSTART.md](QUICKSTART.md)** - Get started in 5 minutes
- **[database/MIGRATIONS.md](database/MIGRATIONS.md)** - Complete migration guide with examples
- **[database/MIGRATION_SUMMARY.md](database/MIGRATION_SUMMARY.md)** - Quick migration reference

### Useful Links
- **PHPMailer**: [GitHub](https://github.com/PHPMailer/PHPMailer) | [Documentation](https://github.com/PHPMailer/PHPMailer/wiki)
- **Tailwind CSS**: [Documentation](https://tailwindcss.com/docs)
- **XAMPP**: [Official Site](https://www.apachefriends.org/)

### Project URLs
- **Homepage**: `http://localhost/Sahitya_Sangam2/`
- **Products**: `http://localhost/Sahitya_Sangam2/products.php`
- **Login**: `http://localhost/Sahitya_Sangam2/login.php`
- **Contact**: `http://localhost/Sahitya_Sangam2/contact.php`

## License

This project is created for educational purposes.

## Contact

For queries, use the contact form at `/contact.php`

---

**Last Updated**: March 2026  
**Version**: 2.0 (Restructured with Migrations)

---

## 🎯 Key Improvements in v2.0

✅ **Organized Structure** - Clean separation of concerns  
✅ **Database Migrations** - Version-controlled schema management  
✅ **Environment Variables** - Secure .env-based credential management  
✅ **Automated Seeding** - Sample data for quick testing  
✅ **Complete Documentation** - Guides for setup and development  
✅ **Security Enhanced** - No hardcoded credentials, proper gitignore  
✅ **Production Ready** - Professional folder structure  

**Happy Coding! 🚀**
