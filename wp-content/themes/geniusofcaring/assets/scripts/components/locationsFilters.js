if ( $('.locations--dropdown').length > 0 ) {

  // if (
  //   ('ontouchstart' in window) ||
  //   (navigator.maxTouchPoints > 0) ||
  //   (navigator.msMaxTouchPoints > 0) ||
  //   window.document.documentMode
  // ) {

  //   $('.locations--dropdown').on('change', function(e) {
  //     e.preventDefault();
  //     filterlocations();
  //   });

  // } else {

    $('.locations--dropdown').selectric({
      maxHeight: 300,
      disableOnMobile: false
    }).on('change', function(e, element, selectric) {
      e.preventDefault();
      filterlocations();
    });
    
  // }

}

function filterlocations() {

  var classesArray   = [];
  var locationsItems = $('.locations--item');

  $('.locations--dropdown').each(function(){

    var selectClass = $(this).val();

    if (selectClass) {
      
      classesArray.push(selectClass);
    }

  });

  if (classesArray.length > 0) {

    locationsItems.each(function() {

      var shouldHide = false;
      var locationsItem  = $(this);

      $.each(classesArray, function(i,val) {

        if ( !locationsItem.hasClass(val) ) {
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

    locationsItems.removeClass('is-hiding');

  }

  locationsItems.addClass('over');

}
