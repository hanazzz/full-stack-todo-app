<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'full_stack_todo_app');

// Store database connection
$mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$mysqli) {
    die('Datbase connection failed: ' . mysqli_connect_error());
} else {
    // echo 'Database has been connected :)'; // FOR TESTING ONLY
}

mysqli_set_charset($mysqli, 'utf8mb4');

?>