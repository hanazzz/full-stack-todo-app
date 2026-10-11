<?php

session_start();

// Connect to the database
require __DIR__ . '/../config/db.php';

// Get the text from the form input
// Ignore white space
// If there isn't any input, then it's an empty string
$new_task_title = trim($_POST['task_title'] ?? '');

// Only insert task if the input is not empty
if ($new_task_title !== '') {
    // Escape the text to make it safe for SQL
    $escaped_title = mysqli_real_escape_string($mysqli, $new_task_title);

    // Get user id from session, escape the text
    $escaped_user_id = mysqli_real_escape_string($mysqli, $user_id);

    // Insert the new task into the database, include user id
    mysqli_query($mysqli, "INSERT INTO tasks (title, user_id) VALUES ('$escaped_title', '$escaped_user_id')");
}

// Redirect back to index.php so the new task shows
header('Location: ../public/index.php');

// Stop executing script
exit;

?>