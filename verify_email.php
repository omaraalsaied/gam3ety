<?php
    ob_start();
    session_start();
    $page_name = "تاكيد البريد الالكتروني";
    $style = "verify_pages.css";
    $script = "verify_email.js";
    require_once "init.php";
    if(isset($_SESSION['id'])){
        if($_SESSION['email_verified_at'] == 0){

?>
<div class="container">
<img class="check_img" src="img/check.gif" alt="CHECK">
<h3 style='color:#5a69ff;font-size: 30px;padding-bottom: 20px;' class="message">تم ارسال كود تاكيد الي الايميل الخاص بك المسجل لدينا ... من فضلك ادخله في الاسفل للتاكد من ملكيتك للايميل , ان لم تصلك رساله يمكنك الضغط علي زر ارسال مره اخري</h3>
        <div style="display: flex;justify-content: center;align-items: center;font-family: 'Cairo', sans-serif">
            <pre><a href="index.php" class="mt-3 btn btn-primary" style="font-family: 'Cairo', sans-serif">العوده للصفحة الرئيسيه</a>    <a style="font-family: 'Cairo', sans-serif" href="logout.php" class="mt-3 btn btn-primary">تسجيل الخروج</a>
            </pre>
        </div>
<div class="row">
    <div style="margin: auto;" class="col-md-4">
        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
            <div class="form-row text-center mt-4">
                <div class="form-group col-md-12 mb-4">
                    <input id="verification_code" style="direction: ltr;" placeholder="Enter Code :" autocomplete="off" name="code" autocomplete="off" type="text" class="form-control">
                </div>
            </div>

            <div class="btns">
                <button data-student="<?php echo $_SESSION['email'];?>" id="verify_email" type="submit" class="mt-3 btn btn-primary">تاكيد الايميل</button>
                <button data-student="<?php echo $_SESSION['email'];?>" id="resend_code" type="submit" class="mt-3 btn btn-outline-primary">اعادة ارسال كود التفعيل</button>
            </div>
        </form>  
</div>
</div>
</div>
 <?php

 require_once "./includes/template/footer.php";
}else{
    // header("location:verify_phone.php");
    header("location:user_dash.php");
}
}else{
    header("Location:signin.php");
}
ob_end_flush();