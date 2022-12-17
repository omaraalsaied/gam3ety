<?php 
    ob_start();
    session_start();
    $page_name = "من نحن";
    $style="about.css";
    $script="about.js";
    require "init.php";



   $all_doctors = getAllData("doctors");
    if(isset($_SESSION["id"])){
        $count_items = count_user_cart($_SESSION["id"]);
    }else{
        $count_items = 0;
    }
?>



    
<!-- ======================================= Start Header ====================================== -->

<header class="header" style="background-color: #000;padding-bottom: 50px;" id="water">
        <!-- ======================================= Start Navbar ====================================== -->
        <nav id="navbar-clone" class="navbar mb-5">
            <div class="container">
                <a href="index.php" class="logo">
                    <img src="img/dark-logo.webp" alt="logo">
                </a>
                <ul class="links d-xl-flex d-none">
                    <li><a href="index.php">الصفحة الرئيسية</a></li>
                    <li><a href="courses_years.php">كورسات</a></li>
                    <li><a class="Nav_Clone_Active_Links" href="about-us.php">معلومات عنا</a></li>
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
                    <li><a href="courses_years.php">كورسات</a></li>
                    <li><a href="about-us.php"><span class="br">معلومات عنا</span></a></li>
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
                    <!-- <img class="shape9" src="img/Vector-1.webp" alt="vector"> -->
                    <img class="contactimg" style="display: block;margin: auto;width: 90%;" src="img/11668427_20943566.png" alt="vector">
                </div>

                <div class="col-lg-8 about_header_title" style="padding-top: 40px;">
                    <!-- <img class="shape8" src="img/Vector-1.webp" alt="vector"> -->
                    <h2 style="text-align:right; padding-bottom: 30px;font-family: 'Cairo', sans-serif;font-size: 40px;">الرئيسيه <strong
                            style="color: #E20813;font-family: 'Cairo', sans-serif;">/ من نحن </h2>
                    <!-- <img class="shape7" src="img/Vector-2.webp" alt="vector"> -->
                    
                </div>
            </div>
        </div>
    </header>
<!-- ======================================= End Header ====================================== -->


    
 <!-------------------------- first section ------------------------>
 <section class="section-first">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 order-lg-1 order-2">
            <div class="about_content">
              <h2>مرحبًا بك</h2>
              <h3>
                يمكنك الانضمام إلى المنصة التعليميه <br />
                وترقية مهاراتك من أجل
                <strong style="color: #e20813; font-family: 'Cairo', sans-serif;display: inline-block;"
                  >مستقبلك المشرق.<img
                    class="under_line"
                    src="./img/line under word.webp"
                    alt="vector"
                /></strong>
              </h3>

              <div class="about_items">
                <p>
                  اختر المواد المفضلة لديك لتتمكن من رؤية فيديوهات شرح مميزه بالاضافة الي ملف يتحوي علي شرح المحاضره
                </p>
              </div>
              <button
                style="line-height: 18px !important"
                class="about_page_btn"
              >
                <a
                  style="
                    display: inline-block;
                    width: 100%;
                    height: 100%;
                    text-decoration: none;
                  "
                  href="./courses_years.php"
                  >الذهاب الي الكورسات</a
                >
              </button>
            </div>
          </div>
          <div class="col-lg-6 order-lg-2 order-1">
            <div class="about_image">
              <img src="./img/about-image.webp" alt="about_image" />
              <div class="statistics">
                <div aria-hidden="true">
                  <strong
                    style="color: #e20813; font-size: 25px; font-weight: 700"
                    ><?php echo count_any("courses"); ?></strong
                  ><br />كورس
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-------------------------- second section ------------------------>
    <section class="services">
        <div class="overlay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="service_item">
                            <div class="row mb-3">
                                <div class="col-7 item_header">
                                    <p>شرح منهج كامل </p>
                                </div>
                                <div class="col-5 item_img">
                                    <img src="img/about-icon-2.webp" alt="about_icon">
                                </div>
                            </div>
                            <p class="desc">بيتم عرض المنهج بشكل كامل و مفصل عشان نضمن وصول المعلومة كاملة ليك و ده اللي هيساعدك في تحقيق هدفك و هو الأمتياز</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="service_item">
                            <div class="row mb-3">
                                <div class="col-7 item_header">
                                    <p>فيديوهات بشكل دوري </p>
                                </div>
                                <div class="col-5 item_img">
                                    <img src="img/about-icon-2.webp" alt="about_icon">
                                </div>
                            </div>
                            <p class="desc">محاضرات جديدة علي مدار الترم بيتم تحديثها بشكل منتظم و بخطه زمنيه تضمن انك تذاكر المواد كلها براحتك</p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-3">
                        <div class="service_item">
                            <div class="row mb-3">
                                <div class="col-7 item_header">
                                    <p>توفير الوقت و المجهود</p>
                                </div>
                                <div class="col-5 item_img">
                                    <img src="img/about-icon-2.webp" alt="about_icon">
                                </div>
                            </div>
                            <p class="desc">جامعتي بتقدملك حل مريح تتابع بيه محاضراتك من غير اي تعب او مجهود في حالة الظروف الاضطرارية اللي تمنعك من حضور محاضراتك الجامعية</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-------------------------- thrid section ------------------------>
    <section class="section-thrid" id="water">
      <div class="container">
        
        <h3 class="member">
          اعضاء
          <strong style="color: #e20813; font-family: 'Cairo', sans-serif"
            >الفريق.<img
              class="under_line"
              src="img/line under word.webp"
              alt="vector"
          /></strong>
        </h3>
        <div class="owl-carousel owl-theme " >
            <?php foreach($all_doctors as $doctor){ ?>
                <div class="item">
                    <div style="display: flex;justify-content:center ;align-items: center;">
                        <img style="width:200px;height:200px;border: 1px solid red; border-radius: 50%; padding: 10px;display: block;margin: auto;" src="admin_controls/img/doctors/<?php echo $doctor["img"] ?>" />
                    </div>
                    <div class="text-center">
                    <h2><?php echo "أ / " . $doctor["name"] ?></h2>
                    <p style="color: #e30813"><?php echo $doctor["position"] ?></p>
                    </div>
                </div>
            <?php }?>
         
        </div>
      </div>
    </section>
    <!-------------------------- End section ------------------------>


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
