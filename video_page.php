<?php    
ob_start();
session_start();
$page_name = "المحاضرات";
$style="video_page.css";
$script= "video_page.js";
include "init.php";
$IP = $_SERVER['REMOTE_ADDR'];
if(isset($_SESSION['id'])){
    if($_SESSION['email_verified_at'] != 0){
        
        // if($_SESSION['phone_verified_at'] != 0){

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $video_id= $_POST['joker'];
            $video_data = all_video_data($video_id);
?>

    <section class="dashHistory-navbar">
        <div class="logo">
            <a href="index.php">
                <img style="width: 9%" src="img/dark-logo.webp" alt="gam3etylogo">
            </a>
        </div>
    </section>

<section class="video_section pb-5">
        <script>!function(e,t,i){if(void 0===e._dyntube_v1_init){e._dyntube_v1_init=!0;var a=t.createElement("script");a.type="text/javascript",a.async=!0,a.src="https://embed.dyntube.com/v1.0/dyntube.js",t.getElementsByTagName("head")[0].appendChild(a)}}(window,document);</script>

        <div style="font-size: 1px !important;" data-watermark="<?php echo $_SESSION["id"] . " - " . $_SESSION['student_name'] ?>"
         data-dyntube-key="<?php echo $video_data["channel_id"]?>"></div>

         <script>
                        
             
            window.addEventListener("dyntubeReady", function() {
            $('dyntube-player').append('<div class="dyt-watermark2">' + '<?php echo $IP; ?>' + '</div>');

            $('dyntube-player').append('<div class="dyt-watermark">' + '<?php echo $_SESSION["id"] . " - " . $_SESSION['student_name'] ?>' + '</div>');

            //Please provide the 'channelKey' attribute of a video or 'key' attribute of a channel to call getChannel function.
            var player = dyntube.getPlayer('<?php echo $video_data["channel_id"]?>');
            //This events get fired when video starts playing.
            // player.on('play', function () {
            //     $('.dyt-watermark2').show();
            // });
                $('.dyt-watermark2').show();
                $('.dyt-watermark').show();


            });

            setInterval(function () {
            $('.dyt-watermark2').hide();
            },20000);

            setInterval(function () {
            $('.dyt-watermark').hide();
            },10000);

            setInterval(function () {
            $('.dyt-watermark2').show();
            },50000);

            setInterval(function () {
            $('.dyt-watermark').show();
            },50000);

         </script>

        <div class="container">
            <h3 class="video_name"><?php echo $video_data["video_name"]?></h3>
            <p class="subject"><?php echo $video_data["subject_name"]?></p>
            <div class="doctor">
                <h5><?php echo $video_data["doctor_name"]?></h5>
                <img src="admin_controls/img/doctors/<?php echo  $video_data["doctor_img"] ?>" alt="doctor_image">
            </div>
            <div class="time">
                <p><?php $date = explode(" . ",$video_data["created_at"]); echo $date[0] ?></p>
                <img src="img/time_cart.png" alt="time">
            </div>
            <p class="desc">
                <?php echo $video_data["description"] ?>
            </p>

            <?php if(!empty($video_data['pdf'])){ ?>
            <a style="display:block;float:right;font-family: 'Cairo', sans-serif !important;" href='./admin_controls/img/videos_pdfs/<?php echo $video_data['pdf'];?>' target="_blank" class='btn editbtn btn-success m-2'>ملف المحاضره <i class="fas fa-file-pdf m-1"></i></a> 
            <?php }else{ ?>
                <button style="display:block;float:right;font-family: 'Cairo', sans-serif !important;" disabled class='btn editbtn btn-success m-2 disabled'>ملف المحاضره غير متوفر<i class="fas fa-file-pdf m-1"></i></button> 
            <?php } ?>


            <div style="direction: rtl;text-align: right;font-size: 17px;line-height: 25px ;padding:30px 20px; margin-top:60px;border:3px solid #ea7c85" class="alert alert-danger" role="alert">
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
}else{
    echo "
    <script>
    toastr.error('تم الوصول الي الصفحه بطريقه غير مصرح بها ... من فضلك تاكد من اختيارك الفيديو')
    </script>";
    header("Refresh:3;url=user_courses.php");
}
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
