<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Achat</title>
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
        input[type="number"],
        input[type="date"],
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
        @media screen and (max-width: 600px) {
            .container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ajouter un Achat</h2>
        <form method="post">
            <label for="Id_achat">Id de l'achat:</label>
            <input type="text" id="Id_achat" name="Id_achat" required>
            <label for="fournisseur">Fournisseur:</label>
            <select name="fournisseur" id="fournisseur" required>
                <option value="">Sélectionnez un ID de fournisseur</option>
                <?php
                // Connexion à la base de données
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "gestion_vente_production";
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("La connexion a échoué : " . $conn->connect_error);
                }
                // Requête pour récupérer les fournisseurs depuis la base de données
                $sql_fournisseurs = "SELECT Id_fournisseur, Nom_fournisseur FROM fournisseur";
                $result_fournisseurs = $conn->query($sql_fournisseurs);
                if ($result_fournisseurs->num_rows > 0) {
                    while($row = $result_fournisseurs->fetch_assoc()) {
                        echo "<option value='" . $row['Id_fournisseur'] . "'>" . $row['Nom_fournisseur'] . "</option>";
                    }
                }
                ?>
            </select>
            <label for="produit">Produit:</label>
            <select name="produit" id="produit" required>
                <option value="">Sélectionnez un ID de produit</option>
                <?php
                // Requête pour récupérer les produits depuis la base de données
                $sql_produits = "SELECT Id_produit, Nom_produit FROM produit";
                $result_produits = $conn->query($sql_produits);
                if ($result_produits->num_rows > 0) {
                    while($row = $result_produits->fetch_assoc()) {
                        echo "<option value='" . $row['Id_produit'] . "'>" . $row['Nom_produit'] . "</option>";
                    }
                }
                ?>
            </select>
            <label for="quantite">Quantité:</label>
            <input type="number" id="quantite" name="quantite" required>
            <label for="prix">Prix:</label>
            <input type="number" id="prix" name="prix" required>
            <label for="date_achat">Date d'Achat:</label>
            <input type="date" id="date_achat" name="date_achat" required>
            <input type="submit" value="Ajouter Achat">
        </form>
        <?php
        // Traitement du formulaire
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $Id_achat = $_POST["Id_achat"];
            $fournisseur_id = $_POST["fournisseur"];
            $produit_id = $_POST["produit"];
            $quantite = $_POST["quantite"];
            $prix = $_POST["prix"];
            $date_achat = $_POST["date_achat"];
            // Code pour insérer les données dans la table des achats
            $sql_insert = "INSERT INTO achats (Id_achat, Id_fournisseur, Id_produit, Quantite, Prix, Date_Achat) VALUES ('$Id_achat', '$fournisseur_id', '$produit_id', '$quantite', '$prix', '$date_achat')";
            if ($conn->query($sql_insert) === TRUE) {
                echo "<p>Achat ajouté avec succès.</p>";
            } else {
                echo "<p>Erreur lors de l'ajout de l'achat: " . $conn->error . "</p>";
            }
            $conn->close(); // Fermeture de la connexion à la base de données
        }
        ?>
    </div>
    <a href="dashboard.php">Retour au dashboard</a>
</body>
</html>
