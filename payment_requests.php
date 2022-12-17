<?php    
ob_start();
session_start();   
$page_name = " - جميع طلبات الدفع";
$script = "payments_requests.js";
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
      if(in_array("all_payments_requests",$roles)){
          ?>
        <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

              
                    <div class="container-fluid">
                        <h1 class="mt-4">جامعتي</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع طلبات الدفع</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع طلبات الدفع

                                    
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
                                            <th>رقم الطلب</th>
                                            <th>اسم الطالب</th>             
                                            <th>ايميل الطالب</th>             
                                            <th>هاتف الطالب</th>             
                                            <th>رقم عملية الدفع</th>             
                                            <th>السعر الاجمالي</th>             
                                            <th>الكوبون المستخدم</th>             
                                            <th>ارقام المحاضرات المباعه</th>             
                                            <th>انشئ في </th>          
                                            <th>تسليم المحاضرات المباعه</th>                               
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>رقم الطلب</th>
                                            <th>اسم الطالب</th>             
                                            <th>ايميل الطالب</th>             
                                            <th>هاتف الطالب</th>             
                                            <th>رقم عملية الدفع</th>             
                                            <th>السعر الاجمالي</th>             
                                            <th>الكوبون المستخدم</th>             
                                            <th>ارقام المحاضرات المباعه</th>             
                                            <th>انشئ في </th>          
                                            <th>تسليم المحاضرات المباعه</th>        
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $payment_data = payments_requests();
                                           foreach($payment_data as $data){?>
                                            <tr class="<?php echo "order" . $data['id']; ?>">
                                                <?php
                                                echo "<td>".  $data['id']  	."</td>";
                                                echo "<td style='font-weight:900'>".  $data['student_name']      	."</td>";
                                                echo "<td>".  $data['student_email']      	."</td>";
                                                echo "<td>".  $data['student_phone']      	."</td>";
                                                echo "<td>".  $data['process_id']      	."</td>";
                                                echo "<td>".  $data['price']      	." EGP</td>";
                                                if($data['coupone'] == 0){
                                                    echo "<td>لا يوجد كوبون مستخدم</td>";
                                                }else{
                                                    echo "<td>".  $data['coupone']      	."</td>";
                                                }
                                                echo "<td>".  $data['videos_id']      	."</td>";
                                                echo "<td>".  $data['created_at']      	."</td>";
                                                echo "<td>
                                                <a videos-id='".$data['videos_id']."' order-id='".$data['id']."' student-id='".$data['student_id']."' href=''
                                                class='btn finish_payment btn-success belete_btn m-2'>تسليم المحاضرات<i class='bx bxs-user-minus m-1'></i></a> " . "</td>";


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
    var doctor_id = $(this).attr('doctor-id');

$.ajax({
type: "POST",
url: 'delete_ajax.php',
dataType:'JSON',
data: {
    "id":doctor_id,
    "from":"doctors"
},
success: function(data){
    console.log(data);
    if(data.status == true){
        $('.doctor'+data.doctor_id).remove();
        toastr.success('تم بنجاح :- تم حذف الدكتور بنجاح');
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