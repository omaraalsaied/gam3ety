<?php    
ob_start();
session_start();   
$script = "all_student.js";
$page_name = " - جميع اجهزة المستخدمين";
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
      if(in_array("all_students_ips",$roles)){
          ?>
        <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

              
                    <div class="container-fluid">
                        <h1 class="mt-4">جامعتي</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع اجهزة المستخدمين</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع اجهزة المستخدمين

                                    
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
                                            <th>الجهاز IP</th>                        
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم المستخدم</th>
                                            <th>اسم المستخدم</th>             
                                            <th>ايميل المستخدم</th>             
                                            <th>هاتف المستخدم</th>             
                                            <th>الجهاز IP</th>             
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $students = all_student_ips();
                                           foreach($students as $all_students){
                                            echo"<tr>";
                                                echo "<td>".  $all_students['student_id']  	."</td>";
                                                echo "<td>".  $all_students['student_name']      	."</td>";
                                                echo "<td>".  $all_students['email']      	."</td>";
                                                echo "<td>".  $all_students['phone']      	."</td>";
                                                echo "<td>".  $all_students['ip']      	."</td>"; 
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