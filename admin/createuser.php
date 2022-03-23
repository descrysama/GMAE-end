<?php 
require_once('../config.php');
if (!empty($_POST['password']) && !empty($_POST['pseudo'])) {
    $create = $bdd->prepare('INSERT INTO users (pseudo, mot_de_passe, role) VALUES (?, ?, ?)');
  $create->execute(array(
     $_POST['pseudo'],
    $_POST['password'],
    $_POST['admin']
  ));
  header('location:home.php');
}

?>