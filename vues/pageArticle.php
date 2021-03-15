<?php

    $id = $_GET['idarticle'];

    $reqArticle = $bdd->prepare("SELECT * FROM article WHERE id=?");
    $reqArticle->execute(array($id));
    $article = $reqArticle->fetch();

    $idAuteur = $article['idAuteur'];
    $reqAuteur = $bdd->prepare("SELECT * FROM user WHERE id=?");
    $reqAuteur->execute(array($idAuteur));
    $Auteur = $reqAuteur->fetch();

    $idContinent = $article['idContinent'];
    $reqContinent = $bdd->prepare("SELECT * FROM continent WHERE id=?");
    $reqContinent->execute(array($idContinent));
    $Continent = $reqContinent->fetch();

    $idPays = $article['idPays'];
    $reqPays = $bdd->prepare("SELECT * FROM pays WHERE id=?");
    $reqPays->execute(array($idPays));
    $Pays = $reqPays->fetch();

    $reqCommentaire = $bdd->prepare("SELECT * FROM commentaire WHERE idArticle=?");
    $reqCommentaire->execute(array($id));
?>

<div class="pageArticle">
    <div class="banner" style="background: url('<?=$article['lienImage']?>'); background-position: center; background-size: cover;">
        <div class="banner-content d-flex f-center light f-dirCol">
            <h1><?=$article['titre']?></h1>
            <div class="d-flex">
                <a class="btn btn-dark" href="?action=pageContinent&idContinent=<?=$Continent['id']?>"><?=$Continent['nomContinent']?></a>
                <a class="btn btn-dark" href="?action=pagePays&idPays=<?=$Pays['id']?>"><?=$Pays['nomPays']?></a>
            </div>
            <?php if($article['idAuteur'] == $_SESSION['id']){ ?>
                <i>Ecrit par : <b><a href="?action=pageCompte&idUser=<?=$Auteur['id']?>">moi</a></b></i>
                <a href="?action=editArticle&idArticle=<?=$article['idAuteur']?>" class="btn btn-warning">Editer</a>
                <a href="?action=suppArticle&idArticle=<?=$article['id']?>" class="btn btn-danger">Supp</a>
            <?php } else { ?>
                <i>Ecrit par : <b><a href="?action=pageCompte&idUser=<?=$Auteur['id']?>"><?=$Auteur['pseudo']?></a></b></i>
            <?php } ?>
        </div>
    </div>

    <div class="pageArticle-content">
        <div class="contenu-article">
            <h2><?=$article['titre']?></h2>
            <p><b><?=$article['description']?></b></p>
            <?=$article['contenu']?>
        </div>

        <div class="commentaire">
            <h3>Commentaires</h3>
            <div class="addCom">
                <span><b>Ecrire un commentaire :</b></span>
                <form method="post" action="index.php?action=postCommentaire&idArticle=<?=$id?>">
                    <div class="form-group">
                        <input type="text" class="form-control" id="commentaire" name="commentaire" placeholder="Ecrire son commentaire ici">
                    </div>
                    <button type="submit" class="btn btn-primary">Poster</button>
                </form>
            </div>  
            <?php if($reqCommentaire->rowCount() == 0) { ?>
                <p><i>Pas de commentaires sur cet article :( </i></p>
            <?php } ?>
        
            <?php while($a = $reqCommentaire->fetch()){ ?>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p><?=$a['contenu']?></p>
                            <?php
                                $idAuteur = $a['idAuteur'];
                                $reqAuteur = $bdd->prepare("SELECT * FROM user WHERE id=?");
                                $reqAuteur->execute(array($idAuteur));
                                $Auteur = $reqAuteur->fetch();
                            ?>
                            <?php if($Auteur['id'] == $_SESSION['id']){ ?>
                                <footer class="blockquote-footer">Ecrit par <cite title="Source Title"><a href="?action=pageCompte&idUser=<?=$_SESSION['id']?>">Moi</a></cite></footer>
                            <?php } else { ?>
                                <footer class="blockquote-footer">Ecrit par <cite title="Source Title"><a href="?action=pageCompte&idUser=<?=$Auteur['id']?>"><?=$Auteur['pseudo']?></a></cite></footer>
                            <?php } ?>
                    </blockquote>
                </div>
            <?php } ?>
        </div>
    </div>
</div>