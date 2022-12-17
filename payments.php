<?php    
ob_start();
session_start();
$page_name = " - جميع عمليات الدفع والطلبات العاجله";
include "init.php";
$role_data = getData_with_id('roles',$_SESSION['role']); // $_SESSION['role'] => role id

if(isset($_SESSION['admin_id'])){ 
$roles= explode("/",$role_data['authentications']) ; 
// if(isset($_SESSION['role'])){
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
             if(isset($_GET['to']) && strlen($_GET['to'])==13 && $_GET['to'] = "quick_request"){
      if(in_array("quick_requists",$roles)){

        ?>
       
                        <div class="tableOfHosters table-responsive">
                            
              
                    <div class="container-fluid">
                        <h1 class="mt-4">الطلبات العاجله </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع الطلبات العاجله</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع الطلبات العاجله
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
                                        <th>رقم الطلب   </th>
                                        <th>اسم المرسل  </th>
                                        <th>الرساله</th>
                                        <th>المحافظه</th>
                                        <th>المدينه</th>
                                        <th>عدد الاكياس</th>
                                        <th>الوقت</th>
                                        <th>حذف الطلب</th>
                                                         
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>رقم الطلب   </th>
                                        <th>اسم المرسل  </th>
                                        <th>الرساله</th>
                                        <th>المحافظه</th>
                                        <th>المدينه</th>
                                        <th>عدد الاكياس</th>
                                        <th>الوقت</th>
                                        <th>حذف الطلب</th>
                                              
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $all_requests = getAllData("quick_request");
                                           foreach($all_requests as $request_data){
                                            $place = select_by_id('donate_places',$request_data['place_id']);
                                            $city =select_by_id('cities',$place['city_id']);
                                            $gov =select_by_id('governorate',$city['gov_id']);
                                            $user_data =select_user_by_id('patients_donors',$request_data['p_ssn']);

                                           
                                              
                                                 	
                                            echo"<tr>";
                                                 echo "<td>".  $request_data['id']      	."</td>";
                                                echo "<td>".  $user_data['p_first_name'] . " " .  $user_data['p_last_name']    	."</td>";
                                                echo "<td>".  $request_data['message']  	."</td>";
                                                echo "<td>".  $gov['name']      	."</td>";
                                                echo "<td>".  $city['name']  	."</td>";
                                                echo "<td>".  $request_data['blood_bags_number']  	."</td>";

                                                echo "<td>".  $request_data['time']      	."</td>";
                                                echo "<td>
                                <a href='delete.php?from=quick_request&id=".$request_data['id']."'
                                class='btn deletebtn btn-danger m-2'>حذف<i class='bx bxs-user-minus m-1'></i></a> " . "</td>";
                
                                echo "</td>";
                                
                                                echo "</tr>";?>
                                            <?php }?>
                                        </tbody>
                                    </table>
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
             }else{ 
      if(in_array("payments",$roles)){
                 
                 ?>
                <div class="tableOfHosters table-responsive">
                            
                            <main>
              
                    <div class="container-fluid">
                        <h1 class="mt-4">عمليات الدفع </h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع عمليات الدفع</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع عمليات الدفع
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
                                        <th>حاله العمليه</th>
                                        <th>المشتري</th>
                                        <th>الدافع</th>
                                        <th>الكميه</th>
                                        <th>الوقت</th>
                                        <th>حذف العمليه</th>
                                                         
                                                        
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                        <th>رقم العمليه</th>
                                        <th>حاله العمليه</th>
                                        <th>المشتري</th>
                                        <th>الدافع</th>
                                        <th>الكميه</th>
                                        <th>الوقت</th>
                                        <th>حذف العمليه</th>
                                              
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $all_payments = getAllData("payments");
                                           foreach($all_payments as $payments_data){
                                               $user_data = select_user_by_id('patients_donors',$payments_data['Payment_User_Id']);?>
                                            <tr class="<?php echo "payment" . $payments_data['id']; ?>">
                                               <?php echo "<td>".  $payments_data['payment_id']  	."</td>";
                                                echo "<td>".  $payments_data['payment_state']      	."</td>";
                                                echo "<td>".  $payments_data['Payment_User_Id']      	."</td>";
                                                echo "<td>".  $payments_data['payer_id']      	."</td>";
                                                echo "<td>".  $payments_data['amount']      	."</td>";
                                                echo "<td>".  $payments_data['time']      	."</td>";
                                                echo "<td>
                                                <a payment-id='".$payments_data['id']."' href=''
                                                class='btn deletebtn belete_btn btn-danger m-2'>حذف<i class='bx bxs-user-minus m-1'></i></a> " . "</td>";
                                
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

                    <script>

$(document).on("click",".belete_btn",function(e){
    e.preventDefault();
    var payment_id = $(this).attr('payment-id');

$.ajax({
type: "POST",
url: 'delete_ajax.php',
dataType:'JSON',
data: {
    "id":payment_id,
    "from":"payment"
},
success: function(data){
    if(data.status == true){
        $('.payment'+data.payment_id).remove();
        toastr.success('تم بنجاح :- تم حذف عملية الدفع بنجاح');
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
            }

                    




require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();