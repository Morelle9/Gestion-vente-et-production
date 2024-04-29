<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de la production</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header, footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px 0;
        }

        main {
            padding: 20px;
        }

        form {
            max-width: 600px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Gestion de la production</h1>
    </header>

    <main>
        <!-- Formulaire pour entrer les procédés de production -->
        <form id="productionForm">
            <label for="id_production">ID de la Production:</label>
            <input type="text" id="id_production" name="productionId" required><br><br>
            <label for="Id_produit">ID du Produit:</label>
            <input type="text" id="Id_produit" name="productId" readonly><br><br>
            <label for="produit">Nom du Produit:</label>
            <select id="produit" name="productName" required>
                <option value="">Sélectionnez un produit</option>
                <!-- Remplir cette liste déroulante avec les produits existants -->
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

                // Récupérer les produits depuis la base de données
                $sql = "SELECT Id_produit, Nom_produit FROM produit";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='".$row['Id_produit']."'>".$row['Nom_produit']."</option>";
                    }
                }
                ?>
            </select><br><br>
            <label for="procédé">Procédé de production :</label>
            <textarea placeholder="entrez les étapes de production" id="procédé" name="procédé" required></textarea><br><br>
            <label for="tempsProduction">Temps de production (en heures) :</label>
            <input type="time" id="tempsProduction" name="tempsProduction" min="0" step="0.01" required>
            <label for="matièresPremières">Matières premières utilisées :</label>
            <textarea id="matièresPremières" name="matièresPremières" required></textarea>
            <button type="submit">Ajouter procédé de production</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2024 Gestion de la production</p>
    </footer>

    <script>
        // Associer un événement change au champ de sélection du produit
        document.getElementById('produit').addEventListener('change', function() {
            // Récupérer la valeur de l'option sélectionnée (ID du produit)
            var selectedProductId = this.value;

            // Mettre à jour le champ d'entrée de l'ID du produit avec la valeur sélectionnée
            document.getElementById('Id_produit').value = selectedProductId;
        });
    </script>
    <a href="dashboard.php">Retour au dashboard</a>
</body>
</html>
