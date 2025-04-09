<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Include required files
require __DIR__ . '/includes/config.php';
require __DIR__ . '/includes/auth.php';
require __DIR__ . '/includes/functions.php';

// Redirect if not logged in
if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}

// Get user data from database
try {
    $stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
    
    if (!$user) {
        session_destroy();
        header('Location: login.php');
        exit;
    }
    
    // Create greeting using username
    $greeting = "Hello " . htmlspecialchars($user['username']) . "!";

} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

$page_title = 'User Dashboard';
require __DIR__ . '/partials/header.php';
?>

<div class="dashboard-container">
    <div class="welcome-message">
        <h1><?= $greeting ?></h1>
        <p class="welcome-text">Welcome to your personal dashboard</p>
        
        <div class="user-info">
            <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
        </div>
    </div>
    
    <div class="dashboard-actions">
        <!-- Removed profile.php link - only keeping logout -->
        <a href="logout.php" class="btn btn-logout">Logout</a>
    </div>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>