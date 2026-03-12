# Environment Setup Guide

## Quick Setup

### 1. Copy .env.example to .env

```powershell
Copy-Item .env.example .env
```

### 2. Edit .env with your credentials

Open `.env` and update:

```env
# Database Configuration
DB_HOST=localhost
DB_USERNAME=root
DB_PASSWORD=        # Leave empty for XAMPP default
DB_DATABASE=sahitya_db

# Email Configuration (PHPMailer)
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-gmail-app-password
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Sahitya Sangam"
MAIL_ENCRYPTION=tls
```

### 3. How to Get Gmail App Password

1. Go to Google Account: https://myaccount.google.com/
2. Security → 2-Step Verification (must be enabled)
3. Scroll to "App passwords"
4. Select app: "Mail"
5. Select device: "Other" → "Sahitya Sangam"
6. Copy the 16-character password
7. Paste into `.env` as `MAIL_PASSWORD`

## File Structure

```
.env.example        # Template (committed to Git)
.env                # Your actual credentials (NOT in Git)
includes/config/env.php    # Environment loader
```

## Environment Variables

### Database Variables

| Variable | Description | Default |
|----------|-------------|---------|
| `DB_HOST` | MySQL server host | localhost |
| `DB_USERNAME` | Database username | root |
| `DB_PASSWORD` | Database password | (empty) |
| `DB_DATABASE` | Database name | sahitya_db |

### Email Variables

| Variable | Description | Example |
|----------|-------------|---------|
| `MAIL_HOST` | SMTP server | smtp.gmail.com |
| `MAIL_PORT` | SMTP port | 587 |
| `MAIL_USERNAME` | Email address | you@gmail.com |
| `MAIL_PASSWORD` | App password | abcd efgh ijkl mnop |
| `MAIL_FROM_ADDRESS` | Sender email | you@gmail.com |
| `MAIL_FROM_NAME` | Sender name | Sahitya Sangam |
| `MAIL_ENCRYPTION` | Encryption type | tls or ssl |

### Application Variables

| Variable | Description | Values |
|----------|-------------|--------|
| `APP_NAME` | Application name | Sahitya Sangam |
| `APP_ENV` | Environment | local, production |
| `APP_DEBUG` | Debug mode | true, false |
| `APP_URL` | Base URL | http://localhost/... |

## Security

✅ **DO**:
- Keep `.env` file secure and never commit it
- Use `.env.example` as a template
- Use strong passwords
- Use Gmail App Passwords (not your actual Gmail password)
- Rotate credentials regularly

❌ **DON'T**:
- Commit `.env` to Git
- Share `.env` file
- Use plain Gmail password
- Hardcode credentials in PHP files

## Usage in Code

```php
// Load environment variables
require_once __DIR__ . '/includes/config/env.php';

// Get value with default
$host = env('DB_HOST', 'localhost');

// Or use getenv()
$username = getenv('DB_USERNAME');
```

## Troubleshooting

### "Cannot connect to database"
- Check `.env` file exists
- Verify `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`
- Ensure MySQL is running in XAMPP

### "Email not sending"
- Verify `MAIL_USERNAME` and `MAIL_PASSWORD`
- Use Gmail App Password, not regular password
- Check 2-Step Verification is enabled
- Verify `MAIL_PORT` (587 for TLS, 465 for SSL)

### ".env file not found"
- Copy `.env.example` to `.env`
- Place `.env` in project root
- Check file permissions

### "Environment variable not loading"
- Ensure `env.php` is included
- Check `.env` file syntax (KEY=VALUE)
- No spaces around `=` sign
- Values with spaces should be in quotes

## Example .env File

```env
# Database
DB_HOST=localhost
DB_USERNAME=root
DB_PASSWORD=
DB_DATABASE=sahitya_db

# Email
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=sahityasangam@gmail.com
MAIL_PASSWORD="abcd efgh ijkl mnop"
MAIL_FROM_ADDRESS=sahityasangam@gmail.com
MAIL_FROM_NAME="Sahitya Sangam"
MAIL_ENCRYPTION=tls

# App
APP_NAME="Sahitya Sangam"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost/Sahitya_Sangam2
```

## Production Deployment

For production servers:

1. Copy `.env.example` to `.env`
2. Update all credentials with production values
3. Set `APP_ENV=production`
4. Set `APP_DEBUG=false`
5. Update `APP_URL` to production domain
6. Ensure `.env` has restricted permissions (600)
7. Never expose `.env` via web server

```bash
# Set proper permissions (Linux/Mac)
chmod 600 .env
```

---

**Need help?** Check [README.md](README.md) or contact support.
