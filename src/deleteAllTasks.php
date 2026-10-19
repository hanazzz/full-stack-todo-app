<!-- Handles logic for deleting all tasks -->

<?php

// Resume session
session_start();

// Connect to the database
require __DIR__ . '/../config/db.php';

// Get user ID
$user_id = $_SESSION['user_id'];

// Delete all of current user's tasks from database and UI
// Prepare statement
$sql = "DELETE FROM tasks WHERE user_id = ?";
$stmt = $mysqli->prepare($sql);
// Bind variable (user ID) to statement as parameter
$stmt->bind_param('s', $user_id);
// Execute statement to delete all tasks
$stmt->execute();

// Redirect back to index.php so the new task shows
header('Location: ../public/index.php');

// Stop executing script
exit;

?>