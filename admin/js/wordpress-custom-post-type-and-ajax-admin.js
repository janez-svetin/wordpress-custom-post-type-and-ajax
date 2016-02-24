(function( $ ) {
	'use strict';
	
	$(function() {
		$('.event_meta_item select').change(function() {
			if($(this).val() === 'festival' || $(this).val() === 'conference') {
				$('.fest_conf_show').removeClass('hidden');
			}
			else {
				$('.fest_conf_show').addClass('hidden');
			}
		});
	});

})( jQuery );
