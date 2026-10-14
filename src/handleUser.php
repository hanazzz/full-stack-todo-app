<?php

/**
 * Looks for a given user ID in database
 *
 * @param string $userId The ID of the target user.
 * @param object $mysqli_connect Object retpresenting MySQL server connection
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


// ORIGINAL CODE - FOR REFERENCE ONLY
// // Check if user has existing user ID stored in session. 
// // If yes, then search for user ID in database. If no, set an.
// if (isset($_SESSION['user_id'])) {
//     echo "Welcome back! Your user id is " . $_SESSION['user_id'] . "<br>"; // FOR TESTING ONLY

//     $user_id = $_SESSION['user_id'];

//     // Look for user in db

//     // Prepare statement
//     $sql = "SELECT count(*) FROM users WHERE user_ID = ?";
//     $stmt = $mysqli->prepare($sql);
//     // Bind variables to the prepared statement as paramters
//     $stmt->bind_param('s', $user_id);
//     // Execute statement to perform search
//     $stmt->execute();
//     // Store result from query to $found variable (which will have the number of rows found)
//     $stmt->bind_result($found);
//     // Fetch result from prepared statement
//     $stmt->fetch();

//     $stmt->free_result();


//     // If user exists in database
//     if ($found) {
//         echo 'found in db'; // FOR TESTING ONLY
//     } else {
//         echo 'not found in db'; // FOR TESTING ONLY
//         // If user not in database, create them

//         // Prepare statement
//         $sql = "INSERT INTO users (user_id) VALUES (?)";
//         $stmt = $mysqli->prepare($sql);
//         // Bind variables to the prepared statement as paramters
//         $stmt->bind_param('s', $user_id);
//         // Execute statement to insert rows into table
//         $stmt->execute();
//         // Store result from query to $found variable (which will have the number of rows found)
//         $stmt->bind_result($found);
//         // Fetch result from prepared statement
//         $stmt->fetch();

//         $stmt->free_result();
//     }
// } else {
//     // If user does not have an existing user ID stored in session
//     echo "Welcome new user!"; // FOR TESTING ONLY
//     // Store session ID as user ID
//     $_SESSION['user_id'] = session_id();
//     $user_id = $_SESSION['user_id'];

//     echo "Your user id is " . $_SESSION['user_id']; // FOR TESTING ONLY
//     // Create user in database
//     // Prepare statement
//     $sql = "INSERT INTO users (user_id) VALUES (?)";
//     $stmt = $mysqli->prepare($sql);
//     // Bind variables to the prepared statement as paramters
//     $stmt->bind_param('s', $user_id);
//     // Execute statement to insert rows into table
//     $stmt->execute();
// }

// ?>