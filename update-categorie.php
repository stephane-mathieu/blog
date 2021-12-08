<?php
// session_start();
require('./DATABASE/database-sqli.php');
session_start();



$test = $_GET['id'];


$query = mysqli_query($conn,"SELECT * FROM `categories` WHERE `id`= '$test'");
$result = mysqli_fetch_all($query,MYSQLI_ASSOC);

$cat = $_POST['categorie'];

var_dump($result);

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
    <title>Document</title>
</head>
<body>
    <main>
        <div class="container col-5 position-absolute top-50 start-50 translate-middle">
            <form  class ="row g-3"action="" method="POST">
            <div class="form-group">
                    <label for="login">modifier la  categorie:</label><br>
                    <input type="categorie" name="categorie" class="form-control" placeholder="Login"  value ="<?php echo $result[0]['nom'] ?>" autocomplete="off">
            </div>
                <button class="btn btn-primary"  name = "submit" type="submit">Valider</button>
            </form>
        <div>
    </main>
</body>
</html>


