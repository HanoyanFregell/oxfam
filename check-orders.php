<?php
session_start();

$mysql = new mysqli("localhost", "root", "", "oxfam");

$max = $_POST['max'];

$check_order_list_q = $mysql->query("select orders.id,customer.fname , customer.lname,customer.address, orders.status from customer left join orders on orders.customer_id = customer.id where orders.status = 0;");
if ($check_order_list_q->num_rows > $max) {
    echo 1;
}else{
    echo 0;
}

 