<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gestion_vente_production";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Initialiser les variables de recherche
$search_keyword = "";
$product_list = array();

// Vérifier si une recherche a été effectuée
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search_keyword = $_POST["search"];

    // Requête SQL pour rechercher le produit
    $sql = "SELECT * FROM produit WHERE Nom_produit LIKE '%$search_keyword%'";

    // Exécuter la requête
    $result = $conn->query($sql);

    // Récupérer les résultats de la recherche
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $product_list[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher un Produit</title>
    <style>
        /* Styles CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
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
        <h2>Rechercher un Produit</h2>
        <form method="post">
            <label for="search">Recherche:</label>
            <input type="text" id="search" name="search" value="<?php echo $search_keyword; ?>" placeholder="Entrez le nom du produit...">
            <input type="submit" value="Rechercher">
        </form>
        <?php if (!empty($product_list)): ?>
            <h3>Résultats de la recherche:</h3>
            <ul>
                <?php foreach ($product_list as $product): ?>
                    <li>
                        <strong><?php echo $product['Nom_produit']; ?></strong> - <?php echo $product['Description']; ?> (<?php echo $product['Prix']; ?> $)
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>
