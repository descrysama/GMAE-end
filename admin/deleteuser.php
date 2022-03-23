<?php 
require_once('../config.php');
session_start();
if (!empty($_POST['pseudo'])) {
    if ($_POST['pseudo'] != $_POST['session']) {
        $delete = $bdd->prepare('DELETE FROM users WHERE pseudo = ?');
        $delete->execute(array(
        $_POST['pseudo']
        ));
    } else {
        $delete = $bdd->prepare('DELETE FROM users WHERE pseudo = ?');
        $delete->execute(array(
        $_POST['pseudo']
        ));
        session_destroy();
    }
  
  header('location:home');
}

?>