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
$query = $conn->prepare("SELECT * FROM vesteging");
$query->execute();
$result = $query->get_result();
echo "<select>";
echo "<option value=''>Locatie</option>";
while($row = $result->fetch_assoc()){
    echo "<option value= ".$row['idbedrijf'].'>'.$row['locatie']."</option>";
}
echo "</select>";
?>