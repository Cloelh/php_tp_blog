<?php

    $idArticle = $_GET['idArticle'];

    $reqArticle = $bdd->prepare('SELECT * FROM article WHERE id=?');
    $reqArticle->execute(array($idArticle));
    $article = $reqArticle->fetch();

    $reqAllContinent = $bdd->prepare('SELECT * FROM continent');
    $reqAllContinent->execute();

    $reqAllPays = $bdd->prepare('SELECT * FROM pays');
    $reqAllPays->execute();

    if($article['idAuteur'] == $_SESSION['id']){

?>

        <div class="pageEdit">
            <div class="pageEdit-content">
                <h2>Editer l'article : <?=$article['titre']?></h2>

                <form method="post" action="index.php?action=updateArticle&idArticle=<?=$article['id']?>">

                    <div class="form-group">
                        <input type="text" class="form-control" name="titre" id="titre" value="<?=$article['titre']?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="description" id="description" value="<?=$article['description']?>">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="contenu" name="contenu" rows="10"><?=$article['contenu']?></textarea>
                    </div>
                    <div class="d-flex">
                        <img src="<?=$article['lienImage']?>" alt="image de l'article" width="100px">
                        <div class="form-group">
                            <input type="text" class="form-control" name="image" id="image" value="<?=$article['lienImage']?>">
                            <i>copier le lien de l'image venant d'internet</i>
                        </div>
                    </div>
                    <select class="form-control" name="idContinent" id="idContinent">

                        <?php while($c = $reqAllContinent->fetch()){ 
                            if($c['id'] == $article['idContinent']){ ?>
                                <option selected value="<?=$c['id']?>"><?=$c['nomContinent']?></option> 
                            <?php } else {?>
                                <option value="<?=$c['id']?>"><?=$c['nomContinent']?></option> 
                            <?php } ?>
                        <?php } ?>
                    </select>
                    <select class="form-control" name="idPays" id="idPays">
                        <?php while($p = $reqAllPays->fetch()){ 
                            if($p['id'] == $article['idPays']){ ?>
                                <option selected value="<?=$p['id']?>"><?=$p['nomPays']?></option> 
                            <?php } else { ?>
                                <option value="<?=$p['id']?>"><?=$p['nomPays']?></option> 
                            <?php } ?>
                        <?php } ?>
                    </select>

                    <button type="submit" name="valider" id="valider" class="btn btn-primary">Edit</button>

                </form>
            </div>
        </div>


<?php } else { ?>
    Vous ne pouvez pas éditez cette article car il ne vous appartient pas, retourner sur l'<a href="?action=home">accueil</a>
<?php } ?>