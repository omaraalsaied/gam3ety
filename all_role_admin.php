<?php    
ob_start();
session_start();   
$page_name = " - جميع الصلاحيات / المسئولين";
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
                    if(isset($_GET['to']) && strlen($_GET['to'])==4 && $_GET['to'] = "role"){
                        if(in_array("all_role",$roles)){
                        ?>
                        <div class="tableOfHosters table-responsive">
                            <a href="add_role_admin.php?to=role">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة صلاحيه  <i class='bx bxs-user-plus'></i></button></a>
                            <main>
              
                    <div class="container-fluid">
                        <h1 class="mt-4">جامعتي</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع الصلاحيات</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع الصلاحيات
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
                                            <th>رقم الصلاحيه</th>
                                            <th>اسم الصلاحيه</th>             
                                            <th>الصلاحيات</th>             
                                            <th>تعديل الصلاحيه</th>             
                                            <th>حذف الصلاحيه</th>             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم الصلاحيه</th>
                                            <th>اسم الصلاحيه</th>
                                            <th>الصلاحيات</th>
                                            <th>تعديل الصلاحيه</th>             
                                            <th>حذف الصلاحيه</th>   
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $all_roles = getAllData("roles");
                                           foreach($all_roles as $role_data){

                                            $auth = [
                                                
                                                "add_admin"                         =>"اضافة مسئول",
                                                "all_admin"                         =>"تعديل وحزف مسئول",
                                                "add_role"                          =>"اضافة صلاحيه",
                                                "all_role"                          =>"تعديل / حذف صلاحيه",
                                                "add_university"                    =>"اضافة جامعه",
                                                "all_universities"                  =>"تعديل / حذف جامعه",
                                                "add_faculty"                       =>"اضافة كلية",
                                                "all_faculties"                     =>"تعديل / حذف كلية",
                                                "add_academic_years"                =>"اضافة سنة دراسيه",
                                                "all_academic_years"                =>"تعديل / حذف سنة دراسيه",
                                                "add_subject"                       =>"اضافة ماده دراسيه",
                                                "all_subjects"                      =>"تعديل / حذف ماده دراسيه",
                                                "add_courses"                       =>"اضافة كوسات",
                                                "all_courses"                       =>"تعديل / حذف كوسات",
                                                "add_dep"                           =>"اضافة قسم",
                                                "all_dep"                           =>"تعديل / حذف قسم",
                                                "add_videos"                        =>"اضافة فيديوهات",
                                                "all_videos"                        =>"تعديل / حذف فيديوهات",
                                                "add_doctor"                        =>"اضافة دكتور",
                                                "all_doctors"                       =>"تعديل / حذف دكتور",
                                                "add_coupone"                       =>"اضافة كوبون خصم",
                                                "all_coupone"                       =>"تعديل / حذف كوبون خصم",
                                                "all_students"                      =>"جميع المستخدمين",
                                                "all_activation_codes"              =>"جميع اكواد التاكيد",
                                                "all_forgetpassword_codes"          =>"جميع اكواد نسيان كلمة السر",
                                                "all_payments_requests"             =>"جميع طلبات الشراء'",
                                                "all_blocked_students"              =>"المستخدمين المحظورين",
                                                "all_students_videos"               =>"جميع فيديوهات المستخدمين",
                                                "gift_video"                        =>"اهداء فيديو",
                                                "all_gifted_videos"                 =>"جميع الفيديوهات المهداه",
                                                "all_videos_statistics"             =>"مرات شراء الفيديوهات",
                                                "payments"                          =>"عمليات الدفع",
                                                "contact_request"                   =>"طلبات المراسله",
                                                "all_years_sold_videos"             =>"الفيديوهات المباعه في السنين الدراسيه",
                                                "all_students_ips"                  =>"اجهزة المسجله بواسطة الطلاب",
                                                "order_pdf"                         =>"تسليم المحاضرات المطبعوعه",
                                            
                                            ];
                                            ?>
                                            <tr class="<?php echo "role" . $role_data['id']; ?>">
                                                <?php echo "<td>".  $role_data['id']  	."</td>";
                                                echo "<td>".  $role_data['role_name']      	."</td>";
                                             ?>
                                                <td><?php                                                 
                                                $roles = $role_data['authentications'];
                                                $imp_data = explode("/",$roles);
                                                for($i=0;$i<sizeof($imp_data);$i++){
                                                    // for($j=0;$j<sizeof($auth)+110;$j++){
                                                    foreach($auth as $key => $value){
                                                        if($key == $imp_data[$i]){
                                                           echo $value . " - ";
                                                        }
                                                        unset($key);
                                                    }
                                                }?></td><?php 
                                                echo "<td>
                                                <a href='update_role_admin.php?to=role&id=".$role_data['id']."'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a role-id='".$role_data['id']."' href=''
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
                                    var role_id = $(this).attr('role-id');

                                $.ajax({
                                type: "POST",
                                url: 'delete_ajax.php',
                                dataType:'JSON',
                                data: {
                                    "id":role_id,
                                    "from":"role"
                                },
                                success: function(data){
                                    console.log(data);
                                    if(data.status == true){
                                        $('.role'+data.role_id).remove();
                                        toastr.success('تم بنجاح :- تم حذف الصلاحيه بنجاح');
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
      if(in_array("all_admin",$roles)){
                        
                        ?>

                        <div class="tableOfHosters table-responsive">
                            <a href="add_role_admin.php">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">اضافة مسئول  <i class='bx bxs-user-plus'></i></button></a>
                            <main>

                        <div class="container-fluid">
                        <h1 class="mt-4">جامعتي</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع المسئولين</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع المسئولين
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
                                            <th>رقم المسئول</th>
                                            <th>اسم المسئول</th>       
                                            <th>البريد الالكتروني</th>      
                                            <th>الصلاحيه</th>
                                            <th>اضيف/عدل بواسطة</th>      
                                            <th>اضيف في</th>      
                                            <th>عدل في</th>      
                                            <th>تعديل البيانات</th>             
                                            <th>حذف البيانات</th>             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم المسئول</th>
                                            <th>اسم المسئول</th>
                                            <th>البريد الالكتروني</th>
                                            <th>الصلاحيه</th>
                                            <th>اضيف/عدل بواسطة</th>      
                                            <th>اضيف في</th>      
                                            <th>عدل في</th>      
                                            <th>تعديل البيانات</th>             
                                            <th>حذف البيانات</th>   
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $all_admin = getAllData("admins");
                                           foreach($all_admin as $admin_data){?>
                                            <tr class="<?php echo "admin" . $admin_data['id']; ?>">
                                                <?php 
                                                echo "<td>".  $admin_data['id']  	."</td>";
                                                echo "<td>".  $admin_data['admin_name'] 	."</td>";
                                                echo "<td>".  $admin_data['email']  	."</td>";
                                                $admin_role = select_by_id("roles" ,$admin_data['role_id']);
                                                $added_by = select_by_id("admins" ,$admin_data['added_by']);
                                                echo "<td>".  $admin_role['role_name']  	."</td>";
                                                echo "<td>".  $added_by['admin_name']  	."</td>";
                                                echo "<td>".  $admin_data['added_at']  	."</td>";
                                                if($admin_data['updated_at'] == 0){
                                                    echo "<td style='font-weight:900'>".  "Not Updated"      	."</td>";
                                                }else{
                                                    echo "<td>".  $admin_data['updated_at']      	."</td>";
                                                }
                                                echo "<td>
                                                <a href='update_role_admin.php?id=".$admin_data['id']."'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a admin-id='".$admin_data['id']."' href=''
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
        var admin_id = $(this).attr('admin-id');

    $.ajax({
     type: "POST",
     url: 'delete_ajax.php',
     dataType:'JSON',
     data: {
        "id":admin_id,
        "from":"admins"
    },
     success: function(data){
         if(data.status == true){
             $('.admin'+data.admin_id).remove();
            toastr.success('تم بنجاح :- تم حذف بيانات المسؤول بنجاح');
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