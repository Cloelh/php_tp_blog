<?php
// Voici la liste des actions possibles avec la page à charger associée

$listeDesActions = array(
    //vues
    "" => "vues/home.php",
    "home" => "vues/home.php",
    "connexion" => "vues/connexion.php",
    "pageContinent" => "vues/pageContinent.php",
    "pagePays" => "vues/pagePays.php",
    "pageArticle" => "vues/pageArticle.php",
    "pageCompte" => "vues/pageCompte.php",
    "newArticle" => "vues/newArticle.php",
    "editArticle" => "vues/editArticle.php",
    "pageAdmin" => "vues/pageAdmin.php",

    //traitement
    "register" => "traitement/register.php",
    "login" => "traitement/login.php",
    "logout" => "traitement/logout.php",
    "postCommentaire" => "traitement/postCommentaire.php",
    "postArticle" => "traitement/postArticle.php",
    "updateArticle" => "traitement/updateArticle.php",
    "suppArticle" => "traitement/suppArticle.php",
    "admin" => "traitement/admin.php",
)

?>