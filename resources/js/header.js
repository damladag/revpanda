(function ($) {
    'use strict';

    $(document).ready(function () {
        $('.rvp-hamburger').click(function(){
            $(this).toggleClass('open');
            $('.rvp-header-nav').toggleClass('open');
        });

        $('.menu-item-has-children').on('click', function (event) {
            if ($(event.target).is('a')) {
                return;
            }
            event.preventDefault();
            let subMenu = $(this).find('> .sub-menu');

            if ($(this).hasClass('open')) {
                $(this).removeClass('open');
                $(this).next('.appended-sub-menu').slideUp(function() {
                    $(this).remove();
                });
            } else {
                $(this).addClass('open');
                let clonedSubMenu = subMenu.clone().show().addClass('appended-sub-menu');
                $(this).after(clonedSubMenu.hide());
                clonedSubMenu.slideDown();
            }
        });
    });

})(jQuery);