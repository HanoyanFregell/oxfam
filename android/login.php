<?php
session_start();

$mysql = new mysqli("localhost", "root", "", "oxfam");

$id= "";
$name = "";
$status = "";



$user = filter_input(INPUT_GET, "username");
$pass = filter_input(INPUT_GET, "password");

$user_q = $mysql->query("select user from user where user = '$user' and type = 0");

if ($user_q->num_rows > 0) {
    while ($row = $user_q->fetch_assoc()) {
        $pass_q = $mysql->query("select user.id,customer.fname,customer.lname from user left join customer on user.id = customer.user_id where"
                . " user.user = '$user' and user.pass = '$pass'");
        if ($pass_q->num_rows > 0) {
             while ($row = $pass_q->fetch_assoc()) {
                 $id = $row['id'];
                 $name = $row['fname']." ".$row['lname'];
             }
            $status = "3";
        }else{
            $status = "2";
        }
    }
}else{
    $status = "1";
}

$login_details = array(
    "id" => $id,
    "name" => $name,
    "status" => $status
        );
echo json_encode($login_details);

