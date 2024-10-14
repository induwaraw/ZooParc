<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "zooparc");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | ZooParc</title>
    <!-- CSS Link -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            background-image: url('images/parrot.jpg');
            background-size: cover; 
            background-position: center; 
            padding: 0;
            color: #333;
        }
        .wrapper {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            padding: 50px;
            text-align: center;
            margin: 20px auto;
            max-width: 1800px;
        }
        .about-section {
            padding: 40px;
            background-color: #fff;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .about-text {
            text-align: left;
            font-size: 18px;
            line-height: 1.6;
        }
        .quick-access {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;

        }
        .quick-access .card {
            background-color: #fff;
            border-radius: 10px;
            width: 200px;
            margin: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
        }
        .quick-access .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }
        .quick-access .card a {
            text-decoration: none;
            color: #007BFF;
            font-size: 18px;
            display: block;
            margin-top: 10px;
            transition: color 0.3s;
        }
        .quick-access .card a:hover {
            color: #0056b3;
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
                    </div>
                </div>
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
<br><br><br>

<div class="container">
    <section class="about-section">
        <h2>About ZooParc Zoological Park</h2><br>
        <div class="about-text">
<p>The world-renowned giant pandas are just one of almost 2,000 animals from 200 species that call ZooParc Zoological Park home. Our 70-hectare zoo is home to a wide range of creatures, including Asian elephants, lions, bald eagles, toxic frogs, wild deer, orangutans, sloth bears, and many more, all of which have naturalistic habitats.

We at ZooParc are dedicated to teaching and conservation. Our online community helps the general people learn more about wildlife and how to care for it by providing a platform for educational purposes. Volunteers with a strong interest in conservation and wildlife are also welcome. Volunteers can support our educational objective by offering guidance and disseminating knowledge about our animals. In order to become a volunteer, you must first register on our website as a community member by completing a brief form with the necessary data. After that, based on your interests and availability, our site administrator will assign you to events that are scheduled.

Additionally, there are several dining options available at ZooParc, or guests are free to pack a picnic. Our website has information on our dining establishments to assist you in making travel plans.
        </p>
            
        </div>
    </section>

    <!-- Quick Access Section -->
    <section class="quick-access">
        <div class="card">
            <a href="animals.php">Explore Animals</a>
        </div>
        <div class="card">
            <a href="learn.php">Education Area</a>
        </div>
        <div class="card">
            <a href="events.php">Upcoming Events</a>
        </div>
        <div class="card">
            <a href="food.php">Food Outlets</a>
        </div>
    </section>
</div>

<section class="footer-container">
    <div class="footer-grid">
        <div class="footer-section">
            <div class="logo">
                <img src="images/icons/darklogo.png" alt="Logo">
            </div>
        </div>
        <div class="footer-section">
            <h4>Quick Links</h4>
            <ul class="link-list">
                <li><a href="index.php">Home</a></li>
                <li><a href="animals.php">Animals</a></li>
                <li><a href="learn.php">Educational Area</a></li>
                <li><a href="events.php">Events</a></li>
                <li><a href="food.php">Food Outlets</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Explore</h4>
            <ul class="link-list">
                <li><a href="login.html">Volunteer Login</a></li>
                <li><a href="volunteer_registration.html">Volunteer Registration</a></li>
            </ul>
        </div>

        <div class="footer-section">
            <h4>Feedback</h4>
            <p>We value your input! Please enter your feedback to help us improve and serve you better.</p>
            <form action="feedback.php" method="POST">
                <input type="text" name="feedback" placeholder="Type here..." required>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
</section>

</div>
</body>
</html>

<?php
$conn->close();
?>
