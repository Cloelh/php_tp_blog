
<?php

    $reqAllContinent = $bdd->prepare('SELECT * FROM continent');
    $reqAllContinent->execute();

    $reqAllPays = $bdd->prepare('SELECT * FROM pays');
    $reqAllPays->execute();

?>


<div class="nouvelArticle">
    <div class="nouvelArticle-content">
        <h2>Ecrire un nouvel article</h2>
        <?php if($_GET['message']) { ?>
            <p><?=$_GET['message']?></p>
        <?php } ?>

        <form method="post" action="index.php?action=postArticle">

            <div class="form-group">
                <label for="titre">Titre de l'article</label>
                <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre de l'article">
            </div>
            <div class="form-group">
                <label for="description">Description de l'article</label>
                <input type="textarea" class="form-control" name="description" id="description" placeholder="Description de l'article">
            </div>
            <div class="form-group">
                <label for="contenu">Contenu de l'article</label>
                <textarea class="form-control" id="contenu" name="contenu" rows="10" placeholder="Contenu de l'article"></textarea>
            </div>
            <div class="form-group">
                <label for="image">Copier le lien de l'image venant d'internet</label>
                <input type="text" class="form-control" name="image" id="image" placeholder="Lien image article">
            </div>
            <div class="form-group">
                <label for="idPays">Pays associé à l'article</label>
                <select class="form-control" name="idPays" id="idPays">
                    <?php while($p = $reqAllPays->fetch()){ ?>
                        <option value="<?=$p['id']?>"><?=$p['nomPays']?></option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" name="valider" id="valider" class="btn btn-primary">Poster</button>

        </form>
    </div>
</div>