<?php
session_start();



// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zooparc";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("<script>alert('Connection failed: " . $conn->connect_error . "');</script>");
}

// Fetch education entries
$sql = "SELECT * FROM education";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn - Education Area</title>
    <!-- CSS Link -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .container {
            padding: 20px;
            text-align: center;
        }

        .education-item {
            margin: 20px auto;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            width: 80%;
            max-width: 800px;
            text-align: left;
        }

        .education-item h2 {
            margin: 0;
            font-size: 1.5em;
        }

        .education-item p {
            margin: 10px 0;
        }

        /* Ensure the header is not affected by additional styles */
        header {
            /* existing styles for header */
        }

        .save-species {
        display: flex;
        justify-content: space-between;
        padding: 0; 
        background-color: #070707;
        color: white;
        height: 330px;
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
</header>
<br><br><br><br>
<section class="save-species">
    <div class="save-species-content">
        <h2>Zoo Parc Education</h2>
        <p>Empower the Next Generation of Heroes in Wildlife Conservation. Join our Education Area at Zoo Parc to learn more about the threats wildlife faces and how you can make a difference.</p>


    </div>
    <div class="save-species-image">
        <img src="images/backgrounds/bg2.jpg">
    </div>

</section>
<main>
    <div class="container">

        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="education-item">
                    <h2><?php echo htmlspecialchars($row['title']); ?></h2>
                    <p><strong>Category:</strong> <?php echo htmlspecialchars($row['category']); ?></p>
                    <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($row['description'])); ?></p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No education entries found.</p>
        <?php endif; ?>
    </div>
</main>
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

<?php
$conn->close();
?>
