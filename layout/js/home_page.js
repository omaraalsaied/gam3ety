// For loading
$(document).ready(function(){
    $('.loading img').fadeOut(1000, () => {
        $('.loading img').parent().fadeOut(2000 , () => {
            $('.loading').remove();
            $('body').css("overflow-y" , "auto");
        })
    });

    

    var mixer = mixitup(".new_videos");
    mixer.filter('.category-a');


    $(".owl-carousel").owlCarousel({
        loop:true,
        margin:10,
        autoplay:true,
        autoplayTimeout:5000,
        autoplayHoverPause:false,
        responsive: {
          0: {
            items: 1,
          },
          1000: {
            items: 3,
          },
        },
      });

});
// End




$(document).on("click",".add_to_cart_btn",function(e){
  e.preventDefault();
  var student_id = $(this).attr('data-student');
  var video_id = $(this).attr('data-video');
  if(student_id == 0 || student_id == 0){
      toastr.error('عفوا .. يجب تسجيل الدخل اولا لكي تتمكن من شراء المحاضره' , { timeOut: 7000 });
  }else{

          $.ajax({
          type: "POST",
          url: 'add_to_cart.php',
          dataType:'JSON',
          data: {
              "student_id":student_id,
              "video_id":video_id,
              "from":"buy_videos"
          },
          success: function(data){
              console.log(data);
              if(data.status == true){
                  toastr.success('تم بنجاح :- تم اضافة المحاضره الي السله' , { timeOut: 7000 });
              }else if(data.status == 'free_video'){
                  toastr.success('تم بنجاح :- تم اضافة المحاضره مباشرة الي المحاضرات المشتراه لديك' , { timeOut: 7000 });
              }else if(data.status == 'free_video_found'){
                  toastr.warning('عفوا .. هذه المحاضره موجوده لديك بالفعل' , { timeOut: 7000 });
              }
              else{
                  toastr.warning('عفوا .. المحاضره المسجله موجوده بالفعل مسبقا' , { timeOut: 7000 });
              }
          }
      });
  }
})
