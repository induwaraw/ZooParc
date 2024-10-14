<?php
session_start();



// Check if the user is logged in
if (!isset($_SESSION['admin_loggedin']) || !$_SESSION['admin_loggedin']) {
    header("Location: admin_login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "zooparc");


// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submissions
$message = "";  // Initialize message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_event'])) {
        $event_name = $conn->real_escape_string($_POST['event_name']);
        $event_date = $conn->real_escape_string($_POST['event_date']);
        $event_area = $conn->real_escape_string($_POST['event_area']);
        $event_time = $conn->real_escape_string($_POST['event_time']);
        $event_description = $conn->real_escape_string($_POST['event_description']);
        
        $sql = "INSERT INTO events (event_name, event_date, event_area, event_time, event_description) VALUES ('$event_name', '$event_date', '$event_area', '$event_time', '$event_description')";
        $message = $conn->query($sql) ? "New event added successfully" : "Error: " . $conn->error;
        
    } elseif (isset($_POST['update_event'])) {
        $event_id = $conn->real_escape_string($_POST['event_id']);
        $event_name = $conn->real_escape_string($_POST['event_name']);
        $event_date = $conn->real_escape_string($_POST['event_date']);
        $event_area = $conn->real_escape_string($_POST['event_area']);
        $event_time = $conn->real_escape_string($_POST['event_time']);
        $event_description = $conn->real_escape_string($_POST['event_description']);
        
        $sql = "UPDATE events SET event_name='$event_name', event_date='$event_date', event_area='$event_area', event_time='$event_time', event_description='$event_description' WHERE event_id='$event_id'";
        if ($conn->query($sql) && $conn->affected_rows > 0) {
            $message = "Event updated successfully";
        } else {
            $message = "No event found with ID: $event_id or no changes made.";
        }
        
    } elseif (isset($_POST['delete_event'])) {
        $event_id = $conn->real_escape_string($_POST['event_id']);
        
        $sql = "DELETE FROM events WHERE event_id='$event_id'";
        if ($conn->query($sql) && $conn->affected_rows > 0) {
            $message = "Event deleted successfully";
        } else {
            $message = "No event found with ID: $event_id.";
        }
    } elseif (isset($_POST['assign_volunteer'])) {
        $volunteer_id = $conn->real_escape_string($_POST['volunteer_id']);
        $event_id = $conn->real_escape_string($_POST['event_id']);

        // Check if the assignment already exists
        $check_sql = "SELECT * FROM assignments WHERE volunteer_id='$volunteer_id' AND event_id='$event_id'";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            $message = "This volunteer is already assigned to the event.";
        } else {
            $sql = "INSERT INTO assignments (volunteer_id, event_id) VALUES ('$volunteer_id', '$event_id')";
            if ($conn->query($sql) === TRUE) {
                $message = "Volunteer assigned successfully.";
            } else {
                $message = "Error assigning volunteer: " . $conn->error;
            }
        }
    }
}

// Fetch volunteers
$volunteers_result = $conn->query("SELECT volunteer_id, name FROM volunteers");
if ($volunteers_result) {
    $volunteers = $volunteers_result->fetch_all(MYSQLI_ASSOC);
} else {
    $message = "Error fetching volunteers: " . $conn->error;
}

// Fetch events
$events_result = $conn->query("SELECT event_id, event_name FROM events");
if ($events_result) {
    $events = $events_result->fetch_all(MYSQLI_ASSOC);
} else {
    $message = "Error fetching events: " . $conn->error;
}


// Fetch orders
$orders_result = $conn->query("SELECT id, food, quantity, veg_nonveg, table_number, order_time FROM orders");
if ($orders_result) {
    $orders = $orders_result->fetch_all(MYSQLI_ASSOC);
} else {
    $orders = []; // Initialize as empty array if the query fails
    $message = "Error fetching orders: " . $conn->error;
}
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- CSS Link -->
    <link rel="stylesheet" href="css/style.css">
    <style>
main {
    padding: 20px;
}

h1 {
    text-align: center;
}

.container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: space-between;
}

