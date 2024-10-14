<?php
session_start();

// Server configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zooparc";

// Create connection with DB
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<script>alert('Connection failed: " . $conn->connect_error . "'); window.location.href='login.html';</script>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    
    // Check the database for the user
    $query = "SELECT username, password FROM volunteers WHERE username = '$username'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($password === $row['password']) {
            // Set login status in the session
            $_SESSION['username'] = $username;
            $_SESSION['loggedin'] = true;
            echo "<script>alert('Hello " . htmlspecialchars($username) . ", welcome again!'); window.location.href='volunteer_dashboard.php';</script>";

        } else {
            echo "<script>alert('Invalid password.'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('No user found with that username.'); window.location.href='login.html';</script>";
    }
}

$conn->close();
?>
