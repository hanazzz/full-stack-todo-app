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
    <!-- daisyUI CDN -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <style type="text/tailwindcss">
      @theme {
        /* Variable for headline font */
        --font-headline: "JetBrains Mono", monospace;;
        /* Variable for body font */
        --font-body: "Inter", sans-serif;
      }
    </style>
    <link rel="stylesheet" href="style.css">
    <title>Full Stack To-Do App</title>
</head>

<body>
    <main>
        <div class="container max-w-xl my-8 mx-auto px-4">
            <!-- To-do Tracker -->
            <div class="flex items-center justify-center">
                <div class="stats border border-gray-400 w-90 sm:w-lg">
                    <div class="stat place-items-center">
                        <div class="stat-title"><h1 class="text-2xl sm:text-4xl font-bold">Tasks Completed</h1></div>
                        <div class="stat-value text-primary font-headline">
                            <?php echo $completed_task_count ?> <span class="px-1">/</span> <?php echo $total_task_count ?>
                        </div>
                        <div id="motivational-text" class="stat-desc italic text-wrap pt-2 tracking-wider text-base">You got this!</div>
                    </div>
                </div>
            </div>

            <!-- Task Input -->
            <div class="flex items-center justify-center">
                <form action="add.php" method="POST">
                    <div class="w-2xs sm:w-xl my-8 mx-auto join">
                        <div class="w-full sm:w-lg">
                            <label class="w-full input focus:bg-base-200 join-item">
                            <input type="text" maxlength="100" name="task_title" class="" placeholder="Your next task is..." required>
                            </label>
                            <!-- <div class="validator-hint hidden">Please enter a task!</div> -->
                        </div>
                        <button type="submit" class="btn btn-primary join-item">
                            <i class="fa-solid fa-plus fa-2xl"></i>
                        </button>
                    </div>
                </form>
            </div>



            <!-- Task List -->
            <h1 class="text-xl font-bold p-2 mb-2">To-do List:</h1>
            <ul class="list my-4">

                <!-- Check if task list is empty -->
                <?php if (empty($task_rows)): ?>
                    <!-- If no tasks, prompt user to create task -->
                    <li class="list-row">
                        <div class="">Add a task to get started...</div>
                    </li>
                    
                <!-- If task list has tasks, display all tasks -->
                <?php else: ?>
                    <?php foreach ($task_rows as $task): ?>
                <li class="list-row py-2 rounded-none border-b border-gray-200 first:border-t">
                    <!-- Task title -->
                    <!-- Check if task is done, if it is then style accordingly -->
                    <div class="list-col-grow content-center <?php echo $task['is_done'] ? 'line-through opacity-60' : '' ?>">
                        <?php echo $task['title']; ?>
                    </div>

                    <!-- Check button -->
                    <div class="">
                        <!-- Add logic for check button to cross out completed tasks -->
                        <form action="toggleComplete.php" method="POST" class="">
                            <!-- Get task ID from database -->
                            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                            <button type="submit" title="Mark task as completed" class="btn btn-outline border-none btn-square btn-success">
                                <i class="fa-solid fa-circle-check fa-xl"></i>
                            </button>
                        </form>
                    </div>

                    <!-- Trash button -->
                    <div class="">
                        <!-- Add logic for trash button to delete tasks -->
                        <form action="delete.php" method="POST" class="">
                            <!-- Get task ID from database -->
                            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                            <button type="submit" title="Delete task" class="btn btn-outline border-none btn-square btn-error ">
                                <i class="fa-solid fa-trash fa-xl"></i>
                            </button>
                        </form>
                    </div>

                </li>
                <?php endforeach; ?>
            </ul>

            <!-- Clear tasks -->
             <div class="flex items-center justify-center">
                <form id="clear-form" action="deleteAll.php" method="POST">
                    <button type="submit" class="btn btn-error mt-4 mb-2 sm:my-8">
                        Clear all tasks
                    </button>
                </form>
            </div

            <?php endif; ?>
        </div>
    </main>

    <script src="app.js"></script>
</body>

</html>