.form-container {
    background: #fff;
    box-shadow: 0 8px 32px rgba(31, 38, 135, 0.37);
    border-radius: 10px;
    padding: 20px;
    box-sizing: border-box;
    flex: 1;
    min-width: 300px;
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

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #f4f4f4;
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
        <a href="admin_logout.php" class="auth-button">Logout</a>
    </div>
</header>

<main>
    <br><br><br><br><hr><br><br><br>
    <h1 align="center">Admin Dashboard</h1>
    <?php if (!empty($message)): ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <div class="container">
        <!-- Add Event Form -->
        <div class="form-container">
            <h2>Add Event</h2>
            <form action="admin_dashboard.php" method="POST">
                <div class="form-group">
                    <label for="event_name">Event Name</label>
                    <input type="text" id="event_name" name="event_name" required>
                </div>
                <div class="form-group">
                    <label for="event_date">Event Date</label>
                    <input type="date" id="event_date" name="event_date" required>
                </div>
                <div class="form-group">
                    <label for="event_area">Event Area</label>
                    <select id="event_area" name="event_area" required>
                        <option value="">Select an area</option>
                        <option value="Savannah">Savannah</option>
                        <option value="Rainforest">Rainforest</option>
                        <option value="Aquatic">Aquatic</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="event_time">Event Time</label>
                    <input type="time" id="event_time" name="event_time" required>
                </div>
                <div class="form-group">
                    <label for="event_description">Event Description</label>
                    <textarea id="event_description" name="event_description" rows="4" required></textarea>
                </div>
                <button type="submit" name="add_event">Add Event</button>
            </form>
        </div>

        <!-- Update Event Form -->
        <div class="form-container">
            <h2>Update Event</h2>
            <form action="admin_dashboard.php" method="POST">
                <div class="form-group">
                    <label for="event_id">Event ID</label>
                    <input type="number" id="event_id" name="event_id" >
                </div>
                <div class="form-group">
                    <label for="event_name">Event Name</label>
                    <input type="text" id="event_name" name="event_name" >
                </div>
                <div class="form-group">
                    <label for="event_date">Event Date</label>
                    <input type="date" id="event_date" name="event_date" >
                </div>
                <div class="form-group">
                    <label for="event_area">Event Area</label>
                    <select id="event_area" name="event_area" >
                        <option value="">Select an area</option>
                        <option value="Savannah">Savannah</option>
                        <option value="Rainforest">Rainforest</option>
                        <option value="Aquatic">Aquatic</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="event_time">Event Time</label>
                    <input type="time" id="event_time" name="event_time" >
                </div>
                <div class="form-group">
                    <label for="event_description">Event Description</label>
                    <textarea id="event_description" name="event_description" rows="4" ></textarea>
                </div>
                <button type="submit" name="update_event">Update Event</button>
            </form>
        </div>

        <!-- Delete Event Form -->
        <div class="form-container">
            <h2>Delete Event</h2>
            <form action="admin_dashboard.php" method="POST">
                <div class="form-group">
                    <label for="event_id">Event ID</label>
                    <input type="number" id="event_id" name="event_id" required>
                </div>
                <button type="submit" name="delete_event">Delete Event</button>
            </form>
        </div>

        <!-- Assign Volunteer Form -->
        <div class="form-container">
            <h2>Assign Volunteer to Event</h2>
            <form action="admin_dashboard.php" method="POST">
                <div class="form-group">
                    <label for="volunteer_id">Select Volunteer</label>
                    <select id="volunteer_id" name="volunteer_id" required>
                        <option value="">Select a volunteer</option>
                        <?php foreach ($volunteers as $volunteer): ?>
                            <option value="<?php echo $volunteer['volunteer_id']; ?>"><?php echo htmlspecialchars($volunteer['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="event_id">Select Event</label>
                    <select id="event_id" name="event_id" required>
                        <option value="">Select an event</option>
                        <?php foreach ($events as $event): ?>
                            <option value="<?php echo $event['event_id']; ?>"><?php echo htmlspecialchars($event['event_name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" name="assign_volunteer">Assign Volunteer</button>
            </form>
        </div>

        <!-- Remove Volunteer Form -->
        <div class="form-container">
            <h2>Remove Volunteer</h2>
            <form action="admin_dashboard.php" method="POST">
                <div class="form-group">
                    <label for="volunteer_id">Select Volunteer</label>
                    <select id="volunteer_id" name="volunteer_id" required>
                        <option value="">Select a volunteer</option>
                        <?php foreach ($volunteers as $volunteer): ?>
                            <option value="<?php echo $volunteer['volunteer_id']; ?>"><?php echo htmlspecialchars($volunteer['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button type="submit" name="remove_volunteer">Remove Volunteer</button>
            </form>
        </div>

        <!-- Orders Table -->
 
        <main>
        <h1>Orders Table</h1>

   
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Food</th>
                    <th>Quantity</th>
                    <th>Veg/Non-Veg</th>
                    <th>Table Number</th>
                    <th>Order Time</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($orders)): ?>
                    <?php foreach ($orders as $order): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($order['id']); ?></td>
                            <td><?php echo htmlspecialchars($order['food']); ?></td>
                            <td><?php echo htmlspecialchars($order['quantity']); ?></td>
                            <td><?php echo htmlspecialchars($order['veg_nonveg']); ?></td>
                            <td><?php echo htmlspecialchars($order['table_number']); ?></td>
                            <td><?php echo htmlspecialchars($order['order_time']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="no-orders">No orders found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>


        </div>
    </div>
</main>
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
            <h4>Feedbacks</h4>
            <p>We value your input! Please enter your feedback to help us improve and serve you better.</p>
            <form action="feedback.php" method="POST">
                <input type="text" name="feedback" placeholder="type here.." required>
                <button type="submit">Send</button>
            </form>
        </div>
    </div>
</section>
</body>
</html>
