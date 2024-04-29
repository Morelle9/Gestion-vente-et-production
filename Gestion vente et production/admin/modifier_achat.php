<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_vente_production";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Initialiser la variable d'achat
$achat = array();
$message = ""; // Initialisez le message à vide

// Vérifier si un ID d'achat est spécifié
if(isset($_GET['id'])) {
    $id_achat = $_GET['id'];
    
    // Requête SQL pour récupérer les données de l'achat spécifié
    $sql = "SELECT * FROM achats WHERE Id_achat = '$id_achat'";
    $result = $conn->query($sql);
    
    if($result->num_rows > 0) {
        $achat = $result->fetch_assoc();
    } else {
        echo "Aucun achat trouvé avec cet identifiant.";
    }
} else {
    echo "Identifiant de l'achat non spécifié.";
}

// Récupérer les données des fournisseurs depuis la base de données
$sql_fournisseurs = "SELECT Id_fournisseur, Nom_fournisseur FROM fournisseur";
$result_fournisseurs = $conn->query($sql_fournisseurs);

// Récupérer les données des produits depuis la base de données
$sql_produits = "SELECT Id_produit, Nom_produit FROM produit";
$result_produits = $conn->query($sql_produits);

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les nouvelles valeurs de l'achat à partir du formulaire
    $id_fournisseur = $_POST["fournisseur"];
    $id_produit = $_POST["produit"];
    $quantite = $_POST["quantite"];
    $prix = $_POST["prix"];
    $date_achat = $_POST["date_achat"];

    // Requête SQL pour mettre à jour l'achat
    $sql_update = "UPDATE achats SET Id_fournisseur='$id_fournisseur', Id_produit='$id_produit', Quantite='$quantite', Prix='$prix', Date_Achat='$date_achat' WHERE Id_achat='$id_achat'";
    
    if ($conn->query($sql_update) === TRUE) {
        $message = "Achat modifié avec succès.";
    } else {
        $message = "Erreur lors de la modification de l'achat: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Achat</title>
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

        .message {
            background-color: #f2f2f2;
            color: #333;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
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
        <h2>Modifier un Achat</h2>
        <?php if (!empty($message)) echo "<div class='message'>$message</div>"; ?>
        <form method="post">
            <label for="fournisseur">Fournisseur:</label>
            <select id="fournisseur" name="fournisseur">
                <?php
                // Afficher les options pour les fournisseurs
                if ($result_fournisseurs->num_rows > 0) {
                    while($row = $result_fournisseurs->fetch_assoc()) {
                        echo "<option value='" . $row['Id_fournisseur'] . "'";
                        // Sélectionner le fournisseur correspondant à l'achat
                        if($row['Id_fournisseur'] == $achat['Id_fournisseur']) {
                            echo " selected";
                        }
                        echo ">" . $row['Nom_fournisseur'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Aucun fournisseur trouvé</option>";
                }
                ?>
            </select>
            <label for="produit">Produit:</label>
            <select id="produit" name="produit">
                <?php
                // Afficher les options pour les produits
                if ($result_produits->num_rows > 0) {
                    while($row = $result_produits->fetch_assoc()) {
                        echo "<option value='" . $row['Id_produit'] . "'";
                        // Sélectionner le produit correspondant à l'achat
                        if($row['Id_produit'] == $achat['Id_produit']) {
                            echo " selected";
                        }
                        echo ">" . $row['Nom_produit'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Aucun produit trouvé</option>";
                }
                ?>
            </select>
            <label for="quantite">Quantité:</label>
            <input type="number" id="quantite" name="quantite" value="<?php echo $achat['Quantite']; ?>"><br><br>
            <label for="prix">Prix:</label>
            <input type="number" id="prix" name="prix" value="<?php echo $achat['Prix']; ?>"><br><br>
            <label for="date_achat">Date de l'Achat:</label>
            <input type="date" id="date_achat" name="date_achat" value="<?php echo $achat['Date_Achat']; ?>"><br><br>
            <input type="submit" value="Modifier Achat">
        </form>
        <a href="dashboard.php">Retour au dashboard</a>
    </div>
</body>
</html>
