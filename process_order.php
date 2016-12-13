<?php

session_start();

$mysql = new mysqli("localhost", "root", "", "oxfam");

$id = $_POST['id'];

$query = "update orders set status = 1 where id = $id";

mysqli_query($mysql, $query)
        or die(mysqli_error($mysql));


echo "Order Processed";
