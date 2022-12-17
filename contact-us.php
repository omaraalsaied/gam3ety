<?php 
    ob_start();
    session_start();
    $page_name = "اتصل بنا";
    $style="contact-us.css";
    $script="contact-us.js";
    require "init.php";

    if(isset($_SESSION["id"])){
        $count_items = count_user_cart($_SESSION["id"]);
    }else{
        $count_items = 0;
    }



    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $student_name            = FILTER_VAR( $_POST['student_name'], FILTER_SANITIZE_STRING);
        $student_email            = FILTER_VAR( $_POST['student_email'], FILTER_SANITIZE_EMAIL);
        $student_phone            = FILTER_VAR( $_POST['student_phone'], FILTER_SANITIZE_NUMBER_INT);
        $message_title            = FILTER_VAR( $_POST['message_title'], FILTER_SANITIZE_STRING);
        $message_content            = FILTER_VAR( $_POST['message_content'], FILTER_SANITIZE_STRING);


        
        $formErrors = array ();


        // check the name
        if(empty($student_name)||strlen($student_name)<3 ){
        $formErrors[] = "
        <script>
            toastr.error('من فضلك تاكد من ادخال اسم اسمك بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
        </script>";
    }
        // check the student_email
        if(empty($student_email)){
        $formErrors[] = "
        <script>
            toastr.error('من فضلك تاكد من ادخال البريد الالكتروني الخاص بك')
        </script>";
    }
        // check the student_phone
        if(empty($student_phone)){
        $formErrors[] = "
        <script>
            toastr.error('من فضلك تاكد من ادخال رقم الهاتف الخاص بك')
        </script>";
    }
        // check the message_title
        if(empty($message_title)){
        $formErrors[] = "
        <script>
            toastr.error('من فضلك تاكد من ادخال عنوان الرساله')
        </script>";
    }
        // check the message_content
        if(empty($message_content) || strlen($message_content)<10){
        $formErrors[] = "
        <script>
            toastr.error('من فضلك تاكد من ادخال محتوي الرساله - *يجب ان يكون اكثر من 10 حروف*')
        </script>";
    }



        if(empty($formErrors)){
            send_message($student_name,$student_email,$student_phone,$message_title,$message_content);
        }

        if (isset($formErrors)){ 
            foreach($formErrors as $error){
                echo $error;
            }
        }
    }


