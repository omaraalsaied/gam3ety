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

        $('#academic_year')
        .append('<option selected disabled value="">...اختر</option><option value="'+ arr_len[i]["id"] + '">كلية '+ arr_len[i]["name"] + '</option>') ;
    }
     }
 }
});
})

$("#academic_year").on("change",function(){
    var academic_year = $("#academic_year :selected").val();
    $('#subject').empty();
$.ajax({
 type: "POST",
 url: 'subject_ajax.php',
 dataType:'JSON',
 data: {
    "id":academic_year,
    "from":"academic_year"
},
 success: function(data){
     if(data.status == true){
        var arr_len = data.subject

        for(var i=0;i<arr_len.length;i++){

        $('#subject')
        .append('<option selected disabled value="">...اختر</option><option value="'+ arr_len[i]["id"] + '"> '+ arr_len[i]["name"] + '</option>') ;
    }
     }
 }
});
})



$("#course").on("change",function(){
    var course_id = $("#course :selected").val();
    $('#department').empty();
    $.ajax({
    type: "POST",
    url: 'subject_ajax.php',
    dataType:'JSON',
    data: {
        "id":course_id,
        "from":"courses"
    },
    success: function(data){
        if(data.status == true){
            var arr_len = data.departments

            for(var i=0;i<arr_len.length;i++){

            $('#department')
            .append('<option selected disabled value="">...اختر</option><option value="'+ arr_len[i]["id"] + '">قسم/ '+ arr_len[i]["dep_name"] + '</option>') ;
        }
        }
    }
    });
})