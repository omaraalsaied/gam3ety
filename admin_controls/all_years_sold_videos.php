<?php    
ob_start();
session_start();   
$script = "all_student.js";
$page_name = " - مرات شراء الفيديوهات بالسنوات الدراسيه";
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
      if(in_array("all_years_sold_videos",$roles)){
          ?>
        <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

              
                    <div class="container-fluid">
                        <h1 class="mt-4">جامعتي</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">مرات شراء الفيديوهات بالسنوات الدراسيه</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    مرات شراء الفيديوهات بالسنوات الدراسيه

                                    
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
                                            <th>رقم السنه</th>
                                            <th>اسم السنه</th>             
                                            <th>الجامعه</th>             
                                            <th>الكليه</th>             
                                            <th>مرات البيع</th>                                       
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم السنه</th>
                                            <th>اسم السنه</th>             
                                            <th>الجامعه</th>             
                                            <th>الكليه</th>     
                                            <th>مرات البيع</th>                     
      
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                        <?php 
                                           $all_academic_years = academic_years();
                                           foreach($all_academic_years as $academic_data){
                                            ?>
                                            <tr class="<?php echo "academic_year" . $academic_data['id']; ?>">
                                                <?php echo "<td>".  $academic_data['id']  	."</td>";
                                                echo "<td>".  $academic_data['name']      	."</td>";
                                                echo "<td>".  $academic_data['university_name']      	."</td>";
                                                echo "<td>".  $academic_data['faculty_name']      	."</td>";
                                                echo "<td style='font-weight:900;color:red'>".  count_bought_videos_for_academic_years($academic_data['id'])      	."</td>";
                                
                                                echo "</td>";?>
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