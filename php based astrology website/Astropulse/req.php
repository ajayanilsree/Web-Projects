<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Requests</title>
<link rel="stylesheet" href="user.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">Contact Requests</h1>
        </div>
    </header>
    <div class="content">
        <div class="container">
            <div class="contact-requests">
                <?php
                // Database connection parameters
                $servername = "localhost"; // Change this if your MySQL server is hosted elsewhere
                $username = "root";
                $password = "";
                $dbname = "astrology"; // Change this to the correct database name

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Check if delete request is sent
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
                    $name = $_POST['name'];
                    $email = $_POST['email'];
                    $message = $_POST['message'];

                    // Prepare a DELETE statement
                    $sql = "DELETE FROM contacts WHERE name = ? AND email = ? AND message = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss", $name, $email, $message);

                    if ($stmt->execute()) {
                        echo "Contact request deleted successfully";
                    } else {
                        echo "Error deleting contact request: " . $conn->error;
                    }
                    exit(); // Stop further execution
                }

                // Retrieve contact requests from the database
                $sql = "SELECT * FROM contacts";
                $result = $conn->query($sql);

                // Check if contact requests exist
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        $name = $row["name"];
                        $email = $row["email"];
                        $message = $row["message"];
                        // Display each row details in a box
                        echo "<div class='request-box'>";
                        echo "<div class='request-detail'>";
                        echo "<span class='detail-label'>Name:</span> $name";
                        echo "</div>";
                        echo "<div class='request-detail'>";
                        echo "<span class='detail-label'>Email:</span> $email";
                        echo "</div>";
                        echo "<div class='request-detail'>";
                        echo "<span class='detail-label'>Message:</span> $message";
                        echo "</div>";
                        // Add delete button
                        echo "<form method='post' action='".$_SERVER["PHP_SELF"]."'>";
                        echo "<input type='hidden' name='name' value='$name'>";
                        echo "<input type='hidden' name='email' value='$email'>";
                        echo "<input type='hidden' name='message' value='$message'>";
                        echo "<button type='submit'>Delete</button>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No contact requests found</p>";
                }

                // Close the connection
                $conn->close();
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
