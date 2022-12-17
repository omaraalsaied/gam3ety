$(document).ready(function(){
    $("#select_gov").change(function(){
        let req = new XMLHttpRequest();         //make ajax request
        req.open("POST","gov_city_ajax.php",true);    //open the location to send data (true لو هيرجع داتا)
        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");         // لما ابعت الحاجه تول عاديه في فانكشن ال post /// لو شلتو وطبعت البوست مش موجود
        //بيخلي الداتا تتبعت بنفس ال mrthod الي بستخدمها
        console.log($("#select_gov").val());
        let key = $("#select_gov").val();
        req.send("gov_id="+key+"&hamada=hamada");
        req.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                $("#select_city").html(this.responseText);

                let req = new XMLHttpRequest();         //make ajax request
                req.open("POST","gov_city_ajax.php",true);    //open the location to send data (true لو هيرجع داتا)
                req.setRequestHeader("Content-type","application/x-www-form-urlencoded");         // لما ابعت الحاجه تول عاديه في فانكشن ال post /// لو شلتو وطبعت البوست مش موجود
                //بيخلي الداتا تتبعت بنفس ال mrthod الي بستخدمها
                console.log($("#select_city").val());
                let key = $("#select_city").val();
                req.send("city_id="+key);
                req.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        console.log(this.responseText);
                        $("#select_place").html(this.responseText);
                        if(this.responseText==""){
                            $("#select_place").html("<option selected disabled>اخترالمدينه اولا</option>")
                        }
                    }
                }


            }
        }
    })


    $("#select_city").change(function(){
        let req = new XMLHttpRequest();         //make ajax request
        req.open("POST","gov_city_ajax.php",true);    //open the location to send data (true لو هيرجع داتا)
        req.setRequestHeader("Content-type","application/x-www-form-urlencoded");         // لما ابعت الحاجه تول عاديه في فانكشن ال post /// لو شلتو وطبعت البوست مش موجود
        //بيخلي الداتا تتبعت بنفس ال mrthod الي بستخدمها
        console.log($("#select_city").val());
        let key = $("#select_city").val();
        req.send("city_id="+key);
        req.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                console.log(this.responseText);
                    $("#select_place").html(this.responseText);
            }
        }
    })
})


// responseText دا بيكون فيه الداتا او الحاجه الي محطوطه في ملف ال php التاني
