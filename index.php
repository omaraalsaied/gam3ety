<?php 
    ob_start();
    session_start();
    $page_name = "الرئيسيه";
    $style="home_page.css";
    $script="home_page.js";
    require "init.php";

    
   $all_doctors = getAllData("doctors");
   if(isset($_SESSION["id"])){
   $count_items = count_user_cart($_SESSION["id"]);
   }else{
    $count_items = 0;
   }
?>

    
<!-- ======================================= Start Header ====================================== -->
<header>
    <div class="overlay">

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
                    <li><a href="index.php"><span class="br">الصفحة الرئيسية</span> </a></li>
                    <li><a href="courses_years.php">كورسات</a></li>
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

            <img class="shape1" src="img/Vector.webp" alt="vector">
            <img class="shape2" src="img/Vector-1.webp" alt="vector">
            <img class="shape3" src="img/Vector-2.webp" alt="vector">
            <img class="shape4" src="img/Vector-3.webp" alt="vector">
            <img class="shape5" src="img/Vector.webp" alt="vector">
            <img class="shape6" src="img/Vector-2.webp" alt="vector">
            <img class="shape7" src="img/Vector-3.webp" alt="vector">
            <img class="shape8" src="img/Vector-1.webp" alt="vector">
            <div class="row">
                <div class="col-md-6">
                    <div class="header_images">
                        <img src="img/header1.webp" alt="header 1">
                        <img src="img/header2.webp" alt="header 2">
                    </div>
                </div>
                <div style="display:flex;align-items: center" class="col-md-6">
                    <div class="header_content">
                        <h5>في كل وقت و في أي مكان </h5>
                        <h3>طرق جديدة و مختلفة لتحسين مهاراتك .</h3>
                        <p>نقدم لك كورسات في جميع المواد الدراسية في كل وقت وفي أي مكان</p>
                        <div class="btns">
                            <a href="signin.php">سجل الان</a>
                            <a href="about-us.php">التعرف علي المزيد </a>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="counter">
                                    <h3>400+</h3>
                                    <p>طالب</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="counter">
                                    <h3><?php echo count_any("subjects") ?></h3>
                                    <p>ماده علميه</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="counter">
                                    <h3><?php echo count_any("courses"); ?></h3>
                                    <p>كورس</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</header>
<!-- ======================================= End Header ====================================== -->


<!-- ======================================= Start About US ====================================== -->
<section class="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 order-lg-1 order-2">
                <div class="about_content">
                    <h2>مرحبًا بك</h2>
                    <h3>يمكنك الانضمام إلى المنصة التعليميه <br> وترقية مهاراتك من أجل    <strong style="color:#E20813;font-family: 'Cairo', sans-serif;">مستقبلك المشرق.<img class="under_line" src="img/line under word.webp" alt="vector"></strong></h3>
                    
                    <div class="about_items">
                        <img src="img/icon home 1.webp" alt="about-icon">
                        <p>ابدأ التعلم من تجربتك</p>
                    </div>
                    <div class="about_items">
                        <img src="img/icon home 2.webp" alt="about-icon">
                        <p>عزز مهاراتك معنا الان</p>
                    </div>
                    <div class="about_items">
                        <img src="img/icon home 3.webp" alt="about-icon">
                        <p>اختر المواد المفضله لديك</p>
                    </div>
                    <button style="line-height: 18px !important;" class="about_page_btn"><a style="display:inline-block;width:100%;height:100%" href="about-us.php">التعرف علي المزيد</a></button>
                    
                </div>
            </div>
            <div class="col-lg-6 order-lg-2 order-1">
                <div class="about_image">
                    <img src="img/about-section.svg" alt="about_image">
                    <div class="statistics">
                        <div aria-hidden="true"><strong style="color:#E20813;font-size:25px;font-weight:700"><?php echo count_any("courses"); ?></strong><br>كورس</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================================= End About US ====================================== -->


