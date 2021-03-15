<?php

    if($_SESSION['roleUser'] == "admin"){
        $admin = $_GET['admin'];
        // ajouter un pays
        if($admin == "addPays"){
            $nomPays = $_POST['nomPays'];
            $idContinent = $_POST['idContinent'];
            $photoPays = $_POST['photoPays'];

            $reqPays = $bdd->prepare('SELECT * FROM pays WHERE nomPays = :nomPays');
            $reqPays->execute([
                'nomPays' => $nomPays
            ]);
            $nb = $reqPays->rowCount();

            if($nb == 0){
                $insertPays = $bdd->prepare("INSERT INTO pays(nomPays, idContinent, photo) VALUES(?, ?, ?)");
                $insertPays->execute(array($nomPays, $idContinent, $photoPays));
            }else{
                $message = "le pays existe déjà";
                header("Location: index.php?action=pageAdmin&messageAddPays=".$message);
            }
        }

        if($admin == "deleteUser"){
            $idUser = $_GET['idUser'];
            
            $deleteUser = $bdd->prepare("DELETE FROM `user` WHERE `user`.`id` = :id ");
            $deleteUser->execute([
                'id' => $idUser
            ]);

            $deleteArticleFromUser = $bdd->prepare("DELETE FROM `article` WHERE `article`.`idAuteur` = :id ");
            $deleteArticleFromUser->execute([
                'id' => $idUser
            ]);

            $deleteComFromUser = $bdd->prepare("DELETE FROM `commentaire` WHERE `commentaire`.`idAuteur` = :id ");
            $deleteComFromUser->execute([
                'id' => $idUser
            ]);
                
            header("Location: index.php?action=pageAdmin");
        }

    }else{
        header("Location: index.php?action=home");
    }
?>