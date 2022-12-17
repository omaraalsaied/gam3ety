<?php
session_start();
ob_start(); 
if(isset($_SESSION['admin_id'])){ 

 
// ================== start Add Role page ======================

if(isset($_GET['to']) && strlen($_GET['to'])==14 && $_GET['to'] = "academic_years"){
$page_name = " - اضافة سنه دراسيه";
$script = "add_academic_year.js";
include 'init.php';
$role_data = getData_with_id('roles',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
require './layout/topNav.php';
if(in_array("add_academic_years",$roles)){

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $faculty            = FILTER_VAR( $_POST['faculty'], FILTER_SANITIZE_NUMBER_INT);
    $academic_year      = FILTER_VAR( $_POST['academic_year'], FILTER_SANITIZE_STRING);

    $formErrors = array ();
    if(empty($academic_year)||strlen($academic_year)<3 ){
        $formErrors[] = "
        <script>
            toastr.error('من فضلك تاكد من ادخال اسم السنه الدراسيه بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
        </script>";
        $name_error="border border-danger";
    }
    if(empty($formErrors)){
        /*check if info already added*/

        global $con;
        $stmt = $con->prepare("SELECT * FROM academic_years WHERE name = ? AND faculty=? ");
        $stmt->execute(array($academic_year,$faculty));
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if ($count){
            echo "
                <script>
                    toastr.error('عفوا .. اسم السنه الدراسيه المسجله موجوده بالفعلا مسبقا')
                </script>";
        }
        else{
            insert_academic_year($faculty,$academic_year);
        }  
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
                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة سنه دراسيه جديده للنظام</p>
                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
                
                    <div style="direction: rtl !important;text-align: right;" class="row m-2 text-center">
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
                            <!--academic year-->
                            <div class="col-md-6 mb-3 col-xs-12 m-auto">
                                <label for="academic_year">الفرقة الدراسيه</label>
                                <select class="<?php echo $year_error;?> custom-select ui search dropdown" name="academic_year" id="academic_year">
                                    <option selected disabled value="">...اختر</option>
                                    <option value="الفرقة الاولي">الفرقة الاولي</option>
                                    <option value="الفرقة الثانيه">الفرقة الثانيه</option>
                                    <option value="الفرقة الثالثه">الفرقة الثالثه</option>
                                    <option value="الفرقة الرابعه">الفرقة الرابعه</option>
                                </select>
                            </div>
    
                                            


                    </div>

                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">اصافة الي السنوات الدراسيه</button>
                </form>
                </div>
            </div>
      </div>
    </div>
</div>
<?php
// ================== End Add Role page ======================
}else{
    echo "
    <script>
    toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
    </script>";
    header("Refresh:1;url=admin_dash.php");
}

// ================== Start add admin page ===================

}else{
$page_name = " - اضافة ماده دراسيه";
$script = "add_subject.js";
include 'init.php';
$role_data = getData_with_id('roles',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
// if(isset($_SESSION['role'])){
require './layout/topNav.php';
$all_university_data = getAllData("university");

//password_verify($pass,$rows['password'])
if(in_array("add_subject",$roles)){

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        @$subject            = FILTER_VAR( $_POST['subject'], FILTER_SANITIZE_STRING);
        @$academic_year            = FILTER_VAR( $_POST['academic_year'], FILTER_SANITIZE_NUMBER_INT);

            $formErrors = array ();
            // check the name
            if(empty($subject)||strlen($subject)<3 ){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال اسم الكلية بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
                </script>";
                $subject_error="border border-danger";
            }
            // check the academic_year
            if(empty($academic_year)){
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
            // check the FACULTY
            if(empty($_POST['faculty'])){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من اختيارك للكليه')
                </script>";
                $faculty_error="border border-danger";
            }




            if(empty($formErrors)){
                /*check if info already added*/
        
                global $con;
                $stmt = $con->prepare("SELECT * FROM subjects WHERE name = ? AND academic_years = ?");
                $stmt->execute(array($subject,$academic_year));
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                $count = $stmt->rowCount();
                if ($count){
                    echo "
                        <script>
                            toastr.error('عفوا .. الماده الدراسيه المسجله موجوده بالفعلا مسبقا')
                        </script>";
                }
                else{
                    insert_subject($subject,$academic_year);             
                }  
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
                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة ماده دراسيه جديده للنظام</p>
                <form method="POST" style="margin-bottom: 50px;" action="<?php $_SERVER['PHP_SELF'] ?>" >
                
                    <div style="direction: rtl !important;text-align: right;" class="row m-2">
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
                            <!--subject-->
                            <div class="col-md-6 col-xs-12">
                                <label for="subject">اسم الماده الدراسيه</label>
                                <input type="text" class="form-control <?php echo $subject_error;?>" id="subject" 
                                    placeholder="ادخل اسم الماده الدراسيه" value="<?php if(isset($subject)){ echo $subject;} ?>" name="subject" autocomplete="off">
                            </div>

                    </div>
                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">اصافة الي المواد</button>
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
}}





    require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
    ob_end_flush();?>
