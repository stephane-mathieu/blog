<?php


function recup(){
    require('./DATABASE/database-sqli.php');
    $sql = mysqli_query($conn, "SELECT * FROM categories");
    $row2 = mysqli_fetch_all($sql, MYSQLI_ASSOC);

    
    foreach ($row2 as  $value) {
        echo "<option value=".$value["id"]." name=".$value["nom"]." >" .$value["nom"]. "</option>";
        echo $value['id'];
    }
    return $value;
    var_dump($value);
}

recup();

?>

