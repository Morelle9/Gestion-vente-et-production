<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des utilisateur</title>
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
        <h1>Liste des utilisateur</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>sexe</th>
                    <th>Date naissance</th>
                    <th>Poste</th>
                    <th>Mot de passe</th>
                    <th>Action</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                try {
                    $db = new PDO('mysql:host=localhost;dbname=gestion_vente_production;charset=utf8', 'root', '');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    $stmt = $db->query("SELECT * FROM utilisateur");
                    $utilisateur = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($utilisateur as $utilisateur) {
                        echo "<tr>";
                        echo "<td>{$utilisateur['Id_utilisateur']}</td>";
                        echo "<td>{$utilisateur['nom_utilisateur']}</td>";
                        echo "<td>{$utilisateur['prenom_utilisateur']}</td>";
                        echo "<td>{$utilisateur['email_utilisateur']}</td>";
                        echo "<td>{$utilisateur['tel_utilisateur']}</td>";
                        echo "<td>{$utilisateur['sexe_utilisateur']}</td>";
                        echo "<td>{$utilisateur['date_naiss_utilisateur']}</td>";
                        echo "<td>{$utilisateur['poste_utilisateur']}</td>";
                        echo "<td>{$utilisateur['mdp_utilisateur']}</td>";
                        echo "<td>";
                        echo "<a class='btn btn-edit' href='modifier_utilisateur.php?id={$utilisateur['Id_utilisateur']}'>Modifier</a>";
                        echo "<a class='btn btn-delete' href='supprimerUtilisateur.php?id={$utilisateur['Id_utilisateur']}' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cet utilisateur ?\")'>Supprimer</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    
                    $db = null;
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
