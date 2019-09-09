jQuery(document).ready(function( $ ) {

    /* Navigation */
    $('.stellarnav').stellarNav({
        breakpoint: 768,
    });

    /* Flex Slider */
    $('.flexslider').flexslider({
        animation: "slide",
        nextText: "",
        prevText: ""
    });

    /* Remove emplty div widgets */
    $('.widget div.widget-content').each(function(){
        if($(this).children().length == 0){
            $(this).remove();
        }
    });


    /* Instagram Feed */
    var instagramUsername = $('.instagram-area').data('instagramUsername');
    if( instagramUsername !== '' ) {
        $(window).on('load', function(){
            $.instagramFeed({
                'username': instagramUsername,
                'container': ".instagram-posts",
                'display_profile': false,
                'display_biography': false,
                'display_gallery': true,
                'get_raw_json': false,
                'callback': null,
                'styling': true,
                'items': 8,
                'items_per_row': 8,
                'margin': 0,
            });
        });
    }

    /* FitVids */
    $(".post-video").fitVids();

    /* Go Top */
    $('.go-top').on('click', function(event) {
            event.preventDefault();
        $('html, body').animate({ scrollTop: 0 }, 'slow');
    });

});

