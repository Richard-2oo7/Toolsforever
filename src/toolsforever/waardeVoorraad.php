<?php
$servername = "docker-mysql-1";
$username = "root";
$password = "password";
$database = "toolsforever";

// Connectie maken met de database
$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    echo "niet connected";
    die("Connection failed: " . $conn->connect_error);
}

$query = $conn->prepare("
    SELECT vesteging.locatie, 
           SUM(artikel.waardeinkoop * voorraad.aantal) AS Inkoop, 
           SUM(artikel.waardeVerkoop * voorraad.aantal) AS Verkoop
    FROM vesteging
    INNER JOIN voorraad ON voorraad.vesteging_idbedrijf = vesteging.idbedrijf
    INNER JOIN artikel ON artikel.idartikel = voorraad.artikel_idartikel
    GROUP BY vesteging.idbedrijf
");

$query->execute();
$result = $query->get_result(); // Correct method to get the result set

if ($result->num_rows > 0) {
    echo "<div>";
    while ($row = $result->fetch_assoc()) {
        echo "<h1>".$row['locatie']."</h1>";
        echo "<p>Totale inkoopwaarde: €".$row['Inkoop']."</p>";
        echo "<p>Totaal verkoopwaarde: €".$row['Verkoop']."</p>";
    }
    echo "</div>";
} else {
    echo "<div>Geen resultaten gevonden.</div>";
}

$query->close();
$conn->close();
?>
