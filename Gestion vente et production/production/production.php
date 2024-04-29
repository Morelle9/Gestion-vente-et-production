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
            <label for="Id_production">ID de la Production:</label>
            <input type="text" id="id_production" name="productionId" required><br><br>
            <label for="Id_produit">ID du Produit:</label>
            <input type="text" id="Id_produit" name="productId" required><br><br>
            <label for="nomProduit">Nom du produit :</label>
            <input type="text" id="nomProduit" name="nomProduit" required><br><br>
            <label for="procédé">Procédé de production :</label>
            <textarea placeholder="entrez les etapes de production" id="procédé" name="procédé" required></textarea><br><br>
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
        document.getElementById('production').addEventListener('submit', function(event) {
        event.preventDefault();
    
        // Récupérer les valeurs du formulaire
        let id_production = document.getElementById('id_production').value;
        let Id_produit = document.getElementById('Id_produit').value;
        let nomProduit = document.getElementById('Nom_produit').value;
        let procédé = document.getElementById('  ').value;
        let tempsProduction = document.getElementById('tempsProduction').value;
        let matièresPremières = document.getElementById('matièresPremières').value;
    
        // Envoyer les données au serveur (non inclus dans cet exemple)
        console.log("Id de la production:", id_Production);
        console.log("Id du produit:", Id_Produit);
        console.log("Nom du produit:", nomProduit);
        console.log("Procédé de production:", procédé);
        console.log("Temps de production:", tempsProduction);
        console.log("Matières premières utilisées:", matièresPremières);
        });

        // Associer un événement input au champ d'entrée de l'identifiant du produit
        document.getElementById('produit').addEventListener('input', function() {
            var Id_produit = this.value; // Récupérer la valeur de l'identifiant du produit

            // Simuler une requête pour obtenir le nom du produit associé à l'identifiant du produit
            // Vous devrez remplacer cette partie par une véritable requête AJAX ou une récupération de données depuis une source de données
            var nomProduit = getProductFromId(Id_produit);

            // Mettre à jour le champ du nom du produit avec le nom obtenu
            document.getElementById('nomProduit').value = Nom_produit;
        });

        // Fonction factice pour simuler la récupération du nom du produit à partir de l'identifiant du produit
        function getProductFromId(Id_produit) {
            // Ici, vous pouvez implémenter la logique de récupération du nom du produit associé à l'identifiant du produit
            // Pour cet exemple, je vais simplement retourner un nom fictif basé sur l'identifiant du produit
            if (Id_produit === 'Id_produit') {
                return 'Nom_produit';
            } else {
                return 'Produit Inconnu';
            }
        }

    </script>
</body>
</html>