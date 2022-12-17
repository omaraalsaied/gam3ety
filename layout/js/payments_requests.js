
$(document).on("click",".finish_payment",function(e){
    e.preventDefault();
    var videos_id = $(this).attr('videos-id');
    var student_id = $(this).attr('student-id');
    var order_id = $(this).attr('order-id');
    $.ajax({
    type: "POST",
    url: 'delete_ajax.php',
    dataType:'JSON',
    data: {
        "videos_id":videos_id,
        "student_id":student_id,
        "order_id":order_id,
        "from":"payments_requests"
    },
    success: function(data){
        if(data.status == true){
            $('.order'+data.order_id).remove();
            toastr.success('تم بنجاح :- تم تسليم المحاضرة بنجاح');
        }
    }
    });
})
