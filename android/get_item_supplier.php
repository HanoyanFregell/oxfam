<?php

require_once 'config.php';

$id = filter_input(INPUT_GET, "id");
$company_name = "";
$name = "";
$age = "";
$sex = "";
$address = "";


$produce_q = $mysql->query("select * from supplier where id = $id");

if ($produce_q->num_rows > 0) {
    while ($row = $produce_q->fetch_assoc()) {
        $company_name = $row['company_name'];
        $name = $row['fname']. " ".$row['lname'];
        $ge = $row['age'];
        $sex = $row['sex'];
        $address = $row['address'];
    }
}

$produce_list =  array("company_name"=>$company_name,"name"=>$name,"age"=>$age,"sex"=>$sex,"address"=>$address);
    

echo json_encode($produce_list);

