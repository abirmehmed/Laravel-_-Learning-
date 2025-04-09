</main>

<footer class="footer">
    <p class="text-center">
        &copy; <?php echo date('Y'); ?> Your Website Name. All rights reserved.
        <?php if (isset($_SESSION['user_id']) && isset($_SESSION['username'])): ?>
            | Logged in as: <?php echo htmlspecialchars($_SESSION['username']); ?>
        <?php endif; ?>
    </p>
</footer>
</div> <!-- Close container div -->

<script>
// Simple JavaScript for form validation and UX enhancements
document.addEventListener('DOMContentLoaded', function() {
    // Add active class to current page link
    const currentPage = location.pathname.split('/').pop();
    document.querySelectorAll('.nav-link').forEach(link => {
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        }
    });
    
    // Auto-hide alerts after 5 seconds
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });
});
</script>
</body>
</html>