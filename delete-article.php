<?php
    require('./DATABASE/database-sqli.php');
    session_start();
    $test = $_GET['id'];
    $req = "DELETE FROM `articles` WHERE id = $test";
    $query = mysqli_query($conn, $req);

    header('location: admin-article.php');


?>