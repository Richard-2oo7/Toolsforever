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

$query = $conn->prepare("SELECT idartikel, naam FROM artikel");
$query->execute();
$result = $query->get_result();
echo "<select>";
while($row = $result->fetch_assoc()){
    echo "<option value='" . $row['idartikel'] . "'>" . $row['naam'] . "</option>";

}
echo "</select>";
?>