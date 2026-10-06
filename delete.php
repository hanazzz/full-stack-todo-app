<?php

// Connect to the database
require __DIR__ . '/db.php';

// Get task ID from the hidden input
$task_id = (int)($_POST['id'] ?? 0);

// If valid ID, then delete the task
if ($task_id > 0) {
    mysqli_query($mysqli, "DELETE FROM tasks WHERE id = $task_id");
}

// Redirect back to index.php so the new task shows
header('Location: index.php');

// Stop executing script
exit;

?>