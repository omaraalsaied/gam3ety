<?php

/*
==========================
  insert new admin
==========================
*/

function insert_admin($admin_name,$email,$password,$role,$added_by){
    global $con;
    $stmt = $con->prepare("INSERT INTO admins(admin_name,email,pass,role_id,added_by,added_at) Value(:admin_name,:email,:pass,:role_id,:added_by,:added_at)");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    $stmt->execute(
    array(
        ":admin_name"           => $admin_name,
        ":email"                => $email,
        ":pass"                 => $password,
        ":role_id"              => $role,
        ":added_by"             => $added_by,
        ":added_at"             => $time,
    ));
    echo "
    <script>
        toastr.success('Great ,successfully: Admin  added .')
    </script>";
    header("Refresh:3;url=all_role_admin.php"); 
}

/*
==========================
  insert new role
==========================
*/

function insert_role($name,$roles_ex){
    global $con;
    $stmt = $con->prepare("INSERT INTO roles(role_name,authentications) Value(:role_name,:roles_ex)");
    $stmt->execute(
    array(
        ":role_name"     => $name,
        ":roles_ex"     => $roles_ex,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة الصلاحيه بنجاح')
    </script>";
    header("Refresh:3;url=all_role_admin.php?to=role"); 
}

/*
==========================
  insert new university
==========================
*/

function insert_university($name){
    global $con;
    $stmt = $con->prepare("INSERT INTO university(name) Value(:university_name)");
    $stmt->execute(
    array(
        ":university_name"     => $name,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة الجامعه بنجاح')
    </script>";
    header("Refresh:3;url=all_universities_faculties.php?to=university"); 
}

/*
==========================
  insert new faculty
==========================
*/

function insert_faculty($name,$university){
    global $con;
    $stmt = $con->prepare("INSERT INTO faculty(name,university_id) Value(:faculty_name,:university_id)");
    $stmt->execute(
    array(
        ":faculty_name"     => $name,
        ":university_id"     => $university,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة الكلية بنجاح')
    </script>";
    header("Refresh:3;url=all_universities_faculties.php"); 
}

/*
==========================
  insert new academic_year
==========================
*/

function  insert_academic_year($faculty,$academic_year){
    global $con;
    $stmt = $con->prepare("INSERT INTO academic_years(name,faculty) Value(:academic_year,:faculty)");
    $stmt->execute(
    array(
        ":academic_year"        => $academic_year,
        ":faculty"              => $faculty,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة السنه الدراسيه بنجاح')
    </script>";
    header("Refresh:3;url=all_academice_subject.php?to=academic_years"); 
}

/*
==========================
  insert new insert_subject
==========================
*/

function  insert_subject($subject,$academic_year){
    global $con;
    $stmt = $con->prepare("INSERT INTO subjects(name,academic_years) Value(:subject,:academic_year)");
    $stmt->execute(
    array(
        ":subject"                      => $subject,
        ":academic_year"                => $academic_year,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة الماده بنجاح')
    </script>";
    header("Refresh:3;url=all_academice_subject.php"); 
}
/*
==========================
  insert new  insert_course
==========================
*/

function insert_course($course,$subject,$doctor,$added_by,$img){
    global $con;
    $stmt = $con->prepare("INSERT INTO courses(name,subject_id,doctor,added_by,img,created_at) Value(:course,:subject_id,:doc,:added_by,:img,:created_at)");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    $stmt->execute(
    array(
        ":course"                       => $course,
        ":subject_id"                   => $subject,
        ":doc"                          => $doctor,
        ":added_by"                     => $added_by,
        ":img"                          => $img,
        ":created_at"                   => $time,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة الكورس بنجاح')
    </script>";
    header("Refresh:3;url=all_courses.php"); 
}
/*
==========================
  insert new  add_department
==========================
*/

function add_department($dep_name,$course,$img,$admin){
    global $con;
    $stmt = $con->prepare("INSERT INTO departments(dep_name,course_id,img,admin_id,created_at) Value(:dep_name,:course_id,:img,:admin_id,:created_at)");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    $stmt->execute(
    array(
        ":dep_name"                         => $dep_name,
        ":course_id"                        => $course,
        ":img"                              => $img,
        ":admin_id"                         => $admin,
        ":created_at"                       => $time,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة القسم بنجاح')
    </script>";
    header("Refresh:3;url=all_department.php"); 
}
/*
==========================
  insert new  insert_video
==========================
*/

function insert_video($video_name,$course,$department,$video_id,$channel_id,$video_price,$discount,$desc,$avatar,$pdf,$admin_id){
    global $con;
    $stmt = $con->prepare("INSERT INTO courses_videos(video_name,course_id,dep_id,video_id,channel_id,description,img,pdf,created_at,price,discound,added_by) Value(:video_name,:course_id,:dep_id,:video_id,:channel_id,:desc,:img,:pdf,:created_at,:price,:discound,:added_by)");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    $stmt->execute(
    array(
        ":video_name"                       => $video_name,
        ":course_id"                        => $course,
        ":dep_id"                           => $department,
        ":video_id"                         => $video_id,
        ":channel_id"                       => $channel_id,
        ":desc"                             => $desc,
        ":img"                              => $avatar,
        ":pdf"                              => $pdf,
        ":created_at"                       => $time,
        ":price"                            => $video_price,
        ":discound"                         => $discount,
        ":added_by"                         => $admin_id,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة الفيديو بنجاح')
    </script>";
    header("Refresh:3;url=all_videos.php"); 
}
/*
==========================
  insert new  gift_video_by_admin
==========================
*/

function gift_video_by_admin($video_id,$student_id,$admin_id){
    global $con;
    $stmt = $con->prepare("INSERT INTO student_videos(student_id,video_id,admin_id,created_at) Value(:student_id,:video_id,:admin_id,:created_at)");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    $stmt->execute(
    array(
        ":student_id"                               => $student_id,
        ":video_id"                                 => $video_id,
        ":admin_id"                                 => $admin_id,
        ":created_at"                               => $time,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اهداء الفيديو للطالب بنجاح')
    </script>";
    header("Refresh:3;url=all_gifted_videos.php"); 
}
/*
==========================
  insert new  insert_doctor
==========================
*/

function insert_doctor($doctor_name,$doctor_position,$doctor_facebook,$doctor_linked_in,$doctor_email,$avatar){
    global $con;
    $stmt = $con->prepare("INSERT INTO doctors(name,position,facebook,linked_in,email,img,created_at) Value(:name,:position,:facebook,:linked_in,:email,:img,:created_at)");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    $stmt->execute(
    array(
        ":name"                               => $doctor_name,
        ":position"                           => $doctor_position,
        ":facebook"                           => $doctor_facebook,
        ":linked_in"                          => $doctor_linked_in,
        ":email"                              => $doctor_email,
        ":img"                                => $avatar,
        ":created_at"                         => $time,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة الدكتور بنجاح')
    </script>";
    header("Refresh:3;url=all_doctors.php"); 
}

/*
==========================
  insert new  insert_coupon
==========================
*/

function insert_coupon($name,$code,$value,$expire,$one_use,$admin){
    global $con;
    $stmt = $con->prepare("INSERT INTO coupons(coupone_name,coupone_code,coupone_value,expire_at,one_used,added_by,created_at) Value(:coupone_name,:coupone_code,:coupone_value,:expire_at,:one_used,:added_by,:created_at)");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    $stmt->execute(
    array(
        ":coupone_name"                      => $name,
        ":coupone_code"                      => $code,
        ":coupone_value"                     => $value,
        ":expire_at"                         => $expire,
        ":one_used"                           => $one_use,
        ":added_by"                          => $admin,
        ":created_at"                        => $time,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة كوبون الخصم بنجاح')
    </script>";
    header("Refresh:3;url=all_coupones.php"); 
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
      update_role          
 ==========================
*/
function update_role($role_id,$name,$roles_ex){
    global $con;
    $stmt= $con->prepare ("UPDATE roles SET `role_name`=? ,`authentications`=? WHERE `id`=?");
    $stmt ->execute(array(
    $name, $roles_ex , $role_id));
    echo "
    <script>
    toastr.success('تم بنجاح :- تم تعديل الصلاحيه بنجاح')
    </script>";
    header("Refresh:2;url=all_role_admin.php?to=role"); 
}
 
/*
 ==========================  
      update_admin          
 ==========================
*/
function update_admin($admin_name,$email,$pass,$role,$updated_by,$admin_id){
    global $con;
    $stmt= $con->prepare ("UPDATE admins SET `admin_name`=? ,`email`=? ,`pass`=?,`role_id`=?,`added_by`=?,`updated_at`=? WHERE `id`=?");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    $stmt ->execute(array(
    $admin_name, $email,$pass, $role,$updated_by,$time,$admin_id ));
    echo "
    <script>
    toastr.success('تم بنجاح :- تم تعديل بيانات المسؤول بنجاح')
    </script>";
    header("Refresh:2;url=all_role_admin.php"); 
}
 
/*
 ==========================  
      update_university          
 ==========================
*/

function update_university($name,$id){
    global $con;
    $stmt= $con->prepare ("UPDATE university SET `name`=? WHERE `id`=?");
    $stmt ->execute(array($name, $id));
    echo "
    <script>
    toastr.success('تم بنجاح :- تم تعديل بيانات الجامعه بنجاح')
    </script>";
    header("Refresh:2;url=all_universities_faculties.php?to=university"); 
}
 
/*
 ==========================  
      update_faculty          
 ==========================
*/
function update_faculty($name,$university,$id){
    global $con;
    $stmt= $con->prepare ("UPDATE faculty SET `name`=?,`university_id`=? WHERE `id`=?");
    $stmt ->execute(array($name,$university,$id));
    echo "
    <script>
    toastr.success('تم بنجاح :- تم تعديل بيانات الكليه بنجاح')
    </script>";
    header("Refresh:2;url=all_universities_faculties.php"); 
}
 
/*
 ==========================  
      update_academic_year          
 ==========================
*/
function update_academic_year($academic_year,$faculty,$id){
    global $con;
    $stmt= $con->prepare ("UPDATE academic_years SET `name`=?,`faculty`=? WHERE `id`=?");
    $stmt ->execute(array($academic_year,$faculty,$id));
    echo "
    <script>
    toastr.success('تم بنجاح :- تم تعديل بيانات السنه الدراسيه بنجاح')
    </script>";
    header("Refresh:2;url=all_academice_subject.php?to=academic_years"); 
}
 
/*
 ==========================  
      update_subject          
 ==========================
*/
function update_subject($subject,$academic_year,$id){
    global $con;
    $stmt= $con->prepare ("UPDATE subjects SET `name`=?,`academic_years`=? WHERE `id`=?");
    $stmt ->execute(array($subject,$academic_year,$id));
    echo "
    <script>
    toastr.success('تم بنجاح :- تم تعديل بيانات الماده الدراسيه بنجاح')
    </script>";
    header("Refresh:2;url=all_academice_subject.php"); 
}
 
/*
 ==========================  
      update_course          
 ==========================
*/
function update_course($course,$doctor,$img,$subject,$admin,$id){
    global $con;
    $stmt= $con->prepare ("UPDATE courses SET `name`=?,`doctor`=?,`img`=?,`subject_id`=?,`added_by`=?,`updated_at`=? WHERE `id`=?");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    $stmt ->execute(array($course,$doctor,$img,$subject,$admin,$time,$id));
    
    echo "
    <script>
    toastr.success('تم بنجاح :- تم تعديل بيانات الكورس بنجاح')
    </script>";
    header("Refresh:2;url=all_courses.php"); 
}
 
/*
 ==========================  
      update_video          
 ==========================
*/
function update_video($video_name,$course,$department,$video_id,$channel_id,$video_price,$discount,$desc,$my_img,$pdf,$admin_id,$id){
    global $con;
    $stmt= $con->prepare ("UPDATE courses_videos SET `video_name`=?,`course_id`=?,`dep_id`=?,`video_id`=?,`channel_id`=?,`description`=?,`img`=?,`pdf`=?,`updated_at`=?,`price`=?,`discound`=?,`added_by`=? WHERE `id`=?");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    $stmt ->execute(array($video_name,$course,$department,$video_id,$channel_id,$desc,$my_img,$pdf,$time,$video_price,$discount,$admin_id,$id));
    
    echo "
    <script>
    toastr.success('تم بنجاح :- تم تعديل بيانات الكورس بنجاح')
    </script>";
    header("Refresh:2;url=all_videos.php"); 
}
 
/*
 ==========================  
      update_dep         
 ==========================
*/
function update_dep($dep_name,$course,$img,$admin_id,$dep_id){
    global $con;
    $stmt= $con->prepare ("UPDATE departments SET `dep_name`=?,`course_id`=?,`img`=?,`updated_at`=?,`admin_id`=? WHERE `id`=?");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    $stmt ->execute(array($dep_name,$course,$img,$time,$admin_id,$dep_id));
    
    echo "
    <script>
    toastr.success('تم بنجاح :- تم تعديل بيانات القسم بنجاح')
    </script>";
    header("Refresh:2;url=all_department.php"); 
}
 
/*
 ==========================  
      update_doctor          
 ==========================
*/
function update_doctor($doctor_name,$doctor_position,$doctor_facebook,$doctor_linked_in,$doctor_email,$avatar,$id){
    global $con;
    $stmt= $con->prepare ("UPDATE doctors SET `name`=?,`position`=?,`facebook`=?,`linked_in`=?,`email`=?,`img`=?,`updated_at`=? WHERE `id`=?");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    $stmt ->execute(array($doctor_name,$doctor_position,$doctor_facebook,$doctor_linked_in,$doctor_email,$avatar,$time,$id));
    
    echo "
    <script>
    toastr.success('تم بنجاح :- تم تعديل بيانات الدكتور بنجاح')
    </script>";
    header("Refresh:2;url=all_doctors.php"); 
}
 
/*
 ==========================  
      update_doctor          
 ==========================
*/
function update_coupon($name,$code,$value,$expire,$one_used,$admin,$id){
    global $con;
    $stmt= $con->prepare ("UPDATE coupons SET `coupone_name`=?,`coupone_code`=?,`coupone_value`=?,`expire_at`=?,`one_used`=?,`updated_at`=?,`added_by`=? WHERE `id`=?");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    $stmt ->execute(array($name,$code,$value,$expire,$one_used,$time,$admin,$id));
    
    echo "
    <script>
    toastr.success('تم بنجاح :- تم تعديل بيانات كوبون الخصم بنجاح')
    </script>";
    header("Refresh:2;url=all_coupones.php"); 
}



/*
==========================
  check if admin exist
==========================
*/
function check_admin ( $admin_email , $hased){
    global $con;
    $stmt = $con->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute(array($admin_email));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count){
        if( password_verify($hased,$rows['pass']) ){
            @session_start();
            $_SESSION['admin_id']    = $rows['id'];
            $_SESSION['admin_name']  = $rows['admin_name'];
            $_SESSION['email'] = $rows['email'];
            $_SESSION['role'] = $rows['role_id'];
            $_SESSION['added_by'] = $rows['added_by'];
            echo "
            <script>
                toastr.success('" . $_SESSION['admin_name'] . " مرحبا مره اخري ')
            </script>";
            header("Refresh:3;url=admin_dash.php");
  

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



function addmsg($msgfrom,$name,$msg,$subject,$time){
    global $con;
    $stmt=$con->prepare("INSERT INTO contact_us(msgfrom,name,msg,subject,time) Value(:msgfrom,:name,:msg,:subject,:time)");
    date_default_timezone_set('Africa/Cairo');
    $time = date("Y/m/d . H:i:s");
    $stmt->execute(array(
        ":msgfrom"=>$msgfrom,
        ":name"=>$name,
        ":msg"=>$msg,
        ":subject"=>$subject,
        ":time"=>$time
        ));
        echo "
        <script>
        toastr.success('Great , Your Message has been successfully Deliverd .')
        </script>";
}



/*
==========================
  get all rols with id
==========================
*/

function get_rols_with_id($id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM roles WHERE id = ?");
    $stmt->execute(array($id));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
}

  /*
==========================  
  select_admin_by_ssn
==========================
*/
function select_admin_by_id($table ,$value_field){
    global $con;
    $stmt1       = $con->prepare("SELECT * FROM $table where `id`=?") ;
    $stmt1       ->execute(array($value_field));
    $row   =$stmt1 ->fetch();
    return $row;
  }

/*
===================
all faculties
===================
*/

function all_faculty(){
    global $con;
    $stmt = $con->prepare("SELECT faculty.* , university.name AS university_name
    FROM faculty 
    INNER JOIN university
    ON faculty.university_id = university.id
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}

/*
===================
all payments_requests
===================
*/

function payments_requests(){
    global $con;
    $stmt = $con->prepare("SELECT payment_request.* , students.student_name AS student_name , students.email AS student_email , students.id AS student_id , students.phone AS student_phone
    FROM payment_request 
    INNER JOIN students
    ON payment_request.student_id = students.id
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}


/*
===================
all faculty by university id
===================
*/

function all_faculty_by_university($university_id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM faculty WHERE university_id = ?");
    $stmt->execute(array($university_id));
    $rows = $stmt->fetchAll();
    return $rows;
}

/*
===================
all academic_years by faculty id
===================
*/

function all_academic_years_by_faculty($faculty_id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM academic_years WHERE faculty = ?");
    $stmt->execute(array($faculty_id));
    $rows = $stmt->fetchAll();
    return $rows;
}

/*
===================
all academic_years 
===================
*/

function academic_years(){
    global $con;
    $stmt = $con->prepare("SELECT academic_years.* , university.name AS university_name , faculty.name AS faculty_name
    FROM academic_years 
    INNER JOIN faculty
    ON academic_years.faculty = faculty.id
    INNER JOIN university
    ON university.id = faculty.university_id
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}


/*
===================
all subjects 
===================
*/

function all_subjects(){
    global $con;
    $stmt = $con->prepare("SELECT subjects.* , university.name AS university_name , faculty.name AS faculty_name , academic_years.name AS academic_years_name
    FROM subjects 
    INNER JOIN academic_years
    ON academic_years.id = subjects.academic_years
    INNER JOIN faculty
    ON academic_years.faculty = faculty.id
    INNER JOIN university
    ON university.id = faculty.university_id
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}



/*
==========================
    get blocked_students
==========================
*/

function blocked_students(){
    global $con;
    $stmt = $con->prepare("SELECT * FROM students WHERE blocked=1");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

/*
===================
all Courses
===================
*/

function all_courses(){
    global $con;
    $stmt = $con->prepare("SELECT courses.* , university.name AS university_name, faculty.name AS faculty_name , academic_years.name AS academic_years_name , subjects.name as subject_name , admins.admin_name
    FROM courses 
    INNER JOIN subjects
    ON subjects.id = courses.subject_id
    INNER JOIN academic_years
    ON academic_years.id = subjects.academic_years
    INNER JOIN faculty
    ON academic_years.faculty = faculty.id
    INNER JOIN university
    ON university.id = faculty.university_id
    INNER JOIN admins
    ON admins.id = courses.added_by
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}

/*
===================
all coupons
===================
*/

function all_coupons(){
    global $con;
    $stmt = $con->prepare("SELECT coupons.* , admins.admin_name
    FROM coupons 
    INNER JOIN admins
    ON admins.id = coupons.added_by
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}

/*
===================
all videos
===================
*/

function all_videos(){
    global $con;
    $stmt = $con->prepare("SELECT courses_videos.* , courses.name AS course_name , doctors.name AS course_doctor , university.name AS university_name, faculty.name AS faculty_name , academic_years.name AS academic_years_name , subjects.name as subject_name , admins.admin_name as admin_name , departments.dep_name as dep_name
    FROM courses_videos 
    INNER JOIN courses
    ON courses.id = courses_videos.course_id
    INNER JOIN admins
    ON admins.id = courses_videos.added_by
    INNER JOIN subjects
    ON subjects.id = courses.subject_id
    INNER JOIN academic_years
    ON academic_years.id = subjects.academic_years
    INNER JOIN faculty
    ON academic_years.faculty = faculty.id
    INNER JOIN university
    ON university.id = faculty.university_id
    INNER JOIN doctors
    ON doctors.id = courses.doctor
    INNER JOIN departments
    ON departments.id = courses_videos.dep_id
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}

/*
===================
all dep
===================
*/

function all_dep(){
    global $con;
    $stmt = $con->prepare("SELECT departments.* , courses.name AS course_name, admins.admin_name as admin_name
    FROM departments 
    INNER JOIN courses
    ON courses.id = departments.course_id
    INNER JOIN admins
    ON admins.id = departments.admin_id
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}


/*
===================
all All Student Videos
===================
*/

function getAllStudentVideos(){
    global $con;
    $stmt = $con->prepare("SELECT student_videos.* , courses_videos.video_name , courses_videos.id AS lecture_id,students.id AS student_id,students.student_name,students.phone , students.email ,courses.name AS course_name ,courses.doctor AS course_doctor ,university.name AS university_name, faculty.name AS faculty_name , academic_years.name AS academic_years_name , subjects.name as subject_name
    FROM student_videos 
    INNER JOIN courses_videos
    ON courses_videos.id = student_videos.video_id
    INNER JOIN courses
    ON courses.id = courses_videos.course_id
    INNER JOIN subjects
    ON subjects.id = courses.subject_id
    INNER JOIN academic_years
    ON academic_years.id = subjects.academic_years
    INNER JOIN faculty
    ON academic_years.faculty = faculty.id
    INNER JOIN university
    ON university.id = faculty.university_id
    INNER JOIN students
    ON students.id = student_videos.student_id
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}


/*
===================
all All Student Videos
===================
*/

function All_Gifted_videos(){
    global $con;
    $stmt = $con->prepare("SELECT student_videos.* , courses_videos.video_name ,students.student_name , students.email ,courses.name AS course_name ,courses.doctor AS course_doctor ,university.name AS university_name, faculty.name AS faculty_name , academic_years.name AS academic_years_name , subjects.name as subject_name
    FROM student_videos 
    INNER JOIN courses_videos
    ON courses_videos.id = student_videos.video_id
    INNER JOIN courses
    ON courses.id = courses_videos.course_id
    INNER JOIN subjects
    ON subjects.id = courses.subject_id
    INNER JOIN academic_years
    ON academic_years.id = subjects.academic_years
    INNER JOIN faculty
    ON academic_years.faculty = faculty.id
    INNER JOIN university
    ON university.id = faculty.university_id
    INNER JOIN students
    ON students.id = student_videos.student_id
    WHERE student_videos.admin_id != 0
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}


/*
===================
all All Student IPS
===================
*/

function all_student_ips(){
    global $con;
    $stmt = $con->prepare("SELECT student_ips.* ,students.* , students.id AS student_id
    FROM student_ips 
    INNER JOIN students
    ON students.id = student_ips.student_id
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}



/*
 ==========================  
      count bought videos
 ==========================
*/
function count_bought_videos($year_id){

    global $con;
    $stmt = $con->prepare("SELECT student_videos.* , courses_videos.video_name ,students.student_name , students.email ,courses.name AS course_name ,courses.doctor AS course_doctor ,university.name AS university_name, faculty.name AS faculty_name , academic_years.name AS academic_years_name , subjects.name as subject_name
    FROM student_videos 
    INNER JOIN courses_videos
    ON courses_videos.id = student_videos.video_id
    INNER JOIN courses
    ON courses.id = courses_videos.course_id
    INNER JOIN subjects
    ON subjects.id = courses.subject_id
    INNER JOIN academic_years
    ON academic_years.id = subjects.academic_years
    INNER JOIN faculty
    ON academic_years.faculty = faculty.id
    INNER JOIN university
    ON university.id = faculty.university_id
    INNER JOIN students
    ON students.id = student_videos.student_id
    WHERE student_videos.video_id = ?
    ");
    $stmt->execute(array($year_id));
    $count = $stmt->rowCount();
    return $count;
}

/*
 ==========================  
      count bought videos for academic years
 ==========================
*/
function count_bought_videos_for_academic_years($year_id){

    global $con;
    $stmt = $con->prepare("SELECT student_videos.* , courses_videos.video_name ,students.student_name , students.email ,courses.name AS course_name ,courses.doctor AS course_doctor ,university.name AS university_name, faculty.name AS faculty_name , academic_years.name AS academic_years_name , subjects.name as subject_name
    FROM student_videos 
    INNER JOIN courses_videos
    ON courses_videos.id = student_videos.video_id
    INNER JOIN courses
    ON courses.id = courses_videos.course_id
    INNER JOIN subjects
    ON subjects.id = courses.subject_id
    INNER JOIN academic_years
    ON academic_years.id = subjects.academic_years
    INNER JOIN faculty
    ON academic_years.faculty = faculty.id
    INNER JOIN university
    ON university.id = faculty.university_id
    INNER JOIN students
    ON students.id = student_videos.student_id
    WHERE academic_years.id = ?
    ");
    $stmt->execute(array($year_id));
    $count = $stmt->rowCount();
    return $count;
}

/*
 ==========================  
      count_video_by_course
 ==========================
*/
function count_video_by_course($course_id){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From courses_videos where course_id=?");
    $stmt->execute(array($course_id));
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      count videos
 ==========================
*/
function count_videos(){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From courses_videos");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}


/*
 ==========================  
      count admins
 ==========================
*/
function count_all_admins(){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From admins");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      count messages
 ==========================
*/
function count_all_messages(){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From contact");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      count roles
 ==========================
*/
function count_all_roles(){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From roles");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      count courses
 ==========================
*/
function count_courses(){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From courses");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}


/*
 ==========================  
      count students
 ==========================
*/
function count_students(){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From students");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}
/*
 ==========================  
      count students
 ==========================
*/
function count_faculty(){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From faculty");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}








/*
==========================
  insert new blood type
==========================
*/

function insert_blood($name){
    global $con;
    $stmt = $con->prepare("INSERT INTO blood_type(name) Value(:name)");
    $stmt->execute(
    array(
        ":name"     => $name,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة فصيلة الدم بنجاح')
    </script>";
    header("Refresh:3;url=all_blood_vaccine.php?to=add_blood"); 
}
/*
==========================
  insert new Vaccine Name   < Reham >
==========================
*/

function insert_vaccine_name($sname,$tname)               
{
    global $con;
    $stmt = $con->prepare("INSERT INTO vaccines(scientific_name,trade_name) 
    Value(:scientific_name,:trade_name)");
    $stmt->execute(
    array(
        ":scientific_name"         => $sname,
        ":trade_name"              => $tname
    ));
    
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة اسم لقاح بنجاح')
    </script>";
    header("Refresh:3;url=all_blood_vaccine.php?to=vaccine_name"); 
}
/*
==========================
  insert new Vaccine     < Reham >
==========================
*/

function insert_vaccine($vac_name_id,$country,$place,$amount,$price,$admin_ssn)               
{
    global $con;
    $stmt = $con->prepare("INSERT INTO avilable_vaccines(vaccine_id,country_id,vaccine_place_id,amount,price,admin_ssn) 
    Value(:vaccine_id,:country_id,:vaccine_place_id,:amount,:price,:admin_ssn)");
    $stmt->execute(
    array(
        ":vaccine_id"               => $vac_name_id,
        ":country_id"               => $country,
        ":vaccine_place_id"         => $place,
        ":amount"                   => $amount,
        ":price"                    => $price,
        ":admin_ssn"                => $admin_ssn,
    ));
    
    echo "
    <script>
        toastr.success('تم بنجاح :- تم اضافة مكان القاح بنجاح')
    </script>";
    header("Refresh:3;url=available_vaccines.php"); 
}
/*
==========================
  check if user exist
==========================
*/

function check_user ( $email , $hased){
    global $con;
    $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute(array($email));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count){
        if( $rows['password'] == $hased ){
            $_SESSION['userid']    = $rows['id'];
            $_SESSION['admin_first_name']  = $rows['username'];
            $_SESSION['useremail'] = $rows['email'];
            $_SESSION['reg_state'] = $rows['reg_state'];
            echo "
            <script>
                toastr.success('Welcome Back " . $_SESSION['username'] . " .')
            </script>";

            if($rows['reg_state'] == "0"){
                header("Refresh:3;url=user_home.php");
            }else{
                header("Refresh:3;url=seller_profile.php");
            }

        }
        else{
            echo "
            <script>
                toastr.error('Sorry Your Email OR Password is not Correct.')
              </script>";
        }
    }
    else{
            echo "
            <script>
                toastr.error('Sorry Your Email OR Password is not Correct.')
              </script>";
        }
}


/*
==========================
  get all patient data 
==========================
*/
function patient_data(){
    global $con;
    $stmt = $con->prepare("SELECT patients_donors.p_ssn as p_ssn ,patients_donors.p_first_name as f_name ,patients_donors.p_last_name as l_name ,patients_donors.email as email ,patients_donors.birthday as age ,patients_donors.mobile_phone as tel1 ,patients_donors.home_phone as tel2 ,blood_type.name as blood,gender.type as gender,governorate.name as gov,cities.name as city,patient_diseases.disiease_id  as disiease_id ,diseases.diseases as diseases
    FROM patients_donors 
    JOIN patient_diseases
    ON ( patients_donors.p_ssn  = patient_diseases.p_ssn  )
    JOIN blood_type
    ON ( patients_donors.blood_type = blood_type.id )
    JOIN gender
    ON ( patients_donors.gender_id  = gender.id )
    JOIN cities
    ON ( patients_donors.city_id  = cities.id )
    JOIN governorate
    ON ( cities.gov_id  = governorate.id )
    JOIN diseases
    ON ( diseases.id = patient_diseases.disiease_id  )
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}



/*
==========================
  count
==========================
*/

function count_data($colume,$databname){
    global $con;
    $stmt = $con->prepare("SELECT COUNT($colume) From $databname");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}



/*IMPORTANT !!! SN = 636f6465206279203a20416d722d4d6f68616d65642d4569737361 */


/*
==========================  
  select_member_by_id
==========================
*/
function select_member_by_id($table ,$value_field){
    global $con;
    $stmt1       = $con->prepare("SELECT * FROM $table where `id`=?") ;
    $stmt1       ->execute(array($value_field));
    $row   =$stmt1 ->fetch();
    return $row;
  }
  /*
==========================  
  select_by_id
==========================
*/
function select_by_id($table ,$value_field){
    global $con;
    $stmt1       = $con->prepare("SELECT * FROM $table where `id`=?") ;
    $stmt1       ->execute(array($value_field));
    $row   =$stmt1 ->fetch();
    return $row;
  }

    /*
==========================  
  get id of vaccine
==========================
*/
function get_vaccine_id($tname){
    global $con;
    $stmt1       = $con->prepare("SELECT * FROM vaccines where `trade_name`=?") ;
    $stmt1       ->execute(array($tname));
    $row   =$stmt1 ->fetch();
    return $row;
  }
  /*
==========================  
  select_user_by_ssn
==========================
*/
function select_user_by_id($table ,$value_field){
    global $con;
    $stmt1       = $con->prepare("SELECT * FROM $table where `p_ssn`=?") ;
    $stmt1       ->execute(array($value_field));
    $row   =$stmt1 ->fetch();
    return $row;
  }
 /*
==========================  
  select_goinng donners
==========================
*/
function select_donners($table ,$id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM $table WHERE request_id = ?");
    $stmt->execute(array($id));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
  }
/*
   ==========================  
        delete_by_id
   ==========================
*/
function delete_by_id($table ,$id_user){
    global $con;
     $stmt1 = $con -> prepare("DELETE FROM $table WHERE `id`=:id");
     $stmt1->bindParam(":id",$id_user);
     $stmt1->execute();
   }
/*=====================end_members_function=============================*/

/*
   ==========================  
        edit admin 
   ==========================
*/
function editAdmin($name,$email, $hashed, $reg_state,$id){
    global $con;
    $stmt=$con->prepare ("UPDATE admins SET `name`=?,`email`=?, `password`=?,`role`=? WHERE `id`=?");
    $stmt->execute(array($name,$email, $hashed, $reg_state,$id));
    echo "
    <script>
        toastr.success('Great ,successfully: Edited Admin .')
    </script>";
    header("Refresh:3;url=all_admins.php"); 
}



/*
==========================  
  select All Admins
==========================
*/
function select_Admins(){
    global $con;
    $stmt = $con->prepare("SELECT * FROM admins");
    $stmt->execute();
    $row   =$stmt ->fetchAll(PDO::FETCH_ASSOC);
    return $row;
  }

  /*
==========================  
count Rows from Database By/ Amr Mohamed
==========================
*/

function count_users($colume,$databname){
    global $con;
    $stmt = $con->prepare("SELECT COUNT($colume) From $databname");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}


/*
==========================
    get all data
==========================
*/

function getAllRegData($table){
    global $con;
    $stmt = $con->prepare("SELECT * FROM $table ORDER BY id DESC");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

/*
===================
GET LAST
===================
*/

function get_last_MEMBER_ID(){
    global $con;
    $stmt = $con->prepare("SELECT * FROM id_form ORDER BY id DESC LIMIT 1");
    $stmt->execute();
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
}
/*
===================
all vaccines by id
===================
*/

function all_vaccines_by_id($vac_id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM vaccines WHERE id = ?");
    $stmt->execute(array($vac_id));
    $rows = $stmt->fetchAll();
    return $rows;
}
/*
===================
all vaccines requests
===================
*/

function all_vaccine_request(){
    global $con;
    $stmt = $con->prepare("SELECT order_vaccine.* , vaccines.scientific_name AS vaccine_scientific_name, vaccines.trade_name AS vaccine_trade_name, avilable_vaccines.amount AS avilable_vaccine , patients_donors.p_first_name AS patient_first_name , patients_donors.p_last_name AS patient_last_name , patients_donors.mobile_phone AS patient_phone 
    FROM order_vaccine 
    INNER JOIN avilable_vaccines
    ON avilable_vaccines.id = order_vaccine.vaccine_id
    INNER JOIN patients_donors
    ON patients_donors.p_ssn = order_vaccine.p_ssn
    INNER JOIN vaccines
    ON avilable_vaccines.vaccine_id = vaccines.id
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}



/*
===================
all purchase_orders
===================
*/

function all_purchase_orders(){
    global $con;
    $stmt = $con->prepare("SELECT purchase_order.* , blood_type.name AS blood_name ,avilable_blood.amount AS blood_amount , patients_donors.p_first_name AS patient_first_name , patients_donors.p_last_name AS patient_last_name , patients_donors.mobile_phone AS patient_phone 
    FROM purchase_order 
    INNER JOIN avilable_blood
    ON avilable_blood.blood_type_id = purchase_order.blood_type
    INNER JOIN patients_donors
    ON patients_donors.p_ssn = purchase_order.p_id
    INNER JOIN blood_type
    ON avilable_blood.blood_type_id = blood_type.id
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}




/*
===================
all cities and governorates
===================
*/

function all_city_gov(){
    global $con;
    $stmt = $con->prepare("SELECT cities.* , governorate.name AS gov_name
    FROM cities 
    INNER JOIN governorate
    ON cities.gov_id = governorate.id
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}



/*
===================
all cities by id
===================
*/

function all_city_by_gov($gov_id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM cities WHERE gov_id = ?");
    $stmt->execute(array($gov_id));
    $rows = $stmt->fetchAll();
    return $rows;
}



/*
===================
all places by city_id
===================
*/

function all_places_by_city($city_id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM donate_places WHERE city_id = ?");
    $stmt->execute(array($city_id));
    $rows = $stmt->fetchAll();
    return $rows;
}



/*
==========================
  insert new donate place
==========================
*/

function insert_donate_place($name,$manager,$city_id,$start_at,$close_at,$holiday,$lat,$long){
    global $con;
    $stmt = $con->prepare("INSERT INTO donate_places(place_name,place_manager,city_id,open_at,close_at,holiday,lat,lng)
    Value(:name,:manager,:city_id,:start_at,:close_at,:holiday,:lat,:long)");
    $stmt->execute(
    array(
        ":name"                 => $name,
        ":manager"              => $manager,
        ":city_id"              => $city_id,
        ":start_at"             => $start_at,
        ":close_at"             => $close_at,
        ":holiday"              => $holiday,
        ":lat"                  => $lat,
        ":long"                 => $long,
    ));
    echo "
    <script>
        toastr.success('تمت اضافة مكان فرع بنك الدم بنجاح .')
    </script>";
    header("Refresh:3;url=all_donate_places.php"); 
    // echo $name . "<br>";
    // echo $manager . "<br>";
    // echo $city_id . "<br>";
    // echo $start_at . "<br>";
    // echo $close_at . "<br>";
    // echo $holiday . "<br>";
    // echo $lat . "<br>";
    // echo $long;

}


/*
==========================
  insert new donate reason
==========================
*/

function insert_reason($reason_name){
    global $con;
    $stmt = $con->prepare("INSERT INTO donate_reasons(reason)
    Value(:reason)");
    $stmt->execute(
    array(
        ":reason"                 => $reason_name,
    ));
    echo "
    <script>
        toastr.success('Great ,successfully: Reason added .')
    </script>";
    header("Refresh:3;url=all_reasons_request_type.php?to=reason"); 
}


/*
==========================
  insert new request type
==========================
*/

function insert_req_type($req_type){
    global $con;
    $stmt = $con->prepare("INSERT INTO request_blood_type(type)
    Value(:req_type)");
    $stmt->execute(
    array(
        ":req_type"                 => $req_type,
    ));
    echo "
    <script>
        toastr.success('Great ,successfully: Request Type added .')
    </script>";
    header("Refresh:3;url=all_reasons_request_type.php"); 
}

/*
 ==========================  
      update reasons        
 ==========================
*/
function  update_reason($reason,$id){
    global $con;
   $stmt= $con->prepare ("UPDATE donate_reasons SET `reason`=?WHERE `id`=?");
   $stmt ->execute(array(
       $reason,$id));
       echo "
       <script>
       toastr.success('تم بنجاح :- تم تعديل سبب التبرع بنجاح')
       </script>";
       header("Refresh:2;url=all_reasons_request_type.php?to=reason"); 
  }

/*
 ==========================  
      update request type        
 ==========================
*/
function update_req_type($req_type,$req_id){
    global $con;
   $stmt= $con->prepare ("UPDATE request_blood_type SET `type`=? WHERE `id`=?");
   $stmt ->execute(array(
       $req_type,$req_id));
       echo "
       <script>
       toastr.success('تم بنجاح :- تم تعديل نوع طلب التبرع بنجاح')
       </script>";
       header("Refresh:2;url=all_reasons_request_type.php"); 
  }
  
/*
==========================
  insert news
==========================
*/

function insert_news($title,$desc,$avatar,$admin_ssn){
    global $con;
    $stmt = $con->prepare("INSERT INTO blog(title,content,img,admin_ssn)
    Value(:title,:desc,:image,:admin_ssn)");
    $stmt->execute(
    array(
        ":title"                    => $title,
        ":desc"                     => $desc,
        ":image"                    => $avatar,
        ":admin_ssn"                => $admin_ssn,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح : تم اضافة الخبر بنجاح.')
    </script>";
    header("Refresh:3;url=all_news.php"); 
}


/*
 ==========================  
      update news
 ==========================
*/
function update_news($title,$desc,$img,$admin_ssn,$news_id){
    global $con;
   $stmt= $con->prepare ("UPDATE blog SET `title`=? , `content`=? , `img`=? , `admin_ssn`=? WHERE `id`=?");
   $stmt ->execute(array(
       $title,$desc,$img,$admin_ssn,$news_id));
       echo "
       <script>
       toastr.success('تم بنجاح :- تم تعديل الخبر بنجاح')
       </script>";
       header("Refresh:2;url=all_news.php"); 
  }
  
    
/*
==========================image.png
  insert news
==========================
*/
function insert_api_user($user_name,$auth_code,$admin_ssn){
    global $con;
    $stmt = $con->prepare("INSERT INTO api_users(user_name,auth_code,admin_ssn)
    Value(:user_name,:auth_code,:admin_ssn)");
    $stmt->execute(
    array(
        ":user_name"                     => $user_name,
        ":auth_code"                     => $auth_code,
        ":admin_ssn"                     => $admin_ssn,
    ));
    echo "
    <script>
        toastr.success('تم بنجاح : تم اضافة مستخدم البيانات بنجاح.')
    </script>";
    header("Refresh:3;url=all_api_users.php"); 
}

/*
===================
all api users
===================
*/

function all_api_users(){
    global $con;
    $stmt = $con->prepare("SELECT api_users.* , admins.admin_first_name AS f_name, admins.admin_last_name AS l_name 
    FROM api_users 
    INNER JOIN admins
    ON api_users.admin_ssn = admins.admin_ssn
    ");
    $stmt->execute();
    $rows = $stmt->fetchAll();
    return $rows;
}


/*
 ==========================  
      update api user
 ==========================
*/
function update_api_user($user_name,$auth_code,$admin_ssn,$api_user_id){
    global $con;
   $stmt= $con->prepare ("UPDATE api_users SET `user_name`=? , `auth_code`=? , `admin_ssn`=? WHERE `id`=?");
   $stmt ->execute(array(
       $user_name,$auth_code,$admin_ssn,$api_user_id));
       echo "
       <script>
       toastr.success('تم بنجاح :- تم تعديل مستخدم البيانات بنجاح')
       </script>";
       header("Refresh:2;url=all_api_users.php"); 
  }
  

/*
 ==========================  
      count blood bags with blood_type
 ==========================
*/
function count_blood_bags($blood_type){
    global $con;
    $stmt = $con->prepare("SELECT SUM(amount) From avilable_blood
    WHERE blood_type_id = ? ");
    $stmt->execute(array($blood_type));
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      count blood bags
 ==========================
*/
function count_all_blood_bags(){
    global $con;
    $stmt = $con->prepare("SELECT SUM(amount) From avilable_blood");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}
  

/*
 ==========================  
      count vaccines with vaccine id
 ==========================
*/
function count_vaccine($vaccine_type){
    global $con;
    $stmt = $con->prepare("SELECT SUM(amount) From avilable_vaccines
    WHERE vaccine_id = ? ");
    $stmt->execute(array($vaccine_type));
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      count vaccines
 ==========================
*/
function count_all_vaccine(){
    global $con;
    $stmt = $con->prepare("SELECT SUM(amount) From avilable_vaccines");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      count patients_donners
 ==========================
*/
function count_all_patients_donners(){
    global $con;
    $stmt = $con->prepare("SELECT count(p_ssn) From patients_donors");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}

/*
 ==========================  
      count hospitals
 ==========================
*/
function count_all_donate_places(){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From donate_places");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}


/*
 ==========================  
      count payments
 ==========================
*/
function count_all_payments(){
    global $con;
    $stmt = $con->prepare("SELECT count(id) From payments");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}
