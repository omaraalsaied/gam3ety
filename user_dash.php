<?php    
ob_start();
session_start();
$page_name = "الصفحه الشخصيه";
$style="dash-profile.css";
$script="dash-profile.js";
include "init.php";
if(isset($_SESSION['id'])){
if($_SESSION['email_verified_at'] != 0){

    // if($_SESSION['phone_verified_at'] != 0){
    
$student_data = getData_with_id("students",$_SESSION['id']);

// if($_SERVER["REQUEST_METHOD"] == "POST"){
//     $student_name       = filter_var($_POST['name'],FILTER_SANITIZE_STRING);
//     $university         = filter_Var($_POST['university'],FILTER_SANITIZE_STRING);
//     $faculty            = filter_Var($_POST['faculty'],FILTER_SANITIZE_STRING);
//     $birthday           = $_POST['birthday'];
//     echo $birthday;
//     $academic_year      = filter_Var($_POST['academic_year'],FILTER_SANITIZE_STRING);
//     $gender             = filter_Var($_POST['gender'],FILTER_SANITIZE_NUMBER_INT);
//     $password           = filter_Var($_POST['password'],FILTER_SANITIZE_STRING);    

//     if(isset($password)){
//         update_student($student_name,$university,$faculty,$birthday,$academic_year,$gender,$password,$_SESSION['id']);
//     }else{
//         update_student($student_name,$university,$faculty,$birthday,$academic_year,$gender,$_SESSION['pass'],$_SESSION['id']);
//     }
    
// }

?>

    <section class="dashHistory-navbar">
        <div class="logo py-3">
            <a href="index.php">
                <img style="width: 10%" src="img/dark-logo.webp" alt="gam3etylogo">
            </a>
        </div>
        <div class="position-relative">
            <nav id="main-nav" class="py-3 shadow">
                <i class="fas fa-bars d-xl-none d-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"></i>
                <ul class="d-flex justify-content-evenly align-items-center d-xl-flex d-none">
                    <li class="px-3"><a class="fw-bolder" href="logout.php">تسجيل الخروج <i class="fas fa-sign-out text-dark"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="user_payments.php">عمليات الدفع <i class="fas fa-credit-card text-dark"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="user_courses.php">كورساتي <i class="fas fa-books text-dark"></i></a></li>
                                        <li class="px-3"><a class="fw-bolder" href="index.php">الصفحة الرئيسيه للموقع<i class="fas fa-home text-dark"></i></a></li>
                    <li class="px-3 active"><a class="fw-bolder active" href="user_dash.php">الصفحة الشخصية <i class=" fas fa-user text-dark active"></i></a></li>
                </ul>
            </nav>
            <nav id="nav-clone" class="py-3 shadow">
                <i class="fas fa-bars d-xl-none d-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasTop" aria-controls="offcanvasTop"></i>
                <ul class="d-flex justify-content-evenly align-items-center d-xl-flex d-none">
                    <li class="px-3"><a class="fw-bolder" href="logout.php">تسجيل الخروج <i class="fas fa-sign-out fa-bookmark"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="user_payments.php">عمليات الدفع <i class="fas fa-credit-card"></i></a></li>
                    <li class="px-3"><a class="fw-bolder" href="user_courses.php">كورساتي <i class="fas fa-books"></i></a></li>
                                        <li class="px-3"><a class="fw-bolder" href="index.php">الصفحة الرئيسيه للموقع<i class="fas fa-home text-dark"></i></a></li>
                    <li class="px-3 active"><a class="fw-bolder active" href="user_dash.php">الصفحة الشخصية <i class=" fas fa-user active"></i></a></li>
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

    
    <section id="dashHistory">
        <div class="container">
            <div class="feed_History my-5">
                <div class="row g-4 justify-content-center">
                    <div class="col-xl-9">
                        <div class="profile text-end bg-white">
    
                            <div class="person p-3 d-flex justify-content-center align-items-center">
                                <div class="per-img text-center">
                                    <img src="img/<?php if($_SESSION['gender']== 1){echo "man.png";}else{echo "woman.png";} ?>" alt="Mohamed Image">
                                    <h4 class="profile_header_subject" class="mt-2"><?php echo $_SESSION['student_name']  ?></h4>
                                </div>
                            </div>
                            <h6 class="p-3">المعلومات الشخصية</h6>
                            <div class="person-details p-3">
                                <div class="person-info">
                                <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                                        <div class="row g-4 justify-content-center flex-row-reverse">
                                            <div class="col-md-4">
                                                <label for="firstName">الأسم</label>
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $_SESSION['student_name']?> ">
                                                    <div class="field-icon"><i class="fas fa-user"></i></div>
                                                </div>
                                            </div>
          
                                            <div class="col-md-4">
                                                <label for="email">البريد الإلكترونى</label>
                                                <div class="form-group mb-0">
                                                    <input disabled type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']?>">
                                                    <div class="field-icon"><i class="fas fa-envelope-square"></i></div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="phone">رقم الموبايل</label>
                                                <div class="form-group mb-0">
                                                    <input disabled type="tel"  id="phone" class="form-control" name="phone" value="<?php echo $_SESSION['phone']?>">
                                                    <div class="field-icon"><i class="fas fa-mobile"></i></div>
                                                </div>
                                            </div>
                                         
                                            <div class="col-md-4">
                                                <label for="firstName">الجامعه</label>
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control" id="university" name="university" value="<?php echo $_SESSION['university']?> ">
                                                    <div class="field-icon"><i class="fas fa-user"></i></div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="firstName">الكليه</label>
                                                <div class="form-group mb-0">
                                                    <input type="text" class="form-control" id="faculty" name="faculty" value="<?php echo $_SESSION['faculty']?> ">
                                                    <div class="field-icon"><i class="fas fa-user"></i></div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="birthday">تاريخ الميلاد</label>
                                                <div class="form-group mb-0">
                                                    <input type="date" id="birthday" <?php if(isset($_SESSION['birthday'])){echo "disabled";}?> class="form-control" name="birthday" <?php if(isset($_SESSION['birthday'])){?> value="<?php echo $_SESSION['birthday'];?>"<?php } ?>>
                                                    <div class="field-icon"><i class="fas fa-id-card"></i></div>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="academic_year">السنه الدراسيه</label>
                                                <div class="form-group mb-0">
                                                    <input type="number" id="academic_year" class="form-control" name="academic_year" value="<?php echo $_SESSION['academic_year']?>">
                                                    <div class="field-icon"><i class="fas fa-id-card"></i></div>
                                                </div>
                                            </div>
                                            <div style="text-align: right !important;direction: rtl;" class="col-md-4  mb-3">
                                                <label for="gender">الجنس</label>
                                                <select style="font-family: 'Cairo', sans-serif;direction: rtl;" class=" custom-select ui search dropdown" name="gender" id="select_gender">
                                                    <option selected value="<?php echo $_SESSION['gender']?>"><?php if($_SESSION['gender'] == 1){echo "ذكر" ;}else{
                                                        echo "انثي";}?></option>    
                                                        <option value="1">ذكر</option>
                                                        <option value="2">انثي</option>
                                                </select>
                                            </div>

                                            <div class="col-md-4">
                                                <label for="password">الرقم السرى</label>
                                                <div class="form-group mb-0">
                                                    <input autocomplete="off" type="password" class="form-control" id="password" name="password" value="">
                                                    <div class="field-icon"><i class="fas fa-key"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-5">
                                            <div class="btns text-center">
                                                <!-- <button class="btn btn-cancel">إلغاء</button> -->
                                                <button data-id="<?php echo $_SESSION["id"];?>" type="submit" id="update_info" class="btn btn-update">تحديث</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

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
