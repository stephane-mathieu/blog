<?php
    // require('./DATABASE/connect-data-base.php');

    // Connexion BDD utilisateurs
    $bdd = mysqli_connect('localhost', 'root', '', 'blog');
    mysqli_set_charset($bdd, 'utf-8');
    $queryUser = mysqli_query($bdd, "SELECT * FROM `utilisateurs`");
    $resultUser = mysqli_fetch_assoc($queryUser);



    // Inner Join id (utilisateurs) -> id_utilisateur (articles)
    $queryJoinArticle = mysqli_query($bdd, "SELECT * FROM `utilisateurs` INNER JOIN `articles` WHERE utilisateurs.id = articles.id_utilisateur");
    $resultarticle = mysqli_fetch_all($queryJoinArticle, MYSQLI_ASSOC);
    var_dump($queryJoinArticle);

    // Inner Join id (catégories) -> id_categorie (articles)
    $queryJoinCategory = mysqli_query($bdd, "SELECT * FROM `categories` INNER JOIN `articles` WHERE categories.id = articles.id_categorie");



    if(isset($_POST['submit'])){
        $userArticle = $_POST['createArticle'];
        // $userId = $_SESSION['id'];
        $date = date("Y/m/d H:i:s");
        $italie = $_POST['italie'];
        var_dump($italie);
        
        
        $queryArticle = mysqli_query($bdd, "INSERT INTO `articles`(`article`, `id_utilisateur`,`id_categorie`, `date` VALUES ('$userArticle', '$userId', '$categories', '$date')");
    }
    
    $categories = explode("_", $_POST['categories'][0]);
    var_dump($categories);
    
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

        <label for="italie">Italie</label>
        <input type="checkbox" name="italie">
        <label for="vietnam">Vietnam</label>
        <input type="checkbox" name="vietnam">
        <label for="russie">Russie</label>
        <input type="checkbox" name="russie">

        <button name="submit">Submit</button>
    </form>
</body>
</html>