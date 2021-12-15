<?php
require('./DATABASE/connect-data-base.php');
    if(!empty($_POST) && !empty($_POST['login']) && !empty($_POST['password'])){

        $login = $_POST['login'];
        $password = $_POST['password'];
        $errors = array();

        // Requete
        // $query = mysqli_query($bdd, "SELECT * FROM `utilisateurs` WHERE `login` = '$login'");
        // $user = mysqli_fetch_all($query, MYSQLI_ASSOC);

        $query = $pdo->prepare("SELECT * FROM `utilisateurs` WHERE `login` = '$login'");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query->execute();
        $user=$query->fetchall();
      
        if(password_verify($password, $user['0']['password'])){
            if($user[0]['id_droits'] == 1337){
                session_start();
                $_SESSION['admin'] = $user;
                $_SESSION['user'] = $user['0']['login'];
                $_SESSION['userPass'] = $user['0']['password'];
                $_SESSION['userId'] = $user['0']['id'];
                $_SESSION['flash']['error'] = "You are logged now. ";
                header('Location: index.php');
            }else{
                session_start();
                $_SESSION['user'] = $user['0']['login'];
                $_SESSION['userPass'] = $user['0']['password'];
                $_SESSION['userId'] = $user['0']['id'];
                $_SESSION['flash']['error'] = "You are logged now. ";
                header('location: index.php');
            }
        
        }
        else {
                $errors['connect'] = "Incorrect login or password";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">
    <link href="./style/styles.css" rel="stylesheet">
    <link href="./Style/connexion.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
   <header>
       <?php include('header.php');?>
   </header>
    <main class="main">

        <!-- Parcoure les potentielles erreurs -->
    <?php if(!empty($errors)): ?>
            <div class="errors">
                <p>You have not completed the form correctly.</p>
                </ul>
                    <?php foreach($errors as $error): ?>
                        <li><?= $error; ?></li>

                    <?php endforeach; ?>
                </ul>
            </div>
    <?php endif; ?>
    <div class="container">
        <div class="row gx-0">
            <div class="col-md-7">
                <div class="card border-0">
                    <form class="box"action="" method="POST" class="form">

                            <h1 class="formTittle">Login</h1>
                            <p class="text-muted"> Please enter your login and password!</p>

                                <label for="login"></label>
                                <input type="text" name="login" placeholder="Your login" class="formText">
                                <label for="password"></label>
                                <input type="password" name="password" placeholder="Your password" class="formText">
                                <input type="submit" name="" value="Login" href="#">
                     </form>
                </div>
            </div>

        </div>

    </div>
    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>