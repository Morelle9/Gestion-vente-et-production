<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques des Ventes</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        canvas {
            width: 100%;
            height: 300px;
        }
    </style>
</head>
<body>
<div class="container">
        <h2>Statistiques des Ventes</h2>
        <canvas id="dailyChart"></canvas>
        <canvas id="weeklyChart"></canvas>
        <canvas id="monthlyChart"></canvas>
        <canvas id="yearlyChart"></canvas>
    </div>

    <script>
        // Récupérer les données des ventes pour chaque période
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

        // Requêtes SQL pour récupérer les données des ventes par période
        $daily_sales_query = "SELECT DATE(Date_vente) AS Date, SUM(Montant_vente) AS Total FROM ventes GROUP BY DATE(Date_vente)";
        $weekly_sales_query = "SELECT YEARWEEK(Date_vente) AS Week, SUM(Montant_vente) AS Total FROM ventes GROUP BY YEARWEEK(Date_vente)";
        $monthly_sales_query = "SELECT DATE_FORMAT(Date_vente, '%Y-%m') AS Month, SUM(Montant_vente) AS Total FROM ventes GROUP BY DATE_FORMAT(Date_vente, '%Y-%m')";
        $yearly_sales_query = "SELECT YEAR(Date_vente) AS Year, SUM(Montant_vente) AS Total FROM ventes GROUP BY YEAR(Date_vente)";

        // Exécuter les requêtes et récupérer les résultats
        $daily_sales_result = $conn->query($daily_sales_query);
        $weekly_sales_result = $conn->query($weekly_sales_query);
        $monthly_sales_result = $conn->query($monthly_sales_query);
        $yearly_sales_result = $conn->query($yearly_sales_query);

        // Convertir les résultats en tableaux PHP
        $daily_sales_data = array();
$weekly_sales_data = array();
$monthly_sales_data = array();
$yearly_sales_data = array();


        while ($row = $daily_sales_result->fetch_assoc()) {
            $daily_sales_data[$row['Date']] = $row['Total'];
        }

        while ($row = $weekly_sales_result->fetch_assoc()) {
            $weekly_sales_data[$row['Week']] = $row['Total'];
        }

        while ($row = $monthly_sales_result->fetch_assoc()) {
            $monthly_sales_data[$row['Month']] = $row['Total'];
        }

        while ($row = $yearly_sales_result->fetch_assoc()) {
            $yearly_sales_data[$row['Year']] = $row['Total'];
        }

        // Fermer la connexion à la base de données
        $conn->close();

        // Convertir les tableaux PHP en JSON
        $daily_sales_json = json_encode($daily_sales_data);
        $weekly_sales_json = json_encode($weekly_sales_data);
        $monthly_sales_json = json_encode($monthly_sales_data);
        $yearly_sales_json = json_encode($yearly_sales_data);
        ?>
        
        var dailySalesData = <?php echo $daily_sales_json; ?>;
        var weeklySalesData = <?php echo $weekly_sales_json; ?>;
        var monthlySalesData = <?php echo $monthly_sales_json; ?>;
        var yearlySalesData = <?php echo $yearly_sales_json; ?>;
        
        // Créer les graphiques avec Chart.js

        var dailyCtx = document.getElementById('dailyChart').getContext('2d');
        var dailyChart = new Chart(dailyCtx, {
            type: 'line',
            data: {
                labels: Object.keys(dailySalesData),
                datasets: [{
                    label: 'Ventes Journalières',
                    data: Object.values(dailySalesData),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var weeklyCtx = document.getElementById('weeklyChart').getContext('2d');
        var weeklyChart = new Chart(weeklyCtx, {
            type: 'bar',
            data: {
                labels: Object.keys(weeklySalesData),
                datasets: [{
                    label: 'Ventes Hebdomadaires',
                    data: Object.values(weeklySalesData),
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        var monthlyChart = new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: Object.keys(monthlySalesData),
                datasets: [{
                    label: 'Ventes Mensuelles',
                    data: Object.values(monthlySalesData),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var yearlyCtx = document.getElementById('yearlyChart').getContext('2d');
        var yearlyChart = new Chart(yearlyCtx, {
            type: 'line',
            data: {
                labels: Object.keys(yearlySalesData),
                datasets: [{
                    label: 'Ventes Annuelles',
                    data: Object.values(yearlySalesData),
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
    <a href="dashboard.php">Retour au dashboard</a>
</body>
</html>
