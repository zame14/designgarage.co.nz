jQuery(function($) {
    var $ = jQuery;
    var waypoint = new Waypoint({
        element: document.getElementById('header'),
        handler: function() {
            //$(".home #header .custom-logo-link").toggleClass('ani-show');
        },
        offset: -10
    })
    $(".menu-toggle").click(function() {
        $("#rk-menu-wrapper").toggleClass('open-menu');
        $(this).toggleClass('close-btn');
    });
    $(".home .project-tile",this).hover(function() {
        var bg = $(this).data('bg');
        $("#page-wrapper").css('background-color',bg);
    },
    function() {
        $("#page-wrapper").css('background-color','#ffffff');
    });
});

function filterCategory(cat) {
    var $ = jQuery;
    $.ajax({
        url: "?ajax=filter_category&categoryid=" + cat,
        cache: false,
        success: function (response) {
            $(".project-tiles-wrapper").html(response).hide().fadeIn();
        }
    });
}