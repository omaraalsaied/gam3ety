<?php    
ob_start();
session_start();
$page_name = "نسيان كلمة السر";
$style="login.css";
$script="";
include "init.php";

?>
    <!-- Start Navbar -->
 
    <!-- End Navbar -->
<style>
    /* start forget page */
.forget{
  /* background-color: #35bac6!important; */
  text-align:center;
  margin: auto;
}
.item{
    padding: 10%;
}
.item img{
    width:100%;
    height:100%;
}
.container{
    /* margin-left:-20px!important; */
    margin-top:25px!important;

}
.carve{
    background:#dc3546b2;
    border-radius: 50px 192px;
}
/* end forget page */
</style>
    
<?php
if(isset($_GET['to'] ) && $_GET['to'] == "code"){
    if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["code"]) && $_POST['state'] == "code" ){

        $code = filter_var($_POST["code"] , FILTER_SANITIZE_EMAIL);
        if( empty($_POST["code"])){
            $formErrors[] = "
            <script>
                toastr.error('من فضلك تاكد من ادخال الكود المرسل إليك ')
            </script>";
            $ssn_error="border border-danger ssn_border";
        }
       
        if(empty($formErrors)){
            checkcode($code,$_GET["email"]);

        }
    }
?>
    <div class="container">
        <div class="row forget">
            <div class="col-md-6 col-sm-12 item carve">
                <img src="img/forgot-password.png" alt="img">
            </div>
            <div class="col-md-6 col-sm-12 item">
            <h3 class="text-gradiant text-center py-3">هل نسيت كلمة السر</h3>
                                <p class="py-3">أدخل الكود الذى تم إرسالة إليك</p>
                                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                                <input type="hidden" name="state" value="code">

                                    <div class="form-group verify ">
                                        <input type="number"name="code" value="" class="form-control" placeholder="######">
                                        <div class="field-icon"><i class="fas fa-code"></i></div>
                                    </div>
                                
                                    <div class="form-group sign-up-btn">
                                        <input type="submit" class="next submit back-gradient " value="التالى">
                                    </div>
                                </form>
                                <div class="sign-in-txt">
                                    إذا كنت تتذكر كلمة المرور الخاصة بك؟ <a href="signin.php" class="sign-up-click text-gradiant">تسجيل الدخول</a>
                                </div>
                </div>
            </div>
    </div>
    <?php 
    }else if(isset($_GET['to'] ) && $_GET['to'] == "forget"){
        if($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['state'] == "forget" ){
    
            $email = filter_var($_POST["email"] , FILTER_SANITIZE_EMAIL);
            if( empty($_POST["email"])){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال البريد الالكتروني بطريقه صحيحه ')
                </script>";
                $ssn_error="border border-danger ssn_border";
            }
           
            if(empty($formErrors)){
                check_user_pass($email);
            }
        }
    ?>
        <div class="container">
            <div class="row forget">
                <div class="col-md-6 col-sm-12 item carve">
                    <img src="img/confused.png" alt="img">
                </div>
                <div class="col-md-6 col-sm-12 item">
                <h3 class="text-gradiant my-4">هل نسيت كلمة السر</h3>
                                <p class="py-2 ">أدخل عنوان بريدك الإلكتروني لإعادة تعيين كلمة المرور الخاصة بك</p>
                                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                                            <input type="hidden" name="state" value="forget">

                                            <div class="form-group forget-email my-4">
                                            <input type="email"name="email" class="my-4 form-control " placeholder="البريد الإلكترونى">
                                            <div class="field-icon"><i class="fas fa-envelope-square"></i></div>
                                            
                                        </div>
                                    
                                    <div class="form-group sign-up-btn my-4">
                                        <input type="submit" class="send submit back-gradient" value="إرسال">
                                    </div>
                                </form>
                                    <div class="sign-in-txt">
                                        إذا كنت تتذكر كلمة المرور الخاصة بك؟ <a href="signin.php" class="sign-up-click text-gradiant">تسجيل الدخول</a>
                                    </div>
                    </div>
                </div>
        </div>
        <?php 
        }   
    else if(isset($_GET['to']) && $_GET['to'] == "confirm"){
        if($_SERVER["REQUEST_METHOD"] == "POST"  && $_POST['state'] == "confirm" ){
        
                $new = filter_var($_POST["new"] , FILTER_SANITIZE_EMAIL);
                $confirm = filter_var($_POST["confirm"] , FILTER_SANITIZE_EMAIL);

                if( empty($_POST["new"]) ||  empty($_POST["confirm"])){
                    $formErrors[] = "
                    <script>
                        toastr.error('من فضلك تاكد من ادخال الرقم السري الجديد ')
                    </script>";
                    $new_error="border border-danger ssn_border";
                }
                if( $new != $confirm){
                    $formErrors[] = "
                    <script>
                        toastr.error('من فضلك تاكد من ادخال نفس الرقم السري ')
                    </script>";
                    $confirm_error="border border-danger ssn_border";
                }else{
                    global $con;
                    $stmt= $con->prepare ("UPDATE students SET `pass`=? WHERE `id`=?");
                    $stmt ->execute(array(password_hash($new,PASSWORD_DEFAULT), $_GET['ssn']));
                    echo "
                        <script>
                            toastr.success('تم تعديل الرقم السري .')
                        </script>";
                    header("Refresh:3;url=signin.php");
                }

            }
            if (isset($formErrors)){ 
                foreach($formErrors as $error){
                    echo $error;
                }
            }
        ?>
            <div class="container">
                <div class="row forget">
                    <div class="col-md-6 col-sm-12 item carve">
                        <img src="img/password.png" alt="img">
                    </div>
                    <div class="col-md-6 col-sm-12 item">
                    <h3 class="text-gradiant text-center py-5">قم بتغير الرقم السرى</h3>
                                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                                <input type="hidden" name="state" value="confirm">
                                    
                                    
                                    <div class="form-group my-4">
                                        <input type="password" class="form-control" name="new" placeholder="كلمة السر الجديدة">
                                        <div class="field-icon"><i class="fas fa-key-skeleton"></i></div>
                                    </div>
                                    <div class="form-group my-4">
                                        <input type="password" name="confirm" class="form-control" placeholder="تأكيد كلمة السر">
                                        <div class="field-icon"><i class="fas fa-key-skeleton"></i></div>
                                    </div>
                                    
                                    <div class="form-group sign-up-btn">
                                        <input type="submit" class="submit back-gradient my-3" value="إرسال">
                                    </div>
                                </form>
                                <div class="sign-in-txt">
                                    إذا كنت تتذكر كلمة المرور الخاصة بك؟ <a href="signin.php" class="sign-up-click text-gradiant">تسجيل الدخول</a>
                                </div>
                        </div>
                    </div>
            </div>
            <?php 

    }
    ?>
    
     <!-- Start Footer -->
     
    <!-- End Footer -->

    <!-- Btn Up -->
    <a id="btnUp" type="button" role="button" class="btn   rounded  text-white" ><i class="fas fa-angle-up fs-5 text-white"></i> </a>

<?php 
require_once "./includes/template/footer.php";
?>