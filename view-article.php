<?php
    session_start();
    require('./DATABASE/database-sqli.php');
    $test = $_GET['id'];
    if(isset($_SESSION['admin'])){
        $req = "SELECT * FROM articles WHERE id = '$test'";
        $query = mysqli_query($conn, $req);
        $result = mysqli_fetch_all($query,MYSQLI_ASSOC);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
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
                    </tr>
                <?php }; ?>
        </tbody>
  </tbody>
</table>


</main>

</body>
</html>