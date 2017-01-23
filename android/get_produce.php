<?php


require_once 'config.php';

$produce_list = [];
$id= "";
$produce = "";
$supplier = "";
$unit = "";
$price = "";


$produce_q = $mysql->query("select item.id,item.name,item.price,supplier.company_name,item.unit from item left join supplier on item.supplier_id = supplier.id");

if ($produce_q->num_rows > 0) {
    while ($row = $produce_q->fetch_assoc()) {
        $id = $row['id'];
        $produce = $row['name'];
        $supplier = $row['company_name'];
        $unit = $row['unit'];
        $price = $row['price'];
        array_push($produce_list,  array("id"=>$id,"produce"=>$produce,"supplier"=>$supplier,"unit"=>$unit,"price"=>$price));
    }
}

echo json_encode($produce_list);
