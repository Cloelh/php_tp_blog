<?php if($_SESSION['roleUser'] != "admin") {
    header("Location: index.php?action=home");
} else {

    $reqContinent = $bdd->prepare("SELECT * FROM continent ORDER BY nomContinent");
    $reqContinent->execute();

?>

<div class="pageAdmin">
    <div class="pageAdmin-content">
        <h1>Page Admin</h1>

        <h2>Ajouter un pays</h2>
        <?php if(isset($_GET['messageAddPays'])){
            echo $_GET['messageAddPays'];
        } ?>
        <form action="?action=admin&admin=addPays" method="post">
            <label for="idContinent">Continent</label>
            <select class="form-control" name="idContinent" id="idContinent">
                <?php while($c = $reqContinent->fetch()){ ?>
                    <option value="<?=$c['id']?>"><?=$c['nomContinent']?></option>
                <?php } ?>
            </select>
            <div class="form-group">
                <label for="nomPays">Nom du pays</label>
                <input type="text" class="form-control" name="nomPays" id="nomPays" placeholder="Nom pays">
            </div>
            <div class="form-group">
                <label for="photoPays">Lien de l'image </label>
                <input type="text" class="form-control" name="photoPays" id="photoPays" placeholder="Nom pays">
            </div>

            <button type="submit" name="valider" id="valider" class="btn btn-primary">Ajouter</button>
        </form>

        <a class="btn btn-danger" href="?action=logout">Se déconnecter</a>
    </div>
</div>








<?php } ?>