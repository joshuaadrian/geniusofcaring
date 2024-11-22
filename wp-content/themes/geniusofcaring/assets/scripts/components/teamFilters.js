import LazyLoad from "vanilla-lazyload";

var winWidth = $(window).width();

if ( $('.team--item').length > 0 ) {

  var lazyLoadTeamItems = new LazyLoad();

  $('.team--item-link').on('click',function(e) {

    e.preventDefault();
    var href      = $(this).attr('href');
    var title     = $('#team-filter--title').val();
    var specialty = $('#team-filter--specialty').val();
    var role      = $('#team-filter--role').val();
    var network   = $('#team-filter--network').val();
    var location  = $('#team-filter--location').val();
    var query     = '';

    if ( title || specialty || role || title ) {

      query    = '?';

      if ( title ) {
        query += 'title=' +title;
      }

      if ( specialty ) {
        query += '&specialty=' +specialty;
      }

      if ( role ) {
        query += '&role=' +role;
      }

      if ( title ) {
        query += '&network=' +network;
      }

      if ( location ) {
        query += '&location=' +location;
      }

      href = href + query;

    }

    if (history.pushState) {
      var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + query;
      window.history.pushState({path:newurl},'',newurl);
    }

    window.location.href = href;

  });

}

if ( $('.team--dropdown').length > 0 ) {

  // if (
  //   ('ontouchstart' in window) ||
  //   (navigator.maxTouchPoints > 0) ||
  //   (navigator.msMaxTouchPoints > 0) ||
  //   window.document.documentMode
  // ) {

  //   $('.team--dropdown').on('change', function(e) {
  //     e.preventDefault();
  //     filterTeam();
  //   });

  // } else {

    $('.team--dropdown').selectric({
      maxHeight: 300,
      disableOnMobile: false
    }).on('change', function(e, element, selectric) {
      e.preventDefault();
      filterTeam();
    });
    
  // }

}

$('#team--search-input').on('focus',function(e) {

  var tagValue = $(this).val();

  if ( window.document.documentMode ) {

    if ( tagValue ) {
      $('.team--dropdown').val("");
      searchTeam(tagValue);
    } else {
      $('.team--item').removeClass('is-hiding');
      $('.team--dropdown').val("");
    }

  } else {

    if ( tagValue ) {
      $('.team--dropdown').val("").selectric('refresh');
      searchTeam(tagValue);
    } else {
      $('.team--item').removeClass('is-hiding');
      $('.team--dropdown').val("").selectric('refresh');
    }

  }

});

$('.team--search').on('click',function() {

  let inputValue = $(this).find('input').val();

  if ( inputValue && !$(this).hasClass('is-expanded') ) {
    $(this).addClass('has-value');
    $(this).addClass('is-expanded');
  } else if ( inputValue ) {
    $(this).addClass('has-value');
  } else {
    $(this).removeClass('has-value');
    $(this).toggleClass('is-expanded');
  }

});

$('#team--search-input').keyup(function( event ) {
  var tagValue = $(this).val().toLowerCase();
  searchTeam(tagValue);
});

$('.team--reset-filter-a').on('click',function(e) {
  e.preventDefault();
  resetFilters();
});

function resetFilters() {

  if ( window.document.documentMode ) {
    $('.team--dropdown').val("");
  } else {
    $('.team--dropdown').val("").selectric('refresh');
  }

  $('#team--search-input').val("");
  $('.team--item').removeClass('is-hiding');
  $('.team--item-section').removeClass('is-hiding');

}

function filterTeam() {

  $('#team--search-input').val("");

  var classesArray       = [];
  var teamItems          = $('.team--item');

  $('.team--dropdown').each(function(){

    var selectClass = $(this).val();

    if (selectClass) {
      
      classesArray.push(selectClass);
    }

  });

  if (classesArray.length > 0) {

    teamItems.each(function() {

      var shouldHide = false;
      var teamItem  = $(this);

      $.each(classesArray, function(i,val) {

        if ( !teamItem.hasClass(val) ) {
          shouldHide = true;
        }

      });

      if (shouldHide) {
        $(this).addClass('is-hiding');
      } else {
        $(this).removeClass('is-hiding');
      };

    });

  } else {

    teamItems.removeClass('is-hiding');

  }

  teamItems.addClass('over');

}

function searchTeam( value ) {

  var tagValue   = value.replace(/[^a-z0-9]/gi, '');
  var teamItems = $('.team--item');
  var sectionTitleSnrLdr = false;
  var sectionTitleAllLdr   = false;

  if (tagValue && tagValue.length > 2) {

    teamItems.each(function() {

      var shouldHide = false;
      var teamItem   = $(this);
      var tags       = teamItem.data('searchtags');

      if ( !tags.includes(tagValue) ) {
        shouldHide = true;
      }

      if (shouldHide) {
        $(this).addClass('is-hiding');
      } else {
        $(this).removeClass('is-hiding').addClass('over');
      };

    });

  } else {
    teamItems.removeClass('is-hiding');
  }

}
