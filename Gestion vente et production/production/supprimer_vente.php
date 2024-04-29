<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_vente_production";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Récupération de l'ID de la vente à supprimer depuis l'URL
$vente_id = $_GET['id'];

// Construction de la requête SQL pour supprimer la vente de la base de données
$sql_supprimer_vente = "DELETE FROM ventes WHERE Id_vente='$vente_id'";

// Exécution de la requête pour supprimer la vente
if ($conn->query($sql_supprimer_vente) === TRUE) {
    echo "La vente a ete supprimee avec succes.";
} else {
    echo "Erreur lors de la suppression de la vente : " . $conn->error;
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
