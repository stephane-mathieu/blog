 
<?php
// session_start();
require('./DATABASE/database-sqli.php');
session_start();



$test = $_GET['id'];

$page_categorie = $_POST['categorie'];
$article = $_POST['article'];
$new_date = $_POST['date-time'];

$loginnn = $_SESSION['user'];
$DateAndTime = date('Y-m-d h:i:s', time());




$sql_categori = mysqli_query($conn, "SELECT * FROM `categories` WHERE `nom` = '$page_categorie'");
$result1 = mysqli_fetch_all($sql_categori, MYSQLI_ASSOC);
$id_categorie = $result1[0]['id'];


// Select * from Utlisateur
$query = mysqli_query($conn,"SELECT * FROM `articles` WHERE `id`= '$test'");
$result = mysqli_fetch_all($query,MYSQLI_ASSOC);

$id_user = $result[0]['id_utilisateur'];


$queryCategories = mysqli_query($conn, "SELECT * FROM `categories`");
$resultCategories = mysqli_fetch_all($queryCategories, MYSQLI_ASSOC);

if(isset($_POST['submit'])){
    $querup = mysqli_query($conn,"UPDATE `articles` SET `article` = '$article', `id_utilisateur` = '$id_user', `id_categorie` = '$id_categorie', `date` = '$new_date' WHERE id = '$test'");
    header('location: admin-article.php');
}



?>

<!DOCTYPE html>
<html lang="en" class="profHtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <?php include ('meta.php') ?>
   
    <title>Article</title>
</head>
<body>
<?php require('header.php') ?>
<main class="mainForm">
            <form class="form" action="" method="POST">
                <div class="formSection">
                    <textarea class="formText" name = "article"></textarea>
                </div>
                <div class="formSection">
                    <select name="categorie">
                            <?php foreach ($resultCategories as $categorie) { ?>
                                <option value="<?php echo $categorie['nom']; ?> "><?php echo $categorie['nom']; ?> </option>
                            <?php } ?>
                        
                    </select>
                </div>

                <div class="formSection">

                    <input type="datetime-local" id="meeting-time"
                            name="date-time" value="<?php $DateAndTime ?>"
                            min="<?php $DateAndTime ?>" max="2030-01-14T00:00">
                </div>
                <div class="formSection">

                    <button class="formButton"  name = "submit" type="submit">Valider</button>
                </div>
            </form>
        <div>
    </main>
</body>
</html>



 