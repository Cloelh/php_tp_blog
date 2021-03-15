<div class="login d-flex f-center">
    <div class="connexion BgDark light">
        <h2>Connexion</h2>
        <?php
            if(isset($_GET['messageConnexion'])){
                echo $_GET['messageConnexion'];
            }
        ?>
        <form method="post" action="index.php?action=login">
            <div class="form-group">
                <label for="pseudo">Nom d'utilisateur</label>
                <input type="text" class="form-control" name="pseudo" id="pseudo">
            </div>

            <div class="form-group">
                <label for="exampleInputPassword1">Mot de passe</label>
                <input type="password" class="form-control" name="mdp" id="mdp">
            </div>

            <button type="submit" name="valider" id="valider" class="btn btn-primary">Se connecter</button>
        </form>
    </div>

    <div class="inscription BgDark light">
        <h2>Inscription</h2>
        <?php
            if(isset($_GET['messageInscription'])){
                echo $_GET['messageInscription'];
            }
        ?>
        <form method="post" action="index.php?action=register">

            <div class="form-group">
                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="mail" id="mail" placeholder="Mail">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="mdp" id="mdp" placeholder="Mot de passe">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="mdpVerif" id="mdpVerif" placeholder="Verifier le mot de passe">
            </div>

            <button type="submit" name="valider" id="valider" class="btn btn-primary">S'inscrire</button>

        </form>
</div>
</div>