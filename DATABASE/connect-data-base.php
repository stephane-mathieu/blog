<?php

$user = 'root';
$pass = '';

try{
    $pdo = new PDO('mysql:host=localhost;dbname=blog',"root","");

}
catch(PDOException $e){
    echo "Erreur :" . $e->getMessage(). "<br>";
    die();
}


?>