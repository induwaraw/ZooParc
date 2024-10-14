<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.html");
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zooparc";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("<script>alert('Connection failed: " . $conn->connect_error . "');</script>");
}

// Handle form submission
$message = "";  // Initialize message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_education'])) {
        $title = $conn->real_escape_string($_POST['title']);
        $category = $conn->real_escape_string($_POST['category']);
        $description = $conn->real_escape_string($_POST['description']);
        
        $sql = "INSERT INTO education (title, category, description) VALUES ('$title', '$category', '$description')";
        $message = $conn->query($sql) ? "Education entry added successfully" : "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 80vh; /* Adjust as needed */
            padding: 20px;
        }

        .form-container {
            background: #fff;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            border-radius: 10px;
            padding: 20px;
            box-sizing: border-box;
            width: 100%;
            max-width: 600px;
        }

        .form-container h2 {
            margin-top: 0;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, .form-group textarea, .form-group select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }

        .message {
            color: green;
            font-weight: bold;
        }
    </style>
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
                <img src="images/icons/search.png" width="14px" height="14px" alt="Search">
            </button>
        </form>
    </div>
    <div class="auth-buttons">
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <a href="#" class="auth-button"><?php echo htmlspecialchars($_SESSION['username']); ?></a>
            <a href="logout.php" class="auth-button">Logout</a>
        <?php else: ?>
            <a href="login.html" class="auth-button">Login</a>
            <a href="volunteer_registration.html" class="auth-button">Volunteer Registration</a>
        <?php endif; ?>
    </div>
</header><br><br><br><br><hr><br>
<h2 align="center">Volunteer Dashboard</h2>
<main>
    <div class="container">
        <div class="form-container">
            <h2>Add Education</h2>
            <?php if (!empty($message)): ?>
                <p class="message"><?php echo htmlspecialchars($message); ?></p>
            <?php endif; ?>
            <form action="volunteer_dashboard.php" method="POST">
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="category" required>
                        <option value="Flying Animals">Flying Animals</option>
                        <option value="Swimming Animals">Swimming Animals</option>
                        <option value="Four-Legged Animals">Four-Legged Animals</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" name="add_education">Add Education</button>
                </div>
            </form>
        </div>
    </div>
</main><br><br>
</div>
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
