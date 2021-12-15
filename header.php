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

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./Style/styles.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Document</title>
</head>
<header class="menu d-flex justify-content-center ">
    <nav class="navbar navbar-expand-lg navbar-dark ">
        <div class=" test container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item active"><a class="nav-link " href="index.php">Accueil</a></li>
                                    <li class="nav-item active "><a class="nav-link " href="articles.php">Articles</a></li>
                                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                                        <ul class="navbar-nav ms-auto">
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle " href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Catégories
                                                </a>
                                                <ul class="dropdown-menu fade-up" aria-labelledby="navbarDarkDropdownMenuLink">
                                                        <?php foreach ($result_cat as $cat) { ?>
                                                            <li>
                                                                <a class="dropdown-item" href="articles.php?categorie=<?= $cat['nom'] ?>"><?= $cat['nom'] ?> </a>
                                                                <?php
                                                                ?>
                                                            </li>
                                                            <?php } ?>
                                                </ul>
                                            </li>
                                        </ul>
                                </div>
                                                            <!-- Si l'user n'est pas connecté -->
                                    <?php if (!isset($loogin)) { ?>
                                        <li class="nav-item active ">
                                            <a class="nav-link" href="inscription.php">Inscription</a>
                                        </li>
                                        <li class="nav-item active ">
                                            <a class="nav-link" href="connexion.php">Connexion</a>
                                        </li>
                                    <?php } ?>
                                    <!-- Si l'user est connecté -->
                                    <?php if (isset($loogin)) { ?>
                                                <li class="nav-item active ">
                                                    <a class="nav-link " href="profil.php">Profil</a>
                                                </li>
                                                <li class="nav-item active">
                                                    <a class="nav-link" href="deconnexion.php">Deconnexion</a>
                                                </li>
                                            <?php } ?>
                                    <!-- SI admin ou modo -->
                                    <?php
                                            if (@$resultUser[0]["id_droits"] == "1337" || @$resultUser[0]["id_droits"] == "42") {
                                            ?>
                                                <li class="nav-item active ">
                                                    <a class="nav-link"  href="creer-articles.php">Créer articles</a>
                                                </li>
                                            <?php }; ?>
                                <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                                        <ul class="navbar-nav ms-auto">
                                            <li class="nav-item dropdown">
                                                
                                                    <?php
                                                    if (@$resultUser[0]["id_droits"] == "1337") {
                                                    ?>
                                                    <a class="nav-link dropdown-toggle  href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Admin
                                                    </a>
                                                    <ul class="dropdown-menu dropdown-menu-end fade-down" aria-labelledby="navbarDarkDropdownMenuLink">
                                                        <li class="nav-item">
                                                                <a class="dropdown-item" href="admin.php">utilisateur</a>
                                                        </li>
                                                        <li class="nav-item">
                                                                <a class="dropdown-item" href="admin-article.php">article</a>
                                                        </li>
                                                        <li class="nav-item">
                                                                <a class="dropdown-item" href="admin-categorie.php">categorie</a>
                                                        </li>
                                                    </ul>
                                                    <?php }; ?>
                                </div>
                                
                            </ul>
            </div>
        </div>
    </nav>
</header>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
