<?php    
ob_start();
session_start();   
$script = "all_student.js";
$page_name = " - جميع فيديوهات الكورسات";
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
                            <li class="breadcrumb-item active">جميع فيديوهات الكورسات</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع فيديوهات الكورسات

                                    
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
                                            <th>#</th>
                                            <th>اسم الفيديو</th>             
                                            <th>رقم الفيديو</th>             
                                            <th>رقم القناه</th>             
                                            <th>السعر</th>             
                                            <th>الخصم</th>             
                                            <th>الجامعه</th>             
                                            <th>الكليه</th>             
                                            <th>السنه الدراسيه</th>             
                                            <th>الماده الدراسيه</th>             
                                            <th>اسم الكورس</th>             
                                            <th>اسم القسم</th>             
                                            <th>الدكتور</th>  
                                            <th>صورة</th>     
                                            <th>ملف المحاضره</th>         
                                            <th>اضيف / عدل بواسطة</th>            
                                            <th>اضيف في </th>             
                                            <th>عدل في </th>             
                                            <th>تعديل الفيديو</th>             
                                            <th>حذف الفيديو</th>                        
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>اسم الفيديو</th>             
                                            <th>رقم الفيديو</th>             
                                            <th>رقم القناه</th>             
                                            <th>السعر</th>             
                                            <th>الخصم</th>             
                                            <th>الجامعه</th>             
                                            <th>الكليه</th>             
                                            <th>السنه الدراسيه</th>             
                                            <th>الماده الدراسيه</th>             
                                            <th>اسم الكورس</th>             
                                            <th>اسم القسم</th>             
                                            <th>الدكتور</th>             
                                            <th>صورة</th>             
                                            <th>ملف المحاضره</th>             
                                            <th>اضيف / عدل بواسطة</th>             
                                            <th>اضيف في </th>             
                                            <th>عدل في </th>             
                                            <th>تعديل الفيديو</th>             
                                            <th>حذف الفيديو</th>  
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $videos = all_videos();
                                           foreach($videos as $video_data){?>
                                            <tr class="<?php echo "videos" . $video_data['id']; ?>">
                                                <?php
                                                echo "<td>".  $video_data['id']  	."</td>";
                                                echo "<td style='font-weight:900'>".  $video_data['video_name']      	."</td>";
                                                echo "<td>".  $video_data['video_id']      	."</td>";
                                                echo "<td>".  $video_data['channel_id']      	."</td>";
                                                echo "<td>".  $video_data['price']      	."</td>";
                                                echo "<td>".  $video_data['discound']      	."</td>";
                                                echo "<td>".  $video_data['university_name']      	."</td>";
                                                echo "<td>".  $video_data['faculty_name']      	."</td>";
                                                echo "<td>".  $video_data['academic_years_name']      	."</td>";
                                                echo "<td>".  $video_data['subject_name']      	."</td>";
                                                echo "<td>".  $video_data['course_name']      	."</td>";
                                                echo "<td>".  $video_data['dep_name']      	."</td>";
                                                echo "<td>".  $video_data['course_doctor']      	."</td>";?>
                                                <td>
                                                <img src="./img/videos/<?php echo $video_data['img'];?>" width="100" height="100">
                                                </td>
                                                <td>
                                                <?php if(!empty($video_data['pdf'])){ ?>
                                                <a href='./img/videos_pdfs/<?php echo $video_data['pdf'];?>' target="_blank" class='btn editbtn btn-success m-2'>ملف المحاضره <i class="fas fa-file-pdf m-1"></i></a> 
                                                <?php }else{ ?>
                                                    <button disabled class='btn editbtn btn-success m-2 disabled'>ملف المحاضره <i class="fas fa-file-pdf m-1"></i></button> 
                                                <?php } ?>
                                                </td>
                                                <?php
                                                echo "<td>".  $video_data['admin_name']      	."</td>";
                                                echo "<td>".  $video_data['created_at']      	."</td>";
                                                if($video_data['updated_at'] == 0){
                                                    echo "<td style='font-weight:900'>".  "Not Updated"      	."</td>";
                                                }else{
                                                    echo "<td>".  $video_data['updated_at']      	."</td>";
                                                }

                                                echo "<td>
                                                <a href='update_videos.php?id=".$video_data['id']."'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a video-id='".$video_data['id']."' href=''
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
    var video_id = $(this).attr('video-id');

$.ajax({
type: "POST",
url: 'delete_ajax.php',
dataType:'JSON',
data: {
    "id":video_id,
    "from":"video"
},
success: function(data){
    console.log(data);
    if(data.status == true){
        $('.videos'+data.video_id).remove();
        toastr.success('تم بنجاح :- تم حذف الفيديو بنجاح');
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