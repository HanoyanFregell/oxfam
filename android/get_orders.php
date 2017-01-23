<?php

require_once 'config.php';

$order_list = [];
$user_id = filter_input(INPUT_GET, "user_id");
$id = "";
$status = "";
$items = "";


$order_q = $mysql->query("select id,status from orders where customer_id = $user_id");

if ($order_q->num_rows > 0) {
    while ($row = $order_q->fetch_assoc()) {
        $id = $row['id'];
        $status = $row['status'];
        
        $item_q = $mysql->query("select item.name,item.price,supplier.company_name,order_items.quantity from order_items left join item on item.id = order_items.item_id left join supplier on supplier.id = item.supplier_id where order_items.order_id = $id");

        if ($item_q->num_rows > 0) {
            while ($row = $item_q->fetch_assoc()) {
                $items .= "Name: ".$row['name']." Supplier: ".$row['company_name']." Price: ".$row['price']." Quantity: ".$row['quantity']." - "; 
            }
        }

        array_push($order_list, array("id" => $id, "status" => $status, "items" => $items));
    }
}

echo json_encode($order_list);
