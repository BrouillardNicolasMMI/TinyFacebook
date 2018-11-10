/* function myFunction(p1) {
     //  p0 = "#affichercomment" + p1
     p2 = "#commentsection" + p1;
     //p2 = ".commentsection" + p1;
     //p3 = ".postcommentsection" + p1;
     div.className = p2;
     div.classList.toggle("visible");
     //document.getElementById('wrap1').className = 'visible';
     //$(p2).slideToggle("slow");

     //$(p3).slideToggle("slow");

 }
*/




//Footer stike
$(document).ready(function () {

    var docHeight = $(window).height();
    var footerHeight = $('#footer').height();
    var footerTop = $('#footer').position().top + footerHeight;

    if (footerTop < docHeight) {
        $('#footer').css('margin-top', -30 + (docHeight - footerTop) + 'px');
    }
});

function myFunction(x) {
    x.classList.toggle("change");
    $("#friendlistwrap").toggle("slow", function () {
        right: '250px'
    });
    $("#visible").toggle("slow", function () {
        right: '250px'
    });
}


$(document).ready(function () {
    $('.toggle').click(function () {
        $('#target').toggle('slow');
    });

    $(function () {
        $('#file-input').bind('click', function (e) {
            document.getElementById("dim").style.display = "block";
            document.getElementById("submit").style.display = "block";
        });

    });

    $(function () {
        $('#submit').bind('click', function (e) {
            document.getElementById("submit").style.display = "none";
        });
    });
    console.log("ready!");



});
