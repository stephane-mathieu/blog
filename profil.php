<?php
session_start();
//connexion a la bdd
require('./DATABASE/connect-data-base.php');

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

$requete_con = mysqli_query($conn, "SELECT * FROM `utilisateurs` WHERE `login` = '$newlog'");
$requete_confetch = mysqli_fetch_all($requete_con, MYSQLI_ASSOC);


  
    if(isset($_POST['validerlog']))
    {
        
        if(!empty($_POST['login'])){

            if(count($requete_confetch) == 0){
                $newlog = $_POST['login'];

                $update = "UPDATE `utilisateurs` SET `login`= '$newlog' WHERE `id` = '$id'";
                $update_new = mysqli_query($conn, $update);
    
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
    <title>Profil</title>
</head>
<body class="profilBody">
<?php require('header.php') ?>
    <main class="mainForm">
    
        <h2 class="sous-titre">Profil de <?php echo $recuper[0] ?> </h2>
        <form action="profil.php" method="post" class="form">
                <div class="formSection">
                    <label for="login">Nouveau login:</label><br>
                    <input type="login" name="login" class="formText" placeholder="Login"  value ="<?php echo $recuper[0]; ?>" autocomplete="off">
                </div>
                <div class="formSection">
                    <label for="login">Nouveau password:</label><br>
                    <input type="password" name="password" class="formText" placeholder="Mot de passe"   autocomplete="off">
                </div>
                <div class="formSection">
                    <button type="submit" name= "validerlog" class="formButton">Valider</button>
                </div>
        </form>
        
    </main>
</body>
</html>