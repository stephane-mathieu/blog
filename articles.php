<?php

//connexion à la base
require('./DATABASE/database-sqli.php');


//requette pour compter les articles
$sql_count_articles = mysqli_query($conn, 'SELECT COUNT(*) AS liste FROM `articles`');
$count_articles = mysqli_fetch_all($sql_count_articles, MYSQLI_ASSOC);


//pagination
$page = "";
if(isset($_GET['page']))
{
    $page = $_GET["page"];
}

if (empty($page)) {
    $page = 1;
}
$nbr_article_par_page = 5;
$nbr_page = ceil($count_articles[0]["liste"] / $nbr_article_par_page);
$debut = ($page - 1) * $nbr_article_par_page;


//requette pour afficher tous les articles
$sql_articles = mysqli_query($conn, "SELECT * FROM `articles` ORDER BY `date` DESC LIMIT $debut , $nbr_article_par_page");
$articles = mysqli_fetch_all($sql_articles, MYSQLI_ASSOC);
if (count($articles) == 0) {
    header("location: articles.php");
}

if(isset($_GET['categorie']))
{
    $page_categorie = $_GET['categorie'];
}

/* if (isset($page_categorie)) { */
    //requete pour afficher les categories dans le selecteur html

    
    $sql = mysqli_query($conn, "SELECT categories.* FROM categories ");
    $result_cat = mysqli_fetch_all($sql, MYSQLI_ASSOC);


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Articles</title>
    <link rel="stylesheet" href="./css/style.css">
    <?php include ('meta.php') ?>

</head>

<body>
    <?php require('header.php') ?>
    <main class="container">

        <section class="categorieHidden">


            <form action="" method="GET">
                <select name="categorie">
                    <?php foreach ($result_cat as $categorie) { ?>
                        <option value="<?php echo $categorie['nom']; ?> "><?php echo $categorie['nom']; ?> </option>
                    <?php } ?>
                </select>
                <input type='hidden' name='page' value='1'>
                <button type='submit' name="submit" class="formButton">Valider</button>
            </form>
            <div class="pagination">
                <?php
                //savoir sur qu'elle page nous sommes 
                if (isset($_GET['categorie'])) {

                  

                    //requette pour compter les articles
                $sql_count_articles_cat = mysqli_query($conn, "SELECT COUNT(articles.id_categorie) AS liste_cat FROM `articles` INNER JOIN `categories` ON categories.id = articles.id_categorie WHERE categories.nom = '$page_categorie'");
                $count_articles_cat = mysqli_fetch_all($sql_count_articles_cat, MYSQLI_ASSOC);

                $nbr_article_par_page_cat = 5;
                $nbr_page_cat = ceil($count_articles_cat[0]["liste_cat"] / $nbr_article_par_page_cat);
                $debut_cat = ($page - 1) * $nbr_article_par_page_cat;
                


                //requette pour afficher tous les articles
                $sql_articles_cat = mysqli_query($conn, "SELECT articles.id, articles.titre, articles.date, articles.article, articles.id_utilisateur, articles.id_categorie, categories.nom 
                FROM articles 
                INNER JOIN categories ON categories.id = articles.id_categorie 
                WHERE categories.nom = '$page_categorie' 
                ORDER BY date 
                DESC 
                LIMIT $debut_cat");
                $articles_cat = mysqli_fetch_all($sql_articles_cat, MYSQLI_ASSOC);
// echo "<pre>";
// var_dump($count_articles_cat);

// echo "<pre>";

                      

                    for ($i = 1; $i <= $nbr_page_cat; $i++) {
                        if ($page != $i)
                            echo "<a class='page' href='?page=$i&categorie=$page_categorie'>$i</a>&nbsp";
                        else
                            echo "<a class='page'>$i</a>&nbsp";
                    }
                } else {
                    for ($i = 1; $i <= $nbr_page; $i++) {
                        if ($page != $i)
                            echo "<a class='page' href='?page=$i'>$i</a>&nbsp";
                        else
                            echo "<a class='page'>$i</a>&nbsp";
                    }
                }


                ?>
            </div>
        </section>
        <section class="conteneur_accueil containerOver">


            <?php
            //tri par catégorie des articles

            if (isset($_GET['categorie'])) {

                if (($_GET['categorie']) == $page_categorie) {

                    $sql_categories = mysqli_query($conn, "SELECT articles.id, articles.titre, articles.article, articles.date,  articles.id_utilisateur, articles.id_categorie, categories.nom 
                    FROM articles 
                    INNER JOIN categories ON categories.id = articles.id_categorie 
                    WHERE categories.nom = '$page_categorie'");

                    $result = mysqli_fetch_all($sql_categories, MYSQLI_ASSOC);
                }
                
                // affichage des articls par catégorie
                if(isset($_GET['page']) && $_GET['page']==1){
                    
                for($i=0;isset($result[$i])&& $i<5;$i++) {
            ?>

                    <div class="articleTitre"><?= $result[$i]['titre'] ?></div>
                    <div><?= $result[$i]['article'] ?></div>
                    <div><?= $result[$i]['date'] ?></div>
                    <div><?php echo '<a href="article.php?id=' . $result[$i]['id'] . '">view article</a>'; ?></div>


                <?php
                }
            }else{
                for($i=5;isset($result[$i]) && $i<10;$i++) {
                    ?>
        
                            <div class="articleTitre"><?= $result[$i]['titre'] ?></div>
                            <div><?= $result[$i]['article'] ?></div>
                            <div><?= $result[$i]['date'] ?></div>
                            <div><?php echo '<a href="article.php?id=' . $result[$i]['id'] . '">view article</a>'; ?></div>
        
        
                        <?php
                        }
            }
            } else {
                // On boucle sur tous les articles
                foreach ($articles as $article) {
                ?>

                    <div class="articleTitre"><?= $article['titre'] ?></div>
                    <div><?= $article['article'] ?></div>
                    <div><?= $article['date'] ?></div>
                    <div><?php echo '<a href="article.php?id=' . $article['id'] . '">view article</a>'; ?></div>

            <?php
                }
            }
            ?>

        </section>


    </main>
    <section class="footer">
        <?php require('footer.php') ?>
    </section>
</body>

</html>