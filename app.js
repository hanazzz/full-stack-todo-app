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