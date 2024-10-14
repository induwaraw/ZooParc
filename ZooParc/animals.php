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
    <title>Animals</title>
    <!-- CSS Link -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        .container {
            padding: 20px;
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 80%; 
            margin: 0 auto;
            overflow: hidden; 
            border-radius: 8px; 
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
                }

            th, td {
            padding: 15px 20px;
            text-align: left;
            vertical-align: middle; 
            }

            th {
            background-color: #2980b9; 
            color: white;
            font-weight: bold;
            text-transform: uppercase; 
            }

            tr:nth-child(even) {
            background-color: #f0f0f0; 
            }

            tr:hover {
            background-color: #e0e0e0; 
            cursor: pointer; 
            }


        .wildlife {
            text-align: center;
            padding: 30px 120px;

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
        <h2>Zoo Parc Animals</h2>
        <p>It's time to get wild! Explore the various interactive exhibitions and get up close and personal with magnificent animals. Make long-lasting memories with your loved ones while experiencing the magic of nature.</p>


    </div>
    <div class="save-species-image">
        <img src="images/section1.png" >
    </div>

</section>
<!--Animals list-->

<section class="wildlife">
    <h2>Mammals</h2>
    <p>Learn about our amazing wildlife</p>
    <div class="cards">
        <div class="card">
            <img src="images/tiger.jpg">
            <div class="card-text">TIGER</div>
        </div>
        <div class="card">
            <img src="images/lion.jpg">
            <div class="card-text">LION</div>
        </div>
        <div class="card">
            <img src="images/deer.jpg">
            <div class="card-text">DEER</div>
        </div>
        <div class="card">
            <img src="images/git.jpg">
            <div class="card-text">GIRAFFE</div>
        </div>
        <div class="card">
            <img src="images/zeb.jpg" >
            <div class="card-text">ZEBRA</div>
        </div>
    </div>

    <div class="cards">
        <div class="card">
            <img src="images/elephants.jpg">
            <div class="card-text">ELEPHANT</div>
        </div>
        <div class="card">
            <img src="images/dol.jpg">
            <div class="card-text">DOLPHIN</div>
        </div>
        <div class="card">
            <img src="images/kangaroo.jpg">
            <div class="card-text">KANGAROO</div>
        </div>
        <div class="card">
            <img src="images/bear.jpg">
            <div class="card-text">BEAR</div>
        </div>
        <div class="card">
            <img src="images/monkey.jpg" >
            <div class="card-text">MONKEY</div>
        </div>
    </div>




</section>

<section class="wildlife">
    <h2>Birds</h2>
    <p>Birds: Nature's vibrant aviators, each with a unique song and style</p>
    <div class="cards">
        <div class="card">
            <img src="images/eagle.jpg">
            <div class="card-text">Eagle</div>
        </div>
        <div class="card">
            <img src="images/penguin.jpg">
            <div class="card-text">Penguin</div>
        </div>
        <div class="card">
            <img src="images/sparrow.jpg">
            <div class="card-text">Sparrow</div>
        </div>
        <div class="card">
            <img src="images/Hummingbird.jpg">
            <div class="card-text">Hummingbird</div>
        </div>
        <div class="card">
            <img src="images/Flamingo.jpg" >
            <div class="card-text">Flamingo</div>
        </div>
    </div>

    <div class="cards">
        <div class="card">
            <img src="images/Peacock.jpg">
            <div class="card-text">Peacock</div>
        </div>
        <div class="card">
            <img src="images/owl.jpg">
            <div class="card-text">Owl</div>
        </div>
        <div class="card">
            <img src="images/Seagull.jpg">
            <div class="card-text">Seagull</div>
        </div>
        <div class="card">
            <img src="images/Woodpecker.jpg">
            <div class="card-text">Woodpecker</div>
        </div>
        <div class="card">
            <img src="images/parrot.jpg" >
            <div class="card-text">Parrot</div>
        </div>
    </div>




</section>

<section class="wildlife">
    <h2>Reptiles</h2>
    <p>Ancient survivors of the wild, showcasing diverse adaptations and behaviors</p>
    <div class="cards">
        <div class="card">
            <img src="images/komododragon.jpg">
            <div class="card-text">Komoda Dragon</div>
        </div>
        <div class="card">
            <img src="images/gecko.jpg">
            <div class="card-text">Gecko</div>
        </div>
        <div class="card">
            <img src="images/chameleon.jpg">
            <div class="card-text">Chameleon</div>
        </div>
        <div class="card">
            <img src="images/kingcobra.jpg">
            <div class="card-text">King Cobra</div>
        </div>
        <div class="card">
            <img src="images/GreenIguana.jpg" >
            <div class="card-text">Green Iguana</div>
        </div>
    </div>

    <div class="cards">
        <div class="card">
            <img src="images/anaconda.jpg">
            <div class="card-text">Anaconda</div>
        </div>
        <div class="card">
            <img src="images/beardeddragon.jpg">
            <div class="card-text">Bearded Dragon</div>
        </div>
        <div class="card">
            <img src="images/Alligator.jpg">
            <div class="card-text">Alligator</div>
        </div>
        <div class="card">
            <img src="images/tortise.jpg">
            <div class="card-text">Tortise</div>
        </div>
        <div class="card">
            <img src="images/viper.jpg" >
            <div class="card-text">Viper</div>
        </div>
    </div>




</section>

<section class="wildlife">
    <h2>Aquatics</h2>
    <p>Discover the vibrant life beneath the waves.</p>
    <div class="cards">
        <div class="card">
            <img src="images/fish1.jpg">
            <div class="card-text">Clown Fish</div>
        </div>
        <div class="card">
            <img src="images/fish2.jpg">
            <div class="card-text">Angele Fish</div>
        </div>
        <div class="card">
            <img src="images/fish3.jpg">
            <div class="card-text">Blue tang</div>
        </div>
        <div class="card">
            <img src="images/fish4.jpg">
            <div class="card-text">Lion fish</div>
        </div>
        <div class="card">
            <img src="images/fish5.jpg" >
            <div class="card-text">Grouper</div>
        </div>
    </div>

    <div class="cards">
        <div class="card">
            <img src="images/fish6.jpg">
            <div class="card-text">Maderin Fish</div>
        </div>
        <div class="card">
            <img src="images/fish7.jpg">
            <div class="card-text">Shark Catfish</div>
        </div>
        <div class="card">
            <img src="images/fish8.jpg">
            <div class="card-text">Rainbow fish</div>
        </div>
        <div class="card">
            <img src="images/fish9.jpg">
            <div class="card-text">Neon tetra</div>
        </div>
        <div class="card">
            <img src="images/fish10.jpg" >
            <div class="card-text">Tropical Catfish</div>
        </div>
    </div>




</section>
<h2 align="center">More Animals</h2><br>

<table>
  <tr>
    <th>Mammals</th>
    <th>Birds</th>
    <th>Reptiles</th>
    <th>Aquatics</th>
  </tr>
  <tr>
    <td>Cheetah</td>
    <td>Toucan</td>
    <td>Crocodile</td>
    <td>Goldfish</td>
  </tr>
  <tr>
    <td>Hippopotamus</td>
    <td>Macaw</td>
    <td>Python</td>
    <td>Betta Fish</td>
  </tr>
  <tr>
    <td>Rhinoceros</td>
    <td>Ostrich</td>
    <td>Turtle</td>
    <td>Tetra</td>
  </tr>
  <tr>
    <td>Koala</td>
    <td>Hawk</td>
    <td>Lizard</td>
    <td>Piranha</td>
  </tr>
  <tr>
    <td>Panda</td>
    <td>Swan</td>
    <td>Snake</td>
    <td>Discus</td>
  </tr>
  <tr>
    <td>Meerkat</td>
    <td>Cardinal</td>
    <td>Monitor Lizard</td>
    <td>Guppy</td>
  </tr>
  <tr>
    <td>Lemur</td>
    <td>Blue Jay</td>
    <td>Galapagos Tortoise</td>
    <td>Swordtail</td>
  </tr>
  <tr>
    <td>Sloth</td>
    <td>Canary</td>
    <td>Boa Constrictor</td>
    <td>Molly</td>
  </tr>
  <tr>
    <td>Orangutan</td>
    <td>Falcon</td>
    <td>Rattlesnake</td>
    <td>Platy</td>
  </tr>
  <tr>
    <td>Gorilla</td>
    <td>Vulture</td>
    <td>Gecko</td>
    <td>Angelfish</td>
  </tr>
  <tr>
    <td>Jaguar</td>
    <td>Parakeet</td>
    <td>Iguana</td>
    <td>Gourami</td>
  </tr>
  <tr>
    <td>Chimpanzee</td>
    <td>Cockatoo</td>
    <td>Caiman</td>
    <td>Rasbora</td>
  </tr>
  <tr>
    <td>Zebra</td>
    <td>Dove</td>
    <td>Skink</td>
    <td>Barbs</td>
  </tr>
  <tr>
    <td>Tapir</td>
    <td>Wood Duck</td>
    <td>Mud Turtle</td>
    <td>Danios</td>
  </tr>
  <tr>
    <td>Warthog</td>
    <td>Kingfisher</td>
    <td>Garter Snake</td>
    <td>Corydoras Catfish</td>
  </tr>
  <tr>
    <td>Okapi</td>
    <td>Pelican</td>
    <td>Gila Monster</td>
    <td>Plecostomus</td>
  </tr>
  <tr>
    <td>Serval</td>
    <td>Heron</td>
    <td>Tegu</td>
    <td>Loaches</td>
  </tr>
  <tr>
    <td>Bison</td>
    <td>Roadrunner</td>
    <td>Anole</td>
    <td>Rainbow Shark</td>
  </tr>
  <tr>
    <td>Red Panda</td>
    <td>Nighthawk</td>
    <td>Horned Lizard</td>
    <td>Otocinclus Catfish</td>
  </tr>
  <tr>
    <td>Wolverine</td>
    <td>Puffin</td>
    <td>Chameleon</td>
    <td>Siamese Algae Eater</td>
  </tr>
  <tr>
    <td>Armadillo</td>
    <td>Emu</td>
    <td>Water Monitor</td>
    <td>Cherry Barb</td>
  </tr>
  <tr>
    <td>Aardvark</td>
    <td>Kiwi</td>
    <td>Milk Snake</td>
    <td>Tiger Barb</td>
  </tr>
  <tr>
    <td>Capybara</td>
    <td>Kookaburra</td>
    <td>Corn Snake</td>
    <td>Neon Tetra</td>
  </tr>
  <tr>
    <td>Hyena</td>
    <td>Lovebird</td>
    <td>Ball Python</td>
    <td>Black Skirt Tetra</td>
  </tr>
  <tr>
    <td>Bat</td>
    <td>Finch</td>
    <td>Hognose Snake</td>
    <td>Harlequin Rasbora</td>
  </tr>
  <tr>
    <td>Pangolin</td>
    <td>Oriole</td>
    <td>Leopard Gecko</td>
    <td>Zebra Danio</td>
  </tr>
  <tr>
    <td>Porcupine</td>
    <td>Mockingbird</td>
    <td>Green Tree Python</td>
    <td>Glowlight Tetra</td>
  </tr>
  <tr>
    <td>Wombat</td>
    <td>Robin</td>
    <td>Emerald Tree Boa</td>
    <td>White Cloud Mountain Minnow</td>
  </tr>
  <tr>
    <td>Echidna</td>
    <td>Crow</td>
    <td>Box Turtle</td>
    <td>Dwarf Gourami</td>
  </tr>
  <tr>
    <td>Platypus</td>
    <td>Raven</td>
    <td>Red-Eared Slider</td>
    <td>Honey Gourami</td>
  </tr>
  <tr>
    <td>Tasmanian Devil</td>
    <td>Snowy Owl</td>
    <td>Snapping Turtle</td>
    <td>Pearl Gourami</td>
  </tr>
  <tr>
    <td>Numbat</td>
    <td>Sandhill Crane</td>
    <td>Alligator Snapping Turtle</td>
    <td>Dwarf Pufferfish</td>
  </tr>
  <tr>
    <td>Quokka</td>
    <td>Secretarybird</td>
    <td>Chinese Alligator</td>
    <td>Pea Pufferfish</td>
  </tr>
  <tr>
    <td>Sugar Glider</td>
    <td>Cassowary</td>
    <td>False Gharial</td>
    <td>Kuhli Loach</td>
  </tr>
  <tr>
    <td>Bilby</td>
    <td>Shoebill</td>
    <td>Spectacled Caiman</td>
    <td>Zebra Loach</td>
  </tr>
  <tr>
    <td>Cuscus</td>
    <td>Hoatzin</td>
    <td>Black Caiman</td>
    <td>Clown Loach</td>
  </tr>
  <tr>
    <td>Bandicoot</td>
    <td>Hornbill</td>
    <td>Dwarf Caiman</td>
    <td>Yoyo Loach</td>
  </tr>
  <tr>
    <td>Dingo</td>
    <td>King Vulture</td>
    <td>Smooth-Fronted Caiman</td>
    <td>Hillstream Loach</td>
  </tr>
  </table>
  <br><Br>

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
