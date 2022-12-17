<?php 
    ob_start();
    session_start();
    $page_name = "عربة التسوق";
    $style="cart.css";
    $script="cart.js";
    require "init.php";

    
    
?>
<style>
    .info{
        font-weight: 600;
    font-size: 30px;
    color: #E20813;
    font-family: 'Cairo', sans-serif;
    text-align: center;
    padding: 30px 20px;
    }
</style>
   
<!-- ======================================= Start cart ====================================== -->
<section class="cart">
    <div class="overlay">
        <div class="container">
            <p style="line-height:60px;font-size: 3rem;" class="cart_header text-center">تم انشاء عملية دفع بنجاح </p>
            <h3 style="direction: rtl;" class="info">تم انشاء عملية دفع بنجاح رقم العمليه الخاص بك هو <?php echo "<b style='color:#000'>" . $_GET['payment_code'] . "</b>";?></h3>
            <h3 style="direction: rtl;" class="info">قم بتحويل المبلغ المطلوب وهو  <?php echo "<b style='color:#000'>" . $_GET['cost'] . " EGP</b>";?> علي الرقم التالي <a style='text-decoration: none;' target="_blank" href="https://wa.me/0201009525047">01009525047</a></h3>
            <p style="line-height:60px;font-size: 2rem;" class="cart_header text-center">قم بارسال رقم العمليه ورقم المحفظه المحول منها الاموال وايضا الايميل الخاص بك علي الواتس اب الخاص بنا من خلال الضغط علي الرقم التالي <a style='text-decoration: none;' target="_blank" href="https://wa.me/0201009525047">01009525047</a> </p>
            <div style="direction: rtl;text-align: right;font-size: 17px;line-height: 25px ;padding:30px 20px; margin-top:60px;border:3px solid #ea7c85" class="alert alert-danger" role="alert">
                                <h3 style="font-family: 'Cairo', sans-serif;"><i class="far fa-engine-warning pl-3 mb-3"></i> تنبيهات هامه :</h3>
                                1- تاكد من اتمام عملية الدفع من جانبك
                                <br>
                                <br>
                                2- قم بارسال رقم العمليه ورقم المحفظه المحول منها الاموال وايضا الايميل الخاص بك علي الرقم المرفق في الاعلي
                                <br>
                                <br>
                                3- الرجاء الحفاظ علي رقم العمليه في الاعلي , لانه لن يتم تاكيد عملية الدفع من جانبنا بدونه
                                <br>
                                <br>
                                4- تاكد من احضارك لرقم الهاتف المحفظه التي حولت منها الاموال
                               <br>
                               <br>
                                5- اذا تم حظر حسابك او في حالة مواجهة اي مشكله يمكنك الاتصال بنا من خلال صفحة اتصل بنا او من خلال البريد الالكتروني التالي ..  <a href="mailto:info@gam3ety.net">info@gam3ety.net</a>
                            </div>
        </div>
        </div>
</section>
<!-- ======================================= End subjects ====================================== -->




<!-- ======================================= Start Footer ====================================== -->
<footer>
    <div class="overlay">
        <div style="border-bottom: 2px solid #9C9C9C" class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="quick_links">
                        <h3>روابط سريعه</h3>
                        <a href="subjects.php?year=1">الفرقه الاولي</a>
                        <a href="subjects.php?year=2"> الفرقه الثانيه</a>
                        <a href="subjects.php?year=3"> الفرقه الثالثه</a>
                        <a href="subjects.php?year=4"> الفرقه الرابعه</a>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="quick_links">
                        <h3>الصفحات الرئيسيه</h3>
                        <a href="index.php">الصفحه الرئيسيه</a>
                        <a href="courses_years.php"> الكورسات</a>
                        <a href="about-us.php"> معلومات عنا</a>
                        <a href="contact-us.php"> التواصل معنا</a>
                    </div>
                </div>
                <div class="col-md-1"><br></div>
                <div class="col-md-5">
                    <div class="footer_info">
                            <img src="img/logo.webp" alt="logo">

                            <h3>في كل وقت و في أي مكان</h3>

                                <div class="contact_info">
                                <div class="phone" >
                                    <i style="color:#E20813;padding-left: 10px;"
                                    class="far fa-phone-alt"></i>
                                    <p>01121320428</p>
                                </div>
                                <div class="phone" >
                                    <i style="color:#E20813;padding-left: 10px;"
                                    class="far fa-phone-alt"></i>
                                    <p>01009525047</p>
                                </div>
                                <div class="phone" >
                                    <i style="color:#E20813;padding-left: 10px;"
                                    class="far fa-phone-alt"></i>
                                    <p>01508750726</p>
                                </div>
                                <div class="email" >
                                    <i style="color:#E20813;padding-left: 10px;"
                                    class="far fa-envelope"></i>
                                    <p>info@gam3ety.net</p>
                                </div>
                                <div class="social_icons" >
                                    <a href="https://t.me/+COW7LwF26ww1M2E0" target="_blank"><i style="color: #fff;" class="fab fa-telegram"></i></a>
                                    <a href="https://chat.whatsapp.com/B8x9k90hsPA2zWzSfiNrXR" target="_blank"> <i style="color: #fff;margin-right: 60px;" class="fab fa-whatsapp"></i></a>
                                    <!-- <i style="color: #fff;" class="fab fa-facebook-f"></i> -->
                                </div>
                            </div>
                    </div>
                </div>

            </div>
        </div>

        <p style="text-align: center;direction: rtl; color:#fff; padding-top: 20px ; padding-bottom: 30px;font-family: 'Cairo', sans-serif;">حقوق النشر 2022 , جميع الحقوق محفوظه الي <span style="color:#E30813 !important;font-weight:700;font-size:18px;cursor:pointer"> فريق جامعتي </span></p>
    </div>
</footer>
<!-- ======================================= End Footer ====================================== -->





<?php
require_once "./includes/template/footer.php";
ob_end_flush();
