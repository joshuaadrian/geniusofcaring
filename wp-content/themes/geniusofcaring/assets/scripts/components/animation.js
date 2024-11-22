

// Detect if element is inview
var inView = function ( elements ) {

  var $window    = $(window);
  var docViewTop = $window.scrollTop() + $window.height() - ( $window.height() / 10 );

  elements.each( function( index ) {

    if ( !$(this).hasClass('over') ) {

      var elemTop = $(this).offset().top;

      if ( elemTop < docViewTop ) {

        $(this).addClass('over');

      }

    }

  });

};

inView( $('.inview') );

$( window ).scroll( function(e) {
  inView( $('.inview') );
});

