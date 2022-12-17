<?php
session_start();
ob_start();
if(isset($_SESSION['admin_id'])){ 
// ================== start update courses page ======================
  $page_name = " - تعديل الاقسام";
  $script = "add_courses.js";
  include 'init.php';

  require './layout/topNav.php';
  $dep_id = $_GET['id'];
  $department_data = getData_with_id("departments",$dep_id);
  $all_courses = all_courses();
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    @$dep_name                = FILTER_VAR( $_POST['dep_name'], FILTER_SANITIZE_STRING);
    @$course                    = FILTER_VAR( $_POST['course'], FILTER_SANITIZE_NUMBER_INT);
    $formErrors = array ();

    $extention_allowed = array("png","jpg","jpeg","svg","webp","");   
    @$extention             = strtolower(end(explode(".",$_FILES["img"]["name"])));

// check the name
if(empty($dep_name)||strlen($dep_name)<3 ){
$formErrors[] = "
<script>
    toastr.error('من فضلك تاكد من ادخال اسم القسم بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
</script>";
$dep_name_error="border border-danger";
}

// check the course
if(empty($_POST['course'])){
$formErrors[] = "
<script>
    toastr.error('من فضلك تاكد من اختيارك لاسم الكورس')
</script>";
$course_error="border border-danger";
}



if(in_array($extention,$extention_allowed)){
    $avatar = time() . "." . $extention;
    $destination = "img/departments/" . $avatar ;
  if(empty($formErrors)){
    if(empty($_FILES["img"]["name"])){
        update_dep($dep_name,$course,$department_data["img"],$_SESSION['admin_id'],$dep_id);  

    }else{
        $avatar_name = $_FILES["img"]["name"];
        $size = $_FILES["img"]["size"];
        $tmp_name = $_FILES["img"]["tmp_name"];
        $type = $_FILES["img"]["type"];

        @unlink("img/departments/" . $department_data["img"]);
        move_uploaded_file($tmp_name,$destination);
        update_dep($dep_name,$course,$avatar,$_SESSION['admin_id'],$dep_id);  

    }  
    }
}else{
    echo "
    <script>
        toastr.error('امتداد الصوره غير مسموح به .. الامتدادات المسموحه (png,jpg,jpeg,svg,webp')
    </script>";
}  



      if (isset($formErrors)){ 
      foreach($formErrors as $error){
          echo $error;
      }
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
                  <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك تعديل بيانات الاقسام</p>
                  <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                        <div style="direction: rtl !important;text-align: right;" class="row m-2 pb-3">
                                <!--dep_name-->
                                <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                                    <label for="dep_name">اسم القسم</label>
                                    <input type="text" class="form-control <?php echo $dep_name_error;?>" id="dep_name" 
                                        placeholder="ادخل اسم القسم" value="<?php if(isset($dep_name)){ echo $dep_name;}else{echo $department_data["dep_name"];} ?>" name="dep_name" autocomplete="off">
                                </div>


                                <!--course--->
                                <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                                    <label for="course">الكورس</label>
                                    <select class="<?php echo $course_error;?> custom-select ui search dropdown" name="course" id="course">
                                        <option selected disabled value="">...اختر</option>
                                        <?php foreach($all_courses as $course_data){ ?>
                                            <option value="<?php echo $course_data["id"];?>"><?php echo "جامعة " . $course_data["university_name"] . " - كلية " . $course_data["faculty_name"] . " - " . $course_data["academic_years_name"] . " - " . $course_data["subject_name"] . " - " . $course_data["name"]; ?></option>
                                            <?php } ?>
                                        </select>
                                </div>

                                <!--department image--->
                                <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                                    <label for="img">صورة القسم</label>
                                    <input type="file" class="form-control" style="padding-bottom: 32px;" id="img" name="img" >
                                </div>
                                
                            </div>
  
                      <!--btn -> add--->
                      <button class="btn btn-primary d-block m-auto mt-5">تعديل اسم القسم</button>
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