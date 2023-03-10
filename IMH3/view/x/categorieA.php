<?php
//
// categorieA.php
// Deze pagina toont de documenten uit een van de categorieën uit de webwinkel.
//

// Zet het niveau van foutmeldingen zo dat warnings niet getoond worden.
error_reporting(E_ERROR | E_PARSE);

// Zet de titel en laad de HTML header uit het externe bestand.
$page_title = 'Welkom in de WebWinkel';
$active = 2;	// Zorgt ervoor dat header.html weet dat dit het actieve menu-item is.
include ('../controller/includes/header.html');

echo "<h1>Producten van categorie A</h1>";
echo "<p>Opdracht: Voeg een productcategorie toe aan de producten uit de webwinkel, en zorg ervoor dat je webwinkel verschillende categorieën ondersteunt.</p>";

include ('../controller/includes/footer.html');
?>