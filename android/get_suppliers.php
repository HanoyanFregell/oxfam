<?php


$mysql = new mysqli("localhost", "root", "", "oxfam");

$supplier_list = [];
$id= "";
$company_name = "";
$name = "";



$supplier_q = $mysql->query("select * from supplier");

if ($supplier_q->num_rows > 0) {
    while ($row = $supplier_q->fetch_assoc()) {
        $id = $row['id'];
        $company_name = $row['company_name'];
        $name = $row['fname']. " " .$row['lname'];
        array_push($supplier_list,  array("id"=>$id,"name"=>$name,"company_name"=>$company_name));
    }
}

echo json_encode($supplier_list);