?>

    <header class="header" style="background-color: #000;padding-bottom: 50px;" id="water">
        <!-- ======================================= Start Navbar ====================================== -->
        <nav id="navbar-clone" class="navbar">
            <div class="container">
                <a href="index.php" class="logo">
                    <img src="img/dark-logo.webp" alt="logo">
                </a>
                <ul class="links d-xl-flex d-none">
                    <li><a href="index.php">الصفحة الرئيسية</a></li>
                    <li><a href="courses_years.php">كورسات</a></li>
                    <li><a href="about-us.php">معلومات عنا</a></li>
                    <li><a class="Nav_Clone_Active_Links" href="contact-us.php">تواصل معنا</a></li>
                    <?php if(isset($_SESSION["id"])){ ?>
                        <li><a href="logout.php">تسجيل الخروج</a></li>
                    <?php } ?>
                </ul>

                <div class="btns d-xl-block d-none">

                        <!-- <a href="logout.php" class="btn">تسجيل الخروج</a>
                        <a href="dash-profile.php" target="_blank" class="btn">لوحة التحكم</a> -->

                        <a href="cart.php" class="btn">
                            <div class="cart">
                            <?php if($count_items>0 && isset($count_items)){ ?>
                                <span class="count"><?php echo $count_items; ?></span>
                                <?php } ?>
                                  <img style="position: relative;" src="img/cart-dark.webp" alt="cart">
                            </div>
                        </a>

                        <?php if(isset($_SESSION["id"])){ ?>
                            <a href="user_courses.php" class="btn">لوحة التحكم - كورساتك</a>
                        <?php }else{?>
                            <a href="signin.php" class="btn">تسجيل الدخول</a>
                        <?php } ?>
                        

                </div>
                <div style="margin-left: 20px;" class="bars d-xl-none d-block">
                    <i class="fas fa-bars " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"></i>
                </div>
            </div>
        </nav>

        <nav  class="navbar">
            <div class="container">
                <a href="index.php" class="logo">
                <img src="img/logo.webp" alt="logo">
                </a>
                <ul class="links d-xl-flex d-none">
                    <li><a href="index.php">الصفحة الرئيسية</span> </a></li>
                    <li><a href="courses_years.php">كورسات</a></li>
                    <li><a href="about-us.php">معلومات عنا</a></li>
                    <li><a href="contact-us.php"><span class="br">تواصل معنا</span></a></li>
                    <?php if(isset($_SESSION["id"])){ ?>
                        <li><a href="logout.php">تسجيل الخروج</a></li>
                    <?php } ?>
                </ul>

                <div class="btns d-xl-block d-none">
                    <!-- <a href="logout.php" class="btn">تسجيل الخروج</a>
                    <a href="dash-profile.php" target="_blank" class="btn">لوحة التحكم</a> -->
                    <a href="cart.php" class="btn">
                            <div class="cart">
                            <?php if($count_items>0 && isset($count_items)){ ?>
                                <span class="count"><?php echo $count_items; ?></span>
                                <?php } ?>
                                  <img style="position: relative;" src="img/cart.webp" alt="cart">
                            </div>
                        </a>
                    <?php if(isset($_SESSION["id"])){ ?>
                        <a href="user_courses.php" class="btn">لوحة التحكم - كورساتك</a>
                        <?php }else{?>
                            <a href="signin.php" class="btn">تسجيل الدخول</a>
                        <?php } ?>

                </div>

                <div style="margin-left: 20px;" class="bars d-xl-none d-block">
                    <i class="far fa-bars " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"></i>
                    
                    <div class="offcanvas bg-white offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header box">
                            <div class="logo">
                                <img src="img/dark-logo.webp" alt="BloodBank_Logo">
                            </div>
                            <i class="far fa-times" type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></i>    
                        </div>
                        <div class="offcanvas-body">
                            <div></div>

                            <div>
                                <ul class="canv_links flex-column text-dark mb-5">
                                    <li><a href="index.php"><i class="fas fa-home ms-2"></i>الصفحة الرئيسية</a></li>
                                    <li><a href="about-us.php"><i class="fas fa-users ms-2"></i>معلومات عنا</a></li>
                                    <li><a href="courses_years.php"><i class="fas fa-books ms-2"></i>كورسات </a></li>
                                    <li><a href="contact-us.php"><i class="fab fa-facebook-messenger ms-2"></i>تواصل معنا</a></li>
                                </ul>

                                <div class="btns">
                                    <?php if(isset($_SESSION["id"])){ ?>
                                        <a href="user_courses.php" target="_blank" class="btn mb-3">لوحة التحكم - كورساتك</a>
                                        <a href="logout.php" class="btn">تسجيل الخروج</a>
                                    <?php }else{?>
                                        <a href="signin.php" class="btn">تسجيل الدخول</a>
                                        <?php } ?>
                                        <br><br>
                                        <a href="cart.php" class="btn mt-3 cart_side d-inline-block"><img src="img/cart.webp" alt="cart"></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- ======================================= End Navbar ====================================== -->


        <div class="container">
            <div class="imgs">
                <img class="shape1" src="img/Vector-1.webp" alt="vector">
                <img class="shape2" src="img/Vector-2.webp" alt="vector">
                <img class="shape3" src="img/Vector-3.webp" alt="vector">
                <img class="shape4" src="img/Vector-2.webp" alt="vector">
                <img class="shape5" src="img/Vector.webp" alt="vector">
                
            </div>
            <div class="row">

                <div class="col-lg-6">
                    <img class="shape9" src="img/Vector-1.webp" alt="vector">
                    <img class="contactimg" src="img/contact us.webp" alt="vector">
                </div>

                <div class="col-lg-6" style="padding-top: 40px;">
                    <img class="shape8" src="img/Vector-1.webp" alt="vector">
                    <h2 style="text-align:right; padding-bottom: 30px;font-family: 'Cairo', sans-serif;">الصفحه الرئيسيه <strong
                            style="color: #E20813;font-family: 'Cairo', sans-serif;">/</strong> التواصل معنا </h2>
                    <h1 style="color:#E20813 ;text-align: right;font-family: 'Cairo', sans-serif;">التوصل معانا</h1>
                    <img class="shape7" src="img/Vector-2.webp" alt="vector">
                    
                </div>
            </div>
        </div>
    </header>

    <section>
    <div class="overlay" style="padding-bottom: 50px; padding-top: 30px;">
        <div class="container">
            
            <div class="content1" style="position:relative ;">
                <h5 class="header_title" style="text-align:right;">ابقي <strong style="color: #E20813;font-family: 'Cairo', sans-serif;">علي تواصل</strong></h5>
                <img style="right: 12px;position: absolute;margin-top: 10px;" src="img/line under word.webp" alt="vector">
                <p style="color: #9C9C9C;text-align: right; margin-top: 40px;font-family: 'Cairo', sans-serif;">لديك سؤال او تريد فقط ان اقول مرحبا؟ نحب
                    ان نسمع منك</p>
            </div>


            <div class="row" style="padding-top: 50px;">



                <div class="col-lg-6 col-md-12">
                    <div class="black_form"
                        style="background-color: #000;border-radius: 20px;position: relative;width: 100%; padding-bottom: 40px;"
                        id="water">
                        <div class="imgs">
                            <img class="shape11" src="img/Vector-1.webp" alt="vector">
                            <img class="shape22" src="img/Vector-2.webp" alt="vector">
                            <img class="shape33" src="img/Vector-3.webp" alt="vector">
                            <img class="shape55" src="img/Vector.webp" alt="vector">
                            
                        </div>


                        <div style="padding-top: 40px; margin-bottom: 50px;padding-bottom: 65px;">
                            <div class="part1">
                                <p style="color:#FFFFFF;font: size 20px;text-align:right ;font-family: 'Cairo', sans-serif;padding-top: 10px ">التليفون المحمول</p>
                                <p style="color:#5C5C5C;font: size 20px;text-align:right ;font-family: 'Cairo', sans-serif;">+201121320428</p>
                                <p style="color:#5C5C5C;font: size 20px;text-align:right ;font-family: 'Cairo', sans-serif;">+201009525047</p>
                                <p style="color:#5C5C5C;font: size 20px;text-align:right ;font-family: 'Cairo', sans-serif;">+201508750726</p>
                            </div>
                            <div class="part2">
                                <i style="color:#E20813; background-color: #FFF4F4; font-size: 20px; border-radius: 180px; padding: 20px; margin: 10px;"
                                    class="far fa-phone-alt"></i>
                            </div>


                            <br>
                        </div>
                        <hr style="background-color: #E20813; width: 80%; margin-top: 40px;">



                        <div
                            style="padding-top: 40px;margin-bottom: 50px; width: 80%;padding-bottom: 30px;">
                            <div class="part1">
                                <p style="color:#FFFFFF;font: size 20px;text-align:right ;font-family: 'Cairo', sans-serif;padding-top: 10px "> العنوان الالكتروني</p>
                                <p style="color:#5C5C5C;font: size 20px;text-align:right ;font-family: 'Cairo', sans-serif;">info@gam3ety.net</p>
                            </div>
                            <div class="part2">
                                <i class="far fa-envelope"
                                    style="color:#E20813; background-color: #FFF4F4; font-size: 20px; border-radius: 180px; padding: 20px; margin: 10px;"></i>
                            </div>
                            <br>
                        </div>
                        <hr style="background-color: #E20813; width: 80%; margin-top: 40px;">




                        <div style="padding-top: 40px;margin-bottom: 20px;display: flex;justify-content: center;">
                                <div class="social_icons" >
                                    <a href="https://t.me/+COW7LwF26ww1M2E0" target="_blank"><i style="color: #fff;    font-size: 45px;" class="fab fa-telegram"></i></a>
                                    <a href="https://chat.whatsapp.com/B8x9k90hsPA2zWzSfiNrXR" target="_blank"> <i style="color: #fff;margin-left: 60px;    font-size: 45px;" class="fab fa-whatsapp"></i></a>
                                    <!-- <i style="color: #fff;" class="fab fa-facebook-f"></i> -->
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <div class="white_form" style="width: 90%;">
                        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                            <div class="form-group mt-1">
                                <input type="text" style="font-family: 'Cairo', sans-serif !important; text-align: right; height: 60px;border-radius: 17px;color:#9C9C9C;
                            " class="form-control" required name="student_name" aria-describedby="emailHelp"
                                    placeholder="ادخل اسمك">
                            </div>
                            <div class="form-group mt-3">
                                <input type="email"
                                    style="font-family: 'Cairo', sans-serif !important; text-align: right; height: 60px;border-radius: 17px;"
                                    class="form-control" required name="student_email" placeholder="البريد الالكتروني الخاص بك">
                            </div>
                            <div class="form-group mt-3">
                                <input type="tel"
                                    style="font-family: 'Cairo', sans-serif !important; text-align: right; height: 60px;border-radius: 17px;"
                                    class="form-control" required name="student_phone" placeholder="رقم الهاتف الخاص بك">
                            </div>
                            <div class="form-group mt-3">

                                <input type="text"
                                    style="font-family: 'Cairo', sans-serif !important; text-align: right; height: 60px;border-radius: 17px;"
                                    class="form-control" required name="message_title" placeholder="ادخل عنوان الرساله">
                            </div>

                            <div class="form-group mt-3">

                                <textarea class="form-control"
                                    style="font-family: 'Cairo', sans-serif !important; text-align: right; height: 200px;border-radius: 17px;"
                                    name="message_content" required placeholder="نص الرساله" rows="7"></textarea>
                            </div>

                            <button style="margin-top:20px" type="submit" class="send_email">ارسال الرساله</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </section>


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