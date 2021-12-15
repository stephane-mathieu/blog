<?php
    session_start();
    require('./DATABASE/database-sqli.php');
    if(isset($_SESSION['admin'])){
        $req = "SELECT * FROM utilisateurs";
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
      <th scope="col">login</th>
      <th scope="col">password</th>
      <th scope="col">email</th>
      <th scope="col">id_droits</th>
    </tr>
  </thead>
  <tbody>
    <?php
      if(isset($_SESSION['admin'])){
    echo'<a href="add.php">ajouter un user</a>';
      }?>
  <?php foreach ($result as $st) {  ?>
                    <tr>
                        <td> <?= $st['id']; ;?> </td>
                        <td> <?= $st['login']; ?> </td>
                        <td> <?= $st['password']; ?> </td>
                        <td> <?= $st['email']; ?> </td>
                        <td> <?= $st['id_droits']; ?> </td>
                        <td> <?php echo '<a href="view.php?id='.$st['id'] . '">view</a>';?></td>
                        <td> <?php echo '<a href="update.php?id='.$st['id'] . '">update</a>';?></td>
                        <td> <?php echo '<a href="delete.php?id='.$st['id'] . '">delete</a>';?></td>
                    </tr>
                <?php }; ?>
        </tbody>
  </tbody>
</table>


</main>

</body>
</html>