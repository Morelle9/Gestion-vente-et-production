<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Utilisateur</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            max-width: 500px;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        input[type="submit"] {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error-message {
            color: #ff0000;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ajouter un Utilisateur</h2>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gestion_vente_production";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("La connexion a échoué : " . $conn->connect_error);
        }

        // Vérification si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Assurez-vous que tous les champs requis sont définis dans $_POST
            if(isset($_POST["id"]) && isset ($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["email"]) && isset($_POST["telephone"]) && isset($_POST["sexe"]) && isset($_POST["date_naiss"]) && isset($_POST["poste"]) && isset($_POST["mdp"]) ) {
                // Assignation des valeurs des champs du formulaire à des variables
                $id = $_POST["id"];
                $nom = $_POST["nom"];
                $prenom = $_POST["prenom"];
                $email = $_POST["email"];
                $telephone = $_POST["telephone"];
                $sexe = $_POST["sexe"];
                $date_naiss = $_POST["date_naiss"];
                $poste = $_POST["poste"];
                $mdp = $_POST["mdp"];

                // Vérifier si l'utilisateur existe déjà dans la base de données
                $check_query = "SELECT * FROM utilisateur WHERE Id_utilisateur='$id' AND nom_utilisateur='$nom' AND prenom_utilisateur='$prenom' AND email_utilisateur='$email' AND tel_utilisateur='$telephone' AND sexe_utilisateur='$sexe' AND date_naiss_utilisateur='$date_naiss' AND poste_utilisateur='$poste' AND mdp_utilisateur='$mdp'";
                $result = $conn->query($check_query);

                if ($result->num_rows > 0) {
                    // L'utilisateur existe déjà
                    echo "<p class='error-message'>Cet utilisateur existe déjà dans la base de données.</p>";
                } else {
                    // L'utilisateur n'existe pas, procéder à l'insertion
                    $insert_query = "INSERT INTO utilisateur (Id_utilisateur, nom_utilisateur, prenom_utilisateur, email_utilisateur, tel_utilisateur, sexe_utilisateur, date_naiss_utilisateur, poste_utilisateur, mdp_utilisateur) VALUES ('$id', '$nom', '$prenom', '$email', '$telephone', '$sexe','$date_naiss', '$poste', '$mdp' )";
                    if ($conn->query($insert_query) === TRUE) {
                        echo "<p>Utilisateur ajouté avec succès!</p>";
                    } else {
                        echo "<p class='error-message'>Erreur lors de l'ajout d'un utilisateur: " . $conn->error . "</p>";
                    }
                }
            } else {
                echo "<p class='error-message'>Tous les champs requis n'ont pas été remplis.</p>";
            }
        }
        ?>
        <form method="post">
            <label for="id">Id de l'Utilisateur:</label>
            <input type="text" id="id" name="id" required>    
            <label for="nom">Nom de l'Utilisateur:</label>
            <input type="text" id="nom" name="nom" required>
            <label for="prenom">Prénom de l'Utilisateur:</label>
            <input type="text" id="prenom" name="prenom" required>
            <label for="email">Email de l'Utilisateur:</label>
            <input type="email" id="email" name="email" required>
            <label for="telephone">Téléphone de l'Utilisateur:</label>
            <input type="text" id="telephone" name="telephone" required>
            <label for="date_naiss">Date de naissance de l'Utilisateur:</label>
            <input type="date" id="date_naiss" name="date_naiss" required>
            <label for="poste">Poste de l'Utilisateur:</label>
            <input type="text" id="poste" name="poste" required>
            <label for="mdp">Mot de passe de l'Utilisateur:</label>
            <input type="password" id="mdp" name="mdp" required>
            <input type="submit" value="Ajouter Utilisateur">
        </form>
    </div>
</body>
</html>
