if ($('.box-list--box').length > 0) {

	$('.box-list--box').on('click', function() {
		$('.box-list--box').not(this).removeClass('is-showing');
		$(this).toggleClass('is-showing');
	});

}
