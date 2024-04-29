<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Total des Ventes</title>
<style>
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .total-ventes {
        background-color: #ffffff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
</style>
</head>
<body>
    <?php
    // Paramètres de connexion à la base de données
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gestion_vente_production";
    
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Définir le mode d'erreur PDO sur Exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        // Requête SQL pour calculer le total des ventes
        $sql = "SELECT SUM(Montant_vente) AS total_ventes FROM ventes";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    
        // Récupérer le résultat
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        $total_ventes = $result['total_ventes'];
    
        echo "<div class='total-ventes'>Total des ventes : " . $total_ventes . " €</div>";
    }
    catch(PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>
</body>
</html>
    