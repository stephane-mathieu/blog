<?php
session_start();
// Connexion BDD utilisateurs
require('./DATABASE/database-sqli.php');


@$loogin = $_SESSION['user'];

$queryUser = mysqli_query($conn, "SELECT * FROM `utilisateurs` WHERE login = '$loogin'");
$resultUser = mysqli_fetch_all($queryUser, MYSQLI_ASSOC);


// Categorie
$sql = mysqli_query($conn, "SELECT categories.* FROM categories ");
$result_cat = mysqli_fetch_all($sql, MYSQLI_ASSOC);

$sql_recup = mysqli_query($conn, "SELECT categories.*, articles.id_categorie FROM categories INNER JOIN articles WHERE categories.id = articles.id_categorie;");
$result_article_tri = mysqli_fetch_all($sql_recup, MYSQLI_ASSOC);

// @$get = $_GET['categorie'];


?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    
</head>
<header class = "menu">
    <div class = "conteneur_nav" >
        <nav class = "menuNav">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="articles.php">Articles</a></li>
                    <li ><a href="index.php">Catégories
                        <ul>
                            <?php foreach ($result_cat as $cat) { ?>
                                <li class = "dropdown"><a href="articles.php?categorie=<?= $cat['nom'] ?>"><?= $cat['nom'] ?></a></li>
                                <?php
                                ?>
                            <?php } ?> 
                        </ul>
                </li>
            
            

            <!-- Si l'user n'est pas connecté -->
            <?php if (!isset($loogin)) { ?>
                <li>
                    <a href="inscription.php">Inscription</a>
                </li>
                <li>
                    <a href="connexion.php">Connexion</a>
                </li>
            <?php } ?>

            <!-- SI admin ou modo -->
            <?php
            if (@$resultUser[0]["id_droits"] == "1337" || @$resultUser[0]["id_droits"] == "42") {
            ?>
                <li class="nav-item">
                    <a href="creer-articles.php">Créer articles</a>
                </li>
            <?php }; ?>
            <?php
            if (@$resultUser[0]["id_droits"] == "1337") {
            ?><li class="nav-item">
                    <a href="admin.php">Admin</a>
                    <ul>
                        <li><a href="admin-categorie.php">catégories</a></li>
                        <li><a href="admin-article.php">articles</a></li>
                    </ul>
                </li>
            <?php }; ?>

            <!-- Si l'user est connecté -->
            <?php if (isset($loogin)) { ?>
                <li>
                    <a href="profil.php">Profil</a>
                </li>
                <li>
                    <form action="deconnexion.php" method="POST">
                        <button name="deconnexion" class="formButton btnNav">Deconnexion</button>
                    </form>
                </li>
            <?php } ?>

        
            </ul>
        </nav>
</div>
</header>