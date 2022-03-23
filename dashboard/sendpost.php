<?php

session_start();
require_once '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['content'])){
        if (strlen($_POST['content']) <= 1000 ) {
                $user_pseudo = htmlspecialchars($_SESSION['pseudo']);
                $content = htmlspecialchars($_POST['content']);
                $assuranceid = htmlspecialchars($_POST['assurance_id']);

                $req = $bdd->prepare('INSERT INTO comments (user_pseudo, content, assurance_id) VALUES (?, ?, ?)');
                $req->execute(array(
                    $user_pseudo,
                    $content,
                    $assuranceid
                ));
                header('location:assurance-'.$assuranceid);
        }
    }
}

?>