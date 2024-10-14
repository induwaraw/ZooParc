<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zooparc";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$name = $_POST['name'];
$email = $_POST['new_email'];
$phone = $_POST['phno'];
$code = $_POST['code'];
$username = $_POST['username'];
$password = $_POST['password'];


$sql = "INSERT INTO admins (name, email, phone, code, username, password) VALUES ('$name', '$email', '$phone', '$code', '$username', '$password')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Registration successful! Please Login');
            window.location.href = 'admin_login.php';
          </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
