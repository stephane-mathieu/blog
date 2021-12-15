<?php

//connexion à la base
$bdd = mysqli_connect("localhost","root","","blog");

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
    <link href="./Style/index2.css" rel="stylesheet">
    <link href="./Style/text.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Page d'accueil</title>
</head>
<body>
    <header>
        <?php require 'header.php'?>
    </header>
<main class="main1">
    <div class="typing">
        <h2 class="text-uppercase">Creating..</h2>
    </div>
    <div class="container">
        <div class="row">
            <div class=" rt d-flex justify-content-center align-item-center ">
            <?php
                        foreach($affiche_article as $article){
                            ?>
                            <div class=" item icard card ms-5 view  style="width: 20rem;">
                                <div class="item">
                                    <div class=" it1  item card-body">
                                       <p><?= $article['article'] ?></p> 
                                        <p><?= $article['date'] ?></p>
                                    </div>
                                    <?php echo '<a class="bi bi-eye h3" href="article.php?id='.$article['id'] . '"></a>';?>
                                </div>
                            </div>
                                <?php
                
            }
            ?>
        </div>
    </div>
    <div class="artcl">
            <a class=" ba bi bi-book h3"  href="articles.php"> voir plus d'article </a>
    </div>
</div>
</main>
<footer>
    <?php include('footer.php') ?>
</footer>
<?php include('script_index.php');?>
</body>
</html>