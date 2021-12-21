<?php


    // Connexion BDD utilisateurs
    require('./DATABASE/database-sqli.php');

    @$loginnn = $_SESSION['user'];

    @$page_categorie = $_GET['categorie'];
    $sql_categori = mysqli_query($conn, "SELECT * FROM `categories` WHERE `nom` = '$page_categorie'");
    $result1 = mysqli_fetch_all($sql_categori, MYSQLI_ASSOC);

    //msg d'erreur
    $msg = "";

    // Select * from Utlisateur
    $queryUser = mysqli_query($conn, "SELECT * FROM `utilisateurs` where login = '$loginnn'");
    $resultUser = mysqli_fetch_assoc($queryUser);


    //Select * from Categories
    $queryCategories = mysqli_query($conn, "SELECT * FROM `categories`");
    $resultCategories = mysqli_fetch_all($queryCategories, MYSQLI_ASSOC);
   


    // Inner Join id (utilisateurs) -> id_utilisateur (articles)
    $queryJoinArticle = mysqli_query($conn, "SELECT * FROM `utilisateurs` INNER JOIN `articles` WHERE utilisateurs.id = articles.id_utilisateur");
    $resultarticle = mysqli_fetch_all($queryJoinArticle, MYSQLI_ASSOC);

    // Inner Join id (catégories) -> id_categorie (articles)
    $queryJoinCategory = mysqli_query($conn, "SELECT * FROM `categories` INNER JOIN `articles` WHERE categories.id = articles.id_categorie");
    $resultCategory = mysqli_fetch_all($queryJoinCategory);



    if(isset($_GET['submit'])){
        $userArticle = $_GET['createArticle'];
        $userId = $resultUser['id'];
        $date = date("Y/m/d H:i:s");
       

        if(empty($userArticle)){
            echo "Veuillez rédiger un article.";
        }

        if (($_GET['categorie']) == $page_categorie) {
            $idcate = $result1[0]['id'];
            $categories = $idcate;
        }
        
        $queryArticle = mysqli_query($conn, "INSERT INTO `articles`(`article`, `id_utilisateur`, `id_categorie`, `date`) VALUES ('$userArticle','$userId','$categories','$date')");
        
    }
   

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" >
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">

    <title>Article</title>
</head>
<body>
    <?php require('header.php') ?>
    <main class="mainForm">
        <form action="" method="GET" class="form" >
            <div class="formSection">
            <textarea class="formText" name="createArticle" cols="30" rows="10"></textarea>
            </div>
            <div class="formSection">
            <select name="categorie">
                            <?php foreach ($resultCategories as $categorie) { ?>
                                <option value="<?php echo $categorie['nom']; ?> "><?php echo $categorie['nom']; ?> </option>
                            <?php } ?>
                        
            </select>
            </div>
            <button name="submit" class="formButton">Submit</button>
        </form>
    </main>
</body>
</html> 