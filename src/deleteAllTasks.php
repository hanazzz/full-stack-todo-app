<?php

// Resume session
session_start();

// Connect to the database
require __DIR__ . '/../config/db.php';

// Get user ID
$user_id = $_SESSION['user_id'];

// Delete all of current user's tasks from database and UI
mysqli_query($mysqli, "DELETE FROM tasks WHERE user_id = '$user_id'");

// Redirect back to index.php so the new task shows
header('Location: ../public/index.php');

// Stop executing script
exit;

?>