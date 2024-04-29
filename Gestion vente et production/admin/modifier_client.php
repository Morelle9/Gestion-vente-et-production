<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_vente_production";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

$message = ""; // Initialisez le message à vide

if(isset($_GET['id'])) {
    $Id_produit = $_GET['id'];
    
    $sql = "SELECT * FROM produit WHERE Id_produit = '$Id_produit'";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0) {
        $produit = $result->fetch_assoc();
    } else {
        echo "Aucun produit trouvé avec cet identifiant.";
    }
} else {
    echo "Identifiant du produit non spécifié.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les nouvelles valeurs du produit à partir du formulaire
    $Categorie = $_POST["categorie"];
    $Nom_produit = $_POST["nom_produit"];
    $Description = $_POST["description"];
    $Prix = $_POST["prix"];
    $Date_expiration = $_POST["date_expiration"];
    $Date_fabrication = $_POST["date_fabrication"];

    // Requête SQL pour mettre à jour le produit
    $sql_update = "UPDATE produit SET Categorie='$Categorie', Nom_produit='$Nom_produit', Description='$Description', Prix=$Prix, Date_expiration='$Date_expiration', Date_fabrication='$Date_fabrication' WHERE Id_produit='$Id_produit'";
    
    if ($conn->query($sql_update) === TRUE) {
        $message = "Produit modifié avec succès.";
    } else {
        $message = "Erreur lors de la modification du produit: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Produit</title>
    <!-- Styles et Responsive ici -->
</head>
<body>
    <div class="container">
        <h2>Modifier un Produit</h2>
        <?php if (!empty($message)) echo "<p>$message</p>"; ?>
        <form method="post">
            <label for="categorie">Catégorie:</label>
            <input type="text" id="categorie" name="categorie" value="<?php echo $produit['Categorie']; ?>"><br><br>
            <label for="nom_produit">Nom du Produit:</label>
            <input type="text" id="nom_produit" name="nom_produit" value="<?php echo $produit['Nom_produit']; ?>"><br><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?php echo $produit['Description']; ?></textarea><br><br>
            <label for="prix">Prix:</label>
            <input type="number" id="prix" name="prix" value="<?php echo $produit['Prix']; ?>"><br><br>
            <label for="date_expiration">Date d'Expiration:</label>
            <input type="date" id="date_expiration" name="date_expiration" value="<?php echo $produit['Date_expiration']; ?>"><br><br>
            <label for="date_fabrication">Date de Fabrication:</label>
            <input type="date" id="date_fabrication" name="date_fabrication" value="<?php echo $produit['Date_fabrication']; ?>"><br><br>
            <input type="submit" value="Modifier Produit">
        </form>
        <a href="dashboard.php">Retour au dashboard</a>
    </div>
</body>
</html>
