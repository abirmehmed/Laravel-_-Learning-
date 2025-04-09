<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Auth System'; ?></title>
    <link rel="stylesheet" href="<?php echo isset($base_url) ? $base_url : ''; ?>assets/style.css">
    <link rel="icon" href="<?php echo isset($base_url) ? $base_url : ''; ?>assets/favicon.ico">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Authentication System'; ?></h1>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <nav class="main-nav">
                    <a href="dashboard.php" class="nav-link">Dashboard</a>
                    <a href="logout.php" class="nav-link">Logout</a>
                </nav>
            <?php else: ?>
                <nav class="main-nav">
                    <a href="login.php" class="nav-link">Login</a>
                    <a href="register.php" class="nav-link">Register</a>
                </nav>
            <?php endif; ?>
        </header>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['message_type']; ?>">
                <?php 
                echo htmlspecialchars($_SESSION['message']); 
                unset($_SESSION['message']);
                unset($_SESSION['message_type']);
                ?>
            </div>
        <?php endif; ?>

        <main class="main-content">