<?php 
ob_start();
session_start();
include 'init.php';
if(isset($_SESSION['admin_ssn'])){ 
/* ************* admins ************* */
if ($_GET['from'] == "admins" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $admin_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM admins WHERE admin_ssn = :admin_id");
    $stmt->bindParam(":admin_id" , $admin_id);
    $stmt->execute();
    header("Location:all_role_admin.php");
}
/* ************* patients ************* */
else if ($_GET['from'] == "patient" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $p_ssn = $_GET['id'];
    $p_diseases = select_user_by_id('patient_diseases',$p_ssn);
    foreach($p_diseases as $data){
        $stmt = $con->prepare("DELETE FROM patient_diseases WHERE p_ssn = :p_ssn");
        $stmt->bindParam(":p_ssn" , $p_ssn);
        $stmt->execute();
    }
    $stmt = $con->prepare("DELETE FROM patients_donors WHERE p_ssn = :p_ssn");
    $stmt->bindParam(":p_ssn" , $p_ssn);
    $stmt->execute();
    header("Location:all_patients.php");
}
/* ************* role ************* */
else if($_GET['from'] == "role" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $role_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM role WHERE id = :role_id");
    $stmt->bindParam(":role_id" , $role_id);
    $stmt->execute();
    header("Location:all_role_admin.php?to=role");
}
/* ************* payment ************* */
else if($_GET['from'] == "payment" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $payment_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM payments WHERE id = :payment_id");
    $stmt->bindParam(":payment_id" , $payment_id);
    $stmt->execute();
    header("Location:payments.php");
}
/* ************* quick_request ************* */
else if($_GET['from'] == "quick_request" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $quick_request_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM quick_request WHERE id = :quick_request");
    $stmt->bindParam(":quick_request" , $quick_request_id);
    $stmt->execute();
    header("Location:payments.php?to=quick_request");
}
/* ************* blood_type ************* */
else if($_GET['from'] == "blood_type" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $blood_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM blood_type WHERE id = :blood_id");
    $stmt->bindParam(":blood_id" , $blood_id);
    $stmt->execute();
    header("Location:all_blood_vaccine.php?to=add_blood");
}
/* ************* add vaccines ************* */
else if($_GET['from'] == "avilable_vaccine" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $vaccine_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM avilable_vaccines WHERE id = :vaccine_id");
    $stmt->bindParam(":vaccine_id" , $vaccine_id);
    $stmt->execute();
    header("Location:all_blood_vaccine.php");
}
/* *************  vaccines ************* */
else if($_GET['from'] == "vaccines" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $vaccine_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM vaccines WHERE id = :vaccine_id");
    $stmt->bindParam(":vaccine_id" , $vaccine_id);
    $stmt->execute();
    header("Location:all_blood_vaccine.php?to=vaccine_name");
}

/* ************* gov ************* */
else if($_GET['from'] == "gov" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $gov_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM governorate WHERE id = :gov_id");
    $stmt->bindParam(":gov_id" , $gov_id);
    $stmt->execute();
    header("Location:all_gov_city.php?to=gov");
}
/* ************* city ************* */
else if($_GET['from'] == "city" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $city_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM cities WHERE id = :city_id");
    $stmt->bindParam(":city_id" , $city_id);
    $stmt->execute();
    header("Location:all_gov_city.php?to=city");
}
/* ************* countrry ************* */
else if($_GET['from'] == "country" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $country_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM country WHERE id = :country_id");
    $stmt->bindParam(":country_id" , $country_id);
    $stmt->execute();
    header("Location:all_gov_city.php?to=country");
}
/* ************* reasons ************* */
else if($_GET['from'] == "reasons" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $reason_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM donate_reasons WHERE id = :reason_id");
    $stmt->bindParam(":reason_id" , $reason_id);
    $stmt->execute();
    header("Location:all_reasons_request_type.php?to=reason");
}
/* ************* request blood type ************* */
else if($_GET['from'] == "request_type" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $request_type_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM request_blood_type WHERE id = :request_type_id");
    $stmt->bindParam(":request_type_id" , $request_type_id);
    $stmt->execute();
    header("Location:all_reasons_request_type.php");
}
/* ************* news ************* */
else if($_GET['from'] == "news" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $news_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM blog WHERE id = :news_id");
    $stmt->bindParam(":news_id" , $news_id);
    $stmt->execute();
    header("Location:all_news.php");
}
/* ************* api_users ************* */
else if($_GET['from'] == "api_users" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $api_user_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM api_users WHERE id = :api_user_id");
    $stmt->bindParam(":api_user_id" , $api_user_id);
    $stmt->execute();
    header("Location:all_api_users.php");
}
/* ************* storis ************* */
else if($_GET['from'] == "story" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $story = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM stories WHERE id = :story");
    $stmt->bindParam(":story" , $story);
    $stmt->execute();
    header("Location:all_stories.php");
}
/* ************* places ************* */
else if($_GET['from'] == "places" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $place_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM donate_places WHERE id = :place_id");
    $stmt->bindParam(":place_id" , $place_id);
    $stmt->execute();
    header("Location:all_donate_places.php");
}
/* ************* diseases ************* */
else if($_GET['from'] == "diseases" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $disease_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM diseases WHERE id = :disease_id");
    $stmt->bindParam(":disease_id" , $disease_id);
    $stmt->execute();
    header("Location:all_diseases.php");
}
/* ************* avilable_blood ************* */
else if($_GET['from'] == "avilable_blood" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $avilable_blood_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM avilable_blood WHERE id = :avilable_blood_id");
    $stmt->bindParam(":avilable_blood_id" , $avilable_blood_id);
    $stmt->execute();
    header("Location:available_vaccines.php?to=add_availble_blood");
}
else{
    header("location:admin_dash.php");
}
require_once "./includes/template/footer.php";

}else{
    header("Location:index.php");
}
ob_end_flush();