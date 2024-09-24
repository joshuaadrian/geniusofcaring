var _throttleTimer = null;
var _throttleDelay = 100;
var $window = $(window);
var $document = $(document);

$document.ready(function () {

    $window
        .off('scroll', ScrollHandler)
        .on('scroll', ScrollHandler);

});

function ScrollHandler(e) {
    if($('body').hasClass('has_modal')){
        return false;
    }
    //throttle event:
    clearTimeout(_throttleTimer);
    _throttleTimer = setTimeout(function () {
        console.log('scroll');

        //do work
        if ($window.scrollTop() + $window.height() > $document.height() - 300) {
            LoadMore();
        }

    }, _throttleDelay);
}

function LoadMore(){
    var page = $('ul.gallery').data('page');
    if(!page){
        page = 1;
    } else {
        page = page+1;
    }
	$('ul.gallery').data('page', page);
    $.post( '/wp-content/themes/caring/helpers/load_more.php', { limit: "20", page: page } ) 
        .done(function( data ) {
            var newitems = $(data);
            $('ul.gallery').isotope( 'insert', newitems )
			ScrollHandler();
    }); 
}