# Sahitya Sangam 📚

A literary e-commerce platform for book lovers and authors.

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
├── 📁 assets/              # Static resources (for future use)
│   ├── css/                # Stylesheets
│   ├── js/                 # JavaScript files
│   └── images/             # Image assets
│
├── 📁 scripts/             # Utility scripts
│   └── read_excel.py       # Python Excel reader
│
├── 📁 .venv/               # Python virtual environment
│
├── .gitignore              # Git ignore rules
└── README.md               # This file
```

## Technology Stack

- **Backend**: PHP (Sessions, MySQLi)
- **Frontend**: HTML, Tailwind CSS, JavaScript
- **Database**: MySQL/MariaDB
- **Email**: PHPMailer
- **Scripts**: Python 3.x
- **Server**: XAMPP (Apache + MySQL)

## Features

- 📖 Book catalog and browsing
- 👤 User authentication (login/register)
- 🛒 Shopping cart functionality
- 📧 Contact form with email notifications
- 👥 Author profiles
- 📦 Order management

## Setup Instructions

### Prerequisites

1. **XAMPP** installed (Apache + MySQL)
2. **Python 3.x** (for utility scripts)

### Installation

1. **Database Setup**
   ```sql
   CREATE DATABASE sahitya_db;
   ```

2. **Configure Database**
   - Edit `includes/config/db.php`
   - Update credentials if needed:
     ```php
     $conn = new mysqli("localhost","root","","sahitya_db");
     ```

3. **Start XAMPP Services**
   - Start Apache
   - Start MySQL

4. **Access Application**
   - Navigate to: `http://localhost/Sahitya_Sangam2/`

5. **Python Environment** (Optional)
   ```powershell
   # Activate virtual environment
   .\.venv\Scripts\Activate.ps1
   
   # Install dependencies if needed
   pip install -r requirements.txt
   ```

## Email Configuration

PHPMailer is configured in `includes/process/contact_process.php`:

```php
$mail->Host = 'smtp.gmail.com';
$mail->Username = 'your-email@gmail.com';
$mail->Password = 'your-app-password';
```

**Note**: Use [Gmail App Passwords](https://support.google.com/accounts/answer/185833) for secure authentication.

## File Organization

### Main Pages
All user-facing pages are in the root directory for easy access.

### Includes Directory
- **config/**: Database and application configuration
- **auth/**: User authentication handlers
- **order/**: Order processing logic
- **process/**: Form processors and utilities

### Vendor Directory
Third-party libraries follow PSR-4 standards:
- PHPMailer for email functionality

### Assets Directory
Ready for:
- Custom CSS stylesheets
- JavaScript files
- Image uploads and static images

## Security Considerations

⚠️ **Important Security Notes**:

1. **Database Configuration**: The `includes/config/db.php` is gitignored to protect credentials
2. **SQL Injection**: Consider using prepared statements instead of direct queries
3. **Password Storage**: Using `password_hash()` for secure password storage ✓
4. **Session Security**: Sessions are properly initialized with `session_start()`
5. **Email Credentials**: Keep PHPMailer credentials secure (use environment variables)

## Development Workflow

```powershell
# Start development
cd C:\xampp\htdocs\Sahitya_Sangam2

# Activate Python environment (if needed)
.\.venv\Scripts\Activate.ps1

# Start XAMPP services via Control Panel
# - Apache
# - MySQL

# Access in browser
# http://localhost/Sahitya_Sangam2/
```

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
3. Test thoroughly
4. Submit a pull request

## Database Schema

### Users Table
```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255)
);
```

### Orders Table
```sql
CREATE TABLE orders (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    total_amount DECIMAL(10,2),
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### Order Items Table
```sql
CREATE TABLE order_items (
    id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT,
    book_id INT,
    quantity INT,
    FOREIGN KEY (order_id) REFERENCES orders(id)
);
```

## Troubleshooting

### Common Issues

1. **Database Connection Failed**
   - Check XAMPP MySQL is running
   - Verify credentials in `includes/config/db.php`

2. **Email Not Sending**
   - Verify SMTP credentials in `includes/process/contact_process.php`
   - Check Gmail App Password is correct
   - Ensure `allow_url_fopen` is enabled in php.ini

3. **404 Errors on Form Submission**
   - Verify file paths are correct
   - Check that includes directory structure matches README

4. **Session Not Working**
   - Ensure `session_start()` is called before any output
   - Check session directory permissions

## License

This project is created for educational purposes.

## Contact

For queries, use the contact form at `/contact.php`

---

**Last Updated**: March 2026  
**Version**: 2.0 (Restructured)
