<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapport du meilleur commercial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        canvas {
            margin: 0 auto;
            display: block;
            max-width: 600px;
        }

        p {
            text-align: center;
            margin-bottom: 10px;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #333;
        }

        a:hover {
            color: #555;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Rapport du meilleur commercial</h2>

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

    // Requête SQL pour récupérer le total des ventes de chaque commercial avec leurs noms
    $sql = "SELECT vendeur.Nom_vendeur AS Nom_vendeur, SUM(ventes.Montant_vente) AS total_ventes 
            FROM ventes 
            INNER JOIN vendeur ON ventes.id_vendeur = vendeur.id_vendeur
            GROUP BY ventes.id_vendeur";

    $result = $conn->query($sql);

    // Vérifier si des lignes ont été renvoyées
    if ($result) {
        if ($result->num_rows > 0) {
            // Création des données pour le graphique
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[$row["Nom_vendeur"]] = $row["total_ventes"];
            }

            // Détermination du meilleur vendeur
            arsort($data);
            $meilleur_vendeur = key($data);
            $total_ventes_meilleur_vendeur = reset($data);

            // Fermeture de la connexion à la base de données
            $conn->close();

            // Affichage des statistiques sous forme de graphique
            echo "<canvas id='ventesChart'></canvas>";
            echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js'></script>";
            echo "<script>";
            echo "var data = " . json_encode($data) . ";";
            echo "var labels = Object.keys(data);";
            echo "var values = Object.keys(data).map(function(key) { return data[key]; });";
            echo "var ctx = document.getElementById('ventesChart').getContext('2d');";
            echo "var chart = new Chart(ctx, {";
            echo "    type: 'bar',";
            echo "    data: {";
            echo "        labels: labels,";
            echo "        datasets: [{";
            echo "            label: 'Total des ventes par commercial',";
            echo "            data: values,";
            echo "            backgroundColor: 'rgba(75, 192, 192, 0.2)',";
            echo "            borderColor: 'rgba(75, 192, 192, 1)',";
            echo "            borderWidth: 1";
            echo "        }]";
            echo "    },";
            echo "    options: {";
            echo "        scales: {";
            echo "            yAxes: [{";
            echo "                ticks: {";
            echo "                    beginAtZero: true";
            echo "                }";
            echo "            }]";
            echo "        }";
            echo "    }";
            echo "});";
            echo "</script>";

            // Affichage du meilleur vendeur
            echo "<h2>Meilleur vendeur</h2>";
            echo "<p>Nom du commercial : " . $meilleur_vendeur . "</p>";
            echo "<p>Total des ventes : " . $total_ventes_meilleur_vendeur . "</p>";
        } else {
            echo "<p>Aucune vente enregistrée.</p>";
        }
    } else {
        echo "<p>Erreur lors de l'exécution de la requête SQL : " . $conn->error . "</p>";
    }

    ?>

</div>
<a href="dashboard.php">Retour au dashboard</a>
</body>
</html>
