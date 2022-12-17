<?php
session_start();
ob_start();
if(isset($_SESSION['admin_id'])){ 
// ================== start Add Role page ======================

if(isset($_GET['to']) && strlen($_GET['to'])==4 && $_GET['to'] = "role"){
$role_id =(int)$_GET['id'];
  $page_name = " - تعديل صلاحيه";
  include 'init.php';

  require './layout/topNav.php';
  $the_role_id = $_GET['id'];
  $role_data = get_rols_with_id($the_role_id);
  $old_roles = $role_data['authentications'];
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      $name      = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
      $roles      = $_POST['roles'];
      $imp_data = explode("/",$old_roles);
      foreach($imp_data as $old_rules){
        $index = array_search($old_rules,$roles);
        unset($roles[$index]); 
      }
      $formErrors = array ();
      if(empty($name)||strlen($name)<3 ){
          $formErrors[] = "
          <script>
              toastr.error('من فضلك تاكد من ادخال اسم الصلاحيه بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
          </script>";
          $name_error="border border-danger";
      }
      if(empty($formErrors)){
          $roles_ex = implode("/",$roles);  
          update_role($role_id,$name,$roles_ex);
    
}
      
  }
      if (isset($formErrors)){ 
      foreach($formErrors as $error){
          echo $error;
      }
  }



  ?>
  <div id="layoutSidenav">     
      <?php 
        require './layout/sidNav.php';
  
      ?> 
      <div id="layoutSidenav_content">
          <div class="container-fluid ">
              <div class="allContent">
              <div class="container mainAddForm">
                  <img class="addMemberMainImg pt-5 mb-4" style="width: 80px;margin: auto;display: block;" src="img/addMember.png">
                  <p class="firstParagraph text-center">اهلا بك في لوحة التحكم الخاصة بالنظام</p>
                  <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك اضافة صلاحية جديده للنظام</p>
                  <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
                  <?php 
                      $the_role_id = $_GET['id'];
                      $role_data = get_rols_with_id($the_role_id);
                  ?>
                      <div style="direction: rtl !important;text-align: right;" class="row m-2">
                      <!--User Name-->
                          <div class="col-md-6 mb-3 col-xs-12">
                              <label for="Name">اسم الصلاحيه</label>
                              <input type="text" class="form-control <?php echo $name_error;?>" id="Name" 
                                  placeholder="ادخل اسم الصلاحيه" value="<?php echo $role_data['role_name'] ?>" name="name" autocomplete="off">
                          </div>
                          
                                  

                          <div style="direction: ltr;" class="col-md-6 mb-3 col-xs-12">
                              <label for="Name">الصلاحيات</label>
                              <?php echo $role_data["role_name"]; ?>
                              <select name="roles[]" class="ui fluid search dropdown" multiple="" id="selected_role">

                              <?php
                                $roles = $role_data['authentications'];
                                $imp_data = explode("/",$roles);
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
                                    "add_coupone"                        =>"اضافة كوبون خصم",
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
                                for($i=0;$i<sizeof($imp_data);$i++){
                                    // for($j=0;$j<sizeof($auth)+110;$j++){
                                    foreach($auth as $key => $value){
                                        if($key == $imp_data[$i]){?>
                                            <option selected value="<?php echo $key;?>"><?php echo $value ?></option>
                                        <?php 
                                        unset($key);
                                        }
                                    }
                                }

                                foreach($auth as $key => $data){?>
                                    <option value="<?php echo $key;?>"><?php echo $data ?></option>
                                <?php
                                }
                                
                              ?>


                              <option value="">الصلاحيات</option>
                              </select>
                          </div>
                      </div>
  
                      <!--btn -> add--->
                      <button class="btn btn-primary d-block m-auto mt-5">تعديل الصلاحيه</button>
                  </form>
                  </div>
              </div>
        </div>
      </div>
  </div>
  <?php
  // ================== End Add Role page ======================
  
  
  
  }else{
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $id =(int)$_GET['id'];
    $page_name = " - تعديل مسئول";
    $script = "add_admin.js";
    include 'init.php';
    // if(isset($_SESSION['role'])){
    require './layout/topNav.php';
    $admin_data = select_admin_by_id('admins',$id);
    $all_role_data = getAllData("roles");
    $admin_role = select_by_id('roles',$admin_data['role_id']);
     
    //password_verify($pass,$rows['password'])
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            @$admin_name                = FILTER_VAR( $_POST['admin_name'], FILTER_SANITIZE_STRING);
            @$email                 = FILTER_VAR( $_POST['email'], FILTER_SANITIZE_EMAIL);
            @$hashed_password       = password_hash($_POST['password'],PASSWORD_DEFAULT);
            @$role                  = FILTER_VAR( $_POST['role'], FILTER_SANITIZE_NUMBER_INT);
    
                $formErrors = array ();
                // check the first name
                if(empty($admin_name)||strlen($admin_name)<3 ){
                    $formErrors[] = "
                    <script>
                        toastr.error('من فضلك تاكد من ادخال الاسم الاول بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
                    </script>";
                    $admin_name_error="border border-danger";
                }
                // check the email
                if(empty($email)||strlen($email)<3 ){
                    $formErrors[] = "
                    <script>
                        toastr.error('من فضلك تاكد من ادخال البريد الالكتروني بطريقه صحيحه ')
                    </script>";
                    $email_error="border border-danger";
                }
                // check the passwprd
                if(empty($_POST['password'])||strlen($_POST['password'])<5 ){
                    $formErrors[] = "
                    <script>
                        toastr.error('من فضلك تاكد من ادخال كلمة السر بطريقه صحيحه (يجب ان تكون اكثر من 5 حروف')
                    </script>";
                    $password_error="border border-danger";
                }
                // check the role
                if(empty($role)){
                    $formErrors[] = "
                    <script>
                        toastr.error('من فضلك تاكد من اختيارك لصلاحيه')
                    </script>";
                    $role_error="border border-danger";
                }
              
    
    
                if(empty($formErrors)){  
                    update_admin($admin_name,$email,$hashed_password,$role,$_SESSION['admin_id'],$id);
                }
            }
    
            if (isset($formErrors)){ 
                foreach($formErrors as $error){
                    echo $error;
                }
            }
    
    ?>
    <div id="layoutSidenav">     
        <?php 
          require './layout/sidNav.php';
        ?> 
        <div id="layoutSidenav_content">
            <div class="container-fluid ">
                <div class="allContent">
                <div class="container mainAddForm">
                    <img class="addMemberMainImg pt-5 mb-4" style="width: 80px;margin: auto;display: block;" src="img/addMember.png">
                    <p class="firstParagraph text-center">اهلا بك في لوحة التحكم الخاصة بالنظام</p>
                    <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك تعديل مسئول موجود فى النظام</p>
                    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
                    
                        <div style="direction: rtl !important;text-align: right;" class="row m-2">
                        <!--first Name-->
                            <div class="col-md-6 mb-3 col-xs-12">
                                <label for="admin_name">الأسم الأول</label>
                                <input type="text" class="form-control <?php echo $admin_name_error;?>" value="<?php echo $admin_data['admin_name'] ?>" id="admin_name" placeholder="ادخل الاسم الاول" name="admin_name" autocomplete="off">
                            </div>
                      
                        <!--Email-->
                            <div class="col-md-6 mb-3 col-xs-12">
                                <label for="Email">البريد الالكتروني</label>
                                <input type="email" class="form-control <?php echo $email_error;?>" value="<?php echo $admin_data['email'] ?>" id="Email" placeholder="ادخل البريد الالكتروني " name="email" autocomplete="off">
                            </div>
                     
                        <!--password-->
                            <div class="col-md-6 mb-3 col-xs-12">
                                <label for="Password">كلمة السر</label>
                                <input type="password" class="form-control <?php echo $password_error;?>" id="Password" placeholder="ادخل كلمة السر " name="password" autocomplete="off">
                            </div>
                            <!--role--->
                            <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                                <label for="role">الصلاحيه</label>
                                <select class="<?php echo $role_error;?> custom-select ui search dropdown" name="role" id="role">
                               
                                    <option selected value="<?php echo $admin_role['id']  ?>"><?php echo $admin_role['role_name']  ?></option>
                                    <?php foreach($all_role_data as $role_data){ 
                                        if($role_data['id'] == $admin_role['id']){
                                            continue;
                                        }else{
                                        ?>
                                        <option value="<?php echo $role_data['id'];?>"><?php echo $role_data["role_name"]; ?></option>
                                        <?php } 

                                        } ?>
                                    </select>
                            </div>
    
    
    
                        </div>
                        <!--btn -> add--->
                        <button class="btn btn-primary d-block m-auto my-5">تعديل بيانات المسئول</button>
                    </form>
                    </div>
                </div>
          </div>
        </div>
    </div>
    
    
    
    <?php
  }}


require_once "./includes/template/footer.php";
}else{
    header("Location:index.php");
}
ob_end_flush();?>