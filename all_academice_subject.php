<?php    
ob_start();
session_start();   
$page_name = " - جميع السنوات / المواد الدراسيه";
include "init.php";
if(isset($_SESSION['admin_id'])){ 
$role_data = getData_with_id('roles',$_SESSION['role']); // $_SESSION['role'] => role id

$roles= explode("/",$role_data['authentications']) ;
// if(isset($_SESSION['role'])){
    // if(in_array("all_admin",$data_ex)){
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
      

    ?> 
    <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

            
            <?php 
                    if(isset($_GET['to']) && strlen($_GET['to'])==14 && $_GET['to'] = "academic_years"){
                        if(in_array("all_academic_years",$roles)){
                        ?>
                        <div class="tableOfHosters table-responsive">
                            <a href="add_academice_subject.php?to=academic_years">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة سنه دراسيه  <i class='bx bxs-user-plus'></i></button></a>
                            <main>
              
                    <div class="container-fluid">
                        <h1 class="mt-4">جامعتك</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع السنوات الدراسيه</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع السنوات الدراسيه
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
                                            <th>تعديل السنه</th>             
                                            <th>حذف السنه</th>             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم السنه</th>
                                            <th>اسم السنه</th>
                                            <th>الجامعه</th>   
                                            <th>الكليه</th>             
                                            <th>تعديل السنه</th>             
                                            <th>حذف السنه</th>   
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
                                                echo "<td>
                                                <a href='update_academice_subject.php?to=academic_years&id=".$academic_data['id']."'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a academic_year-id='".$academic_data['id']."' href=''
                                                class='btn deletebtn btn-danger belete_btn m-2'>حذف<i class='bx bxs-user-minus m-1'></i></a> " . "</td>";
                                
                                                echo "</td>";?>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        </div>
                        <script>

                                $(document).on("click",".belete_btn",function(e){
                                    e.preventDefault();
                                    var university_id = $(this).attr('academic_year-id');

                                $.ajax({
                                type: "POST",
                                url: 'delete_ajax.php',
                                dataType:'JSON',
                                data: {
                                    "id":university_id,
                                    "from":"academic_year"
                                },
                                success: function(data){
                                    console.log(data);
                                    if(data.status == true){
                                        $('.academic_year'+data.academic_year_id).remove();
                                        toastr.success('تم بنجاح :- تم حذف العام الدراسي بنجاح');
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

                    <?php }else{
      if(in_array("all_subjects",$roles)){
                        
                        ?>

                        <div class="tableOfHosters table-responsive">
                            <a href="add_academice_subject.php">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة ماده دراسيه  <i class='bx bxs-user-plus'></i></button></a>
                            <main>

                        <div class="container-fluid">
                        <h1 class="mt-4">جامعتك</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع المواد الدراسيه</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع المواد الدراسيه
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
                                            <th>رقم الماده</th>
                                            <th>اسم الماده</th>       
                                            <th>الجامعه</th>       
                                            <th>الكليه</th>       
                                            <th>السنه الدراسيه</th>           
                                            <th>تعديل الماده</th>             
                                            <th>حذف الماده</th>             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم الماده</th>
                                            <th>اسم الماده</th>     
                                            <th>الجامعه</th>       
                                            <th>الكليه</th>       
                                            <th>السنه الدراسيه</th>            
                                            <th>تعديل الماده</th>             
                                            <th>حذف الماده</th>  
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $all_subjects = all_subjects();
                                           foreach($all_subjects as $subject_data){?>
                                            <tr class="<?php echo "subjects" . $subject_data['id']; ?>">
                                                <?php 
                                                echo "<td>".  $subject_data['id']  	."</td>";
                                                echo "<td>".  $subject_data['name'] 	."</td>";
                                                echo "<td>".  $subject_data['university_name']  	."</td>";
                                                echo "<td>".  $subject_data['faculty_name']  	."</td>";
                                                echo "<td>".  $subject_data['academic_years_name']  	."</td>";
                                                echo "<td>
                                                <a href='update_academice_subject.php?id=".$subject_data['id']."'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a subjects-id='".$subject_data['id']."' href=''
                                                class='btn deletebtn btn-danger belete_btn m-2'>حذف<i class='bx bxs-user-minus m-1'></i></a> " . "</td>";
                                
                                                echo "</td>";?>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php }else{
                        echo "
                        <script>
                        toastr.success('ليس من صلاحياتك الوصول لهذه الصفحه')
                        </script>";
                        header("Refresh:1;url=admin_dash.php");
                    }}?>
                </main>

          </div>
        </div>
      </div>
    </div>
</div>
<script>

    $(document).on("click",".belete_btn",function(e){
        e.preventDefault();
        var subjects_id = $(this).attr('subjects-id');

    $.ajax({
     type: "POST",
     url: 'delete_ajax.php',
     dataType:'JSON',
     data: {
        "id":subjects_id,
        "from":"subjects"
    },
     success: function(data){
         if(data.status == true){
             $('.subjects'+data.subjects_id).remove();
            toastr.success('تم بنجاح :- تم حذف بيانات الماده الدراسيه بنجاح');
         }
     }
});
})
</script>
<?php
require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();