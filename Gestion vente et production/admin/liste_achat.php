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
$achats = array();

// Récupérer les données des achats depuis la base de données
$sql = "SELECT * FROM achats";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Parcourir les résultats de la requête et ajouter chaque ligne dans le tableau des achats
    while($row = $result->fetch_assoc()) {
        $achats[] = $row;
    }
} else {
    echo "Aucun achat trouvé.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Achats</title>
    <style>
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .actions a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
        }
        .actions a:hover {
            background-color: #45a049;
        }
        .btn-dashboard {
            display: block;
            width: 100px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-dashboard:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Liste des Achats</h2>
        <table>
            <thead>
                <tr>
                    <th>ID de l'Achat</th>
                    <th>ID du Fournisseur</th>
                    <th>ID du Produit</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Date de l'Achat</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Afficher chaque achat dans une ligne du tableau
                foreach($achats as $achat) {
                    echo "<tr>";
                    echo "<td>".$achat["Id_achat"]."</td>";
                    echo "<td>".$achat["Id_fournisseur"]."</td>";
                    echo "<td>".$achat["Id_produit"]."</td>";
                    echo "<td>".$achat["Quantite"]."</td>";
                    echo "<td>".$achat["Prix"]."</td>";
                    echo "<td>".$achat["Date_Achat"]."</td>";
                    echo "<td class='actions'>
                            <a href='modifier_achat.php?id=".$achat["Id_achat"]."'>Modifier</a>
                            <a href='supprimer_achat.php?id=".$achat["Id_achat"]."'>Supprimer</a>
                        </td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="dashboard.php" class="btn-dashboard">Retour au Dashboard</a>
    </div>
</body>
</html>
