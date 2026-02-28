<?php
require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../config/router.php";

set_time_limit(300);
session_start();

// Define the session timeout duration in seconds
$timeout_duration = 3600; // 1 hour

// Check if the last activity timestamp exists and if it has expired
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    // Session has expired
    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session
    echo "Session has expired. Please log in again.";
    exit;
}

// Update the last activity timestamp to the current time
$_SESSION['LAST_ACTIVITY'] = time();

use App\Core\Router;


Router::dispatch();
