<!-- Handles logic for periodically clearing all task and user data -->

<?php

/**
 * Clears task and user data from db every 7 days
 *
 * @param object $mysqli Object representing MySQL server connection
 * 
 */
function cleanDB($mysqli) {

    // Define time interval in seconds for how often cleaning should occur (7 days)
    $cleaning_interval = 7 * 24 * 60 * 60;

    $last_clean = 0;
    $setting_key = "last_cleanup";

    // Get last cleanup time from db
    // Prepare statement
    $sql = "SELECT setting_value FROM site_settings WHERE setting_key = ?";
    $stmt = $mysqli->prepare($sql);
    // Bind variable (setting key) to statement as parameter
    $stmt->bind_param('s', $setting_key);
    // Execute statement and get results from search
    $stmt->execute();
    $result = $stmt->get_result();

    // Check that query was successful and get last cleanup time from results
    if ($result && $row = $result->fetch_assoc()) {
        // Convert last cleanup date to integer (from string)
        $last_clean = (int)$row['setting_value'];
    }

    // Get current time
    $current_time = time();

    // Check if the specified time interval has passed
    if (($current_time - $last_clean) > $cleaning_interval) {
        // Update last cleaned date to be the current time
        // Convert current time to string
        $current_time = (string)$current_time;
        // Prepare statement
        $sql = "UPDATE site_settings SET setting_value = ? WHERE setting_key = ?";
        $stmt = $mysqli->prepare($sql);
        // Bind variable (setting value and setting key) to statement as parameter
        $stmt->bind_param('ss', $current_time, $setting_key);
        // Execute statement to update table
        $stmt->execute();

        // Dump all task and user data
        $truncate_tasks_sql = "TRUNCATE TABLE tasks";
        $truncate_users_sql = "TRUNCATE TABLE users";
        $mysqli->query($truncate_tasks_sql);
        $mysqli->query($truncate_users_sql);

    }
}



?>