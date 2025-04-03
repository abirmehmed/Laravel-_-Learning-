# **🔥 LESSON 1: LARAVEL INSTALLATION – `COMPOSER CREATE-PROJECT` OR DIE**  
*(Your baptism by fire into the Laravel universe.)*  

---

## **💀 WHY THIS LESSON MATTERS**  
Before you can **summon the power** of Laravel, you must **install it correctly**.  
Fail here, and you’ll face:  
- **Broken dependencies**  
- **Permission errors**  
- **The dreaded "Class not found"**  

This lesson **ensures your first Laravel app survives birth**.  

---

## **⚡ PREREQUISITES (OR YOU WILL SUFFER)**  
1. **PHP 8.2+** (Lower versions = **DOOM**)  
   ```bash
   php -v  # Must say 8.2.x or higher
   ```
2. **Composer** (Laravel’s lifeline)  
   ```bash
   composer -v  # Must show version
   ```
3. **A Terminal** (Windows? Use **Git Bash** or **WSL**)  

---

## **🔥 STEP 1: INSTALL LARAVEL (THE RIGHT WAY)**  

### **Option A: The Classic Way (For Warriors)**  
```bash
composer create-project laravel/laravel hellscape
cd hellscape
php artisan serve
```  
✅ **Pros:** Pure, unadulterated Laravel.  
❌ **Cons:** Slower (downloads everything fresh).  

### **Option B: The Laravel Installer (For Speed Demons)**  
1. **Install the global Laravel installer:**  
   ```bash
   composer global require laravel/installer
   ```
2. **Create a new project:**  
   ```bash
   laravel new hellscape
   cd hellscape
   php artisan serve
   ```  
✅ **Pros:** Faster, cleaner.  
❌ **Cons:** Requires global Composer access.  

---

## **💥 WHAT JUST HAPPENED?**  
1. **`composer create-project`**  
   - Downloads Laravel + **all dependencies** (vendor folder).  
   - Sets up **autoloading** (PSR-4).  

2. **`php artisan serve`**  
   - Starts a **local dev server** at `http://127.0.0.1:8000`.  
   - **Do NOT use this in production** (Use Nginx/Apache instead).  

---

## **☠️ COMMON INSTALLATION FAILURES (AND HOW TO FIX THEM)**  

| Error | Cause | Solution |
|-------|-------|----------|
| **`PHP extension missing`** | Missing `mbstring`, `openssl`, etc. | Install PHP extensions: `sudo apt install php8.2-mbstring` |
| **`Composer not found`** | Composer not in PATH | Reinstall Composer **with PATH checked** |
| **`Permission denied`** | Linux file permissions | Run: `sudo chmod -R 777 storage bootstrap/cache` |
| **`Class not found`** | Autoload broken | Run: `composer dump-autoload` |

---

## **🚀 POST-INSTALLATION RITUALS**  
1. **Secure your `.env` file**  
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
2. **Test the installation**  
   - Visit `http://127.0.0.1:8000` → You should see the **Laravel welcome page**.  
   - Run `php artisan` → Should show **Artisan commands**.  

---

## **🔥 PRO TIPS (FROM A SURVIVOR)**  
1. **Use Laravel Herd (Mac Only)**  
   - One-click PHP + Laravel installer: [https://herd.laravel.com](https://herd.laravel.com)  

2. **Docker Lovers? Use Sail**  
   ```bash
   curl -s "https://laravel.build/hellscape" | bash
   cd hellscape && ./vendor/bin/sail up
   ```  
   (No PHP install needed!)  

3. **Windows Users:**  
   - **Avoid XAMPP** (Use WSL2 or Laragon).  

---

## **🎯 LESSON 1 CHALLENGE**  
1. Install Laravel **without errors**.  
2. Run `php artisan serve` and **see the welcome page**.  
3. **Break something** (Delete `routes/web.php` and see what happens).  

---

### **💀 FINAL WARNING**  
If you **skip this step**, every future lesson **will fail**.  
**Install Laravel. Then proceed.**  

**Welcome to hell, developer.** 🔥🚀
