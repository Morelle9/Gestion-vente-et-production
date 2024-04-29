<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Fournisseur</title>
    <style>
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
        input[type="submit"] {
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Ajouter un Fournisseur</h2>
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
            if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["adresse"]) && isset($_POST["telephone"]) && isset($_POST["email"]) && isset($_POST["id"])) {
                // Assignation des valeurs des champs du formulaire à des variables
                $nom = $_POST["nom"];
                $prenom = $_POST["prenom"];
                $adresse = $_POST["adresse"];
                $telephone = $_POST["telephone"];
                $email = $_POST["email"];
                $id = $_POST["id"];

                // Vérifier si le fournisseur existe déjà dans la base de données
                $check_query = "SELECT * FROM fournisseur WHERE Nom_fournisseur='$nom' AND Prenom_fournisseur='$prenom' AND Adresse_fournisseur='$adresse' AND Telephone_fournisseur='$telephone' AND Email_fournisseur='$email' AND Id_fournisseur='$id'";
                $result = $conn->query($check_query);

                if ($result->num_rows > 0) {
                    // Le fournisseur existe déjà
                    echo "<p>Ce fournisseur existe déjà dans la base de données.</p>";
                } else {
                    // Le fournisseur n'existe pas, procéder à l'insertion
                    $insert_query = "INSERT INTO fournisseur (Nom_fournisseur, Prenom_fournisseur, Adresse_fournisseur, Telephone_fournisseur, Email_fournisseur, Id_fournisseur) VALUES ('$nom', '$prenom', '$adresse', '$telephone', '$email','$id')";
                    if ($conn->query($insert_query) === TRUE) {
                        echo "<p>Fournisseur ajouté avec succès!</p>";
                    } else {
                        echo "<p>Erreur lors de l'ajout du fournisseur: " . $conn->error . "</p>";
                    }
                }
            } else {
                echo "<p>Tous les champs requis n'ont pas été remplis.</p>";
            }
        }
        ?>
        <form method="post">
        <label for="id">Id du Fournisseur:</label>
            <input type="text" id="id" name="id" required>    
        <label for="nom">Nom du Fournisseur:</label>
            <input type="text" id="nom" name="nom" required>
            <label for="prenom">Prénom du Fournisseur:</label>
            <input type="text" id="prenom" name="prenom" required>
            <label for="adresse">Adresse du Fournisseur:</label>
            <input type="text" id="adresse" name="adresse" required>
            <label for="telephone">Téléphone du Fournisseur:</label>
            <input type="text" id="telephone" name="telephone" required>
            <label for="email">Email du Fournisseur:</label>
            <input type="email" id="email" name="email" required>
            <input type="submit" value="Ajouter Fournisseur">
        </form>
    </div>
</body>
</html>
