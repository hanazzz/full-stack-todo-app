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
                    <p class="completed-subheading">You got this!</p>
                </div>
                <div class="task-counter">
                    1 <span class="spacer">/</span> 3
                </div>
            </div>

            <!-- Task Input -->
            <form class="task-form">
                <input type="text" class="task-input" placeholder="Your next task is..." required>
                <button type="submit" class="submit-btn">
                    <i class="fa-solid fa-plus fa-2xl"></i>
                </button>
            </form>

            <!-- Task List -->
             <h1>To-do List:</h1>
            <ul class="task-list">
                <li class="task-item">
                    <div class="li-text">Take out trash</div>
                    <div class="task-icons">
                        <button class="task-btn">
                            <i class="fa-solid fa-circle-check fa-2xl"></i>
                        </button>
                        <button class="task-btn">
                            <i class="fa-solid fa-trash fa-2xl"></i>
                        </button>
                    </div>
                </li>
                <li class="task-item">
                    <div class="li-text">Read 50 pages</div>
                    <div class="task-icons">
                        <button class="task-btn">
                            <i class="fa-solid fa-circle-check fa-2xl"></i>
                        </button>
                        <button class="task-btn">
                            <i class="fa-solid fa-trash fa-2xl"></i>
                        </button>
                    </div>
                </li>
                <li class="task-item">
                    <div class="li-text">This is a really really long task with a lot of text</div>
                    <div class="task-icons">
                        <button class="task-btn">
                            <i class="fa-solid fa-circle-check fa-2xl"></i>
                        </button>
                        <button class="task-btn">
                            <i class="fa-solid fa-trash fa-2xl"></i>
                        </button>
                    </div>
                </li>
            </ul>

            <!-- Clear tasks -->
             <button type="button" class="clear-all-btn">
                Clear All Tasks
            </button>
        </div>
    </main>

    <script src="app.js"></script>
</body>

</html>