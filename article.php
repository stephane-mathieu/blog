
<?php
    session_start();
    $bdd = mysqli_connect("localhost","root","","blog");

    $test = $_GET['id'];
     $req = "SELECT * FROM `articles` WHERE id = '$test'";
     $query = mysqli_query($bdd, $req);
     $result = mysqli_fetch_all($query,MYSQLI_ASSOC);


     $querry = mysqli_query($bdd, "SELECT commentaires.id_article,commentaire,articles.article FROM articles INNER JOIN commentaires WHERE commentaires.id_article = articles.id ");
     $result1 = mysqli_fetch_all($querry,MYSQLI_ASSOC);

     $result1[0]['id_article'] = $test;
     $que = mysqli_query($bdd, "SELECT * from commentaires where id_article = '$test'");
     $resu = mysqli_fetch_all($que,MYSQLI_ASSOC);

     $query = mysqli_query($bdd, "SELECT commentaires.id,login,commentaire,date from utilisateurs INNER JOIN commentaires ON utilisateurs.id = commentaires.id_utilisateur");
     $resultlog= mysqli_fetch_all($query,MYSQLI_ASSOC);

    //  var_dump($resultlog);


if(isset($_POST['submit'])){
    $DateAndTime = date('Y-m-d h:i:s', time());
    $idd = $_SESSION['userId'];
    $commm = $_POST['commentaire'];
    $res = mysqli_query($bdd, "INSERT INTO commentaires(commentaire,id_article,id_utilisateur,date) VALUES ('$commm','$test','$idd','$DateAndTime')");
    if(isset($res)){
        $que = mysqli_query($bdd, "SELECT * from commentaires where id_article = '$test'");
        $resu = mysqli_fetch_all($que,MYSQLI_ASSOC);
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

<table class="table-article">
     <thead>
         <th>Article</th>
         <th>Commentaire</th>
     </thead>
     <tbody>
         <tr>
             <td><?= $result[0]['article'] ?></td>
         <?php
     foreach($resu as $article){
                            ?>
                                <td><?= $article['commentaire']?> </td>
                                <?php
                            }
                            ?>
                            </tr>
     </tbody>
<?php
var_dump($artic2);
?>
<div class="container col-5 position-absolute top-50 start-50 translate-middle">
    <form  class ="row g-3"action="" method="POST">
    <textarea  name="commentaire"></textarea>
    <button class="btn btn-primary"  name = "submit" type="submit">Valider</button>
    </form>
<div>
</body>
</html>