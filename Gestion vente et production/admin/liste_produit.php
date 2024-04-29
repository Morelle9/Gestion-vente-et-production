<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Produits</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Liste des Produits</h2>
        <table>
            <thead>
                <tr>
                    <th>Id du Produit</th>
                    <th>Nom du Produit</th>
                    <th>Categorie</th>
                    <th>Description du Produit</th>
                    <th>Prix du Produit</th>
                    <th>Date d'expiration</th>
                    <th>Date de fabrication</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "gestion_vente_production";
                $conn = new mysqli($servername, $username, $password, $dbname);
                if ($conn->connect_error) {
                    die("La connexion a échoué : " . $conn->connect_error);
                }

                $sql = "SELECT * FROM produit";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row["Id_produit"]."</td>";
                        echo "<td>".$row["Nom_produit"]."</td>";
                        echo "<td>".$row["Categorie"]."</td>";
                        echo "<td>".$row["Description"]."</td>";
                        echo "<td>".$row["Prix"]."</td>";
                        echo "<td>".$row["Date_expiration"]."</td>";
                        echo "<td>".$row["Date_fabrication"]."</td>";
                        echo "<td class='actions'>
                                <a href='modifier_produit.php?id=".$row["Id_produit"]."'>Modifier</a>
                                <a href='supprimer_produit.php?id=".$row["Id_produit"]."'>Supprimer</a>
                            </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Aucun produit trouvé.</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <a href="dashboard.php">Retour au dashboard</a>
    </div>
</body>
</html>
