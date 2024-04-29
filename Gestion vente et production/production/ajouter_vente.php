<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Vente</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ajouter une Vente</h2>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gestion_vente_production";

        // Connexion à la base de données
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("La connexion a échoué : " . $conn->connect_error);
        }

        // Récupération des produits depuis la base de données
        $produits_query = "SELECT Id_produit, Nom_produit, Prix FROM produit";
        $produits_result = $conn->query($produits_query);

        // Récupération des vendeurs depuis la base de données
        $vendeurs_query = "SELECT Id_vendeur, Nom_vendeur FROM vendeur";
        $vendeurs_result = $conn->query($vendeurs_query);
        ?>

        <form method="post">
            <label for="id_vente">Id de la Vente:</label>
            <input type="text" id="id_vente" name="id_vente" required>    

            <label for="id_client">Nom du Client:</label>
            <select id="id_client" name="id_client" required>
                <?php 
                // Récupération des clients depuis la base de données
                $clients_query = "SELECT Id_client, Nom_client FROM clients";
                $clients_result = $conn->query($clients_query);

                // Affichage des clients dans le menu déroulant
                while ($client = $clients_result->fetch_assoc()) {
                    echo "<option value='" . $client['Id_client'] . "'>" . $client['Nom_client'] . "</option>";
                }
                ?>
            </select>
            
            <label for="id_vendeur">Id du Vendeur:</label>
            <select id="id_vendeur" name="id_vendeur" required>
                <?php 
                // Affichage des vendeurs dans le menu déroulant
                while ($vendeur = $vendeurs_result->fetch_assoc()) {
                    echo "<option value='" . $vendeur['Id_vendeur'] . "'>" . $vendeur['Nom_vendeur'] . "</option>";
                }
                ?>
            </select>
            
            <label for="id_produit">Produit(s) vendu(s):</label>
            <select id="id_produit" name="id_produit[]" multiple required onchange="updateProductId()">
                <?php 
                // Affichage des produits dans le menu déroulant
                while ($produit = $produits_result->fetch_assoc()) {
                    echo "<option value='" . $produit['Id_produit'] . "' data-prix='" . $produit['Prix'] . "'>" . $produit['Nom_produit'] . " - " . $produit['Prix'] . " $</option>";
                }
                ?>
            </select>

            <label for="quantite">Quantité de Produit(s) vendu(s):</label>
            <input type="text" id="quantite" name="quantite" required onchange="calculateTotal()">

            <label for="montant_vente">Montant de la Vente:</label>
            <input type="text" id="montant_vente" name="montant_vente" readonly>

            <label for="Date_vente">Date de vente du Produit:</label>
            <input type="date" id="date_vente" name="date_vente" required>

            <!-- Champ pour l'ID du produit sélectionné -->
            <input type="hidden" id="id_produit_selected" name="id_produit_selected">

            <input type="submit" value="Ajouter Vente">
        </form>

        <?php
        // Vérification si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupération des valeurs du formulaire
            $id_vente = $_POST["id_vente"];
            $id_client = $_POST["id_client"];
            $id_vendeur = $_POST["id_vendeur"];
            $id_produit = $_POST["id_produit_selected"]; // Utilisation de l'ID du produit sélectionné
            $quantite = $_POST["quantite"];
            $montant_vente = $_POST["montant_vente"];
            $date_vente = $_POST["date_vente"];

            // Construction de la requête SQL pour insérer la vente dans la base de données
            $sql_vente = "INSERT INTO ventes (Id_vente, Id_client, Id_vendeur, Id_produit, Quantite, Montant_vente, Date_vente) VALUES ('$id_vente', '$id_client', '$id_vendeur', '$id_produit','$quantite', '$montant_vente', '$date_vente')";

            // Exécution de la requête pour insérer la vente
            if ($conn->query($sql_vente) === TRUE) {
                echo "La vente a été ajoutée avec succès.";
            } else {
                echo "Erreur lors de l'ajout de la vente : " . $conn->error;
            }
        }

        // Fermeture de la connexion à la base de données
        $conn->close();
        ?>

        <script>
            function calculateTotal() {
                var quantite = document.getElementById("quantite").value;
                var prix = document.getElementById("id_produit").options[document.getElementById("id_produit").selectedIndex].getAttribute("data-prix");
                var montant = quantite * prix;
                document.getElementById("montant_vente").value = montant;
            }

            function updateProductId() {
                var selectedProductId = document.getElementById("id_produit").value;
                document.getElementById("id_produit_selected").value = selectedProductId;
            }
        </script>
        <a href="dashboard.php">Retour au dashboard</a>
    </div>
</body>
</html>
