

var winWidth = $(window).width();

function isTouchDevice() {
  return (('ontouchstart' in window) ||
     (navigator.maxTouchPoints > 0) ||
     (navigator.msMaxTouchPoints > 0));
}

if ( isTouchDevice() ) {
  $('html').addClass('is-touch');
}

$('.back-to-top').on('click', function(e) {

  e.preventDefault();
  $('html, body').animate({
    scrollTop: 0
  }, 750);

});

// Add class to body on hamburger click
$('.navbar-toggler').on('click', function(e) {

  e.preventDefault();

  $('body').toggleClass('menu-is-open');
  $('body').removeClass('is-searching');

  if (!$('body').hasClass('menu-is-open')) {
    $('.nav-search').removeClass('is-showing');
    $('.menu-item').not('.nav-search').removeClass('is-hiding');
  } else {
    $('.dropdown').removeClass('is-expanded');
    $('#menu-primary-menu').removeClass('depth-0-expanded').removeClass('depth-1-expanded');
  }

  if ( $('body').hasClass('menu-is-open') ) {

    $(this).attr('aria-expanded','true');
    $('.navbar--container').attr('aria-hidden','false')

  } else {

    $(this).attr('aria-expanded','false');
    $('.navbar--container').attr('aria-hidden','true')

  }

});

if ( !$('body').hasClass('home') ) {

  var menuItems = $('.banner .menu-item a');

  menuItems.each(function() {
    var href = $(this).attr('href');

    if ( href.indexOf("#") != -1 ) {
      var newHref = 'https://' + window.location.hostname + '/' + href;
      $(this).attr('href',newHref);
    }

  });

}

$('.menu-item > a').on('click', function(e) {

  if ( winWidth < 1200 ) {
    $('body').removeClass('menu-is-open');
  }

});

$('.ginput_container input:not(:file), .ginput_container textarea').on('focusout', function(e) {

  var thisVal = $(this).val();

  if (thisVal) {
    $(this).parent().addClass('has-value');
  } else {
    $(this).parent().removeClass('has-value');
  }

});

if ( $('.blank').length > 0 ) {

  $('.blank').each( function(index, value) {
    $(this).find('a').attr('target','_blank').attr('rel','external noreferrer noopener');
  });

}
