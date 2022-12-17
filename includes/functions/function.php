<?php

/*
 ==========================  
      count courses
 ==========================
*/
function count_any($table){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From $table");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      count bought videos
 ==========================
*/
function count_bought_videos($video_id){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From student_videos where video_id=?");
    $stmt->execute(array($video_id));
    $rows = $stmt->fetchColumn();
    return $rows;
}


/*
===================
all_courses_num
===================
*/

function all_courses_num($year){
    global $con;
    $stmt = $con->prepare("SELECT courses.id,academic_years.id,subjects.id
    FROM courses
    INNER JOIN subjects
    ON subjects.id = courses.subject_id
    INNER JOIN academic_years
    ON academic_years.id = subjects.academic_years
    WHERE academic_years.name = ?
    ");
    $stmt->execute(array($year));
    $count = $stmt->rowCount();
    return $count;
}

/*
===================
all_courses_num
===================
*/

function count_all_courses_by_subject($sub){
    global $con;
    $stmt = $con->prepare("SELECT courses.id,academic_years.id,subjects.id
    FROM courses
    INNER JOIN subjects
    ON subjects.id = courses.subject_id
    INNER JOIN academic_years
    ON academic_years.id = subjects.academic_years
    WHERE courses.subject_id =?
    ");
    $stmt->execute(array($sub));
    $count = $stmt->rowCount();
    return $count;
}


/*
===================
all_subjects_num
===================
*/

function all_subjects_num($year){
    global $con;
    $stmt = $con->prepare("SELECT subjects.id,academic_years.id
    FROM subjects
    INNER JOIN academic_years
    ON subjects.academic_years = academic_years.id
    WHERE academic_years.name = ?
    ");
    $stmt->execute(array($year));
    $count = $stmt->rowCount();
    return $count;
}


/*
===================
all_subject_data
===================
*/

function all_subject_data($year){
    global $con;
    $stmt = $con->prepare("SELECT subjects.name AS subject_name , subjects.id AS subject_id ,academic_years.id
    FROM subjects
    INNER JOIN academic_years
    ON subjects.academic_years = academic_years.id
    WHERE academic_years.name = ?
    ");
    $stmt->execute(array($year));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

/*
==========================
    get all data
==========================
*/

function getAllData($table){
    global $con;
    $stmt = $con->prepare("SELECT * FROM $table");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

/*
==========================
  get all data with id
==========================
*/

function getData_with_id($table,$id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM $table WHERE id = ?");
    $stmt->execute(array($id));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
}


/*
===================
all Courses
===================
*/

function all_courses_by_subject($subject){
    global $con;
    $stmt = $con->prepare("SELECT courses.* , doctors.name AS doctor_name ,doctors.img AS doctor_img , subjects.name as subject_name
    FROM courses 
    INNER JOIN subjects
    ON subjects.id = courses.subject_id
    INNER JOIN doctors
    ON doctors.id = courses.doctor
    WHERE courses.subject_id=?
    ");
    $stmt->execute(array($subject));
    $rows = $stmt->fetchAll();
    return $rows;
}

/*
 ==========================  
      count_video_by_course
 ==========================
*/
function count_video_by_course($course_id){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From departments where course_id=?");
    $stmt->execute(array($course_id));
    $rows = $stmt->fetchColumn();
    return $rows;
}


/*
===================
all_videos_by_course
===================
*/

function all_videos_by_course($course_id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM courses_videos WHERE course_id=?");
    $stmt->execute(array($course_id));
    $rows = $stmt->fetchAll();
    return $rows;
}


/*
===================
all_videos_by_course
===================
*/

function all_videos_by_department($dep_id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM courses_videos WHERE dep_id=?");
    $stmt->execute(array($dep_id));
    $rows = $stmt->fetchAll();
    return $rows;
}

/*
===================
all_dep_by_course
===================
*/

function all_dep_by_course($course_id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM departments WHERE course_id=?");
    $stmt->execute(array($course_id));
    $rows = $stmt->fetchAll();
    return $rows;
}



/*
===================
all cart dara
===================
*/

function all_cart_data($student){
    global $con;
    $stmt = $con->prepare("SELECT cart.* , courses_videos.video_name , courses_videos.price , courses_videos.discound ,doctors.img AS doctor_img , doctors.name as doctor_name
    FROM cart 
    INNER JOIN students
    ON students.id = cart.student_id
    INNER JOIN courses_videos
    ON courses_videos.id = cart.video_id
    INNER JOIN courses
    ON courses.id = courses_videos.course_id
    INNER JOIN doctors
    ON doctors.id = courses.doctor
    WHERE cart.student_id=?
    ");
    $stmt->execute(array($student));
    $rows = $stmt->fetchAll();
    return $rows;
}

/*
 ==========================  
      count_user_cart
 ==========================
*/
function count_user_cart($student_id){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From cart where student_id=?");
    $stmt->execute(array($student_id));
    $rows = $stmt->fetchColumn();
    return $rows;
}


/*
===================
all student videos
===================
*/

function all_student_videos($student){
    global $con;
    $stmt = $con->prepare("SELECT student_videos.* ,subjects.name AS subject_name , courses_videos.video_name,courses_videos.video_id,courses_videos.description , courses_videos.img AS video_img, doctors.name as doctor_name , courses.name AS course_name ,courses_videos.id AS id_of_video
    FROM student_videos 
    INNER JOIN courses_videos
    ON courses_videos.id = student_videos.video_id
    INNER JOIN courses
    ON courses.id = courses_videos.course_id
    INNER JOIN subjects
    ON subjects.id = courses.subject_id
    INNER JOIN doctors
    ON doctors.id = courses.doctor
    WHERE student_videos.student_id=?
    ");
    $stmt->execute(array($student));
    $rows = $stmt->fetchAll();
    return $rows;
}


/*
==========================
  insert new student
==========================
*/

function  insert_student($name,$email,$phone,$university,$faculty,$birthday,$academic_year,$gender,$hashed_password){
    global $con;
    $stmt = $con->prepare("INSERT INTO students(student_name,email,phone,pass,gender,university,faculty,birthday,academic_year,created_at,status) Value(:student_name,:email,:phone,:pass,:gender,:university,:faculty,:birthday,:academic_year,:created_at,:status)");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    $status =0;
    $stmt->execute(
    array(
        ":student_name"             => $name,
        ":email"                    => $email,
        ":phone"                    => $phone,
        ":pass"                     => $hashed_password,
        ":gender"                   => $gender,
        ":university"               => $university,
        ":faculty"                  => $faculty,
        ":birthday"                 => $birthday,
        ":academic_year"            => $academic_year,
        ":created_at"               => $time,
        ":status"                   => $status
    ));
    $stmt2 = $con->prepare("INSERT INTO verify_email(email,code,created_at) Value(:email,:code,:created_at)");
    $code =rand(100000,999999);
    $stmt2->execute(
    array(
        ":email"                => $email,
        ":code"                 => $code,
        ":created_at"           => $time,
    ));
    mail($email,"Verify Your Email","<h3>You are logged in to Gam3eity website and we want to make sure that you own the email </h3><br>" . "\r\n" . "<h2>Your Verification code is :- " . $code . "</h2> " . "\r\n" . " <br> please go to our site and enter the verification code","From: Gam3eity <info@gam3ety.net>\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n");


    $stmt3 = $con->prepare("SELECT id FROM students WHERE email = ?");
    $stmt3->execute(array($email));
    $rows3 = $stmt3->fetch(PDO::FETCH_ASSOC);


    $stmt5 = $con->prepare("INSERT INTO student_ips(student_id,ip,created_at) Value(:student_id,:ip,:created_at)");
    $IP = $_SERVER['REMOTE_ADDR'];
    $stmt5->execute(
    array(
        ":student_id"                   => $rows3["id"],
        ":ip"                           => $IP,
        ":created_at"                   => $time,
    ));
 

    echo "
    <script>
        toastr.success('تم بنجاح :- تم التسجيل بنجاح')
    </script>";
    header("Refresh:3;url=signin.php"); 
}

/*
==========================
  check if user exist
==========================
*/
function check_user ( $user_email , $hased){
    global $con;
    $stmt = $con->prepare("SELECT * FROM students WHERE email = ?");
    $stmt->execute(array($user_email));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count){
        if( password_verify($hased,$rows['pass']) ){
            if($rows['status'] != 0){
                echo "
                    <script>
                        toastr.error('عفوا ... لايمكنك تسجيل الدخول بنفس الحساب مرتين في نفس الوقت , من فضلك سجل الخروج من الجهاز الاخر اولا لكي تتمكن من الدخول')
                    </script>";
            }else{

                $IP = $_SERVER['REMOTE_ADDR'];
                $stmt7 = $con->prepare("SELECT * FROM student_ips WHERE ip = ? AND student_id = ?");
                $stmt7->execute(array($IP,$rows["id"]));
                $ip_already_found = $stmt7->rowCount();


                if( $ip_already_found != 0){


                    if ($rows['blocked'] == 0){
                        @session_start();
                        $_SESSION['id']    = $rows['id'];
                        $_SESSION['student_name']  = $rows['student_name'];
                        $_SESSION['email'] = $rows['email'];
                        $_SESSION['pass'] = $rows['pass'];
                        $_SESSION['phone'] = $rows['phone'];
                        $_SESSION['birthday'] = $rows['birthday'];
                        $_SESSION['gender'] = $rows['gender'];
                        $_SESSION['university'] = $rows['university'];
                        $_SESSION['faculty'] = $rows['faculty'];
                        $_SESSION['academic_year'] = $rows['academic_year'];
                        $_SESSION['email_verified_at'] = $rows['email_verified_at'];
                        $_SESSION['phone_verified_at'] = $rows['phone_verified_at'];
                        $stmt9   = $con->prepare ("UPDATE students SET `status`=1 WHERE `id`=?");
                        $stmt9->execute(array($rows['id']));


                        $stmt4 = $con->prepare("INSERT INTO session_token(token,student_id) Value(:token,:student_id)");
                        $student_token = uniqid("gam3ety");
                        $stmt4->execute(
                        array(
                            ":token"            => $student_token,
                            ":student_id"       => $rows['id'],
                        ));
                        setcookie("_token", $student_token, time() + (86400 * 3000), "/");



                        echo "
                        <script>
                            toastr.success('" . $_SESSION['student_name'] . " مرحبا مره اخري ')
                        </script>";
                        if($_SESSION['email_verified_at'] == 0){
                            header("Refresh:3;url=verify_email.php");
                        }else{
                            header("Refresh:3;url=user_dash.php");
                        }
                    }else{
                        echo "
                        <script>
                            toastr.error('تم حظر حسابك مؤقتا .. يرجي التواصل مع مسئولين الموقع من خلال صفحة اتصل بنا او من خلال الشات بوت ')
                        </script>";
                    }

                }else{

                    $stmt4 = $con->prepare("SELECT * FROM student_ips WHERE student_id = ?");
                    $stmt4->execute(array($rows["id"]));
                    $count_ips = $stmt4->rowCount();
                    if($count_ips > 2 && $count_ips !=0){
                        $stmt= $con->prepare ("UPDATE students SET `blocked`=1 WHERE `id`=?");
                        $stmt ->execute(array($rows['id']));
                        echo "
                        <script>
                            toastr.error('تم حظر حسابك مؤقتا لتجاوزك المعايير الخاصة بموقعنا ..... من فضلك تواصل مع مسئولين الموقع من خلال صفحة اتصل بنا او من خلال الشات بوت')
                        </script>";
                    }else{

                        if ($rows['blocked'] == 0){
                        
                            $stmt6 = $con->prepare("SELECT * FROM student_ips WHERE ip = ? AND student_id = ?");
                            $stmt6->execute(array($IP,$rows["id"]));
                            $if_ip_not_found = $stmt6->rowCount();
                            if($if_ip_not_found == 0){
                                $stmt5 = $con->prepare("INSERT INTO student_ips(student_id,ip,created_at) Value(:student_id,:ip,:created_at)");
                                date_default_timezone_set('Africa/Cairo');
                                $time = date("Y/m/d . H:i:s");
                                $stmt5->execute(
                                array(
                                    ":student_id"                   => $rows['id'],
                                    ":ip"                           => $IP,
                                    ":created_at"                   => $time,
                                ));
                            }
                            @session_start();
                            $_SESSION['id']    = $rows['id'];
                            $_SESSION['student_name']  = $rows['student_name'];
                            $_SESSION['email'] = $rows['email'];
                            $_SESSION['pass'] = $rows['pass'];
                            $_SESSION['phone'] = $rows['phone'];
                            $_SESSION['birthday'] = $rows['birthday'];
                            $_SESSION['gender'] = $rows['gender'];
                            $_SESSION['university'] = $rows['university'];
                            $_SESSION['faculty'] = $rows['faculty'];
                            $_SESSION['academic_year'] = $rows['academic_year'];
                            $_SESSION['email_verified_at'] = $rows['email_verified_at'];
                            $_SESSION['phone_verified_at'] = $rows['phone_verified_at'];


                            $stmt44 = $con->prepare("INSERT INTO session_token(token,student_id) Value(:token,:student_id)");
                            $student_token = uniqid("gam3ety");
                            $stmt44->execute(
                            array(
                                ":token"            => $student_token,
                                ":student_id"       => $rows['id'],
                            ));
                            setcookie("_token", $student_token, time() + (86400 * 3000), "/");


                            echo "
                            <script>
                                toastr.success('" . $_SESSION['student_name'] . " مرحبا مره اخري ')
                            </script>";
                            if($_SESSION['email_verified_at'] == 0){
                                header("Refresh:3;url=verify_email.php");
                            }else{
                                header("Refresh:3;url=user_dash.php");
                            }
                        }else{
                            echo "
                            <script>
                                toastr.error('تم حظر حسابك مؤقتا .. يرجي التواصل مع مسئولين الموقع من خلال صفحة اتصل بنا او من خلال الشات بوت ')
                            </script>";
                        }



                    }

                }


               



                   
            }
        }
        else{
            echo "
            <script>
                toastr.error('تأكد من ادخال البيانات بطريقه صحيحه , البريد الالكتروني او كلمة السر خطأ .')
              </script>";
        }
    }
    else{
            echo "
            <script>
                toastr.error('تأكد من ادخال البيانات بطريقه صحيحه , البريد الالكتروني او كلمة السر خطأ .')
              </script>";
        }
}




/*
===================
all video data
===================
*/

function all_video_data($video_id){
    global $con;
    $stmt = $con->prepare("SELECT courses_videos.* ,subjects.name AS subject_name , doctors.name as doctor_name, doctors.img as doctor_img , courses.name AS course_name
    FROM courses_videos 
    INNER JOIN courses
    ON courses.id = courses_videos.course_id
    INNER JOIN subjects
    ON subjects.id = courses.subject_id
    INNER JOIN doctors
    ON doctors.id = courses.doctor
    WHERE courses_videos.id=?
    ");
    $stmt->execute(array($video_id));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
}

 
/*
 ==========================  
      update_student          
 ==========================
*/

function update_student($name,$university,$faculty,$birthday,$academic_year,$gender,$password,$id){
    global $con;
    $stmt= $con->prepare ("UPDATE students SET `name`=?,`university`=?,`faculty`=?,`birthday`=?,`academic_year`=?,`gender`=?,`pass`=? WHERE `id`=?");
    $stmt ->execute(array($name,$university,$faculty,$birthday,$academic_year,$gender,$password,$id));
    echo "
    <script>
    toastr.success('تم بنجاح :- تم تعديل بياناتك بنجاح')
    </script>";
    header("Refresh:2;url=user_dash.php"); 
}


/*
===================
all video data
===================
*/

function all_years_videos($year){
    global $con;
    $stmt = $con->prepare("SELECT courses_videos.* ,academic_years.name AS academic_year_name, subjects.name AS subject_name , doctors.name as doctor_name, doctors.img as doctor_img , courses.name AS course_name
    FROM courses_videos 
    INNER JOIN courses
    ON courses.id = courses_videos.course_id
    INNER JOIN subjects
    ON subjects.id = courses.subject_id
    INNER JOIN doctors
    ON doctors.id = courses.doctor
    INNER JOIN academic_years
    ON academic_years.id = subjects.academic_years
    WHERE academic_years.name=? 
    LIMIT 2
    ");
    $stmt->execute(array($year));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}







/*
==========================
    get all data
==========================
*/

function check_student_token($_token){
    global $con;
    $stmt = $con->prepare("SELECT * FROM session_token WHERE token=?");
    $stmt->execute(array($_token));
    $count = $stmt->rowCount();
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    if($count > 0){

        $stmt2 = $con->prepare("SELECT * FROM students WHERE id=?");
        $stmt2->execute(array($rows["student_id"]));
        $rows2 = $stmt2->fetch(PDO::FETCH_ASSOC);
        $_SESSION['id']    = $rows2['id'];
        $_SESSION['student_name']  = $rows2['student_name'];
        $_SESSION['email'] = $rows2['email'];
        $_SESSION['pass'] = $rows2['pass'];
        $_SESSION['phone'] = $rows2['phone'];
        $_SESSION['gender'] = $rows2['gender'];
        $_SESSION['university'] = $rows2['university'];
        $_SESSION['faculty'] = $rows2['faculty'];
        $_SESSION['academic_year'] = $rows2['academic_year'];
        $_SESSION['email_verified_at'] = $rows2['email_verified_at'];
        $_SESSION['phone_verified_at'] = $rows2['phone_verified_at'];
    }
}


/*
==========================
   send_message
==========================
*/

function send_message($student_name,$student_email,$student_phone,$message_title,$message_content){
    global $con;
    $stmt4 = $con->prepare("INSERT INTO contact(subject,sender_email,phone,message,time,sender_name) Value(:subject,:sender_email,:phone,:message,:time,:sender_name)");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    $stmt4->execute(
    array(
        ":subject"          => $message_title,
        ":sender_email"     => $student_email,
        ":phone"            => $student_phone,
        ":message"          => $message_content,
        ":time"             => $time,
        ":sender_name"      => $student_name,
    ));
    mail("info@gam3ety.net","Messaage from Website :- " . $message_title . " " , " <h2>Hello Gam3ety Manager </h2><br>" . "\r\n" . "A New Message was Sent By:-  <span style='font-weight:900'> " . $student_name . " </span> <br><br> his Phone is :-  " . $student_phone . " <br><br> his Email is :-  " . $student_email .  "  <br><br> Message Content :- " . $message_content . " <br><br> At :- <span style='font-weight:900'> " . $time . " </span>
    ","From: " . $student_email . "\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n");
    echo "
    <script>
    toastr.success('تم بنجاح :- تم ارسال الرساله بنجاح')
    </script>";
}

    /*
==========================  
  select_user_by_email
==========================
*/
function select_user_by_email($table ,$value_field){
    global $con;
    $stmt1       = $con->prepare("SELECT * FROM $table where `email`=?") ;
    $stmt1       ->execute(array($value_field));
    $row   =$stmt1 ->fetch();
    return $row;
  }

/*
==========================
   check forgetpass code
==========================
*/

function checkcode( $code,$email){
    $user = select_user_by_email("students",$email);
    global $con;
    $stmt=$con->prepare("SELECT * FROM forget_password WHERE student_id=?");
    $stmt->execute(array( $user['id']));
    $rows=$stmt->fetch(PDO::FETCH_ASSOC);
    $count=$stmt->rowCount();
    if ($count) {
       if($code == $rows['code']){
        $stmt = $con->prepare("DELETE FROM forget_password WHERE id = :id");
        $stmt->bindParam(":id" , $user['id']);
        $stmt->execute();
        header("location:forget_password.php?to=confirm&ssn=".$user['id']."");
       }else{
        echo "
        <script>
            toastr.error('كود التاكيد الذي ادخلته غير صحيح ')
          </script>";
       }
    }
    else{
        header("Refresh:3;url=login.php");
    }

}


  /*
==========================  
  select_user_by_id_for_forgetpass
==========================
*/
function select_user_by_id_for_forgetpass($table ,$value_field){
    global $con;
    $stmt1       = $con->prepare("SELECT * FROM $table where `student_id`=?") ;
    $stmt1       ->execute(array($value_field));
    $row   =$stmt1 ->fetch();
    return $row;
  }


/*
==========================
  check if user exist
==========================
*/

function check_user_pass ( $email ){
    global $con;
    $stmt = $con->prepare("SELECT * FROM students WHERE email = ?");
    $stmt->execute(array($email));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count){
        $retries = select_user_by_id_for_forgetpass('forget_password',$rows['id']);
        if(isset($retries['retries'] )){
            if($retries['retries'] > 0){
                $retries_count=$retries['retries']-1;
                $stmt= $con->prepare ("UPDATE forget_password SET `retries`=? WHERE `student_id`=?");
                $stmt ->execute(array($retries_count, $rows['id']));
                $header="from:".$email;
                $time= date("Y/m/d . h:i:s");
                $code = $retries['code'];
                $msg = "كود التفعيل : " .$code ;
                mail($email,"Forget Passworsd","<h2>We Send a authentication code to you Based on Your Order To Change Password</h2><br>" . "\r\n" . "Authentication Code :-  <span style='font-weight:900'> " . $code . "</span>","From: info@gam3ety.net\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n");
                // add_forget($rows['student_id'],$email,$code,3,$time);
                echo "
                <script>
                toastr.success('تم ارسال كود التفعيل لبريدك الالكتروني.')
                </script>";
                header("location:forget_password.php?to=code&email=".$rows['email']."");
                
            }else{
                global $con;
                $stmt = $con->prepare("DELETE FROM forget_password WHERE student_id = :student_id");
                $stmt->bindParam(":student_id" , $rows['id']);
                $stmt->execute();
                echo "
                <script>
                    toastr.error('للاسف لقد نفذت جميع محاولاتك حاول فى وقت لاحق ')
                  </script>";
            }
        }else{
            $stmt= $con->prepare ("UPDATE forget_password SET `retries`=? WHERE `student_id`=?");
                    $stmt ->execute(array(
                        $retries,  $rows['id']));
                $header="from:".$email;
                $time= date("Y/m/d . h:i:s");
                $code =rand(100000,999999);
                $msg = "كود التفعيل : " .$code ;
                mail($email,"Forget Passworsd","<h2>We Send a authentication code to you Based on Your Order To Change Password</h2><br>" . "\r\n" . "Authentication Code :-  <span style='font-weight:900'> " . $code . "</span>","From: info@gam3ety.net\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n");
                add_forget($rows['id'],$email,$code,3,$time);
                    echo "
                    <script>
                        toastr.success('تم ارسال كود التفعيل لبريدك الالكتروني.')
                      </script>";
                      header("location:forget_password.php?to=code&email=".$rows['email']."");
        }
        
}else{
            echo "
            <script>
                toastr.error('للاسف بريدك الالكتروني غير صحيح')
              </script>";
        }
}
// add forget password code 
function add_forget($student_id,$email,$code,$retries,$time){
    global $con;
    $stmt=$con->prepare("INSERT INTO forget_password(student_id,code,retries,time) Value(:student_id,:code,:retries,:time)");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . h:i:s");
    $stmt->execute(array(
        ":student_id"=>$student_id,
        ":code"=>$code,
        ":retries"=>$retries,
        ":time"=>$time
        ));
}