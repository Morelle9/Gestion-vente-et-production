<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Produit</title>
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
        <h2>Ajouter un Produit</h2>
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
            if(isset($_POST["id"]) && isset($_POST["nom"]) && isset($_POST["categorie"]) && isset($_POST["description"]) && isset($_POST["prix"]) && isset($_POST["date_expiration_produit"]) && isset($_POST["date_fabrication_produit"])) {
                // Assignation des valeurs des champs du formulaire à des variables
                $id = $_POST["id"];
                $nom = $_POST["nom"];
                $categorie = $_POST["categorie"];
                $description = $_POST["description"];
                $prix = $_POST["prix"];
                $date_expiration_produit = $_POST["date_expiration_produit"];
                $date_fabrication_produit = $_POST["date_fabrication_produit"];

                // Vérifier si le produit existe déjà dans la base de données
                $check_query = "SELECT * FROM produit WHERE Id_produit='$id' AND Nom_produit='$nom' AND Categorie='$categorie' AND Description='$description' AND Prix='$prix' AND Date_expiration='$date_expiration_produit' AND Date_fabrication='$date_fabrication_produit'";
                $result = $conn->query($check_query);

                if ($result === TRUE) {
                    // Le produit existe déjà
                    echo "<p>Ce produit existe déjà dans la base de données.</p>";
                } else {
                    // Le produit n'existe pas, procéder à l'insertion
                    $insert_query = "INSERT INTO produit (Id_produit, Nom_produit, Categorie, Description, Prix, Date_expiration, Date_fabrication) VALUES ('$id', '$nom', '$categorie', '$description', '$prix','$date_expiration_produit', '$date_fabrication_produit')";
                    if ($conn->query($insert_query) === TRUE) {
                        echo "<p>Produit ajouté avec succès!</p>";
                    } else {
                        echo "<p>Erreur lors de l'ajout du produit: " . $conn->error . "</p>";
                    }
                }
            } else {
                echo "<p>Tous les champs requis n'ont pas été remplis.</p>";
            }
        }
        ?>
        <form method="post">
        <label for="id">Id du Produit:</label>
            <input type="text" id="id" name="id" required>    
        <label for="nom">Nom du Produit:</label>
            <input type="text" id="nom" name="nom" required>
            <label for="categorie">Categorie:</label>
            <input type="text" id="categorie" name="categorie" required>
            <label for="description">Description du Produit:</label>
            <textarea id="description" name="description" required></textarea>
            <label for="prix">Prix du Produit:</label>
            <input type="number" id="prix" name="prix" required>
            <label for="Date_expiration">Date d'expiration du Produit:</label>
            <input type="date" id="date_expiration_produit" name="date_expiration_produit" required>
            <label for="Date_fabrication">Date de fabrication du Produit:</label>
            <input type="date" id="date_fabrication_produit" name="date_fabrication_produit" required>
            <input type="submit" value="Ajouter Produit">
        </form>
        <a href="dashboard.php">Retour au dashboard</a>
    </div>
</body>
</html>
