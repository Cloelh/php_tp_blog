<?php

    
    if(
        !empty($_POST['nom']) AND
        !empty($_POST['prenom']) AND
        !empty($_POST['pseudo']) AND 
        !empty($_POST['mail']) AND 
        !empty($_POST['mdp']) AND 
        !empty($_POST['mdpVerif']) ){
       
            $nom = htmlspecialchars($_POST['nom']);
            $_COOKIE['nom'] = $nom;
            $prenom = htmlspecialchars($_POST['prenom']);
            $pseudo = htmlspecialchars($_POST['pseudo']);
            $mail = htmlspecialchars($_POST['mail']);
            $mdp = sha1($_POST['mdp']);
            $mdpVerif = sha1($_POST['mdpVerif']);

            if(strlen($nom) < 100){
                if(strlen($prenom) < 100){
                    if(strlen($pseudo) < 100){
                        if(strlen($mail) < 100){
                            if($mdp == $mdpVerif){
                                //l'email n'existe pas pour une autre compte
                                $reqpseudo = $bdd->prepare("SELECT * FROM user WHERE pseudo = ?");
                                $reqpseudo->execute(array($pseudo));
                                $pseudoexist = $reqpseudo->rowCount(); //si une ligne est renvoyé, le pseudo existe déjà dans la bdd

                                if($pseudoexist == 0){
                                    //l'email n'existe pas pour une autre compte
                                    $reqmail = $bdd->prepare("SELECT * FROM user WHERE mail = ?");
                                    $reqmail->execute(array($mail));
                                    $mailexist = $reqmail->rowCount(); //si une ligne est renvoyé, l'email existe déjà dans la bdd

                                    if($mailexist == 0){

                                        $date = date('d-m-Y');
                                        $role = 'user';
                                        
                                        //toutes les conditions sont ok => inscription/insertion des données dans le bdd
                                        $insertUser = $bdd->prepare("INSERT INTO user(nom, prenom, pseudo, mail, mdp, roleUser, rememberMe) VALUES(?, ?, ?, ?, ?, ?, ?)");
                                        $insertUser->execute(array($nom, $prenom, $pseudo, $mail, $mdp, $role, 0));
                                        header("Location: index.php?action=connexion&message=votre compte a bien été crée");
                                    }
                                    else{
                                        $message = "cet email existe déjà";
                                        header("Location: index.php?action=connexion&messageInscription=" . $message);}
                                }
                                else{
                                    $message = "ce pseudo existe déjà";
                                    header("Location: index.php?action=connexion&messageInscription=" . $message);}
                            }
                            else{
                                $message = "les mots de passe ne correspondent pas";
                                header("Location: index.php?action=connexion&messageInscription=" . $message);}
                        }
                        else{
                            $message = "email trop long";
                            header("Location: index.php?action=connexion&messageInscription=" . $message);}
                    }
                    else{
                        $message = "pseudo trop long";
                        header("Location: index.php?action=connexion&messageInscription=" . $message);}
                }
                else{
                    $message = "prenom trop long";
                    header("Location: index.php?action=connexion&messageInscription=" . $message);}
            }
            else{
                $message = "nom trop long";
                header("Location: index.php?action=connexion&messageInscription=" . $message);}
    }
    else{
        $message = "veuillez remplit tous les champs";
        header("Location: index.php?action=connexion&messageInscription=" . $message);}

?>