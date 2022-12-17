<?php 
include 'connect_db.php';
$tran = $_POST['tr_id'];
global $con;
$stmt = $con->prepare('select * from payments where Transaction_id = :tr');
$stmt->bindParam(":tr",$tran);
$stmt->execute();
$rows = $stmt->fetchColumn();
if(mysqli_num_rows($rows)==0){
echo 0;
}
else{
    return $rows;

}
