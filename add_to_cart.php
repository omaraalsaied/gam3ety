<?php 

include 'connect_db.php';

if($_POST['from'] == "buy_videos"){
    $video_id = $_POST['video_id'];
    $student_id = $_POST['student_id'];

    $stmt = $con->prepare("SELECT price,discound From courses_videos WHERE id = ?");
    $stmt->execute(array($video_id));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if($rows["discound"] == 0){

        $stmt3 = $con->prepare("SELECT * FROM student_videos WHERE student_id = ? AND video_id=?");
        $stmt3->execute(array($student_id,$video_id));
        $count = $stmt3->rowCount();
        if($count == 0){
            $stmt4 = $con->prepare("INSERT INTO student_videos(student_id,video_id,created_at) Value(:student_id,:video_id,:created_at)");
            date_default_timezone_set('Africa/Cairo');
            $time = date("Y/m/d . H:i:s");
            $stmt4->execute(
            array(
                ":student_id"       => $student_id,
                ":video_id"         => $video_id,
                ":created_at"       => $time,
            ));
            $value =  array('status' => 'free_video');
            echo json_encode($value);

        }else{
            $value =  array('status' => 'free_video_found');
            echo json_encode($value);

        }

    }else{

        
        $stmt2 = $con->prepare("SELECT count(id) From cart WHERE student_id = ? AND video_id = ?");
        $stmt2->execute(array($student_id,$video_id));
        $cound_on_cart = $stmt2->fetchColumn();
        
        if($cound_on_cart > 0){
   
            $value =  array('status' => false);
            echo json_encode($value);
    
        }else{
            $stmt5 = $con->prepare("INSERT INTO cart(student_id,video_id,created_at) Value(:student_id,:video_id,:created_at)");
            date_default_timezone_set('Africa/Cairo');
            $time = date("Y/m/d . H:i:s");
            $stmt5->execute(
            array(
                ":student_id"           => $student_id,
                ":video_id"             => $video_id,
                ":created_at"           => $time,
            ));
           
            $value =  array('status' => true);
                  echo json_encode($value);
        }
    }


}