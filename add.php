<?php 
    require('./DATABASE/connect-data-base.php');


    if(isset($_POST['submit']))
    {

        if ($_POST["droits"] == 'utilisateur') {
            $droits = 1;
        }
        else if ($_POST["droits"] == 'moderateur') {
            $droits = 47;
        }
        else if ($_POST["droits"] == 'administrateur') {
            $droits = 1337;
        }
        $user = $_POST['utilisateur'];
        $modo = $_POST['moderateur'];
        $admin = $_POST['administrateur'];
        if(!empty($_POST)){
            // Erreurs possibles
            $errors = array();
            $login = $_POST['login'];
            $password = $_POST['password'];
            $email = $_POST['email'];
        
            if(empty($_POST['login'])){
                $errors['login'] = "Your login is not valid";
            } else {

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

                $password = $pdo->prepare("INSERT INTO `utilisateurs`(`login`,`password`,`email`,`id_droits`) VALUES ('$login','$password','$email',$droits)");
                $password->setFetchMode(PDO::FETCH_ASSOC);
                $password->execute();
                $addUser= $password->fetchall();

                session_start();
                $_SESSION['flash']['sucess'] = "Your account has been create, you can now log in. ";
                header('location:admin.php');
            }
        }
    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Go Magritte || Sign Up</title>
    <link rel="icon" type="image/x-icon" href="./assets/images/favicon.ico">
    <link href="./style/styles.css" rel="stylesheet">
    <link href="./Style/connexion.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body>
    <header>
    <?php include('header.php');?>
    </header>
    <main class="main_form">
    
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

    </form> 
    <div class="container">
        <div class="row gx-0">
            <div class="col-md-7">
                <div class="card border-0">
                    <form class="box"action="" method="POST" class="form">

                            <h1 class="formTittle">Sign Up</h1>
                            <p class="text-muted"> Please enter your login and password!</p>

                                <label for="login"></label>
                                <input type="text" name="login" placeholder="Your login" class="formText">
                                <label for="login"></label>
                                <input type="text" name="email" placeholder="Your email" class="formText">
                                <label for="password"></label>
                                <input type="password" name="password" placeholder="Your password" class="formText">
                                <label for="password"></label>
                                <input type="password" name="password_confirm" placeholder="Confirm your password" class="formText">
                                <select class=" selecto" name="droits" id="droits">
                                    <option value="utilisateur">utilisateur</option>
                                    <option value="moderateur">modérateur</option>
                                    <option value="administrateur">administrateur</option>
                                </select>
                                <input type="submit" name="submit" value="Login" href="#">
                     </form>
                </div>
            </div>

        </div>

    </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>





