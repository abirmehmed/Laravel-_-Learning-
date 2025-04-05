# Step-by-Step Guide to Creating a Laravel Project

## Prerequisites
Before you begin, ensure you have:
- PHP (8.0 or higher recommended)
- Composer installed
- A database server (MySQL, PostgreSQL, SQLite, etc.)
- Node.js (for frontend assets)

## Step 1: Install Laravel Installer (Optional but Recommended)
```bash
composer global require laravel/installer
```

## Step 2: Create a New Laravel Project

### Option A: Using Laravel Installer
```bash
laravel new project-name
```

### Option B: Using Composer
```bash
composer create-project laravel/laravel project-name
```

## Step 3: Navigate to Your Project Directory
```bash
cd project-name
```

## Step 4: Configure Environment Variables
1. Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```
2. Generate an application key:
   ```bash
   php artisan key:generate
   ```
3. Open the `.env` file and configure your database connection:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database_name
   DB_USERNAME=your_database_username
   DB_PASSWORD=your_database_password
   ```

## Step 5: Run Database Migrations
```bash
php artisan migrate
```

## Step 6: Install Frontend Dependencies (Optional)
If you want to use Laravel's frontend scaffolding:
```bash
npm install
```

## Step 7: Start the Development Server
```bash
php artisan serve
```
This will start a development server at `http://localhost:8000`

## Step 8: Access Your Application
Open your browser and visit:
```
http://localhost:8000
```

## Additional Useful Commands

### For Development
- Compile frontend assets (Vite):
  ```bash
  npm run dev
  ```
- Watch for frontend changes:
  ```bash
  npm run watch
  ```

### For Production
- Optimize the application:
  ```bash
  php artisan optimize
  ```
- Cache routes and views:
  ```bash
  php artisan route:cache
  php artisan view:cache
  ```

That's it! You now have a fresh Laravel project ready for development. You can start building your application by creating controllers, models, views, and routes as needed.
