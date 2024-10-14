<?php
session_start();




// Database connection
$conn = new mysqli("localhost", "root", "", "zooparc");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch assigned volunteers and event details
$sql = "SELECT e.event_name, e.event_area, e.event_time, e.event_description, e.event_date, v.name AS volunteer_name 
        FROM events e
        LEFT JOIN assignments a ON e.event_id = a.event_id
        LEFT JOIN volunteers v ON a.volunteer_id = v.volunteer_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>
    <!-- CSS Link -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .container {
            padding: 20px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
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
        <h2>Zoo Parc Events</h2>
        <p>Learn, discover, explore: Embark on a voyage of discovery in the natural world at Zoo Parc, featuring engaging interactive exhibits and interesting interpretative programming to bring conservation into life.</p>


    </div>
    <div class="save-species-image">
        <img src="images/events.jpg">
    </div>

</section>
<br><br>
<main>
    <div class="container">
 

        <table>
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Event Date</th>
                    <th>Event Area</th>
                    <th>Event Time</th>
                    <th>Event Description</th>
                    <th>Assigned Volunteer</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['event_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['event_date']); ?></td>
                            <td><?php echo htmlspecialchars($row['event_area']); ?></td>
                            <td><?php echo htmlspecialchars($row['event_time']); ?></td>
                            <td><?php echo htmlspecialchars($row['event_description']); ?></td>
                            <td>
                                <?php 
                                echo empty($row['volunteer_name']) ? "Not assigned" : htmlspecialchars($row['volunteer_name']); 
                                ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No assignments found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>
                </div><br><br><br><br>
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
