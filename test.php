<?php
$mysql = new mysqli("womensmarket.biz", "womensma_root", "042895Ced!", "womensma_store");

if (!$mysql) {
    die('Could not connect: ' . mysql_error());
}else{
    echo 'Connected successfully';
}



