<!-- Handles logic for retrieving tasks from database -->

<?php

/**
 * Retrieves all tasks in database for a given user ID (incomplete tasks first, then newest first)
 *
 * @param string $user_id The ID of the target user.
 * @param object $mysqli Object representing MySQL server connection.
 * 
 * @return array Returns an array of all tasks for the target user.
 */
function findTasks($user_id, $mysqli) {

    // Runs a query to get all tasks from the database belonging to the user ID

    // Prepare statement
    $sql = "SELECT id, title, is_important, is_done FROM tasks WHERE user_ID = ? ORDER BY is_done, id DESC";
    $stmt = $mysqli->prepare($sql);
    // Bind variable (user ID) to statement as parameter
    $stmt->bind_param('s', $user_id);
    // Execute statement and get results from search
    $stmt->execute();
    $task_result__set = $stmt->get_result();

    // Stores all rows of data in a php array for later use
    $task_rows = [];

    while ($task_row = mysqli_fetch_assoc($task_result__set)) {
        // Converts is_done and is_important to integer (from string)
        $task_row['is_done'] = (int)$task_row['is_done'];
        $task_row['is_important'] = (int)$task_row['is_important'];

        $task_rows[] = $task_row;
    }

    return $task_rows;

}

?>