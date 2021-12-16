<?php
//connexion à la base
$bdd = mysqli_connect("localhost","root","root","blog");

//requete pour recuperer les articles et les afficher par 3

$sql_affiche_article = mysqli_query($bdd, "SELECT * FROM `articles` ORDER BY `date` DESC LIMIT 3");
$affiche_article = mysqli_fetch_all($sql_affiche_article, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <title>Accueil</title>
</head>
<body>
    <?php require 'header.php'?>
    <section class="conteneur_accueil">
            <h1>Poèmes</h1>
            
            <?php
            foreach($affiche_article as $article){
                ?>
                    <tr>
                        <td class="articleTitre"><?= $article['titre'] ?></td></br>
                        <td><?= $article['article'] ?></td></br>
                        <td><?= $article['date'] ?></td></br>
                        <td> <?php echo '<a href="article.php?id='.$article['id'] . '">voir plus</a>';?></td></br>
                    </tr>
                <?php
                }
                ?> 
                <a href="articles.php">voir plus d'article</a>
        </section> 
        
                 
</body>
        <section class="footer">
            <?php require('footer.php') ?>  
        </section>
</html>