// // Filename: validate_signup.js

// function validateForm() {
//     var username = document.getElementById("username").value;
//     var password = document.getElementById("password").value;
//     var confirmPassword = document.getElementById("confirmPassword").value;
//     var dob = document.getElementById("dob").value;

//     var errors = [];

//     if (username.trim() === "") {
//         errors.push("Username is required");
//     } else if (!/^[a-zA-Z0-9]{5,}$/.test(username)) {
//         errors.push("Username must contain at least 5 characters and consist of letters, numbers");
//     }

//     if (password.trim() === "") {
//         errors.push("Password is required");
//     } else if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}/.test(password)) {
//         errors.push("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character");
//     }

//     if (confirmPassword.trim() === "") {
//         errors.push("Confirm password is required");
//     } else if (password !== confirmPassword) {
//         errors.push("Passwords do not match");
//     }

//     if (dob.trim() === "") {
//         errors.push("Date of birth is required");
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
    var password = document.getElementById("password").value.trim();
    var confirmPassword = document.getElementById("confirmPassword").value.trim();
    var dob = document.getElementById("dob").value.trim();
    var zodiacSign = document.getElementById("zodiacSign").value.trim();

    var errors = [];

    if (username === "") {
        errors.push("Username is required");
    } else if (!/^[a-zA-Z0-9]{5,}$/.test(username)) {
        errors.push("Username must contain at least 5 characters and consist of letters, numbers");
    }

    if (password === "") {
        errors.push("Password is required");
    } else if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(password)) {
        errors.push("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character");
    }

    if (confirmPassword === "") {
        errors.push("Confirm password is required");
    } else if (password !== confirmPassword) {
        errors.push("Passwords do not match");
    }

    if (dob === "") {
        errors.push("Date of birth is required");
    }

    if (zodiacSign === "") {
        errors.push("Zodiac sign is required");
    }

    if (errors.length > 0) {
        document.getElementById("error").innerHTML = errors.join("<br>");
        return false;
    }

    return true;
}
