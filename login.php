<?php
session_start();
require_once 'config.php';

if (!empty($_SESSION['user'])) {
    header('location:dashboard/home');
}

$passwordErr = null;
$emailErr = null;



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['password'])){
        if (strlen($_POST['password']) >= 6 ) {
            if (!empty($_POST['username'])) {
        
                $username = htmlspecialchars($_POST['username']);
                $password = htmlspecialchars($_POST['password']);

                $req = $bdd->prepare('SELECT pseudo, mot_de_passe, prenom FROM users WHERE pseudo = ?');
                $req->execute(array($username));
                $fetch = $req->fetch();
                $row = $req->rowCount();

                if ($row == 1) {
                    if ($fetch['pseudo'] === $username) {
                        if ($fetch['mot_de_passe'] === $password) {
                            $_SESSION['user'] = $fetch['prenom'];
                            $_SESSION['pseudo'] = $fetch['pseudo'];
                            header('location:dashboard/home');
                        }else { $passwordErr = 'Mot de passe incorrect.';}
                    }
                } else { $usernameErr = 'Pseudo incorrect.';}




            } else { $usernameErr = 'Un nom d\'utilisateur correct est requis.';}
        } else { $passwordErr = 'Un mot de passe de plus de 6 caractères est requis.';}
    }
}



?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>GMAE | Connexion</title>
</head>

<body>
    <div class="contenair">
        <img src="/assets/img/logo_GMAE-1.png" class="imglogo" alt="logo_GMAE">
        <p style="color: red;"><?php if (!empty($passwordErr)) {echo $passwordErr;} ?></p>
        <p style="color: red;"><?php if (!empty($usernameErr)) {echo $usernameErr;} ?></p>
        <form action="" method="POST" class="form">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-15">
                    Username :<input type="text" class="form-control" id="username" name="username">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-15">
                    Password<input type="password" class="form-control" id="password" name="password">
                </div>
            </div>
            <button type="submit" id="log" class="btn btn-danger">Login</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>

</html>