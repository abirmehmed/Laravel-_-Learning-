<?php
$page_title = 'Welcome';
require 'partials/header.php';
?>

<main class="welcome-container">
    <div class="welcome-card">
        <h1>Welcome to My PHP Project</h1>
        <p class="subtitle">Server is running successfully</p>
        
        <div class="welcome-options">
            <a href="login.php" class="welcome-btn login-btn">
                <span class="btn-icon">→</span>
                <span>Login to Account</span>
            </a>
            
            <a href="register.php" class="welcome-btn register-btn">
                <span class="btn-icon">+</span>
                <span>Create Account</span>
            </a>
        </div>
    </div>
</main>

<?php require 'partials/footer.php'; ?>