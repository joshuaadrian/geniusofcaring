$('.event--button:not(.is-pdf) .wp-block-buttons').on('click', function(e) {
	e.preventDefault();
	$(this).toggleClass('is-showing-tooltip');
});