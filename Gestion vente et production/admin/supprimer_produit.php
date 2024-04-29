<?php
// Vérifier si l'ID du produit à supprimer est présent dans l'URL
if(isset($_GET['id'])) {
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

    // Récupérer l'ID du produit à supprimer depuis l'URL
    $id_produit = $_GET['id'];

    // Requête SQL pour supprimer le produit avec l'ID spécifié
    $sql = "DELETE FROM produit WHERE Id_produit='$id_produit'";

    // Exécuter la requête de suppression
    if ($conn->query($sql) === TRUE) {
        // Redirection vers la page de liste des produits après la suppression
        header("Location: liste_produit.php");
        exit(); // Arrêter l'exécution du script après la redirection
    } else {
        echo "Erreur lors de la suppression du produit: " . $conn->error;
    }

    // Fermer la connexion à la base de données
    $conn->close();
} else {
    // Si l'ID du produit à supprimer n'est pas présent dans l'URL, afficher un message d'erreur
    echo "L'identifiant du produit à supprimer n'est pas spécifié.";
}
?>
