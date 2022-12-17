$('.signup').hide();
$('#to_signin').click(function(e) {
    e.preventDefault();
    $('.signup').hide(2000);
    $('.signin').show(2000);
})
$('#to_signup').click(function(e) {
    e.preventDefault();
    $('.signup').show(2000);
    $('.signin').hide(2000);
})
