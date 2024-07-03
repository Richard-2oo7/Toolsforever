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
$gegevensStr = $_POST['product'];
$gegevensarr = explode(',',$gegevensStr);

$query = $conn->prepare("UPDATE artikel
                         set idartikel = ?, naam = ?, type = ?, fabriek = ?, waardeinkoop = ?, waardeverkoop = ?
                         where idartikel = ".$gegevensarr[0]."
                        ");
$query->execute($gegevensarr);
?>