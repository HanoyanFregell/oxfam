<?php

session_start();

 require_once 'config.php';
 
$supplier_id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$desc = $_POST['desc'];
$dimension = $_POST['dimension'];
$unit = $_POST['unit'];


$query = "insert into item(supplier_id,name,price,description,dimensions,unit) values($supplier_id,'$name',$price,'$desc','$dimension','$unit');";

mysqli_query($mysql, $query)
        or die(mysqli_error($mysql));


echo "Added Produce";
