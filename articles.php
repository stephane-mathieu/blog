<?php

//connexion à la base
require('./DATABASE/database-sqli.php');


//requette pour compter les articles
$sql_count_articles = mysqli_query($conn, 'SELECT COUNT(*) AS liste FROM `articles`');
$count_articles = mysqli_fetch_all($sql_count_articles, MYSQLI_ASSOC);


//pagination
@$page = $_GET["page"];

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

//requete pour afficher les categories dans le selecteur html
$sql = mysqli_query($conn, "SELECT categories.* FROM categories ");
$result_cat = mysqli_fetch_all($sql, MYSQLI_ASSOC);

$sql_recup = mysqli_query($conn, "SELECT categories.*, articles.id_categorie FROM categories INNER JOIN articles WHERE categories.id = articles.id_categorie;");
$result_article_tri = mysqli_fetch_all($sql_recup, MYSQLI_ASSOC);


@$oi = $_GET['categorie'];
$sql_categori = mysqli_query($conn, "SELECT * FROM `categories` WHERE `nom` = '$oi'");
$result1 = mysqli_fetch_all($sql_categori, MYSQLI_ASSOC);



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
<?php require('header.php') ?>
    <main class="container">
        <div class="row">
            <section class="liste-article">
                <h1>Articles</h1>
                <form action="" method="GET">
                    <select name="categorie">
                        <?php foreach ($result_cat as $categorie) { ?>
                            <option value="<?php echo $categorie['nom']; ?> "><?php echo $categorie['nom']; ?> </option>
                        <?php } ?>
                    </select>
                    <button name="submit" class="formButton">Valider</button>
                </form>
                <?php
                //savoir sur qu'elle page nous sommes 
                for ($i = 1; $i <= $nbr_page; $i++) {
                    if ($page != $i)
                        echo "<a class='page' href='?page=$i'>$i</a>&nbsp";
                    else
                        echo "<a class='page'>$i</a>&nbsp";
                }
                ?>
                <table class="table-article">
                    <thead>
                        <th>Titre</th>
                        <th>Poème</th>
                        <th>Date</th>
                    </thead> 
                    <tbody>
                        <?php
                        //tri par catégorie des articles

                        if (isset($_GET['categorie'])) {

                            if (($_GET['categorie']) == $oi) {
                                $idcate = $result1[0]['id'];
                                $sql_categories = mysqli_query($conn, "SELECT * FROM `articles` WHERE `id_categorie` = '$idcate'");
                                $result = mysqli_fetch_all($sql_categories, MYSQLI_ASSOC);
                            }

                            // affichage des articles par catégorie
                            foreach ($result as $cat) {
                        ?>
                                <tr>
                                    <td><?= $cat['titre'] ?></td>
                                    <td><?= $cat['article'] ?></td>
                                    <td><?= $cat['date'] ?></td>
                                    <td> <?php echo '<a href="article.php?id=' . $cat['id'] . '">view article</a>'; ?></td>
                                </tr>
                            <?php
                            }
                        } else {
                            // On boucle sur tous les articles
                            foreach ($articles as $article) {
                            ?>
                                <tr>
                                    <td class="articleTitre"><?= $article['titre'] ?></td>
                                    <td><?= $article['article'] ?></td>
                                    <td><?= $article['date'] ?></td>
                                    <td> <?php echo '<a href="article.php?id=' . $article['id'] . '">view article</a>'; ?></td>
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
    <section class="footer">
            <?php require('footer.php') ?>  
        </section>
</body>

</html>