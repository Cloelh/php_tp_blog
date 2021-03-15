<!-- UPDATE table
SET colonne_1 = 'valeur 1', colonne_2 = 'valeur 2', colonne_3 = 'valeur 3'
WHERE condition -->

<?php
    $idArticle = $_GET['idArticle'];

    if(!empty($_POST['titre']) AND !empty($_POST['description']) AND !empty($_POST['contenu']) AND !empty($_POST['image']) AND !empty($_POST['idContinent']) AND !empty($_POST['idPays'])){
        $titre = htmlspecialchars($_POST['titre']);
        $description = htmlspecialchars($_POST['description']);
        $contenu = htmlspecialchars($_POST['contenu']);
        $image = htmlspecialchars($_POST['image']);
        $idContinent = htmlspecialchars($_POST['idContinent']);
        $idPays = htmlspecialchars($_POST['idPays']);
        $idAuteur = $_SESSION['id'];

        $reqContinent = $bdd->prepare('SELECT * FROM continent WHERE id=?');
        $reqContinent->execute(array($idContinent));
        $continent = $reqContinent->fetch();

        $reqPays = $bdd->prepare('SELECT * FROM pays WHERE id=?');
        $reqPays->execute(array($idPays));
        $pays = $reqPays->fetch();

        if(strlen($titre) < 250 ){
            if(strlen($image) < 250 ){
                if($pays['idContinent'] == $idContinent){
                    echo "titre : " . $titre . "</br>";
                    echo "descrption : " . $description . "</br>";
                    echo "contenu : " . $contenu . "</br>";
                    echo "image : " . $image . "</br>";
                    echo "id continent : " . $idContinent . "</br>";
                    echo "id pays : " . $idPays . "</br>";
                    echo "id article : " . $idArticle . "</br>";

                    $editArticle = $bdd->prepare("UPDATE article SET titre = :titre, description = :description, contenu = :contenu, lienImage = :image, idContinent = :idContinent, idPays = :idPays WHERE id = :idArticle)");
                    $editArticle->execute([
                        'titre' => $titre,
                        'description' => $description,
                        'contenu' => $contenu,
                        'lienImage' => $image,
                        'idContinent' => $idContinent,
                        'idPays' => $idPays,
                        'idArticle' => $idArticle
                    ]);
                    // header("Location: index.php?action=pageCompte&idUser=".$idAuteur);
                    echo "article mis à jour";
                }
                else{
                    echo $pays['nomPays']." n'appartient pas au continent ".$continent['nomContinent'];
                }
            }
            else{
                echo "lien image trop long";
            }
        }
        else{
            echo "titre trop long";
        }

    }

?>