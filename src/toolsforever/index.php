<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table, td, tr, th{
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <table>
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

$query = $conn->prepare("SELECT artikel.naam, voorraad.aantal
                         FROM artikel
                         join voorraad on artikel.idartikel = voorraad.artikel_idartikel
                         join vesteging on vesteging.idbedrijf = voorraad.vesteging_idbedrijf
                         where vesteging.idbedrijf = '1'");
$query->execute();
$result = $query->get_result();

while ($row = $result->fetch_assoc()) {
    echo"<tr>";
foreach($row as $row){
    echo "<td>";
    echo $row;
    echo "</td>";
}
    echo"</tr>";
}
?>
</table>
</body>
</html>
