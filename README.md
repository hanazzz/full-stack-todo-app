# To-Do List App
A simple, responsive full-stack to-do list web application.


## Demo
🚀 [View the live demo](http://todo-demo.hanazait.com/)

<img src="docs/Demo - Screenshot - Empty page.png" width="600" />
<img src="docs/Demo - Screenshot - Tasks.png" width="600" />
<img src="docs/Demo - Screenshot - Theme selection.png" width="600" />


## Overview
I built this app as an exercise to learn the basics of PHP, using [a tutorial](https://www.youtube.com/watch?v=cWfVVqOAM4I) as the initial foundation. I then built upon what I learned by adding several features and improvements:
- Added the ability to flag tasks as important
- Modified the query logic to display incomplete tasks before complete tasks, then sort tasks by their original creation date
- Migrated from using vanilla CSS to using a CSS framework and component library (Tailwind CSS and daisyUI)
- Added the ability to switch themes
- Modified the complete button to change appearance depending on task completion status
- Added a visual representation of the percentage of completed tasks using a progress indicator
- Updated the motivational text to randomly display different text from an array of options, rather than a single static phrase
- Added basic user authentication for the live version

### Deployment Process
Deploying a live public demo introduced data privacy challenges. In the initial project, all tasks from the database were displayed. While a single, global task list works for running the app locally, it would have been a security issue for a live, public environment. However, I still wanted users to be able to test out the app instantly without creating a login.

To address this issue, I implemented simple user authentication using PHP sessions. This allows people to access the live app, while keeping their tasks private. When a user visits the live site, I revised the app to initiate a unique, temporary guest session. This assigns them a hidden identifier to separate their tasks from other visitors without forcing them to create a formal username and password. Because this is a temporary demo, data does not persist beyond the active browser session. I also set up the database to periodically wipe all user and task data to maintain visitor privacy and clear out old data.

The repository is split into two branches to manage these two versions of the app:

1. Local Development Version (`main` branch) - For local use only. Anyone running this version can access all tasks in their local database.

2. Live Deployed Version (`production` branch) - For public demonstration. Users can only see tasks they create during their browser session.


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