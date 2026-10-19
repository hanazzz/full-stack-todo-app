<?php

// Start sessions
session_start();

// Connects to the database
require __DIR__ . '/../config/db.php';

require '../src/handleUser.php';
require '../src/findTasks.php';


// Check if user has existing user ID stored in session.
// If yes, then store user ID as variable and search database
if (isset($_SESSION['user_id'])) {
    // Store user ID from session
    $user_id = $_SESSION['user_id'];
    // Search database for user ID
    $found = findUser($user_id, $mysqli);

    // If user is not found in db
    if (!$found) {
        // If user is not found in db
        // Create user in db
        createUser($user_id, $mysqli);
    }
} else {
    // If user does not have an existing user ID stored in session
    // Store session ID as user ID
    $_SESSION['user_id'] = session_id();
    $user_id = $_SESSION['user_id'];
    // Create user in db
    createUser($user_id, $mysqli);
}


// Get user's tasks from database
$task_rows = findTasks($user_id, $mysqli);

// TASK TOTALS FOR TO-DO TRACKER
// Counts # of all tasks
$total_task_count = count($task_rows);
// Counts # of completed tasks
$completed_task_count = 0;
foreach ($task_rows as $task) {
    if ($task['is_done'] === 1) {
        $completed_task_count++;
    }
}
// Calculates % of completed tasks, rounded to a whole number
// Only run calculation if # of completed tasks is 0 (to avoid error)
if ($completed_task_count != 0) {
    $completed_task_percentage = round(($completed_task_count/$total_task_count)*100);    
}

?>


<!DOCTYPE html>
<!-- Select daisuUI theme -->
<html lang="en" data-theme="garden">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/59746a953b.js" crossorigin="anonymous"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    <!-- daisyUI CDN -->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <!-- daisyUI CDN for themes -->
     <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />

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

