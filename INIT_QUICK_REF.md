# 📋 Quick Reference: Centralized Init Pattern

## ⚡ Quick Start

```php
<?php
require_once __DIR__ . '/includes/config/init.php';
// That's it! Everything is loaded.
```

## 🗂️ File Paths by Location

| Your File Location | Required Path |
|-------------------|---------------|
| Root (index.php) | `__DIR__ . '/includes/config/init.php'` |
| includes/auth/ | `__DIR__ . '/../config/init.php'` |
| includes/process/ | `__DIR__ . '/../config/init.php'` |
| includes/order/ | `__DIR__ . '/../config/init.php'` |
| database/ | `__DIR__ . '/../includes/config/init.php'` |

## 🛠️ Helper Function Cheatsheet

### Environment Variables
```php
env('DB_HOST', 'localhost')     // Get with default
env('MAIL_PASSWORD')            // Get (returns null if not set)
```

### Database
```php
$conn->query("SELECT * FROM users")              // Execute query
$stmt = $conn->prepare("SELECT * FROM users WHERE id = ?")  // Prepared statement
```

### Redirects
```php
redirect('/login.php')          // Redirect and exit
redirect('../../index.php')     // Relative path redirect
```

### Flash Messages
```php
set_success('Saved!')           // Set success message
set_error('Failed!')            // Set error message
get_success()                   // Get & clear success message
get_error()                     // Get & clear error message
```

### Authentication
```php
is_logged_in()                  // Returns true/false
require_auth('/login.php')      // Force login or redirect
$_SESSION['user_id']            // Access session data
```

### Security
```php
sanitize($_POST['name'])        // Clean input (strip tags, trim, XSS)
e($userInput)                   // Escape for HTML output
htmlspecialchars($data)         // Raw escape
```

## 💡 Common Patterns

### Login Handler
```php
<?php
require_once __DIR__ . '/../config/init.php';

$email = sanitize($_POST['email']);
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param('s', $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    set_success('Welcome back!');
    redirect('/index.php');
}

set_error('Invalid credentials');
redirect('/login.php');
```

### Form Processing
```php
<?php
require_once __DIR__ . '/../config/init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name']);
    
    if (empty($name)) {
        set_error('Name is required');
        redirect('/form.php');
    }
    
    $stmt = $conn->prepare("INSERT INTO table (name) VALUES (?)");
    $stmt->bind_param('s', $name);
    
    if ($stmt->execute()) {
        set_success('Data saved!');
    } else {
        set_error('Failed to save');
    }
    
    redirect('/form.php');
}
```

### Protected Page
```php
<?php
require_once __DIR__ . '/includes/config/init.php';
require_auth('/login.php');  // Must be logged in

?>
<!DOCTYPE html>
<html>
<body>
    <h1>Welcome, <?= e($_SESSION['user_name']) ?></h1>
    
    <?php if ($msg = get_success()): ?>
        <div class="success"><?= e($msg) ?></div>
    <?php endif; ?>
</body>
</html>
```

### Email with PHPMailer
```php
<?php
require_once __DIR__ . '/../config/init.php';

use PHPMailer\PHPMailer\PHPMailer;
require '../../vendor/phpmailer/src/PHPMailer.php';

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = env('MAIL_HOST');
$mail->Username = env('MAIL_USERNAME');
$mail->Password = env('MAIL_PASSWORD');
// ... rest of mail config
```

## 🚫 Don't Do This Anymore

```php
// ❌ OLD WAY - Don't use
session_start();
include "../config/db.php";
require_once __DIR__ . '/env.php';

// ✅ NEW WAY - Use this
require_once __DIR__ . '/../config/init.php';
```

## 📖 Full Documentation

- **[INIT_PATTERN.md](INIT_PATTERN.md)** - Complete guide with all details
- **[README.md](README.md)** - Project overview

## ⚙️ What Gets Loaded

When you load `init.php`:

1. ✅ Sessions started (web context only)
2. ✅ Environment variables loaded from `.env`
3. ✅ Database connection established (`$conn`)
4. ✅ 10+ helper functions available
5. ✅ All ready to use!

---

**Remember**: Always load `init.php` at the top of every PHP script! 🚀
