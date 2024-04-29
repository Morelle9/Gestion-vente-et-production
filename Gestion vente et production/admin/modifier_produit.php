<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_vente_production";

// Créez une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifiez la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

$message = "";

// Vérifiez si l'identifiant du produit est présent
if(isset($_GET['id'])) {
    $Id_produit = $conn->real_escape_string($_GET['id']);
    
    // Récupérer les données du produit
    $sql = "SELECT * FROM produit WHERE Id_produit = '$Id_produit'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $produit = $result->fetch_assoc();
    } else {
        die("Aucun produit trouvé avec cet identifiant.");
    }
}

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["modifier"])) {
    $categorie = $conn->real_escape_string($_POST["categorie"]);
    $nom_produit = $conn->real_escape_string($_POST["nom_produit"]);
    $description = $conn->real_escape_string($_POST["description"]);
    $prix = intval($_POST["prix"]);
    $date_expiration = $conn->real_escape_string($_POST["date_expiration"]);
    $date_fabrication = $conn->real_escape_string($_POST["date_fabrication"]);

    // Mettez à jour les informations du produit
    $sql_update = "UPDATE produit SET Categorie='$categorie', Nom_produit='$nom_produit', Description='$description', Prix=$prix, Date_expiration='$date_expiration', Date_fabrication='$date_fabrication' WHERE Id_produit='$Id_produit'";
    
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"],
        input[type="date"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        @media screen and (max-width: 600px) {
            .container {
                width: 100%;
                padding: 15px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Modifier un Produit</h2>
    <?php if (!empty($message)) { echo "<p>$message</p>"; } ?>
    <form method="post">
        <label for="categorie">Catégorie:</label>
        <input type="text" id="categorie" name="categorie" value="<?php echo $produit['Categorie']; ?>" required>

        <label for="nom_produit">Nom du Produit:</label>
        <input type="text" id="nom_produit" name="nom_produit" value="<?php echo $produit['Nom_produit']; ?>" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?php echo $produit['Description']; ?></textarea>

        <label for="prix">Prix:</label>
        <input type="number" id="prix" name="prix" value="<?php echo $produit['Prix']; ?>" required>

        <label for="date_expiration">Date d'Expiration:</label>
        <input type="date" id="date_expiration" name="date_expiration" value="<?php echo $produit['Date_expiration']; ?>" required>

        <label for="date_fabrication">Date de Fabrication:</label>
        <input type="date" id="date_fabrication" name="date_fabrication" value="<?php echo $produit['Date_fabrication']; ?>" required>

        <input type="submit" name="modifier" value="Modifier Produit">
    </form>
    <a href="dashboard.php">Retour au dashboard</a>
</div>
</body>
</html>
