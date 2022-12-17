<?php
session_start();
ob_start(); 
if(isset($_SESSION['admin_id'])){ 
$page_name = " - اضافة دكتور";
include 'init.php';
$role_data = getData_with_id('roles',$_SESSION['role']);
$roles= explode("/",$role_data['authentications']) ;
require './layout/topNav.php';
if(in_array("add_doctor",$roles)){
if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        @$doctor_name                           = FILTER_VAR( $_POST['doctor_name'], FILTER_SANITIZE_STRING);
        @$doctor_position                       = FILTER_VAR( $_POST['doctor_position'], FILTER_SANITIZE_STRING);
        @$doctor_facebook                       = FILTER_VAR( $_POST['doctor_facebook'], FILTER_SANITIZE_STRING);
        @$doctor_linked_in                      = FILTER_VAR( $_POST['doctor_linked_in'], FILTER_SANITIZE_STRING);
        @$doctor_email                          = FILTER_VAR( $_POST['doctor_email'], FILTER_SANITIZE_STRING);
        $avatar_name = $_FILES["img"]["name"];
        $size = $_FILES["img"]["size"];
        $tmp_name = $_FILES["img"]["tmp_name"];
        $type = $_FILES["img"]["type"];
        $extention_allowed = array("png","jpg","jpeg","svg","webp");   
        @$extention             = strtolower(end(explode(".",$avatar_name)));

        $formErrors = array ();
        if(empty($doctor_facebook)){
            $doctor_facebook = "فارغ";
        }
        if(empty($doctor_linked_in)){
            $doctor_linked_in = "فارغ";
        }
        if(empty($doctor_email)){
            $doctor_email = "فارغ";
        }


  // check the doctor_name
if(empty($doctor_name)||strlen($doctor_name)<3 ){
    $formErrors[] = "
    <script>
        toastr.error('من فضلك تاكد من ادخال اسم الدكتور بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
    </script>";
    $doctor_name_error="border border-danger";
}
// check the doctor_position
if(empty($doctor_position)||strlen($doctor_position)<5 ){
    $formErrors[] = "
    <script>
        toastr.error('من فضلك تاكد من ادخال مؤهل الدكتور بطريقه صحيحه (يجب ان يكون اكثر من 5 حروف')
    </script>";
    $doctor_position_error="border border-danger";
}




        if(in_array($extention,$extention_allowed)){
            $avatar = time() . "." . $extention;
            $destination = "img/doctors/" . $avatar ;
            if(empty($formErrors)){

                global $con;
                $stmt = $con->prepare("SELECT * FROM doctors WHERE name = ? AND position = ?");
                $stmt->execute(array($doctor_name,$doctor_position));
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                $count = $stmt->rowCount();
                if ($count){
                    echo "
                        <script>
                            toastr.error('عفوا .. اسم الدكتور والمؤهل المسجلين موجودين بالفعل')
                        </script>";
                }
                else{
                    insert_doctor($doctor_name,$doctor_position,$doctor_facebook,$doctor_linked_in,$doctor_email,$avatar); 
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
                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة دكتور جديد للنظام</p>
                <form method="POST" style="margin-bottom: 50px;" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                
                    <div style="direction: rtl !important;text-align: right;" class="row m-2 pb-3">
                        <!--doctor_name-->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="doctor_name">اسم الدكتور</label>
                            <input type="text" class="form-control <?php echo $doctor_name_error;?>" id="doctor_name" 
                                placeholder="ادخل اسم الدكتور" value="<?php if(isset($doctor_name)){ echo $doctor_name;} ?>" name="doctor_name" autocomplete="off">
                        </div>

                        <!--doctor_position-->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="doctor_position">مؤهل الدكتور</label>
                            <input type="text" class="form-control <?php echo $doctor_position_error;?>" id="doctor_position" 
                                placeholder="ادخل مؤهل الدكتور" value="<?php if(isset($doctor_position)){ echo $doctor_position;} ?>" name="doctor_position" autocomplete="off">
                        </div>


                        <!--doctor_facebook-->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="doctor_facebook">لينك الفيسبوك</label>
                            <input type="url" class="form-control <?php echo $doctor_facebook_error;?>" id="doctor_facebook" 
                                placeholder="ادخل لينك الفيسبوك" value="<?php if(isset($doctor_facebook)){ echo $doctor_facebook;} ?>" name="doctor_facebook" autocomplete="off">
                        </div>


                        <!--doctor_linked_in-->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="doctor_linked_in">لينك لينكد ان</label>
                            <input type="url" class="form-control <?php echo $doctor_linked_in_error;?>" id="doctor_linked_in" 
                                placeholder="ادخل لينك لينكد ان" value="<?php if(isset($doctor_linked_in)){ echo $doctor_linked_in;} ?>" name="doctor_linked_in" autocomplete="off">
                        </div>


                        <!--doctor_email-->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="doctor_email">الايميل</label>
                            <input type="email" class="form-control <?php echo $doctor_email_error;?>" id="doctor_email" 
                                placeholder="ادخل الايميل" value="<?php if(isset($doctor_email)){ echo $doctor_email;} ?>" name="doctor_email" autocomplete="off">
                        </div>

                        <!--img-->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="img">صورة الدكتور</label>
                            <input type="file" class="form-control" required style="padding-bottom: 32px;" id="img" name="img" >
                        </div>
                       
                    </div>
                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">اصافة الي الدكتور</button>
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
