import Combobo from 'combobo'; // or require('combobo')

const combobo = new Combobo();

combobo
	.on('change', function () {
		console.log('stuff has changed and stuff');
	})
	.on('selection', function () {
		console.log('selection made!');
	});