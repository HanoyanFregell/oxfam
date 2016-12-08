<?php

session_start();

$mysql = new mysqli("localhost", "root", "", "oxfam");

$max = $_POST['max'];

$check_order_list_q = $mysql->query("select * from supplier");
if ($check_order_list_q->num_rows > $max) {
    echo 1;
}else{
    echo 0;
}

 