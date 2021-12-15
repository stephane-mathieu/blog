<?php
    session_start();
    require('./DATABASE/database-sqli.php');

    $test = $_GET['id'];
     $req = "SELECT * FROM `articles` WHERE id = '$test'";
     $query = mysqli_query($conn, $req);
     $result = mysqli_fetch_all($query,MYSQLI_ASSOC);

     $query = mysqli_query($conn, "SELECT utilisateurs.login, commentaires.commentaire, commentaires.date, commentaires.id_article FROM utilisateurs INNER JOIN commentaires WHERE utilisateurs.id = commentaires.id_utilisateur");
     $resultlog= mysqli_fetch_all($query,MYSQLI_ASSOC);



if(isset($_POST['submit'])){
    $DateAndTime = date('Y-m-d h:i:s', time());
    $idd = $_SESSION['userId'];
    $commm = $_POST['commentaire'];
    $res = mysqli_query($conn, "INSERT INTO commentaires(commentaire,id_article,id_utilisateur,date) VALUES ('$commm','$test','$idd','$DateAndTime')");
    if(isset($res)){
        $query = mysqli_query($conn, "SELECT utilisateurs.login, commentaires.commentaire, commentaires.date, commentaires.id_article FROM utilisateurs INNER JOIN commentaires WHERE utilisateurs.id = commentaires.id_utilisateur");
        $resultlog= mysqli_fetch_all($query,MYSQLI_ASSOC);
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php require 'header.php'?>
<table class="table-article">
     <thead>
         <th>Article</th>
         <th>Commentaire</th>
         <th>login</th>
     </thead>
     <tbody>
         <tr>
             <td><?= $result[0]['article'] ?></td>
             <?php
            foreach($resultlog as $log){
                if($log['id_article'] == $test){
                ?>
                <td><?= $log['commentaire']?></td>
                <td><?= $log['login']?></td>
                <?php
                }
            }
            ?> 

        </tr>
     </tbody>
<?php
?>
<div class="container col-5 position-absolute top-50 start-50 translate-middle">
    <form  class ="row g-3"action="" method="POST">
    <textarea  name="commentaire"></textarea>
    <button class="btn btn-primary"  name = "submit" type="submit">Valider</button>
    </form>
<div>
</body>
</html>