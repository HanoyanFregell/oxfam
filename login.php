<?php

session_start();

$mysql = new mysqli("localhost", "root", "", "oxfam");

$login = filter_input(INPUT_POST, 'login');
if (isset($login)) {
    $user = filter_input(INPUT_POST, 'uname');
    $pass = filter_input(INPUT_POST, 'pword');

    $q = "select * from user where user='$user'";

    //search for the username
    if ($result = $mysql->query($q)) {
        $error = 0;
        //Check if username exists
        if ($result->num_rows === 0) {
            $error = 1;
            header("Location: index.php?error=$error");
        } else {
            //get id and password from database
            while ($row = $result->fetch_assoc()) {
                $db_id = $row['id'];
                $db_pass = $row['pass'];
            }
            if ($pass == $db_pass) {
                echo $db_id;
                $_SESSION['id'] = $db_id;
                header('Location: home.php');
            } else {
                $error = 2;
                header("Location: index.php?error=$error");
            }
        }
    }
}

    $mysql->close();
