<?php
session_start();
ob_start();
if(isset($_SESSION['admin_id'])){ 
// ================== start update courses page ======================
  $page_name = " - تعديل الكورسات";
  $script = "add_courses.js";
  include 'init.php';

  require './layout/topNav.php';
  $course_id = $_GET['id'];
  $course_data = getData_with_id("courses",$course_id);
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      $course               = FILTER_VAR( $_POST['course'], FILTER_SANITIZE_STRING);
      $doctor               = FILTER_VAR( $_POST['doctor'], FILTER_SANITIZE_NUMBER_INT);
      $subject              = FILTER_VAR( $_POST['subject'], FILTER_SANITIZE_NUMBER_INT);

      $extention_allowed = array("png","jpg","jpeg","svg","webp","");   
      @$extention             = strtolower(end(explode(".",$_FILES["img"]["name"])));
    
      $formErrors = array ();
      if(empty($course)||strlen($course)<3 ){
          $formErrors[] = "
          <script>
              toastr.error('من فضلك تاكد من ادخال اسم السنه الدراسيه بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
          </script>";
          $course_error="border border-danger";
      }
      if(empty($doctor)){
          $formErrors[] = "
          <script>
              toastr.error('من فضلك تاكد من ادخال اسم السنه الدراسيه بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
          </script>";
          $doctor_error="border border-danger";
      }
      if(empty($subject)){
        $formErrors[] = "
        <script>
            toastr.error('من فضلك تاكد من اختيارك للكليه')
        </script>";
        $subject_error="border border-danger";
    }

    if(in_array($extention,$extention_allowed)){
        $avatar = time() . "." . $extention;
        $destination = "img/courses/" . $avatar ;
      if(empty($formErrors)){
        if(empty($_FILES["img"]["name"])){
            update_course($course,$doctor,$course_data["img"],$subject,$_SESSION["admin_id"],$course_id);
        }else{
            $avatar_name = $_FILES["img"]["name"];
            $size = $_FILES["img"]["size"];
            $tmp_name = $_FILES["img"]["tmp_name"];
            $type = $_FILES["img"]["type"];

            @unlink("img/courses/" . $course_data["img"]);
            move_uploaded_file($tmp_name,$destination);
            update_course($course,$doctor,$avatar,$subject,$_SESSION["admin_id"],$course_id);
        }  
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
                  <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك تعديل بيانات الكورسات</p>
                  <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>"  enctype="multipart/form-data">
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
                                        placeholder="ادخل اسم الكورس" value="<?php if(isset($course)){ echo $course;}else{echo $course_data["name"];} ?>" name="course" autocomplete="off">
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
                                    <input type="file" class="form-control" style="padding-bottom: 32px;" id="img" name="img" >
                                </div>

                            </div>
  
                      <!--btn -> add--->
                      <button class="btn btn-primary d-block m-auto mt-5">تعديل اسم الكورس</button>
                  </form>
                  </div>
              </div>
        </div>
      </div>
  </div>
  
<?php
require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();?>