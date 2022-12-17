<?php
session_start();
ob_start(); 
if(isset($_SESSION['admin_id'])){ 
$style="addMember.css";

 
// ================== start Add Role page ======================

if(isset($_GET['to']) && strlen($_GET['to'])==4 && $_GET['to'] = "role"){
$page_name = " - اضافة صلاحيه";
include 'init.php';
$role_data = getData_with_id('roles',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
require './layout/topNav.php';
if(in_array("add_role",$roles)){

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name      = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
    $roles      = $_POST['roles'];
    $roles_ex = implode("/",$roles);
    $formErrors = array ();
    if(empty($name)||strlen($name)<3 ){
        $formErrors[] = "
        <script>
            toastr.error('من فضلك تاكد من ادخال اسم الصلاحيه بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
        </script>";
        $name_error="border border-danger";
    }
    if(empty($formErrors)){
        /*check if info already added*/

        global $con;
        $stmt = $con->prepare("SELECT * FROM roles WHERE role_name = ?");
        $stmt->execute(array($name));
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
        $count = $stmt->rowCount();
        if ($count){
            echo "
                <script>
                    toastr.error('عفوا .. اسم الصلاحيه المسجله موجوده بالفعلا مسبقا')
                </script>";
        }
        else{
            insert_role($name,$roles_ex);
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
                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة صلاحية جديده للنظام</p>
                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
                
                    <div style="direction: rtl !important;text-align: right;" class="row m-2">
                    <!--User Name-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label for="Name">اسم الصلاحيه</label>
                            <input type="text" class="form-control <?php echo $name_error;?>" id="Name" 
                                placeholder="ادخل اسم الصلاحيه" value="<?php if(isset($name)){ echo $name;} ?>" name="name" autocomplete="off">
                        </div>

                        <div style="direction: ltr;" class="col-md-6 mb-3 col-xs-12">
                            <label for="Name">الصلاحيات</label>
                            <select name="roles[]" class="ui fluid search dropdown" multiple="">

                                <option value="">الصلاحيات</option>
                                <option value="add_admin">اضافة مسئول</option>
                                <option value="all_admin">تعديل وحزف مسئول</option>
                                <option value="add_role">اضافة صلاحيه</option>
                                <option value="all_role">تعديل / حذف صلاحيه</option>
                                <option value="add_university">اضافة جامعه</option>
                                <option value="all_universities">تعديل / حذف جامعه</option>
                                <option value="add_faculty">اضافة كلية</option>
                                <option value="all_faculties">تعديل / حذف كلية</option>
                                <option value="add_academic_years">اضافة سنة دراسيه</option>
                                <option value="all_academic_years">تعديل / حذف سنة دراسيه</option>
                                <option value="add_subject">اضافة ماده دراسيه</option>
                                <option value="all_subjects">تعديل / حذف ماده دراسيه</option>
                                <option value="add_courses">اضافة كوسات</option>
                                <option value="all_courses">تعديل / حذف كوسات</option>
                                <option value="add_dep">اضافة قسم</option>
                                <option value="all_dep">تعديل / حذف قسم</option>
                                <option value="add_videos">اضافة فيديوهات</option>
                                <option value="all_videos">تعديل / حذف فيديوهات</option>
                                <option value="add_doctor">اضافة دكتور</option>
                                <option value="all_doctors">تعديل / حذف دكتور</option>
                                <option value="add_coupone">اضافة كوبون خصم</option>
                                <option value="all_coupone">تعديل / حذف كوبون خصم</option>
                                <option value="all_students">جميع المستخدمين</option>               
                                <option value="all_activation_codes">جميع اكواد التاكيد</option>     
                                <option value="all_forgetpassword_codes">جميع اكواد نسيان كلمة السر</option>               
                                <option value="all_payments_requests">جميع اكواد نسيان كلمة السر</option>               
                                <option value="all_blocked_students">المستخدمين المحظورين</option>               
                                <option value="all_students_videos">جميع فيديوهات المستخدمين</option>               
                                <option value="all_gifted_videos">جميع الفيديوهات المهداه</option>               
                                <option value="gift_video">اهداء فيديو</option>               
                                <option value="all_videos_statistics">مرات شراء الفيديوهات</option>               
                                <option value="all_years_sold_videos">الفيديوهات المباعه في السنين الدراسيه</option>               
                                <option value="all_students_ips">اجهزة المسجله بواسطة الطلاب</option>               
                                <option value="order_pdf">تسليم المحاضرات المطبعوعه</option>
                                <option value="payments">عمليات الدفع</option>
                                <option value="contact_request">طلبات المراسله</option>
                            </select>
                        </div>
                    </div>

                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">اصافة الي الصلاحيات</button>
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
$page_name = " - اضافة مسئول";
$script = "add_admin.js";
include 'init.php';
$role_data = getData_with_id('roles',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
// if(isset($_SESSION['role'])){
require './layout/topNav.php';
$all_role_data = getAllData("roles");

//password_verify($pass,$rows['password'])
if(in_array("add_admin",$roles)){

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        @$admin_name            = FILTER_VAR( $_POST['admin_name'], FILTER_SANITIZE_STRING);
        @$email                 = FILTER_VAR( $_POST['email'], FILTER_SANITIZE_EMAIL);
        @$hashed_password       = password_hash($_POST['password'],PASSWORD_DEFAULT);
        @$role                  = FILTER_VAR( $_POST['role'], FILTER_SANITIZE_NUMBER_INT);

            $formErrors = array ();
            // check the first name
            if(empty($admin_name)||strlen($admin_name)<3 ){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال اسم المسئول بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
                </script>";
                $admin_name_error="border border-danger";
            }
            // check the email
            if(empty($email)||strlen($email)<3 ){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال البريد الالكتروني بطريقه صحيحه ')
                </script>";
                $email_error="border border-danger";
            }
            // check the passwprd
            if(empty($_POST['password'])||strlen($_POST['password'])<5 ){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال كلمة السر بطريقه صحيحه (يجب ان تكون اكثر من 5 حروف')
                </script>";
                $password_error="border border-danger";
            }
            // check the role
            if(empty($role)){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من اختيارك للصلاحيه')
                </script>";
                $role_error="border border-danger";
            }




            if(empty($formErrors)){
                /*check if info already added*/
        
                global $con;
                $stmt = $con->prepare("SELECT * FROM admins WHERE email = ?");
                $stmt->execute(array($email));
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                $count = $stmt->rowCount();
                if ($count){
                    echo "
                        <script>
                            toastr.error('عفوا .. البريد الالكتروني المسجل موجود بالفعلا مسبقا')
                        </script>";
                }
                else{
                    insert_admin($admin_name,$email,$hashed_password,$role,$_SESSION['admin_id']);             
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
                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة مسئول جديد للنظام</p>
                <form method="POST" style="margin-bottom: 50px;" action="<?php $_SERVER['PHP_SELF'] ?>" >
                
                    <div style="direction: rtl !important;text-align: right;" class="row m-2">
                    <!--first Name-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label for="admin_name">اسم المسئول</label>
                            <input type="text" class="form-control <?php echo $admin_name_error;?>" value="<?php if(isset($admin_name)){ echo $admin_name;} ?>" id="admin_name" placeholder="ادخل الاسم الاول" name="admin_name" autocomplete="off">
                        </div>
                    <!--Email-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label for="Email">البريد الالكتروني</label>
                            <input type="email" class="form-control <?php echo $email_error;?>" value="<?php if(isset($email)){ echo $email;} ?>" id="Email" placeholder="ادخل البريد الالكتروني " name="email" autocomplete="off">
                        </div>
                    <!--password-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label for="Password">كلمة السر</label>
                            <input type="password" class="form-control <?php echo $password_error;?>" id="Password" placeholder="ادخل كلمة السر " name="password" autocomplete="off">
                        </div>
                        <!--role--->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="role">الصلاحيه</label>
                            <select class="<?php echo $role_error;?> custom-select ui search dropdown" name="role" id="role">
                                <option selected disabled value="">...اختر</option>
                                <?php foreach($all_role_data as $role_data){ ?>
                                    <option value="<?php echo $role_data["id"];?>"><?php echo $role_data["role_name"]; ?></option>
                                    <?php } ?>
                                </select>
                        </div>


                    </div>
                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">اصافة الي المسئولين</button>
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
