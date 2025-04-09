<?php

function redirect($url) {
    header("Location: $url");
    exit();
}

function sanitize_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

function display_error($message) {
    if (!empty($message)) {
        echo '<div class="alert alert-danger">' . sanitize_input($message) . '</div>';
    }
}

function display_success($message) {
    if (!empty($message)) {
        echo '<div class="alert alert-success">' . sanitize_input($message) . '</div>';
    }
}

function is_valid_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function generate_token($length = 32) {
    return bin2hex(random_bytes($length));
}

function current_url() {
    return (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . 
           "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}