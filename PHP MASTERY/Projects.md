Here are **15 powerful things you can build with raw PHP** (without frameworks), expanding far beyond basic forms:

---

### **1. User Authentication System**
```php
// login.php
session_start();
if ($_POST['password'] === $storedHash) {
    $_SESSION['authenticated'] = true;
    header('Location: dashboard.php');
}
```
**Build**: Secure login/logout with password hashing (`password_hash()`)

---

### **2. CRUD Application with MySQL**
```php
// create.php
$stmt = $pdo->prepare("INSERT INTO products (name) VALUES (?)");
$stmt->execute([$_POST['product_name']]);
```
**Build**: Full inventory system with Create, Read, Update, Delete operations.

---

### **3. RESTful API**
```php
header('Content-Type: application/json');
echo json_encode(['data' => $results]);
```
**Build**: API endpoints for mobile apps using `$_SERVER['REQUEST_METHOD']`.

---

### **4. File Upload Manager**
```php
move_uploaded_file($_FILES['file']['tmp_name'], "uploads/".$newFilename);
```
**Build**: Image gallery with validation (size/type checks).

---

### **5. Web Scraper**
```php
$html = file_get_contents('https://example.com');
preg_match_all('/<h2>(.*?)<\/h2>/', $html, $matches);
```
**Build**: Price comparison tool scraping e-commerce sites.

---

### **6. PDF Generator**
```php
require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->Write(10, 'Hello World!');
$pdf->Output();
```
**Build**: Invoice generation system.

---

### **7. Email Newsletter System**
```php
mail($to, "Subject", $message, "From: newsletter@yoursite.com");
```
**Build**: Bulk email sender with CSV import.

---

### **8. Real-Time Chat (Polling)**
```php
// chat.php
file_put_contents('chatlog.txt', $_POST['msg']."\n", FILE_APPEND);
echo file_get_contents('chatlog.txt');
```
**Build**: Simple chat using AJAX polling.

---

### **9. Payment Gateway Integration**
```php
// payment.php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://payment-api.com/charge");
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($paymentData));
```
**Build**: PayPal/Stripe-like checkout.

---

### **10. Data Visualization**
```php
// stats.php
header('Content-Type: image/png');
$chart = imagecreate(400, 300);
imagepng($chart);
```
**Build**: Dynamic charts using GD Library.

---

### **11. Command-Line Tools**
```php
// cli.php
if (php_sapi_name() === 'cli') {
    fwrite(STDOUT, "Enter your name: ");
    $name = trim(fgets(STDIN));
}
```
**Build**: CSV import/export scripts.

---

### **12. WebSocket Server**
```php
// websocket.php
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_bind($socket, '0.0.0.0', 8080);
```
**Build**: Real-time dashboard (requires `ext-sockets`).

---

### **13. CMS (Content Management)**
```php
// admin.php
file_put_contents("pages/{$_POST['page']}.html", $_POST['content']);
```
**Build**: Basic page editor with file-based storage.

---

### **14. XML/JSON Data Processor**
```php
$xml = simplexml_load_file('data.xml');
foreach ($xml->product as $node) {
    echo $node->name;
}
```
**Build**: Import/export tool for Excel data.

---

### **15. Authentication Middleware**
```php
// auth_check.php
if (!isset($_SESSION['user'])) {
    die('Access denied');
}
```
**Build**: Role-based access control system.

---

### **Pro Tips for Raw PHP Development**:
1. **Security Essentials**:
   ```php
   // Always sanitize:
   $clean = filter_var($_POST['input'], FILTER_SANITIZE_STRING);
   // Always escape DB queries:
   $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
   ```

2. **Structure Your Code**:
   ```
   /project
     /includes
       - db.php
       - auth.php
     /public
       - index.php
   ```

3. **Performance Tricks**:
   ```php
   // Cache database results:
   $cacheFile = 'cache/products.cache';
   if (file_exists($cacheFile) && time()-filemtime($cacheFile) < 3600) {
       return unserialize(file_get_contents($cacheFile));
   }
   ```

4. **Modern PHP Features**:
   ```php
   // Type hints:
   function calculateTotal(float $price, int $qty): float {
       return $price * $qty;
   }
   ```

Raw PHP gives you **complete control** - perfect for learning core web concepts or building lightweight applications. The only limit is your imagination! 🚀

Want me to dive deeper into any of these? Just ask!
