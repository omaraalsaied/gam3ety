<?php 

include 'connect_db.php';

if($_POST['from'] == "all_students"){
    $student_id = $_POST['id'];
    global $con;
    $stmt= $con->prepare ("UPDATE students SET `blocked`=1 WHERE `id`=?");
    $stmt ->execute(array($student_id));
        $value =  array('status' => true , 'std_id' => $student_id);
        echo json_encode($value);


}elseif($_POST['from'] == "all_students_unblock"){
    $student_id = $_POST['id'];
    global $con;
    $stmt= $con->prepare ("UPDATE students SET `blocked`=0 WHERE `id`=?");
    $stmt ->execute(array($student_id));
        $value =  array('status' => true , 'std_id' => $student_id);
        echo json_encode($value);


}