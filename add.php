<?php

// Connect to the database
require __DIR__ . '/db.php';

// Get the text from the form input
// Ignore white space
// If there isn't any input, then it's an empty string
$new_task_title = trim($_POST['task_title'] ?? '');

// Only insert task if the input is not empty
if ($new_task_title !== '') {
    // Escape the text to make it safe for SQL
    $escaped_title = mysqli_real_escape_string($mysqli, $new_task_title);

    // Insert the new task into the database
    mysqli_query($mysqli, "INSERT INTO tasks (title) VALUES ('$escaped_title')");
}

// Redirect back to index.php so the new task shows
header('Location: index.php');

// Stop executing script
exit;

?>