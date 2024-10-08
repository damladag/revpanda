(function ($) {
    'use strict';

    $('.search-toggle').on('click', function(event) {
        event.preventDefault();
        $('.search-form').toggleClass('hidden');
    });

})(jQuery);