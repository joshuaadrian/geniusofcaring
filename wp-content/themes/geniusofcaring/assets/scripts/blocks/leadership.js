var winWidth = $(window).width();

$('.leadership--item--link').on('click', function(e) {

  e.preventDefault();

  $('.leadership--item').removeClass('is-expanded').attr('aria-expanded','false');
  $(this).parent().addClass('is-expanded');
  $(this).attr('aria-expanded','true');

  var itemHeight = $(this).height();
  var gridOffset = $(this).offset();
  var banner = winWidth > 1199 ? 0 : 80;
  var href = $(this).attr('href');
  $(href).attr('aria-hidden','false');

  $('html, body').animate({
    scrollTop: gridOffset.top + itemHeight
  }, 750);

});

$('.leadership--bio--close').on('click', function(e) {

  e.preventDefault();

  var bio =  $(this).closest('.leadership--bio');
  bio.prev().removeClass('is-expanded');

  var leadershipItem = bio.data('image');
  var leadershipItemOffset = $('#'+leadershipItem).offset();
  var banner = winWidth > 1199 ? 102 : 80;

  $('html, body').animate({
    scrollTop: leadershipItemOffset.top - banner
  }, 750);


});