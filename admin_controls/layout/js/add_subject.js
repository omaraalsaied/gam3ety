$(document).on("change","#university",function(){
   
    var university_id = $("#university :selected").val();
    
$.ajax({
 type: "POST",
 url: 'subject_ajax.php',
 dataType:'JSON',
 data: {
    "id":university_id,
    "from":"university"
},
 success: function(data){
     if(data.status == true){
        var arr_len = data.faculties
        $('#faculty').empty();
        for(var i=0;i<arr_len.length;i++){

        $('#faculty')
        .append('<option selected disabled value="">...اختر</option><option value="'+ arr_len[i]["id"] + '">كلية '+ arr_len[i]["name"] + '</option>') ;
    }
     }
 }
});
})

$("#faculty").on("change",function(){
    var faculty_id = $("#faculty :selected").val();
    $('#academic_year').empty();
    console.log(faculty_id)
$.ajax({
 type: "POST",
 url: 'subject_ajax.php',
 dataType:'JSON',
 data: {
    "id":faculty_id,
    "from":"faculty"
},
 success: function(data){
     if(data.status == true){
        var arr_len = data.academic_years

        for(var i=0;i<arr_len.length;i++){
        console.log(arr_len[i])

        $('#academic_year')
        .append('<option selected disabled value="">...اختر</option><option value="'+ arr_len[i]["id"] + '">كلية '+ arr_len[i]["name"] + '</option>') ;
    }
     }
 }
});
})