// // Filename: validate_forgot_password.js

// function validateForm() {
//     var username = document.getElementById("username").value;
//     var dob = document.getElementById("dob").value;
//     var newPassword = document.getElementById("new_password").value;

//     var errors = [];

//     if (username.trim() === "") {
//         errors.push("Username is required");
//     }

//     if (dob.trim() === "") {
//         errors.push("Date of Birth is required");
//     }

//     if (newPassword.trim() === "") {
//         errors.push("New Password is required");
//     } else if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}/.test(newPassword)) {
//         errors.push("New password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character");
//     }

//     if (errors.length > 0) {
//         // Display errors
//         var errorString = errors.join("<br>");
//         document.getElementById("error").innerHTML = errorString;
//         return false; // Prevent form submission
//     }

//     return true; // Allow form submission
// }
function validateForm() {
    var username = document.getElementById("username").value.trim();
    var dob = document.getElementById("dob").value.trim();
    var newPassword = document.getElementById("new_password").value.trim();

    var errors = [];

    if (username === "") {
        errors.push("Username is required");
    }

    if (dob === "") {
        errors.push("Date of Birth is required");
    }

    if (newPassword === "") {
        errors.push("New password is required");
    } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(newPassword)) {
        errors.push("New password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character");
    }

    if (errors.length > 0) {
        alert(errors.join("\n"));
        return false;
    }

    return true;
}
