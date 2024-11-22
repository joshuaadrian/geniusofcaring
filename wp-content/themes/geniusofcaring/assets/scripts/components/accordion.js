export const accordion = () => {

    $('.accordion--title-link').on("click", function (e) {

      e.preventDefault();

      var parent = $(this).closest('.accordion-block');
      
      if ( !parent.hasClass('is-expanded') ) {

        $('.accordion-block').removeClass('is-expanded');
        parent.addClass('is-expanded');

        // var parentOffset = parent.offset();

        // console.log(parentOffset);

        // $('html, body').animate({
        //   scrollTop: parentOffset.top
        // }, 250);

      } else {
        parent.removeClass('is-expanded');
      }

    });

 }