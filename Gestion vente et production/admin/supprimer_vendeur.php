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
    $Id_vendeur = $_GET['id'];
    
    $sql = "SELECT * FROM vendeur WHERE id_vendeur = $Id_vendeur";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0) {
        $vendeur = $result->fetch_assoc();
    } else {
        echo "Aucun vendeur trouvé avec cet identifiant.";
    }
} else {
    echo "Identifiant du vendeur non spécifié.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer l'ID du vendeur à supprimer
    $Id_vendeur = $_POST["id"];

    // Requête SQL pour supprimer le vendeur
    $sql_delete = "DELETE FROM vendeur WHERE id_vendeur='$Id_vendeur'";
    
    if ($conn->query($sql_delete) === TRUE) {
        $message = "Vendeur supprimé avec succès.";
    } else {
        $message = "Erreur lors de la suppression du vendeur: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un Vendeur</title>
    <style>
        /* Styles CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
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
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="submit"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #d9534f;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #c9302c;
        }

        /* Styles spécifiques pour la mise en page responsive */
        @media screen and (max-width: 600px) {
        .container {
            width: 90%;
            margin: 30px auto;
        }
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Supprimer un Vendeur</h2>
        <?php if (!empty($message)) echo "<p>$message</p>"; ?>
        <form method="post">
            <label for="id">ID du Vendeur à supprimer:</label>
            <input type="text" id="id" name="id" value="<?php echo $vendeur['id_vendeur']; ?>" readonly><br><br>
            <input type="submit" value="Supprimer Vendeur">
        </form>
        <a href="dashboard.php">Retour au dashboard</a>
    </div>
</body>
</html>