<body class="flex flex-col h-screen">
    
    <main class="grow">
        <!-- Theme Controller -->
        <div class="fixed top-2 right-2 z-99">
            <!-- Button to open theme dropdown menu -->
            <button class="btn btn-accent soft btn-circle opacity-80 sm:mr-2 sm:mt-2" popovertarget="popover-theme" style="anchor-name:--anchor-theme">
                <i class="fa-solid fa-lg fa-palette"></i>
            </button>
            <!-- Theme options -->
            <ul class="dropdown dropdown-end menu w-auto rounded-box bg-base-100 shadow-sm mt-1.5"
            popover id="popover-theme" style="position-anchor:--anchor-theme">
                <form id="theme-form">
                    <li>
                    <input
                        type="radio"
                        name="theme-dropdown"
                        class="theme-controller w-full btn btn-sm btn-block btn-ghost justify-start"
                        aria-label="Garden"
                        value="garden" />
                    </li>
                    <li>
                    <input
                        type="radio"
                        name="theme-dropdown"
                        class="theme-controller w-full btn btn-sm btn-block btn-ghost justify-start"
                        aria-label="Light"
                        value="light" />
                    </li>
                    <li>
                    <input
                        type="radio"
                        name="theme-dropdown"
                        class="theme-controller w-full btn btn-sm btn-block btn-ghost justify-start"
                        aria-label="CMYK"
                        value="cmyk" />
                    </li>
                    <li>
                    <input
                        type="radio"
                        name="theme-dropdown"
                        class="theme-controller w-full btn btn-sm btn-block btn-ghost justify-start"
                        aria-label="Dim"
                        value="dim" />
                    </li>
                    <li>
                    <input
                        type="radio"
                        name="theme-dropdown"
                        class="theme-controller w-full btn btn-sm btn-block btn-ghost justify-start"
                        aria-label="Abyss"
                        value="abyss" />
                    </li>
                </form>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="my-4 sm:mt-12 sm:mb-16 mx-auto px-4 md:px-8 lg:px-16 md:grid md:grid-cols-3 gap-12">

            <!-- To-do Tracker -->
            <div class="flex justify-center items-start border-b md:border-b-0 md:border-r border-gray-300">
                <!-- <div class="stats w-90 sm:w-full"> -->
                <div class="stat h-full flex flex-col justify-between place-items-center text-center gap-2 pb-6 sm:pb-10">
                    <!-- Tasks Completed Stats -->
                    <div class="flex flex-col justify-berween place-items-center">
                        <!-- Header -->
                        <div class="stat-title"><h1 class="text-3xl lg:text-4xl font-bold text-wrap">Tasks Completed</h1></div>
                        <!-- Stats -->
                        <div>
                            <!-- Display count of tasks completed -->
                            <div class="stat-value text-primary font-headline mt-2 md:mt-4 md:mb-2">
                                <?php echo $completed_task_count ?> <span class="px-1">/</span> <?php echo $total_task_count ?>
                            </div>
                            <!-- Display percentage of tasks completed using a progress indicator -->
                            <div>
                                <progress class="progress progress-success w-56 md:w-40 lg:w-56" value="<?php echo $completed_task_percentage ?>" max="100"></progress>
                            </div>
                        </div>
                    </div>
                    <!-- Motivational Text -->
                    <div id="motivational-text" class="stat-desc italic text-wrap tracking-wider text-sm md:text-base">You got this!</div>
                </div>
                <!-- </div> -->
            </div>


            <!-- Task Management -->
             <div class="col-span-2 flex flex-col px-2 md:px-4">

                <!-- Task Input -->
                <div class="mx-auto">
                    <form action="../src/addTask.php" method="POST">
                        <div class="w-2xs sm:w-md my-8 mx-auto join">
                            <!-- <div class="w-full sm:w-lg"> -->
                            <label class="w-full input focus:bg-base-200 join-item">
                            <input type="text" maxlength="100" name="task_title" class="" placeholder="Your next task is..." required>
                            </label>
                            <!-- </div> -->
                            <button type="submit" class="btn btn-primary join-item">
                                <i class="fa-solid fa-plus fa-2xl"></i>
                            </button>
                        </div>
                    </form>
                </div>



                <!-- Task List -->
                <div class="sm:my-4">
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

                                <!-- Create <li> element for each task -->
                                <li class="list-row py-2 rounded-none border-b border-gray-300 first:border-t">
                                    
                                    <!-- Flag as important button/indicator -->
                                    <div class="">
                                        <!-- Add logic for flag button to toggle importance -->
                                        <form action="../src/toggleImportance.php" method="POST" class="">
                                            <!-- Get task ID from database -->
                                            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                            <!-- If task is done, fade button -->
                                            <button type="submit" title="Mark task as important" class="btn btn-ghost btn-square btn-warning <?php echo $task['is_done'] ? 'opacity-40' : '' ?>">
                                                <!-- If tasks is flagged as important, then flag button is filled in. If not, then it's unfilled. -->
                                                <i class="<?php echo $task['is_important'] ? 'fa-solid' : 'fa-regular' ?> fa-flag fa-lg"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Task title -->
                                    <!-- If task is done, if it is then fade text and strikethrough -->
                                    <div class="list-col-grow content-center <?php echo $task['is_done'] ? 'line-through opacity-50' : '' ?>">
                                        <?php echo $task['title']; ?>
                                    </div>

                                    <!-- Check button/completion indicator -->
                                    <div class="">
                                        <!-- Add logic for check button to toggle completion status -->
                                        <form action="../src/toggleComplete.php" method="POST" class="">
                                            <!-- Get task ID from database -->
                                            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                            <!-- If task is done, fade button -->
                                            <button type="submit" title="Mark task as completed" class="btn btn-ghost btn-square btn-success  <?php echo $task['is_done'] ? 'opacity-50' : '' ?>">
                                                <!-- If tasks is completed, then check button is filled in. If not, then it's unfilled. -->
                                                <i class="<?php echo $task['is_done'] ? 'fa-solid' : 'fa-regular' ?> fa-circle-check fa-xl"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Trash button -->
                                    <div class="">
                                        <!-- Add logic for trash button to delete tasks -->
                                        <form action="../src/deleteTask.php" method="POST" class="">
                                            <!-- Get task ID from database -->
                                            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                                            <button type="submit" title="Delete task" class="btn btn-ghost btn-square btn-error ">
                                                <i class="fa-solid fa-trash fa-xl"></i>
                                            </button>
                                        </form>
                                    </div>
                                </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Delete all tasks -->
                <div class="flex items-end justify-center">

                    <!-- Delete all button -->
                    <button class="btn btn btn-error mt-6 mb-4 sm:mt-10 sm:mb-8" onclick="my_modal_1.showModal()">
                        Delete all tasks
                    </button>
                    
                    <!-- Delete all modal -->
                    <dialog id="my_modal_1" class="modal">
                    <div class="modal-box">
                        <!-- Confirmation text -->
                        <h3 class="text-lg font-bold">IMPORTANT</h3>
                        <p class="py-4">Are you sure you want to delete ALL tasks?</p>
                        <p class="py-4">This action is irreversible.</p>

                        <!-- Buttons -->
                        <div class="modal-action flex flex-end items-center">
                            <!-- Close modal and don't delete -->
                            <form method="dialog">
                                <!-- if there is a button in form, it will close the modal -->
                                <button class="btn">
                                    Cancel
                                </button>
                            </form>
                            <!-- Confirm Delete all tasks -->
                            <form action="../src/deleteAllTasks.php" method="POST">
                                <button type="submit" class="btn btn-error">
                                    Delete all tasks
                                </button>
                            </form>
                        </div>
                    </div>
                    </dialog>
                </div>

                <?php endif; ?>
            </div>
        </div>
    </main>

    <footer class="footer sm:footer-horizontal footer-center bg-primary text-primary-content p-4 mt-6 shrink">
      <aside>
            <a href="https://github.com/hanazzz/full-stack-todo-app" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-github fa-xl"></i></a>
        </aside>
    </footer>
    

    <script src="app.js"></script>
</body>

</html>