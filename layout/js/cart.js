$(".fawry_button input").attr('value','الدفع');


$(document).on("click",".delete_cart",function(e){

    e.preventDefault();
    var item_id = $(this).attr('data-item');
    if(item_id == 0){
        toastr.error('عفوا .. يجب تسجيل الدخل اولا لكي تتمكن من شراء المحاضره' , { timeOut: 7000 });
    }else{

            $.ajax({
            type: "POST",
            url: 'delete_from_cart.php',
            dataType:'JSON',
            data: {
                "item_id":item_id,
                "from":"delete_from_cart"
            },
            success: function(data){
                if(data.status == true){
                    var x = $('.price').text();
                    var t = x.split(' ');
                    var y = $('.itemm'+data.item_id+' .current_item_price').attr('data-current-price');
                    var z = t[0]-y;
                    $('.price').text(z);
                    var count = $('.count_items').text();
                    count = count-1;
                    $('.count_items').text(count);
                    $('#cart_count1').text(count);
                    $('#cart_count2').text(count);
                    $('.itemm'+data.item_id).remove();
                    $('.itemm'+data.item_id+' .for_del').attr('data-total',z)
                    toastr.success('تم بنجاح :- تم حذف المحاضره من السله' , { timeOut: 7000 });
                }else{
                    toastr.warning('عفوا .. حدث خطأ' , { timeOut: 7000 });
                }
            }
        });
    }
})


$(document).on("click",".pay",function(e){

    e.preventDefault();
    var student_id = $(this).attr('data-user');
    if(student_id == 0){
        toastr.error('عفوا .. يجب تسجيل الدخل اولا لكي تتمكن من شراء المحاضره' , { timeOut: 7000 });
    }else{

                    // toastr.warning('عفوا ..لايمكنك شراء المحاضرات في الوقت الحالي' , { timeOut: 7000 });



            $.ajax({
            type: "POST",
            url: 'activate_email.php',
            dataType:'JSON',
            data: {
                "student_id":student_id,
                "from":"finish_payment"
            },
            success: function(data){
                if(data.status == true){
                        toastr.success('تم بنجاح :- تم الاضافة الي المحاضرات الخاصه بك' , { timeOut: 7000 });
                }else{
                    toastr.warning('عفوا ..يجب الدفع اولا لكي تتمكن من الحصول علي الفيديوهات' , { timeOut: 7000 });
                }
            }
        });
    }
})


$(document).on("click",".check_coupon_btn",function(e){
    e.preventDefault();
    var coupon = $("#coupone_code").val();
    var total_price = $(this).attr('total-price');

        $.ajax({
            type: "POST",
            url: 'activate_email.php',
            dataType:'JSON',
            data: {
                "coupon_id":coupon,
                "total_price":total_price,
                "from":"coupon"
            },
            success: function(data){
                if(data.status == true){
                    console.log(data.new_total_price)
                        toastr.success('تم بنجاح :- تم اضافة الخصم بنجاح ... استمتع بتجربتك مع جامعتي 😍' , { timeOut: 7000 });
                        $('#after_buy_price').text(data.new_total_price + " EGP") ;
                }else{
                    toastr.error('عفوا ..هناك خطا في الكود الذي ادخلته او ان صلاحيته قد انتهت' , { timeOut: 7000 });
                }
            }
        });

})