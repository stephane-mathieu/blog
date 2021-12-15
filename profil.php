<?php
session_start();
//connexion a la bdd
require('./DATABASE/connect-data-base.php');
$bdd = mysqli_connect("localhost","root","","blog");
//

//recup de la session conn
$sessLogin = $_SESSION['user'];
$sessPasswrd = $_SESSION['userPass'];
$id = $_SESSION['userId'];
$newlog = $_POST['login'];

$password =  $_POST['password'];
$hashed_pwrd = password_hash($password, PASSWORD_DEFAULT);
$newpassWrd = $hashed_pwrd;


if (isset($_SESSION['user'])) {
    $requette = $pdo->prepare("SELECT login,password FROM `utilisateurs` WHERE `id`= '$id'");
    $requette->setFetchMode(PDO::FETCH_ASSOC);
    $requette->execute();
    if (isset($requette))
    $recuper=$requette->fetchall(PDO::FETCH_COLUMN);

    $requ = $pdo->prepare("SELECT password FROM `utilisateurs` WHERE `id`= '$id'");
    $requ->setFetchMode(PDO::FETCH_ASSOC);
    $requ->execute();
    if (isset($requ))
    $recupsw=$requ->fetchall(PDO::FETCH_COLUMN);
    
}


$requete_con = mysqli_query($bdd, "SELECT * FROM `utilisateurs` WHERE `login` = '$newlog'");
$requete_confetch = mysqli_fetch_all($requete_con, MYSQLI_ASSOC);


  
    if(isset($_POST['validerlog']))
    {
        
        if(!empty($_POST['login'])){

            if(count($requete_confetch) == 0){
                $newlog = $_POST['login'];

                $update = "UPDATE `utilisateurs` SET `login`= '$newlog' WHERE `id` = '$id'";
                $update_new = mysqli_query($bdd, $update);
    
                if(isset($update_new)) {
    
                    $requette = $pdo->prepare("SELECT `login` FROM `utilisateurs` WHERE `id`= '$id'");
                    $requette->setFetchMode(PDO::FETCH_ASSOC);
                    $requette->execute();
                    $recuper=$requette->fetchall(PDO::FETCH_COLUMN);
    
                }
            } elseif(count($requete_confetch) != 0){
                echo "login alredy used";
            }
        }

            if(!empty($_POST['password'])){
                $update2 = $pdo->prepare("UPDATE `utilisateurs` SET `password`='$newpassWrd' WHERE `login` = '$sessLogin'");
                $update2->setFetchMode(PDO::FETCH_ASSOC);
                $update2->execute();
                $update_new2=$update2->fetchall();
    
            }

        }
   



?>

<!DOCTYPE html>
<html lang="en" class="profHtml">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" type="text/css">
    <link href="./style/styles.css" rel="stylesheet">
    <link href="./Style/connexion.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Document</title>
</head>
<body class="profilBody">
<header>
        <?php require('header.php') ?>
</header>
    <main>
    <div class= container>
        <div class="row gx-0">
            <div class="col-md-7">
                <div class="card border-0">
                    <form  class ="box" action="profil.php" method="post" class="form">
                                    <h2 class="sous-titre">Profil de <?php echo $recuper[0] ?> </h2>
                                        <div class="form-group">
                                            <label for="login">Nouveau login:</label><br>
                                            <input type="text" name="login" class="form-control" placeholder="Login"  value ="<?php echo $recuper[0]; ?>" autocomplete="off">
                                            <label for="login">Nouveau password:</label><br>
                                            <input type="password" name="password" class="form-control2" placeholder="Mot de passe"   autocomplete="off">
                                            <input type="submit" name= "validerlog" class="btn btn-primary btn-block"></button>
                                </form>
                 </div>
            </div>
        </div>
    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>