
  
<?php
// session_start();
require('./DATABASE/database-sqli.php');
// session_start();



$test = $_GET['id'];
$login = $_POST['login'];
$password = $_POST['password'];

$hashed_pwrd = password_hash($password, PASSWORD_DEFAULT);
$newpassWrd = $hashed_pwrd;


$query = mysqli_query($conn,"SELECT * FROM `utilisateurs` WHERE `id`= '$test'");
$result = mysqli_fetch_assoc($query);


$requete_con = mysqli_query($conn, "SELECT * FROM `utilisateurs` WHERE `login` = '$login'");
$requete_confetch = mysqli_fetch_all($requete_con, MYSQLI_ASSOC);




      if(isset($_POST['validerdroits'])){
        if ($_POST["droits"] == 'utilisateur') {
            $droits = 1;
        }
        else if ($_POST["droits"] == 'moderateur') {
            $droits = 42;
        }
        else if ($_POST["droits"] == 'administrateur') {
            $droits = 1337;
        }

        $updatedr = "UPDATE `utilisateurs` SET `id_droits`='$droits' WHERE `id` = '$test'";
        $update_newdr = mysqli_query($conn, $updatedr);
        header('location: admin.php');
      }

        if(isset($_POST['validerlog']))
        {

       
            if(count($requete_confetch) == 0)
             {
            
                    $result = $_POST['login'];
                    $newlog = $_POST['login'];

                    $update = "UPDATE `utilisateurs` SET `login`='$login' WHERE `id` = '$test'";
                    $update_new = mysqli_query($conn, $update);
                    header('location: admin.php');

            } elseif(count($requete_confetch) != 0){
                echo "login alredy used";
            }
        }
            

        if(isset($_POST['validerpass']))
        {
            
            
            $password = $result['password'];
            
            $update2 = "UPDATE `utilisateurs` SET `password`='$newpassWrd' WHERE `id` = '$test'";
            $update_new2 = mysqli_query($conn, $update2);
            header('location: admin.php');

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
    <title>Profil</title>
</head>
<body class="profilBody">
<?php require('header.php') ?>
    <main class="mainForm">
    

        <h2 class="sous-titre">Profil de <?php echo $result['login'] ?> </h2>
        <form action="" method="post" class="form">
                <div class="formSection">
                    <label for="login">Nouveau login:</label><br>
                    <input type="text" name="login" class="formText" placeholder="Login"  value ="<?php echo $result['login'] ?>" autocomplete="off">
                </div>
                <div class="formSection">
                    <button type="submit" name= "validerlog" class="formButton">Valider</button>
                </div>  
                <div class="formSection">
                    <label for="login">Nouveau password:</label><br>
                    <input type="password" name="password" class="formText" placeholder="Mot de passe"   autocomplete="off">
                </div>
                <div class="formSection">
                    <button type="submit" name= "validerpass" class="formButton">Valider</button>
                </div>
                <select name="droits" id="droits">
                    <option value="utilisateur">utilisateur</option>
                    <option value="moderateur">modérateur</option>
                    <option value="administrateur">administrateur</option>
                </select>
                <div class="formSection">
                    <button type="submit" name= "validerdroits" class="formButton">Valider</button>
                </div>
                
        </form>
        
        
    </main>
</body>
</html>