<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User List</title>
<link rel="stylesheet" href="user.css">
<script>
function deleteUser(username) {
    if (confirm("Are you sure you want to delete this user?")) {
        // Make an AJAX request to delete the user
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "user.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Reload the page after successful deletion
                location.reload();
            }
        };
        xhr.send("username=" + username);
    }
}
</script>
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">User List</h1>
        </div>
    </header>
    <div class="content">
        <div class="container">
            <div class="user-list">
                <?php
                // Database connection parameters
                $servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
                $username = "root";
                $password = "";
                $dbname = "astrology";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Check if delete request is sent
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
                    $username = $_POST['username'];

                    // Prepare a DELETE statement
                    $sql = "DELETE FROM register WHERE username = '$username'";

                    if ($conn->query($sql) === TRUE) {
                        echo "User deleted successfully";
                    } else {
                        echo "Error deleting user: " . $conn->error;
                    }
                    exit(); // Stop further execution
                }

                // Retrieve users from the database
                $sql = "SELECT * FROM register WHERE username != 'adminadmin'";
                $result = $conn->query($sql);

                // HTML string to store user details
                $userDetailsHTML = '';

                // Check if users exist
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        $username = $row["username"];
                        $dob = $row["dob"];
                        $zodiacSign = $row["zodiac_sign"];
                        // Create user card HTML
                        $userDetailsHTML .= "<div class='user-card'>";
                        $userDetailsHTML .= "<h3>$username</h3>";
                        $userDetailsHTML .= "<p>Date of Birth: $dob</p>";
                        $userDetailsHTML .= "<p>Zodiac Sign: $zodiacSign</p>";
                        $userDetailsHTML .= "<button class='delete-btn' onclick='deleteUser(\"$username\")'>Delete</button>";
                        $userDetailsHTML .= "</div>";
                    }
                } else {
                    $userDetailsHTML = "<p>No users found</p>";
                }

                // Close the connection
                $conn->close();

                // Output the user details HTML
                echo $userDetailsHTML;
                ?>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container">
            <p>&copy; 2024 Admin Panel. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>

