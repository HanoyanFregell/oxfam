<?php

$mysql = new mysqli("localhost", "root", "", "oxfam");

 
$email = filter_input(INPUT_GET, "email");
$pass = filter_input(INPUT_GET, "password");
$fname = filter_input(INPUT_GET, "fname");
$lname = filter_input(INPUT_GET, "lname");
$age = filter_input(INPUT_GET, "age");
$sex_text = filter_input(INPUT_GET, "sex");
$sex = 0;
$user_id = 0;

if ($sex_text == "Male") {
    $sex = 1;
} else {
    $sex = 2;
}

$customer_q = $mysql->query("select user from user where user = '$email'");

if ($customer_q->num_rows == 0) {
    $user_query = "insert into user(user,pass) values('$email','$pass');";
    mysqli_query($mysql, $user_query)
            or die(mysqli_error($mysql));
    
    $user_id = mysqli_insert_id($mysql);
   
   $customer_query = "insert into customer(user_id, email,fname,lname,age,sex,address) values($user_id,'$email','$fname','$lname',$age,$sex,'');";

   mysqli_query($mysql, $customer_query)
            or die(mysqli_error($mysql));

    echo  "0";
} else {
    echo "1";
}




