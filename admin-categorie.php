<?php
 require('./DATABASE/database-sqli.php');
$req = "SELECT * FROM categories";
$query = mysqli_query($conn, $req);
$result = mysqli_fetch_all($query,MYSQLI_ASSOC);

var_dump($result);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Document</title>
</head>
<body>
<main>
  <table class="table table-success table-striped">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">nom</th>
    </tr>
  </thead>
  <tbody>
  <a href="add-categorie.php">ajouter une categorie</a>
  <?php foreach ($result as $st) {  ?>
                    <tr>
                        <td> <?= $st['id']; ;?> </td>
                        <td> <?= $st['nom']; ?> </td>
                        <td> <?php echo '<a href="view-categorie.php?id='.$st['id'] . '">view</a>';?></td>
                        <td> <?php echo '<a href="update-categorie.php?id='.$st['id'] . '">update</a>';?></td>
                        <td> <?php echo '<a href="delete-categorie.php?id='.$st['id'] . '">delete</a>';?></td>
                    </tr>
                <?php }; ?>
        </tbody>
  </tbody>
</table>


</main>

</body>
</html>