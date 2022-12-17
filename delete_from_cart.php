<?php 
session_start();
include 'connect_db.php';

if($_POST['from'] == "delete_from_cart"){
    $item_id = $_POST['item_id'];
    $stmt = $con->prepare("DELETE FROM cart WHERE id = :item_id");
    $stmt->bindParam(":item_id" , $item_id);
    $stmt->execute();
    $value =  array('status' => true , 'item_id' => $item_id);
          echo json_encode($value);

}elseif($_POST['from'] == "user_dash"){
    $student_name           = $_POST['student_name'];
    $university             = $_POST['university'];
    $faculty                = $_POST['faculty'];
    $academic_year          = $_POST['academic_year'];
    $birthday               = $_POST['birthday'];
    $gender                 = $_POST['gender'];
    $password               = $_POST['password'];
    $student_id             = $_POST['student_id'];
    if($password == "old pass"){
        $hashed_pass        = $_SESSION["pass"];
    }else{
        $hashed_pass        = password_hash($password,PASSWORD_DEFAULT);
    }

    $_SESSION["student_name"]       = $student_name;
    $_SESSION["university"]         = $university;
    $_SESSION["faculty"]            = $faculty;
    $_SESSION["academic_year"]      = $academic_year;
    $_SESSION["gender"]             = $gender;
    $_SESSION["pass"]               = $hashed_pass;

    $stmt= $con->prepare ("UPDATE students SET `student_name`=?,`university`=?,`faculty`=?,`birthday`=?,`academic_year`=?,`gender`=?,`pass`=? WHERE `id`=?");
    $stmt ->execute(array($student_name,$university,$faculty,$birthday,$academic_year,$gender,$hashed_pass,$student_id));
    
    $value =  array('status' => true);
          echo json_encode($value);

}