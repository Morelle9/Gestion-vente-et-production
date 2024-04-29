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
    $Id_utilisateur = $_GET['id'];
    
    $sql = "SELECT * FROM utilisateur WHERE Id_utilisateur = $Id_utilisateur";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0) {
        $utilisateur = $result->fetch_assoc();
    } else {
        echo "Aucun utilisateur trouvé avec cet identifiant.";
    }
} else {
    echo "Identifiant de l'utilisateur non spécifié.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez les nouvelles valeurs de l'utilisateur à partir du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $telephone = $_POST["telephone"];
    $date_naiss = $_POST["date_naiss"];
    $poste = $_POST["poste"];
    $mdp = $_POST["mdp"];

    // Requête SQL pour mettre à jour l'utilisateur
    $sql_update = "UPDATE utilisateur SET nom_utilisateur='$nom', prenom_utilisateur='$prenom', email_utilisateur='$email', tel_utilisateur='$telephone', date_naiss_utilisateur='$date_naiss', poste_utilisateur='$poste', mdp_utilisateur='$mdp' WHERE Id_utilisateur='$Id_utilisateur'";
    
    if ($conn->query($sql_update) === TRUE) {
        $message = "Utilisateur modifié avec succès.";
    } else {
        $message = "Erreur lors de la modification de l'utilisateur: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Utilisateur</title>
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
        <h2>Modifier un Utilisateur</h2>
        <?php if (!empty($message)) echo "<p>$message</p>"; ?>
        <form method="post">
            <label for="nom">Nom de l'Utilisateur:</label>
            <input type="text" id="nom" name="nom" value="<?php echo $utilisateur['nom_utilisateur']; ?>"><br><br>
            <label for="prenom">Prénom de l'Utilisateur:</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $utilisateur['prenom_utilisateur']; ?>"><br><br>
            <label for="email">Email de l'Utilisateur:</label>
            <input type="email" id="email" name="email" value="<?php echo $utilisateur['email_utilisateur']; ?>"><br><br>
            <label for="telephone">Téléphone de l'Utilisateur:</label>
            <input type="text" id="telephone" name="telephone" value="<?php echo $utilisateur['tel_utilisateur']; ?>"><br><br>
            <label for="date_naiss">Date de naissance de l'Utilisateur:</label>
            <input type="date" id="date_naiss" name="date_naiss" value="<?php echo $utilisateur['date_naiss_utilisateur']; ?>"><br><br>
            <label for="poste">Poste de l'Utilisateur:</label>
            <input type="text" id="poste" name="poste" value="<?php echo $utilisateur['poste_utilisateur']; ?>"><br><br>
            <label for="mdp">Mot de passe de l'Utilisateur:</label>
            <input type="password" id="mdp" name="mdp" value="<?php echo $utilisateur['mdp_utilisateur']; ?>"><br><br>
            <input type="submit" value="Modifier Utilisateur">
        </form>
        <a href="liste_utilisateur.php">Retour à la liste des utilisateurs</a>
    </div>
</body>
</html>
