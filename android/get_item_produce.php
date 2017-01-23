<?php

require_once 'config.php';

$id = filter_input(INPUT_GET, "id");
$description = "";
$supplier = "";
$unit = "";
$price = "";


$produce_q = $mysql->query("select item.description,item.dimensions,item.price,supplier.company_name,item.unit from item left join supplier on item.supplier_id = supplier.id where item.id = $id");

if ($produce_q->num_rows > 0) {
    while ($row = $produce_q->fetch_assoc()) {
        $supplier = $row['company_name'];
        $unit = $row['unit'];
        $price = $row['price'];
        $description = $row['description'] . " " . $row['dimensions'];
    }
}

$produce_list =  array("supplier"=>$supplier,"unit"=>$unit,"price"=>$price,"description"=>$description);
    

echo json_encode($produce_list);

