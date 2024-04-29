<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un utilisateur</title>
    <style>
        /* Styles CSS */
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
    color: #333;
}

.container {
    width: 90%;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px 0 rgba(0, 0, 0, 0.1);
}

h2 {
    color: #333;
}

label {
    font-weight: bold;
}

select, input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
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

@media screen and (min-width: 600px) {
    .container {
        width: 50%;
    }
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Supprimer un Utilisateur</h2>
        <form id="deleteForm" method="post">
            <label for="id">ID de utilisateur à Supprimer:</label>
            <select name="id" id="id" required>
                <option value="">Sélectionnez un ID de utilisateur</option>
                <?php
                // Connexion à la base de données
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "gestion_vente_production";
                $conn = new mysqli($servername, $username, $password, $dbname);
                
                // Vérifier la connexion
                if ($conn->connect_error) {
                    die("La connexion a échoué : " . $conn->connect_error);
                }

                // Requête pour récupérer tous les IDs des utilisateurs
                $sql = "SELECT Id_utilisateur FROM utilisateur";
                $result = $conn->query($sql);

                // Afficher chaque ID utilisateur dans une option du menu déroulant
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['Id_utilisateur'] . "'>" . $row['Id_utilisateur'] . "</option>";
                    }
                } else {
                    echo "Aucun utilisateur trouvé.";
                }
                ?>
            </select>
            <input type="button" value="Supprimer Utilisateur" onclick="confirmDelete()">
        </form>
            
    </div>
    <script>
        function confirmDelete() {
            var result = confirm("Voulez-vous vraiment supprimer cet utilisateur ?");
            if (result) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
</body>
</html>
