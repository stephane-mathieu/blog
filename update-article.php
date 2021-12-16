 
<?php
// session_start();
require('./DATABASE/database-sqli.php');
session_start();



$test = $_GET['id'];

$oi = $_POST['categorie'];
$article = $_POST['article'];
$new_date = $_POST['date-time'];

$loginnn = $_SESSION['user'];
$DateAndTime = date('Y-m-d h:i:s', time());




$sql_categori = mysqli_query($conn, "SELECT * FROM `categories` WHERE `nom` = '$oi'");
$result1 = mysqli_fetch_all($sql_categori, MYSQLI_ASSOC);
$id_categorie = $result1[0]['id'];


// Select * from Utlisateur
$query = mysqli_query($conn,"SELECT * FROM `articles` WHERE `id`= '$test'");
$result = mysqli_fetch_all($query,MYSQLI_ASSOC);

$id_user = $result[0]['id_utilisateur'];


$queryCategories = mysqli_query($conn, "SELECT * FROM `categories`");
$resultCategories = mysqli_fetch_all($queryCategories, MYSQLI_ASSOC);

if(isset($_POST['submit'])){
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
    <title>Article</title>
</head>
<body>
    <main>
        <div class="container col-5 position-absolute top-50 start-50 translate-middle">
            <form  action="" method="POST">
                <textarea  name = "article"></textarea>
                <select name="categorie">
                        <?php foreach ($resultCategories as $categorie) { ?>
                            <option value="<?php echo $categorie['nom']; ?> "><?php echo $categorie['nom']; ?> </option>
                        <?php } ?>
                    
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



 