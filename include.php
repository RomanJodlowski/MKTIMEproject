<?php
# Access session.
session_start();
# Redirect if not logged in.
if (!isset($_SESSION['user_id'])) {
    require('login_tools.php');
    load();
}

echo "<p>Welcome to MK Time Brand, {$_SESSION['first_name']} {$_SESSION['last_name']} </p>";
$page_title = 'home';

# Open database connection.
require('connect_db.php');