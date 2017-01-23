<?php

session_start();

 require_once 'config.php';

$max = $_POST['max'];
$limit = $_POST['limit'];
$name = "";
$address = "";
$status = "";
$order_id = 0;

$orders = '';

$more_order_list_q = $mysql->query("select orders.id,customer.fname , customer.lname,customer.address, orders.status from customer left join orders on orders.customer_id = customer.id where orders.status = 0 limit $limit;");
if ($more_order_list_q->num_rows > 0) {
    $count = 0;
    while ($row = $more_order_list_q->fetch_assoc()) {
        $count++;
        if ($count >= $max) {
            $order_id = $row['id'];
            $name = $row['fname'] . " " . $row['lname'];
            $address = $row['address'];

            if ($row['status'] == 0) {
                $status = "Not Processed";
            } else if ($row['status'] == 1) {
                $status = "In Transit";
            } else if ($row['status'] == 2) {
                $status = "Delivered";
            } else if ($row['status'] == 3) {
                $status = "Return";
            }

            $orders .= '<a href="#"  style="display: none;" class="list-group-item order-list-item"  data-id="' .$order_id. '" data-toggle="modal" data-target="#process_order_modal">' .
                    '<div class="row" >' .
                    '<div class="col-sm-2 profile-picture-wrapper" >' .
                    '<img class="profile-picture center-block" src="resources/Oxfam_Circle_Green-min.png" id="symbol" />' .
                    '</div>' .
                    '<div class="col-sm-3" >' .
                    '<div class="row" >' .
                    '<div class="col-sm-12 name">' . $name . '</div>' .
                    '</div>' .
                    '<div class="row" >' .
                    '<div class="col-sm-12 description" >' . $address . '</div>' .
                    '</div>' .
                    '</div>' .
                    '<div class="col-sm-4 orders" >';


            $order_items_q = $mysql->query("select item.name, item.unit, order_items.quantity from item left join order_items on order_items.item_id = item.id where order_items.order_id = $order_id;");
            if ($order_items_q->num_rows > 0) {
                $item_name = "";
                $item_quantity = "";
                while ($row = $order_items_q->fetch_assoc()) {
                    $item_name = $row['name'];
                    $item_quantity = $row['quantity'] . " " . $row['unit'];
                    if ($row['quantity'] >= 2) {
                        $item_quantity = $item_quantity . "es";
                    }
                    $orders .= '<div class="row text-center">' .
                            '<div class="col-sm-6"> ' . $item_name . '></div>' .
                            '<div class="col-sm-4"> ' . $item_quantity . '></div>' .
                            '</div>';
                }
            }
            $orders .= '</div>' .
                    '<div class="col-sm-3 text-center status">' . $status . '</div>' .
                    '</div>' .
                    '</a>';
        }
    }
}

echo json_encode($orders);

