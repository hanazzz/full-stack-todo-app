# To-Do List App
A simple, full-stack to-do list web application.


## Demo
<img src="docs/Demo - Screenshot - Empty page.png" width="600" />
<img src="docs/Demo - Screenshot - Tasks.png" width="600" />
<img src="docs/Demo - Screenshot - Theme selection.png" width="600" />


## Overview
I built this app as an exercise to learn the basics of PHP. The project is based on this [Build a Full Stack To-Do App with PHP & MySQL](https://youtu.be) tutorial.


To build upon the tutorial, I made some changes and additions:
- Added ability to flag tasks as important
- Modified the query logic to display incomplete tasks before complete tasks, then sort tasks by their original creation date
- Migrated from using vanilla CSS to using a CSS framework and component library (Tailwind CSS and daisyUI)
- Added the ability to switch themes
- Modified check mark button to change appearance depending on task completion status
- Added a visual representation of the percentage of completed tasks using a progress indicator
- Updated the motivational text to randomly display different text from an array of options, rather than a single static phrase


## Built With
- PHP
- JavaScript
- MySQL
- daisyUI / Tailwind CSS


## Features
- **Add & Delete Tasks:** Create new tasks, remove individual tasks, or delete all tasks
- **Task Tracking:** Mark tasks as complete or flag them as high importance
- **Smart Sorting:** Automatically display incomplete and newest tasks at the top of the list
- **Rotating Motivational Phrases:** Display random encouraging phrases upon refresh
- **Progress Visualization:** Display a progress indicator based on percentage of completed tasks
- **Theme Selection:** Change user interface theme and remember preferred theme


## Possible Future Improvements
- Functional
    - Track individual user's tasks using PHP sessions
    - Track and display task completion dates
    - Add ability for users to submit their own motivational phrases or choose the ones they want from a list
    - Add button for users to refresh motivational phrase (or to disable them entirely)
    - Add ability for users to change task sort order
- UI
    - Create a brief tutorial (e.g. pre-made tasks with instructions like "This is an example task. Click the trash can icon to delete it.")


## Installation
To run this app locally on your computer:


### Set up the environment
1. **Clone this repository** to your computer.
2. **Download and install [MAMP](https://mamp.info)**.
3. **Move the project folder** into MAMP's root directory on your computer (`htdocs`).
    - Mac: `/Applications/MAMP/htdocs/`
    - Windows: `C:\MAMP\htdocs`
4. **Open MAMP** and click **Start**.


### Configure the database
5. Open your browser and **go to [http://localhost:8888/phpMyAdmin/](http://localhost:8888/phpmyadmin/)**.
6. **Create a new database**.
    - Click **New** from the left sidebar.
    - Name the database `full_stack_todo_app`.
    - Select **utf8mb4_general_ci** for the collation.
    - Click **Create** and you will now have a database called **full_stack_todo_app**.
    - Click the **Import** tab.
    - **Import the `setup.sql` file** located in your project repository (in the config folder). You will now have a table called **tasks**.


### Run the application
7. In a new browser tab, **go to [http://localhost:8888/full-stack-todo-app/public/index.php](http://localhost:8888/full-stack-todo-app/public/index.php)**.
8. You should now be able to see and use the app.