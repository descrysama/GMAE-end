<?php
session_start();
require_once 'config.php';

if (empty($_SESSION['pseudo'])) {
    header('location:/login');
}


$pseudo = $_SESSION['pseudo'];

$firstrequest = $bdd->prepare('SELECT nom FROM users WHERE pseudo = ?');
$firstrequest->execute(array($pseudo));
$fetch = $firstrequest->fetch();
$row = $firstrequest->rowCount();

if ($row == 1) {
    if (!empty($fetch['nom'])) {
        header('location:/dashboard/home');
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['question']) && !empty($_POST['reponse'])) {
        $req = $bdd->prepare('UPDATE users SET nom = ? , prenom = ? , question = ?, reponse = ? WHERE pseudo = ?');
        $req->execute(array(
        htmlentities($_POST['nom']),
        htmlentities($_POST['prenom']),
        htmlentities($_POST['question']),
        htmlentities($_POST['reponse']),
        htmlentities($pseudo)
    ));
    header('location:dashboard/home');
    } else {
        $formErr = 'Veuillez compléter correctement le formulaire';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/index.css">
    <title>GMAE | Complete</title>
</head>

<body>
    <div class="contenair">
        <img src="assets/img/logo_GMAE.png" class="imglogo" alt="logo_GMAE">
        <h5>Bonjour <?php echo $pseudo ?>, veuillez completer vos informations pour acceder à votre espace de travail.</h5>
        <p style="color: red;"><?php if (!empty($formErr)){echo $formErr;} ?></p>
        <form class="form" method="POST">
            
            <div class="row mb-3">
                <label for="inputPrenom3" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-15">
                    Prénom <input type="text" class="form-control" id="prenom" name="prenom">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputNom3" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-15">
                    Nom <input type="text" class="form-control" id="nom" name="nom">
                </div>
            </div>
            Question<select class="form-select" id="question" name="question">
                <option value="Quel était votre surnom étant enfant ?">Quel était votre surnom étant enfant ?</option>
                <option value="Quel est votre Jeu-Vidéo favoris ?">Quel est votre Jeu-Vidéo favoris ?</option>
                </option>
                <option value="A quel âge avez-vous appris à faire du vélo ?">A quel âge avez-vous appris à faire du vélo ?</option>
            </select>
            <div class="row mb-3">
                <label for="inputReponse3" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-15">
                    Reponse <input type="text" class="form-control" id="reponse" name="reponse">
                </div>
            </div>
            <button type="submit" class="btn btn-danger">Valider</button>
            <li class="nav-item">
                <a href="../deconnexion" class="btn btn-danger">Déconnecter</a>
            </li>
        </form>
        <p class="para" id="first-log">Ceci est votre première connexion sur votre espace de travail, veuillez
            rentrer les informations suivante pour terminer votre inscription (ces informations vous seront
            demandé qu’une seule
            fois veillez à en entrer des correctes).</p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
    <script src="app.js"></script>
</body>

</html>
