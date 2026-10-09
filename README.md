# To-Do List App
A simple, full-stack to-do list web application.

## Demo
<img src="demo_screenshot.png" width="600" />


## Overview
I built this app as an exercise to learn the basics of PHP. The project is based on this [Build a Full Stack To-Do App with PHP & MySQL](https://youtu.be) tutorial.

To build upon the tutorial, I made some changes and additions:
- Added ability to flag tasks as important
- Modified the query logic to display incomplete tasks before complete tasks, then sort tasks by their original creation date
- Updated the motivational text to randomly display different text from an array of options, rather than a single static phrase
- Migrated from using vanilla CSS to using a CSS framework and component library (Tailwind CSS and daisyUI)
- Modified check mark button to change appearance depending on task completion status
- Added a visual representation of the percentage of completed tasks using a progress indicator

## Built With
- PHP
- JavaScript
- MySQL
- daisyUI / Tailwind CSS

## Features
- Add a task
- Delete individual task or delete all tasks
- Mark tasks as complete
- Flag tasks as important
- Tasks are sorted by completion status (incomplete tasks first), then creation date (newest tasks first)
- Randomly displays different motivational phrases
- Displays a visual representation of the percentage of completed tasks

## Possible Future Improvements
- Functional
    - Track and display task completion dates
    - Add ability for users to submit their own motivational phrases or choose the ones they want from a list
    - Add button for users to refresh motivational phrase (or to disable them entirely)
    - Add ability to change task sort order
- UI
    - Add dark/light theme toggle or ability to pick theme
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
    - Click **Create**.
    - Click the **Import** tab.
    - **Import the `create_db.sql` file** located in your project repository.

### Run the application
7. In a new browser tab, **go to [http://localhost:8888/](http://localhost:8888/)**.
8. Click **full-stack-todo-app/** to launch and use the app.