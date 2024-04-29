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
    $Id_client = $_GET['id'];
    
    $sql = "SELECT * FROM clients WHERE Id_client = '$Id_client'";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0) {
        $client = $result->fetch_assoc();
    } else {
        echo "Aucun client trouvé avec cet identifiant.";
    }
} else {
    echo "Identifiant du client non spécifié.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les nouvelles valeurs du client à partir du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    $adresse = $_POST["adresse"];

    // Requête SQL pour mettre à jour le client
    $sql_update = "UPDATE clients SET Nom_client='$nom', Prenom_client='$prenom', Email_client='$email', Telephone_client='$telephone', Adresse_client='$adresse' WHERE Id_client='$Id_client'";
    
    if ($conn->query($sql_update) === TRUE) {
        $message = "Client modifié avec succès.";
    } else {
        $message = "Erreur lors de la modification du client: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Client</title>
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
        <h2>Modifier un Client</h2>
        <?php if (!empty($message)) echo "<p>$message</p>"; ?>
        <form method="post">
            <label for="nom">Nom du Client:</label>
            <input type="text" id="nom" name="nom" value="<?php echo $client['Nom_client']; ?>"><br><br>
            <label for="prenom">Prénom du Client:</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $client['Prenom_client']; ?>"><br><br>
            <label for="email">Email du Client:</label>
            <input type="email" id="email" name="email" value="<?php echo $client['Email_client']; ?>"><br><br>
            <label for="telephone">Téléphone du Client:</label>
            <input type="text" id="telephone" name="telephone" value="<?php echo $client['Telephone_client']; ?>"><br><br>
            <label for="adresse">Adresse du Client:</label>
            <input type="text" id="adresse" name="adresse" value="<?php echo $client['Adresse_client']; ?>"><br><br>
            <input type="submit" value="Modifier Client">
        </form>
        <a href="dashboard.php">Retour au dashboard</a>
    </div>
</body>
</html>
