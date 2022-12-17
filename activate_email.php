<?php 
session_start();
include 'connect_db.php';


if($_POST['from'] == "activate_email"){
    $stmt = $con->prepare("SELECT * FROM verify_email WHERE email = ?");
    $stmt->execute(array($_POST['student_email']));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count){
        if( $rows["code"] ==  $_POST['code']){
            date_default_timezone_set('Africa/Cairo');
            $time = date("Y/m/d . H:i:s");

        $stmt2= $con->prepare ("UPDATE students SET `email_verified_at`=? WHERE `email`=?");
        $stmt2 ->execute(array($time, $_POST['student_email']));
        $_SESSION['email_verified_at'] = $time;

        $student_email = $_POST['student_email'];
        $stmt = $con->prepare("DELETE FROM verify_email WHERE email = :student_email");
        $stmt->bindParam(":student_email" , $student_email);
        $stmt->execute();

        $stmt9   = $con->prepare ("UPDATE students SET `status`=1 WHERE `email`=?");
        $stmt9->execute(array($student_email));

            $value =  array('status' => true);
            echo json_encode($value);

        }else{
            $value =  array('status' => false);
            echo json_encode($value);
        }

    }else{
            $value =  array('status' => false);
            echo json_encode($value);
    }

}elseif($_POST['from'] == "resend_email"){

    $stmt = $con->prepare("SELECT * FROM verify_email WHERE email = ?");
    $stmt->execute(array($_POST['student_email']));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count){
        mail($_POST['student_email'],"Verify Your Email","<h3>You are logged in to Gam3eity website and we want to make sure that you own the email </h3><br>" . "\r\n" . "<h2>Your Verification code is :- " . $rows["code"] . "</h2> " . "\r\n" . " <br> please go to our site and enter the verification code","From: Gam3eity <info@gam3ety.net>\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n");

        $value =  array('status' => true);
        echo json_encode($value);
    }else{
        $stmt2 = $con->prepare("INSERT INTO verify_email(email,code,created_at) Value(:email,:code,:created_at)");
        $code =rand(100000,999999);
        date_default_timezone_set('Africa/Cairo');
        $time = date("Y/m/d . H:i:s");
        $stmt2->execute(
        array(
            ":email"                => $_POST['student_email'],
            ":code"                 => $code,
            ":created_at"           => $time,
        ));
        mail($_POST['student_email'],"Verify Your Email","<h3>You are logged in to Gam3eity website and we want to make sure that you own the email </h3><br>" . "\r\n" . "<h2>Your Verification code is :- " . $code . "</h2> " . "\r\n" . " <br> please go to our site and enter the verification code","From: Gam3eity <info@gam3ety.net	>\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n");

        $value =  array('status' => false , "code" => $rows["code"]);
        echo json_encode($value);
    
    }

}elseif($_POST['from'] == "finish_payment"){
    $student_id = $_POST["student_id"];
    $stmt = $con->prepare("SELECT * FROM cart WHERE student_id = ?");
    $stmt->execute(array($_POST['student_id']));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    foreach($rows as $videos){
        $stmt2 = $con->prepare("SELECT * FROM courses_videos WHERE id = ?");
        $stmt2->execute(array($videos['video_id']));
        $rows2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        if($rows2["price"] == 0 && $rows2["discound"] == 0){
            $stmt3 = $con->prepare("SELECT * FROM student_videos WHERE student_id = ? AND video_id=?");
            $stmt3->execute(array($student_id,$videos['video_id']));
            $count = $stmt3->rowCount();
            if($count == 0){
                $stmt4 = $con->prepare("INSERT INTO student_videos(student_id,video_id,created_at) Value(:student_id,:video_id,:created_at)");
                $stmt4->execute(
                array(
                    ":student_id"     => $student_id,
                    ":video_id"     => $videos['video_id'],
                    ":created_at"     => $time,
                ));
                $stmt5 = $con->prepare("DELETE FROM cart WHERE student_id = :student_id AND video_id = :video_id");
                $stmt5->execute(array(":student_id" => $student_id ,":video_id" => $videos['video_id']));
                
            }else{
                $stmt5 = $con->prepare("DELETE FROM cart WHERE student_id = :student_id AND video_id = :video_id");
                $stmt5->execute(array(":student_id" => $student_id ,":video_id" => $videos['video_id']));
            }
        }else{
            $new_total_price = "1000" * ((100-15) / 100);
            echo Fawry::payment('ar-eg', '1tSa6uxz2nTwlaAmt38enA==', 2312465464, 'Amr Eissa', '01212889256', 'amr-eissa@ieee.org', 12, 'course number 1', 24, 1522, 'video 12', $new_total_price, '1', 'unset', 'unset', 'unset', 'unset', 'success.php', 'fail.php', null);
        }    
    }
    
    $value =  array('status' => true);
    echo json_encode($value);


}elseif($_POST['from'] == "coupon"){
    $coupone_id = $_POST["coupon_id"];
    $price = $_POST["total_price"];

    $stmt = $con->prepare("SELECT * FROM coupons WHERE coupone_code = ?");
    $stmt->execute(array($coupone_id));
    $coupon_state = $stmt->rowCount();
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);

    if($coupon_state > 0){


        $now = date('Y/m/d');
        $expire = $rows["expire_at"];
        $today = strtotime($now);
        $exp = strtotime($expire);

        if($today > $exp){
            $value =  array('status' => false);
            echo json_encode($value);
        }else{
            $new_total_price = $price * ((100-$rows["coupone_value"]) / 100);
            $value =  array('status' => true , 'new_total_price' => $new_total_price);
            echo json_encode($value);

        }

    }else{
        $value =  array('status' => false);
        echo json_encode($value);
    }
  
}elseif($_POST['from'] == "verify_phone"){
    $student_id     = $_POST["student_id"];
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    $stmt2= $con->prepare ("UPDATE students SET `phone_verified_at`=? WHERE `id`=?");
    $stmt2 ->execute(array($time,$student_id));
    $_SESSION['phone_verified_at'] = $time;
    $value =  array('status' => true);
    echo json_encode($value);

}