<?php
$idArticle = $_GET['idArticle'];

$suppArticle = $bdd->prepare("DELETE FROM `article` WHERE `article`.`id` = :id ");
$suppArticle->execute([
    'id' => $idArticle
]);

$suppCom = $bdd->prepare("DELETE FROM `commentaire` WHERE `commentaire`.`idArticle` = :id ");
$suppCom->execute([
    'id' => $idArticle
]);

header("Location: index.php?action=home");

?>