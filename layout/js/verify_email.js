$(document).on("click","#verify_email",function(e){
    e.preventDefault();
    var code = $("#verification_code").val();
    var student_email = $(this).attr('data-student');
    if(!code){
        toastr.error('من فضلك تاكد من ادخال كود تفعيل الايميل الخاص بك' , { timeOut: 7000 });
    }else{
                $.ajax({
                type: "POST",
                url: 'activate_email.php',
                dataType:'JSON',
                data: {
                    "student_email":student_email,
                    "code":code,
                    "from":"activate_email"
                },
                success: function(data){
                    if(data.status == true){
                        toastr.success('تم بنجاح :- تم تاكيد البريد الالكتروني بنجاح' , { timeOut: 7000 });
                        window.location.href = 'https://gam3ety.net/user_dash.php';
                    }else{
                        toastr.warning('عفوا .. الكود الذي ادخلته غير صحيح' , { timeOut: 7000 });
                    }
                }
            });
    }
})


$(document).on("click","#resend_code",function(e){
    e.preventDefault();
    var student_email = $(this).attr('data-student');
    if(!student_email){
        toastr.error('من فضلك تاكد من البريد الالكتروني وتسجيل الدخول مره اخري' , { timeOut: 7000 });
    }else{

                $.ajax({
                type: "POST",
                url: 'activate_email.php',
                dataType:'JSON',
                data: {
                    "student_email":student_email,
                    "from":"resend_email"
                },
                success: function(data){
                    if(data.status == true){
                        toastr.success('تم بنجاح :- تم ارسال كود التاكيد الي البريد الالكتروني بنجاح' , { timeOut: 7000 });
                    }else{
                        toastr.success('تم بنجاح :- تم ارسال كود التاكيد مره اخري الي البريد الالكتروني بنجاح' , { timeOut: 7000 });
                    }
                }
            });
    }
})