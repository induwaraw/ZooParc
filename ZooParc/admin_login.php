<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zooparc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize variables
$error_message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize input
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    
    // Query to check admin credentials
    $sql = "SELECT * FROM admins WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Correct credentials
        $_SESSION['admin_loggedin'] = true;
        $_SESSION['admin_username'] = $username;
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Incorrect credentials
        $error_message = "Invalid username or password.";
        echo "<script>alert('Invalid username or password.');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <!-- CSS Link -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Validations JS -->
    <script type="text/javascript">
        function LetterValidation(uname) {
            var letters = /^[A-Za-z]+$/;
            if (uname.value === "") {
                alert('Fill the Username Field');
                uname.focus();
                return false;
            } else if (uname.value.match(letters)) {
                return true;
            } else {
                alert('Username must have characters only');
                uname.focus();
                return false;
            }
        }

        function validateLogin() {
            var username = document.login_form.username;
            var password = document.login_form.password;

            if (!LetterValidation(username)) {
                return false;
            } else if (password.value === "") {
                alert('Please enter your password.');
                password.focus();
                return false;
            } else {
                return true;
            }
        }
    </script>
</head>
<body>
<div class="wrapper">
<header>
        <div class="logo">
            <img src="images/icons/logo.png" height="50px" width="150px" alt="ZooParc Logo">
        </div>

        <a href="#" class="brand"></a>
        <div class="menu-btn">
            <div class="navigation">
                <div class="navigation-items">
                <a href="index.php">Home</a>
                <a href="animals.php">Animals</a>

                    <div class="dropdown">
                    <a href="#">Zoo Parc ▼</a>
                    <div class="dropdown-content">
                            <a href="learn.php">Education Area</a>
                            <a href="events.php">Events</a>
                            <a href="food.php">Food Outlets</a>
                            <a href="about.php">About Us</a>

                        </div></div>
                        <div class="dropdown">
                        <a href="#">More ▼</a>
                        <div class="dropdown-content">
                            <a href="admin_dashboard.php">Admin Dashboard</a>
                            <a href="volunteer_dashboard.php">Volunteer Dashboard</a>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        
        <div class="search-bar">
            <form action="search.php" method="POST">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit">
                <img src="images/icons/search.png" width="14px" height="14px" alt="Search"></button>
            </form>
        </div>

    </header>
    <br><br><br><br><hr><br><br><br>
    <main>
        <div class="container">
            <div class="form-container" style="background: rgba(255, 255, 255, 0.25); box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37); backdrop-filter: blur(4px); -webkit-backdrop-filter: blur(4px); border-radius: 10px; border: 1px solid rgba(255, 255, 255, 0.18);">
                <h2>Admin Login</h2>
                <form name="login_form" action="admin_login.php" method="POST" onsubmit="return validateLogin()">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password">
                    </div>
                    <?php if ($error_message): ?>
                        <p class="error-message"><?php echo htmlspecialchars($error_message); ?></p>
                    <?php endif; ?>
                    <div class="form-group">
                        <button type="submit">Login</button>
                    </div>
                    To Access Admin Area you must login <br>
                    Don't have an account? Verify and <a href="admin_registration.html"> Register Now !</a>
                </form>
            </div>
            <div class="image-container" style="flex: 1; max-width: 500px; height: 300px; padding: 1px; background: #f1f1f1; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); text-align: center;">
                <img src="images/owl.jpg" alt="Login Image" style="width: 100%; height: 400px; border-radius: 8px; object-fit: cover;">
            </div>
        </div>
    </main>
                    </div><br><br><Br>

                    <section class="footer-container">
    <div class="footer-grid">
        <div class="footer-section">
            <div class="logo">
                <img src="images\icons/darklogo.png" alt="Logo">
            </div>
        </div>
        <div class="footer-section">
            <h4>Qucik Links</h4>
            <ul class="link-list">
                <li><a href="index.php">Home</a></li>
                <li><a href="animals.php">Animals</a></li>
                <li><a href="learn.php">Educational <Area></Area></a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="food.php">Food Outlets</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Explore</h4>
            <ul class="link-list">
                <li><a href="login.html">Volunteer Login</a></li>
                <li><a href="volunteer_registration.html">Volunteer Registration</a></li>

        </div>

        <div class="footer-section">
            <h4>Feedbacks</h4>
            <p>
            We value your input! Please enter your feedback to help us improve and serve you better.
            </p>
            <form action="feedback.php" method="POST">
                <input type="text" name="feedback" placeholder="type here.." required>
                <button type="submit">Send</button>
            </form>

        </div>
    </div>
</section>




</body>
</html>
