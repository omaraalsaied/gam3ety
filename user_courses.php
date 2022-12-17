<?php    
ob_start();
session_start();
$page_name = "الكورسات المسجله";
$style="user-courses.css";
$script= NULL;
include "init.php";
if(isset($_SESSION['id'])){
if($_SESSION['email_verified_at'] != 0){
    
    // if($_SESSION['phone_verified_at'] != 0){

@$year ="الفرقه الرابعه";
@$subject = "اي حاجه";
@$course = 2;
@$videos = all_videos_by_course($course);
$all_videos = all_student_videos($_SESSION["id"]);
?>

    <section class="dashHistory-navbar">
        <div class="logo">
            <a href="index.php">
                <img  style="width: 9%" src="img/dark-logo.webp" alt="gam3etylogo">
            </a>
        </div>
        <div class="position-relative">
            <nav id="main-nav" class="py-3 shadow">
                <i class="fas fa-bars d-xl-none d-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"></i>
                <ul class="d-flex justify-content-evenly align-items-center d-xl-flex d-none">
                    <li class="px-3"><a class="fw-bolder" href="logout.php">تسجيل الخروج <i class="fas fa-sign-out text-dark"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="user_payments.php">عمليات الدفع <i class="fas fa-credit-card text-dark"></i></a></li>
                    <li class="px-3 active"><a class="fw-bolder active" href="user_courses.php">كورساتي <i class="fas fa-books text-dark active"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="index.php">الصفحة الرئيسيه للموقع<i class="fas fa-home text-dark"></i></a></li>
                    <li class="px-3"><a class="fw-bolder " href="user_dash.php">الصفحة الشخصية <i class=" fas fa-user text-dark"></i></a></li>
                </ul>
            </nav>
            <nav id="nav-clone" class="py-3 shadow">
                <i class="fas fa-bars d-xl-none d-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"></i>
                <ul class="d-flex justify-content-evenly align-items-center d-xl-flex d-none">
                    <li class="px-3"><a class="fw-bolder" href="logout.php">تسجيل الخروج <i class="fas fa-sign-out fa-bookmark"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="user_payments.php">عمليات الدفع <i class="fas fa-credit-card"></i></a></li>
                    <li class="px-3 active"><a class="fw-bolder active" href="user_courses.php">كورساتي <i class="fas fa-books"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="index.php">الصفحة الرئيسيه للموقع<i class="fas fa-home text-dark"></i></a></li>
                    <li class="px-3"><a class="fw-bolder " href="user_dash.php">الصفحة الشخصية <i class=" fas fa-user"></i></a></li>
                </ul>

            </nav>
            <div class="bars d-xl-none d-block">
                <div class="offcanvas offcanvas-top" tabindex="-1" id="offcanvasTop" aria-labelledby="offcanvasTopLabel">
                    <div class="offcanvas-header py-2 shadow">
                        <i class="far fa-times" type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></i>    
                        <div style="    justify-content: end;" class="logo d-flex align-items-center">
                            <img style="width:8%;" src="img/dark-logo.webp" alt="gam3ety_logo">
                        </div>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="canv_links  text-dark mb-1">
                            <li><a class="" href="user_dash.php"><i class=" fas fa-user ms-2 fa-fw"></i>الصفحة الشخصية</a></li>
                            <li><a href="index.php"><i class="fas fa-home ms-2 fa-fw"></i>الصفحة الرئيسيه للموقع</a></li>
                            <li><a href="user_courses.php"><i class="fas fa-books ms-2 fa-fw"></i>كورساتي</a></li>
                            <li><a href="user_payments.php"><i class="fas fa-credit-card ms-2 fa-fw"></i>عمليات الدفع</a></li>
                            <li><a href="index.php"><i class="fas fa-sign-out ms-2 fa-fw"></i>تسجيل الخروج </a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="courses">
        <div class="overlay">
            <div class="container">
                <h3 class="courses_header">كورساتي</h3>
                <p class="header_desc">الفيديوهات التي تم شراءها</p>
                <div class="row" style="direction: rtl;">
                    <?php 
                    if(empty($all_videos)){?>
                        <p style="margin-top: 20px;font-weight: 700;font-size: 30px;" class="text-danger text-center">* عفوا .. لاتوجد محاضرات تم شرائها بعد *</p>

                    <?php }
                        foreach($all_videos as $videos_data){
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
                                    <span class="ui yellow ribbon label">تم شرائة حديثا</span>
                                <?php } ?>

                            <div class="item_header">
                                <img src="admin_controls/img/videos/<?php echo  $videos_data["video_img"] ?>" alt="video image">
                            </div>
                            <div class="video_content">
                                <h3><?php echo  $videos_data["video_name"] ?></h3>
                                <p class="subject"><?php echo $videos_data["course_name"] . " - " . $videos_data["subject_name"]; ?></p>
                                <p class="desc">
                                    <?php $str = substr($videos_data["description"], 0, 50) . '...'; echo $str; ?>
                                </p>
                                <div class="video_statistics mt-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <img src="img/courses page/time.png" alt="icon 1">
                                            <p><?php $date = explode(" . " , $videos_data["created_at"]);echo $date[0]; ?></p>
                                        </div>
                                        <div class="col-6">
                                            <img src="img/courses page/courses_num.png" alt="icon 1">
                                            <p><?php echo $videos_data["doctor_name"]; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <form action="video_page.php" method="POST">
                                            <input type="text" name="joker" hidden value="<?php echo $videos_data["id_of_video"] ?>">
                                            <button type="submit" style="line-height: 18px !important;" class="videos_btn add_video">الذهاب الي الفيديو</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php } ?>
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
// }else{
//     header("location:verify_phone.php");
// }
}else{
    header("location:verify_email.php");
}
}else{
    header("Location:signin.php");
}
?>
