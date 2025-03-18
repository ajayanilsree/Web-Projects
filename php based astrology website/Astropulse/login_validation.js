function validateForm() {
    var username = document.getElementById("username").value.trim();
    var password = document.getElementById("password").value.trim();

    if (username === "" || password === "") {
        alert("Username and password are required");
        return false;
    }

    return true;
}
