$(document).ready(function(){
    $("#tname").change(function(){
        let req = new XMLHttpRequest();         //make ajax request
        req.open("POST","vaccine_name_ajax.php",true);    //open the location to send data (true لو هيرجع داتا)
        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");         // لما ابعت الحاجه تول عاديه في فانكشن ال post /// لو شلتو وطبعت البوست مش موجود
        //بيخلي الداتا تتبعت بنفس ال mrthod الي بستخدمها
        let key = $("#tname").val();
        req.send("vac_id="+key+"&hamada=hamada");
        req.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                $("#sname").html(this.responseText);

                let req = new XMLHttpRequest();         //make ajax request
                req.open("POST","vaccine_name_ajax.php",true);    //open the location to send data (true لو هيرجع داتا)
                req.setRequestHeader("Content-type","application/x-www-form-urlencoded");         // لما ابعت الحاجه تول عاديه في فانكشن ال post /// لو شلتو وطبعت البوست مش موجود
                //بيخلي الداتا تتبعت بنفس ال mrthod الي بستخدمها
                let key = $("#sname").val();
                req.send("city_id="+key);
                req.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        $("#select_place").html(this.responseText);
                        if(this.responseText==""){
                            $("#select_place").html("<option selected disabled>اخترالمدينه اولا</option>")
                        }
                    }
                }


            }
        }
    })


    $("#sname").change(function(){
        let req = new XMLHttpRequest();         //make ajax request
        req.open("POST","vaccine_name_ajax.php",true);    //open the location to send data (true لو هيرجع داتا)
        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");         // لما ابعت الحاجه تول عاديه في فانكشن ال post /// لو شلتو وطبعت البوست مش موجود
        //بيخلي الداتا تتبعت بنفس ال mrthod الي بستخدمها
       
        let key = $("#sname").val();
        req.send("vac_id="+key);
        req.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                    $("#select_place").html(this.responseText);
            }
        }
    })
})


// responseText دا بيكون فيه الداتا او الحاجه الي محطوطه في ملف ال php التاني
