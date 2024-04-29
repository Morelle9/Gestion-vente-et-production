<?php
include('includes/dbconnection.php');

if(isset($_POST['submit'])) {
    $id = $_POST['id']; 
    $accountID = $_POST['accountID'];
    $accountType = $_POST['accountType'];
    $contactName = $_POST['contactName'];
    $companyName = $_POST['companyName'];
    $address = $_POST['address'];
    $cellphnumber = $_POST['cellphnumber'];
    $email = $_POST['email'];
    $notes = $_POST['notes'];
    $password = $_POST['password'];
    $creationdate = $_POST['creationdate'];
    
    $query = "INSERT INTO tblclient (ID, AccountID, AccountType, ContactName, CompanyName, Address, Cellphnumber, Email, Notes, Password, CreationDate) VALUES ('$id', '$accountID', '$accountType', '$contactName', '$companyName', '$address', '$cellphnumber', '$email', '$password', '$creationdate')";
    $result = mysqli_query($con, $query);
if($result) {
    echo "<script>alert('Client has been added.');</script>";
} else {
    echo "<script>alert('Error: " . mysqli_error($con) . "');</script>";
}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Client</title>
    <style>
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.container {
    width: 80%;
    margin: 0 auto;
}

h1 {
    color: #333;
}

form {
    margin-bottom: 20px;
}

input[type=text],
input[type=email],
input[type=password],
input[type=date],
textarea {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid #ccc;
}

th, td {
    padding: 10px;
    text-align: left;
}

th {
    background-color: #007bff;
    color: #fff;
}

/* Style spécifique pour la mise en page responsive */

/* Utilisation de media queries pour rendre la mise en page responsive */
@media screen and (max-width: 768px) {
    .container {
        width: 100%;
    }

    .dashboard-sidebar {
        width: 100%;
        float: none;
    }

    .dashboard-content {
        width: 100%;
        float: none;
    }
}
</style>
    <!-- Inclure les fichiers CSS -->
    <link rel="stylesheet" href="styles.css">
</head>
    <!-- Formulaire d'ajout de client -->

<body class="body-theme-light">

    <div class="container">
        <h1>Add Client</h1>
        <form action="add-client.php" method="post">
            <label for="id">Client Id:</label>
            <input type="text" id="id" name="id" required>

            <label for="accountID">Account Id:</label>
            <input type="text" id="accountID" name="accountID" required>

            <label for="accountType">Account Type:</label>
            <input type="text" id="accountType" name="accountType" required>

            <label for="contactName">Client Name:</label>
            <input type="text" id="contactName" name="contactName" required>

            <label for="companyName">Company Name:</label>
            <input type="text" id="companyName" name="companyName" required>

            <label for="address">Addresse:</label>
            <textarea id="address" name="address" required></textarea>

            <label for="cellphnumber">CellPhone Number:</label>
            <input type="text" id="cellphnumber" name="cellphnumber" required>

            <label for="email">E-mail address:</label>
            <input type="email" id="email" name="email" required>

            <label for="notes">Notes:</label>
            <textarea id="notes" name="notes"></textarea>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>

            <label for="creationdate">Creation Date</label>
            <input type="date" id="creationdate" name="creationdate" required>

            <button type="submit" name="submit">Add client</button>
        </form>
    </div>

    <!-- Inclure le fichier JavaScript -->
    <script src="script.js"></script>
</body>
</html>

