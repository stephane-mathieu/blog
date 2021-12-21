<?php 
    require('./DATABASE/connect-data-base.php');
    require('./DATABASE/database-sqli.php');
    if(!empty($_POST)){
        
        // Erreurs possibles
        $errors = array();
        $login = $_POST['login'];
        $password = $_POST['password'];
        $email = $_POST['email'];
    
        if(empty($_POST['login'])){
            $errors['login'] = "Your login is not valid";
        } else {
            // $loginCheck = mysqli_query($bdd, "SELECT `login` FROM `utilisateurs` WHERE `login` = '$login'");
            // $loginCheckResult = mysqli_fetch_all($loginCheck, MYSQLI_ASSOC);

            $loginCheck = $pdo->prepare("SELECT `login` FROM `utilisateurs` WHERE `login` = '$login'");
            $loginCheck->setFetchMode(PDO::FETCH_ASSOC);
            $loginCheck->execute();
            $loginCheckResult= $loginCheck->fetchall();

            if(count($loginCheckResult) != 0){
            $errors['login'] = "Login not available";
            }
        }

        if(empty($_POST['email'])){
            $errors['email'] = "Your email is not valid";
        } else {
            // $loginCheck = mysqli_query($bdd, "SELECT `login` FROM `utilisateurs` WHERE `login` = '$login'");
            // $loginCheckResult = mysqli_fetch_all($loginCheck, MYSQLI_ASSOC);

            $loginCheck = $pdo->prepare("SELECT `email` FROM `utilisateurs` WHERE `login` = '$login'");
            $loginCheck->setFetchMode(PDO::FETCH_ASSOC);
            $loginCheck->execute();
            $loginCheckResult= $loginCheck->fetchall();

            if(count($loginCheckResult) != 0){
            $errors['email'] = "email not available";
            }
        }

        if(empty($_POST['password'])){
            $errors['password'] = "You must enter a valid password";
        }

        if($_POST['password'] != $_POST['password_confirm']){
            $errors['password_confirm'] = "Your password doesn't match";
        }

        if (empty($errors)){
            $password = password_hash($password, PASSWORD_BCRYPT);
            // $addUser = mysqli_query($bdd, "INSERT INTO `utilisateurs`(`login`,`password`) VALUES ('$login','$password')");

            $password = $pdo->prepare("INSERT INTO `utilisateurs`(`login`,`password`,`email`,`id_droits`) VALUES ('$login','$password','$email',1)");
            $password->setFetchMode(PDO::FETCH_ASSOC);
            $password->execute();
            $addUser= $password->fetchall();

            session_start();
            $_SESSION['flash']['sucess'] = "Your account has been create, you can now log in. ";
            header('location:index.php');
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">
    <link rel="stylesheet" href="./css/style.css">
    <?php include ('meta.php') ?>

</head>
<body>
<?php require('header.php') ?>
    <main class="mainForm">
     
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

    <form action="" method="post" class="form">
        
        <h1 class="formTittle">Sign up</h1>

        <div class="formSection formSection1">
            <label for="login"></label>
            <input type="text" name="login" placeholder="Your login" class="formText">
        </div>
        <div class="formSection formSection1">
            <label for="login"></label>
            <input type="text" name="email" placeholder="Your email" class="formText">
        </div>


        <div class="formSection formSection2">
            <label for="password"></label>
            <input type="password" name="password" placeholder="Your password" class="formText">
        </div>
        
        <div class="formSection  formSection3">
            <label for="password_confirm"></label>
            <input type="password" name="password_confirm" placeholder="Confirm your password" class="formText">
        </div>
        <div class="formSection formSection4">
            <button type="submit" name="submit" class="formButton">Submit</button>
        </div>
    </form>
    </main>
</body>
</html>