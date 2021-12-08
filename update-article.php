
  
<?php
// session_start();
require('./DATABASE/database-sqli.php');
session_start();



$test = $_GET['id'];

$DateAndTime = date('Y-m-d h:i:s', time());
$article = $_POST['article'];
$new_date =$_POST['date-time'];



$query = mysqli_query($conn,"SELECT * FROM `articles` WHERE `id`= '$test'");
$result = mysqli_fetch_all($query,MYSQLI_ASSOC);

$id_user = $result[0]['id_utilisateur'];

if(isset($_POST['submit'])){
    if ($_POST["categories"] == 1) {
        $id_categorie = 1;
    }
    else if ($_POST["categories"] == 2) {
        $id_categorie = 2;
    }
    else if ($_POST["categories"] == 3) {
        $id_categorie = 3;
    }

    $querup = mysqli_query($conn,"UPDATE `articles` SET `article` = '$article', `id_utilisateur` = '$id_user', `id_categorie` = '$id_categorie', `date` = '$new_date' WHERE id = '$test'");
    header('location: admin-article.php');
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
                <textarea  name="article"></textarea>
                <select name="categories">
                    <option value="1">Italie</option>
                    <option value="2">Vietnam</option>
                    <option value="3">Russie</option>
                </select>
                <input type="datetime-local" id="meeting-time"
                        name="date-time" value="<?php $DateAndTime ?>"
                        min="<?php $DateAndTime ?>" max="2030-01-14T00:00">
                <button class="btn btn-primary"  name = "submit" type="submit">Valider</button>
            </form>
        <div>
    </main>
</body>
</html>


