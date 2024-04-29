<?php
// Initialisez la variable $search_keyword
$search_keyword = '';

// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérez le mot-clé de recherche à partir du formulaire
    $search_keyword = isset($_POST['search']) ? $_POST['search'] : '';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechercher un Produit</title>
    <style>
        /* Styles CSS */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
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

        /* Styles spécifiques pour la mise en page responsive */
        @media screen and (max-width: 600px) {
            .container {
                width: 90%;
                margin: 30px auto;
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <h2>Rechercher un Produit</h2>
        <form method="post">
            <label for="search">Recherche:</label>
            <input type="text" id="search" name="search" value="<?php echo htmlspecialchars($search_keyword); ?>" placeholder="Entrez le nom du produit...">
            <datalist id="suggestions">
                <!-- Les options de suggestion seront ajoutées ici par JavaScript -->
            </datalist>
            <input type="submit" value="Rechercher">
        </form>
        <div id="search-results"></div>
    </div>

    <script>
        // Sélectionnez la zone de recherche et le datalist
        const searchInput = document.getElementById('search');
        const suggestionsList = document.getElementById('suggestions');

        // Événement de saisie sur la zone de recherche
        searchInput.addEventListener('input', function() {
            const keyword = searchInput.value.trim(); // Récupérer la valeur saisie sans espaces
            suggestionsList.innerHTML = ''; // Effacer la liste des suggestions

            if (keyword.length > 0) { // Vérifier si la saisie n'est pas vide
                // Envoyer une requête AJAX pour récupérer les suggestions
                const xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            const suggestions = JSON.parse(xhr.responseText); // Convertir la réponse JSON en objet JavaScript
                            suggestions.forEach(function(suggestion) {
                                const option = document.createElement('option'); // Créer un élément d'option pour chaque suggestion
                                option.value = suggestion; // Définir la valeur de l'option sur la suggestion
                                suggestionsList.appendChild(option); // Ajouter l'option à la liste de suggestions
                            });
                        } else {
                            console.error('Une erreur s\'est produite lors de la récupération des suggestions.');
                        }
                    }
                };
                xhr.open('GET', 'get_suggestions.php?keyword=' + encodeURIComponent(keyword), true); // Envoyer la requête GET avec le mot-clé encodé
                xhr.send();
            }
        });
    </script>
</body>
</html>
