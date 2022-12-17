 // realtime for governorrates

 $(document).ready(function(){
  $("#university").change(function(){
      let req = new XMLHttpRequest();         //make ajax request
      req.open("POST","university_faculty_ajax.php",true);    //open the location to send data (true لو هيرجع داتا)
      req.setRequestHeader("Content-type","application/x-www-form-urlencoded");         // لما ابعت الحاجه تول عاديه في فانكشن ال post /// لو شلتو وطبعت البوست مش موجود
      //بيخلي الداتا تتبعت بنفس ال mrthod الي بستخدمها
      let key = $("#university").val();
      req.send("university_id="+key+"");
      req.onreadystatechange = function(){
          if(this.readyState == 4 && this.status == 200){
              $("#faculty").html(this.responseText);


          }
      }
  })

    
  
  // responseText دا بيكون فيه الداتا او الحاجه الي محطوطه في ملف ال php التاني
  
})
