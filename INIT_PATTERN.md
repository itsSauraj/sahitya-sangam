# 🔧 Centralized Initialization Pattern

## Overview

This project uses a **centralized bootstrap system** through `includes/config/init.php` to provide consistent access to:
- Environment variables
- Database connection
- Session management
- Common helper functions

## Quick Start

### Using init.php in Your Files

```php
<?php
require_once __DIR__ . '/path/to/includes/config/init.php';

// Now you have access to:
// - $conn: Database connection
// - env(): Environment variable helper
// - $_SESSION: Session variables (web only)
// - Helper functions (redirect, sanitize, etc.)
```

### Path Examples

From different locations in your project:

```php
// From root level (index.php, login.php, etc.)
require_once __DIR__ . '/includes/config/init.php';

// From includes/auth/ (loginprocess.php, etc.)
require_once __DIR__ . '/../config/init.php';

// From includes/process/ (contact_process.php, etc.)
require_once __DIR__ . '/../config/init.php';

// From database/ (migrate.php, seed.php)
require_once __DIR__ . '/../includes/config/init.php';
```

## What init.php Provides

### 1. Environment Variables

Access your `.env` configuration anywhere:

```php
$dbHost = env('DB_HOST', 'localhost');
$mailPassword = env('MAIL_PASSWORD');
$appName = env('APP_NAME', 'My App');
```

### 2. Database Connection

Automatically connected and ready to use:

```php
$result = $conn->query("SELECT * FROM users WHERE email = '$email'");
$user = $result->fetch_assoc();
```

### 3. Session Management

Sessions are started automatically (except in CLI mode):

```php
$_SESSION['user_id'] = $userId;
$_SESSION['cart'] = $cartItems;
```

### 4. Helper Functions

#### Redirect Helper
```php
redirect('/login.php');
redirect('../../index.php');
```

#### Success/Error Messages
```php
// Set messages
set_success('Order placed successfully!');
set_error('Invalid credentials.');

// Get and clear messages (typically in view files)
$success = get_success(); // Gets message and clears it
$error = get_error();
```

#### Authentication Helpers
```php
// Check if user is logged in
if (is_logged_in()) {
    echo "Welcome, " . $_SESSION['user_name'];
}

// Require authentication (redirect if not logged in)
require_auth('/login.php');
```

#### Input Sanitization
```php
// Sanitize user input
$cleanName = sanitize($_POST['name']);

// Escape output for safe display
echo "Hello, " . e($username);
```

## File Structure

```
includes/
└── config/
    ├── init.php        # 👈 Main bootstrap file (USE THIS)
    ├── env.php         # Environment loader (auto-loaded by init.php)
    └── db.php          # Database connection (auto-loaded by init.php)
```

## Migration from Old Pattern

### ❌ Old Way (Don't do this)

```php
<?php
session_start();
include "../config/db.php";
require_once __DIR__ . '/../config/env.php';

// Your code...
```

### ✅ New Way (Do this)

```php
<?php
require_once __DIR__ . '/../config/init.php';

// Your code...
// Everything is already loaded!
```

## Benefits

### 🎯 Single Entry Point
- Load everything with one line
- No more multiple includes for env, db, session

### 🔒 Consistent Security
- Session handling is standardized
- Input sanitization functions available everywhere

### 🚀 Easier Maintenance
- Change database logic in one place
- Update environment loading in one place
- Add new global functions in one place

### 📱 CLI-Friendly
- Automatically detects CLI mode
- Skips session management for command-line scripts
- Perfect for migrations and seeders

## Common Use Cases

### Authentication Script

```php
<?php
require_once __DIR__ . '/../config/init.php';

$email = sanitize($_POST['email']);
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        set_success('Login successful!');
        redirect('/index.php');
    }
}

set_error('Invalid credentials.');
redirect('/login.php');
```

### Form Processing

```php
<?php
require_once __DIR__ . '/../config/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    
    // Validate
    if (empty($name) || empty($email)) {
        set_error('All fields are required.');
        redirect('/contact.php');
    }
    
    // Process...
    $stmt = $conn->prepare("INSERT INTO contacts (name, email) VALUES (?, ?)");
    $stmt->bind_param('ss', $name, $email);
    
    if ($stmt->execute()) {
        set_success('Message sent successfully!');
    } else {
        set_error('Failed to send message.');
    }
    
    redirect('/contact.php');
}
```

### Protected Page

```php
<?php
require_once __DIR__ . '/includes/config/init.php';

// Require authentication
require_auth('/login.php');

// User is logged in, show protected content
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - <?= e(env('APP_NAME')) ?></title>
</head>
<body>
    <h1>Welcome, <?= e($_SESSION['user_name']) ?>!</h1>
    
    <?php if ($msg = get_success()): ?>
        <div class="success"><?= e($msg) ?></div>
    <?php endif; ?>
    
    <?php if ($msg = get_error()): ?>
        <div class="error"><?= e($msg) ?></div>
    <?php endif; ?>
</body>
</html>
```

## Troubleshooting

### "Call to undefined function env()"

You haven't loaded init.php. Add:
```php
require_once __DIR__ . '/path/to/includes/config/init.php';
```

### "Cannot modify header information"

Sessions or output have already been sent. Make sure:
1. `init.php` is loaded at the very top
2. No output (echo, HTML) before redirects
3. No whitespace before `<?php`

### Database connection not available

Make sure `.env` file exists and contains:
```env
DB_HOST=localhost
DB_USERNAME=root
DB_PASSWORD=your_password
DB_DATABASE=sahitya_db
```

## Advanced: Extending init.php

You can add your own helper functions to `init.php`:

```php
/**
 * Format price for display
 */
function format_price($amount) {
    return '₹' . number_format($amount, 2);
}

/**
 * Get current user
 */
function current_user() {
    if (!is_logged_in()) {
        return null;
    }
    
    global $conn;
    $userId = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}
```

## See Also

- [Environment Setup Guide](ENV_SETUP.md) - Configure .env file
- [Database Migrations](database/MIGRATIONS.md) - Database version control
- [README.md](README.md) - Project overview

---

**Remember**: Always use `init.php` at the top of every PHP script. It's your one-stop bootstrap! 🚀
