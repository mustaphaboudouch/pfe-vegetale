$(document).ready(function(){
    var i = document.location.href.lastIndexOf('/');
    var currentPage = document.location.href.substr(i+1);
    $('#navbarText ul li a').removeClass('active');
    $('#navbarText ul li a[href^="'+currentPage+'"').addClass('active');
    var title = $('#navbarText ul li a[href^="'+currentPage+'"').text();
    document.title = title;
});