<?php
    if($_SESSION['id'] == $_GET['idUser']){
        $monCompte = true;
        $id = $_SESSION['id'];
    }else{
        $id = $_GET['idUser'];
        $monCompte = false;
    }

    $reqCompte = $bdd->prepare("SELECT * FROM user WHERE id=?");
    $reqCompte->execute(array($id));
    $compte = $reqCompte->fetch();

    $reqArticle = $bdd->prepare("SELECT * FROM article WHERE idAuteur=?");
    $reqArticle->execute(array($id));

    $nbArticle = $reqArticle->rowCount();

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

<div class="pageArticle">
    <div class="pageArticle-content">
        <?php if($monCompte){?>
            <h1>Mon compte</h1>
            <p>Peudo : <b><?=$compte['pseudo']?></b></p>
        <?php } else {?>
            <h1>Compte de <?=$compte['pseudo']?></h1>
        <?php } ?>
        <p><i>Infos du compte</i></p>
        <p>Nom Prénom : <b><?=$compte['nom']?> <?=$compte['prenom']?></b></p>
        <p>Email : <b><?=$compte['mail']?></b></p>
        <p>Mdp : <b>*************</b></p>
        <p>Role : <b><?=$compte['roleUser']?></b></p>
        <?php if($monCompte){ ?>
            <a href="?action=logout" class="btn btn-danger light">Déconnexion</a>
        <?php } ?>

        <?php if($_SESSION['roleUser'] == "admin"){ ?>
            <a href="?action=admin&admin=deleteUser&idUser=<?=$compte['id']?>" class="btn btn-danger light">Supprimer ce compte</a>
        <?php } ?>

        <?php if($nbArticle == 0) {?>
            <h3>Pas d'article sur ce compte </h3>
        <?php } else { ?>
            <h3>Article de <?=$compte['pseudo']?></h3>
            <div class="article article d-flex f-wrap">
                <?php while($a = $reqArticle->fetch()){ ?>
                    <a href="?action=pageArticle&idarticle=<?=$a['id']?>" class="card-article" style="background:url('<?=$a['lienImage']?>'); background-position: center;  background-size: cover;">
                        <div class="card-article-content d-flex f-center f-dirCol light">
                            <h5 class="card-article-title"><?=$a['titre']?></h5>
                        </div>
                    </a>  
                <?php } ?>
            </div>
        <?php } ?>
        <?php if($monCompte){?>
            <a class="btn btn-success" href="?action=newArticle">Ecrire un nouvel article</a>
        <?php } ?>             

        
    </div>
    
</div>