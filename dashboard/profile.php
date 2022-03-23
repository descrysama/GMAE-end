<?php
session_start();
require_once '../config.php';
if (empty($_SESSION['pseudo'])) {
  header('location:../login');
}

$formErr = null;
$pseudo = $_SESSION['pseudo'];
$req = $bdd->prepare('SELECT  nom, prenom, mot_de_passe, role FROM users WHERE pseudo = ?');
$req->execute(array($pseudo));
$fetch = $req->fetch();
$row = $req->rowCount();

$nom = $fetch['nom'];
$prenom = $fetch['prenom'];
$password = $fetch['mot_de_passe'];
$role = $fetch['role'];

if ($role == 1) {
   $admin = '<li class="nav-item"><a class="nav-link" aria-current="page" href="../admin/home">Admin</a></li>';
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (!empty($_POST['pseudo']) && !empty($_POST['prenom']) && !empty($_POST['nom'])){
    if (empty($_POST['password'])) {
      $sqlpassword = $fetch['mot_de_passe'];
    } else {$sqlpassword = $_POST['password'];}
    if (empty($_POST['pseudo'])) {
      $sqlpseudo = $pseudo;
    } else {$sqlpseudo = $_POST['pseudo'];}
    if (empty($_POST['nom'])) {
      $sqlnom = $fetch['nom'];
    } else {$sqlnom = $_POST['nom'];}
    if (empty($_POST['prenom'])) {
      $sqlprenom = $fetch['prenom'];
    } else {$sqlprenom = $_POST['prenom'];}
    $req = $bdd->prepare('UPDATE users SET pseudo = ? , prenom = ? , nom = ?, mot_de_passe = ? WHERE pseudo = ?');
    $req->execute(array(
    htmlspecialchars($sqlpseudo),
    htmlspecialchars($sqlprenom),
    htmlspecialchars($sqlnom),
    htmlspecialchars($sqlpassword),
    htmlspecialchars($pseudo)
    ));
    $formErr = 'Changements validés';
    $_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']);
  }else {$formErr = 'Veuillez remplir correctement tout les champs.';}
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/index.css">
    <title>GMAE | Profile</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href=""><img src="../assets/img/logo_GMAE-1.png" alt="logo" width="5%"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="d-flex">
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link" href="home">Partenaires</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="profile">Profil</a>
                  </li>
                  <?php if (isset($admin)){echo $admin;}?>
                  <li class="nav-item">
                    <a href="../deconnexion" class="btn btn-danger">Déconnecter</a>
                  </li>
                </ul>
              </div>
              </div>
            </div>
          </nav>
    </header>
    <div class="container">
    <h3>Changez vos informations de connexion ici :</h3>
    <div class="card">
        <div class="card-body d-flex justify-content-center">
          <form class="form" action="" method="POST">
          <p style="font-style:italic; text-align:center; color: red;"><?php if (!empty($formErr)){echo $formErr;} ?></p>
            <h5>Pseudo : </h5>
            <input type="text" name="pseudo" value="<?php echo $pseudo?>">
            <h5>Prenom : </h5>
            <input type="text" name="prenom" value="<?php echo $prenom?>">
            <h5>Nom : </h5>
            <input type="text" name="nom" value="<?php echo $nom?>">
            <h5>Mot de Passe : </h5>
            <input type="password" name="password" value="<?php $nombre = strlen($password); echo str_repeat('*', $nombre);?>">
            <input class="btn btn-danger m-2" type="submit" value="Valider les changements">
          </form>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html> 