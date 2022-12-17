<?php
session_start();
ob_start(); 
if(isset($_SESSION['admin_id'])){ 
$page_name = " - اضافة قسم جديد";
$script = "add_courses.js";
include 'init.php';
$role_data = getData_with_id('roles',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
// if(isset($_SESSION['role'])){
require './layout/topNav.php';
$all_courses = all_courses();

//password_verify($pass,$rows['password'])
if(in_array("add_dep",$roles)){

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        @$dep_name                  = FILTER_VAR( $_POST['dep_name'], FILTER_SANITIZE_STRING);
        @$course                    = FILTER_VAR( $_POST['course'], FILTER_SANITIZE_NUMBER_INT);
        $avatar_name = $_FILES["img"]["name"];
        $size = $_FILES["img"]["size"];
        $tmp_name = $_FILES["img"]["tmp_name"];
        $type = $_FILES["img"]["type"];
        $extention_allowed = array("png","jpg","jpeg","svg","webp");   
        @$extention             = strtolower(end(explode(".",$avatar_name)));



        $formErrors = array ();


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

        global $con;
        $stmt = $con->prepare("SELECT * FROM departments WHERE dep_name = ? AND course_id=?");
        $stmt->execute(array($dep_name,$course));
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if ($count){
            echo "
                <script>
                    toastr.error('عفوا .. اسم القسم والكورس المسجل موجودين بالفعل')
                </script>";
        }
        else{
            add_department($dep_name,$course,$avatar,$_SESSION['admin_id']); 
            move_uploaded_file($tmp_name,$destination);            
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
                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة قسم جديده للنظام</p>
                <form method="POST" style="margin-bottom: 50px;" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                
                    <div style="direction: rtl !important;text-align: right;" class="row m-2 pb-3">
                        <!--dep_name-->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="dep_name">اسم القسم</label>
                            <input type="text" class="form-control <?php echo $dep_name_error;?>" id="dep_name" 
                                placeholder="ادخل اسم القسم" value="<?php if(isset($dep_name)){ echo $dep_name;} ?>" name="dep_name" autocomplete="off">
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

                        <!--img-->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="img">صورة القسم</label>
                            <input type="file" class="form-control" required style="padding-bottom: 32px;" id="img" name="img" >
                        </div>
                       
                    </div>
                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">اصافة الي الاقسام</button>
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
