<?php 
    ob_start();
    session_start();
    $page_name = "المحاضرات";
    $style="courses_vidoes.css";
    $script="courses_videos.js";
    require "init.php";

        if(empty( $_GET["course"]) || empty($_GET["year"]) || empty($_GET["subject"]) || empty($_GET["department"])){
            echo "
            <script>
            toastr.error('من فضلك تاكد من اختيارك للسنه الدراسيه والماده الدراسيه بشكل صحيح.')
            </script>";
            header("Refresh:3;url=courses_years.php"); 
        }else{
            @$course = $_GET["course"];
            @$year = $_GET["year"];
            @$subject = $_GET["subject"];
            @$department_id = $_GET["department"];
            
            $courses = getData_with_id("courses",@$course);
            @$videos = all_videos_by_department($department_id);
        }

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
                    <img class="contactimg" style="display: block;margin: auto;width:95%;margin-top:-25px" src="img/courses4.webp" alt="vector">
                </div>

                <div class="col-lg-8" style="padding-top: 40px;">
                    <h2 style="text-align:right; padding-bottom: 30px;font-family: 'Cairo', sans-serif;">الكورسات <strong
                            style="color: #E20813;font-family: 'Cairo', sans-serif;">/</strong> <?php echo $year; ?> <strong
                            style="color: #E20813;font-family: 'Cairo', sans-serif;">/</strong> <?php echo $subject; ?></h2>
                    <h1 style="color:#E20813 ;text-align: right;font-family: 'Cairo', sans-serif;"><?php echo $courses["name"] ?><strong
                            style="color: #fff;font-family: 'Cairo', sans-serif;"> / </strong><?php $doctor = getData_with_id("doctors",$courses["doctor"]);echo "<span style='color:#fff'> د .  " . $doctor["name"] . "</span>"; ?></h1>
                    
                </div>
            </div>
        </div>
    </header>

   
<!-- ======================================= Start courses ====================================== -->
<section class="courses">
    <div class="overlay">
        <div class="container">
            <div class="courses_header">اختار <strong style="color:#E20813;font-family: 'Cairo', sans-serif;">الفيديو .<img class="under_line" src="img/line under word.webp" alt="vector"></strong></ي>
                <div class="row" style="direction: rtl;">
                    <?php 
                    if(empty($videos)){?>
                        <p style="margin-top: 20px;font-weight: 700;font-size: 30px;" class="text-danger text-center">* عفوا .. لاتوجد محاضرات مسجله لهذا القسم بعد , من فضلك تواصل مع مسئولين الموقع *</p>

                    <?php }
                        foreach($videos as $videos_data){
                    ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="video_item">
                            <?php 
                                $date_time1= $videos_data["created_at"];
                                date_default_timezone_set('Africa/Cairo');
                                $date_time2 = date("Y/m/d . H:i:s");
                                $date1 = explode(" . " , $date_time1);
                                $date2 = explode(" . " , $date_time2);
                                $day1 = explode("/" , $date1[0]);
                                $day2 = explode("/" , $date2[0]);
                                $days_ago = date('d/m', strtotime('-2 days', strtotime($date_time2)));
                                $current_date = date('d/m', strtotime('-1 days', strtotime($date_time2)));
                                $new_date_2 = $day2[2] . "/" . $day2[1];
                                $new_date_1 = $day1[2] . "/" . $day1[1];
                        
                                if($new_date_1 == $new_date_2 || $new_date_1 == $days_ago || $new_date_1 == $current_date){?>
                                    <span class="ui yellow ribbon label">جديد</span>
                                <?php } ?>

                            <div class="item_header">
                                <img src="admin_controls/img/videos/<?php echo  $videos_data["img"] ?>" alt="video image">
                            </div>
                            <div class="video_content">
                                <h3><?php echo  $videos_data["video_name"] ?></h3>
                                <p class="subject"><?php echo $year . " - " . $subject; ?></p>
                                <p class="desc">
                                    <?php $str = substr($videos_data["description"], 0, 50) . '...'; echo $str; ?>
                                </p>
                                <div class="video_statistics">
                                    <div class="row">
                                        <div class="col-12">
                                            <img src="img/courses page/time.png" alt="icon 1">
                                            <p><?php $date = explode(" . " , $videos_data["created_at"]);echo $date[0]; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="price mt-3">
                                        <?php
                                        if($videos_data["discound"]!= 0){
                                            if($videos_data["price"] == $videos_data["discound"]){ ?>
                                            <p><?php echo $videos_data["price"] . " جنيه "?> </p>
                                            <?php }else{ ?>
                                                <p><span><?php echo $videos_data["price"] . " جنيه "?></span> <?php echo $videos_data["discound"] . " جنيه "?> </p>

                                            <?php }
                                        }else{?>
                                            <p><span><?php echo $videos_data["price"] . " جنيه "?></span> <?php echo "مجانا";?> </p>
                                        <?php }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button data-video="<?php if(isset($videos_data["id"])){echo $videos_data["id"];}?>" data-student="<?php if(isset($_SESSION["id"])){echo $_SESSION["id"];}else{echo 0;} ?>" style="line-height: 18px !important;" class="videos_btn add_video">اضافة الي السله</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ======================================= End courses ====================================== -->




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
