<?php

// Connect to the database
require __DIR__ . '/db.php';

// Delete all tasks from database and UI
mysqli_query($mysqli, "DELETE FROM tasks");

// Redirect back to index.php so the new task shows
header('Location: index.php');

// Stop executing script
exit;

?>