<!-- ======================================= Start Services ====================================== -->
<section class="services">
    <div class="overlay">
        <div class="container">
            <h3 class="service_header">الخدمات</h3>
            <img class="line" src="img/line under word.webp" alt="line">
            <div class="row">
                <div class="col-lg-6">
                    <img class="services_image" src="img/service in home.webp" alt="services image">
                </div>
                <div class="col-lg-6 about_sec_content pt-5 mt-2">
                    
                    <div class="row">
                        <div class="col-10">
                            <h3 class="service_name">محاضرات اونلاين</h3>
                            <p class="service_desc">نساهم في تطوير عملية التعليم عن بعد من خلال منصة متكاملة</p>
                        </div>
                        <div class="col-2">
                            <p class="service_num">01</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-10">
                            <h3 class="service_name">امكانية شراء محاضره واحده</h3>
                            <p class="service_desc">يمكنك اختيار ما تريدة من محاضرات دون التقيد بشراء المحتوي بالكامل</p>
                        </div>
                        <div class="col-2">
                            <p class="service_num">02</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-10">
                            <h3 class="service_name">محاضرين متميزين</h3>
                            <p class="service_desc">نخبة من أفضل المحاضرين في مجال القانون</p>
                        </div>
                        <div class="col-2">
                            <p class="service_num">03</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================================= End Services ====================================== -->



<!-- ======================================= Start How to work ====================================== -->
<section class="how_to_work">
    <div class="container">
        <h3 class="how_header">كيف <strong style="color:#E20813;font-family: 'Cairo', sans-serif;">يعمل.<img class="under_line" src="img/line under word.webp" alt="vector"></strong></h3>
        <div class="row">
            
            <div class="col-md-4">
                <div class="how_to_items">
                    <div class="how_overlay">
                        <div class="item_image">
                            <img src="img/how-to1.webp" alt="how to image">
                        </div>
                        <h3>قم بإختيار محاضراتك</h3>
                        <!-- <p>لقد نجا ليس فقط قفز المائة في الإلكترونية.</p> -->
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="how_to_items">
                    <div class="how_overlay">
                        <div class="item_image">
                            <img src="img/how-to2.webp" alt="how to image">
                        </div>
                        <h3>قم بإختيار فرقتك</h3>
                        <!-- <p>لقد نجا ليس فقط قفز المائة في الإلكترونية.</p> -->
                    </div>
                </div>
            </div>
            
            
            <div class="col-md-4">
                <div class="how_to_items">
                    <div class="how_overlay">
                        <div class="item_image">
                            <img src="img/how-to3.webp" alt="how to image">
                        </div>
                        <h3>قم بإنشاء حسابك</h3>
                        <!-- <p>لقد نجا ليس فقط قفز المائة في الإلكترونية.</p> -->
                    </div>
                </div>
            </div>
        </div>

        <div style="direction: rtl;text-align: right;font-size: 17px;line-height: 25px ;padding:30px 20px; margin-top:10px;border:3px solid #ea7c85;font-family: 'Cairo', sans-serif;" class="alert alert-danger" role="alert">
                                <h3 style="font-family: 'Cairo', sans-serif;"><i class="far fa-engine-warning pl-3 mb-3"></i> تنبيهات هامه :</h3>
                                1- محاولة سرقة المحتوى و نشرة يعرضك للحظر و للمسائلة القانونية لإنتهاك حقوق الطبع و النشر
                                <br>
                                <br>
                                2- لايمكنك الوصول الي هذه المحاضره الا من خلال صفحة الكورسات الخاصه بك
                                <br>
                                <br>
                                3- لايمكنك فتح الحساب الخاص بك علي اكثر من جهاز في نفس الوقت
                                <br>
                                <br>
                                4- في حالة تم ملاحظة فتح الحساب علي عدة اجهزه او عدة اماكن مختلفه , سيتم حظر الحساب
                               <br>
                               <br>
                                5- اذا تم حظر حسابك او في حالة مواجهة اي مشكله يمكنك الاتصال بنا من خلال صفحة اتصل بنا او من خلال البريد الالكتروني التالي ..  <a href="mailto:info@gam3ety.net">info@gam3ety.net</a>
                            </div>
    </div>
</section>
<!-- ======================================= End How to work ====================================== -->



