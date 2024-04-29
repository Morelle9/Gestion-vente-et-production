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

// Récupération de l'ID du client à supprimer depuis l'URL
$client_id = $_GET['id'];

// Construction de la requête SQL pour supprimer la vente de la base de données
$sql_supprimer_client = "DELETE FROM clients WHERE Id_client='$client_id'";

// Exécution de la requête pour supprimer la vente
if ($conn->query($sql_supprimer_client) === TRUE) {
    echo "Le client a ete supprime avec succes.";
} else {
    echo "Erreur lors de la suppression du client : " . $conn->error;
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
<a href="dashboard.php">Retour au dashboard</a>