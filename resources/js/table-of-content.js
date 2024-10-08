(function($) {
    'use strict';

    $('.rvp-toc').on('click', function() {
        $('.rvp-toc-content').slideToggle(500);
        $('.rvp-toc-arrow').toggleClass('rotated')
    });
})(jQuery);
