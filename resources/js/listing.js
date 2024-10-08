(function ($) {
    'use strict';

    let totalPages = 1;
    let currentPage = 1;
    let loading = false;
    const itemsPerPage = 4;

    $('.rvp-tab').on('click', function() {
        $('.rvp-tab').removeClass('active-tab');
        $(this).addClass('active-tab');

        currentPage = 1;
        let order = $(this).data('order');
        loadListings(order, true);
    });

    $('.rvp-show-more').on('click', function() {
        if (!loading && currentPage < totalPages) {
            loading = true;
            currentPage++;
            let order = $('.rvp-tab.active-tab').data('order') || 'top_rated';
            loadListings(order, false);
        }
    });

    $('.rvp-tabs-sort-by').on('click', function() {
        $('.rvp-tabs').slideToggle(300);
        $(this).toggleClass('open');
    });

    function loadListings(order, replace = false) {
        $.ajax({
            url: '/wp-json/iu/v1/get_listings',
            method: 'GET',
            data: {
                order: order,
                page: currentPage
            },
            success: function(response) {
                if (replace) {
                    $('.rvp-listing').html(response.html);
                } else {
                    $('.rvp-listing').append(response.html);
                }

                totalPages = response.total_pages;

                if (currentPage >= totalPages) {
                    $('.rvp-show-more').hide();
                } else {
                    $('.rvp-show-more').show().text('Show More');
                }

                loading = false;
            },
            error: function(error) {
                console.error('Error fetching listings:', error);
                loading = false;
            }
        });
    }

    loadListings('top_rated', true);

})(jQuery);
