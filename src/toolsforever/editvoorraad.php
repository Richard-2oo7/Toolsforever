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

$idlocatie = $_POST['idLocatie'];
$idartikel = $_POST['idArtikel'];
$aantal = $_POST['aantal'];

$query = $conn->prepare("UPDATE voorraad
                         set aantal = ?
                         where artikel_idartikel = ? and vesteging_idbedrijf = ?
                        ");
$query->bind_param("iii", $aantal, $idartikel, $idlocatie);
$query->execute();
?>