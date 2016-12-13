<?php

$mysql = new mysqli("localhost", "root", "", "oxfam");

$cart_list = [];
$user_id = filter_input(INPUT_GET, "user_id");
$id = "";
$produce = "";
$supplier = "";
$quantity = "";
$price = "";




$cart_q = $mysql->query("select cart.item_id, item.name,item.price,supplier.company_name from cart left join item on cart.item_id = item.id left join supplier on item.supplier_id = supplier.id where cart.user_id = $user_id");

if ($cart_q->num_rows > 0) {

    while ($row = $cart_q->fetch_assoc()) {
        $duplicate = false;
        $id = $row['item_id'];
        $produce = $row['name'];
        $supplier = $row['company_name'];
        $price = $row['price'];
        
        $item_q = $mysql->query("select count(item_id) as quantity from cart where item_id = $id");

        if ($item_q->num_rows > 0) {
            while ($row = $item_q->fetch_assoc()) {
                $quantity = $row['quantity'];
            }
        }
        
        
        if( count($cart_list) == 0){
             array_push($cart_list, array("id" => $id, "produce" => $produce, "supplier" => $supplier, "quantity" => $quantity, "price" => $price));
        }
        
        for($a=0; $a<count($cart_list);$a++){
            if($cart_list[$a]["id"] == $id){
                $duplicate = true;
            }
        }
        
        if(!$duplicate){
             array_push($cart_list, array("id" => $id, "produce" => $produce, "supplier" => $supplier, "quantity" => $quantity, "price" => $price));
        }
    }
}

echo json_encode($cart_list);
