<?php

// Connect to the database
require __DIR__ . '/db.php';

// Fetch data from database every time page is reloaded

// Run a query to get all tasks from the database (incomplete tasks first, then newest first)
$task_result__set = mysqli_query(
    $mysqli, 
    "SELECT id, title, is_done FROM tasks ORDER BY is_done, id DESC"
);

// Store all rows of data in a php array for later use
$task_rows = [];
while ($task_row = mysqli_fetch_assoc($task_result__set)) {
    // Convert is_done to integer (from string)
    $task_row['is_done'] = (int)$task_row['is_done'];
    $task_rows[] = $task_row;
}

// Count totals for the To-do Tracker
// Count # of all tasks
$total_task_count = count($task_rows);
// Count # of completed tasks
$completed_task_count = 0;
foreach ($task_rows as $task) {
    if ($task['is_done'] === 1) {
        $completed_task_count++;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/59746a953b.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Full Stack To-Do App</title>
</head>

<body>
    <main>
        <div class="container">
            <!-- To-do Tracker -->
            <div class="todo-tracker">
                <div class="task-tracker-text">
                    <h1>Tasks Completed</h1>
                    <p id="motivational-text">You got this!</p>
                </div>
                <div class="task-counter">
                    <?php echo $completed_task_count ?> <span class="spacer">/</span> <?php echo $total_task_count ?>
                </div>
            </div>

            <!-- Task Input -->
            <form action="add.php" method="POST" class="task-form">
                <input type="text" maxlength="100" name="task_title" class="task-input" placeholder="Your next task is..." required>
                <button type="submit" class="submit-btn">
                    <i class="fa-solid fa-plus fa-2xl"></i>
                </button>
            </form>

            <!-- Task List -->
             <h1>To-do List:</h1>
            <ul class="task-list">

                <!-- Check if task list is empty -->
                <?php if (empty($task_rows)): ?>
                    <!-- If no tasks, prompt user to create task -->
                    <li class="task-item">
                        <div class="li-text">Add a task to get started...</div>
                    </li>
                    
                <!-- If task list has tasks, display all tasks -->
                <?php else: ?>
                    <?php foreach ($task_rows as $task): ?>
                <li class="task-item">
                    <!-- Check if task is done, if it is then add "done" class -->
                    <div class="li-text <?php echo $task['is_done'] ? 'done' : '' ?>">
                        <?php echo $task['title']; ?>
                    </div>

                    <div class="task-icons">
                        <!-- Add logic for check button to cross out completed tasks -->
                        <form action="toggleComplete.php" method="POST" class="inline-form">
                            <!-- Get task ID from database -->
                            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                            <button type="submit" title="Mark task as completed" class="task-btn">
                                <i class="fa-solid fa-circle-check fa-2xl"></i>
                            </button>
                        </form>

                        <!-- Add logic for trash button to delete tasks -->
                        <form action="delete.php" method="POST" class="inline-form">
                            <!-- Get task ID from database -->
                            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                            <button type="submit" title="Delete task" class="task-btn">
                                <i class="fa-solid fa-trash fa-2xl"></i>
                            </button>
                        </form>

                    </div>
                </li>
                <?php endforeach; ?>
            </ul>

            <!-- Clear tasks -->
             <form id="clear-form" action="deleteAll.php" method="POST">
                <button type="submit" class="clear-all-btn">
                    Clear all tasks
                </button>
            </form>

            <?php endif; ?>
        </div>
    </main>

    <script src="app.js"></script>
</body>

</html>