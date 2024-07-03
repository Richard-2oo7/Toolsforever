<?php
$servername = "docker-mysql-1";
$username = "root";
$password = "password";
$database = "toolsforever";

// Connectie maken met de database
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    echo "Niet verbonden";
    die("Connection failed: " . $conn->connect_error);
}

$idartikel = $_POST['idartikel'];

$query = $conn->prepare("DELETE FROM voorraad WHERE artikel_idartikel = ?");
$query->bind_param("i", $idartikel); // "i" staat voor integer
$query->execute();

// Eerste DELETE query
$query = $conn->prepare("DELETE FROM artikel WHERE idartikel = ?");
$query->bind_param("i", $idartikel); // "i" staat voor integer
$query->execute();


// Connectie sluiten
$query->close();
$conn->close();
?>
