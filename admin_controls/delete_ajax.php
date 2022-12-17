<?php 

include 'connect_db.php';

if($_POST['from'] == "admins"){
    $admin_id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM admins WHERE id = :admin_id");
    $stmt->bindParam(":admin_id" , $admin_id);
    $stmt->execute();
    
    $value =  array('status' => true , 'admin_id' => $admin_id);
          echo json_encode($value);

}elseif($_POST['from'] == "role"){
    $role_id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM roles WHERE id = :role_id");
    $stmt->bindParam(":role_id" , $role_id);
    $stmt->execute();
    
    $value =  array('status' => true , 'role_id' => $role_id);
          echo json_encode($value);

}elseif($_POST['from'] == "payment"){
    $payment_id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM payments WHERE id = :payment_id");
    $stmt->bindParam(":payment_id" , $payment_id);
    $stmt->execute();
    
    $value =  array('status' => true , 'payment_id' => $payment_id);
          echo json_encode($value);

}elseif($_POST['from'] == "messages"){
    $messages_id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM contact WHERE id = :messages_id");
    $stmt->bindParam(":messages_id" , $messages_id);
    $stmt->execute();
    
    $value =  array('status' => true , 'messages_id' => $messages_id);
          echo json_encode($value);

}elseif($_POST['from'] == "university"){
    $university_id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM university WHERE id = :university_id");
    $stmt->bindParam(":university_id" , $university_id);
    $stmt->execute();
    
    $value =  array('status' => true , 'university_id' => $university_id);
          echo json_encode($value);
}elseif($_POST['from'] == "faculty"){
    $faculty_id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM faculty WHERE id = :faculty_id");
    $stmt->bindParam(":faculty_id" , $faculty_id);
    $stmt->execute();
    
    $value =  array('status' => true , 'faculty_id' => $faculty_id);
          echo json_encode($value);
}elseif($_POST['from'] == "academic_year"){
    $academic_year_id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM academic_years WHERE id = :academic_year_id");
    $stmt->bindParam(":academic_year_id" , $academic_year_id);
    $stmt->execute();
    
    $value =  array('status' => true , 'academic_year_id' => $academic_year_id);
          echo json_encode($value);
}elseif($_POST['from'] == "subjects"){
    $subjects_id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM subjects WHERE id = :subjects_id");
    $stmt->bindParam(":subjects_id" , $subjects_id);
    $stmt->execute();
    
    $value =  array('status' => true , 'subjects_id' => $subjects_id);
          echo json_encode($value);
}elseif($_POST['from'] == "course"){
    $course_id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM courses WHERE id = :course_id");
    $stmt->bindParam(":course_id" , $course_id);
    $stmt->execute();
    
    $value =  array('status' => true , 'course_id' => $course_id);
          echo json_encode($value);

}elseif($_POST['from'] == "video"){
    $video_id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM courses_videos WHERE id = :video_id");
    $stmt->bindParam(":video_id" , $video_id);
    $stmt->execute();
    
    $value =  array('status' => true , 'video_id' => $video_id);
          echo json_encode($value);

}elseif($_POST['from'] == "doctors"){
    $doctor_id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM doctors WHERE id = :doctor_id");
    $stmt->bindParam(":doctor_id" , $doctor_id);
    $stmt->execute();
    
    $value =  array('status' => true , 'doctor_id' => $doctor_id);
          echo json_encode($value);

}elseif($_POST['from'] == "delete_student_ips"){
    $student_id = $_POST['id'];
    $stmt = $con->prepare("DELETE FROM student_ips WHERE student_id = :student_id");
    $stmt->bindParam(":student_id" , $student_id);
    $stmt->execute();
    
    $value =  array('status' => true);
          echo json_encode($value);

}elseif($_POST['from'] == "add_pdf_order"){
    $student_id = $_POST['student_id'];
    $lecture_id = $_POST['lecture_id'];
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");

    $stmt4 = $con->prepare("INSERT INTO lecture_pdf_deliver(student_id,video_id,created_at) Value(:student_id,:video_id,:created_at)");
    $stmt4->execute(
    array(
        ":student_id"     => $student_id,
        ":video_id"     => $lecture_id,
        ":created_at"     => $time,
    ));
    $order = ".order" . $student_id . $lecture_id;
    
    $value =  array('status' => true , 'itemm' => $order);
          echo json_encode($value);

}elseif($_POST['from'] == "coupones"){
    $coupone_id = $_POST['id'];

    $stmt = $con->prepare("DELETE FROM coupons WHERE id = :coupone_id");
    $stmt->bindParam(":coupone_id" , $coupone_id);
    $stmt->execute();
    
    $value =  array('status' => true , 'coupone_id' => $coupone_id);
          echo json_encode($value);

}elseif($_POST['from'] == "departments"){
    $dep_id = $_POST['id'];

    $stmt = $con->prepare("DELETE FROM departments WHERE id = :dep_id");
    $stmt->bindParam(":dep_id" , $dep_id);
    $stmt->execute();
    
    $value =  array('status' => true , 'dep_id' => $dep_id);
          echo json_encode($value);

}elseif($_POST['from'] == "signout_from_devices"){
    $student_id = $_POST['student_id'];
    $stmt= $con->prepare ("UPDATE students SET `status`=0 WHERE `id`=?");
    $stmt ->execute(array($student_id));
    
    $value =  array('status' => true);
          echo json_encode($value);

}elseif($_POST['from'] == "payments_requests"){
    $student_id = $_POST['student_id'];
    $videos_id  = $_POST['videos_id'];
    $order_id  = $_POST['order_id'];

    $video_id = explode("-" , $videos_id);
    foreach ($video_id as $data){
        $stmt4 = $con->prepare("INSERT INTO student_videos(student_id,video_id,created_at) Value(:student_id,:video_id,:created_at)");
        date_default_timezone_set('Africa/Cairo');
        $time = date("Y/m/d . H:i:s");
        $stmt4->execute(
        array(
            ":student_id"       => $student_id,
            ":video_id"         => $data,
            ":created_at"       => $time,
        ));
    }
    $stmt = $con->prepare("DELETE FROM payment_request WHERE id = :order_id");
    $stmt->bindParam(":order_id" , $order_id);
    $stmt->execute();
    
    $value =  array('status' => true , 'order_id' => $order_id);
          echo json_encode($value);

}