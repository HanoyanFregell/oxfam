<?php
$mysql = new mysqli("localhost", "root", "", "oxfam");

$user_id = filter_input(INPUT_GET, "user_id");



$query = "delete from cart where user_id = $user_id";


mysqli_query($mysql, $query)
        or die(mysqli_error($mysql));

