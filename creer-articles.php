<?php

session_start();
    // Connexion BDD utilisateurs
    require('./DATABASE/database-sqli.php');

    $loginnn = $_SESSION['user'];

    $oi = $_POST['categorie'];
    $sql_categori = mysqli_query($conn, "SELECT * FROM `categories` WHERE `nom` = '$oi'");
    $result1 = mysqli_fetch_all($sql_categori, MYSQLI_ASSOC);


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



    if(isset($_POST['submit'])){
        echo "test";
        $userArticle = $_POST['createArticle'];
        $userId = $resultUser['id'];
        $date = date("Y/m/d H:i:s");

        if (($_POST['categorie']) == $oi) {
            $idcate = $result1[0]['id'];
            
        }

        if(empty($userArticle)){
            echo "Veuillez rédiger un article.";
        }

        
        var_dump($date);
        var_dump($userArticle);
        var_dump($userId);
        var_dump($idcate);

        
        $queryArticle = mysqli_query($conn, "INSERT INTO `articles`(`article`, `id_utilisateur`, `id_categorie`, `date`) VALUES ('$userArticle','$userId','$idcate','$date')");
        
        if(isset($queryArticle)){
            echo "ok";
        }
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">
    <link href="./Style/connexion.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Créer Article</title>
</head>
<body>
    <header>
        <?php require('header.php') ?>
    </header>
<main>
<div class="container">
        <div class="row gx-0">
            <div class="col-md-7">
                <div class="card border-0">
                        <form  class="box" action="" method="POST">
                                <label for="createArticle"></label>
                                <!-- <textarea  name="createArticle" cols="30" rows="10"></textarea> -->
                                <label class="bi bi-pencil-fill" for="form10">Votre Article</label>
                                <div class="md-form">
                                <textarea id="form10" class="md-textarea form-control" rows="3"></textarea>
                                
                                </div>
                                <select  class=" selecto" name="categorie">
                                                <?php foreach ($resultCategories as $categorie) { ?>
                                                    <option value="<?php echo $categorie['nom']; ?> "><?php echo $categorie['nom']; ?> </option>
                                                <?php } ?>
                                            
                                </select>
                                <input  type="submit" name="submit"></button>
                        </form>
                </div>
            </div>
        </div>
</div>
</main>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>