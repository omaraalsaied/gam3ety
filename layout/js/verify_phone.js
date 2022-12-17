$(document).on("click","#send_activation_code",function(e){
    e.preventDefault();
    var phone_number = $(this).attr('data-phone');
    var myHeaders = new Headers();
    myHeaders.append("Content-Type", "application/json");

    var raw = JSON.stringify({
    "username": "eZzat@gaM3ty*",
    "password": "B09385*fE",
    "sender": "Academy",
    "mobile": phone_number,
    "lang": "en"
    });

    var requestOptions = {
    method: 'POST',
    headers: myHeaders,
    body: raw,
    redirect: 'follow'
    };

    fetch("https://smssmartegypt.com/sms/api/otp-send", requestOptions)
    .then(response => response.json())
    .then(result => {
        if(result["type"] == "success"){
        toastr.success('تم بنجاح :- تم ارسال كود التاكيد علي رقم الهاتف بنجاح' , { timeOut: 20000 });

        }else{
            toastr.error( "عفوا .. حدث خطا من فضلك اعد ارسال الكود في وقت لاحق" , { timeOut: 15000 });
        }
    })
    .catch(error => console.log('error', error));
})


$(document).on("click","#verify_phone",function(e){


    e.preventDefault();
    var activation_code = $("#activation_code").val();
    var phone_number = $(this).attr('data-phone');
    var student_id = $(this).attr('data-student');

        var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");

        var raw = JSON.stringify({
        "username": "eZzat@gaM3ty*",
        "password": "B09385*fE",
        "mobile": phone_number,
        "otp":activation_code,
        "verify":true
        });

        var requestOptions = {
        method: 'POST',
        headers: myHeaders,
        body: raw,
        redirect: 'follow'
        };

        fetch("https://smssmartegypt.com/sms/api/otp-check", requestOptions)
        .then(response => response.json())
        .then(result => {
            if(result["type"] == "success"){
            
                $.ajax({
                    type: "POST",
                    url: 'activate_email.php',
                    dataType:'JSON',
                    data: {
                        "student_id":student_id,
                        "phone_number":phone_number,
                        "from":"verify_phone"
                    },
                    success: function(data){
                        if(data.status == true){
                                toastr.success('تم بنجاح :- تم تاكيد رقم الهاتف الخاص بك ❤👌' , { timeOut: 7000 });
                                window.location.href = 'https://gam3ety.net/user_dash.php';
                        }
                    }
                });

            }else{
                toastr.error('عفوا ..كود التاكيد خطأ او تم استخدامه من قبل , جرب ارسال الكود مره اخري' , { timeOut: 7000 });
            }


        })
        .catch(error => console.log('error', error));

})


