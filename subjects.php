<?php 
    ob_start();
    session_start();
    $page_name = "المواد الدراسيه";
    $style="subjects.css";
    $script=NULL;
    require "init.php";

        @$year = $_GET["year"];
        if(isset($year) && $year == 1){
            $year = "الفرقة الاولي";
        }elseif(isset($year) && $year == 2){
            $year = "الفرقة الثانيه";
        }elseif(isset($year) && $year == 3){
            $year = "الفرقة الثالثه";
        }elseif(isset($year) && $year == 4){
            $year = "الفرقة الرابعه";
        }else{
            $year = "الفرقة الاولي";
            echo "
            <script>
                toastr.error('تم عرض مواد الفرقة الأولى لانك لم تختر السنه الدراسيه او تم اختيارها بطريقة صحيحه.')
              </script>";
        }


    $subject_data = all_subject_data($year);


    if(isset($_SESSION["id"])){
        $count_items = count_user_cart($_SESSION["id"]);
    }else{
        $count_items = 0;
    }

?>


    <header class="header" style="background-color: #000;padding-bottom: 50px;" id="water">
        <!-- ======================================= Start Navbar ====================================== -->
        <nav id="navbar-clone" class="navbar mb-5">
            <div class="container">
                <a href="index.php" class="logo">
                    <img src="img/dark-logo.webp" alt="logo">
                </a>
                <ul class="links d-xl-flex d-none">
                    <li><a href="index.php">الصفحة الرئيسية</a></li>
                    <li><a class="Nav_Clone_Active_Links" href="courses_years.php">كورسات</a></li>
                    <li><a href="about-us.php">معلومات عنا</a></li>
                    <li><a href="contact-us.php">تواصل معنا</a></li>
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
                    <img src="img/red-menu.png" style="width:70%;cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" alt="menu">
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
                    <li><a href="courses_years.php"><span class="br">كورسات</span></a></li>
                    <li><a href="about-us.php">معلومات عنا</a></li>
                    <li><a href="contact-us.php">تواصل معنا</a></li>
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
                    <img src="img/menu.png" style="width:70%;cursor: pointer;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" alt="menu">
                    
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

                <div class="col-lg-4">
                    <img class="contactimg" style="display: block;width:80%;margin-top:-20px" src="img/courses3.webp" alt="vector">
                </div>

                <div class="col-lg-8 subject_header_Text" style="padding-top: 40px;">
                    <img class="shape8" src="img/Vector-1.webp" alt="vector">
                    <h2 style="text-align:right; padding-bottom: 30px;font-family: 'Cairo', sans-serif;">الصفحه الرئيسيه <strong
                            style="color: #E20813;font-family: 'Cairo', sans-serif;">/</strong> الكورسات <strong
                            style="color: #E20813;font-family: 'Cairo', sans-serif;">/</strong> <?php echo $year; ?></h2>
                    <h1 style="color:#E20813 ;text-align: right;font-family: 'Cairo', sans-serif;"><?php echo $year ?></h1>
                    <img class="shape7" src="img/Vector-2.webp" alt="vector">
                    
                </div>
            </div>
        </div>
    </header>

   
<!-- ======================================= Start subjects ====================================== -->
<section class="subjects">
    <div class="overlay">
        <div class="container">
            <div class="subjects_header">اختار <strong style="color:#E20813;font-family: 'Cairo', sans-serif;">الماده الدراسيه .<img class="under_line" src="img/line under word.webp" alt="vector"></strong></div>
                <div class="row" style="direction: rtl;">
                    <?php 
                    if(empty($subject_data)){?>
                        <p style="margin-top: 20px;font-weight: 700;font-size: 30px;" class="text-danger text-center">* لاتوجد مواد مسجله لهذة السنه , من فضلك تواصل مع مسئولين الموقع *</p>

                    <?php }
                        foreach($subject_data as $subject){
                    ?>
                    <div class="col-12">
                        <div class="subject_item">
                            <div class="row">
                                <div class="col-md-4">
                                    <img class="subject_image" src="img/courses page/subjects_img.png" alt="subject img">
                                </div>
                                <div class="col-md-8 content">
                                    <h3><?php echo $subject["subject_name"];?></h3>
                                    <p><?php echo "من خلال اختيارك لمادة " . $subject["subject_name"] . " , سوف يكون بامكانك رؤية العديد من المحاضرات بشرح دكتور او اكثر" ?></p>
                                    <div class="statistics">
                                        <img src="img/courses page/courses_num2.png" alt="courses number 2">
                                        <p class="coueses_num"><?php echo count_all_courses_by_subject($subject["subject_id"]) . " كورسات"; ?></p>
                                    </div>
                                    <button style="line-height: 18px !important;" class="courses_btn"><a style="display:inline-block;width:100%;height:100%" href="courses.php?subject=<?php echo $subject["subject_id"] . "&year=" . $year;?>">انتقل الي الكورسات</a></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
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
