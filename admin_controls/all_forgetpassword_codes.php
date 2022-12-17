<?php    
ob_start();
session_start();   
$script = "all_student.js";
$page_name = " - جميع اكواد نسيان كلمة السر";
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
      if(in_array("all_forgetpassword_codes",$roles)){
          ?>
        <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

              
                    <div class="container-fluid">
                        <h1 class="mt-4">جامعتي</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع اكواد نسيان كلمة السر</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع اكواد نسيان كلمة السر

                                    
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
                                            <th>رقم العمليه</th>
                                            <th>اسم الطالب</th>
                                            <th>البريد الالكتروني</th>
                                            <th>كود التاكيد</th>
                                            <th>تم انشائه في</th>                                            
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم العمليه</th>
                                            <th>اسم الطالب</th>
                                            <th>البريد الالكتروني</th>
                                            <th>كود التاكيد</th>
                                            <th>تم انشائه في</th>      
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $activation_codes = getAllData("forget_password");
                                           foreach($activation_codes as $all_activation_codes){
                                            echo"<tr>";
                                                echo "<td>".  $all_activation_codes['id']  	."</td>";

                                                $student_data = select_member_by_id("students" ,$all_activation_codes['student_id']);
                                                echo "<td>".  $student_data['student_name']      	."</td>";
                                                echo "<td>".  $student_data['email']      	."</td>";
                                                echo "<td>".  $all_activation_codes['code']      	."</td>";
                                                echo "<td>".  $all_activation_codes['time']      	."</td>";
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