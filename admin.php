<?php
session_start();
require('./DATABASE/database-sqli.php');
if (isset($_SESSION['admin'])) {
  $req = "SELECT * FROM utilisateurs";
  $query = mysqli_query($conn, $req);
  $result = mysqli_fetch_all($query, MYSQLI_ASSOC);
}
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
          <th>id</th>
          <th>login</th>
          <th>password</th>
          <th>email</th>
          <th>id_droits</th>
          <th></th>
          <th></th>
          <th>
          <?php
            if (isset($_SESSION['admin'])) {
                echo '<a class="ba bi-plus-circle  h4 link-warning" href="add.php"></a>';
            } ?></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($result as $st) {  ?>
          <tr>
            <td> <?= $st['id'];; ?> </td>
            <td> <?= $st['login']; ?> </td>
            <td> <?= $st['password']; ?> </td>
            <td> <?= $st['email']; ?> </td>
            <td> <?= $st['id_droits']; ?> </td>
            <td> <?php echo '<a class="bi bi-eye h4" href="view.php?id=' . $st['id'] . '"></a>'; ?></td>
            <td> <?php echo '<a  class="bi bi-arrow-up-circle h4 link-success" href="update.php?id=' . $st['id'] . '"></a>'; ?></td>
            <td> <?php echo '<a  class="bi bi-trash h4 link-danger" href="delete.php?id=' . $st['id'] . '"></a>'; ?></td>
          </tr>
        <?php }; ?>
      </tbody>
      </tbody>
    </table>


  </main>
</body>

</html>