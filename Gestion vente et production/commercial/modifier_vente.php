<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Vente</title>
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
        <h2>Modifier une Vente</h2>
        <?php
        // Récupération de l'ID de la vente à modifier depuis l'URL
        $vente_id = $_GET['id'];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "gestion_vente_production";

        // Connexion à la base de données
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("La connexion a échoué : " . $conn->connect_error);
        }

        // Récupération des données de la vente à modifier
        $vente_query = "SELECT * FROM ventes WHERE Id_vente = '$vente_id'";
        $vente_result = $conn->query($vente_query);

        if ($vente_result->num_rows > 0) {
            $vente = $vente_result->fetch_assoc();
        ?>
        <form method="post">
            <label for="id_vente">Id de la Vente:</label>
            <input type="text" id="id_vente" name="id_vente" value="<?php echo $vente['Id_vente']; ?>" readonly>    

            <label for="id_client">Nom du Client:</label>
            <select id="id_client" name="id_client" required>
                <?php 
                // Récupération des clients depuis la base de données
                $clients_query = "SELECT Id_client, Nom_client FROM clients";
                $clients_result = $conn->query($clients_query);

                // Affichage des clients dans le menu déroulant
                while ($client = $clients_result->fetch_assoc()) {
                    $selected = ($client['Id_client'] == $vente['Id_client']) ? "selected" : "";
                    echo "<option value='" . $client['Id_client'] . "' $selected>" . $client['Nom_client'] . "</option>";
                }
                ?>
            </select>
            
            <label for="id_vendeur">Id du Vendeur:</label>
            <select id="id_vendeur" name="id_vendeur" required>
                <?php 
                // Récupération des vendeurs depuis la base de données
                $vendeurs_query = "SELECT Id_vendeur, Nom_vendeur FROM vendeur";
                $vendeurs_result = $conn->query($vendeurs_query);

                // Affichage des vendeurs dans le menu déroulant
                while ($vendeur = $vendeurs_result->fetch_assoc()) {
                    $selected = ($vendeur['Id_vendeur'] == $vente['Id_vendeur']) ? "selected" : "";
                    echo "<option value='" . $vendeur['Id_vendeur'] . "' $selected>" . $vendeur['Nom_vendeur'] . "</option>";
                }
                ?>
            </select>
            
            <label for="id_produit">Produit(s) vendu(s):</label>
            <select id="id_produit" name="id_produit[]" multiple required onchange="updateProductId()">
                <?php 
                // Récupération des produits depuis la base de données
                $produits_query = "SELECT Id_produit, Nom_produit, Prix FROM produit";
                $produits_result = $conn->query($produits_query);

                // Affichage des produits dans le menu déroulant
                while ($produit = $produits_result->fetch_assoc()) {
                    $selected = (in_array($produit['Id_produit'], explode(",", $vente['Id_produit']))) ? "selected" : "";
                    echo "<option value='" . $produit['Id_produit'] . "' data-prix='" . $produit['Prix'] . "' $selected>" . $produit['Nom_produit'] . " - " . $produit['Prix'] . " $</option>";
                }
                ?>
            </select>

            <label for="quantite">Quantité de Produit(s) vendu(s):</label>
            <input type="text" id="quantite" name="quantite" value="<?php echo $vente['Quantite']; ?>" required onchange="calculateTotal()">

            <label for="montant_vente">Montant de la Vente:</label>
            <input type="text" id="montant_vente" name="montant_vente" value="<?php echo $vente['Montant_vente']; ?>" readonly>

            <label for="Date_vente">Date de vente du Produit:</label>
            <input type="date" id="date_vente" name="date_vente" value="<?php echo $vente['Date_vente']; ?>" required>

            <!-- Champ pour l'ID du produit sélectionné -->
            <input type="hidden" id="id_produit_selected" name="id_produit_selected" value="<?php echo $vente['Id_produit']; ?>">

            <input type="submit" value="Modifier Vente">
        </form>
        <?php
        } else {
            echo "Aucune vente trouvée avec l'ID : $vente_id";
        }

        // Vérification si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupération des valeurs du formulaire
            $id_vente = $_POST["id_vente"];
            $id_client = $_POST["id_client"];
            $id_vendeur = $_POST["id_vendeur"];
            $id_produit = $_POST["id_produit_selected"];
            $quantite = $_POST["quantite"];
            $montant_vente = $_POST["montant_vente"];
            $date_vente = $_POST["date_vente"];

            // Construction de la requête SQL pour modifier la vente dans la base de données
            $sql_vente = "UPDATE ventes SET Id_client='$id_client', id_vendeur='$id_vendeur', Id_produit='$id_produit', Quantite='$quantite', Montant_vente='$montant_vente', Date_vente='$date_vente' WHERE Id_vente='$id_vente'";

            // Exécution de la requête pour modifier la vente
            if ($conn->query($sql_vente) === TRUE) {
                echo "La vente a été modifiée avec succès.";
            } else {
                echo "Erreur lors de la modification de la vente : " . $conn->error;
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
    </div>
</body>
</html>
