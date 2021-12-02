<?php
session_start();

require('./DATABASE/connect-data-base.php');

$sessLogin = $_SESSION['user'];
$sessPasswrd = $_SESSION['userPass'];


$password =  $_POST['password'];

$newlog = $_POST['login'];
$hashed_pwrd = password_hash($password, PASSWORD_DEFAULT);
$newpassWrd = $hashed_pwrd;
// echo '<pre>';
// var_dump("first login ".$login);
// echo '</pre>';


// $query = mysqli_query($bdd,"SELECT * FROM `utilisateurs` WHERE `login`= '$sessLogin'");
// $result = mysqli_fetch_assoc($query);

$query = $pdo->prepare("SELECT * FROM `utilisateurs` WHERE `login`= '$sessLogin'");
$query->setFetchMode(PDO::FETCH_ASSOC);
$query->execute();
$result=$query->fetchall();

// $requete_con = mysqli_query($bdd, "SELECT * FROM `utilisateurs` WHERE `login` = '$login'");
// $requete_confetch = mysqli_fetch_all($requete_con, MYSQLI_ASSOC);

$requete_con = $pdo->prepare("SELECT * FROM `utilisateurs` WHERE `login` = '$login'");
$requete_con->setFetchMode(PDO::FETCH_ASSOC);
$requete_con->execute();
$requete_confetch=$requete_con->fetchall();


    if(count($requete_confetch) == 0)
    {
        

        if(isset($_POST['validerlog']))
        {
            
            $result = $_POST['login'];
            $newlog = $_POST['login'];

            // $update = "UPDATE `utilisateurs` SET `login`='$login' WHERE `login` = '$sessLogin'";
            // $update_new = mysqli_query($bdd, $update);
            
            $update = $pdo->prepare("UPDATE `utilisateurs` SET `login`='$newlog' WHERE `login` = '$sessLogin'");
            $update->setFetchMode(PDO::FETCH_ASSOC);
            $update->execute();
            $update_new=$update->fetchall();

            session_destroy();
            header('Location: connexion.php');
           
        }
            

        elseif(isset($_POST['validerpass']))
        {
            
            $password = $result['password'];
            
            // $update2 = "UPDATE `utilisateurs` SET `password`='$newpassWrd' WHERE `login` = '$sessLogin'";
            // $update_new2 = mysqli_query($bdd, $update2);


            $update2 = $pdo->prepare("UPDATE `utilisateurs` SET `password`='$newpassWrd' WHERE `login` = '$sessLogin'");
            $update2->setFetchMode(PDO::FETCH_ASSOC);
            $update2->execute();
            $update_new2=$update2->fetchall();
            

            session_destroy();
            header('Location:connexion.php');
        }
            
} elseif(count($requete_confetch) != 0){
    echo "login alredy used";
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
<body class="profilBody">
    <main>
    <section class= formulaire>
        <h2 class="sous-titre">Profil de <?php echo $sessLogin ?> </h2>
        <form action="profil.php" method="post" class="form">
                <div class="form-group">
                    <label for="login">Nouveau login:</label><br>
                    <input type="login" name="login" class="form-control" placeholder="Login"  value ="<?php echo $sessLogin ?>" autocomplete="off">
                </div>
                <div class="form-group">
                    <button type="submit" name= "validerlog" class="btn btn-primary btn-block">Valider</button>
                </div>  
                <div class="form-group">
                    <label for="login">Nouveau password:</label><br>
                    <input type="password" name="password" class="form-control2" placeholder="Mot de passe"   autocomplete="off">
                </div>
                <div class="form-group">
                    <label for="login">Confirmer le password:</label><br>
                    <input type="passwordconfirm" name="passwordconfirm" class="form-control" placeholder="Confimer le nouveau mot de passe"   autocomplete="off">
                </div>
                <div class="form-group">
                    <button type="submit" name= "validerpass" class="btn">Valider</button>
                </div>   
        </form>
        </section>
    </main>
</body>
</html>