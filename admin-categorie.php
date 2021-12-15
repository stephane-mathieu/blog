<?php
 require('./DATABASE/database-sqli.php');
$req = "SELECT * FROM categories";
$query = mysqli_query($conn, $req);
$result = mysqli_fetch_all($query,MYSQLI_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="./Style/admin.css" rel="stylesheet">
    <link href="./Style/connexion.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Document</title>
</head>
<body>
  <header>
    <?php include('header.php'); ?>
  </header>
<main>
  <table class="table table-success table-striped">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">nom</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th>  <?php
            if (isset($_SESSION['admin'])) {
                echo '<a class="ba bi-plus-circle  h4 link-warning" href="add-categorie.php"></a>';
            } ?></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $st) {  ?>
                    <tr>
                        <td> <?= $st['id']; ;?> </td>
                        <td> <?= $st['nom']; ?> </td>
                        <td> <?php echo '<a class="bi bi-eye h5" href="view-categorie.php?id='.$st['id'] . '"></a>';?></td>
                        <td> <?php echo '<a class="bi bi-arrow-up-circle h5 link-success" href="update-categorie.php?id='.$st['id'] . '"></a>';?></td>
                        <td> <?php echo '<a class="bi bi-trash h5 link-danger" href="delete-categorie.php?id='.$st['id'] . '"></a>';?></td>
                    </tr>
                <?php }; ?>
        </tbody>
  </tbody>
</table>


</main>

</body>
</html>