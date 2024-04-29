<?php
session_start();
error_reporting(0);
include('commercial/includes/dbconnection.php');

if(isset($_POST['login']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $query = mysqli_prepare($con, "SELECT id_vendeur FROM vendeur WHERE Nom_vendeur=? AND mdp_vendeur=?");
mysqli_stmt_bind_param($query, "ss", $username, $password);
mysqli_stmt_execute($query);
$ret = mysqli_stmt_get_result($query);


    if($ret){
        $_SESSION['vendeur'] = $ret['id_vendeur'];
        header('location:dashboard.php');
    } else {
        echo '<script>alert("Nom d\'utilisateur ou mot de passe incorrect.")</script>';
    }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Connexion Vendeur</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .login-container {
            margin-top: 100px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center login-container">
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h3>Connexion Vendeur</h3>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label for="username">Nom d'utilisateur :</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Mot de passe :</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="login">Sign In</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="../index.php" class="btn btn-info"><i class="fas fa-home"></i> Retour à l'accueil</a>
                    <a href="#" class="btn btn-link">Reset Password</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
