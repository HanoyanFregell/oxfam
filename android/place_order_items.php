<?php
require_once 'config.php';

$order_id = filter_input(INPUT_GET, "order_id");
$item_id = filter_input(INPUT_GET, "item_id");
$quantity = filter_input(INPUT_GET, "quantity");


$query = "insert into order_items(order_id,item_id,quantity) values($order_id,$item_id,$quantity);";


mysqli_query($mysql, $query)
        or die(mysqli_error($mysql));

