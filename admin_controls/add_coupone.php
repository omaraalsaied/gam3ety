<?php
session_start();
ob_start(); 
if(isset($_SESSION['admin_id'])){ 
$page_name = " - اضافة كوبونات خصم";
$script = "add_courses.js";
include 'init.php';
$role_data = getData_with_id('roles',$_SESSION['role']);

$roles= explode("/",$role_data['authentications']) ;
require './layout/topNav.php';
if(in_array("add_coupone",$roles)){

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name               = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
        $code               = FILTER_VAR( $_POST['code'], FILTER_SANITIZE_STRING);
        $expire             = $_POST['expire'];
        $value              = FILTER_VAR( $_POST['value'], FILTER_SANITIZE_NUMBER_INT);
        $one_use              = FILTER_VAR( $_POST['one_use'], FILTER_SANITIZE_NUMBER_INT);
    
            $formErrors = array ();
            // check the name
            if(empty($name)||strlen($name)<3 ){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال اسم الكوبون بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
                </script>";
                $name_error="border border-danger";
            }
            // check the code
            if(empty($code)){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال كود الكوبون')
                </script>";
                $code_error="border border-danger";
            }
            // check the value
            if(empty($_POST['value'])){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال قيمة الكوبون')
                </script>";
                $value_error="border border-danger";
            }


            if(empty($formErrors)){
                insert_coupon($name,$code,$value,$expire,$one_use,$_SESSION["admin_id"]);     
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
                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة كوبونات خصم جديده للنظام</p>
                <form method="POST" style="margin-bottom: 50px;" action="<?php $_SERVER['PHP_SELF'] ?>">
                
                    <div style="direction: rtl !important;text-align: right;" class="row m-2 pb-3">

                        <!--name-->
                        <div class="col-md-6 mt-4 col-xs-12">
                            <label for="name">اسم كوبون الخصم</label>
                            <input type="text" class="form-control <?php echo $name_error;?>" id="name" 
                                placeholder="ادخل اسم الكوبون" value="<?php if(isset($name)){ echo $name;} ?>" name="name" autocomplete="off">
                        </div>

                        <!--code-->
                        <div class="col-md-3 mt-4 col-xs-12">
                            <label for="code">كود كوبون الخصم</label>
                            <input type="text" value="<?php if(isset($code)){ echo $code;}else{echo "gam3ety-" . rand(100,99999);} ?>" class="form-control <?php echo $code_error;?>" id="code" placeholder="كود الكوبون" readonly name="code" autocomplete="off">
                        </div>

                        <!--ecpire_at-->
                        <div class="col-md-3 mt-4 col-xs-12">
                            <label for="expire">تاريخ انتهاء الكوبون</label>
                            <input type="date" class="form-control <?php echo $expire_error;?>" id="expire" name="expire" autocomplete="off">
                        </div>

                        <!--one_use--->
                        <div style="margin-bottom: 30px !important;margin-top:30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <select class="<?php echo $one_use_error;?> custom-select ui search dropdown" name="one_use" id="one_use">
                                <option selected disabled value="">...الاستخدام</option>
                                    <option value="1">استخدام مره واحده</option>
                                    <option value="0">غير محدد</option>
                                </select>
                        </div>

                        <div style="margin-top:30px !important" class="input-group col-md-6 m-auto col-xs-12 mt-3">
                            <input type="text" class="form-control <?php echo $value_error;?>" id="value" 
                                placeholder="ادخل فيمة الكوبون" value="<?php if(isset($value)){ echo $value;} ?>" name="value" autocomplete="off">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">%</span>
                            </div>
                        </div>
                                                
                    </div>
                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">اصافة الي الكوبونات خصم</button>
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
