<?php

//connexion à la base
// require('./DATABASE/connect-data-base.php');

$bdd = mysqli_connect("localhost","root","","blog");


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
                <form action = "" method= "post">
                <select name = "categorie">
                    <option value="1">Italie</option>
                    <option value="2">Vietnam</option>
                    <option value="3">Russie</option>
                </select>
                <button name = "submit">Valider</button>
                <button name="reset"><a href="articles.php?page=1">Reset</a></button>
                </form>
                <?php
                //savoir sur qu'elle page nous sommes 
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
                       //tri par catégorie des articles
                                
                                    if(isset($_POST['categorie']) && isset($_POST['submit'])){

                                    if(($_POST['categorie']) == 1 ){
                                        $sql_categories = mysqli_query($bdd,"SELECT * FROM `articles` WHERE `id_categorie` = 1");
                                        $result = mysqli_fetch_all($sql_categories, MYSQLI_ASSOC);
                                    }  

                                    if(($_POST['categorie']) == 2 ){
                                        $sql_categories = mysqli_query($bdd,"SELECT * FROM `articles` WHERE `id_categorie` = 2");
                                        $result = mysqli_fetch_all($sql_categories, MYSQLI_ASSOC);
                                    }    

                                    if(($_POST['categorie']) == 3 ){
                                        $sql_categories = mysqli_query($bdd,"SELECT * FROM `articles` WHERE `id_categorie` = 3");
                                        $result = mysqli_fetch_all($sql_categories, MYSQLI_ASSOC);   
                                    }

                        // affichage des articles par catégorie
                                        foreach($result as $cat){
                                            ?>
                                                <tr>
                                                    <td><?= $cat['id_categorie'] ?></td>
                                                    <td><?= $cat['article'] ?></td>
                                                    <td><?= $cat['date'] ?></td>
                                                    <td> <?php echo '<a href="article.php?id='.$cat['id'] . '">view article</a>';?></td>
                                                </tr>
                                                <?php   
                                            }
                                            
                                        }
                                        
                                        else{ 
                                            // On boucle sur tous les articles
                                            foreach($articles as $article){
                                                ?>
                                                    <tr>
                                                        <td><?= $article['id'] ?></td>
                                                        <td><?= $article['article'] ?></td>
                                                        <td><?= $article['date'] ?></td>
                                                        <td> <?php echo '<a href="article.php?id='.$article['id'] . '">view article</a>';?></td>
                                                    </tr>
                                                <?php
                                                }
                        }
                         ?>
                    </tbody>
                </table>
            </section>
        </div>
    </main>
</body>
</html>