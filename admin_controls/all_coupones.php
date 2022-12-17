<?php    
ob_start();
session_start();   
$script = "all_student.js";
$page_name = " - جميع كوبونات الخصم";
include "init.php";
if(isset($_SESSION['admin_id'])){ 
$role_data = getData_with_id('roles',$_SESSION['role']);

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
      if(in_array("all_coupone",$roles)){
          ?>
        <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

              
                    <div class="container-fluid">
                        <h1 class="mt-4">جامعتي</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع كوبونات الخصم</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع كوبونات الخصم

                                    
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
                                            <th>رقم الكوبون</th>
                                            <th>اسم الكوبون</th>             
                                            <th>كود الكوبون</th>             
                                            <th>الاستخدام</th>             
                                            <th>قيمة الكوبون</th>             
                                            <th>اضيف / عدل بواسطة</th>          
                                            <th>اضيف في </th>             
                                            <th>ينتهي في </th>             
                                            <th>عدل في </th>             
                                            <th>تعديل الكوبون</th>             
                                            <th>حذف الكوبون</th>                        
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم الكوبون</th>
                                            <th>اسم الكوبون</th>             
                                            <th>كود الكوبون</th>     
                                            <th>الاستخدام</th>        
                                            <th>قيمة الكوبون</th>             
                                            <th>اضيف / عدل بواسطة</th>          
                                            <th>اضيف في </th>        
                                            <th>ينتهي في </th>                  
                                            <th>عدل في </th>             
                                            <th>تعديل الكوبون</th>             
                                            <th>حذف الكوبون</th>   
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $coupons = all_coupons();
                                           foreach($coupons as $copon_data){?>
                                            <tr class="<?php echo "coupons" . $copon_data['id']; ?>">
                                                <?php
                                                echo "<td>".  $copon_data['id']  	."</td>";
                                                echo "<td>".  $copon_data['coupone_name']      	."</td>";
                                                echo "<td style='font-weight:900'>".  $copon_data['coupone_code']      	."</td>";?>
                                                <td style='font-weight:900'><?php if($copon_data['one_used'] == 1){echo "الاستخدام مره واحده";}else{echo "غير محدد";} ?></td>
                                                <?php
                                                echo "<td style='font-weight:900'>".  "%" 	. $copon_data['coupone_value'] . "</td>";
                                                echo "<td>".  $copon_data['admin_name']      	."</td>";
                                                echo "<td>".  $copon_data['created_at']      	."</td>";
                                                echo "<td>".  $copon_data['expire_at']      	."</td>";
                                                if($copon_data['updated_at'] == 0){
                                                    echo "<td style='font-weight:900'>".  "Not Updated"      	."</td>";
                                                }else{
                                                    echo "<td>".  $copon_data['updated_at']      	."</td>";
                                                }

                                                echo "<td>
                                                <a href='update_coupone.php?id=".$copon_data['id']."'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a coupone-id='".$copon_data['id']."' href=''
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
    var coupone_id = $(this).attr('coupone-id');

$.ajax({
type: "POST",
url: 'delete_ajax.php',
dataType:'JSON',
data: {
    "id":coupone_id,
    "from":"coupones"
},
success: function(data){
    console.log(data);
    if(data.status == true){
        $('.coupons'+data.coupone_id).remove();
        toastr.success('تم بنجاح :- تم حذف الكوبون بنجاح');
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