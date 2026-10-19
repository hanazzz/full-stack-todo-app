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
    // Get user id from session
    $user_id = $_SESSION['user_id'];

    // Insert the new task into the database, include user id
    // Prepare statement
    $sql = "INSERT INTO tasks (title, user_id) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param('ss', $new_task_title, $user_id);
    // Execute statement to insert new user row into table
    $stmt->execute();
}

// Redirect back to index.php so the new task shows
header('Location: ../public/index.php');

// Stop executing script
exit;

?>