// Vendor Libraries

try {

  window.$ = window.jQuery = require('jquery');
  window.Selectric         = require('jquery-selectric');

  var isIE11 = !!window.MSInputMethodContext && !!document.documentMode ? 'is-ie' : 'is-not-ie';
  $('html').removeClass('no-js').addClass('is-loaded').addClass(isIE11);

} catch (e) {
  console.log(e);
}

import { accordion } from './components/accordion';
import { slider } from './components/slider';

jQuery(document).ready(function($) {

  // Components
  require('./components/utilities');
  require('./components/scrollTracker');
  require('./components/animation');
  require('./components/ada');
  require('./components/postFilters');
  require('./components/disclaimer');

  // Blocks
  require('./blocks/masthead');
  require('./blocks/wp-menu');
  require('./blocks/marquee');

  accordion();
  slider();

});