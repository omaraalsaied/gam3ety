<?php    
ob_start();
session_start();   
$script = "all_student.js";
$page_name = " - تسليم المحاضرات";
include "init.php";
if(isset($_SESSION['admin_id'])){ 
$role_data = getData_with_id('roles',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ; 

require './layout/topNav.php';
?>

    <style>
        .columns {
            float: unset !important;
            display: block;
            margin:20px auto !important;

        }
    </style>
<div id="layoutSidenav">     
    <?php 
      require './layout/sidNav.php';
      if(in_array("order_pdf",$roles)){
          ?>
        <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

              
                    <div class="container-fluid">
                        <h1 class="mt-4">جامعتي</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">تسليم المحاضرات</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    تسليم المحاضرات

                                    
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div id="toolbar" class="select">
                                        <select style="display: none;" class="form-control">
                                        </select>
                                    </div>
                                    <table class="table table-bordered text-center" data-show-export="true"
                                    data-toolbar="#toolbar" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>اسم المستخدم</th>             
                                            <th>ايميل المستخدم</th>             
                                            <th>هاتف المستخدم</th>             
                                            <th>الجامعه</th>             
                                            <th>الكليه</th>             
                                            <th>السنه الدراسيه</th>             
                                            <th>اسم الماده</th>             
                                            <th>اسم الكورس</th>             
                                            <th>اسم المحاضره</th>             
                                            <th>تسليم المحاضره</th>                         
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>اسم المستخدم</th>             
                                            <th>ايميل المستخدم</th>             
                                            <th>هاتف المستخدم</th>             
                                            <th>الجامعه</th>             
                                            <th>الكليه</th>             
                                            <th>السنه الدراسيه</th>             
                                            <th>اسم الماده</th>             
                                            <th>اسم الكورس</th>             
                                            <th>اسم المحاضره</th>             
                                            <th>تسليم المحاضره</th> 
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $student_videos = getAllStudentVideos();
                                           foreach($student_videos as $all_students_videos){
                                            echo"<tr>";
                                                echo "<td>".  $all_students_videos['student_name']      	."</td>";
                                                echo "<td>".  $all_students_videos['email']      	."</td>";
                                                echo "<td>".  $all_students_videos['phone']      	."</td>";
                                                echo "<td>".  $all_students_videos['university_name']      	."</td>";
                                                echo "<td>".  $all_students_videos['faculty_name']      	."</td>";
                                                echo "<td>".  $all_students_videos['academic_years_name']      	."</td>";
                                                echo "<td>".  $all_students_videos['subject_name']      	."</td>";
                                                echo "<td>".  $all_students_videos['course_name']      	."</td>";
                                                echo "<td>".  $all_students_videos['video_name']      	."</td>";

                                                    $stmt3 = $con->prepare("SELECT * FROM lecture_pdf_deliver WHERE student_id = ? AND video_id=?");
                                                    $stmt3->execute(array($all_students_videos["student_id"],$all_students_videos['lecture_id']));
                                                    $count = $stmt3->rowCount();
                                                    
                                                    ?>
                                               <td>
                                                    <button student-id='<?php echo $all_students_videos["student_id"] ?>' lecture-id="<?php echo $all_students_videos['lecture_id'];?>" class='btn btn-primary <?php if($count !=0 ){echo "disabled";} ?> m-2 deliver_lecture order<?php echo $all_students_videos["student_id"] . $all_students_videos["lecture_id"] ?>'>تسليم المحاضره</button>
                                               </td>

                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </main>

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

?>
    
</div>

<?php
require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();