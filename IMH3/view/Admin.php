<?php


//
// index.php
// Dit is het startscherm van de webwinkel.
//

// Zet het niveau van foutmeldingen zo dat warnings niet getoond worden.
error_reporting(E_ERROR | E_PARSE);

// Zet de titel en laad de HTML header uit het externe bestand.
$page_title = 'Welkom in de WebWinkel';
$active = 1;    // Zorgt ervoor dat header.html weet dat dit het actieve menu-item is.
include('../controller/includes/header.html');

// mysqli_connect.php bevat de inloggegevens voor de database.
// Per server is er een apart inlogbestand - localhost vs. remote server
include('../controller/includes/mysqli_connect_' . $_SERVER['SERVER_NAME'] . '.php');

echo '<h1>Welkom in de WebWinkel';


$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// check connection
if (mysqli_connect_errno()) {
    printf("<p><b>Fout: verbinding met de database mislukt.</b><br/>\n%s</p>\n", mysqli_connect_error());
    include('../controller/includes/footer.html');
    exit();
}

// Maak de SQL query die onze producten gaat opleveren.
$sql = "SELECT 
`klant`.`klantnummer`, 
`klant`.`naam`, 
`klant`.`adres`, 
`klant`.`postcode`,
`klant`.`plaats`, 
`klant`.`emailadres`, 
FROM `klant`;";

// Voer de query uit en sla het resultaat op
$result = mysqli_query($conn, $sql);

if ($result === false) {
    echo "<p>Er zijn geen producten in de winkel gevonden.</p>\n";
} else {
    $num = 0;
    $num = mysqli_num_rows($result);
    echo "<p>Er zijn " . $num . " producten gevonden.</p>\n";
}

// Laat de producten zien in een form, zodat de gebruiker ze kan selecteren.
// Haal een nieuwe regel op uit het resultaat, zolang er nog regels beschikbaar zijn.
// We gebruiken in dit geval een associatief array.
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "<!-- ---------------------------------- -->\n";
    echo "<div id=\"klant\">\n<form action=\"Admin.php\" method=\"post\">\n";
    // echo "<div id=\"prodnummer\">".$row["productnummer"]."</div>\n";


    echo "<div id=\"klantnummer\">€ " . number_format($row["klantnummer"], 2, ',', '.') . "</div>\n";
    echo "<div id=\"naam\">" . $row["naam"] . "</div>\n";
    echo "<div id=\"adres\">" . $row["adres"] . "</div>\n";
    echo "<div id=\"postcode\">Leverbaar: " . $row["postcode"] . "</div>\n";
    echo "<div id=\"plaats\">Voorraad: " . $row["plaats"] . "</div>\n";
    echo "<div id=\"emailadres\">Voorraad: " . $row["emailadres"] . "</div>\n";
    echo "<input type=\"submit\" value=\"Bestel\" class=\"button\" /></div>\n";
    echo "</form>\n</div>\n";
}

/* maak de resultset leeg */
mysqli_free_result($result);

/* sluit de connection */
mysqli_close($conn);

include('../controller/includes/footer.html');
