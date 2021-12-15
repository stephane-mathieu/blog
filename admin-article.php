<?php
    
    require('./DATABASE/database-sqli.php');

    if(isset($_SESSION['admin'])){
        $req = "SELECT * FROM articles";
        $query = mysqli_query($conn, $req);
        $result = mysqli_fetch_all($query,MYSQLI_ASSOC);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Document</title>
</head>
<body>
<?php require('header.php') ?>
<main>
  <table class="table table-success table-striped">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Article</th>
      <th scope="col">id_utilisateur</th>
      <th scope="col">id_categorie</th>
      <th scope="col">date</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $st) {  ?>
                    <tr>
                        <td> <?= $st['id']; ;?> </td>
                        <td> <?= $st['article']; ?> </td>
                        <td> <?= $st['id_utilisateur']; ?> </td>
                        <td> <?= $st['id_categorie']; ?> </td>
                        <td> <?= $st['date']; ?> </td>
                        <td> <?php echo '<a href="view-article.php?id='.$st['id'] . '">view</a>';?></td>
                        <td> <?php echo '<a href="update-article.php?id='.$st['id'] . '">update</a>';?></td>
                        <td> <?php echo '<a href="delete-article.php?id='.$st['id'] . '">delete</a>';?></td>
                    </tr>
                <?php }; ?>
        </tbody>
  </tbody>
</table>


</main>

</body>
</html>