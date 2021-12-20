<?php

// $user = 'root'; 
// $pass = '';
$user = 'root'; 
$pass = 'root';

try{
    $pdo = new PDO('mysql:host=localhost;dbname=blog',$user,$pass);

}
catch(PDOException $e){
    echo "Erreur :" . $e->getMessage(). "<br>";
    die();
}


?>