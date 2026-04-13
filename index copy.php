<?php
require_once 'config.php';

// Already logged in → go to dashboard
if (isset($_SESSION['user_id'])) {
    redirect('dashboard.php');
}

// Otherwise send to login
redirect('login.php');
