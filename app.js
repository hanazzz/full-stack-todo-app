///////////////////////////
// MOTIVATIONAL TEXT
///////////////////////////

// Display random motivational text

const motivationalText = document.getElementById("motivational-text");

function updateMotivationalText() {
    const motivationalTextOptions = [
    "You got this!",
    "You can do it!",
    "Keep up the good work!",
    "Let's get stuff done!",
    "The secret of getting ahead is getting started.",
    "Done is better than perfect.",
    "Keep pushing forward!",
    "Every step forward is a step in the right direction.",
    "Future you will thank you for doing this now."
]
    // Get random text from array of options
    var randomText = Math.floor(Math.random() * motivationalTextOptions.length);
    // Update the text on the page
    motivationalText.textContent = motivationalTextOptions[randomText];
}


///////////////////////////
// CLEAR ALL TASKS BUTTON
///////////////////////////

// Confirm that user wants to clear all tasks when click "Clear all tasks" button

const clearForm = document.getElementById("clear-form");

function confirmClearForm(event) {
    const yesSubmit = confirm("Are you sure you want to delete ALL tasks? This action is irreversible.")

    if (!yesSubmit) {
        event.preventDefault();
    } else {
        alert('All tasks have been deleted.')
    }
}

// If the "Clear all tasks" button is found, then add event listener
// This check prevents an error from happening when there are no tasks (and thus no button)
clearForm ? clearForm.addEventListener("submit", confirmClearForm) : null;


///////////////////////////
// THEME SELECTION
///////////////////////////

// Set default theme as a fail safe
const defaultTheme = 'garden'

// Retrieves saved theme and matches checked radio input
function loadTheme() {
    // If there is no theme saved in local storage, fall back to default theme
    (!localStorage.getItem('theme')) ? localStorage.setItem('theme', defaultTheme) : null;
    
    // Retrieve theme from local storage
    savedTheme = localStorage.getItem('theme')

    // SET SAVED THEME'S RADIO INPUT AS CHECKED
    // Ensures theme appears checked on dropdown menu and triggers theme update if needed

    // Get the radio input that matches the current saved theme
    savedThemeInput = document.querySelector(`input[name="theme-dropdown"][value="${savedTheme}"]`);

    // If a matching input is found, set that input as checked
    // If no match, fall back to checking the default theme input
    savedThemeInput ? 
    savedThemeInput.checked = true : 
    document.querySelector(`input[name="theme-dropdown"][value="${defaultTheme}"]`).checked = true;
}


// Save theme selections to local storage
function handleThemeSelecion() {
    // Get all theme radio inputs from theme dropdown menu
    const allThemeInputs = document.querySelectorAll('input[name="theme-dropdown"]');

    // Detect theme selection by listening for changes on each radio input
    allThemeInputs.forEach(input => {
        input.addEventListener('change', (e) => {
            // Get the selected theme name from the value of the radio input that changed
            const selectedTheme = e.target.value;
            // Save selected theme to local storage
            localStorage.setItem('theme', selectedTheme);
        });
    });
}


///////////////////////////
// ON PAGE LOAD
///////////////////////////

// Handle theme load/selection and update motivational text
document.addEventListener('DOMContentLoaded', () => {

    let savedTheme
    let savedThemeInput

    loadTheme();

    handleThemeSelecion();

    updateMotivationalText()

});