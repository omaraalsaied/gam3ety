<?php 

$dsn = "mysql:host=localhost;dbname=u833752782_gam3etyDB";
$user = "root";
$pass="";

try{
    $con = new PDO($dsn , $user , $pass);
   
}catch(PDOException $e){
    echo "error" . $e->getMessage();
}




?>

