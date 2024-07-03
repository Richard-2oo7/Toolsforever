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


$condition1 = "";
$condition2 = "";
$condition = "";

if(isset($_POST['locatie'])){
    $condition1 = "vesteging.idbedrijf =".$_POST['locatie'];
    if($_POST['locatie'] == ""){
        $condition1 = "";
    }
}
if(isset($_POST['nameProduct'])){
  $naamproduct = $_POST['nameProduct'];
  $condition2 = "artikel.naam like "."'%$naamproduct%'";  
}
if($condition1 == "" && $condition2 == ""){
    $condition = "";
} else if($condition1 == ""){
    $condition = "where ".$condition2;
}else if($condition2 == ""){
    $condition = "where ".$condition1;
}else{
    $condition = "where ". $condition1 ." and ". $condition2;
}
$query = $conn->prepare("SELECT artikel.naam, artikel.type, artikel.fabriek,voorraad.aantal as voorraad, artikel.waardeverkoop as verkoopprijs, vesteging.locatie
                         FROM artikel
                         left join voorraad on artikel.idartikel = voorraad.artikel_idartikel
                         left join vesteging on vesteging.idbedrijf = voorraad.vesteging_idbedrijf
                         $condition
                         ");
$query->execute();
$result = $query->get_result();

if($result->num_rows > 0){
    
    $firstrow = $result->fetch_assoc();

    echo "<tr>";
    foreach($firstrow as $key => $value){
        echo "<th>$key</th>";
    }
    echo "</tr>";

    $result->data_seek(0);
    while ($row = $result->fetch_assoc()) {
        echo"<tr>";
        foreach($row as $cell){
            echo "<td>";
            echo $cell;
            echo "</td>";
        }
        echo"</tr>";
    }
} else{
    echo "er zijn geen producten gevonden";
}

?>