<!-- Handles logic for finding and adding users in database -->

<?php

/**
 * Looks for a given user ID in database
 *
 * @param string $user_id The ID of the target user.
 * @param object $mysqli Object representing MySQL server connection
 * 
 * @return int Returns number of rows found in database that match user ID.
 */
function findUser($user_id, $mysqli) {
    // Look for user in db

    // Prepare statement
    $sql = "SELECT count(*) FROM users WHERE user_ID = ?";
    $stmt = $mysqli->prepare($sql);
    // Bind variables to the prepared statement as paramters
    $stmt->bind_param('s', $user_id);
    // Execute statement to perform search
    $stmt->execute();
    // Store result from query to $found variable (which will have the number of rows found)
    $stmt->bind_result($found);
    // Fetch result from prepared statement
    $stmt->fetch();

    $stmt->free_result();

    return $found;
};


/**
 * Creates a new user in database
 *
 * @param string $userId The ID of the target user.
 * @param object $mysqli_connect Object retpresenting MySQL server connection
 * 
 */
function createUser($user_id, $mysqli) {
    // Prepare statement
    $sql = "INSERT INTO users (user_id) VALUES (?)";
    $stmt = $mysqli->prepare($sql);
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param('s', $user_id);
    // Execute statement to insert new user row into table
    $stmt->execute();
};


 ?>