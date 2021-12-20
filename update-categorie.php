<?php
// session_start();
require('./DATABASE/database-sqli.php');
session_start();



$test = $_GET['id'];


$query = mysqli_query($conn,"SELECT * FROM `categories` WHERE `id`= '$test'");
$result = mysqli_fetch_all($query,MYSQLI_ASSOC);

$cat = $_POST['categorie'];


    if(isset($_POST['submit'])){
        $updt = mysqli_query($conn,"UPDATE `categories` SET `nom`='$cat' WHERE id = '$test'");
        header('location: admin-categorie.php');
    }




?>

<!DOCTYPE html>
<html lang="en" class="profHtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Categorie</title>
</head>
<body>
<?php require('header.php') ?>
<main class="mainForm">
            <form  class ="form"action="" method="POST">
            <div class="formSection">
                    <label for="login">modifier la  categorie:</label><br>
                    <input type="text" name="categorie" class="formText" placeholder="Login"  value ="<?php echo $result[0]['nom'] ?>" autocomplete="off">
            </div>
                <button class="formButton"  name = "submit" type="submit">Valider</button>
            </form>
</main>
</body>
</html>


