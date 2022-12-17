<?php 
    ob_start();
    session_start();
    require "connect_db.php";
    global $con;
    $stmt=$con->prepare ("UPDATE admins SET `state`=0 WHERE `id`=?");
    $stmt->execute(array($_SESSION['id']));
    session_unset(); 
    session_destroy();
    header("location:index.php");
    exit(); 
    ob_end_flush();