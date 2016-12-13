<?php
$mysql = new mysqli("localhost", "root", "", "oxfam");

$user_id = filter_input(INPUT_GET, "user_id");


$query = "insert into orders(customer_id) values($user_id);";


mysqli_query($mysql, $query)
        or die(mysqli_error($mysql));
$last_id = mysqli_insert_id($mysql);

echo $last_id;

