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

$idartikel = $_POST['idArtikel'];
$idlocatie = $_POST['idLocatie'];


echo $idartikel;
echo $idlocatie;

$query = $conn->prepare("DELETE FROM voorraad WHERE artikel_idartikel = ? AND vesteging_idbedrijf = ?");
$query->bind_param("ii", $idartikel,$idlocatie); // "i" staat voor integer
$query->execute();

// echo "jassa";
// Connectie sluiten
$query->close();
$conn->close();
?>
