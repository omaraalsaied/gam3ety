
/* Start Navbar */

$(window).scroll(function(){
    let wScroll = $(window).scrollTop();

    if(wScroll > 72.68){
        $('#navbar-clone').addClass("is-active");
    }
    else{
        $('#navbar-clone').removeClass("is-active");
    } 
});
/* End Navbar */

/* Start offcanvas links */
$('.canv_links li').click(function(){
    $(this).children('a').addClass('drop-active').find('.fa-angle-down').addClass('drop-active');
    $(this).siblings().children('a').removeClass('drop-active').find('.fa-angle-down').removeClass('drop-active');
});
/* Start offcanvas links */

// for nav links
var path = window.location.href; // because the 'href' property of the DOM element is the absolute path

$('#navbar-clone li a').each(function() {
  
  if (this.href === path) {
    $(this).addClass('Nav_Clone_Active_Links');
    $(this).find('i').addClass('Nav_Clone_Active_Links');
  }
  
});

$('.canv_links li a').each(function() {
  
  if (this.href === path) {
    $(this).addClass('Nav_Clone_Active_Links');
    $(this).find('i').addClass('Nav_Clone_Active_Links');
  }
  
});



// print();
