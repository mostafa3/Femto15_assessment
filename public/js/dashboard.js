$(function () {$('[data-toggle="tooltip"]').tooltip()})


$('.cur').attr('href','#');
$('.sidebar').mouseenter(function(){
  $('.toggler').show();
})
$('.sidebar').mouseleave(function(){
  $('.toggler').hide();
})
$('.sidebar').on("click",".toggler.expanded",function(){
    $('.sidebar a').children('span').hide();
    $('.sidebar').width('65px');
    $('.toggler').hide();
    $('.toggler').addClass('collapsed');
    $('.sidebar').addClass('sidebar-collpsed');
    $('.toggler').removeClass('expanded');
    $('.toggler').children('i').removeClass('fa-chevron-left');
    $('.toggler').children('i').addClass('fa-chevron-right');
});
$('.sidebar').on("click",".toggler.collapsed",function(){
    $('.sidebar a').children('span').show();
    $('.sidebar').width('230px');
    $('.toggler').removeClass('collapsed');
    $('.sidebar').removeClass('sidebar-collpsed');
    $('.toggler').addClass('expanded');
    $('.toggler').children('i').removeClass('fa-chevron-right');
    $('.toggler').children('i').addClass('fa-chevron-left');
});
