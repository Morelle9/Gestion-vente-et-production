<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Client</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; box-sizing: border-box; }
        .container { max-width: 600px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        label { margin-top: 10px; }
        input[type="text"], input[type="email"], input[type="number"], input[type="submit"] { width: 100%; padding: 10px; margin-top: 5px; border-radius: 5px; border: 1px solid #ccc; box-sizing: border-box; }
        input[type="submit"] { background-color: #4CAF50; color: white; cursor: pointer; }
        input[type="submit"]:hover { background-color: #45a049; }
    </style>
</head>
<body>

<div class="container">
    <h2>Ajouter un nouveau client</h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Récupération des valeurs du formulaire
        $id = $_POST['Id_client'];
        $nom = $_POST['Nom_client'];
        $prenom = $_POST['Prenom_client'];
        $adresse = $_POST['Adresse_client'];
        $telephone = $_POST['Telephone_client'];
        $email = $_POST['Email_client'];
    
        // Connexion à la base de données
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gestion_vente_production";
    
        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $sql = "INSERT INTO clients (Id_client, Nom_client, Prenom_client, Adresse_client, Telephone_client, Email_client) VALUES (?, ?, ?, ?, ?, ?)";
        
            $stmt = $conn->prepare($sql);
            // Modification ici
            $stmt->execute(array($id, $nom, $prenom, $adresse, $telephone, $email));
        
            echo "<p>Client ajouté avec succès.</p>";
        } catch(PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }
    ?>
    <form action="ajouter_client.php" method="post">
        <label for="Id_client">ID Client:</label>
        <input type="text" id="Id_client" name="Id_client" required>

        <label for="Nom_client">Nom:</label>
        <input type="text" id="Nom_client" name="Nom_client" required>

        <label for="Prenom_client">Prénom:</label>
        <input type="text" id="Prenom_client" name="Prenom_client" required>

        <label for="Adresse_client">Adresse:</label>
        <input type="text" id="Adresse_client" name="Adresse_client" required>

        <label for="Telephone_client">Téléphone:</label>
        <input type="number" id="Telephone_client" name="Telephone_client" required>

        <label for="Email_client">Email:</label>
        <input type="email" id="Email_client" name="Email_client" required>

        <input type="submit" value="Ajouter">
    </form>
    <a href="dashboard.php">Retour au dashboard</a>

    
    
</div>

</body>
</html>
