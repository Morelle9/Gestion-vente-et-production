<?php
$host = 'localhost'; // ou l'IP du serveur de base de données
$dbname = 'inventorydb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur de PDO à exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
}

function getAllUsers($pdo) {
    $sql = "SELECT * FROM users";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function addUser($pdo, $name, $email) {
    $sql = "INSERT INTO users (name, email) VALUES (?, ?)";
    $stmt= $pdo->prepare($sql);
    $stmt->bindValue(1, $name, PDO::PARAM_STR);
    $stmt->bindValue(2, $email, PDO::PARAM_STR);
    $stmt->execute();
}

function updateUser($pdo, $id, $name, $email) {
    $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
    $stmt= $pdo->prepare($sql);
    $stmt->bindValue(1, $name, PDO::PARAM_STR);
    $stmt->bindValue(2, $email, PDO::PARAM_STR);
    $stmt->bindValue(3, $id, PDO::PARAM_INT);
    $stmt->execute();
}

function deleteUser($pdo, $id) {
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $id, PDO::PARAM_INT);
    $stmt->execute();
}
?>