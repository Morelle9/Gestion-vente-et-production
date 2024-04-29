<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_vente_production";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Vérifier si un ID d'achat est spécifié dans l'URL
if(isset($_GET['id'])) {
    $id_achat = $_GET['id'];
    
    // Requête SQL pour supprimer l'achat avec l'ID spécifié
    $sql_delete = "DELETE FROM achats WHERE Id_achat = '$id_achat'";
    
    if ($conn->query($sql_delete) === TRUE) {
        echo "Achat supprime avec succes.";
    } else {
        echo "Erreur lors de la suppression de l'achat: " . $conn->error;
    }
} else {
    echo "Identifiant de l'achat non spécifié.";
}

$conn->close();
?>
<a href="dashboard.php">Retour au dashboard</a>