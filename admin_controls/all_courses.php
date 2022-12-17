<?php    
ob_start();
session_start();   
$script = "all_student.js";
$page_name = " - جميع الكورسات";
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
      if(in_array("all_courses",$roles)){
          ?>
        <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

              
                    <div class="container-fluid">
                        <h1 class="mt-4">جامعتي</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع الكورسات</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع الكورسات

                                    
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
                                            <th>رقم الكورس</th>
                                            <th>اسم الكورس</th>             
                                            <th>الدكتور</th>             
                                            <th>الجامعه</th>             
                                            <th>الكليه</th>             
                                            <th>السنه الدراسيه</th>             
                                            <th>الماده الدراسيه</th>   
                                            <th>اضيف / عدل بواسطة</th>          
                                            <th>اضيف في </th>             
                                            <th>عدل في </th>             
                                            <th>تعديل الكورس</th>             
                                            <th>حذف الكورس</th>                        
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم الكورس</th>
                                            <th>اسم الكورس</th>             
                                            <th>الدكتور</th>             
                                            <th>الجامعه</th>             
                                            <th>الكليه</th>             
                                            <th>السنه الدراسيه</th>             
                                            <th>الماده الدراسيه</th>             
                                            <th>اضيف / عدل بواسطة</th>             
                                            <th>اضيف في </th>             
                                            <th>عدل في </th>             
                                            <th>تعديل الكورس</th>             
                                            <th>حذف الكورس</th>   
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $courses = all_courses();
                                           foreach($courses as $course_data){?>
                                            <tr class="<?php echo "course" . $course_data['id']; ?>">
                                                <?php
                                                echo "<td>".  $course_data['id']  	."</td>";
                                                echo "<td style='font-weight:900'>".  $course_data['name']      	."</td>";
                                                $doctor_data = getData_with_id("doctors",$course_data["doctor"]);
                                                echo "<td>".  $doctor_data['name']      	."</td>";
                                                echo "<td>".  $course_data['university_name']      	."</td>";
                                                echo "<td>".  $course_data['faculty_name']      	."</td>";
                                                echo "<td>".  $course_data['academic_years_name']      	."</td>";
                                                echo "<td>".  $course_data['subject_name']      	."</td>";
                                                echo "<td>".  $course_data['admin_name']      	."</td>";
                                                echo "<td>".  $course_data['created_at']      	."</td>";
                                                if($course_data['updated_at'] == 0){
                                                    echo "<td style='font-weight:900'>".  "Not Updated"      	."</td>";
                                                }else{
                                                    echo "<td>".  $course_data['updated_at']      	."</td>";
                                                }

                                                echo "<td>
                                                <a href='update_courses.php?id=".$course_data['id']."'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a course-id='".$course_data['id']."' href=''
                                                class='btn deletebtn btn-danger belete_btn m-2'>حذف<i class='bx bxs-user-minus m-1'></i></a> " . "</td>";


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
    <script>

$(document).on("click",".deletebtn",function(e){
    e.preventDefault();
    var course_id = $(this).attr('course-id');

$.ajax({
type: "POST",
url: 'delete_ajax.php',
dataType:'JSON',
data: {
    "id":course_id,
    "from":"course"
},
success: function(data){
    console.log(data);
    if(data.status == true){
        $('.course'+data.course_id).remove();
        toastr.success('تم بنجاح :- تم حذف الكورس بنجاح');
    }
}
});
})
</script>
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