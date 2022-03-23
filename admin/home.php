<?php

session_start();
require_once '../config.php';
if (empty($_SESSION['pseudo'])) {
    header('location:../login');
}
$pseudo = $_SESSION['pseudo'];
$req = $bdd->prepare('SELECT role FROM users WHERE pseudo = ?');
$req->execute(array($pseudo));
$fetch = $req->fetch();

$request = $bdd->query('SELECT id, pseudo, nom, prenom, role role FROM users');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$request->execute();
$users = $request->fetchAll(PDO::FETCH_OBJ);




if ($fetch['role'] == 0) {
    header('location:../dashboard/home');
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
              <a class="navbar-brand" href="">ADMIN PANEL</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="d-flex">
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../dashboard/profile">Profil</a>
                  </li>
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
    <h3>Créez les comptes utilisateurs ici :</h3>

    <div class="w-25 m-4">
    <form action="createuser.php" method="POST" class="form">
            <div class="row mb-3">
                <label for="pseudo" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-15">
                    Username :<input type="text" class="form-control" id="pseudo" name="pseudo">
                </div>
            </div>
            <div class="row mb-3">
                <label for="password" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-15">
                    Password<input type="text" class="form-control" id="password" name="password">
                </div>
            </div>
            <div class="row mb-3">
            <label for="admin" class="col-sm-2 col-form-label">Admin</label>
                <div>
                  <input type="radio" id="non" name="admin" value="0" checked>
                  <label for="non">Non</label>
                </div>
                <div>
                  <input type="radio" id="oui" name="admin" value="1">
                  <label for="oui">Oui</label>
                </div>
            </div>
            <button type="submit" id="log" class="btn btn-danger">Créer le compte</button>
      </form>
    </div>
    <table class="table">
      <thead>
          <tr>
              <th colspan="2">Les comptes</th>
          </tr>
      </thead>
      <tbody>
          <tr>
              <td>Pseudo :</td>
              <td>Nom:</td>
              <td>Prenom:</td>
              <td>Role:</td>
              <td>Action:</td>
          </tr>
          <tr <?php foreach ($users as $user): ?> >
              <td><?= $user->pseudo ?></td>
              <td><?= $user->nom ?> </td>
              <td><?= $user->prenom ?></td>
              <td><?= $user->role ?></td>
              <td>
                <form action="deleteuser" method="POST">
                  <input type="hidden" name="pseudo" value="<?= $user->pseudo ?>">
                  <input type="hidden" name="session" value="<?= $_SESSION['pseudo'] ?>">
                  <input class="btn btn-danger" type="submit" value="Delete" name="">
                </form>
              </td>
          </tr <?php endforeach ?>>
      </tbody>
    </table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
