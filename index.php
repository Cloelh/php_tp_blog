<?php

    include('config/actions.php');
    include('config/bdd.php');

    session_start();

    $reqContinent = $bdd->prepare("SELECT * FROM continent ORDER BY nomContinent");
    $reqContinent->execute();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Voyages</title>
    <link rel="stylesheet" href="asset/main.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
</head>
<body>

    <nav class="d-flex f-alignItems-center f-jusContent-between BgLight">
        <a href="index.php"><div class="logo">Voyages</div></a>
        <div class="link d-flex f-alignItems-center f-jusContent-between">
            <?php if(isset($_SESSION['id'])){
                if($_SESSION['roleUser'] == "admin"){ ?>
                    <?php while($c = $reqContinent->fetch()) { ?>
                            <div class="item d-flex f-dirCol f-center"><a href="index.php?action=pageContinent&idContinent=<?=$c['id']?>"><?=$c['nomContinent']?></a><span class="underline BgDark"></span></div>
                    <?php } ?>
                    <div class="item d-flex f-dirCol f-center"><a href="index.php?action=pageAdmin">Admin</a><span class="underline BgDark"></span></div>
                <?php } else { ?>
                    <?php while($c = $reqContinent->fetch()) { ?>
                            <div class="item d-flex f-dirCol f-center"><a href="index.php?action=pageContinent&idContinent=<?=$c['id']?>"><?=$c['nomContinent']?></a><span class="underline BgDark"></span></div>
                    <?php } ?>
                    <div class="item d-flex f-dirCol f-center"><a href="index.php?action=pageCompte&idUser=<?=$_SESSION['id']?>">Mon Compte</a><span class="underline BgDark"></span></div>
                <?php } ?>
            <?php } else{  ?>
                <div class="item d-flex f-dirCol f-center"><a href="?action=connexion">Connexion</a><span class="underline BgDark"></span></div>
            <?php } ?>
        </div>
    </nav>

    <div>
        <div>
            <!--<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">-->
            <div>
                <?php
                // Quelle est l'action à faire ?
                if (isset($_GET["action"])) {
                    $action = $_GET["action"];
                } else {
                    $action = "home";
                }

                // Est ce que cette action existe dans la liste des actions
                if (array_key_exists($action, $listeDesActions) == false) {
                    include("vues/404.php"); // NON : page 404
                } else {
                    include($listeDesActions[$action]); // Oui, on la charge
                }

                ob_end_flush(); // Je ferme le buffer, je vide la mémoire et affiche tout ce qui doit l'être
                ?>


            </div>
        </div>
    </div>
    

    <footer class="BgDark d-flex f-center light">
        @2021 - Fais quelquepart
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>