<?php

session_start();

 require_once 'config.php';

$company_name = $_POST['company_name'];
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$address = $_POST['address'];

$query = "insert into supplier(company_name,fname,lname,age,sex,address) values('$company_name','$fname','$lname',$age,$sex,'$address');";

mysqli_query($mysql, $query)
        or die(mysqli_error($mysql));

echo "Supplier Added";