<?php 
    ob_start();
    session_start();
    $page_name = "التسجيل في الموقع";
    $style="signin.css";
    $script="signin.js";
    require "init.php";

    // $student_token = uniqid("gam3ety");
    // setcookie("_token", $student_token, time() + (86400 * 3000), "/");
    if(isset($_COOKIE["_token"])){
        check_student_token($_COOKIE["_token"]);
    }

    if(isset($_SESSION['id'])){
        header("Location:courses_years.php");
    }else{

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(isset($_POST["type"]) &&  $_POST["type"] == "signup"){
            @$name                           = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
            @$email                          = FILTER_VAR( $_POST['email'], FILTER_SANITIZE_EMAIL);
            @$phone                          = FILTER_VAR( $_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
            @$university                     = FILTER_VAR( $_POST['university'], FILTER_SANITIZE_STRING);
            @$faculty                        = FILTER_VAR( $_POST['faculty'], FILTER_SANITIZE_STRING);
            @$birthday                       = $_POST['birthday'];
            @$academic_year                  = FILTER_VAR( $_POST['academic_year'], FILTER_SANITIZE_NUMBER_INT);
            @$gender                         = FILTER_VAR( $_POST['gender'], FILTER_SANITIZE_NUMBER_INT);
            @$password                       = FILTER_VAR( $_POST['password'], FILTER_SANITIZE_STRING);
            @$confirm_password               = FILTER_VAR( $_POST['confirm_password'], FILTER_SANITIZE_STRING);
            
            @$domains_allowed             = array("gmail.com","yahoo.com","hotmail.com","outlook.com");
            @$domain             = strtolower(end(explode("@",$email)));

            $formErrors = array ();
            if(empty($name)||strlen($name)<3 ){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال الاسم بطريقة صحيحه (يجب ان يكون اكثر من 3 حروف')
                </script>";
                $name_error="border border-danger";
            }
            // check the email
            if(empty($email)||strlen($email)<3 ){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال البريد الالكتروني بطريقه صحيحه ')
                </script>";
                $email_error="border border-danger";
            }
            // check if email is allowed
            if(!in_array($domain,$domains_allowed)){
                $formErrors[] = "
                <script>
                    toastr.error('البريد الالكتروني المسجل غير مدعوم لدينا , من فضلك حاول التسجيل ببريد الكتروني اخر (gmail,yahoo,hotmail,...etc) ')
                </script>";
                $email_error="border border-danger";
            }
            // check the phone
            if(empty($phone)||strlen($phone)<3 ){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال رقم الهاتف بطريقه صحيحه ')
                </script>";
                $phone_error="border border-danger";
            }
            if(empty($university)||strlen($university)<2 ){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال اسم الجامعه بطريقه صحيحه ')
                </script>";
                $university_error="border border-danger";
            }
            if(empty($faculty)||strlen($faculty)<3 ){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال اسم الكليه بطريقه صحيحه ')
                </script>";
                $faculty_error="border border-danger";
            }
            if(empty($password)||strlen($password)<3 ){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال كلمة السر بطريقه صحيحه .. يجب ان تكون اكثر من 8 حروف او ارقام ')
                </script>";
                $password_error="border border-danger";
            }
            if(empty($confirm_password)||strlen($confirm_password)<3 ){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال تاكيد كلمة السر ومطابقتها بكلمة السر ')
                </script>";
                $confirm_password_error="border border-danger";
            }
            if(empty($academic_year)){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال السنه الدراسيه الخاصه بك بطريقه صحيحه ')
                </script>";
                $academic_year_error="border border-danger";
            }
            if(empty($gender)){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال النوع بطريقه صحيحه ')
                </script>";
                $gender_error="border border-danger";
            }
            if(empty($birthday)){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من ادخال تاريخ الميلاد بطريقه صحيحه ')
                </script>";
                $birthday_error="border border-danger";
            }
            if (isset($formErrors)){ 
                foreach($formErrors as $error){
                    echo $error;
                }
            }
            if(empty($formErrors)){
                if($password != $confirm_password){
                    echo "
                    <script>
                        toastr.error('الرقم السري وتاكيد الرقم السري غير متطابقان')
                    </script>";
                }else{
                    global $con;
                    $stmt = $con->prepare("SELECT * FROM students WHERE email = ? OR phone=?");
                    $stmt->execute(array($email,$phone));
                    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                    $count = $stmt->rowCount();
                    if ($count){
                        echo "
                            <script>
                                toastr.error('عفوا .. البريد الالكتروني او رقم الهاتف المسجلين موجودين بالفعلا مسبقا')
                            </script>";
                    }
                    else{
                        $hashed_password       = password_hash($password,PASSWORD_DEFAULT);
                        insert_student($name,$email,$phone,$university,$faculty,$birthday,$academic_year,$gender,$hashed_password);             
                    }  
                }
            }
        }else{
            @$admin_email = filter_var(@$_POST["login_email"] , FILTER_SANITIZE_EMAIL);
            @$hased = filter_var(@$_POST['login_pass'], FILTER_SANITIZE_STRING);
            check_user($admin_email,$hased);
    }
}
?>
    
<header>
    <div class="overlay">


 <!-- ======================================= Start Navbar ====================================== -->

        <nav  class="navbar">
            <div class="container">
                <a href="index.php" class="logo">
                <img src="img/logo.webp" alt="logo">
                </a>

                <div style="margin-left: 20px;" class="bars d-xl-none d-block">
                    <i style="color:#fff !important" class="far fa-bars " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"></i>
                    
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
                                            <a href="cart.php" class="btn mt-1 cart_side d-inline-block"><img src="img/cart.webp" alt="cart"></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- ======================================= End Navbar ====================================== -->



        <div class="row w-100 h-100">
            <div class="col-md-6 signin_image_sec">
                <div class="image_section">
                    <div class="image_overlay">
                        <img src="img/logo.webp" alt="logo">
                        <p style="color: #fff;font-family: 'Cairo', sans-serif;text-align: center;padding-bottom:10px">
                            يمكنك الانضمام إلى المنصة التعليميه
                        </p>
                        <div class="image_text">
                            <p style="color: #fff;font-family: 'Cairo', sans-serif;text-align: center;">وترقية مهاراتك من أجل   <strong style="color:#E20813;font-family: 'Cairo', sans-serif;">مستقبلك المشرق</strong></p>
                            <img style="display: block; margin: auto;    position: relative;
                            right: 70px;width:100px" src="img/line under word.webp" alt="vector">
                            <button style="line-height: 18px !important;" href="index.php" class="home_page_btn"><a style="display:inline-block;width:100%;height:100%" href="index.php">الصفحه الرئيسيه</a></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">

                            <!-- ======================= sign in ======================= -->
                            <div class="signin">
                     
                    <img class="logo" src="img/logo.webp" alt="logo">
                    <!-- <a href="forget_password.php?to=forget" class="home_btn">الصفحه الرئيسيه</a> -->
                    <div class="content2" style="width: 90%; display: flex;flex-direction: column; margin: auto;padding:30px 3rem;padding-top:10px !important;margin-top:80px">
                        <h3 class="signin_title">تسجيل الدخول</h3>
                        <p class="signin_desc">مرحبا بيك مجددا في جامعتي</p>
                        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" style="padding-top: 40px;">

                            <div class="input-icons">

                            <div class="inputwrapper" >
                                <i class="fas fa-at icon_style"></i>
                            <input type="email" style="height: 55px;width: 100%;margin-bottom: 15px;border-radius: 10px;direction:rtl;padding-right:10px;font-family: 'Cairo', sans-serif;" name="login_email" class="input-field" placeholder="البريد الالكتروني">
                            </div>

                            <div class="inputwrapper">
                            <i class="fas fa-lock-open-alt icon_style"></i>
                            <input type="password" style="height: 55px;width: 100%;margin-bottom: 15px;font-family: 'Cairo', sans-serif;border-radius: 10px;direction:rtl;padding-right:10px" name="login_pass" class="input-field" autocomplete="off" placeholder=" الرقم السري ">
                            </div>
                            
                        </div>
                        
                        <button style="margin-bottom:0" class="signin_link">تسجيل الدخول</button>
                        <a href="forget_password.php?to=forget" class="forgot-password-click text-gradiant">هل نسيت كلمة السر ؟</a>
                        <p style="color: #fff;text-align: center;font-family: 'Cairo', sans-serif;padding:10px;direction: rtl;margin:10px auto !important">ليس لديك حساب !</p>
                        <button style="margin-top:0" id="to_signup" class="submit_btn">انشاء حساب</button>
                        </form>
                    </div>

                </div>
                <!-- ======================= sign up ======================= -->
                <div class="signup">
                    <img class="logo mt-3" src="img/logo.webp" alt="logo">
                    <div class="content2" style="width: 90%; display: flex;flex-direction: column; margin: auto;padding:30px 3rem;padding-top:10px !important">
                        <h3 style="color: #fff; text-align: center;font-family: 'Cairo', sans-serif;">انشاء حساب جديد</h3>
                        <p style="color:#9C9C9C ;text-align: center;font-family: 'Cairo', sans-serif;">مرحبا بيك في جامعتي</p>
                        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" style="padding-top: 40px;">
                            <input name="type" hidden value="signup" type="text">
                            <div class="input-icons">

                            <div class="inputwrapper">
                            <i class="far fa-spell-check icon_style"></i>
                            <input name="name" type="text" style="height: 55px;width: 100%;font-family: 'Cairo', sans-serif;margin-bottom: 15px; border-radius: 10px;direction:rtl;padding-right:10px" class="input-field <?php echo $name_error;?>" value="<?php if(isset($name)){ echo $name;} ?>" placeholder="ادخل اسمك">                  
                            </div>
                            
                            <div class="inputwrapper" >
                                <i class="fas fa-at icon_style"></i>
                            <input name="email" type="email" style="height: 55px;width: 100%;font-family: 'Cairo', sans-serif;margin-bottom: 15px;border-radius: 10px;direction:rtl;padding-right:10px" class="input-field <?php echo $email_error;?>" value="<?php if(isset($email)){ echo $email;} ?>" placeholder="البريد الالكتروني">
                            </div>

                            <div class="inputwrapper" >
                                <i class="fas fa-phone icon_style"></i>
                            <input name="phone" type="tel" style="height: 55px;width: 100%;font-family: 'Cairo', sans-serif;margin-bottom: 15px;border-radius: 10px;direction:rtl;padding-right:10px" class="input-field <?php echo $phone_error;?>" value="<?php if(isset($phone)){ echo $phone;} ?>" placeholder="رقم الهاتف">
                            </div>

                            
                            <div class="inputwrapper" >
                            <i class="far fa-university icon_style"></i>
                            <input name="university" type="text" style="height: 55px;width: 100%;font-family: 'Cairo', sans-serif;margin-bottom: 15px; border-radius: 10px;direction:rtl;padding-right:10px" class="input-field <?php echo $university_error;?>" value="<?php if(isset($university)){ echo $university;} ?>" placeholder="ادخل جامعتك">
                            </div>

                            <div class="inputwrapper" >
                                <i class="fas fa-graduation-cap icon_style"></i>
                                <input name="faculty" type="text" style="height: 55px;width: 100%;font-family: 'Cairo', sans-serif;margin-bottom: 15px; border-radius: 10px;direction:rtl;padding-right:10px" class="input-field <?php echo $faculty_error;?>" value="<?php if(isset($faculty)){ echo $faculty;} ?>" placeholder="ادخل كليتك">    
                            </div>

                            <div class="inputwrapper" >
                                <i class="fas fa-calendar icon_style"></i>
                                <input name="birthday" type="text" placeholder="ادخل تاريخ ميلادك" onfocus="(this.type='date')" style="height: 55px;width: 100%;font-family: 'Cairo', sans-serif;margin-bottom: 15px; border-radius: 10px;direction:rtl;text-align: right;padding-right:10px" class="input-field <?php echo $birthday_error;?>" value="<?php if(isset($birthday)){ echo $birthday;} ?>" >    

                            </div>

                            <div class="inputwrapper" >
                                <i class="fas fa-calendar-check icon_style"></i>
                                <input name="academic_year" type="number" style="height: 55px;width: 100%;font-family: 'Cairo', sans-serif;margin-bottom: 15px; border-radius: 10px;direction:rtl;padding-right:10px" class="input-field <?php echo $academic_year_error;?>" value="<?php if(isset($academic_year)){ echo $academic_year;} ?>" placeholder="ادخل فرقتك الجامعيه ( ادخل ارقام فقط - مثل :- 1 للفرقه الاولي )">    
                            </div>
                            

                            <div class="inputwrapper">
                                <i class="fas fa-lock-open-alt icon_style"></i>
                                <input name="password" type="password" style="height: 55px;width: 100%;font-family: 'Cairo', sans-serif;margin-bottom: 15px;border-radius: 10px;direction:rtl;padding-right:10px" autocomplete="off" class="input-field <?php echo $password_error;?>" value="<?php if(isset($password)){ echo $password;} ?>" placeholder=" الرقم السري ">
                            </div>

                            <div class="inputwrapper">
                                <i class="far fa-badge-check icon_style"></i>
                                <input name="confirm_password" type="password" style="height: 55px;font-family: 'Cairo', sans-serif;width: 100%;margin-bottom: 15px;border-radius: 10px;direction:rtl;padding-right:10px" autocomplete="off" class="input-field <?php echo $confirm_password_error;?>" value="<?php if(isset($confirm_password)){ echo $confirm_password;} ?>" placeholder=" اعاده الرقم السري">
                            </div>
                            <div class="inputwrapper">
                                <select style="direction: rtl;font-family: 'Cairo', sans-serif;    padding: 16px 40px;
    border-radius: 10px;" name="gender" class="form-select <?php echo $gender_error;?>" aria-label="Default select example">
                                    <option disabled selected>النوع</option>
                                    <option value="1">ذكر</option>
                                    <option value="2">انثي</option>
                                </select>
                            </div>

                            
                        </div>
                            
                        <button type="submit" class="submit_btn">انشاء حساب</button>
                        <p style="color: #fff;text-align: center;font-family: 'Cairo', sans-serif;padding:10px;direction: rtl;">لديك حساب بالفعل !</p>
                        <button id="to_signin" class="signin_link">تسجيل الدخول</button>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </div>
</header>

<?php 
require_once "./includes/template/footer.php";
}
?>
