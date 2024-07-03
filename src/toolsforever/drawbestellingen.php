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

$query = $conn->prepare("
    SELECT vesteging.locatie, 
           bestelling.*, 
           artikel.naam AS naam, 
           artikel.type, 
           artikel.fabriek, 
           artikel.waardeinkoop, 
           artikel.waardeverkoop,
           bestelling_has_artikel.aantal
    FROM bestelling
    INNER JOIN vesteging ON vesteging.idbedrijf = bestelling.vesteging_idbedrijf
    INNER JOIN bestelling_has_artikel ON bestelling.idbestelling = bestelling_has_artikel.bestelling_idbestelling
    INNER JOIN artikel ON artikel.idartikel = bestelling_has_artikel.artikel_idartikel
");

$query->execute();
$result = $query->get_result();

$query->close();
$conn->close();

$locations = [];

foreach ($result as $row) {
    $locatie = $row['locatie'];
    if (!isset($locations[$locatie])) {
        $locations[$locatie] = [];
    }
    $locations[$locatie][] = $row;
}

echo "<div>";

foreach ($locations as $locatie => $bestellingen) {
    echo "<div class='locatie-box'>";
    echo "<h1>" . $locatie . "</h1>";

    // Tabelkop voor alle bestellingen in deze locatie
    echo "<table>";
    echo "<thead>";
    echo "<tr>";
    echo "<th>Naam</th><th>Type</th><th>Fabriek</th><th>Aantal</th><th>Waarde Inkoop</th><th>Waarde Verkoop</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";

    $current_bestelling_id = null;

    foreach ($bestellingen as $row) {
        if ($row['idbestelling'] != $current_bestelling_id) {
            $besteldatum = date("Y-m-d", strtotime($row['besteldatum']));
            $aankomstdatum = date("Y-m-d", strtotime($row['aankomstdatum']));

            echo "<tr style='background-color: lightgray;'>";
            echo "<td colspan='6' style='padding: 0px'>Besteldatum: " . $besteldatum . " Aankomstdatum: " . $aankomstdatum . "</td>";
            echo "</tr>";

            $current_bestelling_id = $row['idbestelling'];
        }

        echo "<tr>";
        echo "<td>" . $row['naam'] . "</td>";
        echo "<td>" . $row['type'] . "</td>";
        echo "<td>" . $row['fabriek'] . "</td>";
        echo "<td>" . $row['aantal'] . "</td>";
        echo "<td>€ " . $row['waardeinkoop'] . "</td>";
        echo "<td>€ " . $row['waardeverkoop'] . "</td>";
        echo "</tr>";
    }
    // echo "<tr>";
    // echo "<td colspan= '6'></td>";
    // echo "</tr>";

    echo "</tbody>";
    echo "</table>";
    echo "</div>";
}

echo "</div>";
?>
