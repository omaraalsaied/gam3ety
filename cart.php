<?php 
    ob_start();
    session_start();
    $page_name = "عربة التسوق";
    $style="cart.css";
    $script="cart.js";
    require "init.php";
    // Require Class Fawry
    // require_once 'Class/Fawry.php';


    if(isset($_SESSION["id"])){
        $count_items = count_user_cart($_SESSION["id"]);
        $cart_data = all_cart_data($_SESSION["id"]);

    }else{
        $count_items = 0;
    }
    $total_price = 0;
    foreach($cart_data as $cart){
        if( $cart["price"] ==  $cart["discound"]){
            $total_price =  $total_price + $cart["price"];
        }else{
            $total_price =  $total_price + $cart["discound"];
        }
    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $coupone_id = filter_var($_POST['value'],FILTER_SANITIZE_STRING);

    if(!empty($coupone_id)){
        $stmt = $con->prepare("SELECT * FROM coupons WHERE coupone_code = ?");
        $stmt->execute(array($coupone_id));
        $coupon_state = $stmt->rowCount();
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if($coupon_state > 0){
    
    
            $now = date('Y/m/d');
            $expire = $rows["expire_at"];
            $today = strtotime($now);
            $exp = strtotime($expire);
    
            if($today > $exp){
                $new_total_price = $total_price;
                $coupone = "0";
            }else{
                $new_total_price = $total_price * ((100-$rows["coupone_value"]) / 100);
                $coupone = $coupone_id;
                echo "<script>toastr.success('تم بنجاح :- تم اضافة الخصم بنجاح ... استمتع بتجربتك مع جامعتي 😍' , { timeOut: 7000 })</script>";
            }
    
        }else{
            $new_total_price = $total_price;
            $coupone = "0";
        }
    }else{
        $new_total_price = $total_price;
        $coupone = "0";
    }




    global $con;

    $videos_arr=[];
foreach($cart_data as $videos_in_cart){
    array_push($videos_arr,$videos_in_cart["video_id"]); 
}



    if(!empty($videos_arr)){

        $sold_videos = implode("-",$videos_arr);


        $stmt16 = $con->prepare("SELECT * FROM payment_request WHERE student_id = ? AND price = ?");
        $stmt16->execute(array($_SESSION["id"],$new_total_price));
        $rows = $stmt16->fetch(PDO::FETCH_ASSOC);
        $count = $stmt16->rowCount();
        if ($count){
            echo "
                <script>
                    toastr.error('عفوا .. لقد قمت بعملية الدفع هذه قبل ذلك , من فضلك تواصل مع المسئولين')
                </script>";
        }
        else{

            $stmt5555 = $con->prepare("DELETE FROM cart WHERE student_id = :student_id");
            $stmt5555->execute(array(":student_id" => $_SESSION["id"]));

            if($coupone != 0){

                $stmt15 = $con->prepare("SELECT * FROM coupons WHERE coupone_code = ?");
                $stmt15->execute(array($coupone));
                $rows15 = $stmt15->fetch(PDO::FETCH_ASSOC);
                if($rows15["one_used"] == 1){
                    $stmt18 = $con->prepare("DELETE FROM coupons WHERE coupone_code = :coupone_code");
                    $stmt18->execute(array(":coupone_code" => $coupone));
                }

            }

            $stmt17=$con->prepare("INSERT INTO payment_request(student_id,process_id,price,videos_id,coupone,created_at) Value(:student_id,:process_id,:price,:videos_id,:coupone,:created_at)");
            date_default_timezone_set('Africa/Cairo');
            $time = date("Y/m/d . H:i:s");
            $process_id = "gam3ety_" . rand(1,9999999);
            $stmt17->execute(array(
                ":student_id"=>$_SESSION["id"],
                ":process_id"=>$process_id,
                ":price"=>$new_total_price,
                ":videos_id"=>$sold_videos,
                ":coupone"=>$coupone,
                ":created_at"=>$time
                ));
                echo "
                <script>
                toastr.success('تم ارسال طلب الدفع الخاص بك وسوف يتم تحويلك لصفحة الدفع , سيتم تحويلك لصفحة الدفع الان')
                </script>";   
                
                header("Refresh:3;url=confirm_payment.php?payment_code=". $process_id ."&cost=". $new_total_price .""); 
        }  

    }else{
        echo "
        <script>
        toastr.error('عملية غير ناجحه , من فضلك تاكد من اختيارك للفيديوهات.')
        </script>";
    }


    }
?>


    <header class="header" style="background-color: #000;" id="water">
        <!-- ======================================= Start Navbar ====================================== -->
        <nav id="navbar-clone" class="navbar mb-5">
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
                                <span id="cart_count1" class="count"><?php echo $count_items; ?></span>
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
                                <span id="cart_count2" class="count"><?php echo $count_items; ?></span>
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
    </header>

   
