<?php
session_start();

// Database connection
$conn = new mysqli("localhost", "root", "", "zooparc");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Food items and prices (this could be fetched from a database in a real-world scenario)
$food_items = [
    ["name" => "Pizza", "price" => "$8"],
    ["name" => "Burger", "price" => "$5"],
    ["name" => "Pasta", "price" => "$7"],
    ["name" => "Salad", "price" => "$4"],
    ["name" => "Sushi", "price" => "$10"],
    ["name" => "Tacos", "price" => "$6"],
    ["name" => "Sandwich", "price" => "$4"],
    ["name" => "Fries", "price" => "$3"],
    ["name" => "Ice Cream", "price" => "$2"],
    ["name" => "Steak", "price" => "$15"],
];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $food = $conn->real_escape_string($_POST['food']);
    $quantity = intval($_POST['quantity']);
    $veg_nonveg = $conn->real_escape_string($_POST['veg_nonveg']);
    $table_number = intval($_POST['table_number']);

    // SQL query to insert data into orders table
    $sql = "INSERT INTO orders (food, quantity, veg_nonveg, table_number)
            VALUES ('$food', $quantity, '$veg_nonveg', $table_number)";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Your order is successful! Please wait until our waiter brings your food. Thank you for dining with us.');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Outlets</title>
    <!-- CSS Link -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .h1{
            margin-left:160px;
        }
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
            width: 500px; /* Set a fixed width */
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .form-container {
            margin: 20px 0;
        }

        .form-container select, .form-container input[type="number"] {
            margin: 10px 0;
            padding: 8px;
            width: 100%;
        }

        .form-container button {
            padding: 10px 20px;
            background-color: #417c85;
            color: white;
            border: none;
            cursor: pointer;
        }

        .form-container button:hover {
            background-color: #45a049;
        }

        .save-species {
            display: flex;
            justify-content: space-between;
            padding: 0; 
            background-color: #c68731;
            color: white;
            height: 430px;
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
<br><br><br><br><hr><br>

<main>
    <h1 class="h1">ZooParc Food Outlet</h1>
    <div class="container">

        <table>
            <thead>
                <tr>
                    <th>Food Item</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($food_items as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['name']); ?></td>
                        <td><?php echo htmlspecialchars($item['price']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="form-container">
            <form action="" method="POST">
                <select name="food" required>
                    <option value="">Select Food</option>
                    <?php foreach ($food_items as $item): ?>
                        <option value="<?php echo htmlspecialchars($item['name']); ?>">
                            <?php echo htmlspecialchars($item['name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <input type="number" name="quantity" placeholder="Quantity" required min="1">

                <select name="veg_nonveg" required>
                    <option value="">Veg/Non-Veg</option>
                    <option value="Veg">Veg</option>
                    <option value="Non-Veg">Non-Veg</option>
                </select>

                <input type="number" name="table_number" placeholder="Table Number" required min="1" max="50">

                <button type="submit">Order</button>
            </form>
        </div>
    </div>
    <section class="save-species">
    <div class="save-species-content">
        <h2>Enjoy Delicious Meals </h2>
        <p>Our food outlets offer a variety of meals and snacks that cater to all tastes. From quick bites to full meals, enjoy your dining experience while exploring the zoo. Online Ordering Made Easy
Order your favorite meals and snacks online for a quick and convenient dining experience.</p>
                    </div>

    <div class="save-species-image">
        <img src="images/outlet.png" alt="Smithsonian Researchers holding cheetah cubs">
        
                    </section>
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
