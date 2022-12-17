<?php
session_start();
ob_start(); 
if(isset($_SESSION['admin_id'])){ 
$page_name = " - اضافة كورسات";
$script = "add_courses.js";
include 'init.php';
$role_data = getData_with_id('roles',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
// if(isset($_SESSION['role'])){
require './layout/topNav.php';
$all_university_data = getAllData("university");

//password_verify($pass,$rows['password'])
if(in_array("add_courses",$roles)){

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        @$course            = FILTER_VAR( $_POST['course'], FILTER_SANITIZE_STRING);
        @$subject            = FILTER_VAR( $_POST['subject'], FILTER_SANITIZE_NUMBER_INT);
        @$doctor            = FILTER_VAR( $_POST['doctor'], FILTER_SANITIZE_NUMBER_INT);
        $avatar_name = $_FILES["img"]["name"];
        $size = $_FILES["img"]["size"];
        $tmp_name = $_FILES["img"]["tmp_name"];
        $type = $_FILES["img"]["type"];
        $extention_allowed = array("png","jpg","jpeg","svg","webp");   
        @$extention             = strtolower(end(explode(".",$avatar_name)));
            $formErrors = array ();
            // check the name
            if(empty($course)||strlen($course)<3 ){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال اسم الكلية بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
                </script>";
                $course_error="border border-danger";
            }
            // check the doctor
            if(empty($doctor)){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال اسم الدكتور بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
                </script>";
                $doctor_error="border border-danger";
            }
            // check the academic_year
            if(empty($_POST['academic_year'])){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من اختيارك للعام الاكاديمي')
                </script>";
                $academic_year_error="border border-danger";
            }
            // check the university
            if(empty($_POST['university'])){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من اختيارك للجامعه')
                </script>";
                $university_error="border border-danger";
            }
            // check the university
            if(empty($_POST['subject'])){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من اختيارك للماده الدراسيه')
                </script>";
                $subject_error="border border-danger";
            }
            // check the FACULTY
            if(empty($_POST['faculty'])){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من اختيارك للكليه')
                </script>";
                $faculty_error="border border-danger";
            }



            if(in_array($extention,$extention_allowed)){
                $avatar = time() . "." . $extention;
                $destination = "img/courses/" . $avatar ;
                if(empty($formErrors)){
                    insert_course($course,$subject,$doctor,$_SESSION["admin_id"],$avatar);     
                    move_uploaded_file($tmp_name,$destination);        
                }
            }else{
                echo "
                <script>
                    toastr.error('امتداد الصوره غير مسموح به .. الامتدادات المسموحه (png,jpg,jpeg,svg,webp')
                </script>";
            }  
            }

        if (isset($formErrors)){ 
            foreach($formErrors as $error){
                echo $error;
            }
        }

?>
<div id="layoutSidenav">     
    <?php 
      require './layout/sidNav.php';
    ?> 
    <div id="layoutSidenav_content">
        <div class="container-fluid ">
            <div class="allContent">
            <div class="container mainAddForm">
                <img class="addMemberMainImg pt-5 mb-4" style="width: 80px;margin: auto;display: block;" src="img/addMember.png">
                <p class="firstParagraph text-center">اهلا بك في لوحة التحكم الخاصة بالنظام</p>
                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة كوسات جديده للنظام</p>
                <form method="POST" style="margin-bottom: 50px;" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                
                    <div style="direction: rtl !important;text-align: right;" class="row m-2 pb-3">
                        <!--university--->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="university">الجامعه</label>
                            <select class="<?php echo $university_error;?> custom-select ui search dropdown" name="university" id="university">
                                <option selected disabled value="">...اختر</option>
                                <?php $all_university_data = getAllData("university"); foreach($all_university_data as $university_data){ ?>
                                    <option value="<?php echo $university_data["id"];?>"><?php echo "جامعة " . $university_data["name"]; ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                        <!--faculty--->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="faculty">الكلية</label>
                            <select class="<?php echo $faculty_error;?> custom-select ui search dropdown" name="faculty" id="faculty">
                            <option selected disabled value="">...اختر</option>
                               
                                </select>
                        </div>
                        <!--academic_year--->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="academic_year">السنه الدراسيه</label>
                            <select class="<?php echo $academic_year_error;?> custom-select ui search dropdown" name="academic_year" id="academic_year">
                            <option selected disabled value="">...اختر</option>
                               
                                </select>
                        </div>
                        <!--subject--->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="subject">الماده الدراسيه</label>
                            <select class="<?php echo $subject_error;?> custom-select ui search dropdown" name="subject" id="subject">
                            <option selected disabled value="">...اختر</option>
                               
                                </select>
                        </div>
                        <!--subject-->
                        <div class="col-md-6 col-xs-12">
                            <label for="course">اسم الكورس</label>
                            <input type="text" class="form-control <?php echo $course_error;?>" id="course" 
                                placeholder="ادخل اسم الكورس" value="<?php if(isset($course)){ echo $course;} ?>" name="course" autocomplete="off">
                        </div>
                        <!--doctor-->

                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="doctor">اسم الدكتور</label>
                            <select class="<?php echo $doctor_error;?> custom-select ui search dropdown" name="doctor" id="doctor">
                            <option selected disabled value="">...اختر</option>
                                    <?php $all_doctors = getAllData("doctors"); foreach($all_doctors as $doctor_data){ ?>
                                        <option value="<?php echo $doctor_data["id"];?>"><?php echo "دكتور /  " . $doctor_data["name"] . " - " . $doctor_data["position"]; ?></option>
                                    <?php } ?>
                               
                                </select>
                        </div>
                       

                        <!--img-->
                        <div style="margin-bottom: 30px !important;margin-top: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12 m-auto">
                            <label for="img">صورة الكورس</label>
                            <input type="file" class="form-control" required style="padding-bottom: 32px;" id="img" name="img" >
                        </div>
                    </div>
                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">اصافة الي الكورسات</button>
                </form>
                </div>
            </div>
      </div>
    </div>
</div>



<?php 
}else{
    echo "
    <script>
    toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
    </script>";
    header("Refresh:1;url=admin_dash.php");
}





require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
    ob_end_flush();?>
