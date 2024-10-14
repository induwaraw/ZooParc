<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zooparc";

//database connection

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$feedback = $_POST['feedback'];



$sql = "INSERT INTO feedback (feedback) VALUES ('$feedback')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Sent successful! ');
            window.location.href = 'index.php';
          </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
