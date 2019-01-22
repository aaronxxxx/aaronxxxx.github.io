$(function () {

    $('#hamburger').on('click', function () {

        $('#nav-inner').toggleClass('show');

        $(this).toggleClass('active');

    });

});

var topBtn = document.getElementById('btn');

topBtn.onclick = function () {
    
    document.body.scrollTop = 0;
    document.documentElement.scrollTop =0;

}

