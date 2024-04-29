<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Commerciaux</title>
    <style>
        /* CSS ici */
    </style>
</head>
<body>
    <div class="container">
        <h1>Liste des Commerciaux</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Adresse</th>
                    <th>Téléphone</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                try {
                    // Connexion à la base de données
                    $db = new PDO('mysql:host=localhost;dbname=gestion_vente_production;charset=utf8', 'root', '');
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Requête SQL pour récupérer les commerciaux
                    $stmt = $db->query("SELECT * FROM vendeur");
                    $vendeurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Parcours des commerciaux
                    foreach ($vendeurs as $vendeur) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($vendeur['id_vendeur']) . "</td>";
                        echo "<td>" . htmlspecialchars($vendeur['Nom_vendeur']) . "</td>";
                        echo "<td>" . htmlspecialchars($vendeur['Prenom_vendeur']) . "</td>";
                        echo "<td>" . htmlspecialchars($vendeur['Adresse_vendeur']) . "</td>";
                        echo "<td>" . htmlspecialchars($vendeur['Telephone_vendeur']) . "</td>";
                        echo "<td>" . htmlspecialchars($vendeur['Email_vendeur']) . "</td>";
                        echo "<td>";
                        echo "<a class='btn btn-edit' href='modifier_vendeur.php?id=" . urlencode($vendeur['id_vendeur']) . "'>Modifier</a>";
                        echo "<a class='btn btn-delete' href='supprimer_vendeur.php?id=" . urlencode($vendeur['id_vendeur']) . "' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer ce commercial ?\")'>Supprimer</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    
                    // Fermeture de la connexion à la base de données
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
