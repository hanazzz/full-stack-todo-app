<?php

/**
 * Retrieves all tasks in database for a given user ID (incomplete tasks first, then newest first)
 *
 * @param string $user_id The ID of the target user.
 * @param object $mysqli_connect Object retpresenting MySQL server connection.
 * 
 * @return array Returns an array of all tasks for the target user.
 */
function findTasks($user_id, $mysqli) {
    // Runs a query to get all tasks from the database belonging to the user ID
    $task_result__set = mysqli_query(
        $mysqli, 
        "SELECT id, title, is_important, is_done FROM tasks WHERE user_id='$user_id' ORDER BY is_done, id DESC"
    );

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