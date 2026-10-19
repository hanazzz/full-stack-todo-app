<!-- Handles logic for toggling task importance -->

<?php

// Connect to the database
require __DIR__ . '/../config/db.php';

// Get task ID from the hidden input
$task_id = (int)($_POST['id'] ?? 0);

// If valid id, then flip the is_important from 0 to 1 or 1 to 0
if($task_id > 0) {
    // Prepare statement
    $sql = "UPDATE tasks SET is_important = IF(is_important=1, 0, 1) WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    // Bind variable (task ID) to statement as parameter
    $stmt->bind_param('i', $task_id);
    // Execute statement to delete task
    $stmt->execute();
}

// Redirect back to index.php so the new task shows on page
header('Location: ../public/index.php');

// Stop executing script
exit;

?>