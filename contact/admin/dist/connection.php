<?php
    require_once $_SERVER['DOCUMENT_ROOT'] . '/.env.php';
    $host = DB_SERVER;
    $user = DB_USERNAME;
    $password = DB_PASSWORD;
    $db_name = DB_NAME;

    $con = mysqli_connect($host, $user, $password, $db_name);
    if(mysqli_connect_errno()) {
        die("Failed to connect with MySQL: ". mysqli_connect_error());
    }
?>
