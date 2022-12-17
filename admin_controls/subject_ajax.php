<?php 

include 'connect_db.php';

if($_POST['from'] == "university"){
    $university_id = $_POST['id'];
        global $con;
        $stmt = $con->prepare("SELECT * FROM faculty WHERE university_id = ?");
        $stmt->execute(array($university_id));
        $rows = $stmt->fetchAll();
    $value =  array('status' => true , 'faculties' => $rows);
          echo json_encode($value);

}elseif($_POST['from'] == "faculty"){
    $faculty_id = $_POST['id'];
    global $con;
    $stmt = $con->prepare("SELECT * FROM academic_years WHERE faculty = ?");
    $stmt->execute(array($faculty_id));
    $rows = $stmt->fetchAll();
$value =  array('status' => true , 'academic_years' => $rows);
      echo json_encode($value);

}elseif($_POST['from'] == "academic_year"){
    $academic_year = $_POST['id'];
    global $con;
    $stmt = $con->prepare("SELECT * FROM subjects WHERE academic_years = ?");
    $stmt->execute(array($academic_year));
    $rows = $stmt->fetchAll();
$value =  array('status' => true , 'subject' => $rows);
      echo json_encode($value);

}elseif($_POST['from'] == "courses"){
    $dep_id = $_POST['id'];
    global $con;
    $stmt = $con->prepare("SELECT * FROM departments WHERE course_id = ?");
    $stmt->execute(array($dep_id));
    $rows = $stmt->fetchAll();
$value =  array('status' => true , 'departments' => $rows);
      echo json_encode($value);

}