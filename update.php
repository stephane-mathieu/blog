
  
<?php
// session_start();
require('./DATABASE/database-sqli.php');
session_start();



$test = $_GET['id'];
$login = $_POST['login'];
$password = $_POST['password'];

$hashed_pwrd = password_hash($password, PASSWORD_DEFAULT);
$newpassWrd = $hashed_pwrd;
// // echo '<pre>';
// // var_dump("first login ".$login);
// // echo '</pre>';


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
            
            var_dump($result);
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
    <link rel="stylesheet" href="style.css" type="text/css">
    <title>Document</title>
</head>
<body class="profilBody">
    <main>
    <section class= formulaire>

        <h2 class="sous-titre">Profil de <?php echo $result['login'] ?> </h2>
        <form action="" method="post" class="form">
                <div class="form-group">
                    <label for="login">Nouveau login:</label><br>
                    <input type="login" name="login" class="form-control" placeholder="Login"  value ="<?php echo $result['login'] ?>" autocomplete="off">
                </div>
                <div class="form-group">
                    <button type="submit" name= "validerlog" class="btn btn-primary btn-block">Valider</button>
                </div>  
                <div class="form-group">
                    <label for="login">Nouveau password:</label><br>
                    <input type="password" name="password" class="form-control2" placeholder="Mot de passe"   autocomplete="off">
                </div>
                <div class="form-group">
                    <button type="submit" name= "validerpass" class="btn">Valider</button>
                </div>
                <select name="droits" id="droits">
                    <option value="utilisateur">utilisateur</option>
                    <option value="moderateur">modérateur</option>
                    <option value="administrateur">administrateur</option>
                </select>
                <div class="form-group">
                    <button type="submit" name= "validerdroits" class="btn">Valider</button>
                </div>
                
        </form>
        
        </section>
    </main>
</body>
</html>