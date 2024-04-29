<?php
include('db.php');

$message = '';

if (isset($_POST['save'])) {
    addUser($pdo, $_POST['name'], $_POST['email']);
    $message = 'Utilisateur ajouté';
}

if (isset($_POST['update'])) {
    updateUser($pdo, $_POST['id'], $_POST['name'], $_POST['email']);
    $message = 'Utilisateur mis à jour';
}

if (isset($_GET['delete'])) {
    deleteUser($pdo, $_GET['delete']);
    $message = 'Utilisateur supprimé';
}

$users = getAllUsers($pdo);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Inventory Management System|| Manage Users</title>
<link rel="stylesheet" href="style.css">
<?php include_once('includes/cs.php');?>
</head>
<body>

<?php include_once('includes/header.php');?>

    <?php if($message): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <input type="hidden" name="id" value="">
        <input type="text" name="name" placeholder="Nom de l'utilisateur" required>
        <input type="email" name="email" placeholder="Email" required>
        <button type="submit" name="save">Sauvegarder</button>
    </form>

    <h3>Liste des utilisateurs</h3>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['name'] ?></td>
                <td><?= $user['email'] ?></td>
                <td>
                    <a href="?edit=<?= $user['id'] ?>">Modifier</a>
                    <a href="?delete=<?= $user['id'] ?>" onclick="return confirm('Êtes-vous sûr?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
