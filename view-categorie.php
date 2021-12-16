<?php
 require('./DATABASE/database-sqli.php');
$test = $_GET['id'];
$req = "SELECT * FROM categories WHERE id = '$test'";
$query = mysqli_query($conn, $req);
$result = mysqli_fetch_all($query,MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Categorie</title>
</head>
<body>
<?php require('header.php') ?>
<main>
  <table class="table table-success table-striped">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">nom</th>
    </tr>
  </thead>
  <tbody>

  <?php foreach ($result as $st) {  ?>
                    <tr>
                        <td> <?= $st['id']; ;?> </td>
                        <td> <?= $st['nom']; ?> </td>
                    </tr>
                <?php }; ?>
        </tbody>
  
</table>


</main>

</body>
</html>