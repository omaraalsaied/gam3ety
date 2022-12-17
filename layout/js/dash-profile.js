$(document).on("click","#update_info",function(e){
    e.preventDefault();

    var name = $("#name").val();
    var university = $("#university").val();
    var faculty = $("#faculty").val();
    var academic_year = $("#academic_year").val();
    var birthday = $("#birthday").val();
    var gender = $("#select_gender").val();
    var pass = $("#password").val();
    if(!pass){
        pass = "old pass";
    }else{
        pass = $("#password").val();
    }
    var student_id = $(this).attr('data-id');
    if(!name){
            toastr.error( "من فضلك تاكد من ادخالك للاسم" , { timeOut: 15000 });
    }

    else if(!university){
            toastr.error( "من فضلك تاكد من ادخالك للجامعه" , { timeOut: 15000 });
    }

    else if(!faculty){
            toastr.error( "من فضلك تاكد من ادخالك للكليه" , { timeOut: 15000 });
    }

    else if(!academic_year){
            toastr.error( "من فضلك تاكد من ادخالك للعام الدراسي" , { timeOut: 15000 });
    }

    else if(!birthday){
            toastr.error( "من فضلك تاكد من ادخالك لتاريخ ميلادك" , { timeOut: 15000 });
    }

    else if(!gender){
            toastr.error( "من فضلك تاكد من ادخالك للنوع" , { timeOut: 15000 });
    }
    else{
                $.ajax({
                type: "POST",
                url: 'delete_from_cart.php',
                dataType:'JSON',
                data: {
                    "student_name":name,
                    "university":university,
                    "faculty":faculty,
                    "academic_year":academic_year,
                    "birthday":birthday,
                    "gender":gender,
                    "password":pass,
                    "student_id":student_id,
                    "from":"user_dash"
                },
                success: function(data){
                    if(data.status == true){
                        toastr.success('تم بنجاح :- تم تعديل البيانات بنجاح ... من فضلك سجل الخرج وعاود الدخول مره اخري لرؤية التحديثات' , { timeOut: 20000 });
                    }else{
                        toastr.warning('عفوا .. هناك خطأ في البيانات المدخله' , { timeOut: 7000 });
                    }
                }
            });
    }
})