<?php

    $id = $_GET['idPays'];

    $reqPays = $bdd->prepare("SELECT * FROM pays WHERE id=?");
    $reqPays->execute(array($id));
    $pays = $reqPays->fetch();

    $reqArticle = $bdd->prepare("SELECT * FROM article WHERE idPays=?");
    $reqArticle->execute(array($id));
?>

<div class="pagePays">
    <div class="banner" style="background: url('<?=$pays['photo']?>'); background-position: center; background-size: cover;">
        <div class="banner-content d-flex f-center light">
            <h1><?=$pays['nomPays']?></h1>
        </div>
    </div>

    <div class="pagePays-content">
        <h2>Articles sur <?=$pays['nomPays']?></h2>
        <div class="article row">
            <?php
                while($a = $reqArticle->fetch()){ ?>
                    <?php 
                        $reqAuteur = $bdd->prepare('SELECT * FROM user WHERE id=?');
                        $reqAuteur->execute(array($a['idAuteur']));
                        $auteur = $reqAuteur->fetch();

                        if($auteur['id'] == $_SESSION['id']){
                            $monArticle = true;
                        }
                        else{
                            $monArticle = false;
                        }
                    ?>
                    <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src='<?=$a['lienImage']?>' alt="image de l'article">
                        <div class="card-body">
                            <h5 class="card-title"><?=$a['titre']?></h5>
                            <p class="card-text"> <?=$a['description']?> </br> Ecrit par <a href="?action=pageCompte&idUser=<?=$auteur['id']?>"><i><?=$auteur['pseudo']?></i></a> </p>
                            <a href="index.php?action=pageArticle&idarticle=<?=$a['id']?>" class="btn btn-primary">Découvrir</a>
                            <?php if($monArticle){ ?>
                                <a href="index.php?action=editArticle&idArticle=<?=$a['id']?>" class="btn btn-warning">Editer</a>
                                <a href="?action=suppArticle&idArticle=<?=$a['id']?>" class="btn btn-danger">Supp</a>
                            <?php } ?>
                        </div>
                    </div>
                    
                <?php } ?>
        </div>
    </div>
    
</div>