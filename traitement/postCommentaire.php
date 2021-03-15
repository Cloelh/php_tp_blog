<?php

    if(!empty($_POST['commentaire'])){
        $commentaire = $_POST['commentaire'];
        $idAuteur = $_SESSION['id'];
        $idArticle = $_GET['idArticle'];
            $insertCom = $bdd->prepare("INSERT INTO commentaire(idArticle, idAuteur, contenu) VALUES(?, ?, ?)");
            $insertCom->execute(array($idArticle, $idAuteur, $commentaire));
            header("Location: index.php?action=pageArticle&idarticle=".$idArticle);
    }
?>
