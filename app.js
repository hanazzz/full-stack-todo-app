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

// Motivational text is updated each time the page loads
document.addEventListener("DOMContentLoaded", updateMotivationalText());



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

clearForm.addEventListener("submit", confirmClearForm);

// clearForm.addEventListener("submit", function(event){
//     const yesSubmit = confirm("Are you sure you want to DELETE all tasks? This action is irreversible.")

//     if (!yesSubmit) {
//         event.preventDefault();
//     } else {
//         alert('All tasks have been deleted.')
//     }
// }
// );