<?php    
ob_start();
session_start();   
$page_name = " - جميع الجامعات / الكليات";
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
                    if(isset($_GET['to']) && strlen($_GET['to'])==10 && $_GET['to'] = "university"){
                        if(in_array("all_universities",$roles)){
                        ?>
                        <div class="tableOfHosters table-responsive">
                            <a href="add_university_faculty.php?to=university">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة جامعه  <i class='bx bxs-user-plus'></i></button></a>
                            <main>
              
                    <div class="container-fluid">
                        <h1 class="mt-4">جامعتك</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع الجامعات</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع الجامعات
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
                                            <th>رقم الجامعه</th>
                                            <th>اسم الجامعه</th>             
                                            <th>تعديل الجامعه</th>             
                                            <th>حذف الجامعه</th>             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم الجامعه</th>
                                            <th>اسم الجامعه</th>
                                            <th>تعديل الجامعه</th>             
                                            <th>حذف الجامعه</th>   
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $all_universities = getAllData("university");
                                           foreach($all_universities as $university_data){
                                            ?>
                                            <tr class="<?php echo "university" . $university_data['id']; ?>">
                                                <?php echo "<td>".  $university_data['id']  	."</td>";
                                                echo "<td>".  $university_data['name']      	."</td>";
                                                echo "<td>
                                                <a href='update_university_faculty.php?to=university&id=".$university_data['id']."'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a university-id='".$university_data['id']."' href=''
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
                                    var university_id = $(this).attr('university-id');

                                $.ajax({
                                type: "POST",
                                url: 'delete_ajax.php',
                                dataType:'JSON',
                                data: {
                                    "id":university_id,
                                    "from":"university"
                                },
                                success: function(data){
                                    console.log(data);
                                    if(data.status == true){
                                        $('.university'+data.university_id).remove();
                                        toastr.success('تم بنجاح :- تم حذف الكلية بنجاح');
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
      if(in_array("all_faculties",$roles)){
                        
                        ?>

                        <div class="tableOfHosters table-responsive">
                            <a href="add_university_faculty.php">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة كلية  <i class='bx bxs-user-plus'></i></button></a>
                            <main>

                        <div class="container-fluid">
                        <h1 class="mt-4">جامعتك</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع الكليات</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع الكليات
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
                                            <th>رقم الكلية</th>
                                            <th>اسم الكلية</th>       
                                            <th>الجامعه</th>      
                                            <th>تعديل الكلية</th>             
                                            <th>حذف الكلية</th>             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم الكلية</th>
                                            <th>اسم الكلية</th>       
                                            <th>الجامعه</th>      
                                            <th>تعديل الكلية</th>             
                                            <th>حذف الكلية</th>  
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $all_faculties = all_faculty();
                                           foreach($all_faculties as $faculty_data){?>
                                            <tr class="<?php echo "faculty" . $faculty_data['id']; ?>">
                                                <?php 
                                                echo "<td>".  $faculty_data['id']  	."</td>";
                                                echo "<td>".  $faculty_data['name'] 	."</td>";
                                                echo "<td>".  $faculty_data['university_name']  	."</td>";
                                                echo "<td>
                                                <a href='update_university_faculty.php?id=".$faculty_data['id']."'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a faculty-id='".$faculty_data['id']."' href=''
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
        var faculty_id = $(this).attr('faculty-id');

    $.ajax({
     type: "POST",
     url: 'delete_ajax.php',
     dataType:'JSON',
     data: {
        "id":faculty_id,
        "from":"faculty"
    },
     success: function(data){
         if(data.status == true){
             $('.faculty'+data.faculty_id).remove();
            toastr.success('تم بنجاح :- تم حذف بيانات الكلية بنجاح');
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