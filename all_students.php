<?php    
ob_start();
session_start();   
$script = "all_student.js";
$page_name = " - جميع المستخدمين";
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
      if(in_array("all_students",$roles)){
          ?>
        <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

              
                    <div class="container-fluid">
                        <h1 class="mt-4">جامعتي</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع المستخدمين</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع المستخدمين

                                    
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
                                            <th>هاتف المستخدم</th>  
                                            <th>تاريخ الميلاد</th>                        
                                            <th>الجامعه</th>             
                                            <th>الكليه</th>             
                                            <th>السنه الدراسيه</th>             
                                            <th>سجل في</th>             
                                            <th>عدل في</th>                       
                                            <th>حالة الايميل</th>             
                                            <th>حالة الهاتف</th>             
                                            <th>اهداء فيديو</th>             
                                            <th>حظر المستخدم</th>   
                                            <th>تسجل الخروج من جميع الاجهزه</th>                      
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم المستخدم</th>
                                            <th>اسم المستخدم</th>             
                                            <th>ايميل المستخدم</th>             
                                            <th>هاتف المستخدم</th>             
                                            <th>تاريخ الميلاد</th>             
                                            <th>الجامعه</th>             
                                            <th>الكليه</th>             
                                            <th>السنه الدراسيه</th>             
                                            <th>سجل في</th>             
                                            <th>عدل في</th>             
                                            <th>حالة الايميل</th>             
                                            <th>حالة الهاتف</th>             
                                            <th>اهداء فيديو</th> 
                                            <th>حظر المستخدم</th> 
                                            <th>تسجل الخروج من جميع الاجهزه</th> 
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $students = getAllData("students");
                                           foreach($students as $all_students){
                                            echo"<tr>";
                                                echo "<td>".  $all_students['id']  	."</td>";
                                                echo "<td>".  $all_students['student_name']      	."</td>";
                                                echo "<td>".  $all_students['email']      	."</td>";
                                                echo "<td>".  $all_students['phone']      	."</td>";
                                                if(isset($all_students['birthday'])){
                                                    echo "<td>".  $all_students['birthday']      	."</td>";
                                                }else{
                                                    echo "<td>". "غير محدد"      	."</td>";
                                                }
                                                echo "<td>".  $all_students['university']      	."</td>";
                                                echo "<td>".  $all_students['faculty']      	."</td>";
                                                echo "<td>".  $all_students['academic_year']      	."</td>";
                                                echo "<td>".  $all_students['created_at']      	."</td>";
                                                if($all_students['updated_at'] == 0){
                                                    echo "<td style='font-weight:900'>".  "Not Updated"      	."</td>";
                                                }else{
                                                    echo "<td>".  $video_data['updated_at']      	."</td>";
                                                }
                                                if($all_students['email_verified_at'] != 0){
                                                    echo '<td><div class="ui green label"><i style="font-size:15px" class="fas fa-check-circle"></i> Verified</div></td>';}else{echo '<td><div class="ui yellow label"><i style="font-size:15px" class="fad fa-hourglass-end"></i> non-Verified</div></td>';
                                                }
                                                if($all_students['phone_verified_at'] != 0){
                                                    echo '<td><div class="ui green label"><i style="font-size:15px" class="fas fa-check-circle"></i> Verified</div></td>';}else{echo '<td><div class="ui yellow label"><i style="font-size:15px" class="fad fa-hourglass-end"></i> non-Verified</div></td>';
                                                }
                                                if($all_students['blocked'] == 1){
                                                    $block_state = "display:none";
                                                    $un_block_state = "";
                                                }else{
                                                    $un_block_state = "display:none";
                                                    $block_state="";
                                                }
                                                echo "<td>
                                               <a href='gift_video.php?student_id=" . $all_students['id'] . "' class='btn btn-primary m-2'>اهداء فيديو<i class='fal fa-gift m-1'></i></a></td>";
                                                echo "<td>
                                               <a href='' style='" . $block_state . "' student-id=" . $all_students['id'] . "
                                                class='btn blockbtn blockbtn_" . $all_students['id'] . " btn-danger m-2'>حظر<i class='bx bxs-user-minus m-1'></i></a> 
                                                
                                                <a href= '' style='" . $un_block_state . "' student-id=" . $all_students['id'] . "
                                                class='btn unblock unblock_" . $all_students['id'] . " btn-primary m-2'>الغاء الحظر<i class='bx bxs-user-minus m-1'></i></a>

                                                " . "</td>";
                                                
                                                echo "<td> <a href= '' student-id=" . $all_students['id'] . "
                                                class='btn signout btn-warning m-2'>تسجل الخروج من الاجهزه<i class='bx bxs-user-minus m-1'></i></a>  </td>";


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