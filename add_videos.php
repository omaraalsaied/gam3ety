<?php
session_start();
ob_start(); 
if(isset($_SESSION['admin_id'])){ 
$page_name = " - اضافة فيديوهات الكورسات";
$script = "add_courses.js";
include 'init.php';
$role_data = getData_with_id('roles',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
// if(isset($_SESSION['role'])){
require './layout/topNav.php';
$all_courses = all_courses();

//password_verify($pass,$rows['password'])
if(in_array("add_videos",$roles)){

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

        @$video_name                = FILTER_VAR( $_POST['video_name'], FILTER_SANITIZE_STRING);
        @$course                    = FILTER_VAR( $_POST['course'], FILTER_SANITIZE_NUMBER_INT);
        @$department                = FILTER_VAR( $_POST['department'], FILTER_SANITIZE_NUMBER_INT);
        @$video_id                  = FILTER_VAR( $_POST['video_id'], FILTER_SANITIZE_STRING);
        @$channel_id                = FILTER_VAR( $_POST['channel_id'], FILTER_SANITIZE_STRING);
        @$video_price               = FILTER_VAR( $_POST['video_price'], FILTER_SANITIZE_STRING);
        @$discount                  = FILTER_VAR( $_POST['discount'], FILTER_SANITIZE_STRING);
        @$desc                      = FILTER_VAR( $_POST['desc'], FILTER_SANITIZE_STRING);
        $avatar_name = $_FILES["img"]["name"];
        $size = $_FILES["img"]["size"];
        $img_tmp_name = $_FILES["img"]["tmp_name"];
        $type = $_FILES["img"]["type"];
        $extention_allowed = array("png","jpg","jpeg","svg","webp");   
        @$image_extention             = strtolower(end(explode(".",$avatar_name)));
        
        
        $pdf_name = $_FILES["pdf"]["name"];
        $pdf_tmp_name = $_FILES["pdf"]["tmp_name"];
        @$pdf_extention             = strtolower(end(explode(".",$pdf_name)));
        $pdf_final_name = time() . "." . $pdf_extention;
        $pdf_destination = "img/videos_pdfs/" . $pdf_final_name ;




        $formErrors = array ();


  // check the name
  if(empty($video_name)||strlen($video_name)<3 ){
    $formErrors[] = "
    <script>
        toastr.error('من فضلك تاكد من ادخال اسم الفيديو بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
    </script>";
    $video_name_error="border border-danger";
}
// check the desc
if(empty($desc)||strlen($desc)<20 ){
    $formErrors[] = "
    <script>
        toastr.error('من فضلك تاكد من ادخال وصف الفيديو بطريقه صحيحه (يجب ان يكون اكثر من 20 حروف')
    </script>";
    $desc_error="border border-danger";
}
// check the discount
if(empty($_POST['discount']) && $_POST['discount'] != 0){
    $formErrors[] = "
    <script>
        toastr.error('من فضلك تاكد من ادخال السعر بعد الخصم')
    </script>";
    $discount_error="border border-danger";
}
// check the video_price
if(empty($_POST['video_price'])){
    $formErrors[] = "
    <script>
        toastr.error('من فضلك تاكد من ادخال سعر الفيديو')
    </script>";
    $video_price_error="border border-danger";
}
// check the video_id
if(empty($_POST['video_id'])){
    $formErrors[] = "
    <script>
        toastr.error('من فضلك تاكد من ادخال رقم الفيديو')
    </script>";
    $video_id_error="border border-danger";
}
// check the channel_id
if(empty($_POST['channel_id'])){
    $formErrors[] = "
    <script>
        toastr.error('من فضلك تاكد من ادخال رقم القناه')
    </script>";
    $channel_id_error="border border-danger";
}
// check the course
if(empty($_POST['course'])){
    $formErrors[] = "
    <script>
        toastr.error('من فضلك تاكد من اختيارك لاسم الكورس')
    </script>";
    $course_error="border border-danger";
}
// check the department
if(empty($_POST['department'])){
    $formErrors[] = "
    <script>
        toastr.error('من فضلك تاكد من اختيارك لاسم القسم')
    </script>";
    $department_error="border border-danger";
}



        if(in_array($image_extention,$extention_allowed)){
            $avatar = time() . "." . $image_extention;
            $destination = "img/videos/" . $avatar ;
            if(empty($formErrors)){

                global $con;
                $stmt = $con->prepare("SELECT * FROM courses_videos WHERE video_id = ?");
                $stmt->execute(array($video_id));
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                $count = $stmt->rowCount();
                if ($count){
                    echo "
                        <script>
                            toastr.error('عفوا .. رقم الفيديو المسجل موجود بالفعل')
                        </script>";
                }
                else{
                    insert_video($video_name,$course,$department,$video_id,$channel_id,$video_price,$discount,$desc,$avatar,$pdf_final_name,$_SESSION['admin_id']); 
                    move_uploaded_file($img_tmp_name,$destination);     
                    move_uploaded_file($pdf_tmp_name,$pdf_destination);       
                }  
            }



        }else{
            echo "
            <script>
                toastr.error('امتداد الصوره غير مسموح به .. الامتدادات المسموحه (png,jpg,jpeg,svg,webp')
            </script>";
        }  



          



        if (isset($formErrors)){ 
            foreach($formErrors as $error){
                echo $error;
            }
        }
    }
?>
<div id="layoutSidenav">     
    <?php 
      require './layout/sidNav.php';
    ?> 
    <div id="layoutSidenav_content">
        <div class="container-fluid ">
            <div class="allContent">
            <div class="container mainAddForm">
                <img class="addMemberMainImg pt-5 mb-4" style="width: 80px;margin: auto;display: block;" src="img/addMember.png">
                <p class="firstParagraph text-center">اهلا بك في لوحة التحكم الخاصة بالنظام</p>
                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة فيديوهات جديده للنظام</p>
                <form method="POST" style="margin-bottom: 50px;" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                
                    <div style="direction: rtl !important;text-align: right;" class="row m-2 pb-3">
                        <!--video_name-->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="video_name">اسم الفيديو</label>
                            <input type="text" class="form-control <?php echo $video_name_error;?>" id="video_name" 
                                placeholder="ادخل اسم الفيديو" value="<?php if(isset($video_name)){ echo $video_name;} ?>" name="video_name" autocomplete="off">
                        </div>


                        <!--course--->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="course">الكورس</label>
                            <select class="<?php echo $course_error;?> custom-select ui search dropdown" name="course" id="course">
                                <option selected disabled value="">...اختر</option>
                                <?php foreach($all_courses as $course_data){ ?>
                                    <option value="<?php echo $course_data["id"];?>"><?php echo "جامعة " . $course_data["university_name"] . " - كلية " . $course_data["faculty_name"] . " - " . $course_data["academic_years_name"] . " - " . $course_data["subject_name"] . " - " . $course_data["name"]; ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                        <!--department--->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="department">القسم</label>
                            <select class="<?php echo $department_error;?> custom-select ui search dropdown" name="department" id="department">
                            <option selected disabled value="">...اختر</option>
                               
                                </select>
                        </div>

                        <!--video_id-->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="video_id">رقم الفيديو</label>
                            <input type="text" class="form-control <?php echo $video_id_error;?>" id="video_id" 
                                placeholder="ادخل رقم الفيديو" value="<?php if(isset($video_id)){ echo $video_id;} ?>" name="video_id" autocomplete="off">
                        </div>

                        <!--channel_id-->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="channel_id">رقم القناة (channel id)</label>
                            <input type="text" class="form-control <?php echo $channel_id_error;?>" id="channel_id" 
                                placeholder="ادخل رقم القناه" value="<?php if(isset($channel_id)){ echo $channel_id;} ?>" name="channel_id" autocomplete="off">
                        </div>


                        <!--video_price-->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="video_price">سعر الفيديو</label>
                            <input type="number" class="form-control <?php echo $video_price_error;?>" id="video_price" 
                                placeholder="ادخل سعر الفيديو" value="<?php if(isset($video_price)){ echo $video_price;} ?>" name="video_price" autocomplete="off">
                        </div>


                        <!--discount-->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="discount">السعر بعد الخصم</label>
                            <input type="number" class="form-control <?php echo $discount_error;?>" id="discount" 
                                placeholder="ادخل السعر بعد الخصم ( بدون خصم :- ادخل نفس سعر الفيديو )" value="<?php if(isset($discount)){ echo $discount;} ?>" name="discount" autocomplete="off">
                        </div>

                        <!--img-->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-3 col-xs-12">
                            <label for="img">صورة الفيديو</label>
                            <input type="file" class="form-control" required style="padding-bottom: 32px;" id="img" name="img" >
                        </div>

                        <!--pdf-->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-3 col-xs-12">
                            <label for="pdf">ملف المحاضره</label>
                            <input type="file" class="form-control" style="padding-bottom: 32px;" id="pdf" name="pdf" >
                        </div>

                        <!--description-->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-12 col-xs-12">
                            <label for="des">وصف الفيديو</label>
                            <textarea id="des" name="desc" class="form-control <?php echo $desc_error;?>" placeholder="ادخل وصف مبسط للفيديو لايزيد عن 10 كلمات:" rows="4" autocomplete="off"></textarea>
                        </div>  
                       
                    </div>
                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">اصافة الي الفيديوهات</button>
                </form>
                </div>
            </div>
      </div>
    </div>
</div>



<?php 
}else{
    echo "
    <script>
    toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
    </script>";
    header("Refresh:1;url=admin_dash.php");
}





require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
    ob_end_flush();?>
