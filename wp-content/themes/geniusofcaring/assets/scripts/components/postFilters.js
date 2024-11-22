if ( $('.media--dropdown').length > 0 ) {

  var grid = $('.media--grid');

  $(".posts--pagination-more").on('click',function(e) {
    e.preventDefault();
    var paged = parseFloat( $(this).attr('data-next') );
    var type  = $(this).attr('data-type');
    type = type ? type : 'post'
    updateMediaResults(paged, type);
  });

  $(".media--dropdown").on('change',function() {
    updateMediaResults();
  });

  var updateMediaResults = function( paged, type ) {

    paged       = paged ? paged : 1;
    let filters = $('.media--filters');

    $.ajax({
       type     : "post",
       dataType : "json",
       url      : localized_object.ajax_url,
       data : {
          action : "get_media_form",
          year   : $('#media-filter--year').val(),
          cat   : $('#media-filter--category').val(),
          nonce  : localized_object.nonce,
          paged  : paged
       },
       timeout    : 300000,
       beforeSend : function() {
          filters.addClass('is-loading');
          filters.css({'cursor': 'wait'});
          filters.find('input, button, select, label').css({'cursor': 'wait'});
       }
    }).done( function( response ) {



      if ( response && typeof response.media !== 'undefined' ) {

        var count = $('.cur-num').text();

        console.log(response.media);

        grid.html(response.media);

        $(".posts--pagination-more").attr('data-next', response.cur_page + 1 );
        $('.cur-num').html(count);
        $('.max-num').html(parseFloat(response.max_count));

        if ( response.cur_page < response.max_pages ) {
          $(".posts--pagination-more").show();
        } else {
          $(".posts--pagination-more").hide();
        }

      }

    }).fail( function( request, status, err ) {

       console.log( 'REQUEST => ' + request );
       console.log( 'STATUS => ' + status );
       console.log( 'ERR => ' );
       console.log( err );

    }).always(function() {

      filters.removeClass('is-loading');
      filters.css({'cursor': 'auto'});
      filters.find('input, button, select, label').css({'cursor': 'auto'});

    });

  }

}