
<?php

if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $mdp = sha1($_POST['mdp']);

    $connectVerif = $bdd->prepare("SELECT * FROM user WHERE pseudo = ?");
    $connectVerif->execute(array($pseudo));
    
    $nbProfil = $connectVerif->rowCount();
    if($nbProfil == 1){
        $userInfo = $connectVerif->fetch();
        if($mdp == $userInfo['mdp']){

            //l'user existe =>connexion
            $_SESSION['id'] = $userInfo['id'];
            $_SESSION['nom'] = $userInfo['nom'];
            $_SESSION['prenom'] = $userInfo['prenom'];
            $_SESSION['pseudo'] = $userInfo['pseudo'];
            $_SESSION['email'] = $userInfo['email'];
            $_SESSION['mdp'] = $userInfo['mdp'];
            $_SESSION['roleUser'] = $userInfo['roleUser'];
            header("Location: index.php?action=home");
        }
        else{
            $message = "mauvais mot de passe";
            header("Location: index.php?action=connexion&messageConnexion=" . $message);}
    }
    else{
        $message = "aucun profil ne correspond à ce pseudo";
        header("Location: index.php?action=connexion&messageConnexion=" . $message);}
}
else{
    $message = "remplit tous les champs";
    header("Location: index.php?action=connexion&messageConnexion=" . $message);}
?>