<!-- ======================================= Start new_videos ====================================== -->
<section class="new_videos">
    <div class="overlay">
        <div class="container">
            <h3 class="new_videos_header">احدث <strong style="color:#E20813;font-family: 'Cairo', sans-serif;">الفيديوهات . <img class="under_line" src="img/line under word.webp" alt="vector"></strong></h3>
            <div class="row text-center filter_btns">
                <div class="col-3">
                    <button type="button" data-filter=".category-a" data-order="1">الفرقه الاولي</button>
                </div>
                <div class="col-3">
                    <button type="button" data-filter=".category-b">الفرقه الثانيه</button>
                </div>
                <div class="col-3">
                    <button type="button" data-filter=".category-c">الفرقه الثالثه</button>
                </div>
                <div class="col-3">
                    <button type="button" data-filter=".category-d">الفرقه الرابعه</button>
                </div>
            </div>


            <div class="row mt-5 pt-3">
                <?php $videos_data = all_years_videos("الفرقة الاولي");foreach($videos_data as $data){?>
                <div class="col-lg-6 mix category-a mb-3">
                <div class="videos_item">
                        <img class="video_img" src="admin_controls/img/videos/<?php echo $data["img"];?>" alt="video_image">
                        <div class="row mt-3 mb-3">
                            <div class="col-6">

                                <div class="doctor">
                                    <img class="doctor_img" src="admin_controls/img/doctors/<?php echo $data["doctor_img"];?>" alt="doctor image">
                                    <h4><?php echo $data["doctor_name"];?></h4>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="course_name">
                                        <p><?php echo $data["course_name"];?></p>
                                </div>
                            </div>
                        </div>
                        <div class="video_desc mb-2">
                            <p><?php $str = substr($data["description"], 0, 50) . '...'; echo $str; ?></p>
                        </div>
                        <div class="video_time mb-3">
                            <div class="row">
                                <div class="col-2">
                                    <img src="img/clock.webp" alt="clock">
                                </div>
                                <div class="col-10">
                                    <p><?php echo $data["created_at"];?></p>
                                </div>
                            </div>
                        </div>
                        <div class="video_price">
                            <div class="row">
                                <div class="col-6">
                                    <div class="submit_btn">
                                        <button data-student="<?php if(isset($_SESSION["id"])){echo $_SESSION["id"];}else{echo "unset";} ?>" data-video="<?php echo $data["id"]; ?>" class="add_to_cart_btn">اضافة الي السله</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="price">
                                        <p>                                   <?php
                                        if($data["price"] != 0 && $data["discound"]!= 0){
                                            if($data["price"] == $data["discound"]){ ?>
                                            <p><?php echo $data["price"] . " جنيه "?> </p>
                                            <?php }else{ ?>
                                                <p><span><?php echo $data["price"] . " جنيه "?></span> <?php echo $data["discound"] . " جنيه "?> </p>

                                            <?php }
                                        }else{?>
                                            <p>مجانا </p>
                                        <?php }
                                            ?> </p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
              
                
                <?php $videos_data = all_years_videos("الفرقة الثانيه");foreach($videos_data as $data){?>
                <div class="col-lg-6 mix category-b mb-3">
                    <div class="videos_item">
                        <img class="video_img" src="admin_controls/img/videos/<?php echo $data["img"];?>" alt="video_image">
                        <div class="row mt-3 mb-3">
                            <div class="col-6">

                                <div class="doctor">
                                    <img class="doctor_img" src="admin_controls/img/doctors/<?php echo $data["doctor_img"];?>" alt="doctor image">
                                    <h4><?php echo $data["doctor_name"];?></h4>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="course_name">
                                        <p><?php echo $data["course_name"];?></p>
                                </div>
                            </div>
                        </div>
                        <div class="video_desc mb-2">
                            <p><?php $str = substr($data["description"], 0, 50) . '...'; echo $str; ?></p>
                        </div>
                        <div class="video_time mb-3">
                            <div class="row">
                                <div class="col-2">
                                    <img src="img/clock.webp" alt="clock">
                                </div>
                                <div class="col-10">
                                    <p><?php echo $data["created_at"];?></p>
                                </div>
                            </div>
                        </div>
                        <div class="video_price">
                            <div class="row">
                                <div class="col-6">
                                    <div class="submit_btn">
                                        <button data-student="<?php if(isset($_SESSION["id"])){echo $_SESSION["id"];}else{echo "unset";} ?>" data-video="<?php echo $data["id"]; ?>" class="add_to_cart_btn">اضافة الي السله</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="price">
                                        <p>                                   <?php
                                        if($data["price"] != 0 && $data["discound"]!= 0){
                                            if($data["price"] == $data["discound"]){ ?>
                                            <p><?php echo $data["price"] . " جنيه "?> </p>
                                            <?php }else{ ?>
                                                <p><span><?php echo $data["price"] . " جنيه "?></span> <?php echo $data["discound"] . " جنيه "?> </p>

                                            <?php }
                                        }else{?>
                                            <p>مجانا </p>
                                        <?php }
                                            ?> </p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
                
                <?php $videos_data = all_years_videos("الفرقة القالقه");foreach($videos_data as $data){?>
                <div class="col-lg-6 mix category-c mb-3">
                    <div class="videos_item">
                        <img class="video_img" src="admin_controls/img/videos/<?php echo $data["img"];?>" alt="video_image">
                        <div class="row mt-3 mb-3">
                            <div class="col-6">

                                <div class="doctor">
                                    <img class="doctor_img" src="admin_controls/img/doctors/<?php echo $data["doctor_img"];?>" alt="doctor image">
                                    <h4><?php echo $data["doctor_name"];?></h4>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="course_name">
                                        <p><?php echo $data["course_name"];?></p>
                                </div>
                            </div>
                        </div>
                        <div class="video_desc mb-2">
                            <p><?php $str = substr($data["description"], 0, 50) . '...'; echo $str; ?></p>
                        </div>
                        <div class="video_time mb-3">
                            <div class="row">
                                <div class="col-2">
                                    <img src="img/clock.webp" alt="clock">
                                </div>
                                <div class="col-10">
                                    <p><?php echo $data["created_at"];?></p>
                                </div>
                            </div>
                        </div>
                        <div class="video_price">
                            <div class="row">
                                <div class="col-6">
                                    <div class="submit_btn">
                                        <button data-student="<?php if(isset($_SESSION["id"])){echo $_SESSION["id"];}else{echo "unset";} ?>" data-video="<?php echo $data["id"]; ?>" class="add_to_cart_btn">اضافة الي السله</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="price">
                                        <p>                                   <?php
                                        if($data["price"] != 0 && $data["discound"]!= 0){
                                            if($data["price"] == $data["discound"]){ ?>
                                            <p><?php echo $data["price"] . " جنيه "?> </p>
                                            <?php }else{ ?>
                                                <p><span><?php echo $data["price"] . " جنيه "?></span> <?php echo $data["discound"] . " جنيه "?> </p>

                                            <?php }
                                        }else{?>
                                            <p>مجانا </p>
                                        <?php }
                                            ?> </p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
                
                <?php $videos_data = all_years_videos("الفرقة الرابعه");foreach($videos_data as $data){?>
                    <div class="col-lg-6 mix category-d mb-3">
                    <div class="videos_item">
                        <img class="video_img" src="admin_controls/img/videos/<?php echo $data["img"];?>" alt="video_image">
                        <div class="row mt-3 mb-3">
                            <div class="col-6">

                                <div class="doctor">
                                    <img class="doctor_img" src="admin_controls/img/doctors/<?php echo $data["doctor_img"];?>" alt="doctor image">
                                    <h4><?php echo $data["doctor_name"];?></h4>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="course_name">
                                        <p><?php echo $data["course_name"];?></p>
                                </div>
                            </div>
                        </div>
                        <div class="video_desc mb-2">
                            <p><?php $str = substr($data["description"], 0, 50) . '...'; echo $str; ?></p>
                        </div>
                        <div class="video_time mb-3">
                            <div class="row">
                                <div class="col-2">
                                    <img src="img/clock.webp" alt="clock">
                                </div>
                                <div class="col-10">
                                    <p><?php echo $data["created_at"];?></p>
                                </div>
                            </div>
                        </div>
                        <div class="video_price">
                            <div class="row">
                                <div class="col-6">
                                    <div class="submit_btn">
                                        <button data-student="<?php if(isset($_SESSION["id"])){echo $_SESSION["id"];}else{echo "unset";} ?>" data-video="<?php echo $data["id"]; ?>" class="add_to_cart_btn">اضافة الي السله</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="price">
                                        <p>                                   <?php
                                        if($data["price"] != 0 && $data["discound"]!= 0){
                                            if($data["price"] == $data["discound"]){ ?>
                                            <p><?php echo $data["price"] . " جنيه "?> </p>
                                            <?php }else{ ?>
                                                <p><span><?php echo $data["price"] . " جنيه "?></span> <?php echo $data["discound"] . " جنيه "?> </p>

                                            <?php }
                                        }else{?>
                                            <p>مجانا </p>
                                        <?php }
                                            ?> </p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }?>
            </div>

            <a href="courses_years.php" class="go_to_videos">المزيد من الفيديوهات</a>


        </div>
    </div>
</section>
<!-- ======================================= End new_videos ====================================== -->

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
                        <img style="width:200px;height:200px;border: 1px solid red; border-radius: 50%; padding: 10px;display: block;margin: auto;" src="admin_controls/img/doctors/<?php echo $doctor["img"] ?>" alt="doctor image" />
                    </div>
                    <div class="text-center">
                    <h2 style='font-family: "Cairo", sans-serif !important;padding:20px 0'><?php echo "أ / " . $doctor["name"] ?></h2>
                    <p style='color: #e30813;font-family: "Cairo", sans-serif !important;'><?php echo $doctor["position"] ?></p>
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
