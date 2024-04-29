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
    // Récupérez les nouvelles valeurs du vendeur à partir du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $adresse = $_POST["adresse"];
    $telephone = $_POST["telephone"];
    $id = $_POST["id"];
    $mdp = $_POST["mdp"];

    // Requête SQL pour mettre à jour le vendeur
    $sql_update = "UPDATE vendeur SET Nom_vendeur='$nom', Prenom_vendeur='$prenom', Email_vendeur='$email', Adresse_vendeur='$adresse', Telephone_vendeur='$telephone', mdp_vendeur='$mdp' WHERE id_vendeur='$Id_vendeur'";
    
    if ($conn->query($sql_update) === TRUE) {
        $message = "Vendeur modifié avec succès.";
    } else {
        $message = "Erreur lors de la modification du vendeur: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Vendeur</title>
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
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
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
        <h2>Modifier un Vendeur</h2>
        <?php if (!empty($message)) echo "<p>$message</p>"; ?>
        <form method="post">
            <label for="nom">Nom du Vendeur:</label>
            <input type="text" id="nom" name="nom" value="<?php echo $vendeur['Nom_vendeur']; ?>"><br><br>

            <label for="prenom">Prénom du Vendeur:</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $vendeur['Prenom_vendeur']; ?>"><br><br>

            <label for="id">Id du Vendeur:</label>
            <input type="text" id="id" name="id" value="<?php echo $vendeur['id_vendeur']; ?>"><br><br>

            <label for="telephone">Téléphone du Vendeur:</label>
            <input type="text" id="telephone" name="telephone" value="<?php echo $vendeur['Telephone_vendeur']; ?>"><br><br>

            <label for="adresse">Adresse du Vendeur:</label>
            <input type="text" id="adresse" name="adresse" value="<?php echo $vendeur['Adresse_vendeur']; ?>"><br><br>

            <label for="email">Email du Vendeur:</label>
            <input type="email" id="email" name="email" value="<?php echo $vendeur['Email_vendeur']; ?>"><br><br>

            <label for="mdp">Mot de passe du Vendeur:</label>
            <input type="password" id="mdp" name="mdp" value="<?php echo $vendeur['mdp_vendeur']; ?>"><br><br>
            <input type="submit" value="Modifier Vendeur">
        </form>
        <a href="dashboard.php">Retour au dashboard</a>
    </div>
</body>
</html>
