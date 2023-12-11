<?php # CONNECT TO MySQL DATABASE.
# Connect on 'localhost' for user to database 'site_db'
$link = mysqli_connect('localhost', 'root', '', 'mktime');
if (!$link) {
# Otherwise fail gracefully and explain the error.
    die('Could not connect to MySQL: ' . mysqli_error());
}
$error="";
//echo 'Connection OK';
