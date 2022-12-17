<?php
session_start();
ob_start(); 
if(isset($_SESSION['admin_id'])){ 
$page_name = " - اهداء فيديو";
include 'init.php';
$student_id = $_GET["student_id"];
$role_data = getData_with_id('roles',$_SESSION['role']);
$student_data = getData_with_id('students',$student_id);
$roles= explode("/",$role_data['authentications']) ;
require './layout/topNav.php';
$all_videos = all_videos();
if(in_array("gift_video",$roles)){

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        @$video            = FILTER_VAR( $_POST['video'], FILTER_SANITIZE_NUMBER_INT);

            $formErrors = array ();
            // check video id
            if(empty($video)){
                $formErrors[] = "
                <script>
                    toastr.error('من فضلك تاكد من اختيارك للفيديو')
                </script>";
                $video_error="border border-danger";
            }




            if(empty($formErrors)){
                /*check if info already added*/
        
                global $con;
                $stmt = $con->prepare("SELECT * FROM student_videos WHERE student_id = ? AND video_id=?");
                $stmt->execute(array($student_id,$video));
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $count = $stmt->rowCount();
                if ($count){
                    echo "
                        <script>
                            toastr.error('عفوا .. الفيديو المضاف موجوده بالفعل لدي الطالب مسبقا')
                        </script>";
                }
                else{
                    gift_video_by_admin($video,$student_id,$_SESSION['admin_id']);             
                }  
            }
        }

        if (isset($formErrors)){ 
            foreach($formErrors as $error){
                echo $error;
            }
        }

?>
<style>
    .ui.dropdown .menu .item{
        line-height: 25px;
        border-bottom: 3px solid #ececec;
    }
    .ui.selection.dropdown{
        min-height: 4.714286em !important;
        line-height: 25px;
    }
</style>
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
                <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اهداء فيديو الي مستخدم</p>
                <form method="POST" style="margin-bottom: 50px;" action="<?php $_SERVER['PHP_SELF'] ?>" >
                
                    <div style="direction: rtl !important;text-align: right;" class="row m-2">
                        <!--student name-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label>اسم الطالب</label>
                            <input type="text" disabled class="form-control" value="<?php echo $student_data["student_name"]; ?>">
                        </div>
                        <!--student email-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label>ايميل الطالب</label>
                            <input type="text" disabled class="form-control" value="<?php echo $student_data["email"]; ?>">
                        </div>
                        <!--student phone-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label>هاتف الطالب</label>
                            <input type="text" disabled class="form-control" value="<?php echo $student_data["phone"]; ?>">
                        </div>
                        <!--student university-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label>جامعة الطالب</label>
                            <input type="text" disabled class="form-control" value="<?php echo $student_data["university"]; ?>">
                        </div>
                        <!--student faculty-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label>كلية الطالب</label>
                            <input type="text" disabled class="form-control" value="<?php echo $student_data["faculty"]; ?>">
                        </div>
                        <!--student acadedmic year-->
                        <div class="col-md-6 mb-3 col-xs-12">
                            <label>السنه الدراسيه للطالب</label>
                            <input type="text" disabled class="form-control" value="<?php echo $student_data["academic_year"]; ?>">
                        </div>

                        <!--video--->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12 m-auto">
                            <label for="video">الفيديو</label>
                            <select class="<?php echo $video_error;?> custom-select ui search dropdown" name="video" id="video">
                                <option selected disabled value="">...اختر</option>
                                <?php foreach($all_videos as $video_data){ ?>
                                    <option value="<?php echo $video_data["id"];?>"><?php echo "جامعة " . $video_data["university_name"] . " - كلية " . $video_data["faculty_name"] . " - " . $video_data["academic_years_name"] . " - " . $video_data["subject_name"] . " - " . $video_data["course_name"] . " - " . $video_data["video_name"]; ?></option>
                                    <?php } ?>
                                </select>
                        </div>


                    </div>
                    <!--btn -> add--->
                    <button class="btn btn-primary d-block m-auto mt-5">اهداء الفيديو</button>
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
