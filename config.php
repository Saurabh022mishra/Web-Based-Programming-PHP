<?php
// ============================================================
//  Database Configuration
// ============================================================
define('DB_HOST',     'localhost');
define('DB_USER',     'root');        // ← change to your MySQL user
define('DB_PASS',     '');            // ← change to your MySQL password
define('DB_NAME',     'auth_system');
define('DB_CHARSET',  'utf8mb4');

// ============================================================
//  Connect & bootstrap the schema
// ============================================================
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);

if ($conn->connect_error) {
    die(json_encode([
        'status'  => 'error',
        'message' => '❌ Database Connection Failed: ' . $conn->connect_error
    ]));
}

// Create database if it does not exist
$conn->query("CREATE DATABASE IF NOT EXISTS `" . DB_NAME . "` CHARACTER SET " . DB_CHARSET);
$conn->select_db(DB_NAME);

// Create users table
$conn->query("
    CREATE TABLE IF NOT EXISTS `users` (
        `id`         INT(11)      NOT NULL AUTO_INCREMENT,
        `username`   VARCHAR(50)  NOT NULL UNIQUE,
        `email`      VARCHAR(100) NOT NULL UNIQUE,
        `password`   VARCHAR(255) NOT NULL,
        `created_at` DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=" . DB_CHARSET
);

session_start();

// ============================================================
//  Helper: redirect
// ============================================================
function redirect(string $page): void {
    header("Location: $page");
    exit;
}
