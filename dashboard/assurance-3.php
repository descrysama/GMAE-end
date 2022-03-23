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
    <main>
      <div class="d-flex justify-content-center">
          <img src="../assets/img/ASSURISK.png" alt="ASSURISK" width="15%">
      </div>
      <div class="container">
        <div class="row">
            <div class="col-md-2 col-12 col-lg-2">
            </div>
            <div class="col-md-8 col-12 col-lg-8">
        <p>ASSURISK est le leader français de l’assurance en ligne.
          Nous vous proposons l’offre et les options qui vous correspondent le mieux,
          soit en ligne, soit avec l’un de nos conseillers au téléphone.
          
          Vous avez le choix de passer soit par notre appli ou soit par votre espace personnel sur le site.
          Mais nous savons que dans ce moment délicat, il est rassurant de parler à quelqu’un :
          un conseiller spécialisé dans la gestion des sinistres est là pour vous.
          Il sera votre interlocuteur unique pour vous accompagner dans toutes vos démarches
          et vous tenir au courant de l’avancée de votre dossier.
          Vous bénéficiez aussi du large réseau de garages partenaires, d’expert, et de l’assistance
          de notre Groupe. Une prise en charge 24h/24, 7 jours/7 qui s’appuie sur la performance
          du 1er groupe mondial d’assurance.</p>
      </div>
    </div>
  </div>
</div>
    <div class="col-md-2 col-12 col-lg-2"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-2 col-12 col-lg-2">
                </div>
                <div class="col-md-8 col-12 col-lg-8">
                <form method="POST" action="sendpost">
                        <input type="hidden" name="assurance_id" value="3">
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="content" name="content"
                                style="height: 100px"></textarea>
                            <label for="content">Laisser un commentaire</label>
                        </div>
                        <div class="d-flex justify-content-end">
                            <input class="btn btn-primary" type="submit" value="Poster">
                        </div> 
                    </form>
                    
                    <div id="commentaires">
                      <?php 
                            require('../config.php');

                            $req = $bdd->prepare("SELECT * FROM comments WHERE assurance_id = 3");
                            $req->execute();
                            $fetch = $req->fetchAll(PDO::FETCH_OBJ);
                        ?>
                        <?php foreach ($fetch as $comment): ?>
                            <div class="card">
                            <h5 class="card-header"><?= $comment->user_pseudo ?></h5>
                              <div class="card-body"><?= $comment->content ?></div>
                          </div>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        </div>    
    </div>
  </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="app.js"></script>
</body>
</html>