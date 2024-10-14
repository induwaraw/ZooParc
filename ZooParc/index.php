<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZooParc</title>

<!--CSS Link-->
<style>
.video {
    height:100vh;
    width:100vw;
    object-fit:cover;
    position:fixed;
}
</style>

<link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="wrapper">
    <header>
        <div class="logo">
            <img src="images/icons/logo.png" height="50px" width="150px" alt="ZooParc Logo">
        </div>
<!--navigation bar-->
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
        <!-- Search Bar -->
        <div class="search-bar">
            <form action="search.php" method="POST">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit">
                    <img src="images/icons/search.png" width="14px" height="14px" alt="Search">
                </button>
            </form>
        </div>

        <!-- Auth Buttons -->
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

    <!--Slider-->
    <section class="home">
        <img decoding="async" class="img-slide active" src="images/backgrounds/bg1.jpg" />
        <img decoding="async" class="img-slide" src="images/backgrounds/bg2.jpg"/>
        <img decoding="async" class="img-slide" src="images/backgrounds/bg3.jpg" />

        <div class="content active">
            <h2>Explore Our Diverse Wildlife,</h2><br><h1><span>ZooParc</span></h1>
            <p>Discover the enchanting ZooParc Zoological Park, home to about 2,000 animals from 200 different species, including our famous giant pandas. Spanning 70 hectares, our zoo features diverse habitats for lions, bald eagles, poisonous frogs, Asian elephants, wild deer, orangutans, sloth bears, and more.</p>
            <a href="animals.php">Read More</a>
        </div>
        <div class="content">
            <h1>Volunteer Community</h1>
            <p>Come and join ZooParc's online community, which is devoted to wild animal care and education. We are happy to have volunteers provide guidance and details on our residents. It is necessary for community members to register in advance, and this can be done by completing a form on our website. Then, volunteers will be scheduled by site administrators for different events.</p>
            <a href="events.php">Read More</a>
        </div>
        <div class="content">
            <h1>Dining and Picnics</h1>
            <p>Easily arrange your trip to ZooParc! Several dining options are available to visitors, or they can pack a picnic. Our website has comprehensive details about our dining establishments, guaranteeing you a delightful meal experience while seeing the delights of our zoo.
            </p>
            <a href="food.php">Read More</a>
        </div>

        <div class="media-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
        </div>
        <div class="slider-navigation">
            <div class="nav-btn active"></div>
            <div class="nav-btn"></div>
            <div class="nav-btn"></div>
        </div>
    </section>
    <!--blog posts-->
    <section class="blog-posts">
    <h2>Latest Blog Posts</h2>
    <div class="blog-container">
        <div class="blog-box">
            <img src="images/lion.jpg" alt="Blog 1">
            <h3>The Lions: The Kings of ZooParc</h3>
            <p>Our lions are, in reality, the kings of their habitat here within ZooParc. They are..</p>
            <a href="posts/lions.php" class="read-more">Read More</a>
        </div>
        <div class="blog-box">
            <img src="images/eagle.jpg" alt="Blog 2">
            <h3>Bald Eagles: A Magnificent Bird at ZooParc</h3>
            <p>Our bald eagles at ZooParc are living symbols of liberty and strength, delighting.. </p>
            <a href="posts/eagles.php" class="read-more">Read More</a>
        </div>
        <div class="blog-box">
            <img src="images/frog.jpg" alt="Blog 3">
            <h3>Colorful and Deadly Poisonous Frogs at ZooParc</h3>
            <p>Our ZooParc maintains some of the most colorful and most poisonous frogs that are.. </p>
            <a href="posts/frogs.php" class="read-more">Read More</a>
        </div>
        <div class="blog-box">
            <img src="images/elephants.jpg" alt="Blog 4">
            <h3>Asian Elephants: The Gentle Giants of ZooParc</h3>
            <p>Indeed, our Asian elephants are the gentle giants in our animal family here at.. </p>
            <a href="posts/elephants.php" class="read-more">Read More</a>
        </div>
        <div class="blog-box">
            <img src="images/deer.jpg" alt="Blog 5">
            <h3>Wild Deer: Lovely Residents of ZooParc</h3>
            <p>These wild deer of our ZooParc belong to the most graceful, elegant creatures one.. </p>
            <a href="posts/deer.php" class="read-more">Read More</a>
        </div>
        <div class="blog-box">
            <img src="images/oran.jpg" alt="Blog 6">
            <h3>Orangutans: Clever Climbers at ZooParc</h3>
            <p>Our orangutans are among the most intelligent and resourceful primates in the animal..</p>
            <a href="posts/orangutans.php" class="read-more">Read More</a>
        </div>
    </div>
</section>

<!-- content-->

    <section class="save-species">
    <div class="save-species-content">
        <h2>We Save Species</h2>
        <p>We Preserve Species: Leading worldwide initiatives to avert the extinction of species are carried out by our committed group of scientists and researchers. Come explore our conservation initiatives, which serve to both save endangered animals and prepare the next generation of environmentalists.</p>

        <a href="about.php" class="conservation-work-button">Our Conservation Work</a>

    </div>
    <div class="save-species-image">
        <img src="images/section1.png">
    </div>

</section>
<br><br>

<!--animals list-->
<section class="wildlife">
    <h2>Our Wildlife</h2>
    <p>Learn about our amazing wildlife</p>
    <div class="cards">
        <div class="card">
            <img src="images/dol.jpg" alt="Wombat - Common">
            <div class="card-text">DOLPHIN</div>
        </div>
        <div class="card">
            <img src="images/tiger.jpg" alt="Giraffe">
            <div class="card-text">TIGER</div>
        </div>
        <div class="card">
            <img src="images/frog.jpg" alt="Crocodile - Saltwater">
            <div class="card-text">POISUNUS FROG</div>
        </div>
        <div class="card">
            <img src="images/deer.jpg" alt="Crocodile - Saltwater">
            <div class="card-text">DEER</div>
        </div>
    </div>

    <div class="cards">
        <div class="card">
            <img src="images/zeb.jpg" alt="Wombat - Common">
            <div class="card-text">ZEBRA</div>
        </div>
        <div class="card">
            <img src="images/viper.jpg" alt="Giraffe">
            <div class="card-text">VIPER</div>
        </div>
        <div class="card">
            <img src="images/sloth.jpg" alt="Crocodile - Saltwater">
            <div class="card-text">SLOTH BEAR</div>
        </div>
        <div class="card">
            <img src="images/git.jpg" alt="Crocodile - Saltwater">
            <div class="card-text">GIRAFFE</div>
        </div>
    </div>
    <a href="animals.php">
    <button class="view-all">VIEW ALL ANIMALS</button></a>
</section>

            </div>

<!--Video BG-->
<video src="images/video.mp4" autoplay muted loop></video>

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





    <script src="js/zoo.js"></script>
</body>
</html>
