<?php
    require('./DATABASE/database-sqli.php');
$categorie = $_POST['categorie'];
if(isset($_POST['submit'])){
    $req = "INSERT INTO `categories`(`nom`) VALUES ('$categorie')";
    $query = mysqli_query($conn, $req);
    header('location: admin-categorie.php');
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
</head>
<body>

    <form action="" method="post" class="form">

        <div class="formSection formSection1">
            <label for="categorie"></label>
            <input type="text" name="categorie" placeholder="Your categorie" class="formText">
        </div>
        <div class="formSection formSection4">
            <button type="submit" name="submit" class="formButton">Submit</button>
        </div>
    </form>
    </main>
</body>
</html>





