<?php    
ob_start();
session_start();   
$script = "all_student.js";
$page_name = " - جميع الفيديوهات المهداه";
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
      if(in_array("all_gifted_videos",$roles)){
          ?>
        <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

              
                    <div class="container-fluid">
                        <h1 class="mt-4">جامعتي</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع الفيديوهات المهداه</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع الفيديوهات المهداه

                                    
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
                                            <th>رقم المستخدم</th>
                                            <th>اسم المستخدم</th> 
                                            <th>ايميل المستخدم</th>             
                                            <th>رقم الفيديو</th>             
                                            <th>اسم الفيديو</th>             
                                            <th>اسم الكورس</th>             
                                            <th>الماده الدراسيه</th>             
                                            <th>السنه الدراسيه</th>             
                                            <th>الكليه</th>             
                                            <th>الجامعه</th>             
                                            <th>اسم المسئول</th>             
                                            <th>سجل في</th>                       
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم المستخدم</th>
                                            <th>اسم المستخدم</th> 
                                            <th>ايميل المستخدم</th>             
                                            <th>رقم الفيديو</th>             
                                            <th>اسم الفيديو</th>             
                                            <th>اسم الكورس</th>             
                                            <th>الماده الدراسيه</th>             
                                            <th>السنه الدراسيه</th>             
                                            <th>الكليه</th>             
                                            <th>الجامعه</th>   
                                            <th>اسم المسئول</th>                       
                                            <th>سجل في</th> 
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $videos = All_Gifted_videos();
                                           foreach($videos as $video_data){ ?>
                                            <tr class="<?php echo "videos" . $video_data['id']; ?>">
                                                <?php
                                                echo "<td>".  $video_data['student_id']  	."</td>";
                                                echo "<td>".  $video_data['student_name']      	."</td>";
                                                echo "<td>".  $video_data['email']      	."</td>";
                                                echo "<td>".  $video_data['video_id']      	."</td>";
                                                echo "<td>".  $video_data['video_name']      	."</td>";
                                                echo "<td>".  $video_data['course_name']      	."</td>";
                                                echo "<td>".  $video_data['subject_name']      	."</td>";
                                                echo "<td>".  $video_data['academic_years_name']      	."</td>";
                                                echo "<td>".  $video_data['faculty_name']      	."</td>";
                                                echo "<td>".  $video_data['university_name']      	."</td>";
                                                $admin_data = getData_with_id("admins",$video_data['admin_id']);
                                                echo "<td>".  $admin_data['admin_name']      	."</td>";
                                                echo "<td>".  $video_data['created_at']      	."</td>";


                                                echo "</td>";
                                                
                                                
                                                
                                                ?>
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