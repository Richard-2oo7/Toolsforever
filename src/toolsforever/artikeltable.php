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

$query = $conn->prepare("SELECT * FROM artikel");
$query->execute();
$result = $query->get_result();

if($result->num_rows > 0){
    
    $firstrow = $result->fetch_assoc();

    echo "<thead>";
    foreach($firstrow as $key => $value){
        echo "<th>$key</th>";
    }
    echo "</thead>";

    $result->data_seek(0);
    while ($row = $result->fetch_assoc()) {
        echo"<tr class = 'dataRow'>";
        foreach($row as $row){
            echo "<td>";
            echo $row;
            echo "</td>";
        }
        echo"</tr>";
    }
} else{
    echo "er zijn geen producten gevonden";
}
?>