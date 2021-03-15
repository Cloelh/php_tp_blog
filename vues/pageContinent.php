<?php

    $id = $_GET['idContinent'];

    $reqContinent = $bdd->prepare("SELECT * FROM continent WHERE id=?");
    $reqContinent->execute(array($id));
    $continent = $reqContinent->fetch();

    $reqAllPays = $bdd->prepare("SELECT * FROM pays WHERE idContinent=? ORDER BY nomPays");
    $reqAllPays->execute(array($id));

    $reqArticle = $bdd->prepare("SELECT * FROM article WHERE idContinent= :idContinent ORDER BY id DESC");
    $reqArticle->execute([
        'idContinent' => $continent['id']
    ]);

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

<div class="pageContinent">
    <div class="banner" style="background: url('<?=$continent['photo']?>'); background-position: center; background-size: cover;">
        <div class="banner-content d-flex f-center light">
            <h1><?=$continent['nomContinent']?></h1>
        </div>
    </div>

    <div class="pageContinent-content">
        <h2>Pays</h2>
        <p>Découvrez les pays d'<?=$continent['nomContinent']?></p>
        <div class="listPays d-flex">
            <?php
            while($p = $reqAllPays->fetch()){?>
                <a href="index.php?action=pagePays&idPays=<?=$p['id']?>">
                    <div class="item d-flex f-center" style="background: url('<?=$p['photo']?>'); background-position: center;  background-size: cover;">
                        <div class="item-content light d-flex f-center">
                            <h5><?=$p['nomPays']?></h5>
                        </div>
                    </div>
                </a>
            <?php } ?>
        </div>
        <h2>Derniers articles postés sur l'<?=$continent['nomContinent']?></h2>
        <?php if ($reqArticle->rowCount() == 0) {?>
            <p> <i>pas d'articles à afficher, soyer le premier à <a href="?action=newArticle">écrire un article sur l'<?=$continent['nomContinent']?></a></i> </p>
        <?php }?>
        <div class="article article d-flex f-wrap">
                <?php while($a = $reqArticle->fetch()){ ?>
                    <a href="?action=pageArticle&idarticle=<?=$a['id']?>" class="card-article" style="background:url('<?=$a['lienImage']?>'); background-position: center;  background-size: cover;">
                        <div class="card-article-content d-flex f-center f-dirCol light">
                            <h5 class="card-article-title"><?=$a['titre']?></h5>
                        </div>
                    </a>  
                <?php } ?>
            </div>
    </div>
    
</div>