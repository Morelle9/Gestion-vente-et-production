<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Produit</title>
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
        <h2>Modifier un Produit</h2>
        <form method="post">
            <label for="id">ID du Produit à Modifier:</label>
            <select name="id" id="id" required>
                <option value="">Sélectionnez un ID d'un produit</option>
                <?php
                // Connexion à la base de données
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "gestion_vente_production";
                $conn = new mysqli($servername, $username, $password, $dbname);
                
                // Vérifier la connexion
                if ($conn->connect_error) {
                    die("La connexion a échoué : " . $conn->connect_error);
                }

                // Requête pour récupérer tous les IDs des produits
                $sql = "SELECT Id_produit FROM produit";
                $result = $conn->query($sql);

                // Afficher chaque ID produit dans une option du menu déroulant
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['Id_produit'] . "'>" . $row['Id_produit'] . "</option>";
                    }
                } else {
                    echo "Aucun produit trouvé.";
                }
                ?>
            </select>
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
            <input type="submit" value="Modifier Produit">
        </form>
    </div>
</body>
</html>
