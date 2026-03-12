<?php
/**
 * Database Connection
 * Uses environment variables from .env file
 */

// Load environment variables
require_once __DIR__ . '/env.php';

// Get database credentials from environment
$db_host = env('DB_HOST', 'localhost');
$db_username = env('DB_USERNAME', 'root');
$db_password = env('DB_PASSWORD', '');
$db_database = env('DB_DATABASE', 'sahitya_db');

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_database);

// Check connection
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to UTF-8
$conn->set_charset("utf8mb4");
?>