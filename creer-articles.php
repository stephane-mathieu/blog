<?php

session_start();
    // Connexion BDD utilisateurs
    $bdd = mysqli_connect('localhost', 'root', '', 'blog');
    mysqli_set_charset($bdd, 'utf-8');

    $loginnn = $_SESSION['user'];

    // Select * from Utlisateur
    $queryUser = mysqli_query($bdd, "SELECT * FROM `utilisateurs` where login = '$loginnn'");
    $resultUser = mysqli_fetch_assoc($queryUser);

    var_dump($_SESSION['user']);
    var_dump($resultUser['id']);

    //Select * from Categories
    $queryCategories = mysqli_query($bdd, "SELECT * FROM `categories`");
    $resultCategories = mysqli_fetch_all($queryCategories, MYSQLI_ASSOC);
    // var_dump($resultCategories['0']['id']);


    // Inner Join id (utilisateurs) -> id_utilisateur (articles)
    $queryJoinArticle = mysqli_query($bdd, "SELECT * FROM `utilisateurs` INNER JOIN `articles` WHERE utilisateurs.id = articles.id_utilisateur");
    $resultarticle = mysqli_fetch_all($queryJoinArticle, MYSQLI_ASSOC);
    // var_dump($resultarticle);

    // Inner Join id (catégories) -> id_categorie (articles)
    $queryJoinCategory = mysqli_query($bdd, "SELECT * FROM `categories` INNER JOIN `articles` WHERE categories.id = articles.id_categorie");
    $resultCategory = mysqli_fetch_all($queryJoinCategory);
    // var_dump($resultCategory);



    if(isset($_POST['submit'])){
        $userArticle = $_POST['createArticle'];
        $userId = $resultUser['id'];
        $date = date("Y/m/d H:i:s");

        if(empty($userArticle)){
            echo "Veuillez rédiger un article.";
        }

        if($_POST['categories'] == '1'){
            $categories = 1;
        }
        if($_POST['categories'] == '2'){
              $categories = 2;
        }
        if($_POST['categories'] == '3'){
            $categories = 3;
        }
        
        $queryArticle = mysqli_query($bdd, "INSERT INTO `articles`(`article`, `id_utilisateur`, `id_categorie`, `date`) VALUES ('$userArticle','$userId','$categories','$date')");
        
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer Article</title>
</head>
<body>
    <?php require('header.php') ?>

    <form action="" method="POST">
        <label for="createArticle"></label>
        <textarea name="createArticle" cols="30" rows="10"></textarea>

        <select name="categories">
            <option value="1">Italie</option>
            <option value="2">Vietnam</option>
            <option value="3">Russie</option>
        </select>

        <button name="submit">Submit</button>
    </form>
</body>
</html>