<?php
    require('./DATABASE/database-sqli.php');
    
    $test = $_GET['id'];
        $req = "SELECT * FROM utilisateurs where id = '$test'";
        $query = mysqli_query($conn, $req);
        $result = mysqli_fetch_all($query,MYSQLI_ASSOC);

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
  <?php foreach ($result as $st) {  ?>
                    <tr>
                        <td> <?= $st['id']; ;?> </td>
                        <td> <?= $st['login']; ?> </td>
                        <td> <?= $st['password']; ?> </td>
                        <td> <?= $st['email']; ?> </td>
                        <td> <?= $st['id_droits']; ?> </td>
                    </tr>
                <?php }; ?>
        </tbody>
  </tbody>
  </tbody>
</table>


</main>

</body>
</html>