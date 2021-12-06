<?php

//connexion à la base
// require('./DATABASE/connect-data-base.php');



$bdd = mysqli_connect("localhost","root","root","blog");



//requette pour compter les articles
$sql_count_articles = mysqli_query($bdd,'SELECT COUNT(*) AS liste FROM `articles`');
$count_articles = mysqli_fetch_all($sql_count_articles, MYSQLI_ASSOC);


//pagination
@$page = $_GET["page"];
if(empty($page)){
    $page = 1;
}
$nbr_article_par_page = 5;
$nbr_page = ceil($count_articles[0]["liste"] / $nbr_article_par_page);
$debut = ($page - 1) * $nbr_article_par_page;


//requette pour afficher tous les articles
$sql_articles = mysqli_query($bdd,"SELECT * FROM `articles` ORDER BY `date` DESC LIMIT $debut , $nbr_article_par_page");
$articles = mysqli_fetch_all($sql_articles, MYSQLI_ASSOC);
if(count($articles) == 0){
    header("location: articles.php");
}


echo '<pre>';
var_dump($nbr_page);
echo '</pre>';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
</head>
<body>
<main class="container">
        <div class="row">
            <section class="liste-article">
                <h1>Liste des articles</h1>
                <?php
                    for($i = 1; $i <= $nbr_page; $i++){
                        if($page != $i)
                            echo "<a href='?page=$i'>$i</a>&nbsp";
                        else
                            echo "<a>$i</a>&nbsp";
                    }
                ?>
                <table class="table-article">
                    <thead>
                        <th>ID</th>
                        <th>Titre</th>
                        <th>Date</th>
                    </thead>
                    <tbody>
                        <?php
                        // On boucle sur tous les articles
                        foreach($articles as $article){
                        ?>
                            <tr>
                                <td><?= $article['id'] ?></td>
                                <td><?= $article['article'] ?></td>
                                <td><?= $article['date'] ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </section>
        </div>
    </main>
</body>
</html>