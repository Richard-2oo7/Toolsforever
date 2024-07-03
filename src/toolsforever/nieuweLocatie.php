<?php
$servername = "docker-mysql-1";
$username = "root";
$password = "password";
$database = "toolsforever";
 
// Connectie maken met de database
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    echo "niet connected";
    die("Connection failed: " . $conn->connect_error);
}

$locatie = $_POST['Locatie'];

$query = $conn->prepare("INSERT INTO vesteging (locatie) VALUES (?)");
$query->bind_param("s", $locatie);
$query->execute();
?>