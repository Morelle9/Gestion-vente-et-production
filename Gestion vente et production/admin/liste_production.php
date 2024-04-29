<?php
// Connexion à la base de données
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

// Récupérer les données des productions depuis la base de données
$sql = "SELECT * FROM production";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Productions</title>
    <style>
        /* Styles CSS ici */
    </style>
</head>

<body>
    <div class="container">
        <h2>Liste des Productions</h2>
        <table>
            <thead>
                <tr>
                    <th>ID de la Production</th>
                    <th>ID du Produit</th>
                    <th>Nom des Matières Premières</th>
                    <th>Quantité des Matières Premières</th>
                    <th>Temps de Production</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Afficher chaque production dans une ligne du tableau
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id_production"] . "</td>";
                        echo "<td>" . $row["Id_produit"] . "</td>";
                        echo "<td>" . $row["nom_mat_premiere"] . "</td>";
                        echo "<td>" . $row["qte_mat_premiere"] . "</td>";
                        echo "<td>" . $row["temps_production"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>Aucune production trouvée.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
// Fermer la connexion à la base de données
$conn->close();
?>
