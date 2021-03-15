<?php

    if(!empty($_POST['titre']) AND !empty($_POST['description']) AND !empty($_POST['contenu']) AND !empty($_POST['image']) AND !empty($_POST['idPays'])){
        $titre = htmlspecialchars($_POST['titre']);
        $description = htmlspecialchars($_POST['description']);
        $contenu = htmlspecialchars($_POST['contenu']);
        $image = htmlspecialchars($_POST['image']);
        $idPays = htmlspecialchars($_POST['idPays']);
        $idAuteur = $_SESSION['id'];

        $reqPays = $bdd->prepare('SELECT * FROM pays WHERE id=?');
        $reqPays->execute(array($idPays));
        $pays = $reqPays->fetch();

        $idContinent = $pays['idContinent'];

        $reqContinent = $bdd->prepare('SELECT * FROM continent WHERE id=?');
        $reqContinent->execute(array($idContinent));
        $continent = $reqContinent->fetch();

        

        if(strlen($titre) < 250 ){
            if(strlen($image) < 250 ){
                if($pays['idContinent'] == $idContinent){
                    $insertArticle = $bdd->prepare("INSERT INTO article(idAuteur, titre, description, contenu, lienImage, idContinent, idPays) VALUES(?, ?, ?, ?, ?, ?, ?)");
                    $insertArticle->execute(array($idAuteur, $titre, $description, $contenu, $image, $idContinent, $idPays));
                    header("Location: index.php?action=pageCompte&idUser=".$idAuteur);
                }
                else{
                    $message = $pays['nomPays']." n'appartient pas au continent ".$continent['nomContinent'];
                    header("Location: index.php?action=newArticle&message=" . $message);}
            }
            else{
                $message = "lien trop long";
                header("Location: index.php?action=newArticle&message=" . $message);}
        }
        else{
            $message = "titre trop long";
            header("Location: index.php?action=newArticle&message=" . $message);
        }
    }
    else{
        $message = "entrez qlqch dans tous les champs";
        header("Location: index.php?action=newArticle&message=" . $message);
    }

?>