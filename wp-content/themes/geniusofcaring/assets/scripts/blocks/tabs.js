$('.tabs--link a').on('click', function(e) {

	e.preventDefault();

	$('.tabs--link').removeClass('is-showing');
	$('.tab-content').removeClass('is-showing');
	$(this).parent().addClass('is-showing');
	$($(this).attr('href')).addClass('is-showing');

	var gridOffset = $(this).offset();
	var banner = $('.banner').height();

	$('html, body').animate({
		scrollTop: gridOffset.top - banner
	}, 750);

});

$('.tab-content').on('click', '.tab-content-close', function(e) {
	$(this).parent('.tab-content').removeClass('is-showing');
	$('.tabs--link').removeClass('is-showing');
});

$('.tab-content').each(function(i){
	$(this).prepend('<span class="tab-content-close">&times;</span>');
});