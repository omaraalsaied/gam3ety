<?php    
ob_start();
session_start();   
$script = "all_student.js";
$page_name = " - جميع الاقسام";
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
      if(in_array("all_dep",$roles)){
          ?>
        <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

              
                    <div class="container-fluid">
                        <h1 class="mt-4">جامعتي</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">لوحة التحكم</li>
                            <li class="breadcrumb-item active">جميع الاقسام</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    جميع الاقسام

                                    
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
                                            <th>اسم القسم</th>                      
                                            <th>اسم الكورس</th>                     
                                            <th>صورة القسم</th>                     
                                            <th>اضيف / عدل بواسطة</th>             
                                            <th>اضيف في </th>             
                                            <th>عدل في </th>             
                                            <th>تعديل القسم</th>             
                                            <th>حذف القسم</th>                   
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>اسم القسم</th>                      
                                            <th>اسم الكورس</th>    
                                            <th>صورة القسم</th>                                      
                                            <th>اضيف / عدل بواسطة</th>             
                                            <th>اضيف في </th>             
                                            <th>عدل في </th>             
                                            <th>تعديل القسم</th>             
                                            <th>حذف القسم</th>  
                                        </tr>            
                                    </tfoot>
                                        <tbody>
                                           <?php 
                                           $dep = all_dep();
                                           foreach($dep as $dep_data){?>
                                            <tr class="<?php echo "dep" . $dep_data['id']; ?>">
                                                <?php
                                                echo "<td style='font-weight:900'>".  $dep_data['dep_name']      	."</td>";
                                                echo "<td>".  $dep_data['course_name']      	."</td>";?>
                                                <td>
                                                    <img src="./img/departments/<?php echo $dep_data['img'];?>" width="100" height="100">
                                                </td>
                                                <?php
                                                echo "<td>".  $dep_data['admin_name']      	."</td>";
                                                echo "<td>".  $dep_data['created_at']      	."</td>";
                                                if($dep_data['updated_at'] == 0){
                                                    echo "<td style='font-weight:900'>".  "Not Updated"      	."</td>";
                                                }else{
                                                    echo "<td>".  $dep_data['updated_at']      	."</td>";
                                                }

                                                echo "<td>
                                                <a href='update_department.php?id=".$dep_data['id']."'
                                                class='btn editbtn btn-primary m-2'>تعديل<i class='bx bxs-edit m-1 '></i></a> " . "</td>";
                                                echo "<td>
                                                <a dep-id='".$dep_data['id']."' href=''
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
    var dep_id = $(this).attr('dep-id');

$.ajax({
type: "POST",
url: 'delete_ajax.php',
dataType:'JSON',
data: {
    "id":dep_id,
    "from":"departments"
},
success: function(data){
    console.log(data);
    if(data.status == true){
        $('.dep'+data.dep_id).remove();
        toastr.success('تم بنجاح :- تم حذف القسم بنجاح');
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