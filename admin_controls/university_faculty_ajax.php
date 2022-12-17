<?php 
include "connect_db.php";
include "includes/functions/function.php";
if(isset($_POST["university_id"])){
    $faculty = all_faculty_by_university($_POST["university_id"]);
    foreach($faculty as $faculty_data){ ?>
        <option value="<?php echo $faculty_data['id'];?>"><?php echo "كلية " . $faculty_data["name"]; ?></option>
        <?php } 
    }elseif(isset($_POST["faculty_id"])){

        $years = all_academic_years_by_faculty($_POST["faculty_id"]);
            foreach($years as $year_data){ 
                ?>
                <option value="<?php echo $year_data['id'];?>"><?php echo $year_data["name"]; ?></option>
    <?php 

    }
    }
    ?>