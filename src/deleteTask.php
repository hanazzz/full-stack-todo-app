<!-- Handles logic for deleting a task -->

<?php

// Connect to the database
require __DIR__ . '/../config/db.php';

// Get task ID from the hidden input
$task_id = (int)($_POST['id'] ?? 0);

// If valid ID, then delete the task
if ($task_id > 0) {
    // Prepare statement
    $sql = "DELETE FROM tasks WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    // Bind variable (task ID) to statement as parameter
    $stmt->bind_param('i', $task_id);
    // Execute statement to delete task
    $stmt->execute();
}

// Redirect back to index.php so the new task shows
header('Location: ../public/index.php');

// Stop executing script
exit;

?>