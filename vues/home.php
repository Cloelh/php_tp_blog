<?php

    $reqContinent = $bdd->prepare("SELECT * FROM continent ORDER BY nomContinent");
    $reqContinent->execute();

    $reqArticle = $bdd->prepare("SELECT * FROM article ORDER BY id DESC");
    $reqArticle->execute();

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

<div class="home">
    
    <div class="banner" style="background:url('https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1533&q=80') ;">
        <div class="banner-content d-flex d-dirCol f-center">
            <h1 class="light">Venez découvrir nos déstinations favorites</h1>
        </div>
    </div>

    <div class="home-content">
        <h2>Découvrez par continent :</h2>
        <div class="listContinent d-flex f-jusContent-between">
            <?php
            while($c = $reqContinent->fetch()){?>
                <a href="index.php?action=pageContinent&idContinent=<?=$c['id']?>">
                    <div class="item d-flex f-center" style="background: url('<?=$c['photo']?>'); background-position: center;  background-size: cover;">
                        <div class="item-content light d-flex f-center">
                            <h5><?=$c['nomContinent']?></h5>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
        <h2>Derniers articles postés : </h2>
        <div class="article d-flex f-jusContent-between">
            <?php
                $nbArticle = 0;
                while($a = $reqArticle->fetch()){ 
                if ($nbArticle == 5) break;  $nbArticle++; ?>
                    <a href="?action=pageArticle&idarticle=<?=$a['id']?>" class="card-article" style="background:url('<?=$a['lienImage']?>'); background-position: center;  background-size: cover;">
                        <div class="card-article-content d-flex f-center f-dirCol light">
                            <h5 class="card-article-title"><?=$a['titre']?></h5>
                        </div>
                    </a>    
                <?php } ?>
        </div>
    </div>


</div>