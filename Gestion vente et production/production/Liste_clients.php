<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
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
    <h2>Liste des Clients</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $host = "localhost";
            $username = "root";
            $password = "";
            $dbname = "gestion_vente_production";

            try {
                $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM clients";
                $stmt = $conn->query($sql);

                while ($row = $stmt->fetch()) {
                    echo "<tr>
                            <td>{$row['Id_client']}</td>
                            <td>{$row['Nom_client']}</td>
                            <td>{$row['Prenom_client']}</td>
                            <td>{$row['Adresse_client']}</td>
                            <td>{$row['Telephone_client']}</td>
                            <td>{$row['Email_client']}</td>
                            <td>
                                <a href='modifier_client.php?id={$row['Id_client']}'>Modifier</a> |
                                <a href='supprimer_client.php?id={$row['Id_client']}' onclick=\"return confirm('Êtes-vous sûr de vouloir supprimer ce client ?');\">Supprimer</a>
                            </td>
                          </tr>";
                }

            } catch(PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            ?>
        </tbody>
    </table>
    <a href="dashboard.php">Retour au dashboard</a>
</div>

</body>
</html>
