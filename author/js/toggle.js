
$("#content-wrapper").css('paddingLeft', '250px');
$('#toggle-menu').html('<i class="fa fa-chevron-left"></i>');
$('#toggle-menu').click(function() {
    if($('#sidebar-wrapper').width() == 0) {
        $("#sidebar-wrapper").animate({width: "250px"});
        $("#content-wrapper").animate({paddingLeft: "250px"});
        $("#sidebar-wrapper .my-logo").fadeIn(1000);
        $("#sidebar-wrapper .my-menu").fadeIn(1000);
        $('#toggle-menu').html('<i class="fa fa-chevron-left"></i>');
    } else {
        $("#sidebar-wrapper").animate({width: "0px"});
        $("#content-wrapper").animate({paddingLeft: "0px"});
        $("#sidebar-wrapper .my-logo").hide();
        $("#sidebar-wrapper .my-menu").hide();
        $('#toggle-menu').html('<i class="fa fa-chevron-right"></i>');
    }
});