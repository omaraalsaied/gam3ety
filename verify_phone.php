<?php
    ob_start();
    session_start();
    $page_name = "تاكيد رقم الهاتف";
    $style = "verify_pages.css";
    $script = "verify_phone.js";
    require_once "init.php";
    if(isset($_SESSION['id'])){
        if($_SESSION['phone_verified_at'] == 0 || $_SESSION['phone_verified_at'] != 0){
            

?>
<style>
    @media(max-width:500px){
        .btns{
            flex-flow: column;
        }
    }
</style>
<div class="container">
<img class="check_img" src="img/phone_verification.gif" alt="CHECK">
<h3 style='color:#5a69ff;font-size: 25px;padding-bottom: 20px;' class="message">من فضلك اضغط علي زر ارسال كود التفعيل في الاسفل لارسال كود تستخدمه لتأكيد ملكيتك لرقم الهاتف </h3>
<div class="row">
    <div style="margin: auto;" class="col-md-8">
        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                <div class="form-row text-center mt-4">
                    <div class="form-group col-md-12 mb-4">
                        <input id="phone" style="direction: rtl;font-family: 'Cairo', sans-serif;text-align:center ;" readonly value="<?php echo "0" . $_SESSION["phone"];?>" autocomplete="off" name="code" autocomplete="off" type="tel" class="form-control">
                    </div>
                </div>

                <div class="form-row text-center mt-4">
                    <div class="form-group col-md-12 mb-4">
                        <input id="activation_code" style="direction: rtl;font-family: 'Cairo', sans-serif;text-align:right ;" placeholder="ادخل كود التاكيد المرسل علي هاتفك" autocomplete="off" name="code" autocomplete="off" type="number" class="form-control">
                    </div>
                </div>

                <div class="btns">
                    <button data-student="<?php echo $_SESSION['id'];?>" data-phone="<?php echo "20" . $_SESSION['phone'];?>" id="verify_phone" type="submit" class="mt-3 btn btn-primary">تاكيد رقم الهاتف</button>
                    <button data-phone="<?php echo "20" . $_SESSION['phone'];?>" id="send_activation_code" type="submit" class="mt-3 btn btn-outline-primary">ارسال كود التفعيل</button>
                </div>

        </form>  
</div>
</div>
</div>
 <?php

 require_once "./includes/template/footer.php";
}else{
    header("location:user_dash.php");
}
}else{
    header("Location:signin.php");
}
ob_end_flush();