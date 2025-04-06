# **Step-by-Step: User Authentication System in Pure PHP**

This guide will walk you through creating a **secure login/logout system** with password hashing (`password_hash()`) using **pure PHP** (no frameworks).  

---

## **📌 Features**
✅ **User Registration** (with password hashing)  
✅ **Secure Login & Logout** (with sessions)  
✅ **Password Reset** (optional, via email)  
✅ **Protected Pages** (middleware for auth checks)  
✅ **Basic Security** (XSS/CSRF protection)  

---

# **🚀 Step 1: Project Setup**
### **Folder Structure**
```
/auth-system/
│── /assets/
│   └── style.css
│── /includes/
│   ├── config.php      (DB connection)
│   ├── auth.php        (Auth functions)
│   └── functions.php   (Helpers)
│── /partials/
│   ├── header.php
│   ├── footer.php
│   └── nav.php
│── register.php
│── login.php
│── dashboard.php
│── logout.php
│── index.php
```

---

# **🔐 Step 2: Database Setup**
### **1. Create a MySQL Database**
```sql
CREATE DATABASE auth_system;
USE auth_system;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

### **2. `config.php` (Database Connection)**
```php
<?php
$host = 'localhost';
$db   = 'auth_system';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
```

---

# **👤 Step 3: User Registration**
### **1. `register.php`**
```php
<?php
require 'includes/config.php';
require 'includes/auth.php';

if (is_logged_in()) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required!";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Check if user exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetch()) {
            $error = "Username or Email already exists!";
        } else {
            // Hash password & insert user
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$username, $email, $hashed_password]);
            header('Location: login.php?registered=1');
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>
    <div class="container">
        <h1>Register</h1>
        <?php if (isset($error)): ?>
            <div class="alert error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
    <?php include 'partials/footer.php'; ?>
</body>
</html>
```

---

# **🔑 Step 4: User Login & Sessions**
### **1. `auth.php` (Authentication Functions)**
```php
<?php
session_start();

function is_logged_in() {
    return isset($_SESSION['user_id']);
}

function login($username, $password) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE username = ? LIMIT 1");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        return true;
    }
    return false;
}

function logout() {
    session_unset();
    session_destroy();
    header('Location: login.php');
    exit;
}
?>
```

### **2. `login.php`**
```php
<?php
require 'includes/config.php';
require 'includes/auth.php';

if (is_logged_in()) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $error = "Username and Password are required!";
    } elseif (login($username, $password)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $error = "Invalid credentials!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>
    <div class="container">
        <h1>Login</h1>
        <?php if (isset($_GET['registered'])): ?>
            <div class="alert success">Registration successful! Please login.</div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="alert error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
    <?php include 'partials/footer.php'; ?>
</body>
</html>
```

---

# **🚪 Step 5: Logout & Protected Pages**
### **1. `logout.php`**
```php
<?php
require 'includes/auth.php';
logout();
?>
```

### **2. `dashboard.php` (Protected Page)**
```php
<?php
require 'includes/auth.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT username FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$user = $stmt->fetch();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>
    <div class="container">
        <h1>Welcome, <?= htmlspecialchars($user['username']) ?>!</h1>
        <p>This is your secure dashboard.</p>
        <a href="logout.php" class="btn">Logout</a>
    </div>
    <?php include 'partials/footer.php'; ?>
</body>
</html>
```

---

# **🔒 Step 6: Security Enhancements**
### **1. Prevent Session Hijacking**
```php
// In `auth.php`
session_regenerate_id(true); // Add after successful login
```

### **2. CSRF Protection (Optional)**
```php
// In `auth.php`
function generate_csrf_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// In forms:
<input type="hidden" name="csrf_token" value="<?= generate_csrf_token() ?>">

// On form submission:
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("CSRF token validation failed!");
}
```

---

# **🚀 Final Steps**
1. **Run the app**:
   ```bash
   php -S localhost:8000
   ```
2. **Access in browser**:
   - `http://localhost:8000/register.php` (Register)
   - `http://localhost:8000/login.php` (Login)
   - `http://localhost:8000/dashboard.php` (Protected)

---

# **📌 Key Takeaways**
✅ **Password Hashing** (`password_hash()` & `password_verify()`)  
✅ **Session Management** (`session_start()`, `$_SESSION`)  
✅ **PDO for Secure DB Queries** (Prevents SQL Injection)  
✅ **Basic CSRF Protection** (Optional but recommended)  

This is a **fully functional** authentication system in pure PHP! 🎉  
Want to extend it? Ask about **password reset, role-based access, or email verification**! 🚀
