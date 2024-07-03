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

    $query = $conn->prepare("SELECT artikel.idartikel,vesteging_idbedrijf, artikel.naam, vesteging.locatie AS locatie, voorraad.aantal 
                             FROM voorraad
                             INNER JOIN artikel on artikel.idartikel = voorraad.artikel_idartikel
                             INNER JOIN vesteging on vesteging.idbedrijf = voorraad.vesteging_idbedrijf"
                             );
    $query->execute();
    $result = $query->get_result();
    
    if($result->num_rows > 0){
        // Haal de eerste rij op om de kolomkoppen te maken
        $firstrow = $result->fetch_assoc();
        
        echo "<table>";
        echo "<thead>";
        foreach($firstrow as $key => $value){
            // Sla de artikelid over bij de kolomkoppen
            if ($key != 'idartikel' && $key != 'vesteging_idbedrijf') {
                echo "<th>$key</th>";
            }
        }
        echo "</thead>";

        // Zet de data seek pointer terug naar de eerste rij
        $result->data_seek(0);

        // Itereer door alle rijen om de tabel rijen te genereren
        while ($row = $result->fetch_assoc()) {
            // Haal de artikelid op voor de id van de <tr>
            $artikelid = $row['idartikel'];
            $locatieid = $row['vesteging_idbedrijf'];
            
            echo "<tr artikelid='$artikelid' locatieId='$locatieid' class='dataRow'>";
            foreach($row as $key => $value){
                // Sla de artikelid over bij de tabelcellen
                if ($key != 'idartikel' && $key != 'vesteging_idbedrijf') {
                    echo "<td>$value</td>";
                }
            }
            echo "</tr>";
        }
        echo "</table>";
    } else{
        echo "er zijn geen producten gevonden";
    }
?>
