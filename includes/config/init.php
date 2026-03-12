<?php
/**
 * Application Bootstrap / Initialization File
 * 
 * This is the central initialization file that:
 * - Starts PHP session (unless running in CLI mode)
 * - Loads environment variables (.env)
 * - Establishes database connection
 * - Provides common helper functions
 * 
 * Usage in any PHP file:
 *   require_once __DIR__ . '/relative/path/to/includes/config/init.php';
 * 
 * After including this file, you'll have access to:
 * - $conn - Database connection object
 * - env() - Environment variable helper function
 * - Session variables ($_SESSION) - only in web context
 */

// Start session if not already started AND not running in CLI mode
if (php_sapi_name() !== 'cli' && session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load environment variables
require_once __DIR__ . '/env.php';

// Establish database connection
require_once __DIR__ . '/db.php';

/**
 * Custom helper functions
 */

/**
 * Redirect helper
 * @param string $url - URL to redirect to
 */
function redirect($url) {
    header("Location: $url");
    exit();
}

/**
 * Set success message in session
 * @param string $message
 */
function set_success($message) {
    $_SESSION['success'] = $message;
}

/**
 * Set error message in session
 * @param string $message
 */
function set_error($message) {
    $_SESSION['error'] = $message;
}

/**
 * Get and clear success message
 * @return string|null
 */
function get_success() {
    if (isset($_SESSION['success'])) {
        $msg = $_SESSION['success'];
        unset($_SESSION['success']);
        return $msg;
    }
    return null;
}

/**
 * Get and clear error message
 * @return string|null
 */
function get_error() {
    if (isset($_SESSION['error'])) {
        $msg = $_SESSION['error'];
        unset($_SESSION['error']);
        return $msg;
    }
    return null;
}

/**
 * Check if user is logged in
 * @return bool
 */
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

/**
 * Require authentication (redirect if not logged in)
 * @param string $redirect_url - URL to redirect to if not logged in
 */
function require_auth($redirect_url = '/login.php') {
    if (!is_logged_in()) {
        redirect($redirect_url);
    }
}

/**
 * Sanitize input to prevent XSS
 * @param string $data
 * @return string
 */
function sanitize($data) {
    return htmlspecialchars(strip_tags(trim($data)), ENT_QUOTES, 'UTF-8');
}

/**
 * Escape output for safe display
 * @param string $string
 * @return string
 */
function e($string) {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}
