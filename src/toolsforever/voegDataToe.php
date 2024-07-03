<?php
$servername = "docker-mysql-1";
$username = "root";
$password = "password";
$database = "toolsforever";
 
// Connectie maken met de database
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    echo "niet conected";
    die("Connection failed: " . $conn->connect_error);
}

$gegevens = $_POST['product'];
echo "alleGegevens in de backend". $gegevens;

$gegevensarr = explode(",", $gegevens);

$query = $conn->prepare("INSERT INTO artikel (naam, type, fabriek, waardeinkoop, waardeverkoop) VALUES (?, ?, ?, ?, ?)");
$query->bind_param("sssii", $gegevensarr[0], $gegevensarr[1], $gegevensarr[2], $gegevensarr[3], $gegevensarr[4]);
$query->execute();
echo "Gegevens succesvol toegevoegd.";

?>