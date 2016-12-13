<?php
$mysql = new mysqli("localhost", "root", "", "oxfam");

$user_id = filter_input(INPUT_GET, "user_id");
$item_id = filter_input(INPUT_GET, "item_id");


$query = "insert into cart values($user_id,$item_id);";


mysqli_query($mysql, $query)
        or die(mysqli_error($mysql));
$last_id = mysqli_insert_id($mysql);
