<?php
session_start();
ob_start();
if(isset($_SESSION['admin_id'])){ 
// ================== start update university page ======================

if(isset($_GET['to']) && strlen($_GET['to'])==10 && $_GET['to'] = "university"){
$role_id =(int)$_GET['id'];
  $page_name = " - تعديل الجامعات";
  include 'init.php';

  require './layout/topNav.php';
  $university_id = $_GET['id'];
  $university_data = getData_with_id("university",$university_id);
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
      $name      = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
    
      $formErrors = array ();
      if(empty($name)||strlen($name)<3 ){
          $formErrors[] = "
          <script>
              toastr.error('من فضلك تاكد من ادخال اسم الجامعه بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
          </script>";
          $name_error="border border-danger";
      }
      if(empty($formErrors)){
          update_university($name,$university_id);
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
                  <p class="secondParagraph text-center pb-5">من خلال هذه الصفحه يمكنك تعديل اسم جامعه</p>
                  <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" >
                      <div style="direction: rtl !important;text-align: right;" class="row m-2">
                            <!--User Name-->
                            <div class="col-md-6 mb-3 col-xs-12 m-auto">
                                <label for="Name">اسم الجامعه</label>
                                <input type="text" class="form-control mt-3 mb-3 <?php echo $name_error;?>" id="Name" 
                                    placeholder="ادخل اسم الجامعه" value="<?php if(isset($name)){ echo $name;}else{echo $university_data["name"];} ?>" name="name" autocomplete="off">
                            </div>
                      </div>
  
                      <!--btn -> add--->
                      <button class="btn btn-primary d-block m-auto mt-5">تعديل اسم الجامعه</button>
                  </form>
                  </div>
              </div>
        </div>
      </div>
  </div>
  <?php
  // ================== End update university page ======================
  
  
  
  }else{
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $id =(int)$_GET['id'];
    $page_name = " - تعديل الكليات";
    $script = "add_admin.js";
    include 'init.php';
    // if(isset($_SESSION['role'])){
    require './layout/topNav.php';
    $faculty_data = getData_with_id('faculty',$id);
    $all_university_data = getAllData("university");
    //password_verify($pass,$rows['password'])
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            @$name                          = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
            @$university                    = FILTER_VAR( $_POST['university'], FILTER_SANITIZE_NUMBER_INT);
    
                $formErrors = array ();
                // check the first name
                if(empty($name)||strlen($name)<3 ){
                    $formErrors[] = "
                    <script>
                        toastr.error('من فضلك تاكد من ادخال اسم الكلية بطريقه صحيحه (يجب ان يكون اكثر من 3 حروف')
                    </script>";
                    $name_error="border border-danger";
                }
                // check the university
                if(empty($university)){
                    $formErrors[] = "
                    <script>
                        toastr.error('من فضلك تاكد من اختيارك للجامعه')
                    </script>";
                    $university_error="border border-danger";
                }
              
    
    
                if(empty($formErrors)){  
                    global $con;
                    $stmt = $con->prepare("SELECT * FROM faculty WHERE name = ? AND university_id=?");
                    $stmt->execute(array($name,$university));
                    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    $count = $stmt->rowCount();
                    if ($count){
                        echo "
                            <script>
                                toastr.error('عفوا .. الكلية المسجله موجوده بالفعلا مسبقا')
                            </script>";
                    }
                    else{
                        update_faculty($name,$university,$id);             
                    }  
                    
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
                            <label for="name">اسم الكلية</label>
                            <input type="text" class="form-control <?php echo $name_error;?>" value="<?php if(isset($name)){ echo $name;}else{echo $faculty_data["name"];} ?>" id="name" placeholder="ادخل اسم الكلية" name="name" autocomplete="off">
                        </div>
                
                        <!--university--->
                        <div style="margin-bottom: 30px !important;text-align: right !important;direction: rtl;" class="col-md-6 col-xs-12">
                            <label for="university">الجامعه</label>
                            <select class="<?php echo $university_error;?> custom-select ui search dropdown" name="university" id="university">
                                <option selected disabled value="">...اختر</option>
                                <?php foreach($all_university_data as $university_data){ ?>
                                    <option value="<?php echo $university_data["id"];?>"><?php echo "جامعة " . $university_data["name"]; ?></option>
                                    <?php } ?>
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