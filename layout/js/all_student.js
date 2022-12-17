$(document).on("click",".blockbtn",function(e){
    e.preventDefault();
    var student_id = $(this).attr('student-id');

$.ajax({
type: "POST",
url: 'block_student.php',
dataType:'JSON',
data: {
    "id":student_id,
    "from":"all_students"
},
success: function(data){
    if(data.status == true){
        toastr.success('تم بنجاح :- تم حظر المستخدم بنجاح');
        $(".blockbtn_"+data.std_id).hide();
        $(".unblock_"+data.std_id).show();
    }
}
});
})



$(document).on("click",".unblock",function(e){
    e.preventDefault();
    var student_id = $(this).attr('student-id');

$.ajax({
type: "POST",
url: 'block_student.php',
dataType:'JSON',
data: {
    "id":student_id,
    "from":"all_students_unblock"
},
success: function(data){
    if(data.status == true){
        toastr.success('تم بنجاح :- تم الغاء حظر المستخدم بنجاح');
        $(".blockbtn_"+data.std_id).show();
        $(".unblock_"+data.std_id).hide();
    }
}
});
})



$(document).on("click",".deleteipsbtn",function(e){
    e.preventDefault();
    var student_id = $(this).attr('student-id-for-IPS');
$.ajax({
type: "POST",
url: 'delete_ajax.php',
dataType:'JSON',
data: {
    "id":student_id,
    "from":"delete_student_ips"
},
success: function(data){
    if(data.status == true){
        toastr.success('تم بنجاح :- تم حذف الاجهزه المسجله لهذا المستخدم');
    }
}
});
})


$(document).on("click",".deliver_lecture",function(e){
    e.preventDefault();
    var lecture_id = $(this).attr('lecture-id');
    var student_id = $(this).attr('student-id');
    $.ajax({
    type: "POST",
    url: 'delete_ajax.php',
    dataType:'JSON',
    data: {
        "student_id":student_id,
        "lecture_id":lecture_id,
        "from":"add_pdf_order"
    },
    success: function(data){
        if(data.status == true){
            console.log(data.itemm)
            $(data.itemm).addClass('disabled');
            toastr.success('تم بنجاح :- تم تسليم المحاضره بنجاح');
        }
    }
    });
})


$(document).on("click",".signout",function(e){
    e.preventDefault();
    var student_id = $(this).attr('student-id');
    $.ajax({
    type: "POST",
    url: 'delete_ajax.php',
    dataType:'JSON',
    data: {
        "student_id":student_id,
        "from":"signout_from_devices"
    },
    success: function(data){
        if(data.status == true){
            toastr.success('تم بنجاح :- تم تسجيل الخروج من جميع الاجهزه بنجاح');
        }
    }
    });
})