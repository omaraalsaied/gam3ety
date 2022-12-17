<?php 
    ob_start();
    session_start();
    require "init.php";
    global $con;
    /* update login state to ofline*/
    $stmt9   = $con->prepare ("UPDATE students SET `status`=0 WHERE `id`=?");
    $stmt9->execute(array($_SESSION['id']));

    /* delete the token from cookies*/
    $stmt2 = $con->prepare("DELETE FROM session_token WHERE student_id = :student_id");
    $stmt2->execute(array(":student_id" => $_SESSION['id']));

    /* delete the cookies*/
    setcookie("_token", $student_token, time() - (86400 * 10), "/");
    session_unset(); 
    session_destroy();
    header("location:index.php");
    exit(); 
    ob_end_flush();