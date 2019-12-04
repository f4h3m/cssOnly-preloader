(function($) {

    $(window).on('load', function () {
        if ($(".preloader-area").length > 0) {
            $(".preloader-area").fadeOut("slow");
        }
    });

})(jQuery);