<!-- ======================================= Start cart ====================================== -->
<section class="cart">
    <div class="overlay">
                <?php if(isset($_SESSION["id"])){?>
            <p class="cart_header">سلة التسوق</p>
            <p class="cart_desc"><span class="count_items"><?php echo $count_items; ?></span> كورس في السله</p>
                <div class="row" style="direction: ltr;">
                <div class="col-lg-3">
                    <div class="price_item text-center">
                        <p class="price_header">
                            الكل : 
                        </p>
                        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
                        <h3 class="price"><?php echo $total_price; ?> EGP</h3>
                        <button data-bs-toggle="modal" data-bs-target="#exampleModal" data-user="<?php echo $_SESSION["id"];?>" class="pay"><a href="#">الدفع</a></button>
                        <!-- <button data-bs-toggle="modal" data-bs-target="" data-user="<?php echo $_SESSION["id"];?>" class="pay"><a href="#">الدفع</a></button> -->
                        
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">اتمام عملية الدفع</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h3 class="price" id="after_buy_price"><?php echo $total_price; ?> EGP</h3>
                                    <p class="pay_method">هل تمتلك كوبون خصم؟</p>
                                    <div class="input-group">
                                        <input style="font-family: 'Cairo', sans-serif;" type="text" class="form-control" id="coupone_code" 
                                            placeholder="ادخل كود الكوبون" name="value" autocomplete="off">
                                        <div class="input-group-append">
                                            <button total-price="<?php echo $total_price;?>" style="font-family: 'Cairo', sans-serif;" class="input-group-text check_coupon_btn" id="basic-addon2">اضغط لتفعيل الكوبون </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                <button type="submit" style="color: white;" class="submit_pay">الدفع</button>

                                </div>
                                </div>
                            </div>
                            </div>
                            </form>

                        <p class="pay_method">الدفع بواسطة فوري فقط</p>
                    </div>
                </div>
                    <div class="col-lg-9">
                        <?php 
                        if(empty($cart_data)){?>
                            <p style="margin-top: 100px;font-weight: 700;font-size: 30px;" class="text-danger text-center">* لاتوجد محاضرات مضافة الي السله ... اكمل التصفح لشراء المحاضرات *</p>

                        <?php } 

                            foreach($cart_data as $cart){
                        ?>

                        <div class="cart_item <?php echo "itemm" . $cart['id'];?>">
                            <div class="row">
                                <div data-item="<?php echo $cart["id"];?>" class="col-md-1 order-md-1 order-4 delete_cart">
                                        <p class="delete_text d-none">Delete Order</p>
                                        <img class="d-none del1" src="img/delete_cart.png" alt="delete">
                                        <img class="del2" src="img/delete_cart2.png" alt="delete">
                                </div>
                                <div class="col-md-3 order-md-2 order-3 cart_price">
                                    <p data-current-price="<?php if( $cart["price"] ==  $cart["discound"]){echo $cart["price"];}else{echo $cart["discound"];}?>" class="current_item_price text-center"> <?php
                                        if($cart["price"] != 0 && $cart["discound"] != 0){
                                        if( $cart["price"] ==  $cart["discound"]){echo $cart["price"];}else{echo $cart["discound"];} ?> EGP <br> <span> <?php if( $cart["price"] ==  $cart["discound"]){echo "";}else{echo $cart["price"] . " EGP";}?> </span> 
                                        <?php }else{echo "مجانا";} ?>
                                    </p>
                                    <p class="for_del" data-total="<?php echo $total_price;?>" style="display:none;"></p>
                                    <img src="img/cart_item.png" alt="cart_item">
                                </div>
                                <div class="col-md-5 order-md-3 order-2">
                                    <h4 class="course_name"><?php echo $cart["video_name"];?></h4>
                                    <h5 class="doctor_name">د / <?php echo $cart["doctor_name"]; ?></h5>
                                    <!-- <h5 class="year_collage">الفرقه الرابعه كلية الحاسبات والذكاء الاصطناعي</h5> -->
                                    <div class="time"><?php
                                    $date = explode(" . ",$cart["created_at"]);
                                    echo $date[0]; ?><img src="img/time_cart.png" alt="time_cart"> </div>
                                </div>
                                <div class="col-md-3 order-md-4 order-1 cart_left">
                                        <img src="img/courses page/course_img.png" alt="doctor_img" class="item_img">
                                        <img src="img/home 5.webp" class="doctor_img" alt="doctor_img">
                                    </img>
                                </div>

                            </div>
                        </div>

                        <?php } ?>
                    </div>

                    <?php }else{ ?>
                        <p style="margin: 200px 0;font-weight: 700;font-size: 30px;" class="text-danger text-center">* سجل الدخول في الموقع اولا واضف محاضرات الي السله لكي تتمكن من رؤيتها هنا *</p>
                    <?php } ?>

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
