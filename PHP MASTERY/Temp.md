Here's a step-by-step guide to creating a **small basic PHP project** without any frameworks (pure PHP):

---

### **Step 1: Set Up Your Project**
1. **Create a project folder**:  
   ```bash
   mkdir my-php-project
   cd my-php-project
   ```
2. **Initialize files**:  
   - Create these files inside the folder:
     - `index.php` (main entry point)
     - `functions.php` (optional, for reusable code)
     - `style.css` (optional, for styling)

---

### **Step 2: Write Basic PHP Code**
#### **1. `index.php` (Simple Page with Form)**
```php
<!DOCTYPE html>
<html>
<head>
    <title>My PHP Project</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome to My PHP App</h1>
    
    <!-- Basic Form -->
    <form method="POST" action="process.php">
        <input type="text" name="username" placeholder="Enter your name">
        <button type="submit">Submit</button>
    </form>

    <!-- Display PHP Output -->
    <?php
    include 'functions.php';
    echo greetUser("Guest"); // Example function call
    ?>
</body>
</html>
```

#### **2. `functions.php` (Optional Helper Functions)**
```php
<?php
function greetUser($name) {
    return "<p>Hello, $name!</p>";
}
?>
```

#### **3. `process.php` (Form Handling)**
```php
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    echo "<h2>Hello, $username!</h2>";
} else {
    header("Location: index.php"); // Redirect if accessed directly
}
?>
```

---

### **Step 3: Add Basic Styling (Optional)**
#### **`style.css`**
```css
body {
    font-family: Arial, sans-serif;
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
}
input, button {
    padding: 8px;
    margin: 5px 0;
}
```

---

### **Step 4: Run Your Project**
1. **Using PHP's Built-in Server**:  
   Run this command in your project folder:  
   ```bash
   php -S localhost:8000
   ```
2. **Access in Browser**:  
   Open `http://localhost:8000` in your browser.

---

### **Key Features of This Project**
✅ **Pure PHP** (No framework required)  
✅ **Form Handling** (`process.php` handles POST data)  
✅ **Modular Code** (`functions.php` for reusable logic)  
✅ **Basic Styling** (Optional CSS)  

---

### **Next Steps to Enhance It**
1. **Add a Database**:  
   Use MySQL with `mysqli` or PDO:
   ```php
   $conn = new mysqli("localhost", "user", "password", "database");
   $result = $conn->query("SELECT * FROM users");
   ```
2. **User Authentication**:  
   Store sessions with `session_start()` and `$_SESSION`.
3. **File Uploads**:  
   Use `$_FILES` to handle file uploads.

---

### **Why Start with Pure PHP?**
1. **No Dependencies**: Learn PHP fundamentals first.  
2. **Faster Execution**: No framework overhead.  
3. **Better Understanding**: Core concepts like forms, sessions, and DB interactions become clearer.

---

This is a **minimalist PHP project** to get you started. Expand it by adding more features as you learn! 🚀
