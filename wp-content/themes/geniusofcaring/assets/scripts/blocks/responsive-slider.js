import 'flickity/dist/flickity.min.css';

if ( 
	$('.responsive-slider--wrapper').length > 0
	|| $('.transactions--slider').length > 0
	|| $('.quote-slider--wrapper').length > 0
	|| $('.transactions--carousel').length > 0
) { 

	const Flickity = require('flickity');
	require('flickity-fade');

	$('.responsive-slider--wrapper').each(function() {

		let _this     = $(this).attr('id');
		let _settings = JSON.parse($(this).attr('data-settings'));
		let flkty     = new Flickity( '#'+_this, _settings);

	});

	$('.transactions--slider').each(function() {

		let _this     = $(this).attr('id');
		let _settings = JSON.parse($(this).attr('data-settings'));
		let flkty     = new Flickity( '#'+_this, _settings);

	});

	$('.quote-slider--wrapper').each(function() {

		var items = $(this).find('.qs-item');

		if ( items.length > 1 ) {

			let _this     = $(this).attr('id');
			let _settings = JSON.parse($(this).attr('data-settings'));
			let flkty     = new Flickity( '#'+_this, _settings);

		}

	});

	$('.transactions--carousel').each(function() {

		var items = $(this).find('.transactions--carousel--item');

		if ( items.length >= 1 ) {

			let _this     = $(this).attr('id');
			let _settings = JSON.parse($(this).attr('data-settings'));
			let flkty     = new Flickity( '#'+_this, _settings);

		}

	});
	
}