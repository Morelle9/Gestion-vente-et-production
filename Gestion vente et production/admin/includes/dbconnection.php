
<?php
// Connexion à la base de données
$con = mysqli_connect("localhost", "root", "", "inventorydb");

// Vérifier la connexion
if (mysqli_connect_error()) {
    echo "Échec de la connexion : " . mysqli_connect_error();
}
?>
