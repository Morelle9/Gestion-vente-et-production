<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Ventes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            margin: 20px auto;
            overflow-x: auto;
        }

        h1 {
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

        .btn {
            display: inline-block;
            padding: 6px 12px;
            margin-bottom: 0;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.42857143;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            cursor: pointer;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .btn-edit {
            background-color: #5cb85c;
            color: #fff;
            border-color: #4cae4c;
        }

        .btn-delete {
            background-color: #d9534f;
            color: #fff;
            border-color: #d43f3a;
        }

        @media screen and (max-width: 600px) {
            .container {
                width: 100%;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 6px;
            }

            .btn {
                padding: 4px 8px;
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Liste des Ventes</h2>
        <table>
            <thead>
                <tr>
                    <th>ID Vente</th>
                    <th>ID Client</th>
                    <th>ID Vendeur</th>
                    <th>ID Produit</th>
                    <th>Quantité</th>
                    <th>Montant Vente</th>
                    <th>Date Vente</th>
                </tr>
            </thead>
            <tbody>
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

                // Récupération des ventes depuis la base de données
                $ventes_query = "SELECT * FROM ventes";
                $ventes_result = $conn->query($ventes_query);

                if ($ventes_result->num_rows > 0) {
                    // Affichage des ventes dans la table
                    while ($vente = $ventes_result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $vente['Id_vente'] . "</td>";
                        echo "<td>" . $vente['Id_client'] . "</td>";
                        echo "<td>" . $vente['id_vendeur'] . "</td>";
                        echo "<td>" . $vente['Id_produit'] . "</td>";
                        echo "<td>" . $vente['Quantite'] . "</td>";
                        echo "<td>" . $vente['Montant_vente'] . "</td>";
                        echo "<td>" . $vente['Date_vente'] . "</td>";
                        echo "<td>";
                        echo "<a class='btn btn-edit' href='modifier_vente.php?id={$vente['Id_vente']}'>Modifier</a>";
                        echo "<a class='btn btn-delete' href='supprimer_vente.php?id={$vente['Id_vente']}' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette vente ?\")'>Supprimer</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>Aucune vente trouvée</td></tr>";
                }
                // Fermeture de la connexion à la base de données
                $conn->close();
                ?>
            </tbody>
        </table>
        <a href="dashboard.php">Retour au dashboard</a>
    </div>
</body>
</html>
