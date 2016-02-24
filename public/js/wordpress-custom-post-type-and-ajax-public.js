(function( $ ) {
	'use strict';
	
	$(function() {
		$('.event_filters input').change(function() {
			console.log("filter changed");
			var page = $('.page-numbers.current').contents().eq(1).text();
			reloadPosts(page);
		});

		$('.pagination .page-numbers').click(function(e) {
			e.preventDefault();
			var page = $(this).contents().eq(1).text();
			reloadPosts(page);
		});

		function reloadPosts(page) {
			var checked = $('.event_filters input:checked').map(function() {
				return this.id;
			}).get();

			$('.tagged-posts').fadeOut();

			var data = {
				action: 'filter_posts', // function to execute
				afp_nonce: afp_vars.afp_nonce, // wp_nonce
				types: checked, // selected tag
				page: page
			};

			$.post( afp_vars.afp_ajax_url, data, function(response) {
				if( response ) {
					$('.tagged-posts').html( response );
					$('.tagged-posts').fadeIn();

					$('.pagination .page-numbers').removeClass('current');
					$('.pagination .page-numbers:contains("'+page+'")').addClass('current');
				};
			});
		}
	});

})( jQuery );