<?php
session_start();
require_once('../config.php');

if (empty($_SESSION['pseudo'])) {
    header('location:../login');
}

$user = $_SESSION['pseudo'];


$req = $bdd->prepare('SELECT nom , prenom FROM users where pseudo = ?');
$req->execute(array($user));
$fetch = $req->fetch();
$row = $req->rowCount();

$prenom = $fetch['prenom'];

if ($row = 1) {
    if (empty($fetch['nom'])) {
        header('location:../complete');
    }
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
    <title>GMAE | Accueil</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
              <a class="navbar-brand" href="home"><img src="../assets/img/logo_GMAE-1.png" alt="logo" width="5%"></a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="d-flex">
              <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="home">Partenaires</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="profile">Profil</a>
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
    <h3>Bienvenue <?php echo $prenom;?>.</h3>
        <div class="row">
            <div class="col-md-6 col-12 col-lg-6">
                <div class="card">
                    <img src="../assets/img/les-mutualistes.png" class="card-img-top" alt="les-mutualistes">
                    <div class="card-body">
                      <h5 class="card-title">LES + MUTUALISTES</h5>
                      <p class="card-text">LES + MUTUALISTES finance la solidarité nationale.
                        Nous appliquons le principe édifié par la Sécurité sociale française en 1945 : permettre à chacun de bénéficier d’une protection sociale.
                        </p>
                      <a href="assurance-1" class="btn btn-primary">Voir plus</a>
                    </div>
                  </div>
            </div>
            <div class="col-md-6 col-12 col-lg-6">
                <div class="card">
                    <img src="../assets/img/ALLIA.png" class="card-img-top second" alt="ALLIA">
                    <div class="card-body">
                      <h5 class="card-title">ALLIA</h5>
                      <p class="card-text">ALLIA accompagne les entreprises dans leurs démarches en terme d’assurance. 
                        Son président est élu pour 3 ans par ses pairs, chefs d’entreprises et présidents de tous les ALLIA de France.
                        </p>
                      <a href="assurance-2" class="btn btn-primary">Voir plus</a>
                    </div>
                  </div>
            </div>
            <div class="col-md-6 col-12 col-lg-6">
                <div class="card">
                    <img src="../assets/img/ASSURISK.png" class="card-img-top third" alt="ASSURISK">
                    <div class="card-body">
                      <h5 class="card-title">ASSURISK</h5>
                      <p class="card-text">Etre bien couvert, votre objectif et notre mission!
                        Le leader français de l’assurance en ligne.
                        Nous vous proposons l’offre et les options qui vous correspondent le mieux,
                        soit en ligne, soit avec l’un de nos conseillers au téléphone.</p>
                      <a href="assurance-3" class="btn btn-primary">Voir plus</a>
                    </div>
                  </div>
            </div>
            <div class="col-md-6 col-12 col-lg-6">
                <div class="card">
                    <img src="../assets/img/OCAR.png" class="card-img-top" alt="OCAR" width="">
                    <div class="card-body">
                      <h5 class="card-title">OCAR</h5>
                      <p class="card-text">Une compagnie d’assurance qui est présente sur tout le territoire.
                        Nous proposons est une solution clé en main et une mise en place entièrement gratuite allant d’un simple lien tracké à une intégration totale dans votre parcours de vente.</p>
                      <a href="assurance-4" class="btn btn-primary">Voir plus</a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>
</html>