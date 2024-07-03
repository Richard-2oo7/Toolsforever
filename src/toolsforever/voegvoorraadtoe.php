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

$naam = $_POST['naam'];
$locatie = $_POST['locatie'];
$aantal = $_POST['aantal'];

$query = $conn->prepare("INSERT INTO voorraad (artikel_idartikel, vesteging_idbedrijf, aantal) VALUES (?, ?, ?)");
$query->bind_param("iii", $naam, $locatie, $aantal);
$query->execute();

?>